<x-app-layout>
<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg p-8 mt-6 mb-12">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-amber-700">✏️ Edit Data Pelayanan Pasien</h1>
        <a href="{{ route('pelayanan') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold text-sm shadow">
            ⬅️ Kembali
        </a>
    </div>

    <form action="{{ route('pelayanan.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Wajib untuk proses Update data di Laravel -->

        <h2 class="text-xl font-semibold text-gray-700 mb-4">Data Pemilik</h2>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-600">Nama Lengkap Pemilik</label>
                <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik', $pasien->owner->name ?? '') }}" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Nomor WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone', $pasien->owner->phone ?? '') }}" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-sm font-medium text-gray-600">Alamat Pemilik</label>
            <textarea name="address" rows="3" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>{{ old('address', $pasien->owner->address ?? '') }}</textarea>
        </div>

        <hr class="my-8 border-gray-200">

        <h2 class="text-xl font-semibold text-gray-700 mb-4">Data Hewan</h2>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-600">Nama Hewan</label>
                <input type="text" name="name" value="{{ old('name', $pasien->name) }}" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Spesies</label>
                <input type="text" name="species" value="{{ old('species', $pasien->species) }}" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Jenis Kelamin</label>
                <select name="gender" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>
                    <option value="Jantan" {{ old('gender', $pasien->gender) == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="Betina" {{ old('gender', $pasien->gender) == 'Betina' ? 'selected' : '' }}>Betina</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Ras</label>
                <input type="text" name="breed" value="{{ old('breed', $pasien->breed) }}" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Warna</label>
                <input type="text" name="color" value="{{ old('color', $pasien->color) }}" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Umur</label>
                <input type="number" name="age" value="{{ old('age', $pasien->age) }}" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-600">Layanan</label>
                <select name="service" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>
                    <option value="Grooming" {{ old('service', $pasien->service) == 'Grooming' ? 'selected' : '' }}>Grooming</option>
                    <option value="Rawat Jalan" {{ old('service', $pasien->service) == 'Rawat Jalan' ? 'selected' : '' }}>Rawat Jalan</option>
                    <option value="Rawat Inap" {{ old('service', $pasien->service) == 'Rawat Inap' ? 'selected' : '' }}>Rawat Inap</option>
                </select>
            </div>
        </div>
        <div class="mt-5">
            <label class="block text-sm font-medium text-gray-600">Keluhan</label>
            <textarea name="complaint" rows="4" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 outline-none" required>{{ old('complaint', $pasien->complaint) }}</textarea>
        </div>
        <div class="mt-8 text-right">
            <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-3 rounded-lg font-semibold shadow-md transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
</x-app-layout>
