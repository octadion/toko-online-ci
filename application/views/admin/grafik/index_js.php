<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- <script src="http://code.highcharts.com/highcharts.js"></script> -->
<script src="<?= base_url(); ?>assets/js/plugins/bootstrap-datepicker.js"></script>
<script>
  jQuery(function () {
        Codebase.helpers(['summernote', 'tags-inputs', 'select2']);
    });
function datepicker(){
 $('.input-daterange').datepicker({
    todayBtn: 'linked',
    format: "yyyy-mm-dd",
    autoclose: true
    });
}
$('#search').click(function(){
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
    var tipe = $('#tipe').val();
    console.log(start_date);
    console.log(end_date);
    console.log(tipe);
     getAjaxData(tipe, start_date, end_date);
});

var chart = Highcharts.chart('container', {
    chart: {
      type: 'column'
    },
    title: {
      text: ''
    },
    subtitle: {
      text: ''
    },
    xAxis: {
          categories: [
          []
          ],
          crosshair: true
      },
    series: [{
      name: 'Data',
      color: "#2a82ff",
      data: [],
      dataLabels: {
        enabled: true,
        color: '#045396',
        align: 'center',
        formatter: function() {
              return Highcharts.numberFormat(this.y, 0);
              },
        y: 0,
        style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif',
        position: 'relative'
       }
     }
    },
    ]
});
                function getAjaxData(tipe, start_date, end_date) {
                    var base_url = '<?= base_url(); ?>';
                    $.ajax({
                url: base_url + 'admin/grafik/data',
                type: 'POST',
                dataType: "json",
                data : {tipe: tipe,
                        start_date : start_date,
                        end_date : end_date},

            }).done(function(data) {
                // console.log(result);
                let result = [];
                          // data = JSON.parse(data);
                          // console.log(data);
                          let datetime = [];
                          let total = [];
                          data.forEach(item => {
                            result.push(parseInt(item.total));
                          })
                          data.forEach(item => {
                            total.push(parseInt(item.total_penjualan));
                          })
                          data.forEach(item => {
                            datetime.push(item.datetime);
                          })
                          console.log(result);
                          console.log(datetime);
                          console.log(data);
                          // console.log(datetime);
                        chart.series[0].setData(result);
                        chart.xAxis[0].setCategories( datetime )
                });
        
                }
// i'm assume the queries from database already worked out
// simply use this below code to send parameter during request

$(document).ready(function(){
    datepicker();
    // tables_load();
    // unitValidation.init();
    Codebase.helpers('notify');
})
</script>