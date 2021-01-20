@extends('admin.layouts.layout')

@section('content')
  <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="pull-left page-title"><i class="fa fa-users"></i> Users</h4>
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
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>                  
                        <tbody>
                            @foreach($user as $data)
                            
                            <tr class="gradeX">
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->name }}</td>
                                <td class="actions">
                                    <button class="btn btn-icon btn-sm btn-success" onclick="edit({{ $data->id }})"> <i class="fa fa-edit"></i> </button> 
                                    <button class="btn btn-icon btn-sm btn-danger" onclick="hapus({{ $data->id }})"> <i class="fa fa-trash"></i> </button>
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
                <h4 class="modal-title">Users</h4> 
            </div> 
            
            <form action="{{ Route('users.save') }}" method="post" enctype="multipart/form-data" id="modalform">
                {{ csrf_field() }}
                <div class="modal-body">
                    <input type="hidden" id="id" name="id"> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label class="control-label">Username</label> 
                                <input type="text" class="form-control" id="username" name="username" required> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Nama</label> 
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Password</label> 
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div> 
                        </div> 
                    </div> 
                    <div class="row"> 
                        <div class="col-md-12"> 
                            <div class="form-group"> 
                                <label for="field-7" class="control-label">Konfirmasi Password</label> 
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div> 
                        </div> 
                    </div> 
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup <i class="fa fa-close"></i></button> 
                    <button type="button" id="submit" class="btn btn-primary waves-effect waves-light" onclick="simpan()">Simpan <i class="fa fa-save"></i></button> 
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
            url:"{{ Route('users.data') }}",
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
                    $("#username").val(value.username);
                    $("#name").val(value.name);
                    $("#password").val('');
                    $("#confirm_password").val('');
                });
            }
        });
    }

    function resetValue()
    {
        $("#id").val("");
        $("#username").val("");
        $("#name").val("");
        $("#password").val("");
        $("#confirm_password").val("");
    }

    function simpan()
    {
        if($("#username").val() == "")
        {
            alert("Harap isi username!");
            return false;
        }
        
        if($("#name").val() == "")
        {
            alert("Harap isi nama!");
            return false;
        }

        if($("#id").val() == "" && $("#password").val() == "")
        {
            alert("Harap isi password!");
            return false;
        }
        
        if($("#password").val() != $("#confirm_password").val())
        {
            alert("Konfirmasi Password Tidak Sesuai!");
            return false;
        }

        $.ajax(
        {
            url: "{{ Route('users.save') }}",
            type: 'POST',
            data: 
            {
                id: $("#id").val(),
                username: $("#username").val(),
                name: $("#name").val(),
                password: $("#password").val(),
                _token: '{{csrf_token()}}'
            },
            success: function (response)
            {
                if(response.status != "OK")
                {
                    alert(response.pesan);
                    return false;
                }
                else
                {
                    swal({
                        title: "Berhasil!",
                        text: "Data berhasil disimpan!",
                        type: "success"
                    }, function() {
                        location.reload();
                    });
                }
            }
        });
        
        return false;
    }

    function hapus(id)
    {
        if(!confirm("Apakah anda yakin?")) 
        {
            return false;
        }

        $.ajax(
        {
            url: "{{ Route('users.delete') }}",
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