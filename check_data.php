<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Jurusan;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$jurusans = Jurusan::all();
echo "Jumlah jurusan: " . $jurusans->count() . "\n";

foreach ($jurusans as $jurusan) {
    echo "- {$jurusan->name}: {$jurusan->pertanyaans()->count()} pertanyaan\n";
}