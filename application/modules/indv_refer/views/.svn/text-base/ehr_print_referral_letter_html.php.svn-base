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

echo "\n\n<div id='print_content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(referral_info)=<br />";
		print_r($referral_info);
	echo '</pre>';
    echo "\n</div>";
}

echo "<hr />";
echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('past_con_details_html_title')."</h1></div>";

echo "\n<table>";
echo "\n<tr>";
	echo '<td>';
        echo $referral_info[0]['doctor_name'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo "<td><strong>";
        echo $referral_info[0]['referral_centre'];
	echo "</strong></td>";
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo $referral_info[0]['address'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo $referral_info[0]['address2'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo $referral_info[0]['address3'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo $referral_info[0]['town'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo $referral_info[0]['state'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo $referral_info[0]['postcode'];
	echo '</td>';
echo '</tr>';
echo '</table>';


echo "<br /><br />";
echo $referral_info[0]['referral_date'];
echo "<br /><br />";

echo "\n<p>";
echo "Dear Sir,";
echo "\n</p>";

echo "\n<strong>RE: PATIENT REFERRAL</strong>";
echo "\n<p>";
echo "I seek your assistance to examine the following patient:<br />";
echo "\n</p>";

echo "\n<table class='valigntop'>";
echo "\n<tr>";
	echo '<td>';
		echo 'Patient\'s Name';
	echo '</td>';
	echo '<td>';
        echo "<strong>".$patient_info['name'].", ".$patient_info['name_first']."</strong>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo "Date of Birth";
	echo '</td>';
	echo '<td>';
        echo $patient_info['birth_date'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Sex';
	echo '</td>';
	echo '<td>';
        echo $patient_info['gender'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo "Referral Reference";
	echo '</td>';
	echo '<td>';
        echo $referral_info[0]['referral_reference'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo "Referral Reason";
	echo '</td>';
	echo '<td>';
        echo $referral_info[0]['reason'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo "Clinical Examination";
	echo '</td>';
	echo '<td>';
        echo $referral_info[0]['clinical_exam'];
	echo '</td>';
echo '</tr>';

echo '</table>';



echo "\n<br />Prepared by:";
echo "<br /><br /><br /><br /><br />";
echo "\n__________________<br />";
//echo "\nPrepared by:";
echo $patcon_info['signed_name'];
echo "<hr />";

echo "\n\n<div id='response' class='episodeblock'>";
    echo "<div class='block_title'>REFERRAL CENTRE'S REPLY</div>";
    echo "<br /><br /><br /><br /><br />";
echo "</div>"; //id='response'

echo "</div>"; //id='content'

echo "</div>"; //id=body
