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
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(physical_info)=<br />";
		print_r($physical_info);
    echo "\n<br />print_r(modules_list)=<br />";
		print_r($modules_list);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_physical_exam_html_title')."</h1></div>";

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<h2>".$save_attempt."</h2>";
$attributes =   array('class' => 'select_form', 'id' => 'form', 'name' => 'form');
echo form_open('ehr_consult/edit_physical_exam/edit_physical/'.$patient_id.'/'.$summary_id, $attributes);
echo "\n<table>";

echo "\n<tr><td>";
echo "\n<fieldset>";
echo "<legend>Cardio Vascular System</legend>";
echo "\n<table>";

    echo "\n<tr><td width='250'><strong>Pulse rate</strong></td><td>";
    echo form_error('pulse_rate');
    echo "\n<input type='text' name='pulse_rate' value='".set_value('pulse_rate',$init_pulse_rate)."' size='3' /> bpm</td></tr>";

    echo "\n<tr><td><strong>Regular pulse</strong></td><td>";
    echo form_error('pulse_regular');
    echo "\n<input type='radio' name='pulse_regular' value='Yes' ".($init_pulse_regular=='Yes'?"checked='checked'":"")." onClick='checkPulseRegular(this);' >Yes</input>";
    echo "\n<input type='radio' name='pulse_regular' value='No' ".($init_pulse_regular=='No'?"checked='checked'":"")." onClick='checkPulseRegular(this);' >No</input>";
    //echo "\n<input type='radio' name='pulse_regular' value='Yes' ".set_radio('pulse_regular','Yes',($init_pulse_regular=='Yes'?TRUE:FALSE))." onClick='checkPulseRegular(this);' >Yes</input>";
    //echo "\n<input type='radio' name='pulse_regular' value='No' ".set_radio('pulse_regular','No',($init_pulse_regular=='No'?TRUE:FALSE))." onClick='checkPulseRegular(this);' >No</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If irregular, elaborate</td><td>";
    echo form_error('pulse_regular_spec');
    echo "\n<input type='text' name='pulse_regular_spec' value='".set_value('pulse_regular_spec',$init_pulse_regular_spec)."' size='80'";
    if(empty($init_pulse_regular_spec) && $init_pulse_regular<>'No'){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";

    echo "\n<tr><td><strong>Volume</strong></td><td>";
    echo form_error('pulse_volume');
    echo "\n<input type='radio' name='pulse_volume' value='Normal' ".($init_pulse_volume=='Normal'?"checked='checked'":"")." onClick='checkPulseVolume(this);' >Normal</input>";
    echo "\n<input type='radio' name='pulse_volume' value='Abnormal' ".($init_pulse_volume=='Abnormal'?"checked='checked'":"")." onClick='checkPulseVolume(this);' >Abnormal</input>";
    //echo "\n<input type='radio' name='pulse_volume' value='Normal' ".set_radio('pulse_volume','Normal',($init_pulse_volume=='Normal'?TRUE:FALSE))." onClick='checkPulseVolume(this);' >Normal</input>";
    //echo "\n<input type='radio' name='pulse_volume' value='Abnormal' ".set_radio('pulse_volume','Abnormal',($init_pulse_volume=='Abnormal'?TRUE:FALSE))." onClick='checkPulseVolume(this);' >Abnormal</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If abnormal, elaborate</td><td>";
    echo form_error('pulse_volume_spec');
    echo "\n<input type='text' name='pulse_volume_spec' value='".set_value('pulse_volume_spec',$init_pulse_volume_spec)."' size='80'";
    if(empty($init_pulse_volume_spec) && $init_pulse_volume<>"Abnormal"){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";

    echo "\n<tr><td><strong>Heart rhythm</strong></td><td>";
    echo form_error('heart_rhythm');
    echo "\n<input type='radio' name='heart_rhythm' value='Regular' ".($init_heart_rhythm=='Regular'?"checked='checked'":"")." onClick='checkPulseRythm(this);' >Regular</input>";
    echo "\n<input type='radio' name='heart_rhythm' value='Irregular' ".($init_heart_rhythm=='Irregular'?"checked='checked'":"")." onClick='checkPulseRythm(this);' >Irregular</input>";
    //echo "\n<input type='radio' name='heart_rhythm' value='Regular' ".set_radio('heart_rhythm','Regular',($init_heart_rhythm=='Regular'?TRUE:FALSE))." onClick='checkPulseRythm(this);' >Regular</input>";
    //echo "\n<input type='radio' name='heart_rhythm' value='Irregular' ".set_radio('heart_rhythm','Irregular',($init_heart_rhythm=='Irregular'?TRUE:FALSE))." onClick='checkPulseRythm(this);' >Irregular</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If irregular, elaborate</td><td>";
    echo form_error('heart_rhythm_spec');
    echo "\n<input type='text' name='heart_rhythm_spec' value='".set_value('heart_rhythm_spec',$init_heart_rhythm_spec)."' size='80'";
    if(empty($init_heart_rhythm_spec) && $init_heart_rhythm<>"Irregular"){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";

    echo "\n<tr><td><strong>Heart murmur</strong></td><td>";
    echo form_error('heart_murmur');
    echo "\n<input type='radio' name='heart_murmur' value='Absent' ".($init_heart_murmur=='Absent'?"checked='checked'":"")." onClick='checkPulseMurmur(this);' >Absent</input>";
    echo "\n<input type='radio' name='heart_murmur' value='Present' ".($init_heart_murmur=='Present'?"checked='checked'":"")." onClick='checkPulseMurmur(this);' >Present</input>";
    //echo "\n<input type='radio' name='heart_murmur' value='Absent' ".set_radio('heart_murmur','Absent',($init_heart_murmur=='Absent'?TRUE:FALSE))." onClick='checkPulseMurmur(this);' >Absent</input>";
    //echo "\n<input type='radio' name='heart_murmur' value='Present' ".set_radio('heart_murmur','Present',($init_heart_murmur=='Present'?TRUE:FALSE))." onClick='checkPulseMurmur(this);' >Present</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If present, elaborate</td><td>";
    echo form_error('heart_murmur_spec');
    echo "\n<input type='text' name='heart_murmur_spec' value='".set_value('heart_murmur_spec',$init_heart_murmur_spec)."' size='80'";
    if(empty($init_heart_murmur_spec) && $init_heart_murmur<>"Present"){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";

echo "\n</table>";
echo "\n</fieldset>";
echo "\n</td></tr>";

echo "\n<tr><td>";
echo "\n<fieldset>";
echo "<legend>Respiratory System</legend>";
echo "\n<table>";
    echo "\n<tr><td width='250'><strong>Clear lungs</strong></td><td>";
    echo form_error('lung_clear');
    echo "\n<input type='radio' name='lung_clear' value='Yes' ".($init_lung_clear=='Yes'?"checked='checked'":"")." onClick='checkRespiratoryLungs(this);' >Yes</input>";
    echo "\n<input type='radio' name='lung_clear' value='No' ".($init_lung_clear=='No'?"checked='checked'":"")." onClick='checkRespiratoryLungs(this);' >No</input>";
    //echo "\n<input type='radio' name='lung_clear' value='Yes' ".set_radio('lung_clear','Yes',($init_lung_clear=='Yes'?TRUE:FALSE))." onClick='checkRespiratoryLungs(this);' >Yes</input>";
    //echo "\n<input type='radio' name='lung_clear' value='No' ".set_radio('lung_clear','No',($init_lung_clear=='No'?TRUE:FALSE))." onClick='checkRespiratoryLungs(this);' >No</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If not clear, elaborate</td><td>";
    echo form_error('lung_clear_spec');
    echo "\n<input type='text' name='lung_clear_spec' value='".set_value('lung_clear_spec',$init_lung_clear_spec)."' size='80'";
    if(empty($init_lung_clear_spec) && $init_lung_clear<>"No"){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";

    echo "\n<tr><td><strong>Chest (inhale)</strong></td><td>";
    echo form_error('chest_measurement_in');
    echo "\n<input type='text' name='chest_measurement_in' value='".set_value('chest_measurement_in',$init_chest_measurement_in)."' size='6' /> cm</td></tr>";

    echo "\n<tr><td><strong>Chest (exhale)</strong></td><td>";
    echo form_error('chest_measurement_out');
    echo "\n<input type='text' name='chest_measurement_out' value='".set_value('chest_measurement_out',$init_chest_measurement_out)."' size='6' /> cm</td></tr>";

    echo "\n<tr><td><strong>Percussion</strong></td><td>";
    echo form_error('percussion');
    echo "\n<input type='radio' name='percussion' value='Normal' ".($init_percussion=='Normal'?"checked='checked'":"")." onClick='checkRespiratoryPercussion(this);' >Normal</input>";
    echo "\n<input type='radio' name='percussion' value='Abnormal' ".($init_percussion=='Abnormal'?"checked='checked'":"")." onClick='checkRespiratoryPercussion(this);' >Abnormal</input>";
    //echo "\n<input type='radio' name='percussion' value='Normal' ".set_radio('percussion','Normal',($init_percussion=='Normal'?TRUE:FALSE))." onClick='checkRespiratoryPercussion(this);' >Normal</input>";
    //echo "\n<input type='radio' name='percussion' value='Abnormal' ".set_radio('percussion','Abnormal',($init_percussion=='Abnormal'?TRUE:FALSE))." onClick='checkRespiratoryPercussion(this);' >Abnormal</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If abnormal, elaborate</td><td>";
    echo form_error('percussion_spec');
    echo "\n<input type='text' name='percussion_spec' value='".set_value('percussion_spec',$init_percussion_spec)."' size='80'";
    if(empty($init_percussion_spec) && $init_percussion<>"Abnormal"){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";

    echo "\n<tr><td><strong>Abdominal girth</strong></td><td>";
    echo form_error('abdominal_girth');
    echo "\n<input type='text' name='abdominal_girth' value='".set_value('abdominal_girth',$init_abdominal_girth)."' size='6' /> cm</td></tr>";

echo "\n</table>";
echo "\n</fieldset>";
echo "\n</td></tr>";


echo "\n<tr><td>";
echo "\n<fieldset>";
echo "<legend>Breasts</legend>";
echo "\n<table>";
    echo "\n<tr><td width='250'><strong>Breasts exam</strong></td><td>";
    echo form_error('breasts');
    echo "\n<input type='radio' name='breasts' value='Normal' ".($init_breasts=='Normal'?"checked='checked'":"")." onClick='checkBreasts(this);' >Normal</input>";
    echo "\n<input type='radio' name='breasts' value='Abnormal' ".($init_breasts=='Abnormal'?"checked='checked'":"")." onClick='checkBreasts(this);' >Abnormal</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If not normal, elaborate</td><td>";
    echo form_error('breasts_spec');
    echo "\n<input type='text' name='breasts_spec' value='".set_value('breasts_spec',$init_breasts_spec)."' size='80'";
    if(empty($init_breasts_spec) && $init_breasts<>"Abnormal"){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";
echo "\n</table>";
echo "\n</fieldset>";
echo "\n</td></tr>";


echo "\n<tr><td>";
echo "\n<fieldset>";
echo "<legend>Abdomen</legend>";
echo "\n<table>";
    echo "\n<tr><td width='250'><strong>Liver palpable</strong></td><td>";
    echo form_error('liver_palpable');
    echo "\n<input type='radio' name='liver_palpable' value='No' ".($init_liver_palpable=='No'?"checked='checked'":"")." onClick='checkLiver(this);' >No</input>";
    echo "\n<input type='radio' name='liver_palpable' value='Yes' ".($init_liver_palpable=='Yes'?"checked='checked'":"")." onClick='checkLiver(this);' >Yes</input>";
    //echo "\n<input type='radio' name='liver_palpable' value='No' ".set_radio('liver_palpable','No',($init_liver_palpable=='No'?TRUE:FALSE))." onClick='checkLiver(this);' >No</input>";
    //echo "\n<input type='radio' name='liver_palpable' value='Yes' ".set_radio('liver_palpable','Yes',($init_liver_palpable=='Yes'?TRUE:FALSE))." onClick='checkLiver(this);' >Yes</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If palpable, elaborate</td><td>";
    echo form_error('liver_palpable_spec');
    echo "\n<input type='text' name='liver_palpable_spec' value='".set_value('liver_palpable_spec',$init_liver_palpable_spec)."' size='80'";
    if(empty($init_liver_palpable_spec) && $init_liver_palpable<>"Yes"){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";

    echo "\n<tr><td><strong>Spleen palpable</strong></td><td>";
    echo form_error('spleen_palpable');
    echo "\n<input type='radio' name='spleen_palpable' value='No' ".($init_spleen_palpable=='No'?"checked='checked'":"")." onClick='checkSpleen(this);' >No</input>";
    echo "\n<input type='radio' name='spleen_palpable' value='Yes' ".($init_spleen_palpable=='Yes'?"checked='checked'":"")." onClick='checkSpleen(this);' >Yes</input>";
    //echo "\n<input type='radio' name='spleen_palpable' value='No' ".set_radio('spleen_palpable','No',($init_spleen_palpable=='No'?TRUE:FALSE))." onClick='checkSpleen(this);' >No</input>";
    //echo "\n<input type='radio' name='spleen_palpable' value='Yes' ".set_radio('spleen_palpable','Yes',($init_spleen_palpable=='Yes'?TRUE:FALSE))." onClick='checkSpleen(this);' >Yes</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If palpable, elaborate</td><td>";
    echo form_error('spleen_palpable_spec');
    echo "\n<input type='text' name='spleen_palpable_spec' value='".set_value('spleen_palpable_spec',$init_spleen_palpable_spec)."' size='80'";
    if(empty($init_spleen_palpable_spec) && $init_spleen_palpable<>"Yes"){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";

    echo "\n<tr><td><strong>Kidney palpable</strong></td><td>";
    echo form_error('kidney_palpable');
    echo "\n<input type='radio' name='kidney_palpable' value='No' ".($init_kidney_palpable=='No'?"checked='checked'":"")." onClick='checkKidney(this);' >No</input>";
    echo "\n<input type='radio' name='kidney_palpable' value='Yes' ".($init_kidney_palpable=='Yes'?"checked='checked'":"")." onClick='checkKidney(this);' >Yes</input>";
    //echo "\n<input type='radio' name='kidney_palpable' value='No' ".set_radio('kidney_palpable','No',($init_kidney_palpable=='No'?TRUE:FALSE))." onClick='checkKidney(this);' >No</input>";
    //echo "\n<input type='radio' name='kidney_palpable' value='Yes' ".set_radio('kidney_palpable','Yes',($init_kidney_palpable=='Yes'?TRUE:FALSE))." onClick='checkKidney(this);' >Yes</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If palpable, elaborate</td><td>";
    echo form_error('kidney_palpable_spec');
    echo "\n<input type='text' name='kidney_palpable_spec' value='".set_value('kidney_palpable_spec',$init_kidney_palpable_spec)."' size='80'";
    if(empty($init_kidney_palpable_spec) && $init_kidney_palpable<>"Yes"){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";

    echo "\n<tr><td><strong>External genitalia</strong></td><td>";
    echo form_error('external_genitalia');
    echo "\n<input type='radio' name='external_genitalia' value='Normal' ".($init_external_genitalia=='Normal'?"checked='checked'":"")." onClick='checkGenitalia(this);' >Normal</input>";
    echo "\n<input type='radio' name='external_genitalia' value='Abnormal' ".($init_external_genitalia=='Abnormal'?"checked='checked'":"")." onClick='checkGenitalia(this);' >Abnormal</input>";
    //echo "\n<input type='radio' name='external_genitalia' value='Normal' ".set_radio('external_genitalia','Normal',($init_external_genitalia=='Normal'?TRUE:FALSE))." onClick='checkGenitalia(this);' >Normal</input>";
    //echo "\n<input type='radio' name='external_genitalia' value='Abnormal' ".set_radio('external_genitalia','Abnormal',($init_external_genitalia=='Abnormal'?TRUE:FALSE))." onClick='checkGenitalia(this);' >Abnormal</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If abnormal, elaborate</td><td>";
    echo form_error('external_genitalia_spec');
    echo "\n<input type='text' name='external_genitalia_spec' value='".set_value('external_genitalia_spec',$init_external_genitalia_spec)."' size='80'";
    if(empty($init_external_genitalia_spec) && $init_external_genitalia<>"Abnormal"){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";

    echo "\n<tr><td><strong>Perectal exam</strong></td><td>";
    echo form_error('perectal_exam');
    echo "\n<input type='text' name='perectal_exam' value='".set_value('perectal_exam',$init_perectal_exam)."' size='80' /></td></tr>";

    echo "\n<tr><td><strong>Hernial orifices intact</strong></td><td>";
    echo form_error('hernial_orifices');
    echo "\n<input type='radio' name='hernial_orifices' value='Yes' ".($init_hernial_orifices=='Yes'?"checked='checked'":"")." onClick='checkHernial(this);' >Yes</input>";
    echo "\n<input type='radio' name='hernial_orifices' value='No' ".($init_hernial_orifices=='No'?"checked='checked'":"")." onClick='checkHernial(this);' >No</input>";
    //echo "\n<input type='radio' name='hernial_orifices' value='Yes' ".set_radio('hernial_orifices','Yes',($init_hernial_orifices=='Yes'?TRUE:FALSE))." onClick='checkHernial(this);' >Yes</input>";
    //echo "\n<input type='radio' name='hernial_orifices' value='No' ".set_radio('hernial_orifices','No',($init_hernial_orifices=='No'?TRUE:FALSE))." onClick='checkHernial(this);' >No</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td>If not, elaborate</td><td>";
    echo form_error('hernial_orifices_spec');
    echo "\n<input type='text' name='hernial_orifices_spec' value='".set_value('hernial_orifices_spec',$init_hernial_orifices_spec)."' size='80'";
    if(empty($init_hernial_orifices_spec) && $init_hernial_orifices<>"No"){
        echo " disabled='disabled'";
    }
    echo "/></td></tr>";

echo "\n</table>";
echo "\n</fieldset>";
echo "\n</td></tr>";

echo "\n<tr><td>";
echo "\n<fieldset>";
echo "<legend>Central Nervous System</legend>";
echo "\n<table>";
    echo "\n<tr><td width='250'><strong>Pupils equal</strong></td><td>";
    echo form_error('pupils_equal');
    echo "\n<input type='radio' name='pupils_equal' value='Yes' ".($init_pupils_equal=='Yes'?"checked='checked'":"")."  >Yes</input>";
    echo "\n<input type='radio' name='pupils_equal' value='No' ".($init_pupils_equal=='No'?"checked='checked'":"")."  >No</input>";
    //echo "\n<input type='radio' name='pupils_equal' value='Yes' ".set_radio('pupils_equal','Yes',($init_pupils_equal=='Yes'?TRUE:FALSE))."  >Yes</input>";
    //echo "\n<input type='radio' name='pupils_equal' value='No' ".set_radio('pupils_equal','No',($init_pupils_equal=='No'?TRUE:FALSE))."  >No</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td><strong>Pupils reactive</strong></td><td>";
    echo form_error('pupils_reactive');
    echo "\n<input type='radio' name='pupils_reactive' value='Yes' ".($init_pupils_reactive=='Yes'?"checked='checked'":"")."  >Yes</input>";
    echo "\n<input type='radio' name='pupils_reactive' value='No' ".($init_pupils_reactive=='No'?"checked='checked'":"")."  >No</input>";
    //echo "\n<input type='radio' name='pupils_reactive' value='Yes' ".set_radio('pupils_reactive','Yes',($init_pupils_reactive=='Yes'?TRUE:FALSE))."  >Yes</input>";
    //echo "\n<input type='radio' name='pupils_reactive' value='No' ".set_radio('pupils_reactive','No',($init_pupils_reactive=='No'?TRUE:FALSE))."  >No</input>";
    echo "\n</td></tr>";

    echo "\n<tr><td><strong>Reflexes</strong></td><td>";
    echo form_error('reflexes');
    echo "\n<input type='radio' name='reflexes' value='Normal' ".($init_reflexes=='Normal'?"checked='checked'":"")."  >Normal</input>";
    echo "\n<input type='radio' name='reflexes' value='Abnormal' ".($init_reflexes=='Abnormal'?"checked='checked'":"")."  >Abnormal</input>";
    //echo "\n<input type='radio' name='reflexes' value='Normal' ".set_radio('reflexes','Normal',($init_reflexes=='Normal'?TRUE:FALSE))."  >Normal</input>";
    //echo "\n<input type='radio' name='reflexes' value='Abnormal' ".set_radio('reflexes','Abnormal',($init_reflexes=='Abnormal'?TRUE:FALSE))."  >Abnormal</input>";
    echo "\n</td></tr>";

echo "\n</table>";
echo "\n</fieldset>";
echo "\n</td></tr>";

echo "\n<table>";
echo "\n<tr><td valign='top' width='200'><strong>Notes</strong> <font color='red'>*</font></td><td>";
echo form_error('notes');
//echo "\n<input type='text' name='notes' value='".set_value('notes',$init_notes)."' size='10' /></td></tr>";
echo "\n<textarea class='normal' name='notes' id='notes' cols='80' rows='7'>".$init_notes."</textarea></td></tr>";
echo "\n</table>";


echo "\n</table>\n";
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('physical_exam_id', $physical_exam_id);

echo "<div align='center'><br />";
echo "\n<input type='submit' value='Save' />";
echo "</div>";

echo "\n</form>";

?>
 <script language="JavaScript">
      function checkPulseRegular(obj)
      {
         txt1 = obj.value;

         if (txt1 == "Yes")
         {
            document.form.pulse_regular_spec.disabled = true;
            //document.form.pulse_regular_spec.value = "";
            document.form.pulse_regular_spec.style.backgroundColor="#DDEEDD";
         }
         else
         {
            document.form.pulse_regular_spec.disabled = false;
            document.form.pulse_regular_spec.style.backgroundColor="#FFFFEE";
         }

         return true;
      }

      function checkPulseVolume(obj)
      {
         txt1 = obj.value;

         if (txt1 == "Normal")
         {
            document.form.pulse_volume_spec.disabled = true;
            //document.form.pulse_volume_spec.value = "";
            document.form.pulse_volume_spec.style.backgroundColor="#DDEEDD";
         }
         else
         {
            document.form.pulse_volume_spec.disabled = false;
            document.form.pulse_volume_spec.style.backgroundColor="#FFFFEE";
         }

         return true;
      }

      function checkPulseRythm(obj)
      {
         txt1 = obj.value;

         if (txt1 == "Regular")
         {
            document.form.heart_rhythm_spec.disabled = true;
            //document.form.heart_rhythm_spec.value = "";
            document.form.heart_rhythm_spec.style.backgroundColor="#DDEEDD";
         }
         else
         {
            document.form.heart_rhythm_spec.disabled = false;
            document.form.heart_rhythm_spec.style.backgroundColor="#FFFFEE";
         }

         return true;
      }

      function checkPulseMurmur(obj)
      {
         txt1 = obj.value;

         if (txt1 == "Present")
         {
            document.form.heart_murmur_spec.disabled = false;
            document.form.heart_murmur_spec.style.backgroundColor="#FFFFEE";
         }
         else
         {
            document.form.heart_murmur_spec.disabled = true;
            //document.form.heart_murmur_spec.value = "";
            document.form.heart_murmur_spec.style.backgroundColor="#DDEEDD";
         }

         return true;
      }

      function checkRespiratoryLungs(obj)
      {
         txt1 = obj.value;

         if (txt1 == "Yes")
         {
            document.form.lung_clear_spec.disabled = true;
            //document.form.lung_clear_spec.value = "";
            document.form.lung_clear_spec.style.backgroundColor="#DDEEDD";
         }
         else
         {
            document.form.lung_clear_spec.disabled = false;
            document.form.lung_clear_spec.style.backgroundColor="#FFFFEE";
         }

         return true;
      }

      function checkRespiratoryPercussion(obj)
      {
         txt1 = obj.value;

         if (txt1 == "Normal")
         {
            document.form.percussion_spec.disabled = true;
            //document.form.percussion_spec.value = "";
            document.form.percussion_spec.style.backgroundColor="#DDEEDD";
         }
         else
         {
            document.form.percussion_spec.disabled = false;
            document.form.percussion_spec.style.backgroundColor="#FFFFEE";
         }

         return true;
      }

      function checkBreasts(obj)
      {
         txt1 = obj.value;

         if (txt1 == "Normal")
         {
            document.form.breasts_spec.disabled = true;
            //document.form.lung_clear_spec.value = "";
            document.form.breasts_spec.style.backgroundColor="#DDEEDD";
         }
         else
         {
            document.form.breasts_spec.disabled = false;
            document.form.breasts_spec.style.backgroundColor="#FFFFEE";
         }

         return true;
      }

      function checkLiver(obj)
      {
         txt1 = obj.value;

         if (txt1 == "No")
         {
            document.form.liver_palpable_spec.disabled = true;
            //document.form.liver_palpable_spec.value = "";
            document.form.liver_palpable_spec.style.backgroundColor="#DDEEDD";
         }
         else
         {
            document.form.liver_palpable_spec.disabled = false;
            document.form.liver_palpable_spec.style.backgroundColor="#FFFFEE";
         }

         return true;
      }

      function checkSpleen(obj)
      {
         txt1 = obj.value;

         if (txt1 == "No")
         {
            document.form.spleen_palpable_spec.disabled = true;
            //document.form.spleen_palpable_spec.value = "";
            document.form.spleen_palpable_spec.style.backgroundColor="#DDEEDD";
         }
         else
         {
            document.form.spleen_palpable_spec.disabled = false;
            document.form.spleen_palpable_spec.style.backgroundColor="#FFFFEE";
         }

         return true;
      }

      function checkKidney(obj)
      {
         txt1 = obj.value;

         if (txt1 == "No")
         {
            document.form.kidney_palpable_spec.disabled = true;
            //document.form.kidney_palpable_spec.value = "";
            document.form.kidney_palpable_spec.style.backgroundColor="#DDEEDD";
         }
         else
         {
            document.form.kidney_palpable_spec.disabled = false;
            document.form.kidney_palpable_spec.style.backgroundColor="#FFFFEE";
         }

         return true;
      }

      function checkGenitalia(obj)
      {
         txt1 = obj.value;

         if (txt1 == "Normal")
         {
            document.form.external_genitalia_spec.disabled = true;
            //document.form.external_genitalia_spec.value = "";
            document.form.external_genitalia_spec.style.backgroundColor="#DDEEDD";
         }
         else
         {
            document.form.external_genitalia_spec.disabled = false;
            document.form.external_genitalia_spec.style.backgroundColor="#FFFFEE";
         }

         return true;
      }

      function checkHernial(obj)
      {
         txt1 = obj.value;

         if (txt1 == "Yes")
         {
            document.form.hernial_orifices_spec.disabled = true;
            //document.form.hernial_orifices_spec.value = "";
            document.form.hernial_orifices_spec.style.backgroundColor="#DDEEDD";
         }
         else
         {
            document.form.hernial_orifices_spec.disabled = false;
            document.form.hernial_orifices_spec.style.backgroundColor="#FFFFEE";
         }

         return true;
      }

   </script>


