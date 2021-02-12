@extends('pelanggan.layouts.layout')
@section('title_page', 'Homepage')

@section('content')
    <x-pelanggan.navbar/>
    <section style="
        background: url({{URL::asset('assets/pelanggan')}}/img/banner.jpg) center center;
        background-size: cover;
        height: 160px;
        width: 100%;
    ">
        
    </section>
    <div class="container" style="margin-top: 120px">
        <h2 class="h2" style="margin-bottom: 32px">Motor For Rent</h2>
        <div class="row">
            @for ($i = 0; $i < 12; $i++)
                <div class="col-3">
                    <x-pelanggan.item/>
                </div>
            @endfor
        </div>
    </div>
    <div class="container" style="margin-top: 64px; text-align:center">
        <a href="#" class="btn btn-md btn-secondary btn-50">Load More</a>
    </div>
    <div class="container" style="margin-top: 64px">
        <x-pelanggan.keyvalue/>
    </div>
    <div class="container" style="margin-top: 64px">
        <h2 class="h2" style="margin-bottom: 32px">FAQ</h2>
        <div class="row">
            <div class="col-6">
                <x-pelanggan.faq/>
            </div>
            <div class="col-6" style="text-align: right">
                <img src="{{URL::asset('assets/pelanggan')}}/img/faq.svg" alt="">
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 64px; margin-bottom:64px">
        <x-pelanggan.terms/>
    </div>
    <div style="background: #FAFAFA">
        <div class="container">
            <x-pelanggan.footer/>
        </div>
    </div>
    
@endsection
