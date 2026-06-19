<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsetOperasional;

class AsetOperasionalController extends Controller
{
    // ======================================================
    // KONSTANTA PATH UPLOAD
    // ======================================================

    /*
        Harus sama dengan KodeBarangController::UPLOAD_PATH
        agar foto yang dihapus saat cascade delete
        ditemukan di path yang benar.
    */

    private const UPLOAD_PATH = 'uploads/aset';

    // ======================================================
    // HELPER: HAPUS FOTO FISIK
    // ======================================================

    private function hapusFoto(?string $filename): void
    {
        if (!$filename) return;

        $path = public_path(self::UPLOAD_PATH . '/' . $filename);

        if (file_exists($path)) {
            unlink($path);
        }
    }

    // ======================================================
    // INDEX
    // ======================================================

    public function index()
    {
        $aset_operasional = AsetOperasional::with([
            'manufacturer',
            'kodeBarang',
        ])->latest()->get();

        return response()->json([
            'message' => 'Daftar aset operasional',
            'data'    => $aset_operasional,
        ], 200);
    }

    // ======================================================
    // STORE
    // ======================================================

    /*
        Master aset hanya menyimpan:
        - nama_asetoperasional
        - id_manufacturer (opsional)

        Foto dan detail unit ada di tabel kode_barang.
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_asetoperasional' =>
                'required|string|max:100',

            'id_manufacturer' =>
                'nullable|exists:manufacturers,id_manufacturer',
        ]);

        $aset_operasional = AsetOperasional::create($validated);
        $aset_operasional->load(['manufacturer', 'kodeBarang']);

        return response()->json([
            'message' => 'Aset Operasional berhasil dibuat',
            'data'    => $aset_operasional,
        ], 201);
    }

    // ======================================================
    // SHOW
    // ======================================================

    public function show(string $id)
    {
        $aset_operasional = AsetOperasional::with([
            'manufacturer',
            'kodeBarang',
        ])->findOrFail($id);

        return response()->json([
            'message' => 'Detail aset operasional',
            'data'    => $aset_operasional,
        ], 200);
    }

    // ======================================================
    // UPDATE
    // ======================================================

    public function update(Request $request, string $id)
    {
        $aset_operasional = AsetOperasional::findOrFail($id);

        $validated = $request->validate([
            'nama_asetoperasional' =>
                'sometimes|required|string|max:100',

            'id_manufacturer' =>
                'nullable|exists:manufacturers,id_manufacturer',
        ]);

        $aset_operasional->update($validated);
        $aset_operasional->load(['manufacturer', 'kodeBarang']);

        return response()->json([
            'message' => 'Aset Operasional berhasil diupdate',
            'data'    => $aset_operasional,
        ], 200);
    }

    // ======================================================
    // DESTROY
    // ======================================================

    public function destroy(string $id)
    {
        $aset_operasional = AsetOperasional::with('kodeBarang')
            ->findOrFail($id);

        /*
            Hapus foto fisik semua unit (kode_barang) terlebih
            dahulu sebelum delete master.

            Meski database cascade menghapus record kode_barang
            secara otomatis, file foto di disk TIDAK ikut
            terhapus oleh cascade — harus dihapus manual di sini.
        */

        foreach ($aset_operasional->kodeBarang as $unit) {
            $this->hapusFoto($unit->foto_asetoperasional);
        }

        /*
            delete() akan memicu cascade di database:
            semua kode_barang yang berelasi ikut terhapus.
        */

        $aset_operasional->delete();

        return response()->json([
            'message' => 'Aset Operasional beserta semua unit berhasil dihapus',
        ], 200);
    }
}