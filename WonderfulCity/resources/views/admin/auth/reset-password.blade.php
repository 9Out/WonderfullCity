@extends('admin.layouts.session')

@section('content')
<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md mx-auto mt-10">
    <div class="mb-2">
        <h1 class="text-2xl font-bold text-gray-700 mb-3">Reset Password</h1>
    </div>

    @if ($errors->any())
    <div class="bg-red-100 text-red-800 text-sm font-bold p-2 rounded-xl mb-4">
        @foreach ($errors->all() as $error)
            <div class="text-center">{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-4 mt-4">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div>
            <label class="block text-sm font-medium text-gray-700">Password Baru</label>
            <input type="password" name="password" required
                class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" />
        </div>

        <button type="submit"
            class="w-full bg-purple-600 text-white py-2 rounded-md hover:bg-purple-700 transition">
            Reset Password
        </button>
    </form>
</div>
@endsection