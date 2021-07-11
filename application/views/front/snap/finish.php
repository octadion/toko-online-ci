<!-- <div class="section section-components">
      <div class="container"> -->
      <section class="breadcrumb-section pb-3 pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Payment</li>
            </ol>
        </div>
    </section>
    <section class="products-grid pb-4 pt-4">
        <div class="container">
            <div class="row">
        <h3 class="h4 font-weight-bold mb-4">Payment</h4>
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <!-- Tabs with icons -->
              <div class="mb-3">
                <small class="text-uppercase font-weight-bold">Finish</small>
              </div>
              <div class="card shadow">
                <div class="card-body">
                <h4 class="cart-heading">Your Billing Detail:</h4>
					<div class="row">
        
						<div class="col-md-3 col-sm-4">
							<p class="text-dark mb-2" style="font-weight: normal; font-size:14px; text-transform: uppercase;">Status</p>
							<address>
              <?php echo $finish->status_message;?>
								<br> Gross Amount:  <?=$finish->gross_amount?>
								<br> Payment Type: <?=$finish->payment_type?>
								<br> Transaction Time:  <?=$finish->transaction_time?>
                                <br> Transaction Status:  <?=$finish->transaction_status?>
							</address>
						</div>
						<div class="col-xl-3 col-lg-4">
							<p class="text-dark mb-2" style="font-weight: normal; font-size:14px; text-transform: uppercase;">Details</p>
							<address>
                            <?php if($finish->payment_type == 'bank_transfer'){?>
                                <?php if($finish->va_numbers){?>
                                    <?php foreach($finish->va_numbers as $row){ ?>
                                        <br> Vendor: <?=$row->bank?>
                                        <br> VA Number: <?=$row->va_number?>
                                        <br> Bill Code: --
                            <?php } 
                            } else { ?>
                                <br> Vendor: Permata
                                <br> VA Number: <?=$finish->permata_va_number?>
                                <br> Bill Code: --
                            <?php }
                            } else if($finish->payment_type == 'echannel'){ ?>
                                <br> Vendor: Mandiri
                                <br> VA Number: <?=$finish->bill_key?>
                                <br> Bill Code: <?=$finish->biller_code?>
                            <?php } else { ?>
                                <br> Vendor: Alfamart/Indomart
                                <br> VA Number: <?=$finish->payment_code?>
                                <br> Bill Code: --
							<?php } ?>
                            </address>
						</div>
						<div class="col-xl-3 col-lg-4">
							<p class="text-dark mb-2" style="font-weight: normal; font-size:14x; text-transform: uppercase;">Guide</p>
							<address>
                Panduan Pembayaran:
                <a href=<?php echo $finish->pdf_url;?> target=_blank>Payment Guide</a>
							</address>
              
						</div>
           
                </div>
                <p class="description">Proses pembayaran anda hampir selesai, berikut Virtual Account Number dan Biller Code yang dapat anda gunakan untuk proses pembayaran. Anda juga dapat mendownload guide jika masih memerlukan panduan pembayaran.</p>
                </div>
              </div>

              <br>
           
            </div>
          
           
          </div>
        </div>
        </div>
    </section>
   <br>