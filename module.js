M.report_assignmentactivity = {};

// times are in seconds since epoch, as is stored in the Moodle database
// var assignData = [
// 	{'username': 'erik', 'time_viewed': 1416674429, 'time_submitted': 1416774429},
// 	{'username': 'david', 'time_viewed': 1416675429, 'time_submitted': 1416799429}
// ];

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

	var width = 500,
	    barHeight = 20;

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
	    .attr("width", width)
	    .attr("height", barHeight * timeLengths.length);

	var bar = chart.selectAll("g")
	    .data(timeLengths)
	  .enter().append("g")
	    .attr("transform", function(d, i) { 
	    	return "translate(" + (timeOffsets[i]/timePerPx) + "," + i * barHeight + ")"; 
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

