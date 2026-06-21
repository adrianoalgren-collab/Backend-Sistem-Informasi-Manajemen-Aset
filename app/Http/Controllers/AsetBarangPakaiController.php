<?php

namespace App\Http\Controllers;

use App\Models\AsetBarangPakai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsetBarangPakaiController extends Controller
{
    public function index()
    {
        $data = AsetBarangPakai::with('manufacturer')
            ->latest()
            ->get();

        return response()->json($data);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'kode_asetbarangpakai' => 'required|string|max:50|unique:aset_barang_pakai,kode_asetbarangpakai',
        'nama_asetbarangpakai' => 'required|string|max:255',
        'lokasi_asetbarangpakai' => 'required|string|max:255',
        'stok_asetbarangpakai' => 'required|integer|min:0',
        'satuan_asetbarangpakai' => 'required|string|max:100',
        'foto_asetbarangpakai' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'id_manufacturer' => 'nullable|exists:manufacturers,id_manufacturer',
    ]);

    if ($request->hasFile('foto_asetbarangpakai')) {
        $file = $request->file('foto_asetbarangpakai');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $validated['foto_asetbarangpakai'] = $file->storeAs('aset_barang_pakai', $filename, 'public');
    }

    $data = AsetBarangPakai::create($validated);

    return response()->json([
        'message' => 'Data aset barang pakai berhasil ditambahkan',
        'data' => $data
    ], 201);
}

    public function show($id)
    {
        $data = AsetBarangPakai::with('manufacturer')
            ->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data'   => $data,
        ]);
    }

    public function update(Request $request, $id)
{
    $data = AsetBarangPakai::findOrFail($id);

    $validated = $request->validate([
        'kode_asetbarangpakai' => 'required|string|max:50|unique:aset_barang_pakai,kode_asetbarangpakai,' . $id . ',id_barang_pakai',
        'nama_asetbarangpakai' => 'required|string|max:255',
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

        $file = $request->file('foto_asetbarangpakai');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $validated['foto_asetbarangpakai'] = $file->storeAs('aset_barang_pakai', $filename, 'public');
    }

    $data->update($validated);

    return response()->json([
        'message' => 'Data aset barang pakai berhasil diperbarui',
        'data' => $data
    ]);
}

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