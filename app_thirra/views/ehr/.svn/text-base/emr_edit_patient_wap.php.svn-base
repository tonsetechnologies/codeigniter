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

include_once("header_xhtml1-strict.php");
//include_once("header_xhtml1-transitional.php");

echo "\n\n<div id='content'>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    echo '<pre>';
    print "\n<br />offline_mode = " . $offline_mode;
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(clinic_info)=<br />";
		print_r($clinic_info);
    echo "\n<br />print_r(broken_birth_date)=<br />";
		print_r($broken_birth_date);
    echo "\n<br />print_r(broken_now_date)=<br />";
		print_r($broken_now_date);
    echo "\n<br />print_r(addr_village_list)=<br />";
		print_r($addr_village_list);
    echo "\n<br />print_r(addr_area_list)=<br />";
		print_r($addr_area_list);
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />offline_mode = " . $offline_mode;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
    echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('12100-100_patients_edit_patient_html_title')."</h1></div>";

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<h2>".$save_attempt."</h2>";

echo form_open('ehr_individual/edit_patient/'.$form_purpose.'/'.$patient_id);

echo "\n<fieldset>";
echo "<legend>BIO DATA</legend>";
echo "\n<table>";
echo "\n<tr><td>Clinic Ref.</td><td>";
echo form_error('clinic_reference_number');
echo "\n<input type='text' name='clinic_reference_number' value='".set_value('clinic_reference_number',$init_clinic_reference_number)."' size='20' /></td></tr>";

echo "\n<tr><td>Last Name <font color='red'>*</font></td><td>";
echo form_error('patient_name');
echo "<input type='text' name='patient_name' value='".set_value('patient_name',$patient_name)."' size='50' /></td></tr>";

echo "\n<tr><td>First Name</td><td>";
echo form_error('name_first');
echo "<input type='text' name='name_first' value='".set_value('name_first',$name_first)."' size='50' /></td></tr>";

echo "\n<tr><td>Alias Name</td><td>";
echo form_error('name_alias');
echo "<input type='text' name='name_alias' value='".set_value('name_alias',$name_alias)."' size='50' /></td></tr>";

echo "\n<tr><td>IC No.</td><td>";
echo form_error('ic_no');
echo "<input type='text' name='ic_no' value='".set_value('ic_no',$ic_no)."' size='12' /> yymmdd-xx-xxxx</td></tr>";

echo "\n<tr><td>Other IC No.</td><td>";
echo form_error('ic_other_no');
echo "<input type='text' name='ic_other_no' value='".set_value('ic_other_no',$init_ic_other_no)."' size='12' /> </td></tr>";

echo "\n<tr><td>Other IC Type</td><td>";
echo form_error('ic_other_type');
echo "<input type='text' name='ic_other_type' value='".set_value('ic_other_type',$init_ic_other_type)."' size='12' /> </td></tr>";

echo "\n<tr><td>Birth Cert. No.</td><td>";
echo form_error('birth_cert_no');
echo "<input type='text' name='birth_cert_no' value='".set_value('birth_cert_no',$init_birth_cert_no)."' size='12' /> </td></tr>";

echo "\n<tr><td>Gender  <font color='red'>*</font></td><td>";
echo form_error('gender');
    echo "\n<select name='gender'>";
    if($gender == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Male  ' ".($gender=='Male  '?' selected=\'selected\'':'').">Male</option>";
    echo "\n<option value='Female' ".($gender=='Female'?' selected=\'selected\'':'').">Female</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Birth Date  <font color='red'>*</font></td><td>";
