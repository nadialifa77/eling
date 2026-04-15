@extends('layouts.app')

@section('title', 'Pengembang')

@section('content')

<div class="h-[calc(100vh-80px)] flex flex-col justify-between px-6 py-6 overflow-hidden">

    {{-- JUDUL --}}
    <h1 class="text-3xl md:text-4xl font-bold text-center text-yellow-400 mb-10">
        Pengembang Aplikasi Eling
    </h1>

    {{-- DATA --}}
    @php
        $developers = [
            [
                'nama' => 'Dr. Ribut Purwaningrum, M. Pd. ',
                'foto' => asset('images/dosen.jpg'),
            ],
            [
                'nama' => 'Davin Maulana Viananda',
                'foto' => asset('images/dapin.jpg'),
            ],
            
            [
                'nama' => 'Nadia Alifa',
                'foto' => asset('images/nadia.jpeg'),
            ],
        ];
    @endphp

    {{-- GRID --}}
    <div class="flex-1 flex items-start">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 max-w-6xl mx-auto w-full">

            @foreach ($developers as $dev)
            <div class="bg-[#E9D89C] rounded-2xl p-4 shadow-lg 
                        flex flex-col items-center 
                        hover:scale-105 transition duration-300">

                <div class="bg-[#F3E6B3] rounded-xl p-2 w-full">
                    <img src="{{ $dev['foto'] }}"
                         class="rounded-lg w-full h-72 object-cover">
                </div>

                <p class="mt-3 font-semibold text-black text-lg text-center">
                    {{ $dev['nama'] }}
                </p>

            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection