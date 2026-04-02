<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Register - Eling</title>
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

            <h2 class="text-2xl font-bold mb-6 text-center">
                Register Account
            </h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- NAME --}}
                <div>
                    <label class="text-sm">Nama</label>
                    <input type="text" name="name"
                        value="{{ old('name') }}"
                        class="w-full mt-1 px-4 py-2 rounded-lg 
                               bg-[#220048] border border-transparent 
                               focus:border-yellow-400 focus:ring-0 text-white"
                        required autofocus>

                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="text-sm">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="w-full mt-1 px-4 py-2 rounded-lg 
                               bg-[#220048] border border-transparent 
                               focus:border-yellow-400 focus:ring-0 text-white"
                        required>

                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label class="text-sm">Password</label>
                    <input type="password" name="password"
                        class="w-full mt-1 px-4 py-2 rounded-lg 
                               bg-[#220048] border border-transparent 
                               focus:border-yellow-400 focus:ring-0 text-white"
                        required>

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                {{-- CONFIRM PASSWORD --}}
                <div>
                    <label class="text-sm">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full mt-1 px-4 py-2 rounded-lg 
                               bg-[#220048] border border-transparent 
                               focus:border-yellow-400 focus:ring-0 text-white"
                        required>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
                </div>

                {{-- BUTTON --}}
                <button type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-600 
                           text-black font-semibold py-2 rounded-lg transition">
                    Register
                </button>

                {{-- LOGIN LINK --}}
                <p class="text-center text-sm mt-4">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" 
                       class="text-yellow-400 hover:underline">
                        Login di sini
                    </a>
                </p>

            </form>
        </div>

    </div>
</div>

</body>
</html>