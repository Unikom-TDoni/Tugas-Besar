@extends('admin.layouts.layout')

@section('content')
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="fa fa-cart-plus"></i> Transaksi</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ Route('dashboard') }}">Admin</a></li>
                        <li><a href="{{ Route('transaksi') }}">Transaksi</a></li>
                        <li class="active">Detail</li>
                    </ol>
                </div>
            </div>

            <div class="panel">          
                <div class="panel-heading">
                    <h3 class="panel-title">Detail</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form">        
                        <div class="col-sm-6">                                    
                            <div class="form-group">
                                <label class="col-md-4 control-label">Kode Transaksi : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ $data->kode_transaksi }}
                                </div>
                                <input type="hidden" id="kode" name="kode" value="{{ $data->kode_transaksi }}">
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Tanggal Transaksi : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ date("d-m-Y", strtotime($data->tanggal_transaksi)) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">No. Telp Peminjam : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ $data->telp }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">No. KTP Peminjam : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ $data->nomor_ktp }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nama Peminjam : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ $data->nama }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Alamat Peminjam : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ $data->alamat }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Kendaraan : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ $data->kendaraan }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Nomor Plat : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ ($data->nomor_plat!="")?$data->nomor_plat:"-" }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Periode Peminjaman : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ date("d-m-Y", strtotime($data->tanggal_mulai_peminjaman)) }} s/d
                                    {{ date("d-m-Y", strtotime($data->tanggal_akhir_peminjaman)) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Kendaraan Diantar : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ ($data->is_diantar)?"YA":"TIDAK" }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Waktu Antar : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ ($data->is_diantar)?date("Y-m-d H:i", strtotime($data->waktu_antar)):"-" }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Alamat Antar : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ ($data->is_diantar)?$data->alamat_antar:"-" }}
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">    
                            <div class="form-group">
                                <label class="col-md-4 control-label">Harga Sewa : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ "Rp " . number_format($data->harga_sewa, 0, ",", ".") }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Denda : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ "Rp " . number_format($data->denda, 0, ",", ".") }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Total Bayar : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ "Rp " . number_format($data->total_bayar, 0, ",", ".") }}
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-4 control-label">Status Transaksi : </label>
                                <div class="col-md-8 form-control-static">
                                    @if($data->status_transaksi == 0)
                                        <label class="label label-default">Menunggu Konfirmasi Transaksi</label>
                                    @elseif($data->status_transaksi == 1)
                                        <label class="label label-success">Transaksi Dikonfirmasi</label>
                                    @else
                                        <label class="label label-danger">Transaksi Batal</label>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Status Pembayaran : </label>
                                <div class="col-md-8 form-control-static">
                                    @if($data->status_transaksi == 1)
                                        @if($data->status_pembayaran)
                                            <label class="label label-success">Pembayaran Dikonfirmasi</label>
                                        @else
                                            <label class="label label-default">Menunggu Pembayaran</label>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Status Pengembalian Kendaraan : </label>
                                <div class="col-md-8 form-control-static">
                                    @if($data->status_transaksi == 1 && $data->status_pembayaran == 1)
                                        @if($data->status_pengembalian)
                                            <label class="label label-success">Kendaraan Sudah Dikembalikan</label>
                                        @else
                                            <label class="label label-default">Kendaraan Sedang Dipinjam</label>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Waktu Pengembalian : </label>
                                <div class="col-md-8 form-control-static">
                                    {{ ($data->status_pengembalian)?date("Y-m-d H:i", strtotime($data->waktu_pengembalian)):"-" }}
                                </div>
                            </div>
                        </div>
                    </form>
                    @if($data->status_transaksi != 2 && $data->status_pengembalian != 1)
                        <div class="row">
                            <table class="table table-bordered" style="margin: auto;width: 80%;text-align: center;">
                                <thead>
                                    <tr>
                                        <th class="text-center">Transaksi</th>
                                        <th class="text-center">Pembayaran</th>
                                        <th class="text-center">Pengembalian Kendaraan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            @if($data->status_transaksi == 0)
                                                <button class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#transaksi""> <i class="fa fa-check"></i> Konfirmasi Transaksi</button>
                                            @endif
                                            <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="ubahStatus('transaksi', 2);"> <i class="fa fa-remove"></i> Batalkan Transaksi</button>
                                        </td>
                                        <td>
                                            @if($data->status_transaksi == 1 && $data->status_pembayaran == 0)
                                                <button class="btn btn-icon waves-effect waves-light btn-success m-b-5" onclick="ubahStatus('pembayaran');"> <i class="fa fa-check"></i> Konfirmasi Pembayaran</button>
                                            @elseif($data->status_transaksi == 1 && $data->status_pembayaran == 1)
                                                <label class="label label-success">Pembayaran Dikonfirmasi</label>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->status_transaksi == 1 && $data->status_pembayaran == 1 && $data->status_pengembalian == 0)
                                                <button class="btn btn-icon waves-effect waves-light btn-success m-b-5" onclick="ubahStatus('pengembalian');"> <i class="fa fa-check"></i> Konfirmasi Pengembalian</button>
                                                @if(date("Y-m-d") > $data->tanggal_akhir_peminjaman && $data->denda == 0)
                                                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" onclick="ubahStatus('denda');"> <i class="fa fa-money"></i> Kenakan Denda</button>
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>  
                        </div>
                    @endif
                </div> <!-- end Panel -->
            </div>
        </div>
    </div> 
</div>  

<div id="transaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Konfirmasi Transaksi</h4> 
            </div> 
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label class="control-label">Nomor Plat Kendaraan</label> 
                                <input type="text" class="form-control" id="nomor_plat" name="nomor_plat" value="{{ $data->nomor_plat }}"> 
                            </div> 
                        </div> 
                    </div> 
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup <i class="fa fa-close"></i></button> 
                    <button type="button" id="submit" class="btn btn-primary waves-effect waves-light" onclick="ubahStatus('nomor_plat', nomor_plat.value, false);">Simpan <i class="fa fa-save"></i></button> 
                </div> 
        </div> 
    </div>
</div><!-- /.modal -->

<script>
    function ubahStatus(status, value = 1, show_confirm = true)
    {
        if(show_confirm)
        {
            if(!confirm("Apakah anda yakin?")) 
            {
                return false;
            }
        }
        else
        {
            if(value == "")
            {
                alert("Harap isi Nomor Plat!");
                return false;
            }
        }

        $.ajax(
        {
            url: "{{ Route('transaksi.status') }}",
            type: 'POST',
            data: 
            {
                kode_transaksi: $("#kode").val(),
                status: status,
                value: value,
                _token: '{{csrf_token()}}'
            },
            success: function (response)
            {
                location.reload();
            }
        });
        
        return false;
    }
</script>
@endsection