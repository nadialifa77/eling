@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto mt-6 px-4 md:px-0">

        {{-- ALERT --}}
        @error('judul')
            <div id="alertError" class="bg-red-100 text-red-600 px-4 py-3 rounded-xl mb-4 transition-opacity duration-500">
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
        <div x-data="{ info: false }" id="roadmap" class="relative bg-gray-200 rounded-2xl p-6 shadow">

            {{-- HEADER --}}
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold">🎯 Spill The Tea</h2>
        
                <button
                    type="button"
                    @click="info = !info"
                    class="w-8 h-8 rounded-full bg-blue-900 text-white font-bold hover:bg-blue-600 transition">
                    i
                </button>
            </div>
        
            {{-- popup info --}}
            <div
                x-show="info"
                @click.away="info = false"
                x-transition
                class="absolute top-16 right-6 w-72 bg-gray-800 text-white text-sm p-4 rounded-xl shadow-lg z-50">
                Fitur untuk menuliskan langkah dan proses menuju tujuan yang ingin dicapai.
                Kamu bisa melihat progres diri dengan lebih jelas dan terarah.
            </div>
        
            {{-- PETUNJUK --}}
            <div class="text-sm text-gray-700 mb-5">
                <p class="mb-2 font-medium">
                    Bagian ini kamu bisa mulai isi dengan:
                </p>
        
                <ol class="list-decimal ml-5 space-y-1">
                    <li>Apa tujuan yang sedang kamu kejar sekarang?</li>
                    <li>Kamu boleh menuliskan tujuan yang kecil atau yang besar ya best.</li>
                </ol>
        
                <p class="mt-2 text-gray-600 italic">
                    Tulis maksimal 30 kata.
                </p>
            </div>
        
            <form action="{{ route('tujuan.store') }}" method="POST">
                @csrf
        
                <textarea
                    name="judul"
                    class="w-full h-24 rounded-xl p-4 border border-gray-300 focus:ring-2 focus:ring-yellow-400 mb-4"
                    placeholder="Tulis tujuan kamu..."
                ></textarea>
        
                <button
                    class="w-full bg-yellow-500 py-3 rounded-xl font-semibold hover:bg-yellow-600 transition">
                    Tambah Tujuan
                </button>
            </form>
        </div>

        {{-- ================= ROADMAP ================= --}}
        <div class="bg-gray-200 rounded-2xl p-6 shadow">

            <h2 class="text-lg font-bold mb-2">🪄 Roadmap</h2>

            <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                Ini adalah ruang perjalananmu 🌿<br>
                Catat tujuanmu, pecah menjadi langkah-langkah kecil, lalu rayakan setiap progresnya ✨
            </p>

            <div class="space-y-4">

                @if ($tujuans->isEmpty())
                    <div class="bg-white rounded-xl p-8 text-center border-2 border-dashed border-gray-300">
                        <div class="text-5xl mb-3">🗺️</div>

                        <h3 class="text-lg font-semibold text-gray-700 mb-2">
                            Kamu belum bercerita
                        </h3>

                        <p class="text-gray-500 text-sm">
                            Yuk, tuliskan cerita kamu di atas, 
                            lalu kenangan kamu akan muncul di sini layaknya sebuah lini masa dalam berproses menjadi lebih baik.
                        </p>
                    </div>
                @else
                @foreach ($tujuans as $tujuan)
                @php
                    $total = $tujuan->subTujuans->count();
                    $done = $tujuan->subTujuans->where('is_done', true)->count();
                    $percent = $total > 0 ? round(($done / $total) * 100) : 0;
                @endphp
            
                <div x-data="{ open: true }" class="bg-white rounded-2xl p-4 md:p-5 shadow-sm">
            
                    {{-- JUDUL --}}
                    <div class="flex justify-between items-start gap-3 mb-3">
                        <h3 class="font-semibold text-sm md:text-base break-words flex-1">
                            {{ $tujuan->judul }}
                        </h3>
                        <span class="text-sm shrink-0">{{ $percent }}%</span>
                    </div>
            
                    {{-- PROGRESS --}}
                    <div class="w-full h-2 bg-gray-200 rounded-full mb-4">
                        <div class="h-2 bg-yellow-500 rounded-full"
                            style="width: {{ $percent }}%">
                        </div>
                    </div>
            
                    {{-- BUTTON --}}
                    <div class="space-y-2 mb-4">
            
                        {{-- toggle --}}
                        <button
                            @click="open = !open"
                            class="w-full bg-yellow-400 py-3 rounded-xl font-semibold text-sm">
                            <span x-show="!open">Lihat Rencana</span>
                            <span x-show="open">Sembunyikan Rencana</span>
                        </button>
            
                        {{-- tambah sub --}}
                        <form action="{{ route('sub.store') }}"
                            method="POST"
                            class="flex flex-col sm:flex-row gap-2">
                            @csrf
                            <input type="hidden"
                                name="tujuan_id"
                                value="{{ $tujuan->id }}">
            
                            <input
                                type="text"
                                name="judul"
                                placeholder="Sub tujuan"
                                class="flex-1 px-3 py-3 rounded-xl border text-sm"
                                required>
            
                            <button
                                class="bg-yellow-300 px-4 py-3 rounded-xl text-sm font-medium">
                                Tambah
                            </button>
                        </form>
            
                        {{-- hapus --}}
                        <form action="{{ route('tujuan.delete', $tujuan->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
            
                            <button
                                class="w-full bg-red-500 text-white py-3 rounded-xl text-sm font-medium">
                                Hapus
                            </button>
                        </form>
                    </div>
            
                    {{-- SUB TUJUAN --}}
                    <div x-show="open" x-transition class="space-y-3">
            
                        @foreach ($tujuan->subTujuans as $sub)
                        <div class="flex items-start gap-3 w-full overflow-hidden">
            
                                {{-- checklist --}}
                                <form action="{{ route('sub.toggle', $sub->id) }}"
                                    method="POST"
                                    class="flex-1">
                                    @csrf
            
                                    <label class="flex items-start gap-3 cursor-pointer">
            
                                        <input
                                            type="checkbox"
                                            onchange="this.form.submit()"
                                            class="mt-1 shrink-0"
                                            {{ $sub->is_done ? 'checked' : '' }}>
            
                                            <span class="text-sm flex-1 break-all leading-relaxed pr-2
                                            {{ $sub->is_done ? 'line-through text-gray-400' : '' }}">
                                            {{ $sub->judul }}
                                        </span>
                                    </label>
                                </form>
            
                                {{-- delete --}}
                                <form action="{{ route('sub.delete', $sub->id) }}"
                                    method="POST"
                                    class="shrink-0">
                                    @csrf
                                    @method('DELETE')
            
                                    <button
                                        class="text-gray-400 hover:text-red-500 text-lg">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        @endforeach
            
                    </div>
                </div>
            @endforeach
                @endif
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
