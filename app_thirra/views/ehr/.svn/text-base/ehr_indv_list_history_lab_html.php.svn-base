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
    echo "\n<br />print_r(tests_list)=<br />";
		print_r($tests_list);
	echo '</pre>';
    echo "\n<br />debug_mode=".$debug_mode;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_history_lab_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<fieldset>";
echo "<legend>LAB TESTS LIST</legend>";
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Sample Date</th>";
    echo "\n<th width='100'>Code</th>";
    echo "\n<th width='250'>Package</th>";
    echo "\n<th width='150'>Supplier</th>";
    echo "\n<th width='250'>Remarks</th>";
    echo "\n<th width='250'>Result summary</th>";
echo "</tr>";
if(isset($tests_list)){
    $rownum = 1;
    foreach ($tests_list as $lab_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('ehr_individual_history/edit_labresults/edit_labresults/'.$patient_id.'/'.$lab_item['session_id'].'/'.$lab_item['lab_order_id'], "<strong>".$lab_item['sample_date']."</strong>")."</td>";
        echo "\n<td>".$lab_item['package_code']."</td>";
        echo "\n<td>".$lab_item['package_name']."</td>";
        echo "\n<td>".$lab_item['supplier_name']."</td>";
        echo "\n<td>".$lab_item['remarks']."</td>";
        echo "\n<td>".$lab_item['summary_result']."</td>";
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


