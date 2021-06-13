<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en" class="no-focus">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Toko Hidroponik Phicos<?= @$title ? ' - ' . $title : ''; ?></title>

    <meta name="description" content="Info Covid Surakarta">
    <meta name="author" content="pixelcave">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Info Covid Surakarta">
    <meta property="og:site_name" content="Info Covid Surakarta">
    <meta property="og:description" content="Info Covid Surakarta">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>assets/img/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>assets/img/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/dropzonejs/min/dropzone.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/js/plugins/select2/select2-bootstrap.min.css">

    <!-- Codebase framework -->
    <link rel="stylesheet" id="css-main" href="<?= base_url(); ?>assets/css/codebase.min.css">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="<?= base_url(); ?>assets/css/themes/flat.min.css"> -->
    <!-- END Stylesheets -->
</head>

<body>
    <div id="page-container" class="sidebar-o side-scroll page-header-modern main-content-boxed">

        <nav id="sidebar">
            <!-- Sidebar Scroll Container -->
            <div id="sidebar-scroll">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow px-15">
                        <!-- Mini Mode -->
                        <div class="content-header-section sidebar-mini-visible-b">
                            <!-- Logo -->
                            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                            </span>
                            <!-- END Logo -->
                        </div>
                        <!-- END Mini Mode -->

                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="<?= base_url('dashboard'); ?>">
                                    <span class="font-size-xl text-dual-primary-dark">Hidroponik</span><span class="font-size-xl text-primary"> Store</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>
                    <!-- END Side Header -->

                    <!-- Side User -->
                    <div class="content-side content-side-full content-side-user px-10 align-parent">
                        <!-- Visible only in mini mode -->
                        <div class="sidebar-mini-visible-b align-v animated fadeIn">
                            <img class="img-avatar img-avatar32" src="<?= base_url(); ?>assets/img/avatars/avatar15.jpg" alt="">
                        </div>
                        <!-- END Visible only in mini mode -->

                        <!-- Visible only in normal mode -->
                        <div class="sidebar-mini-hidden-b text-center">
                            <a class="img-link" href="<?= base_url('admin/profil')?>">
                                <img class="img-avatar" src="<?= base_url(
                                                                    $this->session->userdata('foto')['name'] != null ? $this->session->userdata('foto')['path']."/".
                                                                    $this->session->userdata('foto')['name'] : 'assets/img/avatars/avatar15.jpg')
                                                                 ?>" alt="">
                            </a>
                            <ul class="list-inline mt-10">
                                <li class="list-inline-item">
                                    <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="<?= base_url('admin/profil')?>"><?= $this->session->userdata('role') != null ? $this->session->userdata('role') : 'Anonymous'; ?></a>
                                    <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                                            <i class="si si-drop"></i>
                                        </a>
                                </li>
                            </ul>
                           
                        </div>
                        <!-- END Visible only in normal mode -->
                    </div>
                    <!-- END Side User -->

                    <!-- Side Navigation -->
                    <div class="content-side content-side-full">
                    <ul class="nav-main">
                                <li>
                                    <a href="<?= base_url('admin/dashboard'); ?>" class="<?= @$menu_active == 'dashboard' ? 'active' : '' ?>"><i class="si si-home"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li>
                                
                                <li class="nav-main-heading"><span class="sidebar-mini-visible">BD</span><span class="sidebar-mini-hidden">Product</span></li>
                                <li class="<?= @$menu_active == 'category' || @$menu_active == 'unit' || @$menu_active == 'product' ? 'open' : '' ?>">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-drawer"></i><span class="sidebar-mini-hide">Catalog</span></a>
                                    <ul>
                                        <li>
                                           <a href="<?= base_url('admin/category'); ?>" class="<?= @$menu_active == 'category' ? 'active' : '' ?>">Category</span></a>
                                        </li>
                    
                                        <li>
                                        <a href="<?= base_url('admin/unit'); ?>" class="<?= @$menu_active == 'unit' ? 'active' : '' ?>">Unit</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('admin/product'); ?>" class="<?= @$menu_active == 'product' ? 'active' : '' ?>">Product</a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="<?= @$menu_active == 'orders' || @$menu_active == 'shipment' || @$menu_active == 'trashed' ? 'open' : '' ?>">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-basket"></i><span class="sidebar-mini-hide">Orders</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?= base_url('admin/order'); ?>" class="<?= @$menu_active == 'orders' ? 'active' : '' ?>">Orders</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('admin/trashed'); ?>" class="<?= @$menu_active == 'trashed' ? 'active' : '' ?>">Trashed</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('admin/shipment'); ?>" class="<?= @$menu_active == 'shipment' ? 'active' : '' ?>">Shipment</a>
                                        </li>
                                       
                                    </ul>
                                </li>
                                <li class="<?= @$menu_active == 'payment' || @$menu_active == 'inventory' || @$menu_active == 'report_product'  ? 'open' : '' ?>">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-layers"></i><span class="sidebar-mini-hide">Reports</span></a>
                                    <ul>
                                        <li>
                                        <a href="<?= base_url('admin/payment'); ?>" class="<?= @$menu_active == 'payment' ? 'active' : '' ?>">Payment</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('admin/report_product'); ?>" class="<?= @$menu_active == 'report_product' ? 'active' : '' ?>">Product</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('admin/inventory'); ?>" class="<?= @$menu_active == 'inventory' ? 'active' : '' ?>">Inventories</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <li class="nav-main-heading"><span class="sidebar-mini-visible">BD</span><span class="sidebar-mini-hidden">General</span></li>
                                <li class="<?= @$menu_active == 'profil' || @$menu_active == 'akun'  ? 'open' : '' ?>">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-users"></i><span class="sidebar-mini-hide">Account</span></a>
                                    <ul>
                                        <li>
                                        <a href="<?= base_url('admin/akun'); ?>" class="<?= @$menu_active == 'akun' ? 'active' : '' ?>">Account</a>
                                        </li>
                                        <li>
                                        <a href="<?= base_url('admin/profil'); ?>" class="<?= @$menu_active == 'profil' ? 'active' : '' ?>">Profile</a>
                                        </li>
                                      
                                    </ul>
                                </li>
                               
                                <li class="<?= @$menu_active == 'pengaturan'  ? 'open' : '' ?>">
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-settings"></i><span class="sidebar-mini-hide">Setting</span></a>
                                    <ul>
                                        <li>
                                        <a href="<?= base_url('admin/setting'); ?>" class="<?= @$menu_active == 'pengaturan' ? 'active' : '' ?>">Setting</a>
                                        </li>
                                      
                                      
                                    </ul>
                                </li>
                              
                                <!-- <li class="nav-main-heading"><span class="sidebar-mini-visible">PG</span><span class="sidebar-mini-hidden">Pages</span></li> -->
                              
                            </ul>
                        <!-- <ul class="nav-main">
                            <li>
                                <a href="<?= base_url('admin/dashboard'); ?>" class="<?= @$menu_active == 'dashboard' ? 'active' : '' ?>"><i class="si si-home"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                            </li>
                            <li class="nav-main-heading">
                                <span class="sidebar-mini-hidden">Product</span>
                            </li>
                            <l>
                                <a href="<?= base_url('admin/category'); ?>" class="<?= @$menu_active == 'category' ? 'active' : '' ?>"><i class="si si-drawer"></i><span class="sidebar-mini-hide">Category</span></a>
                            </l>
                            
                            <l>
                                <a href="<?= base_url('admin/unit'); ?>" class="<?= @$menu_active == 'unit' ? 'active' : '' ?>"><i class="si si-bag"></i><span class="sidebar-mini-hide">Unit</span></a>
                            </l>
                            <l>
                                <a href="<?= base_url('admin/product'); ?>" class="<?= @$menu_active == 'product' ? 'active' : '' ?>"><i class="si si-basket"></i><span class="sidebar-mini-hide">Product</span></a>
                            </l>
                            <li class="nav-main-heading">
                                <span class="sidebar-mini-hidden">Reports</span>
                            </li>
                            <l>
                                <a href="<?= base_url('admin/payment'); ?>" class="<?= @$menu_active == 'payment' ? 'active' : '' ?>"><i class="si si-wallet"></i><span class="sidebar-mini-hide">Payment</span></a>
                            </l>

                            <li class="nav-main-heading">
                                <span class="sidebar-mini-hidden">ACCOUNT</span>
                            </li>
                            

                            <l>
                                <a href="<?= base_url('admin/akun'); ?>" class="<?= @$menu_active == 'akun' ? 'active' : '' ?>"><i class="si si-users"></i><span class="sidebar-mini-hide">Account</span></a>
                            </l>
                            <l>
                                <a href="<?= base_url('admin/profil'); ?>" class="<?= @$menu_active == 'profil' ? 'active' : '' ?>"><i class="si si-user"></i><span class="sidebar-mini-hide">Profile</span></a>
                            </l>
                            <li class="nav-main-heading">
                                <span class="sidebar-mini-hidden">Setting</span>
                            </li>
                            <l>
                                <a href="<?= base_url('admin/setting'); ?>" class="<?= @$menu_active == 'pengaturan' ? 'active' : '' ?>"><i class="si si-settings"></i><span class="sidebar-mini-hide">Setting</span></a>
                            </l>

                        </ul> -->
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- Sidebar Content -->
            </div>
            <!-- END Sidebar Scroll Container -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="content-header-section">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-navicon"></i>
                    </button>
                    <!-- END Toggle Sidebar -->

                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="content-header-section">
                <!-- <div style="margin-right: 10px!important;">
                        <a href="<?=base_url('front')?>" target="_blank">    Lihat website</a>
                    </div> -->
                    <!-- User Dropdown -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $this->session->userdata('name'); ?><i class="fa fa-angle-down ml-5"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown">
                            <a class="dropdown-item" href="<?= base_url('admin/profil')?>">
                                <i class="si si-user mr-5"></i> My Profile
                            </a>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">
                                <i class="si si-logout mr-5"></i> Logout
                            </a>
                        </div>
                    </div>
                    <!-- END User Dropdown -->

                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Loader -->
            <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-primary">
                <div class="content-header content-header-fullrow text-center">
                    <div class="content-header-item">
                        <i class="fa fa-sun-o fa-spin text-white"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            <div class="content">
                <?php $this->load->view($isi); ?>
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->

        <!-- Footer -->
        <footer id="page-footer" class="opacity-0">
            <div class="content py-20 font-size-xs clearfix">
                <div class="float-right">
                    <a class="font-w600" href="#" target="_blank">Hidroponik Store Phicos 2.0</a> &copy; <span class="js-year-copy"><?= date('Y'); ?></span>
                </div>
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Page Container -->

    <!-- Codebase Core JS -->
    <script>
        // Global Variable
        const BASE_URL = '<?= base_url(); ?>';
    </script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.scrollLock.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.appear.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/jquery.countTo.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/core/js.cookie.min.js"></script>

    <!-- Page JS -->
    <script src="<?= base_url(); ?>assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/pages/be_forms_validation.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/sweetalert2/es6-promise.auto.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/select2/select2.full.min.js"></script>

    <script src="<?= base_url(); ?>assets/js/plugins/dropzonejs/min/dropzone.min.js"></script>
    
    <script src="<?= base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/jquery-redirect/jquery.redirect.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    
    <!-- End Page JS -->

    <script src="<?= base_url(); ?>assets/js/codebase.js"></script>
    <script>
        const notifikasi = (option, settings) => {
            $.notify(option, settings);
        }
        
        swal.setDefaults({
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-lg btn-alt-success m-5',
            cancelButtonClass: 'btn btn-lg btn-alt-danger m-5',
            inputClass: 'form-control'
        });
    </script>
    <?= $js; ?>
</body>

</html>