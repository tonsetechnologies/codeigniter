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

echo "\n<body>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />social_history_id = " . $social_history_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(history_info)=<br />";
		print_r($history_info);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

if($form_purpose == 'edit_history'){
    $editable = " disabled='disabled' ";
    // Still need to pass data to server
    echo form_hidden('record_date', $init_record_date);
} else {
    $editable = " ";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_history_social_html_title')."</h1></div>";


//echo validation_errors(); Displays ALL errors in one place.
$attributes =   array('class' => 'select_form', 'id' => 'form', 'name' => 'form');
echo form_open('ehr_individual_history/edit_history_social/'.$patient_id.'/'.$form_purpose.'/'.$social_history_id, $attributes);

echo "<fieldset>";
echo "<legend>History Info</legend>";
echo "\n<table>";
echo "\n<tr><td width='250'>History Taken Date <font color='red'>*</font></td><td>";
echo form_error('record_date');
if($form_purpose == 'edit_history'){
    echo form_hidden('record_date', $init_record_date);
    echo $init_record_date."</td></tr>";
} else {
    echo "\n<input type='text' name='record_date' value='".set_value('record_date',$init_record_date)."' size='8' ".$editable."/></td></tr>";
}

echo "\n<tr><td><strong>Safety belt use</strong></td><td>";
echo form_error('safety_belt_use');
echo "\n<select class='normal' name='safety_belt_use' id='safety_belt_use' >";          
    echo "\n<option value=' ' ".($init_safety_belt_use==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='Yes' ".($init_safety_belt_use=='Yes'?"selected='selected'":"").">Yes</option>";
    echo "\n<option value='No' ".($init_safety_belt_use=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='NA' ".($init_safety_belt_use=='NA'?"selected='selected'":"").">Not applicable</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td><strong>Helmet use</strong></td><td>";
echo form_error('helmet_use');
echo "\n<select class='normal' name='helmet_use' id='helmet_use' >";          
    echo "\n<option value=' ' ".($init_helmet_use==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='Yes' ".($init_helmet_use=='Yes'?"selected='selected'":"").">Yes</option>";
    echo "\n<option value='No' ".($init_helmet_use=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='NA' ".($init_helmet_use=='NA'?"selected='selected'":"").">Not applicable</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td><strong>Drugs</strong></td><td>";
echo form_error('drugs_use');
echo "\n<select class='normal' name='drugs_use' id='drugs_use' onChange='checkDrugUse(this);'>";          
    echo "\n<option value=' ' ".set_select('drugs_use','Choose').">Choose</option>";
    echo "\n<option value='Yes' ".set_select('drugs_use','Yes').">Yes</option>";
    echo "\n<option value='No' ".set_select('drugs_use','No').">No</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>If yes, specify</td><td>";
echo form_error('drugs_spec');
echo "<input type='text' name='drugs_spec' value='".set_value('drugs_spec',$init_drugs_spec)."' size='100' disabled='disabled' /></td></tr>";

echo "\n<tr><td><strong>Alcohol</strong></td><td>";
echo form_error('alcohol_use');
echo "\n<select class='normal' name='alcohol_use' id='alcohol_use' onChange='checkAlcoholUse(this);'>";          
    echo "\n<option value=' ' ".($init_alcohol_use==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='Yes' ".($init_alcohol_use=='Yes'?"selected='selected'":"").">Yes</option>";
    echo "\n<option value='No' ".($init_alcohol_use=='No'?"selected='selected'":"").">No</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Average amount per day</td><td>";
echo form_error('alcohol_spec');
echo "<input type='text' name='alcohol_spec' value='".set_value('alcohol_spec',$init_alcohol_spec)."' size='10' disabled='disabled' /></td></tr>";

echo "\n<tr><td><strong>Tobacco</strong></td><td>";
echo form_error('tobacco_use');
echo "\n<select class='normal' name='tobacco_use' id='tobacco_use' onChange='checkTobaccoUse(this);'>";          
    echo "\n<option value=' ' ".($init_tobacco_use==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='Yes' ".($init_tobacco_use=='Yes'?"selected='selected'":"").">Yes</option>";
    echo "\n<option value='No' ".($init_tobacco_use=='No'?"selected='selected'":"").">No</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Average sticks per day</td><td>";
echo form_error('tobacco_spec');
echo "<input type='text' name='tobacco_spec' value='".set_value('tobacco_spec',$init_tobacco_spec)."' size='10' disabled='disabled' /></td></tr>";

echo "\n<tr><td><strong>Exercise</strong></td><td>";
echo form_error('exercise_use');
echo "\n<select class='normal' name='exercise_use' id='exercise_use' onChange='checkExercise(this);'>";          
    echo "\n<option value=' ' ".($init_exercise_use==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='Yes' ".($init_exercise_use=='Yes'?"selected='selected'":"").">Yes</option>";
    echo "\n<option value='No' ".($init_exercise_use=='No'?"selected='selected'":"").">No</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Average hours per week</td><td>";
echo form_error('exercise_spec');
echo "<input type='text' name='exercise_spec' value='".set_value('exercise_spec',$init_exercise_spec)."' size='10' disabled='disabled' /></td></tr>";

echo "\n<tr><td><strong>Trauma</strong></td><td>";
echo form_error('trauma');
echo "<input type='text' name='trauma' value='".set_value('room_trauma',$init_trauma)."' size='10' /></td></tr>";

echo "\n<tr><td><strong>Hospitalizations</strong></td><td>";
echo form_error('hospitalizations');
echo "<input type='text' name='hospitalizations' value='".set_value('hospitalizations',$init_hospitalizations)."' size='100' /></td></tr>";

echo "\n<tr><td><strong>Illnesses</strong></td><td>";
echo form_error('illness');
echo "<input type='text' name='illness' value='".set_value('illness',$init_illness)."' size='10' /></td></tr>";

echo "\n<tr><td><strong>Operations</strong></td><td>";
echo form_error('operation');
echo "<input type='text' name='operation' value='".set_value('operation',$init_operation)."' size='100' /></td></tr>";

echo "\n<tr><td><strong>Family income</strong></td><td>";
echo form_error('family_income');
echo "<input type='text' name='family_income' value='".set_value('family_income',$init_family_income)."' size='10' /></td></tr>";

echo "\n<tr><td><strong>Remarks</strong><td>";
echo form_error('remarks');
echo "<input type='text' name='remarks' value='".set_value('remarks',$init_remarks)."' size='80' /></td></tr>";

echo "\n</table>";
echo "</fieldset>";


echo form_hidden('now_id', $now_id);
echo form_hidden('social_history_id', $social_history_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Add/Edit History' />";
echo "</div>";

echo "</form>";

echo "\n<fieldset>";
echo "<legend>HISTORIES RECORDED</legend>";
echo "\n<br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Reading Date</th>";
    echo "\n<th width='150'>staff</th>";
    echo "\n<th width='150'>Drugs</th>";
    echo "\n<th width='150'>Alcohol</th>";
    echo "\n<th width='150'>Tobacco</th>";
echo "</tr>";
if(isset($history_list)){
    $rownum = 1;
    foreach ($history_list as $history_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('ehr_individual/edit_history_social/'.$patient_id.'/edit_history/'.$history_item['social_history_id'], "<strong>".$history_item['date']."</strong>")."</td>";
        echo "\n<td>".$history_item['staff_id']."</td>";
        echo "\n<td>".$history_item['drugs_use']."</td>";
        echo "\n<td>".$history_item['alcohol_use']."</td>";
        echo "\n<td>".$history_item['tobacco_use']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


echo "</div>"; //id=content

?>
   <script language="JavaScript">

      function checkGenitalia(obj)
      {
         txt1 = obj.value;

         if (txt1 == "Normal")
         {
            document.form.external_genitalia_spec.disabled = true;
            document.form.external_genitalia_spec.value = "";
            document.form.external_genitalia_spec.style.backgroundColor="#AFCCBD";
         }
         else
         {
            document.form.external_genitalia_spec.disabled = false;
            document.form.external_genitalia_spec.style.backgroundColor="#EFFFD6";
         }

         return true;
      }

      function checkDrugUse(obj)
      {
         txt1 = obj.value;
         if (txt1  != "Yes") 
         {
            document.form.drugs_spec.disabled = true;
            document.form.drugs_spec.value = "";
            document.form.drugs_spec.style.backgroundColor="#CCCCCC";
         }
         else {
            document.form.drugs_spec.disabled = false;
            document.form.drugs_spec.style.backgroundColor="#FFEEEE";
         }

         return true;
      }


      function checkAlcoholUse(obj)
      {
         txt1 = obj.value;
         if (txt1  != "Yes") 
         {
            document.form.alcohol_spec.disabled = true;
            document.form.alcohol_spec.value = "";
            document.form.alcohol_spec.style.backgroundColor="#CCCCCC";
         }
         else {
            document.form.alcohol_spec.disabled = false;
            document.form.alcohol_spec.style.backgroundColor="#FFEEEE";
         }

         return true;
      }


      function checkTobaccoUse(obj)
      {
         txt1 = obj.value;
         if (txt1  != "Yes") 
         {
            document.form.tobacco_spec.disabled = true;
            document.form.tobacco_spec.value = "";
            document.form.tobacco_spec.style.backgroundColor="#CCCCCC";
         }
         else {
            document.form.tobacco_spec.disabled = false;
            document.form.tobacco_spec.style.backgroundColor="#FFEEEE";
         }

         return true;
      }


      function checkExercise(obj)
      {
         txt1 = obj.value;
         if (txt1  != "Yes") 
         {
            document.form.exercise_spec.disabled = true;
            document.form.exercise_spec.value = "";
            document.form.exercise_spec.style.backgroundColor="#CCCCCC";
         }
         else {
            document.form.exercise_spec.disabled = false;
            document.form.exercise_spec.style.backgroundColor="#FFEEEE";
         }

         return true;
      }
   </script>


