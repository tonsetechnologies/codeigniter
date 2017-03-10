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
 * Portions created by the Initial Developer are Copyright (C) 2009
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";

if($debug_mode) {
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
}

echo "\n\n<div align='center'><h1>".$this->lang->line('pharmacy_mgt_html_title')."</h1></div>";

echo "\n\n<div id='pharmacy_dispensings' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Dispensings</h2></p>";
	echo "\n<p class='section_body'>";
        echo "\n<table>";
            echo "\n<tr>";
                echo "\n<th>print</th>";
                echo "\n<th width='200'>Name</th>";
                echo "\n<th>Birth date</th>";
                echo "\n<th>Sex</th>";
                echo "\n<th>Session Date</th>";
            echo "</tr>";
        foreach ($dispensing_info as $dispensing_item){
            echo "<tr>";
            echo "<td>".anchor('ehr_pharmacy/print_prescription/'.$dispensing_item['session_id'], 'print', "target='_blank'")."</td>";
            echo "<td>".$dispensing_item['name']."</td>";
            echo "<td>".$dispensing_item['birth_date']."</td>";
            echo "<td>".$dispensing_item['gender']."</td>";
            echo "<td>".$dispensing_item['date_ended']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "\n</table>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='pharmacy_prescriptions' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Prescriptions</h2></p>";
	echo "\n<p class='section_body'>";
        echo "\n<table>";
            echo "\n<tr>";
                echo "\n<th>print</th>";
                echo "\n<th width='200'>Name</th>";
                echo "\n<th>Birth date</th>";
                echo "\n<th>Sex</th>";
                echo "\n<th>Session Date</th>";
            echo "</tr>";
        foreach ($prescription_info as $prescription_item){
            echo "<tr>";
            echo "<td>".anchor('ehr_pharmacy/print_prescription/'.$prescription_item['session_id'], 'print', "target='_blank'")."</td>";
            echo "<td>".$prescription_item['name']."</td>";
            echo "<td>".$prescription_item['birth_date']."</td>";
            echo "<td>".$prescription_item['gender']."</td>";
            echo "<td>".$prescription_item['date_ended']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "\n</table>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='pharmacy_inventory' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Inventory</h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='pharmacy_drug_codes' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Drug Codes</h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='pharmacy_' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2></h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "</div>"; //id=body
