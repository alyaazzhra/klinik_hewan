<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner; 
use App\Models\Pet;   
use Illuminate\Support\Facades\DB; 

class ServiceController extends Controller
{
    // 1. Menampilkan Halaman Form & Tabel Pasien
    public function index()
    {
        // Menarik data hewan beserta data pemiliknya
        $daftarPasien = Pet::with('owner')->latest()->get();

        // Mengirim data ke folder pelayanan file index.blade.php
        return view('pelayanan.index', compact('daftarPasien')); 
    }

    // 2. Memproses Tombol Simpan Formulir Baru
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'address'      => 'required|string',
            'name'         => 'required|string|max:255', 
            'species'      => 'required|string|max:255',
            'gender'       => 'required|string',
            'breed'        => 'required|string|max:255',
            'color'        => 'required|string|max:255',
            'age'          => 'required|integer',
            'service'      => 'required|in:Grooming,Rawat Jalan,Rawat Inap',
            'complaint'    => 'required|string',
        ]);

        // Proses simpan ganda menggunakan Database Transaction
        DB::transaction(function () use ($request) {
            
            $owner = Owner::create([
                'name'    => $request->nama_pemilik,
                'phone'   => $request->phone,
                'address' => $request->address,
            ]);

            Pet::create([
                'owner_id'  => $owner->id, 
                'name'      => $request->name,
                'species'   => $request->species,
                'gender'    => $request->gender,
                'breed'     => $request->breed,
                'color'     => $request->color,
                'age'       => $request->age,
                'service'   => $request->service,
                'complaint' => $request->complaint,
            ]);
            
        });

        return redirect()->route('pelayanan')->with('success', 'Pendaftaran pasien berhasil disimpan!');
    }

    // 3. Menampilkan Halaman Edit Data Pasien
    public function edit($id)
    {
        // Cari data hewan beserta pemiliknya berdasarkan ID
        $pasien = Pet::with('owner')->findOrFail($id);
        return view('pelayanan.edit', compact('pasien'));
    }

    // 4. Memproses Perubahan Data (Update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'address'      => 'required|string',
            'name'         => 'required|string|max:255', 
            'species'      => 'required|string|max:255',
            'gender'       => 'required|string',
            'breed'        => 'required|string|max:255',
            'color'        => 'required|string|max:255',
            'age'          => 'required|integer',
            'service'      => 'required|in:Grooming,Rawat Jalan,Rawat Inap',
            'complaint'    => 'required|string',
        ]);

        DB::transaction(function () use ($request, $id) {
            $pet = Pet::findOrFail($id);
            
            // Update data pemilik (owner)
            $pet->owner->update([
                'name'    => $request->nama_pemilik,
                'phone'   => $request->phone,
                'address' => $request->address,
            ]);

            // Update data hewan (pet)
            $pet->update([
                'name'      => $request->name,
                'species'   => $request->species,
                'gender'    => $request->gender,
                'breed'     => $request->breed,
                'color'     => $request->color,
                'age'       => $request->age,
                'service'   => $request->service,
                'complaint' => $request->complaint,
            ]);
        });

        return redirect()->route('pelayanan')->with('success', 'Data pasien berhasil diperbarui!');
    }

    // 5. Menghapus Data Pasien
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $pet = Pet::findOrFail($id);
            
            // Ambil ID owner terlebih dahulu sebelum data hewan dihapus
            $ownerId = $pet->owner_id;

            // Hapus data hewan
            $pet->delete();

            // Hapus data owner
            Owner::where('id', $ownerId)->delete();
        });

        return redirect()->route('pelayanan')->with('success', 'Data pasien berhasil dihapus!');
    }
}
