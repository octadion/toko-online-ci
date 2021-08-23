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
        <h3 class="h4 font-weight-bold mb-4">MY ORDER</h4>
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <!-- Tabs with icons -->
              <div class="mb-3">
                <small class="text-uppercase font-weight-bold">Progress Order</small>
              </div>
              <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Order</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Confirmed</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Delivered</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Completed</a>
                  </li>
                </ul>
              </div>
              <div class="card shadow">
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                        <table class="table">
                            <tr>
                                <!-- <th>No.</th> -->
                                <th>Code</th>
                                <th>Date</th>
                                <th>Courier</th>
                                <th class="text-right">Total Price</th>
                                <th class="text-center">Payment Status</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach($unpaid as $key => $value){ ?>
                            <tr>
                                <td><?=$value->code?></td>
                                <td><?=$value->order_date?></td>
                                <td><?=$value->shipping_courier?></td>
                                <td class="text-right"><?=indo_currency($value->total_price)?></td>
                                <td <?php if($value->payment_status == 'pending'){?>
                                class="text-center"><span class="badge badge-warning">Pending</span>
                                <?php } else if($value->payment_status == 'expire'){?>
                                  class="text-center"><span class="badge badge-danger">Expire</span>
                                  <?php } else if($value->payment_status == 'settlement'){?>
                                    class="text-center"><span class="badge badge-success">Paid</span>
                                    <?php }else if($value->payment_status == 'deny'){?>
                                    class="text-center"><span class="badge badge-danger">Denied</span>
                                    <?php }
                                    else if($value->payment_status == 'capture'){?>
                                      class="text-center"><span class="badge badge-success">Capture</span>
                                      <?php }
                                       else if($value->payment_status == 'refund'){?>
                                        class="text-center"><span class="badge badge-warning">refund</span>
                                        <?php }?>
                                </td>
                                <td> <?php if($value->payment_status == 'pending'){?>
                                <a href="<?= base_url('front/order/pay/'.$value->id.'')?>" class="btn btn-sm btn-block btn-primary">Pay</a></button> 
                               <?php } else if($value->payment_status == 'expire'){?>
                                <a href="<?= base_url('front/order/del/'.$value->id.'')?>" class="btn btn-sm btn-block btn-danger">Del</a></button> 
                                <?php }
                                else if($value->payment_status == 'deny'){?>
                                  <a href="<?= base_url('front/order/del/'.$value->id.'')?>" class="btn btn-sm btn-block btn-danger">Del</a></button> 
                                  <?php }
                                   else if($value->payment_status == 'capture'){?>
                                    <a href="<?= base_url('front/order/detail_refund/'.$value->id.'')?>" class="btn btn-sm btn-block btn-primary">Detail</a></button> 
              
                                    <?php }
                                     else if($value->payment_status == 'refund'){?>
                                    <a href="<?= base_url('front/order/del/'.$value->id.'')?>" class="btn btn-sm btn-block btn-danger">Del</a></button> 
                
                                      <?php }
                                      else if($value->payment_status == 'settlement'){?>
                                        <a href="<?= base_url('front/order/detail_refund/'.$value->id.'')?>" class="btn btn-sm btn-block btn-primary">Detail</a></button> 
                    
                                          <?php }?>
                              </td>
                               
                            </tr>
                            <?php } ?>
                        </table>
                        <p class="description">Order anda telah di buat, segera lanjut untuk membayar agar proses pemesanan dapat segera diproses. Anda dapat membayar dengan cara mengklik tombol bayar pada samping pesanan yang sudah dibuat</p>
               
                    </div>
                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <table class="table">
                            <tr>
                                <!-- <th>No.</th> -->
                                <th>Code</th>
                                <th>Date</th>
                                <th>Courier</th>
                                <th class="text-right">Total Price</th>
                                <th class="text-center">Payment Status</th>
                                <!-- <th>Action</th> -->
                            </tr>
                            <?php foreach($packed as $key => $value){ ?>
                            <tr>
                                <td><?=$value->code?></td>
                                <td><?=$value->order_date?></td>
                                <td><?=$value->shipping_courier?></td>
                                <td class="text-right"><?=indo_currency($value->total_price)?></td>
                                <td <?php if($value->payment_status == 'pending'){?>
                                class="text-center"><span class="badge badge-warning">Pending</span>
                                <?php } else if($value->payment_status == 'expire'){?>
                                  class="text-center"><span class="badge badge-danger">Expire</span>
                                  <?php } else if($value->payment_status == 'settlement'){?>
                                    class="text-center"><span class="badge badge-success">Paid</span>
                                    <?php }?>
                                </td>
                                <!-- <td> <?php if($value->payment_status == 'pending'){?>
                                <a href="<?= base_url('front/order/pay/'.$value->id.'')?>" class="btn btn-sm btn-block btn-primary">Pay</a></button> 
                               <?php } else if($value->payment_status == 'expire'){?>
                                <a href="<?= base_url('front/order/del/'.$value->id.'')?>" class="btn btn-sm btn-block btn-danger">Del</a></button> 
                                <?php }?></td> -->
                               
                            </tr>
                            <?php } ?>
                        </table>
                      <p class="description">Order anda telah di konfirmasi, mohon tunggu barang anda sedang dalam proses shipping. Pesanan akan segera dikirim begitu shipping selesai, nomor resi akan dikirim dan anda dapat mengeceknya di tab delivered.</p>
                    </div>
                    <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <table class="table">
                            <tr>
                                <!-- <th>No.</th> -->
                                <th>Code</th>
                                <th>Date</th>
                                <th>Courier</th>
                                <th class="text-right">Total Price</th>
                                <th class="text-center">Payment Status</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach($delivered as $key => $value){ ?>
                            <tr>
                                <td><?=$value->code?></td>
                                <td><?=$value->order_date?></td>
                                <td><?=$value->shipping_courier?></td>
                                <td class="text-right"><?=indo_currency($value->total_price)?></td>
                                <td <?php if($value->payment_status == 'pending'){?>
                                class="text-center"><span class="badge badge-warning">Pending</span>
                                <?php } else if($value->payment_status == 'expire'){?>
                                  class="text-center"><span class="badge badge-danger">Expire</span>
                                  <?php } else if($value->payment_status == 'settlement'){?>
                                    class="text-center"><span class="badge badge-success">Paid</span>
                                    <?php }?>
                                </td>
                                <td>
                                <a href="<?= base_url('front/order/detail/'.$value->id.'')?>" class="btn btn-sm btn-block btn-primary">Detail</a></button> 
                              
                               </td>
                               
                            </tr>
                            <?php } ?>
                        </table>
                      <p class="description">Order anda telah di kirim, mohon tunggu barang anda sedang dalam proses pengiriman. Anda dapat mengecek pesanan anda dengan mengklik tombol track, saat sudah sampai anda dapat mengklik tombol complete untuk menyelesaikan proses order.</p>
                    </div>
                    <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                    <table class="table">
                            <tr>
                                <!-- <th>No.</th> -->
                                <th>Code</th>
                                <th>Date</th>
                                <th>Courier</th>
                                <th class="text-right">Total Price</th>
                                <th class="text-center">Payment Status</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach($completed as $key => $value){ ?>
                            <tr>
                                <td><?=$value->code?></td>
                                <td><?=$value->order_date?></td>
                                <td><?=$value->shipping_courier?></td>
                                <td class="text-right"><?=indo_currency($value->total_price)?></td>
                                <td <?php if($value->payment_status == 'pending'){?>
                                class="text-center"><span class="badge badge-warning">Pending</span>
                                <?php } else if($value->payment_status == 'expire'){?>
                                  class="text-center"><span class="badge badge-danger">Expire</span>
                                  <?php } else if($value->payment_status == 'settlement'){?>
                                    class="text-center"><span class="badge badge-success">Paid</span>
                                    <?php }?>
                                </td>
                                <td>
                                <a href="<?= base_url('front/order/del/'.$value->id.'')?>" class="btn btn-sm btn-block btn-danger">Del</a></button> 
                               </td>
                               
                            </tr>
                            <?php } ?>
                        </table>
                      <p class="description">Order anda telah complete, terimakasih telah membeli produk kami. Silahkan memesan lagi ingin produk kami memuaskan, anda dapat menghapus history order jika anda ingin menghapusnya.</p>
                    </div>
                  </div>
                </div>
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
   <br>
   <br>