@extends('admin.layouts.crud')

@section('title', 'Edit UMKM')

@section('links')
@endsection

@section('content')
<div class="w-full max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Data UMKM</h1>

    <div class="form-header mb-5">
        <h2 class="font-bold"></h2>
        <a href="{{ route('umkm.admin') }}" class="close-btn" id="backButton">
            <i class="fa-regular fa-circle-left"></i>
            <span class="close-caption">Back</span>
        </a>
    </div>

    <div class="form-body">
    <form action="{{ route('umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data" id="inputForm">
        @csrf
        @method('PUT')

        <!-- Nama UMKM -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Nama UMKM</label>
            <input type="text" name="nama_umkm" class="w-full border rounded px-3 py-2" value="{{ old('nama_umkm', $umkm->nama_umkm) }}" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2" required>{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Alamat</label>
            <input type="text" name="alamat" class="w-full border rounded px-3 py-2" value="{{ old('alamat', $umkm->alamat) }}" required>
        </div>

        <!-- Link Map -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Link Google Maps</label>
            <input type="url" name="link_map" class="w-full border rounded px-3 py-2" placeholder="https://goo.gl/maps/..." value="{{ old('link_map', $umkm->link_map) }}">
            <p class="text-sm text-gray-500 mt-1">Masukkan tautan Google Maps lokasi UMKM.</p>
        </div>

        <!-- Foto Utama -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Foto Utama</label>
            @if($umkm->foto_utama)
                <p class="mb-2">Saat ini:</p>
                <img src="{{ asset('storage/' . $umkm->foto_utama) }}" class="w-32 h-32 object-cover rounded border mb-2">
            @endif
            <input type="file" name="foto_utama" accept="image/*" onchange="previewUtama(event)" required>
            <img id="preview-foto-utama" class="w-32 h-32 object-cover rounded border mt-2" style="display:none;">
        </div>

        <!-- List Foto -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Foto Galeri</label>

            <p class="text-sm text-gray-500 mb-2">Centang untuk menghapus foto tertentu atau centang "Ganti semua galeri lama" di bawah</p>

            <!-- Galeri Lama -->
            <div class="flex gap-4 flex-wrap">
                @if($umkm->list_foto)
                    @foreach($umkm->list_foto as $index => $foto)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $foto) }}" class="w-24 h-24 object-cover border rounded">
                            <label class="absolute top-0 left-0">
                                <input type="checkbox" name="hapus_foto_lama[]" value="{{ $foto }}" class="absolute m-1">
                            </label>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Opsi replace semua -->
            <div class="mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="replace_all_galeri" value="1" class="mr-2">
                    Ganti semua galeri lama dengan foto baru
                </label>
            </div>

            <!-- Upload Foto Baru -->
            <div class="mt-4">
                <label class="block text-sm font-semibold mb-1">Tambahkan Foto Galeri Baru</label>
                <input type="file" name="list_foto[]" multiple accept="image/*" onchange="previewList(event)">
                <div id="preview-list-foto" class="flex gap-2 mt-2 flex-wrap"></div>
            </div>
        </div>
    </form>
    </div>

    <div class="form-footer">
        <button class="btn btn-sm btn-danger" id="resetFormBtn"></i>Reset Form</button>
        <button type="submit" form="inputForm" class="btn btn-sm btn-secondary"><i class="fa-regular fa-floppy-disk"></i>Simpan Update</button>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function previewUtama(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview-foto-utama');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function previewList(event) {
        const container = document.getElementById('preview-list-foto');
        container.innerHTML = '';
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e){
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList = "w-24 h-24 object-cover rounded border";
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }


    // Fungsi untuk reset preview gambar
    function resetPreview() {
        const utamaPreview = document.getElementById('preview-foto-utama');
        if (utamaPreview) {
            utamaPreview.src = '';
            utamaPreview.style.display = 'none';
        }

        const listPreview = document.getElementById('preview-list-foto');
        if (listPreview) {
            listPreview.innerHTML = '';
        }
    }
</script>
@endpush