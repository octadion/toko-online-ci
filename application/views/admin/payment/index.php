<!-- <h2 class="content-heading">DataTables Plugin</h2> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
    <span class="breadcrumb-item active">Payments</span>
</nav>

<!-- Dynamic Table Full -->
<div class="block block-rounded block-shadow">
    <div class="block-header block-header-default">
        <h3 class="block-title">List Payments</h3>
        <div class="block-options">
            <!-- <button type="button" id="cek_status" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-popin">
                <i class="fa fa-search"></i> Check Status
            </button> -->
        </div>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
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
        <table id="table_payment" class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <!-- <th class="text-center">No.</th> -->
                    <th>Order ID</th>
                    <th>Amount</th>
                    <th>Payment Type</th>
                    <th>Vendor</th>
                    <th>VA Number</th>
                    <th>Transaction Time</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
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
        <form id="form_cek" class="js-validation-unit" method="post" enctype="multipart/form-data">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="title-input-unit block-title">Check Status</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group row">
                        <label class="col-12" for="unit_judul">Order ID <label class="text-danger">*</label></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="order_id" name="order_id" placeholder="Check Status">
                            <!-- <input type="hidden" id="page" name="page" value="">
                            <input type="hidden" id="unit_id" name="unit_id" value=""> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button id="submit_cek" type="submit" class="btn btn-primary">
                    <i class="fa fa-search"></i> Seacrh
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- END Top Modal -->