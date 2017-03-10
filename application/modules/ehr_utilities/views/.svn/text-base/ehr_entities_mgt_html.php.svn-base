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

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username');
	echo '<pre>';
    echo "\n<br />print_r(medication_list)=<br />";
		print_r($medication_list);
    echo "\n<br />print_r(entities_list)=<br />";
		//print_r($entities_list);
    echo "\n<br />print_r(panel_list)=<br />";
		print_r($panel_list);
    echo "\n<br />print_r(entities_patient)=<br />";
		print_r($entities_patient);
	echo '</pre>';
    echo "\n</div>";
}
include_once($version_file);

echo "\n\n<div align='center'><h1>".$this->lang->line('utilities_mgt_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<fieldset>";
echo "<legend>ENTITIES</legend>";
echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='150'>name</th>";
    echo "\n<th width='50'>ent_info_id</th>";
    echo "\n<th width='80'>short</th>";
    echo "\n<th width='50'>code</th>";
    echo "\n<th width='50'>entity statutory</th>";
    echo "\n<th width='50'>is panel</th>";
    echo "\n<th width='50'>is mco</th>";
    echo "\n<th width='50'>is mco client</th>";
    echo "\n<th width='50'>is insurer</th>";
    echo "\n<th width='50'>is insurer client</th>";
    echo "\n<th width='150'>entity industry</th>";
    echo "\n<th width='250'>entity_remarks</th>";
echo "</tr>";
if(isset($entities_list)){
    $rownum = 1;
    foreach ($entities_list as $state_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td><strong>".$state_item['entity_name']."</strong></td>";
        echo "\n<td>".$state_item['entity_info_id']."</td>";
        echo "\n<td>".$state_item['entity_shortname']."</td>";
        echo "\n<td>".$state_item['entity_code']."</td>";
        echo "\n<td>".$state_item['entity_statutory']."</td>";
        echo "\n<td>".$state_item['is_panel']."</td>";
        echo "\n<td>".$state_item['is_mco']."</td>";
        echo "\n<td>".$state_item['is_mco_client']."</td>";
        echo "\n<td>".$state_item['is_insurer']."</td>";
        echo "\n<td>".$state_item['is_insurer_client']."</td>";
        echo "\n<td>".$state_item['entity_industry']."</td>";
        echo "\n<td>".$state_item['entity_remarks']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


echo "\n<fieldset>";
echo "<legend>clinic_info_id = ".$clinic_info_id1."</legend>";
echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='50'>ent_clin_id</th>";
    echo "\n<th width='150'>name</th>";
    echo "\n<th width='50'>ent_info_id</th>";
    echo "\n<th width='80'>short</th>";
    echo "\n<th width='50'>code</th>";
    echo "\n<th width='50'>Clinic Ref.</th>";
    echo "\n<th width='50'>Debtor Ref.</th>";
    echo "\n<th width='120'>entity_type</th>";
    echo "\n<th width='50'>markup tier</th>";
    echo "\n<th width='150'>contact person</th>";
    echo "\n<th width='250'>description</th>";
    echo "\n<th width='250'>notes</th>";
echo "</tr>";
if(isset($clients_list1)){
    $rownum = 1;
    foreach ($clients_list1 as $state_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$state_item['entity_clinic_id']."</td>";
        echo "\n<td><strong>".$state_item['entity_name']."</strong></td>";
        echo "\n<td>".$state_item['entity_info_id']."</td>";
        echo "\n<td>".$state_item['entity_shortname']."</td>";
        echo "\n<td>".$state_item['entity_code']."</td>";
        echo "\n<td>".$state_item['relation_clinic_reference']."</td>";
        echo "\n<td>".$state_item['relation_entity_reference']."</td>";
        echo "\n<td>".$state_item['entity_type']."</td>";
        echo "\n<td>".$state_item['markup_tier']."</td>";
        echo "\n<td>".$state_item['contact_person']."</td>";
        echo "\n<td>".$state_item['relation_description']."</td>";
        echo "\n<td>".$state_item['clinic_relation_notes']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


echo "\n<fieldset>";
echo "<legend>clinic_info_id = ".$clinic_info_id2."</legend>";
echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='50'>ent_clin_id</th>";
    echo "\n<th width='150'>name</th>";
    echo "\n<th width='50'>ent_info_id</th>";
    echo "\n<th width='80'>short</th>";
    echo "\n<th width='50'>code</th>";
    echo "\n<th width='50'>Clinic Ref.</th>";
    echo "\n<th width='50'>Debtor Ref.</th>";
    echo "\n<th width='120'>entity_type</th>";
    echo "\n<th width='50'>markup tier</th>";
    echo "\n<th width='150'>contact person</th>";
    echo "\n<th width='250'>description</th>";
    echo "\n<th width='250'>notes</th>";
echo "</tr>";
if(isset($clients_list2)){
    $rownum = 1;
    foreach ($clients_list2 as $state_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$state_item['entity_clinic_id']."</td>";
        echo "\n<td><strong>".$state_item['entity_name']."</strong></td>";
        echo "\n<td>".$state_item['entity_info_id']."</td>";
        echo "\n<td>".$state_item['entity_shortname']."</td>";
        echo "\n<td>".$state_item['entity_code']."</td>";
        echo "\n<td>".$state_item['relation_clinic_reference']."</td>";
        echo "\n<td>".$state_item['relation_entity_reference']."</td>";
        echo "\n<td>".$state_item['entity_type']."</td>";
        echo "\n<td>".$state_item['markup_tier']."</td>";
        echo "\n<td>".$state_item['contact_person']."</td>";
        echo "\n<td>".$state_item['relation_description']."</td>";
        echo "\n<td>".$state_item['clinic_relation_notes']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


echo "\n<fieldset>";
echo "<legend>patient_id = ".$patient_id1."</legend>";
echo "List of entities chargeable for this patient.";
echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='50'>ent_pat_id</th>";
    echo "\n<th width='50'>clinic_info_id</th>";
    echo "\n<th width='150'>name</th>";
    echo "\n<th width='80'>short</th>";
    echo "\n<th width='50'>code</th>";
    echo "\n<th width='120'>entity_type</th>";
    echo "\n<th width='50'>relation type</th>";
    echo "\n<th width='50'>reference</th>";
    echo "\n<th width='50'>start</th>";
    echo "\n<th width='50'>Position</th>";
    echo "\n<th width='150'>clinic notes</th>";
    echo "\n<th width='150'>patient notes</th>";
echo "</tr>";
if(isset($entities_patient1)){
    $rownum = 1;
    foreach ($entities_patient1 as $state_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$state_item['entity_patient_id']."</td>";
        echo "\n<td>".$state_item['clinic_info_id']."</td>";
        echo "\n<td><strong>".$state_item['entity_name']."</strong></td>";
        echo "\n<td>".$state_item['entity_shortname']."</td>";
        echo "\n<td>".$state_item['entity_code']."</td>";
        echo "\n<td>".$state_item['entity_type']."</td>";
        echo "\n<td>".$state_item['relation_type']."</td>";
        echo "\n<td>".$state_item['relation_reference']."</td>";
        echo "\n<td>".$state_item['relation_start']."</td>";
        echo "\n<td>".$state_item['job_position']."</td>";
        echo "\n<td>".$state_item['clinic_relation_notes']."</td>";
        echo "\n<td>".$state_item['patient_relation_notes']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


echo "\n<fieldset>";
echo "<legend>patient_id = ".$patient_id2."</legend>";
echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='50'>ent_pat_id</th>";
    echo "\n<th width='50'>clinic_info_id</th>";
    echo "\n<th width='150'>name</th>";
    echo "\n<th width='80'>short</th>";
    echo "\n<th width='50'>code</th>";
    echo "\n<th width='120'>entity_type</th>";
    echo "\n<th width='50'>relation type</th>";
    echo "\n<th width='50'>reference</th>";
    echo "\n<th width='50'>start</th>";
    echo "\n<th width='50'>Position</th>";
    echo "\n<th width='150'>clinic notes</th>";
    echo "\n<th width='150'>patient notes</th>";
echo "</tr>";
if(isset($entities_patient2)){
    $rownum = 1;
    foreach ($entities_patient2 as $state_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$state_item['entity_patient_id']."</td>";
        echo "\n<td>".$state_item['clinic_info_id']."</td>";
        echo "\n<td><strong>".$state_item['entity_name']."</strong></td>";
        echo "\n<td>".$state_item['entity_shortname']."</td>";
        echo "\n<td>".$state_item['entity_code']."</td>";
        echo "\n<td>".$state_item['entity_type']."</td>";
        echo "\n<td>".$state_item['relation_type']."</td>";
        echo "\n<td>".$state_item['relation_reference']."</td>";
        echo "\n<td>".$state_item['relation_start']."</td>";
        echo "\n<td>".$state_item['job_position']."</td>";
        echo "\n<td>".$state_item['clinic_relation_notes']."</td>";
        echo "\n<td>".$state_item['patient_relation_notes']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";



echo "</div>"; //id=body


