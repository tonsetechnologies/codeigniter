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
    echo "\n<br />print_r(submodule_info)=<br />";
		print_r($submodule_info);
    echo "\n<br />print_r(sessions_list)=<br />";
		print_r($sessions_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_gem_history_submodule_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<table class='frame valigntop' width='100%' align='center'>";
echo "\n<tr>";
    echo "<td width='200'>Submodule Name</td>";
    echo "<td>:</td>";
    echo "<td><h3>".$submodule_info[0]['gem_submod_name']."</h3></td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Submodule Code</td>";
    echo "<td>:</td>";
    echo "<td>".$submodule_info[0]['gem_submod_code']."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Description</td>";
    echo "<td>:</td>";
    echo "<td>".$submodule_info[0]['gem_submod_descr']."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Module Name</td>";
    echo "<td>:</td>";
    echo "<td>";
    echo anchor('ehr_individual_gem/list_gem_submodules/'.$submodule_info[0]['gem_module_id'].'/'.$patient_id, $submodule_info[0]['gem_module_name']);
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Module Code</td>";
    echo "<td>:</td>";
    echo "<td>".$submodule_info[0]['gem_module_code']."</td>";
echo "</tr>";

echo "\n</table>";


echo "\n<fieldset>";
echo "<legend>SESSIONS LIST</legend>";
//echo anchor('ehr_pharmacy/phar_edit_drug_package/new_package/new_package', "<strong>Add New Package</strong>");
//echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    //echo "\n<th width='100'>Code</th>";
    echo "\n<th width='250'>Consultation Date</th>";
    echo "\n<th width='150'>Age Band</th>";
    echo "\n<th width='150'>Consultant</th>";
echo "</tr>";
if(isset($sessions_list)){
    $rownum = 1;
    foreach ($sessions_list as $session_item){
        echo "\n<tr>";
        echo "\n<td valign='top'>".$rownum.".</td>";
        //echo "\n<td valign='top'>".$session_item['gem_submod_code']."</td>";
        echo "\n<td valign='top'>";
        if(!empty($session_item['date_ended'])){
            echo anchor('ehr_individual_gem/gem_view_consult/'.$session_item['gem_module_id'].'/'.$session_item['gem_submod_id'].'/'.$session_item['gem_session_id'].'/'.$patient_id, $session_item['date_ended']."&nbsp;&nbsp;&nbsp;".$session_item['time_ended']);
        } else {
            echo "In progress";
        }
        echo "</td>";
        echo "\n<td valign='top'>".$session_item['gem_agename']."</td>";
        echo "\n<td valign='top'>".$session_item['staff_name']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";






