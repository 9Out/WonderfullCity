@extends('admin.layouts.session')

@section('content')
    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">
        <div class="text-center mt-6">
            <h1 class="text-3xl font-bold text-gray-700  mb-2">{{ config('app.name') }}</h1>
            <div class="text-pink-600 text-3xl mb-2">✹</div>
        </div>


        <h3 class="text-2xl text-center font-bold text-gray-700 mb-2">
        Login
        </h3>

        <p class="text-sm text-center text-gray-500 mb-6">
        Please sign-in to your account
        </p>

        @if ($errors->any())
        <div class="bg-red-100 text-red-800 text-sm font-bold p-2 rounded-xl mb-4">
            @foreach ($errors->all() as $error)
                <div class="text-center">{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form action="{{ route('login-submit') }}" method="POST" class="space-y-4">
            @csrf
        <div>
            <label class="block text-sm font-bold text-gray-700">Email</label>
            <input type="email" name="email" autocomplete="nope" required
                class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"/>
        </div>

        <div>
            <div class="relative">
                <label class="block text-sm font-bold text-gray-700">Password</label>
                <a href="{{ route('password.request') }}" class="absolute top-1/2 right-0 text-sm text-purple-500 transform -translate-y-1/2">Lupa Password?</a>
            </div>
            <input type="password" name="password" autocomplete="nope" required
                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-purple-500"/>
        </div>

        <div class="flex items-center">
            <input id="remember-me" name="remember" type="checkbox" class="h-4 w-4 text-purple-600 border-gray-300 rounded">
            <label for="remember-me" class="ml-1 block text-sm text-gray-700 select-none">Remember Me</label>
        </div>

        <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-md hover:bg-purple-700 transition">
            Login
        </button>
        </form>
    </div>
@endsection