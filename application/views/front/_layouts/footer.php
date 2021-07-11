<footer class="footer bg-primary">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer about">
                            <div class="logo-footer">
                                <i class="fa fa-shopping-bag fa-3x"></i> <span class="logo">Hidrostore</span>
                            </div>
                            <p class="text">Hidroponik Store Phicos solusi sayur sehat anda. Membantu anda merencanakan dan mengembangkan kebun sayur anda.</p>
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
                                    <li>Jl Rajawali 1 No 2, RT 02 RW 06, Kelurahan Manahan, Kecamatan Banjarsari</li>
                                    <li>Surakarta.</li>
                                    <li>phicos@gmail.com</li>
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
                                <p>Copyright © 2021 <a href="http://indokoding.net" target="_blank">Phicos Group Surakarta</a> -
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
    <?php
    $tot_berat = 0;
    foreach($cartItems as $item){   
        $berat = $item["qty"] * $item["weight"];
        $tot_berat = $tot_berat + $berat;
    
    ?>
    <?php } ?>
    <style>
#loading
{
 text-align:center; 
 background: url('<?= base_url();?>assets_front/loader.gif') no-repeat center; 
 height: 150px;
}
</style>
    <!-- Core -->
    <link rel="stylesheet"href="<?= base_url() ?>assets/js/plugins/slick/slick.min.css">
 <link rel="stylesheet" href="<?= base_url() ?>assets/js/plugins/slick/slick-theme.min.css">
 <script src="<?= base_url() ?>assets/js/plugins/slick/slick.min.js"></script>
    <!-- <script src="<?= base_url(); ?>assets_front/assets/js/core/jquery.min.js"></script> -->
    <script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets_front/assets/js/core/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets_front/assets/js/core/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets_front/assets/js/core/jquery-ui.min.js"></script>
    <script src="<?= base_url(); ?>assets_front/assets/js/codebase.js"></script>
    <script src="<?= base_url(); ?>assets/js/codebase.js"></script>
    <script src="<?= base_url(); ?>assets/js/argon-design-system.min.js?v=1.2.2" type="text/javascript"></script>

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
        $('.filter_data').html('<div id="loading" style="" ></div>');
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
<script>
    $(document).ready(function () {
       
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/province')?>",
            success: function (result_province) {
                // console.log(result_province)
                $("select[name=provinsi]").html(result_province);
            }
        });

      $("select[name=provinsi]").on("change", function(){
            var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
            $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/city')?>",
            data: 'id_provinsi='+id_provinsi_terpilih,
            success: function (result_city) {
                // console.log(result_province)
                $("select[name=kota]").html(result_city);
            }
        });
      });

      $("select[name=kota]").on("change", function(){
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/ekspedisi')?>",
            success: function (result_ekspedisi) {
                // console.log(result_province)
                $("select[name=ekspedisi]").html(result_ekspedisi);
            }
        });
    
    });
    $("select[name=ekspedisi]").on("change", function(){
        
        var ekspedisi_terpilih = $("select[name=ekspedisi]").val();
        var tujuan = $("option:selected","select[name=kota]").attr('id_kota');
        // alert(tujuan);
        var total_berat = <?= $tot_berat ?>;
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/paket')?>",
            data: 'ekspedisi='+ekspedisi_terpilih+'&id_kota='+tujuan+'&berat='+total_berat,
            success: function (result_paket) {
                // console.log(result_province)
                $("select[name=paket]").html(result_paket);
            }
        });
    });
    $("select[name=paket]").on("change", function(){
        
        var dataongkir = $("option:selected", this).attr('ongkir');
        $("#ongkir").html("Rp. " + dataongkir);
        var data_total_bayar = parseInt(dataongkir) + parseInt(<?= $this->cart->total()?>);
        $("#total_bayar").html("Rp. " + data_total_bayar);

        //etd ongkir
        var shipping_etd = $("option:selected", this).attr('shipping_etd');
        $("input[name=shipping_etd]").val(shipping_etd);
        $("input[name=shipping_cost]").val(dataongkir);
        $("input[name=total_price]").val(data_total_bayar);
        // $("input[name=shipping_courier]").val(result_ekspedisi);
        // $("input[name=shipping_service]").val(result_paket);
    });
        jQuery(function () {
        // Init page helpers (Summernote + CKEditor + SimpleMDE plugins)
        Codebase.helpers(['summernote', 'tags-inputs', 'select2','slick']);
    });

      });
</script>
<script>

$('#pay-button').click(function (event) {
    var id = $(this).data('id');
    var grossamount = $(this).data('total_price');
    var shipping_cost = $(this).data('shipping_cost');
    var first_name = $(this).data('first_name');
    var last_name = $(this).data('last_name');
    var phone = $(this).data('phone');
    var email = $(this).data('email');
    var address = $(this).data('address');
    console.log(shipping_cost);
      event.preventDefault();
      $(this).attr("disabled", "disabled");
    
    $.ajax({
      url: '<?=base_url()?>/snap/token',
      cache: false,
        data: {
            grossamount: grossamount,
            id: id,
            first_name: first_name,
            last_name: last_name,
            phone: phone,
            email: email,
            address: address,
        },
      success: function(data) {
        //location = data;

        console.log('token = '+data);
        
        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type,data){
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
          //resultType.innerHTML = type;
          //resultData.innerHTML = JSON.stringify(data);
        }

        snap.pay(data, {
          
          onSuccess: function(result){
            changeResult('success', result);
            console.log(result.status_message);
            console.log(result);
            $("#payment-form").submit();
          },
          onPending: function(result){
            changeResult('pending', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          },
          onError: function(result){
            changeResult('error', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          }
        });
      }
    });
  });

</script>
<script>
$('#form_akun').on('submit', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        
        var form = $('form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        console.log(Array.from(formData));
        // if($("#form_akun").valid() === true){
            var BASE_URL = '<?= base_url(); ?>';
            $.ajax({
                
                url: BASE_URL + 'front/profile/update',
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(res){
                    console.log(res);
                    // swal(res);
                    window.location.replace(BASE_URL+'front/profile');
                },
                error: function(res){
                    console.log('error');
                }
            });
        // }
    });
</script>
</body>

</html>