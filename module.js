M.report_assignmentactivity = {};

M.report_assignmentactivity.init = function(Y) {
   	
	$("#asgnmnt-form").submit(function (e) {
		var assignment = $("select[name='assignment']").val();
		console.log("assignment: " + assignment);
	});
};

//M.report_assignmentactivity.graphStudents = function(

