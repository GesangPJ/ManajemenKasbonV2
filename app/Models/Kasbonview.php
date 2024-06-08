<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kasbonview extends Model
{
    use HasFactory;
    public static function viewKaryawan()
    {
        return self::where('user_id', Auth::id())->get();
    }

    public static function viewRequest()
    {
        return self::where('status_r','belum')->get();
    }

    public static function viewBayar()
    {
        return self::where('status_b', 'belum')
                   ->where('status_r', 'setuju')
                   ->get();
    }


}
