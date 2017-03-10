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

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_mgt_html_title')."</h1></div>";

echo "\n\n<div id='patients_patients_list' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Patients List</h2></p>";
	echo "\n<p class='section_body'>";
	echo anchor('ehr_patient/patients_list', 'View FULL Patients List');
	echo "</p>";
	echo "\n<p>";
	echo anchor('ehr_patient/patients_list/A', ' A ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/B', ' B ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/C', ' C ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/D', ' D ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/E', ' E ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/F', ' F ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/G', ' G ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/H', ' H ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/I', ' I ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/J', ' J ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/K', ' K ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/L', ' L ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/M', ' M ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/N', ' N ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/O', ' O ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/P', ' P ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/Q', ' Q ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/R', ' R ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/S', ' S ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/T', ' T ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/U', ' U ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/V', ' V ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/W', ' W ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/X', ' X ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/Y', ' Y ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/Z', ' Z ');
    echo "\n| ";
	echo anchor('ehr_patient/patients_list/', ' All ');
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
