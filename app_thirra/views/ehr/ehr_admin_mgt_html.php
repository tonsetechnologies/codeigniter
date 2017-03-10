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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2011
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
    print "\n<br />offline_mode = " . $offline_mode;
	echo '<pre>';
    echo "\n<br />print_r(user_rights)=<br />";
		print_r($user_rights);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div align='center'><h1>".$this->lang->line('admin_mgt_html_title')."</h1></div>";

if($offline_mode == FALSE) {
    echo "\n\n<div id='admin_users' class='section'>";
	    echo "\n<div class='section_title'>";
	    echo "<h2>Users Management</h2></div>";
	    echo "\n<div class='section_body'>";
            echo anchor('ehr_admin/admin_list_systemusers/username', 'System Users');
            echo "\n<br />";
            echo anchor('ehr_admin/admin_list_staffcategories', 'Staff Categories');
	    echo "</div>";
        echo "\n<br />";
    echo "</div>";

} //endif($offline_mode == FALSE) 

if($offline_mode == FALSE) {
    echo "\n\n<div id='admin_users' class='section'>";
	    echo "\n<div class='section_title'>";
	    echo "<h2>Places Management</h2></div>";
	    echo "\n<div class='section_body'>";
            echo anchor('ehr_admin/admin_list_clinics/sort_clinic', 'Clinics');
            echo "\n<br />";
            echo anchor('ehr_admin/admin_list_depts/dept_sort', 'Departments');
            echo "\n<br />";
            echo anchor('ehr_admin/admin_list_referral_centres', 'Referral Centres');
	    echo "</div>";
        echo "\n<br />";
    echo "</div>";

} //endif($offline_mode == FALSE) 


echo "\n\n<div id='synch_data' class='section'>";
    echo "\n<div class='section_title'>";
    echo "<h2>Data Synchronisation</h2></div>";
    echo "\n<div class='section_body'>";
    echo anchor('ehr_admin_edi_export/admin_export_logins', 'Export Logins Data');
    echo " (".count($unsynched_logins)." rows)";
    echo "\n<br />";
    echo anchor('ehr_admin_edi_export/admin_export_patients', 'Export New Patients Data');
    echo " (".count($unsynched_new_patients)." rows)";
    echo "\n<br />";
    echo anchor('ehr_admin_edi_export/admin_export_oldpatients', 'Export Updated Old Patients Data');
    echo " (".count($unsynched_old_patients)." rows)";
    echo "\n<br />";
    echo anchor('ehr_admin_edi_export/admin_export_episodes', 'Export Episodes Data');
    echo " (".count($unsynched_closed_episodes)." rows)";
    echo "\n - ";
    echo anchor('ehr_admin_edi_export/admin_list_open_episodes', 'Open Episodes');
    echo " (".count($unsynched_open_episodes)." rows)";
    echo "\n<br />";
    echo anchor('ehr_admin_edi_export/admin_export_antenatal_info', 'Export Antenatal Info Data');
    echo " (".count($unsynched_antenatalinfo)." rows)";
    echo "\n<br />";
    echo anchor('ehr_admin_edi_export/admin_export_antenatal_checkup', 'Export Antenatal Checkup Data');
    echo " (".count($unsynched_antenatalcheckup)." rows)";
    echo "\n<br />";
    echo anchor('ehr_admin_edi_export/admin_export_antenatal_delivery', 'Export Antenatal Delivery Data');
    echo " (".count($unsynched_antenataldelivery)." rows)";
    echo "\n<br />";
    echo anchor('ehr_admin_edi_export/admin_export_history_immunisation', 'Export Immunisation Histories Data');
    echo " (".count($unsynched_historyimmunisation)." rows)";
    echo "\n<br />";
    //echo anchor('ehr_admin_edi_export/admin_export_histories', 'Export Histories Data');
    echo "\nExport Histories Data";
    echo "\n<br /><br />";
    echo anchor('ehr_admin_edi_import/admin_import_logins', 'Import Logins Data');
    echo "\n<br />";
    echo anchor('ehr_admin_edi_import/admin_import_patients', 'Import Patients Data');
    echo "\n<br />";
    echo anchor('ehr_admin_edi_import/admin_import_episodes', 'Import Episodes Data');
    echo "\n<br />";
    echo anchor('ehr_admin_edi_import/admin_import_antenatal_info', 'Import Antenatal Info Data');
    echo "\n<br />";
    echo anchor('ehr_admin_edi_import/admin_import_antenatal_checkup', 'Import Antenatal Checkup Data');
    echo "\n<br />";
    echo anchor('ehr_admin_edi_import/admin_import_antenatal_delivery', 'Import Antenatal Delivery Data');
    echo "\n<br />";
    echo anchor('ehr_admin_edi_import/admin_import_history_immunisation', 'Import Immunisation Histories Data');
    echo "\n<br />";
    echo anchor('ehr_admin_edi/admin_import_refer', 'Import Referrals Data');
    echo "\n<br />";
    //echo anchor('ehr_admin_edi/admin_import_histories', 'Import Histories Data');
    echo "\nImport Histories Data";
    echo "\n</p>";
if($offline_mode==FALSE){
    echo "\n<br />";
    echo anchor('ehr_admin_edi_import/admin_reset_synchflag', 'Reset Synch Flags');
}
    echo "\n<br /><br />";
    echo anchor('ehr_admin_edi_import/admin_list_synchlogs', 'View Synch Activity Logs');
	echo "</div>";
    echo "\n<br />";
echo "</div>";

/*
echo "\n\n<div id='new' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2></h2></div>";
	echo "\n<div class='section_body'>";
	echo "<br />";
	echo "</div>";
echo "</div>";
*/
echo "</div>"; //id=body
