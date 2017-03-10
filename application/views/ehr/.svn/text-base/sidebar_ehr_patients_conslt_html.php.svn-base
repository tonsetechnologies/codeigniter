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

echo "\n\n<div id='sidebar' class='sidebar'>";

    echo "<img src='".PICS_URL."patient_pics/".trim($patient_id)."_tnhi.jpg' alt='[portrait]' width='96'></a> ";

	echo "\n<p class='sidebar_l1'><strong>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/consult_episode/edit_episode/'.trim($patient_id).'/'.$summary_id, $this->lang->line('patients_sidebar_consult_html_progress'));
	echo "</strong></p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/edit_reason_encounter/new_complaints/'.trim($patient_id).'/'.$summary_id.'/new_complaints', 'Complaints');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/edit_vitals/edit_vitals/'.trim($patient_id).'/'.$summary_id, 'Vital Signs');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/edit_physical_exam/edit_physical/'.trim($patient_id).'/'.$summary_id, 'Physical Exam');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('cons/cons/index/cons_orders/ehr_consult_orders/edit_lab/new_lab/'.trim($patient_id).'/'.$summary_id.'/new_lab', 'Lab Orders');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('cons/cons/index/cons_orders/ehr_consult_orders/edit_imaging/new_imaging/'.trim($patient_id).'/'.$summary_id.'/new_imaging', 'Imaging Orders');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	//echo anchor('ehr_consult_orders/edit_procedure/new_procedure/'.trim($patient_id).'/'.$summary_id.'/new_procedure', 'Procedure');
    echo "Procedure";
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('cons/cons/index/cons_diagnosis/ehr_consult_diagnosis/edit_prediagnosis/new_diagnosis/'.trim($patient_id).'/'.$summary_id.'/new_diagnosis', 'Pre-diagnosis');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
    echo "Diagnosis";
    echo "<br />- ";
	echo anchor('cons/cons/index/cons_diagnosis/ehr_consult_diagnosis/edit_diagnosis/new_diagnosis/'.trim($patient_id).'/'.$summary_id.'/new_diagnosis', 'Categorised');
    echo "<br />- ";
	echo anchor('cons/cons/index/cons_diagnosis/ehr_consult_diagnosis/edit_diagnoses/new_diagnosis/'.trim($patient_id).'/'.$summary_id.'/new_diagnosis', 'Searchable');
	echo "</p>";
/*
	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult_diagnosis/edit_diagnosis/new_diagnosis/'.trim($patient_id).'/'.$summary_id.'/new_diagnosis', 'Diagnosis (Categorised)');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult_diagnosis/edit_diagnoses/new_diagnosis/'.trim($patient_id).'/'.$summary_id.'/new_diagnosis', 'Diagnosis (Searchable)');
	echo "</p>";
*/
	echo "\n<p class='sidebar_l1'>";
    echo "Prescription";
    echo "<br />- ";
	echo anchor('cons/cons/index/cons_prescribe/ehr_consult_prescribe/edit_prescription/new_prescribe/'.trim($patient_id).'/'.$summary_id.'/new_prescribe', 'Categorised');
    echo "<br />- ";
	echo anchor('cons/cons/index/cons_prescribe/ehr_consult_prescribe/edit_prescribe/new_prescribe/'.trim($patient_id).'/'.$summary_id.'/new_prescribe', 'Searchable');
    echo "<br />- ";
	echo anchor('cons/cons/index/cons_prescribe/ehr_consult_prescribe/list_drug_packages/new_prescribe/'.trim($patient_id).'/'.$summary_id.'/new_prescribe', 'Packages');
    //echo "\nPackages";
	echo "</p>";
/*
	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult_prescribe/edit_prescription/new_prescribe/'.trim($patient_id).'/'.$summary_id.'/new_prescribe', 'Prescription (Categorised)');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('ehr_consult_prescribe/edit_prescribe/new_prescribe/'.trim($patient_id).'/'.$summary_id.'/new_prescribe', 'Prescription (Searchable)');
	echo "</p>";
*/
	echo "\n<p class='sidebar_l1'>";
	echo anchor('cons/cons/index/cons_prescribe/ehr_consult_prescribe/edit_immune_select/new_immune/'.trim($patient_id).'/'.$summary_id.'/new_immune', 'Immunisation');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('cons/cons/index/cons_orders/ehr_consult_orders_procedure/edit_procedure/new_procedure/'.trim($patient_id).'/'.$summary_id.'/new_procedure', 'Procedures');
    //echo "Procedures";
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/edit_referral/new_referral/'.trim($patient_id).'/'.$summary_id.'/new_referral', 'Referral');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/upload_pics_con/new_file/'.trim($patient_id).'/'.$summary_id.'/new_file', 'Upload Files');
	//echo "Upload Files";
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo anchor('cons/cons/index/cons_progress/ehr_consult/con_externalmod/externalmod/'.trim($patient_id).'/'.$summary_id, 'Modules');
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	//echo anchor('ehr_consult_orders/edit_procedure/new_procedure/'.trim($patient_id).'/'.$summary_id.'/new_procedure', 'Procedure');
    echo "Med Certificate";
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	//echo anchor('ehr_consult_orders/edit_procedure/new_procedure/'.trim($patient_id).'/'.$summary_id.'/new_procedure', 'Procedure');
    echo "Notify Auth.";
	echo "</p>";

	echo "\n<p class='sidebar_l1'>";
	echo "";
	echo "</p>";

    // For Female patients only
    if($individual_info['gender'] == "Female"){
        //echo "<hr />";
	    echo "\n<p class='sidebar_l1'>";
	    echo "ANTENATAL";
	    echo "</p>";

	    echo "\n<p class='sidebar_l1'>";
	    //echo anchor('ehr_consult_antenatal/edit_antenatal_info/new_antenatal/'.trim($patient_id).'/'.$summary_id, 'Antenatal Info');
        if(($individual_info['gender'] == "Female") && ($individual_info['fertile'] == "TRUE")){
	        echo anchor('cons/cons/index/cons_antenatal/ehr_consult_antenatal/edit_antenatal_info/new_antenatal/'.trim($patient_id).'/'.$summary_id, 'Antenatal Info');
        } else {
            echo "Antenatal History";
        } //endif($patient['gender'] == "Female")
	    echo "</p>";

	    //echo "\n<p class='sidebar_l1'>";
	    //echo anchor('ehr_consult_antenatal/edit_antenatal_post/new_antenatal/'.trim($patient_id).'/'.$summary_id, 'Post-natal Follow-up');
        //echo "Post-natal Follow-up";
	    //echo "</p>";
    } //endif($patient['gender'] == "Female")


// Experimental ACL menus
echo "\n<div class='sidebar_l1'>";
echo "\n<hr />";
//echo "\n<table id='banner_table'>";
//echo "<tr>";
foreach($acl_menu as $acl_item){
    //echo "\n<td width='200'>";
    if($acl_item['rights_single'] > 0){
        echo "<a href='".site_url().$acl_item['syssection_link_url'].$patient_id."'>";
        echo $acl_item['syssection_link_text'];
        echo "</a>";
    } else {
        echo $acl_item['syssection_link_text'];
    }
    //echo "<br />(";
    //echo $acl_item['acl_rights'];
    //echo "</td>";
}
//echo "\n</tr>";
//echo "</table>";
echo "</div>";


echo "\n</div>";


