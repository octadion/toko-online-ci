<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Hidroponik Store Phicos - Solusi Sayuran Sehat Anda</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link href="<?= base_url(); ?>assets_front/assets/css/nucleo-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets_front/assets/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('assets/')?>vendors/linericon/style.css">
    <!-- Jquery UI -->
    <link type="text/css" href="<?= base_url(); ?>assets_front/assets/css/jquery-ui.css" rel="stylesheet">

    <!-- Argon CSS -->
    <link type="text/css" href="<?= base_url(); ?>assets_front/assets/css/argon-design-system.min.css" rel="stylesheet">

    <!-- Main CSS-->
    <link type="text/css" href="<?= base_url(); ?>assets_front/assets/css/style.css" rel="stylesheet">
    
    <!-- Optional Plugins-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="<?=base_url();?>assets/css/argon-design-system.css?v=1.2.2" rel="stylesheet" />
</head>
<style>
#loading
{
    text-align: center;
    background: url('<?= base_url();?>assets_front/loader.gif') 
    no-repeat center ;
    height: 150px;
}
</style>
<body>
    <header class="header clearfix">
        <div class="top-bar d-none d-sm-block">
            <div class="container">
                <div class="row">
                    <div class="col-6 text-left">
                        <ul class="top-links contact-info">
                            <li><i class="fa fa-envelope-o"></i> <a href="#">hidroponik.phicos@gmail.com</a></li>
                            <li><i class="fa fa-whatsapp"></i> +1 5589 55488 55</li>
                        </ul>
                    </div>
                    <div class="col-6 text-right">
                        <ul class="top-links account-links">
                            <li><i class="fa fa-user-circle-o"></i> <a href="<?=base_url('front/profile')?>">My Account</a></li>
                            <?= $this->session->userdata('logged_in')==true? '<li><i class="fa fa-power-off"></i> <a href="'.base_url('auth/logout').'">Logout</a></li> ' : '<li><i class="fa fa-power-off"></i> <a href="#">Login</a></li>'?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-main border-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-12 col-sm-6">
                        <a class="navbar-brand mr-lg-5" href="<?= base_url(); ?> assets_front/index.html">
                            <i class="fa fa-shopping-bag fa-3x"></i> <span class="logo">HidroStore</span>
                        </a>
                    </div>
                    <div class="col-lg-7 col-12 col-sm-6">
                    <!-- <?php echo form_open('front/productfront/search')?> -->
                        <!-- <form action="<?=base_url('front/productfront/search')?>" class="search"> -->
                            <!-- <div class="input-group w-100">
                                <input type="text" name="keyword"class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div> -->
                        <!-- </form> -->
                        <!-- <?php form_close()?> -->
                    </div>
                    <div class="col-lg-2 col-12 col-sm-6">
                        <div class="right-icons pull-right d-none d-lg-block">
                            <div class="single-icon wishlist">
                                <a href="#"><i class="fa fa-heart-o fa-2x"></i></a>
                                <span class="badge badge-default"></span>
                            </div>
                            <div class="single-icon shopping-cart">
                            <a href="<?php echo base_url('front/cart'); ?>" title="View Cart"><i class="fa fa-shopping-cart fa-2x"></i> 
                            </a>
                                <span class="badge badge-default">(<?php echo ($this->cart->total_items() > 0)?$this->cart->total_items().'':'Empty'; ?>)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-main navbar-expand-lg navbar-light border-top border-bottom">
            <div class="container">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                    aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?= base_url('front/home')?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('front/about')?>">About</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">Pages</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= base_url('front/productFront/')?>">Products</a>
                                <!-- <a class="dropdown-item" href="product-detail.html">Product Detail</a> -->
                                <a class="dropdown-item" href="<?= base_url('front/cart')?>">Cart</a>
                                <!-- <a class="dropdown-item" href="checkout.html">Checkout</a> -->
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('front/order/')?>">ORDER</a>
                        </li>
                    </ul>
                </div> <!-- collapse <?= base_url(); ?> assets_front// -->
            </div> <!-- container <?= base_url(); ?> assets_front// -->
        </nav>
    </header>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="<SB-Mid-client-_dCWZfqcBr4vmo90>"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>