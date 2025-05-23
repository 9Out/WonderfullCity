        @foreach ($wisataCard as $wisata)    
            <div class="card">
                <div class="card-image">
                    <img src="{{ asset('storage/' . $wisata->foto_utama) }}" alt="{{ $wisata->nama_wisata }}">
                </div>
                <div class="card-caption">
                    <div class="caption-text-wrapper">
                        <h3>{{ $wisata->nama_wisata }}</h3>
                    </div>
                    <a href="{{ route('wisata.show', $wisata->slug) }}" class="detail-button">Detail</a>
                </div>
            </div>
        @endforeach

        {{-- Dummy card untuk mengisi kekosongan jika kurang dari 12 --}}
        @for ($i = $wisataCard->count(); $i < 6; $i++)
            <div class="card dummy-card" style="visibility: hidden;"></div>
        @endfor