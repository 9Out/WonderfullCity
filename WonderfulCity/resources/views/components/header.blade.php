    <header class="header">
        <div class="container" id="header-container">
        <!-- Logo -->
        <div class="logo">
            <div class="logo-circle">SOC</div>
        </div>

        <!-- Navigation -->
        <nav class="nav">
            @if (Route::is('landing.index'))
                <a class="active" onclick="return false;">BERANDA</a>
            @else
                <a href="{{ route('landing.index') }}">BERANDA</a>
            @endif

            @if (Route::is('umkm.index'))
                <a class="active" onclick="return false;">UMKM</a>
            @else
                <a href="{{ route('umkm.index') }}">UMKM</a>
            @endif

            @if (Route::is('wisata.index'))
                <a class="active" onclick="return false;">WISATA</a>
            @else
                <a href="{{ route('wisata.index') }}">WISATA</a>
            @endif

            <a href="#" class="header-search" onclick="scrollToCenter()">
                <i class="fa fa-search"></i>
            </a>
        </nav>
        </div>
    </header>

@push('scripts')
    <!-- JavaScript -->
    <script>
        // ------------------- //
        // Script Width Header //
        // ------------------- //
        document.addEventListener('DOMContentLoaded', function () {
            const header = document.getElementById("header-container");

            window.addEventListener('scroll', function () {
                if (window.scrollY > 20) {
                header.classList.add("shrink");
                } else {
                header.classList.remove("shrink");
                }
            });
        });
        
        // ------------- //
        // Script Scroll //
        // ------------- //
        function scrollToCenter() {
            event.preventDefault();
            const element = document.getElementById("search-section");

            if (!element) {
                console.warn('Elemen #search-section tidak ditemukan!');
                return;
            }

            const elementTop = element.getBoundingClientRect().top + window.scrollY;
            const elementHeight = element.offsetHeight;
            const windowHeight = window.innerHeight;
            const scrollTo = elementTop - (windowHeight / 2) + (elementHeight / 2);

            window.scrollTo({
                top: scrollTo,
                behavior: 'smooth'
            });
        }
    </script>
@endpush