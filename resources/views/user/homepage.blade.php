@foreach($infoKendaraan as $data)
    <tr>    
      <th>Nama Kendaraan : {{$data->nama_kendaraan}}</th> 
      <th>Harga Sewa : {{$data->harga_sewa}}</th>
      <th>Jenis : {{$data->jenis}}</th>
      <th>Gambar : {{$data->gambar}}</th>
      <br>
    </tr>
@endforeach