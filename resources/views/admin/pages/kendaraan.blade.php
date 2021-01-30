@extends('admin.layouts.layout')

@section('content')
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="fa fa-bicycle"></i> Kendaraan</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ Route('dashboard') }}">Admin</a></li>
                        <li class="active">Kendaraan</li>
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
                                <th>Nama Kendaraan</th>
                                <th>Merk</th>
                                <th>Jenis</th>
                                <th>Harga Sewa</th>
                                <th>Denda</th>
                                <th>Cabang</th>
                                <th>Jumlah</th>
                                <th>Tersedia</th>
                                <th>Terpakai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>                  
                        <tbody>
                            @foreach($kendaraan as $data)
                            
                            <tr class="gradeX">
                                <td>{{ $data->nama_kendaraan }}</td>
                                <td>{{ $data->merk }}</td>
                                <td>{{ $data->jenis }}</td>
                                <td>{{ "Rp ". number_format($data->harga_sewa, 0, ",", ".") }}</td>
                                <td>{{ "Rp ".number_format($data->denda, 0, ",", ".") }}</td>
                                <td>{{ $data->cabang }}</td>
                                <td>{{ $data->jumlah_kendaraan }}</td>
                                <td>{{ $data->jumlah_tersedia }}</td>
                                <td>{{ $data->jumlah_terpakai }}</td>
                                <td class="actions">
                                    <button class="btn btn-icon btn-sm btn-success" onclick="edit({{ $data->id_kendaraan }})"> <i class="fa fa-edit"></i> </button> 
                                    <button class="btn btn-icon btn-sm btn-danger" onclick="hapus({{ $data->id_kendaraan }})"> <i class="fa fa-trash"></i> </button>
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
                <h4 class="modal-title">Kendaraan</h4> 
            </div> 
            
            <form action="{{ Route('kendaraan.save') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="id" name="id"> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label class="control-label">Nama Kendaraan</label> 
                                <input type="text" class="form-control" id="nama" name="nama" required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label class="control-label">Merk</label>
                                <input type="text" class="form-control" id="merk" name="merk" required> 
                            </div> 
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label">Jenis</label> 
                                <select class="form-control" id="jenis" name="jenis" required>
                                    <option value="">--Pilih Jenis Kendaraan--</option>
                                    <option value="Matic">Matic</option>
                                    <option value="Bebek">Bebek</option>
                                    <option value="Trail">Trail / Offroad</option>
                                    <option value="Sport">Sport</option>
                                </select>
                            </div> 
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label for="field-5" class="control-label">Harga Sewa</label> 
                                <input type="number" class="form-control" id="harga" name="harga" required> 
                            </div> 
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group"> 
                                <label class="control-label">Denda Keterlambatan</label>
                                <input type="number" class="form-control" id="denda" name="denda" required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Cabang</label> 
                                <select class="form-control" id="cabang" name="cabang" required>
                                    <option value="">--Pilih Cabang--</option>
                                    @foreach($cabang as $data)
                                    <option value="{{ $data->id_cabang }}">{{ $data->nama_cabang }}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Jumlah Kendaraan</label> 
                                <input type="number" class="form-control" id="jumlah" name="jumlah" required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Gambar</label> 
                                <input type="file" class="form-control" id="gambar" name="gambar" onchange="showGambar(this);"> 
                            </div> 
                        </div> 
                    </div> 

                    <div class="panel panel-default" style="width: 200px; height: 150px;">
                        <img id="gambar_src" src="" style="width:100%"/>
                        <input name="old_gambar" id="old_gambar" type="hidden" class="form-control">
                    </div>

                    <br><br>
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
    function tambah()
    {
        $('#edit').modal('show');
        resetValue();
    }

    function edit(id)
    {
        $('#edit').modal('show');

        $.ajax(
        {
            url:"{{ Route('kendaraan.data') }}",
            type: "POST",
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            dataType : 'json',
            success: function(result)
            {
                $.each(result.data,function(key,value)
                {
                    $("#id").val(id);
                    $("#nama").val(value.nama_kendaraan);
                    $("#merk").val(value.merk);
                    $("#jenis").val(value.jenis);
                    $("#harga").val(value.harga_sewa);
                    $("#denda").val(value.denda);
                    $("#cabang").val(value.id_cabang);
                    $("#jumlah").val(value.jumlah_kendaraan);
                    $("#old_gambar").val(value.gambar);
                    $("#gambar_src").attr("src", "{{ URL::asset('images/kendaraan') }}" + "/" + value.gambar);
                });
            }
        });
    }

    function showGambar(input) 
    {
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();
            reader.onload = function (e) {
            $('#gambar_src')
                .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetValue()
    {
        $("#id").val("");
        $("#nama").val("");
        $("#merk").val("");
        $("#jenis").val("");
        $("#harga").val("");
        $("#denda").val("");
        $("#cabang").val("");
        $("#jumlah").val("");
        $("#gambar").val("");
        $("#gambar_old").val("");
        $("#gambar_src").attr("src", "");
    }

    function hapus(id)
    {
        if(!confirm("Apakah anda yakin?")) 
        {
            return false;
        }

        $.ajax(
        {
            url: "{{ Route('kendaraan.delete') }}",
            type: 'POST',
            data: 
            {
                id: id,
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
</script>
@endsection