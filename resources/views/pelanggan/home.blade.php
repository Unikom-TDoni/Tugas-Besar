<form action="{{route('pelanggan.homepage.filter')}}" method="POST">
    @csrf
    <select name="id_kota">
      <option value="0" selected>All</option>
      <option value=5103 {{($filterData['id_kota'] ?? 'default') == 5103 ? 'selected' : ''}}>Aceh</option>
      <option value=3273 {{($filterData['id_kota'] ?? 'default') == 3273 ? 'selected' : ''}}>Bandung</option>
      <option value=3471 {{($filterData['id_kota'] ?? 'default') == 3471 ? 'selected' : ''}}>Yogyakarta</option>
      <option value=3173 {{($filterData['id_kota'] ?? 'default') == 3173 ? 'selected' : ''}}>Jakarta Pusat</option>
    </select>

    <select name="jenis">
        <option value="0">All</option>
        <option value="Manual" {{($filterData['jenis'] ?? 'default') == "Manual" ? 'selected' : ''}}>Manual</option>
        <option value="Matic" {{($filterData['jenis'] ?? 'default') == "Matic" ? 'selected' : ''}}>Matic</option>
    </select>
    <button type="submit">FILTER</button>
</form>

@if($outlineInfo->count() == 0)
    <h1>Data Not Found</h1>
@endif

@foreach($outlineInfo as $info)
    <tr>    
      <th>Nama Kendaraan : {{$info->nama_kendaraan}}</th> 
      <th>Harga Sewa : {{$info->harga_sewa}}</th>
      <th>Jenis : {{$info->jenis}}</th>
      <th>Gambar : {{$info->gambar}}</th>
      <th>Cabang : {{$info->cabang->nama_cabang}}</th>
      <a href="{{route("pelanggan.detail.index", $info->id_kendaraan)}}">
        <button>Get Detail Info</button>
      </a>
      <br>
    </tr>
@endforeach