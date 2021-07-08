<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en" class="no-focus">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Hidroponik Store Phicos - Register</title>

    <meta name="description" content="Info Covid Surakarta">
    <meta name="author" content="pixelcave">
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
    <link rel="shortcut icon" href="<?= base_url('assets/'); ?>/img/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets/'); ?>/img/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/'); ?>/img/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->
    <link rel="stylesheet" id="css-main" href="<?= base_url('assets/'); ?>/css/codebase.min.css">
</head>

<body>
    <!-- Page Container -->
    <div id="page-container" class="main-content-boxed">
        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            <div class="bg-body-dark bg-pattern" style="background-image: url('<?= base_url('assets/'); ?>/img/various/bg-pattern-inverse.png');">
                <div class="row mx-0 justify-content-center">
                    <div class="hero-static col-lg-6 col-xl-4">
                        <div class="content content-full overflow-hidden">
                            <!-- Header -->
                            <div class="py-30 text-center">
                                <h1 class="h4 font-w700 mt-30 mb-10">Hidroponik Store Phicos</h1>
                            </div>
                            <!-- END Header -->
                            <?= $this->session->flashdata('error_messages'); ?>
                            <?= $this->session->flashdata('success'); ?>
                            <form class="js-validation-signin" action="<?= base_url('auth/register'); ?>" method="post">
                                <input type="hidden" name="previous" value="<?= $this->input->get('page'); ?>">
                                <div class="block block-themed block-rounded block-shadow">
                                    <div class="block-header bg-gd-dusk">
                                        <h3 class="block-title">Silahkan Mengisi Data</h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="fname">First Name</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Masukkan Nama Depan">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="lname">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Masukkan Nama Belakang">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan No. Handphone">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="email">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="passconf">Password Confirmation</label>
                                                <input type="password" class="form-control" id="passconf" name="passconf" placeholder="Masukkan Konfirmasi Password">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                        <div class="col-sm-6 push">
                                        <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="<?=base_url('auth')?>">
                                                    <i class="fa fa-user text-muted mr-5"></i> Sign In
                                                </a>
                                        </div>
                                            <div class="col-sm-6 text-sm-right push">
                                                <button type="submit" class="btn btn-alt-primary">
                                                <i class="fa fa-plus mr-5"></i>Create Account
                                                </button>
                                            </div>
                                        </div>
                                        <!-- <div class="block-content bg-body-light">
                                            <div class="form-group text-center">
                                                <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="op_auth_signup3.html">
                                                    <i class="fa fa-plus mr-5"></i> Create Account
                                                </a>
                                                <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="op_auth_reminder3.html">
                                                    <i class="fa fa-warning mr-5"></i> Forgot Password
                                                </a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->

    <!-- Codebase Core JS -->
    <script src="<?= base_url('assets/'); ?>/js/core/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/core/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/core/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/core/jquery.scrollLock.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/core/jquery.appear.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/core/jquery.countTo.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/core/js.cookie.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/codebase.js"></script>

    <!-- Page JS Plugins -->
    <script src="<?= base_url('assets/'); ?>/js/plugins/jquery-validation/jquery.validate.min.js"></script>


    <script>
        var OpAuthSignIn = function() {
            var initValidationSignIn = function() {
                jQuery('.js-validation-signin').validate({
                    errorClass: 'invalid-feedback animated fadeInDown',
                    errorElement: 'div',
                    errorPlacement: function(error, e) {
                        jQuery(e).parents('.form-group > div').append(error);
                    },
                    highlight: function(e) {
                        jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
                    },
                    success: function(e) {
                        jQuery(e).closest('.form-group').removeClass('is-invalid');
                        jQuery(e).remove();
                    },
                    rules: {
                        'first_name': {
                        required: true,
                        },
                        'last_name': {
                            required: true,
                        },
                        'email': {
                            required: true,
                            minlength: 3,
                            email: true
                        },
                        'phone': {
                        required: true
                        },
                        'alamat': {
                            required: true
                        },
                        'password': {
                            required: true,
                            minlength: 5
                        },
                         'passconf': {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                        },
                    },
                    messages: {
                        'first_name': 'First name wajib diisi!',
                    'last_name': 'Last name wajib diisi!',
                        'email': {
                            required: 'Silahkan masukkan email',
                            minlength: 'Masukkan minimal 3 karakter',
                            email: 'Email anda tidak valid'
                        },
                        'phone': 'Telepon wajib diisi!',
                    'alamat': 'Alamat wajib diisi!',
                        'password': {
                            required: 'Silahkan masukkan password',
                            minlength: 'Masukkan minimal 5 karakter'
                        },
                        'passconf': { 
                        required: 'Password Confirmation wajib diisi!',
                        minlength: 'Password Confirmation minimal 5 karakter',
                        equalTo: 'Password harus sesuai dengan diatas!'
                    },
                    }
                });
            };

            return {
                init: function() {
                    initValidationSignIn();
                }
            };
        }();

        jQuery(function() {
            OpAuthSignIn.init();
        });
    </script>
</body>

</html>