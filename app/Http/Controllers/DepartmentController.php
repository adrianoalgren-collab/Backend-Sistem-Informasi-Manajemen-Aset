<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with('users')->get();

        return response()->json($departments, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_department' => 'required|string|max:20|unique:department,kode_department',
            'nama_department' => 'required|string|max:100',
            'penanggungjawab_department' => 'required|string|max:100',
            'email_department' => 'nullable|email|max:100',
            'nomor_telepon_department' => 'nullable|string|max:20',
        ]);

        $department = Department::create($validated);

        return response()->json([
            'message' => 'Department berhasil dibuat',
            'data' => $department
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::with('users')
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail department',
            'data' => $department
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $department = Department::findOrFail($id);

        $validated = $request->validate([
            'kode_department' => 'sometimes|required|string|max:20|unique:department,kode_department,' . $id . ',id_department',
            'nama_department' => 'sometimes|required|string|max:100',
            'penanggungjawab_department' => 'sometimes|required|string|max:100',
            'email_department' => 'nullable|email|max:100',
            'nomor_telepon_department' => 'nullable|string|max:20',
        ]);

        $department->update($validated);

        return response()->json([
            'message' => 'Department berhasil diupdate',
            'data' => $department
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $department->delete();

        return response()->json([
            'message' => 'Department berhasil dihapus'
        ], 200);
    }
}