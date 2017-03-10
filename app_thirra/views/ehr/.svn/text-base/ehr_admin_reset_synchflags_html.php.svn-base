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
	echo '<pre>';
    echo "\n<br />print_r(user_rights)=<br />";
		print_r($user_rights);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div align='center'><h1>".$this->lang->line('admin_reset_synchflags_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n\n<div id='synch_data' class='section'>";
    echo "\n<p class='section_title'>";
    echo "<h2>Data Synchronisation</h2></p>";
    echo "\n<p class='section_body'>";
    echo 'Synched Logins Data';
    echo " (".count($unsynched_logins)." rows)";
    echo "\n<br />";
    echo 'Synched Patients Data';
    echo " (".count($unsynched_patients)." rows)";
    echo "\n<br />";
    echo 'Synched Episodes Data';
    echo " (".count($unsynched_episodes)." rows)";
    echo "\n<br />";
    echo 'Synched Antenatal Info Data';
    echo " (".count($unsynched_antenatalinfo)." rows)";
    echo "\n<br />";
    echo 'Synched Antenatal Checkup Data';
    echo " (".count($unsynched_antenatalcheckup)." rows)";
    echo "\n<br />";
    echo 'Synched Antenatal Delivery Data';
    echo " (".count($unsynched_antenataldelivery)." rows)";
    echo "\n<br />";
    echo 'Synched Immunisation Histories Data';
    echo " (".count($unsynched_historyimmunisation)." rows)";
    echo "\n<br />";
    echo "\n</p>";
if($offline_mode==FALSE){
    echo anchor('ehr_admin_edi_import/admin_reset_synchflagsdone', 'Confirm Clear Synch Flags');
}
echo "</div>";


echo "</div>"; //id=body
