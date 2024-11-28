<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MahasiswaController extends Controller
{
    public function index()
    {
        // Mengambil semua data mahasiswa menggunakan query builder
        $mahasiswa = DB::table('tb_mahasiswa')->get();
        return response()->json($mahasiswa);
    }
    
    public function tampil($nim)
    {
        $mahasiswa = DB::table('tb_mahasiswa')->where('nim', $nim)->first();

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }
        return response()->json($mahasiswa);
    }
    

    public function tambah(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'nama_lengkap' => 'required',
            'prodi' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);
        $existingNim = DB::table('tb_mahasiswa')->where('nim', $request->nim)->exists();

        if ($existingNim) {
            return response()->json([
                'message' => 'NIM sudah terdaftar.'
            ], 400);
        }
        $inserted = DB::table('tb_mahasiswa')->insert([
            'nim' => $request->nim,
            'nama_lengkap' => $request->nama_lengkap,
            'prodi' => $request->prodi,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
           
        ]);
        if ($inserted) {
            return response()->json([
                'message' => 'Data mahasiswa berhasil ditambahkan.'
            ], 201);
        }
        return response()->json([
            'message' => 'Gagal menambahkan data mahasiswa.'
        ], 400);
    }


    public function edit(Request $request, $nim)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required',
            'prodi' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);
    
        $mahasiswa = DB::table('tb_mahasiswa')->where('nim', $nim)->first();
    
        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], 404);
        }
    
        $updateData = [
            'nama_lengkap' => $request->nama_lengkap,
            'prodi' => $request->prodi,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
            
        ];

        DB::table('tb_mahasiswa')->where('nim', $nim)->update($updateData);
        $updatedMahasiswa = DB::table('tb_mahasiswa')->where('nim', $nim)->first();
        return response()->json($updatedMahasiswa);
    }
    

    public function hapus($nim)
    {
        $mahasiswa = DB::table('tb_mahasiswa')->where('nim', $nim)->first();
        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }
        $deleted = DB::table('tb_mahasiswa')->where('nim', $nim)->delete();
        if ($deleted) {
            return response()->json(['message' => 'Mahasiswa Berhasil Dihapus']);
        }
        return response()->json(['message' => 'Gagal untuk delete mahasiswa'], 400);
    }
    
}