<?php

namespace App\Http\Controllers;

use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VersionController extends Controller
{
    public function index()
    {
        $version = Version::where('user_id', Auth::id())->first();

        return view('versi', compact('version'));
    }

    public function store(Request $request)
    {
        if (!$request->harapan || !$request->pesan) {
            return back()->withErrors([
                'custom' => 'Harapan dan pesan tidak boleh kosong!'
            ])->withInput();
        }

        Version::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'harapan' => $request->harapan,
                'pesan' => $request->pesan
            ]
        );

        return redirect()->back()->with('success', 'Berhasil disimpan! Lihat halaman dashboard');
    }
}
