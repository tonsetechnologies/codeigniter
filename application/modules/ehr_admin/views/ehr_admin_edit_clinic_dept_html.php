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
    echo "\n<br />print_r(clinics_list)=<br />";
		print_r($clinics_list);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />referral_center_id=".$referral_center_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_edit_clinic_dept_html_title')."</h1></div>";


$attributes =   array('class' => 'select_form', 'id' => 'dept_form');
echo form_open('ehr/ehr/index/ehr_admin/ehr_admin/admin_edit_clinic_dept/'.$form_purpose.'/'.$clinic_dept_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('clinic_dept_id', $clinic_dept_id);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td width='200'>Department Name<font color='red'>*</font></td><td>";
echo form_error('dept_name');
echo "<input type='text' name='dept_name' value='".set_value('dept_name',$init_dept_name)."' size='75' /></td></tr>";

echo "\n<tr><td>Dept shortname<font color='red'>*</font></td><td>";
echo form_error('dept_shortname');
echo "<input type='text' name='dept_shortname' value='".set_value('dept_shortname',$init_dept_shortname)."' size='20' /></td></tr>";

echo "\n<tr><td>Dept Code</td><td>";
echo form_error('dept_code');
echo "<input type='text' name='dept_code' value='".set_value('dept_code',$init_dept_code)."' size='20' /></td></tr>";

echo "\n<tr><td>Sort order</td><td>";
echo form_error('dept_sort');
echo "<input type='text' name='dept_sort' value='".set_value('dept_sort',$init_dept_sort)."' size='5' /></td></tr>";

echo "\n<tr><td>Description</td><td>";
echo form_error('dept_description');
echo "<input type='text' name='dept_description' value='".set_value('dept_description',$init_dept_description)."' size='100' /></td></tr>";

echo "\n<tr><td>Dept Head</td><td>";
echo form_error('dept_head');
echo "<input type='text' name='dept_head' value='".set_value('dept_head',$init_dept_head)."' size='50' /></td></tr>";

echo "\n<tr><td>Tel. No.</td><td>";
echo form_error('dept_telno');
echo "<input type='text' name='dept_telno' value='".set_value('dept_telno',$init_dept_telno)."' size='20' /></td></tr>";

echo "\n<tr>";
    echo "\n<td id='level_two' valign='top'>Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='dept_remarks' cols='40' rows='3'>".set_value('dept_remarks',$init_dept_remarks)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "<tr>";
    echo "\n<td>Location</td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='location_id' class='normal' >";
        //echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($clinics_list as $clinic)
        {
            echo "\n<option value='".$clinic['clinic_info_id']."'";
            //echo "\n<option label='".$clinic['clinic_info_id']."' value='".$clinic['clinic_info_id']."'";
            echo ($init_location_id == $clinic['clinic_info_id'] ? " selected='selected'" : "");
            echo ">".$clinic['clinic_name']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Add/Edit Department' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";

echo "\n</form>";
echo "\n<br />";



