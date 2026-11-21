<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminMobileAppController extends Controller
{
    /**
     * Check if the current session has valid admin authorization (via PIN or Auth).
     */
    protected function isAuthorized(): bool
    {
        $masterPin = (string) config('app.admin_mobile_pin', '1234');
        $sessionPin = (string) session('admin_mobile_pin', '');
        return Auth::check() || ($sessionPin !== '' && hash_equals($masterPin, $sessionPin));
    }

    /**
     * Display the mobile uploader app interface.
     */
    public function index(Request $request)
    {
        if (!$this->isAuthorized()) {
            return view('admin.mobile-pin');
        }

        $recentProducts = Product::orderBy('created_at', 'desc')->take(15)->get();
        return view('admin.mobile-uploader', compact('recentProducts'));
    }

    /**
     * Unlock mobile app with PIN.
     */
    public function verifyPin(Request $request)
    {
        $request->validate(['pin' => 'required|string|max:20']);
        $masterPin = (string) config('app.admin_mobile_pin', '1234');

        if (hash_equals($masterPin, (string) $request->pin)) {
            $adminUser = User::first();
            if ($adminUser) {
                Auth::login($adminUser, true);
            }
            session(['admin_mobile_pin' => $request->pin]);
            return redirect()->route('admin.mobile.uploader')->with('success', 'Connecté avec succès !');
        }

        return back()->withErrors(['pin' => 'Code PIN incorrect. Veuillez réessayer.']);
    }

    /**
     * Store new piece/material directly from mobile camera.
     */
    public function store(Request $request)
    {
        if (!$this->isAuthorized()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'image' => 'required|mimes:jpeg,jpg,png,webp|max:10240', // Safe raster formats up to 10MB
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

        // Permanently persist in NoSQL document database
        \App\Services\NoSqlStore::save('products', $product->toArray());

        return redirect()->route('admin.mobile.uploader')->with('success', '✅ Pièce ajoutée et publiée avec succès sur le site !');
    }

    /**
     * Quick delete a piece from mobile.
     */
    public function destroy($id)
    {
        if (!$this->isAuthorized()) {
            abort(403, 'Accès non autorisé.');
        }

        $product = Product::findOrFail($id);
        if ($product->image && $product->image !== 'default.jpg') {
            Storage::disk('public')->delete($product->image);
        }

        // Delete from NoSQL document database
        \App\Services\NoSqlStore::delete('products', $id);

        $product->delete();

        return redirect()->route('admin.mobile.uploader')->with('success', 'Pièce supprimée.');
    }
}

