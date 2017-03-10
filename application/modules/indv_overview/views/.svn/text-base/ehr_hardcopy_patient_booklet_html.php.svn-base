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

echo "\n\n<div id='print_content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(social_history)=<br />";
		print_r($social_history);
    echo "\n<br />print_r(allergy_list)=<br />";
		print_r($allergy_list);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('12900-100_past_con_details_html_title')."</h1></div>";

echo "\n<p>";

echo "\n<table>";
echo "\n<tr>";
	echo "<td width='200'>";
		echo 'Given Name';
	echo '</td>';
	echo '<td>';
        echo "<h3>".$patient_info['name_first']."</h3>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Surname';
	echo '</td>';
	echo '<td>';
        echo "<h3>".$patient_info['name']."</h3>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'NRIC';
	echo '</td>';
	echo '<td>';
        echo $patient_info['ic_no']." / ".$patient_info['ic_other_no'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Clinic Ref. No.';
	echo '</td>';
	echo '<td>';
        echo $patient_info['clinic_reference_number'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Date of Birth';
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
		echo 'Marital Status';
	echo '</td>';
	echo '<td>';
        echo $patient_info['marital_status'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Address';
	echo '</td>';
	echo '<td>';
        echo $patient_info['patient_address'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo ' ';
	echo '</td>';
	echo '<td>';
        echo $patient_info['patient_address2'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo ' ';
	echo '</td>';
	echo '<td>';
        echo $patient_info['patient_address3'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo ' ';
	echo '</td>';
	echo '<td>';
        echo $patient_info['patient_postcode'];
        echo " ".$patient_info['patient_town'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo ' ';
	echo '</td>';
	echo '<td>';
        echo $patient_info['patient_state'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Telephone';
	echo '</td>';
	echo '<td>';
        echo $patient_info['tel_home'];
        echo " / ".$patient_info['tel_mobile'];
	echo '</td>';
echo '</tr>';


echo '</table>';
echo "\n</p>";



echo "\n\n<div id='allergy' class='episodeblock'>";
    echo "<div class='block_title'>DRUG ALLERGIES</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th width='200'>generic_name</th>";
        echo "\n<th width='200'>reaction</th>";
        echo "\n<th>remarks</th>";
    echo "</tr>";
    foreach ($allergy_list as $allergy_item){
        echo "<tr>";
        echo "<td>".$allergy_item['generic_name']."</td>";
        echo "<td>".$allergy_item['reaction']."</td>";
        echo "<td>".$allergy_item['added_remarks']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='allergy'

echo "\n<table>";
echo "\n<tr>";
	echo "<td width='100'>";
		echo 'Tobacco';
	echo '</td>';
	echo "<td width='50'>";
        echo $social_history[0]['tobacco_use'];
	echo '</td>';
	echo '<td>';
        echo $social_history[0]['tobacco_spec'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Alcohol';
	echo '</td>';
	echo '<td>';
        echo $social_history[0]['alcohol_use'];
	echo '</td>';
	echo '<td>';
        echo $social_history[0]['alcohol_spec'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Drugs';
	echo '</td>';
	echo '<td>';
        echo $social_history[0]['drugs_use'];
	echo '</td>';
	echo '<td>';
        echo $social_history[0]['drugs_spec'];
	echo '</td>';
echo '</tr>';
echo '</table>';

echo "</div>"; //id='content'

echo "</div>"; //id=body
