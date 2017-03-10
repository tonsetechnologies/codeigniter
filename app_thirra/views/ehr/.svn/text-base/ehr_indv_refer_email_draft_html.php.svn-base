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
    print "\n<br />summary_id = " . $summary_id;
    print "\n<br />referral_id = " . $referral_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(clinic_info)=<br />";
		print_r($clinic_info);
    echo "\n<br />print_r(referral_info)=<br />";
		print_r($referral_info);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_draft_refer_out_email_html_title')."</h1></div>";

//echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


if($form_purpose == "new_draft"){

    $email_subject    =   "Patient Referral from ".$from_name;
    $email_salutation =   "Dear Sir";
    $email_paragraph1 =   "I am sending the following patient to ".$referral_centre." for your examination.";
    $email_paragraph2 =   "I would appreciate if you can send us a reply after you have completed your examination.";
    $email_conclusion =   "Yours sincerely,";

} else {

}


if($form_purpose == "edit_draft"){
    echo "<fieldset>";
    echo "<legend>Review Draft e-mail</legend>";
    echo "<p><strong>".$email_subject."</strong></p>";
    echo $email_salutation.",";
    echo "<p>".$email_paragraph1."</p>";
    echo "\n<br />The details of the patient are as follows:";
    echo "<table class='valigntop'>";
    echo "\n<tr>";
        echo "<td>Patient Name</td><td>";
        echo ": &nbsp;";
        echo $patient_name;
        echo "</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "<td>Birth Date</td><td>";
        echo ": &nbsp;";
        echo $patient_info['birth_date'];
        echo "</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "<td>Gender</td><td>";
        echo ": &nbsp;";
        echo $patient_info['gender'];
        echo "</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "<td>Reference</td><td>";
        echo ": &nbsp;";
        echo $referral_reference;
        echo "</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "<td>Referal Date</td><td>";
        echo ": &nbsp;";
        echo $referral_date;
        echo "</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "<td>Reason</td><td>";
        echo ": &nbsp;";
        echo $reason;
        echo "</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "<td>Clinical Exam</td><td>";
        echo ": &nbsp;";
        echo $clinical_exam;
        echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "<p>".$email_paragraph2."</p>";
    echo "<p>".$email_conclusion."</p>";
    echo $referout_doctor_name;
    echo "</fieldset>";
    echo "<hr />";
}

echo "\n<table class='header valigntop' width='100%' align='center'>";
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
    echo "<td>Referral Date</td><td>";
    echo $referral_date;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Referral Reference</td><td>";
    echo $referral_reference;
    echo "</td>";
echo "</tr>";
echo "\n</table>";


echo form_open('ehr_individual_refer/draft_notify_email/'.$form_purpose.'/'.$patient_id.'/'.$summary_id.'/'.$referral_id);

echo "<fieldset>";
echo "<legend>Edit Draft</legend>";

echo "\n<table>";
echo "\n<tr>";
    echo "<td width='20%'>FROM</td><td>";
    echo $from_name." &lt;".$from_email."&gt;";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>TO</td><td>";
    echo form_error('referral_email');
    echo "\n<input type='text' id='referral_doctor_name' name='referral_doctor_name' value='".set_value('referral_doctor_name',$referral_doctor_name)."' size='30' />";
    echo "&lt;";
    echo "\n<input type='text' id='referral_email' name='referral_email' value='".set_value('referral_email',$referral_email)."' size='30' />";
    echo "&gt;";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>CC.</td><td>";
    echo form_error('cc_email');
    echo "\n<input type='text' id='cc_name' name='cc_name' value='".set_value('cc_name',$cc_name)."' size='30' />";
    echo "&lt;";
    echo "\n<input type='text' id='cc_email' name='cc_email' value='".set_value('cc_email',$cc_email)."' size='30' />";
    echo "&gt;";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>SUBJECT</td><td>";
    echo form_error('email_subject');
    echo "\n<input type='text' id='email_subject' name='email_subject' value='".$email_subject."' size='60' />";
    echo "</td>";
echo "</tr>";
echo "\n</table>";

echo "<br />";
echo "\n<input type='text' id='email_salutation' name='email_salutation' value='".set_value('email_salutation',$email_salutation)."' size='20' />,";

echo "<br />Paragraph 1<br />";
echo "\n<textarea class='normal' name='email_paragraph1' id='email_paragraph1' cols='80' rows='5'>".$email_paragraph1."</textarea>";


echo "\n<br />The details of the patient are as follows:";
echo "<table class='valigntop'>";
echo "\n<tr>";
    echo "<td>Patient Name</td><td>";
    echo ": &nbsp;";
    echo $patient_name;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Birth Date</td><td>";
    echo ": &nbsp;";
    echo $patient_info['birth_date'];
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Gender</td><td>";
    echo ": &nbsp;";
    echo $patient_info['gender'];
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Reference</td><td>";
    echo ": &nbsp;";
    echo $referral_reference;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Referral Date</td><td>";
    echo ": &nbsp;";
    echo $referral_date;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Reason</td><td>";
    echo ": &nbsp;";
    echo $reason;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Clinical Exam</td><td>";
    echo ": &nbsp;";
    echo $clinical_exam;
    echo "</td>";
echo "</tr>";
echo "</table>";


echo "<br />Paragraph 2<br />";
echo "\n<textarea class='normal' name='email_paragraph2' id='email_paragraph2' cols='80' rows='5'>".$email_paragraph2."</textarea>";

echo "<br />Conclusion<br />";
echo "\n<textarea class='normal' name='email_conclusion' id='email_conclusion' cols='80' rows='3'>".$email_conclusion."</textarea>";

echo "<br />".$referout_doctor_name;

echo "</fieldset>";



echo form_hidden('now_id', $now_id);
echo form_hidden('referral_id', $referral_id);

echo "<div align='center'><br />";
echo "<input type='submit' name='button_preview' value='Preview' />&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type='submit' name='button_send' value='Send e-mail' />";
echo "</div>";

echo "</form>";

echo "</div>"; //id=content

