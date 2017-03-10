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
    echo "\n<br />print_r(history_info)=<br />";
		print_r($history_info);
    echo "\n<br />print_r(family_above)=<br />";
		print_r($family_above);
    echo "\n<br />print_r(family_below)=<br />";
		print_r($family_below);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_list_family_relations_html_title')."</h1></div>";


echo "\n<fieldset>";
echo "<legend>GENERATIONS  ABOVE</legend>";
//echo "<strong>Add New History</strong>";
echo anchor('ehr_individual/edit_history_social/'.$patient_id.'/new_history/new_history', "<strong>Add New Relationship</strong>");
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='300'>Name</th>";
    echo "\n<th width='100'>Birth Date</th>";
    echo "\n<th width='80'>Sex</th>";
    echo "\n<th width='150'>Ref. No.</th>";
    echo "\n<th width='150'>NRIC</th>";
echo "</tr>";
if(isset($family_above)){
    $rownum = 1;
    foreach ($family_above as $above_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('ehr_individual/individual_overview/'.$above_item['patient_id'], "<strong>".$above_item['name']."</strong>", 'target="_blank"')."</td>";
        echo "\n<td>".$above_item['birth_date']."</td>";
        echo "\n<td>".$above_item['gender']."</td>";
        echo "\n<td>".$above_item['clinic_reference_number']."</td>";
        echo "\n<td>".$above_item['ic_no']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";

echo "\n<h3>".$patient_info['name']."</h3>";
echo "\n<fieldset>";
echo "<legend>GENERATIONS BELOW</legend>";
//echo "<strong>Add New History</strong>";
echo anchor('ehr_individual/edit_history_social/'.$patient_id.'/new_history/new_history', "<strong>Add New Relationship</strong>");
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='300'>Name</th>";
    echo "\n<th width='100'>Birth Date</th>";
    echo "\n<th width='80'>Sex</th>";
    echo "\n<th width='150'>Ref. No.</th>";
    echo "\n<th width='150'>NRIC</th>";
echo "</tr>";
if(isset($family_below)){
    $rownum = 1;
    foreach ($family_below as $below_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('ehr_individual/individual_overview/'.$below_item['patient_id'], "<strong>".$below_item['name']."</strong>, ".$below_item['name_first'], 'target="_blank"')."</td>";
        echo "\n<td>".$below_item['birth_date']."</td>";
        echo "\n<td>".$below_item['gender']."</td>";
        echo "\n<td>".$below_item['clinic_reference_number']."</td>";
        echo "\n<td>".$below_item['ic_no']."</td>";
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


