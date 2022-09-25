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
 * This plugin provides access to Moodle data in form of analytics and reports in real time.
 *
 *
 * @package    local_intelliboard
 * @copyright  2017 IntelliBoard, Inc
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @website    https://intelliboard.net/
 */
//defined('MOODLE_INTERNAL') || die();
//$plugin->version   = 2017021201;        // The current plugin version (Date: YYYYMMDDXX).
//$plugin->requires  = 2015011000;        // Requires this Moodle version.
//$plugin->component = 'profilefield_dependencymenu'; // Full name of the plugin (used for diagnostics).
//$plugin->maturity = MATURITY_STABLE;
//$plugin->release   = 'dependencymenu_v1.1';

define('AJAX_SCRIPT', true);

require('../../../../config.php');

//$data = '<option value=""></option>';
//echo $data;
//exit;
//die(json_encode($data));
$data = array();
$data[0]['id'] = 0;
$data[0]['data'] = 'data0';
$data[1]['id'] = 1;
$data[1]['data'] = 'data1';
//die(json_encode($data));
//$age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

$id = optional_param('id', '', PARAM_TEXT);
$param1 = optional_param('param1', '', PARAM_TEXT);
$param3 = optional_param('param3', '', PARAM_TEXT);

$sql = "$param1 where $param3 = '$id'";
$menus = $DB->get_records_sql($sql);
//$sql = ":param1 WHERE :param3 = :cmid";
//$menus = $DB->get_records_sql($sql, ['param1' => $param1, 'param3' => $param3, 'cmid' => $id]);

