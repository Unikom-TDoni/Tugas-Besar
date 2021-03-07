@extends('admin.layouts.layout')

@section('content')
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="fa fa-user"></i> Pelanggan</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ Route('dashboard') }}">Admin</a></li>
                        <li class="active">Pelanggan</li>
                    </ol>
                </div>
            </div>

            <div class="panel">          
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>No. Telp</th>
                                <th>No. KTP</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>                  
                        <tbody>
                            @foreach($pelanggan as $data)
                            <tr class="gradeX">
                                <td>{{ $data->nama }}</td>
                                <td>{{ ($data->tanggal_lahir!="")?date("d-m-Y", strtotime($data->tanggal_lahir)):"" }}</td>
                                <td>{{ $data->jenis_kelamin }}</td>
                                <td>{{ $data->telp }}</td>
                                <td>{{ $data->nomor_ktp }}</td>
                                <td>{{ $data->email }}</td>
                                <td>    
                                    <button class="btn btn-icon btn-sm btn-info" onclick="detail('{{ $data->telp }}')"><i class="fa fa-eye"></i> Detail</button>
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
  
  <div id="detail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Pelanggan</h4> 
            </div> 
            <div class="modal-body">
                <form class="form-horizontal" role="form">     
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="nama"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tanggal Lahir</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="tanggal_lahir"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="jenis_kelamin"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Alamat</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="alamat"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">No. Telp</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="telp"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">No. KTP</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="ktp"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="email"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Waktu Daftar</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="waktu_daftar"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Foto</label>
                            <div class="col-sm-9">
                                <div class="panel panel-default" style="width: 200px; height: 150px;">
                                    <img id="foto" src="" style="width:100%"/>
                                </div>
                            </div>
                        </div>  
                    </div> 
                </form>
            </div>
        </div> 
    </div>
</div><!-- /.modal -->

<script>
    function detail(telp)
    {
        $('#detail').modal('show');
       
        $.ajax(
        {
            url:"{{ Route('pelanggan.data') }}",
            type: "POST",
            data: {
                telp: telp,
                _token: '{{csrf_token()}}'
            },
            dataType : 'json',
            success: function(request)
            {
                value = request.data;

                date_tl = new Date(value.tanggal_lahir);
                date_td = new Date(value.created_at);

                var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                tgl_lahir       = (value.tanggal_lahir !== null)?date_tl.getDate() + " " + months[date_tl.getMonth()] + " " + date_tl.getFullYear():"";
                waktu_daftar    = date_td.getDate() + " " + months[date_td.getMonth()] + " " + date_td.getFullYear() + " " + date_td.getHours() + ":" + date_td.getMinutes();

                $("#nama").html(value.nama);
                $("#tanggal_lahir").html(tgl_lahir);
                $("#jenis_kelamin").html(value.jenis_kelamin);
                $("#alamat").html(value.alamat);
                $("#telp").html(value.telp);
                $("#ktp").html(value.nomor_ktp);
                $("#email").html(value.email);
                $("#waktu_daftar").html(waktu_daftar);
                $("#foto").attr("src", "{{ URL::asset('images/pelanggan') }}" + "/" + value.gambar);
            }
        });
    }
</script>
@endsection