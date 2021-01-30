@foreach($outlineInfo as $info)
    <tr>    
      <th>Nama Kendaraan : {{$info->nama_kendaraan}}</th> 
      <th>Harga Sewa : {{$info->harga_sewa}}</th>
      <th>Jenis : {{$info->jenis}}</th>
      <th>Gambar : {{$info->gambar}}</th>
      <th>Cabang : {{$info->cabang->nama_cabang}}</th>
      <button type="button" onclick="window.location='{{route("pelanggan.detailpage.index", $info->id_kendaraan)}}'">Get Detail Info</button>
      <br>
    </tr>
@endforeach