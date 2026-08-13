<x-app-layout>
<!-- Bungkus dengan AlpineJS untuk kontrol pembukaan jendela pop-up modal kasir -->
<div class="max-w-5xl mx-auto mt-6" x-data="{ 
    openKasir: false, 
    selectedPetId: '', 
    selectedPet: '', 
    selectedService: '',
    estimatedCost: 0
}">
    
    <!-- NOTIFIKASI SUKSES JIKA TRANSAKSI BERHASIL -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-6 p-4 bg-emerald-100 border border-emerald-400 text-emerald-700 rounded-lg shadow flex items-center justify-between">
            <span class="font-medium">✨ {{ session('success') }}</span>
        </div>
    @endif

    <!-- TABEL UTAMA KASIR -->
    <div class="bg-white rounded-2xl p-8 shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-emerald-700">💵 Kasir Pembayaran</h1>
                <p class="text-sm text-gray-500 mt-1">Pilih pasien terdaftar di bawah ini untuk memproses pembayaran dan cetak invoice struk.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-50 text-left text-gray-600 font-semibold border-b">
                        <th class="p-4 text-center">No</th>
                        <th class="p-4">Nama Pasien</th>
                        <th class="p-4">Nama Pemilik</th>
                        <th class="p-4">Layanan Medis</th>
                        <th class="p-4">Keluhan</th>
                        <th class="p-4 text-center">Aksi Keuangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($daftarPasien as $key => $pasien)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-center font-medium text-gray-500">{{ $key + 1 }}</td>
                            <td class="p-4 font-bold text-emerald-700">
                                {{ $pasien->name }} 
                                <span class="text-xs font-normal text-gray-400">({{ $pasien->species }})</span>
                            </td>
                            <td class="p-4 text-gray-700">{{ $pasien->owner->name ?? 'Tidak ada data' }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    {{ $pasien->service == 'Grooming' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $pasien->service == 'Rawat Jalan' ? 'bg-amber-100 text-amber-800' : '' }}
                                    {{ $pasien->service == 'Rawat Inap' ? 'bg-purple-100 text-purple-800' : '' }}">
                                    {{ $pasien->service }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-500 max-w-xs truncate">{{ $pasien->complaint }}</td>
                            
                            <!-- TOMBOL MEMBUAT POP-UP KASIR MUNCUL -->
                            <td class="p-4 text-center">
                                <button @click="
                                    openKasir = true; 
                                    selectedPetId = '{{ $pasien->id }}'; 
                                    selectedPet = '{{ $pasien->name }} (Pemilik: {{ $pasien->owner->name ?? '-' }})'; 
                                    selectedService = '{{ $pasien->service }}';
                                    estimatedCost = '{{ $pasien->service }}' === 'Grooming' ? 50000 : ('{{ $pasien->service }}' === 'Rawat Jalan' ? 100000 : 250000);
                                " class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-xs font-bold shadow transition">
                                    💰 Hitung & Cetak Struk
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-gray-400 italic">Belum ada data pasien dari bagian pelayanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- JENDELA POP-UP MODAL HITUNG TRANSAKSI (PERBAIKAN STRUKTUR TOTAL) -->
    <div x-show="openKasir" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" x-cloak x-transition>
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl" @click.away="openKasir = false">
            
            <div class="flex items-center justify-between mb-4 border-b pb-2">
                <h3 class="text-xl font-bold text-gray-800">📋 Rincian Pembayaran</h3>
                <button @click="openKasir = false" class="text-gray-400 hover:text-gray-600 text-2xl font-bold">&times;</button>
            </div>

            <form action="{{ route('kasir.store') }}" method="POST">
                @csrf
                <!-- Mengirim ID Pasien secara tersembunyi ke Controller -->
                <input type="hidden" name="pet_id" :value="selectedPetId">

                <div class="mb-4 bg-gray-50 p-3 rounded-lg border border-gray-200">
                    <p class="text-xs text-gray-400 uppercase tracking-wider">Pasien / Pemilik:</p>
                    <p class="font-bold text-gray-800 text-base mt-0.5" x-text="selectedPet"></p>
                    <p class="text-xs text-emerald-700 font-semibold mt-1">
                        Tarif Dasar Layanan: <span x-text="selectedService"></span> (Rp <span x-text="estimatedCost.toLocaleString('id-ID')"></span>)
                    </p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Biaya Tambahan Obat / Vitamin (Rp)</label>
                    <input type="number" name="biaya_tambahan" value="0" class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 outline-none focus:ring-2 focus:ring-emerald-500" required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Catatan Medis & Resep Dokter</label>
                    <textarea name="catatan_layanan" rows="4" placeholder="Contoh: Pembelian obat puyer racikan 3x sehari dan salep jamur." class="w-full border border-gray-300 rounded-lg p-2.5 mt-1 outline-none focus:ring-2 focus:ring-emerald-500"></textarea>
                </div>

                <div class="flex justify-end gap-3 border-t pt-4">
                    <button type="button" @click="openKasir = false" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-gray-200 transition">Batal</button>
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg font-semibold text-sm shadow transition">Simpan & Cetak Invoice</button>
                </div>
            </form>

        </div>
    </div>

</div>
</x-app-layout>
