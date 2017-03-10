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
 * Portions created by the Initial Developer are Copyright (C) 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";

echo "\n<body>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />user_id = " . $user_id;
    print "\n<br />referral_id = " . $referral_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
		print_r($user_info);
    echo "\n<br />print_r(referral_info)=<br />";
		print_r($referral_info);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_refer_out_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<table class='header valigntop'>";
echo "\n<tr>";
    echo "<td width='25%'>Referral Centre</td><td>";
    echo $referral_centre;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Referral Specialty</td><td>";
    echo $referral_specialty;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Referral Doctor's Name</td><td>";
    echo $referral_doctor_name;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Notify by e-mail</td><td>";
    echo anchor('indv/indv/index/indv_refer/ehr_individual_refer/draft_notify_email/new_draft/'.$patient_id.'/'.$summary_id.'/'.$referral_id, 'Send email',"target='_blank'");
    //echo form_open('ehr_individual_refer/draft_notify_email/new_draft/'.$patient_id.'/'.$summary_id.'/'.$referral_id);
    //echo "\n<input type='text' id='referral_email' name='referral_email' value='".set_value('referral_email',$doctor_email)."' size='30' />";
    //echo form_hidden('referral_doctor_name', $referral_doctor_name);
    //echo "<input type='submit' value='Send e-mail' />";
    //echo "</form>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Referral Date</td><td>";
    echo $referral_date;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Referral Reference</td><td>";
    echo $referral_reference;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Referred By</td><td>";
    echo $referred_by;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Reason</td><td>";
    echo $reason;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Clinical Exam</td><td>";
    echo $clinical_exam;
    echo "</td>";
echo "</tr>";
echo "</table>";

echo "<fieldset>";
echo "<legend>Transmit Data</legend>";
echo "\n<table class='header valigntop'>";
echo "\n<tr>";
    echo "<td>Referral Server</td><td>";
    echo $thirra_url;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Push data to remote server</td>";
    echo "<td valign='top'>";
    if(!empty($thirra_url)){
        //echo anchor('ehr_individual_refer/check_remote_patient_existence/check_patient/'.$patient_id.'/'.$summary_id.'/'.$referral_id, 'EDI', 'target="_blank"');
        echo form_open('indv/indv/index/indv_refer/ehr_individual_refer/check_remote_patient_existence/check_patient/'.$patient_id.'/'.$summary_id.'/'.$referral_id);
        echo "There is a possibility that patient is already registered but with minor spelling differences.<br />";
        echo "\nSubstring Search : <input type='text' id='substring_search' name='substring_search' value='".substr($patient_info['name'],0,$substring_length)."' size='30' />";
        echo "<input type='submit' value='Check referral server' />";
        echo "</form>";
    } else {
        echo "URL of remote server not given.";
    }
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Prepare data (Plan B)</td><td>";
    echo anchor('indv/indv/index/indv_refer/ehr_individual_refer/refer_select_details/new_export/'.$patient_id.'/'.$summary_id.'/'.$referral_id, 'Export XML', 'target="_blank"')."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td>Print Referral Letter</td>";
    echo "\n<td valign='top'>";
    echo "\nGeneric : ";
    echo anchor('indv/indv/index/indv_refer/ehr_individual_refer/print_referral_letter/print_hardcopy/'.$patient_id.'/'.$summary_id.'/'.$referral_id.'/Gen/html', 'HTML', 'target="_blank"');
    echo ", ";
    echo anchor('indv/indv/index/indv_refer/ehr_individual_refer/print_referral_letter/print_hardcopy/'.$patient_id.'/'.$summary_id.'/'.$referral_id.'/Gen/pdf', 'PDF', 'target="_blank"');
    echo "\n<br />MY : ";
    echo anchor('indv/indv/index/indv_refer/ehr_individual_refer/print_referral_letter/print_hardcopy/'.$patient_id.'/'.$summary_id.'/'.$referral_id.'/MY/html', 'HTML', 'target="_blank"');
    echo ", ";
    echo anchor('indv/indv/index/indv_refer/ehr_individual_refer/print_referral_letter/print_hardcopy/'.$patient_id.'/'.$summary_id.'/'.$referral_id.'/MY/pdf', 'PDF', 'target="_blank"');
    echo "\n<br />NP : ";
    echo anchor('indv/indv/index/indv_refer/ehr_individual_refer/print_referral_letter/print_hardcopy/'.$patient_id.'/'.$summary_id.'/'.$referral_id.'/NP/html', 'HTML', 'target="_blank"');
    echo ", ";
    echo anchor('indv/indv/index/indv_refer/ehr_individual_refer/print_referral_letter/print_hardcopy/'.$patient_id.'/'.$summary_id.'/'.$referral_id.'/NP/pdf', 'PDF', 'target="_blank"');
    echo "\n<br />PH : ";
    echo anchor('indv/indv/index/indv_refer/ehr_individual_refer/print_referral_letter/print_hardcopy/'.$patient_id.'/'.$summary_id.'/'.$referral_id.'/PH/html', 'HTML', 'target="_blank"');
    echo ", ";
    echo anchor('indv/indv/index/indv_refer/ehr_individual_refer/print_referral_letter/print_hardcopy/'.$patient_id.'/'.$summary_id.'/'.$referral_id.'/PH/pdf', 'PDF', 'target="_blank"');
