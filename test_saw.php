<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use App\Models\Jurusan;
use App\Models\Kriteria;
use App\Models\Pertanyaan;
use App\Models\JawabanSiswa;
use App\Models\NilaiSiswa;
use App\Services\SAWService;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Ambil user pertama yang bukan admin
$user = User::where('email', '!=', 'admin@spk.local')->first();

if ($user) {
    echo "User ditemukan: {$user->name} ({$user->email})\n";

    // Buat data test jika belum ada
    if ($user->nilaiSiswas()->count() == 0) {
        echo "Membuat data nilai akademik test...\n";
        $kriterias = Kriteria::where('data_source', 'academic')->get();
        foreach ($kriterias as $kriteria) {
            NilaiSiswa::create([
                'user_id' => $user->id,
                'kriteria_id' => $kriteria->id,
                'raw_value' => rand(70, 100), // Nilai random 70-100
            ]);
        }
    }

    if ($user->jawabanSiswas()->count() == 0) {
        echo "Membuat data jawaban kuisioner test...\n";
        $jurusans = Jurusan::with('pertanyaans')->get();
        foreach ($jurusans as $jurusan) {
            foreach ($jurusan->pertanyaans as $pertanyaan) {
                JawabanSiswa::create([
                    'user_id' => $user->id,
                    'pertanyaan_id' => $pertanyaan->id,
                    'score' => rand(1, 5), // Score random 1-5
                ]);
            }
        }
    }

    // Cek data nilai siswa
    $nilaiCount = $user->nilaiSiswas()->count();
    echo "Jumlah nilai akademik: {$nilaiCount}\n";

    // Cek data jawaban kuisioner
    $jawabanCount = $user->jawabanSiswas()->count();
    echo "Jumlah jawaban kuisioner: {$jawabanCount}\n";

    $service = new SAWService();
    $results = $service->calculateForUser($user);

    echo "\nHasil perhitungan SAW:\n";
    foreach ($results as $result) {
        echo "{$result['jurusan_name']}: {$result['score']}\n";

        // Tampilkan detail kriteria
        foreach ($result['details'] as $detail) {
            echo "  - {$detail['kriteria']} ({$detail['source']}): normalized={$detail['normalized']}, weight={$detail['weight']}%, subtotal={$detail['subtotal']}\n";
        }
        echo "\n";
    }
} else {
    echo "Tidak ada user siswa ditemukan\n";
}