<footer class="footer bg-primary">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer about">
                            <div class="logo-footer">
                                <i class="fa fa-shopping-bag fa-3x"></i> <span class="logo">IndoMarket</span>
                            </div>
                            <p class="text">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, magna
                                eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor,
                                facilisis luctus, metus.</p>
                            <p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">+0123 456
                                        789</a></span></p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Faq</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Services</h4>
                            <ul>
                                <li><a href="#">Payment Methods</a></li>
                                <li><a href="#">Money-back</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Shipping</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer social">
                            <h4>Get In Touch</h4>
                            <!-- Single Widget -->
                            <div class="contact">
                                <ul>
                                    <li>NO. 342 - London Oxford Street.</li>
                                    <li>012 United Kingdom.</li>
                                    <li>info@indomarket.com</li>
                                    <li>+032 3456 7890</li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                            <ul>
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-flickr"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="copyright-inner border-top">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="left">
                                <p>Copyright © 2021 <a href="http://indokoding.net" target="_blank">IndoKoding.net</a> -
                                    All Rights Reserved.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="right pull-right">
                                <ul class="payment-cards">
                                    <li><i class="fa fa-cc-paypal"></i></li>
                                    <li><i class="fa fa-cc-amex"></i></li>
                                    <li><i class="fa fa-cc-mastercard"></i></li>
                                    <li><i class="fa fa-cc-stripe"></i></li>
                                    <li><i class="fa fa-cc-visa"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <style>
#loading
{
 text-align:center; 
 background: url('assets_front/loader.gif') no-repeat center; 
 height: 150px;
}
</style>
    <!-- Core -->
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link rel="stylesheet"href="<?= base_url() ?>assets/js/plugins/slick/slick.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/js/plugins/slick/slick-theme.min.css">
    <script src="<?= base_url() ?>assets/js/plugins/slick/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/swiper.css">
    <script src="<?= base_url() ?>assets/js/swiper.min.js"></script>
    <script src="<?= base_url(); ?>assets_front/assets/js/core/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets_front/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets_front/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets_front/assets/js/core/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>assets_front/assets/js/codebase.js"></script>

    <!-- Optional plugins -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Argon JS -->
    <script src="<?= base_url(); ?>assets_front/assets/js/argon-design-system.js"></script>

    <!-- Main JS-->
    <script src="<?= base_url(); ?>assets_front/assets/js/main.js"></script>
    <script>
$(document).ready(function () {
    filter_data(1);
    function filter_data(page){
        $('#filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var category = get_filter('category');
        $.ajax({
            url: "<?= base_url();?>front/productfront/fetch_data/" +page,
            method: "POST",
            dataType: "JSON",
            data: {action:action, minimum_price:minimum_price,
                    maximum_price:maximum_price, category:category
                },
            success:function(data){
                $('.filter_data').html(data.product_list);
                $('#pagination_link').html(data.pagination_link);
                console.log(data);
            }
        })
    }

    function get_filter(class_name) {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        
        });
        return filter;
      }

      $(document).on('click', '.pagination li a', function(event){
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            filter_data(page);

      });
      $('.common_selector').click(function(){
            filter_data(1);
      });
      $('#price_range').slider({
          range: true,
          min: 1000,
          max: 100000,
          values: [1000,100000],
          step:500,
          stop:function(event, ui){
              $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data(1);
        }
      });
      jQuery(function () {
                // Init page helpers (Slick Slider plugin)
                Codebase.helpers('slick');
            });
  
});
</script>
</body>

</html>