$(document).ready(function () {

    $('table.highchart')
        .bind('highchartTable.beforeRender', function (event, highChartConfig) {

            if ($(this).hasClass('highchart-emoticon')) {
                var icons = $(this).data('icons');

                highChartConfig.plotOptions.series = {
                    dataLabels: {
                        useHTML: true,
                        formatter : function () {
                            var defaultDatalabel = '<b>' + this.point.name + '</b> : ' + this.percentage.toFixed(2) + '%';
                            if (typeof icons[this.point.name] === 'undefined') {
                                return defaultDatalabel;
                            }
                            var infos = icons[this.point.name];
                            return '<i class="icon ' + infos.class + '" style="font-size: ' + infos.size + '"></i> ' + defaultDatalabel;
                        }
                    }
                };
            }

            if ($(this).hasClass('highchart-value-and-percent')) {
                highChartConfig.plotOptions.series = {
                    dataLabels: {
                        useHTML: true,
                        formatter : function () {
                            return '<b>' + this.point.name + '</b> : ' + this.y + ' (' + this.percentage.toFixed(2) + '%)';
                        }
                    }
                };
            }

            highChartConfig.colors[0] = '#4C6EAF';
            var align = $(this).data('graph-xaxis-labels-align');
            if (align !== undefined) {
                highChartConfig.xAxis.labels.align = align;
            }
        })
        .highchartTable();
});

