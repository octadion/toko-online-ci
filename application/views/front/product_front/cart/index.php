<script>
// Update item quantity
function updateCartItem(obj, rowid){
    const id = $(obj).attr("data-id")
    console.log(id);
    $.get("<?php echo base_url('front/cart/updateItemQty/'); ?>", {rowid:rowid, qty:obj.value, id:id}, function(resp){
        if(resp == 'ok'){
            location.reload();
        }else{
            Swal.fire(
            'Mohon Maaf',
            'Stock tidak mencukupi',
            'error'
            );
        }
    });
}
</script>
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
                                <h3>Shop Cart</h3>
                            </div>
                            <div class="card shadow">
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
<table class="table" id="table-cart">
<thead>
    <tr>
        <th width="10%"></th>
        <th width="30%">Product</th>
        <th width="15%">Price</th>
        <th width="13%">Quantity</th>
        <th width="13%" class="text-center">Weight</th>
        <th width="20%" class="text-right">Subtotal</th>
        <th width="12%"></th>
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
        <td>
            <?php $imageURL = !empty($item["foto"])?base_url('uploads'."/".$item["foto"]):base_url('assets/images/pro-demo-img.jpeg'); ?>
            <img src="<?php echo $imageURL; ?>" width="50"/>
        </td>
        <td><?php echo $item["name"]; ?></td>
        <td><?php echo ''.indo_currency($item["price"]).''; ?></td>
        <td><input type="number" class="form-control text-center" data-id="<?php echo $item["id"]; ?>" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
       <td class="text-center"><?= $berat?> Gr</td>
        <td class="text-right"><?php echo ''.indo_currency($item["subtotal"]).''; ?></td>
        <td class="text-right"><button class="btn btn-sm btn-danger" onclick="window.location.href='<?php echo base_url('front/cart/removeItem/'.$item["rowid"]); ?>'"><i class="fa fa-remove"></i> </button> </td>
    </tr>
    <?php } }else{ ?>
    <tr><td colspan="6"><p>Your cart is empty.....</p></td>
    <?php } ?>
    <?php if($this->cart->total_items() > 0){ ?>
    <tr>
        
        <td></td>
        <td></td>
        <td><strong>Cart Total</strong></td>
        <td><strong><?php echo 'Rp. '.$this->cart->total().''; ?></strong></td>
        <td><strong>Total Berat</strong></td>
        <td ><strong><?= $tot_berat ?></strong> <strong>Gr</strong></td>
        
        <td></td>
    </tr>
    <?php } ?>
</tbody>
</table>
<p class="description">Order anda telah di simpan dikeranjang, silakan proses ke checkout jika barang sudah terpilih semua atau anda dapat memilih produk lagi. Pesanan anda akan di data pada proses checkout nanti.</p>
<!-- <div class="col mb-6"> -->
 <div class="row">
    <div class="col-sm-6 col-md-3">
        <a href="<?= base_url('front/productFront/')?>" class="btn btn-lg btn-block btn-light">Continue shopping</a>
    </div>
    <div class="col-sm-6 col-md-3 text-right">
        <?php if($this->cart->total_items()>0){?>
        <a href="<?= base_url('front/checkout/cod')?>" class="btn btn-lg btn-block btn-primary">Checkout (COD)</a>
        <?php }?>
    </div>
    <div class="col-sm-6 col-md-3 text-right">
        <?php if($this->cart->total_items()>0){?>
        <a href="<?= base_url('front/checkout/')?>" class="btn btn-lg btn-block btn-primary">Checkout (Online)</a>
        <?php }?>
    </div>
 </div>
<!-- </div> -->
                    </div>
                    </div>
                    </div>
                    </div>

</div>
            </div>
</section>
<br>
<br>