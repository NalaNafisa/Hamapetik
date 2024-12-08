<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HamaPetik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-teal-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="asset/icon/image_logo.png" alt="Logo" class="w-8 h-8 mr-2">
                <span class="text-xl font-bold">HamaPetik</span>
            </div>
            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-4">
                <a href="#" class="text-gray-700 hover:text-green-500">Beranda</a>
                <a href="#fitur" class="text-gray-700 hover:text-green-500">Fitur</a>
                <a href="#kontak" class="text-gray-700 hover:text-green-500">Kontak</a>
                <a href="{{route('login')}}" class="text-green-500 font-bold hover:text-green-600">Login</a>
            </div>
            <!-- Mobile Menu Button -->
            <button id="menu-button" class="md:hidden text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white">
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-teal-100">Beranda</a>
            <a href="#fitur" class="block px-4 py-2 text-gray-700 hover:bg-teal-100">Fitur</a>
            <a href="#kontak" class="block px-4 py-2 text-gray-700 hover:bg-teal-100">Kontak</a>
            <a href="{{route('login')}}" class="block px-4 py-2 text-green-500 font-bold hover:bg-teal-100">Login</a>
        </div>
    </nav>

    <!-- Content -->
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-md text-center max-w-xl w-full mx-auto md:max-w-2xl lg:max-w-4xl">
            <div class="flex flex-col md:flex-row items-center justify-center mb-6">
                <h1 class="text-2xl font-bold ml-0 md:ml-3 mt-3 md:mt-0">Selamatkan Tanaman Anda dari Hama dengan Mudah!</h1>
            </div>
            <div class="flex justify-center items-center mb-4">
                <img src="{{asset('asset/pohon.png')}}" alt="Tree" class="w-3/4 md:w-1/2 lg:w-1/3 mx-auto mb-4">
            </div>
            <!-- header -->
            <div class="mt-10">
                <p class="text-lg text-gray-700 mb-4">HamaPetik memberikan solusi praktis untuk melindungi tanaman kesayangan Anda, kapan saja, di mana saja. Jaga kebun Anda tetap sehat dan subur tanpa khawatir dengan hama yang merusak.</p>
            </div>

            <!-- subline -->
            <div class="mt-10">
                <p class="text-lg text-gray-700 font-medium mb-4">Teknologi AI untuk Perlindungan Tanaman yang Lebih Baik</p>
            </div>
            <div class="flex justify-center items-center mb-4">
                <img src="{{asset('asset/ai.png')}}" alt="Tree" class="w-3/4 md:w-1/2 lg:w-1/3 mx-auto mb-4">
            </div>
            <div class="mt-10">
                <p class="text-lg text-gray-700 mb-4">Dari deteksi otomatis hingga saran perawatan tanaman, HamaPetik memberikan berbagai fitur AI untuk membantu Anda menjaga kebun tetap bebas hama</p>
            </div>
            <div class="text-gray-700 mt-4 italic">
                "Tanaman Anda, Tanggung Jawab Anda"
            </div>
            <div class="my-10">
                <a href="{{route('home.index')}}" class="bg-green-500 text-white py-4 px-8 rounded mt-4 w-full hover:bg-green-600 transition duration-300">
                    Mulai Melindungi Tanaman Anda Sekarang!
                </a>
            </div>
        </div>
    </div>


    <!-- Script for Mobile Menu -->
    <script>
        const menuButton = document.getElementById('menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        menuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>