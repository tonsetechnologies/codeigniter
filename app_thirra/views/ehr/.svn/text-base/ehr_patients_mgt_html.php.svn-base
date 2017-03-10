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

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(pending_referrals)=<br />";
		print_r($pending_referrals);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('10200-100_patients_mgt_html_title')."</h1></div>";

echo "\n\n<div id='patients_patients_list' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Patients List</h2></div>";
	echo "\n<div class='section_body'>";
	echo "View FULL Patients List by Alphabet";
	echo "</p>";
	echo "\n<p>";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/A', ' A ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/B', ' B ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/C', ' C ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/D', ' D ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/E', ' E ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/F', ' F ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/G', ' G ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/H', ' H ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/I', ' I ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/J', ' J ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/K', ' K ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/L', ' L ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/M', ' M ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/N', ' N ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/O', ' O ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/P', ' P ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/Q', ' Q ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/R', ' R ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/S', ' S ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/T', ' T ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/U', ' U ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/V', ' V ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/W', ' W ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/X', ' X ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/Y', ' Y ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/Z', ' Z ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/', ' All ');
	echo "</p>";
	echo "\n<p class='section_body'>";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/', 'FULL Patients List');
	echo "</div>";
echo "</div>";

echo "\n\n<div id='patients_new_patient' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Add New Patient</h2></div>";
	echo "\n<div class='section_body'>";
	echo "To ensure no duplications, please search first.<br />";
	echo "</div>";
	echo "<br />";
echo "</div>";

echo "\n\n<div id='patients_search_patient' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Search for Patient</h2></div>";
	echo "\n<div class='section_body'>";
	echo form_open('ehr_patient/search_patient');
	echo "\n<input type='text' name='patient_name' value='' size='50' />";
    echo "\n<br /><input type='radio' name='search_field' value='name' checked='checked' >Name</input>";
    echo "\n<input type='radio' name='search_field' value='ic_no' >NRIC</input>";
    echo "\n<input type='radio' name='search_field' value='clinic_reference_number' >Clinic Reference</input>";
	echo "\n<br /><input type='submit' value='Search' />";
	echo "\n</form>";
	echo "</div>";
	echo "<br />";
echo "</div>";


echo "\n\n<div id='patients_' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Pending Outgoing Referrals</h2></p>";
	echo "\n<p class='section_body'>";
    if(isset($pending_referrals)){
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th></th>";
            echo "\n<th>Date</th>";
            echo "\n<th>Patient</th>";
            echo "\n<th>NRIC No.</th>";
            echo "\n<th>Referral Centre</th>";
            echo "\n<th>Doctor</th>";
            echo "\n<th>Reason</th>";
        echo "\n</tr>";
        $rownum =   1;
        foreach($pending_referrals as $referral_item){
            echo "\n<tr>";
                echo "<td>".$rownum.". </td>";
                echo "<td>".$referral_item['referral_date']."</td>";
                echo "<td><strong>";//.$referral_item['name'].", ".$referral_item['name_first']."</strong></td>";
	            echo anchor('ehr_individual/individual_overview/'.$referral_item['patient_id'], "<strong>".$referral_item['name']."</strong>, ".$referral_item['name_first'], 'target="_blank"');
                echo "</td>";
                echo "<td>".$referral_item['ic_no']."</td>";
                echo "<td><strong>".$referral_item['referral_centre']."</strong></td>";
                echo "<td>".$referral_item['referral_doctor_name']."</td>";
                echo "<td>".$referral_item['reason']."</td>";
            echo "\n</tr>";
            $rownum++;
        }
        echo "\n</table>";
    }
	echo "<br />";
	echo "</p>";
    echo anchor('ehr_patient/pat_listclosed_referrals/', 'Referrals Responded');
	echo "<br />";
	echo "<br />";
echo "</div>";

echo "</div>"; //id=body
