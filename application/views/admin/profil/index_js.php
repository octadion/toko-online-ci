<script>
 $(document).ready(function() {
    
    $.ajax({
            type: 'GET',
            url: BASE_URL+'admin/profil/get_profile',
            dataType: 'JSON',
            success: function(res)  {
                var img = "<?= base_url('assets/img/avatars/avatar15.jpg') ?>";
               var img_new = $(`#foto_name`)[0].setAttribute('src',BASE_URL + res.foto_path+'/'+res.foto_name);
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
            $('#tmp_foto_name').attr('src', img_new);
        });
    }
        });

    });
</script>
<script>
    data = {};


    jQuery(function () {
        // Init page helpers (Summernote + CKEditor + SimpleMDE plugins)
        Codebase.helpers(['summernote', 'tags-inputs', 'select2']);
    });

    function getProfile(){
        $.ajax({
            type: 'GET',
            url: BASE_URL+'admin/profil/get_profile',
            dataType: 'JSON',
            success: function(res)  {
                console.log(res.id);
                $(`#id`).val(res.id);
                $(`#first_name`).val(res.first_name);
                $(`#last_name`).val(res.last_name);
                $(`#email`).val(res.email);
                $(`#phone`).val(res.phone);
                $(`#alamat`).val(res.alamat);
                $(`#foto`)[0].setAttribute('src',BASE_URL + res.foto_path+'/'+res.foto_name);
              }
        });


    }

    var OpAuthSignIn = function() {
        var initValidationSignIn = function() {
            jQuery('.js-validation-akun').validate({
                ignore: ".ignoreThisClass",
                errorClass: 'invalid-feedback animated fadeInDown',
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    jQuery(e).parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
                },
                success: function(e) {
                    jQuery(e).closest('.form-group').removeClass('is-invalid');
                    jQuery(e).remove();
                },
                rules: {
                    'username': {
                        required: true,
                    },
                    'name': {
                        required: true,
                    },
                    'email': {
                        required: true,
                        email: true,
                        // remote: 
                        //     {
                        //             url: BASE_URL + 'akun/check_email_exists',
                        //             type: 'POST',
                        //             data: 
                        //             {
                        //                 email: function(){ return $("#email").val(); }
                                        
                        //             },
                                    
                        //     } 
                    },
                    'first_name': {
                        required: true
                    },
                    'last_name': {
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
                    'username': 'Username wajib diisi!',
                    'name': 'Name wajib diisi!',
                    'email': {
                        required: 'Email wajib diisi!',
                        // remote: 'Email sudah dipakai!',
                    },
                    'first_name': 'Nama Depan wajib diisi!',
                    'last_name': 'Nama Belakang wajib diisi!',
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
    var OpAuthSignIn2 = function() {
        var initValidationSignIn2 = function() {
            jQuery('.js-validation-password').validate({
                ignore: ".ignoreThisClass",
                errorClass: 'invalid-feedback animated fadeInDown',
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    jQuery(e).parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
                },
                success: function(e) {
                    jQuery(e).closest('.form-group').removeClass('is-invalid');
                    jQuery(e).remove();
                },
                rules: {
                    
                    'password': {
                        required: true,
                        minlength: 5,
                     
                    },
                    'new_password': {
                        required: true,
                        minlength: 5,
        
                    },
                    'passconf': {
                        required: true,
                        minlength: 5,
                        equalTo: "#new_password"
                    },
                   
                },
                messages: {
                    
                    'new_password': { 
                        required: 'Password wajib diisi!',
                        minlength: 'Password minimal 5 karakter!'
                    },
                    'passconf': { 
                        required: 'Password Confirmation wajib diisi!',
                        minlength: 'Password Confirmation minimal 5 karakter',
                        equalTo: 'Password harus sesuai dengan diatas!'
                    },
                    'password': {
                        required: 'Password lama wajib diisi!',
                        remote: 'Password tidak sesuai dengan password lama!',
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

    


    $('#form_akun').on('submit', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        
        var form = $('form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        console.log(Array.from(formData));

        if($("#form_akun").valid() === true){
            $.ajax({
                url: BASE_URL + 'admin/profil/update',
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(res){
                    console.log(res);
                    swal(res);
                    // window.location.replace(BASE_URL+'akun');
                },
                error: function(res){
                    console.log('error');
                }
            });
        }
    });
    $('#form_password').on('submit', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        
        var form = $('#form_password')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        console.log(Array.from(formData));

        if($("#form_password").valid() === true){
            $.ajax({
                url: BASE_URL + 'admin/profil/edit_pw',
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(res){
                    console.log(res);
                    // window.location.replace(BASE_URL+'akun');
                    swal(res);
                },
                error: function(res){
                    console.log('error');    
                }
            });
        }
    });
    $( document ).ready(function() {
        
        console.log( "ready!" );
        OpAuthSignIn.init();
        OpAuthSignIn2.init();
        getProfile();
    });
    
</script>
