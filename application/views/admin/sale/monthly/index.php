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
    <span class="breadcrumb-item active">Sale</span>
</nav>

<!-- Dynamic Table Full -->
<div class="block block-rounded block-shadow">
    <div class="block-header block-header-default">
        <h3 class="block-title">Monthly Sales</h3>
    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
        <table id="table_monthly" class="table table-bordered table-striped table-vcenter js-dataTable-full">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">#</th>
                    <th>No. Order</th>
                    <th>Order Date</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $no = 1;
            $grand_total = 0;
            foreach($monthly as $mon){
                $grand_total = $grand_total + $mon->grand_total;
               ?>
            <tr>
                    <td style="width: 5%;"><?=$no++?></td>
                    <td><?=$mon->code?></td>
                    <td><?=$mon->order_date?></td>
                    <td><?=indo_currency($mon->grand_total)?></td>
            </tr>
            <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                <th colspan="3">Grand Total</th>
               
                <th><?=indo_currency($grand_total)?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- END Top Modal -->