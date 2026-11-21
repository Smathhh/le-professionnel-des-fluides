<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\NoSqlStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class MobileApiController extends Controller
{
    /**
     * Verify PIN code with timing attack protection.
     */
    protected function verifyPin(Request $request): bool
    {
        $pin = (string) $request->header('X-Admin-PIN', $request->input('pin', ''));
        $masterPin = (string) config('app.admin_mobile_pin', env('ADMIN_MOBILE_PIN', '1234'));
        return $pin !== '' && hash_equals($masterPin, $pin);
    }

    /**
     * Authenticate PIN from Android APK.
     */
    public function checkPin(Request $request)
    {
        if ($this->verifyPin($request)) {
            return response()->json([
                'success' => true,
                'message' => 'PIN valide',
                'server_time' => now()->toIso8601String(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Code PIN incorrect.',
        ], 401);
    }

    /**
     * List pieces / products with ETag + 304 Not Modified caching and 60-second Redis/Database Cache.
     */
    public function getProducts(Request $request)
    {
        if (!$this->verifyPin($request)) {
            return response()->json(['success' => false, 'message' => 'Accès refusé'], 403);
        }

        // Cache optimization for mobile speed
        $data = Cache::remember('api_mobile_products_list', 60, function () {
            $products = Product::orderBy('created_at', 'desc')->get()->map(function ($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'name_ar' => $p->name_ar,
                    'category' => $p->category,
                    'price' => $p->price,
                    'description' => $p->description,
                    'image' => $p->image,
                    'image_url' => $p->image ? asset('storage/' . $p->image) : null,
                    'created_at' => $p->created_at ? $p->created_at->toIso8601String() : null,
                ];
            });

            return [
                'items' => $products,
                'etag' => md5(json_encode($products) . Product::max('updated_at')),
            ];
        });

        $etag = $data['etag'];

        // HTTP ETag conditional request support (304 Not Modified saves battery and data)
        if ($request->header('If-None-Match') === $etag) {
            return response()->noContent(304, ['ETag' => $etag]);
        }

        return response()->json([
            'success' => true,
            'count' => count($data['items']),
            'products' => $data['items'],
        ])->header('ETag', $etag)
          ->header('Cache-Control', 'public, max-age=30');
    }

    /**
     * Upload a new piece directly from Android camera.
     */
    public function storeProduct(Request $request)
    {
        if (!$this->verifyPin($request)) {
            return response()->json(['success' => false, 'message' => 'Accès refusé'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'required|mimes:jpeg,jpg,png,webp|max:15360', // Up to 15MB phone camera pics
        ]);

        if (empty($validated['description'])) {
            $validated['description'] = 'Pièce de rechange / équipement de haute qualité - ' . $validated['name'];
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $validated['is_active'] = true;
        $validated['order'] = Product::max('order') + 1;

        $product = Product::create($validated);

        // Invalidate cache immediately so app has fresh data
        Cache::forget('api_mobile_products_list');

        // Permanently persist in NoSQL document database
        NoSqlStore::save('products', $product->toArray());

        return response()->json([
            'success' => true,
            'message' => 'Pièce ajoutée et synchronisée avec succès !',
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category,
                'price' => $product->price,
                'image_url' => asset('storage/' . $product->image),
            ],
        ], 201);
    }

    /**
     * Delete a piece from mobile.
     */
    public function destroyProduct(Request $request, $id)
    {
        if (!$this->verifyPin($request)) {
            return response()->json(['success' => false, 'message' => 'Accès refusé'], 403);
        }

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produit introuvable'], 404);
        }

        if ($product->image && $product->image !== 'default.jpg') {
            Storage::disk('public')->delete($product->image);
        }

        NoSqlStore::delete('products', $id);
        $product->delete();

        // Invalidate cache immediately
        Cache::forget('api_mobile_products_list');

        return response()->json([
            'success' => true,
            'message' => 'Pièce supprimée avec succès.',
        ]);
    }
}

