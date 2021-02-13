@extends('admin.layouts.layout')

@section('content')
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container">
        <!-- Page-Title -->
        <div class="row">
          <div class="col-sm-12">
              <h4 class="pull-left page-title"><i class="md md-dashboard"></i> Dashboard</h4>
              <ol class="breadcrumb pull-right">
                  <li><a href="{{ Route('dashboard') }}">Dashboard</a></li>
              </ol>
          </div>
        </div>

        <!-- Start Widget -->
        <div class="row">
          <div class="col-md-6 col-sm-6 col-lg-3">
              <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-info"><i class="md md-home"></i></span>
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{ $jumlah_cabang }}</span>
                      Jumlah Cabang
                  </div>
              </div>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-3">
              <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-purple"><i class="fa fa-bicycle"></i></span>
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{ $jumlah_kendaraan }}</span>
                      Jumlah Kendaraan
                  </div>
              </div>
          </div>
          
          <div class="col-md-6 col-sm-6 col-lg-3">
              <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-success"><i class="fa fa-user"></i></span>
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{ $jumlah_pelanggan }}</span>
                      Jumlah Pelanggan
                  </div>
              </div>
          </div>

          <div class="col-md-6 col-sm-6 col-lg-3">
              <div class="mini-stat clearfix bx-shadow">
                  <span class="mini-stat-icon bg-primary"><i class="fa fa-users"></i></span>
                  <div class="mini-stat-info text-right text-muted">
                      <span class="counter">{{ $jumlah_user }}</span>
                      Jumlah User
                  </div>
              </div>
          </div>
      </div> 
      <!-- End row-->

      <div class="panel panel-default">    
        <div class="panel-heading">
          <h3 class="panel-title">Transaksi Hari Ini</h3>
        </div>      
        <div class="panel-body">
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
                    
                    @php 
                        if($data->status_transaksi == 0)
                        {
                            $status     = "Transaksi Diproses";
                            $label_bg   = "label-info";
                        }
                        elseif ($data->status_transaksi == 1) 
                        {
                            $status     = "Transaksi Selesai";   
                            $label_bg   = "label-success";
                        }
                        else
                        {
                            $status     = "Transaksi Batal";
                            $label_bg   = "label-danger";
                        }
                    @endphp
                    
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
            <hr>
            <div style="float: right">
              <a href="{{ Route('transaksi') }}" class="btn btn-icon btn-sm btn-primary">LIHAT SEMUA TRANSAKSI <i class="fa fa-arrow-right"></i></i></a>
            </div>
        </div>
        <!-- end: page -->
    </div> <!-- end Panel -->

    </div>
  </div>
</div>



                   
@endsection