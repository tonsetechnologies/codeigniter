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
 * Portions created by the Initial Developer are Copyright (C) 2010
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    print "<br />age_menarche = " . $age_menarche;
    print "<br />form_purpose = " . $form_purpose;
    print "<br />patient_id = " . $patient_id;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patient_age)=<br />";
		print_r($patient_age);
    echo "\n<br />print_r(referral_info)=<br />";
		print_r($referral_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(patient_past_con)=<br />";
		print_r($patient_past_con);
    echo "\n<br />print_r(vitals_info)=<br />";
		print_r($vitals_info);
    echo "\n<br />print_r(medication_info)=<br />";
		print_r($medication_info);
    echo "\n<br />print_r(lab_info)=<br />";
		print_r($lab_info);
    echo "\n<br />print_r(imaging_info)=<br />";
		print_r($imaging_info);
    echo "\n<br />print_r(diagnoses_info)=<br />";
		print_r($diagnoses_info);
    echo "\n<br />print_r(social_history)=<br />";
		print_r($social_history);
    echo "\n<br />print_r(vaccines_list)=<br />";
		print_r($vaccines_list);
    echo "\n<br />print_r(history_antenatal)=<br />";
		print_r($history_antenatal);
    echo "\n<br />print_r(referrals_list)=<br />";
		print_r($referrals_list);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_refer_select_details_html_title')."</h1></div>";

$attributes =   array('class' => 'select_form', 'id' => 'export_form');
echo form_open('ehr_individual_refer/refer_export_detailsdone/'.$form_purpose.'/'.$patient_id.'/'.$summary_id, $attributes);

echo "\n<table>";
echo "\n<tr>";
    echo "<td>Referral Centre</td>";
    echo "<td><strong>".$referral_info[0]['referral_centre']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>Referral Person</td>";
    echo "<td><strong>".$referral_info[0]['referral_doctor_name']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>Speciality</td>";
    echo "<td><strong>".$referral_info[0]['referral_specialty']."</strong></td>";
echo "\n</tr>";
echo "\n</table>";
echo "\n<br />";

if($multicolumn){
    echo "\n<table>";
}

if($multicolumn){
    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='drug_allergies' class='overviewblock'>";
                echo "\n<div class='block_title'>DRUG ALLERGIES</div>";
                echo "\n<table>";
                if(count($drug_allergies) > 0){
                    $rownum = 1;
                    foreach ($drug_allergies as $allergy_item){
                        echo "\n<tr>";
                        echo "\n<td>".$rownum.".</td>";
                        echo "\n<td>".$allergy_item['generic_name']."</td>";
                        //echo "\n<td>".anchor('ehr_individual/edit_drug_allergy/edit_allergy/'.$patient_id.'/'.$allergy_item['patient_drug_allergy_id'], "<strong>".$allergy_item['generic_name']."</strong></td>");
                        echo "\n<td>".$allergy_item['reaction']."</td>";
                        echo "\n</tr>";
                        $rownum++;
                    }//endforeach;
                } else {
                    echo "\n<tr><td><br /> None recorded</td></tr>";
                } //endif(isset($allergy_list))
                echo "\n</table>";
            echo "</div>"; //id='drug_allergies'
        echo "\n</td>";
        echo "\n<td valign='top'>";
            echo "\n\n<div id='other_allergies' class='overviewblock'>";
                echo "\n<div class='block_title'>OTHER ALLERGIES</div>";
                    echo "\n<br /> None recorded";
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
                        echo "\n<td>[".$vitals_info['reading_date']."]</td>";
                        echo "<td>";
                        echo anchor('ehr_individual/graph_processor', ' ;', 'target="_blank"');
                        echo "</td>";
                        echo "\n<td></td>";
                        echo "<td></td>";
                    echo "\n</tr>";
                    echo "\n</table>";
                } else {
                    echo "\n<br /> None recorded";
                        echo anchor('ehr_individual/graph_processor', ' ;', 'target="_blank"');
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
                    echo "\n<tr><td><br /> None recorded</td></tr>";
                echo "\n</table>";
            echo "</div>"; //id='current_medication'
if($multicolumn){
        echo "\n</td>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='medication_history' class='overviewblock'>";
                echo "\n<div class='block_title'>MEDICATION HISTORY</div>";
                echo "\n<table>";
                if(count($medication_info) > 0){
                    foreach ($medication_info as $medication_item){
                        echo "\n<tr>";
                        echo "<td>".$medication_item['date_started']."</td>";
                        echo "<td width='400'><strong>".$medication_item['generic_name']."</strong></td>";
                        //echo "<td width='400'>".anchor('ehr_patient/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$medication_item['medication_id'], $medication_item['generic_name'])."</td>";
                        echo "<td>".$medication_item['date_stopped']."</td>";
                        //echo "<td>".$medication_item['dose_form']."</td>";
                        //echo "<td>".$medication_item['frequency']."</td>";
                        //echo "<td>".$medication_item['quantity']."</td>";
                        echo "</tr>";
                    }//endforeach;
                } else {
                    echo "\n<tr><td><br /> None recorded</td></tr>";
                } //endif(isset($medication_info))
                echo "\n</table>";
            echo "</div>"; //id='medication_history'
if($multicolumn){
       echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='medical_history' class='overviewblock'>";
                echo "\n<div class='block_title'>MEDICAL HISTORY</div>";
                if(count($diagnoses_info) > 0){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th>Code</th>";
                        echo "\n<th width='400'>Title</th>";
                        echo "\n<th>Type</th>";
                        echo "\n<th>Notes</th>";
                    echo "</tr>";
                    foreach ($diagnoses_info as $diagnosis_item){
                        echo "<tr>";
                        echo "<td valign='top'>".anchor('ehr_patient/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$diagnosis_item['diagnosis_id'], $diagnosis_item['dcode1ext_code'])."</td>";
                        echo "<td>".$diagnosis_item['full_title']."</td>";
                        echo "<td valign='top'>".$diagnosis_item['diagnosis_type']."</td>";
                        echo "<td valign='top'>".$diagnosis_item['diagnosis_notes']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($diagnoses_info) > 0)
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
                if(count($lab_info) > 0){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th>Code</th>";
                        echo "\n<th width='400'>Package</th>";
                        echo "\n<th>Date</th>";
                        echo "\n<th>Result</th>";
                    echo "</tr>";
                    foreach ($lab_info as $lab_item){
                        echo "\n<tr>";
                        echo "<td>".$lab_item['package_code']."</td>";
                        echo "\n<td>".anchor('ehr_individual_history/edit_labresults/edit_labresults/'.$patient_id.'/'.$lab_item['session_id'].'/'.$lab_item['lab_order_id'], "<strong>".$lab_item['package_code']."</strong>")."</td>";
                        echo "<td>".$lab_item['package_name']."</td>";
                        echo "<td>".$lab_item['sample_date']."</td>";
                        echo "<td>".$lab_item['result_status']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($lab_info) > 0)
            echo "</div>"; //id='lab_orders'
        echo "\n</td>";
        echo "\n<td valign='top'>";
                echo "\n\n<div id='imaging_orders' class='overviewblock'>";
                echo "\n<div class='block_title'>IMAGING ORDERS</div>";
                if(count($imaging_info) > 0){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th>Code</th>";
                        echo "\n<th>Component</th>";
                        echo "\n<th width='200'>Remarks</th>";
                        echo "\n<th>Supplier</th>";
                    echo "</tr>";
                    foreach ($imaging_info as $imaging_item){
                        echo "<tr>";
                        echo "<td>".$imaging_item['product_code']."</td>";
                        //echo "<td>".anchor('ehr_patient/edit_/edit_diagnosis/'.$patient_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
                        echo "<td>".$imaging_item['component']."</td>";
                        echo "<td>".$imaging_item['remarks']."</td>";
                        echo "<td>".$imaging_item['supplier_name']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($lab_info) > 0)
                echo "</div>"; //id='imaging_orders'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
} //endif($multicolumn)
            echo "\n\n<div id='proc_orders' class='overviewblock'>";
                echo "\n<div class='block_title'>SOCIAL HISTORY</div>";
                if(count($social_history) > 0){
                    echo "\n<table>";
                    echo "\n<tr><td colspan='2'>Date recorded</td><td>: ".anchor('ehr_individual/edit_history_social/'.$patient_id.'/edit_history/'.$social_history[0]['social_history_id'], $social_history[0]['date'])."</td>";
                    echo "\n<tr><td valign='top' width='100'>Drugs use</td><td width='40' valign='top'>: ".$social_history[0]['drugs_use']."</td><td>: ".$social_history[0]['drugs_spec']."</td></tr>";
                    echo "\n<tr><td valign='top'>Alcohols use</td><td valign='top'>: ".$social_history[0]['alcohol_use']."</td><td>: ".$social_history[0]['alcohol_spec']."</td></tr>";
                    echo "\n<tr><td valign='top'>Tobacco use</td><td valign='top'>: ".$social_history[0]['tobacco_use']."</td><td>: ".$social_history[0]['tobacco_spec']."</td></tr>";
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($diagnoses_info) > 0)
            echo "</div>"; //id='proc_orders'
        echo "\n</td>";
        echo "\n<td valign='top'>";
            echo "\n\n<div id='appointments' class='overviewblock'>";
                echo "\n<div class='block_title'>IMMUNISATION HISTORY</div>";
                echo "\n<table>";
                echo "\n<tr>";
                    echo "\n<th>Date</th>";
                    echo "\n<th>Vaccine</th>";
                    echo "\n<th width='200'>Notes</th>";
                echo "</tr>";
                foreach ($vaccines_list as $vaccine_item){
                    if(!empty($vaccine_item['date'])){
                        echo "<tr>";
                        echo "<td>".$vaccine_item['date']."</td>";
                        //echo "<td>".anchor('ehr_patient/edit_/edit_diagnosis/'.$patient_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
                        echo "<td><strong>".$vaccine_item['vaccine_short']."</strong></td>";
                        echo "<td>".$vaccine_item['notes']."</td>";
                        echo "</tr>";
                    }
                }//endforeach;
                echo "</table>";
            echo "</div>"; //id='appointments'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
} //endif($multicolumn)
            echo "\n\n<div id='antenatal_history' class='overviewblock'>";
                echo "\n<div class='block_title'>ANTENATAL HISTORY</div>";
                if(count($history_antenatal) > 0){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th>Gravida</th>";
                        echo "\n<th width='80'>LMP</th>";
                        echo "\n<th width='80'>EDD</th>";
                        echo "\n<th width='80'>Status</th>";
                    echo "</tr>";
                    foreach ($history_antenatal as $antenatal_item){
                        echo "<tr>";
                        echo "<td>".$antenatal_item['gravida']."</td>";
                        //echo "<td>".anchor('ehr_patient/edit_/edit_diagnosis/'.$patient_id.'/'.$lab_item['lab_order_id'], $lab_item['package_code'])."</td>";
                        echo "<td>".$antenatal_item['lmp']."</td>";
                        echo "<td><strong>".$antenatal_item['lmp_edd']."</strong></td>";
                        echo "<td align='center'>".$antenatal_item['status']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($lab_info) > 0)
            echo "</div>"; //id='proc_orders'
        echo "\n</td>";
        echo "\n<td valign='top'>";
                echo "\n\n<div id='referrals_history' class='overviewblock'>";
                echo "\n<div class='block_title'>REFERRALS HISTORY</div>";
                if(count($referrals_list) > 0){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th>Date</th>";
                        echo "\n<th width='100'>Referral Centre</th>";
                        echo "\n<th>Doctor</th>";
                        echo "\n<th>Reason</th>";
                    echo "</tr>";
                    foreach ($referrals_list as $referral_item){
                        echo "<tr>";
                        echo "<td valign='top'>".anchor('ehr_consult/print_referral_letter/print_referral_letter/'.$patient_id.'/'.$referral_item['session_id'].'/'.$referral_item['referral_id'], $referral_item['referral_date'], 'target="_blank"')."</td>";
                        echo "<td valign='top'>".$referral_item['referral_centre']."</td>";
                        echo "<td valign='top'>".$referral_item['referral_doctor_name']."</td>";
                        echo "<td valign='top'>".$referral_item['reason']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($lab_info) > 0)
                echo "</div>"; //id='imaging_orders'
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

echo "<table>";
echo "\n<tr>";
    echo "<td>Reference</td>";
    echo "<td>";
        echo "<input type='text' class='normal' name='reference' value='' id='reference' />";          
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td valign='top'>Remarks</td>";
    echo "<td>";
    echo "\n<textarea class='normal' name='remarks' id='remarks' cols='60' rows='4'></textarea>";
    echo "\n</td>";
echo "\n</tr>";
echo "</table>";

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('referral_id', $referral_id);

echo "<div align='center'><br />";
echo "<input type='submit' value=' Export Referral Details ' />";
echo "</div>";

echo "</form>";

echo "</div>"; //id=content

echo "</div>"; //id=body
