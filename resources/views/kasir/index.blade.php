<x-app-layout>
    <!-- Bungkus dengan AlpineJS untuk kontrol modal -->
    <div class="max-w-5xl mx-auto mt-6" x-data="{ 
        openKasir: false, 
        selectedPetId: '', 
        selectedPet: '', 
        selectedService: '',
        estimatedCost: 0
    }">
        
        <!-- NOTIFIKASI SUKSES -->
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
                                
                                <td class="p-4 text-center">
                                    <button type="button" @click="
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

        <!-- JENDELA POP-UP MODAL FULL SCREEN -->
        <template x-teleport="body">
            <div x-show="openKasir" 
                 class="fixed inset-0 z-50 bg-white overflow-y-auto" 
                 x-cloak 
                 x-transition>
                
                <div class="w-full min-h-screen p-6 sm:p-10 flex flex-col justify-between max-w-7xl mx-auto">
                    <div>
                        <!-- HEADER MODAL -->
                        <div class="flex items-center justify-between mb-6 border-b pb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">📋 Rincian Pembayaran</h3>
                                <p class="text-sm text-gray-500 mt-0.5">Lengkapi data transaksi kasir di bawah ini.</p>
                            </div>
                            <button type="button" @click="openKasir = false" class="text-gray-400 hover:text-gray-600 text-3xl font-bold leading-none p-2">&times;</button>
                        </div>

                        <!-- FORM SUBMIT -->
                        <form action="{{ route('kasir.store') }}" method="POST" target="_blank" @submit="setTimeout(() => openKasir = false, 500)" class="space-y-6">
                            @csrf
                            <input type="hidden" name="pet_id" :value="selectedPetId">

                            <!-- INFORMASI PASIEN / PEMILIK -->
                            <div class="bg-emerald-50/80 p-5 rounded-2xl border border-emerald-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div>
                                    <p class="text-xs font-bold text-emerald-800 uppercase tracking-wider">Pasien / Pemilik:</p>
                                    <p class="font-bold text-gray-800 text-lg mt-0.5" x-text="selectedPet"></p>
                                </div>
                                <div class="bg-white px-4 py-2 rounded-xl border border-emerald-200 text-right">
                                    <p class="text-xs text-gray-500 font-medium">Tarif Dasar Layanan (<span x-text="selectedService"></span>):</p>
                                    <p class="text-lg font-bold text-emerald-700">Rp <span x-text="Number(estimatedCost).toLocaleString('id-ID')"></span></p>
                                </div>
                            </div>

                            <!-- BIAYA TAMBAHAN -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Biaya Tambahan Obat / Vitamin (Rp)</label>
                                <input type="number" name="biaya_tambahan" value="0" min="0" class="w-full border border-gray-300 rounded-xl p-3 text-base outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" required>
                            </div>

                            <!-- CATATAN MEDIS -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Medis & Resep Dokter</label>
                                <textarea name="catatan_layanan" rows="6" placeholder="Contoh: Pembelian obat puyer racikan 3x sehari dan salep jamur." class="w-full border border-gray-300 rounded-xl p-3 text-base outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"></textarea>
                            </div>

                            <!-- FOOTER TOMBOL AKSI -->
                            <div class="flex items-center justify-end gap-3 border-t pt-6 mt-8">
                                <button type="button" @click="openKasir = false" class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl font-semibold text-sm hover:bg-gray-200 transition">Batal</button>
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-semibold text-sm shadow-lg transition">Simpan & Cetak Invoice</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>

    </div>
</x-app-layout>