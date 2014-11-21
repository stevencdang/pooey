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

$PAGE->requires->js('/report/assignmentactivity/d3.min.js');

$id          = optional_param('id', 0, PARAM_INT);// Course ID.
$modid       = optional_param('modid', 0, PARAM_ALPHANUMEXT); // Module id or 'site_errors'.

$params = array();
if ($id !== 0) {
    $params['id'] = $id;
}
if ($modid !== 0) {
    $params['modid'] = $modid;
}

$url = new moodle_url("/report/assignmentactivity/index.php", $params);

$PAGE->set_url('/report/assignmentactivity/index.php', array('id' => $id));
$PAGE->set_pagelayout('report');
$PAGE->set_title(get_string('pluginname', 'report_assignmentactivity').$displaycoursename);
$PAGE->set_heading(get_string('pluginname', 'report_assignmentactivity').$displaycoursename);

echo $OUTPUT->header();

// Get course details.
$course = null;
if ($id) {
    $course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);
    // require_login($course);
    require_login();
    $context = context_course::instance($course->id);
} else {
    require_login();
    $context = context_system::instance();
    $PAGE->set_context($context);
}

// require_capability('report/assignmentactivity:view', $context);

echo '<form action="index.php" method="post">'."\n";
echo "<div><h1>Testing</h1></div>";
echo '</form>';

echo $OUTPUT->footer();

