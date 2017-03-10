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

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_refer_out2server_confirm_html_title')."</h1></div>";

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
echo "Confirm send to server at <strong>".$remote_site."</strong>";
echo "<br /><br />\n";

echo form_open('indv/indv/index/indv_refer/ehr_individual_refer/send_referral_out2server_done/'.$form_purpose.'/'.$patient_id.'/'.$summary_id.'/'.$referral_id);

echo "\n<table class='valigntop'>";
echo "\n<tr>";
echo "\n<th></th>";
echo "\n<th>Local server</th>";
echo "\n<th>Remote server</th>";
echo "\n<tr>";

echo "\n<tr>";
    echo "\n<td width='200'>Last Name</td>";
    echo "\n<td>".$patient_info['name']."</td>";
    echo "\n<td><span";
    if($patient_info['name'] <> $rec_name_last){
        echo " class='error_field'";
    }
    echo ">".$rec_name_last."</span></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td>First Name</td>";
    echo "\n<td>".$patient_info['name_first']."</td>";
    echo "\n<td><span";
    if($patient_info['name_first'] <> $rec_name_first){
        echo " class='error_field'";
    }
    echo ">".$rec_name_first."</span></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td>Birth Date</td>";
    echo "\n<td>".$patient_info['birth_date']."</td>";
    echo "\n<td><span";
    if($patient_info['birth_date'] <> $rec_birth_date){
        echo " class='error_field'";
    }
    echo ">".$rec_birth_date."</span></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td>NRIC No.</td>";
    echo "\n<td>".$patient_info['ic_no']."</td>";
    echo "\n<td><span";
    if($patient_info['ic_no'] <> $rec_ic_no){
        echo " class='error_field'";
    }
    echo ">".$rec_ic_no."</span></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td>patient_id</td>";
    echo "\n<td>".$patient_id."</td>";
    echo "\n<td><span";
    if($patient_info['patient_id'] <> $rec_patient_id){
        echo " class='error_field'";
    }
    echo ">".$rec_patient_id."</span></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td></td>";
    echo "\n<td><input type='submit' value='Confirm and Submit patient info and referral info' /></td>";
    echo "\n<td></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td></td>";
    echo "\n<td><br />".anchor('indv/indv/index/indv_refer/ehr_individual_refer/edit_referral_out/edit_refer/'.$patient_id.'/'.$summary_id.'/'.$referral_id, "<strong>Cancel. Click this to start over</strong>")."</td>";
    echo "\n<td></td>";
echo "\n</tr>";
echo "\n</table>";


echo form_hidden('now_id', $now_id);
echo form_hidden('rec_patient_id', $rec_patient_id);
echo "</form>\n";

echo "<div align='center'><br />";
echo "</div>";


echo "</div>"; //id=content


