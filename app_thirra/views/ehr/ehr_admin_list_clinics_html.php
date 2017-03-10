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
    echo "\n<br />print_r(clinics_list)=<br />";
		print_r($clinics_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_list_clinics_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<fieldset>";
echo "<legend>CLINICS LIST</legend>";
echo anchor('ehr_admin/admin_edit_clinic_info/new_clinic', "<strong>Add New Clinic</strong>");
echo "\n<br /><br />";

echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>";
	echo anchor('ehr_admin/admin_list_clinics/clinic_ref_no', 'Code');
    echo "</th>";
    echo "\n<th width='350'>";
	echo anchor('ehr_admin/admin_list_clinics/clinic_name', 'Clinic Name');
    echo "</th>";
    echo "\n<th width='200'>";
	echo anchor('ehr_admin/admin_list_clinics/country', 'Country');
    echo "</th>";
    echo "\n<th width='50'>";
	echo anchor('ehr_admin/admin_list_clinics/sort_clinic', 'Sort');
    echo "</th>";
    echo "\n<th width='250'>Remarks</th>";
echo "</tr>";
if(isset($clinics_list)){
    $rownum = 1;
    foreach ($clinics_list as $clinic_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$clinic_item['clinic_ref_no']."</td>";
        echo "\n<td>".anchor('ehr_admin/admin_edit_clinic_info/edit_clinic/'.$clinic_item['clinic_info_id'], "<strong>".$clinic_item['clinic_name']."</strong>")."</td>";
        echo "\n<td>".$clinic_item['country']."</td>";
        echo "\n<td>".$clinic_item['sort_clinic']."</td>";
        echo "\n<td>".$clinic_item['remarks']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


