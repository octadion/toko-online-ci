<style>
table{
    width: 100%;
}

</style>
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
    <a class="breadcrumb-item" href="<?= base_url('admin/order') ?>">Dashboard</a>
    <span class="breadcrumb-item active">Orders</span>
</nav>
<div class="block">
            <ul class="nav nav-tabs nav-tabs-alt justify-content-start" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-static2-created">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-static2-confirmed">Confirmed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-static2-delivered">Delivered</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#btabs-static2-completed">Completed</a>
                </li>
               
            </ul>
<!-- Dynamic Table Full -->
<div class="tab-content">
                <div class="tab-pane active" id="btabs-static2-created" role="tabpanel">
<div class="block block-rounded">
 
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
                <table id="table_order" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <!-- <th class="text-center">No.</th> -->
                            <th>Order ID</th>
                            <th>Code</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
                </div>
                <div class="tab-pane" id="btabs-static2-confirmed" role="tabpanel">
                <div class="block block-rounded">
                 
                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
                        <table id="table_orderconfirmed" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                                <tr>
                                    <!-- <th class="text-center">No.</th> -->
                                    <th>Order ID</th>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
                <div class="tab-pane" id="btabs-static2-delivered" role="tabpanel">
                <div class="block block-rounded">
                 
                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
                        <table id="table_orderdeliver" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                                <tr>
                                    <!-- <th class="text-center">No.</th> -->
                                    <th>Order ID</th>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
                <div class="tab-pane" id="btabs-static2-completed" role="tabpanel">
                <div class="block block-rounded">
                   
                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/be_tables_datatables.js -->
                        <table id="table_completed" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                                <tr>
                                    <!-- <th class="text-center">No.</th> -->
                                    <th>Order ID</th>
                                    <th>Code</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
</div>
</div>
<!-- END Dynamic Table Full -->

