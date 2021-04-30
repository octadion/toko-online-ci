<script>
$(document).ready(function () {
    filter_data(1);
    function filter_data(page){
        $('#filter_data').html("<div id='loading'</div>");
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var category = get_filter('category');
        $.ajax({
            url: "<?= base_url();?>productfront/fetch_data"+page,
            method: "POST",
            dataType: "JSON",
            data: {action:action, minimum_price:minimum_price,
                    maximum_price:maximum_price, category:category
                },
            success:function(data){
                $('.filter_data').html(data.product_list);
                $('#pagination_link').html(data.pagination_link);
            }
        })
    }

    function get_filter(class_name) {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        
        });
        return filter;
      }
  
});
</script>
<script>
            jQuery(function () {
                // Init page helpers (Slick Slider plugin)
                Codebase.helpers('slick');
            });
        </script>