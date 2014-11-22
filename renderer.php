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
 * HTML rendering methods are defined here
 *
 * @package     report_assignmentactivity
 * @category    output
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Assignment Activity Renderer
 */
class report_assignmentactivity_renderer extends plugin_renderer_base {
    /**
     * Render the assignment selection form
     *
     * @param 
     * @return string
     */
    public function form($assignments, $id) {
		$out = '<form id="asgnmnt-form" action="index.php" method="get">'."\n";
		$out .= "<div><h1>Assigment Activity Form</h1></div>";
		$out .= '<div style="background:#FFFFCC;min-height:50px;width:100%;margin-bottom:15px;padding:10px;">';
		$out .= '<h3 style="display:inline-block;margin-right:50px;">Select Assignment:</h3>';
		$out .= '<input name="id" value="'.$id.'" hidden>';
		$out .= '<select name="assignment">';
		foreach ($assignments as $assignment) {
			$out .= '<option value="'.($assignment->id).'">'.($assignment->name).'</option>';
		}
		$out .= '</select>';
		$out .= '</div>';
		$out .= '<input type="submit" value="'.get_string('view').'" />';
		$out .= '</form>';


		$out .= '<script src="module.js"></script>';
		return $out;	
    }

    /**
     * Render the activity chart
     *
     * @param 
     * @return string
     */
    public function chart($assignData, $createTime, $studentData, $deadline) {

		$out = '<script>';
		$out .= 'var assignData = ' . json_encode($assignData) . ';';
		$out .= 'var createTime = ' . json_encode($createTime) . ';';
		$out .= 'var studentData = ' . json_encode($studentData) . ';';
		$out .= 'var deadline = ' . json_encode($deadline) . ';';
		$out .= '</script>';
	
		$out .= '<div><h1 class="chart-title">Student Assignments Turn In Times</h1>';
		// // Test code to view all data given in studentData
		// foreach ($studentData as $data) {
		// 	$out .= '<h2>'.$data->id.' '.$data->firstname.' '.$data->lastname.': '.
		// 		$data->timemodified.'</h2>';
		// }

		$out .= '</div>';
		$out .= '<div id="asgn-chart" style="background:#eee;width:500px;padding:10px;">';
		
		$out .= '<style>

		.axis text {
		  font: 10px sans-serif;
		}

		.dot {
		  stroke: #000;
		}

		.axis path,
		.axis line {
		  fill: none;
		  stroke: #000;
		  shape-rendering: crispEdges;
		}

		.chart rect {
		  fill: steelblue;
		}

		.chart text {
		  fill: white;
		  font: 10px sans-serif;
		  text-anchor: end;
		}

		.tick text {
		  fill: black;
		}

		</style>';

		$out .= '<svg class="chart" width="500"></svg>';

		$out .= '</div>';
		return $out;	
    }

}
