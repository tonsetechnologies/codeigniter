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

echo "\n\n<div align='center'><h1>".$this->lang->line('utilities_mgt_html_title')."</h1></div>";

echo "\n\n<div id='edit_geog_' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Geographical Locations</h2></p>";
	echo "\n<p class='section_body'>";
    echo anchor('bio_utilities/util_list_addrvillages/addr_village_sort', 'Villages');
	echo "<br />";
    echo anchor('bio_utilities/util_list_addrtowns/addr_town_sort', 'Towns');
	echo "<br />";
    echo anchor('bio_utilities/util_list_addrareas/addr_area_sort', 'Areas');
	echo "<br />";
    echo anchor('bio_utilities/util_list_addrdistricts/addr_district_sort', 'Districts');
	echo "<br />";
    echo anchor('bio_utilities/util_list_addrstates/addr_state_sort', 'States');
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='edit_codes' class='section'>";
    echo "\n<p class='section_title'>";
    echo "<h2>Codes and Classifications</h2></p>";
    echo "\n<p class='section_body'>";
    echo anchor('bio_utilities/admin_export_patients', 'Complaints Codes');
    echo "\n<br />";
    echo anchor('bio_utilities/admin_export_histories', 'Diagnosis Codes');
    echo "\n<br />";
    echo anchor('bio_utilities/admin_export_episodes', 'LOINC');
    echo "\n<br />";
    echo anchor('bio_utilities/admin_import_patients', 'Drug Codes');
    echo "\n<br />";
    echo anchor('bio_utilities/util_list_drugformulary/formulary_code/0', 'Drug Formularies');
    echo "\n<br />";
    echo anchor('bio_utilities/admin_import_patients', 'ATC Drug Codes');
    echo "\n</p>";
echo "</div>";


echo "\n\n<div id='utilities_' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2></h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "</div>"; //id=body


