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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content_nosidebar'>";

echo "\n<body>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    echo '<pre>';
    echo "\n<br />print_r(clinic_info)=<br />";
		print_r($clinic_info);
    echo "\n<br />print_r(category_info)=<br />";
		print_r($category_info);
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />user_id = " . $user_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
    echo "\n<br />print_r(user_info)=<br />";
		print_r($user_info);
    echo "\n<br />print_r(user_rights)=<br />";
		print_r($user_rights);
    echo "\n<br />print_r(access_rights)=<br />";
		print_r($access_rights);
    echo "\n<br />print_r(acl_single)=<br />";
		print_r($acl_single);
        echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_edit_staff_category_html_title')."</h1></div>";

//echo validation_errors(); Displays ALL errors in one place.
echo form_open('ehr/ehr/index/ehr_admin/ehr_admin/edit_staff_category/'.$form_purpose.'/'.$category_id);

echo "<fieldset>";
echo "<legend>Category Info</legend>";
echo "\n<table>";
echo "\n<tr><td>Category Name <font color='red'>*</font></td><td>";
echo form_error('category_name');
echo "\n<input type='text' name='category_name' value='".set_value('username',$category_name)."' size='30' /></td></tr>";

echo "\n<tr><td valign='top'>Description <font color='red'>*</font></td><td>";
echo form_error('description');
//echo "<input type='text' name='description' value='".set_value('description',$description)."' size='80' /></td></tr>";
echo "\n<textarea class='normal' name='description' id='description' cols='40' rows='4'>".$description."</textarea>";
echo "</td></tr>";

echo "\n<tr>";
echo "<td>Allowed to consult patients";
echo "</td>";
echo "<td>";
echo "\n<input type='radio' name='can_consult' value='0' ".($can_consult==0?"checked='checked'":"")." >None &nbsp;</input>";
echo "\n<input type='radio' name='can_consult' value='100' ".($can_consult==100?"checked='checked'":"")." >All &nbsp;</input>";
echo "</td>";
echo "</tr>";
echo "\n</table>";
if(!isset($sys_category_id)){
    echo "<font color='red'>WARNING: NO MATCHING SYSTEM CATEGORY</font>";
}
echo "</fieldset>";

echo "<fieldset>";
echo "<legend>Access Rights (deprecated)</legend>";
echo "Enable checkbox to give access:<br />";
echo "\n<br /><input type='checkbox' name='access_patients'  value='100' ".($init_access_patients=='100' ? " checked='checked'" : " ")." id='access_patients' /> Patients Section";
echo "\n<br /><input type='checkbox' name='access_pharmacy'  value='100' ".($init_access_pharmacy=='100' ? " checked='checked'" : " ")." id='access_pharmacy' /> Pharmacy Section";
echo "\n<br /><input type='checkbox' name='access_orders'  value='100' ".($init_access_orders=='100' ? " checked='checked'" : " ")." id='access_orders' /> Orders Section";
echo "\n<br /><input type='checkbox' name='access_queue'  value='100' ".($init_access_queue=='100' ? " checked='checked'" : " ")." id='access_queue' /> Queue Section";
echo "\n<br /><input type='checkbox' name='access_reports'  value='100' ".($init_access_reports=='100' ? " checked='checked'" : " ")." id='access_reports' /> Reports Section";
echo "\n<br /><input type='checkbox' name='access_utilities'  value='100' ".($init_access_utilities=='100' ? " checked='checked'" : " ")." id='access_utilities' /> Utilities Section";
echo "\n<br /><input type='checkbox' name='access_admin'  value='100' ".($init_access_admin=='100' ? " checked='checked'" : " ")." id='access_admin' /> Admin Section";
echo "</fieldset>";

echo "\n<fieldset>";
echo "<legend>Access Control List</legend>";
echo "\nAccess rights are cumulative. Update means to modify completed sessions.<br /><br />";
echo "\n<table>";
echo "\n<tr>";
echo "<tr>";
    echo "<td colspan='3' align='center'>SECTION</td>";
    echo "<td>|</td>";
    echo "<td colspan='6' align='center'>HOME CLINIC</td>";
    echo "<td>|</td>";
    echo "<td colspan='6' align='center'>GROUP CLINICS</td>";
