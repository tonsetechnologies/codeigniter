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
 * Portions created by the Initial Developer are Copyright (C) 2010
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(area_list)=<br />";
		print_r($area_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_list_addrstates_html_title')."</h1></div>";

echo "\n<p>";
    echo anchor('ehr_utilities/util_list_addrstates/addr_state_sort', 'State');
    echo "\n > ";
    echo anchor('ehr_utilities/util_list_addrdistricts/addr_district_sort', 'District');
    echo "\n > ";
    echo anchor('ehr_utilities/util_list_addrareas/addr_area_sort', 'Area');
    echo "\n > ";
    echo anchor('ehr_utilities/util_list_addrtowns/addr_town_sort', 'Town');
    echo "\n > ";
    echo anchor('ehr_utilities/util_list_addrvillages/addr_village_sort', 'Villages');
echo "</p>";

echo "\n<fieldset>";
echo "<legend>STATES LIST</legend>";
echo "<strong>Add New State</strong>";
//echo anchor('ehr_utilities/util_edit_district_info/new_district/new_district', "<strong>Add New District</strong>");
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>";
	echo anchor('ehr_utilities/util_list_addrstates/addr_state_code', 'Code');
    echo "</th>";
    echo "\n<th width='300'>";
	echo anchor('ehr_utilities/util_list_addrstates/addr_state_name', 'State Name');
    echo "</th>";
    echo "\n<th width='200'>";
	echo anchor('ehr_utilities/util_list_addrstates/addr_state_country', 'Country');
    echo "</th>";
    echo "\n<th width='50'>Sort</th>";
    echo "\n<th width='250'>Description</th>";
echo "</tr>";
if(isset($state_list)){
    $rownum = 1;
    foreach ($state_list as $state_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$state_item['addr_state_code']."</td>";
        echo "\n<td>".anchor('ehr_utilities/util_edit_state_info/edit_state/'.$state_item['addr_state_id'], "<strong>".$state_item['addr_state_name']."</strong>")."</td>";
        echo "\n<td>".$state_item['addr_state_country']."</td>";
        echo "\n<td>".$state_item['addr_state_sort']."</td>";
        echo "\n<td>".$state_item['addr_state_descr']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";





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


