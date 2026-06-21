<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestPemakaian;
use App\Models\AsetBarangPakai;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RequestPemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = RequestPemakaian::with(['department', 'user', 'barangPakai'])
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Daftar request pemakaian',
            'data'    => $requests
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'tanggal_request' =>
                'required|date',

            'id_barang_pakai' =>
                'required|exists:aset_barang_pakai,id_barang_pakai',

            'jumlah_pemakaian' =>
                'required|integer|min:1',

            'keterangan_pemakaian' =>
                'required|string',

            'id_department' =>
                'required|exists:department,id_department',

            'id_user' =>
                'required|exists:users,id',

            'file_request' =>
                'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        /*
        =========================================
        Upload File
        =========================================
        */
        $filePath = $request->file('file_request')
            ->store('request_pemakaian', 'public');

        /*
        =========================================
        Create Request Pemakaian
        =========================================
        */
        $requestPemakaian = RequestPemakaian::create([

            'tanggal_request' =>
                $validated['tanggal_request'],

            'id_barang_pakai' =>
                $validated['id_barang_pakai'],

            'jumlah_pemakaian' =>
                $validated['jumlah_pemakaian'],

            'keterangan_pemakaian' =>
                $validated['keterangan_pemakaian'],

            'id_department' =>
                $validated['id_department'],

            'id_user' =>
                $validated['id_user'],

            'file_request' =>
                $filePath,

            'status_approval' =>
                'Pending',

            'catatan_manager' =>
                null,
        ]);

        $requestPemakaian->load(['department', 'user', 'barangPakai']);

        return response()->json([
            'message' => 'Request pemakaian berhasil dibuat',
            'data'    => $requestPemakaian
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $requestPemakaian = RequestPemakaian::with(['department', 'user', 'barangPakai'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail request pemakaian',
            'data'    => $requestPemakaian
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([

            'status_approval' =>
                'sometimes|required|in:Pending,Approved,Rejected',

            'catatan_manager' =>
                'nullable|string',
        ]);

        return DB::transaction(function () use ($validated, $id) {

            /*
            =========================================
            Lock Row Request Pemakaian
            =========================================
            */
            $requestPemakaian = RequestPemakaian::lockForUpdate()
                ->findOrFail($id);

            $statusSebelumnya = $requestPemakaian->status_approval;
            $statusBaru = $validated['status_approval'] ?? $statusSebelumnya;

            /*
            =========================================
            Auto Kurangi Stok Barang Pakai
            (hanya saat transisi ke Approved, bukan saat
            sudah Approved sebelumnya, supaya stok tidak
            terpotong dua kali)
            =========================================
            */
            if (
                $statusBaru === 'Approved' &&
                $statusSebelumnya !== 'Approved'
            ) {
                $barangPakai = AsetBarangPakai::lockForUpdate()
                    ->find($requestPemakaian->id_barang_pakai);

                if (!$barangPakai) {
                    throw ValidationException::withMessages([
                        'id_barang_pakai' => 'Barang pakai tidak ditemukan.',
                    ]);
                }

                if ($barangPakai->stok_asetbarangpakai < $requestPemakaian->jumlah_pemakaian) {
                    throw ValidationException::withMessages([
                        'jumlah_pemakaian' => 'Stok tidak cukup untuk menyetujui pemakaian ini. Stok tersedia: ' . $barangPakai->stok_asetbarangpakai,
                    ]);
                }

                $barangPakai->decrement(
                    'stok_asetbarangpakai',
                    $requestPemakaian->jumlah_pemakaian
                );
            }

            $requestPemakaian->update($validated);

            $requestPemakaian->load(['department', 'user', 'barangPakai']);

            return response()->json([
                'message' => 'Request pemakaian berhasil diupdate',
                'data'    => $requestPemakaian
            ], 200);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $requestPemakaian = RequestPemakaian::find($id);

        if (!$requestPemakaian) {

            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        /*
        =========================================
        Hapus File
        =========================================
        */
        if ($requestPemakaian->file_request) {

            Storage::disk('public')
                ->delete($requestPemakaian->file_request);
        }

        $requestPemakaian->delete();

        return response()->json([
            'message' => 'Request pemakaian berhasil dihapus'
        ], 200);
    }
}