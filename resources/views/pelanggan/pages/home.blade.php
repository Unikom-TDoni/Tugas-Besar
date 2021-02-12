@extends('pelanggan.layouts.layout')
@section('title_page', 'Homepage')

@section('content')
    <x-pelanggan.navbar/>
    <div class="container" style="margin-top: 120px">
        <div class="row">
            @for ($i = 0; $i < 8; $i++)
                <div class="col-3">
                    <x-pelanggan.item/>
                </div>
            @endfor
        </div>
    </div>
    
@endsection
