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
	echo '<pre>';
    echo "\n<br />print_r(module_info)=<br />";
		print_r($module_info);
    echo "\n<br />print_r(submodules_list)=<br />";
		print_r($submodules_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_list_submodules_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<table class='frame valigntop' width='100%' align='center'>";
echo "\n<tr>";
    echo "<td>Module Name</td>";
    echo "<td>:</td>";
    echo "<td><h3>".$module_info[0]['gem_module_name']."</h3></td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Module Code</td>";
    echo "<td>:</td>";
    echo "<td>".$module_info[0]['gem_module_code']."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Description</td>";
    echo "<td>:</td>";
    echo "<td>".$module_info[0]['gem_module_descr']."</td>";
echo "</tr>";

echo "\n</table>";


echo "\n<fieldset>";
echo "<legend>SUBMODULES LIST</legend>";
//echo anchor('ehr_pharmacy/phar_edit_drug_package/new_package/new_package', "<strong>Add New Package</strong>");
//echo "\n<br /><br />";

echo "\n<table class='valigntop'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='100'>Code</th>";
    echo "\n<th width='50'>Form</th>";
    echo "\n<th width='350'>Submodule Name</th>";
    echo "\n<th width='450'>Description</th>";
echo "</tr>";
if(isset($submodules_list)){
    $rownum = 1;
    foreach ($submodules_list as $submodule_item){
        echo "\n<tr>";
        echo "\n<td valign='top'>".$rownum.".</td>";
        echo "\n<td valign='top'>".$submodule_item['gem_submod_code']."</td>";
        echo "\n<td valign='top'>";
        if(isset($submodule_item['gem_session_id'])){
            echo anchor('cons/cons/index/cons_gem/ehr_consult_gem/gem_edit_consult/edit_consult/'.$patient_id.'/'.$summary_id.'/'.$submodule_item['gem_submod_id'].'/'.$submodule_item['gem_agegroup_id'], '<strong>Edit</strong>');
            //echo anchor('ehr_consult_gem/gem_edit_consult/edit_consult/'.$submodule_item['gem_submod_id'].'/'.$submodule_item['gem_agegroup_id'].'/'.$patient_id.'/'.$summary_id, $submodule_item['gem_submod_name']);
        } else {
            echo anchor('cons/cons/index/cons_gem/ehr_consult_gem/gem_select_agegroup/new_group/'.$patient_id.'/'.$summary_id.'/'.$module_info[0]['gem_module_id'].'/'.$submodule_item['gem_submod_id'], 'New');
            //echo anchor('ehr_consult_gem/gem_select_agegroup/'.$module_info[0]['gem_module_id'].'/'.$submodule_item['gem_submod_id'].'/'.$patient_id.'/'.$summary_id, $submodule_item['gem_submod_name']);
        }
        echo "</td>";
        echo "\n<td valign='top'>";
        echo $submodule_item['gem_submod_name'];
        echo "</td>";
        echo "\n<td valign='top'>".$submodule_item['gem_submod_descr']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";






