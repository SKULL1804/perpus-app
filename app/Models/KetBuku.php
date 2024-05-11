<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetBuku extends Model
{
    use HasFactory;

    protected $table = 'ket_buku';

    protected $fillable = [
        'status',
    ];

        // Jika ada hubungan langsung dengan User, tambahkan relasi berikut
        public function users()
        {
            return $this->hasMany(User::class, 'ket_buku_id');
        }

        // Jika ada hubungan langsung dengan HistoryBaca, tambahkan relasi berikut
        public function historyBacas()
        {
            return $this->hasMany(HistoryBaca::class, 'id_ket');
        }

}
