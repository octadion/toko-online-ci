<!-- <h2 class="content-heading">DataTables Plugin</h2> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"> -->
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.jqueryui.min.css"> -->

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
    <span class="breadcrumb-item active">Report product</span>
</nav>

<!-- Dynamic Table Full -->
<div class="block block-rounded block-shadow">
    <div class="block-header block-header-default">
        <h3 class="block-title">List product</h3>
        <div class="block-options">
            <!-- <button type="button" id="tambah_unit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-popin">
                <i class="fa fa-plus"></i> Add Unit
            </button> -->
        </div>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
        <!-- <div class="row"> -->
        <div class="input-daterange">
        <div class="form-group row">
            <div class="col-md-2">
                <input type="text" name="start_date" id="start_date" class="form-control" />
            </div>
            <div class="input-group-prepend input-group-append">
            <span class="input-group-text font-w600">to</span>
            </div>
            <div class="col-md-2">
                <input type="text" name="end_date" id="end_date" class="form-control" />
            </div>  
        </div>   
        </div>
        <div class="form-group">
            <div class="col-md-3">
        
                <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
                <input type="button" name="reset" id="reset" value="Reset" class="btn btn-secondary" />
            </div>
            </div>
        <!-- </div> -->
        <table id="table_revenue" class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <!-- <th class="text-center" style="width: 5%;">No.</th> -->
                    <th>Date</th>
                    <th>Orders</th>
                    <th>Gross Revenue</th>
                    
                    <th>Shipping</th>
                    <th>Net Revenue</th>
                    <!-- <th class="text-center" style="width: 16%;">Action</th> -->
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                <th colspan="4">Total</th>
               
                <th id="total_rev"></th>
                
                
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Dynamic Table Full -->

<!-- Top Modal -->
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
        <form id="form_stock" class="js-validation-unit" method="post" enctype="multipart/form-data">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="title-input-unit block-title">Edit Stock</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group row">
                        <label class="col-12" for="unit_judul">Stock <label class="text-danger">*</label></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="qty" name="qty" placeholder="Stock..">
                            <!-- <input type="hidden" id="page" name="page" value=""> -->
                            <input type="hidden" id="id" name="id" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="unit_judul">Tipe <label class="text-danger">*</label></label>
                        <div class="col-md-12">
                        <select class="js-select2 form-control" id="tipe" name="tipe" style="width: 100%;" data-placeholder="Pilih tipe..">
                            <option></option>
                            <option value="penyesuaian">Penyesuaian Stock</option>
                            <option value="penambahan">Penambahan Stock</option>
                            <option value="pengurangan">Pengurangan Stock</option>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button id="submit_unit" type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- END Top Modal -->