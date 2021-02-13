<form action="ulasanPelanggan/post" method="POST">
{{csrf_field()}}
<input type="hidden" name="id">
<input type="hidden" name="telp" value="089653665">
<input type="hidden" name="id_pelanggan" value="1">
<input type="hidden" name="nama" value="Abraham">
<input type="hidden" name="id_kendaraan" value="1">
<input type="hidden" name="kode_transaksi" value="T210212003">
<br>
rating:<input type="text" name="rating">
<br>
<textarea name="ulasan" id="ulasan" cols="30" rows="10"></textarea>
<input type="submit" value="kirim">
</form>


