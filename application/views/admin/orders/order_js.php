<script>

function tables_load(){
    $('#table_order').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax":{
            "url": "<?= site_url('admin/order/get_ajax')?>",
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
function tables_load2(){
  
    $('#table_orderconfirmed').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax":{
            "url": "<?= site_url('admin/order/get_ajax2')?>",
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
    $('#table_orderconfirmed').css("width","100%")
    
};
function tables_load3(){
  
  $('#table_orderdeliver').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax":{
          "url": "<?= site_url('admin/order/get_ajax3')?>",
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
  $('#table_orderdeliver').css("width","100%")
  
};
function tables_load4(){
  
  $('#table_completed').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax":{
          "url": "<?= site_url('admin/order/get_ajax4')?>",
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
  $('#table_completed').css("width","100%")
  
};
function getproduct(id){
    $.ajax({
            type: 'GET',
            url: BASE_URL+'admin/order/get_product/'+id,
            dataType: 'JSON',
            data: {
              
                id: id
            },
            success: function(res)  {
                // $(`#id`).val(res.id);
                product = [];
                product = res;
                let html = '';

                for (const pro of product) { 
                    html += `
                    <tr>
                        <td>${pro.barcode}</td>
                        <td>${pro.name}</td>
                        <td>${pro.qty}</td>
                
                    </tr
                    `;

                }
                $('table#table_confirm tbody').html(html);
    }
        });

}
function reload_table(){
    $('#table_order').DataTable().draw( false );
}
function delete_row(id){
    $('#table_order').DataTable().row('#del'.id).remove().draw( false );
}
function reload_table2(){
    $('#table_orderconfirmed').DataTable().draw( false );
}
function delete_row2(id){
    $('#table_orderconfirmed').DataTable().row('#del'.id).remove().draw( false );
}
function reload_table3(){
    $('#table_orderdeliver').DataTable().draw( false );
}
function delete_row3(id){
    $('#table_orderdeliver').DataTable().row('#del'.id).remove().draw( false );
}
function reload_table4(){
    $('#table_completed').DataTable().draw( false );
}
function delete_row4(id){
    $('#table_completed').DataTable().row('#del'.id).remove().draw( false );
}

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

    $('#form_cancel').on('click', '#submit', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        console.log('submited');
        
        var form = $('form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        console.log(Array.from(formData));

        if($("#form_cancel").valid() === true){
            console.log('validation true')
            jQuery('#modal-popin').modal('hide');
            $.ajax({
                url: BASE_URL + 'admin/order/cancel',
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(res){
                    console.log('success');
                    $('#note').val('');
                    $('#table_order').DataTable().ajax.reload();
                },
                error: function(res){
                    console.log('error');
                }
            });
        }
    });
    $('#form_deliver').on('click', '#submit', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        console.log('submited');
        
        var form = $('#form_deliver')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        console.log(Array.from(formData));

        if($("#form_deliver").valid() === true){
            console.log('validation true')
            jQuery('#modal-popin2').modal('hide');
            $.ajax({
                url: BASE_URL + 'admin/order/deliver',
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(res){
                    console.log('success');
                    $('#unit_judul').val('');
                    $('#table_orderconfirmed').DataTable().ajax.reload();
                },
                error: function(res){
                    console.log('error');
                }
            });
        }
    });
    $('#form_confirm').on('click', '#submit', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        console.log('submited');
        
        var form = $('#form_confirm')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        console.log(Array.from(formData));

        if($("#form_confirm").valid() === true){
            console.log('validation true')
            jQuery('#modal-popin3').modal('hide');
            $.ajax({
                url: BASE_URL + 'admin/order/confirm',
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(res){
                    console.log('success');
                    $('#unit_judul').val('');
                    $('#table_order').DataTable().ajax.reload();
                    $('#table_orderconfirmed').DataTable().ajax.reload();
                },
                error: function(res){
                    console.log('error');
                }
            });
        }
    });

    $('form#form_cek').on('click', '#close', function(e) {
        $('.form-group').removeClass('is-invalid');
    });

    $(document).on('click', '#cek_status', function(e) {
        $('.form-group').removeClass('is-invalid');
        $('#form_cek').find("input[type=text], textarea").val("");
        $('#page').val('add');
    });
    $(document).on('click', '.change-status_deliver', function(e) {
        $('.title-input-unit').text('Edit unit')
        $('#form_cancel').find('#unit_judul').rules('remove', 'remote');
        var id = $(this).data('id');
        var user_id = $(this).data('user_id');
        var status = $(this).data('status');
        var code = $(this).data('code');
        var full_name = $(this).data('full_name');
        var province = $(this).data('province');
        var city = $(this).data('city');
        var courier = $(this).data('courier');
        var postcode = $(this).data('postcode');
        var service = $(this).data('service');
        $('#id_').val(id);
        $('#status_').val(status);
        $('#code_').text(code);
        $('#payment_').text(payment);
        $('#full_name_').text(full_name);
        $('#province').text(province);
        $('#city').text(city);
        $('#postcode').text(postcode);
        $('#courier').text(courier);
        $('#service').text(service);
        console.log(id);
        console.log(status);
    });

    $(document).on('click', '.change-status_cancel', function(e) {
        $('.title-input-unit').text('Edit unit')
        $('#form_cancel').find('#unit_judul').rules('remove', 'remote');
        var id = $(this).data('id');
        var user_id = $(this).data('user_id');
        var status = $(this).data('status');
        var code = $(this).data('code');
        var date = $(this).data('date');
        var payment = $(this).data('payment');
        var full_name = $(this).data('full_name');
        var email = $(this).data('email');
        var phone = $(this).data('phone');
        $('#id').val(id);
        $('#status').val(status);
        $('#code').text(code);
        $('#date').text(date);
        $('#payment').text(payment);
        $('#full_name').text(full_name);
        $('#email').text(email);
        $('#phone').text(phone);
        console.log(id);
        console.log(status);
        console.log(code);
        console.log(date);
    });

    $(document).on('click', '.swal-confirm-delete', function(){
        let id = $(this).data('id');
        console.log(id);
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
                    url: BASE_URL + 'admin/order/del',
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
    $(document).on('click', '.swal-confirm-delete2', function(){
        let id = $(this).data('id');
        console.log(id);
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
                    url: BASE_URL + 'admin/order/del',
                    dataType: 'text',
                    data: {
                        id: id
                    },
                    success: function(res){
                        if(res === 'true'){
                            delete_row2(id);
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
    $(document).on('click', '.swal-confirm-delete3', function(){
        let id = $(this).data('id');
        console.log(id);
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
                    url: BASE_URL + 'admin/order/del',
                    dataType: 'text',
                    data: {
                        id: id
                    },
                    success: function(res){
                        if(res === 'true'){
                            delete_row3(id);
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
    $(document).on('click', '.swal-confirm-delete4', function(){
        let id = $(this).data('id');
        console.log(id);
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
                    url: BASE_URL + 'admin/order/del',
                    dataType: 'text',
                    data: {
                        id: id
                    },
                    success: function(res){
                        if(res === 'true'){
                            delete_row4(id);
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

    $(document).on('click', '.btn-confirm', function(e) {
        // product_id = $(this).data('product_id');
        id = $(this).data('id');
        user_id = $(this).data('user_id');
        status = $(this).data('status');
        $('#order_id').val(id);
        $('#status_confirm').val(status);
        console.log(id);
        console.log(status);
        getproduct(id);
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'admin/order/update_stock',
            dataType: 'text',
            data: {
                id: id,
            },
            success: function(res){
                // reload_table()
                // reload_table2()
                console.log('edit status success');
            },
            error: function(res){
                console.log('edit status failed');
            }
        });
    });

    
    $(document).on('click', '.change-status_confirm', function(){
        id = $(this).data('id');
        user_id = $(this).data('user_id');
        status = $(this).data('status');
        qty = $(this).data('qty');
        product_id = $(this).data('product_id');
        console.log(id);
        console.log(product_id);
        $.ajax({
            type: 'POST',
            // url: BASE_URL + 'admin/order/confirm',
            dataType: 'text',
            data: {
                id: id,
                user_id: user_id,
                status: status,
                qty: qty,
                product_id: product_id
            },
            success: function(res){
                // reload_table()
                // reload_table2()
                console.log('edit status success');
            },
            error: function(res){
                console.log('edit status failed');
            }
        });
    });
    $(document).on('click', '.change-status_payment', function(){
        id = $(this).data('id');
        console.log(id);
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'admin/order/cekstatus',
            dataType: 'text',
            data: {
                id: id,
            },
            success: function(res){
                reload_table()
                reload_table2()
                console.log('edit status success');
            },
            error: function(res){
                console.log('edit status failed');
            }
        });
    });

$(document).ready(function(){

    tables_load();
    tables_load2();
    tables_load3();
    tables_load4();
    unitValidation.init();
    Codebase.helpers('notify');
})
</script>