<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Desa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PencatatanKegiatanKesling;

class AdminController extends Controller
{
    //
    public function index(){
        $user = User::all();
        $desa = Desa::all();
        $currentMonth = Carbon::now()->month;
        
        $kesling = PencatatanKegiatanKesling::select('jumlah')
        ->where('bulan', $currentMonth)->get();
        $jumlah = $kesling->pluck('jumlah')->toJson();
        #dd($jumlah);

        $data = DB::table('pencatatan_data_kesling')->select('kegiatan_kesling.kegiatan')
            ->leftJoin('kegiatan_kesling', 'pencatatan_data_kesling.idKegiatanKesling', '=', 'kegiatan_kesling.id')
            ->where('bulan', $currentMonth)
            ->get();

        $kegiatan = $data->pluck('kegiatan')->toJson();

        #dd($kegiatan);

        return view('admin.index', compact('user', 'desa', 'jumlah', 'kegiatan', 'currentMonth'));
    }
    
}
