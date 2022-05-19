<div class="block block-rounded">
    <div class="block-content" style="background-image: url('<?= base_url(); ?>assets/img/illust/header-dashboard.png'); background-size: cover;">
        <div class="py-20 text-center">
            <h1 class="h3 mb-5"><?= $title; ?></h1>
            <p class="mb-10 text-muted">
                <em>Enderest Store</em>
            </p>
        </div>
    </div>
</div>

<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="<?= base_url('admin/order') ?>">Dashboard</a>
    <span class="breadcrumb-item active">Orders</span>
</nav>
<h2 class="content-heading">
                        <!-- <button type="button" class="btn btn-sm btn-secondary float-right">
                            <i class="fa fa-envelope-o text-info mr-5"></i>Contact
                        </button> -->
                        Customer
                    </h2>
                    <div class="row row-deck">
                        <!-- Customer's Basic Info -->
                        <div class="col-lg-4">
                            <a class="block block-rounded block-link-shadow text-center" href="be_pages_ecom_customer.html">
                                <div class="block-content bg-gd-dusk">
                                    <div class="push">
                                        <img class="img-avatar img-avatar-thumb" src="<?=base_url(''.$data->foto_path.''.'/'.''.$data->foto_name.'')?>" alt="">
                                    </div>
                                    <div class="pull-r-l pull-b py-10 bg-black-op-25">
                                        <div class="font-w600 mb-5 text-white">
                                           <?=$data->first_name.' '.$data->last_name?> <i class="fa fa-star text-warning"></i>
                                        </div>
                                        <div class="font-size-sm text-white-op">User</div>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="row items-push text-center">
                                        <div class="col-6">
                                            <div class="mb-5"><i class="si si-bag fa-2x"></i></div>
                                            <div class="font-size-sm text-muted"><?=$total_order?> Orders</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-5"><i class="si si-basket-loaded fa-2x"></i></div>
                                            <div class="font-size-sm text-muted"><?=$tot_product?> Products</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- END Customer's Basic Info -->

                        <!-- Customer's Past Orders -->
                        <div class="col-lg-8">
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Past Orders</h3>
                                </div>
                                <div class="block-content">
                                    <table class="table table-borderless table-sm table-striped">
                                        <tbody>
                                        <?php foreach($order as $ord){?>
                                            <tr>
                                                <td>
                                                    <a class="font-w600" href="be_pages_ecom_order.html"><?=$ord->code?></a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-success"><?=$ord->status?></span>
                                                </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <?=$ord->order_date?>                               </td>
                                                <td class="d-none d-sm-table-cell">
                                                    <a href="be_pages_ecom_customer.html"><?=$ord->first_name.' '.$ord->last_name?></a>
                                                </td>
                                                <td class="text-right">
                                                    <span class="text-black"><?=indo_currency($ord->total_price)?></span>
                                                </td>
                                            </tr>
                                           <?php } ?>
                                          
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END Customer's Past Orders -->
                    </div>
                    <!-- END Customer -->

                    <!-- Addresses -->
                    <h2 class="content-heading">Addresses</h2>
                    <div class="row row-deck gutters-tiny">
                        <!-- Billing Address -->
                        <div class="col-md-6">
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Billing Address</h3>
                                </div>
                                <div class="block-content">
                                    <div class="font-size-lg text-black mb-5"> <?=$data->first_name.' '.$data->last_name?> </div>
                                    <address>
                                        <?=$data->alamat?><br>
                                        <?=$data->customer_postcode?><br>
                                        <?=$data->customer_city?><br><br>
                                        <i class="fa fa-phone mr-5"></i> <?=$data->phone?><br>
                                        <i class="fa fa-envelope-o mr-5"></i> <a href="javascript:void(0)"><?=$data->email?></a>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <!-- END Billing Address -->

                        <!-- Shipping Address -->
                        <div class="col-md-6">
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">Shipping Address</h3>
                                </div>
                                <div class="block-content">
                                    <div class="font-size-lg text-black mb-5"><?=$data->customer_firstname.' '.$data->customer_lastname?></div>
                                    <address>
                                    <?=$data->customer_address?><br>
                                        <?=$data->customer_postcode?><br>
                                        <?=$data->customer_city?><br><br>
                                        <i class="fa fa-phone mr-5"></i>  <?=$data->customer_phone?><br>
                                        <i class="fa fa-envelope-o mr-5"></i> <a href="javascript:void(0)"><?=$data->customer_email?></a>
                                    </address>
                                </div>
                            </div>
                        </div>
                        <!-- END Shipping Address -->
                    </div>
                    <!-- END Addresses -->

                    <!-- Products -->
                    <h2 class="content-heading">Products (<?=$total_tabelprd?>)</h2>
                    <div class="block block-rounded">
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px;">ID</th>
                                            <th>Product</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">QTY</th>
                                            <th class="text-right" style="width: 10%;">UNIT</th>
                                            <th class="text-right" style="width: 10%;">PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($product as $prd){?>
                                        <tr>
                                            <td>
                                                <a class="font-w600" href="be_pages_ecom_product_edit.html"><?=$prd->product_id?></a>
                                            </td>
                                            <td>
                                                <a href="be_pages_ecom_product_edit.html"><?=$prd->name?></a>
                                            </td>
                                            <td class="text-center"><?=$prd->stock?></td>
                                            <td class="text-center font-w600"><?=$prd->qty?></td>
                                            <td class="text-right"><?=indo_currency($prd->base_price)?></td>
                                            <td class="text-right"><?=indo_currency($prd->base_total)?></td>
                                        </tr>
                                        <?php }?>
                                   
                                      
                                        <tr>
                                            <td colspan="5" class="text-right font-w600">Total Price:</td>
                                            <td class="text-right"><?=indo_currency($total)?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right font-w600">Shipping Cost:</td>
                                            <td class="text-right"><?=indo_currency($prd->shipping_cost)?></td>
                                        </tr>
                                        <tr class="table-success">
                                            <td colspan="5" class="text-right font-w600 text-uppercase">Total:</td>
                                            <td class="text-right font-w600"><?=indo_currency($prd->total_price)?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>