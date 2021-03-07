@extends('pelanggan.layouts.layout')
@section('title_page', 'Register')
@section('content')
    <section class="login-page">
        <div class="container">
            <div class="row login-row">
                <x-pelanggan.register/>
            </div>
        </div>
        <div class="login-illustration">
            <img src="{{URL::asset('assets/pelanggan')}}/img/illustration_login.svg" alt="illustration">
        </div>
    </section>
@endsection