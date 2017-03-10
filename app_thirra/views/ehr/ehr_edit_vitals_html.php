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
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

//include_once("header_xhtml1-strict.php");
//include_once("header_xhtml1-transitional.php");

//echo "\n<body>";
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
		print_r($patient_info);
		print_r($patcon_info);
		print_r($vitals_info);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_vitals_html_title')."</h1></div>";

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<h2>".$save_attempt."</h2>";
$attributes =   array('class' => 'select_form', 'id' => 'vitals_form');
echo form_open('ehr_consult/edit_vitals/edit_vitals/'.$patient_id.'/'.$summary_id, $attributes);
echo "\n<table>";
echo "\n<tr><td>Temperature</td><td>";
echo form_error('temperature');
echo "\n<input type='text' name='temperature' value='".set_value('temperature',$init_temperature)."' size='5' /> &deg;C</td></tr>";

echo "\n<tr><td>Pulse rate</td><td>";
echo form_error('pulse_rate');
echo "<input type='text' name='pulse_rate' value='".set_value('pulse_rate',$init_pulse_rate)."' size='5' /> times per minute</td></tr>";

echo "\n<tr><td>BP systolic</td><td>";
echo form_error('bp_systolic');
echo "<input type='text' name='bp_systolic' value='".set_value('bp_systolic',$init_bp_systolic)."' size='5' /> mm Hg</td></tr>";

echo "\n<tr><td>BP diastolic</td><td>";
echo form_error('bp_diastolic');
echo "<input type='text' name='bp_diastolic' value='".set_value('bp_diastolic',$init_bp_diastolic)."' size='5' /> mm Hg</td></tr>";

echo "\n<tr><td>Respiration rate</td><td>";
echo form_error('respiration_rate');
echo "<input type='text' name='respiration_rate' value='".set_value('respiration_rate',$init_respiration_rate)."' size='5' /> times per minute</td></tr>";

echo "\n<tr><td>Height</td><td>";
echo form_error('height');
echo "<input type='text' name='height' value='".set_value('height',$init_height)."' size='10' id='height' onChange='calculateHeightInch();' /> cm <input class='disabled' name='heightInch' value='' type='text' size='10' id='heightInch' readonly='readonly' onFocus='blur();'> inches</td></tr>";

echo "\n<tr><td>Weight</td><td>";
echo form_error('weight');
echo "<input type='text' name='weight' value='".set_value('weight',$init_weight)."' size='10' id='weight' onChange='calculateBMI();' /> kg</td></tr>";

echo "\n<tr><td>BMI</td><td>";
echo form_error('bmi');
echo "\n<input type='disabled' name='bmi' value='".set_value('bmi',$init_bmi)."' size='5' onFocus='blur();' id='bmi' readonly='readonly' /></td></tr>";

echo "\n<tr><td>Waist circumference</td><td>";
echo form_error('waist_circumference');
echo "\n<input type='text' name='waist_circumference' value='".set_value('waist_circumference',$init_waist_circumference)."' size='5' id='waistCircumference' onChange='calculateWCInch();' /> cm <input class='disabled' name='wcInch' value='' type='text'  size='10' id='wcInch' readonly='readonly' onFocus='blur();'> inches</td></tr>";

echo "\n<tr><td>OFC</td><td>";
echo form_error('ofc');
echo "\n<input type='text' name='ofc' value='".set_value('ofc',$init_ofc)."' size='5' /> cm </td></tr>";

echo "\n<tr><td>Left vision</td><td>";
echo form_error('left_vision');
echo form_error('right_vision');
echo "\n<input type='text' name='left_vision' value='".set_value('left_vision',$init_left_vision)."' size='5' />";
echo " Right vision ";
echo "\n<input type='text' name='right_vision' value='".set_value('right_vision',$init_right_vision)."' size='5' />";
echo "</td></tr>";


echo "\n<tr><td>Remarks</td><td>";
echo form_error('remarks');
echo "\n<input type='text' name='remarks' value='".set_value('remarks',$init_remarks)."' size='80' /></td></tr>";

echo "\n<tr><td>Reading Date</td><td>";
echo form_error('reading_date');
echo "\n<input type='text' name='reading_date' value='".set_value('reading_date',$init_reading_date)."' size='10' id='read_datepicker' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Reading Time</td><td>";
echo form_error('reading_time');
echo "\n<input type='text' name='reading_time' value='".set_value('reading_time',$init_reading_time)."' size='6' /> hh:mm</td></tr>";

echo "</table>";
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('vital_id', $init_vital_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Save' />";
echo "</div>";

echo "</form>";

?>
    <script  type="text/javascript">
    /*
        var $ = function (id) {
            return document.getElementById(id);
        }
    */


    $(function() {
        $( "#read_datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });

    });


      function calculateBMI()
      {
         if (document.getElementById("height").value == '' || document.getElementById("weight").value == '')
            document.getElementById("bmi").value = '';
         else
         {
            var height = Number(document.getElementById("height").value);
            var weight = Number(document.getElementById("weight").value);
            height = height / 100;
            var bmi = Math.round(weight / Math.pow(height, 2));
            document.getElementById("bmi").value = bmi;
         }
      }

      function calculateWCInch()
      {
         if (document.getElementById("waistCircumference").value == '')
            document.getElementById("wcInch").value = '';
         else
         {
            var waistCircumference = Number(document.getElementById("waistCircumference").value);
            var wcInch = waistCircumference * 0.3937008;
            document.getElementById("wcInch").value = wcInch;
         }
      }

      function calculateHeightInch()
      {
         if (document.getElementById("height").value == '')
            document.getElementById("heightInch").value = '';
         else
         {
            var height = Number(document.getElementById("height").value);
            var heightInch = height * 0.3937008;
            document.getElementById("heightInch").value = heightInch;
         }
      }

    window.onload = function() {
        document.getElementById("height").onChange = calculateHeightInch;
        document.getElementById("height").onChange = calculateBMI;
        document.getElementById("weight").onChange = calculateBMI;
        document.getElementById("waistCircumference").onChange = calculateWCInch;
    }
  </script>

