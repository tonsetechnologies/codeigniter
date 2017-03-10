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

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_list_synchlogs_html_title')."</h1></div>";


echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n\n<div id='admin_users' class='section'>";
    echo "\n<p class='section_title'>";
    echo "<h2>Import Activity</h2></p>";
    echo "\n<p class='section_body'>";

        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th>Date / Time</th>";
            echo "\n<th>Import Ref.</th>";
            echo "\n<th>Filename</th>";
            echo "\n<th>Outcome</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        foreach ($imports_list as $import_item){
            echo "<tr>";
            echo "<td>".anchor('ehr_admin/edit_staff_category/edit_category/'.$import_item['data_synch_log_id'], date("Y-m-d H:i",$import_item['import_when']))."</td>";
            echo "<td>".$import_item['import_reference']."</td>";
            echo "<td>".$import_item['data_filename']."</td>";
            echo "<td>".$import_item['import_outcome']."</td>";
            echo "<td>".$import_item['import_remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
    echo "</p>";
echo "</div>";

echo "\n\n<div id='admin_users' class='section'>";
    echo "\n<p class='section_title'>";
    echo "<h2>Export Activity</h2></p>";
    echo "\n<p class='section_body'>";

        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th>Date / Time</th>";
            echo "\n<th>Export Ref.</th>";
            echo "\n<th>Filename</th>";
            echo "\n<th>Outcome Remarks</th>";
        echo "</tr>";
        foreach ($exports_list as $export_item){
            echo "<tr>";
            echo "<td>".anchor('ehr_admin/edit_staff_category/edit_category/'.$export_item['data_synch_log_id'], date("Y-m-d H:i",$export_item['export_when']))."</td>";
            echo "<td>".$export_item['export_reference']."</td>";
            echo "<td>".$export_item['data_filename']."</td>";
            echo "<td>".$export_item['outcome_remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
    echo "</p>";
echo "</div>";



