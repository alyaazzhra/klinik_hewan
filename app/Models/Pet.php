<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'owner_id', 'name', 'species', 'gender', 
        'breed', 'color', 'age', 'service', 'complaint'
    ];

    // Hubungan relasi: Setiap hewan peliharaan dimiliki oleh seorang Owner
    public function owner()
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }
}
