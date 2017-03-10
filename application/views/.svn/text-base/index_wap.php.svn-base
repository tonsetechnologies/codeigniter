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
include_once("header_xhtml-mobile10.php");

echo "\n<body>";

echo "<p>";
    echo $agent . " - " . $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
    if ("Unknown Platform" == $this->agent->platform()){
        echo " - Mobile Device Mode";
    } else {
        echo " - Desktop Mode";
    }
echo "</p>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    echo "\n<u>NOTICE</u><br />";
    echo "\n<p>If you are reading this, do not panic. It simply means that THIRRA is running in debugging mode. Turn off the debug flag in app_thirra/config/config.php to revert to normal mode.</p>";
    print "\n<br />Session info = " . $this->session->userdata('thirra_mode');
    print "\n<br />location = " . $this->session->userdata('location_id');
    print "\n<br />User = " . $this->session->userdata('username');
    print "\n<br />device_mode = " . $device_mode;
	echo "\n<pre>";
    echo "\n<br />print_r(clinics_list)=<br />";
		print_r($clinics_list);
	echo "</pre>";
    echo "\n</div>";
} //endif debug

echo "\n<h1>THIRRA</h1>";
echo form_open("thirra/main");
echo "<table>";
echo "\n<tr>";
	echo '<td>';
		echo 'Username';
	echo '</td>';
	echo '<td>';
        echo "\n<input type='text' name='username' value=''/>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Password';
	echo '</td>';
	echo '<td>';
        echo "\n<input type='password' name='password' value='' autocomplete='off' />";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo "<td align='left'>";
		echo 'Location';
	echo '</td>';
	echo "<td align='left'>";
        echo "\n<select name='location_id'>";
        foreach ($clinics_list as $clinic){
            echo "\n<option value='".$clinic['clinic_info_id']."'>".$clinic['clinic_name']."</option>";
        }//endforeach;
        echo "\n</select>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Mode';
	echo '</td>';
	echo '<td>';
        echo "\n<select name='thirra_mode'>";
        if($country == "All" || $country == "Nepal"  || $country == "Malaysia"){
            echo "\n<optgroup label='Malaysia and Nepal'>";
                echo "\n<option value='ehr_mobile'>EHR - Mobile</option>";
                echo "\n<option value='ehr_broad'>EHR - Broadband</option>";
                echo "\n<option value='ehr_dept' disabled='disabled'>EHR - Department</option>";
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
        if($country == "All" || $country == "Malaysia"){
            echo "\n<optgroup label='Malaysia'>";
                echo "\n<option value='mh_mobile' disabled='disabled'>Health Supplies - Mobile</option>";
                echo "\n<option value='mh_broad' disabled='disabled'>Health Supplies - Office</option>";
            echo "\n</optgroup>";
        }
            echo "\n<optgroup label='Admin'>";
                echo "\n<option value='admin_broad' disabled='disabled'>Administration</option>";
            echo "\n</optgroup>";
        // To delete - old version
        /*
        echo "\n<option value='bio_mobile'>Biosurveillance - Mobile</option>";
        echo "\n<option value='bio_broad'>Biosurveillance - Office</option>";
        echo "\n<option value='bio_hospital'>Biosurveillance - Hospital</option>";
        echo "\n<option value='bio_dept' disabled='disabled'>Biosurveillance - Department</option>";
        echo "\n<option value='emr_mobile'>EHR - Mobile</option>";
        echo "\n<option value='emr_broad'>EHR - Broadband</option>";
        echo "\n<option value='emr_dept' disabled='disabled'>EMR - Department</option>";
        echo "\n<option value='mh_mobile' disabled='disabled'>Health Supplies - Mobile</option>";
        echo "\n<option value='mh_broad' disabled='disabled'>Health Supplies - Office</option>";
        echo "\n<option value='admin'>Administration</option>";
        */
        echo "\n</select>";
        //echo "This will be restricted by country, later";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Language';
	echo '</td>';
	echo '<td>';
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

echo "<p>A PANACeA project</p>";
?>
</body>
</html>
