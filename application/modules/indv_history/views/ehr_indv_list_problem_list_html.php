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
 * Portions created by the Initial Developer are Copyright (C) 2010 - 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username');
	echo '<pre>';
    echo "\n<br />print_r(diagnoses_list)=<br />";
		print_r($diagnoses_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_problem_list_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<fieldset>";
echo "<legend>LIST OF PROBLEMS OR CONCERNS</legend>";
//echo "<strong>Add New Past Procedure</strong>";
echo anchor('indv/indv/index/indv_history/ehr_indvhist_problemlist/edit_problem_list/new_problem/'.$patient_id, "<strong>Add New Problem</strong>");
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Date Recorded</th>";
    echo "\n<th width='50'>Staff</th>";
    echo "\n<th width='500'>Problem</th>";
echo "</tr>";
if(isset($problem_list)){
    $rownum = 1;
    foreach ($problem_list as $problem_item){
        echo "\n<tr>";
        echo "\n<td valign='top'>".$rownum.".</td>";
       echo "\n<td valign='top'>".anchor('indv/indv/index/indv_history/ehr_indvhist_problemlist/edit_problem_list/edit_problem/'.$patient_id.'/'.$problem_item['problem_list_id'], "<strong>".$problem_item['date']."</strong>")."</td>";
        echo "\n<td valign='top'>".$problem_item['staff_initials']."</td>";
        echo "\n<td valign='top'>".$problem_item['problem']."</td>";
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


