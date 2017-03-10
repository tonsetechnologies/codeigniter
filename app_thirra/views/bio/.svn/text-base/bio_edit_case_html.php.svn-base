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

echo "\n<div align='center'><h1>THIRRA - Case</h1></div>";
//$map_server = "http://jasontan.getmyip.com";
//$map_server = "http://202.9.99.46:84";
//$map_server = "http://thirra-my.dnsalias.net";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />bio_case_id = " . $bio_case_id;
    print "\n<br />notification_id = " . $notification_id;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(clinic_info)=<br />";
		print_r($clinic_info);
    echo "\n<br />print_r(clinics_list)=<br />";
		print_r($clinics_list);
    echo "\n<br />print_r(notify_info)=<br />";
		print_r($notify_info);
    echo "\n<br />print_r(bio_case_details)=<br />";
		print_r($bio_case_details);
    echo "\n<br />print_r(bio_inv_list)=<br />";
		print_r($bio_inv_list);
	echo '</pre>';
    echo "\n</div>";
} //endif debug

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<br /><h1>".$save_attempt."</h1>";
echo form_open('bio_phi/edit_case/'.$form_purpose.'/'.$patient_id.'/'.$notification_id);
echo form_hidden('now_id', $now_id);
echo form_hidden('bio_case_id', $bio_case_id);
echo form_hidden('notification_id', $notification_id);
echo form_hidden('patient_id', $init_patient_id);
echo form_hidden('summary_id', $init_summary_id);
//echo form_hidden('location_id', $init_location_id);

echo "\n<fieldset>";
echo "<legend>PATIENT INFO</legend>";
echo "\n<table>";
echo "\n<tr><td width='170'>Clinic Ref.</td><td>";
echo $patient_info['clinic_reference_number']."</td></tr>";

echo "\n<tr><td>Name</td><td><strong>";
echo $patient_info['patient_name']."</strong></td></tr>";

echo "\n<tr><td>Other IC No.</td><td>";
echo $patient_info['ic_other_no']."</td></tr>";

echo "\n<tr><td>Sex</td><td>";
echo $patient_info['gender']."</td></tr>";

echo "\n<tr><td>Age</td><td>";
//echo $patient_info['birth_date']."</td></tr>";
$formatted = sprintf("%01.1f",$est_age);
echo $formatted;
echo " years</td></tr>";

echo "\n<tr><td>&nbsp;</td><td>";
echo "</tr></table>";
echo "\n</fieldset>";

echo "\n<fieldset>";
echo "<legend>CASE DETAILS</legend>";
echo "<table>";

echo "\n<tr><td>PHI Range</td><td>";
echo form_error('phi_range');
    echo "\n<select name='phi_range'>";
    foreach($clinics_list as $clinic){
        echo "\n<option value='".$clinic['clinic_info_id']."'".($init_location_id==$clinic['clinic_info_id']?' selected=\'selected\'':'').">".$clinic['clinic_name']."</option>";
    }
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td width='170'>MOH Register No. <font color='red'>*</font></td><td>";
echo form_error('case_ref');
echo "<input type='text' name='case_ref' value='".set_value('case_ref',$init_case_ref)."' size='12' /> </td></tr>";

echo "\n<tr><td>PHI Reference No. <font color='red'>*</font></td><td>";
echo form_error('bio_phi_ref');
echo "<input type='text' name='bio_phi_ref' value='".set_value('bio_phi_ref',$init_bio_phi_ref)."' size='12' /> </td></tr>";

