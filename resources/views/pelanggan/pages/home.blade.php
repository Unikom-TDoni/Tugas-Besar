@extends('pelanggan.layouts.layout')
@section('title_page', 'Homepage')

@section('content')
    <x-pelanggan.navbar/>
    <section class="banner"></section>
    <section class="items">
        <div class="container">
            <h2 class="h2">Motor For Rent</h2>
            <div class="row">
                @for ($i = 0; $i < 12; $i++)
                    <div class="col-3">
                        <x-pelanggan.item/>
                    </div>
                @endfor
            </div>
            <a href="#" class="load-more btn btn-md btn-secondary btn-50">Load More</a>
        </div>
    </section>
    <x-pelanggan.keyvalue/>
    <x-pelanggan.faq/>
    <x-pelanggan.terms/>
    <x-pelanggan.footer/>
@endsection
