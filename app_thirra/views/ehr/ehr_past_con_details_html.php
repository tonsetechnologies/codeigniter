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
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(vitals_info)=<br />";
		print_r($vitals_info);
    echo "\n<br />print_r(referrals_list)=<br />";
		print_r($referrals_list);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('12900-100_past_con_details_html_title')."</h1></div>";

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
        echo "\nNotes";
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
        echo "<td valign='top'>".$complaint_item['icpc_code']."</td>";
        //echo "<td>".anchor('ehr_patient/edit_reason_encounter/edit_complaints/'.$patient_id.'/'.$summary_id.'/'.$complaint_item['complaint_id'], $complaint_item['icpc_code'])."</td>";
        echo "<td valign='top' width='400'>".$complaint_item['full_description']."</td>";
        echo "<td valign='top'>".$complaint_item['duration']."</td>";
        echo "<td valign='top'>".$complaint_item['complaint_notes']."</td>";
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
            echo "\n<td width='100'>&deg;C</td>";
            echo "\n<td width='250'>Pulse Rate</td>";
            echo "<td width='50'>".$vitals_info['pulse_rate']."</td>";
            echo "\n<td width='100'>bpm</td>";
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
            echo "\n<td>m</td>";
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
        echo "\n</table>";
    } else {
        echo "\n<br />&nbsp; None recorded";
    }
echo "</div>"; //id='vitals'

