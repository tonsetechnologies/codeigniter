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

echo "\n<body>";

if($debug_mode) {
    print "\n<br />form_purpose = " . $form_purpose;
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
echo form_open('bio_phi/edit_case/'.$form_purpose.'/'.$patient_id.'/'.$notification_id);

echo "\n<hr />PATIENT INFO";

echo "\n<br />Clinic Ref. : ";
echo $patient_info['clinic_reference_number'];

echo "\n<br />Name : ";
echo $patient_info['patient_name'];

echo "\n<br />Other IC No. : ";
echo $patient_info['ic_other_no'];

echo "\n<br />Gender : ";
echo $patient_info['gender'];

echo "\n<br />Age : ";
//echo $patient_info['birth_date'];
$formatted = sprintf("%01.1f",$est_age);
echo $formatted;
echo " years";

echo "\n<hr /><h2>Case Details</h2>";

echo "\nPHI Range : <br />";
echo form_error('phi_range');
    echo "\n<select name='phi_range'>";
    foreach($clinics_list as $clinic){
        echo "\n<option value='".$clinic['clinic_info_id']."'".($init_location_id==$clinic['clinic_info_id']?' selected=\'selected\'':'').">".$clinic['clinic_name']."</option>";
    }
    echo "\n</select><br />";

echo "\nPHI Ref. No. :  <font color='red'>*</font><br />";
echo form_error('bio_phi_ref');
echo "<input type='text' name='bio_phi_ref' value='".set_value('bio_phi_ref',$init_bio_phi_ref)."' size='12' />";

echo "\n<br />MOH Register No. :  <font color='red'>*</font><br />";
echo form_error('case_ref');
echo "<input type='text' name='case_ref' value='".set_value('case_ref',$init_case_ref)."' size='12' />";

echo "\n<br />Start Case Date :  <font color='red'>*</font><br />";
echo form_error('case_start_date');
echo "<input type='text' name='case_start_date' value='".set_value('case_start_date',$init_case_start_date)."' size='10' /> YYYY-MM-DD";

echo "\n<br />End Case Date : <br />";
echo form_error('case_end_date');
echo "<input type='text' name='case_end_date' value='".set_value('case_end_date',$init_case_end_date)."' size='10' /> YYYY-MM-DD";

echo "\n<br />Movements prior 3 wks : <br />";
echo form_error('case_prior_movements');
echo "<input type='text' name='case_prior_movements' value='".set_value('case_prior_movements',$init_case_prior_movements)."' size='80' />";

echo "\n<br />Case findings : <br />";
echo form_error('case_findings');
echo "<input type='text' name='case_findings' value='".set_value('case_findings',$init_case_findings)."' size='80' />";

echo "\n<br />Nature of case</td><td>";
echo form_error('case_outbreak_degree');
if(!isset($init_case_outbreak_degree)){
    $init_case_outbreak_degree = NULL;
}
echo "\n<input type='radio' name='case_outbreak_degree' value='Isolated case' ".set_radio('case_outbreak_degree','Isolated case',($init_case_outbreak_degree=='Isolated case'?TRUE:FALSE))." >Isolated case</input>";
echo "\n<input type='radio' name='case_outbreak_degree' value='Infecting' ".set_radio('case_outbreak_degree','Infecting',($init_case_outbreak_degree=='Infecting'?TRUE:FALSE))." >Infecting</input>";

echo "\n<br />One case in outbreak : ";
if(!isset($init_case_in_outbreak)){
    $init_case_in_outbreak  = "";
}echo form_error('case_in_outbreak');
echo "\n<input type='radio' name='case_in_outbreak' value='Yes' ".set_radio('case_in_outbreak','Yes',($init_case_in_outbreak=='Yes'?TRUE:FALSE))." >Yes</input>";
echo "\n<input type='radio' name='case_in_outbreak' value='No' ".set_radio('case_in_outbreak','No',($init_case_in_outbreak=='No'?TRUE:FALSE))." >No</input>";

echo "\n<br /v>Case summary : <br />";
echo form_error('case_summary');
echo "<input type='text' name='case_summary' value='".set_value('case_summary',$init_case_summary)."' size='80' />";

echo "\n<br /v>Case comments : <br />";
echo form_error('case_comments');
echo "<input type='text' name='case_comments' value='".set_value('case_comments',$init_case_comments)."' size='80' />";

echo "\n<br /v>Alert status : ";
echo form_error('alert_now');
echo "<input type='text' name='alert_now' value='".set_value('alert_now',$init_alert_now)."' size='3' />";

echo "\n<br />GPS : ";
echo form_error('gps_lat');
echo "Lat <input type='text' name='gps_lat' value='".set_value('gps_lat',$init_gps_lat)."' size='10' /> ";
echo form_error('gps_long');
echo "Long <input type='text' name='gps_long' value='".set_value('gps_long',$init_gps_long)."' size='10' /> ";

echo "\n<br /><br />INVESTIGATION(S)";
if($form_purpose == "new_case"){
    echo ": Add investigations after creating new case.";
} else {
    echo "<br /><strong>". anchor('bio_phi/edit_inv/new_inv/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id.'/new_inv', 'Write New');
    if(isset($bio_inv_list)){
        $row    =   0;
        echo "</strong>\n<table border='1' class='line'>";
        foreach($bio_inv_list as $bio_inv_row){
            echo "\n<tr><td>";
            echo ($row+1).". <strong>";
            echo anchor('bio_phi/edit_inv/edit_inv/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id.'/'.$bio_inv_list[$row]['bio_inv_id'], 'Edit');
            echo "</strong>\n<br />Ref. : ".$bio_inv_list[$row]['inv_ref'];
            echo "\n<br />Date : ".$bio_inv_list[$row]['inv_start_date'];
            echo "\n<br />Interviewee : ".$bio_inv_list[$row]['inv_main_name'];
            echo "\n<br />Relationship : ".$bio_inv_list[$row]['inv_main_relship'];
            echo "\n<br />Town : ".$bio_inv_list[$row]['inv_town'];
            echo "\n<br />Cluster : ".$bio_inv_list[$row]['inv_cluster_size'];
            echo "\n<br />Findings : ".$bio_inv_list[$row]['inv_findings'];
            echo "\n<br />Summary : ".$bio_inv_list[$row]['inv_summary'];
            echo "\n<br />Comments : ".$bio_inv_list[$row]['inv_comments'];
            $row++;
            echo "</td></tr>";
        }
        echo "\n</table>";
    }
}
echo "\n<hr /><h2>Clinical Episode</h2>";

echo "\nHospital : ";
echo $notify_info['clinic_name'];

echo "\n<br />Notification Date : ";
echo $notify_info['notify_date'];

echo "\n<br />Admission Date : ";
echo $notify_info['check_in_date'];

echo "\n<br />Date of Onset :";
echo $notify_info['started_date'];

echo "\n<br />Diagnosis : ";
echo $notify_info['dcode1ext_code']." <strong>".$notify_info['short_title']."</strong>";

echo "\n<br />Diagnosis Notes : ";
echo $notify_info['diagnosis_notes'];

echo "\n<br />Lab Test : ";
    if(count($lab_list)){
        echo "\n".$lab_list[0]['package_name'];
    } else {
        echo "\n&nbsp;Not tested.";
    }

echo "\n<br />Disease Confirmed<br />";
echo form_error('case_disease_confirmed');
    echo "\n<select name='case_disease_confirmed'>";
    echo "\n<option value=''>Please select one</option>";
    $diagnosis_selected = "";
    echo "\n<optgroup label='Notifiable Diseases in Sri Lanka'>";
    foreach ($common_diagnosis as $diagnosis){
        if($init_case_disease_confirmed == $diagnosis['dcode1ext_code']) {
            $diagnosis_selected = " selected='selected'";
        }
        echo "\n<option value='".$diagnosis['dcode1ext_code']."'$diagnosis_selected>".substr($diagnosis['short_title'],0,90)." [".$diagnosis['dcode1ext_code']."]</option>";
        $diagnosis_selected = "";
    }//endforeach;
    echo "\n</optgroup>";
    /*
    echo "\n<optgroup label='Others'>";
    foreach ($diagnosis_list as $diagnosis){
        if($init_case_disease_confirmed == $diagnosis['dcode1ext_code']) {
            $diagnosis_selected = " selected='selected'";
        }
        echo "\n<option value='".$diagnosis['dcode1ext_code']."'$diagnosis_selected>".substr($diagnosis['short_title'],0,90)." [".$diagnosis['dcode1ext_code']."]</option>";
        $diagnosis_selected = "";
    }//endforeach;
    echo "\n</optgroup>";
    */
    echo "\n</select>";

echo "\n<br />Date Confirmed :<br />";
echo form_error('date_disease_confirmed');
echo "<input type='text' name='date_disease_confirmed' value='".set_value('date_disease_confirmed',$init_date_disease_confirmed)."' size='10' /> YYYY-MM-DD";

echo "\n<br />Notification Ref.: ";
echo $notify_info['notify_ref'];

echo "\n<br />Notifiy Comments: ";
echo $notify_info['notify_comments'];

echo "\n<br />Where isolated  <font color='red'>*</font>";
echo form_error('case_location_isolation');
echo "\n<input type='radio' name='case_location_isolation' value='Home' ".set_radio('case_location_isolation','Home',($init_case_location_isolation=='Home'?TRUE:FALSE))." >Home</input>";
echo "\n<input type='radio' name='case_location_isolation' value='Hospital' ".set_radio('case_location_isolation','Hospital',($init_case_location_isolation=='Hospital'?TRUE:FALSE))." >Hospital</input>";
echo "\n<input type='radio' name='case_location_isolation' value='Not isolated' ".set_radio('case_location_isolation','Not isolated',($init_case_location_isolation=='Not isolated'?TRUE:FALSE))." >Not isolated</input>";

echo "\n<br />Discharged Date : <br />";
echo form_error('discharged_date');
echo "<input type='text' name='discharged_date' value='".set_value('discharged_date',$init_discharged_date)."' size='10' /> YYYY-MM-DD";

echo "\n<br />Clinical Outcome : ";
if(!isset($init_case_clinical_outcome)){
    $init_case_clinical_outcome  = "";
}echo form_error('case_clinical_outcome');
echo "\n<input type='radio' name='case_clinical_outcome' value='Recovered' ".set_radio('case_clinical_outcome','Recovered',($init_case_clinical_outcome=='Recovered'?TRUE:FALSE))." >Recovered</input>";
echo "\n<input type='radio' name='case_clinical_outcome' value='Died' ".set_radio('case_clinical_outcome','Died',($init_case_clinical_outcome=='Died'?TRUE:FALSE))." >Died</input>";


echo form_hidden('now_id', $now_id);
echo form_hidden('bio_case_id', $bio_case_id);
echo form_hidden('notification_id', $notification_id);
echo form_hidden('patient_id', $init_patient_id);
echo form_hidden('summary_id', $init_summary_id);
echo form_hidden('location_id', $init_location_id);
echo "<div><br /><input type='submit' value='Save' /></div>";

echo "</form>";

echo "\n<hr /><h2>Contact Info</h2>";

echo "\nAddress :<br />";
echo $patient_info['patient_address'];

echo "<br />".$patient_info['patient_address2'];

echo $patient_info['patient_address3'];

echo "<br />".$patient_info['patient_postcode'];

echo " ".$patient_info['patient_town'];

echo "<br />".$patient_info['patient_state'];

echo "\n<br />Tel. Home : ";
echo $patient_info['tel_home'];

echo "\n<br /><br />";
echo anchor('bio_hospital/edit_patient/new_notify/'.$patient_id, 'Edit Patient Details');


?>

</body>
</html>
