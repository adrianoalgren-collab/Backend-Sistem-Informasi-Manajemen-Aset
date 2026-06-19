<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RequestPerbaikan;
use App\Models\AsetOperasional;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class RequestPerbaikanSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil beberapa aset dan staff untuk contoh
        $asetList = AsetOperasional::take(5)->pluck('id_operasional');
        $staffList = User::take(3)->pluck('id');

        foreach ($asetList as $asetId) {
            foreach ($staffList as $staffId) {
                // Simulasi file dummy
                $dummyFileName = 'request_perbaikan/dummy_proposal_' . $asetId . '_' . $staffId . '.pdf';
                
                // Buat file dummy kosong di storage jika belum ada
                if (!Storage::exists($dummyFileName)) {
                    Storage::put($dummyFileName, 'Ini adalah file proposal dummy.');
                }

                RequestPerbaikan::create([
                    'aset_id' => $asetId,
                    'staff_id' => $staffId,
                    'file_request' => $dummyFileName,
                    'status_request' => ['pending','diterima','ditolak'][array_rand(['pending','diterima','ditolak'])],
                    'catatan_admin' => 'Ini adalah catatan dummy',
                ]);
            }
        }
    }
}