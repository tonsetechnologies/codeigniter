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
    echo "\n<br />print_r(submodule_info)=<br />";
		print_r($submodule_info);
    echo "\n<br />print_r(agebands_list)=<br />";
		print_r($agebands_list);
	echo '</pre>';
    echo "\n<br />age_days=".$patient_info['age_days'];
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_select_age_groups_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<table class='frame' width='100%' align='center'>";
echo "\n<tr>";
    echo "<td>Submodule Name</td>";
    echo "<td>:</td>";
    echo "<td><h3>".$submodule_info[0]['gem_submod_name']."</h3></td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Module Name</td>";
    echo "<td>:</td>";
    echo "<td><strong>";
    //echo $module_info[0]['gem_module_name'];
    echo anchor('ehr_consult_gem/list_gem_submodules/'.$module_info[0]['gem_module_id'].'/'.$patient_id.'/'.$summary_id, $module_info[0]['gem_module_name']);
    echo "</strong></td>";
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
echo "<legend>SELECT AGE BAND</legend>";
//echo anchor('ehr_pharmacy/phar_edit_drug_package/new_package/new_package', "<strong>Add New Package</strong>");
//echo "\n<br /><br />";

$attributes =   array('class' => 'select_form', 'id' => 'gem_form');
echo form_open('cons/cons/index/cons_gem/ehr_consult_gem/gem_edit_consult/'.$patient_id, $attributes);

echo form_hidden('patient_id', $patient_id);

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th></th>";
    echo "\n<th width='150'>Band Name</th>";
    echo "\n<th width='100'>From</th>";
    echo "\n<th width='100'>To</th>";
    echo "\n<th>Description</th>";
echo "</tr>";
if(isset($agebands_list)){
    $rownum = 1;
    foreach ($agebands_list as $ageband_item){
        $bg_color = " ";
        if($patient_info['age_days'] >= round($ageband_item['gem_age_min']) && $patient_info['age_days'] <= floor($ageband_item['gem_age_max'])) {
            $bg_color = "bgcolor='yellow' ";
        }
        echo "\n<tr>";
        echo "\n<td valign='top' ".$bg_color.">".$rownum.".</td>";
        echo "\n<td valign='top' >";
        //echo "\n<input type='radio' name='gem_agegroup_id' value='".$ageband_item['gem_agegroup_id']."' ></input>";
        echo "</td>";
        echo "\n<td valign='top' ".$bg_color;
        echo ">";
        //echo "<strong>".$ageband_item['gem_agename']."</strong>";
        echo anchor('cons/cons/index/cons_gem/ehr_consult_gem/gem_edit_consult/new_consult/'.$patient_id.'/'.$summary_id.'/'.$submodule_info[0]['gem_submod_id'].'/'.$ageband_item['gem_agegroup_id'], $ageband_item['gem_agename']);
        echo "</td>";
        echo "\n<td valign='top' align='right' ".$bg_color.">".round($ageband_item['gem_age_min'])."</td>";
        echo "\n<td valign='top' align='right' ".$bg_color.">".floor($ageband_item['gem_age_max'])."</td>";
        echo "\n<td valign='top' ".$bg_color.">&nbsp;&nbsp;&nbsp;".$ageband_item['gem_agedescr']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


echo "\n<br />";
echo "\n<center>";
    //echo "\n<input class='button' type='submit' name='submit' value='Proceed to Form' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";

echo "\n</form>";
echo "\n<br />";



