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
        <div x-data="{ info: false }" class="relative bg-gray-200 rounded-2xl p-6 shadow">

            <form action="{{ route('cerita.store') }}" method="POST">
                @csrf

                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-lg font-bold">
                        ✨ Cerita di Balik Tujuanku
                    </h2>

                    {{-- tombol info --}}
                    <button type="button" @click="info = !info"
                        class="w-8 h-8 rounded-full bg-blue-900 text-white font-bold hover:bg-blue-600 transition">
                        i
                    </button>
                </div>

                {{-- popup info --}}
                <div x-show="info" @click.away="info = false" x-transition
                    class="absolute top-16 right-6 w-72 bg-gray-800 text-white text-sm p-4 rounded-xl shadow-lg z-50">
                    Fitur untuk memahami perasaan, pengalaman, dan proses diri setiap hari. 
                    Kamu bisa lebih sadar dengan apa yang sedang dirasakan dan dialami, bukan sekadar mencatat kegiatan.
                </div>

                <p class="text-sm mb-4">
                    Coba cek perasaanmu hari ini. Kamu lagi merasa apa?
                </p>

                {{-- INPUT MOOD --}}
                <input type="hidden" name="mood" id="mood" value="{{ old('mood') }}">

                {{-- EMOJI (POSISI DI ATAS ✔️) --}}
                <div class="bg-white rounded-xl p-4 flex gap-4 w-fit mb-4">
                    <span onclick="setMood(this, '😭')"
                        class="emoji text-3xl cursor-pointer {{ old('mood') == '😭' ? 'scale-125 ring-2 ring-yellow-400' : '' }}">
                        😭
                    </span>
                
                    <span onclick="setMood(this, '😨')"
                        class="emoji text-3xl cursor-pointer {{ old('mood') == '😨' ? 'scale-125 ring-2 ring-yellow-400' : '' }}">
                        😨
                    </span>
                
                    <span onclick="setMood(this, '😐')"
                        class="emoji text-3xl cursor-pointer {{ old('mood') == '😐' ? 'scale-125 ring-2 ring-yellow-400' : '' }}">
                        😐
                    </span>
                
                    <span onclick="setMood(this, '😄')"
                        class="emoji text-3xl cursor-pointer {{ old('mood') == '😄' ? 'scale-125 ring-2 ring-yellow-400' : '' }}">
                        😄
                    </span>
                
                    <span onclick="setMood(this, '😡')"
                        class="emoji text-3xl cursor-pointer {{ old('mood') == '😡' ? 'scale-125 ring-2 ring-yellow-400' : '' }}">
                        😡
                    </span>
                </div>

                {{-- PREVIEW --}}
                <div id="selectedMood" class="mb-4 text-xl">
                    @if(old('mood'))
                        Mood dipilih: {{ old('mood') }} Terima kasih sudah jujur atas perasaanmu🫰🏻
                    @endif
                </div>

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
                    <li>Apakah ada pertanyaan dalam hatimu yang ingin kamu jawab hari ini? Atau mungkin ada hal lain yang
                        ingin kamu ceritakan.</li>
                </ol>

                {{-- TEXTAREA --}}
                <textarea name="isi" class="w-full h-32 p-4 rounded-xl border mb-4" placeholder="Tulis ceritamu..." >{{ old('isi') }}</textarea>

                {{-- BUTTON --}}
                <button class="w-full bg-yellow-500 py-3 rounded-xl font-semibold">
                    Simpan
                </button>

            </form>

        </div>

        {{-- ================= LINI MASA ================= --}}
        <div class="bg-gray-200 rounded-2xl p-6 shadow">

            {{-- HEADER --}}
            <div class="flex items-center gap-2 mb-2">
                <span class="text-2xl">📙</span>
                <h2 class="font-semibold text-lg">Lini Masa</h2>
            </div>

            <p class="text-sm text-gray-600 mb-4 leading-relaxed">
                Ini adalah ruang cerita hidupmu 🌱<br>
                Tuangkan cerita, perasaan, dan pengalamanmu tanpa takut dihakimi, lalu temukan makna dari setiap perjalananmu ✨
            </p>

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
                    <div class="bg-white rounded-xl p-8 text-center border-2 border-dashed border-gray-300 md:col-span-2">
                        <div class="text-5xl mb-3">📖</div>

                        <h3 class="text-lg font-semibold text-gray-700 mb-2">
                            Lini Masa kamu masih kosong
                        </h3>

                        <p class="text-gray-500 text-sm">
                            Yuk mulai tulis cerita pertamamu hari ini,
                            supaya perjalanan dan perasaanmu bisa terekam di sini ✨
                        </p>
                    </div>
                @endforelse

            </div>

        </div>

    </div>
    </div>

    <script>
        function setMood(el, emoji) {
            document.getElementById('mood').value = emoji;

            document.getElementById('selectedMood').innerText =
                "Mood dipilih: " + emoji + " Terima kasih sudah jujur atas perasaanmu🫰🏻";

            document.querySelectorAll('.emoji').forEach(e => {
                e.classList.remove('scale-125', 'ring-2', 'ring-yellow-400');
            });

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
@endsection
