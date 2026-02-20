<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Category; // <--- JANGAN LUPA INI
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil daftar Kategori (hanya yang punya foto)
        // Biar kategori kosong tidak menuh-menuhin menu
        $categories = Category::has('photos')->get();

        // 2. Siapkan Query Dasar (Ambil foto aktif)
        $query = Photo::where('is_active', true);

        // 3. Cek apakah ada request filter? (misal: ?category=wedding)
        if ($request->has('category')) {
            $slug = $request->get('category');
            
            // Filter foto berdasarkan slug kategori
            $query->whereHas('category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }

        // 4. Urutkan (Prioritas -> Terbaru)
        $photos = $query->orderBy('sort_order', 'asc')
                        ->latest()
                        ->get();

        return view('home', compact('photos', 'categories'));
    }
}