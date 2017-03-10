<?php

echo "\n<div align='center'><h1>THIRRA - Add New Notification</h1></div>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />notification_id = " . $notification_id;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(notify_info)=<br />";
		print_r($notify_info);
    echo "\n<br />print_r(rooms_list)=<br />";
		print_r($rooms_list);
    echo "\n<br />print_r(packages_list)=<br />";
		print_r($packages_list);
    echo "\n<br />print_r(queue_info)=<br />";
		print_r($queue_info);
	echo '</pre>';
    echo "\n</div>";
} //endif debug

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<br /><h1>".$save_attempt."</h1>";
echo form_open('bio_hospital/edit_notify544/'.$form_purpose.'/'.$patient_id);

echo "\n<fieldset>";
echo "<legend>BIO DATA</legend>";
echo "\n<table>";
echo "\n<tr><td width='170'>Patient Reference</td><td>";
echo $patient_info['clinic_reference_number']."</td></tr>";

echo "\n<tr><td>Name</td><td><strong>";
echo $patient_info['patient_name']."</strong></td></tr>";

echo "\n<tr><td>Other IC No.</td><td>";
echo $patient_info['ic_other_no']."</td></tr>";

echo "\n<tr><td>Gender</td><td>";
echo $patient_info['gender']."</td></tr>";

echo "\n<tr><td>Age</td><td>";
$formatted = sprintf("%01.1f",$est_age);
echo $formatted;
echo " years old</td></tr>";

echo "\n<tr><td>Birth Date</td><td>";
echo $patient_info['birth_date'];
if($patient_info['birth_date_estimate']) {
    echo " Estimated";
}
echo "</td></tr>";

echo "\n<tr><td>Guardian's Name</td><td>";
echo $patient_info['guardian_name']."</td></tr>";

echo "\n<tr><td>Guardian Relationship</td><td>";
echo $patient_info['guardian_relationship']."</td></tr>";

echo "\n<tr><td>&nbsp;</td><td>";
echo "</tr></table>";
echo "\n</fieldset>";

echo "\n<fieldset>";
echo "<legend>CLINICAL EPISODE</legend>";
echo "<table>";

echo "\n<tr><td width='170'>Hospital</td><td>";
    foreach ($clinic_info as $clinic){
        echo $clinic['clinic_name'];
    }//endforeach;
echo "</td></tr>\n";

