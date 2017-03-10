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
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(referral_info)=<br />";
		print_r($referral_info);
    echo "\n<br />print_r(xml_array)=<br />";
		print_r($xml_array);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_refer_patient_existence_html_title')."</h1></div>";

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
echo "Checking server at <strong>".$remote_site."</strong>";
echo "<br />Found ".$xmlstr->check_stats->exact_match." exact match";
echo " and ".$xmlstr->check_stats->partial_match." partial match(es) against <strong>'".$substring_search."'</strong>.";
echo "<br /><br />";
$common_variables   =   "
    \n<input type='hidden' name='remote_site' value='".$remote_site."' />
";

/*
    \n<input type='hidden' name='' value='".."' />
    \n<input type='hidden' name='' value='".."' />
    \n<input type='hidden' name='' value='".."' />
    \n<input type='hidden' name='' value='".."' />
    \n<input type='hidden' name='' value='".."' />
    \n<input type='hidden' name='' value='".."' />
    \n<input type='hidden' name='' value='".."' />
*/
echo "\n<table class='valigntop'>";
echo "\n<tr>";
echo "\n<th>Last Name</th>";
echo "\n<th>First Name</th>";
echo "\n<th>Birth Date</th>";
echo "\n<th>NRIC No.</th>";
echo "\n<tr>";

if(isset($xml_array['exact_match'])){
    foreach($xml_array['exact_match'] as $exact_match){
        echo form_open('indv/indv/index/indv_refer/ehr_individual_refer/send_referral_out2server_confirm/'.$form_purpose.'/'.$patient_id.'/'.$summary_id.'/'.$referral_id);
        echo "\n<tr>";
            echo "\n<td><strong>".$exact_match['last_name']."</strong></td>";
            echo "\n<td>".$exact_match['name_first']."</td>";
            echo "\n<td><strong>".$exact_match['birth_date']."</strong></td>";
            echo "\n<td>".$exact_match['ic_no']."</td>";
            echo "\n<input type='hidden' name='match_type' value='exact_match' />";
            echo "\n<input type='hidden' name='rec_patient_id' value='".$exact_match['patient_id']."' />";
            echo "\n<input type='hidden' name='rec_name_last' value='".$exact_match['last_name']."' />";
            echo "\n<input type='hidden' name='rec_name_first' value='".$exact_match['name_first']."' />";
            echo "\n<input type='hidden' name='rec_birth_date' value='".$exact_match['birth_date']."' />";
            echo "\n<input type='hidden' name='rec_ic_no' value='".$exact_match['ic_no']."' />";
            echo "\n<td><input type='submit' value='Submit referral info only' /></td>";
        echo "\n<tr>";
        echo $common_variables;
        echo "</form>\n";
    } //endforeach($xml_array['partial_match'] as $partial_match)
}

if(isset($xml_array['partial_match'])){
    foreach($xml_array['partial_match'] as $partial_match){
        echo form_open('indv/indv/index/indv_refer/ehr_individual_refer/send_referral_out2server_confirm/'.$form_purpose.'/'.$patient_id.'/'.$summary_id.'/'.$referral_id);
        echo "\n<tr>";
            echo "\n<td>".$partial_match['last_name']."</td>";
            echo "\n<td>".$partial_match['name_first']."</td>";
            echo "\n<td>".$partial_match['birth_date']."</td>";
            echo "\n<td>".$partial_match['ic_no']."</td>";
            echo "\n<input type='hidden' name='match_type' value='partial_match' />";
            echo "\n<input type='hidden' name='rec_patient_id' value='".$partial_match['patient_id']."' />";
            echo "\n<input type='hidden' name='rec_name_last' value='".$partial_match['last_name']."' />";
            echo "\n<input type='hidden' name='rec_name_first' value='".$partial_match['name_first']."' />";
            echo "\n<input type='hidden' name='rec_birth_date' value='".$partial_match['birth_date']."' />";
            echo "\n<input type='hidden' name='rec_ic_no' value='".$partial_match['ic_no']."' />";
            echo "\n<td><input type='submit' value='Submit referral info only' /></td>";
        echo "\n<tr>";
        echo $common_variables;
        echo "</form>\n";
    } //endforeach($xml_array['partial_match'] as $partial_match)
}

echo form_open('indv/indv/index/indv_refer/ehr_individual_refer/send_referral_out2server_confirm/'.$form_purpose.'/'.$patient_id.'/'.$summary_id.'/'.$referral_id);
echo "\n<tr>";
    echo "\n<td colspan='4'><strong>None of the above.  Need to register as new patient.</strong></td>";
        echo "\n<input type='hidden' name='match_type' value='no_match' />";
        echo "\n<input type='hidden' name='rec_patient_id' value='new_patient' />";
        echo "\n<input type='hidden' name='rec_name_last' value='' />";
        echo "\n<input type='hidden' name='rec_name_first' value='' />";
        echo "\n<input type='hidden' name='rec_birth_date' value='' />";
        echo "\n<input type='hidden' name='rec_ic_no' value='' />";
    echo "\n<td><input type='submit' value='Submit patient info and referral info' /></td>";
echo "\n</tr>";
echo $common_variables;
echo "</form>\n";
echo "\n</table>";
echo "<br />";
echo "\n</div>"; //class='external_server'


echo "\n<table>";
echo "\n<tr>";
    echo "<td valign='top'>".anchor('indv/indv/index/indv_refer/ehr_individual_refer/refer_select_details/new_export/'.$patient_id.'/'.$summary_id.'/'.$referral_id, 'Export XML', 'target="_blank"')."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td valign='top'>".anchor('indv/indv/index/indv_refer/ehr_consult/print_referral_letter/print_referral_letter/'.$patient_id.'/'.$summary_id.'/'.$referral_id, 'Print', 'target="_blank"')."</td>";
echo "</tr>";
echo "\n</table>";


echo form_hidden('now_id', $now_id);

echo "<div align='center'><br />";
echo "</div>";


echo "</div>"; //id=content