echo "\n<tr>";
    echo "<th>No.</th>";
    echo "<th>Module</th>";
    echo "<th>Section</th>";
    echo "<td>|</td>";
    echo "<th>Rights</th>";
    echo "<th width='5'>None</th>";
    echo "<th width='5'>Read</th>";
    echo "<th width='5'>Write</th>";
    echo "<th width='5'>Update</th>";
    echo "<th width='5'>Delete</th>";
    echo "<td>|</td>";
    echo "<th>Rights</th>";
    echo "<th width='5'>None</th>";
    echo "<th width='5'>Read</th>";
    echo "<th width='5'>Write</th>";
    echo "<th width='5'>Update</th>";
    echo "<th width='5'>Delete</th>";
echo "</tr>";
$rownum =   1;
foreach($acl_single as $acl_item){
    echo "\n<tr>";
        echo "<td>".$rownum.".</td>";
        echo "<td>";
        echo $acl_item['sysmodule_shortname'];
        echo "</td>";
        echo "<td>";
        echo $acl_item['syssection_name'];
        echo "</td>";
        echo "<td>|</td>";
        echo "<td>";
        echo $acl_item['rights_single'];
        echo "</td>";
        // Single clinic's rights
        $str_single_syssection_id    =   "single_".$acl_item['syssection_id'];
        $val_single_syssection_id    =   $acl_item[$str_single_syssection_id];
        echo "\n<td>";
        echo "<input type='radio' name='".$str_single_syssection_id."' value='0' ".($val_single_syssection_id==0?"checked='checked'":"")." >&nbsp;</input>";
        echo "</td>";
        echo "\n<td>";
        echo "<input type='radio' name='".$str_single_syssection_id."' value='1' ".($val_single_syssection_id==1?"checked='checked'":"")." >&nbsp;</input>";
        echo "</td>";
        echo "\n<td>";
        echo "<input type='radio' name='".$str_single_syssection_id."' value='3' ".($val_single_syssection_id==3?"checked='checked'":"")." >&nbsp;</input>";
        echo "</td>";
        echo "\n<td>";
        echo "<input type='radio' name='".$str_single_syssection_id."' value='7' ".($val_single_syssection_id==7?"checked='checked'":"")." >&nbsp;</input>";
        echo "</td>";
        echo "\n<td>";
        echo "<input type='radio' name='".$str_single_syssection_id."' value='15' ".($val_single_syssection_id==15?"checked='checked'":"")." >&nbsp;</input>";
        echo "</td>";
        echo "<td>|</td>";
        echo "<td>";
        echo $acl_item['rights_multi'];
        echo "</td>";
        // Multiple clinics' rights
        $str_multi_syssection_id    =   "multi_".$acl_item['syssection_id'];
        $val_multi_syssection_id    =   $acl_item[$str_multi_syssection_id];
        echo "\n<td>";
        echo "<input type='radio' name='".$str_multi_syssection_id."' value='0' ".($val_multi_syssection_id==0?"checked='checked'":"")." >&nbsp;</input>";
        echo "</td>";
        echo "\n<td>";
        echo "<input type='radio' name='".$str_multi_syssection_id."' value='1' ".($val_multi_syssection_id==1?"checked='checked'":"")." >&nbsp;</input>";
        echo "</td>";
        echo "\n<td>";
        echo "<input type='radio' name='".$str_multi_syssection_id."' value='3' ".($val_multi_syssection_id==3?"checked='checked'":"")." >&nbsp;</input>";
        echo "</td>";
        echo "\n<td>";
        echo "<input type='radio' name='".$str_multi_syssection_id."' value='7' ".($val_multi_syssection_id==7?"checked='checked'":"")." >&nbsp;</input>";
        echo "</td>";
        echo "\n<td>";
        echo "<input type='radio' name='".$str_multi_syssection_id."' value='15' ".($val_multi_syssection_id==15?"checked='checked'":"")." >&nbsp;</input>";
        echo "</td>";
    echo "</tr>";
    $rownum++;
}
echo "</table>";
echo "</fieldset>";

echo form_hidden('now_id', $now_id);
echo form_hidden('category_id', $category_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Save' />";
echo "</div>";

echo "</form>";

echo "</div>"; //id=content

