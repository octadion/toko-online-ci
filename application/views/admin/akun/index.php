<!-- <h2 class="content-heading">DataTables Plugin</h2> -->
<div class="block block-rounded">
    <div class="block-content" style="background-image: url('<?= base_url(); ?>assets/img/illust/header-dashboard.png'); background-size: cover;">
        <div class="py-20 text-center">
            <h1 class="h3 mb-5"><?= $title; ?></h1>
            <p class="mb-10 text-muted">
                <em>Enderest Store</em>
            </p>
        </div>
    </div>
</div>

<nav class="breadcrumb bg-white push">
    <a class="breadcrumb-item" href="javascript:void(0)">Dashboard</a>
    <span class="breadcrumb-item active">Manajemen Akun</span>
</nav>

<!-- Dynamic Table Full -->
<div class="block block-rounded block-shadow">
    <div class="block-header block-header-default">
        <h3 class="block-title">List Akun</h3>
        <div class="block-options">
        <button type="button" id="tambah_add" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-popin2">
                <i class="fa fa-plus"></i> Tambah Akun
            </button>
        </div>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
        <table id="table_akun" class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;"></th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Role</th>
                    <!-- <th>Alamat</th> -->
                    <th class="text-center" style="width: 16%;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- END Dynamic Table Full -->
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="#modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
        <form id="form_akun" class="form_akun" method="post" enctype="multipart/form-data">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Edit Akun</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <!-- <div class="form-group row">
                        <label class="col-12" for="">Username</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username..">
                            <input type="hidden" id="page" name="page" >
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label class="col-12" for="">First Name</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name..">
                            <input type="hidden" id="page" name="page" >
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="">Last Name</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name..">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="">Email</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email.." readonly>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="">Phone</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone..">
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="">Address</label>
                        <div class="col-md-12">
                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Address.." ></textarea>
                            
                        </div>
                    </div>
                    
                    
                    <!-- <div class="form-group row">
                        <label class="col-12" for="">Nama Depan</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nama Depan..">
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="">Nama Belakang</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nama Belakang..">
                        </div>
                    </div> -->
                    <!-- <div class="form-group row">
                        <label class="col-12" for="">Role</label>
                        <div class="col-md-12">
                        <select class="js-select2 form-control" id="role_id" name="role_id" readonly>
                            <option value="1">Admin</option>
                        </select>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button id="submit_akun" type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- END Dynamic Table Full -->
<div class="modal fade" id="modal-popin2" tabindex="-1" role="dialog" aria-labelledby="#modal-popin2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
        <form id="form_add" class="js-validation-berita form-validate-summernote" method="post" enctype="multipart/form-data">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Akun</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <!-- <div class="form-group row">
                        <label class="col-12" for="">Username</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username..">
                            <input type="hidden" id="page" name="page" >
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label class="col-12" for="">First Name <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name..">
                            <input type="hidden" id="page" name="page" >
                            <input type="hidden" id="id" name="id">
                            <!-- <input type="hidden" id="role_id" name="role_id" value="1"> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="">Last Name <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name..">
        
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="">Email <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email..">
                            <!-- <input type="hidden" id="page" name="page" >
                            <input type="hidden" id="id" name="id"> -->
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-12" for="">Nama Depan</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nama Depan..">
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="">Nama Belakang</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nama Belakang..">
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label class="col-12" for="">Phone<span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone..">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="">Address <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Address.."></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="">Password <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password..">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="">Konfirmasi Password <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="password" class="form-control" id="passconf" name="passconf" placeholder="Konfirmasi Password..">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="val-website">Foto Profil <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input type="file" accept="image/*" class="form-control" id="foto_name" name="foto_name">
                            <p><small id="error_foto" class="text-danger"></small></p>
                        </div>
                        <div class="col-md-12">
                        <button title="hapus foto profil" style="position: absolute;top:-10px;left:0px;display: none;" id="remove_foto_name" type="button" class="btn btn-sm btn-circle btn-alt-danger mr-5 mb-5"><i class="fa fa-times"></i></button>
                        <img class="img-avatar img-avatar96 img-avatar-thumb" src="<?= base_url('assets/img/avatars/avatar15.jpg') ?>" alt="pilih foto profil" id="tmp_foto_name" width="100">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-12" for="">Role</label>
                        <div class="col-md-12">
                        <select class="js-select2 form-control" id="role_id" name="role_id">
                            <option value="1">Admin</option>
                            <option value="3">Karyawan</option>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button id="submit_add" type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </form>
        </div>
    </div>
</div>