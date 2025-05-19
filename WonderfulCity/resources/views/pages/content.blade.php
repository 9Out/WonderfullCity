@extends('layouts/main')

@section('title', 'Home')
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
    <div class="event-container">
    <div class="event-image">
        <img src="{{ asset('storage/visuals/vfu9GRzNPfiMYbDPotPD5xunPIF7IL9iXvOs3gc3.png') }}" alt="Event Image" onclick="displayPopup(this.src)">
    </div>
    <div class="event-details">
        <h1>JUDUL Content</h1>
        <p>Deskripsi</p>
        <div class="event-info">
            <div>
                <i class="fa-solid fa-calendar-days"></i>
            
            </div>
            <div>
                <i class="fa-solid fa-people-group"></i>
                <span>1 orang</span>
            </div>
            <div>
                <i class="fa-solid fa-location-dot"></i>
                <span>Laweyan</span>
            </div>
            <div>
                <i class="fa-solid fa-camera-retro"></i>
                <a href="#" target="_blank">Dokumentasi Kegiatan</a>
            </div>
        </div>
        <a href="#" class="btn btn-orange">Daftarkan Sekarang</a>
    </div>
</div>

<div class="documentation">
    <h2>Dokumentasi Event</h2>
    <hr>
    <div class="image-grid">
        
    </div>

    <div id="image-popup" class="popup-overlay" onclick="closePopup()">
        <span class="close-button">&times;</span>
        <img id="popup-image" src="">
    </div>

</div>
@endsection

@push('scripts')
    <!-- JavaScript -->
     <script src="{{ asset('js/content.js') }}"></script>
    <script src="{{ asset('js/top.js') }}"></script>
@endpush