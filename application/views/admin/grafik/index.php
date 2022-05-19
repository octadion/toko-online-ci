<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
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
    <span class="breadcrumb-item active">Chart</span>
</nav>
<div class="block block-rounded block-shadow">
    <!-- <div class="block-header block-header-default">
        <h3 class="block-title">List product</h3>
        <div class="block-options">
          
        </div>
    </div> -->
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
        <!-- <div class="row"> -->
            <form>
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
        <div class="form-group row">
        <div class="col-md-2">
        <select class="js-select2 form-control" id="tipe" name="tipe" style="width: 100%;" data-placeholder="Pilih tipe..">
        <option></option>
            <option value="penjualan">Penjualan</option>
            <option value="terjual">Terjual</option>
            <option value="terlaris">Terlaris</option>
        </select>
        </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
        
                <input type="button" name="search" id="search" value="Search" class="btn btn-info" />
                <input type="button" name="reset" id="reset" value="Reset" class="btn btn-secondary" />
            </div>
            </div>
            </form>
            <div id="container"></div>
        <!-- </div> -->
    </div>
</div>