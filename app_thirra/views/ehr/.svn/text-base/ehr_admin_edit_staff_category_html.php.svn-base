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
 * Portions created by the Initial Developer are Copyright (C) 2009
 * the Initial Developer and IDRC. All Rights Reserved.
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
        echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_edit_staff_category_html_title')."</h1></div>";

//echo validation_errors(); Displays ALL errors in one place.
echo form_open('ehr_admin/edit_staff_category/'.$form_purpose.'/'.$category_id);

echo "<fieldset>";
echo "<legend>Category Info</legend>";
echo "\n<table>";
echo "\n<tr><td>Category Name <font color='red'>*</font></td><td>";
echo form_error('category_name');
echo "\n<input type='text' name='category_name' value='".set_value('username',$category_name)."' size='30' /></td></tr>";

echo "\n<tr><td>Description <font color='red'>*</font></td><td>";
echo form_error('description');
echo "<input type='text' name='description' value='".set_value('description',$description)."' size='100' /></td></tr>";

echo "\n</table>";
if(!isset($sys_category_id)){
    echo "<font color='red'>WARNING: NO MATCHING SYSTEM CATEGORY</font>";
}
echo "</fieldset>";

echo "<fieldset>";
echo "<legend>Access Rights</legend>";
echo "Enable checkbox to give access:<br />";
echo "\n<br /><input type='checkbox' name='access_patients'  value='100' ".($init_access_patients=='100' ? " checked='checked'" : " ")." id='access_patients' /> Patients Section";
echo "\n<br /><input type='checkbox' name='access_pharmacy'  value='100' ".($init_access_pharmacy=='100' ? " checked='checked'" : " ")." id='access_pharmacy' /> Pharmacy Section";
echo "\n<br /><input type='checkbox' name='access_orders'  value='100' ".($init_access_orders=='100' ? " checked='checked'" : " ")." id='access_orders' /> Orders Section";
echo "\n<br /><input type='checkbox' name='access_queue'  value='100' ".($init_access_queue=='100' ? " checked='checked'" : " ")." id='access_queue' /> Queue Section";
echo "\n<br /><input type='checkbox' name='access_reports'  value='100' ".($init_access_reports=='100' ? " checked='checked'" : " ")." id='access_reports' /> Reports Section";
echo "\n<br /><input type='checkbox' name='access_utilities'  value='100' ".($init_access_utilities=='100' ? " checked='checked'" : " ")." id='access_utilities' /> Utilities Section";
echo "\n<br /><input type='checkbox' name='access_admin'  value='100' ".($init_access_admin=='100' ? " checked='checked'" : " ")." id='access_admin' /> Admin Section";
echo "</fieldset>";

echo form_hidden('now_id', $now_id);
echo form_hidden('category_id', $category_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Save' />";
echo "</div>";

echo "</form>";

echo "</div>"; //id=content

