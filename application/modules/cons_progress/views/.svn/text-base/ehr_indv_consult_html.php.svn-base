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
 * Portions created by the Initial Developer are Copyright (C) 2009 -2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username');
    print "<br />now_id = " . $now_id;
    print "<br />came_from = " . $came_from;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(vitals_info)=<br />";
		print_r($vitals_info);
    echo "\n<br />print_r(physical_info)=<br />";
		print_r($physical_info);
    echo "\n<br />print_r(lab_list)=<br />";
		print_r($lab_list);
    echo "\n<br />print_r(imaging_list)=<br />";
		print_r($imaging_list);
    echo "\n<br />print_r(prescribe_list)=<br />";
		print_r($prescribe_list);
    echo "\n<br />print_r(dispense_list)=<br />";
		print_r($dispense_list);
    echo "\n<br />print_r(antenatal_info)=<br />";
		print_r($antenatal_info);
    echo "\n<br />print_r(checkup_list)=<br />";
		print_r($checkup_list);
    echo "\n<br />print_r(postpartum_list)=<br />";
		print_r($postpartum_list);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_indv_consult_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

$empty_session =    TRUE;

if($patient_info['gender'] == "Female"&& ($patient_info['fertile'] == "TRUE")){
    echo "\n\n<div id='antenatal' class='episodeblock'>";
        echo "<div class='block_title_con'>";
	    echo anchor('cons/cons/index/cons_antenatal/ehr_consult_antenatal/edit_antenatal_info/new_antenatal/'.$patient_id.'/'.$summary_id, 'CURRENT PREGNANCY');
        echo "</div>";
        echo "\n<table>";
        if($antenatal_info[0]['antenatal_id'] <> "new_antenatal"){
            echo "\n<tr>";
                echo "\n<th>Gravida</th>";
                echo "\n<th width='105'>LMP</th>";
                echo "\n<th>Gestation</th>";
                echo "\n<th width='105'>EDD (LMP)</th>";
                echo "\n<th>Termination</th>";
                echo "\n<th>Outcome</th>";
                echo "\n<th>Remarks</th>";
            echo "</tr>";
            $previous_antenatal_id  =   NULL;
            foreach ($antenatal_info as $antenatal_item){
                echo "\n<tr>";
                if($previous_antenatal_id === $antenatal_item['antenatal_id']){
                    echo "<td></td>";
                    echo "<td align='center'>\"</td>";
                    echo "<td align='center'>\"</td>";
                    echo "<td align='center'>\"</td>";
                    echo "\n<td><strong>".$antenatal_item['date_delivery']."</strong></td>";
                    echo "\n<td>".$antenatal_item['delivery_outcome']."</td>";
                    echo "<td align='center'>\"</td>";
                } else {
                    echo "<td valign='top'>".anchor('cons/cons/index/cons_antenatal/ehr_consult_antenatal/edit_antenatal_info/new_antenatal/'.$patient_id.'/'.$summary_id.'/'.$antenatal_item['antenatal_id'], $antenatal_item['gravida'])."</td>";
                    echo "<td>".$antenatal_item['lmp']."</td>";
                    if(!empty($antenatal_item['date_delivery'])){
                        echo "<td valign='top'><strong>".round((strtotime($antenatal_item['date_delivery'])-strtotime($antenatal_item['lmp']))/(60*60*24*7),1)." weeks</strong></td>";
                    } else {
                        echo "<td valign='top'><strong>".round(($now_id-strtotime($antenatal_item['lmp']))/(60*60*24*7),1)." weeks</strong></td>";
                    } //endif(!empty(antenatal_item['date_delivery']))
                    echo "<td valign='top'>".$antenatal_item['lmp_edd']."</td>";
                    echo "<td valign='top'><strong>".$antenatal_item['date_delivery']."</strong></td>";
                    echo "<td valign='top'>".$antenatal_item['delivery_outcome']."</td>";
                    echo "<td valign='top'>".$antenatal_item['antenatal_remarks']."</td>";
                } //endif($previous_antenatal_id === $history_item['antenatal_id'])
                echo "</tr>";
                $previous_antenatal_id  =   $antenatal_item['antenatal_id'];
            }//endforeach;
        } else {
            echo "\n<tr><td>&nbsp; None recorded</td></tr>";
        }
        echo "</table>";
    echo "</div>"; //id='antenatal'

    echo "\n\n<div id='antenatal_checkup' class='episodeblock'>";
        echo "\n<div class='block_title_con'>ANTENATAL CHECKUPS</div>";
        echo "\n<table>";
        if(!empty($checkup_list)){
            echo "\n<tr>";
                echo "\n<th width='115'>Date</th>";
                echo "\n<th width='120'>Pregnancy duration</th>";
                echo "\n<th width='80'>Weight</th>";
                echo "\n<th width='170'>Risks</th>";
                echo "\n<th width='170'>Notes</th>";
                echo "\n<th>Remarks</th>";
            echo "</tr>";
            foreach ($checkup_list as $checkup_item){
                echo "\n<tr>";
                echo "<td>";
                echo ($checkup_item['session_id']==$summary_id? "<strong>" : "");
                echo anchor('cons/cons/index/cons_antenatal/ehr_consult_antenatal/edit_antenatal_followup/edit_followup/'.$patient_id.'/'.$summary_id.'/'.$checkup_item['antenatal_id'].'/'.$checkup_item['antenatal_followup_id'], $checkup_item['date']);
                echo ($checkup_item['session_id']==$summary_id? "</strong>" : "");
                echo "</td>";
                echo "<td align='center'>".$checkup_item['pregnancy_duration']." weeks</td>";
                echo "<td>".$checkup_item['weight']." kg</td>";
                echo "<td>".$checkup_item['risks']."</td>";
                echo "<td>".$checkup_item['notes']."</td>";
                echo "<td>".$checkup_item['followup_remarks']."</td>";
                echo "</tr>";
            }//endforeach;
        } else {
            echo "\n<tr><td>&nbsp; None recorded</td></tr>";
        }
        echo "</table>";
    echo "</div>"; //id='complaints'


    echo "\n\n<div id='antenatal_postpartum' class='episodeblock'>";
        echo "\n<div class='block_title_con'>POSTPARTUM CARE</div>";
        echo "\n<table>";
        if(!empty($postpartum_list)){
            echo "\n<tr>";
                echo "\n<th>No.</th>";
                echo "\n<th width='110'>Visit Date</th>";
                echo "\n<th width='15'>Days after termination</th>";
                echo "\n<th width='50'>Breastfeeding</th>";
                echo "\n<th width='100'>Fever 38&deg; and above</th>";
                echo "\n<th >Vaginal discharge</th>";
                echo "\n<th >Vaginal bleeding</th>";
                echo "\n<th >Pallor</th>";
                echo "\n<th >Remarks</th>";
            echo "</tr>";
            $rownum = 1;
            foreach ($postpartum_list as $postpartum_item){
                echo "\n<tr>";
                echo "\n<td>".$rownum.".</td>";
                echo "\n<td>";
                echo ($postpartum_item['session_id']==$summary_id? "<strong>" : "");
                echo anchor('cons/cons/index/cons_antenatal/ehr_consult_antenatal/edit_antenatal_postpartum/edit_postpartum/'.$patient_id.'/'.$summary_id.'/'.$postpartum_item['antenatal_id'].'/'.$postpartum_item['antenatal_postpartum_id'], $postpartum_item['care_date']);
                echo ($postpartum_item['session_id']==$summary_id? "</strong>" : "");
                echo "</td>";
                echo "\n<td align='center'>".(round((strtotime($postpartum_item['care_date'])-strtotime($postpartum_item['termination_date']))/(60*60*24),1))."</td>";
                echo "\n<td>".$postpartum_item['breastfeed']."</td>";
                echo "\n<td align='center'>".$postpartum_item['fever_38']."</td>";
                echo "\n<td>";
                if($postpartum_item['vaginal_discharge']=="Heavy"){
                    echo "<span class='mandatory_field'><strong>Heavy. Refer to Physician</strong></span>";
                } else {
                    echo $postpartum_item['vaginal_bleeding'];
                }
                echo "</td>";
                echo "\n<td>";
                if($postpartum_item['vaginal_bleeding']=="Heavy"){
                    echo "<span class='mandatory_field'><strong>Heavy. Refer to Physician</strong></span>";
                } else {
                    echo $postpartum_item['vaginal_bleeding'];
                }
                echo "</td>";
                //echo "\n<td>".$postpartum_item['vaginal_bleeding']."</td>";
                echo "\n<td>";
                if($postpartum_item['pallor']=="Yes"){
                    echo "<span class='mandatory_field'><strong>Yes. Refer to Physician</strong></span>";
                } else {
                    echo $postpartum_item['pallor'];
                }
                echo "</td>";
                echo "\n<td>".$postpartum_item['postpartum_remarks']."</td>";
                echo "\n</tr>";
                $rownum++;
            }//endforeach;
        } else {
            echo "\n<tr><td>&nbsp; None recorded</td></tr>";
        } //endif(isset($postpartum_list))
        echo "</table>";
    echo "</div>"; //id='postpartum'


}

