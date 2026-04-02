<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>@yield('title', 'Eling')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#220048] flex flex-col min-h-screen text-black">

    {{-- ================= HEADER ================= --}}
    <header x-data="{ open: false }" class="fixed top-0 left-0 w-full bg-[#342967] shadow z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    
            {{-- LOGO --}}
            <div class="w-20">
                <img src="{{ asset('images/logo-eling.png') }}" class="w-full">
            </div>
    
            {{-- ================= KALAU SUDAH LOGIN ================= --}}
            @auth
    
            {{-- HAMBURGER --}}
            <button @click="open = !open" class="md:hidden text-white text-2xl">
                ☰
            </button>
    
            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex items-center gap-4 ml-auto">
                <a href="{{ route('dashboard') }}" class="nav-item">🏠 Dashboard</a>
                <a href="{{ route('tujuan') }}" class="nav-item">🎯 Arah yang Kupilih</a>
                <a href="{{ route('cerita') }}" class="nav-item">✨ Cerita Tujuanku</a>
                <a href="{{ route('versi') }}" class="nav-item">🏆 Versi Terbaikku</a>
                <a href="{{ route('jejak') }}" class="nav-item">📊 Jejak Langkahku</a>
    
                {{-- PROFILE --}}
                <div x-data="{ profile: false }" class="relative">
                    <button @click="profile = !profile"
                        class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                        👤
                    </button>
    
                    <div x-show="profile" @click.away="profile = false"
                        class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-lg p-2">
    
                        <a href="{{ route('profile.show') }}"
                            class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-lg">
                            Profil
                        </a>
    
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 rounded-lg">
                                Logout
                            </button>
                        </form>
    
                    </div>
                </div>
            </div>
    
            @endauth
    
            {{-- ================= KALAU BELUM LOGIN ================= --}}
            @guest
            <a href="{{ route('login') }}"
                class="ml-auto bg-yellow-500 text-black px-5 py-2 rounded-xl font-semibold hover:bg-yellow-600 transition">
                Mulai
            </a>
            @endguest
    
        </div>
    
        {{-- ================= MOBILE MENU (LOGIN SAJA) ================= --}}
        @auth
        <div x-show="open" x-transition class="md:hidden bg-[#342967] px-6 pb-4 space-y-3">
    
            <a href="{{ route('dashboard') }}" class="mobile-nav">🏠 Dashboard</a>
            <a href="{{ route('tujuan') }}" class="mobile-nav">🎯 Arah yang Kupilih</a>
            <a href="{{ route('cerita') }}" class="mobile-nav">✨ Cerita Tujuanku</a>
            <a href="{{ route('versi') }}" class="mobile-nav">🏆 Versi Terbaikku</a>
            <a href="{{ route('jejak') }}" class="mobile-nav">📊 Jejak Langkahku</a>
    
            <hr class="border-gray-500">
    
            <a href="{{ route('profile.show') }}" class="mobile-nav">👤 Profil</a>
    
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mobile-nav w-full text-left">🚪 Logout</button>
            </form>
    
        </div>
        @endauth
    
    </header>

    {{-- ================= CONTENT ================= --}}
    <main class="flex-grow pt-28 pb-10 min-h-[80vh]">
        <div
            class="w-full 
            {{ View::hasSection('containerClass') ? trim($__env->yieldContent('containerClass')) : 'max-w-6xl mx-auto px-6' }}">

            @yield('content')

        </div>
    </main>


    {{-- ================= FOOTER ================= --}}
    <footer class="w-full bg-[#342967] text-white py-6 mt-auto">
        <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">

            @auth
                <a href="{{ route('pengembang') }}"
                    class="bg-black text-white px-6 py-2 text-sm hover:bg-gray-800 transition">
                    <span class="font-semibold text-sm">Informasi Pengembang</span>
                </a>
            @endauth

            <div class="text-center mt-4 md:mt-0 md:ml-auto">
                <p class="font-semibold">Contact Us :</p>
                <p class="text-sm">elingwithpurpose@gmail.com</p>
            </div>

        </div>
    </footer>

</body>

</html>
