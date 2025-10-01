@extends('home.layouts')

@section('title', 'Register')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="bg-white/90 backdrop-blur-sm p-6 rounded-xl shadow-lg w-full max-w-sm">
            <h2 class="text-xl font-bold text-center mb-4 text-gray-800">Create Account</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('name') }}" required autofocus autocomplete="name">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                        required autocomplete="new-password">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                        Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                        required autocomplete="new-password">
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Registration Code -->
                <div class="mb-4">
                    <label for="reg_code" class="block text-sm font-medium text-gray-700 mb-1">Registration Code</label>
                    <input type="text" id="reg_code" name="reg_code"
                        class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500"
                        required placeholder="Enter registration code">
                    @error('reg_code')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded transition focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Register
                </button>

                <div class="text-center mt-4">
                    <span class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500">
                            Sign in
                        </a>
                    </span>
                </div>
            </form>
        </div>
    </div>
@endsection
