<!-- Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />

<h1>Profile</h1>
<form method="POST" action="{{route('pelanggan.profile.update', $profileData->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <img src="{{asset('images/profile/'.$profileData->gambar)}}" name="old_gambar"><br><br>
    <input type="file" accept="image/*" name="gambar"><br><br>
    <input placeholder="Name" type="text" placeholder="Nama" name="nama" value="{{$profileData->nama}}"><br><br>
    <input placeholder="Alamat" type="text" name="alamat" value="{{$profileData->alamat}}"><br><br>
    <input placeholder="Telp" type="number" name="telp" value="{{$profileData->telp}}"><br><br>
    <input placeholder="No Ktp" type="number" name="nomor_ktp" value="{{$profileData->nomor_ktp}}"><br><br>
    <input type="date" name="tanggal_lahir" value="{{$profileData->tanggal_lahir}}"><br><br>
    <select name="jenis_kelamin" selected="{{$profileData->jenis_kelamin}}">
        <option value="Pria">Pria</option>
        <option value="Wanita">Wanita</option>
    </select>
    <button type="submit">Save</button>
</form>

<form method="POST" action="{{route('pelanggan.profile.logout')}}">
    @csrf
    <button type="submit">Logout</button>
</form>