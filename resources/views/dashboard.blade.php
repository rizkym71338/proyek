@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>
    <section class="section dashboard">
        <div class="row">
            <div class="d-flex align-items-center justify-content-center mt-5">
                <h1>Selamat datang, {{ auth()->user()->username }}!</h1>
            </div>
        </div>
    </section>
@endsection
