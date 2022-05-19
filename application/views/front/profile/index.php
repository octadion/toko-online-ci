<body class="profile-page">
<div class="wrapper">
<section class="section-profile-cover section-shaped my-0">
      <!-- Circles background -->
      <img class="bg-image" src="<?= base_url(); ?>assets_front/assets/img/slides/sld3.png" style="width: 100%;">
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
                    <img src="<?=base_url(''.$profile->foto_path.''.'/'.''.$profile->foto_name.'')?>"  style="height:180px; width:180px; margin:auto;" class="rounded-circle">
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
              <h3><?=$profile->first_name.' '.$profile->last_name?></h3>
              <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i><?=$profile->phone?></div>
              <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i><?=$profile->email?></div>
              <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i><?=$role?></div>
             
              <!-- <div><i class="ni education_hat mr-2"></i>University of Computer Science</div> -->
            </div>
            <div class="mt-5 py-5 border-top text-center">
              <div class="row justify-content-center">
                <div class="col-lg-9">
                  <p><?=$profile->alamat?></p>
                  <!-- <a href="javascript:;">Show more</a> -->
                </div>
              </div>
            </div>
     
          </div>
        </div>
      </div>
    </section>
</div>
</body>