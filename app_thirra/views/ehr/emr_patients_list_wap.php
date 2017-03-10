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
    echo "\n<div class='debug'>";
    print "\nSession info = " . $_SESSION['thirra_mode'];
    print "\n<br />User = " . $_SESSION['username'];
    echo "\n<br />patient_scope = ".$patient_scope;
    echo "\n<br />list_sort = ".$list_sort;
    echo "\n<br />alphabet = ".$alphabet;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_list_html_title')."</h1></div>";

echo "<p><strong>";
echo anchor('ehr_individual/edit_patient/new_patient/new_patient', 'Add New Patient', 'target="_blank"');
echo form_hidden('patient_scope', $patient_scope);
echo form_hidden('list_sort', $list_sort);
echo form_hidden('alphabet', $alphabet);

echo "</strong></p>";

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
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/All', ' All ');
	echo "</p>";

if(count($patlist) > 0) {
    echo "Click on Patient Name to open Overview Sheet in new window";
    echo "\n<table>";
    echo "<tr>";
        echo "<th>No.</th>";
        echo "<th width='120'>";
    	echo anchor('ehr_patient/patients_list/'.$patient_scope.'/birth_date/'.$alphabet, 'Birth Date');
        echo "</th>";
        echo "<th width='300'>";
    	echo anchor('ehr_patient/patients_list/'.$patient_scope.'/name/'.$alphabet, 'Patient Name');
        echo "</th>";
        echo "<th>";
    	echo anchor('ehr_patient/patients_list/'.$patient_scope.'/gender/'.$alphabet, 'Sex');
        echo "</th>";
        echo "<th></th>";
        echo "<th>Home Clinic</th>";
        echo "<th>Add to</th>";
        echo "<th></th>";
        echo "<th></th>";
    echo "</tr>";
    $row_num = 1;
    foreach ($patlist as $patient){
        echo "\n<tr>";
            echo "<td>";
	        echo $row_num.".";
            echo "</td>";
            echo "<td>";
            echo $patient['birth_date'];
            echo "</td>";
            echo "<td>";
	        echo anchor('ehr_individual/individual_overview/'.$patient['patient_id'], "<strong>".$patient['name']."</strong>, ".$patient['name_first'], 'target="_blank"');
            echo "</td>";
            echo "<td>";
            echo $patient['gender'];
            echo "</td>";
            echo "<td>";
            echo "";
            echo "</td>";
            echo "<td>";
            echo $patient['clinic_shortname'];
            echo "</td>";
            echo "<td>";
	        echo anchor('ehr_queue/queue_edit_queue/new_queue/'.$patient['patient_id'].'/new_queue', 'Queue');
            echo "</td>";
        echo "\n</tr>";
        $row_num++;
    }
    //endforeach;
    echo "</table>"; 

} else {
    echo "\nNo patient with name starting with ".$alphabet.".";
} //endif

echo "<hr />";
echo "All clinics:";
	echo "\n<p>";
	echo anchor('ehr_patient/patients_list/all/name/A', ' A ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/B', ' B ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/C', ' C ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/D', ' D ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/E', ' E ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/F', ' F ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/G', ' G ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/H', ' H ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/I', ' I ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/J', ' J ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/K', ' K ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/L', ' L ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/M', ' M ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/N', ' N ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/O', ' O ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/P', ' P ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/Q', ' Q ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/R', ' R ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/S', ' S ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/T', ' T ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/U', ' U ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/V', ' V ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/W', ' W ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/X', ' X ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/Y', ' Y ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/Z', ' Z ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/all/name/All', ' All ');
	echo "</p>";

echo "</div>"; //id=body
