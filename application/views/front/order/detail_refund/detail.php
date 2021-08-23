<section class="breadcrumb-section pb-3 pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order</li>
            </ol>
        </div>
    </section>
    <section class="products-grid pb-4 pt-4">
        <div class="container">
            <div class="row">
            <div class="widget-title">
                                <h3>Detail Order</h3>
                            </div>
                            <div class="card shadow">
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
<table class="table">
<thead>
    <tr>
        <th width="10%">ID</th>
        <th width="30%">Product</th>
        <th width="15%">Qty</th>
        <th width="13%">Weight</th>
        <th width="13%" class="text-center">Status</th>
    </tr>
</thead>
<tbody>
<?php foreach($shipment as $ship){?>
    <tr>
   
        <td>
           <?=$ship->id?>
        </td>
        <td><?=$ship->name?></td>
        <td><?=$ship->qty?></td>
        <td><?=$ship->weight?></td>
       <td class="text-center"><?= $ship->status?></td>
          
    </tr>
    <?php } ?>
</tbody>
</table>
<p class="description">Order anda telah di kirim, mohon tunggu barang anda sedang dalam proses pengiriman. Anda dapat mengecek pesanan anda dengan mengklik tombol track, saat sudah sampai anda dapat mengklik tombol complete untuk menyelesaikan proses order.</p>
<!-- <div class="col mb-6"> -->
 <div class="row">
    <div class="col-sm-6 col-md-3">
        <a href="<?= base_url('front/order')?>" class="btn btn-lg btn-block btn-light">Back</a>
    </div>
    <?php foreach($shipment as $ship){?>
    <?php if($ship->status=='cancelled'){?>
    <div class="col-sm-6 col-md-3">
        <a href="<?= base_url('front/order/refund_form/'.$ship->order_id.'')?>" class="btn btn-lg btn-block btn-primary">Refund</a>
    </div>
    <?php }?>
    <?php }?>
    <!-- <div class="col-sm-6 col-md-3 text-right">
      
        <a href="<?= base_url('front/order/complete/'.$ship->order_id.'')?>" class="btn btn-lg btn-block btn-primary">Complete</a>
     
    </div> -->
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
      