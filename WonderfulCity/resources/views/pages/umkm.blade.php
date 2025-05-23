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
    <section class="headlight">
        <h1 class="heading title-headlight">UMKM</h1>
        <span class="divider"></span>
        <div class="gallery-container">
            <div class="left-image">
                <div class="image-wrapper">
                    <img src="{{ asset('storage/' . $umkm[0]->foto_utama) }}" alt="{{ $umkm[0]->nama_umkm }}">
                    <a href="{{ route('umkm.show', $umkm[0]->slug) }}" class="caption">{{ $umkm[0]->nama_umkm }}</a>
                </div>
            </div>
            <div class="right-images">
                <div class="top-right">
                    <div class="image-wrapper">
                        <img src="{{ asset('storage/' . $umkm[1]->foto_utama) }}" alt="{{ $umkm[1]->nama_umkm }}">
                        <a href="{{ route('umkm.show', $umkm[1]->slug) }}" class="caption">{{ $umkm[1]->nama_umkm }}</a>
                    </div>
                </div>
                <div class="bottom-right">
                    <div class="image-wrapper">
                        <img src="{{ asset('storage/' . $umkm[2]->foto_utama) }}" alt="{{ $umkm[2]->nama_umkm }}">
                        <a href="{{ route('umkm.show', $umkm[2]->slug) }}" class="caption">{{ $umkm[2]->nama_umkm }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content search">
        <span class="divider"></span>
        <form id="search-form" class="input-container w-50-right" action="javascript:void(0);" method="GET">
            <input type="text" name="search" id="search" placeholder="Cari UMKM">
            <button type="submit" class="btn-search">
                Cari <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <span class="divider"></span>
    </section>


    <section class="content card-container" id="umkm-list">
        @include('partials.umkm-cards', ['umkmCard' => $umkmCard])
    </section>

    <!-- Pagination -->
    <div class="pagination-wrapper" id="pagination-container">
        @include('partials.umkm-pagination', ['umkmCard' => $umkmCard])
    </div>
@endsection

@push('scripts')
    <!-- JavaScript -->
    <script src="{{ asset('js/top.js') }}"></script>
    <script>
        // Fungsi fetch data UMKM pakai AJAX
        function fetchUMKM(url) {
            const keyword = document.getElementById('search').value;

            fetch(`${url}?search=${encodeURIComponent(keyword)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('umkm-list').innerHTML = data.html;
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
                    fetchUMKM(this.href);
                });
            });
        }

        // Event submit form cari
        document.getElementById('search-form').addEventListener('submit', function(e) {
            e.preventDefault();
            fetchUMKM("{{ route('umkm.search') }}");
        });

        // Pasang event pagination saat halaman pertama dimuat
        attachPaginationEvents();
    </script>
@endpush