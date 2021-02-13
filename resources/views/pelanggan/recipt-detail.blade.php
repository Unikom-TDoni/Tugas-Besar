<tr>    
    <th>Kode Transaksi {{$detailInfo->kode_transaksi}}</th> <br>
    <th>Tanggal Mulai {{$detailInfo->tanggal_mulai_peminjaman}}</th> <br>
    <th>Tanggal Berahkir {{$detailInfo->tanggal_akhir_peminjaman}}</th> <br>
    <th>Nama Kendaraan : {{$detailInfo->kendaraan->nama_kendaraan}}</th> <br>
    <th>Harga Sewa : {{$detailInfo->kendaraan->harga_sewa}}</th> <br>
    <th>Jenis : {{$detailInfo->kendaraan->jenis}}</th> <br>
    <th>Merk : {{$detailInfo->kendaraan->merk}}</th> <br>
    <th>Gambar : {{$detailInfo->kendaraan->gambar}}</th> <br>
    <th>Status : {{$detailInfo->status_recipt}}</tr> <br>
    Test <br>
    @if($detailInfo->status_recipt == "Menunggu Transfer")
        <th>Cara Bayar</th> <br>
        <th> Silahkan Transfer ke 02932212322</th>
        <br>
        <form method="POST" action="{{route("pelanggan.recipt.confrim", $detailInfo->kode_transaksi)}}">
            @csrf
            @method('PUT')
            <button type="submit">Konfirmasi Pembayaran</button>
        </form>
        </a>
    @elseif($detailInfo->status_recipt === "Menunggu Pembayaran")
        <th>Cara Bayar</th> <br>
        <th> Silahkan menuju ke alamat cabang</th>
    @elseif($detailInfo->status_recipt === "Transaksi Selesai")
        <form action="../ulasanPelanggan" method="GET" > 
            <button type="submit">Masukan Ulasan</button>
        </form>    
    @endif
    <br>
</tr>

<button>Beri Ulasan</button>

<br><br>
<form method="POST" action="{{route("pelanggan.recipt.review.store")}}">
    @csrf
    <input name="id_pelanggan" value="{{$detailInfo->pelanggan->id}}" hidden readonly>
    <input name="kode_transaksi" value="{{$detailInfo->kode_transaksi}}" hidden readonly>
    <input name="id_kendaraan" value="{{$detailInfo->kendaraan->id_kendaraan}}" hidden readonly>
    <textarea name="ulasan" cols="30" rows="10" placeholder="Ulasan"></textarea><br><br>
    <input type="number" name="rating" placeholder="rating"><br><br>
    <button type="submit">Comment</button><br>
</form>