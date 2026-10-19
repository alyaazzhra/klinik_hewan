<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - {{ $invoice->nomor_invoice }}</title>
    <style>
        body { 
            font-family: 'Courier New', Courier, monospace; 
            width: 320px; 
            margin: 20px auto; 
            padding: 15px; 
            font-size: 13px; 
            color: #000; 
            background: #fff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 8px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .line { border-top: 1px dashed #000; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 3px 0; vertical-align: top; }
        .bold { font-weight: bold; }
        
        /* Gaya untuk tombol cetak di layar */
        .btn-print {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #059669;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-print:hover { background-color: #047857; }

        /* Menyembunyikan tombol cetak saat proses print ke kertas fisik berjalan */
        @media print { 
            .no-print { display: none; } 
            body { box-shadow: none; margin: 0; padding: 0; width: 100%; }
        }
    </style>
</head>
<body>

    <div class="text-center">
        <h3 style="margin: 0 0 5px 0;">🐾 Dokter Hewan Bersama drh Ade Tedi 🐾</h3>
        <p style="margin: 0; font-size: 11px;">Sistem Informasi Klinik Hewan</p>
        <p style="margin: 0; font-size: 11px;">WhatsApp: 0821-545-6775</p>
    </div>

    <div class="line"></div>

    <table>
        <tr><td>No. Nota</td><td>: <span class="bold">{{ $invoice->nomor_invoice }}</span></td></tr>
        <tr><td>Tanggal</td><td>: {{ $invoice->created_at->format('d/m/Y H:i') }} WIB</td></tr>
        <tr><td>Pasien</td><td>: {{ $invoice->pet->name }} ({{ $invoice->pet->species }})</td></tr>
        <tr><td>Pemilik</td><td>: {{ $invoice->pet->owner->name ?? '-' }}</td></tr>
    </table>

    <div class="line"></div>

    <table style="margin-top: 5px;">
        <tr class="bold">
            <td>Deskripsi Layanan</td>
            <td class="text-right">Total</td>
        </tr>
        <tr>
            <td>[Paket] {{ $invoice->pet->service }}</td>
            <td class="text-right">Rp {{ number_format($invoice->biaya_layanan, 0, ',', '.') }}</td>
        </tr>
        @if($invoice->biaya_tambahan > 0)
        <tr>
            <td>Tambahan Obat/Vitamin</td>
            <td class="text-right">Rp {{ number_format($invoice->biaya_tambahan, 0, ',', '.') }}</td>
        </tr>
        @endif
    </table>

    <div class="line"></div>

    <table>
        <tr class="bold" style="font-size: 14px;">
            <td>TOTAL BAYAR</td>
            <td class="text-right">Rp {{ number_format($invoice->total_bayar, 0, ',', '.') }}</td>
        </tr>
    </table>

    @if($invoice->catatan_layanan)
        <div class="line"></div>
        <p class="bold" style="margin: 3px 0;">Catatan / Resep Medis Dokter:</p>
        <p style="margin: 0; font-size: 12px; font-style: italic; line-height: 1.4; color: #374151;">
            "{{ $invoice->catatan_layanan }}"
        </p>
    @endif

    <div class="line"></div>
    <p class="text-center" style="font-size: 11px; margin-top: 15px; color: #4b5563;">
        Terima Kasih Atas Kunjungan Anda<br>Semoga Si Anabul Sehat Selalu! ❤️
    </p>

    <!-- TOMBOL AKSI UTAMA DI LAYAR WEB -->
    <div class="no-print">
        <button onclick="window.print()" class="btn-print">
            🖨️ Cetak Struk Sekarang
        </button>
    </div>

</body>
</html>