echo "\n\n<div id='complaints' class='episodeblock'>";
    echo "\n<div class='block_title_con'>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/edit_reason_encounter/new_complaints/'.$patient_id.'/'.$summary_id.'/new_complaints', 'COMPLAINTS');
    echo "</div>";
    echo "\n<table>";
    if(!empty($complaints_list)){
        echo "\n<tr>";
            echo "\n<th>No.</th>";
            echo "\n<th>Code</th>";
            echo "\n<th width='400'>Title</th>";
            echo "\n<th>Duration</th>";
            echo "\n<th>Notes</th>";
        echo "</tr>";
        $row_num    =   1;
        foreach ($complaints_list as $complaint_item){
            echo "\n<tr>";
            echo "<td valign='top'>".$row_num.".</td>";
            echo "<td valign='top'>".anchor('cons/cons/index/cons_progress/ehr_consult/edit_reason_encounter/edit_complaints/'.$patient_id.'/'.$summary_id.'/'.$complaint_item['complaint_id'], $complaint_item['icpc_code'])."</td>";
            echo "<td width='400' valign='top'>".$complaint_item['full_description']."</td>";
            echo "<td valign='top'>".$complaint_item['duration']."</td>";
            echo "<td valign='top'>".$complaint_item['complaint_notes']."</td>";
            echo "</tr>";
            $row_num++;
        }//endforeach;
        $empty_session =    FALSE;
    } else {
        echo "\n<tr><td>&nbsp; None recorded</td></tr>";
    }
    echo "</table>";
echo "</div>"; //id='complaints'

