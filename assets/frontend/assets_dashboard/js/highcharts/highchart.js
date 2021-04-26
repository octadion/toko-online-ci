// basic-bar charts //
const chart_initial = {

    chart: {
        scrollablePlotArea: {
            // maxWidth: 700
        }
    },

    data: {
        csvURL: 'https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/analytics.csv',
        beforeParse: function (csv) {
            return csv.replace(/\n\n/g, '\n');
        }
    },

    title: {
        text: 'DATA COVID-19 KOTA SURAKARTA'
    },

    subtitle: {
        text: 'sumber: www.surakarta.go.id'
    },

    xAxis: {
        tickInterval: 7 * 24 * 3600 * 1000, // one week
        tickWidth: 0,
        gridLineWidth: 1,
        labels: {
            align: 'left',
            x: 3,
            y: -3
        }
    },

    yAxis: [{ // left y axis
        title: {
            text: null
        },
        labels: {
            align: 'left',
            x: 3,
            y: 16,
            format: '{value:.,0f}'
        },
        showFirstLabel: false
    }, { // right y axis
        linkedTo: 0,
        gridLineWidth: 0,
        opposite: true,
        title: {
            text: null
        },
        labels: {
            align: 'right',
            x: -3,
            y: 16,
            format: '{value:.,0f}'
        },
        showFirstLabel: false
    }],

    legend: {
        align: 'left',
        verticalAlign: 'top',
        borderWidth: 0
    },

    tooltip: {
        shared: true,
        crosshairs: true
    },

    plotOptions: {
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function (e) {
                        hs.htmlExpand(null, {
                            pageOrigin: {
                                x: e.pageX || e.clientX,
                                y: e.pageY || e.clientY
                            },
                            headingText: this.series.name,
                            maincontentText: Highcharts.dateFormat('%A, %b %e, %Y', this.x) + ':<br/> ' +
                                this.y + ' sessions'
                        });
                    }
                }
            },
            marker: {
                lineWidth: 1
            }
        }
    },

    series: [{
        name: 'All sessions',
        lineWidth: 4,
        marker: {
            radius: 4
        }
    }, {
        name: 'New users'
    }]
}
$('#highchart').highcharts(chart_initial);

// pie charts (belum kepake)//
const pie_initial = {
    title: {
        text: ' '
    },

    series: [{
        type: 'pie',
        allowPointSelect: true,
        keys: ['name', 'y', 'selected', 'sliced'],
        data: [
            ['Konfirmasi Pulang', 2358, false],
            ['Konfirmasi Isolasi', 429, false],
            ['Konfirmasi Perawatan', 62, false],
            ['Konfirmasi MD', 140, false],
            ['Suspect Perawatan', 2, false],
            ['Suspect Isolasi', 2, false],
            ['Suspect Discarded', 455, true, true],
            ['Suspect MD', 39, false],
            ['Probable MD', 4, false]
        ],
        showInLegend: true
    }]
}
$('#kelurahan-chart-1').highcharts(pie_initial);
$('#kelurahan-chart-2').highcharts(pie_initial);
