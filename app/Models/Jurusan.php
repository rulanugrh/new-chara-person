<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'active',
    ];

    public function kriterias()
    {
        return $this->belongsToMany(Kriteria::class, 'jurusan_kriteria')
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

    public function hasilRekomendasis()
    {
        return $this->hasMany(HasilRekomendasi::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
