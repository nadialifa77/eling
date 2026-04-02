@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-6">

    {{-- VALIDASI --}}
    @if($errors->has('custom'))
        <div id="alertError"
            class="bg-red-100 text-red-600 px-4 py-3 rounded-xl mb-4 transition-opacity duration-500">
            {{ $errors->first('custom') }}
        </div>
    @endif

        {{-- SUCCESS --}}
    @if(session('success'))
    <div id="alertSuccess"
        class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-4 transition-opacity duration-500">
        {{ session('success') }}
    </div>
@endif

    </div>

    <div class="max-w-4xl mx-auto bg-gray-200 rounded-2xl p-8 shadow">
        {{-- ================= JUDUL ================= --}}
        <h1 class="text-xl font-bold mb-2 flex items-center gap-2">
            ✨ Versi Terbaikku Nanti
        </h1>

        {{-- QUOTE --}}
        <p class="text-sm italic text-gray-700 text-center mb-6">
            “Setiap orang punya masa depan yang ingin dituju. Kamu tidak harus langsung tahu semuanya,
            cukup mulai membayangkannya. Visi bukan tentang sempurna, tetapi tentang arah.”
        </p>

        {{-- ================= HARAPAN ================= --}}
        <p class="font-semibold text-sm mb-1">
            Tuliskan harapan untuk dirimu di masa depan dengan awalan kalimat dibawah ini,
        </p>

        <p class="text-sm mb-3">
            Aku ingin tumbuh menjadi pribadi yang ....................
        </p>

        <form action="{{ route('versi.store') }}" method="POST">
            @csrf

            {{-- TEXTAREA HARAPAN --}}
            <textarea name="harapan" class="w-full h-32 p-4 rounded-xl bg-white border-none focus:ring-2 focus:ring-purple-400 mb-8"
                placeholder=""></textarea>

            {{-- ================= PESAN ================= --}}
            <h2 class="text-lg font-bold flex items-center gap-2 mb-2">
                🕊️ Untukku di Masa Depan
            </h2>

            <p class="text-sm font-semibold mb-2">
                Tuliskan pesan untuk dirimu di masa depan dengan bantuan beberapa pertanyaan di bawah ini,
            </p>

            <ul class="text-sm list-disc ml-5 mb-4 space-y-1">
                <li>Hal baik apa yang ingin tetap ada dalam hidupku di masa depan?</li>
                <li>Jika aku bertemu diriku di masa depan, apa yang ingin kutanyakan?</li>
                <li>Apa harapan kecilku untuk masa depanku?</li>
                <li>Apa pesan sederhana untuk diriku di masa depan?</li>
            </ul>

            {{-- TEXTAREA PESAN --}}
            <textarea name="pesan" class="w-full h-40 p-4 rounded-xl bg-white border-none focus:ring-2 focus:ring-purple-400 mb-6"
                placeholder=""></textarea>

            {{-- BUTTON --}}
            <button type="submit"
                class="w-full bg-yellow-500 py-3 rounded-xl font-semibold hover:bg-yellow-600 transition">
                Simpan
            </button>

        </form>

    </div>

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
        }, 3000); // hilang setelah 3 detik
    </script>
@endsection
