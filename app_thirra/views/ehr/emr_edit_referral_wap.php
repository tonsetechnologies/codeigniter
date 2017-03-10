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
    echo "\n<br />form_purpose=".$form_purpose;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(referrals_list)=<br />";
		print_r($referrals_list);
    echo "\n<br />print_r(referral_info)=<br />";
		print_r($referral_info);
    echo "\n<br />print_r(person_info)=<br />";
		print_r($person_info);
    echo "\n<br />print_r(centres_list)=<br />";
		print_r($centres_list);
    echo "\n<br />print_r(persons_list)=<br />";
		print_r($persons_list);
	echo '</pre>';
    echo "\n<br />referral_id=".$referral_id;
    echo "\n<br />referral_center_id=".$referral_center_id;
    echo "\n<br />referral_doctor_id=".$referral_doctor_id;
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
    echo "\n<th>Referral Letter</th>";
echo "</tr>";
foreach ($referrals_list as $referral_item){
    echo "<tr>";
    echo "<td>".anchor('ehr_consult/edit_referral/edit_referral/'.$patient_id.'/'.$summary_id.'/'.$referral_item['referral_id'], $referral_item['doctor_name'])."</td>";
    echo "<td>".$referral_item['specialty']."</td>";
    echo "<td>".$referral_item['name']."</td>";
    echo "<td>".$referral_item['referral_date']."</td>";
    echo "<td>".$referral_item['reason']."</td>";
    echo "<td>".anchor('ehr_consult/print_referral_letter/'.$referral_item['referral_id'], 'Print', 'target="_blank"')."</td>";
    echo "</tr>";
}//endforeach;
echo "</table>";
echo "</div>"; //id='referrals'

//echo anchor('ehr_consult/edit_referral/new_referral/'.$patient_id.'/'.$summary_id.'/new_referral', 'Add More Referral');

