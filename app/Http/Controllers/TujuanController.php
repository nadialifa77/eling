<?php

namespace App\Http\Controllers;

use App\Models\Tujuan;
use App\Models\SubTujuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TujuanController extends Controller
{
    public function index()
    {
        $tujuans = Tujuan::with('subTujuans')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('tujuan', compact('tujuans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255'
        ], [
            'judul.required' => 'Tujuan tidak boleh kosong!'
        ]);

        Tujuan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul
        ]);

        return back()->with('success', 'Tujuan berhasil ditambahkan!');
    }

    public function addSub(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255'
        ], [
            'judul.required' => 'Sub tujuan tidak boleh kosong!'
        ]);

        SubTujuan::create([
            'tujuan_id' => $request->tujuan_id,
            'judul' => $request->judul
        ]);

        return back()->with('success', 'Sub tujuan berhasil ditambahkan!');
    }

    public function toggle($id)
    {
        $sub = SubTujuan::findOrFail($id);
        $sub->is_done = !$sub->is_done;
        $sub->save();

        return back();
    }

    public function destroy($id)
    {
        Tujuan::findOrFail($id)->delete();
        return back();
    }

    public function deleteSub($id)
    {
        SubTujuan::findOrFail($id)->delete();
        return back();
    }
}
