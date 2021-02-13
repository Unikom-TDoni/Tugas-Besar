@extends('pelanggan.layouts.layout')
@section('title_page', 'Detail')
@section('content')
    <x-pelanggan.navbar/>
    <section class="product-details">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="product-pic">
                        <img src="https://sales.nambomotor.com/wp-content/uploads/2020/08/CT125_featured.png" alt="product pic">
                    </div>
                    <div class="product-desc">
                        <h3 class="h3">Product Description</h3>
                        <p class="f-body desc">Bukalapak merupakan situs belanja online terpercaya di Indonesia yang menjual beragam produk yang dibutuhkan seluruh masyarakat Indonesia. Seiring berkembangnya teknologi, semakin banyak aktivitas yang dilakukan secara digital, lebih mudah dan praktis.</p>
                        <div class="product-spec">
                            <h4 class="f-title-md">Spesification</h4>
                            <table class="spec">
                                <tr class="spec-title">
                                  <td>Merk</td>
                                  <td>:</td>
                                  <td>Honda</td>
                                </tr>
                                <tr class="spec-title">
                                  <td>Type</td>
                                  <td>:</td>
                                  <td>Matic</td>
                                </tr>
                                <tr class="spec-title">
                                    <td>Warna</td>
                                    <td>:</td>
                                    <td>Merah</td>
                                </tr>
                                <tr class="spec-title">
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td>2018</td>
                                </tr>
                                <tr class="spec-title">
                                    <td>Plat</td>
                                    <td>:</td>
                                    <td>D 2xxx ABC</td>
                                </tr>
                                <tr class="spec-title">
                                    <td>Jaminan Pinjaman</td>
                                    <td>:</td>
                                    <td>KTP, SIM, NPWP, Kartu Mahasiswa. (Pilih 2)</td>
                                </tr>
                                <tr class="spec-title">
                                    <td>Harga Denda Telat</td>
                                    <td>:</td>
                                    <td>Rp. 190.000/day (Akumulatif per hari)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="product-review" id="product-review">
                            <h4 class="f-title-md">Reviews</h4>
                            <div class="product-review-content">
                                @for ($i = 0; $i < 2; $i++)
                                    <x-pelanggan.review/>
                                @endfor
                            </div>
                        </div>
                    </div>      
                </div>
                <div class="col-4">
                    <div class="product-cta">
                        <div class="product-card">
                            <div class="product-title f-title-md">
                                Honda Beat Street
                            </div>
                            <div class="product-meta-data f-meta-data">
                                <span class="meta-data-type">Matic</span>
                                <span class="meta-data-year">2018</span>
                                <span class="meta-data-color">Merah</span>
                            </div>
                            <div class="product-review">
                                <div class="ratings">
                                    @for ($i = 0; $i < 5; $i++)
                                        <span class="icon-rating"><i class="fas fa-star"></i></span>
                                    @endfor
                                    <a href="#product-review" title="2 Reviews">2 Reviews</a>
                                </div>
                            </div>
                            <div class="product-price">
                                <span class="h2">IDR 175.000/Day</span>
                            </div>
                            <div class="product-branch">
                                <i class="icon fas fa-map-marker-alt"></i>
                                <span class="f-meta-data">Geger Kalong - Bandung Utara</span>
                            </div>
                        </div>
                        <a href="#" class="product-cta-btn btn btn-md btn-primary btn-full btn-icon">
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
                        @for ($i = 0; $i < 12; $i++)
                            <div class="swiper-slide">
                                <x-pelanggan.item/>
                            </div>
                        @endfor
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