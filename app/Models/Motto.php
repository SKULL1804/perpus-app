<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motto extends Model
{
    use HasFactory;

    protected $table = 'motto' ;
    protected $fillable = [
        'ajakan',
        'motto',
    ];
}
