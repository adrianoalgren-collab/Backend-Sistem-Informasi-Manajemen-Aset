<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestPengadaan;
use Illuminate\Support\Facades\Storage;

class RequestPengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = RequestPengadaan::with(['department', 'user'])
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Daftar request pengadaan',
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

            'nama_pengadaan' =>
                'required|string|max:100',

            'kategori_pengadaan' =>
                'required|string|max:100',

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
            ->store('request_pengadaan', 'public');

        /*
        =========================================
        Create Request Pengadaan
        =========================================
        */
        $requestPengadaan = RequestPengadaan::create([

            'tanggal_request' =>
                $validated['tanggal_request'],

            'nama_pengadaan' =>
                $validated['nama_pengadaan'],

            'kategori_pengadaan' =>
                $validated['kategori_pengadaan'],

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

        $requestPengadaan->load(['department', 'user']);

        return response()->json([
            'message' => 'Request pengadaan berhasil dibuat',
            'data'    => $requestPengadaan
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $requestPengadaan = RequestPengadaan::with(['department', 'user'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail request pengadaan',
            'data'    => $requestPengadaan
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestPengadaan = RequestPengadaan::findOrFail($id);

        $validated = $request->validate([

            'status_approval' =>
                'sometimes|required|in:Pending,Approved,Rejected',

            'catatan_manager' =>
                'nullable|string',
        ]);

        $requestPengadaan->update($validated);

        $requestPengadaan->load(['department', 'user']);

        return response()->json([
            'message' => 'Request pengadaan berhasil diupdate',
            'data'    => $requestPengadaan
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $requestPengadaan = RequestPengadaan::find($id);

        if (!$requestPengadaan) {

            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        /*
        =========================================
        Hapus File
        =========================================
        */
        if ($requestPengadaan->file_request) {

            Storage::disk('public')
                ->delete($requestPengadaan->file_request);
        }

        $requestPengadaan->delete();

        return response()->json([
            'message' => 'Request pengadaan berhasil dihapus'
        ], 200);
    }
}