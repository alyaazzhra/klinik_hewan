<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dokter Hewan Bersama drh Ade Tedi</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen">

    <div
        class="min-h-screen flex items-center justify-center px-4"
        style="
            background: linear-gradient(
                135deg,
                #bbf7d0 0%,
                #ecfdf5 45%,
                #6ee7b7 100%
            );
        "
    >

        {{ $slot }}

    </div>

</body>

</html>