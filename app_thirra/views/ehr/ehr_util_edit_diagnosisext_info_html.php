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

$ideal_field_length = 25;

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(dcode1ext_info)=<br />";
		print_r($dcode1ext_info);
    echo "\n<br />print_r(diagnosis_top)=<br />";
		print_r($diagnosis_top);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />dcode1ext_id=".$dcode1ext_id;
    echo "\n<br />dcode1_id=".$dcode1_id;
    echo "\n<br />dcode1set=".$dcode1set;
    echo "\n<br />dcode1ext_code=".$dcode1ext_code;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'>\n<h1>".$this->lang->line('util_edit_diagnosisext_info_html_title')."</h1></div>\n";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<td><h3>".$diagnosis_top[0]['dcode1_code']."</h3></td>";
    echo "\n<td> : </td>";
    echo "\n<td><h3>".$diagnosis_top[0]['full_title']."</h3></td>";
echo "</tr>";
echo "</table>";


$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('ehr_utilities/util_edit_diagnosisext_info/'.$form_purpose.'/'.$init_dcode1_id.'/'.$dcode1ext_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('dcode1set', $init_dcode1set);
echo form_hidden('code_use', $init_code_use);
echo form_hidden('chapter', $init_chapter);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Code <font color='red'>*</font></td><td>";
echo form_error('dcode1ext_code');
echo "<input type='text' name='dcode1ext_code' value='".set_value('dcode1ext_code',$init_dcode1ext_code)."' size='10' /></td></tr>";

echo "\n<tr><td>Set</td><td>";
echo $init_dcode1set."</td></tr>";

echo "\n<tr><td>Longname <font color='red'>*</font></td><td>";
echo form_error('dcode1ext_longname');
echo "<input type='text' name='dcode1ext_longname' value='".set_value('dcode1ext_longname',$init_dcode1ext_longname)."' size='60' /></td></tr>";

echo "\n<tr><td>Shortname <font color='red'>*</font></td><td>";
echo form_error('dcode1ext_shortname');
echo "<input type='text' name='dcode1ext_shortname' value='".set_value('dcode1ext_shortname',$init_dcode1ext_shortname)."' size='50' /></td></tr>";

echo "\n<tr><td>Component</td><td>";
echo form_error('component');
echo "<input type='text' name='component' value='".set_value('component',$init_component)."' size='60' /></td></tr>";

echo "\n<tr><td>Code use</td><td>";
echo $init_code_use."</td></tr>";

echo "\n<tr><td>Chapter</td><td>";
echo form_error('chapter');
echo $init_chapter;
//echo "<input type='text' name='chapter' value='".set_value('chapter',$init_chapter)."' size='60' /></td></tr>";

echo "\n<tr><td>Topic</td><td>";
echo form_error('topic');
echo "<input type='text' name='topic' value='".set_value('topic',$init_topic)."' size='60' /></td></tr>";

echo "\n<tr><td>Full title <font color='red'>*</font></td><td>";
echo form_error('full_title');
echo "<input type='text' name='full_title' value='".set_value('full_title',$init_full_title)."' size='60' /></td></tr>";

echo "\n<tr><td>Short title <font color='red'>*</font></td><td>";
echo form_error('short_title');
echo "<input type='text' name='short_title' value='".set_value('short_title',$init_short_title)."' size='60' /></td></tr>";

echo "\n<tr><td>Description</td><td>";
echo form_error('description');
echo "<input type='text' name='description' value='".set_value('description',$init_description)."' size='60' /></td></tr>";

echo "\n<tr><td>Mapping to set2</td><td>";
echo form_error('dcode2maps');
echo "<input type='text' name='dcode2maps' value='".set_value('addr',$init_dcode2maps)."' size='60' /></td></tr>";

echo "\n<tr><td>Criteria</td><td>";
echo form_error('criteria');
echo "<input type='text' name='criteria' value='".set_value('criteria',$init_criteria)."' size='60' /></td></tr>";

echo "\n<tr><td>Inclusion criteria</td><td>";
echo form_error('inclusion_criteria');
echo "<input type='text' name='inclusion_criteria' value='".set_value('inclusion_criteria',$init_inclusion_criteria)."' size='60' /></td></tr>";

echo "\n<tr><td>Exclusion criteria</td><td>";
echo form_error('exclusion_criteria');
echo "<input type='text' name='exclusion_criteria' value='".set_value('exclusion_criteria',$init_exclusion_criteria)."' size='60' /></td></tr>";

echo "\n<tr><td>Consideration</td><td>";
echo form_error('consideration');
echo "<input type='text' name='consideration' value='".set_value('consideration',$init_consideration)."' size='60' /></td></tr>";

echo "\n<tr><td>Note</td><td>";
echo form_error('note');
echo "<input type='text' name='note' value='".set_value('note',$init_note)."' size='60' /></td></tr>";

echo "\n<tr><td>Notify level</td><td>";
echo form_error('dcode1ext_notify');
echo "<input type='text' name='dcode1ext_notify' value='".set_value('dcode1ext_notify',$init_dcode1ext_notify)."' size='3' /> 10=Legal 100=Customised</td></tr>";

echo "\n<tr><td>Commonly used</td><td>";
echo form_error('commonly_used');
echo "<input type='text' name='commonly_used' value='".set_value('commonly_used',$init_commonly_used)."' size='5' /> Max.99</td></tr>";

echo "\n<tr><td>Remarks for code</td><td>";
echo form_error('remarks');
echo "<input type='text' name='remarks' value='".set_value('remarks',$init_remarks)."' size='60' /></td></tr>";

echo "\n<tr><td>Active</td><td>";
echo form_error('dcode1ext_active');
//echo "<input type='text' name='dcode1ext_active' value='".set_value('dcode1ext_active',$init_dcode1ext_active)."' size='5' /></td></tr>";
echo $init_dcode1ext_active."</td></tr>";
echo "\n<input type='hidden' name='dcode1ext_active' value='".$init_dcode1ext_active."' />";

if($form_purpose == "new_code"){
    echo "\n<tr><td>Addition Remarks</td><td>";
    echo form_error('added_remarks');
    echo "<input type='text' name='added_remarks' value='".set_value('added_remarks',$init_added_remarks)."' size='60' /></td></tr>";
    echo "\n<input type='hidden' name='edit_remarks' value='".$init_edit_remarks."' />";
} else {
    echo "\n<tr><td>Addition Remarks</td><td>";
    echo (!empty($init_added_remarks)? $init_added_remarks : "");
    echo "</td></tr>";
    echo "\n<tr><td>Editing Remarks</td><td>";
    echo form_error('edit_remarks');
    echo "<input type='text' name='edit_remarks' value='".set_value('edit_remarks',$init_edit_remarks)."' size='60' /></td></tr>";
    echo "\n<input type='hidden' name='added_remarks' value='";
    echo (!empty($init_added_remarks)? $init_added_remarks : "");
    echo "' />";
} //endif($form_purpose == "new_code")

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_code"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Code' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";



