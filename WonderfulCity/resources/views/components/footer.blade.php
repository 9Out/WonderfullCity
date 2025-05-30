    <!-- Bagian Kontak -->
    <section class="contact">
        <p class="subtitle k-text">
            Informasi Lebih Lanjut? Hubungi Kami via 
        </p>
        <div class="list-contact">
            <!-- DATA DARI AppServiceProvider -->
            <p class="k-item">Email: <a target="_blank" href="https://mail.google.com/mail/?view=cm&to={{ $footerContact['email'] ?? '' }}">{{ $footerContact['email'] ?? '' }}</a></p>
            <p class="k-item">Whatsapp: <a href="https://wa.me/{{ $footerContact['whatsapp'] }}">+{{ $footerContact['whatsapp'] }}</a></p>
        </div>
    </section>

    <!-- Tombol Go On Top -->
    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa-regular fa-square-caret-up"></i>
    </button>


    <footer>
        <!-- Main Footer Content -->
        <div class="footer-main">
        <div class="footer-container">
            <!-- Lokasi -->
            <div class="footer-column">
            <h3>Lokasi</h3>
            <!-- ============================== -->
            <!-- PERLU EDIT DATA DINAMIS DISINI -->
            <!-- ============================== -->
            <!-- DATA DARI AppServiceProvider -->
            {{-- {{ $footerContact['map_link'] }} --}}
            <iframe 
                src="{{ $footerContact['map_link'] ?? '' }}"
                allowfullscreen="" 
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <!-- ============================== -->
            </div>

            <!-- Link Terkait -->
            <div class="footer-column">
            <h3>Link Terkait</h3>
            <ul>
                <li><a href="{{ route('umkm.index') }}">UMKM</a></li>
                <li><a href="{{ route('wisata.index') }}">WISATA</a></li>
            </ul>
            </div>
        </div>

        <!-- Garis bawah -->
        <hr class="footer-line">

        <!-- Copyright -->
        <div class="footer-bottom">
            © 2025 All Rights Reserved
        </div>
        </div>
    </footer>

@push('scripts')
    <!-- JavaScript -->
    <script src="{{ asset('js/top.js') }}"></script>
@endpush