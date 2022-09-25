@props([
    'matrix' => []
])

<div style="position: relative">
  <img src="/canvas/1.png" style="position:absolute;top:0;left:0;z-index:1; height: 390px; width: 390px; margin: 30px" />
  <div id="my_dataviz" style="position:relative;z-index:5;opacity: 70%"></div>
</div>

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
</script>
