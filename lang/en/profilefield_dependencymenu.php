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
 * Strings for component 'profilefield_dependencymenu', language 'en'
 *
 * @package   profilefield_dependencymenu
 * @copyright 2022 - Prihantoosa {@link https://digitos.id}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Dropdown dependency menu';

$string['queryerrorfalse'] = "Error executing the query: return value is false";
$string['queryerrorempty'] = "No results found executing the query: cannnot validate";
$string['queryerroridmissing'] = 'id column is missing in query return values';
$string['queryerrordatamissing'] = 'data column is missing in query return values';
$string['queryerrordefaultmissing'] = 'Default value does not exists among the list of allowed values';
$string['sqlquery'] = 'Sql query';
$string['numbersqlvalues'] = 'Number of possible values';
$string['samplesqlvalues'] = 'Sample of possible values';
$string['sqlerror'] = 'Error executing the query';
$string['dependencymenu:caneditsql'] = 'Can edit sql query for dependency menu user custom field';
$string['param1sqlhelp'] = 'Sql query';
$string['param1sqlhelp_help'] = 'The query should return two column: data and id. Furthermore, it should return at least one value. Example: "select 1 id, \'hallo\' data"';