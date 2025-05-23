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
                    <img src="{{ asset('storage/' . $wisata[0]->foto_utama) }}" alt="{{ $wisata[0]->nama_wisata }}">
                    <a href="{{ route('wisata.show', $wisata[0]->slug) }}" class="caption">{{ $wisata[0]->nama_wisata }}</a>
                </div>
            </div>
            <div class="right-images">
                <div class="top-right">
                    <div class="image-wrapper">
                        <img src="{{ asset('storage/' . $wisata[1]->foto_utama) }}" alt="{{ $wisata[1]->nama_wisata }}">
                        <a href="{{ route('wisata.show', $wisata[1]->slug) }}" class="caption">{{ $wisata[1]->nama_wisata }}</a>
                    </div>
                </div>
                <div class="bottom-right">
                    <div class="image-wrapper">
                        <img src="{{ asset('storage/' . $wisata[2]->foto_utama) }}" alt="{{ $wisata[2]->nama_wisata }}">
                        <a href="{{ route('wisata.show', $wisata[2]->slug) }}" class="caption">{{ $wisata[2]->nama_wisata }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content search">
        <span class="divider"></span>
        <form id="search-form" class="input-container w-50-right" action="javascript:void(0);" method="GET">
            <input type="text" name="search" id="search" placeholder="Cari Destinasi Wisata">
            <button type="submit" class="btn-search">
                Cari <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <span class="divider"></span>
    </section>


    <section class="content card-container" id="wisata-list">
        @include('partials.wisata-cards', ['wisataCard' => $wisataCard])
    </section>

    <!-- Pagination -->
    <div class="pagination-wrapper" id="pagination-container">
        @include('partials.wisata-pagination', ['wisataCard' => $wisataCard])
    </div>
@endsection

@push('scripts')
    <!-- JavaScript -->
    <script src="{{ asset('js/top.js') }}"></script>
    <script>
        // Fungsi fetch data Wisata pakai AJAX
        function fetchWisata(url) {
            const keyword = document.getElementById('search').value;

            fetch(`${url}?search=${encodeURIComponent(keyword)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('wisata-list').innerHTML = data.html;
                document.getElementById('pagination-container').innerHTML = data.pagination;
                attachPaginationEvents();
            })
            .catch(error => console.error('Error:', error));
        }

        // Pasang event click pada pagination untuk AJAX
        function attachPaginationEvents() {
            const links = document.querySelectorAll('#pagination-container a.page-link');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    fetchWisata(this.href);
                });
            });
        }

        // Event submit form cari
        document.getElementById('search-form').addEventListener('submit', function(e) {
            e.preventDefault();
            fetchWisata("{{ route('wisata.search') }}");
        });

        // Pasang event pagination saat halaman pertama dimuat
        attachPaginationEvents();
    </script>
@endpush