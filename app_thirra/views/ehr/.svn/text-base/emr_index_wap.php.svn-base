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

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    print "\n<br />offline_mode = " . $offline_mode;
    echo "\n<br />device_mode = ".$_SESSION['device_mode'];
    echo "<p>";
        echo $agent . " - " . $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
        if ("Unknown Platform" == $this->agent->platform()){
            echo " - Mobile Device Mode";
        } else {
            echo " - Desktop Mode";
        }
	echo '<pre>';
    echo "\n<br />print_r(queue_info)=<br />";
		print_r($queue_info);
	echo '</pre>';
    echo "</p>";
    echo "\n</div>";
}

echo "\n<div id='page_title' align='center'><h1>".$this->lang->line('index_html_title')."</h1></div>";

echo "\n\n<div id='patient_queue' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>".$this->lang->line('index_html_div-patientqueue_title')."</h2></p>";
	echo "\n<p class='section_body'>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th>".$this->lang->line('index_html_div-patientqueue_th-time')."</th>";
            echo "\n<th width='300'>".$this->lang->line('index_html_div-patientqueue_th-patientname')."</th>";
            echo "\n<th>".$this->lang->line('index_html_div-patientqueue_th-consultant')."</th>";
            echo "\n<th>".$this->lang->line('index_html_div-patientqueue_th-priority')."</th>";
            echo "\n<th>".$this->lang->line('index_html_div-patientqueue_th-remarks')."</th>";
        echo "</tr>";
        foreach ($queue_info as $queue_item){
            echo "<tr>";
            echo "<td>".$queue_item['start_time']."</td>";
            echo "<td>".anchor('emr/individual_overview/'.$queue_item['patient_id'].'/'.$queue_item['booking_id'], $queue_item['name'], "target='_blank'")."</td>";
            echo "<td>".$queue_item['staff_name']."</td>";
            echo "<td>".$queue_item['priority']."</td>";
            echo "<td>".$queue_item['remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='post_queue' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>".$this->lang->line('index_html_div-postconqueue_title')."</h2></p>";
	echo "\n<p class='section_body'>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th>Time Ended</th>";
            echo "\n<th width='400'>Patient Name</th>";
            echo "\n<th>Note to Staff</th>";
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
	echo "</p>";
echo "</div>";

echo "\n\n<div id='incoming_referrals' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Incoming Referrals</h2></p>";
	echo "\n<p class='section_body'>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th>Referred Date</th>";
            echo "\n<th width='300'>Patient Name</th>";
            echo "\n<th>[Sex]</th>";
            echo "\n<th>Birth Date</th>";
            echo "\n<th>To Refer To</th>";
            echo "\n<th>Specialty</th>";
            echo "\n<th>Referring Clinic</th>";
            echo "\n<th>Referer</th>";
        echo "</tr>";
        foreach ($incoming_referrals as $referral_item){
            echo "<tr>";
            echo "<td>".$referral_item['referral_date']."</td>";
            echo "<td>".anchor('emr/individual_overview/'.$referral_item['patient_id'], $referral_item['name'], "target='_blank'")."</td>";
            echo "<td>[".substr($referral_item['gender'],0,1)."]</td>";
            echo "<td>".$referral_item['birth_date']."</td>";
            echo "<td>".$referral_item['doctor_name']."</td>";
            echo "<td>".$referral_item['specialty']."</td>";
            echo "<td><strong>".$referral_item['clinic_shortname']."</strong></td>";
            echo "<td>".$referral_item['staff_name']."</td>";
            echo "<td>".anchor('emr/queue_edit_queue/new_queue/'.$referral_item['patient_id'].'/new_queue', 'Queue')."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='search_patient' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Search for Patient</h2></p>";
	echo "\n<p class='section_body'>";
    echo form_open('ehr_patient/search_patient');
	echo "Search for patient by name. Partial strings will suffice.<br />";
    echo "\n<input type='text' name='patient_name' value='' size='50' />";
    echo "\n<input type='submit' value='Search' />";
    echo "\n</form>";
	echo "<br />";
	echo "</p>";
echo "</div>";
/*
echo "\n\n<div id='new' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2></h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";
*/

