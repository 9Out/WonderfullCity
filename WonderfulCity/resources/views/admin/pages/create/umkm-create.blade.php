@extends('admin.layouts.crud')

@section('title', 'Tambah UMKM')

@section('links')
@endsection

@section('content')
<div class="w-full max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Tambah UMKM</h1>

    @include('admin.components.error')
        
    <div class="form-header mb-5">
        <h2 class="font-bold"></h2>
        <a href="{{ route('umkm.admin') }}" class="close-btn" id="backButton">
            <i class="fa-regular fa-circle-left"></i>
            <span class="close-caption">Back</span>
        </a>
    </div>
    
    <div class="form-body">
        <form action="{{ route('umkm.store') }}" method="POST" enctype="multipart/form-data" id="inputForm">
        @csrf

        <!-- Nama UMKM -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Nama UMKM</label>
            <input type="text" name="nama_umkm" class="w-full bg-gray-100 border rounded px-3 py-2" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full bg-gray-100 border rounded px-3 py-2 min-h-40" required></textarea>
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Alamat</label>
            <input type="text" name="alamat" class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Nomor Telepon -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" class="w-full border rounded px-3 py-2" placeholder="Contoh: 081234567890">
        </div>

        <!-- Rentang Harga -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Rentang Harga (dalam Rupiah)</label>
            <div class="flex gap-4">
                <input type="number" name="harga_min" class="w-1/2 border rounded px-3 py-2" placeholder="Harga Minimum" min="0">
                <input type="number" name="harga_max" class="w-1/2 border rounded px-3 py-2" placeholder="Harga Maksimum" min="0">
            </div>
            <p class="text-sm text-gray-500 mt-1">Contoh: 10000 - 50000</p>
        </div>

        <!-- Link Map -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Link Google Maps</label>
            <input type="url" name="link_map" class="w-full border rounded px-3 py-2" placeholder="https://goo.gl/maps/...">
            <p class="text-sm text-gray-500 mt-1">Masukkan tautan Google Maps lokasi UMKM.</p>
        </div>

        <!-- Foto Utama -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Foto Utama (maksimal 2MB)</label>
            <input type="file" name="foto_utama" accept="image/*" class="mb-2" onchange="previewUtama(event)" required>
            <img id="preview-foto-utama" class="w-32 h-32 object-cover rounded border" style="display:none;">
        </div>

        <!-- List Foto -->
        <div class="mb-4">
            <label class="block text-sm font-semibold mb-1">Foto Galeri (boleh lebih dari satu) (maksimal 2MB)</label>
            <input type="file" name="list_foto[]" multiple accept="image/*" onchange="previewList(event)">
            <div id="preview-list-foto" class="flex gap-2 mt-2 flex-wrap"></div>
        </div>
        </form>
    </div>

    <div class="form-footer">
        <button class="btn btn-sm btn-danger" id="resetFormBtn"></i>Reset Form</button>
        <button type="submit" form="inputForm" class="btn btn-sm btn-secondary"><i class="fa-regular fa-floppy-disk"></i>Simpan</button>
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