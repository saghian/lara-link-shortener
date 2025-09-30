@extends('home.layouts')

@section('title', 'Lara Link Shortener')

@section('content')
    <div class="text-center mt-16">
        <div class="bg-white/90 backdrop-blur-sm rounded-xl p-6 max-w-2xl mx-auto shadow-lg">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Lara Link Shortener</h1>
            <p class="text-gray-600 mb-6">Simple link shortener with Laravel</p>

            @auth
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    <p class="font-semibold">You're signed in! 🎉</p>
                    <a href="{{ route('console.index') }}"
                        class="inline-block mt-2 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded transition">
                        Go to Dashboard
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    <p class="text-gray-700">Sign in to access platform features</p>
                    <a href="{{ route('login') }}"
                        class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg transition font-semibold">
                        Get Started
                    </a>
                </div>
            @endauth
        </div>
    </div>
@endsection