echo "\n\n<div id='vitals' class='episodeblock'>";
    echo "\n<div class='block_title_con'>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/edit_vitals/edit_vitals/'.$patient_id.'/'.$summary_id, 'VITAL SIGNS');
    echo "</div>";
    $previous_vitals_row    =   0;
    echo "\n<table>";
    if($vitals_info['vital_id'] <> "new_vitals"){
        //echo "\n<table>";
        echo "\n<tr>";
            echo "\n<td width='250'>Temperature</td>";
            echo "<td width='75'><strong>".$vitals_info['temperature']."</strong></td>";
            echo "<td width='75'><strong> &deg;C</strong></td>";
            echo "\n<td width='250'>Pulse Rate</td>";
            echo "<td width='75'><strong>".$vitals_info['pulse_rate']."</strong></td>";
            echo "<td width='75'><strong> beats/min</strong></td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>BP systolic</td>";
            echo "<td><strong>".$vitals_info['bp_systolic']."</strong></td>";
            echo "<td><strong> mm Hg</strong></td>";
            echo "\n<td>Height</td>";
            echo "<td><strong>".$vitals_info['height']."</strong></td>";
            echo "<td><strong> cm</strong></td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>BP diastolic</td>";
            echo "<td><strong>".$vitals_info['bp_diastolic']."</strong></td>";
            echo "<td><strong> mm Hg</strong></td>";
            echo "\n<td>Weight</td>";
            echo "<td><strong>".$vitals_info['weight']."</strong></td>";
            echo "<td><strong> kg</strong></td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td></td>";
            echo "<td></td>";
            echo "\n<td></td>";
            echo "<td></td>";
        echo "\n</tr>";
        //echo "\n</table>";
        $empty_session          =   FALSE;
        $previous_vitals_row    =   1;
    } else {
        echo "\n<tr><td>&nbsp; None recorded</td></tr>";
    }
    // Show historical records if any
    if(count($vitals_list) > $previous_vitals_row){
        echo "\n<tr>";
            echo "\n<td>Last reading : </td>";
            echo "<td width='105'><strong>".$vitals_list[$previous_vitals_row]['reading_date']."</strong></td>";
            echo "\n<td></td>";
            echo "\n<td>Blood Pressure : </td>";
            echo "<td>";
            if(!empty($vitals_list[$previous_vitals_row]['bp_systolic'])){
                echo "<strong>".$vitals_list[$previous_vitals_row]['bp_systolic'].' / '.$vitals_list[$previous_vitals_row]['bp_diastolic']." </strong></td><td><strong>mm Hg</strong>";
            } else {
                echo "None recorded";
            }
            echo "</td>";
        echo "\n</tr>";
    } //endif(count($vitals_list) > 0)
    echo "\n</table>";
echo "</div>"; //id='vitals'

