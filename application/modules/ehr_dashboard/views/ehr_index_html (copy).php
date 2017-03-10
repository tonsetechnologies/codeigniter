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

if($debug_mode) {
    echo "\n<div class='debug'>";
    echo "\n<u>NOTICE</u><br />";
    echo "\n<p>If you are reading this, do not panic. It simply means that THIRRA is running in debugging mode. <br />Turn off the debug flag in app_thirra/config/config.php to revert to normal mode.</p>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    print "\n<br />offline_mode = " . $offline_mode;
    //echo "\n<br />device_mode = ".$device_mode;
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
    echo "\n<br />print_r(lab_orders)=<br />";
		print_r($lab_orders);
    echo "\n<br />print_r(incoming_referrals)=<br />";
		print_r($incoming_referrals);
	echo '</pre>';
    echo "</p>";
    echo "\n</div>";
}

echo "\n<div id='page_title' align='center'><h1>".$this->lang->line('10150-100_index_html_title')."</h1></div>";

echo "\n\n<div id='patient_queue' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>".$this->lang->line('10150-200_index_html_div-patientqueue_title')."</h2></div>";
	echo "\n<div class='section_body'>";
        echo "\n<table class='valigntop'>";
        echo "\n<tr>";
            echo "\n<th>".$this->lang->line('10150-210_index_html_div-patientqueue_th-time')."</th>";
            echo "\n<th width='300'>".$this->lang->line('10150-220_index_html_div-patientqueue_th-patientname')."</th>";
            echo "\n<th>".$this->lang->line('10150-240_index_html_div-patientqueue_th-clinicrefno')."</th>";
            echo "\n<th>".$this->lang->line('10150-230_index_html_div-patientqueue_th-consultant')."</th>";
            echo "\n<th>".$this->lang->line('10150-240_index_html_div-patientqueue_th-priority')."</th>";
            echo "\n<th>".$this->lang->line('10150-250_index_html_div-patientqueue_th-remarks')."</th>";
            echo "\n<th>".$this->lang->line('10150-250_index_html_div-patientqueue_th-room')."</th>";
        echo "</tr>";
        $previous_dept = NULL;
        foreach ($queue_info as $queue_item){
            if($previous_dept <> $queue_item['clinic_dept_id']){
                echo "\n<tr><td>&nbsp;</td></tr>";
            }
            echo "\n<tr>";
            echo "<td>".substr($queue_item['start_time'],0,5)."</td>";
            echo "<td>&nbsp;".anchor('ehr_individual/individual_overview/'.$queue_item['patient_id'].'/'.$queue_item['booking_id'], $queue_item['name']." (".$queue_item['birth_date'].")", "target='_blank'")."</td>";
            echo "<td>".$queue_item['clinic_reference_number']."</td>";
            echo "<td>".$queue_item['staff_initials']."</td>";
            echo "<td><strong><span class='";
            if($queue_item['priority']=='Urgent'){
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

/*
echo "\n\n<div id='post_queue' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>".$this->lang->line('10150-300_index_html_div-postconqueue_title')."</h2></div>";
	echo "\n<div class='section_body'>";
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
            echo "<td>".substr($postcon_item['time_started'],0,5)."</td>";
            echo "<td>".anchor('emr/edit_postconsult_queue/'.$postcon_item['patient_id'].'/'.$postcon_item['summary_id'], $postcon_item['name'], "target='_blank'")."</td>";
            echo "<td>".$postcon_item['note_staff']."</td>";
            echo "<td>".$postcon_item['staff_name']."</td>";
            echo "<td>".$postcon_item['remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
	echo "</div>";
	echo "<br />";
echo "</div>";
*/

echo "\n\n<div id='lab_orders' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>".$this->lang->line('10150-400_index_html_div-laborders_title')."</h2></div>";
	echo "\n<div class='section_body'>";
    echo "\n<table class='valigntop'>";
    echo "\n<tr>";
        echo "\n<th>Sample Date</th>";
        echo "\n<th width='400'>Patient Name</th>";
        echo "\n<th>Ref.</th>";
        echo "\n<th>Lab Package</th>";
        echo "\n<th>Supplier</th>";
        echo "\n<th>Summary Result</th>";
    echo "</tr>";
    if(isset($lab_orders)){
        echo "</tr>";
        foreach($lab_orders as $lab_item){
            echo "<tr>";
            echo "<td>".$lab_item['sample_date']."</td>";
            echo "<td>".anchor('ehr_orders/edit_labresults/edit_labresults/'.$lab_item['patient_id'].'/'.$lab_item['session_id'].'/'.$lab_item['lab_order_id'], $lab_item['name'])."</td>";
            echo "<td>".$lab_item['sample_ref']."</td>";
            echo "<td>".$lab_item['package_name']."</td>";
            echo "<td>".$lab_item['supplier_name']."</td>";
            echo "<td>".$lab_item['summary_result']."</td>";
            echo "</tr>";
        }//endforeach;
    } //endif(isset($lab_orders))
    echo "</table>";
	echo "</div>";
	echo "<br />";
echo "</div>";

echo "\n\n<div id='incoming_referrals' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Incoming Referrals</h2></div>";
	echo "\n<div class='section_body'>";
        echo "\n<table class='valigntop'>";
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
        /*
        foreach ($incoming_referrals as $referral_item){
            echo "<tr>";
            echo "<td>".$referral_item['referral_date']."</td>";
            echo "<td>".anchor('ehr_individual/individual_overview/'.$referral_item['patient_id'], $referral_item['name'].', '.$referral_item['name_first'], "target='_blank'")."</td>";
            echo "<td>[".substr($referral_item['gender'],0,1)."]</td>";
            echo "<td>".$referral_item['birth_date']."</td>";
            echo "<td>".$referral_item['doctor_name']."</td>";
            echo "<td>".$referral_item['specialty']."</td>";
            echo "<td><strong>".$referral_item['clinic_shortname']."</strong></td>";
            echo "<td>".$referral_item['staff_name']."</td>";
            echo "<td>".anchor('ehr_queue/queue_edit_queue/new_queue/'.$referral_item['patient_id'].'/new_queue', 'Queue')."</td>";
            echo "</tr>";
        }//endforeach;
        foreach ($incoming_referrals as $referral_item){
            echo "<tr>";
            echo "<td>".date("Y-m-d",$referral_item['staged_time'])."</td>";
            echo "<td>".anchor('ehr_individual/individual_overview/'.$referral_item['patient_id'], $referral_item['patient_name'].', '.$referral_item['patient_name_first'], "target='_blank'")."</td>";
            echo "<td>[".substr($referral_item['patient_gender'],0,1)."]</td>";
            echo "<td>".$referral_item['patient_birthdate']."</td>";
            echo "<td>".$referral_item['refer_to_person']."</td>";
            echo "<td>".$referral_item['refer_to_specialty']."</td>";
            echo "<td><strong>".$referral_item['refer_clinicname']."</strong></td>";
            echo "<td>".$referral_item['refer_by_person']."</td>";
            echo "<td>Import</td>";
            //echo "<td>".anchor('ehr_queue/queue_edit_queue/new_queue/'.$referral_item['patient_id'].'/new_queue', 'Queue')."</td>";
            echo "</tr>";
        }//endforeach;
        */
        echo "</table>";
	echo "</div>";
	echo "<br />";
echo "</div>";

echo "\n\n<div id='search_patient' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Search for Patient</h2></div>";
	echo "\n<div class='section_body'>";
    echo form_open('ehr_patient/search_patient');
	echo "Search for patient by name. Partial strings will suffice.<br />";
    echo "\n<input type='text' name='patient_name' value='' size='50' />";
    echo "\n<br /><input type='radio' name='search_field' value='name' checked='checked' >Name</input>";
    echo "\n<input type='radio' name='search_field' value='ic_no' >NRIC</input>";
    echo "\n<input type='radio' name='search_field' value='clinic_reference_number' >Clinic Reference</input>";
    echo "\n<br /><input type='submit' value='Search' />";
    echo "\n</form>";
	echo "<br />";
	echo "</div>";
echo "</div>";

echo "\n\n<div id='patients_patients_list' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Patients List</h2></div>";
	echo "\n<div class='section_body'>";
	echo "View FULL Patients List by Alphabet";
	echo "</p>";
	echo "\n<p>";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/A', ' A ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/B', ' B ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/C', ' C ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/D', ' D ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/E', ' E ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/F', ' F ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/G', ' G ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/H', ' H ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/I', ' I ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/J', ' J ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/K', ' K ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/L', ' L ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/M', ' M ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/N', ' N ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/O', ' O ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/P', ' P ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/Q', ' Q ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/R', ' R ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/S', ' S ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/T', ' T ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/U', ' U ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/V', ' V ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/W', ' W ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/X', ' X ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/Y', ' Y ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/Z', ' Z ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/', ' All ');
	echo "</p>";
	echo "\n<p class='section_body'>";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/', 'FULL Patients List');
	echo "</div>";
echo "</div>";

echo "\n\n<div id='open_sessions' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>".$this->lang->line('10150-800_index_html_div-opensession_title')."</h2></div>";
	echo "\n<div class='section_body'>";
    echo "\n<table class='valigntop'>";
    echo "\n<tr>";
        echo "\n<th width='120'>Date</th>";
        echo "\n<th width='100'>Time</th>";
        echo "\n<th width='400'>Patient Name</th>";
        echo "\n<th>External Ref.</th>";
        echo "\n<th>Summary</th>";
    echo "</tr>";
    if(isset($open_episodes)){
        echo "</tr>";
        foreach($open_episodes as $open_item){
            echo "<tr>";
            echo "<td>".$open_item['date_started']."</td>";
            echo "<td>".$open_item['time_started']."</td>";
            echo "<td>";
            //.anchor('ehr_orders/edit_labresults/edit_labresults/'.$open_item['patient_id'].'/'.$open_item['summary_id'], $open_item['name'])."</td>";
            if($open_item['staff_id'] == $_SESSION['staff_id']){
                echo anchor('ehr_consult/consult_episode/'.$open_item['patient_id'].'/'.$open_item['summary_id'], '<strong>End Session </strong>', 'target="_blank"');
                echo anchor('ehr_individual/individual_overview/'.$open_item['patient_id'], $open_item['name'].', '.$open_item['name_first'], 'target="_blank"');
            } else {
                echo "Hidden";
            }
            echo "</td>";
            echo "<td>".$open_item['external_ref']."</td>";
            echo "<td>".$open_item['summary']."</td>";
            echo "</tr>";
        }//endforeach;
    } //endif(isset($lab_orders))
    echo "</table>";
	echo "</div>";
	echo "<br />";
echo "</div>";

/*
echo "\n\n<div id='new' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2></h2></div>";
	echo "\n<div class='section_body'>";
	echo "<br />";
	echo "</div>";
echo "</div>";
*/

