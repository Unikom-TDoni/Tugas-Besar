<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use File;
use Storage;
use Html;
use Image;

use App\Models\Cabang;
use App\Models\Kendaraan;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
      return view('admin/pages/dashboard');
    }

    function swal($halaman, $proses)
    {
        $pesan = "Data $halaman berhasil $proses!";
        Session::flash('alert_swal','swal("Berhasil!", "'.$pesan.'", "success");');
    }

    function cabang()
    {
      $cabang   = DB::table('cabang')
                  ->leftJoin('provinsi', 'cabang.provinsi', '=', 'provinsi.id')
                  ->leftJoin('kota', 'cabang.kota', '=', 'kota.id')
                  ->select('cabang.*', 'provinsi.nama as provinsi', 'kota.nama as kota')
                  ->orderBy('nama_cabang', 'asc')
                  ->get();

      $provinsi = DB::table('provinsi')->orderBy('nama', 'asc')->get();
      
      return view('admin/pages/cabang', ['cabang' => $cabang, 'provinsi' => $provinsi]);
    }

    function getKota(Request $request)
    {
        $data['kota'] = DB::table('kota')->where("id_provinsi",$request->id_provinsi)->orderBy('nama', 'asc')->get();

        return response()->json($data);
    }

    function getDataCabang(Request $request)
    {
        $data['cabang'] = DB::table('cabang')->where("id_cabang",$request->id_cabang)->get();

        return response()->json($data);
    }
    function saveCabang(Request $request)
    {
        $id     = array('id_cabang' => $request->id);
        $data   = array(
            'nama_cabang'   => $request->nama,
            'provinsi'      => $request->provinsi,
            'kota'          => $request->kota,
            'alamat'        => $request->alamat
        );

        Cabang::updateOrCreate($id, $data);        
        
        $proses = ($request->id == "")?"ditambahkan":"diubah";

        $this->swal("cabang", $proses);

        return redirect('admin/cabang');
    }

    function hapusCabang(Request $request)
    {
        $data = DB::table('cabang')->where("id_cabang",$request->id_cabang)->delete();;

        return response()->json($data);
    }

    function ubahAktivasiCabang(Request $request)
    {
        $data = DB::table('cabang')->where("id_cabang",$request->id_cabang)->update(["is_aktif" => DB::raw("IF(is_aktif=1,0,1)")]);
        
        return response()->json($data);
    }

    function kendaraan()
    {
        $kendaraan   = DB::table('kendaraan')
                        ->leftJoin('cabang', 'kendaraan.id_cabang', '=', 'cabang.id_cabang')
                        ->select('kendaraan.*', 'cabang.nama_cabang as cabang', DB::raw('jumlah_kendaraan - jumlah_terpakai as jumlah_tersedia'))
                        ->orderBy('nama_kendaraan', 'asc')
                        ->get();

        
        $cabang = DB::table('cabang')->orderBy('nama_cabang', 'asc')->get();
      
        return view('admin/pages/kendaraan', ['kendaraan' => $kendaraan, 'cabang' => $cabang]);
    }

    function getDataKendaraan(Request $request)
    {
        $data['data'] = DB::table('kendaraan')->where("id_kendaraan",$request->id)->get();

        return response()->json($data);
    }

    function saveKendaraan(Request $request)
    {
        $ClassKendaraan = new Kendaraan();

        $id = ($request->id != "")?$request->id:$ClassKendaraan->getNextId();
        
        if ($request->hasFile('gambar'))
        {
            $destinationPath    = "images/kendaraan";
            $file               = $request->gambar;
            $fileName           = $id.".".$file->getClientOriginalExtension();
            $pathfile           = $destinationPath.'/'.$fileName;

            if($request->old_gambar != "")
            {
                File::delete($destinationPath."/".$request->old_gambar);
            }

            $file->move($destinationPath, $fileName); 

            $gambar = $fileName;
        }
        else
        {
            $gambar = $request->old_gambar;
        }

        $id     = array('id_kendaraan' => $request->id);
        $data   = array(
            'nama_kendaraan'    => $request->nama,
            'id_cabang'         => $request->cabang,
            'merk'              => $request->merk,
            'jenis'             => $request->jenis,
            'harga_sewa'        => $request->harga,
            'denda'             => $request->denda,
            'jumlah_kendaraan'  => $request->jumlah,
            'jumlah_terpakai'   => '0',
            'gambar'            => $gambar
        );

        Kendaraan::updateOrCreate($id, $data);        

        $proses = ($request->id == "")?"ditambahkan":"diubah";

        $this->swal("kendaraan", $proses);

        return redirect('admin/kendaraan');
    }

    function hapusKendaraan(Request $request)
    {
        $query  = DB::table('kendaraan')->where("id_kendaraan",$request->id);
        $data   = $query->first();

        File::delete("images/kendaraan/".$data->gambar);

        $delete = $query->delete();

        return response()->json($delete);
    }

    function pelanggan()
    {
        $pelanggan = DB::table('pelanggan')->orderBy('nama', 'asc')->get();
      
        return view('admin/pages/pelanggan', ['pelanggan' => $pelanggan]);
    }

    function getDataPelanggan(Request $request)
    {
        $data['data'] = DB::table('pelanggan')->where("telp", $request->telp)->first();

        return response()->json($data);
    }

    function users()
    {
        $user = DB::table('users')->orderBy('name', 'asc')->get();
      
        return view('admin/pages/users', ['user' => $user]);
    }

    function getDataUsers(Request $request)
    {
        $data['data'] = DB::table('users')->where("id",$request->id)->get();

        return response()->json($data);
    }

    function saveUsers(Request $request)
    {
        $data_user  = DB::table('users')->where("username",$request->username)->first();
        
        if(!empty($data_user->id) && ($data_user->id != $request->id))
        {
            $ret['status']  = "ERROR";
            $ret['pesan']   = "Username sudah digunakan";
        }
        else
        {   
            $id                 = array('id' => $request->id);
            $data['username']   = $request->username;
            $data['name']       = $request->name;
            
            if($request->password != "")
            {
                $data['password'] = Hash::make($request->password);
            }

            User::updateOrCreate($id, $data);        
    
            $ret['status'] = "OK";
        }

        return response()->json($ret);
    }

    function hapusUsers(Request $request)
    {
        $delete  = DB::table('users')->where("id",$request->id)->delete();

        return response()->json($delete);
    }

    function ubahPasswordUsers(Request $request)
    {
        if(!Hash::check($request->old_password, Auth::user()->password))
        {
            $ret['status']  = "ERROR";
            $ret['pesan']   = "Password lama salah!";
        }
        else
        {   
            $id                 = array('id' => Auth::user()->id);
            $data['username']   = Auth::user()->username;
            $data['name']       = Auth::user()->name;
            $data['password']   = Hash::make($request->password);

            User::updateOrCreate($id, $data);        
    
            $ret['status'] = "OK";
        }

        return response()->json($ret);
    }
}
