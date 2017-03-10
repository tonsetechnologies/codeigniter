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
    print "\n<br />summary_id = " . $summary_id;
    print "\n<br />antenatal_id = " . $antenatal_id;
    print "\n<br />antenatal_info_id = " . $antenatal_info_id;
    print "\n<br />antenatal_current_id = " . $antenatal_current_id;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(antenatal_info)=<br />";
		print_r($antenatal_info);
    echo "\n<br />print_r(followup_list)=<br />";
		print_r($followup_list);
    echo "\n<br />print_r(delivery_list)=<br />";
		print_r($delivery_list);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_antenatal_info_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<h2>".$save_attempt."</h2>";

if($app_country == "Nepal"){
    ?>
    <div align="justify">
    <iframe name="I1" src="http://www.ashesh.com.np/linkdate-converter.php" width="438" height="200" border="0" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" allowtransparency="true">
    </iframe><br>
    <?php
    //<a title="Nepali Date Converter, Nepali Date, Date Converter"href="http://www.ashesh.com.np/nepali-date-converter.php">Date Converter</a></div>
} //endif($app_country == "Nepal")


$attributes =   array('class' => 'select_form', 'id' => 'vitals_form');
echo form_open('ehr_consult_antenatal/edit_antenatal_info/'.$form_purpose.'/'.$patient_id.'/'.$summary_id, $attributes);

echo "\n<fieldset>";
echo "<legend>OBSTETRICAL INFORMATION</legend>";
echo "\n<table>";

echo "\n<tr><td>Antenatal Reference</td><td>";
echo form_error('antenatal_reference');
echo "\n<input type='text' name='antenatal_reference' value='".set_value('antenatal_reference',$init_antenatal_reference)."' size='10' /></td></tr>";

echo "\n<tr><td>Gravida (current)<font color='red'>*</font></td><td>";
echo form_error('gravida');
echo "\n<input type='text' name='gravida' value='".set_value('gravida',$init_gravida)."' size='3' /></td></tr>";

echo "\n<tr><td>Para (previous)<font color='red'>*</font></td><td>";
echo form_error('para');
echo "<input type='text' name='para' value='".set_value('para',$init_para)."' size='3' /></td></tr>";

/*
echo "\n<tr><td>Pregnancy duration</td><td>";
echo form_error('pregnancy_duration');
echo "\n<input type='text' name='pregnancy_duration' id='pregnancy_duration' value='".set_value('pregnancy_duration',$init_pregnancy_duration)."' size='4' /> weeks  <input class='disabled' name='est_duration' value='' type='text' size='3' id='est_duration' readonly='readonly' onFocus='blur();'></td></tr>";
*/

echo "\n<tr><td>LMP <font color='red'>*</font></td><td>";
echo form_error('lmp');
echo "\n<input type='text' name='lmp' id='lmp' value='".set_value('lmp',$init_lmp)."' size='10' onChange='calculateEDD();'/> YYYY-MM-DD</td></tr>";

/*
echo "\n<tr><td>EDD <font color='red'>*</font></td><td>";
echo form_error('edd');
echo "\n<input type='text' name='edd' value='".set_value('edd',$init_edd)."' size='8' /> YYYY-MM-DD <input class='disabled' name='est_edd' value='' type='text' size='12' id='est_edd' readonly='readonly' onFocus='blur();'></td></tr>";
*/
echo "\n<tr><td>Menstrual cycle length</td><td>";
echo form_error('menstrual_cycle_length');
echo "<input type='text' name='menstrual_cycle_length' value='".set_value('menstrual_cycle_length',$init_menstrual_cycle_length)."' size='3' /> days</td></tr>";

echo "\n<tr><td>EDD based on LMP <font color='red'>*</font></td><td>";
echo form_error('lmp_edd');
echo "\n<input type='text' name='lmp_edd' id='lmp_edd' value='".set_value('lmp_edd',$init_lmp_edd)."' size='10' /> YYYY-MM-DD <input class='disabled' name='est_edd' value='' type='text' size='16' id='est_edd' readonly='readonly' onFocus='blur();'></td></tr>";

