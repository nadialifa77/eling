<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Login - Eling</title>
</head>

<body>

<div class="min-h-screen flex items-center justify-center 
    bg-gradient-to-br from-[#220048] to-[#342967] px-6">

    <div class="grid md:grid-cols-2 gap-10 w-full max-w-6xl">

        {{-- ================= LEFT ================= --}}
        <div class="hidden md:flex flex-col justify-center text-white">
            <h1 class="text-4xl font-bold mb-4 leading-tight">
                Selamat Datang di <br>
                <span class="text-yellow-400">Eling</span>
            </h1>

            <p class="text-sm leading-relaxed mb-6 max-w-md">
                Platform digital journaling untuk membantu kamu menemukan 
                <i>purpose in life</i>, mengelola tujuan, dan memahami perjalanan hidupmu.
            </p>

            <img src="{{ asset('images/girl.png') }}" class="w-72">
        </div>

        {{-- ================= RIGHT ================= --}}
        <div class="bg-[#342967] text-white rounded-3xl shadow-2xl p-8 w-full">

            <h2 class="text-2xl font-bold mb-6 text-center">
                Login Account
            </h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- EMAIL --}}
                <div>
                    <label class="text-sm">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="w-full mt-1 px-4 py-2 rounded-lg 
                               bg-[#220048] border border-transparent 
                               focus:border-yellow-400 focus:ring-0 text-white"
                        required autofocus>
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label class="text-sm">Password</label>
                    <input type="password" name="password"
                        class="w-full mt-1 px-4 py-2 rounded-lg 
                               bg-[#220048] border border-transparent 
                               focus:border-yellow-400 focus:ring-0 text-white"
                        required>
                </div>

                {{-- REMEMBER --}}
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember"
                            class="rounded bg-[#220048] border-gray-400 text-yellow-400">
                        Remember me
                    </label>

                    <a href="{{ route('password.request') }}" 
                       class="text-gray-300 hover:text-yellow-400">
                        Forgot Password?
                    </a>
                </div>

                {{-- BUTTON --}}
                <button type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-600 
                           text-black font-semibold py-2 rounded-lg transition">
                    Log in
                </button>

                {{-- REGISTER --}}
                <p class="text-center text-sm mt-4">
                    Belum punya akun?
                    <a href="{{ route('register') }}" 
                       class="text-yellow-400 hover:underline">
                        Daftar sekarang
                    </a>
                </p>

            </form>
        </div>

    </div>
</div>

</body>
</html>