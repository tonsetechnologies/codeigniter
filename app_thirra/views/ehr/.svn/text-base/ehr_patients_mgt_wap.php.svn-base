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
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('10200-100_patients_mgt_html_title')."</h1></div>";

echo "\n\n<div id='patients_patients_list' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Patients List</h2></p>";
	echo "\n<p class='section_body'>";
	echo anchor('ehr_patient/patients_list/'.$location_id.'/name/', 'View FULL Patients List');
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
echo "</div>";

echo "\n\n<div id='patients_new_patient' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Add New Patient</h2></p>";
	echo "\n<p class='section_body'>";
	echo "To ensure no duplications, please search first.<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='patients_search_patient' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Search for Patient</h2></p>";
	echo "\n<p class='section_body'>";
	echo form_open('ehr_patient/search_patient');
	echo "\n<input type='text' name='patient_name' value='' size='50' />";
	echo "\n<input type='submit' value='Search' />";
	echo "\n</form>";
	echo "</p>";
echo "</div>";


echo "\n\n<div id='patients_' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2></h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "</div>"; //id=body
