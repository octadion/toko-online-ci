<body class="profile-page">
<div class="wrapper">
<section class="section-profile-cover section-shaped my-0">
      <!-- Circles background -->
      <img class="bg-image" src="<?= base_url(); ?>assets_front/assets/img/slides/slidebaru2.jpg" style="width: 100%;">
      <!-- SVG separator -->
      <div class="separator separator-bottom separator-skew">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section>
    <section class="section bg-secondary">
      <div class="container">
        <div class="card card-profile shadow mt--300">
          <div class="px-4">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="javascript:;">
                  <img src="<?=base_url(''.$profile->foto_path.''.'/'.''.$profile->foto_name.'')?>"style="height:180px; width:180px; margin:auto;"  class="rounded-circle">
                  </a>
                </div>
              </div>
              <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                <div class="card-profile-actions py-4 mt-lg-0">
                  <a href="<?=base_url('front/profile/edit')?>" class="btn btn-sm btn-info mr-4">Edit</a>
                  <!-- <a href="#" class="btn btn-sm btn-default float-right">Message</a> -->
                </div>
              </div>
              <div class="col-lg-4 order-lg-1">
                <div class="card-profile-stats d-flex justify-content-center">
                  <div>
                    <span class="heading"><?=$order?></span>
                    <span class="description">Orders</span>
                  </div>
                  <div>
                  <span class="heading"><?=$prd?></span>
                    <span class="description">Items</span>
                  </div>
                  <!-- <div>
                    <span class="heading">89</span>
                    <span class="description">Reviews</span>
                  </div> -->
                </div>
              </div>
            </div>
          
            <div class="text-center mt-5">
            <!-- <?php echo form_open('front/profile/update')?> -->
            <form id="form_akun" class="js-validation-akun form-validate-summernote" method="post" enctype="multipart/form-data" novalidate>
            <div class="form-group row">
            
              <!-- <h3><?=$profile->first_name.' '.$profile->last_name?></h3> -->
              <label class="col-lg-4 col-form-label" for="val-email">First Name <span class="text-danger">*</span></label>
              <div class="col-6">
              <input type="text" name="first_name" value="<?=$profile->first_name?>" class="form-control">

            </div>
            </div>
            <div class="form-group row">
            <label class="col-lg-4 col-form-label" for="val-email">Last Name <span class="text-danger">*</span></label>
            <div class="col-6">
              <input type="text" name="last_name" value="<?=$profile->last_name?>" class="form-control">
            </div>
            </div>
            <div class="form-group row">
            <label class="col-lg-4 col-form-label" for="val-email">Phone<span class="text-danger">*</span></label>
            <div class="col-6">
              <input type="text" name="phone" value="<?=$profile->phone?>" class="form-control">
            </div>
          
            </div>
            <div class="form-group row">
            <label class="col-lg-4 col-form-label" for="val-email">Email<span class="text-danger">*</span></label>
            <div class="col-6">
              <input type="text" name="email" value="<?=$profile->email?>" class="form-control">
            </div>
          
            </div>
            <div class="form-group row">
            <label class="col-lg-4 col-form-label" for="val-email">Address<span class="text-danger">*</span></label>
            <div class="col-6">
              <input type="text" name="alamat" value="<?=$profile->alamat?>" class="form-control">
            </div>
          
            </div>
            <div class="form-group row">
                <label class="col-lg-4 col-form-label" for="val-website">Foto Profil <span class="text-danger">*</span></label>
                <div class="col-lg-6">
                    <input type="file" accept="image/*" class="form-control" id="foto_name" name="foto_name">
                    <p><small id="error_foto" class="text-danger"></small></p>

                    
                    <div class="alert alert-warning" role="alert">
                        <h3 class="alert-heading font-size-h4 font-w400"><i class="fa fa-warning"></i> Warning</h3>
                        <p class="mb-0">Perhatian! harap file tidak melebihi 2 mb.</p>
                    </div>
                    
                </div>
                
            </div>
            <div class="form-group row">
                <div class="col-lg-8 ml-auto">
                    <button type="submit" name="" class="btn btn-sm btn-primary mr-4">Update</button>
                </div>
            </div>
            </form>
                  <!-- <?php form_close()?>                                               -->
            </div>
            </div>
            <div class="mt-5 py-5 border-top text-center">
              <div class="row justify-content-center">
                <!-- <div class="col-lg-9">
                  <p>An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</p>
                  <a href="javascript:;">Show more</a>
                </div> -->
              </div>
            </div>
     
          </div>
        </div>
      </div>
    </section>
</div>
</body>