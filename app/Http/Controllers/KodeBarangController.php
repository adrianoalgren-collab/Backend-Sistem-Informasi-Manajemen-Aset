<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\KodeBarang;

class KodeBarangController extends Controller
{
    // ======================================================
    // KONSTANTA PATH UPLOAD
    // ======================================================

    /*
        Didefinisikan sekali di sini agar konsisten di
        seluruh method (store, update, destroy) dan
        mudah diubah tanpa harus cari-ganti di banyak tempat.

        Path relatif dari public_path():
        public/uploads/aset/
    */

    private const UPLOAD_PATH = 'uploads/aset';

    // ======================================================
    // HELPER: SIMPAN FOTO
    // ======================================================

    /*
        Menghasilkan nama file yang aman untuk production:
        - uniqid()  : unik per milidetik, menghindari tabrakan nama
        - getClientOriginalExtension() : ambil ekstensi saja,
          bukan nama asli dari user (mencegah path traversal
          dan karakter berbahaya di nama file)

        Contoh hasil: 6643f2a1b3c4d.jpg
    */

    private function simpanFoto($file): string
    {
        $ext      = $file->getClientOriginalExtension();
        $filename = uniqid() . '.' . $ext;

        $file->move(public_path(self::UPLOAD_PATH), $filename);

        return $filename;
    }

    // ======================================================
    // HELPER: HAPUS FOTO LAMA
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
        $kode_barang = KodeBarang::with([
            'asetOperasional.manufacturer'
        ])->latest()->get();

        return response()->json([
            'message' => 'Daftar kode barang',
            'data'    => $kode_barang,
        ], 200);
    }

    // ======================================================
    // STORE
    // ======================================================

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_operasional' =>
                'required|exists:aset_operasional,id_operasional',

            'kode_barang' =>
                'required|string|max:50|unique:kode_barang,kode_barang',

            'kondisi_asetoperasional' =>
                'required|in:Baik,Rusak Ringan,Rusak Berat',

            'lokasi_asetoperasional' =>
                'required|string|max:100',

            'foto_asetoperasional' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto_asetoperasional')) {
            $validated['foto_asetoperasional'] =
                $this->simpanFoto($request->file('foto_asetoperasional'));
        }

        $kode_barang = KodeBarang::create($validated);
        $kode_barang->load(['asetOperasional.manufacturer']);

        return response()->json([
            'message' => 'Kode Barang berhasil dibuat',
            'data'    => $kode_barang,
        ], 201);
    }

    // ======================================================
    // SHOW
    // ======================================================

    public function show(string $id)
    {
        $kode_barang = KodeBarang::with([
            'asetOperasional.manufacturer'
        ])->findOrFail($id);

        return response()->json([
            'message' => 'Detail kode barang',
            'data'    => $kode_barang,
        ], 200);
    }

    // ======================================================
    // UPDATE
    // ======================================================

    public function update(Request $request, string $id)
    {
        $kode_barang = KodeBarang::findOrFail($id);

        $validated = $request->validate([
            'id_operasional' =>
                'sometimes|required|exists:aset_operasional,id_operasional',

            'kode_barang' => [
                'sometimes', 'required', 'string', 'max:50',
                Rule::unique('kode_barang', 'kode_barang')
                    ->ignore($kode_barang->id_kodebarang, 'id_kodebarang'),
            ],

            'kondisi_asetoperasional' =>
                'sometimes|required|in:Baik,Rusak Ringan,Rusak Berat',

            'lokasi_asetoperasional' =>
                'sometimes|required|string|max:100',

            'foto_asetoperasional' =>
                'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto_asetoperasional')) {

            $this->hapusFoto($kode_barang->foto_asetoperasional);

            $validated['foto_asetoperasional'] =
                $this->simpanFoto($request->file('foto_asetoperasional'));
        }

        $kode_barang->update($validated);
        $kode_barang->load(['asetOperasional.manufacturer']);

        return response()->json([
            'message' => 'Kode Barang berhasil diupdate',
            'data'    => $kode_barang,
        ], 200);
    }

    // ======================================================
    // DESTROY
    // ======================================================

    public function destroy(string $id)
    {
        $kode_barang = KodeBarang::findOrFail($id);

        $this->hapusFoto($kode_barang->foto_asetoperasional);

        $kode_barang->delete();

        return response()->json([
            'message' => 'Kode Barang berhasil dihapus',
        ], 200);
    }

    // ======================================================
    // CHECK KODE — GET /kodebarang/check
    // ======================================================

    /*
        Dipakai frontend saat onBlur input kode_barang
        untuk memastikan kode belum dipakai unit lain.

        Query params:
        - kode_barang : kode yang ingin dicek
        - exclude_id  : id_kodebarang yang dikecualikan (edit mode)

        Response:
        { "exists": true/false }
    */

    public function checkKode(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:50',
            'exclude_id'  => 'nullable|integer',
        ]);

        $query = KodeBarang::where('kode_barang', $request->kode_barang);

        // Edit mode: jangan hitung diri sendiri sebagai duplikat
        if ($request->filled('exclude_id')) {
            $query->where('id_kodebarang', '!=', $request->exclude_id);
        }

        return response()->json([
            'exists' => $query->exists(),
        ], 200);
    }

    // ======================================================
    // NEXT KODE — GET /kodebarang/next
    // ======================================================

    /*
        Auto-suggest kode berikutnya berdasarkan kode terakhir
        milik aset yang sama.

        Format kode yang didukung:
        - "OFF026"  → prefix="OFF", number=26  → "OFF027"
        - "026"     → prefix="",   number=26   → "027"
        - "A1"      → prefix="A",  number=1    → "A2"

        Zero-padding dipertahankan sesuai panjang angka aslinya.
        Contoh: "OFF026" (3 digit) → "OFF027", bukan "OFF27".

        Query params:
        - id_operasional : filter kode milik aset tertentu

        Response:
        { "next_kode": "OFF027" }
        { "next_kode": null }   ← belum ada unit, FE bisa kosongkan atau
                                  beri default sendiri
    */

    public function nextKode(Request $request)
    {
        $request->validate([
            'id_operasional' => 'required|integer|exists:aset_operasional,id_operasional',
        ]);

        $last = KodeBarang::where('id_operasional', $request->id_operasional)
            ->orderByDesc('id_kodebarang')
            ->value('kode_barang');

        // Belum ada unit untuk aset ini
        if (!$last) {
            return response()->json(['next_kode' => null], 200);
        }

        // Pisahkan prefix huruf dan angka di belakang
        // Contoh: "OFF026" → $matches[1]="OFF", $matches[2]="026"
        preg_match('/^([A-Za-z]*)(\d+)$/', $last, $matches);

        $prefix = $matches[1] ?? '';
        $digits = $matches[2] ?? '0';
        $number = (int) $digits;
        $pad    = strlen($digits);   // pertahankan zero-padding

        $next = $prefix . str_pad($number + 1, $pad, '0', STR_PAD_LEFT);

        return response()->json(['next_kode' => $next], 200);
    }
}