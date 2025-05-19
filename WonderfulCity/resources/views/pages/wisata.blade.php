@extends('layouts/main')

@section('title', 'WISATA')
@section('description', 'Selamat datang di situs kami!!!')
@section('keywords', 'informasi, umkm, wisata, surakarta, solo, umkm surakarta, wisata surakarta')
@section('author', 'Nirot & Iqbal')

@push('others-links')
    <!-- head link -->
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endpush

@section('content')
    <!-- Content HTML -->
        <section class="headlight">
        <h1 class="heading title-headlight">WISATA</h1>
        <span class="divider"></span>
        <div class="gallery-container">
            <div class="left-image">
                <div class="image-wrapper">
                    <img src="https://picsum.photos/1280/720/" alt="Gambar 1">
                    <a href="#" class="caption">Judul Gambar Pertama yang Panjang Sekali Hingga Harus Terpotong | Judul Gambar Pertama yang Panjang Sekali Hingga Harus Terpotong</a>
                </div>
            </div>
            <div class="right-images">
                <div class="top-right">
                    <div class="image-wrapper">
                        <img src="https://picsum.photos/1280/720/" alt="Gambar 2">
                        <a href="#" class="caption">Judul Gambar Kedua</a>
                    </div>
                </div>
                <div class="bottom-right">
                    <div class="image-wrapper">
                        <img src="https://picsum.photos/1280/720/" alt="Gambar 3">
                        <a href="#" class="caption">Judul Gambar Ketiga</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content search">
        <span class="divider"></span>
        <form id="search-section" class="input-container w-50-right" action="#" method="GET">
            <input type="text" name="search" id="search" placeholder="Cari Destinasi Wisata">
            <button type="submit" class="btn-search">
                Cari <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <span class="divider"></span>
    </section>


    <section class="content card-container">
        <div class="card">
            <div class="card-image">
                <img src="https://picsum.photos/200/300" alt="Keraton Kasunanan Surakarta">
            </div>
            <div class="card-caption">
                <div class="caption-text-wrapper">
                    <h3>Keraton Kasunanan Surakarta</h3>
                </div>
                <a href="#" class="detail-button">Detail</a>
            </div>
        </div>

        <!-- Duplikat card -->
        <div class="card">
            <div class="card-image">
                <img src="https://picsum.photos/200/300" alt="Keraton Kasunanan Surakarta">
            </div>
            <div class="card-caption">
                <div class="caption-text-wrapper">
                    <h3>Keraton Yogyakarta</h3>
                </div>
                <a href="#" class="detail-button">Detail</a>
            </div>
        </div>

        <div class="card">
            <div class="card-image">
                <img src="https://picsum.photos/200/300" alt="Keraton Kasunanan Surakarta">
            </div>
            <div class="card-caption">
                <div class="caption-text-wrapper">
                    <h3>Pura Mangkunegaran</h3>
                </div>
                <a href="#" class="detail-button">Detail</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- JavaScript -->
    <script src="{{ asset('js/top.js') }}"></script>
@endpush