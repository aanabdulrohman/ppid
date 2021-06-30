<div class="footer-clean" style="background-color: #DBE2EF;">
    <footer>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-3 item">
                    <h3>Tentang PPID</h3>
                    <ul>
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Struktur Organisasi</a></li>
                        <li><a href="#">Visi dan Misi</a></li>
                        <li><a href="#">SOP</a></li>
                        <li><a href="#">Maklumat Informasi Publik</a></li>
                        <li><a href="#">Mekanisme Pelayanan</a></li>
                        <li><a href="#">Dasar Hukum</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-3 item">
                    <h3>Service</h3>
                    <ul>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                        <li><a href="#">Legacy</a></li>
                    </ul>
                </div>
                <div class="col-sm-4 col-md-3 item">
                    <h3>Kontak</h3>
                    <ul>
                        <li><a href="#">022334455</a></li>
                        <li><a href="#">ppid@banjar.go.id</a></li>
                        <li><a href="#">Benefits</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                    <p class="copyright">PPID Banjar Patroman © 2021</p>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- End -->

<!-- AOS Animations -->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        delay: 100,
        once: true,
        duration: 2000,
    });
</script>


<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.0/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.0/TextPlugin.min.js"></script>
<script>
    gsap.registerPlugin(TextPlugin);
    gsap.to('.display-6', {
        duration: 1.5,
        text: 'Pejabat Pengelola Informasi dan Dokumentasi'
    });
    gsap.registerPlugin(TextPlugin);
    gsap.to('.lead', {
        duration: 2,
        delay: 1.5,
        text: 'Website ini dibuat untuk mewujudkan Undang-Undang Nomor 14 Tahun 2008 tentang keterbukaan informasi publik. Didalam website ini anda bisa mendapatkan informasi seputar pemerintahan daerah Kota Banjar'
    });
</script>

<!-- count -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $('.count').each(function() {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function(now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>

<script>
    (function() {
        "use strict";

        // define variables
        var items = document.querySelectorAll(".timeline li");

        function isElementInViewport(el) {
            var rect = el.getBoundingClientRect();
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <=
                (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );
        }

        function callbackFunc() {
            for (var i = 0; i < items.length; i++) {
                if (isElementInViewport(items[i])) {
                    items[i].classList.add("in-view");
                }
            }
        }

        // listen for events
        window.addEventListener("load", callbackFunc);
        window.addEventListener("resize", callbackFunc);
        window.addEventListener("scroll", callbackFunc);
    })();
</script>




<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>