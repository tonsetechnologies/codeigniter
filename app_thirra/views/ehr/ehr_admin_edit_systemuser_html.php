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
    echo "\n<br />print_r(clinics_list)=<br />";
		print_r($clinics_list);
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />user_id = " . $user_id;
    print "\n<br />staff_id = " . $staff_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
    print "\n<br />init_password1 = " . $init_password1;
    echo "\n<br />print_r(user_info)=<br />";
		print_r($user_info);
    echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_edit_systemuser_html_title')."</h1></div>";

//echo validation_errors(); Displays ALL errors in one place.
echo form_open('ehr_admin/edit_systemuser/'.$form_purpose.'/'.$user_id);

echo "<fieldset>";
echo "<legend>System Info</legend>";
echo "\n<table>";
echo "\n<tr><td>Username <font color='red'>*</font></td><td>";
echo form_error('username');
echo "\n<input type='text' name='username' value='".set_value('username',$username)."' size='15' /></td></tr>";

echo "\n<tr><td>Password <font color='red'>*</font></td><td>";
echo form_error('password1');
echo "<input type='password' name='password1' value='".set_value('password1',$init_password1)."' size='15' autocomplete='off' /></td></tr>";

echo "\n<tr><td>Repeat Password</td><td>";
echo form_error('password2');
echo "<input type='password' name='password2' value='".set_value('password2',$init_password2)."' size='15' /></td></tr>";
/*
echo "\n<tr>";
    echo "\n<td width='200'>System Category <font color='red'>*</font></td>";
    echo "\n<td>";
        echo "\n<select name='category_id' class='normal' id='category_id'>";
            //echo "\n<option value='' >Please select one</option>";
            foreach($systemuser_categories as $systemuser_category)
            {
	            echo "\n<option value='".$systemuser_category['category_id']."' ";
                if(isset($category_id)) {
                    echo ($category_id==$systemuser_category['category_id'] ? " selected='selected'" : "");
                }
                echo ">".$systemuser_category['category_name']."&nbsp;-&nbsp;".$systemuser_category['description']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";
*/
echo "\n<tr>";
    echo "\n<td width='200'>Staff Category <font color='red'>*</font></td>";
    echo "\n<td>";
        echo "\n<select name='staff_category_id' class='normal' id='staff_category_id'>";
            //echo "\n<option value='' >Please select one</option>";
            foreach($staff_categories as $staff_category)
            {
	            echo "\n<option value='".$staff_category['category_id']."' ";
                if(isset($staff_category_id)) {
                    echo ($staff_category_id==$staff_category['category_id'] ? " selected='selected'" : "");
                }
                echo ">".$staff_category['category_name']."&nbsp;-&nbsp;".$staff_category['description']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Expiry Date <font color='red'>*</font></td><td>";
echo form_error('expiry_date');
echo "<input type='text' name='expiry_date' value='".set_value('expiry_date',$expiry_date)."' size='10' /> yyyy-mm-dd</td></tr>";
/*
echo "\n<tr><td>Access Status</td><td>";
echo form_error('access_status');
echo "<input type='text' name='access_status' value='".set_value('access_status',$access_status)."' size='5' /> </td></tr>";
*/
echo "\n</table>";
echo "</fieldset>";

echo "<fieldset>";
echo "<legend>Staff Info</legend>";
echo "\n<table>";

echo "\n<tr>";
    echo "\n<td>Home Clinic <font color='red'>*</font></td>";
    echo "\n<td>";
        echo "\n<select name='home_clinic' class='normal' id='home_clinic'>";
            //echo "\n<option value='' >Please select one</option>";
            foreach($clinics_list as $clinic_item)
            {
	            echo "\n<option value='".$clinic_item['clinic_info_id']."' ";
                if(isset($home_clinic)) {
                    echo ($home_clinic==$clinic_item['clinic_info_id'] ? " selected='selected'" : "");
                }
                echo ">".$clinic_item['clinic_name']."&nbsp;-&nbsp;".$clinic_item['country']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Staff Name <font color='red'>*</font></td><td>";
echo form_error('staff_name');
echo "<input type='text' name='staff_name' value='".set_value('staff_name',$staff_name)."' size='30' /></td></tr>";

echo "\n<tr><td>Staff Initials <font color='red'>*</font></td><td>";
echo form_error('staff_initials');
echo "\n<input type='text' name='staff_initials' value='".set_value('staff_initials',$staff_initials)."' size='10' /></td></tr>";

echo "\n<tr><td>License No.</td><td>";
echo form_error('mmc_no');
echo "\n<input type='text' name='mmc_no' value='".set_value('mmc_no',$mmc_no)."' size='10' /></td></tr>";

echo "\n<tr><td>Specialty</td><td>";
echo form_error('specialty');
    echo "\n<select name='specialty'>";
    if($specialty == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='GP' ".($specialty=='GP'?' selected=\'selected\'':'').">GP</option>";
    echo "\n<option value='Specialist' ".($specialty=='Specialist'?' selected=\'selected\'':'').">Specialist-Other</option>";
    echo "\n<option value='Specialist-Paediatrics' ".($specialty=='Specialist-Paediatrics'?' selected=\'selected\'':'').">Specialist-Paediatrics</option>";
    echo "\n<option value='Specialist-Surgery' ".($specialty=='Specialist-Surgery'?' selected=\'selected\'':'').">Specialist-Surgery</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Gender</td><td>";
echo form_error('gender');
    echo "\n<select name='gender'>";
    if($gender == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Male  ' ".($gender=='Male  '?' selected=\'selected\'':'').">Male</option>";
    echo "\n<option value='Female' ".($gender=='Female'?' selected=\'selected\'':'').">Female</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>IC No.</td><td>";
echo form_error('ic_no');
echo "\n<input type='text' name='ic_no' value='".set_value('ic_no',$ic_no)."' size='20' /></td></tr>";

echo "\n<tr><td>Other IC Type</td><td>";
echo form_error('ic_other_type');
echo "\n<input type='text' name='ic_other_type' value='".set_value('ic_other_type',$ic_other_type)."' size='30' /></td></tr>";

echo "\n<tr><td>Other IC No.</td><td>";
echo form_error('ic_other_no');
echo "\n<input type='text' name='ic_other_no' value='".set_value('ic_other_no',$ic_other_no)."' size='20' /></td></tr>";

echo "\n<tr><td>Nationality</td><td>";
echo form_error('nationality');
    echo "\n<select name='nationality'>";
    if($gender == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Malaysia' ".($nationality=='Malaysia  '?' selected=\'selected\'':'').">Malaysia</option>";
    echo "\n<option value='Nepal' ".($nationality=='Nepal'?' selected=\'selected\'':'').">Nepal</option>";
    echo "\n<option value='Pakistan' ".($nationality=='Pakistan'?' selected=\'selected\'':'').">Pakistan</option>";
    echo "\n<option value='Philippines' ".($nationality=='Philippines'?' selected=\'selected\'':'').">Philippines</option>";
    echo "\n<option value='Sri Lanka' ".($nationality=='Sri Lanka'?' selected=\'selected\'':'').">Sri Lanka</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Date of Birth</td><td>";
echo form_error('date_of_birth');
echo "\n<input type='text' name='date_of_birth' value='".set_value('date_of_birth',$date_of_birth)."' size='10' /> yyyy-mm-dd</td></tr>";

echo "\n<tr><td>Race</td><td>";
echo form_error('race');
echo "\n<input type='text' name='race' value='".set_value('race',$race)."' size='20' /></td></tr>";

echo "</table>";
echo "</fieldset>";

echo "<fieldset>";
echo "<legend>Contact Info</legend>";
echo "\n<table>";
echo "\n<tr><td width='200'>Address</td><td>";
echo form_error('address');
echo "\n<input type='text' name='address' value='".set_value('address',$address)."' size='50' /></td></tr>";

echo "\n<tr><td></td><td>";
echo form_error('address2');
echo "\n<input type='text' name='address2' value='".set_value('address2',$address2)."' size='50' /></td></tr>";

echo "\n<tr><td></td><td>";
echo form_error('address3');
echo "\n<input type='text' name='address3' value='".set_value('address3',$address3)."' size='50' /></td></tr>";

echo "\n<tr><td>Town</td><td>";
echo form_error('town');
echo "\n<input type='text' name='town' value='".set_value('town',$town)."' size='30' /></td></tr>";

echo "\n<tr><td>State</td><td>";
echo form_error('state');
echo "\n<input type='text' name='state' value='".set_value('state',$state)."' size='30' /></td></tr>";

echo "\n<tr><td>Post Code</td><td>";
echo form_error('postcode');
echo "\n<input type='text' name='postcode' value='".set_value('postcode',$postcode)."' size='10' /></td></tr>";

echo "\n<tr><td>Country</td><td>";
echo form_error('country');
echo "\n<input type='text' name='country' value='".set_value('country',$country)."' size='20' /></td></tr>";

echo "\n<tr><td>Home Tel.</td><td>";
echo form_error('tel_home');
echo "\n<input type='text' name='tel_home' value='".set_value('tel_home',$tel_home)."' size='20' /></td></tr>";

echo "\n<tr><td>Mobile Tel.</td><td>";
echo form_error('tel_mobile');
echo "\n<input type='text' name='tel_mobile' value='".set_value('tel_mobile',$tel_mobile)."' size='20' /></td></tr>";

echo "\n<tr><td>e-mail</td><td>";
echo form_error('email');
echo "\n<input type='text' name='email' value='".set_value('email',$email)."' size='30' /></td></tr>";

echo "</table>";
echo "</fieldset>";

echo form_hidden('now_id', $now_id);
echo form_hidden('user_id', $user_id);
echo form_hidden('staff_id', $staff_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Save' />";
echo "</div>";

echo "</form>";

echo "</div>"; //id=content

