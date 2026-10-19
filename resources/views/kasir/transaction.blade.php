<x-app-layout>
<div class="max-w-5xl mx-auto mt-6 bg-white rounded-2xl shadow-lg p-8 mb-12">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">📜 Riwayat Transaksi Invoice</h1>
        <p class="text-sm text-gray-500 mt-1">Daftar rekapan pembukuan keuangan dan cetak ulang struk nota kasir Dokter Hewan Bersama drh Ade Tedi.</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-50 text-left border-b font-semibold text-gray-600">
                    <th class="p-4 text-center">No</th>
                    <th class="p-4">No. Invoice</th>
                    <th class="p-4">Tanggal Transaksi</th>
                    <th class="p-4">Nama Pasien & Pemilik</th>
                    <th class="p-4">Layanan Klinik</th>
                    <th class="p-4">Total Bayar</th>
                    <th class="p-4 text-center">Aksi Nota</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($daftarInvoice as $key => $invoice)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center font-medium text-gray-500">{{ $key + 1 }}</td>
                        <td class="p-4 font-mono text-sm text-gray-700 font-semibold">{{ $invoice->nomor_invoice }}</td>
                        <td class="p-4 text-sm text-gray-600">{{ $invoice->created_at->format('d-m-Y H:i') }} WIB</td>
                        <td class="p-4">
                            <span class="font-bold text-emerald-700">{{ $invoice->pet->name }}</span> <br>
                            <span class="text-xs text-gray-400">Pemilik: {{ $invoice->pet->owner->name ?? '-' }}</span>
                        </td>
                        <td class="p-4 text-sm text-gray-600">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                {{ $invoice->pet->service }}
                            </span>
                        </td>
                        <td class="p-4 font-bold text-gray-800">Rp {{ number_format($invoice->total_bayar, 0, ',', '.') }}</td>
                        <td class="p-4 text-center">
                            <!-- Tombol untuk cetak ulang nota struk kapan saja -->
                            <a href="{{ route('kasir.print', $invoice->id) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-xs font-semibold shadow transition whitespace-nowrap">
                                🖨️ Cetak Ulang
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-12 text-center text-gray-400 italic">Belum ada rekapan riwayat transaksi kasir di database.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
