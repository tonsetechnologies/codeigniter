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
    echo "\n<br />print_r(village_list)=<br />";
		print_r($village_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_list_addrvillages_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<p>";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrstates/addr_state_sort', 'State');
    echo "\n > ";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrdistricts/addr_district_sort', 'District');
    echo "\n > ";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrareas/addr_area_sort', 'Area');
    echo "\n > ";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrtowns/addr_town_sort', 'Town');
    echo "\n > ";
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_village_sort', 'Villages');
echo "</p>";

echo "\n<fieldset>";
echo "<legend>VILLAGES LIST</legend>";
echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_village_info/new_village/new_village', "<strong>Add New Village</strong>");
echo "\n<br /><br />";

echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_village_code', 'Code');
    echo "</th>";
    echo "\n<th width='300'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_village_name', 'Village Name');
    echo "</th>";
    echo "\n<th width='250'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_town_name', 'Town');
    echo "</th>";
    echo "\n<th width='250'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_area_name', 'Area');
    echo "</th>";
    echo "\n<th width='200'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_district_name', 'District');
    echo "</th>";
    echo "\n<th width='50'>Sort</th>";
    echo "\n<th width='250'>Description</th>";
echo "</tr>";
if(isset($village_list)){
    $rownum = 1;
    foreach ($village_list as $village_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$village_item['addr_village_code']."</td>";
        echo "\n<td>".anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_village_info/edit_village/'.$village_item['addr_village_id'], "<strong>".$village_item['addr_village_name']."</strong>")."</td>";
        echo "\n<td>".$village_item['addr_town_name']."</td>";
        echo "\n<td><strong>".$village_item['addr_area_name']."</strong></td>";
        echo "\n<td>".$village_item['addr_district_name']."</td>";
        echo "\n<td>".$village_item['addr_village_sort']."</td>";
        echo "\n<td>".$village_item['addr_village_descr']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";



