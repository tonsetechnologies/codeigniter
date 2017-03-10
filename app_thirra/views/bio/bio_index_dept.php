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

if($debug_mode) {
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    print "<br />location = " . $_SESSION['location_id'];
    echo $device_mode;
}
echo "<p>";
    echo $agent . " - " . $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
    if ("Unknown Platform" == $this->agent->platform()){
        echo " - Mobile Device Mode";
    } else {
        echo " - Desktop Mode";
    }
echo "</p>";

echo "\n<div align='center'><h1>THIRRA - Health Department</h1></div>";

echo "\n<h2>Fresh Cases</h2>";
echo "\n<table border='1' class='line' cellpadding='2'>";
    echo "\n<tr>";
        echo "<th>No.</th>";
        echo "<th>Notification</th>";
        echo "<th>Reference</th>";
        echo "<th>Date Notified</th>";
        echo "<th>Illness Started</th>";
        echo "<th>Hospital</th>";
        echo "<th width='200'>Name</th>";
        echo "<th>ID</th>";
        echo "<th>Birth Date</th>";
        echo "<th>Sex</th>";
        echo "<th width='200'>Diagnosis</th>";
        echo "<th>Home Village/Town</th>";
    echo "</tr>";
$rowcount   =   1;
foreach ($fresh_list as $case){
	//echo anchor('bio/edit_case/'.$case['bio_case_id'], 'Edit');
    echo "\n<tr>";
        echo "<td>$rowcount.</td>";
        echo "<td>". anchor('bio/edit_notify/edit_notify/'.$case['patient_id'].'/'.$case['notification_id'], 'Edit') ."</td>";
        echo "<td>".$case['notification_reference']."</td>";
        echo "<td>".$case['notify_date']."</td>";
        echo "<td>".$case['illness_started']."</td>";
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


echo "\n<h2>Open Cases</h2>";
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
$rowcount   =   1;
foreach ($open_list as $case){
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


echo "\n<h2>Closed Cases</h2>";
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
$rowcount   =   1;
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

echo "\n<h2>Print Reports</h2>";
echo "<h2>Print Blank Forms</h2>";
echo "<p>";

echo "</p>";
?>
</body>
</html>
