@props([
    'matrix' => []
])

<div id="my_dataviz"></div>

<script defer>
    const data = @json($matrix);

    // set the dimensions and margins of the graph
    var margin = {top: 30, right: 30, bottom: 30, left: 30},
        width = 450 - margin.left - margin.right,
        height = 450 - margin.top - margin.bottom;
    // append the svg object to the body of the page
    var svg = d3.select("#my_dataviz")
        .append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform",
            "translate(" + margin.left + "," + margin.top + ")");
    // Labels of row and columns
    var rows = [];
    var cols = [];
    var chartData = [];
    data.forEach((item, i) => {
        if( i === 0) {
            item.forEach((itm , j) => {
                cols.push("col" + j);
                chartData.push({ row: "row" + i, col: "col" + j,value: itm});
            });
        } else {
            item.forEach((itm , j) => {
                chartData.push({ row: "row" + i, col: "col" + j, value: itm});
            });
        }
        rows.unshift("row" + i);
    })
    // Build X scales and axis:
    var x = d3.scaleBand()
        .range([ 0, width ])
        .domain(cols)
        .padding(0.01);
    svg.append("g")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(x))

    // Build X scales and axis:
    var y = d3.scaleBand()
        .range([ height, 0 ])
        .domain(rows)
        .padding(0.01);
    svg.append("g")
        .call(d3.axisLeft(y));

    // create a tooltip
    var tooltip = d3.select("#my_dataviz")
        .append("div")
        .style("opacity", 0)
        .attr("class", "tooltip")
        .style("background-color", "white")
        .style("border", "solid")
        .style("border-width", "2px")
        .style("border-radius", "5px")
        .style("padding", "5px")

    // Three function that change the tooltip when user hover / move / leave a cell
    var mouseover = function(d) {
        tooltip
            .style("opacity", 1)
        d3.select(this)
            .style("stroke", "black")
            .style("opacity", 1)
    }
    var mousemove = function(d) {
        tooltip
            .html("The exact value of<br>this cell is: " + d.value)
            .style("left", (d3.mouse(this)[0]+70) + "px")
            .style("top", (d3.mouse(this)[1]) + "px")
    }
    var mouseleave = function(d) {
        tooltip
            .style("opacity", 0)
        d3.select(this)
            .style("stroke", "none")
            .style("opacity", 0.8)
    }
    var onclick = function(d) {
        console.log(d.path[0].__data__)
    }


    // Find our max and min values
    const maxValue = d3.max(data, (layer) => {
        return d3.max(layer, (d) => {
            return d;
        });
    });
    const minValue = d3.min(data, (layer) => {
        return d3.min(layer, (d) => {
            return d;
        });
    });
    console.log(minValue, maxValue)

    // Build color scale
    var myColor = d3.scaleLinear()
        .range(["white", "#69b3a2"])
        .domain([minValue,maxValue])
    console.log(chartData);

    //Read the data
    svg.selectAll()
        .data(chartData, function(d) {return d.row+':'+d.col;})
        .enter()
        .append("rect")
        .attr("x", function(d) { return x(d.col) })
        .attr("y", function(d) { return y(d.row) })
        .attr("width", x.bandwidth() )
        .attr("height", y.bandwidth() )
        .style("fill", function(d) { return myColor(d.value)} )
        .on("mouseover", mouseover)
        .on("mousemove", mousemove)
        .on("mouseleave", mouseleave)
        .on("onclick", onclick)



    // // Add our labels as an array of strings
    // const rowLabelsData = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    // const columnLabelsData = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    //
    // function Matrix(options) {
    //     // Set some base properties.
    //     // Some come from an options object
    //     // pass when `Matrix` is called.
    //     const margin = { top: 50, right: 50, bottom: 180, left: 180 },
    //         width = 350,
    //         height = 350,
    //         container = options.container,
    //         startColor = options.start_color,
    //         endColor = options.end_color;
    //
    //     // Find our max and min values
    //     const maxValue = d3.max(data, (layer) => {
    //         return d3.max(layer, (d) => {
    //             return d;
    //         });
    //     });
    //     const minValue = d3.min(data, (layer) => {
    //         return d3.min(layer, (d) => {
    //             return d;
    //         });
    //     });
    //
    //     const numrows = data.length;
    //     // assume all subarrays have same length
    //     const numcols = data[0].length;
    //
    //     // Create the SVG container
    //     const svg = d3
    //         .select(container)
    //         .append("svg")
    //         .attr("width", width + margin.left + margin.right)
    //         .attr("height", height + margin.top + margin.bottom)
    //         .append("g")
    //         .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
    //
    //     // Add a background to the SVG
    //     const background = svg
    //         .append("rect")
    //         .style("stroke", "black")
    //         .attr("width", width)
    //         .attr("height", height);
    //
    //     // Build some scales for us to use
    //     const x = d3.scale.ordinal().domain(d3.range(numcols)).rangeBands([0, width]);
    //
    //     const y = d3.scale
    //         .ordinal()
    //         .domain(d3.range(numrows))
    //         .rangeBands([0, height]);
    //
    //     // This scale in particular will
    //     // scale our colors from the start
    //     // color to the end color.
    //     const colorMap = d3.scale
    //         .linear()
    //         .domain([minValue, maxValue])
    //         .range([startColor, endColor]);
    //
    //     // Generate rows and columns and add
    //     // color fills.
    //     const row = svg
    //         .selectAll(".row")
    //         .data(data)
    //         .enter()
    //         .append("g")
    //         .attr("class", "row")
    //         .attr("transform", (d, i) => {
    //             return "translate(0," + y(i) + ")";
    //         });
    //
    //     var tooltip = d3.select(container)
    //         .append("div")
    //         .style("opacity", 0)
    //         .attr("class", "tooltip")
    //         .style("background-color", "white")
    //         .style("border", "solid")
    //         .style("border-width", "2px")
    //         .style("border-radius", "5px")
    //         .style("padding", "5px")
    //
    //     // Three function that change the tooltip when user hover / move / leave a cell
    //     var mouseover = function(d) {
    //         tooltip
    //             .style("opacity", 1)
    //         d3.select(this)
    //             .style("stroke", "black")
    //             .style("opacity", 1)
    //     }
    //     var mousemove = function(d) {
    //         tooltip
    //             .html("The exact value of<br>this cell is: " + d.value)
    //             .style("left", (d3.mouse(this)[0]+70) + "px")
    //             .style("top", (d3.mouse(this)[1]) + "px")
    //     }
    //     var mouseleave = function(d, i, h) {
    //         console.log(d, i, h)
    //         tooltip
    //             .style("opacity", 0)
    //         d3.select(this)
    //             .style("stroke", "none")
    //             .style("opacity", 0.8)
    //     }
    //
    //     const cell = row
    //         .selectAll(".cell")
    //         .data((d) => {
    //             return d;
    //         })
    //         .enter()
    //         .append("g")
    //         .attr("data-x", (d, i) => {
    //             return x(i);
    //         })
    //         .attr("data-y", (d) => {
    //             return y(d);
    //         })
    //         .attr("class", "cell")
    //         .attr("transform", (d, i) => {
    //             return "translate(" + x(i) + ", 0)";
    //         })
    //         .on("mouseover", mouseover)
    //         .on("mousemove", mousemove)
    //         .on("mouseleave", mouseleave);
    //
    //     cell
    //         .append("rect")
    //         .attr("width", x.rangeBand() - 0.3)
    //         .attr("height", y.rangeBand() - 0.3);
    //
    //     row
    //         .selectAll(".cell")
    //         .data((d, i) => {
    //             return data[i];
    //         })
    //         .style("fill", colorMap);
    //
    //     const labels = svg.append("g").attr("class", "labels");
    //
    //     const columnLabels = labels
    //         .selectAll(".column-label")
    //         .data(columnLabelsData)
    //         .enter()
    //         .append("g")
    //         .attr("class", "column-label")
    //         .attr("transform", (d, i) => {
    //             return "translate(" + x(i) + "," + height + ")";
    //         });
    //
    //     columnLabels
    //         .append("line")
    //         .style("stroke", "black")
    //         .style("stroke-width", "1px")
    //         .attr("x1", x.rangeBand() / 2)
    //         .attr("x2", x.rangeBand() / 2)
    //         .attr("y1", 0)
    //         .attr("y2", 5);
    //
    //     columnLabels
    //         .append("text")
    //         .attr("x", 0)
    //         .attr("y", y.rangeBand() / 2 + 20)
    //         .attr("dy", ".82em")
    //         .attr("text-anchor", "end")
    //         .attr("transform", "rotate(-60)")
    //         .text((d, i) => {
    //             return d;
    //         });
    //
    //     const rowLabels = labels
    //         .selectAll(".row-label")
    //         .data(rowLabelsData)
    //         .enter()
    //         .append("g")
    //         .attr("class", "row-label")
    //         .attr("transform", (d, i) => {
    //             return "translate(" + 0 + "," + y(i) + ")";
    //         });
    //
    //     rowLabels
    //         .append("line")
    //         .style("stroke", "black")
    //         .style("stroke-width", "1px")
    //         .attr("x1", 0)
    //         .attr("x2", -5)
    //         .attr("y1", y.rangeBand() / 2)
    //         .attr("y2", y.rangeBand() / 2);
    //
    //     rowLabels
    //         .append("text")
    //         .attr("x", -8)
    //         .attr("y", y.rangeBand() / 2)
    //         .attr("dy", ".32em")
    //         .attr("text-anchor", "end")
    //         .text((d, i) => {
    //             return d;
    //         });
    // }
    //
    // Matrix({
    //     container: "#container",
    //     start_color: "#FC7C89",
    //     end_color: "#21A38B",
    // });
    //
    // document.ad
</script>
