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
 * Portions created by the Initial Developer are Copyright (C) 2009-2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_search_patient_html_title')."</h1></div>";

echo "\n\n<div id='patients_new_patient' class='section'>";
    echo "<p><strong>";
    echo anchor('indv/indv/index/indv_overview/ehr_individual/edit_patient/new_patient/new_patient', 'Add New Patient', 'target="_blank"');
    echo "</strong>, if not listed below.";
    echo "</p>";

	echo form_open('ehr/ehr/index/ehr_patients/ehr_patient/search_patient');
    echo "\n<input type='text' name='patient_name' value='' size='50' />";
    echo "\n<br /><input type='radio' name='search_field' value='name' checked='checked' >Name</input>";
    echo "\n<input type='radio' name='search_field' value='ic_no' >NRIC</input>";
    echo "\n<input type='radio' name='search_field' value='clinic_reference_number' >Clinic Reference</input>";
    echo "\n<br /><input type='submit' value='Search' />";
    echo "\n</form>";
echo "</div>";

echo "\n\n<div id='patients_found_patients' class='section'>";
    echo "Found the following patients with the <strong>".$search_field."</strong> containing <strong>'$name_filter'</strong>:";

    echo "\n<p><table class='line valigntop tablebg_blue' cellpadding='2'>";
    echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Ref No.</th>";
        echo "<th>Gender</th>";
        echo "<th>Add To</th>";
        echo "<th>Birth Date</th>";
        echo "<th>IC No.</th>";
        echo "<th>Other IC</th>";
        echo "<th>Home Clinic</th>";
    echo "</tr>";
    if(count($patlist) > 0){
        foreach ($patlist as $patient){
            echo "<tr>";
                echo "\n<td>";
	            echo anchor('indv/indv/index/indv_overview/ehr_individual/individual_overview/overview/'.trim($patient['patient_id']), "<strong>".$patient['name']."</strong>, ".$patient['name_first'], 'target="_blank"');
	            echo "</td>"; 
                echo "\n<td>";
                    echo $patient['clinic_reference_number'];
	            echo "</td>"; 
                echo "\n<td>";
                    echo $patient['gender'];
	            echo "</td>"; 
                echo "\n<td>";
    	        echo anchor('ehr/ehr/index/ehr_queue/ehr_queue/queue_edit_queue/new_queue/'.trim($patient['patient_id']).'/new_queue', 'Q');
                echo "</td>";
                echo "\n<td>";
                    echo $patient['birth_date'];
	            echo "</td>"; 
                echo "\n<td>";
                    echo $patient['ic_no'];
	            echo "</td>"; 
                echo "\n<td>";
                    echo $patient['ic_other_no'];
	            echo "</td>"; 
                echo "\n<td>";
                    echo $patient['clinic_shortname'];
	            echo "</td>"; 
            echo "</tr>";
        }
        //endforeach;
    } else {
        echo "\n<tr><td>None found</td></tr>";
    } //endif(count($patlist) > 0)
    echo "</table></p>";

echo "</div>";

echo "\n\n<div id='patients_patients_list' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Patients List</h2></div>";
	echo "\n<div class='section_body'>";
	echo "View FULL Patients List by Alphabet";
	echo "</p>";
	echo "\n<p>";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/A', ' A ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/B', ' B ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/C', ' C ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/D', ' D ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/E', ' E ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/F', ' F ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/G', ' G ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/H', ' H ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/I', ' I ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/J', ' J ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/K', ' K ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/L', ' L ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/M', ' M ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/N', ' N ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/O', ' O ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/P', ' P ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/Q', ' Q ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/R', ' R ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/S', ' S ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/T', ' T ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/U', ' U ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/V', ' V ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/W', ' W ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/X', ' X ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/Y', ' Y ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/Z', ' Z ');
    echo "\n| ";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/', ' All ');
	echo "</p>";
	echo "\n<p class='section_body'>";
	echo anchor('ehr/ehr/index/ehr_patients/ehr_patient/patients_list/'.$location_id.'/name/', 'FULL Patients List');
	echo "</div>";
echo "</div>";


echo "</div>"; //id=body
