@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-6 mb-20 space-y-8">

    {{-- CARD CONTACT --}}
    <div class="bg-gray-200 rounded-3xl p-10 shadow text-center">

        <div class="w-24 h-24 mx-auto rounded-full bg-gray-300
                    flex items-center justify-center text-5xl mb-4">
            📧
        </div>

        <h1 class="text-3xl font-bold mb-2">
            Hubungi Kami
        </h1>

        <p class="text-gray-600 text-lg">
            elingwithpurpose@gmail.com
        </p>
    </div>


    {{-- FAQ --}}
    <div class="bg-gray-200 rounded-3xl p-8 shadow"
         x-data="{ open: null }">

        <h2 class="text-2xl font-bold mb-6">
            ❓ FAQ Eling
        </h2>

        @php
            $faq = [
                [
                    'q' => 'Apa tujuan utama pengembangan dari eling?',
                    'a' => 'Tujuan utama eling adalah bantu kamu buat ngelola purpose in life supaya kamu bisa lebih paham diri sendiri, nemuin tujuan hidup, dan lebih reflektif sama kehidupan sehari-hari. Selain itu, eling juga dibuat buat bantu kamu lebih sadar sama perasaan, pengalaman, dan hal-hal yang lagi kamu jalanin.'
                ],
                [
                    'q' => 'Apakah eling dapat digunakan secara mandiri?',
                    'a' => 'Pastinya bisa dong! eling emang dirancang supaya kamu bisa pakai sendiri kapan pun kamu butuh, tapi tetap bisa juga dipakai bareng pendampingan guru BK.'
                ],
                [
                    'q' => 'Apakah data yang dimasukkan akan terjamin kerahasiaannya?',
                    'a' => 'Don’t worry yaa, data yang kamu masukin bakal aman dan privasi kamu tetap terjaga karena akun eling cuma bisa diakses sama kamu sendiri.'
                ],
                [
                    'q' => 'Apakah eling membutuhkan koneksi internet?',
                    'a' => 'Yup, karena eling berbasis website jadi kamu perlu koneksi internet buat akses dan nggunain semua fiturnya dengan lancar.'
                ],
                [
                    'q' => 'Apa keunggulan eling dibanding media konvensional?',
                    'a' => 'Eling lebih fleksibel karena bisa kamu akses kapan aja dan di mana aja.'
                ],
                [
                    'q' => 'Apakah media eling sudah melalui proses validasi ahli?',
                    'a' => 'Tentu aja! eling udah melalui proses validasi dan uji kelayakan dari ahli.'
                ],
                [
                    'q' => 'Bagaimana harapan pengembangan media eling ke depan?',
                    'a' => 'Harapannya, eling bisa jadi tempat yang nyaman buat kamu berkembang, refleksi diri, dan lebih kenal sama tujuan hidup kamu.'
                ]
            ];
        @endphp

        <div class="space-y-4">
            @foreach($faq as $i => $item)
                <div class="bg-white rounded-xl p-4">

                    <button
                        @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                        class="w-full flex justify-between items-center text-left">

                        <span class="font-semibold">
                            {{ $item['q'] }}
                        </span>

                        <span class="text-xl">+</span>
                    </button>

                    <div x-show="open === {{ $i }}"
                         x-transition
                         class="mt-3 text-gray-600 text-sm">
                        {{ $item['a'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection