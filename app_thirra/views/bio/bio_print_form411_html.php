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
    echo "\n<br />print_r(phi_range)=<br />";
		print_r($phi_range);
    echo "\n<br />print_r(lab_list)=<br />";
		print_r($lab_list);
    echo "\n<br />print_r(notify_info)=<br />";
		print_r($notify_info);
    echo "\n<br />print_r(bio_case_details)=<br />";
		print_r($bio_case_details);
    echo "\n<br />print_r(branch_info)=<br />";
		print_r($branch_info);
    echo "\n<br />print_r(queue_info)=<br />";
		print_r($queue_info);
    echo "\n<br />print_r(bio_inv_household)=<br />";
		print_r($bio_inv_household);
    echo "\n<br />print_r(bio_inv_other)=<br />";
		print_r($bio_inv_other);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('past_con_details_html_title')."</h1></div>";

echo "\n<div align='right'>Health - 411</div>";

echo "\n<table border='0' class='print'>";
echo "\n<tr>";
    echo "\n<td width='500' colspan='1' align='center' class='print_labelS'>";
    echo "\nDEPARTMENT OF HEALTH";
    echo "\n</td>";
    echo "\n<td width='300' colspan='1' class='print_labelS'>";
    echo "\n&nbsp;&nbsp;PHI Reference No.";
    echo "\n</td>";
    echo "\n<td width='300' colspan='1' class='print_labelS'>";
    echo "\n&nbsp;&nbsp;PHI Range";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='1' class='print_data'>";
    echo "\n&nbsp;";
    echo "\n</td>";
    echo "\n<td colspan='1' class='print_data'>";
    echo "\n".$bio_case_details['bio_phi_ref'];
    echo "\n</td>";
    echo "\n<td colspan='1' class='print_data'>";
    echo "\n".$branch_info[0]['district_name'];
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='40%' colspan='1' align='center' class='print_labelS' rowspan='2'>";
    echo "\n<h3>COMMUNICABLE DISEASE REPORT - Part 1</h3>";
    echo "\n</td>";
    echo "\n<td width='30%' colspan='1' class='print_labelS'>";
    echo "\n&nbsp;&nbsp;MOH Notification No.";
    echo "\n</td>";
    echo "\n<td width='30%' colspan='1' class='print_labelS'>";
    echo "\n";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    /*
    echo "\n<td colspan='1' class='print_data'>";
    echo "\n";
    echo "\n</td>";
    */
    echo "\n<td colspan='1' class='print_data'>";
    echo "\n".$notify_info['notify_ref'];
    echo "\n</td>";
    echo "\n<td colspan='1' class='print_data'>";
    echo "\n";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='1' align='center' class='print_labelS'>";
    echo "\n(To be completed by P.H.I. and returned to Health Office)";
    echo "\n</td>";
    echo "\n<td colspan='1' class='print_labelS'>";
    echo "\n&nbsp;&nbsp;MOH Register No.";
    echo "\n</td>";
    echo "\n<td colspan='1' class='print_labelS'>";
    echo "\n&nbsp;&nbsp;M.O.H./H.O. Area";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td colspan='1' class='print_data print_border_trBottoml'>";
    echo "\n&nbsp;";
    echo "\n</td>";
    echo "\n<td colspan='1' class='print_data print_border_trBottoml'>";
    echo "\n".$bio_case_details['case_ref'];
    echo "\n</td>";
    echo "\n<td colspan='1' class='print_data print_border_trBottoml'>";
    echo "\nUkuwela";
    echo "\n</td>";
echo "\n</tr>";
echo "\n</table>";

