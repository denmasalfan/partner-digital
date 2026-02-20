<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Partner Digital</title>
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
                <a href="/about" class="hover:text-black text-gray-500 transition">About</a>
                <a href="/contact" class="hover:text-black transition">Contact</a>
            </div>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto px-6 pt-40 pb-20">
        <h1 class="text-5xl font-light mb-4">Mari <span class="font-bold">Berkolaborasi.</span></h1>
        <p class="text-gray-500 mb-10 text-lg">Punya ide proyek? Atau sekadar ingin menyapa? Isi form di bawah ini.</p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full px-4 py-3 rounded-lg bg-white border border-gray-200 focus:border-black focus:ring-0 transition outline-none" placeholder="Jhon Doe">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                <input type="email" name="email" required class="w-full px-4 py-3 rounded-lg bg-white border border-gray-200 focus:border-black focus:ring-0 transition outline-none" placeholder="email@contoh.com">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Ceritakan Project Anda</label>
                <textarea name="message" rows="5" required class="w-full px-4 py-3 rounded-lg bg-white border border-gray-200 focus:border-black focus:ring-0 transition outline-none" placeholder="Saya ingin membuat website..."></textarea>
            </div>

            <button type="submit" class="w-full bg-black text-white font-bold py-4 rounded-lg hover:bg-gray-800 transition transform hover:-translate-y-1">
                Kirim Pesan &rarr;
            </button>
        </form>
    </div>

</body>
</html>