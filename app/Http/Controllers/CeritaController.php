<?php

namespace App\Http\Controllers;

use App\Models\Cerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CeritaController extends Controller
{
    public function index()
    {
        $ceritas = Cerita::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('cerita', compact('ceritas'));
    }

    public function store(Request $request)
{
    // VALIDASI CUSTOM
    if (!$request->isi || !$request->mood) {
        return back()->withErrors([
            'custom' => 'Cerita dan mood tidak boleh kosong!'
        ])->withInput();
    }

    Cerita::create([
        'user_id' => Auth::id(),
        'isi' => $request->isi,
        'mood' => $request->mood
    ]);

    return redirect()->back()->with('success', 'Cerita berhasil disimpan!');
}

    public function destroy($id)
    {
        $cerita = Cerita::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $cerita->delete();

        return redirect()->back()->with('success', 'Cerita berhasil dihapus!');
    }
}
