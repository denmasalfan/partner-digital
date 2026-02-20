<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Portfolio - {{ config('app.name') }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* CSS Masonry Layout */
        .masonry-grid {
            column-count: 1;
            column-gap: 1.5rem;
        }
        @media (min-width: 640px) { .masonry-grid { column-count: 2; } }
        @media (min-width: 1024px) { .masonry-grid { column-count: 3; } }
        
        .break-inside-avoid {
            break-inside: avoid;
        }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800 antialiased selection:bg-black selection:text-white">

    <nav class="fixed w-full bg-white/80 backdrop-blur-md border-b border-gray-100 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="/" class="text-2xl font-bold tracking-tighter hover:opacity-70 transition">
                PARTNER<span class="text-gray-400 font-light">DIGITAL.</span>
            </a>
            <div class="hidden md:flex space-x-8 text-sm font-medium text-gray-500">
                <a href="/" class="hover:text-black transition">Work</a>
                <a href="/about" class="hover:text-black transition">About</a>
                <a href="/contact" class="hover:text-black transition">Contact</a>
            </div>
        </div>
    </nav>

    <header class="pt-32 pb-12 px-4 text-center">
        <h1 class="text-5xl md:text-7xl font-light mb-6 tracking-tight text-gray-900">
            Visual <span class="font-bold">Storyteller</span>
        </h1>
        <p class="text-gray-500 max-w-xl mx-auto text-lg font-light leading-relaxed">
            Kumpulan momen yang diabadikan dengan hati.
            <br>Menampilkan keindahan dalam kesederhanaan.
        </p>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        
        <div class="mb-12 flex flex-wrap justify-center gap-3">
            
            <a href="/" 
               class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 border 
               {{ !request('category') ? 'bg-black text-white border-black shadow-lg' : 'bg-white text-gray-500 border-gray-200 hover:border-gray-400 hover:text-black' }}">
               Semua
            </a>

            @foreach($categories as $category)
                <a href="/?category={{ $category->slug }}" 
                   class="px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 border 
                   {{ request('category') == $category->slug ? 'bg-black text-white border-black shadow-lg' : 'bg-white text-gray-500 border-gray-200 hover:border-gray-400 hover:text-black' }}">
                   {{ $category->name }}
                </a>
            @endforeach

        </div>

        <div class="masonry-grid">

            @forelse($photos as $photo)
                <div class="break-inside-avoid mb-6 group relative">
                    
                    <a href="{{ asset('storage/' . $photo->image_path) }}" 
                       class="glightbox block relative overflow-hidden rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-500"
                       data-gallery="gallery1"
                       data-title="{{ $photo->title }}"
                       data-description="{{ $photo->description }}">
                        
                        <img src="{{ asset('storage/' . ($photo->thumbnail_path ?? $photo->image_path)) }}" 
                             alt="{{ $photo->alt_text }}" 
                             class="w-full h-auto object-cover transform group-hover:scale-105 transition duration-700 ease-in-out"
                             loading="lazy">
                        
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            <span class="text-white font-medium text-lg translate-y-4 group-hover:translate-y-0 transition duration-300">
                                {{ $photo->title }}
                            </span>
                            <span class="text-gray-200 text-xs uppercase tracking-wider mt-1 translate-y-4 group-hover:translate-y-0 transition duration-300 delay-75">
                                {{ $photo->category->name ?? 'Uncategorized' }} &rarr;
                            </span>
                        </div>
                    </a>

                </div>
            @empty
                <div class="col-span-3 text-center py-20">
                    <div class="inline-block p-6 rounded-full bg-gray-100 mb-4">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada foto</h3>
                    <p class="text-gray-500 mt-1">Coba pilih kategori lain atau upload foto baru.</p>
                </div>
            @endforelse

        </div>

    </main>

    <footer class="border-t border-gray-200 bg-white py-12 text-center">
        <p class="text-gray-400 text-sm">
            &copy; {{ date('Y') }} Partner Digital. All rights reserved.
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        const lightbox = GLightbox({
            touchNavigation: true,
            loop: true,
            autoplayVideos: true
        });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.3.1/index.min.js"></script>
</body>
</html>