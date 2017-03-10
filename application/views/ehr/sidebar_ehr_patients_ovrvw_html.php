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
 * Portions created by the Initial Developer are Copyright (C) 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='sidebar' class='sidebar'>";
	echo "\n<div class='sidebar_l1'>";
    echo "[<a class='link2' href='JavaScript:window.close();'>Close window</a>]";
	echo "</div>";

    echo "<a href='".PICS_URL."patient_pics/".$patient_id.".jpg' target='_blank' alt='Click to view larger portrait'><img src='".PICS_URL."patient_pics/".$patient_id."_tnhi.jpg' alt='[Click to view larger portrait]' width='96'></a> ";
    //echo "<img src='".$pics_url."patient_pics/".$patient_id.".jpg' alt='[portrait]' width='96'></a> ";

	echo "\n<div class='sidebar_l1'><strong>";
	echo anchor('indv/indv/index/indv_overview/ehr_individual/individual_overview/overview/'.$patient_id, 'OVERVIEW');
	echo "</strong></div>";

	echo "\n<div>";
    //echo "<br />";
    echo "INFO";
	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_overview/ehr_individual/edit_patient/edit_patient/'.$patient_id, 'Demographic');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_overview/ehr_individual/list_family_cluster/list_cluster/'.$patient_id, 'Family Cluster');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_overview/ehr_individual/list_drug_allergies/list_allergies/'.$patient_id, 'Drug Allergies');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_overview/ehr_individual/upload_pics_ovv/new_file/'.$patient_id, 'Upload Files');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_refer/ehr_individual_refer/list_referral_out/list_referrals/'.$patient_id, 'Referrals');
	    echo "</div>";
	echo "</div>";

	echo "\n<div>";
    //echo "<br />";
    echo "HISTORY";
	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_overview/ehr_individual/edithist_immune_select/new_immune/'.$patient_id.'/new_immune', 'Immunisation');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_history/ehr_individual_history/list_history_vitals/list_vitals/'.$patient_id, 'Vital Signs');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_history/ehr_indvhist_problemlist/list_problem_list/list_problems/'.$patient_id, 'Problem List');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_history/ehr_individual_history/list_history_diagnosis/list_diagnoses/'.$patient_id, 'Medical');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_history/ehr_individual_history/list_history_medication/list_medications/'.$patient_id, 'Medication');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_history/ehr_indvhist_procedure/list_past_procedures/list_procedures/'.$patient_id, 'Past Procedures');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_history/ehr_individual_history/list_history_lab/list_orders/'.$patient_id, 'Lab Tests');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_history/ehr_individual_history/list_history_imaging/list_orders/'.$patient_id, 'Imaging Tests');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_history/ehr_indvhist_procedure/list_history_procedure_orders/list_orders/'.$patient_id, 'Procedures Orders');
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_history/ehr_individual_history/list_history_social/list_social/'.$patient_id, 'Social');
	    echo "</div>";

        // For Female patients only
	    echo "\n<div class='sidebar_l1'>";
        if(($individual_info['gender'] == "Female") && ($individual_info['fertile'] == "TRUE")){
	        echo anchor('indv/indv/index/indv_antenatal/ehr_individual_antenatal/list_history_antenatal/list_antenatal/'.$patient_id, 'Antenatal');
        } else {
            echo "Antenatal";
        } //endif($patient['gender'] == "Female")
	    echo "</div>";

	    echo "\n<div class='sidebar_l1'>";
	    echo anchor('indv/indv/index/indv_overview/ehr_individual/ovv_externalmod/externalmod/'.$patient_id, 'Modules');
	    echo "</div>";

	echo "</div>";

	echo "\n<div class='sidebar_l1'>";
    echo "\n<hr />";
    echo "Pt Booklet<br />";
	echo anchor('indv/indv/index/indv_overview/ehr_individual/hardcopy_patient_booklet/print_hardcopy/'.$patient_id.'/html ', 'html', 'target="_blank"');
    echo "\n | ";
	echo anchor('indv/indv/index/indv_overview/ehr_individual/hardcopy_patient_booklet/print_hardcopy/'.$patient_id.'/pdf ', 'pdf', 'target="_blank"');
    echo " ";
	echo "</div>";

	echo "\n<div class='sidebar_l1'>";
	echo "";
	echo "</div>";

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


echo "</div>";


