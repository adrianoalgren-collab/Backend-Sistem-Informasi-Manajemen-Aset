<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestPerbaikan;
use Illuminate\Support\Facades\Storage;

class RequestPerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = RequestPerbaikan::with(['aset', 'kodeBarang', 'user'])
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Daftar request perbaikan',
            'data'    => $requests
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'id_operasional' =>
                'required|exists:aset_operasional,id_operasional',

            'id_kodebarang' =>
                'required|exists:kode_barang,id_kodebarang',

            'id_user' =>
                'required|exists:users,id',

            'file_request' =>
                'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $filePath = $request->file('file_request')
            ->store('request_perbaikan', 'public');

        $requestPerbaikan = RequestPerbaikan::create([
            'id_operasional'  => $validated['id_operasional'],
            'id_kodebarang'   => $validated['id_kodebarang'],
            'id_user'         => $validated['id_user'],
            'tanggal_request' => now(),
            'file_request'    => $filePath,
            'status_request'  => 'Pending',
        ]);

        $requestPerbaikan->load(['aset', 'kodeBarang', 'user']);

        return response()->json([
            'message' => 'Request perbaikan berhasil dibuat',
            'data'    => $requestPerbaikan
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $requestPerbaikan = RequestPerbaikan::with(['aset', 'kodeBarang', 'user'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail request perbaikan',
            'data'    => $requestPerbaikan
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestPerbaikan = RequestPerbaikan::findOrFail($id);

        $validated = $request->validate([

            'id_operasional' =>
                'sometimes|required|exists:aset_operasional,id_operasional',

            'id_kodebarang' =>
                'sometimes|required|exists:kode_barang,id_kodebarang',

            'status_request' =>
                'sometimes|required|in:Pending,Diterima,Ditolak',

            'catatan_admin' =>
                'nullable|string',

            'file_request' =>
                'sometimes|file|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('file_request')) {
            // Hapus file lama
            if ($requestPerbaikan->file_request) {
                Storage::disk('public')->delete($requestPerbaikan->file_request);
            }
            $validated['file_request'] = $request->file('file_request')
                ->store('request_perbaikan', 'public');
        }

        $requestPerbaikan->update($validated);

        $requestPerbaikan->load(['aset', 'kodeBarang', 'user']);

        return response()->json([
            'message' => 'Request perbaikan berhasil diupdate',
            'data'    => $requestPerbaikan
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $requestPerbaikan = RequestPerbaikan::find($id);

        if (!$requestPerbaikan) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        if ($requestPerbaikan->file_request) {
            Storage::disk('public')
                ->delete($requestPerbaikan->file_request);
        }

        $requestPerbaikan->delete();

        return response()->json([
            'message' => 'Request perbaikan berhasil dihapus'
        ], 200);
    }
}