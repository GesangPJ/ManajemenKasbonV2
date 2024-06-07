<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasbon extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'jumlah',
        'metode',
        'keterangan',
        'status_r',
        'status_b',
    ];
}
