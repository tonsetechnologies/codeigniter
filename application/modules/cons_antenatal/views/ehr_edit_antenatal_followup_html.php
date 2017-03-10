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

//include_once("header_xhtml1-strict.php");
//include_once("header_xhtml1-transitional.php");

echo "\n\n<div id='content'>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />antenatal_id = " . $antenatal_id;
    print "\n<br />antenatal_followup_id = " . $antenatal_followup_id;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(vitals_info)=<br />";
		print_r($vitals_info);
    echo "\n<br />print_r(antenatal_info)=<br />";
		print_r($antenatal_info);
    echo "\n<br />print_r(antenatal_followup)=<br />";
		print_r($antenatal_followup);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_antenatal_followup_html_title')."</h1></div>";

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<h2>".$save_attempt."</h2>";

echo "\n<fieldset>";
echo "<legend>FOLLOW-UPS</legend>";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Reading Date</th>";
    echo "\n<th width='15'>Pregnancy Duration (weeks)</th>";
    echo "\n<th width='15'>Lie & Presentation</th>";
    echo "\n<th width='50'>Weight (kg)</th>";
    echo "\n<th width='50'>Fundal Height (cm)</th>";
    echo "\n<th width='150'>Hb</th>";
    echo "\n<th width='150'>Urine Albumin</th>";
    echo "\n<th width='150'>Urine Sugar</th>";
    echo "\n<th width='150'>Ankle Odema</th>";
    echo "\n<th width='150'>Notes</th>";
    echo "\n<th width='150'>Next Check-up</th>";
