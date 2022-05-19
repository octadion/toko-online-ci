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
    <a class="breadcrumb-item" href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
    <span class="breadcrumb-item active">Product</span>
</nav>

<!-- Dynamic Table Full -->
<div class="block block-rounded block-shadow">
    <div class="block-header block-header-default">
        <h3 class="block-title">List Product</h3>
        <div class="block-options">
            <a href="<?= base_url('admin/product/add') ?>" type="submit" id="tambah_berita" class="btn btn-sm btn-primary">
                <i class="fa fa-plus"></i> Add Product

            </a>
        </div>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
        <div class="table-responsive">
        <table id="table_product" class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">No.</th>
                    <th>Barcode</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Name</th>
                    <th class="d-none d-sm-table-cell" style="width: 10%;">Category</th>
                    <th class="d-none d-sm-table-cell" style="width: 13%;">Weight</th>
                    <!-- <th class="d-none d-sm-table-cell" style="width: 13%;">Weight</th> -->
                    <th class="d-none d-sm-table-cell" style="width: 13%;">Price</th>
                    <!-- <th class="d-none d-sm-table-cell" style="width: 13%;">Stock</th> -->
                    <th class="d-none d-sm-table-cell" style="width: 13%;">Status</th>
                    <th style="width: 17%;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>
    </div>
</div>
<!-- END Dynamic Table Full -->
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
        <!-- <form id="form_kategori" class="js-validation-kategori" method="post" enctype="multipart/form-data"> -->
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="title-input-foto block-title">Add Image</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block">
                                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#btabs-alt-static-home">Image</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#btabs-alt-static-profile">Data</a>
                                    </li>
                                    
                                </ul>
                                <div class="block-content tab-content">
                                    <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
                                    <div class="form-group row">
                                        <label class="col-12" for="kategori_judul">Add Image <label class="text-danger">*</label></label>
                                        <div class="col-md-12">
                                            <form enctype="multipart/form-data" action="<?= base_url('admin/product/upload_gambar') ?>" class="dropzone" method="post">
                                                    <div class="fallback">
                                                        <input name="file" type="file" accept=".png,.jpg,.jpeg" />
                                                    </div>
                                                    <input type="hidden" id="page" name="page" value="">
                                            <input type="hidden" id="produk_id" name="produk_id" value="">
                                            <input type="hidden" id="id" name="id" value="">
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="tab-pane" id="btabs-alt-static-profile" role="tabpanel">
                                    <div class="form-group row">
                                    <div class="col-md-12">
                                    <div class='table-responsive'>
                                                <table width="100%" class='table' id='table_data_gambar'>
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Image</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table_body">
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                    </div>
                                   
                                    </div>
                                   
                                </div>
                            </div>
                <div class="block-content">
                    
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button id="close" type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button id="submit_kategori" type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save
                </button>
            </div> -->
        <!-- </form> -->
        </div>
    </div>
</div>