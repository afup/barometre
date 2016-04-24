(function () {
    var svg;
    var path;

    var tooltip = d3.select("body")
      .append("div")
      .attr("class", "tooltip")
      .style("visibility", "hidden");

    function init() {

        if (1 !== $('#map').length) {
            return;
        }

        var xy = d3.geo.albers()
            .origin([2.6, 46.5])
            .parallels([44, 49])
            .scale(2700)
            .translate([250, 250]);
        path = d3.geo.path().projection(xy);

        svg = d3.select("#map svg")
            .append("g");

        var bg = svg.append("g")
            .attr("id", "background");

        svg.insert("g", "#background")
            .attr("id", "data_layer");

        var dataLayer = svg.select('#data_layer');
        dataLayer.attr("class", 'Blues');



        d3.json(getTypeInfos().file, function (json) {
            bg.selectAll("path")
                .data(json.features)
                .enter().append("path")
                .attr("d", path);
            dataLayer.selectAll("path")
                .data(json.features)
                .enter().append("path")
                .attr("d", path);
            recomputeValues();
        });
    }

    function getTypeInfos()
    {
        var mapType = $('#map-table').data("map-type");
        switch (mapType) {
            case 'region':
                return {
                    file: "/geofla/regions_2016.geojson",

                    keyCode: "code",
                    keyNom: "nom"
                };
                break;
            case 'departement':
                return {
                    file: "/geofla/departement.json",
                    keyCode: "CODE_DEPT",
                    keyNom: "NOM_DEPT"
                };
                break;
            default:
                throw "unknown map type";
        }
    }

    function recomputeValues() {
        var values = getValues();
        var typeInfos = getTypeInfos();
        d3.selectAll("#data_layer path")
        .on("mouseover", function (d) {
            var value = parseInt(values[d.properties[typeInfos.keyCode]]);
            if (isNaN(value)) {
                value = 0;
            }
            tooltip.text(d.properties[typeInfos.keyNom] + " / " + value);
            return tooltip.style("visibility", "visible");
        })
        .on("mousemove", function () {
            return tooltip.style("top", (d3.event.pageY - 10) + "px").style("left", (d3.event.pageX + 10) + "px");
        })
        .on("mouseout", function () {
            return tooltip.style("visibility", "hidden");
        })
        .datum(function (d) {
            d.value = parseInt(values[d.properties[typeInfos.keyCode]]);
            if (isNaN(d.value)) {
                d.value = 0;
            }
            return d;
        });
        recomputeScale();
    }

    function getValues() {
        var values = {};
        $('#map-table').find('tr').each(function () {
            var dep = $('td', this).first().text();
            var nb = $('td', this).last().text();
            if (0 === dep.length) {
                return;
            }
            values[dep] = nb.replace(/\s/g, '');
        });
        return values;
    }

    function recomputeScale() {
        var p = d3.selectAll("#data_layer path");
        var values = p.data().map(function (d) { return d.value; });
        var scale = buildScale(values, 9, 'quantize');
        p.attr("class", function (d) { return scale(d.value); });
    }

    function buildScale(domain, buckets) {
        var legendClass = function (n) { return "q" + n + "-" + buckets; };
        var minmax = d3.extent(domain);
        var min = minmax[0];
        var max = minmax[1];
        var a = d3.range(buckets).map(legendClass);
        var scale, q;
        scale = d3.scale.quantize().range(a).domain([min, max]);
        q = d3.range(buckets + 1).map(function (n) {
            return min + (max - min) * (n / buckets);
        });
        q = q.map(function (n) { return n.toPrecision(3); });

        return scale;
    }

    $(document).ready(init);
})();
