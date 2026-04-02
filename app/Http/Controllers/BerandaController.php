<?php

namespace App\Http\Controllers;

use App\Models\Version;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $version = Version::where('user_id', Auth::id())->first();

        return view('dashboard', compact('version'));
    }
}
