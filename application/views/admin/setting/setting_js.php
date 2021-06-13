<script>
    $(document).ready(function () {
        getSetting();
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/province')?>",
            success: function (result_province) {
                // console.log(result_province)
                $("select[name=provinsi]").html(result_province);
            }
        });

      $("select[name=provinsi]").on("change", function(){
            var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
            $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/city')?>",
            data: 'id_provinsi='+id_provinsi_terpilih,
            success: function (result_city) {
                // console.log(result_province)
                $("select[name=kota]").html(result_city);
            }
        });
      });

        jQuery(function () {
        // Init page helpers (Summernote + CKEditor + SimpleMDE plugins)
        Codebase.helpers(['summernote', 'tags-inputs', 'select2']);
    });

      });
</script>
<script>

function getSetting(){
        $.ajax({
            type: 'GET',
            url: BASE_URL+'admin/setting/get_setting',
            dataType: 'JSON',
            success: function(res)  {
                $(`#id`).val(res.id);
                $(`#store_name`).val(res.store_name);
                $(`#kota`).val(res.location);
                $(`#address`).val(res.address);
                $(`#no_telp`).val(res.no_telp);
               
             
              }
        });


    }
    $('#form_teks').on('submit', function(e) { //use on if jQuery 1.7+
        e.preventDefault();
        
        var form = $('form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        console.log(Array.from(formData));

        if($("#form_teks").valid() === true){
            $.ajax({
                url: BASE_URL + 'admin/setting/save',
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
</script>