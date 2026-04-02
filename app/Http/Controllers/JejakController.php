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
        $dates = [];
        $moods = [];

        for ($i = 13; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');

            $cerita = Cerita::where('user_id', Auth::id())
                ->whereDate('created_at', $date)
                ->latest()
                ->first();

            $dates[] = Carbon::parse($date)->format('d M');

            // mapping emoji → angka biar bisa di-chart
            $moods[] = match ($cerita->mood ?? null) {
                '😭' => 1,
                '🥺' => 2,
                '😳' => 3,
                '😡' => 2,
                '🥰' => 5,
                default => 0
            };
        }

        return view('jejak', compact('progress', 'dates', 'moods'));
    }
}