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
                        <li class="active">Ulasan</li>
                    </ol>
                </div>
            </div>

            <div class="panel">          
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>Kendaraan</th>
                                <th>Cabang</th>
                                <th>Jumlah Ulasan</th>
                                <th>Ulasan <br> Ditampilkan</th>
                                <th>Ulasan Tidak <br> Ditampilkan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>                  
                        <tbody>
                            @foreach($kendaraan as $data)
                            <tr class="gradeX">
                                <td>{{ $data['nama_kendaraan'] }}</td>
                                <td>{{ $data['cabang'] }}</td>
                                <td>{{ $data['jumlah_ulasan'] }}</td>
                                <td>{{ $data['jumlah_ulasan_ditampilkan'] }}</td>
                                <td>{{ $data['jumlah_ulasan_tidak_ditampilkan'] }}</td>
                                <td>    
                                    <a href="{{ url('admin/ulasan/detail/'.$data['id_kendaraan']) }}" class="btn btn-icon btn-sm btn-info"><i class="md md-view-list"></i> Daftar Ulasan</a>
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
@endsection