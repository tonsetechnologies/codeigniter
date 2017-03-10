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

echo "\n\n<div id='sidebar' class='sidebar'>";
	echo "\n<p class='sidebar_l1'>";
    echo "[<a class='link2' href='JavaScript:window.close();'>Close window</a>]";
	echo "</p>";

    echo "[PORTRAIT]";
    //echo "<a href='".PICS_URL."patient_pics/".$patient_id.".jpg' target='_blank' alt='Click to view larger portrait'><img src='".PICS_URL."patient_pics/".$patient_id."_tnhi.jpg' alt='[Click to view larger portrait]' width='96'></a> ";
    //echo "<img src='".$pics_url."patient_pics/".$patient_id.".jpg' alt='[portrait]' width='96'></a> ";

	echo "\n<p class='sidebar_l1'>";
	echo "OVERVIEW";
    //echo anchor('ehr_individual/individual_overview/'.$patient_id, 'OVERVIEW');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo "Demographic";
    //echo anchor('ehr_individual/edit_patient/edit_patient/'.$patient_id, 'Demographic');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo "Immunisation";
    //echo anchor('ehr_individual/edithist_immune_select/new_immune/'.$patient_id.'/new_immune', 'Immunisation');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo "History";
    //echo anchor('ehr_individual/patients_history/'.$patient_id, 'History');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo "Upload";
    //echo anchor('ehr_individual/upload_pics_ovv/'.$patient_id, 'Upload');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo "External Modules";
    //echo anchor('ehr_individual/ovv_externalmod/externalmod/'.$patient_id, 'External Modules');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo "";
	echo "</p>";

echo "</div>";


