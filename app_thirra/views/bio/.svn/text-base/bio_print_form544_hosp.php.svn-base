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
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />notification_id = " . $notification_id;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(lab_list)=<br />";
		print_r($lab_list);
    echo "\n<br />print_r(notify_info)=<br />";
		print_r($notify_info);
    echo "\n<br />print_r(queue_info)=<br />";
		print_r($queue_info);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('past_con_details_html_title')."</h1></div>";

echo "\n<div align='right'>Health - 544</div>";
echo "\n<div align='center'><h3>NOTIFICATION OF A COMMUNICABLE DISEASE</h3></div>";

echo "\n<table border='0'>";
echo "\n<tr>";
    echo "\n<td width='600' colspan='2' class='print_label'>"; // Left column
    echo "\nInstitute";
    echo "\n</td>";
    echo "\n<td width='500' colspan='2' class='print_label'>"; // Right column
    echo "\nDisease";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='2' class='print_dataL'>";
    echo "\n&nbsp;".$notify_info['clinic_name'];
    echo "\n</td>";
    echo "\n<td colspan='2' class='print_dataL'>";
    echo "\n&nbsp;".$notify_info['short_title'];
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='2' class='print_label'>";
    echo "\nName of Patient";
    echo "\n</td>";
    echo "\n<td colspan='2' class='print_label'>";
    echo "\nDate of Onset";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='2' class='print_dataL'>";
    echo "\n&nbsp;".$patient_info['name'].", ".$patient_info['name_first'];
    echo "\n</td>";
    echo "\n<td colspan='2' class='print_dataL'>";
    echo "\n&nbsp;".$notify_info['started_date'];
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='2' class='print_label'>";
    echo "\nPaediatric Patients - Name of Mother/Father/Guardian";
    echo "\n</td>";
    echo "\n<td colspan='2' class='print_label'>";
    echo "\nDate of Admission";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='2' class='print_dataL'>";
    echo "\n&nbsp;";
    echo "\n</td>";
    echo "\n<td colspan='2' class='print_dataL'>";
    echo "\n&nbsp;".$notify_info['check_in_date'];
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%' class='print_label'>";
    echo "\nBHT No.";
    echo "\n</td>";
    echo "\n<td width='25%' class='print_label'>";
    echo "\nWard";
    echo "\n</td>";
    echo "\n<td width='25%' class='print_label'>";
    echo "\nAge";
    echo "\n</td>";
    echo "\n<td width='25%' class='print_label'>";
    echo "\nSex";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td class='print_dataL'>";
    echo "\n&nbsp;".$notify_info['bht_no'];
    echo "\n</td>";
    echo "\n<td class='print_dataL'>";
    echo "\n&nbsp;".$room_name;
    echo "\n</td>";
    echo "\n<td class='print_dataL'>&nbsp;";
    $formatted = sprintf("%01.0f",$est_age);
    echo $formatted;
    echo " years</td>";
    echo "\n<td class='print_dataL'>";
    echo "\n&nbsp;".$patient_info['gender'];
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='4' class='print_label'>Laboratory Results (if available)";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='4' class='print_dataL'>";
    echo "\n&nbsp;".$package_code." - ".$lab_result;
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='4' class='print_label'>Home address of Patient (for the Public Health Inspector to trace the patient's residence)";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr><td colspan='4' class='print_dataL'>";
echo "\n&nbsp;".$patient_info['patient_address'];
echo "\n<br />&nbsp;".$patient_info['patient_address2'];
echo "\n<br />&nbsp;".$patient_info['patient_address3'];
echo "\n<br />&nbsp;".$patient_info['patient_town'];
echo "\n<br />&nbsp;".$patient_info['patient_postcode']." ".$patient_info['patient_state']."</td></tr>";
echo "\n<tr>";
    echo "\n<td colspan='4' class='print_label'>Patient's Home Telephone No.";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='4' class='print_dataL'>";
    echo "\n&nbsp;".$patient_info['tel_home']. " &nbsp;&nbsp; ".$patient_info['tel_mobile'];
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>";
    echo "\n<br /><br /><br /><br />......................... ";
    echo "\n</td>";
    echo "\n<td width='25%'>";
    echo "\n<br /><br /><br /><br />......................... ";
    echo "\n</td>";
    echo "\n<td width='25%'>";
    echo "\n<br /><br /><br /><br />......................... ";
    echo "\n</td>";
    echo "\n<td width='25%'>";
    echo "\n<br /><br /><br /><br />......................... ";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%' class='print_label'>";
    echo "\nSignature of Notifier";
    echo "\n</td>";
    echo "\n<td width='25%' class='print_label'>";
    echo "\nName";
    echo "\n</td>";
    echo "\n<td width='25%' class='print_label'>";
    echo "\nStatus";
    echo "\n</td>";
    echo "\n<td width='25%' class='print_label'>";
    echo "\nDate";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";

    echo "\n";


echo "</div>"; //id='content'

echo "</div>"; //id=body
