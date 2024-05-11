<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_kegiatan',
        'deskripsi_kegiatan',
        'tempat',
        'tanggal',
        'image_kegiatan',
    ];
}


