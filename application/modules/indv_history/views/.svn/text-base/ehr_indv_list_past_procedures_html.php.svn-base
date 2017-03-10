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

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_past_procedures_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<fieldset>";
echo "<legend>LIST OF PAST PROCEDURES</legend>";
//echo "<strong>Add New Past Procedure</strong>";
echo anchor('indv/indv/index/indv_history/ehr_indvhist_procedure/edit_past_procedure/new_procedure/'.$patient_id, "<strong>Add New Past Procedure</strong>");
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Procedure Date</th>";
    echo "\n<th width='250'>Procedure</th>";
    echo "\n<th width='300'>Notes</th>";
    echo "\n<th width='250'>Place</th>";
    echo "\n<th width='300'>Outcome</th>";
    echo "\n<th width='250'>Remarks</th>";
echo "</tr>";
if(isset($procedure_list)){
    $rownum = 1;
    foreach ($procedure_list as $procedure_item){
        echo "\n<tr>";
        echo "\n<td valign='top'>".$rownum.".</td>";
        switch($procedure_item['date_precision']){
            case "F":
                // Full
                $procedure_date =   substr($procedure_item['procedure_date'],0,10);
                break;
            case "M":
                // Month
                $procedure_date =   substr($procedure_item['procedure_date'],0,7);
                break;
            case "Y":
                // Year
                $procedure_date =   substr($procedure_item['procedure_date'],0,4);
                break;
            case "D":
                // Decades
                $procedure_date =   substr($procedure_item['procedure_date'],0,3)."0's";
                break;
            default:
                $procedure_date =   "Unknown";
        }
        echo "\n<td valign='top'>".$procedure_date."</td>";
        //echo "\n<td valign='top'>".$procedure_item['procedure_date']."</td>";
        echo "\n<td>".anchor('indv/indv/index/indv_history/ehr_indvhist_procedure/edit_past_procedure/edit_procedure/'.$patient_id.'/'.$procedure_item['past_procedure_id'], "<strong>".$procedure_item['pcode1ext_longname']."</strong>")."</td>";
        echo "\n<td valign='top'>".$procedure_item['procedure_notes']."</td>";
        echo "\n<td valign='top'>".$procedure_item['procedure_place']."</td>";
        echo "\n<td valign='top'>".$procedure_item['procedure_outcome']."</td>";
        echo "\n<td valign='top'>".$procedure_item['outcome_remarks']."</td>";
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


