/* global Highcharts */

var CHART_COLORS = {
    blue: '#4C6EAF',
    teal: '#5495ab',
    orange: '#cd8546',
    purple: '#7e6a9d',
    green: '#8fa156',
    text: '#333333',
    muted: '#555555',
    grid: '#eeeeee',
    axis: '#999999'
};

// Lu par highchartTable pour la palette par défaut des séries
Highcharts.theme = {
    colors: [CHART_COLORS.blue, CHART_COLORS.orange, CHART_COLORS.purple, CHART_COLORS.green, CHART_COLORS.teal, '#92A8CD', '#A47D7C', '#B5CA92', '#999999']
};

Highcharts.setOptions({
    chart: {
        style: {fontFamily: 'inherit'}
    },
    xAxis: {
        lineColor: CHART_COLORS.axis,
        tickLength: 0,
        labels: {style: {color: CHART_COLORS.muted, fontSize: '12px'}}
    },
    yAxis: {
        gridLineColor: CHART_COLORS.grid,
        labels: {style: {color: CHART_COLORS.muted, fontSize: '12px'}}
    },
    legend: {
        itemStyle: {color: CHART_COLORS.text, fontWeight: 'normal', fontSize: '13px'}
    },
    plotOptions: {
        column: {borderWidth: 1, borderColor: '#ffffff', pointPadding: 0.1}
    }
});

$(document).ready(function () {

    // Couleurs de l'ancienne palette encore codées en dur dans certains templates
    var LEGACY_COLORS = {
        '#343477': CHART_COLORS.blue,
        '#3d96ae': CHART_COLORS.teal,
        '#882d60': CHART_COLORS.orange,
        '#a14679': CHART_COLORS.orange,
        '#db843d': CHART_COLORS.orange,
        '#80699b': CHART_COLORS.purple,
        '#89a54e': CHART_COLORS.green
    };
    var modernColor = function (color) {
        return typeof color === 'string' && LEGACY_COLORS[color.toLowerCase()] || color;
    };

    $('table.highchart')
        .bind('highchartTable.beforeRender', function (event, highChartConfig) {

            highChartConfig.series.forEach(function (serie) {
                serie.color = modernColor(serie.color);
                serie.data.forEach(function (point) {
                    if (point && point.color) {
                        point.color = modernColor(point.color);
                    }
                });
            });

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

                        if (this.percentage < 5) {
                            return;
                        }

                        return this.percentage.toFixed(1) + ' %';
                    },
                    style: {fontSize: '12px', fontWeight: 'bold', textOutline: 'none'}
                };
            }

            if ($(this).data('graph-type') === 'line') {
                highChartConfig.series.forEach(function(item) {
                    item.lineWidth = 2;
                    item.marker = {
                        enabled: true,
                        radius: 4
                    };
                    // Seule la dernière valeur de chaque courbe est affichée, en couleur et en k€
                    item.dataLabels = {
                        enabled: true,
                        align: 'left',
                        x: 6,
                        verticalAlign: 'middle',
                        style: {fontSize: '12px', fontWeight: 'bold', textOutline: 'none'},
                        formatter: function () {
                            if (this.point.index !== this.series.points.length - 1) {
                                return null;
                            }
                            return '<span style="color: ' + this.series.color + '">' + Math.round(this.y / 1000) + ' k€</span>';
                        }
                    };
                });
                highChartConfig.yAxis.forEach(function(axis) {
                    axis.labels = axis.labels || {};
                    axis.labels.formatter = function () {
                        return Math.round(this.value / 1000) + ' k€';
                    };
                });
                highChartConfig.chart.marginRight = 60;
            }

            // Comptages simples : on affiche la part et le nombre de réponses au bout de chaque barre
            var isSingleCountColumn = $(this).data('graph-type') === 'column' &&
                !highChartConfig.plotOptions.series.stacking &&
                highChartConfig.series.length === 1 &&
                $.trim(highChartConfig.series[0].name) === 'Nombre de réponses';
            if (isSingleCountColumn && !$(this).data('graph-datalabels-format') && !$(this).hasClass('highchart-emoticon')) {
                var total = highChartConfig.series[0].data.reduce(function (sum, point) {
                    return sum + ((point && point.y) || 0);
                }, 0);
                highChartConfig.series[0].dataLabels = {
                    enabled: true,
                    color: CHART_COLORS.text,
                    style: {fontSize: '12px', fontWeight: 'normal', textOutline: 'none'},
                    formatter: function () {
                        return Math.round(100 * this.y / total) + ' %  (' + this.y + ')';
                    }
                };
            }

            if ($(this).data('graph-datalabels-format')) {
                highChartConfig.plotOptions.series.dataLabels = {
                    useHTML: true,
                    format: $(this).data('graph-datalabels-format')
                };
            }

            if ($(this).data('graph-tooltip-disabled') === 1) {
                highChartConfig.tooltip = {
                    enabled: false
                };
            }

            var align = $(this).data('graph-xaxis-labels-align');
            if (align !== undefined) {
                highChartConfig.xAxis.labels.align = align;
            }
        })
        .highchartTable();
});

