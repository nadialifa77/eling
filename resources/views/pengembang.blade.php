@extends('layouts.app')

@section('title', 'Pengembang | Eling')

@section('content')

<div class="min-h-screen py-10 px-6">

    {{-- JUDUL --}}
    <h1 class="text-3xl md:text-4xl font-bold text-center text-yellow-400 mb-12">
        Pengembang Aplikasi Eling
    </h1>

    {{-- GRID CARD --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 max-w-6xl mx-auto">

        {{-- CARD --}}
        @for ($i = 0; $i < 3; $i++)
        <div class="bg-[#E9D89C] rounded-2xl p-4 shadow-lg 
                    flex flex-col items-center 
                    hover:scale-105 transition duration-300">

            {{-- GAMBAR --}}
            <div class="bg-[#F3E6B3] rounded-xl p-2 w-full">
                <img src="https://via.placeholder.com/300x200"
                     class="rounded-lg w-full h-48 object-cover">
            </div>

            {{-- NAMA --}}
            <p class="mt-4 font-semibold text-black">
                Pengembang
            </p>
        </div>
        @endfor

    </div>

</div>

@endsection