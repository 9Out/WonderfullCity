@extends('layouts/main')

@section('title', $umkm->nama_umkm ?? $wisata->nama_wisata)
@section('description', Str::limit($umkm->deskripsi ?? $wisata->deskripsi , 150))
@section('keywords', $umkm->nama_umkm ?? $wisata->nama_wisata . ', umkm, wisata, surakarta')
@section('author', 'Nirot & Iqbal')

@push('others-links')
    <!-- head link -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    
@endpush

@php
    $data = $umkm ?? $wisata;
@endphp

@section('content')
<div class="w-[80%] mx-auto px-4 py-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row gap-6 mt-5">
        <!-- Main Image -->
        <div class="md:w-1/2">
            <img src="{{ asset('storage/' . $data->foto_utama) }}"
                 alt="{{ $umkm->nama_umkm ?? $wisata->nama_wisata }}"
                 class="rounded-2xl shadow-lg cursor-pointer w-full object-cover"
                 onclick="displayPopup(this.src)">
        </div>

        <!-- Details -->
        <div class="md:w-1/2 flex flex-col justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $umkm->nama_umkm ?? $wisata->nama_wisata }}</h1>
                <div class="h-2 w-full bg-orange-500 mb-3"></div>
                <p class="text-gray-700 mb-4 text-lg">{{ $data->deskripsi}}</p>
                <div class="space-y-2 text-gray-700 ">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-phone text-orange-500 w-5"></i>
                    <span><strong>Telepon:</strong> {{ $data->nomor_telepon}}</span>
                </div>

                <div class="flex items-center gap-2 ">
                    <i class="fa-solid fa-money-bill-wave text-green-500 w-5 text-center"></i>
                    @php
                        $min = number_format($data->rentang_harga[0], 0, ',', '.');
                        $max = number_format($data->rentang_harga[1], 0, ',', '.');
                    @endphp
                    <span><strong>Harga:</strong> Rp{{ $min }} - Rp{{ $max }}</span>
                </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-orange-500 w-5 text-center"></i>
                        <span><strong>Alamat:</strong> {{ $data->alamat }}</span>
                    </div>
                    @if($data->link_map)
                    <a  class="flex mt-6 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-center transition duration-300 w-fit md:w-fit gap-2 justify-center items-center " href="{{ $data->link_map }}" target="_blank" >
                        <i class="fa-regular fa-map text-black"></i>
                        Lihat Lokasi
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Documentation -->
    <div class="mt-12">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Dokumentasi Event</h2>
        <hr class="mb-6">

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            
            @foreach($data->list_foto ?? [] as $foto)
                <img src="{{ asset('storage/' . $foto) }}"
                     alt="Foto Dokumentasi"
                     class="rounded-lg shadow cursor-pointer object-cover w-full h-48"
                     onclick="displayPopup(this.src)">
            @endforeach
        </div>
    </div>
</div>

<!-- Popup Overlay -->
<!-- Popup container -->
<div id="image-popup"
     class="fixed inset-0 bg-black bg-opacity-80 hidden justify-center items-center z-[1050]"
     onclick="closePopup()">
    <span class="absolute top-5 right-5 text-white text-4xl cursor-pointer z-50" onclick="closePopup()">&times;</span>
    <img id="popup-image"
         src=""
         class="w-auto h-auto max-w-[90vw] max-h-[90vh] rounded-lg shadow-xl object-contain">
</div>

@endsection

@push('scripts')
<script>
    function displayPopup(src) {
        console.log("SRC:", src);
        document.getElementById('popup-image').src = src;
        document.getElementById('image-popup').classList.remove('hidden');
        document.getElementById('image-popup').classList.add('flex');
    }

    function closePopup() {
        document.getElementById('popup-image').src = '';
        document.getElementById('image-popup').classList.remove('flex');
        document.getElementById('image-popup').classList.add('hidden');
    }
</script>
@endpush
