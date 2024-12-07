@extends('layout.layout')
@section('title', 'cek kesehatan')
@section('content')
    <div class="flex items-center justify-center pt-4 mb-4 text-center">
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
    <div class="relative flex flex-col items-center justify-center h-dvh">
        <video id="video" class="w-full h-auto max-w-xs bg-black rounded" autoplay></video>
        <button id="snap" class="absolute px-4 py-2 text-white bg-blue-500 rounded-full bottom-20">Take Photo</button>
        <canvas id="canvas" class="hidden max-w-xs mt-4 rounded"></canvas>
        <form id="photoForm" class="flex-col items-center hidden mt-4" method="POST"
            action="{{ route('cek-kesehatan.upload-photo') }}">
            @csrf
            <input type="hidden" name="photo" id="photoInput">
            <button type="submit" class="px-4 py-2 mt-4 text-white bg-green-500 rounded-full">Kirim</button>
        </form>
        <div class="mt-4">
            <label class="block mb-2 text-sm font-medium text-gray-900">Or Upload from Gallery</label>
            <input type="file" id="upload" accept="image/*"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
        </div>
    </div>

    <script>
        // Akses elemen HTML
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const snap = document.getElementById('snap');
        const context = canvas.getContext('2d');
        const photoForm = document.getElementById('photoForm');
        const photoInput = document.getElementById('photoInput');
        const upload = document.getElementById('upload');

        // Akses kamera
        navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: {
                        ideal: "environment"
                    }
                }
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(error => {
                console.error('Error accessing the camera', error);
            });

        // Tangkap gambar ketika tombol diklik
        snap.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            canvas.classList.remove('hidden');
            video.classList.add('hidden');
            snap.classList.add('hidden');
            photoForm.classList.remove('hidden');
            photoInput.value = canvas.toDataURL('image/jpeg');
        });

        // Unggah gambar dari galeri
        upload.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        canvas.width = img.width;
                        canvas.height = img.height;
                        context.drawImage(img, 0, 0, canvas.width, canvas.height);
                        canvas.classList.remove('hidden');
                        video.classList.add('hidden');
                        snap.classList.add('hidden');
                        photoForm.classList.remove('hidden');
                        photoInput.value = canvas.toDataURL('image/jpeg');
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

@endsection
