


@foreach($outlineInfo as $info)
    <tr>    
      <th>Kode Transaksi : {{$info->kode_transaksi}}</th> 
      <th>Nama Kendaraan : {{$info->kendaraan->nama_kendaraan}}</th>
      <th>Status : {{$info->status_recipt}}</th>
      <a href="{{route("pelanggan.recipt.show", $info->kode_transaksi)}}">
        <button>Detail Recipt</button>
      </a>
      <br>
      <br>
    </tr>
@endforeach