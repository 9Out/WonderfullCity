@extends('admin.layouts.adminlayout')

@section('title', 'Dashboard')

@section('content')

<h1>Dashboard</h1>

<div class="status-container">
    <div class="card blue">
        <div class="head">
            <div class="kiri">
                <h2>{{ $countUmkm + $countWisata }}</h2>
                <p>Total</p>
            </div>
            <div class="kanan"><i class="fa fa-table"></i></div>
        </div>
        {{-- <a href="" class="foot">More Info <i class="fa-regular fa-circle-right"></i></a> --}}
    </div>
    <div class="card green">
        <div class="head">
            <div class="kiri">
                <h2>{{ $countUmkm }}</h2>
                <p>UMKM</p>
            </div>
            <div class="kanan"><i class="fa-solid fa-square-plus"></i></div>
        </div>
        <a href="" class="foot">More Info <i class="fa-regular fa-circle-right"></i></a>
    </div>
    <div class="card red">
        <div class="head">
            <div class="kiri">
                <h2>{{ $countWisata }}</h2>
                <p>Wisata</p>
            </div>
            <div class="kanan"><i class="fa-solid fa-square-minus"></i></div>
        </div>
        <a href="" class="foot">More Info <i class="fa-regular fa-circle-right"></i></a>
    </div>
</div>

@endsection

@section('content-js')
    @parent
@endsection