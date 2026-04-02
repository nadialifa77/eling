@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto mt-6 px-4 md:px-0">

    {{-- ALERT --}}
    @error('judul')
        <div id="alertError"
            class="bg-red-100 text-red-600 px-4 py-3 rounded-xl mb-4 transition-opacity duration-500">
            {{ $message }}
        </div>
    @enderror

    @if (session('success'))
        <div id="alertSuccess"
            class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-4 transition-opacity duration-500">
            {{ session('success') }}
        </div>
    @endif

</div>

<div class="max-w-5xl mx-auto mt-6 mb-20 space-y-8 px-4 md:px-0">

    {{-- ================= INPUT TUJUAN ================= --}}
    <div class="bg-gray-200 rounded-2xl p-6 shadow">

        <h2 class="text-lg font-bold mb-2">🎯 Spill The Tea</h2>

        <ol class="text-sm mb-4 ml-4 list-decimal">
            <li>Apa tujuan yang sedang kamu kejar sekarang?</li>
            <li>Boleh tujuan kecil atau besar</li>
        </ol>

        <form action="{{ route('tujuan.store') }}" method="POST">
            @csrf

            <textarea name="judul"
                class="w-full h-24 rounded-xl p-4 border mb-4"
                placeholder="Tulis tujuan kamu..."></textarea>

            <button class="w-full bg-yellow-500 py-3 rounded-xl font-semibold hover:bg-yellow-600 transition">
                Tambah Tujuan
            </button>
        </form>
    </div>

    {{-- ================= ROADMAP ================= --}}
    <div class="bg-gray-200 rounded-2xl p-6 shadow">

        <h2 class="text-lg font-bold mb-4">🪄 Roadmap</h2>

        <div class="space-y-4">

            @foreach ($tujuans as $tujuan)

                @php
                    $total = $tujuan->subTujuans->count();
                    $done = $tujuan->subTujuans->where('is_done', true)->count();
                    $percent = $total > 0 ? round(($done / $total) * 100) : 0;
                @endphp

                {{-- CARD --}}
                <div x-data="{ open: true }" class="bg-white rounded-xl p-4">

                    {{-- JUDUL --}}
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-semibold uppercase text-sm md:text-base">
                            {{ $tujuan->judul }}
                        </h3>
                        <span class="text-sm">{{ $percent }}%</span>
                    </div>

                    {{-- PROGRESS --}}
                    <div class="w-full h-2 bg-gray-200 rounded-full mb-3">
                        <div class="h-2 bg-yellow-500 rounded-full"
                            style="width: {{ $percent }}%"></div>
                    </div>

                    {{-- BUTTON AREA --}}
                    <div class="flex flex-col md:flex-row gap-2 mb-3">

                        {{-- TOGGLE --}}
                        <button 
                            @click="open = !open"
                            class="w-full md:flex-1 bg-yellow-400 py-2 rounded-xl font-semibold"
                        >
                            <span x-show="!open">Lihat Rencana</span>
                            <span x-show="open">Sembunyikan Rencana</span>
                        </button>

                        {{-- TAMBAH SUB --}}
                        <form action="{{ route('sub.store') }}" method="POST"
                            class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                            @csrf
                            <input type="hidden" name="tujuan_id" value="{{ $tujuan->id }}">

                            <input type="text" name="judul"
                                placeholder="Sub tujuan"
                                class="px-3 py-2 rounded border w-full">

                            <button
                                class="bg-yellow-300 px-3 py-2 rounded w-full md:w-auto">
                                Tambah
                            </button>
                        </form>

                        {{-- HAPUS --}}
                        <form action="{{ route('tujuan.delete', $tujuan->id) }}" method="POST" class="w-full md:w-auto">
                            @csrf
                            @method('DELETE')
                            <button
                                class="bg-red-500 text-white px-3 py-2 rounded w-full md:w-auto">
                                Hapus
                            </button>
                        </form>

                    </div>

                    {{-- SUB TUJUAN --}}
                    <div x-show="open" x-transition class="space-y-2">

                        @foreach ($tujuan->subTujuans as $sub)

                        <div class="flex justify-between items-center gap-2">

                            {{-- KIRI --}}
                            <form action="{{ route('sub.toggle', $sub->id) }}" method="POST" class="flex-1">
                                @csrf
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox"
                                        onchange="this.form.submit()"
                                        {{ $sub->is_done ? 'checked' : '' }}>
                        
                                    <span class="truncate {{ $sub->is_done ? 'line-through text-gray-400' : '' }}">
                                        {{ $sub->judul }}
                                    </span>
                                </label>
                            </form>
                        
                            {{-- KANAN --}}
                            <form action="{{ route('sub.delete', $sub->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-gray-400 hover:text-red-500 text-lg">
                                    🗑️
                                </button>
                            </form>
                        
                        </div>

                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

{{-- AUTO HIDE ALERT --}}
<script>
    setTimeout(() => {
        const error = document.getElementById('alertError');
        const success = document.getElementById('alertSuccess');

        if (error) {
            error.style.opacity = '0';
            setTimeout(() => error.remove(), 500);
        }

        if (success) {
            success.style.opacity = '0';
            setTimeout(() => success.remove(), 500);
        }
    }, 3000);
</script>

@endsection