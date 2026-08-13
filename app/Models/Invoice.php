<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    // 1. Daftarkan nama kolom database yang diizinkan untuk diisi secara massal
    protected $fillable = [
        'pet_id', 
        'nomor_invoice', 
        'biaya_layanan', 
        'biaya_tambahan', 
        'catatan_layanan', 
        'total_bayar'
    ];

    // 2. Hubungan Relasi: Setiap 1 Invoice ditujukan untuk 1 Pasien Hewan (Pet)
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }
}
