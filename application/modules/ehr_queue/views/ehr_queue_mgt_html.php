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

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username');
	echo '<pre>';
		//print_r($patient_info);
    echo "\n<br />print_r(queue_info)=<br />";
		print_r($queue_info);
    echo "\n<br />print_r(all_queue)=<br />";
		print_r($all_queue);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div align='center'><h1>".$this->lang->line('queue_mgt_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n\n<div id='queue_queue' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Patients Queue</h2></div>";
	echo "\n<div class='section_body'>";
    echo "<p><strong>";
    if(count($rooms_list) > 0){
        echo anchor('ehr/ehr/index/ehr_queue/ehr_queue/queue_edit_queue/new_queue/patient_id/new_queue', 'Add Patient to Queue');
    } else {
        echo "\n<font color='red'>Please Add New Room before proceeding.</font>";
    }
    echo "</strong></p>";
    echo "<p>";
    echo "Click on Date&Time to edit Queue. Click on Patient's Name to open Patient Clinical Records.";

    echo "</p>";

        echo "\n<table class='valigntop'>"; // class='valigntop'
        echo "\n<tr>";
            echo "\n<th>Date & Time</th>";
            echo "\n<th width='300'>Patient Name</th>";
            echo "\n<th>Consultant</th>";
            echo "\n<th>Priority</th>";
            echo "\n<th>Remarks</th>";
            echo "\n<th>Room</th>";
        echo "</tr>";
        $previous_dept = NULL;
        foreach ($queue_info as $queue_item){
            if($previous_dept <> $queue_item['clinic_dept_id']){
                echo "\n<tr><td>&nbsp;</td></tr>";
            }
            echo "\n<tr>";
            echo "<td>".anchor('ehr/ehr/index/ehr_queue/ehr_queue/queue_edit_queue/edit_queue/'.$queue_item['patient_id'].'/'.$queue_item['booking_id'], "<strong>".$queue_item['date']."</strong> ".substr($queue_item['start_time'],0,5))."</td>";
            echo "<td>&nbsp;<strong>".anchor('indv/indv/index/indv_overview/ehr_individual/individual_overview/overview/'.$queue_item['patient_id'].'/'.$queue_item['booking_id'], $queue_item['name'].", ".$queue_item['name_first']." (".$queue_item['birth_date'].")", "target='_blank'")."</strong></td>";
            echo "<td>".$queue_item['staff_name']."</td>";
            echo "<td><strong><span class='";
            if($queue_item['priority'] == "Urgent"){
                echo "mandatory_field";
            }
            echo "'>".$queue_item['priority']."</span></strong></td>";
            echo "<td>".$queue_item['remarks']."</td>";
            echo "<td>".$queue_item['room_name']."</td>";
            echo "</tr>";
            $previous_dept = $queue_item['clinic_dept_id'];
        }//endforeach;
        echo "</table>";
	echo "</div>";
	echo "<br />";
echo "</div>";

echo "\n\n<div id='queue_appointments' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Global Queue</h2></div>";
	echo "\n<div class='section_body'>";
        echo "\n<table class='valigntop'>";
        echo "\n<tr>";
            echo "\n<th>Date & Time</th>";
            echo "\n<th width='300'>Patient Name</th>";
            echo "\n<th>Consultant</th>";
            echo "\n<th>Priority</th>";
            echo "\n<th>Remarks</th>";
            echo "\n<th>Room</th>";
            echo "\n<th>Clinic</th>";
        echo "</tr>";
        $previous_dept = NULL;
        foreach ($all_queue as $queue_item){
            if($previous_dept <> $queue_item['clinic_dept_id']){
                echo "\n<tr><td>&nbsp;</td></tr>";
            }
            echo "\n<tr>";
            //echo "<td>".anchor('ehr_queue/queue_edit_queue/edit_queue/'.$queue_item['patient_id'].'/'.$queue_item['booking_id'], "<strong>".$queue_item['date']."</strong> ".substr($queue_item['start_time'],0,5))."</td>";
            echo "<td><strong>".$queue_item['date']."</strong> ".substr($queue_item['start_time'],0,5)."</td>";
            echo "<td><strong>".$queue_item['name']." (".$queue_item['birth_date'].")</strong></td>";
            //echo "<td><strong>".anchor('ehr_individual/individual_overview/'.$queue_item['patient_id'].'/'.$queue_item['booking_id'], $queue_item['name']." (".$queue_item['birth_date'].")", "target='_blank'")."</strong></td>";
            echo "<td>".$queue_item['staff_initials']."</td>";
            echo "<td>".$queue_item['priority']."</td>";
            echo "<td>".$queue_item['remarks']."</td>";
            echo "<td>".$queue_item['room_name']."</td>";
            echo "<td>".$queue_item['clinic_shortname']."</td>";
            echo "</tr>";
            $previous_dept = $queue_item['clinic_dept_id'];
        }//endforeach;
        echo "</table>";
	echo "<br />";
	echo "</div>";
echo "</div>";

echo "\n\n<div id='post_consultation' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Post Consultations</h2></div>";
	echo "\n<div class='section_body'>";
        echo "\n<table class='valigntop'>";
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
	echo "</div>";
echo "</div>";

echo "\n\n<div id='queue_rooms' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Rooms</h2></div>";
	echo "\n<div class='section_body'>";
    echo "<p>";
    echo anchor('ehr/ehr/index/ehr_queue/ehr_queue/queue_edit_room/new_room/new_room', 'Add New Room');

    echo "</p>";
    if(count($rooms_list) > 0){
        echo "\n<table class='valigntop'>";
        echo "\n<tr>";
            echo "\n<th width='200'>Room Name</th>";
            echo "\n<th>Code</th>";
            echo "\n<th>Department</th>";
            echo "\n<th>Category</th>";
            echo "\n<th>Description</th>";
        echo "</tr>";
        foreach ($rooms_list as $room_item){
            echo "<tr>";
            echo "<td>".anchor('ehr/ehr/index/ehr_queue/ehr_queue/queue_edit_room/edit_room/'.$room_item['room_id'], $room_item['name'])."</td>";
            echo "<td>".$room_item['room_code']."</td>";
            echo "<td>".$room_item['dept_shortname']."</td>";
            echo "<td>".$room_item['category_name']."</td>";
            echo "<td>".$room_item['description']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
    } else {
        echo "\n<font color='red'>Please Add New Room before proceeding.</font>";
    }
	echo "</div>";
	echo "<br />";
echo "</div>";

//echo anchor('ehr_queue/test_email', 'Test email');

/*
echo "\n\n<div id='queue_' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2></h2></div>";
	echo "\n<div class='section_body'>";
	echo "<br />";
	echo "</div>";
	echo "<br />";
echo "</div>";
*/

echo "</div>"; //id=body

