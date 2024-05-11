<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;

    protected $table = 'kategori_buku';
    protected $fillable = [
        'name',
    ];

    public function daftarBuku() {
        return $this->hasMany(DaftarBuku::class);
    }
}
