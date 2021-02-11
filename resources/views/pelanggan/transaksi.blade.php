<script src="{{asset('assets/pelanggan/js/formTransaksi.js')}}"></script>

<body onload="setMinDateMulaiPinjam(); adjustDateAkhirPinjam();">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form action="{{route('pelanggan.transaksi.store')}}" method="post">
        @csrf
        <input type="text" name="id_pelanggan" value="{{$dataTransaksi['pelanggan']->id}}" hidden readonly>
        <input type="text" name="id_kendaraan" value="{{$dataTransaksi['kendaraan']->id_kendaraan}}" hidden readonly>
        <input type="number" name="harga_sewa" value="{{$dataTransaksi['kendaraan']->harga_sewa}}" hidden readonly>
        <input type="number" name="denda" value="{{$dataTransaksi['kendaraan']->denda}}" hidden readonly>
        
        <input type="text" placeholder="nama" name="nama" value="{{$dataTransaksi['pelanggan']->nama}}" readonly><br><br>
        <input type="text" placeholder="nomor telepon" name="telp" value="{{$dataTransaksi['pelanggan']->telp}}" readonly><br><br>
        <input type="text" placeholder="alamat" name="alamat" value="{{$dataTransaksi['pelanggan']->alamat}}" readonly><br><br>
        <input type="text" placeholder="no ktp" name="nomor_ktp" value="{{$dataTransaksi['pelanggan']->nomor_ktp}}" readonly><br><br>
        <input type="date" name="tanggal_mulai_peminjaman" id="tanggal_mulai_peminjaman" onchange="adjustDateAkhirPinjam(this)" value="{{old('tanggal_mulai_peminjaman')}}"><br><br>
        <input type="date" name="tanggal_akhir_peminjaman" id="tanggal_akhir_peminjaman" value="{{old('tanggal_akhir_peminjaman')}}"><br><br>

        <select name="is_transfer" id="tipe_pembayaran" onchange="chooseTipePembayaran()">
            <option value=0 {{old('is_transfer') == 0 ? 'selected' : ''}}>Manual</option>
            <option value=1 {{old('is_transfer') == 1 ? 'selected' : ''}}>Transfer</option>
        </select>

        <br><br>

        <div id="data_transfer" style="display: none;">
            <input placeholder="Nama Bank" type="string" name="nama_bank" value="{{old('nama_bank')}}"><br><br>
            <input placeholder="No Rekening" type="number" name="nomor_rekening" value="{{old('nomor_rekening')}}"><br><br>
            <input placeholder="Atas Nama" type="string" name="nama_rekening" value="{{old('atas_nama')}}"><br><br>
        </div>

        <select name="is_diantar" id="tipe_pengambilan" onchange="chooseTipePengambilan()" style="display: none;" selected="{{old('is_diantar')}}">
            <option value=0>Ambil Di Tempat</option>
            <option value=1>Di Antar</option>
        </select>

        <div id="data_antar" style="display: none;">
            <input type="time" name="waktu_antar" value="{{old('waktu_antar')}}"><br><br>
            <input placeholder="alamat antar" type="text" name="alamat_antar" value="{{old('alamat_antar')}}">
        </div>
        <br>
        <button type="submit">Pesan</button>
    </form>
    
</body>



