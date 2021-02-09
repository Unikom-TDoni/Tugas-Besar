<form action="./ulasan/post" method="POST">
{{csrf_field()}}
id: <input type="number" name="id">
<input type="hidden" name="telp" value="089653665">
<input type="hidden" name="nama" value="Abraham dos">
<input type="hidden" name="id_kendaraan" value="5">
<input type="hidden" name="kode_transaksi" value="T210207001">
<br>
rating:<input type="text" name="rating">
<br>
<textarea name="ulasan" id="ulasan" cols="30" rows="10"></textarea>
<input type="submit" value="kirim">
</form>
