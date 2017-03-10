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

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username');
	echo '<pre>';
    echo "\n<br />print_r(diagnosis_list)=<br />";
		print_r($diagnosis_list);
	echo '</pre>';
    echo "\n<br />sort_order=".$sort_order;
    echo "\n<br />row_first=".$row_first;
    echo "\n<br />count_fulllist=".$count_fulllist;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_list_diagnosiscodes_html_title')."</h1></div>";

echo "\n<fieldset>";
echo "<legend>DIAGNOSIS CODES LIST</legend>";
echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_edit_diagnosis_info/new_code/new_code', "<strong>Add New Diagnosis Code</strong>");
echo "\n<br /><br />";
echo $this->pagination->create_links();

echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='60'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosiscodes/commonly_used/0', 'CU');
    echo "</th>";
    echo "\n<th width='20'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosiscodes/dcode1_code/0', 'Code');
    echo "</th>";
    echo "\n<th width='500'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosiscodes/full_title/0', 'Diagnosis');
    echo "</th>";
    echo "\n<th width='500'>Chapter</th>";
echo "</tr>";
if(isset($diagnosis_list)){
    if(count($diagnosis_list) < $per_page){
        $per_page = count($diagnosis_list);
    }
    $rownum = $row_first + 1;
    for ($i=0; $i < $per_page; $i++){
        echo "\n<tr>";
        echo "\n<td valign='top'>".$rownum.".</td>";
        echo "\n<td valign='top'>".$diagnosis_list[$i]['commonly_used']."</td>";
        echo "\n<td valign='top'><strong>".$diagnosis_list[$i]['dcode1_code']."</strong></td>";
        echo "\n<td valign='top'>".anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosisext_codes/dcode1ext_code/'.$diagnosis_list[$i]['dcode1_id'], $diagnosis_list[$i]['full_title'])."</td>";
        echo "\n<td valign='top'>".$diagnosis_list[$i]['chapter']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}

echo "</table>";
echo $this->pagination->create_links();
echo "\n<br />";
echo "\n</fieldset>";



