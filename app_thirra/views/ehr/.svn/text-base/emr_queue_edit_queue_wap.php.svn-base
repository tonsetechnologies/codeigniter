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

include_once("header_xhtml1-strict.php");
//include_once("header_xhtml1-transitional.php");

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
		//print_r($patient_info);
    echo "\n<br />print_r(queue_info)=<br />";
		print_r($queue_info);
    echo "\n<br />print_r(patients_list)=<br />";
		print_r($patients_list);
	echo '</pre>';
    echo "\n</div";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('queue_edit_queue_html_title')."</h1></div>";

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<h2>".$save_attempt."</h2>";
echo form_open('ehr_queue/queue_edit_queue/edit_queue/'.$patient_id);
echo "\n<table>";

echo "\n<tr><td>Queue Date<font color='red'>*</font></td><td>";
echo form_error('queue_date');
echo "\n<input type='text' name='queue_date' value='".set_value('queue_date',$init_queue_date)."' size='8' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Start Time</td><td>";
echo form_error('start_time');
echo "\n<input type='text' name='start_time' value='".set_value('start_time',$init_start_time)."' size='6' /> hh:mm</td></tr>";

echo "\n<tr><td>Patient Name<font color='red'>*</font></td><td>";
echo form_error('patient_id');
if(isset($patients_list) && (count($patients_list) > 1)) {
    echo "\n<select name='patient_id' class='normal' id='patient_id'>";
        echo "\n<option value='' >Please select one</option>";
        foreach($patients_list as $patient)
        {
            echo "\n<option value='".$patient['patient_id']."' ";
            if(isset($patient_id)) {
                echo ($patient_id==$patient['patient_id'] ? " selected='selected'" : "");
            }
            echo ">".$patient['name'].", ".$patient['name_first']." - ".$patient['birth_date']."</option>";
        } //foreach
    echo "\n</select>";
} else {
    echo $init_name." [".$init_gender."] ".$init_birth_date;
    echo form_hidden('patient_id', $patient_id);
} //endif
echo "</td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Consultant<font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo form_error('staff_id');
        echo "\n<select name='staff_id' class='normal' id='staff'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($staff_list as $person)
            {
	            echo "\n<option value='".$person['staff_id']."' ";
                if(isset($init_staff_id)) {
                    echo ($init_staff_id==$person['staff_id'] ? " selected='selected'" : "");
                }
                echo ">".$person['staff_name']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Room<font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo form_error('room_id');
        echo "\n<select name='room_id' class='normal' id='room_id'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($rooms_list as $room)
            {
	            echo "\n<option value='".$room['room_id']."' ";
                if(isset($init_room_id)) {
                    echo ($init_room_id==$room['room_id'] ? " selected='selected'" : "");
                }
                echo ">".$room['name']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Priority</td><td>";
echo form_error('priority');
    echo "\n<select name='priority'>";
     echo "\n<option value='Regular' ".($init_priority=='Regular'?' selected=\'selected\'':'').">Regular</option>";
    echo "\n<option value='Urgent' ".($init_priority=='Urgent'?' selected=\'selected\'':'').">Urgent</option>";
    echo "\n<option value='Appointmt.' ".($init_priority=='Appointmnt.'?' selected=\'selected\'':'').">Appointment</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>External Ref.</td><td>";
echo form_error('external_ref');
echo "\n<input type='text' name='external_ref' value='".set_value('remarks',$init_external_ref)."' size='20' /></td></tr>";

echo "\n<tr><td>Remarks</td><td>";
echo form_error('remarks');
echo "\n<input type='text' name='remarks' value='".set_value('remarks',$init_remarks)."' size='80' /></td></tr>";

echo "</table>";
echo form_hidden('now_id', $now_id);
echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('booking_id', $booking_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Save' />";
echo "</div>";

echo "</form>";

echo "</div>";