echo form_error('birth_date');
echo "<input type='text' name='birth_date' value='".set_value('birth_date',$init_birth_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Marital Status</td><td>";
echo form_error('marital_status');
    echo "\n<select name='marital_status'>";
    if($init_marital_status == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Single'".($init_marital_status=='Single'?' selected=\'selected\'':'').">Single</option>";
    echo "\n<option value='Married'".($init_marital_status=='Married'?' selected=\'selected\'':'').">Married</option>";
    echo "\n<option value='Divorced'".($init_marital_status=='Divorced'?' selected=\'selected\'':'').">Divorced</option>";
    echo "\n<option value='Others'".($init_marital_status=='Others'?' selected=\'selected\'':'').">Others</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Citizen of</td><td>";
echo form_error('nationality');
echo "<input type='text' name='nationality' value='".set_value('nationality',$init_nationality)."' size='30' /> </td></tr>";

echo "\n<tr><td>Ethnicity</td><td>";
echo form_error('ethnicity');
echo "<input type='text' name='ethnicity' value='".set_value('ethnicity',$init_ethnicity)."' size='30' /> </td></tr>";

echo "\n<tr><td>Religion</td><td>";
echo form_error('religion');
echo "<input type='text' name='religion' value='".set_value('religion',$init_religion)."' size='30' /> </td></tr>";

echo "\n<tr><td>Patient Type</td><td>";
echo form_error('patient_type');
echo "<input type='text' name='patient_type' value='".set_value('patient_type',$init_patient_type)."' size='30' /> </td></tr>";

echo "\n<tr><td>Blood Group</td><td>";
echo form_error('blood_group');
    echo "\n<select name='blood_group'>";
    if($blood_group == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='O'".($blood_group=='O'?' selected=\'selected\'':'').">O</option>";
    echo "\n<option value='A'".($blood_group=='A'?' selected=\'selected\'':'').">A</option>";
    echo "\n<option value='B'".($blood_group=='B'?' selected=\'selected\'':'').">B</option>";
    echo "\n<option value='AB'".($blood_group=='AB'?' selected=\'selected\'':'').">AB</option>";
    echo "\n</select>";
//echo form_error('ethnicity');
//echo "<input type='text' name='blood_group' value='".set_value('blood_group',$init_blood_group)."' size='3' /> ";

echo "\n Rhesus Factor";
echo form_error('blood_rhesus');
    echo "\n<select name='blood_rhesus'>";
    if($blood_rhesus == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='positive'".($blood_rhesus=='positive'?' selected=\'selected\'':'').">positive</option>";
    echo "\n<option value='negative'".($blood_rhesus=='negative'?' selected=\'selected\'':'').">negative</option>";
    echo "\n</select>";

echo "\n<tr><td>Remarks</td><td>";
echo form_error('patdemo_remarks');
echo "<input type='text' name='patdemo_remarks' value='".set_value('patdemo_remarks',$init_patdemo_remarks)."' size='80' /> </td></tr>";

echo "\n<tr><td>&nbsp;</td></tr>";
echo "\n</table>";

echo "\n</fieldset>";
echo "\n<fieldset>";
echo "<legend>CONTACT INFO</legend>";
echo "\n<table>";

echo "\n<tr><td>Address</td><td>";
echo form_error('patient_address');
echo "<input type='text' name='patient_address' value='".set_value('patient_address',$init_patient_address)."' size='50' /></td></tr>\n";

echo "\n<tr><td>&nbsp;</td><td>";
echo form_error('patient_address2');
echo "<input type='text' name='patient_address2' value='".set_value('patient_address2',$init_patient_address2)."' size='50' /></td></tr>\n";

echo "\n<tr><td>&nbsp;</td><td>";
echo form_error('patient_address3');
echo "<input type='text' name='patient_address3' value='".set_value('patient_address3',$init_patient_address3)."' size='50' /></td></tr>\n";

echo "\n<tr><td>Post Code</td><td>";
echo form_error('patient_postcode');
echo "<input type='text' name='patient_postcode' value='".set_value('patient_postcode',$init_patient_postcode)."' size='10' /></td></tr>\n";

echo "\n<tr>";
    echo "\n<td width='25%'>Village, Town, Area <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='addr_village_id' class='normal' onchange='javascript:selectLabPackage()' id='addr_village_id'>";
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:selectDiagnosisCategory()'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($addr_village_list as $addr_village)
        {
            echo "\n<option value='".rtrim($addr_village['addr_village_id'])."'";
            echo ($init_addr_village_id == rtrim($addr_village['addr_village_id']) ? " selected='selected'" : "");
            echo ">".$addr_village['addr_village_name']." , ".$addr_village['addr_town_name']." , ".$addr_village['addr_area_name']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

/*
echo "\n<tr>";
    echo "\n<td width='25%'>Area, District <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='addr_area_id' class='normal' onchange='javascript:selectLabPackage()' id='addr_area_id'>";
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:selectDiagnosisCategory()'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($addr_area_list as $addr_area)
        {
            echo "\n<option value='".rtrim($addr_area['addr_area_id'])."'";
            echo ($init_addr_area_id == rtrim($addr_area['addr_area_id']) ? " selected='selected'" : "");
            echo ">".$addr_area['addr_area_name']." , ".$addr_area['addr_district_name']."]</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";
*/

echo "\n<tr><td>Town</td><td>";
echo form_error('patient_town');
echo "<input type='text' name='patient_town' value='".set_value('patient_town',$init_patient_town)."' size='30' disabled='disabled' /></td></tr>\n";

echo "\n<tr><td>Area</td><td>";
echo $init_patient_area;
echo "</td></tr>\n";

echo "\n<tr><td>District</td><td>";
echo $init_patient_district;
echo "</td></tr>\n";

echo "\n<tr><td>State</td><td>";
echo form_error('patient_state');
echo "<input type='text' name='patient_state' value='".set_value('patient_state',$init_patient_state)."' size='30' disabled='disabled' /></td></tr>\n";

echo "\n<tr><td>Country</td><td>";
echo form_error('patient_country');
echo "<input type='text' name='patient_country' value='".set_value('patient_country',$init_patient_country)."' size='30' disabled='disabled' /></td></tr>\n";

echo "\n<tr><td>Tel. Home</td><td>";
echo form_error('tel_home');
echo "<input type='text' name='tel_home' value='".set_value('tel_home',$init_tel_home)."' size='15' /></td></tr>\n";

echo "\n<tr><td>Tel. Office</td><td>";
echo form_error('tel_office');
echo "<input type='text' name='tel_office' value='".set_value('tel_office',$init_tel_office)."' size='15' /></td></tr>\n";

echo "\n<tr><td>Tel. Mobile</td><td>";
echo form_error('tel_mobile');
echo "<input type='text' name='tel_mobile' value='".set_value('tel_mobile',$init_tel_mobile)."' size='15' /></td></tr>\n";

echo "\n<tr><td>e-mail</td><td>";
echo form_error('email');
echo "<input type='text' name='email' value='".set_value('email',$init_email)."' size='20' /></td></tr>\n";

echo "\n<tr><td>Fax No.</td><td>";
echo form_error('fax_no');
echo "<input type='text' name='fax_no' value='".set_value('fax_no',$init_fax_no)."' size='15' /></td></tr>\n";

echo "\n<tr><td>Pager No.</td><td>";
echo form_error('pager_no');
echo "<input type='text' name='pager_no' value='".set_value('pager_no',$init_pager_no)."' size='15' /></td></tr>\n";

echo "\n<tr><td>Other</td><td>";
echo form_error('contact_other');
echo "<input type='text' name='contact_other' value='".set_value('contact_other',$init_contact_other)."' size='30' /></td></tr>\n";

echo "\n<tr><td>Contact Remarks</td><td>";
echo form_error('contact_remarks');
echo "<input type='text' name='contact_remarks' value='".set_value('contact_remarks',$init_contact_remarks)."' size='80' /></td></tr>\n";

echo "\n</table>";
echo "\n</fieldset>";
echo "\n<fieldset>";
echo "<legend>DEMISE INFO</legend>";
echo "\n<table>";

echo "\n<tr><td>Demise Date</td><td>";
echo form_error('demise_date');
echo "<input type='text' name='demise_date' value='".set_value('demise_date',$init_demise_date)."' size='10' /> YYYY-MM-DD";

echo "\n<tr><td>Demise Time</td><td>";
echo form_error('demise_time');
echo "<input type='text' name='demise_time' value='".set_value('demise_time',$init_demise_time)."' size='10' />";

echo "\n<tr><td>Demise Cause</td><td>";
echo form_error('demise_cause');
echo "<input type='text' name='demise_cause' value='".set_value('demise_cause',$init_demise_cause)."' size='50' />";

echo "\n<tr><td>Death Cert No.</td><td>";
echo form_error('death_cert');
echo "<input type='text' name='death_cert' value='".set_value('death_cert',$init_death_cert)."' size='20' />";

echo "</table>";
echo "\n</fieldset>";
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $init_patient_id);
echo form_hidden('location_id', $init_location_id);
echo form_hidden('contact_id', $contact_id);
echo form_hidden('patient_status', $init_patient_status);
echo form_hidden('patient_town', $init_patient_town);
echo form_hidden('patient_state', $init_patient_state);
echo form_hidden('patient_country', $init_patient_country);

echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_patient"){
        echo "Add";
    } else {
        echo "Save";
    }
    echo " Patient Information' />";
echo "\n</center>";


echo "</form>";

echo "</div>";

