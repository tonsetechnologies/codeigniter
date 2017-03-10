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
    echo "\n<br />print_r(diagnoses_list)=<br />";
		print_r($diagnoses_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_history_diagnosis_html_title')."</h1></div>";


echo "\n<fieldset>";
echo "<legend>DIAGNOSES LIST</legend>";
echo "<strong>Add New Medical History</strong>";
//echo anchor('ehr_utilities/util_edit_district_info/new_district/new_district', "<strong>Add New District</strong>");
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Date Recorded</th>";
    echo "\n<th width='50'>Code</th>";
    echo "\n<th width='300'>Condition</th>";
    echo "\n<th width='300'>Notes</th>";
    echo "\n<th width='50'>Mapped</th>";
    echo "\n<th width='150'>Recorded by</th>";
echo "</tr>";
if(isset($diagnoses_list)){
    $rownum = 1;
    foreach ($diagnoses_list as $diagnosis_item){
        echo "\n<tr>";
        echo "\n<td valign='top'>".$rownum.".</td>";
        //echo "\n<td>".anchor('ehr_utilities/util_edit_state_info/edit_state/'.$vitals_item['vital_id'], "<strong>".$vitals_item['reading_date']."</strong>")."</td>";
        echo "\n<td valign='top'>".$diagnosis_item['date_ended']."</td>";
        echo "\n<td valign='top'>".$diagnosis_item['dcode1ext_code']."</td>";
        echo "\n<td valign='top'><strong>".$diagnosis_item['full_title']."</strong></td>";
        echo "\n<td valign='top'>".$diagnosis_item['diagnosis_notes']."</td>";
        echo "\n<td valign='top'>".$diagnosis_item['dcode2ext_code']."</td>";
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


