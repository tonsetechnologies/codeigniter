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
 * Portions created by the Initial Developer are Copyright (C) 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";

echo "\n<body>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />user_id = " . $user_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
		print_r($user_info);
    echo "\n<br />print_r(referral_info)=<br />";
		print_r($referral_info);
    echo "\n<br />print_r(xml_array)=<br />";
		print_r($xml_array);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_refer_out2server_done_html_title')."</h1></div>";

echo "\n<table class='header valigntop' width='100%' align='center'>";
/*
echo "\n<tr>";
    echo "<td>Patient Name</td><td>";
    echo $name;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Birth Date</td><td>";
    echo $birth_date;
    echo "</td>";
echo "</tr>";
*/
echo "\n<tr>";
    echo "<td width='25%'>Referral Centre</td><td>";
    echo $referral_centre;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Referral Specialty</td><td>";
    echo $referral_specialty;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Referral Doctor's Name</td><td>";
    echo $referral_doctor_name;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Referral Date</td><td>";
    echo $referral_date;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Referral Reference</td><td>";
    echo $referral_reference;
    echo "</td>";
echo "</tr>";
echo "\n</table>";

echo "<div class='external_server'>\n";
//echo $curled;

echo "<br />";
echo "<br />Referring Clinic : ".$xmlstr->info_sent->export_clinicname.".";
echo "<br />";
echo "Sent referral info to <strong>".$remote_site."</strong>";
echo "<br />";
echo "<br />";
if(!empty($xmlstr->edi_confirmation->edi_no)){
    echo "TRANSMITTED SUCCESSFULLY!";
}
echo "<br />Confirmation No.: ".$xmlstr->edi_confirmation->edi_no.".";
echo "<br />";
//echo "<br />Data Sent : ".$xmlstr->info_sent->xml_sent;
echo "<br />xml_md5 : ".$xmlstr->info_sent->xml_md5;
echo "<br />md5_xml_refer : ".$xmlstr->info_sent->md5_xml_refer;
echo "<br /><br />";
echo "<br />";
echo "\n</div>"; //class='external_server'



echo "</div>"; //id=content


