@extends('layout.auth-layout')
@section('title', 'Login')
@section('content')
    <div class="bg-gray-50 ">
        <div class="flex flex-col items-center justify-center min-h-screen px-4 py-6">
            <div class="w-full max-w-md">
                <div class="p-8 bg-white shadow rounded-2xl">
                <div class="flex items-center justify-center mb-4">
                <img src="asset/icon/image_logo.png" alt="Logo" class="w-8 h-8 mr-2">
                <h2 class="text-2xl font-bold text-gray-800">Login</h2>
            </div>
                    <form class="mt-8 space-y-4" action="{{ route('auth.authentication') }}" method="POST">
                        @csrf
                        @if ($errors->has('login'))
                            <p class="text-sm italic text-red-500">{{ $errors->first('login') }}</p>
                        @endif
                        <div>
                            <label for="email" class="block mb-2 text-sm text-gray-800">Email</label>
                            <div class="relative flex items-center">
                                <input id="email" name="email" type="email" required
                                    class="w-full px-4 py-3 text-sm text-gray-800 border border-gray-300 rounded-md outline-blue-600"
                                    placeholder="Enter user name" />
                            </div>
                            @error('email')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block mb-2 text-sm text-gray-800">Password</label>
                            <div class="relative flex items-center">
                                <input id="password" name="password" type="password" required
                                    class="w-full px-4 py-3 text-sm text-gray-800 border border-gray-300 rounded-md outline-blue-600"
                                    placeholder="Enter password" />

                            </div>
                            @error('password')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="!mt-8">
                            <button type="submit"
                                class="w-full px-4 py-3 text-sm tracking-wide text-white bg-green-600 rounded-lg hover:bg-green-500 focus:outline-none">
                                Sign in
                            </button>
                        </div>
                        <p class="text-gray-800 text-sm !mt-8 text-center">Don't have an account? <a
                                href="{{ route('register') }}"
                                class="ml-1 font-semibold text-green-500 hover:underline whitespace-nowrap">Register
                                here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
