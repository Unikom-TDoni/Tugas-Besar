@extends('pelanggan.layouts.layout')
@section('title_page', 'Order')
@section('content')
  <x-pelanggan.navbar/>
    <section class="checkout-order">
        <div class="container">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form action="{{route('pelanggan.detail.store')}}" method="post" class="row form-checkout">
                @csrf
                <div class="col-8">
                    <div class="detail-checkout">
                        <div class="detail-checkout-title">
                            <h3 class="h3">Checkout Rentall</h3>
                        </div>
                        <div class="detail-checkout-info" >
                            <div class="detail-checkout-row personal-detail">
                                <div class="input-title">
                                    <span class="personal-detail-label f-title-sm">Personal Detail</span>
                                </div>
                                <div class="input-field">
                                    <div class="personal-detail-card">
                                        <p class="f-title-sm">{{$dataTransaksi['pelanggan']->nama}}</p>
                                        <input type="text" placeholder="nama" name="nama" value="{{$dataTransaksi['pelanggan']->nama}}" readonly hidden>
                                        <span class="f-meta-data">
                                            No.KTP {{$dataTransaksi['pelanggan']->nomor_ktp}}
                                            <input type="text" placeholder="no ktp" name="nomor_ktp" value="{{$dataTransaksi['pelanggan']->nomor_ktp}}" readonly hidden>
                                        </span>
                                        <span class="f-meta-data">
                                            Phone: {{$dataTransaksi['pelanggan']->telp}}
                                            <input type="text" placeholder="nomor telepon" name="telp" value="{{$dataTransaksi['pelanggan']->telp}}" readonly hidden>
                                        </span>
                                        <input type="text" placeholder="alamat" name="alamat" value="{{$dataTransaksi['pelanggan']->alamat}}" readonly hidden>
                                        <input type="text" name="id_pelanggan" value="{{$dataTransaksi['pelanggan']->id}}" hidden readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="detail-checkout-row payment-detail">
                                <div class="input-title">
                                    <span class="payment-detail-label f-title-sm">Payment Detail</span>
                                </div>
                                <div class="input-field">
                                    <div class="input-field-row">
                                        <label for="">Payment Method</label>
                                        <div class="selection-input">
                                            <select name="is_transfer" id="tipe_pembayaran">
                                                <option value=0 {{old('is_transfer') == 0 ? 'selected' : ''}}>Bayar di Tempat</option>
                                                <option value=1 {{old('is_transfer') == 1 ? 'selected' : ''}}>Bank Transfer</option>
                                            </select>
                                        </div>
                                        {{-- <div id="data_transfer" style="display: none;">
                                            <input placeholder="Nama Bank" type="string" name="nama_bank" value="{{old('nama_bank')}}"><br><br>
                                            <input placeholder="No Rekening" type="number" name="nomor_rekening" value="{{old('nomor_rekening')}}"><br><br>
                                            <input placeholder="Atas Nama" type="string" name="nama_rekening" value="{{old('atas_nama')}}"><br><br>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="detail-checkout-row rentall-detail">
                                <div class="input-title">
                                    <span class="rentall-detail-label f-title-sm">Rental Detail</span>
                                </div>
                                <div class="input-field">
                                    <div class="input-field-row date-range">
                                        <div class="date-start">
                                            <label for="">Rentall Date</label>
                                            <input type="date" name="tanggal_mulai_peminjaman" id="tanggal_mulai_peminjaman" onchange="onStartDateBookingChange()" value="{{old('tanggal_mulai_peminjaman')}}">
                                        </div>
                                        <div class="date-end">
                                            <label for="">Rentall End</label>
                                            <input type="date" name="tanggal_akhir_peminjaman" id="tanggal_akhir_peminjaman" onchange="onEndDateBookingChange()" value="{{old('tanggal_akhir_peminjaman')}}">
                                        </div>
                                    </div>
                                    <div class="input-field-row">
                                        <label for="">Rentall Method</label>
                                        <div class="selection-input">
                                            <select name="is_diantar" id="tipe_pengambilan" onchange="chooseTipePengambilan()" style="display: block;">
                                                <option value=0 {{old('is_diantar') == 0 ? 'selected' : ''}}>Ambil Di Tempat</option>
                                                <option value=1 {{old('is_diantar') == 1 ? 'selected' : ''}}>Di Antar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="data_antar" style="display: none;">
                                        <div class="input-field-row">
                                                <label for="">Rentall Time</label>
                                                <input type="time" name="waktu_antar" value="{{old('waktu_antar')}}">
                                        </div>
                                        <div class="input-field-row">
                                            <label for="">Alamat pengantaran</label>
                                            <textarea name="alamat_antar" value="{{old('alamat_antar')}}" placeholder="Alamat Antar"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="recipt-checkout">
                        <div class="recipt">
                            <div class="recipt-title">
                                <div class="title-image">
                                    <img src="{{asset('images/kendaraan/'.$dataTransaksi['kendaraan']->gambar)}}" alt="Sepeda Motor">
                                </div>
                                <div class="title-text">
                                    <h4 class="f-title-sm">{{$dataTransaksi['kendaraan']->nama_kendaraan}}</h4>
                                    <div class="meta-tag f-meta-data">{{$dataTransaksi['kendaraan']->jenis}} {{$dataTransaksi['kendaraan']->tahun}} - {{$dataTransaksi['kendaraan']->warna}}</div>
                                    <input type="text" name="id_kendaraan" value="{{$dataTransaksi['kendaraan']->id_kendaraan}}" hidden readonly>
                                </div>
                            </div>
                            <div class="recipt-info">
                                <div class="recipt-info-row">
                                    <span class="f-meta-data">Plat Nomor</span>
                                    <span class="f-button-md">{{$dataTransaksi['kendaraan']->nomor_plat}}</span>
                                </div>
                                <div class="recipt-info-row">
                                    <span class="f-meta-data">Rentall Date</span>
                                    <span class="f-button-md" id="recipt_info_depart"></span>
                                </div>
                                <div class="recipt-info-row">
                                    <span class="f-meta-data">Return Date</span>
                                    <span class="f-button-md" id="recipt_info_return"></span>
                                </div>
                                <div class="recipt-info-row summary">
                                    <div class="summary-line">
                                        <span class="f-body">Price</span>
                                        <span class="f-body">IDR {{$dataTransaksi['kendaraan']->harga_sewa}}/Day</span>
                                    </div>
                                    <div class="summary-line">
                                        <span class="f-body">Days</span>
                                        <span class="f-body" id="borrow_day"></span>
                                    </div>
                                    <div class="summary-line total">
                                        <span class="f-body">Total Price</span>
                                        <span class="f-title-sm total-price" price="({{$dataTransaksi['kendaraan']->harga_sewa}}x2)" id="total_price_info"></span>
                                        <input type="number" name="harga_sewa" id="harga_sewa" value="{{$dataTransaksi['kendaraan']->harga_sewa}}" hidden readonly>
                                        <input type="number" name="denda" value="{{$dataTransaksi['kendaraan']->denda}}" hidden readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-icon btn-full btn-md btn-primary" type="submit" id="btn_submit" onclick="this.disabled=true; this.form.submit();"></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <x-pelanggan.terms/> 
    <x-pelanggan.footer/>   
    <script src="{{asset('assets/pelanggan/js/formTransaksi.js')}}" onload="initForm();"></script>
@endsection