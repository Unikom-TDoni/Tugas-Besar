<?php

namespace App\Http\Controllers\Pelanggan;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ulasan;


class UlasanPageController extends Controller
{
    //
    public function ulasan(){
        return view('Pelanggan/ulasan');
    }

    public function storeUlasan(Request $request){
        DB::table('ulasan')->insert([
            'id'=>$request->id,
            'telp'=>$request->telp,
            'nama'=>$request->nama,
            'id_kendaraan'=>$request->id_kendaraan,
            'id_pelanggan'=>$request->id_pelanggan,
            'kode_transaksi'=>$request->kode_transaksi,
            'rating'=>$request->rating,
            'ulasan'=>$request->ulasan
        ]);
        return redirect('ulasanPelanggan');
    }


}

