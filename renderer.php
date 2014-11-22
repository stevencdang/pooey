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
    public function form(array $assignments) {
	$out = '<form id="asgnmnt-form" action="index.php" method="get">'."\n";
	$out .= "<div><h1>Assigment Activity Form</h1></div>";
	$out .= '<div style="background:#FFFFCC;min-height:50px;width:100%;margin-bottom:15px;padding:10px;">';
	$out .= '<h3 style="display:inline-block;margin-right:50px;">Select Assignment:</h3>';
	$out .= '<select name="assignment">';
	foreach ($assignments as $assignment) {
		$out .= '<option value="'.$assignment.'">'.$assignment.'</option>';
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
    public function chart(array $assignData) {

		$out = '<script> var assignData = ';
		$out .= json_encode($assignData);
		$out .= '; </script>';

		$out .= '<div><h1 class="chart-title">Student Assignments Chart</h1>';

		$out .= '</div>';
		$out .= '<div id="asgn-chart" style="background:#eee;width:500px;padding:10px;">';
		
		$out .= '<style>

		.chart rect {
		  fill: steelblue;
		}

		.chart text {
		  fill: white;
		  font: 10px sans-serif;
		  text-anchor: end;
		}</style>';

		$out .= '<svg class="chart" width="500"></svg>';
		//   <g transform="translate(0,0)">
		//     <rect width="40" height="19"></rect>
		//     <text x="37" y="9.5" dy=".35em">4</text>
		//   </g>
		//   <g transform="translate(0,20)">
		//     <rect width="80" height="19"></rect>
		//     <text x="77" y="9.5" dy=".35em">8</text>
		//   </g>
		//   <g transform="translate(0,40)">
		//     <rect width="150" height="19"></rect>
		//     <text x="147" y="9.5" dy=".35em">15</text>
		//   </g>
		//   <g transform="translate(0,60)">
		//     <rect width="160" height="19"></rect>
		//     <text x="157" y="9.5" dy=".35em">16</text>
		//   </g>
		//   <g transform="translate(0,80)">
		//     <rect width="230" height="19"></rect>
		//     <text x="227" y="9.5" dy=".35em">23</text>
		//   </g>
		//   <g transform="translate(0,100)">
		//     <rect width="420" height="19"></rect>
		//     <text x="417" y="9.5" dy=".35em">42</text>
		//   </g>
		// </svg>';

		$out .= '</div>';
		return $out;	
    }

}
