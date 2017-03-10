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
 * Portions created by the Initial Developer are Copyright (C) 2009-2011
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
    print "\n<br />antenatal_id = " . $antenatal_id;
    print "\n<br />antenatal_delivery_id = " . $antenatal_delivery_id;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(antenatal_info)=<br />";
		print_r($antenatal_info);
    echo "\n<br />print_r(antenatal_delivery)=<br />";
		print_r($antenatal_delivery);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_antenatal_delivery_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";
echo "\n<div class='validation_errors'>".$error_messages['severity'].$error_messages['msg']."</div>";

echo form_hidden('no_error', $no_error);
echo form_error('no_error');
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

echo "\n<fieldset>";
echo "<legend>DELIVERY</legend>";
echo anchor('ehr_consult_antenatal/edit_antenatal_delivery/new_delivery/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/new_delivery', "<strong>Add New Delivery</strong>");
echo "\n<br /><br />";


echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='15'>Date of Delivery</th>";
    echo "\n<th width='110'>Time of Delivery</th>";
    echo "\n<th width='150'>Delivery Type</th>";
    echo "\n<th width='250'>Delivery Place</th>";
    echo "\n<th width='50'>Baby's Weight</th>";
    echo "\n<th width='150'>Date of Admission</th>";
    echo "\n<th width='250'>Name of Child</th>";
