<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/backend/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<style>
    .border-3 {
        border-width: 3px !important;
    }
    
</style>
                <div class="bg-image bg-image-bottom" style="background-image: url('../assets/img/photos/photo13@2x.jpg')">
                    <div class="bg-primary-dark-op py-30">
                        <div class="content content-full text-center">
                            <!-- Avatar -->
                            <div class="mb-15">
                                <a class="img-link" href="<?= $this->session->userdata('foto')['path']."/". $this->session->userdata('foto')['name']?>" target="_blank">
                                    <img class="img-avatar img-avatar96 img-avatar-thumb" id="foto" alt="">
                                </a>
                                <a class="align-middle link-effect text-primary-dark font-w600" href=""></a>
                            </div>
                            <h1 class="h3 text-white font-w700 mb-10" id=""><?= $this->session->userdata('first_name').' '.$this->session->userdata('last_name')?></h1>
                            <h2 class="h5 text-white-op">
                            <?= $this->session->userdata('role')?> <a class="text-primary-light" href="javascript:void(0)">@EnderestStore</a>
                            </h2>
                        </div>
                    </div>
                </div>
                <br>
                <nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="javascript:void(0)">Dashboard</a>
    <span class="breadcrumb-item active">Profil</span>
</nav>

    <div class="col-md-13"> 
        <div class="block">
            <ul class="nav nav-tabs nav-tabs-alt justify-content-start" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-static2-home">Akun</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-static2-profile">Password</a>
                </li>
               
            </ul>

            
            <div class="tab-content">
                <div class="tab-pane active" id="btabs-static2-home" role="tabpanel">
                <div class="row">
                            <div class="col-md-12">
                                <div class="block block-themed block-rounded">
                                    <!-- <div class="block-header block-header-default bg-gd-dusk">
                                        <h3 class="block-title">Edit Akun</h3>
                                    </div> -->
                                    <form id="form_akun" class="js-validation-akun form-validate-summernote" method="post" enctype="multipart/form-data" novalidate>
                                    <div class="block-content block-content-full">
                                            <div class="block">
                                                <div class="block-content">
                                                    <div class="row justify-content-center py-20">
                                                        <div class="col-xl-6">
                                                            <!-- jQuery Validation (.js-validation-bootstrap class is initialized in js/pages/be_forms_validation.js) -->
                                                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                                            <!-- <form class="js-validation-akun form-validate-summernote" id="form_akun" method="post"> -->
                                                                <!-- <div class="form-group row">
                                                                    <label class="col-lg-4 col-form-label" for="val-username">Username <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-6">
                                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="">
                                                                    <input type="hidden" id="page" name="page" value="">
                                                                    <input type="hidden" id="id" name="id" value="">
                            
                                                                    </div>
                                                                </div> -->
                                                                <div class="form-group row">
                                                                    <label class="col-lg-4 col-form-label" for="val-email">First Name <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-6">
                                                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="">
                                                                        <input type="hidden" id="page" name="page" value="">
                                                                        <input type="hidden" id="id" name="id" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-lg-4 col-form-label" for="val-email">Last Name <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-6">
                                                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Name" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-6">
                                                                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="">
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="form-group row">
                                                                    <label class="col-lg-4 col-form-label" for="val-currency">Nama Depan <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-6">
                                                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nama Depan" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-lg-4 col-form-label" for="val-website">Nama Belakang <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-6">
                                                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nama Belakang" value="">
                                                                    </div>
                                                                </div> -->
                                                                <div class="form-group row">
                                                                    <label class="col-lg-4 col-form-label" for="val-website">Phone <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-6">
                                                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-lg-4 col-form-label" for="val-website">Address <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-6">
                                                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Address" value="">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-lg-4 col-form-label" for="val-website">Foto Profil <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-6">
                                                                        <input type="file" accept="image/*" class="form-control" id="foto_name" name="foto_name">
                                                                        <p><small id="error_foto" class="text-danger"></small></p>
                                                                        
                                                                        <!-- <div class="col-lg-6">
                                                                    <button title="hapus foto profil" style="position: absolute;top:-10px;right: -50px;display: none;" id="remove_foto_name" type="button" class="btn btn-sm btn-circle btn-alt-danger mr-5 mb-5"><i class="fa fa-times"></i></button>
                                                                        <img src="" class="img-avatar img-avatar96 img-avatar-thumb" alt="pilih foto profil" id="tmp_foto_name" width="150">
                                                                        </div> -->
                                                                        
                                                                        <div class="alert alert-warning" role="alert">
                                                                            <h3 class="alert-heading font-size-h4 font-w400"><i class="fa fa-warning"></i> Warning</h3>
                                                                            <p class="mb-0">Perhatian! harap file tidak melebihi 2 mb.</p>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    
                                                                </div>
                                                                
                                                                <!-- <div class="form-group row">
                                                                    <label class="col-lg-4 col-form-label" for="val-skill">Role <span class="text-danger"></span></label>
                                                                    <div class="col-lg-6">
                                                                    <select class="js-select2 form-control" id="role_id" name="role_id" readonly>
                                                                        <option value="1">Admin</option>
                                                                    </select>
                                                                    </div>
                                                                </div> -->
                                                                <div class="form-group row">
                                                                    <div class="col-lg-8 ml-auto">
                                                                        <button type="submit" name="" id="save" class="btn btn-alt-primary">Update</button>
                                                                    </div>
                                                                </div>
                                                            <!-- </form> -->
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>              
                                    </div>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        </div>
                        <div class="tab-pane" id="btabs-static2-profile" role="tabpanel">
                        <div class="row">
                        <div class="col-md-12">
                            <div class="block block-themed block-rounded">
                                <!-- <div class="block-header block-header-default bg-gd-dusk">
                                    <h3 class="block-title">Ganti Password</h3>
                                </div> -->
                                <form id="form_password" class="js-validation-password form-validate-summernote" method="post">
                                <div class="block-content block-content-full">
                                        <div class="block">
                                            <div class="block-content">
                                                <div class="row justify-content-center py-20">
                                                    <div class="col-xl-6">
                                                        <!-- jQuery Validation (.js-validation-bootstrap class is initialized in js/pages/be_forms_validation.js) -->
                                                        <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                                        <!-- <form class="js-validation-akun form-validate-summernote" id="form_akun" method="post"> -->
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label" for="val-username">Password Lama <span class="text-danger">*</span></label>
                                                                <div class="col-lg-6">
                                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password Lama">
                                                                <!-- <input type="hidden" id="page" name="page" value="">
                                                                <input type="hidden" id="id" name="id" value=""> -->
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label" for="val-password">Password Baru<span class="text-danger">*</span></label>
                                                                <div class="col-lg-6">
                                                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Password Baru">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label" for="val-confirm-password">Confirm Password <span class="text-danger">*</span></label>
                                                                <div class="col-lg-6">
                                                                    <input type="password" class="form-control" id="passconf" name="passconf" placeholder="Password Confirmation" >
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-8 ml-auto">
                                                                    <button type="submit" class="btn btn-alt-primary">Update</button>
                                                                </div>
                                                            </div>
                                                        <!-- </form> -->
                                                    </div>
                                                </div>

                                            </div>
                                        </div>              
                                </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    </div>
                    
                </div>
            </div>
    </div>
</form>