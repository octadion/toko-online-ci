<section class="breadcrumb-section pb-3 pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Refund</li>
            </ol>
        </div>
    </section>
    <section class="products-grid pb-4 pt-4">
        <div class="container">
            <div class="row">
            <div class="widget-title">
                                <h3>Form Refund</h3>
                            </div>
                            <div class="card shadow">
                <div class="card-body">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
<table class="table">
<thead>
    <tr>
        <th width="10%">ID</th>
        <th width="30%">Payment Type</th>
        <th width="15%">Vendor</th>
        <th width="13%">Amount</th>
        <th width="13%" class="text-center">Status</th>
    </tr>
</thead>
<tbody>
<?php foreach($pay as $ship){?>
    <tr>
   
        <td>
           <?=$ship->id?>
        </td>
        <td><?=$ship->payment_type?></td>
        <td><?=$ship->vendor_name?></td>
        <td><?=$ship->gross_amount?></td>
       <td class="text-center"><?= $ship->status?></td>
          
    </tr>
    <?php } ?>
</tbody>
</table>
<!-- <div class="text-center mt-5"> -->

<!-- </div> -->
<p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">Order anda telah di cancel, mohon untuk mengisi form dibawah. Anda harus mengisikan nomor rekening dan amount agar order anda dapat diproeses untuk pengembalian dananya.</p>
<!-- <div class="col mb-6"> -->
<?php
    echo form_open('front/order/add_refund');

    ?>
<div class="row">
          <div class="col-sm-6">
            <div class="form-group">
                <label for="">Bank Number</label>
                <input type="text" name="no_rekening" value="" class="form-control">
                <input type="hidden" name="order_id" value="<?=$ship->order_id?>">
            </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                  <label for="">Amount</label>
                  <input type="text" name="amount_refund" value="" class="form-control">
              </div>
          </div>
</div>
<div class="row">
    <div class="col-sm-3 col-md-3">
        <a href="<?= base_url('front/order')?>" class="btn btn-md btn-block btn-light">Back</a>
    </div>
    <div class="col-sm-3 col-md-3">
    <button type="submit" class="btn btn-md btn-block btn-primary"><i class="fa fa-money"></i> Refund</button>        
    </div>
 </div>
 <?php echo form_close();?>
<!-- </div> -->
                    </div>
                    </div>
                    </div>
                    </div>

</div>
            </div>
</section>
<br>
      