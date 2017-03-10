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
 * Portions created by the Initial Developer are Copyright (C) 2010 - 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    print "<br />family_link = " . $family_link;
	echo '<pre>';
    echo "\n<br />print_r(family_head)=<br />";
		print_r($family_head);
    echo "\n<br />print_r(head_info)=<br />";
		print_r($head_info);
    echo "\n<br />print_r(family_cluster)=<br />";
		print_r($family_cluster);
    echo "\n<br />print_r(family_above)=<br />";
		print_r($family_above);
    echo "\n<br />print_r(family_below)=<br />";
		print_r($family_below);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_list_family_cluster_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\nType of Family Position: <strong>".$patient_info['family_link']."</strong>";
echo "\n<p><u>Convert to</u>: ";
echo "<br />\n";
if(($patient_info['family_link'] == "Head of Family") || !empty($family_cluster)){
    echo "Head of Family";
} else {
    echo anchor('ehr_individual/change_family_link_type/change_type/'.$patient_id.'/head', "<strong>Head of Family</strong>");
}
echo "<br />\n";
if(($patient_info['family_link'] == "Independent") || !empty($family_cluster)){
    echo "Independent";
} else {
    echo anchor('ehr_individual/change_family_link_type/change_type/'.$patient_id.'/independent', "<strong>Independent</strong>");
}
echo "<br />\n";
if(($patient_info['family_link'] == "Under Head of Family") || !empty($family_cluster)){
    echo "Under Head of Family";
} else {
    echo anchor('ehr_individual/change_family_link_type/change_type/'.$patient_id.'/under', "<strong>Under Head of Family</strong>");
}
echo "\n<p><br />";


if(count($head_info) > 0){
    if($head_info[0]['patient_id'] == $patient_id){
        $overview_sheet =   "<strong>".$head_info[0]['name']."</strong>, ".$head_info[0]['name_first'];
        $which_window   =   "";
    } else {
        $overview_sheet =   anchor('ehr_individual/individual_overview/'.$head_info[0]['patient_id'], "<strong>".$head_info[0]['name']."</strong>, ".$head_info[0]['name_first'], 'target="_blank"');
        $which_window   =   'target="_blank"';
    } //endif($cluster_item['patient_id'] == $patient_id)
    echo "\n<h3>Head = ".$overview_sheet;
    echo " : ".$head_info[0]['birth_date']."</h3>";
}

echo "\n<fieldset>";
echo "<legend>FAMILY MEMBERS</legend>";
//echo "<strong>Add New History</strong>";

if((count($head_info) < 1) && ($patient_info['family_link'] == "Under Head of Family")){
    echo anchor('ehr_individual/edit_relationship_info/new_relation/'.$patient_id.'/new_relation', "<strong>Add New Relationship</strong>");
}

echo "\n<br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='300'>Name</th>";
    echo "\n<th width='100'>Birth Date</th>";
    echo "\n<th width='80'>Sex</th>";
    echo "\n<th width='150'>Ref. No.</th>";
    echo "\n<th width='150'>NRIC</th>";
    echo "\n<th width='150'>Relationship</th>";
    echo "\n<th width='15'>Position</th>";
echo "</tr>";
if(isset($family_cluster)){
    $rownum = 1;
    foreach ($family_cluster as $cluster_item){
        if($cluster_item['patient_id'] == $patient_id){
            $overview_sheet =   "<strong>".$cluster_item['name']."</strong>, ".$cluster_item['name_first'];
            $which_window   =   "";
            $delete_link    =   anchor('ehr_individual/delete_family_relationship/delete_relation/'.$cluster_item['patient_id'].'/'.$cluster_item['relationship_id'], "Delete", $which_window);
        } else {
            $overview_sheet =   anchor('ehr_individual/individual_overview/'.$cluster_item['patient_id'], "<strong>".$cluster_item['name']."</strong>, ".$cluster_item['name_first'], 'target="_blank"');
            $which_window   =   'target="_blank"';
            $delete_link    =   "";
        } //endif($cluster_item['patient_id'] == $patient_id)

        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$overview_sheet."</td>";
        echo "\n<td>".$cluster_item['birth_date']."</td>";
        echo "\n<td><strong>".$cluster_item['gender']."</strong></td>";
        echo "\n<td>".$cluster_item['clinic_reference_number']."</td>";
        echo "\n<td>".$cluster_item['ic_no']."</td>";
        if(isset($cluster_item['family_position'])){
            echo "\n<td>".anchor('ehr_individual/edit_relationship_info/edit_relation/'.$cluster_item['patient_id'].'/'.$cluster_item['relationship_id'], "<strong>".$cluster_item['family_position']."</strong>", $which_window)."</td>";
        } else {
            echo "\n<td>Define</td>";
        } //endif(isset($cluster_item['family_position']))
        echo "\n<td>".$cluster_item['generation_to_head']."</td>";
        echo "\n<td>".$delete_link."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


echo "\n<p>";
echo anchor('ehr_individual/list_family_relations/'.$patient_id, 'Family Chain');
echo "</p>";



?>
    <script  type="text/javascript">
        var $ = function (id) {
            return document.getElementById(id);
        }

        function select_level_two(){
            $("consultation_form").status.value="Unfinished";
            $("level_two").selectedIndex = -1;
            $("consultation_form").submit.click();
        }

      </script>


