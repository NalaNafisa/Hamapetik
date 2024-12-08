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
    <div class="container mx-auto px-4">


        {{-- Tampilan Produk Secara Detail --}}
        @forelse ($data as $category => $categoryData)
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Pupuk {{ $category }}</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse ($categoryData['data'] as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden transform transition duration-300 hover:scale-105">
                    {{-- Gambar Produk --}}
                    <div class="h-48 w-full">
                        <img
                            src="{{ $product[6] }}"
                            alt="{{ $product[0] }}"
                            class="w-full h-full object-cover">
                    </div>

                    {{-- Informasi Produk --}}
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-2 truncate">{{ $product[0] }}</h3>

                        {{-- Harga --}}
                        <div class="flex justify-between items-center">
                            <span class="text-green-600 font-semibold">
                                {{ $product[1] }}
                            </span>

                            {{-- Tombol Beli --}}
                            <a
                                href="{{ $product[4] }}"
                                target="_blank"
                                class="bg-green-500 text-white px-3 py-1 rounded-full text-sm hover:bg-green-600 transition">
                                lihat detail
                            </a>
                        </div>

                        {{-- Detail Tambahan --}}
                        <div class="mt-2 text-sm text-gray-600">
                            <p>Toko: {{ $product[5] }}</p>
                            <p>Rating: {{ $product[2] }}</p>
                            <p>Terjual: {{ $product[3] }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-xl text-gray-500">Tidak ada produk ditemukan</p>
                </div>
                @endforelse
            </div>
        </div>
        @empty
        <div class="text-center py-10">
            <p class="text-2xl text-gray-500">Tidak ada produk yang tersedia</p>
        </div>
        @endforelse
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Efek hover pada produk
        const productCards = document.querySelectorAll('.transform');
        productCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.classList.add('shadow-xl');
            });
            card.addEventListener('mouseleave', function() {
                this.classList.remove('shadow-xl');
            });
        });
    });
    const axios = require('axios');
    const cheerio = require('cheerio');

    async function scrapeTokopedia(url) {
        try {
            const {
                data
            } = await axios.get(url);
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