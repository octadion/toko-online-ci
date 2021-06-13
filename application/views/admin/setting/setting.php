<!-- <h2 class="content-heading">DataTables Plugin</h2> -->
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

<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="javascript:void(0)">Dashboard</a>
    <span class="breadcrumb-item active">Setting Web</span>
</nav>

<div class="col-md-13"> 
        
            <ul class="nav nav-tabs nav-tabs-block justify-content-start" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-static2-home">Setting</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#btabs-static2-profile">Media Sosial</a>
                </li> -->
               
            </ul>

            
            <div class="tab-content">
                <div class="tab-pane active" id="btabs-static2-home" role="tabpanel">
                <div class="row">
                            <div class="col-md-12">
                                <div class="block block-themed block-rounded block-shadow">
                                    <!-- <div class="block-header block-header-default bg-gd-dusk">
                                        <h3 class="block-title">Edit Akun</h3>
                                    </div> -->
                                    <form id="form_teks" class="js-validation-akun form-validate-summernote" method="post" enctype="multipart/form-data" novalidate>
                                    <div class="block-content block-content-full">
                                            <div class="block">
                                                <div class="block-content">
                                                    <div class="row justify-content-center py-20">
                                                        <div class="col-xl-6">

                                                               
                                                                <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label" for="val-username">Store Name <span class="text-danger">*</span></label>
                                                                <div class="col-lg-6">
                                                                <input type="text" class="form-control" id="store_name" name="store_name" placeholder="">
                                                                <input type="hidden" id="id" name="id" value="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label" for="val-password">Provinsi</label>
                                                                <div class="col-lg-6">
                                                                    <select name="provinsi" class="js-select2 form-control" id="provinsi"></select>
                                                                    <!-- <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter"> -->
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label" for="val-confirm-password">Kota</label>
                                                                <div class="col-lg-6">
                                                                    <select name="kota" class="js-select2 form-control" id="kota"></select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                    <label class="col-lg-4 col-form-label" for="val-email">Address <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-6">
                                                                        <textarea class="form-control" id="address" name="address"></textarea>
                                                                        <!-- <input type="hidden" id="page" name="page" value=""> -->
                                                                    
                                                                    </div>
                                                                </div>
                                                            <div class="form-group row">
                                                                <label class="col-lg-4 col-form-label" for="val-confirm-password">No. Telp <span class="text-danger">*</span></label>
                                                                <div class="col-lg-6">
                                                                    <input type="text" class="form-control" id="no_telp" name="no_telp" p >
                                                                </div>
                                                            </div>
                                                                <div class="form-group row">
                                                                    <div class="col-lg-8 ml-auto">
                                                                        <button type="submit" name="" id="save" class="btn btn-alt-primary">Save</button>
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
