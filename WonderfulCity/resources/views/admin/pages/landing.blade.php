@extends('admin.layouts.adminlayout')

@section('title', 'Informasi Web')

@push('links')
    <!-- Link Head -->
    <style>
        .preview img {
            width: 300px;
            height: 180px;
            object-fit: cover;
            margin-top: 15px;
            border: 1px solid #ccc;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .container p.no-data {
            margin-bottom: 16px;
            padding: 0.5rem 0.75rem;
            display: block;
            font-weight: bold;
        }
        .label {
            font-weight: bold;
        }
        .info {
            margin-bottom: 15px;
        }
    </style>
@endpush

@section('content')
    <!-- Content HTML -->
<div class="container">
    <h1>Informasi Web</h1>

    @include('admin.components.success')

    @if ($data)
        <div class="aksi">
            <a class="button button-amber" href="{{ route('landing.edit') }}">
                <i class="fa fa-pen-to-square"></i>
                Edit Informasi Web
            </a>
        </div>

        <div class="info">
            <p class="label">Detail Website:</p>
            <p>{{ $data->website_detail }}</p>
        </div>

        <div class="info">
            <p class="label">Email:</p>
            <p>{{ $data->email }}</p>
        </div>

        <div class="info">
            <p class="label">WhatsApp:</p>
            <p>{{ $data->whatsapp }}</p>
        </div>

        <div class="info">
            <p class="label">Embed Google Maps:</p>
            <p style="margin-bottom: 4px;color: blue;"><small>Tipe url yang dipakai: https://www.google.com/maps/embed?...</small></p>
            <p>{{ $data->map_link }}</p>
        </div>

        <div class="info">
            <p class="label">Carousel Gambar:</p>
            <div class="preview">
                @foreach ($data->carousel_images as $img)
                    @if ($img)
                        <img src="{{ asset('storage/' . $img) }}" alt="Gambar Carousel">
                    @endif
                @endforeach
            </div>
        </div>

        <div class="info">
            <p class="label">Visual UMKM:</p>
            <div class="preview">
                <img src="{{ asset('storage/' . $data->visual_umkm) }}" width="300">
            </div>
        </div>
        
        <div class="info">
            <p class="label">Visual Wisata:</p>
            <div class="preview">
                <img src="{{ asset('storage/' . $data->visual_wisata) }}" width="300">
            </div>
        </div>

    @else
        <a href="{{ route('landing.edit') }}">
            <button class="button button-blue">Buat Sekarang</button>
        </a>
        <p class="no-data labl red">Belum ada data landing page.</p>
    @endif
</div>
@endsection

@section('content-js')
    @parent
    <!-- Javascript -->
@endsection