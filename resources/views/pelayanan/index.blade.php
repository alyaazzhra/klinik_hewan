<x-app-layout>

<div
    class="w-full max-w-6xl mx-auto
           px-4 sm:px-6 lg:px-8
           py-6 md:py-8"
    x-data="{ tab: 'form' }">


    <!-- ===================================================== -->
    <!-- NOTIFIKASI SUKSES -->
    <!-- ===================================================== -->

    @if(session('success'))

        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"

            class="mb-6
                   p-4
                   bg-emerald-100
                   border border-emerald-300
                   text-emerald-700
                   rounded-2xl
                   shadow-sm
                   flex items-center justify-between">

            <span class="font-medium">
                ✨ {{ session('success') }}
            </span>

            <button
                @click="show = false"
                class="text-emerald-800 hover:text-emerald-500 font-bold text-xl">

                &times;

            </button>

        </div>

    @endif


    <!-- ===================================================== -->
    <!-- TAB -->
    <!-- ===================================================== -->

    <div
        class="bg-white
               rounded-2xl
               shadow-md
               overflow-hidden
               mb-6">

        <div class="flex">

            <!-- TAB FORM -->
            <button
                @click="tab = 'form'"

                :class="tab === 'form'
                    ? 'border-emerald-600 text-emerald-700 bg-emerald-50 font-bold'
                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'"

                class="flex-1
                       py-4
                       px-4 sm:px-6
                       text-center
                       border-b-2
                       font-medium
                       transition
                       text-sm sm:text-base
                       flex items-center
                       justify-center
                       gap-2">

                📝
                <span>
                    Isi Formulir Baru
                </span>

            </button>


            <!-- TAB PASIEN -->
            <button
                @click="tab = 'daftar'"

                :class="tab === 'daftar'
                    ? 'border-emerald-600 text-emerald-700 bg-emerald-50 font-bold'
                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'"

                class="flex-1
                       py-4
                       px-4 sm:px-6
                       text-center
                       border-b-2
                       font-medium
                       transition
                       text-sm sm:text-base
                       flex items-center
                       justify-center
                       gap-2">

                📋
                <span>
                    Pasien Sudah Terdaftar
                </span>

            </button>

        </div>

    </div>



    <!-- ===================================================== -->
    <!-- FORM PELAYANAN BARU -->
    <!-- ===================================================== -->

    <div
        x-show="tab === 'form'"
        x-transition

        class="bg-white
               rounded-2xl
               shadow-lg
               p-6 sm:p-8 md:p-10">


        <!-- JUDUL -->
        <div class="mb-8">

            <div class="flex items-center gap-3">

                <div
                    class="w-12 h-12
                           rounded-xl
                           bg-emerald-100
                           flex items-center justify-center
                           text-2xl">

                    🩺

                </div>

                <div>

                    <h1
                        class="text-2xl sm:text-3xl
                               font-bold
                               text-gray-800">

                        Form Pelayanan Baru

                    </h1>

                    <p class="text-gray-500 mt-1 text-sm">

                        Masukkan data pemilik dan hewan peliharaan.

                    </p>

                </div>

            </div>

        </div>



        <!-- ================================================= -->
        <!-- FORM -->
        <!-- ================================================= -->

        <form
            action="{{ route('pelayanan.store') }}"
            method="POST">

            @csrf


            <!-- ============================================= -->
            <!-- DATA PEMILIK -->
            <!-- ============================================= -->

            <div class="mb-10">

                <div class="flex items-center gap-2 mb-5">

                    <span
                        class="w-8 h-8
                               rounded-lg
                               bg-emerald-100
                               text-emerald-700
                               flex items-center justify-center">

                        👤

                    </span>

                    <h2
                        class="text-xl
                               font-semibold
                               text-gray-800">

                        Data Pemilik

                    </h2>

                </div>


                <div
                    class="grid
                           grid-cols-1
                           md:grid-cols-2
                           gap-5">


                    <!-- Nama -->
                    <div>

                        <label
                            class="block
                                   text-sm
                                   font-semibold
                                   text-gray-700
                                   mb-2">

                            Nama Lengkap

                        </label>

                        <input
                            type="text"
                            name="nama_pemilik"

                            class="w-full
                                   border border-gray-300
                                   rounded-xl
                                   px-4 py-3
                                   bg-gray-50
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-emerald-500
                                   outline-none
                                   transition"

                            placeholder="Masukkan nama pemilik..."
                            required>

                    </div>


                    <!-- WhatsApp -->
                    <div>

                        <label
                            class="block
                                   text-sm
                                   font-semibold
                                   text-gray-700
                                   mb-2">

                            Nomor WhatsApp

                        </label>

                        <input
                            type="text"
                            name="phone"

                            class="w-full
                                   border border-gray-300
                                   rounded-xl
                                   px-4 py-3
                                   bg-gray-50
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-emerald-500
                                   outline-none
                                   transition"

                            placeholder="08xxxxxxxxxx"
                            required>

                    </div>

                </div>


                <!-- Alamat -->
                <div class="mt-5">

                    <label
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2">

                        Alamat

                    </label>

                    <textarea
                        name="address"
                        rows="3"

                        class="w-full
                               border border-gray-300
                               rounded-xl
                               px-4 py-3
                               bg-gray-50
                               focus:bg-white
                               focus:ring-2
                               focus:ring-emerald-500
                               focus:border-emerald-500
                               outline-none
                               transition"

                        placeholder="Masukkan alamat lengkap..."
                        required></textarea>

                </div>

            </div>



            <!-- GARIS -->
            <div class="border-t border-gray-200 my-8"></div>



            <!-- ============================================= -->
            <!-- DATA HEWAN -->
            <!-- ============================================= -->

            <div class="mb-8">

                <div class="flex items-center gap-2 mb-5">

                    <span
                        class="w-8 h-8
                               rounded-lg
                               bg-emerald-100
                               text-emerald-700
                               flex items-center justify-center">

                        🐾

                    </span>

                    <h2
                        class="text-xl
                               font-semibold
                               text-gray-800">

                        Data Hewan

                    </h2>

                </div>


                <div
                    class="grid
                           grid-cols-1
                           md:grid-cols-2
                           gap-5">


                    <!-- Nama Hewan -->
                    <div>

                        <label
                            class="block
                                   text-sm
                                   font-semibold
                                   text-gray-700
                                   mb-2">

                            Nama Hewan

                        </label>

                        <input
                            type="text"
                            name="name"

                            class="w-full
                                   border border-gray-300
                                   rounded-xl
                                   px-4 py-3
                                   bg-gray-50
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-emerald-500
                                   outline-none
                                   transition"

                            placeholder="Contoh: Mochi"
                            required>

                    </div>


                    <!-- Spesies -->
                    <div>

                        <label
                            class="block
                                   text-sm
                                   font-semibold
                                   text-gray-700
                                   mb-2">

                            Spesies

                        </label>

                        <input
                            type="text"
                            name="species"

                            class="w-full
                                   border border-gray-300
                                   rounded-xl
                                   px-4 py-3
                                   bg-gray-50
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-emerald-500
                                   outline-none
                                   transition"

                            placeholder="Contoh: Kucing"
                            required>

                    </div>


                    <!-- Jenis Kelamin -->
                    <div>

                        <label
                            class="block
                                   text-sm
                                   font-semibold
                                   text-gray-700
                                   mb-2">

                            Jenis Kelamin

                        </label>

                        <select
                            name="gender"

                            class="w-full
                                   border border-gray-300
                                   rounded-xl
                                   px-4 py-3
                                   bg-gray-50
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-emerald-500
                                   outline-none
                                   transition"

                            required>

                            <option value="">
                                Pilih jenis kelamin
                            </option>

                            <option value="Jantan">
                                Jantan
                            </option>

                            <option value="Betina">
                                Betina
                            </option>

                        </select>

                    </div>


                    <!-- Ras -->
                    <div>

                        <label
                            class="block
                                   text-sm
                                   font-semibold
                                   text-gray-700
                                   mb-2">

                            Ras

                        </label>

                        <input
                            type="text"
                            name="breed"

                            class="w-full
                                   border border-gray-300
                                   rounded-xl
                                   px-4 py-3
                                   bg-gray-50
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-emerald-500
                                   outline-none
                                   transition"

                            placeholder="Contoh: Persia"
                            required>

                    </div>


                    <!-- Warna -->
                    <div>

                        <label
                            class="block
                                   text-sm
                                   font-semibold
                                   text-gray-700
                                   mb-2">

                            Warna

                        </label>

                        <input
                            type="text"
                            name="color"

                            class="w-full
                                   border border-gray-300
                                   rounded-xl
                                   px-4 py-3
                                   bg-gray-50
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-emerald-500
                                   outline-none
                                   transition"

                            placeholder="Contoh: Putih"
                            required>

                    </div>


                    <!-- Umur -->
                    <div>

                        <label
                            class="block
                                   text-sm
                                   font-semibold
                                   text-gray-700
                                   mb-2">

                            Umur

                        </label>

                        <input
                            type="number"
                            name="age"
                            min="0"

                            class="w-full
                                   border border-gray-300
                                   rounded-xl
                                   px-4 py-3
                                   bg-gray-50
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-emerald-500
                                   outline-none
                                   transition"

                            placeholder="Umur dalam tahun"
                            required>

                    </div>


                    <!-- Layanan -->
                    <div class="md:col-span-2">

                        <label
                            class="block
                                   text-sm
                                   font-semibold
                                   text-gray-700
                                   mb-2">

                            Layanan

                        </label>

                        <select
                            name="service"

                            class="w-full
                                   border border-gray-300
                                   rounded-xl
                                   px-4 py-3
                                   bg-gray-50
                                   focus:bg-white
                                   focus:ring-2
                                   focus:ring-emerald-500
                                   focus:border-emerald-500
                                   outline-none
                                   transition"

                            required>

                            <option value="Grooming">
                                Grooming
                            </option>

                            <option value="Rawat Jalan">
                                Rawat Jalan
                            </option>

                            <option value="Rawat Inap">
                                Rawat Inap
                            </option>

                        </select>

                    </div>

                </div>


                <!-- Keluhan -->
                <div class="mt-5">

                    <label
                        class="block
                               text-sm
                               font-semibold
                               text-gray-700
                               mb-2">

                        Keluhan

                    </label>

                    <textarea
                        name="complaint"
                        rows="4"

                        class="w-full
                               border border-gray-300
                               rounded-xl
                               px-4 py-3
                               bg-gray-50
                               focus:bg-white
                               focus:ring-2
                               focus:ring-emerald-500
                               focus:border-emerald-500
                               outline-none
                               transition"

                        placeholder="Tuliskan keluhan atau kondisi hewan..."
                        required></textarea>

                </div>

            </div>



            <!-- ============================================= -->
            <!-- BUTTON SIMPAN -->
            <!-- ============================================= -->

            <div
                class="flex
                       justify-end
                       pt-5
                       border-t
                       border-gray-200">

                <button
                    type="submit"

                    class="bg-emerald-600
                           hover:bg-emerald-700
                           text-white
                           px-8
                           py-3
                           rounded-xl
                           font-semibold
                           shadow-md
                           hover:shadow-lg
                           transition
                           duration-200
                           flex items-center gap-2">

                    💾
                    Simpan Data Pasien

                </button>

            </div>

        </form>

    </div>



    <!-- ===================================================== -->
    <!-- DAFTAR PASIEN -->
    <!-- ===================================================== -->

    <div
        x-show="tab === 'daftar'"
        x-transition
        x-cloak

        class="bg-white
               rounded-2xl
               shadow-lg
               p-6 sm:p-8 md:p-10">


        <div class="flex items-center gap-3 mb-6">

            <div
                class="w-12 h-12
                       rounded-xl
                       bg-emerald-100
                       flex items-center justify-center
                       text-2xl">

                📋

            </div>

            <div>

                <h2
                    class="text-2xl
                           font-bold
                           text-gray-800">

                    Riwayat Pendaftaran Pasien

                </h2>

                <p class="text-sm text-gray-500 mt-1">

                    Daftar pasien yang telah didaftarkan.

                </p>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table
                class="w-full
                       border border-gray-200
                       rounded-xl
                       overflow-hidden">

                <thead>

                    <tr
                        class="bg-emerald-50
                               text-left
                               text-gray-700
                               font-semibold
                               border-b">

                        <th class="p-4 text-center">
                            No
                        </th>

                        <th class="p-4">
                            Nama Pemilik
                        </th>

                        <th class="p-4">
                            No. Telepon
                        </th>

                        <th class="p-4">
                            Nama Hewan
                        </th>

                        <th class="p-4">
                            Spesies
                        </th>

                        <th class="p-4">
                            Layanan
                        </th>

                        <th class="p-4">
                            Keluhan
                        </th>

                        <th class="p-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody
                    class="divide-y divide-gray-200">

                    @forelse($daftarPasien as $key => $pasien)

                        <tr
                            class="hover:bg-emerald-50/50 transition">

                            <td
                                class="p-4
                                       text-center
                                       font-medium
                                       text-gray-500">

                                {{ $key + 1 }}

                            </td>


                            <td
                                class="p-4
                                       text-gray-700
                                       font-medium">

                                {{ $pasien->owner->name ?? 'Tidak ada data' }}

                            </td>


                            <td
                                class="p-4 text-gray-600">

                                {{ $pasien->owner->phone ?? '-' }}

                            </td>


                            <td
                                class="p-4
                                       font-bold
                                       text-emerald-700">

                                {{ $pasien->name }}

                            </td>


                            <td
                                class="p-4 text-gray-600">

                                {{ $pasien->species }}

                            </td>


                            <td class="p-4">

                                <span
                                    class="px-3 py-1
                                           text-xs
                                           font-semibold
                                           rounded-full

                                           {{ $pasien->service == 'Grooming'
                                                ? 'bg-blue-100 text-blue-800'
                                                : '' }}

                                           {{ $pasien->service == 'Rawat Jalan'
                                                ? 'bg-amber-100 text-amber-800'
                                                : '' }}

                                           {{ $pasien->service == 'Rawat Inap'
                                                ? 'bg-purple-100 text-purple-800'
                                                : '' }}">

                                    {{ $pasien->service }}

                                </span>

                            </td>


                            <td
                                class="p-4
                                       text-gray-500
                                       max-w-xs
                                       truncate">

                                {{ $pasien->complaint }}

                            </td>


                            <td
                                class="p-4
                                       text-center">

                                <div
                                    class="flex
                                           items-center
                                           justify-center
                                           gap-2">

                                    <!-- EDIT -->

                                    <a
                                        href="{{ route('pelayanan.edit', $pasien->id) }}"

                                        class="bg-amber-500
                                               hover:bg-amber-600
                                               text-white
                                               px-3
                                               py-1.5
                                               rounded-lg
                                               text-xs
                                               font-semibold
                                               shadow
                                               transition">

                                        ✏️ Edit

                                    </a>


                                    <!-- HAPUS -->

                                    <form
                                        action="{{ route('pelayanan.destroy', $pasien->id) }}"
                                        method="POST"

                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?')">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"

                                            class="bg-red-500
                                                   hover:bg-red-600
                                                   text-white
                                                   px-3
                                                   py-1.5
                                                   rounded-lg
                                                   text-xs
                                                   font-semibold
                                                   shadow
                                                   transition">

                                            🗑️ Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="p-12
                                       text-center
                                       text-gray-400
                                       italic">

                                Belum ada data pendaftaran pasien di database.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</x-app-layout>