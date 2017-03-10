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
    echo "\n<br />print_r(supplier_list)=<br />";
		print_r($supplier_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('phar_list_closed_prescriptions_html_title')."</h1></div>";


echo "\n<fieldset>";
echo "<legend>CLOSED RESULTS LIST</legend>";
        echo "\n<table>";
            echo "\n<tr>";
                echo "\n<th>print</th>";
                echo "\n<th width='250'>Name</th>";
                echo "\n<th>Birth date</th>";
                echo "\n<th>Sex</th>";
                echo "\n<th>Session Date</th>";
            echo "</tr>";
        foreach ($prescription_info as $prescription_item){
            echo "\n<tr>";
            echo "<td>";
            echo anchor('ehr_pharmacy/print_prescription/'.$prescription_item['patient_id'].'/'.$prescription_item['session_id'], 'html', "target='_blank'");
            echo " ";
            echo anchor('ehr_pharmacy/print_prescription/'.$prescription_item['patient_id'].'/'.$prescription_item['session_id'], 'pdf', "target='_blank'");
            echo "</td>";
            echo "<td>".$prescription_item['name']."</td>";
            echo "<td>".$prescription_item['birth_date']."</td>";
            echo "<td>".$prescription_item['gender']."</td>";
            echo "<td>".$prescription_item['date_ended']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "\n</table>";
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


