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
 * Portions created by the Initial Developer are Copyright (C) 2010 - 2011 
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content_nosidebar'>";
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

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_list_staffcategories_html_title')."</h1></div>";


echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

if($offline_mode == FALSE) {
    echo "\n\n<div id='admin_users' class='section'>";
	    echo "\n<p class='section_title'>";
	    echo "<h2>Categories Management</h2></p>";
	    echo "\n<p class='section_body'>";
            echo "<p><strong>";
            echo anchor('ehr/ehr/index/ehr_admin/ehr_admin/edit_staff_category/new_category', 'Add New Category');
            echo "</strong></p>";

            echo "\n<table>";
            echo "\n<tr>";
                echo "\n<th width='250'>";
	            echo anchor('ehr/ehr/index/ehr_admin/ehr_admin/admin_list_systemusers/username', 'Category');
                echo "</th>";
                echo "\n<th>Allowed to<br/ > Consult</th>";
                echo "\n<th>Description</th>";
            echo "</tr>";
            foreach ($users_list as $user_item){
                echo "<tr>";
                echo "<td>".anchor('ehr/ehr/index/ehr_admin/ehr_admin/edit_staff_category/edit_category/'.$user_item['category_id'], $user_item['category_name'])."</td>";
                if($user_item['can_consult'] > 0){
                    echo "<td>Yes</td>";
                } else {
                    echo "<td>-</td>";
                }
                echo "<td>".$user_item['description']."</td>";
                echo "</tr>";
            }//endforeach;
            echo "</table>";
	    echo "</p>";
    echo "</div>";

}


