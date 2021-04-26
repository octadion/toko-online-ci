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
    <a class="breadcrumb-item" href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
    <span class="breadcrumb-item active">Category</span>
</nav>

<!-- Dynamic Table Full -->
<div class="block block-rounded block-shadow">
    <div class="block-header block-header-default">
        <h3 class="block-title">List Category</h3>
        <div class="block-options">
            <button type="button" id="tambah_kategori" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-popin">
                <i class="fa fa-plus"></i> Add Category
            </button>
        </div>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
        <table id="table_kategori" class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;"></th>
                    <th>Category</th>
                    <th class="text-center" style="width: 16%;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<!-- END Dynamic Table Full -->

<!-- Top Modal -->
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
        <form id="form_kategori" class="js-validation-kategori" method="post" enctype="multipart/form-data">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="title-input-kategori block-title">Add Category</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group row">
                        <label class="col-12" for="kategori_judul">Category <label class="text-danger">*</label></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="kategori_judul" name="kategori_judul" placeholder="Kategori..">
                            <input type="hidden" id="page" name="page" value="">
                            <input type="hidden" id="kategori_id" name="kategori_id" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button id="submit_kategori" type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- END Top Modal -->