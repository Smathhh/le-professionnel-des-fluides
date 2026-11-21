<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'whatsapp' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'about_text' => 'nullable|string',
            'about_text_ar' => 'nullable|string',
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }

        return redirect()->route('admin.settings')->with('success', 'Paramètres et numéro WhatsApp mis à jour avec succès.');
    }
}
