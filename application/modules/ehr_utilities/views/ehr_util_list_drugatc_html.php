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
    echo "\n<br />print_r(drugatc_list)=<br />";
		print_r($drugatc_list);
	echo '</pre>';
    echo "\n<br />row_first=".$row_first;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_list_drugatc_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<fieldset>";
echo "<legend>DRUGS ATC CODE LIST</legend>";
echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_edit_drugatc/new_code/new_code', "<strong>Add New ATC Code</strong>");
echo "\n<br /><br />";
echo $this->pagination->create_links();

echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    /*
    echo "\n<th width='60'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drugatc/commonly_used/0', 'CU');
    echo "</th>";
    */
    echo "\n<th width='40'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drugatc/atc_code/0', 'Code');
    echo "</th>";
    echo "\n<th width='500'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drugatc/atc_name/0', 'ATC Name');
    echo "</th>";
    echo "\n<th width='400'>Anatomical System</th>";
echo "</tr>";
if(isset($drugatc_list)){
    if(count($drugatc_list) < $per_page){
        $per_page = count($drugatc_list);
    }
    $rownum = $row_first + 1;
    for ($i=0; $i < $per_page; $i++){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        //echo "\n<td></td>";//.$complaints_list[$i]['commonly_used']."</td>";
        //echo "\n<td>".$drugatc_list[$i]['atc_code']."</td>";
        echo "\n<td>".anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_edit_drugatc/edit_code/'.$drugatc_list[$i]['atc_code'], "<strong>".$drugatc_list[$i]['atc_code']."</strong>")."</td>";
        echo "\n<td>".$drugatc_list[$i]['atc_name']."</strong></td>";
        //echo "\n<td>".anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_edit_formulary_info/edit_formulary/'.$drugatc_list[$i]['atc_code'], "<strong>".$drugatc_list[$i]['atc_name']."</strong>")."</td>";
        echo "\n<td>".$drugatc_list[$i]['desc_anatomical']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}

echo "</table>";
echo $this->pagination->create_links();
echo "\n<br />";
echo "\n</fieldset>";


