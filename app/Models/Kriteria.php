<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    public const SOURCE_ACADEMIC = 'academic';
    public const SOURCE_QUESTIONNAIRE = 'questionnaire';
    public const SOURCE_MANUAL = 'manual';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'data_source',
        'max_value',
        'is_benefit',
        'is_minat',
    ];

    protected $casts = [
        'max_value' => 'integer',
        'is_benefit' => 'boolean',
        'is_minat' => 'boolean',
    ];

    public function jurusans()
    {
        return $this->belongsToMany(Jurusan::class, 'jurusan_kriteria')
            ->withPivot('weight', 'value_source')
            ->withTimestamps();
    }

    public function pertanyaans()
    {
        return $this->hasMany(Pertanyaan::class);
    }

    public function nilaiSiswas()
    {
        return $this->hasMany(NilaiSiswa::class);
    }
}
