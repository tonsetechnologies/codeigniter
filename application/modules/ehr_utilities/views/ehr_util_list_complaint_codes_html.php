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
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $this->session->userdata('username');
	echo '<pre>';
    echo "\n<br />print_r(formulary_list)=<br />";
		print_r($formulary_list);
	echo '</pre>';
    echo "\n<br />row_first=".$row_first;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_list_complaint_codes_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<fieldset>";
echo "<legend>COMPLAINT CODES LIST</legend>";
echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_edit_complaint_code/new_code/new_code', "<strong>Add New Complaint Code</strong>");
echo "\n<br /><br />";
echo $this->pagination->create_links();

echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='60'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_complaint_codes/commonly_used/0', 'CU');
    echo "</th>";
    echo "\n<th width='40'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_complaint_codes/icpc_code/0', 'Code');
    echo "</th>";
    echo "\n<th width='500'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_complaint_codes/full_description/0', 'Description');
    echo "</th>";
    echo "\n<th width='350'>Component</th>";
echo "</tr>";
if(isset($complaints_list)){
    if(count($complaints_list) < $per_page){
        $per_page = count($complaints_list);
    }
    $rownum = $row_first + 1;
    for ($i=0; $i < $per_page; $i++){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td></td>";//.$complaints_list[$i]['commonly_used']."</td>";
        echo "\n<td>".$complaints_list[$i]['icpc_code']."</td>";
        echo "\n<td>".anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_edit_complaint_code/edit_code/'.$complaints_list[$i]['icpc_code'], "<strong>".$complaints_list[$i]['full_description']."</strong>")."</td>";
        echo "\n<td>".$complaints_list[$i]['component']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}

echo "</table>";
echo $this->pagination->create_links();
echo "\n<br />";
echo "\n</fieldset>";



