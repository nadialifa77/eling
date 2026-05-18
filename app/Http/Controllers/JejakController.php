<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tujuan;
use App\Models\Cerita;
use Carbon\Carbon;

class JejakController extends Controller
{
    public function index()
    {
        // ================= PROGRESS TUJUAN =================
        $tujuans = Tujuan::with('subTujuans')
            ->where('user_id', Auth::id())
            ->get();

        $totalSub = 0;
        $doneSub = 0;

        foreach ($tujuans as $t) {
            $totalSub += $t->subTujuans->count();
            $doneSub += $t->subTujuans->where('is_done', true)->count();
        }

        $progress = $totalSub > 0 ? round(($doneSub / $totalSub) * 100) : 0;

        // ================= MOOD 14 HARI =================
        $ceritas = Cerita::where('user_id', Auth::id())
            ->where('created_at', '>=', Carbon::now()->subDays(14))
            ->orderBy('created_at', 'asc')
            ->get();

        $dates = [];
        $moodData = [];

        $moodMap = [
            '😭' => 1,
            '😨' => 2,
            '😐' => 3,
            '😄' => 4,
            '😡' => 5,
        ];

        foreach ($ceritas as $cerita) {
            $dates[] = $cerita->created_at->format('d M H:i');
            $moodData[] = $moodMap[$cerita->mood];
        }

        return view('jejak', compact('progress', 'dates', 'moodData'));
    }
}
