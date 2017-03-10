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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username')."<br />";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_test/entities_mgt', 'entities');
    echo "\n</div>";
}
include_once($version_file);

echo "\n\n<div align='center'><h1>".$this->lang->line('utilities_mgt_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n\n<div id='edit_geog_' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Geographical Locations</h2></div>";
	echo "\n<div class='section_body'>";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_village_sort', 'Villages');
	echo "<br />";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrtowns/addr_town_sort', 'Towns');
	echo "<br />";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrareas/addr_area_sort', 'Areas');
	echo "<br />";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrdistricts/addr_district_sort', 'Districts');
	echo "<br />";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrstates/addr_state_sort', 'States');
	echo "<br />";
	echo "</div>";
	echo "\n<br />";
echo "</div>";

echo "\n\n<div id='edit_codes' class='section'>";
    echo "\n<div class='section_title'>";
    echo "<h2>Codes and Classifications</h2></div>";
    echo "\n<div class='section_body'>";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_complaint_codes/icpc_code/0', 'Complaints Codes');
    echo "\n<br />";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosiscodes/dcode1_code/0', 'Diagnosis Codes');
    echo "\n<br />";
    echo "LOINC";
    //echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/admin_export_episodes', 'LOINC');
    echo "\n<br />";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drugatc/atc_code/0', 'ATC Drug Codes');
    echo "\n<br />";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drugformulary/formulary_code/0', 'Drug Formularies');
    echo "\n (generic names)<br />";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drug_codes/drug_code/0', 'Drug Codes');
    echo "\n (trade names)<br />";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_immunisation_codes/immunisation_sort/0', 'Immunisation Codes');
    echo "\n<br />";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes_procedures/util_list_procedure_groups/pcode1_code/0', 'Procedure Codes');
    echo "\n</div>";
	echo "\n<br />";
echo "</div>";


echo "\n\n<div id='utilities_' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Useful Links</h2></div>";
	echo "\n<div class='section_body'>";
    echo anchor('http://202.9.99.47/wiki-thirra/index.php/Main_Page', 'Online Wiki Documentation', 'target="_blank"');
	echo "\n<br />";
    echo anchor('http://202.9.99.47/wiki-thirra/index.php?title=Category:THIRRA_EHR_-_User_Manual&action=pdfbook', 'Download User Manual');
    echo " from wiki site";
	echo "\n<br />";
    echo anchor('http://thirra.primacare.org.my', 'THIRRA Project Website', 'target="_blank"');
	echo "</div>";
	echo "\n<br />";
echo "</div>";


echo "\n\n<div id='utilities_' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>About ".$this->config->item('app_name')."</h2></div>";
	echo "\n<div class='section_body'>";
    echo "\nVersion ";
    if("THIRRA" == $this->config->item('app_name')){
        echo $base_version;
    } else {
        echo $alt_version;
    }
    echo $app_version." &nbsp;&nbsp;Build ".$svn_build;

	echo "</div>";
	echo "\n<a href='http://codeigniter.com/' target='_blank'>CodeIgniter</a> version ";
    echo CI_VERSION;
    echo "<br /><br />";
echo "</div>";


echo "</div>"; //id=body


