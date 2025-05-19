        // ------------------ //
        //   SCRIPT CARAUSEL  //
        // ------------------ //

        // const images = @json($imagePaths); // Bila dinamis misalnya dari controller
        // const images = [
        //     'images/1.png',
        //     'images/2.png'
        // ];

        const images = (window.carouselImages || []).map(path => `${window.storageBase}/${path}`);

        let currentIndex = 0;

        function showImage(index) {
            const img = document.getElementById('carousel-image');
            if (img) {
                img.src = images[index];
            }
        }

        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        }

        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }

        // Tampilkan gambar pertama saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            showImage(currentIndex);
            setInterval(nextImage, 10000); // ganti 10 detik
        });

        // -------------------- //
        // SCRIPT INPUT FOCUSED //
        // -------------------- //
        const container = document.querySelector('.input-container');

        // Tambahkan class saat salah satu elemen dalam container difokuskan
        container.addEventListener('focusin', (event) => {
            if (event.target.matches('input[type="text"]')) {
                container.classList.add('input-focused');
            }
        });

        // Hapus class hanya jika klik benar-benar di luar container
        document.addEventListener('click', (event) => {
            if (!container.contains(event.target)) {
                container.classList.remove('input-focused');
            }
        });