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

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(patient_past_con)=<br />";
		print_r($patient_past_con);
    echo "\n<br />print_r(vitals_info)=<br />";
		print_r($vitals_info);
    echo "\n<br />print_r(medication_info)=<br />";
		print_r($medication_info);
    echo "\n<br />print_r(diagnoses_info)=<br />";
		print_r($diagnoses_info);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('12000-100_patients_indv_overview_html_title')."</h1></div>";

echo "\n<p />";
if($patcon_info['summary_id'] == "new_summary"){
    echo anchor('ehr_consult/consult_new/'.$patient_info['patient_id'].'/'.$patcon_info['summary_id'], 'Start New Consultation', 'target="_blank"');
} else {
    echo anchor('ehr_consult/consult_episode/'.$patient_info['patient_id'].'/'.$patcon_info['summary_id'], 'Continue Consultation started on '.$patcon_info['date_started'], 'target="_blank"');
} //endif $patcon_info['summary_id'] == "new_summary")

/*
echo "\n<table>";
echo '<tr>';
	echo '<td>';
		echo 'Clinic Ref.';
	echo '</td>';
	echo '<td>';
		echo $patient_info['clinic_reference_number'];
	echo '</td>';
echo '</tr>';
echo '<tr>';
	echo '<td>';
		echo 'Patient Name';
	echo '</td>';
	echo '<td>';
		echo $patient_info['name'];
	echo '</td>';
echo '</tr>';
echo '</table>';
*/

if($multicolumn){
    echo "\n<table>";
}

