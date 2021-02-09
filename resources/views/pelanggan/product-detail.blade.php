<!-- Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<tr>    
    <th>Nama Kendaraan : {{$detailInfo->nama_kendaraan}}</th> 
    <th>Harga Sewa : {{$detailInfo->harga_sewa}}</th>
    <th>Jenis : {{$detailInfo->jenis}}</th>
    <th>Merk : {{$detailInfo->merk}}</th>
    <th>Gambar : {{$detailInfo->gambar}}</th>
    <th>Cabang : {{$detailInfo->cabang->nama_cabang}}</th>
    <a href="{{route("pelanggan.transaksi.index", $detailInfo->id_kendaraan)}}">
        <button>Pesan</button>
      </a>
    <br>
</tr>