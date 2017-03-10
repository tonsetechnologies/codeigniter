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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2010
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='sidebar' class='sidebar'>";

    echo "<img src='".PICS_URL."patient_pics/".$patient_id."_tnhi.jpg' alt='[portrait]' width='96'></a> ";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult/consult_episode/'.$patient_id.'/'.$summary_id, $this->lang->line('patients_sidebar_consult_html_progress'));
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult/edit_reason_encounter/new_complaints/'.$patient_id.'/'.$summary_id.'/new_complaints', 'Complaints');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult/edit_vitals/edit_vitals/'.$patient_id.'/'.$summary_id, 'Vital Signs');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult/edit_physical_exam/edit_physical/'.$patient_id.'/'.$summary_id, 'Physical Exam');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult_orders/edit_lab/new_lab/'.$patient_id.'/'.$summary_id.'/new_lab', 'Lab');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult_orders/edit_imaging/new_imaging/'.$patient_id.'/'.$summary_id.'/new_imaging', 'Imaging');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult_diagnosis/edit_diagnosis/new_diagnosis/'.$patient_id.'/'.$summary_id.'/new_diagnosis', 'Diagnosis (Categorised)');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult_diagnosis/edit_diagnoses/new_diagnosis/'.$patient_id.'/'.$summary_id.'/new_diagnosis', 'Diagnosis (Searchable)');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult_prescribe/edit_prescription/new_prescribe/'.$patient_id.'/'.$summary_id.'/new_prescribe', 'Prescription (Categorised)');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult_prescribe/edit_prescribe/new_prescribe/'.$patient_id.'/'.$summary_id.'/new_prescribe', 'Prescription (Searchable)');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult_prescribe/edit_immune_select/new_immune/'.$patient_id.'/'.$summary_id.'/new_immune', 'Immunisation');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult/edit_referral/new_referral/'.$patient_id.'/'.$summary_id.'/new_referral', 'Referral');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	//echo anchor('ehr_consult/upload_pics_con/new_file/'.$patient_id.'/'.$summary_id.'/new_referral', 'Upload Files');
	echo "Upload Files";
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult/con_externalmod/externalmod/'.$patient_id.'/'.$summary_id, 'External Modules');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo "";
	echo "</p>";

    // For Female patients only
    if($patient_info['gender'] == "Female"){
        echo "<hr />";
	    echo "\n<p class='sidebar_l1'>";
	    echo "ANTENATAL";
	    echo "</p>";

	    echo "\n<p class='sidebar_l1'>";
	    //echo anchor('ehr_consult_antenatal/edit_antenatal_info/new_antenatal/'.$patient_id.'/'.$summary_id, 'Antenatal Info');
        if(($patient_info['gender'] == "Female") && ($patient_info['fertile'] == "TRUE")){
	        echo anchor('ehr_consult_antenatal/edit_antenatal_info/new_antenatal/'.$patient_id.'/'.$summary_id, 'Antenatal Info');
	        echo "\n<p class='sidebar_l1'>";
	        echo anchor('ehr_consult_antenatal/edit_antenatal_postpartum/new_postpartum/'.$patient_id.'/'.$summary_id, 'Postpartum');
            //echo "Postpartum";
        } else {
            echo "Antenatal History";
        } //endif($patient['gender'] == "Female")
	    echo "</p>";

	    echo "</p>";
    } //endif($patient['gender'] == "Female")

echo "\n</div>";


