<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryBaca extends Model
{
    use HasFactory;

    protected $table = 'history_baca';
    protected $fillable = [
        'id_user',
        'id_buku',
        'tanggal_baca',
        'id_ket',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function daftarBuku() {
        return $this->belongsTo(DaftarBuku::class, 'id_buku');
    }

    public function ketBuku()
    {
        return $this->belongsTo(KetBuku::class, 'id_ket');
    }
}