echo "\n<tr><td>Gestation (today) based on LMP</td><td>";
echo form_error('lmp_gestation');
if((strtotime($now_date)-strtotime($init_lmp_edd)) <= 0){
    echo round((strtotime($now_date)-strtotime($init_lmp))/(60*60*24*7),1);
} else {
    echo round((strtotime($now_date)-strtotime($init_lmp))/(60*60*24*7),1);
    //echo "N/A";
}
//echo "\n<input type='text' name='lmp_gestation' id='lmp_gestation' value='".set_value('lmp_gestation',$init_lmp_gestation)."' size='4' />";
echo "\n<input class='disabled' name='est_duration' value='' type='text' size='3' id='est_duration' readonly='readonly' onFocus='blur();'> weeks</td></tr>";

echo "\n<tr><td>Midwife's name</td><td>";
echo form_error('midwife_name');
echo "\n<input type='text' name='midwife_name' value='".set_value('midwife_name',$init_midwife_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Planned place</td><td>";
echo form_error('planned_place');
echo "\n<input type='text' name='planned_place' value='".set_value('planned_place',$init_planned_place)."' size='50' /></td></tr>";

echo "\n<tr><td>Ultra-sound Scan Date</td><td>";
echo form_error('usscan_date');
echo "\n<input type='text' name='usscan_date' id='usscan_date' value='".set_value('usscan_date',$init_usscan_date)."' size='8' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>EDD based on Ultra-sound Scan</td><td>";
echo form_error('usscan_edd');
echo "\n<input type='text' name='usscan_edd' id='usscan_edd' value='".set_value('usscan_edd',$init_usscan_edd)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Gestation based on Ultra-sound Scan</td><td>";
echo form_error('usscan_gestation');
echo "\n<input type='text' name='usscan_gestation' id='usscan_gestation' value='".set_value('usscan_gestation',$init_usscan_gestation)."' size='4' /> weeks</td></tr>";

echo "\n<tr><td>Record Date <font color='red'>*</font></td><td>";
echo form_error('record_date');
echo "\n<input type='text' name='record_date' id='record_date' value='".set_value('record_date',$init_record_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n</table>";
echo "\n</fieldset>";


echo "\n<fieldset>";
echo "<legend>OBSTETRICAL HISTORY</legend>";
echo "\n<table>";

echo "\n<tr><td>No. of caesarean births</td><td>";
echo form_error('num_caesarean_births');
echo "\n<input type='text' name='num_caesarean_births' value='".set_value('num_caesarean_births',$init_num_caesarean_births)."' size='2' /> times</td></tr>";

echo "\n<tr><td>No. of miscarriages</td><td>";
echo form_error('num_miscarriages');
echo "\n<input type='text' name='num_miscarriages' value='".set_value('num_miscarriages',$init_num_miscarriages)."' size='2' /> times</td></tr>";

echo "\n<tr><td>Three consecutive miscarriages</td><td>";
echo form_error('three_consec_miscarriages');
echo "\n<select class='normal' name='three_consec_miscarriages'>";          
    echo "\n<option value='' ".($init_three_consec_miscarriages===NULL?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='FALSE' ".($init_three_consec_miscarriages=='f'?"selected='selected'":"").">No</option>";
    echo "\n<option value='TRUE' ".($init_three_consec_miscarriages==='t'?"selected='selected'":"").">Yes</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>No. of stillbirths</td><td>";
echo form_error('num_stillbirths');
echo "\n<input type='text' name='num_stillbirths' value='".set_value('num_stillbirths',$init_num_stillbirths)."' size='2' /> times</td></tr>";

echo "\n<tr><td>Post-partum depression</td><td>";
echo form_error('post_partum_depression');
echo "\n<select class='normal' name='post_partum_depression'>";          
    echo "\n<option value=' ' ".($init_post_partum_depression==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_post_partum_depression=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Yes' ".($init_post_partum_depression=='Yes'?"selected='selected'":"").">Yes</option>";
    echo "\n<option value='Mild' ".($init_post_partum_depression=='Mild'?"selected='selected'":"").">Mild</option>";
    echo "\n<option value='Severe' ".($init_post_partum_depression=='Severe'?"selected='selected'":"").">Severe</option>";
    echo "\n<option value='Prolonged' ".($init_post_partum_depression=='Prolonged'?"selected='selected'":"").">Prolonged</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>No. of term deliveries</td><td>";
echo form_error('num_term_deliveries');
echo "\n<input type='text' name='num_term_deliveries' value='".set_value('num_term_deliveries',$init_num_term_deliveries)."' size='2' /> times</td></tr>";

echo "\n<tr><td>No. of pre-term deliveries</td><td>";
echo form_error('num_preterm_deliveries');
echo "\n<input type='text' name='num_preterm_deliveries' value='".set_value('num_preterm_deliveries',$init_num_preterm_deliveries)."' size='2' /> times</td></tr>";

echo "\n<tr><td>No. of pregnancies &lt; 21 weeks</td><td>";
echo form_error('num_preg_lessthan_21wk');
echo "\n<input type='text' name='num_preg_lessthan_21wk' value='".set_value('num_preg_lessthan_21wk',$init_num_preg_lessthan_21wk)."' size='2' /> times</td></tr>";

echo "\n<tr><td>No. of live births</td><td>";
echo form_error('num_live_births');
echo "\n<input type='text' name='num_live_births' value='".set_value('num_live_births',$init_num_live_births)."' size='2' /> times</td></tr>";

echo "\n<tr><td>Method of contraception</td><td>";
echo form_error('method_contraception');
echo "<input type='text' name='method_contraception' value='".set_value('method_contraception',$init_method_contraception)."' size='15' /></td></tr>";

echo "\n<tr><td>Abortion</td><td>";
echo form_error('abortion');
echo "\n<input type='text' name='abortion' value='".set_value('abortion',$init_abortion)."' size='2' /> times</td></tr>";

echo "\n<tr><td>&nbsp;</td><td> </td>";
echo "\n<tr><td><u>PRESENT HEALTH PROBLEMS</u></td><td> </td>";

echo "\n<tr><td>PTB (14+ days of cough)</td><td>";
echo form_error('present_pulmonary_tb');
echo "\n<select class='normal' name='present_pulmonary_tb'>";          
    echo "\n<option value=' ' ".($init_present_pulmonary_tb==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_present_pulmonary_tb=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Yes' ".($init_present_pulmonary_tb=='Yes'?"selected='selected'":"").">Yes</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Heart disease</td><td>";
echo form_error('present_heart_disease');
echo "\n<select class='normal' name='present_heart_disease'>";          
    echo "\n<option value=' ' ".($init_present_heart_disease==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_present_heart_disease=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Yes' ".($init_present_heart_disease=='Yes'?"selected='selected'":"").">Yes</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Diabetes Mellitus</td><td>";
echo form_error('present_diabetes');
echo "\n<select class='normal' name='present_diabetes'>";          
    echo "\n<option value=' ' ".($init_present_diabetes==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_present_diabetes=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Yes' ".($init_present_diabetes=='Yes'?"selected='selected'":"").">Yes</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Bronchial asthma</td><td>";
echo form_error('present_bronchial_asthma');
echo "\n<select class='normal' name='present_bronchial_asthma'>";          
    echo "\n<option value=' ' ".($init_present_bronchial_asthma==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_present_bronchial_asthma=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Yes' ".($init_present_bronchial_asthma=='Yes'?"selected='selected'":"").">Yes</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Goiter</td><td>";
echo form_error('present_goiter');
echo "\n<select class='normal' name='present_goiter'>";          
    echo "\n<option value=' ' ".($init_present_goiter==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_present_goiter=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Yes' ".($init_present_goiter=='Yes'?"selected='selected'":"").">Yes</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Hepatitis B</td><td>";
echo form_error('present_hepatitis_b');
echo "\n<select class='normal' name='present_hepatitis_b'>";          
    echo "\n<option value=' ' ".($init_present_hepatitis_b==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_present_hepatitis_b=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Yes' ".($init_present_hepatitis_b=='Yes'?"selected='selected'":"").">Yes</option>";
    echo "\n<option value='Vaccinated' ".($init_present_hepatitis_b=='Vaccinated'?"selected='selected'":"").">Vaccinated</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "</table>";
echo "\n</fieldset>";

echo "\n<fieldset>";
echo "<legend>SPOUSE</legend>";
echo "\n<table>";


$registered_spouse_name =   "";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<td valign='top'>Is spouse a registered patient?</td>";
    echo "\n<td>";
    echo "\n<select name='contact_person' class='normal' id='contact_person'>";
        echo "\n<option value='' >No, not inside database</option>";
        if(count($family_above) > 0) {
            foreach($family_above as $kid)
            {
                echo "\n<option value='".$kid['patient_id']."' ";
                if(isset($init_contact_person)) {
                    echo ($init_contact_person==$kid['patient_id'] ? " selected='selected'" : "");
                    $registered_spouse_name =   $kid['name_first']." ".$kid['name'];
                }
                echo ">".$kid['name'].", ".$kid['name_first']." - ".$kid['birth_date']."</option>";
            } //foreach
        }
        if(count($family_below) > 0) {
            foreach($family_below as $kid)
            {
                echo "\n<option value='".$kid['patient_id']."' ";
                if(isset($init_contact_person)) {
                    echo ($init_contact_person==$kid['patient_id'] ? " selected='selected'" : "");
                    $registered_spouse_name =   $kid['name_first']." ".$kid['name'];
                }
                echo ">".$kid['name'].", ".$kid['name_first']." - ".$kid['birth_date']."</option>";
            } //foreach
        }
    echo "\n</select>";
    // Provide link to retrieve record if relationship is established
    if(isset($init_contact_person)) {
        echo "\n&nbsp;&nbsp;";
        echo anchor('ehr_individual/individual_overview/'.$init_contact_person, "<strong>View kin</strong>", 'target="_blank"');
    }
    echo "\n</td>";
echo "\n</tr>";
 
if($init_contact_person == ""){ 
    echo "\n<tr><td>Husband's name</td><td>";
    echo form_error('husband_name');
    echo "\n<input type='text' name='husband_name' value='".set_value('husband_name',$init_husband_name)."' size='50' /></td></tr>";

    echo "\n<tr><td>Husband's job</td><td>";
    echo form_error('husband_job');
    echo "\n<input type='text' name='husband_job' value='".set_value('husband_job',$init_husband_job)."' size='50' /></td></tr>";

    echo "\n<tr><td>Husband's DOB</td><td>";
    echo form_error('husband_dob');
    echo "\n<input type='text' name='husband_dob' id='husband_dob' value='".set_value('husband_dob',$init_husband_dob)."' size='8' /></td></tr>";

    echo "\n<tr><td>Husband's IC No.</td><td>";
    echo form_error('husband_ic_no');
    echo "\n<input type='text' name='husband_ic_no' value='".set_value('husband_ic_no',$init_husband_ic_no)."' size='20' /></td></tr>";
} else {
    echo form_hidden('husband_name', '');
    echo form_hidden('husband_job', '');
    echo form_hidden('husband_dob', '');
    echo form_hidden('husband_ic_no', '');
} //endif($init_contact_person == "")

echo "\n</table>";
echo "\n</fieldset>";


/*
echo "\n<tr><td>zz</td><td>";
echo form_error('zz');
echo "\n<input type='text' name='zz' value='".set_value('zz',$init_zz)."' size='50' /></td></tr>";
*/

echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('antenatal_id', $antenatal_id);
echo form_hidden('antenatal_info_id', $antenatal_info_id);
echo form_hidden('antenatal_current_id', $antenatal_current_id);
echo form_hidden('synch_out', $init_synch_out);
echo "<input type='hidden' name='now_date' value='".$now_date."' id='now_date'/>";

echo "<div align='center'><br />";
echo "<input type='submit' value=' S A V E ' />";
echo "</div>";

echo "</form>";

// If spouse is inside database, then allow user to edit directly from this page.
if($init_contact_person <> ""){
    echo "\n<fieldset>";
    echo "<legend>".$registered_spouse_name."'s Details</legend>";
    echo "\n<div id='ajax_spouse_info'>";
    echo "</div>"; //id='ajax_spouse_info'
    echo "<div id='submit_spouse_info'>";
    echo "<input type='submit' value='Update' />";
    echo "</div>"; //id='submit_spouse_info'
    echo "\n</fieldset>";
} else {
    echo "\n<div id='ajax_spouse_info'>";
    echo "</div>"; //id='ajax_spouse_info'
    echo "<div id='submit_spouse_info'>";
    //echo "<input type='submit' value='Update' />";
    echo "</div>"; //id='submit_spouse_info'
}


if($save_attempt == "EDIT ANTENATAL INFO"){
    echo "\n<fieldset>";
    echo "<legend>CHECK-UPS</legend>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th>No.</th>";
        echo "\n<th width='110'>Reading Date</th>";
        echo "\n<th width='15'>Pregnancy Duration (weeks)</th>";
        echo "\n<th width='15'>Lie</th>";
        echo "\n<th width='50'>Weight (kg)</th>";
        echo "\n<th width='50'>Fundal height (cm)</th>";
        echo "\n<th width='150'>Hb</th>";
        echo "\n<th width='150'>Urine alb</th>";
        echo "\n<th width='150'>Urine sugar</th>";
        echo "\n<th width='150'>Ankle odema</th>";
        echo "\n<th width='150'>Notes</th>";
        echo "\n<th width='150'>Next Check-up</th>";
    echo "</tr>";
    $current_checkup_exists =   FALSE;
    if(isset($followup_list)){
        $rownum = 1;
        foreach ($followup_list as $followup_item){
            echo "\n<tr>";
            echo "\n<td>".$rownum.".</td>";
            echo "\n<td>".anchor('ehr_consult_antenatal/edit_antenatal_followup/edit_followup/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/'.$followup_item['antenatal_followup_id'], "<strong>".$followup_item['date']."</strong>")."</td>";
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
        echo anchor('ehr_consult_antenatal/edit_antenatal_followup/new_followup/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/new_followup', "<strong>Add New Check-up</strong>");
    }
    echo "\n<br /><br />";

    echo "\n</fieldset>";


    echo "\n<fieldset>";
    echo "<legend>DELIVERY</legend>";
    echo anchor('ehr_consult_antenatal/edit_antenatal_delivery/new_delivery/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/new_delivery', "<strong>Add New Delivery</strong>");
    echo "\n<br /><br />";


    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th>No.</th>";
        echo "\n<th width='15'>Delivery Date</th>";
        echo "\n<th width='110'>Delivery Time</th>";
        echo "\n<th width='150'>Delivery Type</th>";
        echo "\n<th width='250'>Delivery Place</th>";
        echo "\n<th width='50'>Baby's Weight</th>";
        echo "\n<th width='150'>Date of Admission</th>";
        echo "\n<th width='250'>Outcome</th>";
        echo "\n<th width='250'>Name of Child</th>";
    echo "</tr>";
    if(isset($delivery_list)){
        $rownum = 1;
        foreach ($delivery_list as $delivery_item){
            echo "\n<tr>";
            echo "\n<td>".$rownum.".</td>";
            echo "\n<td>".anchor('ehr_consult_antenatal/edit_antenatal_delivery/edit_delivery/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/'.$delivery_item['antenatal_delivery_id'], "<strong>".$delivery_item['date_delivery']."</strong>")."</td>";
            echo "\n<td align='center'>".$delivery_item['time_delivery']."</td>";
            echo "\n<td align='center'>".$delivery_item['delivery_type']."</td>";
            echo "\n<td>".$delivery_item['delivery_place']."</td>";
            echo "\n<td>".$delivery_item['baby_weight']."</td>";
            echo "\n<td>".$delivery_item['date_admission']."</td>";
            echo "\n<td>".$delivery_item['delivery_outcome']."</td>";
            echo "\n<td>";
            echo anchor('ehr_individual/individual_overview/'.$delivery_item['child_id'], "<strong>".$delivery_item['name_first']." ".$delivery_item['name']."</strong>", 'target="_blank"');
            echo "\n</td>";
            echo "\n</tr>";
            $rownum++;
        }//endforeach;
    } //endif(isset($delivery_list))
    echo "</table>";
    echo "\n<br />";
    echo "\n</fieldset>";


    echo "\n<fieldset>";
    echo "<legend>POSTPARTUM CARE</legend>";
    if(count($delivery_list) > 0){
        echo anchor('ehr_consult_antenatal/edit_antenatal_postpartum/new_postpartum/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/new_postpartum', "<strong>Add New Postpartum Care</strong>");
    } else {
        echo "\nAdd New Postpartum Care";
    }
    echo "\n<br /><br />";


    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th>No.</th>";
        echo "\n<th width='110'>Visit Date</th>";
        echo "\n<th width='15'>Days after termination</th>";
        echo "\n<th width='50'>Breastfeeding</th>";
        echo "\n<th width='50'>Fever 38&deg; and above</th>";
        echo "\n<th width='50'>Vaginal bleeding</th>";
        echo "\n<th width='50'>Remarks</th>";
    echo "</tr>";
    if(isset($postpartum_list)){
        $rownum = 1;
        foreach ($postpartum_list as $postpartum_item){
            echo "\n<tr>";
            echo "\n<td>".$rownum.".</td>";
            echo "\n<td>".anchor('ehr_consult_antenatal/edit_antenatal_postpartum/edit_postpartum/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/'.$postpartum_item['antenatal_postpartum_id'], "<strong>".$postpartum_item['care_date']."</strong>")."</td>";
            echo "\n<td align='center'>".(round((strtotime($postpartum_item['care_date'])-strtotime($postpartum_item['termination_date']))/(60*60*24),1))."</td>";
            echo "\n<td>".$postpartum_item['breastfeed']."</td>";
            echo "\n<td align='center'>".$postpartum_item['fever_38']."</td>";
            echo "\n<td>".$postpartum_item['vaginal_bleeding']."</td>";
            echo "\n<td>".$postpartum_item['postpartum_remarks']."</td>";
            echo "\n</tr>";
            $rownum++;
        }//endforeach;
    } //endif(isset($postpartum_list))
    echo "</table>";
    echo "\n<br />";
    echo "\n</fieldset>";


} //endif($save_attempt == "EDIT ANTENATAL INFO")


echo "\n<fieldset>";
echo "<legend>PREGNANCIES RECORDED</legend>";
//echo "<strong>Add New History</strong>";
//echo anchor('ehr_individual/edit_history_antenatal/'.$patient_id.'/new_antenatal/new_antenatal', "<strong>Add New History</strong>");
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Reading Date</th>";
    echo "\n<th width='15'>Gravida</th>";
    echo "\n<th width='15'>Para</th>";
    echo "\n<th width='50'>LMP</th>";
    echo "\n<th width='50'>EDD</th>";
    echo "\n<th width='50'>Outcome</th>";
    echo "\n<th width='50'>Status</th>";
echo "</tr>";
if(isset($history_list)){
    $rownum = 1;
    foreach ($history_list as $history_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        //echo "\n<td>".anchor('ehr_individual/edit_history_antenatal/'.$patient_id.'/edit_antenatal/'.$history_item['antenatal_id'], "<strong>".$history_item['date']."</strong>")."</td>";
        echo "\n<td align='center'>".$history_item['date']."</td>";
        echo "\n<td align='center'><strong>".$history_item['gravida']."</strong></td>";
        echo "\n<td align='center'>".$history_item['para']."</td>";
        echo "\n<td>".$history_item['lmp']."</td>";
        echo "\n<td><strong>".$history_item['lmp_edd']."</strong></td>";
        //echo "\n<td>".$history_item['status']."</td>";
        echo "\n<td>".$history_item['delivery_outcome']."</td>";
        echo "\n<td>";
        if($history_item['status'] > 0){
            echo "Closed";
        } else {
            echo "Open";
        }
        echo "</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


echo "</div>";
$siteurl_spouse_info    =   site_url()."/ehr_ajax/update_kin_details/";

/*
      function calculateEDD()
      {
         if ($("lmp").value == '')
            $("est_edd").value = '';
         else
         {
            var height = Number($("lmp").value);
            var heightInch = height + (40 * 7);
            $("est_edd").value = heightInch;
         }
      }
*/
?>
<script type="text/javascript">

    $(document).ready(function() {
        $('#lmp').delegate('select','change',function (){
            calculateEDD()}
            );
        $('#submit_spouse_info').delegate('input','click',function (){
            ajax_submit_spouse_info('Updated')}
            );
        ajax_submit_spouse_info('Init');
        return false;
      })


    function ajax_submit_spouse_info(ajax_outcome) {
        var siteurl = "<?php echo $siteurl_spouse_info; ?>";
        //var ajax_outcome = 'Updated';
        var patient_id = "<?php echo $init_contact_person; ?>";
        var ajax_kin_ic_no = $('#kin_ic_no').val();
        var ajax_kin_birth_date = $('#kin_birth_date').val();
        var ajax_kin_job_function = $('#kin_job_function').val();
        var ajax_kin_tel_mobile = $('#kin_tel_mobile').val();
        var data = 'ajax_outcome='+ajax_outcome+'&patient_id='+patient_id+'&ajax_kin_ic_no='+ajax_kin_ic_no+'&ajax_kin_birth_date='+ajax_kin_birth_date+'&ajax_kin_job_function='+ajax_kin_job_function+'&ajax_kin_tel_mobile='+ajax_kin_tel_mobile;
        //alert(siteurl+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            var multi_part  =   result.split("|=|");
            $('#ajax_spouse_info').html(multi_part[0]);
            $('#more_immunisation').html(multi_part[1]);
          }
        }
    )}


    $(function() {
        $( "#lmp" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c'
        });
    });


    $(function() {
        $( "#lmp_edd" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c+1'
        });
    });


    $(function() {
        $( "#usscan_date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c'
        });
    });


    $(function() {
        $( "#usscan_edd" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c+1'
        });
    });


    $(function() {
        $( "#husband_dob" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c'
        });
    });


      function calculateEDD()
      {
         //if ($("lmp").value == '')
         if (document.getElementById("lmp").value == '')
            document.getElementById("est_edd").value = '';
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
                var record_date = document.getElementById("now_date").value;
                if ((record_date.charAt(4) == "-") && (record_date.charAt(7) == "-")){
                    var recordYYYY = record_date.substring(0,4);
                    var recordMM = record_date.substring(5,7) - 1;
                    var recordDD = record_date.substring(8,10);
                    var record_date  =   new Date(recordYYYY, recordMM, recordDD)
                    var lmp_date  =   new Date(lmpYYYY, lmpMM, lmpDD)
                    var lmp_till_record = (record_date.getTime() - lmp_date.getTime()) / (1000*60*60*24*7);


                } else {
                    var lmp_till_record = "Invalid format";
                }

            } else {
                var lmp_plus_40w = "Invalid format";
            }
            document.getElementById("est_edd").value = lmp_plus_40w;
            document.getElementById("est_duration").value = lmp_till_record;
            //$("est_edd").value = lmp_plus_40w;
            //$("est_duration").value = lmp_till_record;
         }
      }
/*
    window.onload = function() {
        document.getElementById("lmp").onChange = calculateEDD;
        //$("lmp").onChange = calculateEDD;
    }
*/
</script>

