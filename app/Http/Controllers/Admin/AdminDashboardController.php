<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\ContactMessage;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'services' => Service::count(),
            'gallery' => Gallery::count(),
            'messages' => ContactMessage::where('is_read', false)->count()
        ];

        $recentMessages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages'));
    }
}
