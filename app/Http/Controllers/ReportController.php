<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // ── ROLE CONSTANTS ───────────────────────────────────
    private const ROLE_ADMIN          = 1;
    private const ROLE_MANAGER        = 2;
    private const ROLE_STAFF_KANTOR   = 3;
    private const ROLE_STAFF_LAPANGAN = 4;
    private const ROLE_DRIVER         = 5;

    // ── HELPERS ──────────────────────────────────────────

    private function isAdmin(): bool
    {
        return auth()->user()->id_role === self::ROLE_ADMIN;
    }

    /**
     * Base query:
     * - Admin  → semua report
     * - Lainnya → hanya milik sendiri
     */
    private function baseQuery()
    {
        $query = Report::with('user');

        if (!$this->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

    // ── CRUD ─────────────────────────────────────────────

    /**
     * Admin   : semua report + filter opsional by status & user_id
     * Lainnya : hanya report milik sendiri
     */
    public function index(Request $request): JsonResponse
    {
        $query = $this->baseQuery()->latest('tanggal');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($this->isAdmin() && $request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        return response()->json([
            'message' => 'Daftar report',
            'data'    => $query->paginate(15)
        ]);
    }

    /**
     * Buat report baru.
     * Status dikunci 'pending' — tidak bisa diset bebas oleh user.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'judul'   => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file'    => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $filePath = $request->file('file')->store('reports', 'public');

            $report = Report::create([
                'judul'     => $validated['judul'],
                'tanggal'   => $validated['tanggal'],
                'status'    => 'pending', // user tidak bisa set status sendiri
                'file_path' => $filePath,
                'user_id'   => auth()->id(),
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();

            if (isset($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            return response()->json(['message' => 'Gagal menyimpan report'], 500);
        }

        return response()->json([
            'message' => 'Report berhasil dibuat',
            'data'    => $report
        ], 201);
    }

    /**
     * Detail report.
     * Admin   : bisa lihat milik siapapun
     * Lainnya : hanya milik sendiri
     */
    public function show(string $id): JsonResponse
    {
        $report = $this->baseQuery()->findOrFail($id);

        return response()->json([
            'message' => 'Detail report',
            'data'    => $report
        ]);
    }

    /**
     * Update report.
     * Admin   : bisa update milik siapapun + bisa ubah status
     * Lainnya : hanya milik sendiri, status tidak bisa diubah
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $report = $this->baseQuery()->findOrFail($id);

        $rules = [
            'judul'   => 'required|string|max:255',
            'tanggal' => 'required|date',
            'file'    => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ];

        // Hanya admin yang boleh ubah status
        if ($this->isAdmin()) {
            $rules['status'] = 'required|in:pending,disetujui,ditolak';
        }

        $validated = $request->validate($rules);

        try {
            DB::beginTransaction();

            $oldFilePath = null;
            if ($request->hasFile('file')) {
                $oldFilePath = $report->file_path;
                $validated['file_path'] = $request->file('file')->store('reports', 'public');
            }

            $updateData = [
                'judul'     => $validated['judul'],
                'tanggal'   => $validated['tanggal'],
                'file_path' => $validated['file_path'] ?? $report->file_path,
            ];

            if ($this->isAdmin() && isset($validated['status'])) {
                $updateData['status'] = $validated['status'];
            }

            $report->update($updateData);

            DB::commit();

            if ($oldFilePath) {
                Storage::disk('public')->delete($oldFilePath);
            }
        } catch (\Throwable $e) {
            DB::rollBack();

            if (isset($validated['file_path'])) {
                Storage::disk('public')->delete($validated['file_path']);
            }

            return response()->json(['message' => 'Gagal mengupdate report'], 500);
        }

        return response()->json([
            'message' => 'Report berhasil diupdate',
            'data'    => $report->fresh()
        ]);
    }

    /**
     * Soft delete report.
     * Admin   : bisa hapus milik siapapun
     * Lainnya : hanya milik sendiri
     */
    public function destroy(string $id): JsonResponse
    {
        $report = $this->baseQuery()->findOrFail($id);

        $report->delete();

        return response()->json(null, 204);
    }
}