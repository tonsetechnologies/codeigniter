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
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    print "<br />location = " . $_SESSION['location_id'];
    echo $device_mode;
    echo "\n</div>";
}

echo "\n\n<div align='center'><h1>".$this->lang->line('cases_mgt_html_title')."</h1></div>";

echo form_open('bio/search_new_notify');
echo "\n<br /><input type='text' name='patient_name' value='' size='40' />";
echo "<input type='submit' value='Search Name to Add New Notification' /> e.g. Ang";
echo "</form>";


echo "\n<h2>Closed Cases</h2>";
echo $this->pagination->create_links();      

echo "\n<table border='1' class='line' cellpadding='2'>";
    echo "\n<tr>";
        echo "<th>No.</th>";
        echo "<th>Date Reported</th>";
        echo "<th>Case Ref.</th>";
        echo "<th>Hospital</th>";
        echo "<th width='200'>Name</th>";
        echo "<th>ID</th>";
        echo "<th>Birth Date</th>";
        echo "<th>Sex</th>";
        echo "<th width='200'>Diagnosis</th>";
        echo "<th>Home Village/Town</th>";
    echo "</tr>";
$rowcount = $row_first + 1;
foreach ($closed_list as $case){
	//echo anchor('bio/edit_case/'.$case['bio_case_id'], 'Edit');
    echo "\n<tr>";
        echo "<td>$rowcount.</td>";
        echo "<td>".$case['bio_start_date']."</td>";
        echo "<td>".$case['case_ref']."</td>";
        echo "<td>".$case['clinic_shortname']."</td>";
        echo "<td>".$case['patient_name']."</td>";
        echo "<td>".$case['ic_other_no']."</td>";
        echo "<td>".$case['birth_date']."</td>";
        echo "<td>".$case['gender']."</td>";
        echo "<td>".$case['dcode1ext_longname']."</td>";
        echo "<td>".$case['patient_town']."</td>";
    echo "</tr>";
    $rowcount++;
}//endforeach;
echo "</table>";
echo $this->pagination->create_links();      

echo "<p>";

echo "</p>";

echo "</div>"; //id=body