<!-- Top Modal -->
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
        <form id="form_cancel" class="js-validation-unit" method="post" enctype="multipart/form-data">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="title-input-unit block-title">Cancel Order</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                <div class="form-group row">
                <label class="col-12" for="unit_judul">Cancellation Detail</label>
                </div>
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width: 35%">Code</th>
                            <td><span id="code"></span></td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td><span id="date"></span></td>
                        </tr>
                        <!-- <tr>
                            <th>Status</th>
                            <td><span id="status"></span></td>
                        </tr> -->
                        <tr>
                            <th>Payment</th>
                            <td><span id="payment"></span></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><span id="full_name"></span></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><span id="email"></span></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><span id="phone"></span></td>
                        </tr>
                    </tbody>
                </table>
                    <div class="form-group row">
                        <label class="col-12" for="unit_judul">Cancellation Note <label class="text-danger">*</label></label>
                        <div class="col-md-12">
                        <textarea class="form-control" id="note" name="note" placeholder="Note"></textarea>
                           <input type="hidden" id="status" name="status" value="">
                           <input type="hidden" id="id" name="id" value="">
                         
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button id="submit" type="submit" class="btn btn-primary">
                    <i class="fa fa-remove"></i> Cancel
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-popin4" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
        <form id="form_refund" class="js-validation-refund" method="post" enctype="multipart/form-data">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="title-input-unit block-title">Refund Payment</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                <div class="form-group row">
                <label class="col-12" for="unit_judul">Payment Detail</label>
                </div>
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width: 35%">Payment Type</th>
                            <td><span id="payment_type"></span></td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td><span id="total_amount"></span></td>
                        </tr>
                        <!-- <tr>
                            <th>Status</th>
                            <td><span id="status"></span></td>
                        </tr> -->
                        <tr>
                            <th>Vendor</th>
                            <td><span id="vendor"></span></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span id="status__"></span></td>
                        </tr>
                        <tr>
                            <th>Bank Number</th>
                            <td><span id="bank_number"></span></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group row">
                        <label class="col-12" for="unit_judul">Refund <label class="text-danger">*</label></label>
                        <div class="col-md-12">
                        <input type="number" id="amount" name="amount" class="form-control" placeholder="Rp. 0">
                           <!-- <input type="hidden" id="status" name="status" value=""> -->
                           <!-- <input type="hidden" id="id" name="id" value=""> -->
                         
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-12" for="unit_judul">Reason <label class="text-danger">*</label></label>
                        <div class="col-md-12">
                        <textarea class="form-control" id="reason" name="reason" placeholder="reason"></textarea>
                           <!-- <input type="hidden" id="status" name="status" value=""> -->
                           <input type="hidden" id="id2" name="id" value="">
                         
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button id="submit_bank" type="submit" class="btn btn-primary">
                   Bank Transfer
                </button>
                <button id="submit" type="submit" class="btn btn-primary">
                    Credit Card
                </button>
                <button id="submit_3party" type="submit" class="btn btn-primary">
                    3rd Party
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- END Top Modal -->
<div class="modal fade" id="modal-popin3" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
        <form id="form_confirm" class="js-validation-unit" method="post" enctype="multipart/form-data">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="title-input-unit block-title">Confirm Order</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                <div class="form-group row">
                <label class="col-12" for="unit_judul">Confirmation Detail</label>
                </div>
                <table class="table table-bordered no-margin" id="table_confirm">
                <thead>
                        <tr>
                            <th style="width: 35%">Barcode</th>
                            <th>Name</th>
                            <th>Qty</th>
                           
                        </tr>
                </thead>
                    <tbody>
                        
                        <!-- <tr>
                        <td><span id="barcode"></span></td>
                            <td><span id="name"></span></td>
                            <td><span id="qty"></span></td>
                        </tr> -->
                        <!-- <tr>
                            <th>Status</th>
                            <td><span id="status"></span></td>
                        </tr> -->
                    </tbody>
                </table>
                    <!-- <div class="form-group row">
                        <label class="col-12" for="unit_judul">Cancellation Note <label class="text-danger">*</label></label>
                        <div class="col-md-12">
                        <textarea class="form-control" id="note" name="note" placeholder="Note"></textarea>
                           <input type="hidden" id="status" name="status" value="">
                           <input type="hidden" id="id" name="id" value="">
                         
                        </div>
                    </div> -->
                    <input type="hidden" id="status_confirm" name="status" value="">
                           <input type="hidden" id="order_id" name="id" value="">
                       
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button id="submit" type="submit" class="btn btn-primary">
                    <i class="fa fa-check"></i> Confirm
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Top Modal -->
<div class="modal fade" id="modal-popin2" tabindex="-1" role="dialog" aria-labelledby="modal-popin2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
        <form id="form_deliver" class="js-validation-unit" method="post">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="title-input-unit block-title">Deliver Order</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                <div class="form-group row">
                <label class="col-12" for="unit_judul">Delivering Detail</label>
                </div>
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th style="width: 35%">Code</th>
                            <td><span id="code_"></span></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><span id="full_name_"></span></td>
                        </tr>
                        <!-- <tr>
                            <th>Status</th>
                            <td><span id="status"></span></td>
                        </tr> -->
                        <tr>
                            <th>Province</th>
                            <td><span id="province"></span></td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td><span id="city"></span></td>
                        </tr>
                        <tr>
                            <th>Postcode</th>
                            <td><span id="postcode"></span></td>
                        </tr>
                        <tr>
                            <th>Courier</th>
                            <td><span id="courier"></span></td>
                        </tr>
                        <tr>
                            <th>Service</th>
                            <td><span id="service"></span></td>
                        </tr>
                    </tbody>
                </table>
                    <div class="form-group row">
                        <label class="col-12" for="unit_judul">Track Number <label class="text-danger">*</label></label>
                        <div class="col-md-12">
                            <input type="text" id="track_number" name="track_number" class="form-control" placeholder="Track number">
                           <input type="hidden" id="status_" name="status" value="">
                           <input type="hidden" id="id_" name="id" value="">
                            <!-- <input type="hidden" id="page" name="page" value="">
                            <input type="hidden" id="unit_id" name="unit_id" value=""> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button id="submit" type="submit" class="btn btn-primary">
                    <i class="fa fa-sent"></i> Deliver
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- END Top Modal -->