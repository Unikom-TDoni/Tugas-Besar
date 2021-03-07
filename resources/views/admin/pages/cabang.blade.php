@extends('admin.layouts.layout')

@section('content')
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="md md-home"></i> Cabang</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ Route('dashboard') }}">Admin</a></li>
                        <li class="active">Cabang</li>
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
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Nama Cabang</th>
                                <th>No. Telp</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>Aktifasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>                  
                        <tbody>
                            @foreach($cabang as $data)
                            
                            @php
                                $status     = ($data->is_aktif)?"AKTIF":"NON-AKTIF"; 
                                $status_btn = ($data->is_aktif)?"info":"danger"; 
                                $row_bg     = ($data->is_aktif)?"":"background: red;color: white;"; 
                            @endphp
                            
                            <tr class="gradeX" style="{{ $row_bg }}">
                                <td>{{ $data->nama_cabang }}</td>
                                <td>{{ $data->telp }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->kota }}</td>
                                <td>{{ $data->provinsi }}</td>
                                <td>    
                                    <button class="btn btn-icon btn-sm btn-{{ $status_btn }}" onclick="ubahStatus({{ $data->id_cabang }})"> {{ $status }} </button>
                                </td>
                                <td class="actions">
                                    <button class="btn btn-icon btn-sm btn-success" onclick="edit({{ $data->id_cabang }})"> <i class="fa fa-edit"></i> </button> 
                                    <button class="btn btn-icon btn-sm btn-danger" onclick="hapus({{ $data->id_cabang }})"> <i class="fa fa-trash"></i> </button>
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
                <h4 class="modal-title">Cabang</h4> 
            </div> 
            
            <form action="{{ Route('cabang.save') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="id" name="id"> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label class="control-label">Nama Cabang</label> 
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Cabang" required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label class="control-label">No. Telp</label> 
                                <input type="text" class="form-control" id="telp" name="telp" placeholder="No. Telp Cabang" required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label class="control-label">Provinsi</label>
                                <select class="form-control" id="provinsi" name="provinsi" onchange="getKota(this.value)" required>
                                    <option value="">--Pilih Provinsi--</option>
                                    @foreach($provinsi as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label">Kota</label> 
                                <select class="form-control" id="kota" name="kota" required>
                                    <option value="">--Pilih Kota--</option>
                                </select>
                            </div>
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Alamat</label> 
                                <textarea class="form-control autogrow" id="alamat" name="alamat" placeholder="Alamat Cabang" rows="4" required></textarea>
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
    function getKota(id_provinsi, id_kota = '')
    {
        $("#kota").html('');
        $.ajax(
        {
            url:"{{ Route('cabang.getkota') }}",
            type: "POST",
            data: {
                id_provinsi: id_provinsi,
                _token: '{{csrf_token()}}'
            },
            dataType : 'json',
            success: function(result)
            {
                $("#kota").append('<option value="">--Pilih Kota--</option>');
                $.each(result.kota,function(key,value)
                {
                    selected = (id_kota != "" && id_kota == value.id)?"selected":"";

                    $("#kota").append('<option value="'+value.id+'" '+selected+'>'+value.nama+'</option>');
                });
            }
        });
    }

    function tambah()
    {
        $('#edit').modal('show');
        resetValue();
    }

    function edit(id_cabang)
    {
        $('#edit').modal('show');

        $.ajax(
        {
            url:"{{ Route('cabang.data') }}",
            type: "POST",
            data: {
                id_cabang: id_cabang,
                _token: '{{csrf_token()}}'
            },
            dataType : 'json',
            success: function(result)
            {
                $.each(result.cabang,function(key,value)
                {  
                    getKota(value.id_provinsi, value.id_kota);
                    $("#id").val(id_cabang);
                    $("#nama").val(value.nama_cabang);
                    $("#telp").val(value.telp);
                    $("#provinsi").val(value.id_provinsi);
                    $("#kota").val(value.id_kota);
                    $("#alamat").val(value.alamat);
                });
            }
        });
    }

    function resetValue()
    {
        $("#id").val("");
        $("#nama").val("");
        $("#telp").val("");
        $("#provinsi").val("");
        $("#kota").val("");
        $("#alamat").val("");
    }

    function hapus(id_cabang)
    {
        if(!confirm("Apakah anda yakin?")) 
        {
            return false;
        }

        $.ajax(
        {
            url: "{{ Route('cabang.delete') }}",
            type: 'POST',
            data: 
            {
                id_cabang: id_cabang,
                _token: '{{csrf_token()}}'
            },
            success: function (response)
            {
                swal({
                    title: "Berhasil!",
                    text: "Data berhasil dihapus!",
                    type: "success"
                }, function() {
                    location.reload();
                });
            }
        });
        
        return false;
    }

    function ubahStatus(id_cabang)
    {
        $.ajax(
        {
            url: "{{ Route('cabang.aktivasi') }}",
            type: 'POST',
            data: 
            {
                id_cabang: id_cabang,
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