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
    print "\n<br />offline_mode = " . $offline_mode;
    echo "\n</div>";
}

echo "\n\n<div align='center'><h1>".$this->lang->line('admin_mgt_html_title')."</h1></div>";

if($offline_mode == FALSE) {
    echo "\n\n<div id='admin_users' class='section'>";
	    echo "\n<p class='section_title'>";
	    echo "<h2>Users Management</h2></p>";
	    echo "\n<p class='section_body'>";
            echo anchor('ehr_admin/admin_list_systemusers/username', 'System Users');
            echo "\n<br />";
            echo anchor('ehr_admin/admin_list_staffcategories', 'Staff Categories');
	    echo "</p>";
    echo "</div>";

} //endif($offline_mode == FALSE) 

if($offline_mode == FALSE) {
    echo "\n\n<div id='admin_users' class='section'>";
	    echo "\n<p class='section_title'>";
	    echo "<h2>Places Management</h2></p>";
	    echo "\n<p class='section_body'>";
            echo anchor('ehr_admin/admin_list_clinics/sort_clinic', 'Clinics');
            echo "\n<br />";
            echo anchor('ehr_admin/admin_list_referral_centres', 'Referral Centres');
	    echo "</p>";
    echo "</div>";

} //endif($offline_mode == FALSE) 


echo "\n\n<div id='synch_data' class='section'>";
    echo "\n<p class='section_title'>";
    echo "<h2>Synch Data</h2></p>";
    echo "\n<p class='section_body'>";
    echo anchor('ehr_admin/admin_export_patients', 'Export Patients Data');
    echo "\n<br />";
    echo anchor('ehr_admin/admin_export_histories', 'Export Histories Data');
    echo "\n<br />";
    echo anchor('ehr_admin/admin_export_episodes', 'Export Episodes Data');
    echo "\n<br /><br />";
    echo anchor('ehr_admin/admin_import_patients', 'Import Patients Data');
    echo "\n<br />";
    echo anchor('ehr_admin/admin_import_histories', 'Import Histories Data');
    echo "\n<br />";
    echo anchor('ehr_admin/admin_import_episodes', 'Import Episodes Data');
    echo "\n</p>";
echo "</div>";

echo "\n\n<div id='new' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2></h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "</div>"; //id=body
