@extends('layout.auth-layout')
@section('title', 'Register')
@section('content')
    <div class="bg-gray-50 ">
        <div class="flex flex-col items-center justify-center min-h-screen px-4 py-6">
            <div class="w-full max-w-md">

                <div class="p-8 bg-white shadow rounded-2xl">
                <div class="flex items-center justify-center mb-4">
                <img src="asset/icon/image_logo.png" alt="Logo" class="w-8 h-8 mr-2">
                <h2 class="text-2xl font-bold text-gray-800">Register</h2>
            </div>
                    <form class="mt-8 space-y-4" action="{{ route('auth.registration') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm text-gray-800">Name</label>
                            <div class="relative flex items-center">
                                <input id="name" name="name" type="text" required
                                    class="w-full px-4 py-3 text-sm text-gray-800 border border-gray-300 rounded-md outline-green-600"
                                    placeholder="Enter name" />

                            </div>
                            @error('name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm text-gray-800">Email</label>
                            <div class="relative flex items-center">
                                <input id="email" name="email" type="email" required
                                    class="w-full px-4 py-3 text-sm text-gray-800 border border-gray-300 rounded-md outline-green-500"
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
                                    class="w-full px-4 py-3 text-sm text-gray-800 border border-gray-300 rounded-md outline-green-600"
                                    placeholder="Enter password" />

                            </div>
                            @error('password')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="!mt-8">
                            <button type="submit"
                                class="w-full px-4 py-3 text-sm tracking-wide text-white bg-green-600 rounded-lg hover:bg-green-700 focus:outline-none">
                                Register
                            </button>
                        </div>
                        <p class="text-gray-800 text-sm !mt-8 text-center">Allready have an account? <a
                                href="{{ route('login') }}"
                                class="ml-1 font-semibold text-green-500 hover:underline whitespace-nowrap">Login
                                here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
