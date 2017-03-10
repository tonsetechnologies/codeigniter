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
    echo "\n<br />print_r(vitals_info)=<br />";
		print_r($vitals_info);
    echo "\n<br />print_r(lab_list)=<br />";
		print_r($lab_list);
    echo "\n<br />print_r(imaging_list)=<br />";
		print_r($imaging_list);
    echo "\n<br />print_r(prescribe_list)=<br />";
		print_r($prescribe_list);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_indv_consult_html_title')."</h1></div>";

echo "\n\n<div id='complaints' class='episodeblock'>";
    echo "\n<div class='block_title'>COMPLAINTS</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th>Code</th>";
        echo "\n<th width='400'>Title</th>";
        echo "\n<th>Duration</th>";
        echo "\n<th>Notes</th>";
    echo "</tr>";
    foreach ($complaints_list as $complaint_item){
        echo "<tr>";
        echo "<td>".anchor('ehr_consult/edit_reason_encounter/edit_complaints/'.$patient_id.'/'.$summary_id.'/'.$complaint_item['complaint_id'], $complaint_item['icpc_code'])."</td>";
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
            echo "<td width='150'>".$vitals_info['temperature']." &deg;C</td>";
            echo "\n<td width='250'>Pulse Rate</td>";
            echo "<td width='150'>".$vitals_info['pulse_rate']." beats/min</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>BP systolic</td>";
            echo "<td>".$vitals_info['bp_systolic']." mm Hg</td>";
            echo "\n<td>BP diastolic</td>";
            echo "<td>".$vitals_info['bp_diastolic']." mm Hg</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Height</td>";
            echo "<td width='50'>".$vitals_info['height']." cm</td>";
            echo "\n<td>Weight</td>";
            echo "<td width='50'>".$vitals_info['weight']." kg</td>";
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
        echo "\n<th>Code</th>";
        echo "\n<th width='200'>Title</th>";
        echo "\n<th>Sample Ref.</th>";
        echo "\n<th>Supplier</th>";
        echo "\n<th>Remarks</th>";
        echo "\n<th>Results</th>";
    echo "</tr>";
    foreach ($lab_list as $order_item){
        echo "<tr>";
        echo "<td>".anchor('ehr_consult/edit_lab/edit_lab/'.$patient_id.'/'.$summary_id.'/'.$order_item['lab_order_id'], $order_item['package_code'])."</td>";
        echo "<td>".$order_item['package_name']."</td>";
        echo "<td>".$order_item['sample_ref']."</td>";
        echo "<td>".$order_item['supplier_name']."</td>";
        echo "<td>".$order_item['remarks']."</td>";
        echo "<td>".$order_item['summary_result']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='lab'

echo "\n\n<div id='imaging' class='episodeblock'>";
    echo "<div class='block_title'>IMAGING ORDERS</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th>Code</th>";
        echo "\n<th width='200'>Component</th>";
        echo "\n<th width='200'>Description</th>";
        echo "\n<th>Ref No.</th>";
        echo "\n<th>Supplier</th>";
    echo "</tr>";
    foreach ($imaging_list as $imaging_item){
        echo "<tr>";
        echo "<td>".anchor('ehr_consult/edit_imaging/edit_imaging/'.$patient_id.'/'.$summary_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
        echo "<td>".$imaging_item['component']."</td>";
        echo "<td>".$imaging_item['description']."</td>";
        echo "<td>".$imaging_item['supplier_ref']."</td>";
        echo "<td>".$imaging_item['supplier_name']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='imaging'

echo "\n\n<div id='diagnosis' class='episodeblock'>";
    echo "<div class='block_title'>DIAGNOSIS</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th>Code</th>";
        echo "\n<th width='400'>Title</th>";
        echo "\n<th>Type</th>";
        echo "\n<th>Notes</th>";
    echo "</tr>";
    foreach ($diagnosis_list as $diagnosis_item){
        echo "<tr>";
        echo "<td>".anchor('ehr_consult/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$summary_id.'/'.$diagnosis_item['diagnosis_id'], $diagnosis_item['dcode1ext_code'])."</td>";
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
        echo "\n<th>Generic Name</th>";
        echo "\n<th>Dose</th>";
        echo "\n<th></th>";
        echo "\n<th>Frequency</th>";
        echo "\n<th>Indication</th>";
    echo "</tr>";
    foreach ($prescribe_list as $prescribe_item){
        echo "<tr>";
        echo "<td>".anchor('ehr_consult/edit_prescription/edit_prescribe/'.$patient_id.'/'.$summary_id.'/'.$prescribe_item['queue_id'], $prescribe_item['generic_name'])."</td>";
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
    echo "\n<th>Referral Letter</th>";
    echo "</tr>";
    foreach ($referrals_list as $referral_item){
        echo "<tr>";
        echo "<td>".anchor('ehr_consult/edit_referral/edit_referral/'.$patient_id.'/'.$summary_id.'/'.$referral_item['referral_id'], $referral_item['doctor_name'])."</td>";
        echo "<td>".$referral_item['specialty']."</td>";
        echo "<td>".$referral_item['name']."</td>";
        echo "<td>".$referral_item['referral_date']."</td>";
        echo "<td>".$referral_item['reason']."</td>";
    echo "<td>".anchor('ehr_consult/print_referral_letter/print_referral_letter/'.$patient_id.'/'.$summary_id.'/'.$referral_item['referral_id'], 'Print', 'target="_blank"')."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='referral'

echo "\n<p>";
echo form_open('ehr_consult/consult_episode/edit_episode/'.$patient_id.'/'.$summary_id);
echo form_hidden('form_purpose', 'edit_episode');
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);

echo "\n<table>";
echo "\n<tr>";
	echo '<td>';
		echo 'Date started';
	echo '</td>';
	echo '<td>';
        echo form_error('date_started');
        echo "\n<input type='text' name='date_started' value='".set_value('date_started',$patcon_info['date_started'])."' size='10' /> yyyy-mm-dd</td></tr>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Time started';
	echo '</td>';
	echo '<td>';
        echo form_error('time_started');
        echo "\n<input type='text' name='time_started' value='".set_value('time_started',$patcon_info['time_started'])."' size='8' /> hh:mm</td></tr>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Date ended';
	echo '</td>';
	echo '<td>';
        echo form_error('date_ended');
        echo "\n<input type='text' name='date_ended' value='".set_value('date_ended',$date_ended)."' size='10' /> yyyy-mm-dd</td></tr>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Time ended';
	echo '</td>';
	echo '<td>';
        echo form_error('time_ended');
        echo "\n<input type='text' name='time_ended' value='".set_value('time_ended',$time_ended)."' size='8' /> hh:mm</td></tr>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo "\nAdditional Notes to Consultation";
	echo '</td>';
	echo '<td>';
        echo "\n<br /><textarea class='normal' name='consult_notes' id='consult_notes' value='".set_value('consult_notes',$consult_notes)."' cols='40' rows='4'></textarea>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'External Reference';
	echo '</td>';
	echo '<td>';
        echo form_error('external_ref');
        echo "\n<input type='text' name='external_ref' value='".set_value('external_ref',$patcon_info['external_ref'])."' size='10' /></td></tr>";
	echo '</td>';
echo '</tr>';

echo '</table>';

echo "<input type='checkbox' name='confirm_close' /> Confirm close clinical consultation episode.";

echo "\n</p>";
echo "<p><div align='center'><input type='submit' value='End Consultation' /></div> </p>";

echo "\n<br /><h6>Please ensure that all information are correct. You will not be able to return to this page after clicking the [End Consultation] button.</h6>";
echo "</div>"; //id='content'

echo "</div>"; //id=body