echo "\n\n<div id='physical' class='episodeblock'>";
    echo "\n<div class='block_title_con'>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/edit_physical_exam/edit_physical/'.$patient_id.'/'.$summary_id, 'PHYSICAL EXAMINATION');
    echo "</div>";
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
        echo "<legend>Breasts</legend>";
        echo "\n<table>";
            if(!empty($physical_info['breasts_clear'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Breasts Exam</td>";
                echo "<td>".$physical_info['breasts_clear']."</td>";
                echo "\n</tr>";
            }
            if(!empty($physical_info['breasts_spec'])){
                echo "\n<tr>";
                echo "\n<td width='250'>Abnormal </td>";
                echo "<td>".$physical_info['breasts_spec']."</td>";
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
        $empty_session =    FALSE;
    } else {
        echo "\n<tr><td>&nbsp; None recorded</td></tr>";
    }
echo "</div>"; //id='physical'

echo "\n\n<div id='lab' class='episodeblock'>";
    echo "<div class='block_title_con'>";
	echo anchor('cons/cons/index/cons_orders/ehr_consult_orders/edit_lab/new_lab/'.$patient_id.'/'.$summary_id.'/new_lab', 'LAB ORDERS');
    echo "</div>";
    echo "\n<table>";
    if(!empty($lab_list)){
        echo "\n<tr>";
            echo "\n<th>No.</th>";
            echo "\n<th>Code</th>";
            echo "\n<th width='200'>Title</th>";
            echo "\n<th>Sample Ref.</th>";
            echo "\n<th>Supplier</th>";
            echo "\n<th>Remarks</th>";
            echo "\n<th>Results</th>";
        echo "</tr>";
        $row_num    =   1;
        foreach ($lab_list as $order_item){
            echo "\n<tr>";
            echo "<td valign='top'>".$row_num.".</td>";
            echo "<td valign='top'>".anchor('cons/cons/index/cons_orders/ehr_consult_orders/edit_lab/edit_lab/'.$patient_id.'/'.$summary_id.'/'.$order_item['lab_order_id'], $order_item['package_code'])."</td>";
            echo "<td valign='top'>".$order_item['package_name']."</td>";
            echo "<td valign='top'>".$order_item['sample_ref']."</td>";
            echo "<td valign='top'>".$order_item['supplier_name']."</td>";
            echo "<td valign='top'>".$order_item['remarks']."</td>";
            echo "<td valign='top'>".$order_item['summary_result']."</td>";
            echo "</tr>";
            $row_num++;
        }//endforeach;
        $empty_session =    FALSE;
    } else {
        echo "\n<tr><td>&nbsp; None recorded</td></tr>";
    }
    echo "</table>";
echo "</div>"; //id='lab'

echo "\n\n<div id='imaging' class='episodeblock'>";
    echo "<div class='block_title_con'>";
	echo anchor('cons/cons/index/cons_orders/ehr_consult_orders/edit_imaging/new_imaging/'.$patient_id.'/'.$summary_id.'/new_imaging', 'IMAGING ORDERS');
    echo "</div>";
    echo "\n<table>";
    if(!empty($imaging_list)){
        echo "\n<tr>";
            echo "\n<th>No.</th>";
            echo "\n<th>Code</th>";
            echo "\n<th width='200'>Description</th>";
            echo "\n<th>Ref No.</th>";
            echo "\n<th>Supplier</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        $row_num    =   1;
        foreach ($imaging_list as $imaging_item){
            echo "\n<tr>";
            echo "<td valign='top'>".$row_num.".</td>";
            echo "<td valign='top'>".anchor('cons/cons/index/cons_orders/ehr_consult_orders/edit_imaging/edit_imaging/'.$patient_id.'/'.$summary_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
            echo "<td valign='top'>".$imaging_item['description']."</td>";
            echo "<td valign='top'>".$imaging_item['supplier_ref']."</td>";
            echo "<td valign='top'>".$imaging_item['supplier_name']."</td>";
            echo "<td valign='top'>".$imaging_item['remarks']."</td>";
            echo "</tr>";
            $row_num++;
        }//endforeach;
        $empty_session =    FALSE;
    } else {
        echo "\n<tr><td>&nbsp; None recorded</td></tr>";
    }
    echo "</table>";
echo "</div>"; //id='imaging'

if(!empty($prediagnosis_list)){ // Show block only if exist
echo "\n\n<div id='prediagnosis' class='episodeblock'>";
    echo "\n<div class='block_title_con'>";
	echo anchor('cons/cons/index/cons_diagnosis/ehr_consult_diagnosis/edit_diagnosis/new_diagnosis/'.$patient_id.'/'.$summary_id.'/new_diagnosis', 'PRE-DIAGNOSTIC OBSERVATIONS');
    echo "</div>";
    echo "\n<table>";
    if(!empty($prediagnosis_list)){
        echo "\n<tr>";
            echo "\n<th>Code</th>";
            echo "\n<th width='400'>Title</th>";
            echo "\n<th>Type</th>";
            echo "\n<th>Notes</th>";
        echo "</tr>";
        foreach ($prediagnosis_list as $prediagnosis_item){
            echo "\n<tr>";
            echo "<td valign='top'>".anchor('cons/cons/index/cons_diagnosis/ehr_consult_diagnosis/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$summary_id.'/'.$prediagnosis_item['diagnosis_id'], $prediagnosis_item['dcode1ext_code'])."</td>";
            echo "<td valign='top'>".$prediagnosis_item['full_title']."</td>";
            echo "<td valign='top'><strong>".$prediagnosis_item['diagnosis_type']."</strong></td>";
            echo "<td valign='top'>".$prediagnosis_item['diagnosis_notes']."</td>";
            echo "</tr>";
        }//endforeach;
        $empty_session =    FALSE;
    //} else {
        //echo "\n&nbsp; None recorded";
    }
    echo "</table>";
echo "</div>"; //id='prediagnosis'
}

echo "\n\n<div id='diagnosis' class='episodeblock'>";
    echo "\n<div class='block_title_con'>";
        echo "\n\n<table width='100%'><tr><td width='58%' class='block_title_con_td'>";
	echo anchor('cons/cons/index/cons_diagnosis/ehr_consult_diagnosis/edit_diagnosis/new_diagnosis/'.$patient_id.'/'.$summary_id.'/new_diagnosis', 'DIAGNOSIS');
        echo "</td><td align='left' width='40%' class='block_title_con_td'>";
        //echo "\n\n<span id='patients_new_diagnosis' style='float:right;'>";
            $attributes =   array('class' => 'form', 'id' => 'diagnosis_search');
            echo form_open('cons/cons/index/cons_diagnosis/ehr_consult_diagnosis/edit_diagnoses/new_diagnosis/'.$patient_id.'/'.$summary_id.'/new_diagnosis', $attributes);
            echo form_hidden('form_purpose', 'new_diagnosis');
            echo form_hidden('form_id', "search");
            echo form_hidden('now_id', $now_id);
            echo form_hidden('patient_id', $patient_id);
            echo form_hidden('summary_id', $summary_id);
            echo form_hidden('diagnosis_id', 'new_diagnosis');
            echo form_hidden('diagnosis_type', '');
            echo form_hidden('diagnosis_notes', '');
            echo form_hidden('diagnosis', '');
            echo "\n<input type='text' name='diagnosis_term1' id='diagnosis_term1' value='' size='20' />";
            echo "\n<input type='submit' value='Search ICD-10' />";
            echo "\n</form>";
        echo "\n</td><td width='2%'>&nbsp;";
        echo "</td></tr></table>";
    echo "</div>";
    echo "\n<table>";
    if(!empty($diagnosis_list)){
        echo "\n<tr>";
            echo "\n<th>No.</th>";
            echo "\n<th>Code</th>";
            echo "\n<th width='400'>Title</th>";
            echo "\n<th>Type</th>";
            echo "\n<th>Notes</th>";
        echo "</tr>";
        $row_num    =   1;
        foreach ($diagnosis_list as $diagnosis_item){
            echo "\n<tr>";
            echo "<td valign='top'>".$row_num.".</td>";
            echo "<td valign='top'>".anchor('cons/cons/index/cons_diagnosis/ehr_consult_diagnosis/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$summary_id.'/'.$diagnosis_item['diagnosis_id'], $diagnosis_item['dcode1ext_code'])."</td>";
            echo "<td valign='top'>".$diagnosis_item['full_title']."</td>";
            echo "<td valign='top'><strong>".$diagnosis_item['diagnosis_type']."</strong></td>";
            echo "<td valign='top'>".$diagnosis_item['diagnosis_notes']."</td>";
            echo "</tr>";
            $row_num++;
        }//endforeach;
        $empty_session =    FALSE;
    } else {
        echo "\n<tr><td>&nbsp; None recorded</td></tr>";
    }
    echo "</table>";
echo "</div>"; //id='diagnosis'

/* TO DELETE ONCE PRESENTATION OF PREVIOUS BLOCK IS STABLE
echo "\n\n<div id='diagnosis' class='episodeblock'>";
    echo "\n<div class='block_title_con'>";
        //echo "\n\n<span id='new_diagnosis'>";
	echo anchor('cons/cons/index/cons_diagnosis/ehr_consult_diagnosis/edit_diagnosis/new_diagnosis/'.$patient_id.'/'.$summary_id.'/new_diagnosis', 'DIAGNOSIS');
        //echo "</span>";
        echo "\n\n<span id='patients_new_diagnosis' style='float:right;'>";
            $attributes =   array('class' => 'form', 'id' => 'diagnosis_search');
            echo form_open('cons/cons/index/cons_diagnosis/ehr_consult_diagnosis/edit_diagnoses/new_diagnosis/'.$patient_id.'/'.$summary_id.'/new_diagnosis', $attributes);
            echo form_hidden('form_purpose', 'new_diagnosis');
            echo form_hidden('form_id', "search");
            echo form_hidden('now_id', $now_id);
            echo form_hidden('patient_id', $patient_id);
            echo form_hidden('summary_id', $summary_id);
            echo form_hidden('diagnosis_id', 'new_diagnosis');
            echo form_hidden('diagnosis_type', '');
            echo form_hidden('diagnosis_notes', '');
            echo form_hidden('diagnosis', '');
            echo "\n<input type='text' name='diagnosis_term1' id='diagnosis_term1' value='' size='30' />";
            echo "\n<input type='submit' value='Search' />";
            echo "\n</form>";
        echo "</span>";
    echo "</div>";
    echo "\n<table style='clear:both;'>";
    if(!empty($diagnosis_list)){
        echo "\n<tr>";
            echo "\n<th>Code</th>";
            echo "\n<th width='400'>Title</th>";
            echo "\n<th>Type</th>";
            echo "\n<th>Notes</th>";
        echo "</tr>";
        foreach ($diagnosis_list as $diagnosis_item){
            echo "\n<tr>";
            echo "<td valign='top'>".anchor('cons/cons/index/cons_diagnosis/ehr_consult_diagnosis/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$summary_id.'/'.$diagnosis_item['diagnosis_id'], $diagnosis_item['dcode1ext_code'])."</td>";
            echo "<td valign='top'>".$diagnosis_item['full_title']."</td>";
            echo "<td valign='top'><strong>".$diagnosis_item['diagnosis_type']."</strong></td>";
            echo "<td valign='top'>".$diagnosis_item['diagnosis_notes']."</td>";
            echo "</tr>";
        }//endforeach;
        $empty_session =    FALSE;
    } else {
        echo "\n&nbsp; None recorded";
    }
    echo "</table>";
echo "</div>"; //id='diagnosis'
*/


echo "\n\n<div id='imaging' class='episodeblock'>";
    echo "<div class='block_title_con'>";
	echo anchor('cons/cons/index/cons_orders/ehr_consult_orders_procedure/edit_procedure/new_procedure/'.$patient_id.'/'.$summary_id.'/new_procedure', 'PROCEDURE ORDERS');
    echo "</div>";
    echo "\n<table>";
    $row_num = 1;
    if(!empty($procedure_list)){
        echo "\n<tr>";
            echo "\n<th>No.</th>";
            echo "\n<th width='200'>Procedure</th>";
            echo "\n<th>Code</th>";
            echo "\n<th width='200'>Product</th>";
            echo "\n<th>Description</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        foreach ($procedure_list as $procedure_item){
            echo "\n<tr>";
            echo "<td valign='top'>".$row_num.".</td>";
            echo "<td valign='top'>".anchor('cons/cons/index/cons_orders/ehr_consult_orders_procedure/edit_procedure/edit_procedure/'.$patient_id.'/'.$summary_id.'/'.$procedure_item['order_id'], $procedure_item['pcode1ext_longname'])."</td>";
            echo "<td valign='top'>".$procedure_item['product_code']."</td>";
            echo "<td valign='top'>".$procedure_item['product_name']."</td>";
            echo "<td valign='top'>".$procedure_item['prod_description']."</td>";
            echo "<td valign='top'>".$procedure_item['notes']."</td>";
            echo "</tr>";
            $row_num++;
        }//endforeach;
        $empty_session =    FALSE;
    } else {
        echo "\n<tr><td>&nbsp; None recorded</td></tr>";
    }
    echo "</table>";
echo "</div>"; //id='imaging'

echo "\n\n<div id='prescriptions' class='episodeblock'>";
    echo "<div class='block_title_con'>";
    echo "\n<table width='100%'><tr><td width='58%' class='block_title_con_td'>";
	echo anchor('cons/cons/index/cons_prescribe/ehr_consult_prescribe/edit_prescription/new_prescribe/'.$patient_id.'/'.$summary_id, 'PRESCRIPTIONS');
    echo "\n</td><td align='left' width='40%' class='block_title_con_td'>";
        $attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
        echo form_open('cons/cons/index/cons_prescribe/ehr_consult_prescribe/edit_prescribe/new_prescribe/'.$patient_id.'/'.$summary_id.'/new_prescribe', $attributes);
        echo form_hidden('form_purpose', $form_purpose);
        echo form_hidden('form_id', "search");
        echo form_hidden('now_id', $now_id);
        echo form_hidden('patient_id', $patient_id);
        echo form_hidden('summary_id', $summary_id);
        echo form_hidden('prescribe_id', 'new_prescribe');
        echo form_hidden('drug_formulary_id', '');
        echo form_hidden('formulary_term2', '');
        echo form_hidden('dose', '');
        echo form_hidden('dose_form', '');
        echo form_hidden('frequency', '');
        echo form_hidden('indication', '');
        echo form_hidden('instruction', '');
        echo form_hidden('dose_duration', '');
        echo form_hidden('quantity', '');
        echo form_hidden('caution', '');
        echo "<input type='text' name='formulary_term1' value='' size='20' />";//</td></tr>";
        echo "\n<input type='submit' name='part_form' value='Search Generic Name' /></form>";
    echo "\n</td><td width='2%'>&nbsp;";
    echo "</td></tr></table>";
    echo "</div>";
    echo "\n<table>";
    if(!empty($prescribe_list)){
        echo "\n<tr>";
            echo "\n<th>No.</th>";
            echo "\n<th>Generic Name</th>";
            echo "\n<th></th>";
            echo "\n<th>Dose</th>";
            echo "\n<th></th>";
            echo "\n<th>Frequency</th>";
            echo "\n<th>Instruction</th>";
            echo "\n<th>Duration</th>";
            echo "\n<th>Quantity</th>";
        echo "</tr>";
        $row_num    =   1;
        foreach ($prescribe_list as $prescribe_item){
            echo "\n<tr>";
            echo "<td valign='top' rowspan='5'>".$row_num.".</td>";
            echo "<td colspan='8'>".anchor('cons/cons/index/cons_prescribe/ehr_consult_prescribe/edit_prescription/edit_prescribe/'.$patient_id.'/'.$summary_id.'/'.$prescribe_item['queue_id'], $prescribe_item['generic_name'])."</td>";
            echo "\n</tr><tr>";
            echo "<td colspan='8'>".$prescribe_item['trade_name']."</td>";
            echo "\n</tr><tr>";
            echo "<td>Indication</td>";
            echo "<td>:</td>";
            echo "<td valign='top' colspan='6'>";
            if(!empty($prescribe_item['indication'])){
                echo "<strong>".$prescribe_item['indication']."</strong>";
            } else {
                echo "None recorded";
            }
            echo "</td>";
            echo "\n</tr><tr>";
            echo "<td>Caution</td>";
            echo "<td>:</td>";
            echo "<td valign='top' colspan='6'>";
            if(!empty($prescribe_item['caution'])){
                echo "<strong>".$prescribe_item['caution']."</strong>";
            } else {
                echo "None recorded";
            }
            echo "</td>";
            echo "\n</tr><tr>";
            echo "<td></td><td></td>";
            echo "<td valign='top'>".$prescribe_item['dose']."</td>";
            echo "<td valign='top'>".$prescribe_item['dose_form']."</td>";
            echo "<td valign='top'>".$prescribe_item['frequency']."</td>";
            echo "<td valign='top'>".$prescribe_item['instruction']."</td>";
            echo "<td valign='top'> for ".$prescribe_item['dose_duration']." days</td>";
            echo "<td valign='top'>".$prescribe_item['quantity']." ".$prescribe_item['quantity_form']."</td>";
            echo "</tr>";
            $row_num++;
        }//endforeach;
        $empty_session =    FALSE;
    } else {
        echo "\n<tr><td>&nbsp; None recorded</td></tr>";
    } //endif(!empty($prescribe_list))
    echo "</table>";
echo "</div>"; //id='prescriptions'

echo "\n\n<div id='dispense' class='episodeblock'>";
    echo "<div class='block_title_con'>";
	echo anchor('cons/cons/index/cons_prescribe/ehr_consult_prescribe/edit_prescription/new_prescribe/'.$patient_id.'/'.$summary_id, 'DISPENSE');
    echo "</div>";
    echo "\n<table>";
    if(!empty($dispense_list)){
        echo "\n<tr>";
            echo "\n<th>No.</th>";
            echo "\n<th>Generic Name</th>";
            echo "\n<th></th>";
            echo "\n<th>Dose</th>";
            echo "\n<th></th>";
            echo "\n<th>Frequency</th>";
            echo "\n<th>Instruction</th>";
            echo "\n<th>Duration</th>";
            echo "\n<th>Quantity</th>";
        echo "</tr>";
        $row_num    =   1;
        foreach ($dispense_list as $dispense_item){
            echo "\n<tr>";
            echo "<td valign='top' rowspan='5'>".$row_num.".</td>";
            echo "<td colspan='8'>".anchor('cons/cons/index/cons_prescribe/ehr_consult_prescribe/edit_prescription/edit_dispense/'.$patient_id.'/'.$summary_id.'/'.$dispense_item['queue_id'], $dispense_item['generic_name'])."</td>";
            echo "\n</tr><tr>";
            echo "<td colspan='8'>".$dispense_item['trade_name']."</td>";
            echo "\n</tr><tr>";
            echo "<td>Indication</td>";
            echo "<td>:</td>";
            echo "<td valign='top' colspan='6'>";
            if(!empty($dispense_item['indication'])){
                echo "<strong>".$dispense_item['indication']."</strong>";
            } else {
                echo "None recorded";
            }
            echo "</td>";
            echo "\n</tr><tr>";
            echo "<td>Caution</td>";
            echo "<td>:</td>";
            echo "<td valign='top' colspan='6'>";
            if(!empty($dispense_item['caution'])){
                echo "<strong>".$dispense_item['caution']."</strong>";
            } else {
                echo "None recorded";
            }
            echo "</td>";
            echo "\n</tr><tr>";
            echo "<td></td><td></td>";
            echo "<td valign='top'>".$dispense_item['dose']."</td>";
            echo "<td valign='top'>".$dispense_item['dose_form']."</td>";
            echo "<td valign='top'>".$dispense_item['frequency']."</td>";
            echo "<td valign='top'>".$dispense_item['instruction']."</td>";
            echo "<td valign='top'> for ".$dispense_item['dose_duration']." days</td>";
            echo "<td valign='top'>".$dispense_item['quantity']." ".$dispense_item['quantity_form']."</td>";
            echo "</tr>";
            $row_num++;
        }//endforeach;
        $empty_session =    FALSE;
    } else {
        echo "\n<tr><td>&nbsp; None recorded</td></tr>";
    } //endif(!empty($prescribe_list))
    echo "</table>";
echo "</div>"; //id='prescriptions'

//echo "\n<fieldset>";
//echo "<legend>SUBMODULES LIST</legend>";
echo "\n\n<div id='referral' class='episodeblock'>";
    echo "<div class='block_title_con'>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/con_externalmod/externalmod/'.$patient_id.'/'.$summary_id, 'MODULES');
    echo "</div>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='100'>Code</th>";
    echo "\n<th width='50'>Form</th>";
    echo "\n<th width='350'>Submodule Name</th>";
    echo "\n<th width='450'>Description</th>";
echo "</tr>";
if(isset($submodules_list)){
    $rownum = 1;
    foreach ($submodules_list as $submodule_item){
        if(!empty($submodule_item['gem_session_id'])){
            echo "\n<tr>";
            echo "\n<td valign='top'>".$rownum.".</td>";
            echo "\n<td valign='top'>".$submodule_item['gem_submod_code']."</td>";
            echo "\n<td valign='top'>";
            if(isset($submodule_item['gem_session_id'])){
                echo anchor('cons/cons/index/cons_gem/ehr_consult_gem/gem_edit_consult/edit_consult/'.$patient_id.'/'.$summary_id.'/'.$submodule_item['gem_submod_id'].'/'.$submodule_item['gem_agegroup_id'], '<strong>Edit</strong>');
                //echo anchor('ehr_consult_gem/gem_edit_consult/edit_consult/'.$submodule_item['gem_submod_id'].'/'.$submodule_item['gem_agegroup_id'].'/'.$patient_id.'/'.$summary_id, $submodule_item['gem_submod_name']);
            } else {
                echo anchor('cons/cons/index/cons_gem/ehr_consult_gem/gem_select_agegroup/'.$patient_id.'/'.$summary_id.'/'.$module_info[0]['gem_module_id'].'/'.$submodule_item['gem_submod_id'], 'New');
                //echo anchor('ehr_consult_gem/gem_select_agegroup/'.$module_info[0]['gem_module_id'].'/'.$submodule_item['gem_submod_id'].'/'.$patient_id.'/'.$summary_id, $submodule_item['gem_submod_name']);
            }
            echo "</td>";
            echo "\n<td valign='top'>";
            echo $submodule_item['gem_submod_name'];
            echo "</td>";
            echo "\n<td valign='top'>".$submodule_item['gem_submod_descr']."</td>";
            echo "\n</tr>";
            $rownum++;
        }
    }//endforeach;
//}
//echo "</table>";
//echo "\n<br />";
//echo "\n</fieldset>";
    } else {
        echo "\n<tr><td> None recorded</td></tr>";
    } //endif(!empty($prescribe_list))
    echo "</table>";
echo "</div>"; //id='prescriptions'

echo "\n\n<div id='referral' class='episodeblock'>";
    echo "<div class='block_title_con'>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/edit_referral/new_referral/'.$patient_id.'/'.$summary_id, 'REFERRAL');
    echo "</div>";
    echo "\n<table class='valigntop'>";
    if(!empty($referrals_list)){
        echo "\n<tr>";
            echo "\n<th>No.</th>";
            echo "\n<th width='200'>Referral Person</th>";
            echo "\n<th width='100'>Specialty</th>";
            echo "\n<th width='200'>Referral Centre</th>";
            echo "\n<th>Referral Date</th>";
            echo "\n<th>Referral Reason</th>";
        echo "\n<th>Referral Letter</th>";
        echo "</tr>";
        $row_num    =   1;
        foreach ($referrals_list as $referral_item){
            echo "\n<tr>";
            echo "<td valign='top'>".$row_num.".</td>";
            echo "<td valign='top'>".anchor('cons/cons/index/cons_progress/ehr_consult/edit_referral/edit_referral/'.$patient_id.'/'.$summary_id.'/'.$referral_item['referral_id'], $referral_item['doctor_name'])."</td>";
            echo "<td valign='top'>".$referral_item['specialty']."</td>";
            echo "<td valign='top'>".$referral_item['name']."</td>";
            echo "<td valign='top'>".$referral_item['referral_date']."</td>";
            echo "<td valign='top'>".$referral_item['reason']."</td>";
            echo "<td valign='top'>[Disabled]</td>";
            //echo "<td>".anchor('cons/cons/index/cons_progress/ehr_consult/print_referral_letter/print_referral_letter/'.$patient_id.'/'.$summary_id.'/'.$referral_item['referral_id'], 'Print', 'target="_blank"')."</td>";
            echo "</tr>";
            $row_num++;
        }//endforeach;
        $empty_session =    FALSE;
    } else {
        echo "\n<tr><td> None recorded</td></tr>";
    } //endif(!empty($prescribe_list))
    echo "</table>";
echo "</div>"; //id='referral'

echo "\n<p>";
//<form name="form" action="Main.php?do=EndConsultationAction" method="post" onSubmit="if (confirm('Are you sure you want to end the consultation?')) return true; else return false;">
$attributes = array("id" => "myform", "onSubmit" => "if (confirm('Are you sure you want to end the consultation?')) return true; else return false;");
echo form_open('cons/cons/index/cons_progress/ehr_consult/consult_episode/edit_episode/'.$patient_id.'/'.$summary_id, $attributes);
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
        echo "\n<input type='text' name='date_started' value='".set_value('date_started',$patcon_info['date_started'])."' size='10' id='start_datepicker' /> yyyy-mm-dd";//</td></tr>";
        if($patcon_info['date_started'] <> $date_ended){
            echo " <font color='red'>DATE STARTED DIFFERS FROM END DATE</font>";
        }
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Time started';
	echo '</td>';
	echo '<td>';
        echo form_error('time_started');
        echo "\n<input type='text' name='time_started' value='".set_value('time_started',$patcon_info['time_started'])."' size='8' id='time_started' /> hh:mm</td></tr>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Date ended';
	echo '</td>';
	echo '<td>';
        echo form_error('date_ended');
        echo "\n<input type='text' name='date_ended' value='".set_value('date_ended',$date_ended)."' size='10' id='end_datepicker'  /> yyyy-mm-dd</td></tr>";
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
        echo "\n<br /><textarea class='normal' name='consult_notes' id='consult_notes' cols='50' rows='8'>".set_value('consult_notes',$consult_notes)."</textarea>";
        //echo "\n<br /><textarea class='normal' name='consult_notes' id='consult_notes' value='".set_value('consult_notes',$consult_notes)."' cols='50' rows='8'></textarea>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'External Reference';
	echo '</td>';
	echo '<td>';
        echo form_error('external_ref');
        echo "\n<input type='text' name='external_ref' value='".set_value('external_ref',$patcon_info['external_ref'])."' size='10' id='external_ref' /></td></tr>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo "\nSubjective";
	echo '</td>';
	echo '<td>';
        echo "\n<textarea class='normal' name='note_subjective' id='note_subjective' cols='50' rows='4'>".set_value('note_subjective',$note_subjective)."</textarea>";
	echo '</td>';
echo '</tr>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo "\nObjective";
	echo '</td>';
	echo '<td>';
        echo "\n<textarea class='normal' name='note_objective' id='note_objective' cols='50' rows='4'>".set_value('note_objective',$note_objective)."</textarea>";
	echo '</td>';
echo '</tr>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo "\nAssessment";
	echo '</td>';
	echo '<td>';
        echo "\n<textarea class='normal' name='note_assessment' id='note_assessment' cols='50' rows='4'>".set_value('note_assessment',$note_assessment)."</textarea>";
	echo '</td>';
echo '</tr>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
        echo "\nPlan";
	echo '</td>';
	echo '<td>';
        echo "\n<textarea class='normal' name='note_plan' id='note_plan' cols='50' rows='4'>".set_value('note_plan',$note_plan)."</textarea>";
	echo '</td>';
echo '</tr>';

if($debug_mode) {
    echo "\n<tr>";
	    echo '<td>';
        echo "<div class='debug'>dry_run</div>";
	    echo '</td>';
	    echo '<td>';
        echo "<select name='dry_run' class='normal'>";
        echo "\n<option value='FALSE' >FALSE</option>";
        echo "\n<option value='TRUE' selected='selected' >TRUE</option>";
        echo "</select>";
	    echo ' TRUE == Don\'t post</td>';
    echo '</tr>';
} else {
    echo form_hidden('dry_run', 'FALSE');
}

echo '</table>';

//echo "<input type='checkbox' name='confirm_close' /> Confirm close clinical consultation episode.";

echo "\n</p>";
echo "<p><div align='center'><input type='submit' value='End Consultation' /></div> </p>";
echo "</form>";
// If spouse is inside database, then allow user to edit directly from this page.
//if($init_contact_person <> ""){
    echo "\n<fieldset>";
    echo "<legend>Update status</legend>";
    echo "\n<div id='ajax_spouse_info'>";
    echo "</div>"; //id='ajax_spouse_info'
    echo "<div id='submit_spouse_info'>";
    echo "<input type='submit' value='Save Consultation Summary' />";
    echo "</div>"; //id='submit_spouse_info'
    echo "\n</fieldset>";
//} else {
//    echo "\n<div id='ajax_spouse_info'>";
//    echo "</div>"; //id='ajax_spouse_info'
//    echo "<div id='submit_spouse_info'>";
    //echo "<input type='submit' value='Update' />";
//    echo "</div>"; //id='submit_spouse_info'
//}


echo "\n<br /><h6>Please ensure that all information are correct. You will not be able to return to this page after clicking the [End Consultation] button.</h6>";

if($empty_session){
    $delete_link    =   base_url()."index.php/cons/cons/index/cons_progress/ehr_consult/consult_delete_session/hide_links/".$patient_id."/new_summary";
    echo "\n<td><a href=\"javascript:deleteRecord('cancel','Session','".$delete_link ."');\">Delete Session</a>";
}

echo "</div>"; //id='content'

echo "</div>"; //id=body

$siteurl_session_info    =   site_url()."/ehr_ajax/update_consultation_details/";
?>
<script  type="text/javascript">
    /*
    var $ = function (id) {
        return document.getElementById(id);
    }
    */

    $(document).ready(function() {
        $('#lmp').delegate('select','change',function (){
            calculateEDD()}
            );
        $('#submit_spouse_info').delegate('input','click',function (){
            ajax_submit_spouse_info('Updated')}
            );
        //ajax_submit_spouse_info('Init');
        return false;
      })


    function ajax_submit_spouse_info(ajax_outcome) {
        var siteurl = "<?php echo $siteurl_session_info; ?>";
        var ajax_outcome = 'Updated';
        var summary_id = "<?php echo $summary_id; ?>";
        var ajax_date_started = $('#start_datepicker').val();
        var ajax_time_started = $('#time_started').val();
        var ajax_external_ref = $('#external_ref').val();
        var ajax_consult_notes = $('#consult_notes').val();
        var ajax_note_subjective = $('#note_subjective').val();
        var ajax_note_objective = $('#note_objective').val();
        var ajax_note_assessment = $('#note_assessment').val();
        var ajax_note_plan = $('#note_plan').val();
        var data = 'ajax_outcome='+ajax_outcome+'&summary_id='+summary_id+'&ajax_date_started='+ajax_date_started+'&ajax_time_started='+ajax_time_started+'&ajax_external_ref='+ajax_external_ref+'&ajax_consult_notes='+ajax_consult_notes+'&ajax_note_subjective='+ajax_note_subjective+'&ajax_note_objective='+ajax_note_objective+'&ajax_note_assessment='+ajax_note_assessment+'&ajax_note_plan='+ajax_note_plan;
        //alert(siteurl+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            var multi_part  =   result.split("|=|");
            $('#ajax_spouse_info').html(multi_part[0]);
          }
        }
    )}


    $(function() {
        $( "#start_datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });


    $(function() {
        $( "#end_datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });


    function deleteRecord($action, $name, $link){            
        if(confirm("Are you sure you want to " + $action + " this " + $name + " ?")){
            window.open($link, "_top");
        }
    }
  </script>


