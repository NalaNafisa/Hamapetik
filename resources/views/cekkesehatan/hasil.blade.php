@extends('layout.layout')
@section('title', 'cek kesehatan')
@section('content')
    <div class="flex items-center justify-center pt-4 mb-4 text-center ">
        <div class="flex items-center justify-between w-full mt-5">
            <a href="{{ route('home.index') }}" class="flex items-center">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#000000" class="w-6 h-6">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M16.1795 3.26875C15.7889 2.87823 15.1558 2.87823 14.7652 3.26875L8.12078 9.91322C6.94952 11.0845 6.94916 12.9833 8.11996 14.155L14.6903 20.7304C15.0808 21.121 15.714 21.121 16.1045 20.7304C16.495 20.3399 16.495 19.7067 16.1045 19.3162L9.53246 12.7442C9.14194 12.3536 9.14194 11.7205 9.53246 11.33L16.1795 4.68297C16.57 4.29244 16.57 3.65928 16.1795 3.26875Z"
                            fill="#000000"></path>
                    </g>
                </svg>
                <h1 class="ml-2 font-medium text-black">Back</h1>
            </a>
            <div class="flex ">
                <h1 class="text-2xl font-extrabold text-black font-post-no-bills-jaffna">HamaPetik</h1>
                <div class="ml-2">
                    <img src="{{ asset('asset/icon/image_logo.png') }}" alt="Plant"
                        class="object-cover w-10 h-10 rounded-full">
                </div>
            </div>

            <div class="w-[65px] h-6"></div>
        </div>

    </div>

    <h2 class="mb-4 text-2xl font-semibold text-center font-poppins">Hasil Identifikasi</h2>
    @if (session('result'))
        <div class="flex items-center justify-center mb-12">
            <img src="{{ session('image') }}" alt="Plant" class="object-cover rounded-lg shadow-lg"
                style="width: 261px; height: 172px;">
        </div>
        <span class="block mt-4">{{ json_encode(session('result')) }}</span>
        {{-- <span class="block mt-4">"Gambar tersebut menunjukkan kalkulator desktop berwarna putih dengan tombol abu-abu dan layar LCD hitam. Tombolnya termasuk 0-9, tanda tambah, kurang, kali, bagi, persentase, akar kuadrat, MC, M-, M+, dan tombol sama dengan. Di bagian atas kalkulator terdapat logo \"JOYRO\" berwarna biru. Kalkulator terletak di atas permukaan putih dan sebagian tersembunyi di balik jari manusia.</span> --}}
    @endif
@endsection
