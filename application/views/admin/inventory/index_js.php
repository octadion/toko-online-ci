<script src="<?= base_url(); ?>assets/js/buttons/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/js/buttons/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/js/buttons/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/js/buttons/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>assets/js/buttons/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/js/buttons/buttons.print.min.js"></script>
<script>

function tables_load(){
    $('#table_inventory').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax":{
            "url": "<?= site_url('admin/inventory/get_ajax')?>",
            "type": "POST"
        },
        "dom": 'Bfrtip',
        "buttons": [
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            }
        ],
        "columnDefs": [
            {
                "targets": [0, -1],
                "orderable": false
            },
            {
                "targets":[-1],
                "className": 'dt-body-nowrap'
            }
        ]
    })
};

function delete_row(id){
    $('#table_inventory').DataTable().row('#del'.id).remove().draw( false );
}
jQuery(function () {
        // Init page helpers (Summernote + CKEditor + SimpleMDE plugins)
        Codebase.helpers(['summernote', 'tags-inputs', 'select2']);
    });

var unitValidation = function() {
    var initValidationSignIn = function() {
        jQuery('.js-validation-unit').validate({
            ignore: ".ignoreThisClass",
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            errorPlacement: function(error, e) {
                jQuery(e).parents('.form-group > div').append(error);
                console.log('error placement');
            },
            highlight: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
                console.log('highlight');
            },
            success: function(e) {
                jQuery(e).closest('.form-group').removeClass('is-invalid');
                jQuery(e).remove();
                console.log('success');
            },
            rules: {
                'unit_judul': {
                    required: true,
                    remote:{
                        url: BASE_URL + "admin/unit/unit_validation",
                        type: "post"
                    }
                },
            },
            messages: {
                'unit_judul': {
                    required: 'unit wajib diisi!',
                    remote: 'unit tidak boleh sama'
                }
            }
        });
    };

    return {
        init: function() {
            initValidationSignIn();
        }
    };
}();

    $('form#form_stock').on('click', '#submit_unit', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        console.log('submited');
        
        var form = $('form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        console.log(Array.from(formData));

        if($("#form_stock").valid() === true){
            console.log('validation true')
            jQuery('#modal-popin').modal('hide');
            $.ajax({
                url: BASE_URL + 'admin/inventory/edit_stock',
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(res){
                    console.log('success');
                    $('#qty').val('');
                    $('#tipe').val('');
                    $('#table_inventory').DataTable().ajax.reload();
                },
                error: function(res){
                    console.log('error');
                }
            });
        }
    });

    $('form#form_stock').on('click', '#close', function(e) {
        $('.form-group').removeClass('is-invalid');
    });

    $(document).on('click', '#edit', function(e) {
        $('.form-group').removeClass('is-invalid');
        $('#form_stock').find("input[type=text], textarea, select, option").val("");
        $('#page').val('add');
    });

    $(document).on('click', '.edit', function(e) {
        $('.title-input-unit').text('Edit unit')
        $('#form_stock').find('#qty').rules('remove', 'remote');
        $('#form_stock').find('#tipe').rules('remove', 'remote');
        var unit_id = $(this).data('id');
        var unit_judul = $(this).data('unit_judul');
        $('#page').val('edit');
        $('#unit_id').val(unit_id);
        $('#unit_judul').val(unit_judul);
    });

    $(document).on('click', '.swal-confirm-delete', function(){
        let id = $(this).data('id');
        console.log('click delete');
        swal({
            title: 'Apa anda yakin?',
            text: 'Data yang terhapus tidak bisa dikembalikan lagi',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText : 'Batal',
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Ya, hapus!',
            html: false,
            preConfirm: function() {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve();
                    }, 50);
                });
            }
        }).then(function(result){

            // check_value = check_unit(id);

            //check di sini
            // console.log('unit check')
            // console.log(check_value);

            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + 'admin/unit/del',
                    dataType: 'text',
                    data: {
                        id: id
                    },
                    success: function(res){
                        if(res === 'true'){
                            delete_row(id);
                            swal('Terhapus!', 'Data berhasil dihapus.', 'success');
                            console.log('success anjay');
                        }else{
                            swal('Gagal', 'unit masih digunakan', 'error');
                        }
                    },
                    error: function(res){
                        console.log('error');
                    }
                });
            } else if (result.dismiss === 'cancel') {
                swal('Batal', 'unit batal dihapus', 'error');
            }
        });
    });

    $(document).on('click', '.edit', function(){
        id = $(this).data('id');
        $('#id').val(id);
     console.log(id);
    
        // $.ajax({
        //     type: 'POST',
        //     // url: BASE_URL + 'admin/inventory/edit_stock',
        //     dataType: 'text',
        //     data: {
        //         id: id,
        //     },
        //     success: function(res){
        //         // reload_table()
        //         // reload_table2()
        //         console.log('edit status success');
        //     },
        //     error: function(res){
        //         console.log('edit status failed');
        //     }
        // });
    });

$(document).ready(function(){
    tables_load();
    unitValidation.init();
    Codebase.helpers('notify');
})
</script>