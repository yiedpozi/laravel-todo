<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 px-5 pb-5 pt-10 sm:px-10 sm:pb-10 sm:pt-20">
    <div class="text-center mb-5 sm:mb-10">
        <a href="{{ route('task.index') }}">
            <h1 class="text-3xl sm:text-6xl font-extrabold text-transparent uppercase tracking-tighest bg-clip-text bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 inline-block">
                {{ __('Laravel To Do List App') }}
            </h1>
        </a>
    </div>

    <div class="bg-white max-w-[1200px] rounded-lg shadow-md p-5 sm:p-10 m-auto">
        {{ $slot }}
    </div>

    <span class="text-gray-400 text-xs font-semibold text-center uppercase mt-5 block">Powered by Laravel | Built with love by <a class="text-white hover:text-gray-200" href="https://yiedpozi.my/" target="_blank">Yied Pozi</a></span>
</body>
</html>
