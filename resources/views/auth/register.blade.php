<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Registrasi</title>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>

    <div class="min-h-screen flex items-center justify-center 
    bg-gradient-to-br from-[#220048] to-[#342967] px-6">

        <div class="grid md:grid-cols-2 gap-10 w-full max-w-6xl">

            {{-- ================= LEFT ================= --}}
            <div class="hidden md:flex flex-col justify-center text-white">
                <h1 class="text-4xl font-bold mb-4 leading-tight">
                    Mulai Perjalananmu di <br>
                    <span class="text-yellow-400">Eling</span>
                </h1>

                <p class="text-sm leading-relaxed mb-6 max-w-md">
                    Buat akun dan mulai menuliskan pengalaman, mengelola tujuan,
                    serta menemukan <i>purpose in life</i> kamu.
                </p>

                <img src="{{ asset('images/girl.png') }}" class="w-72">
            </div>

            {{-- ================= RIGHT ================= --}}
            <div class="bg-[#342967] text-white rounded-3xl shadow-2xl p-8 w-full">

                <div class="flex items-center justify-between mb-6">
    
                    {{-- 🔙 BACK BUTTON --}}
                    <a href="/"
                        class="w-11 h-11 flex items-center justify-center 
                        rounded-full bg-white/20 backdrop-blur-md 
                        text-white hover:bg-yellow-400 hover:text-black 
                        transition duration-200 shadow-lg">
                
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                
                    {{-- TITLE --}}
                    <h2 class="text-2xl font-bold text-center flex-1">
                        Buat Akun
                    </h2>
                
                    {{-- SPACER biar tengahnya bener-bener center --}}
                    <div class="w-11"></div>
                
                </div>  

                <form method="POST" action="{{ route('register') }}" class="space-y-4 novalidate">
                    @csrf

                    {{-- NAME --}}
                    <div>
                        <label class="text-sm">Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full mt-1 px-4 py-2 rounded-lg 
                               bg-[#220048] border border-transparent 
                               focus:border-yellow-400 focus:ring-0 text-white"
                            required autofocus>

                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label class="text-sm">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full mt-1 px-4 py-2 rounded-lg 
                               bg-[#220048] border border-transparent 
                               focus:border-yellow-400 focus:ring-0 text-white"
                            required>

                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                    </div>

                    {{-- PASSWORD --}}
                    <div x-data="{ show: false }">
                        <label class="text-sm">Password</label>

                        <div class="relative mt-1">
                            <input :type="show ? 'text' : 'password'" name="password"
                                class="w-full px-4 py-2 pr-10 rounded-lg 
                   bg-[#220048] border border-transparent 
                   focus:border-yellow-400 focus:ring-0 text-white"
                                required>

                            {{-- ICON --}}
                            <button type="button" @click="show = !show"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-300 hover:text-yellow-400">

                                {{-- EYE OPEN --}}
                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                       c4.477 0 8.268 2.943 9.542 7
                       -1.274 4.057-5.065 7-9.542 7
                       -4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                                {{-- EYE CLOSED --}}
                                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                       c-4.478 0-8.268-2.943-9.543-7
                       a9.97 9.97 0 012.223-3.592M6.223 6.223A9.956 9.956 0 0112 5
                       c4.478 0 8.268 2.943 9.543 7
                       a9.97 9.97 0 01-4.293 5.293M15 12a3 3 0 00-4.243-4.243
                       M9.88 9.88A3 3 0 0012 15a3 3 0 002.12-.88
                       M3 3l18 18" />
                                </svg>
                            </button>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                    </div>

                    {{-- CONFIRM PASSWORD --}}
                    <div x-data="{ showConfirm: false }">
                        <label class="text-sm">Konfirmasi Password</label>

                        <div class="relative mt-1">
                            <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation"
                                class="w-full px-4 py-2 pr-10 rounded-lg 
                   bg-[#220048] border border-transparent 
                   focus:border-yellow-400 focus:ring-0 text-white"
                                required>

                            {{-- ICON --}}
                            <button type="button" @click="showConfirm = !showConfirm"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-300 hover:text-yellow-400">

                                {{-- EYE OPEN --}}
                                <svg x-show="!showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                       c4.477 0 8.268 2.943 9.542 7
                       -1.274 4.057-5.065 7-9.542 7
                       -4.477 0-8.268-2.943-9.542-7z" />
                                </svg>

                                {{-- EYE CLOSED --}}
                                <svg x-show="showConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                       c-4.478 0-8.268-2.943-9.543-7
                       a9.97 9.97 0 012.223-3.592M6.223 6.223A9.956 9.956 0 0112 5
                       c4.478 0 8.268 2.943 9.543 7
                       a9.97 9.97 0 01-4.293 5.293M15 12a3 3 0 00-4.243-4.243
                       M9.88 9.88A3 3 0 0012 15a3 3 0 002.12-.88
                       M3 3l18 18" />
                                </svg>
                            </button>
                        </div>

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
                    </div>
                    
                    @if ($errors->any())
                    <div x-data="{ show: true }"
                         x-show="show"
                         x-init="setTimeout(() => show = false, 3000)"
                         x-transition
                         class="mb-4 p-3 bg-red-500 text-white rounded-lg text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif
                    {{-- BUTTON --}}
                    <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 
                           text-black font-semibold py-2 rounded-lg transition">
                        Daftar
                    </button>

                    {{-- LOGIN LINK --}}
                    <p class="text-center text-sm mt-4">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-yellow-400 hover:underline">
                            Masuk di sini
                        </a>
                    </p>

                </form>
            </div>

        </div>
    </div>

</body>

</html>
