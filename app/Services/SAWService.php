<?php

namespace App\Services;

use App\Models\HasilRekomendasi;
use App\Models\JawabanSiswa;
use App\Models\Jurusan;
use App\Models\Kriteria;
use App\Models\NilaiSiswa;
use App\Models\User;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class SAWService
{
    public function calculateForUser(User $student): Collection
    {
        $jurusans = Jurusan::with(['kriterias', 'pertanyaans.kriteria'])
            ->active()
            ->get();

        $this->validateJurusanWeights($jurusans);

        $answersByKriteria = JawabanSiswa::where('user_id', $student->id)
            ->with('pertanyaan')
            ->get()
            ->groupBy(fn (JawabanSiswa $jawaban) => $jawaban->pertanyaan->kriteria_id);

        $answersByJurusan = JawabanSiswa::where('user_id', $student->id)
            ->with('pertanyaan')
            ->get()
            ->groupBy(fn (JawabanSiswa $jawaban) => $jawaban->pertanyaan->jurusan_id);

        $nilaiSiswas = NilaiSiswa::where('user_id', $student->id)
            ->get()
            ->keyBy('kriteria_id');

        $results = collect();

        foreach ($jurusans as $jurusan) {
            $score = 0.0;
            $details = [];

            foreach ($jurusan->kriterias as $kriteria) {
                $weight = (float) $kriteria->pivot->weight / 100;
                $normalized = $this->normalizeCriterion($kriteria, $jurusan, $answersByKriteria, $answersByJurusan, $nilaiSiswas);

                $details[] = [
                    'kriteria' => $kriteria->name,
                    'source' => $kriteria->data_source,
                    'normalized' => round($normalized, 4),
                    'weight' => $kriteria->pivot->weight,
                    'subtotal' => round($normalized * $weight, 4),
                ];

                $score += $normalized * $weight;
            }

            $results->push([
                'jurusan_id' => $jurusan->id,
                'jurusan_name' => $jurusan->name,
                'score' => round($score, 4),
                'details' => $details,
            ]);
        }

        $sorted = $results->sortByDesc('score')->values();

        $ranked = $sorted->map(function ($item, $index) {
            $item['rank'] = $index + 1;
            return $item;
        });

        return $ranked;
    }

    protected function normalizeCriterion(
        $kriteria,
        Jurusan $jurusan,
        $answersByKriteria,
        $answersByJurusan,
        $nilaiSiswas
    ): float {
        if ($kriteria->data_source === Kriteria::SOURCE_QUESTIONNAIRE) {
            // Jika kriteria ini adalah minat bakat, hitung jawaban berdasarkan jurusan
            if ($kriteria->is_minat) {
                $jurusanAnswers = $answersByJurusan[$jurusan->id] ?? collect();
                return $this->normalizeQuestionnaire($jurusanAnswers);
            }

            // Untuk kriteria questionnaire biasa, gunakan jawaban yang terkait dengan kriteria
            $questionAnswers = $answersByKriteria[$kriteria->id] ?? collect();
            return $this->normalizeQuestionnaire($questionAnswers);
        }

        $raw = (float) ($nilaiSiswas[$kriteria->id]->raw_value ?? 0);
        return $this->normalizeAcademic($raw, $kriteria->max_value);
    }

    protected function normalizeAcademic(float $rawValue, int $maxValue = 100): float
    {
        if ($maxValue <= 0) {
            return 0.0;
        }

        return min(max($rawValue / $maxValue, 0.0), 1.0);
    }

    protected function normalizeQuestionnaire($answers): float
    {
        $total = $answers->sum('score');
        $count = $answers->count();

        if ($count === 0) {
            return 0.0;
        }

        $max = $count * 5;
        return $max > 0 ? min(max($total / $max, 0.0), 1.0) : 0.0;
    }

    protected function validateJurusanWeights(Collection $jurusans): void
    {
        foreach ($jurusans as $jurusan) {
            $total = $jurusan->kriterias->sum(fn ($kriteria) => $kriteria->pivot->weight);

            if (abs($total - 100.0) > 0.01) {
                throw new InvalidArgumentException("Total bobot untuk jurusan {$jurusan->name} harus 100%, saat ini: {$total}");
            }
        }
    }

    public function persistRecommendations(User $student): void
    {
        $recommendations = $this->calculateForUser($student);

        foreach ($recommendations as $item) {
            HasilRekomendasi::updateOrCreate(
                [
                    'user_id' => $student->id,
                    'jurusan_id' => $item['jurusan_id'],
                ],
                [
                    'score' => $item['score'],
                    'rank' => $item['rank'],
                    'meta' => [
                        'details' => $item['details'],
                    ],
                ]
            );
        }
    }
}