if($multicolumn){
    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='drug_allergies' class='overviewblock'>";
                echo "\n<div class='block_title'>DRUG ALLERGIES</div>";
                    echo "\n None recorded";
            echo "</div>"; //id='drug_allergies'
        echo "\n</td>";
        echo "\n<td valign='top'>";
            echo "\n\n<div id='other_allergies' class='overviewblock'>";
                echo "\n<div class='block_title'>OTHER ALLERGIES</div>";
                    echo "\n None recorded";
            echo "</div>"; //id='other_allergies'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";

    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='vitals' class='overviewblock'>";
                echo "\n<div class='block_title'>VITAL SIGNS</div>";
                if(isset($vitals_info['vital_id']) && ($vitals_info['vital_id'] <> "new_vitals")){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<td width='180'>Temperature</td>";
                        echo "<td width='65'>".$vitals_info['temperature']."</td>";
                        echo "\n<td width='85'>&deg;C</td>";
                        echo "\n<td width='180'>Pulse Rate</td>";
                        echo "<td width='65'>".$vitals_info['pulse_rate']."</td>";
                        echo "\n<td width='85'>bpm</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>BP systolic</td>";
                        echo "<td>".$vitals_info['bp_systolic']."</td>";
                        echo "\n<td>mm Hg</td>";
                        echo "\n<td>BP diastolic</td>";
                        echo "<td>".$vitals_info['bp_diastolic']."</td>";
                        echo "\n<td>mm Hg</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>Height</td>";
                        echo "<td width='50'>".$vitals_info['height']."</td>";
                        echo "\n<td>cm</td>";
                        echo "\n<td>Weight</td>";
                        echo "<td width='50'>".$vitals_info['weight']."</td>";
                        echo "\n<td>kg</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td></td>";
                        echo "<td></td>";
                        echo "\n<td></td>";
                        echo "<td></td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>Chart</td>";
                        echo "<td>";
                        echo anchor('ehr_individual/graph_processor', ' graph', 'target="_blank"');
                        echo "</td>";
                        echo "\n<td></td>";
                        echo "<td></td>";
                    echo "\n</tr>";
                    echo "\n</table>";
                } else {
                    echo "\n<br /> None recorded";
                        echo anchor('ehr_individual/graph_processor', ' graph', 'target="_blank"');
                }
            echo "</div>"; //id='vitals'
if($multicolumn){
        echo "\n</td>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='appointments' class='overviewblock'>";
                echo "\n<div class='block_title'>APPOINTMENTS</div>";
                    echo "\n<br /> No appointment made.";
            echo "</div>"; //id='appointments'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";

    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='current_medication' class='overviewblock'>";
                echo "\n<div class='block_title'>CURRENT MEDICATION</div>";
                echo "\n<table>";
                if(isset($medication_info)){
                    foreach ($medication_info as $medication_item){
                        echo "\n<tr>";
                        echo "<td>".anchor('ehr_patient/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$medication_item['medication_id'], $medication_item['atc_code'])."</td>";
                        echo "<td width='400'>".$medication_item['generic_name']."</td>";
                        echo "<td>".$medication_item['dose']."</td>";
                        echo "<td>".$medication_item['dose_form']."</td>";
                        echo "<td>".$medication_item['frequency']."</td>";
                        echo "<td>".$medication_item['quantity']."</td>";
                        echo "</tr>";
                    }//endforeach;
                } else {
                    echo "\n<tr><td><br /> None</td></tr>";
                } //endif(isset($medication_info))
                echo "\n</table>";
            echo "</div>"; //id='current_medication'
if($multicolumn){
        echo "\n</td>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='medication_history' class='overviewblock'>";
                echo "\n<div class='block_title'>MEDICATION HISTORY</div>";
                    echo "\n<br /> None recorded";
            echo "</div>"; //id='medication_history'
if($multicolumn){
       echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='medical_history' class='overviewblock'>";
                echo "\n<div class='block_title'>MEDICAL HISTORY</div>";
                echo "\n<table>";
                echo "\n<tr>";
                    echo "\n<th>Code</th>";
                    echo "\n<th width='400'>Title</th>";
                    echo "\n<th>Type</th>";
                    echo "\n<th>Notes</th>";
                echo "</tr>";
                foreach ($diagnoses_info as $diagnosis_item){
                    echo "<tr>";
                    echo "<td>".anchor('ehr_patient/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$diagnosis_item['diagnosis_id'], $diagnosis_item['dcode1ext_code'])."</td>";
                    echo "<td>".$diagnosis_item['full_title']."</td>";
                    echo "<td>".$diagnosis_item['diagnosis_type']."</td>";
                    echo "<td>".$diagnosis_item['diagnosis_notes']."</td>";
                    echo "</tr>";
                }//endforeach;
                echo "</table>";
            echo "</div>"; //id='medical_history'
if($multicolumn){
        echo "\n</td>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='family_history' class='overviewblock'>";
                echo "\n<div class='block_title'>FAMILY HISTORY</div>";
                    echo "\n<br /> None recorded";
            echo "</div>"; //id='family_history'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='lab_orders' class='overviewblock'>";
                echo "\n<div class='block_title'>LAB ORDERS</div>";
                    echo "\n<br /> None recorded";
            echo "</div>"; //id='lab_orders'
        echo "\n</td>";
        echo "\n<td valign='top'>";
                echo "\n\n<div id='imaging_orders' class='overviewblock'>";
                    echo "\n<div class='block_title'>IMAGING ORDERS</div>";
                        echo "\n<br /> None recorded";
                echo "</div>"; //id='imaging_orders'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='proc_orders' class='overviewblock'>";
                echo "\n<div class='block_title'>PROCEDURE ORDERS</div>";
                    echo "\n<br /> None recorded";
            echo "</div>"; //id='proc_orders'
        echo "\n</td>";
        echo "\n<td valign='top'>";
            echo "\n\n<div id='appointments' class='overviewblock'>";
                echo "\n<div class='block_title'>APPOINTMENTS</div>";
                    echo "\n<br /> None recorded";
            echo "</div>"; //id='appointments'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>";
}
if($multicolumn){
        echo "\n</td>";
        echo "\n<td>";
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n</table>";
}

echo "\n<p />";
//echo $patient_past_con['date_started'];
echo '<u>Past Consultations</u>';
echo "<ol>";
foreach ($patient_past_con as $consultation){
    echo "<li>";
	echo anchor('ehr_individual/past_con_details/'.$consultation['patient_id'].'/'.$consultation['summary_id'].'/html ', 'html', 'target="_blank"');
    echo " ";
	echo anchor('ehr_individual/past_con_details/'.$consultation['patient_id'].'/'.$consultation['summary_id'].'/pdf ', 'pdf', 'target="_blank"');
    echo " ";
    echo $consultation['date_started']." ".$consultation['clinic_name'];
    echo "</li>";
}
//endforeach;
echo "</ol>";

echo "</div>"; //id=content

echo "</div>"; //id=body
