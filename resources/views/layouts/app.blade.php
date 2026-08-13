<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VetCare POS</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body
    class="font-[Poppins] min-h-screen"
    style="
        margin: 0;
        background: linear-gradient(
            135deg,
            #ecfdf5 0%,
            #f0fdf4 45%,
            #d1fae5 100%
        );
    "
>


<!-- ===================================================== -->
<!-- LAYOUT UTAMA -->
<!-- ===================================================== -->

<div
    x-data="{ sidebarOpen: true }"
    class="min-h-screen flex">


    <!-- ================================================= -->
    <!-- SIDEBAR -->
    <!-- ================================================= -->

    <aside
        :class="sidebarOpen ? 'w-64' : 'w-20'"
        class="
            bg-white
            border-r
            border-emerald-100
            shadow-lg
            flex
            flex-col
            flex-shrink-0
            transition-all
            duration-300
            ease-in-out
        "
    >


        <!-- ============================================= -->
        <!-- LOGO SIDEBAR -->
        <!-- ============================================= -->

        <div
            class="
                h-20
                flex
                items-center
                justify-between
                px-4
                border-b
                border-gray-100
            "
        >

            <!-- Logo ketika sidebar terbuka -->
            <div
                x-show="sidebarOpen"
                x-transition
                class="overflow-hidden"
            >

                <h1
                    class="
                        text-2xl
                        font-bold
                        text-emerald-600
                        whitespace-nowrap
                    "
                >
                    🐾 VetCare POS
                </h1>

                <p
                    class="
                        text-xs
                        text-gray-500
                        mt-1
                        whitespace-nowrap
                    "
                >
                    Sistem Informasi Klinik Hewan
                </p>

            </div>


            <!-- Logo ketika sidebar tertutup -->
            <div
                x-show="!sidebarOpen"
                x-transition
                class="
                    text-2xl
                    mx-auto
                "
            >
                🐾
            </div>


            <!-- Tombol Sidebar -->
            <button
                type="button"
                @click="sidebarOpen = !sidebarOpen"
                class="
                    w-10
                    h-10
                    flex
                    items-center
                    justify-center
                    rounded-xl
                    text-gray-500
                    hover:bg-emerald-50
                    hover:text-emerald-600
                    transition
                "
            >
                ☰
            </button>

        </div>



        <!-- ============================================= -->
        <!-- MENU SIDEBAR -->
        <!-- ============================================= -->

        <nav
            class="
                flex-1
                px-3
                py-6
                space-y-2
            "
        >


            <!-- DASHBOARD -->

            <a
                href="{{ route('dashboard') }}"
                class="
                    flex
                    items-center
                    gap-4
                    px-4
                    py-3
                    rounded-xl
                    transition-all
                    duration-200

                    {{ request()->routeIs('dashboard')
                        ? 'bg-emerald-100 text-emerald-700 font-semibold shadow-sm'
                        : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-600'
                    }}
                "
            >

                <span
                    class="
                        text-xl
                        flex-shrink-0
                    "
                >
                    🏠
                </span>


                <span
                    x-show="sidebarOpen"
                    x-transition
                    class="whitespace-nowrap"
                >
                    Dashboard
                </span>

            </a>



            <!-- PELAYANAN -->

            <a
                href="{{ route('pelayanan') }}"
                class="
                    flex
                    items-center
                    gap-4
                    px-4
                    py-3
                    rounded-xl
                    transition-all
                    duration-200

                    {{ request()->routeIs('pelayanan')
                        ? 'bg-emerald-100 text-emerald-700 font-semibold shadow-sm'
                        : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-600'
                    }}
                "
            >

                <span
                    class="
                        text-xl
                        flex-shrink-0
                    "
                >
                    🩺
                </span>


                <span
                    x-show="sidebarOpen"
                    x-transition
                    class="whitespace-nowrap"
                >
                    Pelayanan
                </span>

            </a>



            <!-- KASIR -->

            <a
                href="/kasir"
                class="
                    flex
                    items-center
                    gap-4
                    px-4
                    py-3
                    rounded-xl
                    transition-all
                    duration-200
                    text-gray-700
                    hover:bg-emerald-50
                    hover:text-emerald-600
                "
            >

                <span
                    class="
                        text-xl
                        flex-shrink-0
                    "
                >
                    💳
                </span>


                <span
                    x-show="sidebarOpen"
                    x-transition
                    class="whitespace-nowrap"
                >
                    Kasir
                </span>

            </a>



            <!-- RIWAYAT -->

            <a
                href="/transactions"
                class="
                    flex
                    items-center
                    gap-4
                    px-4
                    py-3
                    rounded-xl
                    transition-all
                    duration-200
                    text-gray-700
                    hover:bg-emerald-50
                    hover:text-emerald-600
                "
            >

                <span
                    class="
                        text-xl
                        flex-shrink-0
                    "
                >
                    📄
                </span>


                <span
                    x-show="sidebarOpen"
                    x-transition
                    class="whitespace-nowrap"
                >
                    Riwayat
                </span>

            </a>


        </nav>



        <!-- ============================================= -->
        <!-- USER PROFILE & LOGOUT -->
        <!-- ============================================= -->

        <div
            class="
                border-t
                border-gray-100
                p-4
            "
        >

            <!-- PROFILE USER -->
            <div
                class="
                    flex
                    items-center
                    gap-3
                    mb-4
                    px-1
                "
            >

                <!-- ICON ORANG -->
                <div
                    class="
                        w-10
                        h-10
                        rounded-full
                        bg-emerald-100
                        text-emerald-600
                        flex
                        items-center
                        justify-center
                        text-xl
                        flex-shrink-0
                        shadow-sm
                    "
                    title="{{ Auth::user()->name }}"
                >
                    👤
                </div>


                <!-- NAMA ADMIN -->
                <div
                    x-show="sidebarOpen"
                    x-transition
                    class="overflow-hidden"
                >

                    <p
                        class="
                            text-sm
                            font-semibold
                            text-gray-700
                            whitespace-nowrap
                        "
                    >
                        {{ Auth::user()->name }}
                    </p>

                    <p
                        class="
                            text-xs
                            text-gray-400
                            mt-0.5
                            whitespace-nowrap
                        "
                    >
                        Administrator
                    </p>

                </div>

            </div>



            <!-- LOGOUT -->

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="
                        w-full
                        flex
                        items-center
                        justify-center
                        gap-2
                        bg-red-500
                        hover:bg-red-600
                        text-white
                        rounded-xl
                        py-2.5
                        shadow-sm
                        hover:shadow-md
                        transition
                    "
                >

                    <span>
                        🚪
                    </span>


                    <span
                        x-show="sidebarOpen"
                        x-transition
                    >
                        Logout
                    </span>

                </button>

            </form>

        </div>


    </aside>



    <!-- ================================================= -->
    <!-- AREA KANAN -->
    <!-- ================================================= -->

    <div
        class="
            flex-1
            min-w-0
            flex
            flex-col
        "
    >


        <!-- ============================================= -->
        <!-- HEADER -->
        <!-- ============================================= -->

        <header
            class="
                h-20
                bg-white
                border-b
                border-emerald-100
                shadow-sm
                flex
                items-center
                px-6
                md:px-8
                flex-shrink-0
            "
        >

            <div>

                <h2
                    class="
                        text-2xl
                        font-bold
                        text-gray-700
                    "
                >
                    Dashboard
                </h2>


                <p
                    class="
                        text-gray-500
                        text-sm
                        mt-1
                    "
                >
                    Selamat datang di VetCare POS
                </p>

            </div>

        </header>



        <!-- ============================================= -->
        <!-- CONTENT -->
        <!-- ============================================= -->

        <main
            class="
                flex-1
                p-6
                md:p-8
                overflow-auto
            "
        >

            {{ $slot }}

        </main>


    </div>


</div>


</body>

</html>