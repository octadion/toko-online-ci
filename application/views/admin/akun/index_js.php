<script>
 $(document).ready(function() {
    // var imgSrc;
    //     $('#foto_name').validate({
    //         callbacks: {
    //             onImageUpload: function(image) {
    //                 console.log(image);
    //                 uploadImage(image[0]);
    //             }
    //         }
    //     });
    });
</script>
<script>
data = {};
var img = "<?= base_url('assets/img/avatars/avatar15.jpg') ?>";
    $('#foto_name').change(function(e) {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#remove_foto_name').show();
                    $('#tmp_foto_name').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#remove_foto_name').on('click', function() {
            $('#foto_name').val('');
            $('#remove_foto_name').hide();
            $('#tmp_foto_name').attr('src', img);
        });
// function uploadImage(image) {
//         var data = new FormData();
//         data.append("image", image);
//         $.ajax({
//             url: BASE_URL + 'akun/upload_photo_profil',
//             cache: false,
//             contentType: false,
//             processData: false,
//             data: data,
//             type: "post",
//             success: function(url) {
//                 // var image = $('<img>').attr('src', 'http://' + url);
//                 // $('#isi_berita').summernote("insertNode", image[0]);
//                 console.log(url);
//                 $("#foto_name").validate("insertImage", url);
//             },
//             error: function(data) {
//                 console.log(data);
//             }
//         });
//     }


function tables_load(){
    $('#table_akun').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax":{
            "url": "<?= site_url('admin/akun/get_ajax')?>",
            "type": "POST"
        },
    })
};

var akunValidation = function() {
    var initValidationSignIn = function() {
        jQuery('#form_add').validate({
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
                    'first_name': {
                        required: true,
                    },
                    'last_name': {
                        required: true,
                    },
                    'email': {
                        required: true,
                        email: true,
                        remote: 
                            {
                                    url: BASE_URL + 'admin/akun/check_email_exists',
                                    type: 'POST',
                                   
                            } 
                    },
                    'phone': {
                        required: true
                    },
                    'alamat': {
                        required: true
                    },
                    'password': {
                        required: true,
                        minlength: 5
                    },
                    
                   
                    'passconf': {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    },
                },
                messages: {
                    'first_name': 'First name wajib diisi!',
                    'last_name': 'Last name wajib diisi!',
                    'email': {
                        required: 'Email wajib diisi!',
                        remote: 'Email sudah dipakai!',
                    },
                    'phone': 'Telepon wajib diisi!',
                    'alamat': 'Alamat wajib diisi!',
                    'password': { 
                        required: 'Password wajib diisi!',
                        minlength: 'Password minimal 5 karakter!'
                    },
                    'passconf': { 
                        required: 'Password Confirmation wajib diisi!',
                        minlength: 'Password Confirmation minimal 5 karakter',
                        equalTo: 'Password harus sesuai dengan diatas!'
                    },
                    
                }
        });
    };

    return {
        init: function() {
            initValidationSignIn();
        }
    };
}();
var akunValidation2 = function() {
    var initValidationSignIn2 = function() {
        jQuery('.js-validation-edit').validate({
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
                    'first_name': {
                        required: true,
                    },
                    'last_name': {
                        required: true,
                    },
                    
                    'phone': {
                        required: true
                    },
                    'alamat': {
                        required: true
                    },
                    
                },
                messages: {
                    'first_name': 'First name wajib diisi!',
                    'last_name': 'Last name wajib diisi!',
                    'email': {
                        required: 'Email wajib diisi!',
                        remote: 'Email sudah dipakai!',
                    },
                    'phone': 'Telepon wajib diisi!',
                    'alamat': 'Alamat wajib diisi!',
                    'password': { 
                        required: 'Password wajib diisi!',
                        minlength: 'Password minimal 5 karakter!'
                    },
                    'passconf': { 
                        required: 'Password Confirmation wajib diisi!',
                        minlength: 'Password Confirmation minimal 5 karakter',
                        equalTo: 'Password harus sesuai dengan diatas!'
                    },
                    
                }
        });
    };

    return {
        init: function() {
            initValidationSignIn2();
        }
    };
}();
$('form#form_akun').on('click', '#submit_akun', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        console.log('submited');
        
        var form = $('#form_akun')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        console.log(Array.from(formData));
       
        if($("#form_akun").valid() === true){
            console.log('validation true')
            $.ajax({
                url: BASE_URL + 'admin/akun/process',
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(res){
                    console.log('success');
                    jQuery('#modal-popin').modal('hide');
                    $('#first_name').val('');
                    $('#last_name').val('');
                    $('#email').val('');
                    $('#phone').val('');
                    $('#alamat').val('');
                    $('#role_id').val('');
                    $('#foto_name').val('');
                    $('#table_akun').DataTable().ajax.reload();
                },
                error: function(res){
                    console.log('error');
                }
            });
        }
    });

    $('form#form_akun').on('click', '#close', function(e) {
        $('.form-group').removeClass('is-invalid');
    });

    $(document).on('click', '#tambah_akun', function(e) {
        $('#form_akun').find("input[type=text], textarea").val("");

        $('#page').val('add');
        $('#role_id').val('1');
    });

    $(document).on('click', '.edit_akun', function(e) {
        var id = $(this).data('id');
        console.log(id);
        var first_name = $(this).data('first_name');
        var last_name = $(this).data('last_name');
        var email = $(this).data('email');
        var phone = $(this).data('phone');
        var alamat = $(this).data('alamat');
        // var first_name = $(this).data('first_name');
        // var last_name = $(this).data('last_name');
        // var role_id = $(this).data('role_id');
        $('#page').val('edit');
        $('#id').val(id);
        $('#first_name').val(first_name);
        $('#last_name').val(last_name);
        $('#email').val(email);
        $('#phone').val(phone);
        $('#alamat').val(alamat);
        // $('#first_name').val(first_name);
        // $('#last_name').val(last_name);
        // $('#role_id').val(role_id);
    });
