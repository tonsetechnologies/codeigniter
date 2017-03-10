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
    echo "\n<br />print_r(imaging_list)=<br />";
		print_r($imaging_list);
	echo '</pre>';
    echo "\n<br />debug_mode=".$debug_mode;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_history_imaging_html_title')."</h1></div>";


echo "\n<fieldset>";
echo "<legend>IMAGING TESTS LIST</legend>";
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Sample Date</th>";
    echo "\n<th width='100'>Code</th>";
    echo "\n<th width='250'>Package</th>";
    echo "\n<th width='250'>Supplier</th>";
    echo "\n<th width='250'>Results</th>";
    echo "\n<th width='250'>Remarks</th>";
echo "</tr>";
if(isset($imaging_list)){
    $rownum = 1;
    foreach ($imaging_list as $imaging_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('ehr_individual_history/edit_imagresult/edit_result/'.$imaging_item['order_id'], "<strong>".$imaging_item['date_started']."</strong>")."</td>";
        echo "\n<td>".$imaging_item['product_code']."</td>";
        echo "\n<td>".$imaging_item['description']."</td>";
        echo "\n<td>".$imaging_item['supplier_name']."</td>";
        echo "\n<td><strong>".$imaging_item['notes']."</strong></td>";
        echo "\n<td>".$imaging_item['remarks']."</td>";
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


