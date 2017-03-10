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
    echo "\n</div>";
} //endif debug

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<br /><h1>".$save_attempt."</h1>";
echo form_open('bio_hospital/edit_notify/'.$form_purpose.'/'.$patient_id);

echo "\n<fieldset>";
echo "<legend>BIO DATA</legend>";
echo "\n<table>";
echo "\n<tr><td width='170'>PATIENT BIODATA</td><td>";
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
echo "\n</fieldset>";

echo "\n<fieldset>";
echo "<legend>CLINICAL EPISODE</legend>";
echo "<table>";

echo "\n<tr><td width='170'>Hospital</td><td>";
    foreach ($clinic_info as $clinic){
        echo $clinic['clinic_name'];
    }//endforeach;
echo "</td></tr>\n";

echo "\n<tr><td>Date of Admission <font color='red'>*</font></td><td>"; //consultation date
echo form_error('visit_date');
echo "<input type='text' name='visit_date' value='".set_value('visit_date',$init_visit_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Date of Onset <font color='red'>*</font></td><td>";
echo form_error('started_date');
echo "<input type='text' name='started_date' value='".set_value('started_date',$init_started_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Diagnosis <font color='red'>*</font></td><td>";
echo form_error('dcode1ext_code');
    echo "\n<select name='dcode1ext_code'>";
    echo "\n<option value=''>Please select one</option>";
    $diagnosis_selected = "";
    echo "\n<optgroup label='Notifiable Diseases in Sri Lanka'>";
    foreach ($common_diagnosis as $diagnosis){
        if($init_dcode1ext_code == $diagnosis['dcode1ext_code']) {
            $diagnosis_selected = " selected='selected'";
        }
        echo "\n<option value='".$diagnosis['dcode1ext_code']."'$diagnosis_selected>".substr($diagnosis['dcode1ext_longname'],0,90)." [".$diagnosis['dcode1ext_code']."]</option>";
        $diagnosis_selected = "";
    }//endforeach;
    echo "\n</optgroup>";
    echo "\n<optgroup label='Others'>";
    foreach ($diagnosis_list as $diagnosis){
        if($init_dcode1ext_code == $diagnosis['dcode1ext_code']) {
            $diagnosis_selected = " selected='selected'";
        }
        echo "\n<option value='".$diagnosis['dcode1ext_code']."'$diagnosis_selected>".substr($diagnosis['dcode1ext_longname'],0,90)." [".$diagnosis['dcode1ext_code']."]</option>";
        $diagnosis_selected = "";
    }//endforeach;
    echo "\n</optgroup>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Diagnosis Notes</td><td>";
echo form_error('diagnosis_notes');
//echo "<input type='text' name='diagnosis_notes' value='".set_value('diagnosis_notes',$init_diagnosis_notes)."' size='80' /> </td></tr>";
echo "<textarea class='normal' name='diagnosis_notes' value='".set_value('diagnosis_notes',$init_diagnosis_notes)."' cols='50' rows='4'></textarea>";
echo " </td></tr>";

echo "\n<tr><td>MOH Notification No.</td><td>";
echo form_error('notify_ref');
echo "<input type='text' name='notify_ref' value='".set_value('notify_ref',$init_notify_ref)."' size='12' /> </td></tr>";

echo "\n<tr><td>BHT No.</td><td>";
echo form_error('bht_no');
echo "<input type='text' name='bht_no' value='".set_value('bht_no',$init_bht_no)."' size='12' /> </td></tr>";

echo "\n<tr><td>Notify Comments</td><td>";
echo form_error('notify_comments');
//echo "<input type='text' name='notify_comments' value='".set_value('notify_comments',$init_notify_comments)."' size='80' /> </td></tr>";
echo "<textarea class='normal' name='notify_comments' value='".set_value('notify_comments',$init_notify_comments)."' cols='50' rows='4'></textarea>";
echo " </td></tr>";

echo "\n<tr><td>&nbsp;</td><td>";
echo "</tr></table>";
echo "\n</fieldset>";

echo form_hidden('now_id', $now_id);
echo form_hidden('notification_id', $notification_id);
echo form_hidden('patient_id', $patient_info['patient_id']);
echo form_hidden('summary_id', $init_summary_id);
echo form_hidden('location_id', $init_location_id);


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
echo anchor('bio/edit_patient/new_notify/'.$patient_id, 'Edit Patient Details');
echo "</td></tr>\n";
echo "</table>";

echo "\n</fieldset>";


