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

echo "\n<div align='center'><h1>THIRRA - Investigation</h1></div>";
if($debug_mode) {
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />bio_inv_id = " . $bio_inv_id;
    print "\n<br />bio_case_id = " . $bio_case_id;
    print "\n<br />notification_id = " . $notification_id;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
} //endif debug

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<br /><h1>".$save_attempt."</h1>";
echo form_open('bio_phi/edit_inv/'.$form_purpose.'/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id.'/'.$bio_inv_id);
echo form_hidden('now_id', $now_id);
echo form_hidden('bio_inv_id', $bio_inv_id);
echo form_hidden('bio_case_id', $bio_case_id);
echo form_hidden('notification_id', $notification_id);
echo form_hidden('patient_id', $init_patient_id);
echo form_hidden('summary_id', $notify_info['summary_id']);
echo form_hidden('location_id', $notify_info['location_id']);

echo "\nInvestigation Reference <font color='red'>*</font><br />";
echo form_error('inv_ref');
echo "<input type='text' name='inv_ref' value='".set_value('inv_ref',$init_inv_ref)."' size='10' /> ";

echo "\n<br />Interviewee Name <font color='red'>*</font><br />";
echo form_error('inv_main_name');
echo "<input type='text' name='inv_main_name' value='".set_value('inv_main_name',$init_inv_main_name)."' size='50' /> ";

echo "\n<br />Relationship<br />";
echo form_error('inv_main_relship');
echo "<input type='text' name='inv_main_relship' value='".set_value('inv_main_relship',$init_inv_main_relship)."' size='40' />";

echo "\n<br />Interviewee's Age<br />";
echo form_error('inv_main_age');
echo "<input type='text' name='inv_main_age' value='".set_value('inv_main_age',$init_inv_main_age)."' size='3' />";

echo "\n<br />Contact Type <font color='red'>*</font><br />";
echo form_error('inv_main_contacttype');
echo "\n<input type='radio' name='inv_main_contacttype' value='Household' ".set_radio('inv_main_contacttype','Household',($init_inv_main_contacttype=='Household'?TRUE:FALSE))." >Household</input>";
echo "\n<input type='radio' name='inv_main_contacttype' value='Other' ".set_radio('inv_main_contacttype','Other',($init_inv_main_contacttype=='Other'?TRUE:FALSE))." >Other</input>";

echo "\n<br />Response<br />";
echo form_error('inv_main_answer');
echo "<input type='text' name='inv_main_answer' value='".set_value('inv_main_answer',$init_inv_main_answer)."' size='80' />";

echo "\n<br />Remarks<br />";
echo form_error('inv_main_remarks');
echo "<input type='text' name='inv_main_remarks' value='".set_value('inv_main_remarks',$init_inv_main_remarks)."' size='80' />";

echo "\n<br />Cluster size<br />";
echo form_error('inv_cluster_size');
echo "<input type='text' name='inv_cluster_size' value='".set_value('inv_cluster_size',$init_inv_cluster_size)."' size='3' />";

echo "\n<br />Findings<br />";
echo form_error('inv_findings');
echo "<input type='text' name='inv_findings' value='".set_value('inv_findings',$init_inv_findings)."' size='80' />";

echo "\n<br />Summary<br />";
echo form_error('inv_summary');
echo "<input type='text' name='inv_summary' value='".set_value('inv_summary',$init_inv_summary)."' size='80' />";

echo "\n<br />Comments<br />";
echo form_error('inv_comments');
echo "<input type='text' name='inv_comments' value='".set_value('inv_comments',$init_inv_comments)."' size='80' />";

echo "\n<br />Address<br />1";
echo form_error('inv_address1');
echo "<input type='text' name='inv_address1' value='".set_value('inv_address1',$init_inv_address1)."' size='50' />";

echo "\n<br />2";
echo form_error('inv_address2');
echo "<input type='text' name='inv_address2' value='".set_value('inv_address2',$init_inv_address2)."' size='50' />";

echo "\n<br />3";
echo form_error('inv_address3');
echo "<input type='text' name='inv_address3' value='".set_value('inv_address3',$init_inv_address3)."' size='50' />";

echo "\n<br />Post Code<br />";
echo form_error('inv_postcode');
echo "<input type='text' name='inv_postcode' value='".set_value('inv_postcode',$init_inv_postcode)."' size='10' />";

echo "\n<br />Town<br />";
echo form_error('inv_town');
echo "<input type='text' name='inv_town' value='".set_value('inv_town',$init_inv_town)."' size='30' />";

echo "\n<br />State<br />";
echo form_error('inv_state');
echo "<input type='text' name='inv_state' value='".set_value('inv_state',$init_inv_state)."' size='30' />";

echo "\n<br />Tel.<br />";
echo form_error('inv_tel');
echo "<input type='text' name='inv_tel' value='".set_value('inv_tel',$init_inv_tel)."' size='20' />";

echo "\n<br />Fax<br />";
echo form_error('inv_fax');
echo "<input type='text' name='inv_fax' value='".set_value('inv_fax',$init_inv_fax)."' size='20' />";

echo "\n<br />email<br />";
echo form_error('inv_email');
echo "<input type='text' name='inv_email' value='".set_value('inv_email',$init_inv_email)."' size='30' />";

echo "\n<br />GPS coordinates<br />";
echo "Latitude ";
echo form_error('inv_gps_lat');
echo "<input type='text' name='inv_gps_lat' value='".set_value('inv_gps_lat',$init_inv_gps_lat)."' size='20' /> ";
echo "Longitude ";
echo form_error('inv_gps_long');
echo "<input type='text' name='inv_gps_long' value='".set_value('inv_gps_long',$init_inv_gps_long)."' size='20' />";

echo "\n<br />Start Investigation *<br />";
echo form_error('inv_start_date');
echo "<input type='text' name='inv_start_date' value='".set_value('inv_start_date',$init_inv_start_date)."' size='10' /> YYYY-MM-DD";

echo "\n<br />End Investigation<br />";
echo form_error('inv_end_date');
echo "<input type='text' name='inv_end_date' value='".set_value('inv_end_date',$init_inv_end_date)."' size='10' /> YYYY-MM-DD";

echo "\n<br /><u>Pictures</u><br />";

if($bio_inv_id == "new_inv"){
    // Show nothing
} else {
    echo anchor('bio_phi/upload_pics_inv/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id.'/'.$bio_inv_id, 'Upload more pictures');
    echo "<br />";
    echo "<ol>";
    foreach ($bio_pics_list as $pic) {
        echo "\n<li>";
        echo "<a href='".$pics_url."/INV".$pic['bio_pics_id'].".jpg' target='_blank'>View</a>  ";
        echo "\n : ".$pic['bio_pic_ref'];
        echo " - ".$pic['bio_pic_title']."</li>";
    }
    echo "</ol>";
}
echo "<div align='center'><br /><input type='submit' value='Save' /></div>";

echo "\n<hr /><h2>Case Details</h2>";

echo "\nCase Ref. : ";
echo $bio_case_details['case_ref'];
echo " ";
echo anchor('bio_phi/edit_case/edit_case/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id, 'Edit');

echo "\n<br />Start Case Date : ";
echo $bio_case_details['start_date'];

echo "\n<br />End Case Date : ";
echo $bio_case_details['end_date'];

echo "\n<br />Case findings : ";
echo $bio_case_details['case_findings'];

echo "\n<br />Case summary : ";
echo $bio_case_details['case_summary'];

echo "\n<br />Case comments : ";
echo $bio_case_details['case_comments'];

echo "\n<br />Alert status : ";
echo $bio_case_details['alert_now']." (Highest was ". $bio_case_details['alert_max'];

echo "\n<br />GPS coordinates : ";
echo "Latitude : ".$bio_case_details['gps_lat'];
echo " Longitude : ".$bio_case_details['gps_long'];

echo "\n<br />Clinic Ref. : ";
echo $patient_info['clinic_reference_number'];

echo "\n<br />Name : ";
echo $patient_info['patient_name'];

echo "\n<br />Other IC No. : ";
echo $patient_info['ic_other_no'];

echo "\n<br />Gender : ";
echo $patient_info['gender'];

echo "\n<br />Birth Date : ";
echo $patient_info['birth_date']." YYYY-MM-DD";

echo "\n<hr /><h2>Clinical Episode</h2>";

echo "\nLocation : ";
echo $clinic_info[0]['clinic_name'];

echo "\n<br />Consultation Date : ";
echo $notify_info['notify_date'];

echo "\n<br />Date Illness Started : ";
echo $notify_info['started_date'];

echo "\n<br />Diagnosis : ";
echo $notify_info['dcode1ext_code'];

echo "\n<br />Diagnosis Notes : ";
echo $notify_info['diagnosis_notes'];

echo "\n<br />Notification Ref. : ";
echo $notify_info['notify_ref'];

echo "\n<hr /><h2>Contact Info</h2> : ";

echo "\nAddress :<br />";
echo $patient_info['patient_address'];

echo "\n<br />";
echo $patient_info['patient_address2'];

echo "\n<br />";
echo $patient_info['patient_address3'];

echo "\n<br /> ";
echo $patient_info['patient_postcode'];

echo "\n ";
echo $patient_info['patient_town'];

echo "\n<br />";
echo $patient_info['patient_state'];

echo "\n<br />Tel. Home : ";
echo $patient_info['tel_home'];

echo "\n<br />";
echo anchor('bio_hospital/edit_patient/new_notify/'.$patient_id, 'Edit Patient Details');


