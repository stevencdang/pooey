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
    public function form() {
	$out .= '<form action="index.php" method="post">'."\n";
	$out .= "<div><h1>Assigment Activity Form</h1></div>";
	$out .= '<div style="background:#FFFFCC;min-height:50px;width:100%;padding:10px;">';
	$out .= '<h3 style="display:inline-block;margin-right:50px;">Select Assignment:</h3>';
	$out .= '<select name="assignment">';
	$out .= '<option value="test" selected>test</option>';
	$out .= '</select>';
	$out .= '</div>';
	$out .= '<input type="submit" value="'.get_string('view').'" />';
	$out .= '</form>';
	return $out;	
    }

    /**
     * Render the activity chart
     *
     * @param 
     * @return string
     */
    public function test() {
	$out .= "<div><h1>Testing</h1></div>";
	$out .= '<h2>Test content</h2>';
	return $out;	
    }

}
