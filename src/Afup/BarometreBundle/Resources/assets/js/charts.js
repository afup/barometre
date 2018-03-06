$(document).ready(function () {

    $('table.highchart')
        .bind('highchartTable.beforeRender', function (event, highChartConfig) {

            if ($(this).hasClass('highchart-emoticon')) {
                var icons = $(this).data('icons');

                if ($(this).data('graph-type') !== 'column') {
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
                } else {
                    highChartConfig.xAxis.labels.useHTML = true;
                    highChartConfig.xAxis.labels.formatter = function () {
                        var trimmedValue = this.value.trim();
                        var defaultDatalabel = trimmedValue;
                        if (typeof icons[trimmedValue] === 'undefined') {
                            return defaultDatalabel;
                        }
                        var infos = icons[trimmedValue];
                        return '<i class="icon ' + infos.class + '" style="font-size: ' + infos.size + '"></i> ' + defaultDatalabel;
                    };
                }
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

            if ($(this).hasClass('abstract-distribution-evolution')) {
                highChartConfig.plotOptions.series.dataLabels = {
                    useHTML: true,
                    formatter : function () {
                        if (typeof this.percentage === 'undefined') {
                            return;
                        }

                        if (this.percentage < 10) {
                            return;
                        }

                        return '<b>' + this.series.name + '</b> : <br />' + ' ' + this.percentage.toFixed(2) + '%';
                    }
                };
            }

            if ($(this).data('graph-datalabels-format')) {
                highChartConfig.plotOptions.series.dataLabels = {
                    useHTML: true,
                    format: $(this).data('graph-datalabels-format')
                }
            }

            if ($(this).data('graph-tooltip-disabled') == 1) {
                highChartConfig.tooltip = {
                    enabled: false
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

