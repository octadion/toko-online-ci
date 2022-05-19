<section class="breadcrumb-section pb-3 pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </div>
    </section>
    <section class="products-grid pb-4 pt-4">
        <div class="container">
            <div class="row">
            <div class="widget-title">
                                <h3>Checkout</h3>
                            </div>
                            <div class="card shadow">
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <!-- <i class="fa fa-globe"></i> AdminLTE, Inc.
            <small class="pull-right">Date: 2/10/2014</small> -->
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
    
      <!-- /.row -->

      <!-- Table row -->
      <!-- <div class="row"> -->
        <div class="col-xs-12 table-responsive">
          <table class="table">
            <thead>
            <tr>
              <th>Qty</th>
              <th>Product</th>
              <th>Price</th>
              <th>Weight</th>
              <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            $tot_berat = 0;
            if($this->cart->total_items() > 0){ foreach($cartItems as $item){   
                $berat = $item["qty"] * $item["weight"];
                $tot_berat = $tot_berat + $berat;
            ?>
            <tr>
              <td><?php echo $item["qty"]; ?></td>
              <td><?php echo $item["name"]; ?></td>
              <td><?php echo ''.indo_currency($item["price"]).''; ?></td>
              <td><?= $berat?> Gr</td>
              <td><?php echo ''.indo_currency($item["subtotal"]).''; ?></td>
            </tr>
            <?php } }else{ ?>
              <tr><td colspan="6"><p>Your cart is empty.....</p></td>
          <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      <!-- </div> -->
      <!-- /.row -->

      <div class="row">
   
        <div class="col-xs-6">
          <p class="lead">Payment Methods:</p>
          <!-- <img src="../../dist/img/credit/visa.png" alt="Visa">
          <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../../dist/img/credit/american-express.png" alt="American Express">
          <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> -->

          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Enderest Store melayani pembayaran dengan banyak metode antara lain: kartu kredit/debit, transfer bank, e-Money, dan masih banyak lagi.
          Silakan mengisi data diri checkout untuk memproses order anda.
          </p>
        </div>
       
        <div class="col-lg-8">
        <?php
    echo form_open('front/order/add');
    $code = date('Ymd').strtoupper(random_string('alnum',8));

    ?>
        <p><strong>Detail Pembayaran:</strong></p>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
                <label for="">Provinsi</label>
                  <select name="provinsi" class="js-select2 form-control" id="provinsi" required></select>
            </div>
          </div>
          <div class="col-sm-5">
              <div class="form-group">
                  <label for="">Kota</label>
                    <select name="kota" class="js-select2 form-control" id="kota" required></select>
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Kurir</label>
                    <select name="ekspedisi" class="js-select2 form-control" id="ekspedisi" required></select>
              </div>
          </div>
          <div class="col-sm-5">
              <div class="form-group">
                  <label for="">Servis</label>
                    <select name="paket" class="js-select2 form-control" id="paket" required></select>
              </div>
          </div>

          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Nama Depan</label>
                  <input type="text" class="form-control" id="name" name="first_name" required>
              </div>
          </div>
          <div class="col-sm-5">
              <div class="form-group">
                  <label for="">Nama Belakang</label>
                  <input type="text" class="form-control" id="postcode" name="last_name" required>
              </div>
          </div>
         
          <div class="col-sm-8">
              <div class="form-group">
                  <label for="">Alamat</label>
                  <input type="text" class="form-control" id="address" name="address" required>
                   
              </div>
          </div>
          <div class="col-sm-3">
              <div class="form-group">
                  <label for="">Kode Pos</label>
                  <input type="text" class="form-control" id="postcode" name="postcode" required>
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">No. Telp</label>
                  <input type="text" class="form-control" id="phone" name="phone" required>
              </div>
          </div>
          <div class="col-sm-5">
              <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" class="form-control" id="email" name="email" required>
              </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Note</label>
                  <textarea name="note" id="note" cols="85" rows="5"></textarea>
              </div>
          </div>
          <br>
          <br>
          <br>
          <br>
          <br>
          <input type="hidden" name="id">
          <input type="hidden" name="code" value="<?= $code?>">
          <input type="hidden" name="total_price" value="">
          <input type="hidden" name="shipping_cost" value="">
          <input type="hidden" name="grand_total" value="<?= $this->cart->total()?>">
          <input type="hidden"  name="weight" value="<?= $tot_berat ?>">
          <input type="hidden" name="shipping_etd">
          <!-- <input name="shipping_courier">
          <input name="shipping_service"> -->
          <?php
          $i = 1;
          foreach($cartItems as $item){
            echo form_hidden('qty'.$i++, $item['qty']);
          }
          
          ?>

          <div class="col-sm-11">
          <a href="<?= base_url('front/productFront/')?>" class="btn btn-light">Continue shopping</a>
          <button type="submit" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Order</button>                                              
          </div>                           
        </div>
        <?php echo form_close();?>
        </div>
       
       
        <div class="col-xs-6">
          <!-- <p class="lead">Amount Due 2/22/2014</p> -->

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo indo_currency($this->cart->total(), 0); ?></td>
              </tr>
              <tr>
                <th>Weight:</th>
                <td><?= $tot_berat ?> Gr</td>
              </tr>
              <tr>
                <th>Shipping:</th>
                <td><label id="ongkir" for=""></label></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><label id="total_bayar" for=""></label></td>
              </tr>
            </table>
          </div>
         

        </div>
      </div>
      
     

      <!-- this row will not appear when printing -->
      <!-- <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div> -->
    </section>
                    </div>
                  </div>
                </div>
                            </div>

</div>
            </div>
</section>
      <br>