<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>

<body>
    <main class="flex items-start justify-center bg-green-400">
        <div class="w-full max-w-md px-4 mx-auto ">
            @yield('content')
        </div>
    </main>

</body>

</html>
