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
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />bio_inv_id = " . $bio_inv_id;
    print "\n<br />bio_case_id = " . $bio_case_id;
    print "\n<br />notification_id = " . $notification_id;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(bio_inv_details)=<br />";
		print_r($bio_inv_details);
	echo '</pre>';
    echo "\n</div>";
} //endif debug

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<br /><h1>".$save_attempt."</h1>";
echo form_open_multipart('bio_phi/edit_inv/'.$form_purpose.'/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id.'/'.$bio_inv_id);
echo form_hidden('now_id', $now_id);
echo form_hidden('bio_inv_id', $bio_inv_id);
echo form_hidden('bio_case_id', $bio_case_id);
echo form_hidden('notification_id', $notification_id);
echo form_hidden('patient_id', $init_patient_id);
echo form_hidden('summary_id', $notify_info['summary_id']);
echo form_hidden('location_id', $notify_info['location_id']);

echo "\n<table border='1' class='line'>";
echo "<tr><td>\n";
echo "<table>";
echo "\n<tr><td width='150'><u>Investigation Details</u></td><td>";

echo "\n<tr><td>Inv. Ref. <font color='red'>*</font></td><td>";
echo form_error('inv_ref');
echo "<input type='text' name='inv_ref' value='".set_value('inv_ref',$init_inv_ref)."' size='12' /> </td></tr>";

echo "\n<tr><td>Interviewee Name <font color='red'>*</font></td><td>";
echo form_error('inv_main_name');
echo "<input type='text' name='inv_main_name' value='".set_value('inv_main_name',$init_inv_main_name)."' size='50' /> </td></tr>";

echo "\n<tr><td>Relationship</td><td>";
echo form_error('inv_main_relship');
echo "<input type='text' name='inv_main_relship' value='".set_value('inv_main_relship',$init_inv_main_relship)."' size='40' /> </td></tr>";

echo "\n<tr><td>Interviewee's Age</td><td>";
echo form_error('inv_main_age');
echo "<input type='text' name='inv_main_age' value='".set_value('inv_main_age',$init_inv_main_age)."' size='3' /> years</td></tr>";

echo "\n<tr><td>Contact Type <font color='red'>*</font></td><td>";
echo form_error('inv_main_contacttype');
echo "\n<input type='radio' name='inv_main_contacttype' value='Household' ".set_radio('inv_main_contacttype','Household',($init_inv_main_contacttype=='Household'?TRUE:FALSE))." >Household</input>";
echo "\n<input type='radio' name='inv_main_contacttype' value='Other' ".set_radio('inv_main_contacttype','Other',($init_inv_main_contacttype=='Other'?TRUE:FALSE))." >Other</input>";
echo "\n</td></tr>";

echo "\n<tr><td valign='top'>Response</td><td>";
echo form_error('inv_main_answer');
//echo "<input type='text' name='inv_main_answer' value='".set_value('inv_main_answer',$init_inv_main_answer)."' size='80' />";
echo "<textarea class='normal' name='inv_main_answer' cols='50' rows='4'>".set_value('inv_main_answer',$init_inv_main_answer)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td valign='top'>Remarks</td><td>";
echo form_error('inv_main_remarks');
//echo "<input type='text' name='inv_main_remarks' value='".set_value('inv_main_remarks',$init_inv_main_remarks)."' size='80' />";
echo "<textarea class='normal' name='inv_main_remarks' cols='50' rows='4'>".set_value('inv_main_remarks',$init_inv_main_remarks)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td>Cluster size</td><td>";
echo form_error('inv_cluster_size');
echo "<input type='text' name='inv_cluster_size' value='".set_value('inv_cluster_size',$init_inv_cluster_size)."' size='3' /> persons</td></tr>";

echo "\n<tr><td valign='top'>Findings</td><td>";
echo form_error('inv_findings');
//echo "<input type='text' name='inv_findings' value='".set_value('inv_findings',$init_inv_findings)."' size='80' />";
echo "<textarea class='normal' name='inv_findings' cols='50' rows='4'>".set_value('inv_findings',$init_inv_findings)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td valign='top'>Summary</td><td>";
echo form_error('inv_summary');
//echo "<input type='text' name='inv_summary' value='".set_value('inv_summary',$init_inv_summary)."' size='80' />";
echo "<textarea class='normal' name='inv_summary' cols='50' rows='4'>".set_value('inv_summary',$init_inv_summary)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td valign='top'>Comments</td><td>";
echo form_error('inv_comments');
//echo "<input type='text' name='inv_comments' value='".set_value('inv_comments',$init_inv_comments)."' size='80' />";
echo "<textarea class='normal' name='inv_comments' cols='50' rows='4'>".set_value('inv_comments',$init_inv_comments)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td>Address</td><td>";
echo form_error('inv_address1');
echo "<input type='text' name='inv_address1' value='".set_value('inv_address1',$init_inv_address1)."' size='50' /> </td></tr>";

echo "\n<tr><td>&nbsp;</td><td>";
echo form_error('inv_address2');
echo "<input type='text' name='inv_address2' value='".set_value('inv_address2',$init_inv_address2)."' size='50' /> </td></tr>";

echo "\n<tr><td>&nbsp;</td><td>";
echo form_error('inv_address3');
echo "<input type='text' name='inv_address3' value='".set_value('inv_address3',$init_inv_address3)."' size='50' /> </td></tr>";

echo "\n<tr><td>Post Code</td><td>";
echo form_error('inv_postcode');
echo "<input type='text' name='inv_postcode' value='".set_value('inv_postcode',$init_inv_postcode)."' size='10' /> </td></tr>";

echo "\n<tr><td>Town</td><td>";
echo form_error('inv_town');
echo "<input type='text' name='inv_town' value='".set_value('inv_town',$init_inv_town)."' size='30' /> </td></tr>";

echo "\n<tr><td>State</td><td>";
echo form_error('inv_state');
echo "<input type='text' name='inv_state' value='".set_value('inv_state',$init_inv_state)."' size='30' /> </td></tr>";

echo "\n<tr><td>Telephone</td><td>";
echo form_error('inv_tel');
echo "<input type='text' name='inv_tel' value='".set_value('inv_tel',$init_inv_tel)."' size='20' /> </td></tr>";

echo "\n<tr><td>Fax</td><td>";
echo form_error('inv_fax');
echo "<input type='text' name='inv_fax' value='".set_value('inv_fax',$init_inv_fax)."' size='20' /> </td></tr>";

echo "\n<tr><td>email</td><td>";
echo form_error('inv_email');
echo "<input type='text' name='inv_email' value='".set_value('inv_email',$init_inv_email)."' size='30' /> </td></tr>";

echo "\n<tr><td>GPS coordinates</td><td>";
echo "\nLatitude ";
echo form_error('inv_gps_lat');
echo "\n<input type='text' name='inv_gps_lat' value='".set_value('inv_gps_lat',$init_inv_gps_lat)."' size='10' /> ";
echo "Longitude ";
echo form_error('inv_gps_long');
echo "<input type='text' name='inv_gps_long' value='".set_value('inv_gps_long',$init_inv_gps_long)."' size='10' /> ";
echo "\ne.g. 7.252446&deg; and 80.375020&deg;<br />";
if(! empty($init_inv_gps_lat) || ! empty($init_inv_gps_long)) {
    echo "\n<a href='".$map_server."simple_map.php?lat=$init_inv_gps_lat&long=$init_inv_gps_long' target='_blank'>";
    echo "\n<img src='".base_url()."/images/maps_small_horizontal_logo.png' alt='View Map' /></a>";
}
echo "\n</td></tr>";

echo "\n<tr><td>Start Investigation *</td><td>";
echo form_error('inv_start_date');
echo "<input type='text' name='inv_start_date' value='".set_value('inv_start_date',$init_inv_start_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>End Investigation</td><td>";
echo form_error('inv_end_date');
echo "<input type='text' name='inv_end_date' value='".set_value('inv_end_date',$init_inv_end_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td><u>Pictures</u></td><td>";
if($bio_inv_id == "new_inv"){
    // Show nothing
} else {
    echo anchor('bio_phi/upload_pics_inv/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id.'/'.$bio_inv_id, 'Upload more pictures');
    echo "</td></tr>";

    echo "\n<tr><td>&nbsp;</td><td>";
    echo "<table>";
    foreach ($bio_pics_list as $pic) {
        echo "\n<tr><td>&nbsp;</td><td>";
        echo "<a href='".$pics_url."INV".$pic['bio_file_id'].".jpg' target='_blank'>View ";
        echo "<img src='".$pics_url."INV".$pic['bio_file_id']."_thumb.jpg' alt='image'></a> ";
        echo "\n </td><td> ".$pic['bio_file_ref'];
        echo " </td><td> <strong>".$pic['bio_file_title'];
        echo " </td><td> ".$pic['bio_file_descr'];
        echo "</td></tr>";
    }
    echo "</table>";
    echo "</td>";
}

echo "\n<tr><td>&nbsp;</td>";
echo "<td><div align='center'><br /><input type='submit' value='Create/Save' /></div>";
echo "</form>";
echo "</td>";

//echo "<td>";
echo "</tr></table>";
echo "</td></tr>\n";
echo "<tr><td>\n";
echo "<table>";
echo "\n<tr><td width='150'><u>Case Details</u></td><td>";

echo "\n<tr><td>Case Ref.</td><td><strong>";
echo $bio_case_details['case_ref'];
echo " ";
echo anchor('bio_phi/edit_case/edit_case/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id, 'Edit');

echo "</strong></td></tr>";

echo "\n<tr><td>Start Case Date</td><td>";
echo $bio_case_details['start_date']."</td></tr>";

echo "\n<tr><td>End Case Date</td><td>";
echo $bio_case_details['end_date']."</td></tr>";

echo "\n<tr><td>Case findings</td><td>";
echo $bio_case_details['case_findings']."</td></tr>";

echo "\n<tr><td>Case summary</td><td>";
echo $bio_case_details['case_summary']."</td></tr>";

echo "\n<tr><td>Case comments</td><td>";
echo $bio_case_details['case_comments']."</td></tr>";

echo "\n<tr><td>Alert status</td><td>";
echo $bio_case_details['alert_now']." (Highest was ". $bio_case_details['alert_max'].")</td></tr>";

echo "\n<tr><td>GPS coordinates</td><td>";
echo "Latitude : ".$bio_case_details['gps_lat'];
echo " Longitude : ".$bio_case_details['gps_long']."</td></tr>";

echo "<tr><td>&nbsp;</td>";
echo "</tr></table>";
echo "</td></tr>\n";

echo "\n<tr><td>";
echo "\n<table>";
echo "\n<tr><td width='150'>Clinic Ref.</td><td>";
echo $patient_info['clinic_reference_number']."</td></tr>";

echo "\n<tr><td>Name</td><td><strong>";
echo $patient_info['patient_name']."</strong></td></tr>";

echo "\n<tr><td>Other IC No.</td><td>";
echo $patient_info['ic_other_no']."</td></tr>";

echo "\n<tr><td>Gender</td><td>";
echo $patient_info['gender']."</td></tr>";

echo "\n<tr><td>Birth Date</td><td>";
echo $patient_info['birth_date']."</td></tr>";

echo "\n<tr><td>&nbsp;</td><td>";
echo "</tr></table>";
echo "</td></tr>\n";

echo "<tr><td>\n";
echo "<table>";
echo "\n<tr><td width='150'><u>Clinical Episode</u></td><td>";

echo "\n<tr><td>Location</td><td>";
echo $clinic_info[0]['clinic_name'];
echo "</td></tr>\n";

echo "\n<tr><td>Consultation Date</td><td>";
echo $notify_info['notify_date']."</td></tr>";

echo "\n<tr><td>Date Illness Started</td><td>";
echo $notify_info['started_date']."</td></tr>";

echo "\n<tr><td>Diagnosis</td><td>";
echo $notify_info['dcode1ext_code']."</td></tr>";

echo "\n<tr><td>Diagnosis Notes</td><td>";
echo $notify_info['diagnosis_notes']."</td></tr>";

echo "\n<tr><td>Notification Ref.</td><td>";
echo $notify_info['notify_ref']."</td></tr>";

echo "\n<tr><td>&nbsp;</td><td>";
echo "</tr></table>";
echo "</td></tr>\n";
echo "<tr><td>\n";
echo "<table>";
echo "\n<tr><td width='150'><u>Contact Info</u></td><td>";

echo "\n<tr><td>Address</td><td>";
echo $patient_info['patient_address']."</td></tr>\n";

echo "\n<tr><td>&nbsp;</td><td>";
echo $patient_info['patient_address2']."</td></tr>\n";

echo "\n<tr><td>&nbsp;</td><td>";
echo $patient_info['patient_address3']."</td></tr>\n";

echo "\n<tr><td>Post Code</td><td>";
echo $patient_info['patient_postcode']."</td></tr>\n";

echo "\n<tr><td>Town</td><td>";
echo $patient_info['patient_town']."</td></tr>\n";

echo "\n<tr><td>State</td><td>";
echo $patient_info['patient_state']."</td></tr>\n";

echo "\n<tr><td>Tel. Home</td><td>";
echo $patient_info['tel_home']."</td></tr>\n";

echo "\n<tr><td> </td><td>";
echo anchor('bio_hospital/edit_patient/new_notify/'.$patient_id, 'Edit Patient Details');

echo "</td></tr>\n";
echo "</table>";

echo "</td></tr>\n";
echo "</table>";



