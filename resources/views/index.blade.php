@extends('layout.layout')
@section('title', 'tani')
@section('content')
    <div class="flex items-center justify-center pt-4 mb-4 text-center ">
        <h1 class="text-2xl font-extrabold text-black font-post-no-bills-jaffna">HamaPetik</h1>
        <div class="w-12 h-12 ml-2 overflow-hidden bg-gray-300 rounded-full">
            <img src="{{ asset('asset/icon/image_logo.png') }}" alt="Plant" class="object-cover w-full h-full">
        </div>
    </div>
    <hr class="mb-6 border-gray-300">
    <div class="flex flex-col items-center justify-between ">
        <div class="w-full overflow-y-auto h-dvh ">
            <!-- Card 1 -->
            <a href="{{ route('cek-kesehatan.index') }}" class="flex items-center p-4 mb-6 bg-white shadow-md rounded-xl">
                <div class="flex items-center justify-center w-16 h-auto mr-4 overflow-hidden rounded-full bg-white-300">
                    <img src="{{ asset('asset/icon/ic_plant.png') }}" alt="Plant" class="object-cover w-full h-auto">
                </div>
                <div>
                    <h2 class="font-semibold text-lg font-poppins text-[#1D1617]">Cek Kesehatan Tanaman</h2>
                    <p class="font-regular text-sm text-[#7B6F72]">Pantau dan cek kesehatan tanaman dengan hanya memotret
                        nya saja.
                    </p>
                </div>
            </a>

            <!-- Card 2 -->
            <a href="{{ route('ruang-bertanya.index') }}" class="flex items-center p-4 mb-6 bg-white shadow-md rounded-xl">
                <div class="w-10 h-10 overflow-hidden rounded-full mr-7">
                    <img src="{{ asset('asset/icon/ic_chat.png') }}" alt="Plant" class="object-cover w-full h-auto">
                </div>
                <div>
                    <h2 class="font-semibold text-lg font-poppins text-[#1D1617]">Ruang Bertanya</h2>
                    <p class="font-regular text-sm text-[#7B6F72]">Mari diskusikan tanaman anda
                        pada kami.</p>
                </div>
            </a>

            <a href="{{ route('rekomendasi.index') }}" class="flex items-center p-4 mb-6 bg-white shadow-md rounded-xl">
                <div class="w-10 h-10 overflow-hidden rounded-full mr-7">
                    <img src="{{ asset('asset/icon/pupuk.png') }}" alt="Plant" class="object-cover w-full h-auto">
                </div>
                <div>
                    <h2 class="font-semibold text-lg font-poppins text-[#1D1617]">Rekomendasi Pupuk Tanaman</h2>
                    <p class="font-regular text-sm text-[#7B6F72]">Butuh informasi pupuk tanaman? Yuk Kepoin!</p>
                </div>
            </a>
           
        </div>
        <!-- Rectangle with Profile Image -->
        <a href="{{ route('profile.index') }}"
            class="bg-[#026B00] w-full rounded-xl py-4 mt-6 flex items-center justify-center">
            <div class="w-16 h-16 mr-4 bg-gray-300 rounded-full">
                <img src="{{ asset('asset/icon/ic_user.png') }}" alt="Profile" class="object-cover w-full h-full">
            </div>
            <div class="text-slate-100 ">
                <p>Profil</p>
            </div>
        </a>
    </div>
@endsection
