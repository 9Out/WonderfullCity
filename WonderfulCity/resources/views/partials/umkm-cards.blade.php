        @foreach ($umkmCard as $umkm)    
            <div class="card">
                <div class="card-image">
                    <img src="{{ asset('storage/' . $umkm->foto_utama) }}" alt="{{ $umkm->nama_umkm }}">
                </div>
                <div class="card-caption">
                    <div class="caption-text-wrapper">
                        <h3>{{ $umkm->nama_umkm }}</h3>
                    </div>
                    <a href="{{ route('umkm.show', $umkm->slug) }}" class="detail-button">Detail</a>
                </div>
            </div>
        @endforeach

        {{-- Dummy card untuk mengisi kekosongan jika kurang dari 12 --}}
        @for ($i = $umkmCard->count(); $i < 6; $i++)
            <div class="card dummy-card" style="visibility: hidden;"></div>
        @endfor
