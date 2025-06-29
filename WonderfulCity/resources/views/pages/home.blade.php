@extends('layouts/main')

@section('title', 'Home')
@section('description', 'Selamat datang di situs kami!!!')
@section('keywords', 'informasi, umkm, wisata, surakarta, solo, umkm surakarta, wisata surakarta')
@section('author', 'Nirot & Iqbal')

@push('others-links')
    <!-- head link -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <style>
        .head-preview .cover-1 {
            background: url('{{ asset('storage/' . $data->visual_umkm) }}') lightgray -44.418px 0px / 133.272% 100% no-repeat;
        }

        .head-preview .cover-2 {
            background: url('{{ asset('storage/' . $data->visual_wisata) }}') lightgray -44.418px 0px / 133.272% 100% no-repeat;
        }
    </style>
@endpush

@section('content')
    <!-- Content HTML -->
    <section class="headlight">
        <!-- <h1 class="heading title-headlight">Surakarta</h1> -->
        <!-- <span class="divider"></span> -->
        <div class="carousel">
            <div class="image">
                <button class="nav left" onclick="prevImage()"><i class="fa-solid fa-angle-left"></i></button>
                <img id="carousel-image" src="" alt="">
                <button class="nav right" onclick="nextImage()"><i class="fa-solid fa-angle-right"></i></button>
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
                        <a href="{{ route('umkm.index') }}">
                            <button class="button button-secondary button-sm">
                                Lihat Daftar UMKM <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <!-- Konten Dinamis -->
                <div class="list-preview">
                    <span class="left-line"></span>
                    <div class="pre-item">
                        @foreach ($umkm as $item)    
                            <div class="preview-2">
                                <div class="pre-image">
                                    <img src="{{ asset('storage/' . $item->foto_utama) }}" alt="{{ $item->nama_umkm }}">
                                </div>
                                <a href="{{ route('umkm.show', $item->slug) }}" class="pre-title">{{ $item->nama_umkm }}</a>
                            </div>
                        @endforeach
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
                        <a href="{{ route('wisata.index') }}">
                            <button class="button button-secondary button-sm">
                                Lihat Tempat Wisata <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="list-preview">
                    <span class="left-line"></span>
                    <div class="pre-item">
                        @foreach ($wisata as $item)    
                            <div class="preview-2">
                                <div class="pre-image">
                                    <img src="{{ asset('storage/' . $item->foto_utama) }}" alt="{{ $item->nama_wisata }}">
                                </div>
                                <a href="{{ route('wisata.show', $item->slug) }}" class="pre-title">{{ $item->nama_wisata }}</a>
                            </div>
                        @endforeach
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
        <form id="search-form" class="input-container w-75" method="GET">
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
                {{ $data->website_detail }}
            </p>
            <div class="dot-group">
                <span class="dot"></span>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- JavaScript -->
    <script>
        window.carouselImages = @json(array_filter($data->carousel_images));
        window.storageBase = '{{ asset('storage') }}';
    </script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script>
    document.getElementById('search-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const kategori = document.getElementById('kategori').value;
        const search = document.getElementById('search').value.trim();

        if (!search) {
            alert('Silakan isi kata kunci pencarian.');
            return;
        }

        // Tentukan URL berdasarkan kategori
        let baseUrl = '';
        let anchor = '';
        if (kategori === 'umkm') {
            baseUrl = '{{ route('umkm.search') }}';
            anchor = '#umkm-list';
        } else if (kategori === 'wisata') {
            baseUrl = '{{ route('wisata.search') }}';
            anchor = '#wisata-list';
        }

        // Redirect ke URL dengan query string
        window.location.href = baseUrl + '?search=' + encodeURIComponent(search) + anchor;
    });
</script>
@endpush