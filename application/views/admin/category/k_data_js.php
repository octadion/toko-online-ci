<script>

function tables_load(){
    $('#table_kategori').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax":{
            "url": "<?= site_url('admin/category/get_ajax')?>",
            "type": "POST"
        },
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
    $('#table_kategori').DataTable().row('#del'.id).remove().draw( false );
}

var KategoriValidation = function() {
    var initValidationSignIn = function() {
        jQuery('.js-validation-kategori').validate({
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
                'kategori_judul': {
                    required: true,
                    remote:{
                        url: BASE_URL + "admin/category/kategori_validation",
                        type: "post"
                    }
                },
            },
            messages: {
                'kategori_judul': {
                    required: 'Kategori wajib diisi!',
                    remote: 'Kategori tidak boleh sama'
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

    $('form#form_kategori').on('click', '#submit_kategori', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        console.log('submited');
        
        var form = $('form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        console.log(Array.from(formData));

        if($("#form_kategori").valid() === true){
            console.log('validation true')
            jQuery('#modal-popin').modal('hide');
            $.ajax({
                url: BASE_URL + 'admin/category/process',
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(res){
                    console.log('success');
                    $('#kategori_judul').val('');
                    $('#table_kategori').DataTable().ajax.reload();
                },
                error: function(res){
                    console.log('error');
                }
            });
        }
    });

    $('form#form_kategori').on('click', '#close', function(e) {
        $('.form-group').removeClass('is-invalid');
    });

    $(document).on('click', '#tambah_kategori', function(e) {
        $('.form-group').removeClass('is-invalid');
        $('#form_kategori').find("input[type=text], textarea").val("");
        $('#page').val('add');
    });

    $(document).on('click', '.edit_kategori', function(e) {
        $('.title-input-kategori').text('Edit Kategori')
        $('#form_kategori').find('#kategori_judul').rules('remove', 'remote');
        var kategori_id = $(this).data('id');
        var kategori_judul = $(this).data('kategori_judul');
        $('#page').val('edit');
        $('#kategori_id').val(kategori_id);
        $('#kategori_judul').val(kategori_judul);
        console.log(kategori_id);
        console.log(kategori_judul);
        console.log('page')
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

            // check_value = check_kategori(id);

            //check di sini
            // console.log('kategori check')
            // console.log(check_value);

            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + 'admin/category/del',
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
                            swal('Gagal', 'Kategori masih digunakan', 'error');
                        }
                    },
                    error: function(res){
                        console.log('error');
                    }
                });
            } else if (result.dismiss === 'cancel') {
                swal('Batal', 'Kategori batal dihapus', 'error');
            }
        });
    });

$(document).ready(function(){
    tables_load();
    KategoriValidation.init();
    Codebase.helpers('notify');
})
</script>