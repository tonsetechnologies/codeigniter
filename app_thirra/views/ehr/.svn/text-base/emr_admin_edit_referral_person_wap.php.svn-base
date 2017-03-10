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

echo "\n\n<div id='content'>";
if($debug_mode) {
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(persons_list)=<br />";
		print_r($persons_list);
    echo "\n<br />print_r(partner_info)=<br />";
		print_r($partner_info);
    echo "\n<br />print_r(clinics_list)=<br />";
		print_r($clinics_list);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />referral_center_id=".$referral_center_id;
    echo "\n<br />referral_doctor_id=".$referral_doctor_id;
    echo "\n<br />partner_clinic_id=".$partner_clinic_id;
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_edit_referral_person_html_title')."</h1></div>";


echo "\n<fieldset>";
echo "<legend>REFERRAL DOCTORS</legend>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th width='200'>Referral Person</th>";
    echo "\n<th width='100'>Specialty</th>";
    echo "\n<th width='200'>Tel. No.</th>";
    echo "\n<th>e-mail</th>";
    echo "\n<th>Remarks</th>";
echo "</tr>";
foreach ($persons_list as $person_item){
    echo "<tr>";
    echo "<td>".anchor('ehr_admin/admin_edit_referral_person/edit_person/'.$referral_center_id.'/'.$person_item['referral_doctor_id'].'/'.$partner_clinic_id, $person_item['doctor_name'])."</td>";
    echo "<td>".$person_item['specialty']."</td>";
    echo "<td>".$person_item['tel_no']."</td>";
    echo "<td>".$person_item['email']."</td>";
    echo "<td>".$person_item['remarks']."</td>";
    echo "</tr>";
}//endforeach;
echo "</table>";
echo "\n</fieldset>";


$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('ehr_admin/admin_edit_referral_person/'.$referral_doctor_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('referral_doctor_id', $referral_doctor_id);
echo form_hidden('referral_center_id', $referral_center_id);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td width='200'>Doctor's Name<font color='red'>*</font></td><td>";
echo form_error('doctor_name');
echo "<input type='text' name='doctor_name' value='".set_value('doctor_name',$init_doctor_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Specialty</td><td>";
echo form_error('specialty');
echo "<input type='text' name='specialty' value='".set_value('specialty',$init_specialty)."' size='50' /></td></tr>";

echo "\n<tr><td>Tel. No.</td><td>";
echo form_error('tel_no');
echo "<input type='text' name='tel_no' value='".set_value('tel_no',$init_tel_no)."' size='20' /></td></tr>";

echo "\n<tr><td>tel_no2</td><td>";
echo form_error('tel_no2');
echo "<input type='text' name='tel_no2' value='".set_value('tel_no2',$init_tel_no2)."' size='20' /></td></tr>";

echo "\n<tr><td>Fax No.</td><td>";
echo form_error('fax_no');
echo "<input type='text' name='fax_no' value='".set_value('fax_no',$init_fax_no)."' size='20' /></td></tr>";

echo "\n<tr><td>e-mail</td><td>";
echo form_error('email');
echo "<input type='text' name='email' value='".set_value('email',$init_email)."' size='20' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two'>Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='remarks'>".set_value('remarks',$init_remarks)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "<tr>";
    echo "\n<td width='25%'>Partner Staff</td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='partner_clinic_id' class='normal' onchange='javascript:select_level_two()' id='level_one'>";
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:select_level_two()'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($staff_list as $staff)
        {
            echo "\n<option label='".$staff['staff_id']."' value='".$staff['staff_id']."'";
            echo ($partner_clinic_id == $staff['staff_id'] ? " selected='selected'" : "");
            echo ">".$staff['staff_name']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Add Person' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";


if(isset($partner_info)) {
    if(isset($partner_info['clinic_info_id'])) {
        //echo "\n\n<div id='person_info' class='episodeblock'>";
        echo "\n<fieldset>";
        echo "<legend>PARTNER INFORMATION</legend>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<td>Clinic Name</td>";
            echo "\n<td>".$partner_info['clinic_name']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>clinic_ref_no</td>";
            echo "\n<td>".$partner_info['clinic_ref_no']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>clinic_shortname</td>";
            echo "\n<td>".$partner_info['clinic_shortname']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>address</td>";
            echo "\n<td>".$partner_info['address']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>address2</td>";
            echo "\n<td>".$partner_info['address2']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>address3</td>";
            echo "\n<td>".$partner_info['address3']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>town</td>";
            echo "\n<td>".$partner_info['town']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>state</td>";
            echo "\n<td>".$partner_info['state']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>postcode</td>";
            echo "\n<td>".$partner_info['postcode']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>country</td>";
            echo "\n<td>".$partner_info['country']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Tel. No.</td>";
            echo "\n<td>".$partner_info['tel_no']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td></td>";
            echo "\n<td>".$partner_info['tel_no2']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Fax No.</td>";
            echo "\n<td>".$partner_info['fax_no']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>e-mail</td>";
            echo "\n<td>".$partner_info['email']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Others</td>";
            echo "\n<td>".$partner_info['other']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Remarks</td>";
            echo "\n<td>".$partner_info['remarks']."</td>";
        echo "\n<tr>";
        echo "\n</table>";
        //echo "\n</div>";
        echo "</fieldset>";
    }
} //endif($referral_doctor_id <> "")

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


