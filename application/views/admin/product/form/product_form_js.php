   <!-- dropzone -->
   <link rel="stylesheet" href="<?= base_url() ?>assets/js/plugins/dropzonejs/min/dropzone.min.css">
    <script src="<?= base_url() ?>assets/js/plugins/dropzonejs/min/dropzone.min.js"></script>
   
<script>
 $(document).ready(function() {
    
        });
    data = {};

    function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: BASE_URL + 'berita/upload_photo_summernote',
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "post",
            success: function(url) {
                // var image = $('<img>').attr('src', 'http://' + url);
                // $('#isi_berita').summernote("insertNode", image[0]);
                console.log(url);
                $("#isi_berita").summernote("insertImage", url);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            console.log(e.target.result)
            $('#preview').attr('src', e.target.result);
            $('.remove-image').removeAttr("hidden");
            $('.image-area').removeAttr("hidden");
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
    }
    
    jQuery(function () {
        // Init page helpers (Summernote + CKEditor + SimpleMDE plugins)
        Codebase.helpers(['summernote', 'tags-inputs', 'select2']);
    });

    var OpAuthSignIn = function() {
        var initValidationSignIn = function() {
            jQuery.validator.addMethod("notNumber", function(value, element, param) {
                    var reg = /^[0-9]+$/;
                    if(reg.test(value)){
                            return false;
                    }else{
                            return true;
                    }
            }, "Tidak boleh berisi angka saja");
            
            jQuery('.js-validation-product').validate({
                // ignore: $( "#page" ).val() == 'edit' ? "#title" : ".IgnoreThisClass",
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
                    'barcode': {
                        required: true,
                        notNumber: true,
                        remote:{
                            url: BASE_URL + "admin/product/barcode_validation",
                            type: "post"
                        }
                    },
                    'name': {
                        required: true
                    },
                    'category': {
                        required: true
                    },
                    'description': {
                        required: true
                    },
                    'short_desc': {
                        required: true
                    },
                    'weight': {
                        required: true
                    },
                    'unit': {
                        required: true
                    },
                    'price': {
                        required: true
                    },
                },
                messages: {
                    'barcode': {
                            required: 'Barcode wajib diisi!',
                            notNumber: 'Tidak boleh berisi angka saja',
                            remote: 'Barcode tidak boleh sama'
                        },
                    'name': 'Nama product wajib diisi!',
                    'category': 'Kategori product wajib dipilih!',
                    'description' : 'Deskripsi wajib diisi!',
                    'short_desc' : 'Deskripsi singkat wajib diisi!',
                    'weight' : 'Berat product wajib diisi!',
                    'unit' : 'Unit wajib diisi!',
                    'price' : 'Harga wajib diisi!',

                }
            });
        };

        return {
            init: function() {
                initValidationSignIn();
            }
        };
    }();
    
    
    // check button submit clicked, published / draft
    var status;
    $('#published, #draft').click(function () {
        if (this.id == 'published') {
            status_post = 'published';
        }
        else if (this.id == 'draft') {
            status_post = 'draft';
        }
    });
    // end check button

    $('#form_product').on('submit', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        
        var form = $('form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);

        
        console.log(status_post);
        formData.append('status_post', status_post)
        console.log(Array.from(formData));

        if($("#form_product").valid() === true){
            $.ajax({
                url: BASE_URL + 'admin/product/process',
                data: formData,
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                success: function(res){
                    console.log('success');
                    window.location.replace(BASE_URL+'admin/product');
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
        var imgSrc;
        if($( "#page" ).val() == 'edit'){
            $('#form_product').find('#title').rules('remove', 'remote');
            imgSrc = $('#preview').attr('src');
        }
        console.log(imgSrc);
        $('#description').summernote({
            height: 300,
            callbacks: {
                onImageUpload: function(image) {
                    console.log(image);
                    uploadImage(image[0]);
                }
            }
        });

        $("#thumbnail").change(function() {
            readURL(this);
        });

        $(".remove-image").on('click', function() { 
            $("#thumbnail").val(''); 
            $('.remove-image').attr("hidden", true);
            if($( "#page" ).val() == 'edit'){
                $('#preview').attr('src', imgSrc);
            }else{
                $('#preview').attr('src', '#');
                $('.image-area').attr("hidden", true);
            }
        });
        
        // if($( "#page" ).val() == 'edit'){
        //     $.validator.setDefaults({ ignore: ["input#title"] });
        // }
    });

    // Dropzone.autoDiscover = false;
    //     var acceptedFileTypes = "image/*"; //dropzone requires this param be a comma separated list 
    //     var fileList = new Array;
    //     var i = 0;
    //     var base_url = '<?= base_url(); ?>';
    //     var url = base_url + 'admin/product/upload_gambar';
    //     $('.dropzone').each(function() {
    //         $(this).dropzone({
    //             url: url,
    //             addRemoveLinks: true, // true
    //             maxFiles: 10, //change limit as per your requirements
    //             dictMaxFilesExceeded: "File anda terlalu besar",
    //             acceptedFiles: acceptedFileTypes,
    //             dictInvalidFileType: "Hanya untuk file gambar saja",
    //             init: function() {
    //                 // Hack: Add the dropzone class to the element
    //                 $(this.element).addClass("dropzone");
    //                 this.on("addedfile", function() {

    //                 });
    //                 this.on('error', function(file, response) {
    //                     this.removeFile(file); //remove file from the zone.
    //                     var obj = jQuery.parseJSON(response)
    //                     toastr.error(obj.msg, {
    //                         timeOut: 1000,
    //                         fadeOut: 1000
    //                     });
    //                 });
    //                 this.on("success", function(file, response) {
    //                     this.removeFile(file); //remove file from the zone.
    //                     var obj = jQuery.parseJSON(response)
    //                     if (obj.status == 'success') {
    //                         toastr.success(obj.msg, {
    //                             timeOut: 1000,
    //                             fadeOut: 1000
    //                         });
    //                         $('#table_data_gambar').DataTable().ajax.reload();
    //                     }
    //                 });
    //             }
    //         });
    //     });
    
    
</script>
<script>
// $('#table_data_gambar .table_body').on('click', '.tombol_hapus', function(e) {
//             e.preventDefault();
//             var id = $(this).attr('data-id');
//             console.log(id);
//             var url = base_url + 'hapus_data_gambar';
//             Swal.fire({
//                 title: 'Hapus Data ?',
//                 text: "Data akan dihapus dari sistem",
//                 showCancelButton: true,
//                 confirmButtonText: 'Ya',
//                 cancelButtonText: 'Batal',
//                 reverseButtons: true
//             }).then((result) => {
//                 if (result.value) {
//                     var data = new FormData();
//                     data.append('id', id);
//                     e.preventDefault();
//                     $.ajax({
//                         url: url,
//                         type: "POST",
//                         data: data,
//                         dataType: 'json',
//                         processData: false,
//                         contentType: false,
//                         beforeSend: function() {
//                             // console.log('sedang menghapus');
//                         },
//                         complete: function() {
//                             // console.log('Berhasil');
//                         },
//                         error: function(e) {
//                             console.log(e);
//                             toastr.error('gagal, terjadi kesalahan', {
//                                 timeOut: 1000,
//                                 fadeOut: 1000
//                             });
//                         },
//                         success: function(data) {
//                             if (data.status == 'success') {
//                                 toastr.success(data.msg, {
//                                     timeOut: 1000,
//                                     fadeOut: 1000
//                                 });
//                                 $('#table_data_gambar').DataTable().ajax.reload();
//                             }
//                         },
//                     });
//                 } else {
//                     return false;
//                 }
//             })
//         });
        
</script>
<script>
// Dropzone.autoDiscover = false;
// // Dropzone.options.form_product = false;	
// let token = $('meta[name="csrf-token"]').attr('content');
// $(function() {
// var myDropzone = new Dropzone("div#dropzoneDragArea", { 
// 	paramName: "file",
// 	url: BASE_URL + 'admin/product/tambah',
// 	previewsContainer: 'div.dropzone-previews',
// 	addRemoveLinks: true,
// 	autoProcessQueue: false,
// 	uploadMultiple: false,
// 	parallelUploads: 1,
// 	maxFiles: 1,
// 	params: {
//         _token: token
//     },
// 	 // The setting up of the dropzone
// 	init: function() {
// 	    var myDropzone = this;
// 	    //form submission code goes here
// 	    $("form[name='form_product']").submit(function(event) {
// 	    	//Make sure that the form isn't actully being sent.
// 	    	var form = $('form')[0]; // You need to use standard javascript object here
//         var formData = new FormData(form);

        
//         console.log(status);
//         formData.append('status', status)
//         console.log(Array.from(formData));

//         if($("#form_product").valid() === true){
//             $.ajax({
//                 url: url,
//                 data: formData,
//                 type: 'POST',
//                 contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
//                 processData: false, // NEEDED, DON'T OMIT THIS
//                 success: function(res){
//                     console.log('success');
//                     // window.location.replace(BASE_URL+'admin/product');
//                 },
//                 error: function(res){
//                     console.log('error');
//                 }
//             });
//         }
// 	    });
// 	    //Gets triggered when we submit the image.
// 	    this.on('sending', function(file, xhr, formData){
// 	    //fetch the user id from hidden input field and send that userid with our image
// 	      let userid = document.getElementById('userid').value;
// 		   formData.append('userid', userid);
// 		});
		
// 	    this.on("success", function (file, response) {
//             //reset the form
//             $('#form_product')[0].reset();
//             //reset dropzone
//             $('.dropzone-previews').empty();
//         });
//         this.on("queuecomplete", function () {
		
//         });
		
//         // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
// 	    // of the sending event because uploadMultiple is set to true.
// 	    this.on("sendingmultiple", function() {
// 	      // Gets triggered when the form is actually being sent.
// 	      // Hide the success button or the complete form.
// 	    });
		
// 	    this.on("successmultiple", function(files, response) {
// 	      // Gets triggered when the files have successfully been sent.
// 	      // Redirect user or notify of success.
// 	    });
		
// 	    this.on("errormultiple", function(files, response) {
// 	      // Gets triggered when there was an error sending the files.
// 	      // Maybe show form again, and notify user of error
// 	    });
// 	}
// 	});
// });

</script>
<!-- <script>
Dropzone.options.myDropzone= {
    url: BASE_URL + 'admin/product/tambah',
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 5,
    maxFiles: 5,
    maxFilesize: 1,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    init: function() {
        dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

        // for Dropzone to process the queue (instead of default form behavior):
        document.getElementById("published").addEventListener("click", function(e) {
            // Make sure that the form isn't actually being sent.
            e.preventDefault();
            e.stopPropagation();
            dzClosure.processQueue();
        });

        //send all the form data along with the files:
        this.on("sendingmultiple", function(data, xhr, formData) {
            formData.append("barcode", jQuery("#barcode").val());
            formData.append("page", jQuery("#page").val('add'));
            formData.append("id", jQuery("#id").val('id'));
            formData.append("category", jQuery("#category").val());
            formData.append("name", jQuery("#name").val());
            formData.append("description", jQuery("#description").val());
            formData.append("short_desc", jQuery("#short_desc").val());
            formData.append("price", jQuery("#price").val());
            formData.append("barcode", jQuery("#barcode").val());
            formData.append("weight", jQuery("#weight").val());
            formData.append("unit", jQuery("#unit").val());
            // formData.append("file[]", document.getElementById('file'));
            
        });
    }
}
</script> -->
<!-- <script>
        Dropzone.autoDiscover = false;
        myDropzone = new Dropzone('div#imageUpload', {
            url: BASE_URL + 'admin/product/tambah',
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            acceptedFiles: "image/*",

            init: function () {

                var submitButton = document.querySelector("#published");
                var wrapperThis = this;

                submitButton.addEventListener("click", function () {
                    wrapperThis.processQueue();
                });

                this.on("addedfile", function (file) {

                    // Create the remove button
                    var removeButton = Dropzone.createElement("<button class='btn btn-lg dark'>Remove File</button>");

                    // Listen to the click event
                    removeButton.addEventListener("click", function (e) {
                        // Make sure the button click doesn't submit the form:
                        e.preventDefault();
                        e.stopPropagation();

                        // Remove the file preview.
                        wrapperThis.removeFile(file);
                        // If you want to the delete the file on the server as well,
                        // you can do the AJAX request here.
                    });

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                });

                this.on('sendingmultiple', function (data, xhr, formData, file) {
                    formData.append("barcode", jQuery("#barcode").val());
            formData.append("page", jQuery("#page").val('add'));
            formData.append("id", jQuery("#id").val('id'));
            formData.append("category", jQuery("#category").val());
            formData.append("name", jQuery("#name").val());
            formData.append("description", jQuery("#description").val());
            formData.append("short_desc", jQuery("#short_desc").val());
            formData.append("price", jQuery("#price").val());
            formData.append("barcode", jQuery("#barcode").val());
            formData.append("weight", jQuery("#weight").val());
            formData.append("unit", jQuery("#unit").val());
            formData.append("file", file);
                });
            }
        });
    </script> -->