echo "\n<table border='0' class='print'>";
echo "\n<tr>";
echo "\n<td width='50%' width='550' valign='top'>"; // Left column
    echo "\n<table border='0' class='print'>";
    echo "\n<tr>";
        echo "\n<td width='400' colspan='3' class='print_labelS'>";
        echo "\n&nbsp;&nbsp;Disease as Notified:";
        echo "\n</td>";
        echo "\n<td width='150' colspan='1' class='print_labelS'>";
        echo "\n&nbsp;&nbsp;Date: <strong>".$notify_info['notify_date']."</strong>";
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='4' class='print_data'>";
        echo "\n".$notify_info['short_title'];
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='3' class='print_labelS'>";
        echo "\n&nbsp;&nbsp;Disease Confirmed:";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "\n&nbsp;&nbsp;Date: <strong>".$bio_case_details['date_disease_confirmed']."</strong>";
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='4' class='print_data print_border_trBottoml'>";
        if(isset($disease_confirmed['short_title'])){
            echo $disease_confirmed['short_title'];
        } else {
            echo "Unconfirmed";
        }
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='4' class='print_labelS'>";
        echo "\n&nbsp;&nbsp;Name of Patient:";
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='4' class='print_data'>";
        echo "\n".$patient_info['name'].", ".$patient_info['name_first'];
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='4' class='print_labelS'>";
        echo "\n&nbsp;&nbsp;Address:";
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='4' class='print_data print_border_trBottoml'>";
        echo "\n".$patient_info['patient_address'];
        echo "\n<br />".$patient_info['patient_address2'];
        echo "\n<br />".$patient_info['patient_address3'];
        echo "\n<br />".$patient_info['patient_town']." ".$patient_info['patient_postcode'];
        echo "\n<br />".$patient_info['patient_state'];
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS' width='100'>";
        echo "Age";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft' width='200'>";
        echo "\n";
        $formatted = sprintf("%01.0f",$est_age);
        echo $formatted;
        echo " years</td>";
        echo "\n<td colspan='2' class='print_labelS print_border_TopRightBottonLeft' width='250'>";
        echo "\nPatient's movement during 3 weeks prior to onset";
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "Sex";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n".$patient_info['gender'];
        echo "</td>";
        echo "\n<td colspan='2' rowspan='4' class='print_data print_border_TopRightBottonLeft' valign='top'>";
        echo "\n".$bio_case_details['case_prior_movements'];
        echo "</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "Ethnic Group";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n".$patient_info['ethnicity'];
        echo "</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "Date of onset";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n".$notify_info['started_date'];
        echo "</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "Date of hospitalisation";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n".$notify_info['check_in_date'];
        echo "</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "Date of Discharge";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n".$notify_info['check_out_date'];
        echo "</td>";
        echo "\n<td colspan='2' class='print_labelS print_border_TopRightBottonLeft'>";
        echo "Laboratory findings";
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "Name of Hospital";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n".$notify_info['clinic_name'];
        echo "\n<td colspan='2' class='print_data print_border_TopRightBottonLeft'>";
        if(count($lab_list)){
            echo "\n".$lab_list[0]['package_name'];
        } else {
            echo "\n&nbsp;Not tested.";
        }
        echo "</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "Outcome";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n".$bio_case_details['case_clinical_outcome'];
        echo "</td>";
        echo "\n<td colspan='2' class='print_data print_border_TopRightBottonLeft' rowspan='4' valign='top'>";
        if(count($lab_list)){
            echo "\n".$lab_list[0]['summary_result'];
        } else {
            echo "\n&nbsp;";
        }
        echo "</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "Where isolated";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n".$bio_case_details['case_location_isolation'];
        echo "</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "Nature of case";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n".$bio_case_details['case_outbreak_degree'];
        echo "</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "One case in outbreak";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        if(isset($bio_case_details['case_in_outbreak'])){
            echo $bio_case_details['case_in_outbreak'];
        }
        echo "&nbsp;</td>";
    echo "\n</tr>";
    echo "\n</table>";

echo "\n</td>"; // Left column

