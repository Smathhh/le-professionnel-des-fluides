<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->orderBy('order')->paginate(12);
        return view('products', compact('products'));
    }

    public function devis(Request $request, Product $product)
    {
        $qty = max(1, (int) $request->query('qty', 1));
        $clientName = (string) $request->query('client', 'CLIENT PROFESSIONNEL');
        $clientAddress = (string) $request->query('client_address', 'Casablanca, Maroc');
        $delai = (string) $request->query('delai', 'DISPO');
        $devisNumber = str_pad((string) $product->id, 4, '0', STR_PAD_LEFT) . '/' . date('y');

        return view('products-devis', compact('product', 'qty', 'clientName', 'clientAddress', 'delai', 'devisNumber'));
    }
}
