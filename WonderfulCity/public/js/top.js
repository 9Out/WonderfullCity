        document.addEventListener('DOMContentLoaded', function() {
            let mybutton = document.getElementById("myBtn");

            // show the button when scrolls down 20px from the top
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
            }
        });

        // Go on top
        function topFunction() {
            // document.body.scrollTop = 0; // Safari
            // document.documentElement.scrollTop = 0; // Chrome, Firefox, IE and Opera

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }