@extends('admin.layouts.layout')

@section('content')
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="md md-comment"></i> Ulasan</h4>
                    <ol class="breadcrumb pull-right">
                        <li><a href="{{ Route('dashboard') }}">Admin</a></li>
                        <li><a href="{{ Route('ulasan') }}"> Ulasan</a></li>
                        <li class="active">Daftar Ulasan</li>
                    </ol>
                </div>
            </div>

            <div class="panel panel-default">          
                <div class="panel-heading">
                    <h3 class="panel-title">Daftar Ulasan Kendaraan : {{ $kendaraan->nama_kendaraan }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th style="display: none;">No.</th>
                                <th>No. Telp</th>
                                <th>Nama</th>
                                <th>Kode Transaksi</th>
                                <th>Rating</th>
                                <th>Ulasan</th>
                                <th>Waktu Ulasan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>                  
                        <tbody>
                            @foreach($ulasan as $data)

                            <?php 
                                $status     = ($data->status)?"DITAMPILKAN":"TIDAK DITAMPILKAN"; 
                                $status_btn = ($data->status)?"success":"danger";
                            ?>

                            <tr>
                                <td style="display: none;">{{ $loop->index }}</td>
                                <td>{{ $data->telp }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->kode_transaksi }}</td>
                                <td>{{ $data->rating."/5" }}</td>
                                <td>{{ substr($data->ulasan, 0, 20) }}..</td>
                                <td>{{ date("d-m-Y H:i", strtotime($data->created_at)) }}</td>
                                <td>    
                                    <button class="btn btn-icon btn-sm btn-{{ $status_btn }}" onclick="ubahStatus({{ $data->id }})"> {{ $status }} </button>
                                </td>
                                <td>    
                                    <button class="btn btn-icon btn-sm btn-info" onclick="detail('{{ $data->id }}')"><i class="fa fa-eye"></i> Detail</button>
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
                <h4 class="modal-title">Ulasan</h4> 
            </div> 
            <div class="modal-body">
                <form class="form-horizontal" role="form">     
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
                            <label class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="nama"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kendaraan</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="kendaraan"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kode Transaksi</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="kode_transaksi"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Rating</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="rating"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Ulasan</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="ulasan"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Waktu Ulasan</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="waktu"></p>
                            </div>
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9">
                              <p class="form-control-static" id="status"></p>
                            </div>
                        </div>  
                    </div> 
                </form>
            </div>
        </div> 
    </div>
</div><!-- /.modal -->

<script>
    function detail(id)
    {
        $('#detail').modal('show');
       
        $.ajax(
        {
            url:"{{ Route('ulasan.data') }}",
            type: "POST",
            data: {
                id: id,
                _token: '{{csrf_token()}}'
            },
            dataType : 'json',
            success: function(request)
            {
                value = request.data;

                date        = new Date(value.waktu_ulasan);
                var months  = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                waktu       = date.getDate() + " " + months[date.getMonth()] + " " + date.getFullYear() + " " + date.getHours() + ":" + date.getMinutes();

                status = (value.status==0)?'<label class="label label-danger">TIDAK DITAMPILKAN</label>':'<label class="label label-success">DITAMPILKAN</label>';
                
                $("#telp").html(value.telp);
                $("#nama").html(value.nama);
                $("#kendaraan").html(value.kendaraan);
                $("#kode_transaksi").html(value.kode_transaksi);
                $("#rating").html(value.rating + "/5");
                $("#ulasan").html(value.ulasan);
                $("#waktu").html(waktu);
                $("#status").html(status);
            }
        });
    }

    function ubahStatus(id)
    {
        $.ajax(
        {
            url: "{{ Route('ulasan.status') }}",
            type: 'POST',
            data: 
            {
                id: id,
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