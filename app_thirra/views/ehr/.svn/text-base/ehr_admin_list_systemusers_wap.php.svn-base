<?php
/* ***** BEGIN LICENSE BLOCK *****
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 * The Initial Developer of the Original Code is
 * Primary Care Doctors Organisation Malaysia.
 * Portions created by the Initial Developer are Copyright (C) 2010
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(area_list)=<br />";
		print_r($area_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_list_systemusers_html_title')."</h1></div>";


if($offline_mode == FALSE) {
    echo "\n\n<div id='admin_users' class='section'>";
	    echo "\n<p class='section_title'>";
	    echo "<h2>Users Management</h2></p>";
	    echo "\n<p class='section_body'>";
            echo "<p>";
            echo anchor('ehr_admin/edit_systemuser/new_systemuser', 'Add New User');
            echo "</p>";

            echo "\n<table>";
            echo "\n<tr>";
                echo "\n<th width='100'>";
	            echo anchor('ehr_admin/admin_list_systemusers/username', 'username');
                echo "</th>";
                echo "\n<th width='250'>";
	            echo anchor('ehr_admin/admin_list_systemusers/staff_info.staff_name', 'Staff Name');
                echo "</th>";
                echo "\n<th>System Category</th>";
                echo "\n<th>Home Clinic</th>";
                echo "\n<th>Remarks</th>";
            echo "</tr>";
            foreach ($users_list as $user_item){
                echo "<tr>";
                echo "<td>".anchor('ehr_admin/edit_systemuser/edit_systemuser/'.$user_item['user_id'], $user_item['username'])."</td>";
                echo "<td>".$user_item['staff_name']."</td>";
                echo "<td>".$user_item['category_name']."</td>";
                echo "<td>".$user_item['clinic_shortname']."</td>";
                echo "</tr>";
            }//endforeach;
            echo "</table>";
	    echo "</p>";
    echo "</div>";

}





?>
    <script  type="text/javascript">
        var $ = function (id) {
            return document.getElementById(id);
        }

        function select_level_two(){
            $("consultation_form").status.value="Unfinished";
            $("level_two").selectedIndex = -1;
            $("consultation_form").submit.click();
        }

      </script>


