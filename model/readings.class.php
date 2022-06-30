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
 * @package   mod_pdfannotator
 * @copyright 2018 RWTH Aachen (see README.md)
 * @author    Friederike Schwager
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */
defined('MOODLE_INTERNAL') || die();

/**
 * This class contains functions returning the data for the statistics-tab
 */
class pdfannotator_readings {

    

    public function __construct() {
        
    }

    public function get_readings() {
        global $DB;
        $DB->get_records('pdfannotator_readings', null, 'id ASC');
    }

    /**
     * Returns the data for the tabl in the statistics-tab
     * @return array
     */
    public function get_tabledata() {
        $ret = [];

        

        
        $ret[] = array('row' => array($this->get_readings()));
        

        return $ret;
    }

    /*
    public static function create_reading($documentid) {

        global $DB;
        global $USER;
        $datarecord = new stdClass();
        $datarecord->userid = $USER->id;
        $datarecord->pdfannotatorid = $documentid;

        $date = new DateTime();
        $datarecord->start = $date->getTimestamp();
        $datarecord->end = '';
        
        
        
        $readingid = $DB->insert_record('pdfannotator_readings', $datarecord, $returnid = true);
        return $readingid;
    }
*/

/*

$_SESSION["readingid"]
$_SESSION["readingid"]
$_SESSION["readingid"]
$_SESSION["readingid"]
*/
    public static function update($readingId) {
        global $DB, $USER;

        $date = new DateTime();

        $reading = $DB->get_record('pdfannotator_readings', ['id' => $readingId]);
        if ($reading) {

            $reading->end = $date->getTimestamp();
            $success = $DB->update_record('pdfannotator_readings', $reading);
            
        } else {
            $success = false;
        }

        if ($success) {
            $result = array('status' => 'success', 'timemoved' => $time);
            // if ($reading->userid != $USER->id) {
            //     $result['movedby'] = pdfannotator_get_username($USER->id);
            // }
            return $result;
        } else {
            return ['status' => 'error'];
        }
    }

}
