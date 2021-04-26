<script src="<?= base_url()?>assets/js/plugins/chartjs/Chart.bundle.min.js"></script>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script>
var ctx = document.getElementById('myChart2').getContext('2d');
var myChart2 = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scaleShowLabels : false
    }
});
</script>
<script>
/*
 *  Document   : be_pages_dahboard.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in Dashboard Page
 */

var BePagesDashboard = function() {
    // Chart.js Charts, for more examples you can check out http://www.chartjs.org/docs
    var initDashboardChartJS = function () {
        // Set Global Chart.js configuration
        Chart.defaults.global.defaultFontColor              = '#555555';
        Chart.defaults.scale.gridLines.color                = "transparent";
        Chart.defaults.scale.gridLines.zeroLineColor        = "transparent";
        Chart.defaults.scale.display                        = false;
        Chart.defaults.scale.ticks.beginAtZero              = true;
        Chart.defaults.global.elements.line.borderWidth     = 2;
        Chart.defaults.global.elements.point.radius         = 5;
        Chart.defaults.global.elements.point.hoverRadius    = 7;
        Chart.defaults.global.tooltips.cornerRadius         = 3;
        Chart.defaults.global.legend.display                = false;

        // Chart Containers
        var chartDashboardLinesCon  = jQuery('.js-chartjs-dashboard-lines');
        var chartDashboardLinesCon2 = jQuery('.js-chartjs-dashboard-lines2');

        // Chart Variables
        var chartDashboardLines, chartDashboardLines2;

        // Lines Charts Data
        var chartDashboardLinesData = {
            labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
            datasets: [
                {
                    label: 'This Week',
                    fill: true,
                    backgroundColor: 'rgba(66,165,245,.25)',
                    borderColor: 'rgba(66,165,245,1)',
                    pointBackgroundColor: 'rgba(66,165,245,1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(66,165,245,1)',
                    data: [25, 21, 23, 38, 36, 35, 39]
                }
            ]
        };

        var chartDashboardLinesOptions = {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMax: 50
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItems, data) {
                        return ' ' + tooltipItems.yLabel + ' Sales';
                    }
                }
            }
        };

        var chartDashboardLinesData2 = {
            labels: ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'],
            datasets: [
                {
                    label: 'This Week',
                    fill: true,
                    backgroundColor: 'rgba(156,204,101,.25)',
                    borderColor: 'rgba(156,204,101,1)',
                    pointBackgroundColor: 'rgba(156,204,101,1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(156,204,101,1)',
                    data: [190, 219, 235, 320, 360, 354, 390]
                }
            ]
        };

        var chartDashboardLinesOptions2 = {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMax: 480
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItems, data) {
                        return ' $ ' + tooltipItems.yLabel;
                    }
                }
            }
        };

        // Init Charts
        if ( chartDashboardLinesCon.length ) {
            chartDashboardLines  = new Chart(chartDashboardLinesCon, { type: 'line', data: chartDashboardLinesData, options: chartDashboardLinesOptions });
        }

        if ( chartDashboardLinesCon2.length ) {
            chartDashboardLines2 = new Chart(chartDashboardLinesCon2, { type: 'line', data: chartDashboardLinesData2, options: chartDashboardLinesOptions2 });
        }
    };

    return {
        init: function () {
            // Init Chart.js Charts
            initDashboardChartJS();
        }
    };
}();

// Initialize when page loads
jQuery(function(){ BePagesDashboard.init(); });
</script>