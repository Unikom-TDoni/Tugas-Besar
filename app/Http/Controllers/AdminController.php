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

use App\Models\Cabang;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use App\Models\User;
use App\Models\Transaksi;

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
        $classCabang = new Cabang();
        
        $cabang   = $classCabang->getListData()->get();
        $provinsi = $classCabang->getListDataProvinsi()->get();

        return view('admin/pages/cabang', ['cabang' => $cabang, 'provinsi' => $provinsi]);
    }

    function getKota(Request $request)
    {
        $classCabang = new Cabang();

        $data['kota'] = $classCabang->getListDataKotaByProvinsi($request->id_provinsi)->get();

        return response()->json($data);
    }

    function getDataCabang(Request $request)
    {
        $classCabang = new Cabang();

        $data['cabang'] = $classCabang->getDetailData($request->id_cabang)->get();

        return response()->json($data);
    }
    function saveCabang(Request $request)
    {
        $id     = array('id_cabang' => $request->id);
        $data   = array(
            'nama_cabang'   => $request->nama,
            'telp'          => $request->telp,
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
        $classCabang = new Cabang();

        $data = $classCabang->getDetailData($request->id_cabang)->delete();;

        return response()->json($data);
    }

    function ubahAktivasiCabang(Request $request)
    {
        $classCabang = new Cabang();

        $data = $classCabang->updateAktivasi($request->id_cabang);
        
        return response()->json($data);
    }

    function kendaraan()
    {
        $classKendaraan = new Kendaraan();
        $classCabang    = new Cabang();

        $kendaraan  = $classKendaraan->getListData()->get();
        $cabang     = $classCabang->getListData()->get();
      
        return view('admin/pages/kendaraan', ['kendaraan' => $kendaraan, 'cabang' => $cabang]);
    }

    function getDataKendaraan(Request $request)
    {
        $classKendaraan = new Kendaraan();
        
        $data['data'] = $classKendaraan->getDetailData($request->id)->get();

        return response()->json($data);
    }

    function saveKendaraan(Request $request)
    {
        $classKendaraan = new Kendaraan();

        $id = ($request->id != "")?$request->id:$classKendaraan->getNextId();
        
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
        $classKendaraan = new Kendaraan();
        
        $data = $classKendaraan->getDetailData($request->id)->first();

        File::delete("images/kendaraan/".$data->gambar);

        $delete = $classKendaraan->getDetailData($request->id)->delete();

        return response()->json($delete);
    }

    function pelanggan()
    {
        $classPelanggan = new Pelanggan();

        $pelanggan = $classPelanggan->getListData()->get();
      
        return view('admin/pages/pelanggan', ['pelanggan' => $pelanggan]);
    }

    function getDataPelanggan(Request $request)
    {
        $classPelanggan = new Pelanggan();

        $data['data'] = $classPelanggan->getDetailData($request->telp)->first();

        return response()->json($data);
    }

    function users()
    {
        $classUser = new User();

        $user = $classUser->getListData()->get();
      
        return view('admin/pages/users', ['user' => $user]);
    }

    function getDataUsers(Request $request)
    {
        $classUser = new User();
        
        $data['data'] = $classUser->getDetailData($request->id)->get();

        return response()->json($data);
    }

    function saveUsers(Request $request)
    {
        $classUser = new User();

        $data_user  = $classUser->getDetailDataByUsername($request->username)->first();
        
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
        $classUser = new User();

        $delete  = $classUser->getDetailData($request->id)->delete();

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

    function transaksi(Request $request)
    {
        $classTransaksi = new Transaksi();
        $classKendaraan = new Kendaraan();

        $tgl_awal   = ($request->tgl_awal!='')?$request->tgl_awal:date('Y-m-d');
        $tgl_akhir  = ($request->tgl_akhir!='')?$request->tgl_akhir:date('Y-m-d');
        $filter     = ($request->filter!='')?$request->filter:0;

        $transaksi  = $classTransaksi->getListData($tgl_awal, $tgl_akhir, $filter)->get();
        $kendaraan  = $classKendaraan->getListData()->get();
              
        return view('admin/pages/transaksi', [
            'transaksi' => $transaksi,
            'kendaraan' => $kendaraan,
            'tgl_awal'  => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'filter'    => $filter,
        ]);
    }

    function saveTransaksi(Request $request)
    {
        $classKendaraan = new Kendaraan();
        $classTransaksi = new Transaksi();
        $classPelanggan = new Pelanggan();
        
        $data_kendaraan = $classKendaraan->getDetailData($request->kendaraan)->first();
        
        $kode_transaksi = $classTransaksi->generateKodeTransaksi();
        $harga_sewa     = $data_kendaraan->harga_sewa * $request->durasi;
        $durasi_sewa    = $request->durasi-1;

        $data   = array(
            'kode_transaksi'                => $kode_transaksi,
            'tanggal_transaksi'             => date("Y-m-d"),
            'telp'                          => $request->telp,
            'nama'                          => $request->nama,
            'nomor_ktp'                     => $request->ktp,
            'alamat'                        => $request->alamat,
            'id_kendaraan'                  => $request->kendaraan,
            'nomor_plat'                    => $request->nomor_plat,
            'tanggal_mulai_peminjaman'      => $request->tanggal_pinjam,    
            'tanggal_akhir_peminjaman'      => date("Y-m-d", strtotime("+$durasi_sewa days", strtotime($request->tanggal_pinjam))),
            'is_diantar'                    => $request->is_diantar,
            'waktu_antar'                   => ($request->is_diantar)?$request->tanggal_pinjam." ".$request->jam_antar:NULL,
            'alamat_antar'                  => $request->alamat_antar,
            'harga_sewa'                    => $harga_sewa,
            'denda'                         => 0,
            'total_bayar'                   => $harga_sewa,
        );

        Transaksi::Create($data);

        $this->swal("transaksi", "ditambahkan");

        return redirect('admin/transaksi');
    }

    function detailTransaksi(Request $request, $kode_transaksi)
    {
        $classTransaksi = new Transaksi();

        $data = $classTransaksi->getDetailData($kode_transaksi)->first();
              
        return view('admin/pages/transaksi_detail', ['data' => $data]);
    }

    function updateStatusTransaksi(Request $request)
    {
        $classTransaksi = new Transaksi();
        $classKendaraan = new Kendaraan();

        $kode_transaksi = $request->kode_transaksi;
        $status         = $request->status;
        $value          = $request->value;

        $data_transaksi = $classTransaksi->getDetailData($kode_transaksi)->first();
        $data_kendaraan = $classKendaraan->getDetailData($data_transaksi->id_kendaraan)->first();
        $value          = ($status == "denda")?$data_kendaraan->denda:$value;

        $update  = $classTransaksi->updateStatusTransaksi($kode_transaksi, $status, $value);

        return response()->json($update);
    }
}
