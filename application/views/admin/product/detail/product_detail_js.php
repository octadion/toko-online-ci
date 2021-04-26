<link rel="stylesheet"href="<?= base_url() ?>assets/js/plugins/slick/slick.min.css">
 <link rel="stylesheet" href="<?= base_url() ?>assets/js/plugins/slick/slick-theme.min.css">
 <script src="<?= base_url() ?>assets/js/plugins/slick/slick.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/swiper.css">
<script src="<?= base_url() ?>assets/js/swiper.min.js"></script>
 <script>
            jQuery(function () {
                // Init page helpers (Slick Slider plugin)
                Codebase.helpers('slick');
            });
        </script>
        <script>

        var mySwiper1 = new Swiper('.swiper-navigations', {
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        $('#tombol_kembali').on('click', function() {
            window.top.close();
        });
    </script>