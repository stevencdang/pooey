M.report_assignmentactivity = {};


window.onload = function() {

	var users = [];
	var submittedTimes = [];
	for (var key in studentData) {
		var subRow = studentData[key];
		submittedTimes.push(new Date(parseInt(subRow["timemodified"])*1000));
		users.push(subRow["nicename"]);
	}

	var margin = {top: 15, right: 20, bottom: 30, left: 20};
	var width = 500 - margin.left - margin.right,
	    barHeight = 20,
	    height = (barHeight * submittedTimes.length);
	
	var minTime = new Date(createTime*1000);
	var maxTime = new Date(deadline*1000);

	var x = d3.time.scale()
	    .domain([minTime, maxTime])
	    .range([0, width]);

	var chart = d3.select(".chart")
	    .attr("width", width + margin.left + margin.right)
	    .attr("height", height + margin.top + margin.bottom);

	var bar = chart.selectAll("g")
	    .data(submittedTimes)
	  .enter().append("g")
	    .attr("transform", function(d, i) { 
	    	return "translate(" + (margin.left) + "," + (i * barHeight + margin.top) + ")"; 
	    });

	bar.append("rect")
	    .attr("width", x)
	    .attr("height", barHeight - 1)
	    .style("fill", "steelblue");

	bar.append("text")
	    .attr("x", function(d) { return x(d) - 3; })
	    .attr("y", barHeight / 2)
	    .attr("dy", ".35em")
	    .style("text-anchor", "end")
	    .style("font", "10px sans-serif")
	    .style("fill", "white")
	    .text(function(d, i) { return users[i]; });	    

	var xAxis = d3.svg.axis()
	    .scale(x)
	    .orient("bottom")
	    .ticks(8);

	// x-axis label
	chart.append("g")
	    .attr("class", "x axis")
	    .attr("transform", "translate(" + margin.left + "," + (margin.top + height) + ")")
	    .call(xAxis);

	chart.append("g")
		    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");
}


M.report_assignmentactivity.init = function(Y) {
  console.log('heyo');

	$("#asgnmnt-form").submit(function (e) {
		var assignment = $("select[name='assignment']").val();
		console.log("assignment: " + assignment);
		return;
	});
};


