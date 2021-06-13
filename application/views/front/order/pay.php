<!-- <div class="section section-components">
      <div class="container"> -->
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
        <h3 class="h4 font-weight-bold mb-4">Pay Order</h4>
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <!-- Tabs with icons -->
              <div class="mb-3">
                <small class="text-uppercase font-weight-bold">Payment</small>
              </div>
              <div class="card shadow">
                <div class="card-body">
                <h4 class="cart-heading">Your Order:</h4>
					<div class="row">
          <?php foreach($unpaid as $key => $value){ ?>
						<div class="col-md-3 col-sm-4">
							<p class="text-dark mb-2" style="font-weight: normal; font-size:14px; text-transform: uppercase;">Billing Address</p>
							<address>
							<?=$value->customer_firstname.' '.$value->customer_lastname?>
								<br> <?=$value->customer_address?>
								<br> Email:  <?=$value->customer_email?>
								<br> Phone: <?=$value->customer_phone?>
								<br> Postcode:  <?=$value->customer_postcode?>
							</address>
						</div>
						<div class="col-xl-3 col-lg-4">
							<p class="text-dark mb-2" style="font-weight: normal; font-size:14px; text-transform: uppercase;">Shipment Address</p>
							<address>
							<?=$value->customer_firstname.' '.$value->customer_lastname?>
								<br><?=$value->customer_address?>
								<br> Email: <?=$value->customer_email?>
								<br> Phone: <?=$value->customer_phone?>59
								<br> Postcode:<?=$value->customer_postcode?>
							</address>
						</div>
						<div class="col-xl-3 col-lg-4">
							<p class="text-dark mb-2" style="font-weight: normal; font-size:14x; text-transform: uppercase;">Details</p>
							<address>
								Invoice:
								<span class="text-dark"><?=$value->code?></span>
								<br> <?=$value->created_at?>
								<br> Status: <?=$value->status?>
								<br> Payment Status: <?=$value->payment_status?>
								<br> Shipped by: <?=$value->shipping_courier?>
							</address>
						</div>
            <?php }?>
                </div>
                
                </div>
              </div>

              <br>
              <div class="card shadow">
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <!-- <th>Date</th> -->
                                <th>Qty</th>
                                <th class="text-right">Unit Cost</th>
                                <th class="text-center">Total</th>
                                <!-- <th>Action</th> -->
                            </tr>
                            <?php foreach($item as $items){ ?>
                            <tr>
                            <td><?=$items->barcode?></td>
                                <td><?=$items->name?></td>
                           
                                <td><?=$items->qty?></td>
                                <td class="text-right"><?=indo_currency($items->base_price)?></td>
                                <td class="text-center"><?=indo_currency($items->base_total)?></td>
                               
                            </tr>
                            <?php } ?>
                        </table>
                        <p class="description">Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        <!-- <p class="description">Detail:</p> -->
                        
<!--                         
                       
                              -->
                                        <div class="row">
                      <div class="col-md-5 ml-auto">
                        <div class="cart-page-total">
                        <table class="table">
                       
                       <tr>
                           <th>Subtotal:</th>
                           <td><?=$value->grand_total?></td>
                          
                       </tr>
                       <tr>
                            <th>Shipping Cost:</th>
                           <td><?=$value->shipping_cost?></td>
                       </tr>
                       <tr>
                           <th>Grand Total:</th>
                           <td><?=$value->total_price?></td>
                       </tr>
                      <th></th>
                      <td><button id="pay-button" data-id="<?=$value->id?>" data-shipping_cost="<?=$value->shipping_cost?>" data-grand_total="<?=$value->grand_total?>" data-total_price="<?=$value->total_price?>"
                                data-first_name="<?=$value->customer_firstname?>" data-last_name="<?=$value->customer_lastname?>" data-phone="<?=$value->customer_phone?>"
                                data-email="<?=$value->customer_email?>" data-address="<?=$value->customer_address?>"
                                 class="btn btn-md  btn-primary"><i class="fa fa-dollar"></i> Pay</button> 
                                </td>
                       </table>
                                            <!-- <a href="https://app.sandbox.midtrans.com/snap/v2/vtweb/ceaaed41-df16-41ce-a969-d8f70e611416">Proceed to payment</a> -->
                                        </div>
                      </div>
                    </div>
                    </div>
                 
                    <!-- <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                      <p class="description">Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                    </div> -->
                    <!-- <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                      <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                    </div> -->
                    <!-- <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                      <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                    </div> -->
                  </div>
                </div>
               
          <!-- <p class="lead">Amount Due 2/22/2014</p> -->

     
            

     
              </div>
            </div>
            <form id="payment-form" method="post" action="<?=base_url()?>/snap/finish">
      <input type="hidden" name="result_type" id="result-type" value=""></div>
      <input type="hidden" name="result_data" id="result-data" value=""></div>
    </form>
            <!-- <div class="col-lg-6 mt-5 mt-lg-0">
              
              <div class="mb-3">
                <small class="text-uppercase font-weight-bold">With text</small>
              </div>
              <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-text" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false">Profile</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-3-tab" data-toggle="tab" href="#tabs-text-3" role="tab" aria-controls="tabs-text-3" aria-selected="false">Messages</a>
                  </li>
                </ul>
              </div>
              <div class="card shadow">
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-text-1" role="tabpanel" aria-labelledby="tabs-text-1-tab">
                      <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                      <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse.</p>
                    </div>
                    <div class="tab-pane fade" id="tabs-text-2" role="tabpanel" aria-labelledby="tabs-text-2-tab">
                      <p class="description">Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                    </div>
                    <div class="tab-pane fade" id="tabs-text-3" role="tabpanel" aria-labelledby="tabs-text-3-tab">
                      <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
        </div>
    </section>
   