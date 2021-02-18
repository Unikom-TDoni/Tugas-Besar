@extends('pelanggan.layouts.layout')
@section('title_page', 'Detail')
@section('content')
    <x-pelanggan.navbar/>
    <section class="product-details">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="product-pic">
                        <img src="{{asset('images/kendaraan/'.$detailInfo->gambar)}}" alt="product pic">
                    </div>
                    <div class="product-desc">
                        <h3 class="h3">Product Description</h3>
                        <p class="f-body desc">{{$detailInfo->deskripsi}}</p>
                        <div class="product-spec">
                            <h4 class="f-title-md">Spesification</h4>
                            <table class="spec">
                                <tr class="spec-title">
                                  <td>Merk</td>
                                  <td>:</td>
                                  <td>{{$detailInfo->merk}}</td>
                                </tr>
                                <tr class="spec-title">
                                  <td>Type</td>
                                  <td>:</td>
                                  <td>{{$detailInfo->jenis}}</td>
                                </tr>
                                <tr class="spec-title">
                                    <td>Warna</td>
                                    <td>:</td>
                                    <td>{{$detailInfo->warna}}</td>
                                </tr>
                                <tr class="spec-title">
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td>{{$detailInfo->tahun}}</td>
                                </tr>
                                <tr class="spec-title">
                                    <td>Plat</td>
                                    <td>:</td>
                                    <td>{{$detailInfo->nomor_plat}}</td>
                                </tr>
                                <tr class="spec-title">
                                    <td>Jaminan Pinjaman</td>
                                    <td>:</td>
                                    <td>KTP, SIM, NPWP, Kartu Mahasiswa. (Pilih 2)</td>
                                </tr>
                                <tr class="spec-title">
                                    <td>Harga Denda Telat</td>
                                    <td>:</td>
                                    <td>Rp. {{$detailInfo->harga_sewa}}/day (Akumulatif per hari)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="product-review" id="product-review">
                            <h4 class="f-title-md">Reviews</h4>
                            <div class="product-review-content">
                                @foreach ($reviewInfo as $info)
                                    <x-pelanggan.review :reviewInfo="$info"/>
                                @endforeach
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="col-4">
                    <div class="product-cta">
                        <div class="product-card">
                            <div class="product-title f-title-md">
                                {{$detailInfo->nama_kendaraan}}
                            </div>
                            <div class="product-meta-data f-meta-data">
                                <span class="meta-data-type">{{$detailInfo->jenis}}</span>
                                <span class="meta-data-year">{{$detailInfo->tahun}}</span>
                                <span class="meta-data-color">{{$detailInfo->warna}}</span>
                            </div>
                            <div class="product-review">
                                <div class="ratings">
                                    @for ($i = 0; $i < $reviewInfo->avg('rating'); $i++)
                                        <span class="icon-rating"><i class="fas fa-star"></i></span>
                                    @endfor
                                    <a href="#product-review" title="2 Reviews">{{count($reviewInfo)}} Reviews</a>
                                </div>
                            </div>
                            <div class="product-price">
                                <span class="h2">IDR {{$detailInfo->harga_sewa}}/Day</span>
                            </div>
                            <div class="product-branch">
                                <i class="icon fas fa-map-marker-alt"></i>
                                <span class="f-meta-data">{{$detailInfo->cabang->nama_cabang}} - {{$detailInfo->cabang->kota->nama}}</span>
                            </div>
                        </div>
                        <a href="{{route("pelanggan.detail.show", $detailInfo->id_kendaraan)}}" class="product-cta-btn btn btn-md btn-primary btn-full btn-icon">
                            <i class="fas fa-handshake"></i> Rent Now
                        </a>
                        <a href="#" class="product-cta-btn btn btn-md btn-secondary btn-full btn-icon">
                            <i class="fas fa-directions"></i> Get Direction to RentAll
                        </a>
                        <p class="info f-meta-data">**Semua Peminjam wajib memiliki SIM C atau lisensi mengemudi dari negara asal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="relates">
        <div class="container">
            <h3 class="h3">Relates</h3>
            <div class="row">
                <div class="swiper-container relates-slider">
                    <div class="swiper-wrapper">
                        @foreach($outlineInfo as $info)
                            <div class="swiper-slide">
                                <x-pelanggan.item :outlineInfo="$info"/>
                            </div>
                        @endforeach
                    </div>
                    <div class="slide-next"></div>
                    <div class="slide-prev"></div>
                </div>
            </div>
        </div>
    </section>
    <x-pelanggan.keyvalue/>
    <x-pelanggan.terms/>
    <x-pelanggan.footer/>    
@endsection