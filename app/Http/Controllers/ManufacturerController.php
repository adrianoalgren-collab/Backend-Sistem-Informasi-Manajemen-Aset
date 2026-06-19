<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    // ===============================
    // GET ALL
    // ===============================
    public function index()
    {
        $manufacturers = Manufacturer::with('asetOperasional')->get();
        $manufacturers = Manufacturer::withCount('asetOperasional')->get();

        return response()->json($manufacturers, 200);
    }

    // ===============================
    // STORE
    // ===============================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_manufacturer' => 'required|string|max:255',
            'email_manufacturer' => 'nullable|email',
            'telfon_manufacturer' => 'nullable|string|max:20'
        ]);

        $manufacturer = Manufacturer::create($validated);

        return response()->json([
            'message' => 'Manufacturer berhasil ditambahkan',
            'data' => $manufacturer
        ], 201);
    }

    // ===============================
    // SHOW
    // ===============================
    public function show($id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($manufacturer, 200);
    }

    // ===============================
    // UPDATE
    // ===============================
    public function update(Request $request, $id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama_manufacturer' => 'required|string|max:255',
            'email_manufacturer' => 'nullable|email',
            'telfon_manufacturer' => 'nullable|string|max:20'
        ]);

        $manufacturer->update($validated);

        return response()->json([
            'message' => 'Manufacturer berhasil diupdate',
            'data' => $manufacturer
        ], 200);
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);

        if (!$manufacturer) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $manufacturer->delete();

        return response()->json([
            'message' => 'Manufacturer berhasil dihapus'
        ], 200);
    }
}