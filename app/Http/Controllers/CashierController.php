<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;     // Menghubungkan ke data Pasien Hewan
use App\Models\Invoice; // Menghubungkan ke data Keuangan Invoice
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    // 1. Menampilkan Tabel Pasien Pelayanan di Menu Kasir
    public function index()
    {
        $daftarPasien = Pet::with('owner')->latest()->get();
        return view('kasir.index', compact('daftarPasien'));
    }

    // 2. Memproses Perhitungan Biaya Uang dan Menyimpan Transaksi
    public function store(Request $request)
    {
        $request->validate([
            'pet_id'          => 'required|exists:pets,id',
            'biaya_tambahan'  => 'required|integer|min:0',
            'catatan_layanan' => 'nullable|string',
        ]);

        $pet = Pet::findOrFail($request->pet_id);
        
        // Atur nominal tarif dasar klinik otomatis berdasarkan data pelayanan
        $biayaLayanan = 0;
        if ($pet->service == 'Grooming') {
            $biayaLayanan = 50000;
        } elseif ($pet->service == 'Rawat Jalan') {
            $biayaLayanan = 100000;
        } elseif ($pet->service == 'Rawat Inap') {
            $biayaLayanan = 250000;
        }

        $totalBayar = $biayaLayanan + $request->biaya_tambahan;
        $nomorInvoice = 'INV-' . date('Ymd') . '-' . rand(100, 999);

        // Bungkus proses insert dengan Database Transaction agar aman
        $invoice = DB::transaction(function () use ($request, $biayaLayanan, $totalBayar, $nomorInvoice) {
            return Invoice::create([
                'pet_id'          => $request->pet_id,
                'nomor_invoice'   => $nomorInvoice,
                'biaya_layanan'   => $biayaLayanan,
                'biaya_tambahan'  => $request->biaya_tambahan,
                'catatan_layanan' => $request->catatan_layanan,
                'total_bayar'     => $totalBayar,
            ]);
        });

        // Dialihkan kembali ke halaman kasir dengan membawa info sukses dan ID Invoice untuk dicetak
        return redirect()->route('kasir')->with([
            'success' => 'Transaksi pembayaran kasir berhasil disimpan!',
            'print_id' => $invoice->id
        ]);
    }

    // 3. Menampilkan Halaman Khusus Cetak Nota Struk Thermal Mini
    public function print($id)
    {
        $invoice = Invoice::with('pet.owner')->findOrFail($id);
        return view('kasir.print', compact('invoice'));
    }

        // 4. BARU: Fungsi untuk menarik seluruh rekapan data riwayat /transactions
    public function riwayat()
    {
        $daftarInvoice = Invoice::with('pet.owner')->latest()->get();
        
        // PERBAIKAN: Mengubah 'kasir.riwayat' menjadi 'kasir.transaction'
        return view('kasir.transaction', compact('daftarInvoice'));
    }
}


