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

$ideal_field_length = 25;

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $this->session->userdata('username');
	echo '<pre>';
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_edit_complaint_code_html_title')."</h1></div>";

$attributes =   array('class' => 'select_form', 'id' => 'complaint_code');
echo form_open('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_edit_complaint_code/'.$form_purpose.'/'.$icpc_code, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('component', $init_component);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Complaint Code <font color='red'>*</font></td><td>";
echo form_error('icpc_code');
echo "<input type='text' name='icpc_code' value='".set_value('icpc_code',$init_icpc_code)."' size='3' /></td></tr>";

echo "\n<tr><td>Full description</td><td>";
echo form_error('full_description');
echo "<input type='text' name='full_description' value='".set_value('full_description',$init_full_description)."' size='60' /></td></tr>";

echo "\n<tr><td>Short description</td><td>";
echo form_error('short_description');
echo "<input type='text' name='short_description' value='".set_value('short_description',$init_short_description)."' size='40' /></td></tr>";

echo "\n<tr><td>ICD-10</td><td>";
echo form_error('icd_10');
echo "<input type='text' name='icd_10' value='".set_value('icd_10',$init_icd_10)."' size='50' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Criteria</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='criteria' cols='40' rows='3'>".set_value('criteria',$init_criteria)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Inclusion criteria</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='inclusion_criteria' cols='40' rows='3'>".set_value('inclusion_criteria',$init_inclusion_criteria)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Exclusion criteria</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='exclusion_criteria' cols='40' rows='3'>".set_value('exclusion_criteria',$init_exclusion_criteria)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Consideration</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='consideration' cols='40' rows='3'>".set_value('consideration',$init_consideration)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Note</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='note' cols='40' rows='3'>".set_value('note',$init_note)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";


echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_code"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Complaint Code' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";

echo "\n</form>";
echo "\n<br />";



?>
    <script  type="text/javascript">

        function select_level_two(){
            document.getElementById("consultation_form").status.value="Unfinished";
            document.getElementById("level_two").selectedIndex = -1;
            document.getElementById("consultation_form").submit.click();
        }

      </script>


