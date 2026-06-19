<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Carbon;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua user
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->info('Tidak ada user ditemukan. Seeder report dibatalkan.');
            return;
        }

        foreach ($users as $user) {
            for ($i = 1; $i <= 3; $i++) {

                Report::create([
                    'judul_report'   => 'Report ' . $i . ' - ' . $user->name,
                    'tanggal_report' => Carbon::now()->subDays(rand(1, 30)),
                    'status_report'  => collect(['pending', 'disetujui', 'ditolak'])->random(),
                    'file_report'    => 'reports/dummy-file-' . rand(1, 5) . '.pdf',
                    'user_report'        => $user->id,
                ]);
            }
        }

        $this->command->info('Seeder Report berhasil dijalankan.');
    }
}