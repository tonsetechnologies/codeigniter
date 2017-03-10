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

echo "\n\n<div id='content'>";
if($debug_mode) {
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(person_info)=<br />";
		print_r($person_info);
	echo '</pre>';
    echo "\n<br />complaint_id=".$complaint_id;
    echo "\n<br />referral_center_id=".$referral_center_id;
    echo "\n<br />referral_doctor_id=".$referral_doctor_id;
    echo "\n<br />duration=".$duration;
    echo "\n<br />complaint_notes=".$complaint_notes;
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_referral_html_title')."</h1></div>";

echo "\n\n<div id='referrals' class='episodeblock'>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th width='200'>Referral Person</th>";
    echo "\n<th width='100'>Specialty</th>";
    echo "\n<th width='200'>Referral Centre</th>";
    echo "\n<th>Referral Date</th>";
    echo "\n<th>Referral Reason</th>";
echo "</tr>";
foreach ($referrals_list as $referral_item){
    echo "<tr>";
    echo "<td>".anchor('emr/edit_referral/edit_referral/'.$patient_id.'/'.$summary_id.'/'.$referral_item['referral_id'], $referral_item['doctor_name'])."</td>";
    echo "<td>".$referral_item['specialty']."</td>";
    echo "<td>".$referral_item['referral_center_name']."</td>";
    echo "<td>".$referral_item['referral_date']."</td>";
    echo "<td>".$referral_item['reason']."</td>";
    echo "</tr>";
}//endforeach;
echo "</table>";
echo "</div>"; //id='complaints'


$attributes =   array('class' => 'select_form', 'id' => 'referral_form');
echo form_open('emr/edit_referral/'.$patient_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('complaint_id', $complaint_id);

echo "\n<table class='header' width='100%' align='center'>";
echo "<tr><td><b>Referral</b></td></tr>";
echo "</table>";
echo "\n<table class='frame' width='100%' align='center'>";
echo "<tr>";
    echo "\n<td width='25%'>Referral Centre<font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='referral_center_id' class='normal' onchange='javascript:selectComplaintCategory()' id='referralCentre'>";
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:selectDiagnosisCategory()'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($centres_list as $centre_item)
        {
            echo "\n<option value='".rtrim($centre_item['referral_center_id'])."'";
            echo ($referral_center_id == rtrim($centre_item['referral_center_id']) ? " selected='selected'" : "");
            echo ">".$centre_item['name']." - ".$centre_item['centre_type']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Referral Person<font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='referral_doctor_id' class='normal' onchange='javascript:selectDiagnosis()' id='referralPerson'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($persons_list as $person)
            {
	            echo "\n<option value='".$person['referral_doctor_id']."' ";
                if(isset($referral_doctor_id)) {
                    echo ($referral_doctor_id==$person['referral_doctor_id'] ? " selected='selected'" : "");
                }
                echo ">".$person['doctor_name']." &nbsp;&nbsp;- ".$person['specialty']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td width='25%'>Duration</td>";
    echo "<td>";
        echo "<input type='text' class='normal' name='duration' value='$duration' id='diagnosis' />";          
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Referral Reason <font color='red'>*</font></td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='complaint_notes' id='diagnosis2' rows='3' cols='40'>".$complaint_notes."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Add Referral' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";


echo "\n\n<div id='person_info' class='episodeblock'>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<td>Doctor's Name</td>";
    echo "\n<td>".$person_info['doctor_name']."</td>";
echo "\n<tr>";
echo "\n<tr>";
    echo "\n<td>Specialty</td>";
    echo "\n<td>".$person_info['specialty']."</td>";
echo "\n<tr>";
echo "\n<tr>";
    echo "\n<td>Tel. No.</td>";
    echo "\n<td>".$person_info['tel_no']."</td>";
echo "\n<tr>";
echo "\n<tr>";
    echo "\n<td></td>";
    echo "\n<td>".$person_info['tel_no2']."</td>";
echo "\n<tr>";
echo "\n<tr>";
    echo "\n<td>Fax No.</td>";
    echo "\n<td>".$person_info['fax_no']."</td>";
echo "\n<tr>";
echo "\n<tr>";
    echo "\n<td>e-mail</td>";
    echo "\n<td>".$person_info['email']."</td>";
echo "\n<tr>";
echo "\n<tr>";
    echo "\n<td>Others</td>";
    echo "\n<td>".$person_info['other']."</td>";
echo "\n<tr>";
echo "\n<tr>";
    echo "\n<td>Remarks</td>";
    echo "\n<td>".$person_info['remarks']."</td>";
echo "\n<tr>";
echo "\n</table>";
echo "\n</div>";
?>
    <script  type="text/javascript">
        var $ = function (id) {
            return document.getElementById(id);
        }

        function selectComplaintCategory(){
            $("referral_form").status.value="Unfinished";
            $("referralPerson").selectedIndex = -1;
            $("diagnosis").selectedIndex = -1;
            $("diagnosis2").selectedIndex = -1;
            $("referral_form").submit.click();
        }

        function selectDiagnosis(){
            $("referral_form").status.value="Unfinished";
            $("diagnosis").selectedIndex = -1;
            $("diagnosis2").selectedIndex = -1;
            $("referral_form").submit.click();
        }


      </script>


