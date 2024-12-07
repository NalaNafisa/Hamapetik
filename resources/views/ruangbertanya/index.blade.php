@extends('layout.layout')
@section('title', 'Ruang Bertanya')
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
        <div class="text-center">
            <p class="mb-2 text-lg font-medium text-gray-400 font-poppins">Selamat datang di Ruang Diskusi HamaPetik</p>
            <p class="mb-4 text-base text-gray-400 font-poppins font-regular">Selasa, 19 Feb 2024</p>
        </div>
        <div id="chatbox" class="h-screen p-4 overflow-y-auto">
            <!-- Chat messages will be displayed here -->
            @foreach ($messages as $message)
                @if ($message->sender == 'user')
                    <div class="mb-2 text-right">
                        <p
                            class="inline-block px-4 py-2 text-sm text-white bg-blue-500 rounded-lg max-w-80 message-content">
                            {{ $message->content }}</p>
                    </div>
                @else
                    <div class="mb-2">
                        <p
                            class="inline-block px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded-lg max-w-80 message-content">
                            {{ $message->content }}</p>
                    </div>
                @endif
            @endforeach
            {{-- loading animation --}}
            <div id="loading-animation" class="flex items-center justify-center mt-5 h-min" style="display: none;">
                <div class="flex flex-row gap-2">
                    <div class="w-4 h-4 bg-blue-700 rounded-full animate-bounce"></div>
                    <div class="w-4 h-4 rounded-full bg-blue-700 animate-bounce [animation-delay:-.3s]"></div>
                    <div class="w-4 h-4 rounded-full bg-blue-700 animate-bounce [animation-delay:-.5s]"></div>
                </div>
            </div>
        </div>
    </div>
    <form id="chat-form">
        <div class="flex items-center p-4 mb-4 bg-white rounded-lg shadow-md" style="border-radius: 28px;">
            <input type="text" id="message" class="flex-grow p-2 bg-transparent border border-gray-300 rounded-md"
                placeholder="Tulis pesan...">
            <button type="submit" class="flex items-center justify-center w-12 h-12 ml-4 bg-green-600 rounded-full">
                <img src="https://img.icons8.com/ios-filled/50/ffffff/paper-plane.png" alt="Send" class="w-6 h-6">
            </button>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script>
        $(document).ready(function() {
            // Parse existing chat messages
            $('.message-content').each(function() {
                const rawContent = $(this).text();
                const parsedContent = marked.parse(rawContent);
                $(this).html(parsedContent);
            });

            // Form submission handler
            $("#chat-form").submit(function(event) {
                event.preventDefault();
                const messageInput = $("#message");
                const message = messageInput.val();
                if (message.trim() === "") return;

                messageInput.prop('disabled', true);
                $("form button").prop('disabled', true);
                $("#loading-animation").show();

                $.ajax({
                    url: '{{ route('ruang-bertanya.chat') }}',
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    data: {
                        "content": message
                    }
                }).done(function(res) {
                    $('#chatbox').append(
                        '<div class="mb-2 text-right"><p class="inline-block px-4 py-2 text-sm text-white bg-blue-500 rounded-lg max-w-80">' +
                        marked.parse(message) + '</p></div>');
                    const formattedResponse = marked.parse(res); // Convert markdown to HTML
                    $('#chatbox').append(
                        '<div class="mb-2"><div class="inline-block px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded-lg max-w-80">' +
                        formattedResponse + '</div></div>');

                    messageInput.val('');
                    $(document).scrollTop($(document).height());
                }).fail(function() {
                    alert("Terjadi kesalahan. Silakan coba lagi.");
                }).always(function() {
                    $("#loading-animation").hide();
                    messageInput.prop('disabled', false);
                    $("form button").prop('disabled', false);
                });
            });
        });
    </script>
@endsection
