M.report_assignmentactivity = {};


window.onload = function() {

	console.log("onload");

	var users = [];
	var viewedTimes = [];
	var submittedTimes = [];
	var timeLengths = [];
	var row;
	for (var i = 0; i < assignData.length; i++) {
		row = assignData[i];
		users.push(row['username']);
		viewedTimes.push(row['time_viewed']);
		submittedTimes.push(row['time_submitted']);
		timeLengths.push(row['time_submitted'] - row['time_viewed']); 
	};

	var data = [4, 8, 15, 16, 23, 42];

	var margin = {top: 15, right: 20, bottom: 30, left: 20};
	var width = 500 - margin.left - margin.right,
	    barHeight = 20,
	    height = (barHeight * timeLengths.length);

	var minTime = 0;
	
	var timeOffsets = [];
	var timeFinals = [];
	var firstSubTime = d3.min(submittedTimes);
	for (var i = 0; i < assignData.length; i++) {
		var offset = submittedTimes[i] - firstSubTime;
		timeOffsets.push(offset);
		timeFinals.push(timeLengths[i] + offset);
	}
	
	var maxTime = d3.max(timeFinals);
	var timePerPx = (maxTime - minTime)/width;
	console.log(timeOffsets, timePerPx);

	var x = d3.scale.linear()
	    .domain([minTime, maxTime])
	    .range([0, width]);

	var chart = d3.select(".chart")
	    .attr("width", width + margin.left + margin.right)
	    .attr("height", height + margin.top + margin.bottom);

	var bar = chart.selectAll("g")
	    .data(timeLengths)
	  .enter().append("g")
	    .attr("transform", function(d, i) { 
	    	return "translate(" + (margin.left + timeOffsets[i]/timePerPx) + "," + (i * barHeight + margin.top) + ")"; 
	    });

	bar.append("rect")
	    .attr("width", x)
	    .attr("height", barHeight - 1)
	    .style("fill", "steelblue");

	bar.append("text")
	    .attr("x", function(d) { console.log(x(d)); return x(d) - 3; })
	    .attr("y", barHeight / 2)
	    .attr("dy", ".35em")
	    .style("text-anchor", "end")
	    .style("font", "10px sans-serif")
	    .style("fill", "white")
	    .text(function(d, i) { return users[i]; });	    

	var xAxis = d3.svg.axis()
	    .scale(x)
	    .orient("bottom");

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

//M.report_assignmentactivity.graphStudents = function(

