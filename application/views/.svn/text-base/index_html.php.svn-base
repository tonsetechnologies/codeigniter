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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

//include_once("header_xhtml1-strict.php");
include_once("header_xhtml1-transitional.php");

echo "\n<body>";
echo "<h6>";
include_once("version.php");

echo "<p>";
echo $this->config->item('app_name')." Version ";
if("THIRRA" == $this->config->item('app_name')){
    echo $base_version;
} else {
    echo $alt_version;
}
echo $app_version." Build ".$svn_build;

echo "\n<br />".$agent . " " . $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
if ("Unknown Platform" == $this->agent->platform()){
    echo " - Mobile Device Mode";
} else {
    echo " - Desktop Mode";
}
if ($offline_mode) {
    echo " to <font color='red'>Mobile Server</font>";
} else {
    echo " to Static Server";
}

echo "\n<br />Client IP: ".$this->input->ip_address();
echo "</p></h6>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    echo "\n<u>NOTICE</u><br />";
    echo "\n<p>If you are reading this, do not panic. It simply means that THIRRA is running in debugging mode. <br />Turn off the debug flag in <strong>application/config/config.php</strong> to revert to normal mode.</p>";
    print "\n<br />Session info = " . $this->session->userdata('thirra_mode');
    print "\n<br />location = " . $this->session->userdata('location_id');
    print "\n<br />User = " . $this->session->userdata('username');
    print "\n<br />device_mode = " . $device_mode;
	echo "\n<pre>";
    echo "\n<br />print_r(clinics_list)=<br />";
		//print_r($clinics_list);
	echo "</pre>";
    echo "\n</div>";
} //endif debug


echo "\n<div align='center'>";
echo "\n$flash_message";
//echo "\n<a href='http://thirra.primacare.org.my/' target='_blank'><h1>T H I R R A</h1></a> ";
//echo "\n<a href='http://thirra.primacare.org.my/' target='_blank'><h1>".$this->config->item('app_name')."</h1></a> ";
echo "\n<br /><img src='".base_url()."images/logo_vendor.png' />";
echo form_open("thirra/main");
echo "<table>";
echo "\n<tr><td>";
echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";
echo "</td></tr>";
echo "\n<tr>";
	echo "<td align='left'>";
		echo 'Username';
	echo '</td>';
	echo "<td align='left'>";
        echo "\n<input type='text' name='username' value=''/>";
	echo ' </td>';
echo '</tr>';
echo "\n<tr>";
	echo "<td align='left'>";
		echo 'Password';
	echo '</td>';
	echo "<td align='left'>";
        echo "\n<input type='password' name='password' value='' autocomplete='off' />";
	echo ' </td>';
echo '</tr>';
echo "\n<tr>";
	echo "<td align='left'>";
		echo 'Location';
	echo '</td>';
	echo "<td align='left'>";
        echo "\n<select name='location_id'>";
        foreach ($clinics_list as $clinic){
            echo "\n<option value='".$clinic['clinic_info_id']."'>".htmlspecialchars($clinic['clinic_name'])."</option>";
        }//endforeach;
        echo "\n</select>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo "<td align='left'>";
		echo 'Mode';
	echo '</td>';
	echo "<td align='left'>";
        echo "\n<select name='thirra_mode'>";
        if($country == "All" || $country == "Nepal"  || $country == "Malaysia" || $country == "Philippines"){
            echo "\n<optgroup label='MY, NP and PH'>";
                if($device_mode <> "WAP"){
                    echo "\n<option value='ehr_broad'>EHR - Broadband</option>";
                    echo "\n<option value='ehr_mobile'>EHR - Mobile</option>";
                    echo "\n<option value='ehr_dept' disabled='disabled'>EHR - Department</option>";
                } else {
                    echo "\n<option value='ehr_mobile'>EHR - Mobile</option>";
                    echo "\n<option value='ehr_broad'>EHR - Broadband</option>";
                    echo "\n<option value='ehr_dept' disabled='disabled'>EHR - Department</option>";
                }
            echo "\n</optgroup>";
        }
        if($country == "All" || $country == "Sri Lanka"){
            echo "\n<optgroup label='Sri Lanka'>";
                echo "\n<option value='bio_mobile'>Biosurveillance - Mobile</option>";
                echo "\n<option value='bio_broad'>Biosurveillance - Office</option>";
                echo "\n<option value='bio_hospital'>Biosurveillance - Hospital</option>";
                echo "\n<option value='bio_dept' disabled='disabled'>Biosurveillance - Department</option>";
            echo "\n</optgroup>";
        }
        /*
        if($country == "All" || $country == "Malaysia"){
            echo "\n<optgroup label='Malaysia'>";
                echo "\n<option value='mh_mobile' disabled='disabled'>Health Supplies - Mobile</option>";
                echo "\n<option value='mh_broad' disabled='disabled'>Health Supplies - Office</option>";
            echo "\n</optgroup>";
        }
        */
            echo "\n<optgroup label='Admin'>";
                echo "\n<option value='admin_broad' disabled='disabled'>Administration</option>";
            echo "\n</optgroup>";
        echo "\n</select>";
        //echo "This will be restricted by country, later";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo "<td align='left'>";
		echo 'Language';
	echo '</td>';
	echo "<td align='left'>";
        echo "\n<select name='user_language'>";
        echo "\n<option value='English'>English</option>";
        echo "\n<option value='Ceylonese'>Ceylonese</option>";
        echo "\n<option value='Malay'>Malay</option>";
        echo "\n<option value='Nepali'>Nepali</option>";
        echo "\n</select>";
	echo '</td>';
echo '</tr>';
echo "</table>";
echo "<p /><input type='submit' name='full_form' value='Login' />";
echo "</form>";

echo "</div>";
echo "<p>A <a href='http://www.panacea-ehealth.net/' target='_blank'>PANACeA</a> project</p>";
?>
</body>
</html>