echo "\n<tr><td>Date of Notification <font color='red'>*</font></td><td>";
echo form_error('notify_date');
echo "<input type='text' name='notify_date' value='".set_value('notify_date',$init_notify_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Date of Onset <font color='red'>*</font></td><td>";
echo form_error('onset_date');
echo "<input type='text' name='onset_date' id='date_delivery' value='".set_value('onset_date',$init_onset_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Date of Admission <font color='red'>*</font></td><td>"; //consultation date
echo form_error('visit_date');
echo "<input type='text' name='visit_date' value='".set_value('visit_date',$init_visit_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Date of Discharge</td><td>"; //consultation date
echo form_error('discharged_date');
echo "<input type='text' name='discharged_date' value='".set_value('discharged_date',$init_discharged_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Disease/Diagnosis <font color='red'>*</font></td><td>";
echo form_error('dcode1ext_code');
    echo "\n<select name='dcode1ext_code'>";
    echo "\n<option value=''>Please select one</option>";
    $diagnosis_selected = "";
    echo "\n<optgroup label='Notifiable Diseases in Sri Lanka'>";
    foreach ($common_diagnosis as $diagnosis){
        if($init_dcode1ext_code == $diagnosis['dcode1ext_code']) {
            $diagnosis_selected = " selected='selected'";
        }
        echo "\n<option value='".$diagnosis['dcode1ext_code']."'$diagnosis_selected>".substr($diagnosis['short_title'],0,90)." &nbsp; [".$diagnosis['dcode1ext_code']."]</option>";
        $diagnosis_selected = "";
    }//endforeach;
    echo "\n</optgroup>";
    echo "\n<optgroup label='Others'>";
    foreach ($diagnosis_list as $diagnosis){
        if($init_dcode1ext_code == $diagnosis['dcode1ext_code']) {
            $diagnosis_selected = " selected='selected'";
        }
        echo "\n<option value='".$diagnosis['dcode1ext_code']."'$diagnosis_selected>".substr($diagnosis['short_title'],0,90)." [".$diagnosis['dcode1ext_code']."]</option>";
        $diagnosis_selected = "";
    }//endforeach;
    echo "\n</optgroup>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td valign='top'>Diagnosis Notes</td><td>";
echo form_error('diagnosis_notes');
//echo "<input type='text' name='diagnosis_notes' value='".set_value('diagnosis_notes',$init_diagnosis_notes)."' size='80' /> </td></tr>";
echo "<textarea class='normal' name='diagnosis_notes' cols='50' rows='4'>".set_value('diagnosis_notes',$init_diagnosis_notes)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td>MOH Notification No. <font color='red'>*</font></td><td>";
echo form_error('notify_ref');
echo "<input type='text' name='notify_ref' value='".set_value('notify_ref',$init_notify_ref)."' size='12' /> </td></tr>";

echo "\n<tr><td>BHT No. <font color='red'>*</font></td><td>";
echo form_error('bht_no');
echo "<input type='text' name='bht_no' value='".set_value('bht_no',$init_bht_no)."' size='12' /> </td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Ward <font color='red'>*</font></td>";
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

echo "<tr>";
    echo "\n<td width='25%'>Lab Package</td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='lab_package_id' class='normal' id='lab_package_id'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($packages_list as $package_item)
        {
            echo "\n<option value='".rtrim($package_item['lab_package_id'])."'";
            echo ($lab_package_id == rtrim($package_item['lab_package_id']) ? " selected='selected'" : "");
            echo ">".$package_item['package_code']." - ".$package_item['package_name']." (".$package_item['supplier_name'].")</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td valign='top'>Lab Results</td><td>";
echo form_error('lab_result');
echo "<textarea class='normal' name='lab_result' cols='50' rows='4'>".set_value('lab_result',$init_lab_result)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td valign='top'>Notify Comments</td><td>";
echo form_error('notify_comments');
//echo "<input type='text' name='notify_comments' value='".set_value('notify_comments',$init_notify_comments)."' size='80' /> </td></tr>";
echo "<textarea class='normal' name='notify_comments' cols='50' rows='4'>".set_value('notify_comments',$init_notify_comments)."</textarea>";
echo " </td></tr>";

echo "\n<tr><td>&nbsp;</td><td>";
echo "</tr></table>";
echo "\n</fieldset>";

echo form_hidden('now_id', $now_id);
echo form_hidden('notification_id', $notification_id);
echo form_hidden('patient_id', $patient_info['patient_id']);
echo form_hidden('summary_id', $init_summary_id);
echo form_hidden('location_id', $init_location_id);
if(isset($notify_info)){
    echo form_hidden('adt_id', $notify_info['adt_id']);
    echo form_hidden('diagnosis_id', $notify_info['diagnosis_id']);
    echo form_hidden('orig_dcode1ext_code', $init_dcode1ext_code);
} else {
    $notify_info    =   array();
    echo form_hidden('adt_id', NULL);
    echo form_hidden('diagnosis_id', NULL);
    echo form_hidden('orig_dcode1ext_code', NULL);
}


echo "\n<div align='center'><br /><input type='submit' value='Create/Edit Notification' /></div>";

echo "\n</form>";

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

?>
<script  type="text/javascript">

$(function() {
    $( "#date_delivery" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        yearRange: 'c-100:c'
    });
});


$(function() {
    $( "#date_admission" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true,
        yearRange: 'c-100:c'
    });
});



</script>