function delete_row(id){
    $('#table_akun').DataTable().row('#'.id).remove().draw( false );
}
$('form#form_add').on('click', '#submit_add', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        console.log('submited');
        var form = $('#form_add')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        console.log(Array.from(formData));

        if($("#form_add").valid() === true){
            console.log('validation true')
            $.ajax({
                url: BASE_URL + 'admin/akun/tambah',
                cache: false,
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(res){
                    console.log('success');
                    jQuery('#modal-popin2').modal('hide');
                    $('#first_name').val('');
                    $('#last_name').val('');
                    $('#email').val('');
                    $('#phone').val('');
                    $('#alamat').val('');
                    $('#password').val('');
                    $('#passconf').val('');
                    $('#role_id').val('');
                    $('#foto_name').val('');
                    $('#table_akun').DataTable().ajax.reload();
                },
                error: function(res){
                    console.log('error');
                }
            });
        }
    });

    $('form#form_add').on('click', '#close', function(e) {
        $('.form-group').removeClass('is-invalid');
    });

    $(document).on('click', '#tambah_add', function(e) {
        var img = "<?= base_url('assets/img/avatars/avatar15.jpg') ?>";
        $('#form_add').find("input[type=text], textarea, input[type=file], input[type=password]").val("");
        $('#page').val('add');
        // $('#role_id').val('1');
        $('#foto_name').val('');
        $('#remove_foto_name').hide();
        $('#tmp_foto_name').attr('src', img);
    });
$(document).on('click', '.swal-confirm-delete', function(){
        let id = $(this).data('id');
        console.log('click delete');
        swal({
            title: 'Are you sure?',
            text: 'You will not be able to recover this imaginary file!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Yes, delete it!',
            html: false,
            preConfirm: function() {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve();
                    }, 50);
                });
            }
        }).then(function(result){
            if (result.value) {
                swal('Deleted!', 'Your imaginary file has been deleted.', 'success');
                $.ajax({
                    type: 'POST',
                    url: BASE_URL + 'admin/akun/del',
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
                swal('Cancelled', 'Your imaginary file is safe :)', 'error');
            }
        });
    });



$(document).ready(function(){
    tables_load();
    akunValidation.init();
    akunValidation2.init();
        

})
</script>