@extends('admin.layouts.adminlayout')

@section('title', 'Dashboard')

@push('links')
    <!-- Link Head -->
    <style>
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        .container p.no-data {
            margin-bottom: 16px;
            padding: 0.5rem 0.75rem;
            display: block;
            font-weight: bold;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="url"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="file"] {
            margin: 5px;
        }

        .preview .prev-del {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .preview img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .submit-btn {
            margin-top: 25px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #0056b3;
        }

        .info-text {
            font-size: 0.9em;
            color: #666;
            margin-top: 4px;
        }

        .num-list {
            margin: 5px;
            padding: 1px 6px;
            border: 1px solid #374786;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
@endpush

@section('content')
    <!-- Content HTML -->
    <h1>Edit Landing Page</h1>

    @include('admin.components.success')

    @include('admin.components.error')

    <form action="{{ route('landing.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Detail Website:</label>
        <textarea name="website_detail" rows="5" required>{{ old('website_detail', $data->website_detail ?? '') }}</textarea>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $data->email ?? '') }}" required>

        <label>WhatsApp:</label>
        <input type="text" name="whatsapp" value="{{ old('whatsapp', $data->whatsapp ?? '') }}" required>

        <label>Link Google Maps:</label>
        <input type="url" name="map_link" value="{{ old('map_link', $data->map_link ?? '') }}" required>

        <label>Carousel Gambar (minimal 3 - maksimal 6):</label>
        <p><small>Jika tidak diunggah semua, gambar lama tetap dipakai.</small></p>

        <!-- Gambar lama -->
        <!-- @if (!empty($data->carousel_images))
            <div class="preview">
                @foreach ($data->carousel_images as $img)
                    <img src="{{ asset('storage/' . $img) }}" alt="Gambar lama">
                @endforeach
            </div>
        @endif -->

        @if (!empty($data->carousel_images))
            <div class="preview">
                @for ($i = 0; $i < 6; $i++)
                    <div class="carousel-slot">

                        <span class="num-list">{{ $i+1 }}</span>

                        @php
                            $img = $data->carousel_images[$i] ?? null;
                        @endphp

                        @if ($img)
                            <div class="prev-del">
                                <img src="{{ asset('storage/' . $img) }}" alt="Gambar lama" width="100">
                                <label style="margin-top: 0px;">
                                    <input type="checkbox" name="remove_carousel[{{ $i }}]"> Hapus
                                </label>
                            </div>
                        @endif

                        <input type="file" name="carousel[{{ $i }}]" accept="image/*" class="image-input" data-index="{{ $i }}">
                        <div id="preview-{{ $i }}" class="preview"></div>
                    </div>
                @endfor
            </div>
        @endif

        <!-- Upload gambar baru -->
        <!-- <div id="uploadFields">
            @for ($i = 0; $i < 6; $i++)
                <div>
                    <input type="file" name="carousel[]" accept="image/*" class="image-input" data-index="{{ $i }}">
                    <div id="preview-{{ $i }}" class="preview"></div>
                </div>
            @endfor
        </div> -->

        <label>Gambar Visual UMKM:</label>
        @if (!empty($data->visual_umkm))
            <div class="preview">
                <img src="{{ asset('storage/' . $data->visual_umkm) }}" alt="Visual UMKM">
            </div>
        @endif
        <input type="file" name="visual_umkm" accept="image/*">

        <label>Gambar Visual Wisata:</label>
        @if (!empty($data->visual_wisata))
            <div class="preview">
                <img src="{{ asset('storage/' . $data->visual_wisata) }}" alt="Visual Wisata">
            </div>
        @endif
        <input type="file" name="visual_wisata" accept="image/*">

        <br>
        <button class="button button-blue" type="submit" style="margin-top: 15px;">Simpan Perubahan</button>
        <a href="{{ route('landing.show') }}" class="button button-red">
            <span>Batal</span>
        </a>
    </form>

@endsection

@section('content-js')
    @parent
    <!-- Javascript -->
    <script>
        function previewImage(event, index) {
            const fileInput = event.target;
            const previewDiv = document.getElementById('preview-' + index);
            previewDiv.innerHTML = '';

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    previewDiv.appendChild(img);
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
        document.querySelectorAll('.image-input').forEach(input => {
            input.addEventListener('change', function(event) {
                const index = this.dataset.index;
                previewImage(event, index);
            });
        });
    </script>
@endsection