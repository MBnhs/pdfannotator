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
 * The purpose of this script is to collect the output data for the statistic template and
 * make it available to the renderer. The data is collected via the statistic model and then processed.
 * Therefore, class statistic can be seen as a view controller.
 *
 * @package   mod_pdfannotator
 * @copyright 2018 RWTH Aachen (see README.md)
 * @author    Friederike Schwager
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_pdfannotator\output;

use pdfannotator_readings;

defined('MOODLE_INTERNAL') || die();

/**
 * The purpose of this script is to collect the output data for the template and
 * make it available to the renderer.
 */
class readings implements \renderable, \templatable {

    private $tabledata;

    /**
     * Constructor of renderable for statistics tab.
     * @param int $annotatorid Id of the annotator
     * @param int $courseid ID of the course
     * @param object $capabilities Some of the capabilities the user has-
     * @param int $id Course module id
     */
    public function __construct() {
        global $USER, $PAGE;
        

        $readings = new pdfannotator_readings();

        $this->tabledata = $readings->get_tabledata();

        
    }

    /**
     * This function is required by any renderer to retrieve the data structure
     * passed into the template.
     * @param \renderer_base $output
     * @return type
     */
    public function export_for_template(\renderer_base $output) {

        $data = [];
        
        $data['tabledata'] = $this->tabledata;

        return $data;
    }

}
