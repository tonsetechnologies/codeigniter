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

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(clinic_info)=<br />";
		print_r($clinic_info);
    echo "\n<br />print_r(addr_area_info)=<br />";
		print_r($addr_area_info);
    echo "\n<br />print_r(village_info)=<br />";
		print_r($village_info);
    echo "\n<br />print_r(addr_village_list)=<br />";
		print_r($addr_village_list);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />clinic_info_id=".$clinic_info_id;
    echo "\n<br />addr_area_id=".$addr_area_id;
    echo "\n<br />init_addr_state_id=".$init_addr_state_id;
    echo "\n<br />init_addr_district_id=".$init_addr_district_id;
    echo "\n<br />init_addr_area_id=".$init_addr_area_id;
    echo "\n<br />init_addr_town_id=".$init_addr_town_id;
    echo "\n<br />init_addr_village_id=".$init_addr_village_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_edit_clinic_info_html_title')."</h1></div>";


$attributes =   array('class' => 'select_form', 'id' => 'clinic_form');
echo form_open('ehr_admin/admin_edit_clinic_info/'.$form_purpose.'/'.$clinic_info_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('clinic_info_id', $clinic_info_id);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td width='200'>Clinic Name <font color='red'>*</font></td><td>";
echo form_error('clinic_name');
echo "<input type='text' name='clinic_name' value='".set_value('clinic_name',$init_clinic_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Clinic Ref. No. <font color='red'>*</font></td><td>";
echo form_error('clinic_ref_no');
echo "<input type='text' name='clinic_ref_no' value='".set_value('clinic_ref_no',$init_clinic_ref_no)."' size='10' /></td></tr>";

echo "\n<tr><td>Clinic Short Name <font color='red'>*</font></td><td>";
echo form_error('clinic_shortname');
echo "<input type='text' name='clinic_shortname' value='".set_value('clinic_shortname',$init_clinic_shortname)."' size='30' /></td></tr>";

echo "\n<tr><td>Listing Sort Order</td><td>";
echo form_error('sort_clinic');
echo "<input type='text' name='sort_clinic' value='".set_value('sort_clinic',$init_sort_clinic)."' size='5' /></td></tr>";

echo "\n<tr><td>Time Open</td><td>";
echo form_error('time_open');
echo "<input type='text' name='time_open' value='".set_value('time_open',$init_time_open)."' size='8' /></td></tr>";

echo "\n<tr><td>Time Close</td><td>";
echo form_error('time_close');
echo "<input type='text' name='time_close' value='".set_value('time_close',$init_time_close)."' size='8' /></td></tr>";

echo "\n<tr><td>Address</td><td>";
echo form_error('address');
echo "<input type='text' name='address' value='".set_value('addr_address',$init_address)."' size='50' /></td></tr>";

echo "\n<tr><td>Address2</td><td>";
echo form_error('address2');
echo "<input type='text' name='address2' value='".set_value('address2',$init_address2)."' size='50' /></td></tr>";

echo "\n<tr><td>Post Code</td><td>";
echo form_error('postcode');
echo "<input type='text' name='postcode' value='".set_value('postcode',$init_postcode)."' size='10' /></td></tr>";

echo "\n<tr>";
    echo "\n<td>Village, Town, Area <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo form_error('addr_village_id');
    echo "\n<select name='addr_village_id' class='normal' onchange='javascript:selectArea()' id='addr_village_id'>";
        echo "\n<option label='' value='' selected='selected'></option>";
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
            echo $addr_village['addr_town_name'].", &nbsp;".$addr_village['addr_area_name']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Address3</td><td>";
echo form_error('address3');
//echo "<input type='text' name='address3' value='".set_value('address3',$init_address3)."' size='50' /></td></tr>";
echo $init_address3."</td></tr>";

echo "\n<tr><td>Town</td><td>";
echo form_error('town');
//echo "<input type='text' name='town' value='".set_value('town',$init_town)."' size='30' /></td></tr>";
echo $init_town."</td></tr>";

echo "\n<tr><td>State</td><td>";
echo form_error('state');
//echo "<input type='text' name='state' value='".set_value('state',$init_state)."' size='20' /></td></tr>";
echo $init_state."</td></tr>";

echo "\n<tr><td>Country</td><td>";
echo form_error('country');
//echo "<input type='text' name='country' value='".set_value('country',$init_country)."' size='20' /></td></tr>";
echo $init_country."</td></tr>";

echo "\n<tr><td>Tel. No.1</td><td>";
echo form_error('tel_no');
echo "<input type='text' name='tel_no' value='".set_value('tel_no',$init_tel_no)."' size='20' /></td></tr>";

echo "\n<tr><td>Tel. No.2</td><td>";
echo form_error('tel_no2');
echo "<input type='text' name='tel_no2' value='".set_value('tel_no2',$init_tel_no2)."' size='20' /></td></tr>";

echo "\n<tr><td>Tel. No.3</td><td>";
echo form_error('tel_no3');
echo "<input type='text' name='tel_no3' value='".set_value('tel_no3',$init_tel_no3)."' size='20' /></td></tr>";

echo "\n<tr><td>Fax No.1</td><td>";
echo form_error('fax_no');
echo "<input type='text' name='fax_no' value='".set_value('fax_no',$init_fax_no)."' size='20' /></td></tr>";

echo "\n<tr><td>Fax No.2</td><td>";
echo form_error('fax_no2');
echo "<input type='text' name='fax_no2' value='".set_value('fax_no2',$init_fax_no2)."' size='20' /></td></tr>";

echo "\n<tr><td>e-mail</td><td>";
echo form_error('email');
echo "<input type='text' name='email' value='".set_value('email',$init_email)."' size='30' /></td></tr>";

echo "\n<tr><td>Other</td><td>";
echo form_error('other');
echo "<input type='text' name='other' value='".set_value('other',$init_other)."' size='50' /></td></tr>";

echo "\n<tr><td>Date Established</td><td>";
echo form_error('established');
echo "<input type='text' name='established' value='".set_value('established',$init_established)."' size='10' /></td></tr>";

echo "\n<tr><td>Owner_type</td><td>";
echo form_error('owner_type');
echo "<input type='text' name='owner_type' value='".set_value('owner_type',$init_owner_type)."' size='30' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Clinic Manager</td>";
    echo "\n<td colspan='2' class='red'>";
        echo form_error('manager_id');
        echo "\n<select name='manager_id' class='normal' id='manager_id'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($staff_list as $person)
            {
	            echo "\n<option value='".$person['staff_id']."' ";
                if(isset($init_manager_id)) {
                    echo ($init_manager_id==$person['staff_id'] ? " selected='selected'" : "");
                }
                echo ">".$person['staff_name']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Clinic Owner</td>";
    echo "\n<td colspan='2' class='red'>";
        echo form_error('owner_id');
        echo "\n<select name='owner_id' class='normal' id='owner_id'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($staff_list as $person)
            {
	            echo "\n<option value='".$person['staff_id']."' ";
                if(isset($init_owner_id)) {
                    echo ($init_owner_id==$person['staff_id'] ? " selected='selected'" : "");
                }
                echo ">".$person['staff_name']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>health_department_id</td><td>";
echo form_error('health_department_id');
echo "<input type='text' name='health_department_id' value='".set_value('health_department_id',$init_health_department_id)."' size='10' /></td></tr>";

echo "\n<tr><td>Remarks</td><td>";
echo form_error('remarks');
echo "<input type='text' name='remarks' value='".set_value('remarks',$init_remarks)."' size='100' /></td></tr>";

echo "\n<tr><td>PCDOM Ref.</td><td>";
echo form_error('pcdom_ref');
echo "<input type='text' name='pcdom_ref' value='".set_value('pcdom_ref',$init_pcdom_ref)."' size='30' /></td></tr>";

echo "\n<tr><td>Markup 1</td><td>";
echo form_error('markup_1');
echo "<input type='text' name='markup_1' value='".set_value('markup_1',$init_markup_1)."' size='5' /> %</td></tr>";

echo "\n<tr><td>Markup 2</td><td>";
echo form_error('markup_2');
echo "<input type='text' name='markup_2' value='".set_value('markup_2',$init_markup_2)."' size='5' /> %</td></tr>";

echo "\n<tr><td>Markup 3</td><td>";
echo form_error('markup_3');
echo "<input type='text' name='markup_3' value='".set_value('markup_3',$init_markup_3)."' size='5' /> %</td></tr>";

echo "\n<tr><td>Locale</td><td>";
echo form_error('locale');
echo "<input type='text' name='locale' value='".set_value('locale',$init_locale)."' size='30' /></td></tr>";

echo "\n<tr><td>clinic_privatekey</td><td>";
echo form_error('clinic_privatekey');
echo "<input type='text' name='clinic_privatekey' value='".set_value('clinic_privatekey',$init_clinic_privatekey)."' size='30' /></td></tr>";

echo "\n<tr><td>clinic_publickey</td><td>";
echo form_error('clinic_publickey');
echo "<input type='text' name='clinic_publickey' value='".set_value('clinic_publickey',$init_clinic_publickey)."' size='30' /></td></tr>";

echo "\n<tr><td>Clinic Status</td><td>";
echo form_error('clinic_status');
echo "<input type='text' name='clinic_status' value='".set_value('clinic_status',$init_clinic_status)."' size='30' /></td></tr>";

echo "\n<tr><td>GPS Lat</td><td>";
echo form_error('clinic_gps_lat');
echo "<input type='text' name='clinic_gps_lat' value='".set_value('clinic_gps_lat',$init_clinic_gps_lat)."' size='20' /></td></tr>";

echo "\n<tr><td>GPS Long</td><td>";
echo form_error('clinic_gps_long');
echo "<input type='text' name='clinic_gps_long' value='".set_value('clinic_gps_long',$init_clinic_gps_long)."' size='20' /></td></tr>";

echo "\n<tr><td>Clinic Type</td><td>";
echo form_error('clinic_type');
echo "<input type='text' name='clinic_type' value='".set_value('clinic_type',$init_clinic_type)."' size='30' /></td></tr>";

if($form_purpose == "new_clinic"){
    echo "\n<tr><td>First Department Name</td><td>";
    echo form_error('dept_name');
    echo "<input type='text' name='dept_name' value='".set_value('dept_name',$init_dept_name)."' size='50' /></td></tr>";

    echo "\n<tr><td>Department Short Name</td><td>";
    echo form_error('dept_shortname');
    echo "<input type='text' name='dept_shortname' value='".set_value('dept_shortname',$init_dept_shortname)."' size='20' /></td></tr>";
}

echo "\n<tr><td>clinic_district_id</td><td>";
echo form_error('clinic_district_id');
echo "<input type='text' name='clinic_district_id' value='".set_value('clinic_district_id',$init_clinic_district_id)."' size='10' /></td></tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_clinic"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Clinic' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

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


