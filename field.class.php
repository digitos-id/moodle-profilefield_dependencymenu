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
 * Dependency menu profile field definition.
 *
 * @package    profilefield_dependencymenu
 * @copyright  2016 onwards Antonello Moro {@link http://treagles.it}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class profile_field_dependencymenu
 *
 * @copyright  2016 onwards Antonello Moro {@link http://treagles.it}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class profile_field_dependencymenu extends profile_field_base {

    /** @var array $options */
    public $options;

    /** @var int $datakey */
    public $datakey;

    /** @var  array @calls array indexed by @fieldid-$userid. It keeps track of recordset,
     * so that we don't do the query twice for the same field */
    private static $acalls = array();

    /** @var array JavaScript YUI3 Module definition */
//    protected static $jsmodule = array(
//        'name' => 'user_selector',
//        'fullpath' => '/user/profile/field/dependencymenu/assets/modulex.js',
//        'requires' => array('node', 'event-custom', 'datasource', 'json', 'moodle-core-notification', 'core/first', 'jquery', 'jqueryui', 'core/ajax'),
//        'strings' => array(
//            array('previouslyselectedusers', 'moodle', '%%SEARCHTERM%%'),
//            array('nomatchingusers', 'moodle', '%%SEARCHTERM%%'),
//            array('none', 'moodle')
//    ));

    /**
     * Constructor method.
     *
     * Pulls out the options for the menu from the database and sets the the corresponding key for the data if it exists.
     *
     * @param int $fieldid
     * @param int $userid
     */
    public function __construct($fieldid = 0, $userid = 0) {
        // First call parent constructor.
        parent::__construct($fieldid, $userid);
        // Only if we actually need data.
        if ($fieldid !== 0 && $userid !== 0) {
            $mykey = $fieldid . ',' . $userid; // It will always work because they are number, so no chance of ambiguity.
            if (array_key_exists($mykey, self::$acalls)) {
                $rs = self::$acalls[$mykey];
            } else {
                $sql = $this->field->param1;
//                $sql = $this->field->param1 . ' WHERE ';
                global $DB;

//                $sqlp = 'SELECT uif.*, uic.name AS categoryname ';
//                if ($userid > 0) {
//                    $sqlp .= ', uind.id AS hasuserdata, uind.data, uind.dataformat ';
//                }
//                $sqlp .= 'FROM {user_info_field} uif ';
//                $sqlp .= 'LEFT JOIN {user_info_category} uic ON uif.categoryid = uic.id ';
//                if ($userid > 0) {
//                    $sqlp .= 'LEFT JOIN {user_info_data} uind ON uif.id = uind.fieldid AND uind.userid = :userid ';
//                }
//                $sqlp .= 'WHERE uif.shortname = :shortname ORDER BY uic.sortorder ASC, uif.sortorder ASC ';
//                $fields = $DB->get_records_sql($sqlp, ['userid' => $userid, 'shortname' => $this->field->param2]);
//
//                if (!empty($fields)) {
//                    foreach ($fields as $field) {
//                        if (!empty($field->data)) {
//                            $sql .= $this->field->param3 . " = '" . $field->data . "'";
//                        } else {
//                            $sqlpp = $field->param1;
//                            $rsps = $DB->get_records_sql($sqlpp);
//                            if (!empty($rsps)) {
//                                foreach ($rsps as $rsp) {
//                                    $sql .= $this->field->param3 . " = '" . $rsp->id . "'";
//                                    break;
//                                }
//                            } else {
//                                $sql .= '0 = 1';
//                            }
//                        }
//                        break;
//                    }
//
////                    print_r($fields);
////                    exit;
//                } else {
//                    $sql .= '0 = 1';
////                    print_r('kosong');
////                    exit;
//                }

                $rs = $DB->get_records_sql($sql);
                self::$acalls[$mykey] = $rs;
            }
            $this->options = array();
            if ($this->field->required) {
                $this->options[''] = get_string('choose') . '...';
            }
            foreach ($rs as $key => $option) {
                $this->options[format_string($key)] = format_string($option->data); // Multilang formatting.
            }

            // Set the data key.
            if ($this->data !== null) {
                $key = $this->data;
                if (isset($this->options[$key]) || ($key = array_search($key, $this->options)) !== false) {
                    $this->data = $key;
                    $this->datakey = $key;
                }
            }
        }
    }

    /**
     * Old syntax of class constructor. Deprecated in PHP7.
     *
     * @deprecated since Moodle 3.1
     */
    public function profile_field_dependencymenu($fieldid = 0, $userid = 0) {
        self::__construct($fieldid, $userid);
    }

    /**
     * Create the code snippet for this field instance
     * Overwrites the base class method
     * @param moodleform $mform Moodle form instance
     */
    public function edit_field_add($mform) {
        global $PAGE;

//        print_r($this->inputname); exit;
        $mform->addElement('select', $this->inputname, format_string($this->field->name), $this->options);
        $mform->setType($this->inputname, PARAM_TEXT);

        $ajax = "profile/field/dependencymenu/ajax.php";
        $PAGE->requires->js(new moodle_url('/user/profile/field/dependencymenu/assets/eb_settings.js'));
        $PAGE->requires->js_call_amd('local_edwiserbridge/eb_settings', 'init', [$ajax, $this->field->shortname, $this->field->param1, $this->field->param2, $this->field->param3, $this->field->data]);
    }

    /**
     * Set the default value for this field instance
     * Overwrites the base class method.
     * @param moodleform $mform Moodle form instance
     */
    public function edit_field_set_default($mform) {
        $key = $this->field->defaultdata;
        if (isset($this->options[$key]) || ($key = array_search($key, $this->options)) !== false) {
            $defaultkey = $key;
        } else {
            $defaultkey = '';
        }
        $mform->setDefault($this->inputname, $defaultkey);
    }

    /**
     * The data from the form returns the key.
     *
     * This should be converted to the respective option string to be saved in database
     * Overwrites base class accessor method.
     *
     * @param mixed $data The key returned from the select input in the form
     * @param stdClass $datarecord The object that will be used to save the record
     * @return mixed Data or null
     */
    public function edit_save_data_preprocess($data, $datarecord) {
        return isset($this->options[$data]) ? $data : null;
    }

    /**
     * When passing the user object to the form class for the edit profile page
     * we should load the key for the saved data
     *
     * Overwrites the base class method.
     *
     * @param stdClass $user User object.
     */
    public function edit_load_user_data($user) {
        $user->{$this->inputname} = $this->datakey;
    }

    /**
     * HardFreeze the field if locked.
     * @param moodleform $mform instance of the moodleform class
     */
    public function edit_field_set_locked($mform) {
        if (!$mform->elementExists($this->inputname)) {
            return;
        }
        if ($this->is_locked() and!has_capability('moodle/user:update', context_system::instance())) {
            $mform->hardFreeze($this->inputname);
            $mform->setConstant($this->inputname, format_string($this->datakey));
        }
    }

    /**
     * Convert external data (csv file) from value to key for processing later by edit_save_data_preprocess
     *
     * @param string $value one of the values in menu options.
     * @return int options key for the menu
     */
    public function convert_external_data($value) {
        if (isset($this->options[$value])) {
            $retval = $value;
        } else {
            $retval = array_search($value, $this->options);
        }

        // If value is not found in options then return null, so that it can be handled
        // later by edit_save_data_preprocess.
        if ($retval === false) {
            $retval = null;
        }
        return $retval;
    }

    /**
     * Display the data for this field.
     */
    public function display_data() {
        $sql = $this->field->param1;
        global $DB;
        $rs = $DB->get_records_sql($sql);
        if (array_key_exists($this->datakey, $rs)) {
            return $rs[$this->datakey]->data;
        } else {
            return 'N/A';
        }
    }

}
