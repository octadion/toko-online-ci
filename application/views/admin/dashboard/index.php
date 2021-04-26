
<div class="block block-rounded">
    <div class="block-content" style="background-image: url('<?= base_url(); ?>assets/img/illust/header-dashboard.png'); background-size: cover;">
        <div class="py-20 text-center">
            <h1 class="h3 mb-5"><?= $title; ?></h1>
            <p class="mb-10 text-muted">
                <em>Hidroponik Store Phicos</em>
            </p>
        </div>
    </div>
</div>
<!-- 
<div class="block border-left border-3 border-primary"> -->
    <!-- <div class="block-content"> -->
        <!-- <h3 class="mb-0">Selamat Datang, <?= $nama; ?>!</h3>
        <p>Anda telah login sebagai <b><?= $role; ?></b></p> -->
   
       
                    <div class="row gutters-tiny invisible" data-toggle="appear">
                        <!-- Row #1 -->
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-bag fa-3x text-body-bg-dark"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="0" data-to="<?= $product?>">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Product</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-wallet fa-3x text-body-bg-dark"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600">$<span data-toggle="countTo" data-speed="1000" data-to="780">0</span></div>
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Earnings</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-envelope-open fa-3x text-body-bg-dark"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="15">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">Messages</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-xl-3">
                            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                                <div class="block-content block-content-full clearfix">
                                    <div class="float-left mt-10 d-none d-sm-block">
                                        <i class="si si-users fa-3x text-body-bg-dark"></i>
                                    </div>
                                    <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000" data-to="<?= $user?>">0</div>
                                    <div class="font-size-sm font-w600 text-uppercase text-muted">User</div>
                                </div>
                            </a>
                        </div>
                        <!-- END Row #1 -->
                    </div>
                    <div class="row gutters-tiny invisible" data-toggle="appear">
                        <!-- Row #2 -->
                        <div class="col-md-6">
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title">
                                        Sales <small>This week</small>
                                    </h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                        <button type="button" class="btn-block-option">
                                            <i class="si si-wrench"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="pull-all">
                                        <!-- Lines Chart Container -->
                                        <canvas class="js-chartjs-dashboard-lines"></canvas>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <!-- <div class="row items-push">
                                        <div class="col-6 col-sm-4 text-center text-sm-left">
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">This Month</div>
                                            <div class="font-size-h4 font-w600">720</div>
                                            <div class="font-w600 text-success">
                                                <i class="fa fa-caret-up"></i> +16%
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-4 text-center text-sm-left">
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">This Week</div>
                                            <div class="font-size-h4 font-w600">160</div>
                                            <div class="font-w600 text-danger">
                                                <i class="fa fa-caret-down"></i> -3%
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 text-center text-sm-left">
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">Average</div>
                                            <div class="font-size-h4 font-w600">24.3</div>
                                            <div class="font-w600 text-success">
                                                <i class="fa fa-caret-up"></i> +9%
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="block">
                                <div class="block-header">
                                    <h3 class="block-title">
                                        Earnings <small>This week</small>
                                    </h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                            <i class="si si-refresh"></i>
                                        </button>
                                        <button type="button" class="btn-block-option">
                                            <i class="si si-wrench"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="pull-all">
                                        <!-- Lines Chart Container -->
                                        <canvas class="js-chartjs-dashboard-lines2"></canvas>
                                    </div>
                                </div>
                                <div class="block-content bg-white">
                                    <!-- <div class="row items-push">
                                        <div class="col-6 col-sm-4 text-center text-sm-left">
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">This Month</div>
                                            <div class="font-size-h4 font-w600">$ 6,540</div>
                                            <div class="font-w600 text-success">
                                                <i class="fa fa-caret-up"></i> +4%
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-4 text-center text-sm-left">
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">This Week</div>
                                            <div class="font-size-h4 font-w600">$ 1,525</div>
                                            <div class="font-w600 text-danger">
                                                <i class="fa fa-caret-down"></i> -7%
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4 text-center text-sm-left">
                                            <div class="font-size-sm font-w600 text-uppercase text-muted">Balance</div>
                                            <div class="font-size-h4 font-w600">$ 9,352</div>
                                            <div class="font-w600 text-success">
                                                <i class="fa fa-caret-up"></i> +35%
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- END Row #2 -->
                    </div>
                    <div class="row gutters-tiny invisible" data-toggle="appear">
                        <!-- Row #3 -->
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <!-- END Row #3 -->
                    </div>
                    <div class="row gutters-tiny invisible" data-toggle="appear">
                        <!-- Row #4 -->
                        <div class="col-md-6">
                            <a class="block block-link-shadow overflow-hidden" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <i class="si si-briefcase fa-2x text-body-bg-dark"></i>
                                    <div class="row py-20">
                                        <div class="col-6 text-right border-r">
                                            <div class="invisible" data-toggle="appear" data-class="animated fadeInLeft">
                                                <div class="font-size-h3 font-w600">16</div>
                                                <div class="font-size-sm font-w600 text-uppercase text-muted">Projects</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="invisible" data-toggle="appear" data-class="animated fadeInRight">
                                                <div class="font-size-h3 font-w600">2</div>
                                                <div class="font-size-sm font-w600 text-uppercase text-muted">Active</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a class="block block-link-shadow overflow-hidden" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="text-right">
                                        <i class="si si-users fa-2x text-body-bg-dark"></i>
                                    </div>
                                    <div class="row py-20">
                                        <div class="col-6 text-right border-r">
                                            <div class="invisible" data-toggle="appear" data-class="animated fadeInLeft">
                                                <div class="font-size-h3 font-w600 text-info">63250</div>
                                                <div class="font-size-sm font-w600 text-uppercase text-muted">Accounts</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="invisible" data-toggle="appear" data-class="animated fadeInRight">
                                                <div class="font-size-h3 font-w600 text-success">97%</div>
                                                <div class="font-size-sm font-w600 text-uppercase text-muted">Active</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- END Row #4 -->
                    </div>
                    <div class="row gutters-tiny invisible" data-toggle="appear">
                        <!-- Row #5 -->
                        
                
            <!-- END Main Container -->
    <!-- </div> -->
<!-- </div> -->
