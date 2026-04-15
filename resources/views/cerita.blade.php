@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto mt-6">

        {{-- ERROR --}}
        @if ($errors->has('custom'))
            <div id="alertError" class="bg-red-100 text-red-600 px-4 py-3 rounded-xl mb-4 transition-opacity duration-500">
                {{ $errors->first('custom') }}
            </div>
        @endif

        {{-- SUCCESS --}}
        @if (session('success'))
            <div id="alertSuccess"
                class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-4 transition-opacity duration-500">
                {{ session('success') }}
            </div>
        @endif

    </div>

    <div class="max-w-5xl mx-auto mt-6 mb-20 space-y-8">

        {{-- ================= CERITA ================= --}}
        <div class="bg-gray-200 rounded-2xl p-6 shadow">

            <form action="{{ route('cerita.store') }}" method="POST">
                @csrf

                <h2 class="text-lg font-bold mb-2">
                    ✨ Cerita di Balik Tujuanku
                </h2>

                <p class="text-sm mb-4">
                    Coba cek perasaanmu hari ini. Kamu lagi merasa apa?
                </p>

                {{-- INPUT MOOD --}}
                <input type="hidden" name="mood" id="mood">

                {{-- EMOJI (POSISI DI ATAS ✔️) --}}
                <div class="bg-white rounded-xl p-4 flex gap-4 w-fit mb-4">
                    <span onclick="setMood(this, '😭')" class="emoji text-3xl cursor-pointer">😭</span>
                    <span onclick="setMood(this, '😨')" class="emoji text-3xl cursor-pointer">😨</span>
                    <span onclick="setMood(this, '😄')" class="emoji text-3xl cursor-pointer">😄</span>
                    <span onclick="setMood(this, '🥰')" class="emoji text-3xl cursor-pointer">🥰</span>
                    <span onclick="setMood(this, '😡')" class="emoji text-3xl cursor-pointer">😡</span>
                </div>

                {{-- PREVIEW --}}
                <div id="selectedMood" class="mb-4 text-2xl"></div>

                {{-- PERTANYAAN --}}
                <p class="text-sm mb-2 font-semibold">
                    Jika kamu kesulitan dalam bercerita, kamu bisa gunakan beberapa pertanyaan dibawah ini:
                </p>

                <ol class="text-sm list-decimal ml-5 mb-4 space-y-1">
                    <li>Hari ini, pengalaman apa yang kamu mau ceritakan?</li>
                    <li>Apa yang kamu pelajari dari hari ini?</li>
                    <li>Perasaan apa yang paling sering muncul?</li>
                    <li>Apa tantangan yang kamu hadapi?</li>
                    <li>Apa hal kecil yang berhasil kamu lakukan?</li>
                    <li>Apa yang kamu syukuri hari ini?</li>
                    <li>Apakah ada pertanyaan dalam hatimu yang ingin kamu jawab hari ini? Atau mungkin ada hal lain yang ingin kamu ceritakan.</li>
                </ol>

                {{-- TEXTAREA --}}
                <textarea name="isi" class="w-full h-32 p-4 rounded-xl border mb-4" placeholder="Tulis ceritamu..." ></textarea>

                {{-- BUTTON --}}
                <button class="w-full bg-yellow-500 py-3 rounded-xl font-semibold">
                    Simpan
                </button>

            </form>

        </div>

        {{-- ================= LINI MASA ================= --}}
        <div class="bg-gray-200 rounded-2xl p-6 shadow">

            {{-- HEADER --}}
            <div class="flex items-center gap-2 mb-4">
                <span class="text-2xl">📙</span>
                <h2 class="font-semibold text-lg">Lini Masa</h2>
            </div>

            {{-- ISI --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                @forelse ($ceritas as $item)
                    <div class="bg-white rounded-xl p-4 flex justify-between items-start">

                        <div>
                            <div class="text-xl mb-1">{{ $item->mood }}</div>
                            <p class="text-sm">{{ $item->isi }}</p>
                            <p class="text-xs text-gray-400 mt-2">
                                {{ $item->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                            </p>
                        </div>

                        <form action="{{ route('cerita.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="text-gray-400 hover:text-red-500">
                                🗑️
                            </button>
                        </form>

                    </div>
                @empty
                    <p class="text-sm text-gray-500">Belum ada cerita...</p>
                @endforelse

            </div>

        </div>

    </div>
@endsection

<script>
    function setMood(el, emoji) {
        // simpan ke input
        document.getElementById('mood').value = emoji;

        // tampilkan preview
        document.getElementById('selectedMood').innerText = "Mood dipilih: " + emoji;

        // reset semua emoji
        document.querySelectorAll('.emoji').forEach(e => {
            e.classList.remove('scale-125', 'ring-2', 'ring-yellow-400');
        });

        // highlight yang dipilih
        el.classList.add('scale-125', 'ring-2', 'ring-yellow-400');
    }

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