echo "\n<tr><td>Start Case Date <font color='red'>*</font></td><td>";
echo form_error('case_start_date');
echo "<input type='text' name='case_start_date' value='".set_value('case_start_date',$init_case_start_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>End Case Date</td><td>";
echo form_error('case_end_date');
echo "<input type='text' name='case_end_date' value='".set_value('case_end_date',$init_case_end_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td valign='top'>Patient's movements during 3 weeks prior to onset</td><td>";
echo form_error('case_prior_movements');
echo "<textarea class='normal' name='case_prior_movements' cols='50' rows='4'>".set_value('case_prior_movements',$init_case_prior_movements)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td valign='top'>Case findings</td><td>";
echo form_error('case_findings');
//echo "<input type='text' name='case_findings' value='".set_value('case_findings',$init_case_findings)."' size='80' />";
echo "<textarea class='normal' name='case_findings' cols='50' rows='4'>".set_value('case_findings',$init_case_findings)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td>Nature of case</td><td valign='top'>";
if(!isset($init_case_outbreak_degree)){
    $init_case_outbreak_degree  = "";
}
echo form_error('case_outbreak_degree');
echo "\n<input type='radio' name='case_outbreak_degree' value='Isolated case' ".set_radio('case_outbreak_degree','Isolated case',($init_case_outbreak_degree=='Isolated case'?TRUE:FALSE))." >Isolated case</input>";
echo "\n<input type='radio' name='case_outbreak_degree' value='Infecting' ".set_radio('case_outbreak_degree','Infecting',($init_case_outbreak_degree=='Infecting'?TRUE:FALSE))." >Infecting</input>";
echo "\n</td></tr>";

echo "\n<tr><td>One case in outbreak</td><td valign='top'>";
if(!isset($init_case_in_outbreak)){
    $init_case_in_outbreak  = "";
}echo form_error('case_in_outbreak');
echo "\n<input type='radio' name='case_in_outbreak' value='Yes' ".set_radio('case_in_outbreak','Yes',($init_case_in_outbreak=='Yes'?TRUE:FALSE))." >Yes</input>";
echo "\n<input type='radio' name='case_in_outbreak' value='No' ".set_radio('case_in_outbreak','No',($init_case_in_outbreak=='No'?TRUE:FALSE))." >No</input>";
echo "\n</td></tr>";

echo "\n<tr><td valign='top'>Case summary</td><td>";
echo form_error('case_summary');
//echo "<input type='text' name='case_summary' value='".set_value('case_summary',$init_case_summary)."' size='80' />";
echo "<textarea class='normal' name='case_summary' cols='50' rows='4'>".set_value('case_summary',$init_case_summary)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td valign='top'>Case comments</td><td>";
echo form_error('case_comments');
//echo "<input type='text' name='case_comments' value='".set_value('case_comments',$init_case_comments)."' size='80' />";
echo "<textarea class='normal' name='case_comments' cols='50' rows='4'>".set_value('case_comments',$init_case_comments)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td>Alert status</td><td>";
echo form_error('alert_now');
echo "<input type='text' name='alert_now' value='".set_value('alert_now',$init_alert_now)."' size='1' />"; 
if(isset($init_alert_max)) {
    echo  "Highest was ".$init_alert_max;
}
echo "</td></tr>";

echo "\n<tr><td valign='top'>GPS coordinates</td><td>";
echo "Latitude ";
echo form_error('gps_lat');
echo "<input type='text' name='gps_lat' value='".set_value('gps_lat',$init_gps_lat)."' size='20' /> ";
echo "Longitude ";
echo form_error('gps_long');
echo "<input type='text' name='gps_long' value='".set_value('gps_long',$init_gps_long)."' size='20' /> </td></tr>";

echo "\n<tr><td><br /><u>INVESTIGATION(S)</u></td>";
if($form_purpose == "new_case"){
    echo "\n<td><br />Add investigations after creating a new case.</td></tr>";
} else {
    echo "<td><br />". anchor('bio_phi/edit_inv/new_inv/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id.'/new_inv', 'Write New') ."</td></tr>";
    //echo "<tr><td>&nbsp;</td>";
    //echo "<td>". anchor('bio/edit_inv/new_inv/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id.'/'.$bio_inv_id, 'Edit') ."</td></tr>";
    if(isset($bio_inv_list)){
        $row    =   0;
        echo "\n<tr><td></td><td>";
        echo "\n<table border='1' class='line'>";
        echo "\n<th>&nbsp;</th>";
        echo "\n<th>&nbsp;</th>";
        echo "\n<th>Ref.</th>";
        echo "\n<th>Date</th>";
        echo "\n<th>Interviewee</th>";
        echo "\n<th>Relationship</th>";
        echo "\n<th>Town</th>";
        echo "\n<th>Cluster</th>";
        echo "\n<th>Findings</th>";
        echo "\n<th>Summary</th>";
        echo "\n<th>Comments</th>";
        $has_gps    =   0;
        foreach($bio_inv_list as $bio_inv_row){
            echo "\n<tr><td>".($row+1).".</td><td>";
            echo anchor('bio_phi/edit_inv/edit_inv/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id.'/'.$bio_inv_list[$row]['bio_inv_id'], 'Edit');
            echo "\n</td><td>".$bio_inv_list[$row]['inv_ref'];
            echo "\n</td><td>".$bio_inv_list[$row]['inv_start_date'];
            echo "\n</td><td>".$bio_inv_list[$row]['inv_main_name'];
            echo "\n</td><td>".$bio_inv_list[$row]['inv_main_relship'];
            echo "\n</td><td>".$bio_inv_list[$row]['inv_town'];
            echo "\n</td><td>".$bio_inv_list[$row]['inv_cluster_size'];
            echo "\n</td><td>".$bio_inv_list[$row]['inv_findings'];
            echo "\n</td><td>".$bio_inv_list[$row]['inv_summary'];
            echo "\n</td><td>".$bio_inv_list[$row]['inv_comments'];
            echo "\n</td><td>".$bio_inv_list[$row]['inv_gps_lat'];
            echo "\n</td><td>".$bio_inv_list[$row]['inv_gps_long'];
            if( !empty($bio_inv_list[$row]['inv_gps_lat']) && !empty($bio_inv_list[$row]['inv_gps_long']) ){
                $has_gps++;
                $pt[$has_gps]=$bio_inv_list[$row]['inv_gps_lat']."-".$bio_inv_list[$row]['inv_gps_long'];
            }
            echo "\n</td></tr>";
            $row++;
        }
        echo "\n</table>";
        //echo "has_gps=".$has_gps;
        if($has_gps > 0){
            //print_r($pt);
            echo "\n<a href='".$map_server."case_map.php?";
            for($i=1; $i <= $has_gps; $i++){
                echo "p$i=".$pt[$i]."&";
            }
            //lat=$init_inv_gps_lat&long=$init_inv_gps_long'
            echo "has=$has_gps' target='_blank'>Map</a>";
        }
        echo "</td></tr>";
    }
} //endif

echo "</table>";
echo "\n</fieldset>";

echo "\n<fieldset>";
echo "<legend>CLINICAL EPISODE</legend>";

echo "\n<table>";
echo "\n<tr><td width='170'>Hospital</td><td>";
echo $notify_info['clinic_name'];
echo "</td></tr>\n";

echo "\n<tr><td>Notification Date</td><td>";
echo $notify_info['notify_date']."</td></tr>";

echo "\n<tr><td>Admission Date</td><td>";
echo $notify_info['check_in_date']."</td></tr>";

echo "\n<tr><td>Date of Onset</td><td>";
echo $notify_info['started_date']."</td></tr>";

echo "\n<tr><td>Disease Notifiied</td><td>";
echo $notify_info['dcode1ext_code']." <strong>".$notify_info['short_title']."</strong></td></tr>";

echo "\n<tr><td>Diagnosis Notes</td><td>";
echo $notify_info['diagnosis_notes']."</td></tr>";

echo "\n<tr><td>Lab Test</td><td>";
    if(count($lab_list)){
        echo "\n".$lab_list[0]['package_name'];
    } else {
        echo "\n&nbsp;Not tested.";
    }
echo "</td></tr>";

echo "\n<tr><td>Disease Confirmed</td><td>";
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
    echo "\n<optgroup label='Others'>";
    foreach ($diagnosis_list as $diagnosis){
        if($init_case_disease_confirmed == $diagnosis['dcode1ext_code']) {
            $diagnosis_selected = " selected='selected'";
        }
        echo "\n<option value='".$diagnosis['dcode1ext_code']."'$diagnosis_selected>".substr($diagnosis['short_title'],0,90)." [".$diagnosis['dcode1ext_code']."]</option>";
        $diagnosis_selected = "";
    }//endforeach;
    echo "\n</optgroup>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Date Confirmed</td><td>";
echo form_error('date_disease_confirmed');
echo "<input type='text' name='date_disease_confirmed' value='".set_value('date_disease_confirmed',$init_date_disease_confirmed)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Notification Ref.</td><td>";
echo $notify_info['notify_ref']."</td></tr>";

echo "\n<tr><td>Notifiy Comments</td><td>";
echo $notify_info['notify_comments']."</td></tr>";

echo "\n<tr><td>Where isolated  <font color='red'>*</font></td><td>";
echo form_error('case_location_isolation');
echo "\n<input type='radio' name='case_location_isolation' value='Home' ".set_radio('case_location_isolation','Home',($init_case_location_isolation=='Home'?TRUE:FALSE))." >Home</input>";
echo "\n<input type='radio' name='case_location_isolation' value='Hospital' ".set_radio('case_location_isolation','Hospital',($init_case_location_isolation=='Hospital'?TRUE:FALSE))." >Hospital</input>";
echo "\n<input type='radio' name='case_location_isolation' value='Not isolated' ".set_radio('case_location_isolation','Not isolated',($init_case_location_isolation=='Not isolated'?TRUE:FALSE))." >Not isolated</input>";
echo "\n</td></tr>";

echo "\n<tr><td>Date of Discharge</td><td>"; //consultation date
echo form_error('discharged_date');
echo "<input type='text' name='discharged_date' value='".set_value('discharged_date',$init_discharged_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Clinical Outcome</td><td valign='top'>";
if(!isset($init_case_clinical_outcome)){
    $init_case_clinical_outcome  = "";
}echo form_error('case_clinical_outcome');
echo "\n<input type='radio' name='case_clinical_outcome' value='Recovered' ".set_radio('case_clinical_outcome','Recovered',($init_case_clinical_outcome=='Recovered'?TRUE:FALSE))." >Recovered</input>";
echo "\n<input type='radio' name='case_clinical_outcome' value='Died' ".set_radio('case_clinical_outcome','Died',($init_case_clinical_outcome=='Died'?TRUE:FALSE))." >Died</input>";
echo "\n</td></tr>";

echo "\n<tr><td>&nbsp;</td><td>";
echo "</tr>";
echo "<tr><td>&nbsp;</td>";
echo "<td><div align='center'><br /><input type='submit' value='Create/Save' /></div>";
echo "</form>";
echo "</td>";
echo "\n</tr>";
echo "</table>";
echo "\n</fieldset>";

echo "\n<fieldset>";
echo "<legend>CONTACT INFO</legend>";

echo "<table>";
echo "\n<tr><td width='170'>Address</td><td>";
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

echo "\n</fieldset>";



