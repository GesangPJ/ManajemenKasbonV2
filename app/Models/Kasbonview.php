<?php

namespace App\Models;

use Illuminate\Http\Request;
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
    public static function jumlahTotalKasbon()
    {
        // Hitung total jumlah
        $jumlahTotal = self::sum('jumlah');

        // Hitung total jumlah dimana bayar = lunas
        $jumlahLunas = self::where('status_b', 'lunas')->sum('jumlah');

        // Hitung total jumlah dimana bayar = belum
        $jumlahBelum = self::where('status_b', 'belum')->sum('jumlah');

        // Kirim sebagai array
        return [
            'jumlahTotal' => $jumlahTotal,
            'jumlahLunas' => $jumlahLunas,
            'jumlahBelum' => $jumlahBelum,
        ];
    }

    public static function jumlahKasbonKaryawan(){

        // Hitung total jumlah berdasarkan id user (karyawan)
        $totalKasbonKaryawan = self::where('user_id',Auth::id())->sum('jumlah');

        // Hitung total jumlah berdasarkan id user (karyawan) dimana bayar = lunas
        $totalLunasKaryawan = self::where('user_id',Auth::id())->where('status_b','lunas')->sum('jumlah');

        // Hitung total jumlah berdasarkan id user (karyawan) dimana bayar = belum
        $totalBelumKaryawan = self::where('user_id',Auth::id())->where('status_b','belum')->sum('jumlah');

        // Kirim sebagai Array
        return[
            'totalKasbonKaryawan' => $totalKasbonKaryawan,
            'totalLunasKaryawan' => $totalLunasKaryawan,
            'totalBelumKaryawan' => $totalBelumKaryawan,
        ];
    }

    public function index()
    {
        return view('admin.laporan');
    }

    public function getKasbonData(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $kasbonData = Kasbonview::whereMonth('updated_at', $month)
            ->whereYear('updated_at', $year)
            ->get();
        return response()->json($kasbonData);
    }
}
