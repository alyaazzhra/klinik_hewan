<x-app-layout>

    <!-- ================= DASHBOARD ================= -->

    <div class="max-w-7xl mx-auto px-6 md:px-10 lg:px-12 py-6">


        <!-- ================= WELCOME ================= -->

        <div
            class="relative overflow-hidden
                   bg-gradient-to-r from-emerald-100 via-green-50 to-teal-100
                   rounded-3xl
                   shadow-sm
                   border border-emerald-100
                   p-8 md:p-10">

            <!-- Dekorasi background -->
            <div
                class="absolute -right-10 -top-10
                       w-40 h-40
                       bg-emerald-200/40
                       rounded-full">
            </div>

            <div
                class="absolute -right-16 -bottom-20
                       w-52 h-52
                       bg-teal-200/30
                       rounded-full">
            </div>



<!-- ================= MENU ================= -->

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">


    <!-- ================= PELAYANAN ================= -->

    <div
        class="group
               bg-white
               rounded-3xl
               border border-emerald-100
               shadow-sm
               hover:shadow-xl
               hover:-translate-y-1
               transition-all duration-300
               p-8">

        <div class="px-2">

            <!-- ICON -->
            <div
                class="w-14 h-14
                       bg-emerald-100
                       text-emerald-600
                       rounded-2xl
                       flex items-center justify-center
                       text-3xl
                       group-hover:bg-emerald-200
                       group-hover:scale-105
                       transition-all duration-300">

                🩺

            </div>


            <!-- JUDUL -->
            <h2 class="text-xl font-bold text-gray-800 mt-5">

                Pelayanan

            </h2>


            <!-- DESKRIPSI -->
            <p class="text-gray-500 mt-2 text-sm leading-relaxed">

                Input data pemilik dan hewan serta
                kelola pelayanan klinik.

            </p>


            <!-- TOMBOL -->
            <div class="mt-6 flex justify-center">

                <a
                    href="{{ route('pelayanan') }}"
                    class="w-3/4">

                    <button
                        type="button"
                        class="w-full
                               bg-emerald-600
                               hover:bg-emerald-700
                               text-white
                               font-semibold
                               py-3
                               rounded-xl
                               shadow-sm
                               hover:shadow-md
                               transition-all duration-200">

                        Masuk

                    </button>

                </a>

            </div>

        </div>

    </div>



    <!-- ================= KASIR ================= -->

    <div
        class="group
               bg-white
               rounded-3xl
               border border-blue-100
               shadow-sm
               hover:shadow-xl
               hover:-translate-y-1
               transition-all duration-300
               p-8">

        <div class="px-2">

            <!-- ICON -->
            <div
                class="w-14 h-14
                       bg-blue-100
                       text-blue-600
                       rounded-2xl
                       flex items-center justify-center
                       text-3xl
                       group-hover:bg-blue-200
                       group-hover:scale-105
                       transition-all duration-300">

                💳

            </div>


            <!-- JUDUL -->
            <h2 class="text-xl font-bold text-gray-800 mt-5">

                Kasir

            </h2>


            <!-- DESKRIPSI -->
            <p class="text-gray-500 mt-2 text-sm leading-relaxed">

                Hitung pembayaran, kelola transaksi,
                dan cetak invoice.

            </p>


            <!-- TOMBOL -->
            <div class="mt-6 flex justify-center">

                <a
                    href="/kasir"
                    class="w-3/4">

                    <button
                        type="button"
                        class="w-full
                               bg-blue-600
                               hover:bg-blue-700
                               text-white
                               font-semibold
                               py-3
                               rounded-xl
                               shadow-sm
                               hover:shadow-md
                               transition-all duration-200">

                        Masuk

                    </button>

                </a>

            </div>

        </div>

    </div>



    <!-- ================= RIWAYAT ================= -->

    <div
        class="group
               bg-white
               rounded-3xl
               border border-orange-100
               shadow-sm
               hover:shadow-xl
               hover:-translate-y-1
               transition-all duration-300
               p-8">

        <div class="px-2">

            <!-- ICON -->
            <div
                class="w-14 h-14
                       bg-orange-100
                       text-orange-500
                       rounded-2xl
                       flex items-center justify-center
                       text-3xl
                       group-hover:bg-orange-200
                       group-hover:scale-105
                       transition-all duration-300">

                📄

            </div>


            <!-- JUDUL -->
            <h2 class="text-xl font-bold text-gray-800 mt-5">

                Riwayat

            </h2>


            <!-- DESKRIPSI -->
            <p class="text-gray-500 mt-2 text-sm leading-relaxed">

                Lihat transaksi dan riwayat pelayanan
                yang telah dilakukan.

            </p>


            <!-- TOMBOL -->
            <div class="mt-6 flex justify-center">

                <a
                    href="/transactions"
                    class="w-3/4">

                    <button
                        type="button"
                        class="w-full
                               bg-orange-500
                               hover:bg-orange-600
                               text-white
                               font-semibold
                               py-3
                               rounded-xl
                               shadow-sm
                               hover:shadow-md
                               transition-all duration-200">

                        Masuk

                    </button>

                </a>

            </div>

        </div>

    </div>


</div>


</div>


        </div>

    </div>

</x-app-layout>