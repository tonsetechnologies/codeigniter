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

echo "\n\n<div id='sidebar' class='sidebar'>";
	echo "\n<div class='sidebar_l1'>";
    echo "[<a class='link2' href='JavaScript:window.close();'>Close window</a>]";
	echo "</div> ";

    echo "\n<a href='".PICS_URL."patient_pics/".$patient_id."_tnlo.jpg' target='_blank'>Portrait</a> ";
    echo "\n<a href='".PICS_URL."patient_pics/".$patient_id."_tnhi.jpg' target='_blank'>HR</a> ";
    //echo "<img src='".$pics_url."patient_pics/".$patient_id.".jpg' alt='[portrait]' width='96'></a> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_individual/individual_overview/'.$patient_id, 'OVERVIEW');
	echo "</div> ";

	echo "\n<div>";
    echo "<br />";
    echo "INFO";
	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual/edit_patient/edit_patient/'.$patient_id, 'Demographic');
	    echo "</div> ";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual/list_family_cluster/'.$patient_id, 'Family');
	    echo "</div> ";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual/list_drug_allergies/'.$patient_id, 'Allergies');
	    echo "</div> ";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual/upload_pics_ovv/new_file/'.$patient_id, 'Upload');
	    echo "</div> ";

	echo "</div>";

	echo "\n<div>";
    echo "<br />";
    echo "HISTORY";
	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual/edithist_immune_select/new_immune/'.$patient_id.'/new_immune', 'Immunisation');
	    echo "</div> ";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual_history/list_history_vitals/'.$patient_id, 'Vitals');
	    echo "</div> ";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual_history/list_history_diagnosis/'.$patient_id, 'Medical');
	    echo "</div> ";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual_history/list_history_medication/'.$patient_id, 'Medication');
	    echo "</div> ";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual_history/list_history_lab/'.$patient_id, 'Lab');
	    echo "</div> ";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual_history/list_history_imaging/'.$patient_id, 'Imaging');
	    echo "</div> ";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual_history/list_history_social/'.$patient_id, 'Social');
	    echo "</div> ";

        // For Female patients only
	    echo "\n<div class='sidebar_l1'>";
        if(($patient_info['gender'] == "Female") && ($patient_info['fertile'] == "TRUE")){
	        echo anchor('ehr_individual_antenatal/list_history_antenatal/'.$patient_id, 'Antenatal');
        } else {
            echo "Antenatal";
        } //endif($patient['gender'] == "Female")
        echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('ehr_individual/ovv_externalmod/externalmod/'.$patient_id, 'Modules');
	    echo "</div> ";
	echo "</div>";

	echo "\n<div class='sidebar_l1'>";
	echo "";
	echo "</div> ";

echo "</div>";


