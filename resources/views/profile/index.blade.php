@extends('layout.profile')
@section('title', 'Profile')
@section('content')
    <div class="flex items-center justify-center pt-4 mb-4">
        <div class="flex items-center justify-between w-full">
            <a href="{{route('home.index')}}" class="flex items-center">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" class="w-6 h-6">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M16.1795 3.26875C15.7889 2.87823 15.1558 2.87823 14.7652 3.26875L8.12078 9.91322C6.94952 11.0845 6.94916 12.9833 8.11996 14.155L14.6903 20.7304C15.0808 21.121 15.714 21.121 16.1045 20.7304C16.495 20.3399 16.495 19.7067 16.1045 19.3162L9.53246 12.7442C9.14194 12.3536 9.14194 11.7205 9.53246 11.33L16.1795 4.68297C16.57 4.29244 16.57 3.65928 16.1795 3.26875Z"
                            fill="#ffffff"></path>
                    </g>
                </svg>
                <h1 class="ml-2 font-medium text-white">Back</h1>
            </a>
            <h1 class="text-2xl font-extrabold text-white font-post-no-bills-jaffna">Profile</h1>
            <div class="w-[70px] h-6"></div>
        </div>

    </div>
    <div class="relative flex flex-col items-center justify-start p-10 mt-20 bg-white h-dvh rounded-t-3xl">
        <!-- Logo in the center -->
        <div class="absolute flex items-center justify-center w-20 h-20 mb-4 bg-white rounded-full top-[-40px]">
            <img src="{{ asset('asset/icon/image_logo.png') }}" alt="Logo"
                class="object-cover w-full h-full rounded-full">
        </div>
        <!-- Profile information -->
        <h1 class="mt-8 text-xl font-medium text-center">{{ Auth::user()->name }}</h1>
        <div class="flex flex-col items-start justify-start w-full mt-6 text-start">
            <h2 class="text-lg font-semibold">Nama</h2>
            <p class="mb-2 text-gray-700">{{ Auth::user()->name }}</p>
            <h2 class="mt-6 text-lg font-semibold">Email</h2>
            <p class="text-gray-700">{{ Auth::user()->email }}</p>
            <a href="{{ route('logout') }}" class="flex items-center justify-between w-full mt-6">
                <h2 class="text-lg font-semibold text-red-500 ">Logout</h2>
                <img src="{{ asset('asset/icon/ic_arrow_red.png') }}" class="h-auto w-7" alt="" srcset="">
            </a>
        </div>
    </div>
@endsection
