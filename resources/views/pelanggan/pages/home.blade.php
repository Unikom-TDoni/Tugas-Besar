@extends('pelanggan.layouts.layout')
@section('title_page', 'Homepage')

@section('content')
    <x-pelanggan.navbar/>
    <section class="banner"></section>
    <section class="items">
        <div class="container">
            <h2 class="h2">Motor For Rent</h2>
            <div class="row">
                @foreach($outlineInfo as $info)
                    <div class="col-md-4 col-lg-3 col-xl-3">
                        <x-pelanggan.item :outlineInfo="$info"/>
                    </div>
                @endforeach
            </div>
            <a href="{{$outlineInfo->links()}}" class="load-more btn btn-md btn-secondary btn-50">Load More</a>
        </div>
    </section>
    <x-pelanggan.keyvalue/>
    <x-pelanggan.faq/>
    <x-pelanggan.terms/>
    <x-pelanggan.footer/>
@endsection
