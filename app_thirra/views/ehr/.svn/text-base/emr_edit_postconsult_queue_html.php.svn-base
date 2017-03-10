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
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(vitals_info)=<br />";
		print_r($vitals_info);
	echo '</pre>';
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('past_con_details_html_title')."</h1></div>";

echo "\n<p>";

echo "\n<table>";
echo "\n<tr>";
	echo '<td>';
		echo 'Patient\'s Name';
	echo '</td>';
	echo '<td>';
        echo "<h3>".$patient_info['name'].", ".$patient_info['name_first']."</h3>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Date of Birth / Sex';
	echo '</td>';
	echo '<td>';
        echo $patient_info['birth_date']." / ".$patient_info['gender'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Session started';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['date_started']." at ".$patcon_info['time_started'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Session ended';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['date_ended']." at ".$patcon_info['time_ended'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Consultant';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['signed_name'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo "\nAdditional Notes to Consultation";
	echo '</td>';
	echo '<td>';
        echo $patcon_info['summary'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'External Reference';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['external_ref'];
	echo '</td>';
echo '</tr>';

echo '</table>';
echo "\n</p>";


echo "\n\n<div id='complaints' class='episodeblock'>";
    echo "\n<div class='block_title'>COMPLAINTS</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th width='70'>Code</th>";
        echo "\n<th width='400'>Title</th>";
        echo "\n<th>Duration</th>";
        echo "\n<th>Notes</th>";
    echo "</tr>";
    foreach ($complaints_list as $complaint_item){
        echo "<tr>";
        echo "<td>".$complaint_item['icpc_code']."</td>";
        //echo "<td>".anchor('ehr_patient/edit_reason_encounter/edit_complaints/'.$patient_id.'/'.$summary_id.'/'.$complaint_item['complaint_id'], $complaint_item['icpc_code'])."</td>";
        echo "<td width='400'>".$complaint_item['full_description']."</td>";
        echo "<td>".$complaint_item['duration']."</td>";
        echo "<td>".$complaint_item['complaint_notes']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='complaints'

echo "\n\n<div id='vitals' class='episodeblock'>";
    echo "\n<div class='block_title'>VITAL SIGNS</div>";
    if($vitals_info['vital_id'] <> "new_vitals"){
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<td width='250'>Temperature</td>";
            echo "<td width='50'>".$vitals_info['temperature']."</td>";
            echo "\n<td width='250'>Pulse Rate</td>";
            echo "<td width='50'>".$vitals_info['pulse_rate']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>BP systolic</td>";
            echo "<td>".$vitals_info['bp_systolic']."</td>";
            echo "\n<td>BP diastolic</td>";
            echo "<td>".$vitals_info['bp_diastolic']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Height</td>";
            echo "<td width='50'>".$vitals_info['height']."</td>";
            echo "\n<td>Weight</td>";
            echo "<td width='50'>".$vitals_info['weight']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td></td>";
            echo "<td></td>";
            echo "\n<td></td>";
            echo "<td></td>";
        echo "\n</tr>";
        echo "\n</table>";
    } else {
        echo "\n<br />&nbsp; None recorded";
    }
echo "</div>"; //id='vitals'

echo "\n\n<div id='lab' class='episodeblock'>";
    echo "<div class='block_title'>LAB ORDERS</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th width='100'>Code</th>";
        echo "\n<th width='200'>Title</th>";
        echo "\n<th>Sample Ref.</th>";
        echo "\n<th>Supplier</th>";
        echo "\n<th>Remarks</th>";
    echo "</tr>";
    foreach ($lab_list as $order_item){
        echo "<tr>";
        //echo "<td>".anchor('ehr_patient/edit_lab/edit_lab/'.$patient_id.'/'.$summary_id.'/'.$order_item['lab_order_id'], $order_item['package_code'])."</td>";
        echo "<td>".$order_item['package_code']."</td>";
        echo "<td>".$order_item['package_name']."</td>";
        echo "<td>".$order_item['sample_ref']."</td>";
        echo "<td>".$order_item['supplier_name']."</td>";
        echo "<td>".$order_item['remarks']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='referral'

echo "\n\n<div id='imaging' class='episodeblock'>";
    echo "<div class='block_title'>IMAGING ORDERS</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th width='100'>Code</th>";
        echo "\n<th width='200'>Component</th>";
        echo "\n<th width='200'>Description</th>";
        echo "\n<th>Ref No.</th>";
        echo "\n<th>Supplier</th>";
    echo "</tr>";
    foreach ($imaging_list as $imaging_item){
        echo "<tr>";
        echo "<td>".$imaging_item['product_code']."</td>";
        //echo "<td>".anchor('ehr_patient/edit_imaging/edit_imaging/'.$patient_id.'/'.$summary_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
        echo "<td>".$imaging_item['component']."</td>";
        echo "<td>".$imaging_item['description']."</td>";
        echo "<td>".$imaging_item['supplier_ref']."</td>";
        echo "<td>".$imaging_item['supplier_name']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='referral'

echo "\n\n<div id='diagnosis' class='episodeblock'>";
    echo "<div class='block_title'>DIAGNOSIS</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th width='70'>Code</th>";
        echo "\n<th width='400'>Title</th>";
        echo "\n<th>Type</th>";
        echo "\n<th>Notes</th>";
    echo "</tr>";
    foreach ($diagnosis_list as $diagnosis_item){
        echo "<tr>";
        echo "<td>".$diagnosis_item['dcode1ext_code']."</td>";
        //echo "<td>".anchor('ehr_patient/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$summary_id.'/'.$diagnosis_item['diagnosis_id'], $diagnosis_item['dcode1ext_code'])."</td>";
        echo "<td>".$diagnosis_item['full_title']."</td>";
        echo "<td>".$diagnosis_item['diagnosis_type']."</td>";
        echo "<td>".$diagnosis_item['diagnosis_notes']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='diagnosis'

echo "\n\n<div id='prescriptions' class='episodeblock'>";
    echo "<div class='block_title'>PRESCRIPTIONS</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th width='400'>Generic Name</th>";
        echo "\n<th>Dose</th>";
        echo "\n<th></th>";
        echo "\n<th>Frequency</th>";
        echo "\n<th>Indication</th>";
    echo "</tr>";
    foreach ($prescribe_list as $prescribe_item){
        echo "<tr>";
        echo "<td>".$prescribe_item['generic_name']."</td>";
        //echo "<td>".anchor('ehr_patient/edit_prescription/edit_prescribe/'.$patient_id.'/'.$summary_id.'/'.$prescribe_item['queue_id'], $prescribe_item['generic_name'])."</td>";
        echo "<td>".$prescribe_item['dose']."</td>";
        echo "<td>".$prescribe_item['dose_form']."</td>";
        echo "<td>".$prescribe_item['frequency']."</td>";
        echo "<td>".$prescribe_item['indication']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='prescriptions'

echo "\n\n<div id='referral' class='episodeblock'>";
    echo "<div class='block_title'>REFERRAL</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th width='200'>Referral Person</th>";
        echo "\n<th width='100'>Specialty</th>";
        echo "\n<th width='200'>Referral Centre</th>";
        echo "\n<th>Referral Date</th>";
        echo "\n<th>Referral Reason</th>";
    echo "</tr>";
    foreach ($referrals_list as $referral_item){
        echo "<tr>";
        echo "<td>".$referral_item['doctor_name']."</td>";
        //echo "<td>".anchor('ehr_patient/edit_referral/edit_referral/'.$patient_id.'/'.$summary_id.'/'.$referral_item['referral_id'], $referral_item['doctor_name'])."</td>";
        echo "<td>".$referral_item['specialty']."</td>";
        echo "<td>".$referral_item['referral_center_name']."</td>";
        echo "<td>".$referral_item['referral_date']."</td>";
        echo "<td>".$referral_item['reason']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='referral'

echo "</div>"; //id='content'

echo "</div>"; //id=body