echo json_encode(array_values($menus));
exit;
//return $data;
////require_once($CFG->dirroot . '/local/intelliboard/lib.php');
////require_once($CFG->dirroot . '/local/intelliboard/locallib.php');
//
////$action = optional_param('action', '', PARAM_TEXT);
//
//if (!isloggedin() or isguestuser()) {
//    return false;
//}
//require_login();
//
//$PAGE->set_context(context_system::instance());
//
//$data = '<option value=""></option>';
//echo $data;
//exit;
//
//if ($action == 'user_courses_list') {
//    $courses = enrol_get_users_courses($USER->id, true, 'id, fullname');
//
//    $html = '<option value="">' . get_string('courses') . '</option>';
//    foreach ($courses as $course) {
//        $html .= '<option value="' . $course->id . '">' . format_string($course->fullname) . '</option>';
//    }
//    die($html);
//} elseif ($action == 'course_users') {
//    $courseid = optional_param('courseid', 1, PARAM_INT);
//    $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
//    $context = context_course::instance($course->id, MUST_EXIST);
//    if ($course->id == SITEID) {
//        throw new moodle_exception('invalidcourse');
//    }
//    require_capability('moodle/course:enrolreview', $context);
//    $users = get_enrolled_users($context, '', 0);
//
//    $html = '<option value="">' . get_string('users') . '</option>';
//    foreach ($users as $user) {
//        $html .= '<option value="' . $user->id . '">' . fullname($user) . '</option>';
//    }
//    die($html);
//} elseif ($action == 'user_course_quizes_list') {
//    $courseid = optional_param('courseid', 0, PARAM_INT);
//    $course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
//    $params = array('userid' => $USER->id, 'courseid' => $courseid);
//    $quizes = $DB->get_records_sql("SELECT q.id, q.name
//					FROM {quiz} q, {quiz_attempts} qa
//					WHERE qa.userid = :userid AND q.id = qa.quiz AND q.course = :courseid
//					GROUP BY q.id ORDER BY q.name ASC", $params);
//
//    $html = '<option value="">' . get_string('quizzes') . '</option>';
//    foreach ($quizes as $quiz) {
//        $html .= '<option value="' . $quiz->id . '">' . s($quiz->name) . '</option>';
//    }
//    die($html);
//} elseif ($action == 'user_fields') {
//    $custom = optional_param('custom', 0, PARAM_INT);
//    $items = $DB->get_records("user_info_field", array(), "name ASC", "id, name");
//    $html = '<option value=""></option>';
//    foreach ($items as $item) {
//        $html .= '<option value="' . $item->id . '" ' . (($custom == $item->id) ? "selected=selected" : "") . '>' . s($item->name) . '</option>';
//    }
//    die($html);
//} elseif ($action == 'cm_completions') {
//    $id = optional_param('id', 0, PARAM_INT);
//    $timestart = optional_param('timestart', 0, PARAM_INT);
//    $timefinish = optional_param('timefinish', 0, PARAM_INT);
//    $cm = $DB->get_record('course_modules', array('id' => $id), '*', MUST_EXIST);
//    $module = $DB->get_record('modules', array('id' => $cm->module), '*', MUST_EXIST);
//    $instance = $DB->get_record($module->name, array('id' => $cm->instance), '*', MUST_EXIST);
//    $learner_roles = get_config('local_intelliboard', 'filter11');
//
//    //require_capability('moodle/course:manageactivities', context_module::instance($cm->id));
//
//    require_once($CFG->dirroot . '/local/intelliboard/instructor/lib.php');
//
//    intelliboard_instructor_access();
//
//    $params = array(
//        'timestart' => $timestart,
//        'timefinish' => $timefinish,
//        'coursemoduleid' => $id,
//        'courseid' => $cm->course
//    );
//    list($rsql, $rparams) = $DB->get_in_or_equal(explode(",", $learner_roles), SQL_PARAMS_NAMED, 'e');
//    $rsql = ($rsql) ? " AND ra.roleid $rsql " : "";
//    $params = is_array($rparams) ? array_merge($params, $rparams) : $params;
//
//    $grade_single = intelliboard_grade_sql();
//
//    $items = $DB->get_records_sql("SELECT c.id, c.completionstate, c.timemodified, cm.id AS cmid, c.userid, u.firstname, u.lastname, u.email, $grade_single as grade, l.timespend as timespend, l.visits as visits
//		FROM {course_modules_completion} c
//			LEFT JOIN {course_modules} cm ON cm.id = c.coursemoduleid
//		    LEFT JOIN {modules} m ON m.id = cm.module
//			LEFT JOIN {user} u ON u.id = c.userid
//		    LEFT JOIN {grade_items} gi ON gi.itemtype = 'mod' AND gi.itemmodule = m.name AND gi.iteminstance = cm.instance AND gi.gradetype = 1
//			LEFT JOIN {grade_grades} g ON g.itemid = gi.id AND g.userid = u.id AND g.finalgrade IS NOT NULL
//			LEFT JOIN (SELECT userid, param, SUM(timespend) as timespend, SUM(visits) as visits FROM {local_intelliboard_tracking} WHERE page = 'module' GROUP BY userid, param) l ON l.param = cm.id AND l.userid = u.id
//
//		    WHERE c.coursemoduleid = :coursemoduleid AND c.userid IN (SELECT ra.userid FROM {role_assignments} AS ra JOIN {context} AS ctx ON ra.contextid = ctx.id WHERE c.timemodified BETWEEN :timestart AND :timefinish AND ctx.instanceid = :courseid $rsql)", $params);
//
//    $html = '<h2><span>' . get_string('x_completions', 'local_intelliboard', s($instance->name)) . '</span> <a class="btn" style="float: right; margin-top: 6px;" href="#" id="exportcsv">Export to csv</a></h2>';
//    $html .= '<table class="table table-hover table-striped" id="exportcsvtable">';
//    $html .= '<thead><tr>';
//    $html .= '<th>' . get_string('username') . '</th>';
//    $html .= '<th>' . get_string('email') . '</th>';
//    $html .= '<th>' . get_string('completion_status', 'local_intelliboard') . '</th>';
//    $html .= '<th>' . get_string('score', 'local_intelliboard') . '</th>';
//    $html .= '<th>' . get_string('time_spent', 'local_intelliboard') . '</th>';
//    $html .= '<th>' . get_string('visits', 'local_intelliboard') . '</th>';
//    $html .= '<th></th>';
//    $html .= '</tr></thead>';
//    foreach ($items as $item) {
//        $html .= '<tr>';
//        $html .= '<td><a target="_blank" href="' . $CFG->wwwroot . '/local/intelliboard/instructor/courses.php?search&action=learner&id=2&userid=' . $item->userid . '&cmid=' . $item->cmid . '">' . fullname($item) . '</td>';
//        $html .= '<td>' . $item->email . '</td>';
//
//        if ($item->completionstate == 1) {
//            $status = get_string('completed_on', 'local_intelliboard', date('m/d/Y', $item->timemodified));
//        } elseif ($item->completionstate == 2) {
//            $status = get_string('passed_on', 'local_intelliboard', date('m/d/Y', $item->timemodified));
//        } elseif ($item->completionstate == 3) {
//            $status = get_string('failed_on', 'local_intelliboard', date('m/d/Y', $item->timemodified));
//        } else {
//            $status = get_string('incomplete', 'local_intelliboard');
//        }
//
//        $html .= '<td>' . $status . '</td>';
//
//        $html .= '<td>' . round($item->grade, 2) . '</td>';
//        $html .= '<td>' . seconds_to_time($item->timespend) . '</td>';
//        $html .= '<td>' . $item->visits . '</td>';
//        $html .= '</tr>';
//    }
//    $html .= '</table>';
//    die($html);
//} elseif ($action == 'user_groups_list') {
//    $mode = optional_param('mode', 1, PARAM_INT);
//    if ($mode) {
//        $items = $DB->get_records("local_elisprogram_uset", array(), "name ASC", "id, name");
//    } else {
//        $items = $DB->get_records("cohort", array(), "name ASC", "id, name");
//    }
//    $html = '<option value=""></option>';
//    foreach ($items as $item) {
//        $html .= '<option value="' . $item->id . '">' . s($item->name) . '</option>';
//    }
//    die($html);
//} else {
//    $page = optional_param('page', '', PARAM_TEXT);
//    $param = optional_param('param', 0, PARAM_INT);
//    $time = optional_param('time', '', PARAM_INT);
//
//    if (!empty($page) && !empty($param) && !empty($time)) {
//        $trackingParams = [
//            'page' => $page,
//            'param' => $param,
//            'time' => $time,
//        ];
//        $result = local_intelliboard_insert_tracking(false, $trackingParams);
//    } else {
//        $result = local_intelliboard_insert_tracking(true);
//    }
//
//    die(json_encode($result));
//}
