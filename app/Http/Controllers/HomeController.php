<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)->orderBy('order')->take(4)->get();
        $products = Product::where('is_active', true)->orderBy('order')->take(6)->get();
        $gallery = Gallery::where('is_active', true)->orderBy('order')->take(6)->get();
        
        return view('home', compact('services', 'products', 'gallery'));
    }

    public function about()
    {
        return view('about');
    }
}
