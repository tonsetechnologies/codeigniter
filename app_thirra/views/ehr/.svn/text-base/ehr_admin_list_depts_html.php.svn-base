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
    echo "\n<br />print_r(depts_list)=<br />";
		print_r($depts_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_list_depts_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<fieldset>";
echo "<legend>DEPARTMENTS LIST</legend>";
echo anchor('ehr_admin/admin_edit_clinic_dept/new_dept', "<strong>Add New Department</strong>");
echo "\n<br /><br />";

echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='100'>";
	echo anchor('ehr_admin/admin_list_depts/dept_code', 'Code');
    echo "</th>";
    echo "\n<th width='350'>";
	echo anchor('ehr_admin/admin_list_depts/dept_name', 'Department Name');
    echo "</th>";
    echo "\n<th width='300'>";
	echo anchor('ehr_admin/admin_list_depts/clinic_name', 'Clinic');
    echo "</th>";
    echo "\n<th width='50'>";
	echo anchor('ehr_admin/admin_list_depts/dept_sort', 'Sort');
    echo "</th>";
    echo "\n<th width='250'>Description</th>";
echo "</tr>";
if(isset($depts_list)){
    $rownum = 1;
    foreach ($depts_list as $dept_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$dept_item['dept_code']."</td>";
        echo "\n<td>".anchor('ehr_admin/admin_edit_clinic_dept/edit_dept/'.$dept_item['clinic_dept_id'], "<strong>".$dept_item['dept_name']."</strong>")."</td>";
        echo "\n<td>".$dept_item['clinic_name']."</td>";
        echo "\n<td>".$dept_item['dept_sort']."</td>";
        echo "\n<td>".$dept_item['dept_description']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";



