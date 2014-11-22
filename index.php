<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Displays different views of the logs.
 *
 * @package    report_assignmentactivity
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/report/assignmentactivity/locallib.php');

$PAGE->requires->jquery();
$PAGE->requires->js('/report/assignmentactivity/d3.min.js');
$PAGE->requires->js('/report/assignmentactivity/module.js');

$id          = optional_param('id', 0, PARAM_INT);// Course ID.
$modid       = optional_param('modid', 0, PARAM_ALPHANUMEXT); // Module id or 'site_errors'.
$assignment  = optional_param('assignment', 0, PARAM_ALPHANUMEXT); //Assignment id

$params = array();
if ($id !== 0) {
    $params['id'] = $id;
}
if ($modid !== 0) {
    $params['modid'] = $modid;
}
if ($assignment !== 0) {
    $params['assignment'] = $assignment;
}


// Get course details.
$course = NULL;
if ($id) {
    $course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
    require_login($course);
    // require_login();
    $context = context_course::instance($course->id);
    $PAGE->set_context($context);
} else {
    require_login();
    $context = context_system::instance();
    $PAGE->set_context($context);
}

require_capability('report/assignmentactivity:view', $context);

$url = new moodle_url("/report/assignmentactivity/index.php", $params);

$PAGE->set_url('/report/assignmentactivity/index.php', array('id' => $id));
$PAGE->set_pagelayout('report');
$PAGE->set_title(get_string('pluginname', 'report_assignmentactivity'));
$PAGE->set_heading(get_string('pluginname', 'report_assignmentactivity'));
$content = $PAGE->get_renderer('report_assignmentactivity');

echo $OUTPUT->header();

//Get list of assignments
////////////// Fake Assignment INfo ////////////////////////

$allasgn = array();
if (!$allasgn = $DB->get_records('assign', array('course'=>$id))) {
	$allasgn = array(
		array("id"=>1, "name"=>"Test assignment1"),
		array("id"=>2, "name"=>"Test assignment2"),
		array("id"=>3, "name"=>"Test assignment3"),
	);
}


//Render Form
echo $content->form($allasgn, $id);

//Get chart data if assignment was selected
$subTimes = null; 
$deadline = null; 
$createTime = null;
if ($assignment !== 0) {
	//$createTime = $DB->get_record('assign', array('id'=>$assignment))->allowsubmissionsfromdate;
	$createTime = 1416674429;
	//$deadline = $DB->get_record('assign', array('id'=>$assignment))->duedate;
	$deadline = 1416802429;
	$subTimes = $DB->get_records('assign_submission', array('assignment'=>$assignment));
	$assignData = array(
		(object) array('username' => 'erik', 'time_viewed' => 1416674429, 'time_submitted' => 1416774429, 'grade' => 90),
		(object) array('username' => 'david', 'time_viewed' => 1416675429, 'time_submitted' => 1416799429, 'grade' => 87)
	);
}

////////////////////// Insert the assignments chart ///////////////////

function debug_to_console($data) {
    if(is_array($data) || is_object($data))
    {
        echo("<script>console.log('PHP: ".json_encode($data)."');</script>");
    } else {
        echo("<script>console.log('PHP: ".$data."');</script>");
    }
}

if (is_null($subTimes)) {
	echo "<h1>Not building chart</h1>";
} else {
	debug_to_console($assignData);
	debug_to_console(array($createTime, $subTimes, $deadline));
	echo $content->chart($assignData, $createTime, $subTimes, $deadline);
}


$PAGE->requires->js_init_call('M.report_assignmentactivity.init');

echo $OUTPUT->footer();


