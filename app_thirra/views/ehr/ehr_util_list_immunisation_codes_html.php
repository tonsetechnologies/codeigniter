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
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(formulary_list)=<br />";
		print_r($formulary_list);
	echo '</pre>';
    echo "\n<br />row_first=".$row_first;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_list_immunisation_codes_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<fieldset>";
echo "<legend>IMMUNISATION CODES LIST</legend>";
echo anchor('ehr_utilities/util_edit_immunisation_code/new_code/new_code', "<strong>Add New Immunisation Code</strong>");
echo "\n<br /><br />";
echo $this->pagination->create_links();

echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='40'>";
	echo anchor('ehr_utilities/util_list_immunisation_codes/commonly_used/0', 'CU');
    echo "</th>";
    echo "\n<th width='50'>";
	echo anchor('ehr_utilities/util_list_immunisation_codes/immunisation_sort/0', 'Sort');
    echo "</th>";
    echo "\n<th width='400'>";
	echo anchor('ehr_utilities/util_list_immunisation_codes/vaccine/0', 'Vaccine');
    echo "</th>";
    echo "\n<th width='140'>Dose</th>";
    echo "\n<th width='350'>Description</th>";
echo "</tr>";
if(isset($immunisation_list)){
    if(count($immunisation_list) < $per_page){
        $per_page = count($immunisation_list);
    }
    $rownum = $row_first + 1;
    for ($i=0; $i < $per_page; $i++){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td></td>";//.$complaints_list[$i]['commonly_used']."</td>";
        echo "\n<td>".$immunisation_list[$i]['immunisation_sort']."</td>";
        echo "\n<td>".anchor('ehr_utilities/util_edit_immunisation_code/edit_code/'.$immunisation_list[$i]['immunisation_id'], "<strong>".$immunisation_list[$i]['vaccine']."</strong>")."</td>";
        //echo "\n<td><strong>".$immunisation_list[$i]['vaccine']."</strong></td>";
        echo "\n<td>".$immunisation_list[$i]['dose']."</td>";
        echo "\n<td>".$immunisation_list[$i]['description']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}

echo "</table>";
echo $this->pagination->create_links();
echo "\n<br />";
echo "\n</fieldset>";


