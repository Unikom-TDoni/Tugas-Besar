@extends('pelanggan.layouts.layout')
@section('title_page', 'Login')
@section('content')
    <section class="login-page">
        <div class="container">
            <div class="row login-row">
                <x-pelanggan.login/>
            </div>
        </div>
        <div class="login-illustration">
            <img src="{{URL::asset('assets/pelanggan')}}/img/illustration_login.svg" alt="illustration">
        </div>
    </section>
@endsection