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
	echo "\n<div class='sidebar_l1'>";
    echo "[<a class='link2' href='JavaScript:window.close();'>Close window</a>]";
	echo "</div> ";

    //echo "\n<a href='".PICS_URL."patient_pics/".$patient_id."_tnlo.jpg' target='_blank'>Portrait</a> ";
    //echo "\n<a href='".PICS_URL."patient_pics/".$patient_id."_tnhi.jpg' target='_blank'>HR</a> ";
    //echo "<img src='".$pics_url."patient_pics/".$patient_id.".jpg' alt='[portrait]' width='96'></a> ";

	echo "\n<div class='sidebar_l1'>";
	echo "OVERVIEW";
	//echo anchor('ehr_individual/individual_overview/'.$patient_id, 'OVERVIEW');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo "Demographic";
	//echo anchor('ehr_individual/edit_patient/edit_patient/'.$patient_id, 'Demographic');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo "Family";
	//echo anchor('ehr_individual/list_family_cluster/'.$patient_id, 'Family');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo "Allergies";
	//echo anchor('ehr_individual/list_drug_allergies/'.$patient_id, 'Allergies');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo "Immunisation";
	//echo anchor('ehr_individual/edithist_immune_select/new_immune/'.$patient_id.'/new_immune', 'Immunisation');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo "Vitals";
	//echo anchor('ehr_individual/list_history_vitals/'.$patient_id, 'Vitals');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo "Social";
	//echo anchor('ehr_individual/list_history_social/'.$patient_id, 'Social');
	echo "</div> ";

    // For Female patients only
    if($patient_info['gender'] == "Female"){
	    echo "\n<div class='sidebar_l1'>";
	    echo "Antenatal";
	    //echo anchor('ehr_individual/list_history_antenatal/'.$patient_id, 'Antenatal');
	    echo "</div> ";
    } //endif($patient['gender'] == "Female")

	echo "\n<div class='sidebar_l1'>";
	echo "Upload";
	//echo anchor('ehr_individual/upload_pics_ovv/'.$patient_id, 'Upload');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo "External Modules";
	//echo anchor('ehr_individual/ovv_externalmod/externalmod/'.$patient_id, 'External Modules');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo "";
	echo "</div> ";

echo "</div>";


