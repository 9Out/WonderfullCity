    <!-- Bagian Kontak -->
    <section class="contact">
        <p class="subtitle k-text">
            Informasi Lebih Lanjut? Hubungi Kami via 
        </p>
        <div class="list-contact">
            <p class="k-item">Email: <a target="_blank" href="https://mail.google.com/mail/?view=cm&to=info@example.com">info@example.com</a></p>
            <p class="k-item">Whatsapp: <a href="https://wa.me/62xxxxxxxxx">+62xxxxxxxxx</a></p>
        </div>
    </section>

    <!-- Tombol Go On Top -->
    <button onclick="topFunction()" id="myBtn" title="Go to top">
        <i class="fa-regular fa-square-caret-up"></i>
    </button>


    <footer>
        <!-- Info Bar -->
        {{-- <div class="footer-top">
        Ingin UMKM Anda Tampil di Website Kami? Hubungi kami di: <strong>081328382950</strong>
        </div> --}}

        <!-- Main Footer Content -->
        <div class="footer-main">
        <div class="footer-container">
            <!-- Lokasi -->
            <div class="footer-column">
            <h3>Lokasi</h3>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!4v1746623088265!6m8!1m7!1sEMnwbMTeFGkcxFes8-B2Uw!2m2!1d-7.569603056266332!2d110.8302433182977!3f277.39953434280926!4f-0.9386477447675929!5f1.238731008146421"
                allowfullscreen="" 
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            </div>

            <!-- Link Terkait -->
            <div class="footer-column">
            <h3>Link Terkait</h3>
            <ul>
                <li><a href="#">UMKM</a></li>
                <li><a href="#">WISATA</a></li>
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