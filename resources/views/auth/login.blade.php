@extends('home.layouts')

@section('title', 'Sign In')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white/90 backdrop-blur-sm p-6 rounded-xl shadow-lg w-full max-w-sm">
            <h2 class="text-xl font-bold text-center mb-4 text-gray-800">Sign In</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                        required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Sign In
                </button>
                <div class="text-center mt-4">
                    <span class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500">
                            Sign up
                        </a>
                    </span>
                </div>
            </form>
        </div>
    </div>
@endsection
