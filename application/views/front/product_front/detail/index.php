<section class="breadcrumb-section pb-3 pt-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
            </ol>
        </div>
    </section>
    <section class="product-page pb-4 pt-4">
        <div class="container">
            <div class="row product-detail-inner">
                <div class="col-lg-6 col-md-6 col-12">
                <!-- <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true" data-arrows="true">
                <?php foreach($foto as $ft){?>
                    <div>
                        <img class="img-fluid" src=" <?= base_url(); ?><?=$ft->foto_path.'/'.$ft->foto_name?>" alt="Project Promo 1">
                    </div>
                    <?php }?>
                </div> -->
                    <div id="product-images" class="carousel slide" data-ride="carousel">
                     
                       
                        <div class="carousel-inner">

                        <?=$slides?>
                
                            <!-- <div class="carousel-item active"> <img src="<?= base_url(); ?><?=$ft->foto_path.'/'.$ft->foto_name?>" alt="Product 1"> </div>
                            <div class="carousel-item"> <img src="<?= base_url(); ?>assets_front/assets/img/products/2.jpg" alt="Product 2"> </div>
                            <div class="carousel-item"> <img src="<?= base_url(); ?>assets_front/assets/img/products/3.jpg" alt="Product 3"> </div>
                            <div class="carousel-item"> <img src="<?= base_url(); ?>assets_front/assets/img/products/4.jpg" alt="Product 4"> </div> -->
                      
                        </div>
            
                        <a class="carousel-control-prev" href="#product-images" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#product-images" data-slide="next"> <span class="carousel-control-next-icon"></span> </a>
                        <ol class="carousel-indicators list-inline">
                        <?= $indicators?>
                            <!-- <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#product-images"> <img src="<?= base_url(); ?><?=$ft->foto_path.'/'.$ft->foto_name?>" class="img-fluid"> </a> </li>
                            <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#product-images"> <img src="<?= base_url(); ?>assets_front/assets/img/products/2.jpg" class="img-fluid"> </a> </li>
                            <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#product-images"> <img src="<?= base_url(); ?>assets_front/assets/img/products/3.jpg" class="img-fluid"> </a> </li>
                            <li class="list-inline-item"> <a id="carousel-selector-3" data-slide-to="3" data-target="#product-images"> <img src="<?= base_url(); ?>assets_front/assets/img/products/4.jpg" class="img-fluid"> </a> </li> -->
                        </ol>
            
                       
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="product-detail">
                        <h2 class="product-name"><?=$data->name?></h2>
                        <div class="product-price">
                            <span class="price"><?= indo_currency($data->price)?></span>
                        </div>
                        <div class="product-short-desc">
                            <p><?= $data->short_desc?>
                            </p>
                        </div>
                        <div class="product-select">
                            <!-- <form> -->
                                <div class="form-group">
                                    <label>Stock</label>
                                    <!-- <?=print_r($stock)?> -->
                                   
                                   <input type="text" class="form-control" <?php foreach($stock as $st){?> value="<?=$st['qty']?>" <?php } ?> readonly>
                                 
                                </div>
                                <div class="form-group">
                                    <label>Weight</label>
                                    <input type="text" class="form-control" value="<?=$data->weight?> Gr" readonly>
                                </div>
                                <?php
                                echo form_open('front/productFront/cart_by_dtl');
                                echo form_hidden('id', $data->id);
                                echo form_hidden('price', $data->price);
                                echo form_hidden('name', $data->name);
                                echo form_hidden('foto', $data->thumbnail);
                                echo form_hidden('weight', $data->weight);
                                echo form_hidden('barcode', $data->barcode);
                                echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                                ?>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="number" name="qty" class="form-control" value="1" min="1"/>
                                        <!-- <input type="hidden" name="id" value="<?= $data->id?>">
                                        <input type="hidden" name="price" value="<?= $data->price?>">
                                        <input type="hidden" name="name" value="<?= $data->name?>"> -->
                                    </div>
                                    <div class="col-md-5">
                                        <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#" class="btn btn-secondary"><i class="fa fa-heart-o"></i></a>
                                    </div>
                                </div>
                                <?php echo form_close();?>
                            <!-- </form> -->
                        </div>
                        <div class="product-categories">
                            <ul>
                                <li class="categories-title">Categories :</li>
                                <li><a href="#"> <?= $data->category_name?></a></li>
                            </ul>
                        </div>
                        <!-- <div class="product-tags">
                            <ul>
                                <li class="categories-title">Tags :</li>
                                <li><a href="#">fashion</a></li>
                                <li><a href="#">electronics</a></li>
                                <li><a href="#">toys</a></li>
                                <li><a href="#">food</a></li>
                                <li><a href="#">jewellery</a></li>
                            </ul>
                        </div> -->
                        <div class="product-share">
                            <ul>
                                <li class="categories-title">Share :</li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-details">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item">
                                    <!-- <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">Reviews</a> -->
                                </li>
                            </ul>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                        <p><?= $data->description?></p>
                                       
                                    </div>
                                    <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                        <div class="review-form">
                                            <h3>Write a review</h3>
                                            <form>
                                                <div class="form-group">
                                                    <label>Your Name</label>
                                                    <input type="text" class="form-control"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Your Review</label>
                                                    <textarea cols="4" class="form-control"></textarea>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="other-products pb-4 pt-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
            <?php foreach($product as $produk){?>
                <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="<?=base_url('front/productFront/detail/'.$produk->id.'')?>">
                                <img src=" <?= base_url('uploads/'.$produk->thumbnail.'') ?>" style="height:250px; width:300px; margin:auto;" class="img-fluid" />
                            </a>
                        </div>
                        <div class="product-content">
                            <h3><a href="<?=base_url('front/productFront/detail/'.$produk->id.'')?>"><?= $produk->name?></a></h3>
                            <div class="product-price">
                                <span><?= indo_currency($produk->price)?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                <!-- <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="product-detail.html">
                                <img src="./assets/img/products/p2.jpg" class="img-fluid" />
                            </a>
                        </div>
                        <div class="product-content">
                            <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                            <div class="product-price">
                                <span>$57.00</span>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="product-detail.html">
                                <img src="./assets/img/products/p3.jpg" class="img-fluid" />
                            </a>
                        </div>
                        <div class="product-content">
                            <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                            <div class="product-price">
                                <span>$57.00</span>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="product-detail.html">
                                <img src="./assets/img/products/p4.jpg" class="img-fluid" />
                            </a>
                        </div>
                        <div class="product-content">
                            <h3><a href="product-detail.html">Cool &amp; Awesome Item</a></h3>
                            <div class="product-price">
                                <span>$57.00</span>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <br>