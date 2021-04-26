<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="http://ajax.cdnjs.com/ajax/libs/json2/20110223/json2.js"></script>
<script>
$(document).ready(function() {
           
        });
function tables_load(){
    $('#table_product').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax":{
            "url": "<?= site_url('admin/product/get_ajax')?>",
            "type": "POST"
        },
        "columnDefs": [
            {
                "targets": [2, 3, 4],
                "className": 'd-none d-sm-table-cell'            
            },
            {
                "targets": [0, -1],
                "orderable": false
            }
        ]
    })
};

function delete_row(id){
    $('#table_product').DataTable().row('#'.id).remove().draw( false );
}


function reload_table(){
    $('#table_product').DataTable().draw( false );
}

$(document).ready(function(){
    tables_load();
    $(document).on('click', '.btn-foto', function(e) {
        $('.title-input-foto').text('Add Image')
        // $('#form_kategori').find('#kategori_judul').rules('remove', 'remote');
        var produk_id = $(this).data('id');
        var id = $(this).data('id')
       
        $('#page').val('add');
        $('#produk_id').val(produk_id);
        $('#id').val(id);
        load_table_gambar(id);
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
            console.log(result);
            if (result.value) {
                swal('Terhapus!', 'Data berhasil dihapus.', 'success');
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + 'admin/product/del',
                    dataType: 'text',
                    data: {
                        id: id
                    },
                    success: function(res){
                        delete_row(id);
                        console.log('success anjay');
                    },
                    error: function(res){
                        console.log('error');
                    }
                });
            } else if (result.dismiss === 'cancel') {
                swal('Batal', 'Data batal dihapus', 'error');
            }
        });
    });



    $(document).on('click', '.change-status_barang', function(){
        id = $(this).data('id');
        status_barang = $(this).data('status_barang');
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'admin/product/edit_status_barang',
            dataType: 'text',
            data: {
                id: id,
                status_barang: status_barang
            },
            success: function(res){
                reload_table()
                console.log('edit status success');
            },
            error: function(res){
                console.log('edit status failed');
            }
        });
    });

    $('#table_data_gambar .table_body').on('click', '.tombol_hapus', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            var base_url = '<?= base_url(); ?>';
            var url = base_url + 'admin/product/hapus_data_gambar';
            swal({
                title: 'Hapus Data ?',
                text: "Data akan dihapus dari sistem",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    var data = new FormData();
                    data.append('id', id);
                    e.preventDefault();
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: data,
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            // console.log('sedang menghapus');
                        },
                        complete: function() {
                            // console.log('Berhasil');
                        },
                        error: function(e) {
                            console.log(e);
                            toastr.error('gagal, terjadi kesalahan', {
                                timeOut: 1000,
                                fadeOut: 1000
                            });
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                toastr.success(data.msg, {
                                    timeOut: 1000,
                                    fadeOut: 1000
                                });
                                $('#table_data_gambar').DataTable().ajax.reload();
                            }
                        },
                    });
                } else {
                    return false;
                }
            })
        });

})
</script>
<script>

var base_url = '<?= base_url(); ?>';
        function load_table_gambar(id) {
            console.log(id);
            $('#table_data_gambar').dataTable({
                searching: false,
                ordering: false,
                responsive: true,
                destroy: true,
                processing: true,
                serverSide: true,
                
                ajax: {
                    url: base_url + 'admin/product/ajax_getAll_gambar?id=' + id,
                    type: 'GET',
                    dataType: 'JSON',
                },
                drawCallback: function(res) {

                },
                language: {
                    processing: '<div class="spinner-border""></div>'
                },
                order: [],
                columnDefs: [{
                    targets: [0, 1, 2],
                    className: 'text-center',
                    orderable: false
                }, ],
                scrollX: true
            });

        }
</script>
<script>
Dropzone.autoDiscover = false;
        var acceptedFileTypes = "image/*"; //dropzone requires this param be a comma separated list 
        var fileList = new Array;
        var i = 0;
        var base_url = '<?= base_url(); ?>';
        id = $(this).data('id');
        var url = base_url + 'admin/product/upload_gambar';
        $('.dropzone').each(function() {
            $(this).dropzone({
                url: url,
                addRemoveLinks: false, // true
                maxFiles: 10, //change limit as per your requirements
                dictMaxFilesExceeded: "File anda terlalu besar",
                acceptedFiles: acceptedFileTypes,
                dictInvalidFileType: "Hanya untuk file gambar saja",
                id: id,
                init: function() {
                    // Hack: Add the dropzone class to the element
                    $(this.element).addClass("dropzone");
                    this.on("addedfile", function() {

                    });
                    this.on('error', function(file, response) {
                        this.removeFile(file); //remove file from the zone.
                        var obj = jQuery.parseJSON(response)
                        toastr.error(obj.msg, {
                            timeOut: 1000,
                            fadeOut: 1000
                        });
                    });
                    this.on("success", function(file, response) {
                        this.removeFile(file); //remove file from the zone.
                        $('#table_data_gambar').DataTable().ajax.reload();
                        var obj = jQuery.parseJSON(JSON.stringify(response))
                        if (obj.status == 'success') {
                            toastr.success(obj.msg, {
                                timeOut: 1000,
                                fadeOut: 1000
                            });
                            $('#table_data_gambar').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
    
    
</script>