<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\About;

class PageController extends Controller
{
    public function about()
    {
        $about = About::first(); 
        
        return view('about', compact('about'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function storeContact(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'content' => 'required|min:10',
        ]);

        // Simpan ke Database
        Message::create($validated);

        // Kembali dengan pesan sukses
        return back()->with('success', 'Terima kasih! Pesan Anda sudah terkirim.');
    }
}