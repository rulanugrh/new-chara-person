<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;

    protected $table = 'nilai_siswas';

    protected $fillable = [
        'user_id',
        'kriteria_id',
        'raw_value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