$attributes =   array('class' => 'select_form', 'id' => 'referral_form');
echo form_open('ehr_consult/edit_referral/'.$patient_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('referral_id', $referral_id);

echo "\n<table class='header' width='100%' align='center'>";
echo "<tr><td><b>Referral</b></td></tr>";
echo "</table>";
echo "\n<table class='frame' width='100%' align='center'>";
echo "<tr>";
    echo "\n<td width='25%'>Referral Centre<font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='referral_center_id' class='normal' onchange='javascript:selectReferralCentre()' id='referralCentre'>";
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
    echo "\n<td width='25%'>Referral Person <font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='referral_doctor_id' class='normal' onchange='javascript:selectReferralPerson()' id='referralPerson'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($persons_list as $person)
            {
                if(count($referrals_list)) {
                    // Make sure that user cannot create a second referral to the same referring person.
                    // Still a problem if 2 from same centre was already added.
                    foreach($referrals_list as $referred) {
                        if($person['referral_center_id'] === $referred['referral_center_id']) {                              
                            if(($person['referral_doctor_id'] === $referred['referral_doctor_id']) && ($form_purpose==="new_referral")) {
                                // Don't show
                            } else {
	                            echo "\n<option value='".$person['referral_doctor_id']."' ";
                                if(isset($referral_doctor_id)) {
                                    echo ($referral_doctor_id==$person['referral_doctor_id'] ? " selected='selected'" : "");
                                }
                                echo ">".$person['doctor_name']." &nbsp;&nbsp;- ".$person['specialty'];
                                echo "</option>";
                            } //endif(array_search($person['referral_doctor_id'],$referrals_list) === FALSE) 
                        } else {
                            // Condition test not relevant
                            echo "\n<option value='".$person['referral_doctor_id']."' ";
                            if(isset($referral_doctor_id)) {
                                echo ($referral_doctor_id==$person['referral_doctor_id'] ? " selected='selected'" : "");
                            }
                            echo ">".$person['doctor_name']." &nbsp;&nbsp;- ".$person['specialty'];
                            echo "</option>";
                        } //endif($person['referral_center_id'] === $referred['referral_center_id'])
                    } //foreach($referrals_list as $referred) 
                } else {
                    echo "\n<option value='".$person['referral_doctor_id']."' ";
                    if(isset($referral_doctor_id)) {
                        echo ($referral_doctor_id==$person['referral_doctor_id'] ? " selected='selected'" : "");
                    }
                    echo ">".$person['doctor_name']." &nbsp;&nbsp;- ".$person['specialty'];
                    echo "</option>";
                } //endif(count($referrals_list))
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Referral Date <font color='red'>*</font></td><td>";
echo form_error('referral_date');
echo "\n<input type='text' name='referral_date' value='".set_value('referral_date',$init_referral_date)."' size='8' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Referral Reason <font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('reason');
    echo "\n<textarea class='normal' name='reason' id='diagnosis' rows='4' cols='50'>".set_value('reason',$init_reason)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Clinical Examination</td>";
    echo "\n<td>";
    echo form_error('clinical_exam');
    echo "\n<textarea class='normal' name='clinical_exam' id='diagnosis2' rows='4' cols='50'>".set_value('clinical_exam',$init_clinical_exam)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Referral Ref.</td><td>";
echo form_error('referral_reference');
echo "\n<input type='text' name='referral_reference' value='".set_value('referral_reference',$init_referral_reference)."' size='8' /></td></tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Add Referral' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";


if(isset($referral_doctor_id)) {
    if($referral_doctor_id <> "none") {
        //echo "\n\n<div id='person_info' class='episodeblock'>";
        echo "\n<fieldset>";
        echo "<legend>PERSON INFORMATION</legend>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<td>Doctor's Name</td>";
            echo "\n<td>".$person_info[0]['doctor_name']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Specialty</td>";
            echo "\n<td>".$person_info[0]['specialty']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Tel. No.</td>";
            echo "\n<td>".$person_info[0]['tel_no']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td></td>";
            echo "\n<td>".$person_info[0]['tel_no2']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Fax No.</td>";
            echo "\n<td>".$person_info[0]['fax_no']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>e-mail</td>";
            echo "\n<td>".$person_info[0]['email']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Others</td>";
            echo "\n<td>".$person_info[0]['other']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Remarks</td>";
            echo "\n<td>".$person_info[0]['remarks']."</td>";
        echo "\n<tr>";
        echo "\n</table>";
        //echo "\n</div>";
        echo "</fieldset>";
    }
} //endif($referral_doctor_id <> "")


if(isset($referral_center_id)) {
    if($referral_center_id <> "none") {
        //echo "\n\n<div id='person_info' class='episodeblock'>";
        echo "\n<fieldset>";
        echo "<legend>CENTRE INFORMATION</legend>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<td>Centre Name</td>";
            echo "\n<td>".$referral_info[0]['name']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Centre Type</td>";
            echo "\n<td>".$referral_info[0]['centre_type']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Address</td>";
            echo "\n<td>".$referral_info[0]['address'];
            echo "\n<br />".$referral_info[0]['address2'];
            echo "\n<br />".$referral_info[0]['address3'];
            echo "\n<br />".$referral_info[0]['postcode'];
            echo "\n<br />".$referral_info[0]['town'];
            echo "\n<br />".$referral_info[0]['state'];
            echo "\n<br />".$referral_info[0]['country'];
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Tel. No.</td>";
            echo "\n<td>".$referral_info[0]['tel_no'];
            echo "\n<br />".$referral_info[0]['tel_no2'];
            echo "\n<br />".$referral_info[0]['tel_no3'];
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Fax No.</td>";
            echo "\n<td>".$referral_info[0]['fax_no'];
            echo "\n<br />".$referral_info[0]['fax_no2'];
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>e-mail</td>";
            echo "\n<td>".$referral_info[0]['email']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Contact Person</td>";
            echo "\n<td>".$referral_info[0]['contact_person']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Website</td>";
            echo "\n<td>".$referral_info[0]['website']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>No. of Beds</td>";
            echo "\n<td>".$referral_info[0]['beds']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Others</td>";
            echo "\n<td>".$referral_info[0]['other']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Remarks</td>";
            echo "\n<td>".$referral_info[0]['remarks']."</td>";
        echo "\n</tr>";
        echo "\n</table>";
        echo "\n</fieldset>";
        //echo "\n</div>";
    }
} //endif($referral_center_id <> "")


/*
if(isset($referral_center_id)) {
    if($referral_center_id <> "none") {
        //echo "\n\n<div id='person_info' class='episodeblock'>";
        echo "\n<fieldset>";
        echo "<legend>CENTRE INFORMATION</legend>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<td>Centre Name</td>";
            echo "\n<td>".$persons_list[0]['name']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Centre Type</td>";
            echo "\n<td>".$persons_list[0]['centre_type']."</td>";
        echo "\n<tr>";
        echo "\n<tr>";
            echo "\n<td>Address</td>";
            echo "\n<td>".$persons_list[0]['address'];
            echo "\n<br />".$persons_list[0]['address2'];
            echo "\n<br />".$persons_list[0]['address3'];
            echo "\n<br />".$persons_list[0]['postcode'];
            echo "\n<br />".$persons_list[0]['town'];
            echo "\n<br />".$persons_list[0]['state'];
            echo "\n<br />".$persons_list[0]['country'];
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Tel. No.</td>";
            echo "\n<td>".$persons_list[0]['tel_no'];
            echo "\n<br />".$persons_list[0]['tel_no2'];
            echo "\n<br />".$persons_list[0]['tel_no3'];
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Fax No.</td>";
            echo "\n<td>".$persons_list[0]['fax_no'];
            echo "\n<br />".$persons_list[0]['fax_no2'];
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>e-mail</td>";
            echo "\n<td>".$persons_list[0]['email']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Contact Person</td>";
            echo "\n<td>".$persons_list[0]['contact_person']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Website</td>";
            echo "\n<td>".$persons_list[0]['website']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>No. of Beds</td>";
            echo "\n<td>".$persons_list[0]['beds']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Others</td>";
            echo "\n<td>".$persons_list[0]['other']."</td>";
        echo "\n</tr>";
        echo "\n<tr>";
            echo "\n<td>Remarks</td>";
            echo "\n<td>".$persons_list[0]['remarks']."</td>";
        echo "\n</tr>";
        echo "\n</table>";
        echo "\n</fieldset>";
        //echo "\n</div>";
    }
} //endif($referral_center_id <> "")

*/
?>
    <script  type="text/javascript">
        var $ = function (id) {
            return document.getElementById(id);
        }

        function selectReferralCentre(){
            $("referral_form").status.value="Unfinished";
            $("referralPerson").selectedIndex = -1;
            $("diagnosis").selectedIndex = -1;
            $("diagnosis2").selectedIndex = -1;
            $("referral_form").submit.click();
        }

        function selectReferralPerson(){
            $("referral_form").status.value="Unfinished";
            $("diagnosis").selectedIndex = -1;
            $("diagnosis2").selectedIndex = -1;
            $("referral_form").submit.click();
        }


      </script>


