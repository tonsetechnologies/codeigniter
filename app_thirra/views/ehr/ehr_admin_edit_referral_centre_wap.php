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

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
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
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_edit_referral_centre_html_title')."</h1></div>";


$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('ehr_admin/admin_edit_referral_centre/'.$referral_center_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('referral_center_id', $referral_center_id);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td width='200'>Centre Name<font color='red'>*</font></td><td>";
echo form_error('centre_name');
echo "<input type='text' name='centre_name' value='".set_value('centre_name',$init_centre_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Centre Type<font color='red'>*</font></td><td>";
echo form_error('centre_type');
echo "<input type='text' name='centre_type' value='".set_value('centre_type',$init_centre_type)."' size='20' /></td></tr>";

echo "\n<tr><td>Address</td><td>";
echo form_error('address');
echo "<input type='text' name='address' value='".set_value('address',$init_address)."' size='50' /></td></tr>";

echo "\n<tr><td>Address2</td><td>";
echo form_error('address2');
echo "<input type='text' name='address2' value='".set_value('address2',$init_address2)."' size='50' /></td></tr>";

echo "\n<tr><td>Address3</td><td>";
echo form_error('address3');
echo "<input type='text' name='address3' value='".set_value('address3',$init_address3)."' size='50' /></td></tr>";

echo "\n<tr><td>Town</td><td>";
echo form_error('town');
echo "<input type='text' name='town' value='".set_value('town',$init_town)."' size='30' /></td></tr>";

echo "\n<tr><td>State</td><td>";
echo form_error('state');
echo "<input type='text' name='state' value='".set_value('state',$init_state)."' size='20' /></td></tr>";

echo "\n<tr><td>Post Code</td><td>";
echo form_error('postcode');
echo "<input type='text' name='postcode' value='".set_value('postcode',$init_postcode)."' size='10' /></td></tr>";

echo "\n<tr><td>Country</td><td>";
echo form_error('country');
echo "<input type='text' name='country' value='".set_value('country',$init_country)."' size='20' /></td></tr>";

echo "\n<tr><td>Tel. No.</td><td>";
echo form_error('tel_no');
echo "<input type='text' name='tel_no' value='".set_value('tel_no',$init_tel_no)."' size='20' /></td></tr>";

echo "\n<tr><td>tel_no2</td><td>";
echo form_error('tel_no2');
echo "<input type='text' name='tel_no2' value='".set_value('tel_no2',$init_tel_no2)."' size='20' /></td></tr>";

echo "\n<tr><td>tel_no3</td><td>";
echo form_error('tel_no3');
echo "<input type='text' name='tel_no3' value='".set_value('tel_no3',$init_tel_no3)."' size='20' /></td></tr>";

echo "\n<tr><td>Fax No.</td><td>";
echo form_error('fax_no');
echo "<input type='text' name='fax_no' value='".set_value('fax_no',$init_fax_no)."' size='20' /></td></tr>";

echo "\n<tr><td>fax_no2</td><td>";
echo form_error('fax_no2');
echo "<input type='text' name='fax_no2' value='".set_value('fax_no2',$init_fax_no2)."' size='20' /></td></tr>";

echo "\n<tr><td>e-mail</td><td>";
echo form_error('email');
echo "<input type='text' name='email' value='".set_value('email',$init_email)."' size='30' /></td></tr>";

echo "\n<tr><td>Contact Person</td><td>";
echo form_error('contact_person');
echo "<input type='text' name='contact_person' value='".set_value('contact_person',$init_contact_person)."' size='30' /></td></tr>";

echo "\n<tr><td>Website</td><td>";
echo form_error('website');
echo "<input type='text' name='website' value='".set_value('website',$init_website)."' size='20' /></td></tr>";

echo "\n<tr><td>No. of Beds</td><td>";
echo form_error('beds');
echo "<input type='text' name='beds' value='".set_value('beds',$init_beds)."' size='4' /></td></tr>";

echo "\n<tr>";
    echo "\n<td id='level_two' valign='top'>Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='remarks' cols='40' rows='3'>".set_value('remarks',$init_remarks)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "<tr>";
    echo "\n<td>Partner Clinic</td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='partner_clinic_id' class='normal' onchange='javascript:select_level_two()' id='level_one'>";
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:select_level_two()'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($clinics_list as $clinic)
        {
            echo "\n<option label='".$clinic['clinic_info_id']."' value='".$clinic['clinic_info_id']."'";
            echo ($partner_clinic_id == $clinic['clinic_info_id'] ? " selected='selected'" : "");
            echo ">".$clinic['clinic_name']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Add Centre' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";


echo "\n<fieldset>";
echo "<legend>REFERRAL DOCTORS</legend>";
echo anchor('ehr_admin/admin_edit_referral_person/new_person/'.$referral_center_id.'/new_person/'.$partner_clinic_id, 'Add Person');
echo "\n<br /><br /><table>";
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


if(isset($partner_info)) {
    if(isset($partner_info['clinic_info_id'])) {
        //echo "\n\n<div id='person_info' class='episodeblock'>";
        echo "\n<fieldset>";
        echo "<legend>PARTNER INFORMATION</legend>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<td width='200'>Clinic Name</td>";
            echo "\n<td>".$partner_info['clinic_name']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Clinic Ref No.</td>";
            echo "\n<td>".$partner_info['clinic_ref_no']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Clinic Shortname</td>";
            echo "\n<td>".$partner_info['clinic_shortname']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Address</td>";
            echo "\n<td>".$partner_info['address']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Address2</td>";
            echo "\n<td>".$partner_info['address2']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Address3</td>";
            echo "\n<td>".$partner_info['address3']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Town</td>";
            echo "\n<td>".$partner_info['town']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>State</td>";
            echo "\n<td>".$partner_info['state']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Postcode</td>";
            echo "\n<td>".$partner_info['postcode']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Country</td>";
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


