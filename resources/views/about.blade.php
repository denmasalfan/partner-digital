<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Partner Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">
    <script> tailwind.config = { theme: { extend: { fontFamily: { sans: ['Outfit', 'sans-serif'] } } } } </script>
</head>
<body class="bg-[#F8F9FA] text-gray-800 antialiased">

    <nav class="fixed w-full bg-white/80 backdrop-blur-md border-b border-gray-100 z-50">
        <div class="max-w-7xl mx-auto px-4 h-20 flex items-center justify-between">
            <a href="/" class="text-2xl font-bold tracking-tighter">PARTNER<span class="text-gray-400 font-light">DIGITAL.</span></a>
            <div class="flex space-x-8 text-sm font-medium">
                <a href="/" class="hover:text-black text-gray-500 transition">Work</a>
                <a href="/about" class="text-black transition">About</a>
                <a href="/contact" class="hover:text-black transition">Contact</a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-6 pt-40 pb-20">
        
        @if($about)
            <h1 class="text-5xl font-light mb-8 leading-tight">
                {{ $about->title }}
            </h1>
            
            <div class="grid md:grid-cols-3 gap-10 items-start">
                
                @if($about->image)
                    <div class="md:col-span-1">
                        <img src="{{ asset('storage/' . $about->image) }}" 
                             class="rounded-2xl shadow-lg w-full object-cover" 
                             alt="Foto Profil">
                    </div>
                @endif

                <div class="{{ $about->image ? 'md:col-span-2' : 'md:col-span-3' }}">
                    <div class="prose prose-lg text-gray-500 leading-relaxed max-w-none">
                        {!! $about->content !!}
                    </div>
                </div>

            </div>
        @else
            <div class="text-center py-20 bg-gray-100 rounded-lg">
                <h2 class="text-2xl font-bold text-gray-400">Belum ada data Profil.</h2>
                <p class="text-gray-500">Silakan isi di Admin Panel menu 'Abouts'.</p>
            </div>
        @endif

</body>
</html>