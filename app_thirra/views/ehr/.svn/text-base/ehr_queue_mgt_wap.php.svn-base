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
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    echo "\n</div>";
}

echo "\n\n<div align='center'><h1>".$this->lang->line('queue_mgt_html_title')."</h1></div>";

echo "\n\n<div id='queue_queue' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Patients Queue</h2></p>";
	echo "\n<p class='section_body'>";
    echo "<p>";
    echo anchor('ehr_queue/queue_edit_queue/new_queue/patient_id/new_queue', 'Add Patient to Queue');

    echo "</p>";

        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th>Date & Time</th>";
            echo "\n<th width='300'>Patient Name</th>";
            echo "\n<th>Consultant</th>";
            echo "\n<th>Priority</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        foreach ($queue_info as $queue_item){
            echo "<tr>";
            echo "<td>".anchor('ehr_queue/queue_edit_queue/edit_queue/'.$queue_item['patient_id'].'/'.$queue_item['booking_id'], $queue_item['date']." ".$queue_item['start_time'])."</td>";
            echo "<td><strong>".anchor('ehr_queue/individual_overview/'.$queue_item['patient_id'].'/'.$queue_item['booking_id'], $queue_item['name'], "target='_blank'")."</strong></td>";
            echo "<td>".$queue_item['staff_name']."</td>";
            echo "<td>".$queue_item['priority']."</td>";
            echo "<td>".$queue_item['remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='queue_appointments' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Appointments</h2></p>";
	echo "\n<p class='section_body'>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th>Date & Time</th>";
            echo "\n<th width='300'>Patient Name</th>";
            echo "\n<th>Consultant</th>";
            echo "\n<th>Priority</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        echo "</table>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='post_consultation' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Post Consultations</h2></p>";
	echo "\n<p class='section_body'>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th>Date & Time</th>";
            echo "\n<th width='300'>Patient Name</th>";
            echo "\n<th>Consultant</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        foreach ($postcon_info as $postcon_item){
            echo "<tr>";
            echo "<td>".$postcon_item['time_started']."</td>";
            echo "<td>".anchor('emr/edit_postconsult_queue/'.$postcon_item['patient_id'].'/'.$postcon_item['summary_id'], $postcon_item['name'], "target='_blank'")."</td>";
            echo "<td>".$postcon_item['note_staff']."</td>";
            echo "<td>".$postcon_item['staff_name']."</td>";
            echo "<td>".$postcon_item['remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='queue_rooms' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Rooms</h2></p>";
	echo "\n<p class='section_body'>";
    echo "<p>";
    echo anchor('ehr_queue/queue_edit_room/new_room/new_room', 'Add New Room');

    echo "</p>";

        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th width='200'>Room Name</th>";
            echo "\n<th>Category</th>";
            echo "\n<th>Description</th>";
        echo "</tr>";
        foreach ($rooms_list as $room_item){
            echo "<tr>";
            echo "<td>".anchor('ehr_queue/queue_edit_room/edit_room/'.$room_item['room_id'], $room_item['name'])."</td>";
            echo "<td>".$room_item['category_name']."</td>";
            echo "<td>".$room_item['description']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='queue_' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2></h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "</div>"; //id=body

