@extends('layouts.app')

@section('title', 'Eling')

@section('containerClass', 'w-full px-4 sm:px-6 lg:px-8')

@section('content')

    {{-- HERO FIX --}}
    <div class="relative">

        <div class="absolute inset-0"></div>

        <div class="relative max-w-6xl mx-auto px-6 py-10">

            <div class="bg-gray-200 rounded-3xl py-10 px-10 text-center shadow-md max-w-4xl mx-auto">

                <div class="text-3xl mb-3">
                    ⭐
                </div>

                <p class="italic text-xl mb-3">
                    "{{ $quote }}"
                </p>

                <p class="text-sm text-gray-600">
                    Kutipan Hari Ini
                </p>
            </div>
        </div>
    </div>


    {{-- PENGGUNAAN WEB --}}
    <div class="max-w-6xl mx-auto px-6 mb-12">

        <div class="bg-gray-200 rounded-3xl p-6 sm:p-10 shadow-sm 
            flex flex-col md:flex-row items-center gap-8">

            {{-- GAMBAR KIRI --}}
            <div class="w-40 sm:w-56 flex-shrink-0">
                <img src="{{ asset('images/logo.png') }}" alt="Penggunaan Web" class="w-full">
            </div>

            <div>
                <h3 class="font-semibold text-lg mb-4">
                    Penggunaan Web :
                </h3>

                <ol class="list-decimal ml-6 text-sm leading-relaxed space-y-2">
                    <li>
                        Penggunaan website eling dimulai dari membaca
                        <strong>“Apa itu Eling”</strong> yang ada di bawah ini.
                    </li>
                    <li>
                        Dilanjutkan dengan
                        <strong>“Apa itu <i>Purpose in Life?</i>”</strong>.
                    </li>
                    <li>
                        Selanjutnya, pengguna dapat menekan tombol
                        <strong>“BUKU PANDUAN”</strong> yang terdapat di bawah halaman awal website lalu membacanya terlebih
                        dahulu.
                    </li>
                    <li>
                        Setelah itu, pengguna bisa mendaftarkan akun lalu masuk agar dapat menggunakan website ini.
                    </li>
                </ol>
            </div>
        </div>

    </div>

    {{-- SECTION CARD 3 KOLOM --}}
    <div x-data="{ active: null }" class="max-w-6xl mx-auto px-6 mb-20">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

            {{-- CARD 1 --}}
            <div @click="active = active === 'eling' ? null : 'eling'"
                class="bg-gray-200 rounded-3xl p-6 shadow-sm 
                        flex flex-col items-center justify-center text-center
                        hover:shadow-md hover:-translate-y-1 transition duration-300 h-48 cursor-pointer">

                <div class="w-28 mb-4">
                    <img src="{{ asset('images/logo-eling.png') }}" class="w-full mx-auto">
                </div>

                <h3 class="font-semibold">
                    Apa itu Eling?
                </h3>
            </div>

            {{-- CARD 2 --}}
            <div @click="active = active === 'purpose' ? null : 'purpose'"
                class="bg-gray-200 rounded-3xl p-6 shadow-sm 
                    flex flex-col items-center justify-center text-center
                    hover:shadow-md hover:-translate-y-1 transition duration-300 h-48 cursor-pointer">

                <div class="w-28 mb-4">
                    <img src="{{ asset('images/icon.jpg') }}" alt="Purpose" class="w-full mx-auto">
                </div>

                <h3 class="font-semibold italic">
                    Purpose In Life ?
                </h3>
            </div>

            {{-- CARD 3 --}}
            <a href="https://drive.google.com/drive/folders/1TJy1s0T2XH5I4gC6ncpdD3Y5vz0Uduqz" target="_blank">
                <div
                    class="bg-gray-200 rounded-3xl p-6 shadow-sm 
                        flex flex-col items-center justify-center text-center
                        hover:shadow-md hover:scale-105 transition h-48 cursor-pointer">
            
                    <div class="w-28 mb-4">
                        <img src="{{ asset('images/book.png') }}" alt="Buku" class="w-full mx-auto">
                    </div>
            
                    <h3 class="font-semibold">
                        Buku Panduan
                    </h3>
                </div>
            </a>

        </div>

        {{-- 👇 SECTION DETAIL (GAMBAR 2) --}}
        <div x-show="active === 'eling'" x-transition class="mt-10 space-y-6">

            {{-- CARD ATAS --}}
            <div class="bg-gray-200 rounded-3xl p-8">

                <div class="flex flex-col md:flex-row gap-8 items-center">

                    {{-- GAMBAR --}}
                    <div class="w-60">
                        <img src="{{ asset('images/logo-eling.png') }}" class="w-full">
                    </div>

                    {{-- TEXT --}}
                    <div>
                        <h2 class="text-2xl font-bold mb-4">
                            Apa itu Eling?
                        </h2>

                        <p class="mb-4">
                            Eling adalah media <i>digital journaling</i> berbasis website yang
                            mengadaptasi konsep <i>bullet journaling</i> dengan tujuan untuk
                            memfasilitasi peserta didik dalam mengelola <i>purpose in life</i>.
                        </p>

                        <p>
                            Media ini diharapkan dapat membantu peserta didik menuliskan pengalaman,
                            mengelola tujuan, dan memaknai setiap pengalaman secara lebih terstruktur
                            dalam satu media yang terintegrasi.
                        </p>
                    </div>

                </div>
            </div>

            {{-- GRID BAWAH --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

                {{-- KIRI --}}
                <div class="space-y-6">

                    {{-- ELING BUAT APA --}}
                    <div class="bg-gray-200 rounded-3xl p-6">
                        <h3 class="font-semibold text-lg mb-3">
                            Eling Buat apa?
                        </h3>

                        <p class="text-sm leading-relaxed">
                            Eling dapat digunakan sebagai <i>self media</i> bagi peserta didik untuk membantu
                            menuliskan pengalaman, mengelola tujuan, dan memaknai setiap pengalaman yang ada.
                        </p>
                    </div>
                </div>

                {{-- KANAN --}}
                <div class="bg-gray-200 rounded-3xl p-6">
                    <h3 class="font-semibold text-lg mb-3">
                        Peran Guru BK
                    </h3>

                    <p class="mb-4 text-sm leading-relaxed">
                        Guru BK sebagai fasilitator yang mengenalkan dan memberikan arahan pada peserta didik tentang cara
                        penggunaan media.
                    </p>

                    <p class="text-sm leading-relaxed">
                        Guru BK bisa memberikan pendampingan pada peserta didik ketika mengalami kesulitan dalam proses
                        refleksi dan pengelolaan tujuan yang dicapai
                    </p>
                </div>

            </div>

        </div>

        {{-- 👇 SECTION PURPOSE IN LIFE --}}
        <div x-show="active === 'purpose'" x-transition class="mt-10 space-y-6">
            {{-- CARD 1 --}}
            <div class="bg-gray-200 rounded-3xl p-8">
                <div class="flex flex-col md:flex-row gap-8 items-center">

                    <div>
                        <h2 class="text-2xl font-bold mb-4">
                            Apa itu <i>Purpose in Life?</i>
                        </h2>

                        <p class="mb-3 text-sm leading-relaxed">
                            Pernahkah kamu bertanya pada diri sendiri:
                        </p>

                        <p class="italic text-sm mb-4">
                            "Apa yang ingin aku capai dalam hidup?" <br>
                            "Hal apa yang benar-benar penting bagiku?"
                        </p>

                        <p class="text-sm leading-relaxed">
                            <b>Nah, ternyata pertanyaan yang seperti itu berkaitan banget dengan <i>Purpose in Life.</i></b>
                            <br> Menurut Ryff, <i>Purpose in Life</i> adalah kemampuan
                            seseorang untuk menemukan tujuan, arah, dan makna
                            dalam hidupnya. Ketika seseorang memiliki purpose in
                            life, ia tidak hanya menjalani hidup begitu saja, tetapi
                            memiliki alasan untuk terus berkembang dan mencapai
                            sesuatu yang bermakna.
                        </p>
                    </div>

                    <div class="w-100">
                        <img src="{{ asset('images/girl.png') }}">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
                {{-- TANDA PURPOSE --}}
                <div class="bg-gray-200 rounded-3xl p-6">
                    <h3 class="font-semibold text-lg mb-3 text-center">
                        Tanda Kamu Mulai Memiliki <i>Purpose in Life</i>
                    </h3>

                    <ul class="text-sm space-y-4">

                        <li class="flex gap-3">
                            <span class="text-orange-500 text-xl">✔</span>
                            <div>
                                <b>Aku punya tujuan yang ingin dicapai</b><br>
                                Kamu mulai memikirkan hal apa yang ingin kamu raih di masa depan
                            </div>
                        </li>

                        <li class="flex gap-3">
                            <span class="text-orange-500 text-xl">✔</span>
                            <div>
                                <b>Aku bisa belajar dari pengalaman hidupku</b><br>
                                Baik pengalaman menyenangkan maupun sulit membuatmu semakin mengenal diri sendiri
                            </div>
                        </li>

                        <li class="flex gap-3">
                            <span class="text-orange-500 text-xl">✔</span>
                            <div>
                                <b>Aku percaya dengan arah hidup yang kupilih</b><br>
                                Kamu mulai yakin dengan nilai dan hal yang kamu anggap penting
                            </div>
                        </li>

                        <li class="flex gap-3">
                            <span class="text-orange-500 text-xl">✔</span>
                            <div>
                                <b>Aku punya target yang lebih jelas</b><br>
                                Tujuanmu tidak hanya sekadar mimpi, tetapi mulai kamu pikirkan langkah-langkahnya
                            </div>
                        </li>

                    </ul>
                </div>

                {{-- KENAPA PENTING --}}
                <div class="bg-gray-200 rounded-3xl p-6">
                    <h3 class="font-semibold text-lg mb-3 text-center">
                        Kenapa <i>Purpose in Life</i> Itu Penting?
                    </h3>

                    <p class="text-sm mb-3">
                        Memiliki tujuan hidup bisa membantu kamu untuk:
                    </p>

                    <ol class="text-sm list-decimal ml-5 space-y-1">
                        <li>Lebih tahu arah hidupmu</li>
                        <li>Memahami arti dari pengalaman hidupmu</li>
                        <li>Lebih percaya dengan dirimu sendiri</li>
                        <li>Memiliki motivasi untuk meraih cita-cita</li>
                    </ol>

                    <p class="text-sm mt-3">
                        Dengan kata lain, purpose in life membantu kamu tidak hanya berjalan, tetapi tahu ke mana kamu ingin
                        melangkah
                    </p>
                </div>

            </div>
            {{-- KANAN --}}
            <div class="bg-gray-200 rounded-3xl p-6">
                <h3 class="font-semibold text-lg mb-3 text-center">
                    Apa Saja yang Membentuk <i>Purpose in Life</i>?
                </h3>

                <p class="text-sm mb-4">
                    Setiap orang punya tujuan hidup yang berbeda. Tapi biasanya, tujuan hidup kita terbentuk dari cara kita
                    melihat hidup dan bagaimana kita merasakan kehidupan itu sendiri.
                </p>

                <p class="text-sm mb-4">
                    Menurut Molcar & Stuempfig, ada dua hal yang banyak mempengaruhi purpose in life diantaranya,
                </p>

                <ol class="text-sm list-decimal ml-5 space-y-2">
                    <li>
                        <b>Cara Kita Melihat Dunia</b>, setiap orang punya cara
                        pandang yang berbeda tentang hidup. Kalau kita
                        melihat hidup sebagai kesempatan untuk belajar
                        dan berkembang, biasanya kita juga lebih mudah
                        menemukan tujuan yang ingin dicapai.
                    </li>
                    <li>
                        <b>Cara Kita Merasakan Hidup</b>, perasaan bahagia,
                        puas, atau menikmati hal-hal kecil dalam hidup
                        juga bisa membantu kita menemukan arah hidup.
                        Saat kita merasa hidup kita berarti, kita jadi lebih
                        semangat untuk mengejar tujuan yang kita
                        inginkan.
                    </li>
                </ol>
            </div>
        </div>
    </div>

    @if ($version)
        <div class="mt-10 bg-white rounded-2xl p-6 shadow max-w-3xl mx-auto">

            <h2 class="text-xl font-bold mb-4 text-center">
                🌟 Versi Terbaikku Nanti
            </h2>

            <p class="italic text-gray-600 mb-4 text-center">
                "{{ $version->harapan }}"
            </p>

            <div class="bg-gray-100 p-4 rounded-xl">
                <p class="text-sm font-semibold">
                    Untukku
                </p>
                <p class="text-sm whitespace-pre-line">
                    {{ $version->pesan }}
                </p>
            </div>

        </div>
    @endif

@endsection
