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
                        <li class="active">Transaksi</li>
                    </ol>
                </div>
            </div>

            <div class="panel">          
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="m-b-30">
                                <button class="btn btn-primary" onclick="tambah()">Tambah <i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                         
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ Route('transaksi') }}" class="form-inline" role="form" style="float: right;">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" value="{{ $tgl_awal }}">
                                </div>
                                
                                <div class="form-group m-l-10">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="{{ $tgl_akhir }}">
                                </div>

                                <div class="form-group m-l-10">
                                    <label>Filter</label>
                                    <select class="form-control" id="filter" name="filter">
                                        <option value="0" {{ ($filter==0)?"selected":"" }}>Semua Transaksi</option>
                                        <option value="1" {{ ($filter==1)?"selected":"" }}>Transaksi Diproses</option>
                                        <option value="2" {{ ($filter==2)?"selected":"" }}>Transaksi Selesai</option>
                                        <option value="3" {{ ($filter==3)?"selected":"" }}>Transaksi Batal</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-inverse waves-effect waves-light m-l-10"><i class="fa fa-search"> Cari</i></button>
                            </form>
                        </div>
                    </div>

                    <hr>
                    
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Tanggal <br> Transaksi</th>
                                <th>Kode <br> Transaksi</th>
                                <th>Telp</th>
                                <th>Nama</th>
                                <th>Kendaraan</th>
                                <th>Periode <br> Peminjaman</th>
                                <th>Total <br> Bayar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>                  
                        <tbody>
                            @foreach($transaksi as $data)
                            
                            <?php 
                                $label_bg = "label-default";
                                
                                if($data->status_transaksi == 0)
                                {
                                    $status = "Menunggu Konfirmasi Transaksi";
                                }
                                elseif ($data->status_transaksi == 1) 
                                {
                                    $status = ($data->status_pembayaran == 0)?"Menunggu Konfirmasi Pembayaran":"Sedang dalam peminjaman";
                                    
                                    if($data->status_pengembalian == 1)
                                    {
                                        $status     = "Transaksi Selesai";   
                                        $label_bg   = "label-success";
                                    }  
                                }
                                else
                                {
                                    $status     = "Transaksi Batal";
                                    $label_bg   = "label-danger";
                                }
                            ?>
                            
                            <tr class="gradeX">
                                <td>{{ date("d-m-Y", strtotime($data->tanggal_transaksi)) }}</td>
                                <td>{{ $data->kode_transaksi }}</td>
                                <td>{{ $data->telp }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->kendaraan }}</td>
                                <td>{{ date("d-m-Y", strtotime($data->tanggal_mulai_peminjaman)) }} s/d <br> {{ date("d-m-Y", strtotime($data->tanggal_akhir_peminjaman)) }}</td>
                                <td>{{ "Rp ". number_format($data->total_bayar, 0, ".", ",") }}</td>
                                <td><label class="label {{ $label_bg }}">{{ $status }}</label></td>
                                <td class="actions">
                                    <a href="{{ url('admin/transaksi/detail/'.$data->kode_transaksi) }}" class="btn btn-icon btn-sm btn-info"><i class="fa fa-eye"></i> Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end: page -->
            </div> <!-- end Panel -->
        </div>
    </div>
  </div> 
  
  <div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Transaksi</h4> 
            </div> 
            
            <form action="{{ Route('transaksi.save') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label class="control-label">No. Telp</label>
                                <input type="text" class="form-control" id="telp" name="telp" onblur="checkDataPelanggan(this.value)" required> 
                            </div> 
                        </div> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label">No. KTP</label> 
                                <input type="text" class="form-control" id="ktp" name="ktp" required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Nama</label> 
                                <input type="text" class="form-control" id="nama" name="nama" required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Alamat</label> 
                                <textarea class="form-control autogrow" id="alamat" name="alamat" rows="3" required></textarea>
                            </div> 
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label class="control-label">Kendaraan</label>
                                <select  class="form-control" id="kendaraan" name="kendaraan" onchange="hitungHargaSewa();" required>
                                    <option value="">--Pilih Kendaraan--</option>
                                    @foreach($kendaraan as $data)
                                        <option value="{{ $data->id_kendaraan }}">{{ $data->nama_kendaraan }}</option>
                                    @endforeach
                                </select> 
                            </div> 
                        </div> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label">No. Plat</label> 
                                <input type="text" class="form-control" id="nomor_plat" name="nomor_plat" required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label class="control-label">Tanggal Peminjaman</label>
                                <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ date("Y-m-d") }}" required> 
                            </div> 
                        </div> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label">Durasi (Hari)</label> 
                                <input type="number" class="form-control" id="durasi" name="durasi" value="1" min="1" onchange="hitungHargaSewa();" required>
                            </div> 
                        </div> 
                    </div>
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Harga Sewa</label> 
                                <input type="text" class="form-control" id="harga_sewa" name="harga_sewa" disabled> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Kendaraan Diantar</label> 
                                <select class="form-control" id="is_diantar" name="is_diantar" onchange="showInputAntar(this.value);">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div> 
                        </div> 
                    </div>
                    <div id="input_antar" style="display: none;width: 100%;">
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group"> 
                                    <label for="field-7" class="control-label">Jam Antar</label> 
                                    <input type="text" class="form-control" id="jam_antar" name="jam_antar" placeholder="10:00" maxlength="5">
                                </div> 
                            </div> 
                        </div>
                        <div class="row"> 
                            <div class="col-md-12"> 
                                <div class="form-group"> 
                                    <label for="field-7" class="control-label">Alamat Antar</label> 
                                    <textarea class="form-control autogrow" id="alamat_antar" name="alamat_antar" rows="3"></textarea>
                                </div> 
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup <i class="fa fa-close"></i></button> 
                    <button type="submit" id="submit" class="btn btn-primary waves-effect waves-light">Simpan <i class="fa fa-save"></i></button> 
                </div> 
            </form>
        </div> 
    </div>
</div><!-- /.modal -->

<script>
    function checkDataPelanggan(telp)
    {
        $("#kota").html('');
        $.ajax(
        {
            url:"{{ Route('pelanggan.data') }}",
            type: "POST",
            data: {
                telp: telp,
                _token: '{{csrf_token()}}'
            },
            dataType : 'json',
            success: function(result)
            {
                value = result.data;
                $("#nama").val(value.nama);
                $("#ktp").val(value.nomor_ktp);
                $("#alamat").val(value.alamat);
            }
        });
    }

    function hitungHargaSewa()
    {
        if($("#kendaraan").val() != "")
        {
            $.ajax(
            {
                url:"{{ Route('kendaraan.data') }}",
                type: "POST",
                data: {
                    id: $("#kendaraan").val(),
                    _token: '{{csrf_token()}}'
                },
                dataType : 'json',
                success: function(result)
                {
                    value = result.data[0];
                    durasi = $("#durasi").val();
                    harga_sewa_kendaraan = value.harga_sewa * durasi;
                
                    $("#harga_sewa").val(harga_sewa_kendaraan);
                }
            });
        }
        else
        {
            $("#harga_sewa").val(0);
        }
    }

    function showInputAntar(is_diantar)
    {
        if(is_diantar == 0)
        {
            $("#input_antar").css("display", "none");
        }
        else
        {
            $("#input_antar").css("display", "inline-block");
        }
    }

    function tambah()
    {
        $('#edit').modal('show');
    }
</script>
@endsection