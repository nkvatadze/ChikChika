<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://kit.fontawesome.com/310f4c2ddd.js" crossorigin="anonymous"></script>
    @livewireStyles
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 grid grid-cols-4 auto-cols-max">

    <div class="col-span-1">
        @include('partials.navigation')
    </div>

    <div class="col-span-3">
        @if(isset($header))
            <header class="fixed bg-white w-full top-0 h-20 border-l border-gray-100 px-14 py-4">
                {{ $header }}
                <livewire:search/>
            </header>
        @endif
        <main class="col-span-3 @if(isset($header)) mt-24 @endif">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    @stack('scripts')
</div>
</body>
</html>