echo "</tr>";
$current_checkup_exists =   FALSE;
if(isset($followup_list)){
    $rownum = 1;
    foreach ($followup_list as $followup_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        if($antenatal_followup_id == $followup_item['antenatal_followup_id']){
            echo "\n<td><strong>".$followup_item['date']."</strong></td>";
        } else {
            echo "\n<td>".anchor('cons/cons/index/cons_antenatal/ehr_consult_antenatal/edit_antenatal_followup/edit_followup/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/'.$followup_item['antenatal_followup_id'], "<strong>".$followup_item['date']."</strong>")."</td>";
        } //endif($antenatal_id == $followup_item['antenatal_id'])
        echo "\n<td align='center'>".$followup_item['pregnancy_duration']."</td>";
        echo "\n<td align='center'>".$followup_item['lie']."</td>";
        echo "\n<td>".$followup_item['weight']."</td>";
        echo "\n<td>".$followup_item['fundal_height']."</td>";
        echo "\n<td>".$followup_item['hb']."</td>";
        echo "\n<td>".$followup_item['urine_alb']."</td>";
        echo "\n<td>".$followup_item['urine_sugar']."</td>";
        echo "\n<td>".$followup_item['ankle_odema']."</td>";
        echo "\n<td>".$followup_item['notes']."</td>";
        echo "\n<td>".$followup_item['next_followup']."</td>";
        echo "\n</tr>";
        if($followup_item['session_id'] == $summary_id){
            $current_checkup_exists =   TRUE;
        }
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
if($current_checkup_exists == FALSE){
    echo anchor('cons/cons/index/cons_antenatal/ehr_consult_antenatal/edit_antenatal_followup/new_followup/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/new_followup', "<strong>Add New Check-up</strong>");
}
echo "\n<br /><br />";

echo "\n</fieldset>";


// Graph of Pregnancy
$parts_week     =   4;
$max_weeks      =   45;
$parts_month    =   17;
$max_months     =   10;
$acc_duration   =   $init_recalc_duration * $parts_week;
echo "\n<table border='1'  class='figure'>";
echo "\n<tr>";
    echo "<td>&nbsp;</td>";
    echo "\n<td align='center' colspan='52' bgcolor='cyan'>1st Trimester</td>";
    echo "\n<td align='center' colspan='52' bgcolor='yellow'>2nd Trimester</td>";
    echo "\n<td align='center' colspan='52' bgcolor='orange'>3rd Trimester</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td>Week</td>";
    for($i=1; $i<=$max_weeks; $i++){
        echo "\n<td align='center' colspan='$parts_week'>".$i."</td>";
    }
echo "</tr>";

echo "\n<tr>";
    echo "<td>&nbsp;</td>";
    for($j=1; $j<=($max_weeks*$parts_week); $j++){
        if($j <= $acc_duration){
            echo "<td bgcolor='green'>&nbsp;</td>";
        } else {
            echo "<td>&nbsp;</td>";
        }
    }
echo "</tr>";

echo "\n<tr>";
    echo "\n<td>Month</td>";
    for($k=1; $k<=$max_months; $k++){
        echo "\n<td align='center' colspan='$parts_month'>".$k."</td>";
    }
    echo "<td colspan='".(($max_weeks*$parts_week)-($max_months*$parts_month))."'>&nbsp;</td>";
echo "</tr>";

echo "\n</table>";
echo "<br />";


$attributes =   array('class' => 'select_form', 'id' => 'followup_form');
echo form_open('cons/cons/index/cons_antenatal/ehr_consult_antenatal/edit_antenatal_followup/'.$form_purpose.'/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/'.$antenatal_followup_id, $attributes);
echo "\n<table>";
echo "\n<tr><td>Record Date</td><td>";
echo form_error('record_date');
echo "\n<input type='text' name='record_date' id='record_date' value='".set_value('record_date',$init_record_date)."' size='10'  onChange='calculateVP();' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Pregnancy Duration <font color='red'>*</font></td><td>";
echo form_error('pregnancy_duration');
echo "\n<input type='text' name='pregnancy_duration' value='".set_value('pregnancy_duration',$init_pregnancy_duration)."' size='4' /> weeks";
echo "\n --> Recalculated as <input class='disabled' name='visit_period' value='".$init_recalc_duration."' type='text' size='4' id='visit_period' readonly='readonly' onFocus='blur();'> weeks";
echo "\n(<input class='disabled' name='duration_months' value='".$init_recalc_months."' type='text' size='3' id='duration_months' readonly='readonly' onFocus='blur();'> months) ";
echo "\n<input class='disabled' name='error_period' value='' type='text' size='20' id='error_period' readonly='readonly' onFocus='blur();'> ";
echo "</td></tr>";

if($vitals_info['vital_id'] == "new_vitals"){
    echo "\n<tr><td></td><td>No vital signs recorded yet. Click ";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/edit_vitals/edit_vitals/'.$patient_id.'/'.$summary_id, 'Vital Signs');
    echo " to add.</td></tr>";
} //endif($vitals_info['vital_id'] == "new_vitals")

echo "\n<tr><td>Weight</td><td>";
echo form_error('weight');
echo "<input type='text' name='weight' value='".set_value('weight',$init_weight)."' size='5' /> kg</td></tr>";

echo "\n<tr><td>Hb</td><td>";
echo form_error('hb');
echo "<input type='text' name='hb' value='".set_value('hb',$init_hb)."' size='5' /></td></tr>";

echo "\n<tr><td>Urine Albumin</td><td>";
echo form_error('urine_alb');
echo "<input type='text' name='urine_alb' value='".set_value('urine_alb',$init_urine_alb)."' size='5' /></td></tr>";


echo "\n<tr><td>Urine Sugar</td><td>";
echo form_error('urine_sugar');
echo "<input type='text' name='urine_sugar' value='".set_value('urine_sugar',$init_urine_sugar)."' size='5' /></td></tr>";

echo "\n<tr><td>Glucose Tolerance Test</td><td>";
echo form_error('glucose_tolerance_test');
echo "<input type='text' name='glucose_tolerance_test' value='".set_value('glucose_tolerance_test',$init_glucose_tolerance_test)."' size='5' /></td></tr>";

echo "\n<tr><td>Ankle Odema</td><td>";
echo form_error('ankle_odema');
    echo "\n<select name='ankle_odema'>";
    if($init_ankle_odema == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_ankle_odema=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_ankle_odema=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Vaginal Bleeding</td><td>";
echo form_error('vaginal_bleeding');
    echo "\n<select name='vaginal_bleeding'>";
    if($init_vaginal_bleeding == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_vaginal_bleeding=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_vaginal_bleeding=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Vaginal Infection</td><td>";
echo form_error('vaginal_infection');
    echo "\n<select name='vaginal_infection'>";
    if($init_vaginal_infection == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_vaginal_infection=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_vaginal_infection=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Urinary Tract Infection</td><td>";
echo form_error('urinary_tract_infection');
    echo "\n<select name='urinary_tract_infection'>";
    if($init_urinary_tract_infection == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_urinary_tract_infection=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_urinary_tract_infection=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Blood Pressure</td><td>";
echo $bp_systolic."/".$bp_diastolic." mm Hg</td></tr>";

echo "\n<tr><td>Blood Pressure 140/90 and above</td><td>";
echo form_error('blood_pressure');
    echo "\n<select name='blood_pressure'>";
    if($init_blood_pressure == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_blood_pressure=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_blood_pressure=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Temperature</td><td>";
echo $temperature."</td></tr>";

echo "\n<tr><td>Fever 38&deg;C and above</td><td>";
echo form_error('fever');
    echo "\n<select name='fever'>";
    if($init_fever == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_fever=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_fever=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Pallor</td><td>";
echo form_error('pallor');
    echo "\n<select name='pallor'>";
    if($init_pallor == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_pallor=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_pallor=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Fundal Height</td><td>";
echo form_error('fundal_height');
echo "<input type='text' name='fundal_height' value='".set_value('fundal_height',$init_fundal_height)."' size='5' /> cm</td></tr>";

echo "\n<tr><td>Abnormal Fundal Height</td><td>";
echo form_error('abnormal_fundal_height');
    echo "\n<select name='abnormal_fundal_height'>";
    if($init_abnormal_fundal_height == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_abnormal_fundal_height=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_abnormal_fundal_height=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Movements</td><td>";
echo form_error('movements');
    echo "\n<select name='movements'>";
    if($init_movements == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_movements=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_movements=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td valign='top'>Lie & presentation</td><td>";
echo form_error('lie');
echo "\n<textarea class='normal' name='lie' id='lie' cols='40' rows='4'>".$init_lie."</textarea>";
echo "\n</td></tr>";
//echo "<input type='text' name='lie' value='".set_value('lie',$init_lie)."' size='100' /></td></tr>";

echo "\n<tr><td>Abnormal Presentation</td><td>";
echo form_error('abnormal_presentation');
    echo "\n<select name='abnormal_presentation'>";
    if($init_abnormal_presentation == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_abnormal_presentation=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_abnormal_presentation=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Fetal Heart Tones</td><td>";
echo form_error('fetal_heart_tones');
    echo "\n<select name='fetal_heart_tones'>";
    if($init_fetal_heart_tones == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_fetal_heart_tones=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_fetal_heart_tones=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Missing Fetal Heartbeat</td><td>";
echo form_error('missing_fetal_heartbeat');
    echo "\n<select name='missing_fetal_heartbeat'>";
    if($init_missing_fetal_heartbeat == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_missing_fetal_heartbeat=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_missing_fetal_heartbeat=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Supplement Iodine in High Risk Areas</td><td>";
echo form_error('supplement_iodine');
    echo "\n<select name='supplement_iodine'>";
    if($init_supplement_iodine == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_supplement_iodine=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_supplement_iodine=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Supplement Vitamins</td><td>";
echo form_error('supplement_vitamins');
    echo "\n<select name='supplement_vitamins'>";
    if($init_supplement_vitamins == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_supplement_vitamins=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_supplement_vitamins=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Supplement Iron</td><td>";
echo form_error('supplement_iron');
echo "<input type='text' name='supplement_iron' value='".set_value('supplement_iron',$init_supplement_iron)."' size='25' /></td></tr>";

echo "\n<tr><td>Supplement Folate</td><td>";
echo form_error('supplement_folate');
echo "<input type='text' name='supplement_folate' value='".set_value('supplement_folate',$init_supplement_folate)."' size='25' /></td></tr>";

echo "\n<tr><td>Malaria Prophylaxis</td><td>";
echo form_error('malaria_prophylaxis');
    echo "\n<select name='malaria_prophylaxis'>";
    if($init_malaria_prophylaxis == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_malaria_prophylaxis=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_malaria_prophylaxis=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Breastfeed Intention</td><td>";
echo form_error('breastfeed_intention');
    echo "\n<select name='breastfeed_intention'>";
    if($init_breastfeed_intention == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_breastfeed_intention=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_breastfeed_intention=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Advise on 4 Danger Signs</td><td>";
echo form_error('advise_4_danger_signs');
    echo "\n<select name='advise_4_danger_signs'>";
    if($init_advise_4_danger_signs == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_advise_4_danger_signs=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_advise_4_danger_signs=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Dental Checkup</td><td>";
echo form_error('dental_checkup');
    echo "\n<select name='dental_checkup'>";
    if($init_dental_checkup == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_dental_checkup=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_dental_checkup=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Emergency Plans</td><td>";
echo form_error('emergency_plans');
    echo "\n<select name='emergency_plans'>";
    if($init_emergency_plans == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_emergency_plans=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_emergency_plans=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Healthy Diet</td><td>";
echo form_error('healthy_diet');
    echo "\n<select name='healthy_diet'>";
    if($init_healthy_diet == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_healthy_diet=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_healthy_diet=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Adequate Rest</td><td>";
echo form_error('adequate_rest');
    echo "\n<select name='adequate_rest'>";
    if($init_adequate_rest == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_adequate_rest=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_adequate_rest=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Adequate Exercise</td><td>";
echo form_error('adequate_exercise');
    echo "\n<select name='adequate_exercise'>";
    if($init_adequate_exercise == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_adequate_exercise=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_adequate_exercise=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Third Trimester Issues</td><td>";
echo form_error('thirdtrimester_issues');
    echo "\n<select name='thirdtrimester_issues'>";
    if($init_thirdtrimester_issues == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Yes' ".($init_thirdtrimester_issues=='Yes'?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='No' ".($init_thirdtrimester_issues=='No'?' selected=\'selected\'':'').">No</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr>";
    echo "\n<td valign='top'>Risks</td>";
    echo "\n<td>";
    echo form_error('risks');
    echo "\n<textarea class='normal' name='risks' id='risks' cols='40' rows='4'>".$init_risks."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td valign='top'>Notes <font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('notes');
    echo "\n<textarea class='normal' name='notes' id='notes' cols='40' rows='4'>".$init_notes."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td valign='top'>Check-up Remarks</td>";
    echo "\n<td>";
    echo form_error('followup_remarks');
    echo "\n<textarea class='normal' name='followup_remarks' id='followup_remarks' cols='40' rows='4'>".$init_followup_remarks."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Next Check-up</td><td>";
echo form_error('next_followup');
echo "<input type='text' name='next_followup' id='next_followup' value='".set_value('next_followup',$init_next_followup)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "</table>";
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('antenatal_id', $antenatal_id);
echo form_hidden('antenatal_followup_id', $antenatal_followup_id);
echo form_hidden('synch_out', $init_synch_out);
echo "<input type='hidden' name='lmp' value='".$antenatal_info[0]['lmp']."' id='lmp'/>";

echo "<div align='center'><br />";
if($save_attempt == "VIEW ANTENATAL FOLLOW-UP"){
    echo "[ VIEW ONLY ]";
} else {
    echo "<input type='submit' value='S A V E' />";
}
echo "</div>";

echo "</form>";


echo "\n<fieldset>";
echo "<legend>ANTENATAL INFO</legend>";
echo "\n<table>";
echo "\n<tr><td>Gravida</td><td>";
echo $antenatal_info[0]['gravida']."</td></tr>";

echo "\n<tr><td>Para</td><td>";
echo $antenatal_info[0]['para']."</td></tr>";

echo "\n<tr><td>Gestation based on LMP</td><td>";
echo round((time()-strtotime($antenatal_info[0]['lmp']))/(60*60*24*7),1);
//echo $antenatal_info[0]['lmp_gestation'].;
echo " weeks</td></tr>";

echo "\n<tr><td>LMP</td><td>";
echo $antenatal_info[0]['lmp']."</td></tr>";

echo "\n<tr><td>EDD based on LMP</td><td>";
echo $antenatal_info[0]['lmp_edd']."</td></tr>";

echo "\n<tr><td>Planned Place of Delivery </td><td>";
echo $antenatal_info[0]['planned_place']."</td></tr>";

echo "\n<tr><td>Record Date</td><td>";
echo $antenatal_info[0]['date']."</td></tr>";

echo "\n<tr><td>Method of Contraception</td><td>";
echo $antenatal_info[0]['method_contraception']."</td></tr>";

echo "\n<tr><td>Abortions</td><td>";
echo $antenatal_info[0]['abortion']."</td></tr>";

echo "\n<tr><td>Husband's Name</td><td>";
echo $antenatal_info[0]['husband_name']."</td></tr>";

echo "\n<tr><td>Husband's Job</td><td>";
echo $antenatal_info[0]['husband_job']."</td></tr>";

echo "\n<tr><td>Husband's DOB</td><td>";
echo $antenatal_info[0]['husband_dob']."</td></tr>";

echo "\n<tr><td>Husband's IC No.</td><td>";
echo $antenatal_info[0]['husband_ic_no']."</td></tr>";

echo "\n<tr><td>Midwife's Name</td><td>";
echo $antenatal_info[0]['midwife_name']."</td></tr>";

//echo "\n<tr><td>Gestation based on LMP</td><td>";
//echo $antenatal_info[0]['lmp_gestation']." weeks</td></tr>";

echo "</table>";
echo "\n</fieldset>";

echo "</div>";
?>
<script  type="text/javascript">

    $(function() {
        $( "#next_followup" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c+1'
        });
    });


    $(function() {
        $( "#record_date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c'
        });
    });


      function calculateVP()
      {
         //if ($("lmp").value == '')
         if (document.getElementById("lmp").value == '')
            document.getElementById("record_date").value = '';
            //$("est_edd").value = '';
         else
         {
            //var lmp_date = $("lmp").value;
            var lmp_date = document.getElementById("lmp").value;
            if ((lmp_date.charAt(4) == "-") && (lmp_date.charAt(7) == "-")){
                var lmpYYYY = lmp_date.substring(0,4);
                var lmpMM = lmp_date.substring(5,7) - 1;
                var lmpDD = lmp_date.substring(8,10);
                var lmp_plus_40w  =   new Date(lmpYYYY, lmpMM, lmpDD)
                lmp_plus_40w.setDate(lmp_plus_40w.getDate() + (40*7));

                //var record_date = $("record_date").value;
                //var record_date = document.getElementById("record_date").value;
                var record_date = document.getElementById("record_date").value;
                if ((record_date.charAt(4) == "-") && (record_date.charAt(7) == "-")){
                    var recordYYYY = record_date.substring(0,4);
                    var recordMM = record_date.substring(5,7) - 1;
                    var recordDD = record_date.substring(8,10);
                    var record_date  =   new Date(recordYYYY, recordMM, recordDD)
                    var lmp_date  =   new Date(lmpYYYY, lmpMM, lmpDD)
                    var lmp_till_record = (record_date.getTime() - lmp_date.getTime()) / (1000*60*60*24*7);
                    var duration_months = (record_date.getTime() - lmp_date.getTime()) / (1000*60*60*24*30);

                    if(lmp_till_record < 0 || lmp_till_record > 44){
                        var error_period = "Invalid dates";
                    } else {
                        var error_period = "";
                    }
                } else {
                    var lmp_till_record = "Invalid format";
                }

            } else {
                var lmp_plus_40w = "Invalid format";
            }
            //document.getElementById("visit_period").value = lmp_plus_40w;
            document.getElementById("visit_period").value = lmp_till_record;
            document.getElementById("duration_months").value = duration_months;
            document.getElementById("error_period").value = error_period;
            //$("est_edd").value = lmp_plus_40w;
            //$("est_duration").value = lmp_till_record;
         }
      }

    window.onload = function() {
        document.getElementById("care_date").onChange = calculateVP;
        //$("lmp").onChange = calculateEDD;
    }


</script>

