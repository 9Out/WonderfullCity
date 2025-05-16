@extends('layouts/main')

@section('title', 'Home')
@section('description', 'Selamat datang di situs kami!!!')
@section('keywords', 'informasi, umkm, wisata, surakarta, solo, umkm surakarta, wisata surakarta')
@section('author', 'Nirot & Iqbal')

@push('others-links')
    <!-- head link -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('content')
    <!-- Content HTML -->
    <section class="headlight">
        <h1 class="heading title-headlight">Surakarta</h1>
        <span class="divider"></span>
        <div class="carousel">
            <div class="image">
                <button class="nav left" onclick="prevImage()">&#10094;</button>
                <img id="carousel-image" src="MainImages/1.png" alt="">
                <button class="nav right" onclick="nextImage()">&#10095;</button>
            </div>
        </div>
        <span class="divider"></span>
    </section>


    <section class="content preview">
        <div class="title-group">
            <h2 class="heading title-preview">Eksplorasi Potensi Terbaik di Surakarta</h2>
            <p class="subtitle subtitle-preview">
                Temukan UMKM unggulan, destinasi wisata menarik, dan informasi lokal Surakarta dengan mudah dan cepat.
            </p>
            <span class="divider d-1"></span>
        </div>
        <div class="item-group">
            <div class="item">
                <div class="head-preview">
                    <div class="cover cover-1">UMKM</div>
                    <div class="desc-head">
                        <h3 class="heading desc-title">Jelajahi UMKM Unggulan</h3>
                        <p class="desc-info">
                            Dukung produk lokal dan temukan ragam usaha kreatif dari pelaku UMKM.
                        </p>
                        <button onclick="location.href='#'" class="button button-secondary button-sm">
                            Lihat Daftar UMKM <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
                <!-- Konten Dinamis -->
                <div class="list-preview">
                    <span class="left-line"></span>
                    <div class="pre-item">
                        <div class="preview-2">
                            <div class="pre-image">
                                <img src="https://picsum.photos/200/300" alt="">
                            </div>
                            <a href="" class="pre-title">Nasi Liwet Bu Sadinem AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</a>
                        </div>
                        <div class="preview-2">
                            <div class="pre-image">
                                <img src="https://picsum.photos/200/300" alt="">
                            </div>
                            <a href="" class="pre-title">Serabi Mungil Ibu Tipuk</a>
                        </div>
                        <div class="preview-2">
                            <div class="pre-image">
                                <img src="https://picsum.photos/200/300" alt="">
                            </div>
                            <a href="" class="pre-title">Selat Solo Masbos Joko</a>
                        </div>
                        <div class="preview-2">
                            <div class="pre-image">
                                <img src="https://picsum.photos/200/300" alt="">
                            </div>
                            <a href="" class="pre-title">Timlo Solo Sastro</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="head-preview">
                    <div class="cover cover-2">WISATA</div>
                    <div class="desc-head">
                        <h3 class="heading desc-title">Temukan Destinasi Wisata Menarik</h3>
                        <span class="desc-info">
                            Nikmati keindahan alam, budaya, dan tempat seru yang wajib kamu kunjungi.
                        </span>
                        <button onclick="location.href='#'" class="button button-secondary button-sm">Lihat Tempat Wisata <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
                <div class="list-preview">
                    <span class="left-line"></span>
                    <div class="pre-item">
                        <div class="preview-2">
                            <div class="pre-image">
                                <img src="https://picsum.photos/200/300" alt="">
                            </div>
                            <a href="" class="pre-title">Keraton Surakarta Hadiningrat AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</a>
                        </div>
                        <div class="preview-2">
                            <div class="pre-image">
                                <img src="https://picsum.photos/200/300" alt="">
                            </div>
                            <a href="" class="pre-title">Pura Mangkunegaran</a>
                        </div>
                        <div class="preview-2">
                            <div class="pre-image">
                                <img src="https://picsum.photos/200/300" alt="">
                            </div>
                            <a href="" class="pre-title">Museum Batik Danar Hadi</a>
                        </div>
                        <div class="preview-2">
                            <div class="pre-image">
                                <img src="https://picsum.photos/200/300" alt="">
                            </div>
                            <a href="" class="pre-title">Kampung Batik Kauman & Laweyan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span class="divider"></span>
    </section>


    <section class="content search">
        <span class="divider w-75"></span>
        <div class="title-group">
            <h2 class="heading title-search">Cari UMKM & Wisata Favoritmu</h2>
            <p class="subtitle subtitle-preview">Gunakan fitur pencarian untuk menemukan data UMKM dan destinasi wisata yang kamu butuhkan dengan mudah.</p>
        </div>
        <form class="input-container w-75" action="#" method="GET">
            <select name="kategori" id="kategori">
                <option value="umkm">UMKM</option>
                <option value="wisata">Wisata</option>
            </select>
            <input type="text" name="search" id="search" placeholder="Cari sesuatu...">
            <button type="submit" class="btn-search">
                Cari <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <span class="divider w-75"></span>
    </section>
    <section class="content about">
        <div class="isi-about">
            <h2 class="heading title-about">Tentang Surakarta</h2>
            <div class="dot-group">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
            <p class="subtitle about-desc">
                "Sala" adalah satu dari tiga dusun yang dipilih oleh Sri Susuhunan Paku Buwana II atas saran dari Tumenggung Hanggawangsa, Tumenggung Mangkuyudha, serta komandan pasukan Belanda, J.A.B. van Hohendorff, ketika akan mendirikan istana baru, setelah perang suksesi Mataram Islam terjadi di Kartasura.[12] Seiring waktu, karena penyebutan "Sala" dianggap sulit oleh orang Belanda, nama ini berubah menjadi "Solo".[13] Nama "Surakarta" diberikan sebagai nama "wisuda" bagi Keraton Surakarta, pusat pemerintahan baru Kasultanan Mataram Islam di Desa Sala.[12]
            </p>
            <div class="dot-group">
                <span class="dot"></span>
            </div>
        </div>
    </section>


    <section class="contact">
        <p class="subtitle k-text">
            Informasi Lebih Lanjut? Hubungi Kami via 
        </p>
        <div class="list-contact">
            <p class="k-item">Email: <a target="_blank" href="https://mail.google.com/mail/?view=cm&to=info@example.com">info@example.com</a></p>
            <p class="k-item">Whatsapp: <a href="https://wa.me/62xxxxxxxxx">+62xxxxxxxxx</a></p>
        </div>
    </section>


    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa-regular fa-square-caret-up"></i>
    </button>
@endsection

@push('scripts')
    <!-- JavaScript -->
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/top.js') }}"></script>
@endpush