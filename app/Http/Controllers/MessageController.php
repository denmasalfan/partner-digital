<?php

namespace App\Http\Controllers;

use App\Models\Message; 
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return view('contact'); 
    }

    public function send(Request $request)
{
    $validated = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'message' => 'required|string', 
    ]);


    Message::create([
        'name'    => $validated['name'],
        'email'   => $validated['email'],
        'content' => $validated['message'], 
    ]);

    return back()->with('success', 'Terima kasih, pesan Anda sudah kami terima!');
}
}