echo "\n<td width='50%' width='550' valign='top'>"; // Right Column
    echo "\n<table border='0' class='print'>";
    echo "\n<tr>";
        echo "\n<td colspan='4' align='center' class='print_labelS'>";
        echo "\nCONTACTS INVESTIGATED";
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td width='200' align='center' colspan='1' class='print_labelS print_border_TopRightBottonLeft'>";
        echo "\nName";
        echo "\n</td>";
        echo "\n<td width='50' align='center' colspan='1' class='print_labelS print_border_TopRightBottonLeft'>";
        echo "\nAge";
        echo "\n</td>";
        echo "\n<td width='100' align='center' colspan='1' class='print_labelS print_border_TopRightBottonLeft'>";
        echo "\nDate Seen";
        echo "\n</td>";
        echo "\n<td width='200' align='center' colspan='1' class='print_labelS print_border_TopRightBottonLeft'>";
        echo "\nObservation";
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS print_border_TopRightBottonLeft'>";
        echo "\nI. Patient's household<br />&nbsp;";
        echo "\n</td>";
        echo "\n<td colspan='1' align='center' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n";
        echo "\n</td>";
        echo "\n<td colspan='1' align='center' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n";
        echo "\n</td>";
    echo "\n</tr>";

    if(isset($bio_inv_household)){
        $row    =   0;
        foreach($bio_inv_household as $bio_inv_row){
            echo "\n<tr><td valign='top' class='print_data print_border_TopRightBottonLeft'>".($row+1);
            echo "\n. ".$bio_inv_row['inv_main_name'];
            echo "\n (".$bio_inv_row['inv_main_relship'].")";
            echo "\n</td><td valign='top' class='print_data print_border_TopRightBottonLeft'>".$bio_inv_row['inv_main_age'];
            echo "\n</td><td valign='top' class='print_data print_border_TopRightBottonLeft'>".$bio_inv_row['inv_start_date'];
            echo "\n</td><td valign='top' class='print_data print_border_TopRightBottonLeft'>".$bio_inv_row['inv_town'];
            echo "\n ".$bio_inv_row['inv_findings'];
            echo "\n ".$bio_inv_row['inv_summary'];
            echo "\n ".$bio_inv_row['inv_comments'];
            echo "\n</td></tr>";
            $row++;
        }
    }

    $row_filler = 5 - $row;
    for($i=1; $i <= $row_filler; $i++){
        echo "\n<tr>";
            echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
            echo "\n&nbsp;";
            echo "\n</td>";
            echo "\n<td colspan='1' align='center' class='print_data print_border_TopRightBottonLeft'>";
            echo "\n&nbsp;";
            echo "\n</td>";
            echo "\n<td colspan='1' align='center' class='print_data print_border_TopRightBottonLeft'>";
            echo "\n&nbsp;";
            echo "\n</td>";
            echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
            echo "\n&nbsp;";
            echo "\n</td>";
        echo "\n</tr>";
    }
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS print_border_TopRightBottonLeft'>";
        echo "\nII. Other Contacts<br />&nbsp;";
        echo "\n</td>";
        echo "\n<td colspan='1' align='center' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n";
        echo "\n</td>";
        echo "\n<td colspan='1' align='center' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n";
        echo "\n</td>";
        echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
        echo "\n";
        echo "\n</td>";
    echo "\n<tr>";

    if(isset($bio_inv_other)){
        $row    =   0;
        foreach($bio_inv_other as $bio_inv_row){
            echo "\n<tr><td valign='top' class='print_data print_border_TopRightBottonLeft'>".($row+1);
            echo "\n. ".$bio_inv_row['inv_main_name'];
            echo "\n (".$bio_inv_row['inv_main_relship'].")";
            echo "\n</td><td valign='top' class='print_data print_border_TopRightBottonLeft'>".$bio_inv_row['inv_main_age'];
            echo "\n</td><td valign='top' class='print_data print_border_TopRightBottonLeft'>".$bio_inv_row['inv_start_date'];
            echo "\n</td><td valign='top' class='print_data print_border_TopRightBottonLeft'>".$bio_inv_row['inv_town'];
            echo "\n ".$bio_inv_row['inv_findings'];
            echo "\n ".$bio_inv_row['inv_summary'];
            echo "\n ".$bio_inv_row['inv_comments'];
            echo "\n</td></tr>";
            $row++;
        }
    }

    $row_filler = 5 - $row;
    for($i=1; $i <= $row_filler; $i++){
        echo "\n<tr>";
            echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
            echo "\n&nbsp;";
            echo "\n</td>";
            echo "\n<td colspan='1' align='center' class='print_data print_border_TopRightBottonLeft'>";
            echo "\n&nbsp;";
            echo "\n</td>";
            echo "\n<td colspan='1' align='center' class='print_data print_border_TopRightBottonLeft'>";
            echo "\n&nbsp;";
            echo "\n</td>";
            echo "\n<td colspan='1' class='print_data print_border_TopRightBottonLeft'>";
            echo "\n&nbsp;";
            echo "\n</td>";
        echo "\n</tr>";
    }
    echo "\n<tr>";
        echo "\n<td colspan='1' class='print_labelS'>";
        echo "\n<br /><br /><br /><strong>".$bio_case_details['end_date']."</strong><br />......................<br />Date";
        echo "\n</td>";
        echo "\n<td colspan='1' align='center' class='print_data'>";
        echo "\n";
        echo "\n</td>";
        echo "\n<td colspan='2' align='center' class='print_labelS'>";
        echo "\n<br /><br /><br /><br />...........................<br />Signature of PHI";
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n</tr>";
    echo "\n</table>";

echo "\n</td>";

echo "\n</tr>";
echo "\n</table>";



    echo "\n";


echo "</div>"; //id='content'

echo "</div>"; //id=body
