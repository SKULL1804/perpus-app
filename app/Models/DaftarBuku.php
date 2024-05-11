<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarBuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_buku',
        'image_buku',
        'judul',
        'pengarang',
        'penerbit',
        'kategori_buku_id',
        'file_buku',
        'tanggal_terbit',
    ];

    public function kategoriBuku()
    {
        return $this->belongsTo(KategoriBuku::class);
    }

    public function historyBaca()
    {
        return $this->hasMany(HistoryBaca::class, 'id_buku');
    }
}