echo "</tr>";
echo "\n</table>";
echo "</fieldset>";


echo form_open('indv/indv/index/indv_refer/ehr_individual_refer/edit_referral_out/'.$form_purpose.'/'.$patient_id.'/'.$summary_id.'/'.$referral_id);

echo "<fieldset>";
echo "<legend>Response</legend>";
echo "\n<table>";
echo "\n<tr><td>Date replied <font color='red'>*</font></td><td>";
echo form_error('date_replied');
echo "\n<input type='text' name='date_replied' value='".set_value('date_replied',$init_date_replied)."' size='10' id='result_datepicker' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Replying doctor's name <font color='red'>*</font></td><td>";
echo form_error('replying_doctor');
echo "\n<input type='text' id='replying_doctor' name='replying_doctor' value='".set_value('replying_doctor',$init_replying_doctor)."' size='50' /></td></tr>";

echo "\n<tr><td>Replying doctor's specialty</td><td>";
echo form_error('replying_specialty');
echo "\n<input type='text' id='replying_specialty' name='replying_specialty' value='".set_value('replying_specialty',$init_replying_specialty)."' size='50' /></td></tr>";

echo "\n<tr><td>Replying centre</td><td>";
echo form_error('replying_centre');
echo "\n<input type='text' id='replying_centre' name='replying_centre' value='".set_value('replying_centre',$init_replying_centre)."' size='50' /></td></tr>";

echo "\n<tr><td>Replying department</td><td>";
echo form_error('department');
echo "\n<input type='text' id='department' name='department' value='".set_value('department',$init_department)."' size='50' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Findings</td>";
    echo "\n<td>";
    echo form_error('findings');
    echo "\n<textarea class='normal' name='findings' id='findings' cols='50' rows='5'>".$init_findings."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Investigation</td>";
    echo "\n<td>";
    echo form_error('investigation');
    echo "\n<textarea class='normal' name='investigation' id='investigation' cols='50' rows='5'>".$init_investigation."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Diagnosis</td>";
    echo "\n<td>";
    echo form_error('diagnosis');
    echo "\n<textarea class='normal' name='diagnosis' id='diagnosis' cols='50' rows='5'>".$init_diagnosis."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Treatment</td>";
    echo "\n<td>";
    echo form_error('treatment');
    echo "\n<textarea class='normal' name='treatment' id='treatment' cols='50' rows='5'>".$init_treatment."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Plan</td>";
    echo "\n<td>";
    echo form_error('plan');
    echo "\n<textarea class='normal' name='plan' id='plan' cols='50' rows='5'>".$init_plan."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Comments</td>";
    echo "\n<td>";
    echo form_error('comments');
    echo "\n<textarea class='normal' name='comments' id='comments' cols='50' rows='5'>".$init_comments."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";
echo "\n<br /><input type='checkbox' name='close_loop' id='close_loop' value='TRUE'";
echo "\n /> Close referral loop<br />";

echo "</fieldset>";


echo form_hidden('now_id', $now_id);
echo form_hidden('referral_id', $referral_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Record Response' />";
echo "</div>";

echo "</form>";

echo "</div>"; //id=content
?>
<script  type="text/javascript">
    $(function() {
        $( "#result_datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });

    });

</script>
