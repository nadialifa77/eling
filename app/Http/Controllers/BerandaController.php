<?php

namespace App\Http\Controllers;

use App\Models\Version;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;


class BerandaController extends Controller
{
    private function getQuote()
    {
        $quotes = [
            "Setiap orang memiliki mimpi yang bisa menjadi arah dalam hidupnya.",
            "Tujuan hidup membantu kita mengetahui ke mana langkah kita akan menuju.",
            "Hal kecil yang kita lakukan hari ini bisa menjadi bagian dari perjalanan menuju masa depan.",
            "Memiliki tujuan membuat usaha yang kita lakukan terasa lebih berarti.",
            "Ketika kita tahu apa yang ingin dicapai, kita akan lebih semangat untuk berusaha.",
            "Tujuan hidup dapat menjadi pengingat mengapa kita terus belajar dan berkembang.",
            "Setiap langkah kecil tetap berarti selama kita bergerak menuju tujuan.",
            "Mencapai tujuan dimulai dari keberanian untuk mencoba.",
            "Pengalaman masa lalu dapat membantu kita memahami diri sendiri dengan lebih baik.",
            "Setiap kejadian dalam hidup bisa menjadi pelajaran yang berharga.",
            "Kesalahan yang pernah terjadi dapat membantu kita tumbuh menjadi pribadi yang lebih baik.",
            "Pengalaman hari ini bisa menjadi cerita penting di masa depan.",
            "Dari setiap pengalaman, kita bisa belajar tentang apa yang benar-benar penting bagi kita.",
            "Masa lalu tidak hanya untuk dikenang, tetapi juga untuk dipahami maknanya.",
            "Hal-hal yang kita alami hari ini dapat membantu membentuk tujuan hidup ke depan.",
            "Keyakinan pada diri sendiri membantu kita menemukan arah dalam hidup.",
            "Ketika kita percaya pada kemampuan diri, tujuan terasa lebih mungkin dicapai.",
            "Keyakinan dapat memberi kekuatan untuk tetap berusaha meskipun menghadapi kesulitan.",
            "Hal-hal yang kita yakini penting sering kali menjadi dasar tujuan hidup kita.",
            "Kepercayaan pada nilai yang kita pegang dapat membantu menentukan pilihan hidup.",
            "Keyakinan membuat seseorang tetap berusaha meskipun jalan yang ditempuh tidak selalu mudah.",
            "Percaya pada diri sendiri adalah langkah awal untuk membangun masa depan.",
            "Tujuan hidup akan lebih mudah dicapai ketika dirumuskan dengan jelas.",
            "Menuliskan tujuan dapat membantu kita lebih fokus pada apa yang ingin dicapai.",
            "Sasaran yang jelas membantu kita mengetahui langkah apa yang perlu dilakukan.",
            "Perencanaan sederhana dapat membuat tujuan terasa lebih dekat.",
            "Tujuan yang jelas membantu kita menentukan prioritas dalam kehidupan.",
            "Dengan sasaran yang terarah, kita dapat melihat perkembangan diri dari waktu ke waktu.",
            "Tujuan yang dituliskan dapat menjadi pengingat atas mimpi yang ingin diwujudkan.",
            "Ketika tujuan dirumuskan dengan jelas, kita dapat melangkah dengan lebih yakin."
        ];

        $index = Carbon::now()->dayOfYear % count($quotes);
        return $quotes[$index];
    }

    public function welcome()
    {
        $quote = $this->getQuote();
        return view('welcome', compact('quote'));
    }

    public function index()
    {
        $version = Version::where('user_id', Auth::id())->first();
        $quote = $this->getQuote();

        return view('dashboard', compact('version', 'quote'));
    }
}
