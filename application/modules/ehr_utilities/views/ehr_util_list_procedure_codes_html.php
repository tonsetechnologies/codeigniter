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
 * Portions created by the Initial Developer are Copyright (C) 2010- 2012
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
    echo "\n<br />print_r(diagnosis_list)=<br />";
		print_r($diagnosis_list);
    echo "\n<br />print_r(diagnosis_top)=<br />";
		print_r($diagnosis_top);
	echo '</pre>';
    echo "\n<br />sort_order=".$sort_order;
    echo "\n<br />row_first=".$row_first;
    echo "\n<br />dcode1_id=".$dcode1_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_list_procedure_codes_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<table>";
echo "\n<tr>";
    //echo "\n<td><h3>".$diagnosis_top[0]['pcode1_code']."</h3></td>";
    echo "\n<td><h3>Group</h3></td>";
    echo "\n<td> : </td>";
    echo "\n<td><h3>".$diagnosis_top[0]['full_title']."</h3>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td></td>";
    echo "\n<td>  </td>";
    echo "<td>";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes_procedures/util_edit_procedure_group/edit_code/'.$diagnosis_top[0]['pcode1_id'], "<strong>[Edit]</strong>");
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td>Category</td>";
    echo "\n<td> : </td>";
    echo "\n<td>".$diagnosis_top[0]['pcode_category']."</td>";
echo "</tr>";
echo "</table>";

echo "\n<fieldset>";
echo "<legend>PROCEDURE CODES</legend>";
echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes_procedures/util_edit_procedure_code/new_code/'.$pcode1_id.'/new_code', "<strong>Add New Procedure Code</strong>");
echo "\n<br /><br />";
echo $this->pagination->create_links();

echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='160'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes_procedures/util_list_procedure_codes_pergroup/commonly_used/0', 'Commonly Used');
    echo "</th>";
    echo "\n<th width='60'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes_procedures/util_list_procedure_codes_pergroup/dcode1_code/0', 'Code');
    echo "</th>";
    echo "\n<th width='500'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes_procedures/util_list_procedure_codes_pergroup/full_title/0', 'Procedure');
    echo "</th>";
    echo "\n<th width='50'>Notification Level</th>";
echo "</tr>";
if(count($diagnosis_list)> 0){
    $rownum = $row_first + 1;
    for ($i=0; $i < count($diagnosis_list); $i++){
        echo "\n<tr>";
        echo "\n<td valign='top'>".$rownum.".</td>";
        echo "\n<td valign='top' align='center'>".$diagnosis_list[$i]['commonly_used']."</td>";
        echo "\n<td valign='top'><strong>".$diagnosis_list[$i]['pcode1ext_code']."</strong></td>";
        echo "\n<td valign='top'>".anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes_procedures/util_edit_procedure_code/edit_code/'.$diagnosis_list[$i]['pcode1_id'].'/'.$diagnosis_list[$i]['pcode1ext_id'], $diagnosis_list[$i]['pcode1ext_longname'])."</td>";
        echo "\n<td valign='top'>".$diagnosis_list[$i]['pcode1ext_notify']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
} else {
    echo "\n<tr><td colspan='2'>No Procedure inside this group. Please add at least one procedure.</td></tr>";
}

echo "</table>";
echo $this->pagination->create_links();
echo "\n<br />";
echo "\n</fieldset>";



