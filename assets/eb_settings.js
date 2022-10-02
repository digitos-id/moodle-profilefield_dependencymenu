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
 * Js file to handle settings.
 *
 * @package     local_edwiserbridge
 * @copyright   2021 WisdmLabs (https://wisdmlabs.com/) <support@wisdmlabs.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author      Wisdmlabs
 */
"use strict";
define("local_edwiserbridge/eb_settings", [
    "jquery",
    "core/ajax",
    "core/url",
    "core/str",
], function ($, ajax, url, str) {
    function load_settings(ajaxUrl, param0, param1, param2, param3, valData) {
        var translation = str.get_strings([
            {key: "dailog_title", component: "local_edwiserbridge"},
            {key: "site_url", component: "local_edwiserbridge"},
            {key: "token", component: "local_edwiserbridge"},
            {key: "copy", component: "local_edwiserbridge"},
            {key: "copied", component: "local_edwiserbridge"},
            {key: "link", component: "local_edwiserbridge"},
            {key: "create", component: "local_edwiserbridge"},
            {key: "eb_empty_name_err", component: "local_edwiserbridge"},
            {key: "eb_empty_user_err", component: "local_edwiserbridge"},
            {key: "eb_service_select_err", component: "local_edwiserbridge"},
            {key: "click_to_copy", component: "local_edwiserbridge"},
            {key: "pop_up_info", component: "local_edwiserbridge"},
            {key: "eb_settings_msg", component: "local_edwiserbridge"},
            {key: "click_here", component: "local_edwiserbridge"},
                    // {key: 'manualsuccessuser', component: 'local_notifications'}
        ]);

        /*translation.then(function (results) {
         console.log(results);
         });*/

        $(document).ready(function () {
            var pertama = true;
            valData = $('#id_profile_field_' + param0).val();
//            alert('#id_profile_field_' + param0);

            $('#id_profile_field_' + param2).change(function () {
//                alert($('#id_profile_field_' + param2).val());
//                alert(param0);
                var selectedcourseid = $('#id_profile_field_' + param2).val();
                $.ajax({
                    type: "GET",
                    url: ajaxUrl,
                    data: {
                        'id': selectedcourseid,
                        'param1': param1,
                        'param3': param3,
                    },
//                    complete: function (response) {
//                        alert(response.length > 0);
//                        if (response.length > 0) {
//                            $('select#id_profile_field_' + param0).html(response);
//                            $('#id_profile_field_' + param0).select2("val", "''");
//                        }
//                    },
                    success: function (response) {
//                        alert('response');
                        $('#id_profile_field_' + param0).html('');
                        var data = JSON.parse(JSON.stringify(response));
//                        var data = decodeJson();
                        for (var i = 0; i < data.length; i++) {
                            $('<option/>').val(data[i].id).html(data[i].data).appendTo('#id_profile_field_' + param0);
                        }
//                        $('#id_profile_field_' + param0).selectedIndex = 0;
//                        $('#id_profile_field_' + param0).find('option:eq(0)').prop('selected', true);
//                        alert(valData);
                        if (!pertama) {
                            $('#id_profile_field_' + param0).trigger("change");
                        } else {
                            if (valData) {
                                $('#id_profile_field_' + param0).val(valData);//.trigger("change");
                                valData = null;
                            }
                            pertama = false;
//            alert($('#id_profile_field_' + param0).val());
//                            alert('pertama');
                        }
                    }
                });
            });
            $('#id_profile_field_' + param2).trigger("change");
//            pertama = false;

            /************************  FUnctions END  ****************************/
        });
    }
    return {init: load_settings};
});
