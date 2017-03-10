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

    echo "<a href='".PICS_URL."patient_pics/".$patient_id."_tnhi.jpg' target='_blank'>Portrait</a> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult/consult_episode/'.$patient_id.'/'.$summary_id, $this->lang->line('patients_sidebar_consult_html_progress'));
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult/edit_reason_encounter/new_complaints/'.$patient_id.'/'.$summary_id.'/new_complaints', 'Complaints');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult/edit_vitals/edit_vitals/'.$patient_id.'/'.$summary_id, 'Vital Signs');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult/edit_physical_exam/edit_physical/'.$patient_id.'/'.$summary_id, 'Physical Exam');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult_orders/edit_lab/new_lab/'.$patient_id.'/'.$summary_id.'/new_lab', 'Lab');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult_orders/edit_imaging/new_imaging/'.$patient_id.'/'.$summary_id.'/new_imaging', 'Imaging');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult_diagnosis/edit_diagnosis/new_diagnosis/'.$patient_id.'/'.$summary_id.'/new_diagnosis', 'Diagnosis (Categorised)');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult_diagnosis/edit_diagnoses/new_diagnosis/'.$patient_id.'/'.$summary_id.'/new_diagnosis', 'Diagnosis (Searchable)');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult_prescribe/edit_prescription/new_prescribe/'.$patient_id.'/'.$summary_id, 'Prescription');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult_prescribe/edit_prescribe/new_prescribe/'.$patient_id.'/'.$summary_id, 'Prescription (Searchable)');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult_prescribe/edit_immune_select/new_immune/'.$patient_id.'/'.$summary_id.'/new_immune', 'Immunisation');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult/edit_referral/new_referral/'.$patient_id.'/'.$summary_id, 'Referral');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo anchor('ehr_consult/con_externalmod/externalmod/'.$patient_id.'/'.$summary_id, 'External Modules');
	echo "</div> ";

	echo "\n<div class='sidebar_l1'>";
	echo "";
	echo "</div> ";

    // For Female patients only
    if($patient_info['gender'] == "Female"){
	    echo "\n<div class='sidebar_l1'>";
	    //echo anchor('ehr_consult_antenatal/edit_antenatal_info/new_antenatal/'.$patient_id.'/'.$summary_id, 'Antenatal Info');
        if(($patient_info['gender'] == "Female") && ($patient_info['fertile'] == "TRUE")){
	        echo anchor('ehr_consult_antenatal/edit_antenatal_info/new_antenatal/'.$patient_id.'/'.$summary_id, 'Antenatal Info');
        } else {
            echo "Antenatal Info";
        } //endif($patient['gender'] == "Female")
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    //echo anchor('ehr_consult_antenatal/edit_antenatal_post/new_antenatal/'.$patient_id.'/'.$summary_id, 'Post-natal Follow-up');
        echo "Post-natal Follow-up";
	    echo "</div>";
    } //endif($patient['gender'] == "Female")

echo "</div>";


