@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto mt-10 mb-20">

    <div class="bg-gray-200 rounded-2xl p-8 shadow text-center">

        {{-- ICON PROFIL --}}
        <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gray-300 flex items-center justify-center text-4xl">
            👤
        </div>

        {{-- NAMA --}}
        <h2 class="text-xl font-bold">
            {{ Auth::user()->name }}
        </h2>

        {{-- EMAIL --}}
        <p class="text-gray-600 text-sm mt-1">
            {{ Auth::user()->email }}
        </p>

    </div>

</div>

@endsection