echo "</tr>";
if(isset($delivery_list)){
    $rownum = 1;
    foreach ($delivery_list as $delivery_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        if($antenatal_delivery_id == $delivery_item['antenatal_delivery_id']){
            echo "\n<td align='center'><strong>".$delivery_item['date_delivery']."</strong></td>";
        } else {
            echo "\n<td>".anchor('ehr_consult_antenatal/edit_antenatal_delivery/edit_delivery/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/'.$delivery_item['antenatal_delivery_id'], "<strong>".$delivery_item['date_delivery']."</strong>")."</td>";
        } //endif($antenatal_delivery_id == $delivery_item['antenatal_delivery_id'])
        echo "\n<td align='center'>".$delivery_item['time_delivery']."</td>";
        echo "\n<td align='center'>".$delivery_item['delivery_type']."</td>";
        echo "\n<td>".$delivery_item['delivery_place']."</td>";
        echo "\n<td>".$delivery_item['baby_weight']."</td>";
        echo "\n<td>".$delivery_item['date_admission']."</td>";
        echo "\n<td>";
        echo anchor('ehr_individual/individual_overview/'.$delivery_item['child_id'], "<strong>".$delivery_item['name']."</strong>", 'target="_blank"');
        echo "\n</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


$attributes =   array('class' => 'select_form', 'id' => 'delivery_form');
echo form_open('ehr_consult_antenatal/edit_antenatal_delivery/'.$form_purpose.'/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/'.$antenatal_delivery_id, $attributes);
echo "\n<table>";

echo "\n<tr><td>Date Terminated <font color='red'>*</font></td><td>";
echo form_error('date_delivery');
echo "\n<input type='text' name='date_delivery' id='date_delivery' value='".set_value('date_delivery',$init_date_delivery)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Time Terminated</td><td>";
echo form_error('time_delivery');
echo "<input type='text' name='time_delivery' value='".set_value('time_delivery',$init_time_delivery)."' size='8' /> hh:mm</td></tr>";

echo "\n<tr><td>Date of Admission</td><td>";
echo form_error('date_admission');
echo "<input type='text' name='date_admission' id='date_admission' value='".set_value('date_admission',$init_date_admission)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Time of Admission</td><td>";
echo form_error('time_admission');
echo "<input type='text' name='time_admission' value='".set_value('time_admission',$init_time_admission)."' size='8' /> hh:mm</td></tr>";

echo "\n<tr><td>Delivery Place</td><td>";
echo form_error('delivery_place');
echo "<input type='text' name='delivery_place' value='".set_value('delivery_place',$init_delivery_place)."' size='50' /></td></tr>";

echo "\n<tr><td>Outcome <font color='red'>*</font></td><td>";
echo form_error('delivery_outcome');
    echo "\n<select name='delivery_outcome'>";
    if($init_delivery_outcome == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Livebirth' ".($init_delivery_outcome=='Livebirth'?' selected=\'selected\'':'').">Livebirth</option>";
    echo "\n<option value='Stillbirth' ".($init_delivery_outcome=='Stillbirth'?' selected=\'selected\'':'').">Stillbirth</option>";
    echo "\n<option value='Abortion' ".($init_delivery_outcome=='Abortion'?' selected=\'selected\'':'').">Abortion</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Delivery Type</td><td>";
echo form_error('delivery_type');
    echo "\n<select name='delivery_type'>";
    if($init_delivery_type == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Vaginal birth' ".($init_delivery_type=='Vaginal birth'?' selected=\'selected\'':'').">Vaginal birth</option>";
    echo "\n<option value='Induction' ".($init_delivery_type=='Induction'?' selected=\'selected\'':'').">Induction</option>";
    echo "\n<option value='Caesarean Section' ".($init_delivery_type=='Caesarean Section'?' selected=\'selected\'':'').">Caesarean Section</option>";
    echo "\n<option value='Episiotomy' ".($init_delivery_type=='Episiotomy'?' selected=\'selected\'':'').">Episiotomy</option>";
    echo "\n<option value='Forceps' ".($init_delivery_type=='Forceps'?' selected=\'selected\'':'').">Forceps</option>";
    echo "\n<option value='Ventouse' ".($init_delivery_type=='Ventouse'?' selected=\'selected\'':'').">Ventouse</option>";
    echo "\n<option value='Others' ".($init_delivery_type=='Others'?' selected=\'selected\'':'').">Others</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td valign='top'>Mother's Condition</td><td>";
echo form_error('mother_condition');
    echo "\n<textarea class='normal' name='mother_condition' id='mother_condition' cols='60' rows='4'>".$init_mother_condition."</textarea>";
    echo "\n</td>";
echo "\n</tr>";
//echo "<input type='text' name='mother_condition' value='".set_value('mother_condition',$init_mother_condition)."' size='100' /></td></tr>";

echo "\n<tr><td>Postpartum haemorrhage</td><td>";
echo form_error('post_partum_bleed');
    echo "\n<select name='post_partum_bleed'>";
    if($init_post_partum_bleed == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='None' ".($init_post_partum_bleed=='None'?' selected=\'selected\'':'').">None</option>";
    echo "\n<option value='Insignificant' ".($init_post_partum_bleed=='Insignificant'?' selected=\'selected\'':'').">Insignificant</option>";
    echo "\n<option value='Significant' ".($init_post_partum_bleed=='Significant'?' selected=\'selected\'':'').">Significant (> 500cc.)</option>";
    echo "\n<option value='N/A' ".($init_post_partum_bleed=='N/A'?' selected=\'selected\'':'').">N/A</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Baby's Condition <font color='red'>*</font></td><td>";
echo form_error('baby_condition');
    echo "\n<select name='baby_condition'>";
    if($init_baby_condition == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Healthy' ".($init_baby_condition=='Immediate'?' selected=\'selected\'':'').">Healthy</option>";
    echo "\n<option value='Not healthy' ".($init_baby_condition=='Not healthy'?' selected=\'selected\'':'').">Not healthy</option>";
    echo "\n<option value='Dead' ".($init_baby_condition=='Dead'?' selected=\'selected\'':'').">Dead</option>";
    echo "\n</select>";
echo "</td></tr>\n";


echo "\n<tr><td>Baby's Weight</td><td>";
echo form_error('baby_weight');
echo "<input type='text' name='baby_weight' value='".set_value('baby_weight',$init_baby_weight)."' size='5' /> grams</td></tr>";

/*
echo "\n<tr><td>Complication ICPC-2</td><td>";
echo form_error('complication_icpc');
echo "<input type='text' name='complication_icpc' value='".set_value('complication_icpc',$init_complication_icpc)."' size='5' /></td></tr>";
*/
echo "\n<tr><td>Breastfeed immediate</td><td>";
echo form_error('breastfeed_immediate');
    echo "\n<select name='breastfeed_immediate'>";
    if($init_breastfeed_immediate == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Immediate' ".($init_breastfeed_immediate=='Immediate'?' selected=\'selected\'':'').">Immediate</option>";
    echo "\n<option value='Delayed' ".($init_breastfeed_immediate=='Delayed'?' selected=\'selected\'':'').">Delayed</option>";
    echo "\n<option value='Attempted, failed' ".($init_breastfeed_immediate=='None'?' selected=\'selected\'':'').">Attempted, failed</option>";
    echo "\n<option value='No attempt' ".($init_breastfeed_immediate=='None'?' selected=\'selected\'':'').">No attempt</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Birth attendant <font color='red'>*</font></td><td>";
//echo "<input type='text' name='birth_attendant' value='".set_value('birth_attendant',$init_birth_attendant)."' size='50' /></td></tr>";
echo form_error('birth_attendant');
    echo "\n<select name='birth_attendant'>";
    if($init_birth_attendant == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Doctor' ".($init_birth_attendant=='Doctor'?' selected=\'selected\'':'').">A - Doctor</option>";
    echo "\n<option value='Nurse' ".($init_birth_attendant=='Nurse'?' selected=\'selected\'':'').">B - Nurse</option>";
    echo "\n<option value='Midwife' ".($init_birth_attendant=='Midwife'?' selected=\'selected\'':'').">C - Midwife</option>";
    echo "\n<option value='Hilot/TBA' ".($init_birth_attendant=='Hilot/TBA'?' selected=\'selected\'':'').">D - Hilot/TBA</option>";
    echo "\n<option value='Others' ".($init_birth_attendant=='Others'?' selected=\'selected\'':'').">E - Others</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td valign='top'>Complication Notes</td><td>";
echo form_error('complication_notes');
    echo "\n<textarea class='normal' name='complication_notes' id='complication_notes' cols='60' rows='4'>".$init_complication_notes."</textarea>";
    echo "\n</td>";
echo "\n</tr>";
//echo "<input type='text' name='complication_notes' value='".set_value('complication_notes',$init_complication_notes)."' size='100' /></td></tr>";

echo "\n<tr>";
    echo "\n<td valign='top'>Remarks on delivery / termination</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='delivery_remarks' id='delivery_remarks' cols='60' rows='4'>".$init_delivery_remarks."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

if(count($family_below) > 0) {
echo "\n<tr>";
    echo "\n<td valign='top'>Is child a registered patient?</td>";
    echo "\n<td>";
    echo "\n<select name='child_id' class='normal' id='child_id'>";
        echo "\n<option value='' >Please select one</option>";
        foreach($family_below as $kid)
        {
            // List only younger ones
            if($kid['birth_date'] > $patient_info['birth_date']){
                echo "\n<option value='".$kid['patient_id']."' ";
                if(isset($init_child_id)) {
                    echo ($init_child_id==$kid['patient_id'] ? " selected='selected'" : "");
                }
                echo ">".$kid['name'].", ".$kid['name_first']." - ".$kid['birth_date']."</option>";
            } //endif
        } //foreach
    echo "\n</select>";
    // Provide link to retrieve record if relationship is established
    if(isset($init_child_id)) {
        echo "\n&nbsp;&nbsp;";
        echo anchor('ehr_individual/individual_overview/'.$init_child_id, "<strong>View Child</strong>", 'target="_blank"');
    }
    echo "\n</td>";
echo "\n</tr>";
} // end if(count($family_below) > 0)


echo "</table>";
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('antenatal_id', $antenatal_id);
echo form_hidden('antenatal_delivery_id', $antenatal_delivery_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Save' />";
echo "</div>";

echo "</form>";

echo "<p><span class='simple_button_yellow' ><strong>";
echo anchor('ehr_individual/edit_patient/new_patient/new_patient', 'Register Baby as New Patient', 'target="_blank"');
echo "</strong></span></p>";

echo "\n<fieldset>";
echo "<legend>ANTENATAL INFO</legend>";
echo "\n<table>";
echo "\n<tr><td>Gravida <font color='red'>*</font></td><td>";
echo $antenatal_info[0]['gravida']."</td></tr>";

echo "\n<tr><td>Para <font color='red'>*</font></td><td>";
echo $antenatal_info[0]['para']."</td></tr>";

echo "\n<tr><td>Method of Contraception</td><td>";
echo $antenatal_info[0]['method_contraception']."</td></tr>";

echo "\n<tr><td>Abortions</td><td>";
echo $antenatal_info[0]['abortion']."</td></tr>";

echo "\n<tr><td>Husband's Name</td><td>";
echo $antenatal_info[0]['husband_name']."</td></tr>";

echo "\n<tr><td>Husband's Job</td><td>";
echo $antenatal_info[0]['husband_job']."</td></tr>";

echo "\n<tr><td>Husband'd DOB</td><td>";
echo $antenatal_info[0]['husband_dob']."</td></tr>";

echo "\n<tr><td>Husband's IC No.</td><td>";
echo $antenatal_info[0]['husband_ic_no']."</td></tr>";

echo "\n<tr><td>Midwife's Name</td><td>";
echo $antenatal_info[0]['midwife_name']."</td></tr>";

echo "\n<tr><td>Pregnancy Duration</td><td>";
echo $antenatal_info[0]['pregnancy_duration']."</td></tr>";

echo "\n<tr><td>LMP</td><td>";
echo $antenatal_info[0]['lmp']."</td></tr>";



echo "\n<tr><td>EDD based on LMP</td><td>";
echo $antenatal_info[0]['lmp_edd']."</td></tr>";

echo "\n<tr><td>Planned Place of Delivery </td><td>";
echo $antenatal_info[0]['planned_place']."</td></tr>";

echo "\n<tr><td>Record Date</td><td>";
echo $antenatal_info[0]['date']."</td></tr>";

echo "</table>";
echo "\n</fieldset>";


echo "\n<fieldset>";
echo "<legend>CHECK-UPS</legend>";
echo "\n<br />";


echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Reading Date</th>";
    echo "\n<th width='15'>Pregnancy Duration</th>";
    echo "\n<th width='15'>Lie & Presentation</th>";
    echo "\n<th width='50'>Weight</th>";
    echo "\n<th width='50'>Fundal Height</th>";
    echo "\n<th width='150'>Hb</th>";
    echo "\n<th width='150'>Urine Albumi</th>";
    echo "\n<th width='150'>Urine Sugar</th>";
    echo "\n<th width='150'>Ankle Odema</th>";
    echo "\n<th width='150'>Notes</th>";
    echo "\n<th width='150'>Next Check-up</th>";
echo "</tr>";
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
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


echo "</div>";

?>
<script  type="text/javascript">

    $(function() {
        $( "#date_delivery" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c'
        });
    });


    $(function() {
        $( "#date_admission" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c'
        });
    });



</script>

