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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

//include_once("header_xhtml1-strict.php");
//include_once("header_xhtml1-transitional.php");

$ideal_field_length = 25;

echo "\n\n<div id='content'>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    echo '<pre>';
    print "\n<br />offline_mode = " . $offline_mode;
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(clinic_info)=<br />";
		print_r($clinic_info);
    echo "\n<br />print_r(village_info)=<br />";
		print_r($village_info);
    echo "\n<br />print_r(registered_clinic)=<br />";
		print_r($registered_clinic);
    echo "\n<br />print_r(clinics_list)=<br />";
		print_r($clinics_list);
    echo "\n<br />print_r(broken_birth_date)=<br />";
		print_r($broken_birth_date);
    echo "\n<br />print_r(broken_now_date)=<br />";
		print_r($broken_now_date);
    echo "\n<br />print_r(addr_village_list)=<br />";
		print_r($addr_village_list);
    echo "\n<br />print_r(addr_area_list)=<br />";
		print_r($addr_area_list);
    echo "\n<br />print_r(family_above)=<br />";
		print_r($family_above);
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />offline_mode = " . $offline_mode;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />patient_id = " . $patient_id;
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username');
    print "<br />location_id = " . $this->session->userdata('location_id');
    print "\n<br />init_birth_date = " . $init_birth_date;
    print "\n<br />init_age = " . $init_age;
    print "\n<br />init_birth_date_estimate = " . $init_birth_date_estimate;
    echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('12100-100_patients_edit_patient_html_title')."</h1></div>";

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<h2>".$save_attempt."</h2>";

if($app_country == "Nepal"){
    ?>
    <div align="justify">
    <iframe name="I1" src="http://www.ashesh.com.np/linkdate-converter.php" width="438" height="200" border="0" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" allowtransparency="true">
    </iframe><br>
    <?php
    //<a title="Nepali Date Converter, Nepali Date, Date Converter"href="http://www.ashesh.com.np/nepali-date-converter.php">Date Converter</a></div>
} //endif($app_country == "Nepal")

$attributes =   array('class' => 'select_form', 'id' => 'patient_form', 'name' => 'patient_form');
echo form_open('indv/indv/index/indv_overview/ehr_individual/edit_patient/'.$form_purpose.'/'.$patient_id, $attributes);
//echo "\n<div name='expand' id='expand'  onclick='javascript:selectHeadOfFamily()' >Expand</div>";
echo "\n<fieldset>";
echo "<legend>CLINIC INFO</legend>";
echo "\n<table class='valigntop'>";

echo "\n<tr><td width='200'>Clinic Ref.</td><td>";
echo form_error('clinic_reference_number');
echo "\n<input type='text' name='clinic_reference_number' value='".set_value('clinic_reference_number',$init_clinic_reference_number)."' size='20' /></td></tr>";

