@extends('layout.layout')
@section('title', 'Rekomendasi Pupuk')
@section('content')
<div class="mx-auto">
    <div class="flex items-center justify-center mb-4">
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
    <hr class="mb-4 border-gray-300">
    <div class="flex items-start mb-6">

        <div class="w-3/4 ">
            <p class="mb-2 text-2xl text-gray-400 font-poppins">REKOMENDASI</p>
            <p class="mb-4 text-6xl font-poppins font-medium">PUPUK</p>
            <span>Anda butuh pupuk untuk tanaman anda, kualitas tanaman tergantung dari perawatan yang anda berikan.</span>
        </div>

        <div class="ml-4">
            <img src="{{ asset('asset/icon/tanaman.png') }}" alt="tanaman" class="mb-4">
        </div>
    </div>
    
    <div class="flex items-center p-4 mb-4 bg-white shadow-md rounded-xl">
        <p class=" text-gray-400 font-poppins">Cari Pupuk</p>
    </div>
   
    <div class="h-screen">
        {{-- Pupuk Organik --}}
        <div class="py-3">
            <p class="mb-2 text-xl font-poppins font-medium">Pupuk Organik</p>
            <div class="flex space-x-4 overflow-x-auto hide-scrollbar whitespace-nowrap hover-scrollbar">
                @foreach ($data['Organik']['data'] as $allData)
                    <div class="w-36 h-36 bg-gray-300 rounded-lg flex-shrink-0">
                        <a href="{{ $allData[4] }}">
                            <img src="{{ $allData[6] }}" alt="Pupuk" class="object-cover w-full h-full">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    
        {{-- Pupuk Anorganik --}}
        <div class="py-3">
            <p class="mb-2 text-xl font-poppins font-medium">Pupuk Anorganik</p>
            <div class="flex space-x-4 overflow-x-auto hide-scrollbar whitespace-nowrap hover-scrollbar">
                @foreach ($data['Anorganik']['data'] as $allData)
                    <div class="w-36 h-36 bg-gray-300 rounded-lg flex-shrink-0">
                        <a href="{{ $allData[4] }}">
                            <img src="{{ $allData[6] }}" alt="Pupuk" class="object-cover w-full h-full">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    
        {{-- Pupuk Cair --}}
        <div class="py-3">
            <p class="mb-2 text-xl font-poppins font-medium">Pupuk Cair</p>
            <div class="flex space-x-4 overflow-x-auto hide-scrollbar whitespace-nowrap hover-scrollbar">
                @foreach ($data['Cair']['data'] as $allData)
                <div class="w-36 h-36 bg-gray-300 rounded-lg flex-shrink-0">
                    <a href="{{ $allData[4] }}">
                        <img src="{{ $allData[6] }}" alt="Pupuk" class="object-cover w-full h-full">
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    
    
</div>

<script>
    const axios = require('axios');
    const cheerio = require('cheerio');

    async function scrapeTokopedia(url) {
        try {
            const { data } = await axios.get(url);
            const $ = cheerio.load(data);

            // Ganti selector sesuai dengan struktur HTML Tokopedia
            $('.product-card').each((index, element) => {
                const imageUrl = $(element).find('.product-image img').attr('src');
                const productName = $(element).find('.product-name').text();
                const productPrice = $(element).find('.product-price').text();

                console.log(`Nama: ${productName}`);
                console.log(`Harga: ${productPrice}`);
                console.log(`Gambar: ${imageUrl}`);
            });
        } catch (error) {
            console.error('Error scraping Tokopedia:', error);
        }
    }

// Panggil fungsi dengan URL kategori
scrapeTokopedia('https://www.tokopedia.com/p/rumah-tangga/taman/pupuk');

</script>
@endsection
