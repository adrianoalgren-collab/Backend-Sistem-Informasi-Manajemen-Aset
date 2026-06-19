<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\AsetKendaraan;
use App\Models\KendaraanHistory; // ✅ Nama model yang benar

class AsetKendaraanController extends Controller
{
    // ======================================================
    // INDEX
    // ======================================================

    public function index(Request $request): JsonResponse
    {
        $query = AsetKendaraan::with(['manufacturer', 'driver'])->latest();

        if ($request->filled('id_user')) {
            $query->where('id_user', $request->id_user);
        }

        if ($request->filled('kondisi_kendaraan')) {
            $query->byKondisi($request->kondisi_kendaraan);
        }

        return response()->json([
            'message' => 'Daftar aset kendaraan',
            'data'    => $query->get(),
        ], 200);
    }

    // ======================================================
    // STORE
    // ======================================================

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'kode_kendaraan'    => 'required|string|max:50|unique:aset_kendaraan,kode_kendaraan',
            'nama_kendaraan'    => 'required|string|max:100',
            'plat_kendaraan'    => 'required|string|max:20|unique:aset_kendaraan,plat_kendaraan',
            'kondisi_kendaraan' => 'required|string|in:' . implode(',', AsetKendaraan::kondisiOptions()),
            'id_manufacturer'   => 'required|exists:manufacturers,id_manufacturer',
            'id_user'           => 'nullable|exists:users,id',
        ]);

        $kendaraan = AsetKendaraan::create($validated);

        if (!empty($validated['id_user'])) {
            KendaraanHistory::create([
                'id_kendaraan'    => $kendaraan->id_kendaraan,
                'user_id'         => $validated['id_user'], 
                'tanggal_selesai' => null,
            ]);
        }

        $kendaraan->load(['manufacturer', 'driver']);

        return response()->json([
            'message' => 'Aset kendaraan berhasil dibuat',
            'data'    => $kendaraan,
        ], 201);
    }

    // ======================================================
    // SHOW
    // ======================================================

    public function show(string $id): JsonResponse
    {
        $kendaraan = AsetKendaraan::with(['manufacturer', 'driver', 'histories'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail aset kendaraan',
            'data'    => $kendaraan,
        ], 200);
    }

    // ======================================================
    // UPDATE
    // ======================================================

    public function update(Request $request, string $id): JsonResponse
    {
        $kendaraan = AsetKendaraan::findOrFail($id);

        $validated = $request->validate([
            'kode_kendaraan'    => 'sometimes|string|max:50|unique:aset_kendaraan,kode_kendaraan,' . $id . ',id_kendaraan',
            'nama_kendaraan'    => 'sometimes|string|max:100',
            'plat_kendaraan'    => 'sometimes|string|max:20|unique:aset_kendaraan,plat_kendaraan,' . $id . ',id_kendaraan',
            'kondisi_kendaraan' => 'sometimes|string|in:' . implode(',', AsetKendaraan::kondisiOptions()),
            'id_manufacturer'   => 'sometimes|exists:manufacturers,id_manufacturer',
            'id_user'           => 'nullable|exists:users,id',
        ]);

        if ($request->has('id_user') && is_null($request->id_user)) {

            KendaraanHistory::where('id_kendaraan', $id)
                ->whereNull('tanggal_selesai')
                ->update(['tanggal_selesai' => now()]);
        }

        elseif ($request->has('id_user') && !is_null($request->id_user)) {

            KendaraanHistory::where('id_kendaraan', $id)
                ->whereNull('tanggal_selesai')
                ->update(['tanggal_selesai' => now()]);

            // Buat history baru hanya jika driver berbeda
            if ((int) $request->id_user !== (int) $kendaraan->id_user) {
                KendaraanHistory::create([
                    'id_kendaraan'    => $id,
                    'user_id'         => $request->id_user, 
                    'tanggal_selesai' => null,
                ]);
            }
        }

        $kendaraan->update($validated);
        $kendaraan->load(['manufacturer', 'driver']);

        return response()->json([
            'message' => 'Aset kendaraan berhasil diupdate',
            'data'    => $kendaraan,
        ], 200);
    }

    // ======================================================
    // HISTORY
    // ======================================================

    public function history(string $id): JsonResponse
    {
        AsetKendaraan::withTrashed()->findOrFail($id);

        $history = KendaraanHistory::with('user')
            ->where('id_kendaraan', $id)
            ->orderBy('tanggal_assign', 'desc')
            ->get();

        return response()->json([
            'message' => 'History assignment kendaraan',
            'data'    => $history,
        ], 200);
    }

    // ======================================================
    // DESTROY
    // ======================================================

    public function destroy(string $id): JsonResponse
    {
        $kendaraan = AsetKendaraan::findOrFail($id);

        KendaraanHistory::where('id_kendaraan', $id)
            ->whereNull('tanggal_selesai')
            ->update(['tanggal_selesai' => now()]);

        $kendaraan->delete();

        return response()->json([
            'message' => 'Aset kendaraan berhasil dihapus',
        ], 200);
    }
}