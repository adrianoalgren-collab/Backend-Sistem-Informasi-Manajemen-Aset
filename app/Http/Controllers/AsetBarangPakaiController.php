<?php

namespace App\Http\Controllers;

use App\Models\AsetBarangPakai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsetBarangPakaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AsetBarangPakai::with('manufacturer')
            ->latest()
            ->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_asetbarangpakai' => 'required|string|max:50|unique:aset_barang_pakai,kode_asetbarangpakai',
            'nama_asetbarangpakai' => 'required|string|max:255',
            'kategori_asetbarangpakai' => 'required|string|max:255',
            'kondisi_asetbarangpakai' => 'required|in:Baik,Rusak Ringan,Rusak Berat,Dalam Perbaikan,Tidak Digunakan',
            'lokasi_asetbarangpakai' => 'required|string|max:255',
            'stok_asetbarangpakai' => 'required|integer|min:0',
            'satuan_asetbarangpakai' => 'required|string|max:100',
            'foto_asetbarangpakai' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_manufacturer' => 'nullable|exists:manufacturers,id_manufacturer',
        ]);

        if ($request->hasFile('foto_asetbarangpakai')) {
            $validated['foto_asetbarangpakai'] = $request
                ->file('foto_asetbarangpakai')
                ->store('aset_barang_pakai', 'public');
        }

        $data = AsetBarangPakai::create($validated);

        return response()->json([
            'message' => 'Data aset barang pakai berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = AsetBarangPakai::with('manufacturer')
            ->findOrFail($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = AsetBarangPakai::findOrFail($id);

        $validated = $request->validate([
            'kode_asetbarangpakai' => 'required|string|max:50|unique:aset_barang_pakai,kode_asetbarangpakai,' . $id . ',id_barang_pakai',
            'nama_asetbarangpakai' => 'required|string|max:255',
            'kategori_asetbarangpakai' => 'required|string|max:255',
            'kondisi_asetbarangpakai' => 'required|in:Baik,Rusak Ringan,Rusak Berat,Dalam Perbaikan,Tidak Digunakan',
            'lokasi_asetbarangpakai' => 'required|string|max:255',
            'stok_asetbarangpakai' => 'required|integer|min:0',
            'satuan_asetbarangpakai' => 'required|string|max:100',
            'foto_asetbarangpakai' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_manufacturer' => 'nullable|exists:manufacturers,id_manufacturer',
        ]);

        if ($request->hasFile('foto_asetbarangpakai')) {
            if ($data->foto_asetbarangpakai && Storage::disk('public')->exists($data->foto_asetbarangpakai)) {
                Storage::disk('public')->delete($data->foto_asetbarangpakai);
            }

            $validated['foto_asetbarangpakai'] = $request
                ->file('foto_asetbarangpakai')
                ->store('aset_barang_pakai', 'public');
        }

        $data->update($validated);

        return response()->json([
            'message' => 'Data aset barang pakai berhasil diperbarui',
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = AsetBarangPakai::findOrFail($id);

        if ($data->foto_asetbarangpakai && Storage::disk('public')->exists($data->foto_asetbarangpakai)) {
            Storage::disk('public')->delete($data->foto_asetbarangpakai);
        }

        $data->delete();

        return response()->json([
            'message' => 'Data aset barang pakai berhasil dihapus'
        ]);
    }
}