echo "<tr>";
    echo "\n<td width='25%'>Home Clinic</td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='clinic_home' class='normal'  id='clinic_home'>";
        foreach($clinics_list as $clinic)
        {
            echo "\n<option value='".$clinic['clinic_info_id']."'";
            //echo "\n<option label='".$clinic['clinic_info_id']."' value='".$clinic['clinic_info_id']."'";
            echo ($init_clinic_home == $clinic['clinic_info_id'] ? " selected='selected'" : "");
            echo ">".$clinic['clinic_name']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Clinic Registered</td><td>";
echo $clinic_registered_name."</td></tr>";

echo "</table>";
echo "\n</fieldset>";

if(isset($duplicate_patient)){
    echo "\n<fieldset>";
    echo "<legend><font color='red'>POSSIBLE DUPLICATE(S)</font></legend>";
    echo "\n<table>";
        echo "\n<tr><td>Click to check";
        echo "\n<ol>";
        foreach($duplicate_patient as $others){
            echo "\n<li>";//.$others['name'].", ".$others['name_first']." (".$others['birth_date'].") ".
	        echo anchor('indv/indv/index/indv_overview/ehr_individual/individual_overview/overview/'.$others['patient_id'], "<strong>".$others['name']."</strong>, ".$others['name_first']." (".$others['birth_date'].") ", 'target="_blank"');
            echo $others['ic_no']." : ".$others['clinic_reference_number']."</li>";
        }
        echo "\n</ol>";
        echo "</td>";
    echo "</table>";
    echo "\n</fieldset>";
}

echo "\n<fieldset>";
echo "<legend>BIO DATA</legend>";
echo "\n<table class='valigntop'>";
echo "\n<tr><td width='200'>Last Name <font color='red'>*</font></td><td>";
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
echo "<input type='text' name='ic_other_no' value='".set_value('ic_other_no',$init_ic_other_no)."' size='15' /> </td></tr>";

echo "\n<tr><td>Other IC Type</td><td>";
echo form_error('ic_other_type');
echo "<input type='text' name='ic_other_type' value='".set_value('ic_other_type',$init_ic_other_type)."' size='20' /> </td></tr>";

echo "\n<tr><td>NHFA No.</td><td>";
echo form_error('nhfa_no');
echo "<input type='text' name='nhfa_no' value='".set_value('nhfa_no',$init_nhfa_no)."' size='15' /> </td></tr>";

echo "\n<tr><td>PNS Patient No.</td><td>";
echo form_error('pns_pat_id');
echo "<input type='text' name='pns_pat_id' value='".set_value('pns_pat_id',$init_pns_pat_id)."' size='15' /> </td></tr>";

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

echo "\n<tr><td>Birth Date estimated</td><td>";
echo form_error('birth_date_estimate');
echo "\n<select class='normal' name='birth_date_estimate' id='birth_date_estimate' onChange='inputAge(this);'>";          
    echo "\n<option value='TRUE' ";
    $age_estimated_selected =   "selected='selected'";
    if($init_birth_date_estimate=="TRUE"){
        echo $age_estimated_selected;
        $age_estimated_selected =   "";
    }
    //($init_birth_date_estimate===TRUE?"selected='selected'":"")
    echo ">Yes</option>";
    echo "\n<option value='FALSE' ";
    echo $age_estimated_selected;
    //($init_birth_date_estimate<>TRUE?"selected='selected'":"").
    echo ">No</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";
/*
echo "\n<tr><td>birth_date_estimate </td><td>";
echo form_error('birth_date_estimate');
echo "<input type='text' name='birth_date_estimate' id='birth_date_estimate' value='".set_value('birth_date_estimate',$init_birth_date_estimate)."' size='4' /> years old</td></tr>";
*/
echo "\n<tr><td>Age </td><td>";
echo form_error('age');
//echo "\n<input type='text' name='age' id='age' value='".set_value('age',$init_age)."' size='4'  /> years old</td></tr>";
echo "\n<input type='text' name='age' id='age' value='".set_value('age',$init_age)."' size='4' ".($init_birth_date_estimate=='TRUE'?"":"disabled='disabled'")." /> years old</td></tr>";

echo "\n<tr><td>Birth Date  <font color='red'>*</font></td><td>";
echo form_error('birth_date');
//echo "\n<input type='text' name='birth_date' id='birth_date' value='".set_value('birth_date',$init_birth_date)."' size='10'  /> YYYY-MM-DD</td></tr>";
echo "\n<input type='text' name='birth_date' id='birth_date' value='".$init_birth_date."' size='10' ".($init_birth_date_estimate=='FALSE'?"":"disabled='disabled'")." /> YYYY-MM-DD</td></tr>";
//echo "\n<input type='text' name='birth_date' id='birth_date' value='".set_value('birth_date',$init_birth_date)."' size='10' ".($init_birth_date_estimate=='FALSE'?"":"disabled='disabled'")." /> YYYY-MM-DD</td></tr>";

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

echo "\n<tr><td>Work Position</td><td>";
echo form_error('job_function');
echo "<input type='text' name='job_function' value='".set_value('job_function',$init_job_function)."' size='30' /> </td></tr>";

echo "\n<tr>";
    echo "\n<td valign='top'>Education Level</td>";
    echo "\n<td>";
    echo "\n<select name='education_level' class='normal' id='education_level'>";
        echo "\n<option value='' >Please select highest level</option>";
        foreach($education_levels_list as $education)
        {
            echo "\n<option value='".$education['institution']."' ";
            if(isset($init_education_level)) {
                echo ($init_education_level==$education['institution'] ? " selected='selected'" : "");
            }
            echo ">".$education['institution']."</option>";
        } //foreach
    echo "\n</select>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Patient Type</td><td>";
echo form_error('patient_type');
echo "<input type='text' name='patient_type' value='".set_value('patient_type',$init_patient_type)."' size='30' /> </td></tr>";

echo "\n<tr><td>Blood Group</td><td>";
echo form_error('blood_group');
    echo "\n<select name='blood_group'>";
    //if($init_blood_group == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value=''".($init_blood_group==NULL?' selected=\'selected\'':'').">Please select one</option>";
    echo "\n<option value='O'".($init_blood_group=='O '?' selected=\'selected\'':'').">O</option>";
    echo "\n<option value='A'".($init_blood_group=='A '?' selected=\'selected\'':'').">A</option>";
    echo "\n<option value='B'".($init_blood_group=='B '?' selected=\'selected\'':'').">B</option>";
    echo "\n<option value='AB'".($init_blood_group=='AB'?' selected=\'selected\'':'').">AB</option>";
    echo "\n</select>";
//echo form_error('ethnicity');
//echo "<input type='text' name='blood_group' value='".set_value('blood_group',$init_blood_group)."' size='3' /> ";

echo "\n Rhesus Factor";
echo form_error('blood_rhesus');
    echo "\n<select name='blood_rhesus'>";
    //if($init_blood_rhesus == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value=''".($init_blood_rhesus==NULL?' selected=\'selected\'':'').">Please select one</option>";
    echo "\n<option value='positive'".($init_blood_rhesus=='positive'?' selected=\'selected\'':'').">positive</option>";
    echo "\n<option value='negative'".($init_blood_rhesus=='negative'?' selected=\'selected\'':'').">negative</option>";
    echo "\n</select>";

echo "\n<tr><td>Remarks</td><td>";
echo form_error('patdemo_remarks');
echo "\n<textarea class='normal' name='patdemo_remarks' id='patdemo_remarks' cols='40' rows='4'>".$init_patdemo_remarks."</textarea>";
//echo "<input type='text' name='patdemo_remarks' value='".set_value('patdemo_remarks',$init_patdemo_remarks)."' size='80' /> 
echo "</td></tr>";

echo "\n<tr><td>&nbsp;</td></tr>";
echo "\n</table>";

echo "\n</fieldset>";
echo "\n<fieldset>";
echo "<legend>CONTACT INFO</legend>";
echo "\n<table class='valigntop'>";

echo "\n<tr><td width='200'>Address</td><td>";
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
/*
echo "\n<tr>";
    echo "\n<td>Village, Town, Area <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo form_error('addr_village_id');
    echo "\n<select name='addr_village_id' class='normal' onchange='javascript:selectLabPackage()' id='addr_village_id'>";
        echo "\n<option value=''";
        //echo "\n<option label='' value='0'";
        // selected='selected'
        echo ">Please select one</option>";
        foreach($addr_village_list as $addr_village)
        {
            $repeat_space = $ideal_field_length - strlen($addr_village['addr_village_name']);
            if($repeat_space < 1){
                $repeat_space = 0;
            }
            echo "\n<option value='".rtrim($addr_village['addr_village_id'])."'";
            echo ($init_addr_village_id == rtrim($addr_village['addr_village_id']) ? " selected='selected'" : "");
            echo " class='monosp'>".$addr_village['addr_village_name'];
            echo str_repeat("&nbsp;",$repeat_space);
            echo $addr_village['addr_town_name']." , ".$addr_village['addr_area_name']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

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
*/
// AJAX ->

echo "\n<tr><td>Village / Barangay <span class='mandatory_field'>*</span></td><td>";
echo form_error('addr_village_id');
echo "\n<div id='address_village_select'>";
    echo "\n<select name='addr_village_id' class='normal' id='addr_village_id'>";
        echo "\n<option value='0' selected='selected'></option>";
        foreach($addr_villages_list as $village_item)
        {
            echo "\n<option value='".$village_item['addr_village_id']."'";
            echo ($init_addr_village_id == $village_item['addr_village_id'] ? " selected='selected'" : "");
            echo ">".$village_item['addr_village_name']."</option>";
        }
        echo ">All</option>";
        echo "</select>";
echo "</div>";
echo "</td></tr>\n";

echo "\n<tr><td>Town</td><td>";
echo "\n<div id='address_town_select'>";
    echo "\n<select name='addr_town_id' class='normal' id='addr_town_id'>";
        echo "\n<option value='0' selected='selected'></option>";
        foreach($addr_town_list as $town_item)
        {
            echo "\n<option value='".$town_item['addr_town_id']."'";
            echo ($init_addr_town_id == $town_item['addr_town_id'] ? " selected='selected'" : "");
            echo ">".$town_item['addr_town_name']."</option>";
        }
        echo "</select>";
echo "</div>";
echo "</td></tr>\n";

echo "\n<tr><td>Area</td><td>";
echo "\n<div id='address_area_select'>";
    echo "\n<select name='addr_area_id' class='normal' id='addr_area_id'>";
        echo "\n<option value='0' selected='selected'></option>";
        foreach($addr_area_list as $area_item)
        {
            echo "\n<option value='".$area_item['addr_area_id']."'";
            echo ($init_addr_area_id == $area_item['addr_area_id'] ? " selected='selected'" : "");
            echo ">".$area_item['addr_area_name']."</option>";
        }
        echo "</select>";
echo "</div>";
echo "</td></tr>\n";

echo "\n<tr><td>District</td><td>";
echo "\n<div id='address_district_select'>";
    echo "\n<select name='addr_district_id' class='normal' id='addr_district_id'>";
        echo "\n<option value='0' selected='selected'></option>";
        foreach($addr_district_list as $district_item)
        {
            echo "\n<option value='".$district_item['addr_district_id']."'";
            echo ($init_addr_district_id == $district_item['addr_district_id'] ? " selected='selected'" : "");
            echo ">".$district_item['addr_district_name']."</option>";
        }
        echo "</select>";
echo "</div>";
echo "</td></tr>\n";

echo "\n<tr><td>State</td><td>";
echo "\n<div id='address_state_select'>";
    echo "\n<select name='addr_state_id' class='normal' id='addr_state_id'>";
        echo "\n<option value='0' selected='selected'></option>";
        foreach($addr_state_list as $state_item)
        {
            echo "\n<option value='".$state_item['addr_state_id']."'";
            echo ($init_addr_state_id == $state_item['addr_state_id'] ? " selected='selected'" : "");
            echo ">".$state_item['addr_state_name']."</option>";
        }
        echo "</select>";
echo "</div>";
echo "</td></tr>\n";

echo "\n<tr><td>Country</td><td>";
echo "\n<div id='address_country_select'>";
    echo "\n<select name='patient_country' class='normal' id='patient_country'>";
        echo "\n<option value='0' selected='selected'></option>";
        foreach($addr_country_list as $country_item)
        {
            echo "\n<option value='".$country_item['addr_country_name']."'";
            echo ($init_patient_country == $country_item['addr_country_name'] ? " selected='selected'" : "");
            echo ">".$country_item['addr_country_name']."</option>";
        }
        echo "</select>";
echo "</div>";
echo "</td></tr>\n";

// -> AJAX
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
echo "\n<textarea class='normal' name='contact_remarks' id='contact_remarks' cols='40' rows='4'>".$init_contact_remarks."</textarea>";
//echo "<input type='text' name='contact_remarks' value='".set_value('contact_remarks',$init_contact_remarks)."' size='80' />
echo "</td></tr>\n";

echo "\n</table>";
echo "\n</fieldset>";

echo "\n<fieldset>";
echo "<legend>LEGACY INFO</legend>";
echo "\n<table>";

echo "\n<tr>";
    echo "\n<td valign='top'>Is kin a registered patient?</td>";
    echo "\n<td>";
    echo "\n<select name='next_of_kin_id' class='normal' id='next_of_kin_id'>";
        echo "\n<option value='' >No, not inside database</option>";
        if(count($family_above) > 0) {
            foreach($family_above as $kid)
            {
                echo "\n<option value='".$kid['patient_id']."' ";
                if(isset($init_next_of_kin_id)) {
                    echo ($init_next_of_kin_id==$kid['patient_id'] ? " selected='selected'" : "");
                }
                echo ">".$kid['name'].", ".$kid['name_first']." - ".$kid['birth_date']."</option>";
            } //foreach
        }
        if(count($family_below) > 0) {
            foreach($family_below as $kid)
            {
                echo "\n<option value='".$kid['patient_id']."' ";
                if(isset($init_next_of_kin_id)) {
                    echo ($init_next_of_kin_id==$kid['patient_id'] ? " selected='selected'" : "");
                }
                echo ">".$kid['name'].", ".$kid['name_first']." - ".$kid['birth_date']."</option>";
            } //foreach
        }
    echo "\n</select>";
    // Provide link to retrieve record if relationship is established
    if(!empty($init_next_of_kin_id)) {
        echo "\n&nbsp;&nbsp;";
        echo anchor('ehr_individual/individual_overview/'.$init_next_of_kin_id, "<strong>View kin</strong>", 'target="_blank"');
    }
    echo "\n</td>";
echo "\n</tr>";
 

echo "\n<tr><td>Next-of-kin's Name</td><td>";
echo form_error('next_of_kin_name');
echo "<input type='text' name='next_of_kin_name' value='".set_value('next_of_kin_name',$init_next_of_kin_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Next-of-kin Relationship</td><td>";
echo form_error('next_of_kin_relationship');
echo "<input type='text' name='next_of_kin_relationship' value='".set_value('next_of_kin_relationship',$init_next_of_kin_relationship)."' size='30' /></td></tr>";

echo "\n<tr><td width='200'>Demise Date</td><td>";
echo form_error('demise_date');
echo "<input type='text' name='demise_date' value='".set_value('demise_date',$init_demise_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Demise Time</td><td>";
echo form_error('demise_time');
echo "<input type='text' name='demise_time' value='".set_value('demise_time',$init_demise_time)."' size='10' /></td></tr>";

echo "\n<tr><td>Demise Cause</td><td>";
echo form_error('demise_cause');
echo "<input type='text' name='demise_cause' value='".set_value('demise_cause',$init_demise_cause)."' size='50' /></td></tr>";

echo "\n<tr><td>Death Cert No.</td><td>";
echo form_error('death_cert');
echo "<input type='text' name='death_cert' value='".set_value('death_cert',$init_death_cert)."' size='20' /></td></tr>";

echo "</table>";
echo "\n</fieldset>";
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $init_patient_id);
echo form_hidden('location_id', $init_location_id);
echo form_hidden('contact_id', $contact_id);
echo form_hidden('patient_status', $init_patient_status);
echo form_hidden('patient_town', $init_patient_town);
echo form_hidden('patient_state', $init_patient_state);
//echo form_hidden('patient_country', $init_patient_country);
echo form_hidden('synch_out', $init_synch_out);

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

// Set for AJAX calling
$siteurl_state_name    =   site_url()."/ehr_ajax/get_address_state_names";
$siteurl_district_name    =   site_url()."/ehr_ajax/get_address_district_names";
$siteurl_area_name    =   site_url()."/ehr_ajax/get_address_area_names";
$siteurl_town_name    =   site_url()."/ehr_ajax/get_address_town_names";
$siteurl_village_name    =   site_url()."/ehr_ajax/get_address_village_names";
//echo $siteurl;
?>
<script  type="text/javascript">

    $(document).ready(function() {
        $('#address_country_select').delegate('select','change',function (){
            ajax_state_name()}
            );
        $('#address_state_select').delegate('select','change',function (){
            ajax_district_name()}
            );
        $('#address_district_select').delegate('select','change',function (){
            ajax_area_name()}
            );
        $('#address_area_select').delegate('select','change',function (){
            ajax_town_name()}
            );
        $('#address_town_select').delegate('select','change',function (){
            ajax_village_name()}
            );
        $('#doseform').delegate('select','change',function (){
            write_doseform()}
            );
        return false;
      })


    $(function() {
        $( "#birth_date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c'
        });
    });


    function inputAge(obj)
    {
         txt1 = obj.value;
         if (txt1  == "FALSE") 
         {
            document.patient_form.birth_date.disabled = false;
            document.patient_form.age.disabled = true;
            //document.form.age.value = "";
            document.patient_form.birth_date.style.backgroundColor="#FFFFFF";
            document.patient_form.age.style.backgroundColor="#CCCCCC";
         }
         else {
            document.patient_form.birth_date.disabled = true;
            document.patient_form.age.disabled = false;
            document.patient_form.birth_date.style.backgroundColor="#CCCCCC";
            document.patient_form.age.style.backgroundColor="#FFFFFF";
         }

         return true;
    }


    function ajax_state_name() {
        var siteurl = "<?php echo $siteurl_state_name; ?>";
        var ajax_address_country = $('#patient_country').val();
        var data = 'ajax_address_country='+ajax_address_country;
        //alert(siteurl+' '+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            $('#address_state_select').html(result);
          }
        }
    )}


    function ajax_district_name() {
        var siteurl = "<?php echo $siteurl_district_name; ?>";
        //var ajax_patient_country = "<?php echo $init_patient_country; ?>";
        var ajax_address_country = $('#patient_country').val();
        var ajax_address_state = $('#addr_state_id').val();
        var data = 'ajax_address_country='+ajax_address_country+'&ajax_address_state=' + ajax_address_state;
        //alert(siteurl+' '+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            $('#address_district_select').html(result);
          }
        }
    )}


    function ajax_area_name() {
        var siteurl = "<?php echo $siteurl_area_name; ?>";
        //var ajax_patient_country = "<?php echo $init_patient_country; ?>";
        var ajax_address_country = $('#patient_country').val();
        var ajax_address_district = $('#addr_district_id').val();
        var data = 'ajax_address_country='+ajax_address_country+'&ajax_address_district=' + ajax_address_district;
        //alert(siteurl+' '+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            var multi_part  =   result.split("|=|");
            $('#address_area_select').html(multi_part[0]);
            $('#address_town_select').html(multi_part[1]);
            $('#address_village_select').html(multi_part[2]);
          }
        }
    )}


    function ajax_town_name() {
        var siteurl = "<?php echo $siteurl_town_name; ?>";
        //var ajax_patient_country = "<?php echo $init_patient_country; ?>";
        var ajax_address_country = $('#patient_country').val();
        var ajax_address_area = $('#addr_area_id').val();
        var data = 'ajax_address_country='+ajax_address_country+'&ajax_address_area=' + ajax_address_area;
        //alert(siteurl+' '+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            var multi_part  =   result.split("|=|");
            $('#address_town_select').html(multi_part[0]);
            $('#address_village_select').html(multi_part[1]);
          }
        }
    )}


    function ajax_village_name() {
        var siteurl = "<?php echo $siteurl_village_name; ?>";
        //var ajax_patient_country = "<?php echo $init_patient_country; ?>";
        var ajax_address_country = $('#patient_country').val();
        var ajax_address_town = $('#addr_town_id').val();
        var data = 'ajax_address_country='+ajax_address_country+'&ajax_address_town=' + ajax_address_town;
        //alert(siteurl+' '+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            $('#address_village_select').html(result);
          }
        }
    )}


    function write_doseform() {
        var qty_dose_form = $('#dose_form').val();
        //alert(qty_dose_form);
        $('#qty_doseform').html(qty_dose_form);

    }


    function deleteRecord($action, $name, $link){            
        if(confirm("Are you sure you want to " + $action + " this " + $name + " ?")){
            window.open($link, "_top");
        }
    }



</script>

