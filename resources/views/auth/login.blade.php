<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - Dokter Hewan Bersama drh Ade Tedi</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body style="margin: 0; min-height: 100vh;">

    <!-- BACKGROUND -->
    <div
        style="
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
            background: linear-gradient(
                135deg,
                #a7f3d0 0%,
                #ecfdf5 50%,
                #6ee7b7 100%
            );
        "
    >

        <!-- LOGIN CARD -->
        <div
            style="
                width: 100%;
                max-width: 430px;
                box-sizing: border-box;
                background: white;
                border-radius: 24px;
                padding: 40px;
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            "
        >

<!-- LOGO -->
            <div
                style="
                    display: flex;
                    justify-content: center;
                    margin-bottom: 20px;
                "
            >
                <img 
                    src="{{ asset('images/logo.jpg') }}" 
                    alt="Logo Klinik"
                    style="
                        width: 80px;
                        height: 80px;
                        border-radius: 50%;
                        object-fit: cover;
                        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
                    "
                >
            </div>


            <!-- TITLE -->
            <div style="text-align: center; margin-bottom: 30px;">

                <h1
                    style="
                        margin: 0;
                        font-size: 30px;
                        font-weight: 700;
                        color: #059669;
                    "
                >
                    Dokter Hewan Bersama drh Ade Tedi
                </h1>

                <p
                    style="
                        margin-top: 8px;
                        color: #6b7280;
                        font-size: 14px;
                    "
                >
                    Sistem Informasi Klinik Hewan
                </p>

            </div>


            <!-- ERROR -->
            @if ($errors->any())

                <div
                    style="
                        background: #fef2f2;
                        border: 1px solid #fecaca;
                        color: #dc2626;
                        border-radius: 12px;
                        padding: 12px;
                        margin-bottom: 20px;
                        font-size: 14px;
                    "
                >

                    {{ $errors->first() }}

                </div>

            @endif


            <!-- FORM -->
            <form method="POST" action="{{ route('login') }}">

                @csrf


                <!-- EMAIL -->
                <div style="margin-bottom: 20px;">

                    <label
                        for="email"
                        style="
                            display: block;
                            margin-bottom: 8px;
                            font-size: 14px;
                            font-weight: 600;
                            color: #374151;
                        "
                    >
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="Masukkan email..."
                        style="
                            width: 100%;
                            box-sizing: border-box;
                            padding: 12px 16px;
                            border: 1px solid #d1d5db;
                            border-radius: 12px;
                            font-size: 14px;
                            outline: none;
                            background: #f9fafb;
                        "
                    >

                </div>


                <!-- PASSWORD -->
                <div style="margin-bottom: 20px;">

                    <label
                        for="password"
                        style="
                            display: block;
                            margin-bottom: 8px;
                            font-size: 14px;
                            font-weight: 600;
                            color: #374151;
                        "
                    >
                        Password
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan password..."
                        style="
                            width: 100%;
                            box-sizing: border-box;
                            padding: 12px 16px;
                            border: 1px solid #d1d5db;
                            border-radius: 12px;
                            font-size: 14px;
                            outline: none;
                            background: #f9fafb;
                        "
                    >

                </div>


                <!-- REMEMBER -->
                <div
                    style="
                        display: flex;
                        align-items: center;
                        margin-bottom: 24px;
                    "
                >

                    <input
                        id="remember"
                        type="checkbox"
                        name="remember"
                        style="
                            width: 16px;
                            height: 16px;
                            accent-color: #059669;
                        "
                    >

                    <label
                        for="remember"
                        style="
                            margin-left: 8px;
                            font-size: 14px;
                            color: #6b7280;
                        "
                    >
                        Remember Me
                    </label>

                </div>


                <!-- LOGIN BUTTON -->
                <button
                    type="submit"
                    style="
                        width: 100%;
                        border: none;
                        padding: 13px;
                        border-radius: 12px;
                        background: #059669;
                        color: white;
                        font-size: 15px;
                        font-weight: 600;
                        cursor: pointer;
                        box-shadow: 0 8px 15px rgba(5, 150, 105, 0.25);
                    "
                >
                    Login
                </button>

            </form>


            <!-- FOOTER -->
            <div
                style="
                    text-align: center;
                    margin-top: 25px;
                    font-size: 12px;
                    color: #9ca3af;
                "
            >
                © {{ date('Y') }} VetCare POS
            </div>

        </div>

    </div>

</body>

</html>