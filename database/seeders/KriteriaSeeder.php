<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kriteria Akademik
        $academicKriterias = [
            [
                'name' => 'Matematika',
                'slug' => 'matematika',
                'description' => 'Nilai rapor mata pelajaran Matematika',
                'data_source' => Kriteria::SOURCE_ACADEMIC,
                'max_value' => 100,
                'is_benefit' => true,
                'is_minat' => false,
            ],
            [
                'name' => 'Bahasa Indonesia',
                'slug' => 'bahasa-indonesia',
                'description' => 'Nilai rapor mata pelajaran Bahasa Indonesia',
                'data_source' => Kriteria::SOURCE_ACADEMIC,
                'max_value' => 100,
                'is_benefit' => true,
                'is_minat' => false,
            ],
            [
                'name' => 'Bahasa Inggris',
                'slug' => 'bahasa-inggris',
                'description' => 'Nilai rapor mata pelajaran Bahasa Inggris',
                'data_source' => Kriteria::SOURCE_ACADEMIC,
                'max_value' => 100,
                'is_benefit' => true,
                'is_minat' => false,
            ],
            [
                'name' => 'IPA',
                'slug' => 'ipa',
                'description' => 'Nilai rapor mata pelajaran Ilmu Pengetahuan Alam',
                'data_source' => Kriteria::SOURCE_ACADEMIC,
                'max_value' => 100,
                'is_benefit' => true,
                'is_minat' => false,
            ],
            [
                'name' => 'IPS',
                'slug' => 'ips',
                'description' => 'Nilai rapor mata pelajaran Ilmu Pengetahuan Sosial',
                'data_source' => Kriteria::SOURCE_ACADEMIC,
                'max_value' => 100,
                'is_benefit' => true,
                'is_minat' => false,
            ],
            [
                'name' => 'PKN',
                'slug' => 'pkn',
                'description' => 'Nilai rapor mata pelajaran Pendidikan Kewarganegaraan',
                'data_source' => Kriteria::SOURCE_ACADEMIC,
                'max_value' => 100,
                'is_benefit' => true,
                'is_minat' => false,
            ],
            [
                'name' => 'Seni Budaya',
                'slug' => 'seni-budaya',
                'description' => 'Nilai rapor mata pelajaran Seni Budaya',
                'data_source' => Kriteria::SOURCE_ACADEMIC,
                'max_value' => 100,
                'is_benefit' => true,
                'is_minat' => false,
            ],
        ];

        // Kriteria Minat
        $minatKriteria = [
            'name' => 'Minat Bakat',
            'slug' => 'minat-bakat',
            'description' => 'Hasil kuisioner minat dan bakat siswa',
            'data_source' => Kriteria::SOURCE_QUESTIONNAIRE,
            'max_value' => 100,
            'is_benefit' => true,
            'is_minat' => true,
        ];

        // Insert data
        foreach ($academicKriterias as $kriteria) {
            Kriteria::firstOrCreate(
                ['slug' => $kriteria['slug']],
                $kriteria
            );
        }

        Kriteria::firstOrCreate(
            ['slug' => $minatKriteria['slug']],
            $minatKriteria
        );
    }
}