echo "\n\n<div id='physical' class='episodeblock'>";
    echo "\n<div class='block_title'>PHYSICAL EXAMINATION</div>";
    if($physical_info['physical_exam_id'] <> "new_physical"){
        echo "\n<table>";
        echo "\n<tr><td>";
        echo "\n<fieldset>";
        echo "<legend>Cardio Vascular System</legend>";
        echo "\n<table>";
            if(!empty($physical_info['pulse_rate'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Pulse rate</td>";
                echo "<td>".$physical_info['pulse_rate']." bpm</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['pulse_regular'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Pulse regular</td>";
                echo "<td>".$physical_info['pulse_regular']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['pulse_regular_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'> </td>";
                echo "<td>".$physical_info['pulse_regular_spec']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['pulse_volume'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Volume</td>";
                echo "<td>".$physical_info['pulse_volume']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['pulse_volume_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'> </td>";
                echo "<td>".$physical_info['pulse_volume_spec']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['heart_rhythm'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Heart rhythm</td>";
                echo "<td>".$physical_info['heart_rhythm']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['heart_rhythm_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'> </td>";
                echo "<td>".$physical_info['heart_rhythm_spec']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['heart_murmur'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Heart murmur</td>";
                echo "<td>".$physical_info['heart_murmur']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['heart_murmur_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'> </td>";
                echo "<td>".$physical_info['heart_murmur_spec']."</td>";
                echo "\n</tr>";
            }
        echo "\n</table>";
        echo "\n</fieldset>";
        echo "\n</td></tr>";

        echo "\n<tr><td>";
        echo "\n<fieldset>";
        echo "<legend>Respiratory System</legend>";
        echo "\n<table>";
            if(!empty($physical_info['lung_clear'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Clear lungs</td>";
                echo "<td>".$physical_info['lung_clear']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['lung_clear_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'> </td>";
                echo "<td>".$physical_info['lung_clear_spec']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['chest_measurement_in'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Chest (inhale)</td>";
                echo "<td>".$physical_info['chest_measurement_in']." cm</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['chest_measurement_out'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Chest (exhale)</td>";
                echo "<td>".$physical_info['chest_measurement_out']." cm</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['percussion'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Percussion</td>";
                echo "<td>".$physical_info['percussion']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['percussion_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'> </td>";
                echo "<td>".$physical_info['percussion_spec']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['abdominal_girth'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Abdominal girth</td>";
                echo "<td>".$physical_info['abdominal_girth']." cm</td>";
                echo "\n</tr>";
            }
        echo "\n</table>";
        echo "\n</fieldset>";
        echo "\n</td></tr>";

        echo "\n<tr><td>";
        echo "\n<fieldset>";
        echo "<legend>Abdomen</legend>";
        echo "\n<table>";
            if(!empty($physical_info['liver_palpable'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Liver palpable</td>";
                echo "<td>".$physical_info['liver_palpable']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['liver_palpable_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'> </td>";
                echo "<td>".$physical_info['liver_palpable_spec']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['spleen_palpable'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Spleen palpable</td>";
                echo "<td>".$physical_info['spleen_palpable']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['spleen_palpable_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'> </td>";
                echo "<td>".$physical_info['spleen_palpable_spec']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['kidney_palpable'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Kidney palpable</td>";
                echo "<td>".$physical_info['kidney_palpable']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['kidney_palpable_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'> </td>";
                echo "<td>".$physical_info['kidney_palpable_spec']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['external_genitalia'])){
                echo "\n<tr>";
                echo "\n<td width='250'>External genitalia</td>";
                echo "<td>".$physical_info['external_genitalia']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['external_genitalia_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'> </td>";
                echo "<td>".$physical_info['external_genitalia_spec']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['perectal_exam'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Perectal exam</td>";
                echo "<td>".$physical_info['perectal_exam']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['hernial_orifices'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Hernial orifices</td>";
                echo "<td>".$physical_info['hernial_orifices']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['hernial_orifices_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'> </td>";
                echo "<td>".$physical_info['hernial_orifices_spec']."</td>";
                echo "\n</tr>";
            }
        echo "\n</table>";
        echo "\n</fieldset>";
        echo "\n</td></tr>";

        echo "\n<tr><td>";
        echo "\n<fieldset>";
        echo "<legend>Central Nervous System</legend>";
        echo "\n<table>";
            if(!empty($physical_info['pupils_equal'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Pupils equal</td>";
                echo "<td>".$physical_info['pupils_equal']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['pupils_reactive'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Pupils reactive</td>";
                echo "<td>".$physical_info['pupils_reactive']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['reflexes'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Reflexes</td>";
                echo "<td>".$physical_info['reflexes']."</td>";
                echo "\n</tr>";
            }
        echo "\n</table>";
        echo "\n</fieldset>";
        echo "\n</td></tr>";

        echo "\n<tr><td>";
        echo "\n<table>";
            if(!empty($physical_info['notes'])){
                echo "\n<tr>";
                echo "\n<td width='250' valign='top'><strong>Notes</strong></td>";
                echo "<td>".$physical_info['notes']."</td>";
                echo "\n</tr>";
            }
        echo "\n</table>";
        echo "\n</td></tr>";
        echo "\n</table>";
    } else {
        echo "\n<br />&nbsp; None recorded";
    }
echo "</div>"; //id='physical'

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
echo "</div>"; //id='lab'

echo "\n\n<div id='imaging' class='episodeblock'>";
    echo "<div class='block_title'>IMAGING ORDERS</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th width='100'>Code</th>";
        echo "\n<th width='200'>Description</th>";
        echo "\n<th>Ref No.</th>";
        echo "\n<th>Supplier</th>";
        echo "\n<th>Remarks</th>";
    echo "</tr>";
    foreach ($imaging_list as $imaging_item){
        echo "<tr>";
        echo "<td>".$imaging_item['product_code']."</td>";
        //echo "<td>".anchor('ehr_patient/edit_imaging/edit_imaging/'.$patient_id.'/'.$summary_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
        echo "<td>".$imaging_item['description']."</td>";
        echo "<td>".$imaging_item['supplier_ref']."</td>";
        echo "<td>".$imaging_item['supplier_name']."</td>";
        echo "<td>".$imaging_item['remarks']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='imaging'

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
        echo "\n<th>Quantity</th>";
        echo "\n<th></th>";
        echo "\n<th>Indication</th>";
    echo "</tr>";
    foreach ($prescribe_list as $prescribe_item){
        echo "<tr>";
        echo "<td>".$prescribe_item['generic_name']."</td>";
        //echo "<td>".anchor('ehr_patient/edit_prescription/edit_prescribe/'.$patient_id.'/'.$summary_id.'/'.$prescribe_item['queue_id'], $prescribe_item['generic_name'])."</td>";
        echo "<td>".$prescribe_item['dose']."</td>";
        echo "<td>".$prescribe_item['dose_form']."</td>";
        echo "<td>".$prescribe_item['frequency']."</td>";
        echo "<td>".$prescribe_item['quantity']."</td>";
        echo "<td>".$prescribe_item['quantity_form']."</td>";
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
        echo "\n<th width='300'>Referral Centre</th>";
        echo "\n<th>Referral Date</th>";
        echo "\n<th>Referral Reason</th>";
    echo "</tr>";
    foreach ($referrals_list as $referral_item){
        echo "<tr>";
        echo "<td>".$referral_item['doctor_name']."</td>";
        //echo "<td>".anchor('ehr_patient/edit_referral/edit_referral/'.$patient_id.'/'.$summary_id.'/'.$referral_item['referral_id'], $referral_item['doctor_name'])."</td>";
        echo "<td>".$referral_item['specialty']."</td>";
        echo "<td>".$referral_item['name']."</td>";
        echo "<td>".$referral_item['referral_date']."</td>";
        echo "<td>".$referral_item['reason']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='referral'

echo "</div>"; //id='content'

echo "</div>"; //id=body
