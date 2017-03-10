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

echo "\n\n<div id='content_nosidebar'>";

echo "\n<body>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />user_id = " . $user_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
		print_r($user_info);
    echo "\n<br />print_r(dept_list)=<br />";
		print_r($dept_list);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('queue_edit_room_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n\n<div id='queue_rooms' class='section'>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th width='200'>Room Name</th>";
        echo "\n<th>Department</th>";
        echo "\n<th>Category</th>";
        echo "\n<th>Description</th>";
    echo "</tr>";
    foreach ($rooms_list as $room_item){
        echo "<tr>";
        echo "<td>".anchor('ehr_queue/queue_edit_room/edit_room/'.$room_item['room_id'], $room_item['name'])."</td>";
        echo "<td>".$room_item['dept_shortname']."</td>";
        echo "<td>".$room_item['category_name']."</td>";
        echo "<td>".$room_item['description']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
echo "</div>";


//echo validation_errors(); Displays ALL errors in one place.
echo form_open('ehr_queue/queue_edit_room/'.$form_purpose.'/'.$room_id);

echo "<fieldset>";
echo "<legend>Room Info</legend>";
echo "\n<table>";
echo "\n<tr><td>Room Name <font color='red'>*</font></td><td>";
echo form_error('room_name');
echo "\n<input type='text' name='room_name' value='".set_value('room_name',$init_room_name)."' size='20' /></td></tr>";

echo "\n<tr><td>Room Code</td><td>";
echo form_error('room_code');
echo "<input type='text' name='room_code' value='".set_value('room_code',$init_room_code)."' size='20' /> </td></tr>";

echo "\n<tr><td>Description<td>";
echo form_error('description');
echo "<input type='text' name='description' value='".set_value('description',$init_description)."' size='80' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='200'>Department <font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('clinic_dept_id');
        echo "\n<select name='clinic_dept_id' class='normal' id='clinic_dept_id'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($dept_list as $room_category)
            {
	            echo "\n<option value='".$room_category['clinic_dept_id']."' ";
                if(isset($clinic_dept_id)) {
                    echo ($clinic_dept_id==$room_category['clinic_dept_id'] ? " selected='selected'" : "");
                }
                echo ">".$room_category['dept_name']."&nbsp;-&nbsp;".$room_category['dept_description']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='200'>Room Category <font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('category_id');
        echo "\n<select name='category_id' class='normal' id='category_id'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($category_list as $room_category)
            {
	            echo "\n<option value='".$room_category['category_id']."' ";
                if(isset($category_id)) {
                    echo ($category_id==$room_category['category_id'] ? " selected='selected'" : "");
                }
                echo ">".$room_category['name']."&nbsp;-&nbsp;".$room_category['description']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Room Rate 1</td><td>";
echo form_error('room_rate1');
echo "RM <input type='text' name='room_rate1' value='".set_value('room_rate1',$init_room_rate1)."' size='10' /> /day</td></tr>";

echo "\n<tr><td>Room Rate 2</td><td>";
echo form_error('room_rate2');
echo "RM <input type='text' name='room_rate2' value='".set_value('room_rate2',$init_room_rate2)."' size='10' /> /day</td></tr>";

echo "\n<tr><td>Room Rate 3</td><td>";
echo form_error('room_rate3');
echo "RM <input type='text' name='room_rate3' value='".set_value('room_rate3',$init_room_rate3)."' size='10' /> /day</td></tr>";

echo "\n<tr><td>Room Cost</td><td>";
echo form_error('room_cost');
echo "RM <input type='text' name='room_cost' value='".set_value('room_cost',$init_room_cost)."' size='10' /> /day</td></tr>";

echo "\n<tr><td>No. of beds</td><td>";
echo form_error('beds_qty');
echo "<input type='text' name='beds_qty' value='".set_value('beds_qty',$init_beds_qty)."' size='3' /> </td></tr>";

echo "\n<tr><td>Floor of building</td><td>";
echo form_error('room_floor');
echo "<input type='text' name='room_floor' value='".set_value('room_floor',$init_room_floor)."' size='20' /> </td></tr>";

echo "\n<tr><td>Remarks<td>";
echo form_error('room_remarks');
echo "<input type='text' name='room_remarks' value='".set_value('room_remarks',$init_room_remarks)."' size='80' /></td></tr>";

echo "\n</table>";
echo "</fieldset>";


echo form_hidden('now_id', $now_id);
echo form_hidden('room_id', $room_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Add/Edit Room' />";
echo "</div>";

echo "</form>";

echo "</div>"; //id=content

