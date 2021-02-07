@foreach($outlineInfo as $info)
    <tr>    
      <th>Nama Kendaraan : {{$info->nama_kendaraan}}</th> 
      <th>Harga Sewa : {{$info->harga_sewa}}</th>
      <th>Jenis : {{$info->jenis}}</th>
      <th>Gambar : {{$info->gambar}}</th>
      <th>Cabang : {{$info->cabang->nama_cabang}}</th>
      <a href="{{route("pelanggan.detailpage.index", $info->id_kendaraan)}}">
        <button>Get Detail Info</button>
      </a>
      <br>
    </tr>
@endforeach