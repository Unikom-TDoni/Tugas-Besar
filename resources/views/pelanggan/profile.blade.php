@extends('pelanggan.layouts.layout')
@section('title_page', 'Recipts')
@section('content')
    <x-pelanggan.navbar/>
    <section class="banner-profile"></section>
    
    <section class="profile">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-6">
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{route('pelanggan.profile.update', $profileData->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-ava">
                            <div class="profile-ava">
                                @if($profileData->gambar == null)
                                    <span>AP</span>
                                @else
                                    <img id="image-ava" src="{{asset('images/profile/'.$profileData->gambar)}}" name="old_gambar"/>
                                @endif
                            </div>
                            <label for="input-ava"><i class="fas fa-camera"></i></label>
                            <input type="file" accept="image/*" name="gambar" id="input-ava">
                        </div>
                        <div class="form-group">
                            <div class="form-group-title">
                                <span class="f-title-md">Personal Info</span>
                            </div>
                            <div class="form-input">
                                <label for="">Full Name</label>
                                <input placeholder="Input your fullname" type="text" placeholder="Nama" name="nama" value="{{$profileData->nama}}">
                            </div>
                            <div class="form-input">
                                <label for="">No.KTP</label>
                                <input placeholder="Input No.KTP" type="number" name="nomor_ktp" value="{{$profileData->nomor_ktp}}">
                            </div>
                            <div class="form-input">
                                <label for="">Date Birth</label>
                                <input type="date" name="tanggal_lahir" value="{{$profileData->tanggal_lahir}}">
                            </div>
                            <div class="form-input">
                                <label for="">Jenis Kelamin</label>
                                <div class="selection-input">
                                    <select name="jenis_kelamin" selected="{{$profileData->jenis_kelamin}}">
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group-title">
                                <span class="f-title-md">Contact Info</span>
                            </div>
                            <div class="form-input">
                                <label for="">Email</label>
                                <input type="email" name="email" value="{{$profileData->email}}" placeholder="Input your email"/>
                            </div>
                            <div class="form-input">
                                <label for="">Phone Number</label>
                                <input placeholder="Input telp number" type="number" name="telp" value="{{$profileData->telp}}">
                            </div>
                            <div class="form-input">
                                <label for="">Address</label>
                                <textarea placeholder="Input your address" name="alamat">{{$profileData->alamat}}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-full btn-primary" onclick="this.disabled=true; this.form.submit();">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <form method="POST" action="{{route('pelanggan.profile.update', $profileData->id)}}" enctype="multipart/form-data">
        @csrf
    </form>
    <x-pelanggan.terms/> 
    <x-pelanggan.footer/>  
    @section('addon-js')
        <script src="{{URL::asset('assets/pelanggan')}}/js/profile.js"></script> 
    @endsection
@endsection