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

//include_once("header_xhtml1-strict.php");
include_once("header_xhtml1-transitional.php");

echo "\n<body>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    echo $device_mode;
    echo "<p>";
        echo $agent . " - " . $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
        if ("Unknown Platform" == $this->agent->platform()){
            echo " - Mobile Device Mode";
        } else {
            echo " - Desktop Mode";
        }
    echo "</p>";
	echo '<pre>';
    echo "\n<br />print_r(fresh_list)=<br />";
		print_r($fresh_list);
    echo "\n<br />print_r(open_list)=<br />";
		print_r($open_list);
    echo "\n<br />print_r(closed_list)=<br />";
		print_r($closed_list);
	echo '</pre>';
    echo "\n</div>";
}


echo "\n<div align='center'><h1>PHI OFFICE</h1></div>";

echo "\n<h2>Fresh Cases</h2>";
echo " (Total = ".$count_fresh_list.")";
echo "\n<table border='1' class='line' cellpadding='2'>";
    echo "\n<tr>";
        echo "<th>No.</th>";
        echo "<th>Start</th>";
        echo "<th>Notify<br /> Ref.</th>";
        echo "<th>Date Notified</th>";
        echo "<th>Illness Started</th>";
        echo "<th>Hospital</th>";
        echo "<th width='200'>Name</th>";
        echo "<th>ID</th>";
        echo "<th>Birth Date</th>";
        echo "<th>Sex</th>";
        echo "<th width='200'>Diagnosis</th>";
        echo "<th>Home Village/Town</th>";
        echo "<th>Form 544</th>";
    echo "</tr>";
$rowcount   =   1;
foreach ($fresh_list as $case){
	//echo anchor('bio/edit_case/'.$case['bio_case_id'], 'Edit');
    echo "\n<tr>";
        echo "<td>$rowcount.</td>";
        echo "<td>". anchor('bio_phi/edit_case/new_case/'.$case['patient_id'].'/'.$case['notification_id'], 'New') ."</td>";
        echo "<td>".$case['notification_reference']."</td>";
        echo "<td>".$case['notify_date']."</td>";
        echo "<td>".$case['illness_started']."</td>";
        echo "<td>".$case['clinic_shortname']."</td>";
        echo "<td>".$case['patient_name']."</td>";
        echo "<td>".$case['ic_other_no']."</td>";
        echo "<td>".$case['birth_date']."</td>";
        echo "<td>".$case['gender']."</td>";
        echo "<td><strong>".$case['short_title']."</strong></td>";
        echo "<td>".$case['patient_town']."</td>";
        echo "<td>";
	    echo anchor('bio_hospital/print_form544/html/'.$case['patient_id'].'/'.$case['summary_id'].'/'.$case['bio_case_id'], 'html', 'target="_blank"');
        echo " ";
	    echo anchor('bio_hospital/print_form544/pdf/'.$case['patient_id'].'/'.$case['summary_id'].'/'.$case['bio_case_id'], 'pdf', 'target="_blank"');
        echo "</td>";
    echo "</tr>";
    $rowcount++;
}//endforeach;
echo "</table>";
echo anchor('bio_phi/cases_fresh', 'More fresh cases');


echo "\n<h2>Open Cases</h2>";
echo " (Total = ".$count_open_list.")";
echo "\n<table border='1' class='line' cellpadding='2'>";
    echo "\n<tr>";
        echo "<th>No.</th>";
        echo "<th>Date Reported</th>";
        echo "<th>Register</th>";
        echo "<th>Hospital</th>";
        echo "<th width='200'>Name</th>";
        echo "<th>ID</th>";
        echo "<th>Birth Date</th>";
        echo "<th>Sex</th>";
        echo "<th width='200'>Diagnosis</th>";
        echo "<th>Home Village/Town</th>";
        echo "<th>Form 411</th>";
        echo "<th>Form 544</th>";
    echo "</tr>";
$rowcount   =   1;
foreach ($open_list as $case){
    echo "\n<tr>";
        echo "<td>$rowcount.</td>";
        echo "<td>".$case['bio_start_date']."</td>";
        echo "<td>".anchor('bio_phi/edit_case/edit_case/'.$case['patient_id'].'/'.$case['notification_id'].'/'.$case['bio_case_id'], 'Edit')." ".$case['case_ref']."</td>";
        echo "<td>".$case['clinic_shortname']."</td>";
        echo "<td>".$case['patient_name']."</td>";
        echo "<td>".$case['ic_other_no']."</td>";
        echo "<td>".$case['birth_date']."</td>";
        echo "<td>".$case['gender']."</td>";
        echo "<td><strong>".$case['short_title']."</strong></td>";
        echo "<td>".$case['patient_town']."</td>";
        echo "<td>";
	    echo anchor('bio_phi/print_form411/html/'.$case['patient_id'].'/'.$case['notification_id'].'/'.$case['bio_case_id'], 'html', 'target="_blank"');
        echo " ";
	    echo anchor('bio_phi/print_form411/pdf/'.$case['patient_id'].'/'.$case['notification_id'].'/'.$case['bio_case_id'], 'pdf', 'target="_blank"');
        echo "</td>";
        echo "<td>";
	    echo anchor('bio_hospital/print_form544/html/'.$case['patient_id'].'/'.$case['summary_id'].'/'.$case['bio_case_id'], 'html', 'target="_blank"');
        echo " ";
	    echo anchor('bio_hospital/print_form544/pdf/'.$case['patient_id'].'/'.$case['summary_id'].'/'.$case['bio_case_id'], 'pdf', 'target="_blank"');
        echo "</td>";
    echo "</tr>";
    $rowcount++;
}//endforeach;
echo "</table>";
echo anchor('bio_phi/cases_open', 'More open cases');


echo "\n<h2>Closed Cases</h2>";
echo " (Total = ".$count_closed_list.")";
echo "\n<table border='1' class='line' cellpadding='2'>";
    echo "\n<tr>";
        echo "<th>No.</th>";
        echo "<th>Date Reported</th>";
        echo "<th>Register</th>";
        echo "<th>Hospital</th>";
        echo "<th width='200'>Name</th>";
        echo "<th>ID</th>";
        echo "<th>Birth Date</th>";
        echo "<th>Sex</th>";
        echo "<th width='200'>Diagnosis</th>";
        echo "<th>Home Village/Town</th>";
        echo "<th>Form 411</th>";
        echo "<th>Form 544</th>";
    echo "</tr>";
$rowcount   =   1;
foreach ($closed_list as $case){
    echo "\n<tr>";
        echo "<td>$rowcount.</td>";
        echo "<td>".$case['bio_start_date']."</td>";
        echo "<td>".anchor('bio_phi/edit_case/edit_case/'.$case['patient_id'].'/'.$case['notification_id'].'/'.$case['bio_case_id'], 'Edit')." ".$case['case_ref']."</td>";
        echo "<td>".$case['clinic_shortname']."</td>";
        echo "<td>".$case['patient_name']."</td>";
        echo "<td>".$case['ic_other_no']."</td>";
        echo "<td>".$case['birth_date']."</td>";
        echo "<td>".$case['gender']."</td>";
        echo "<td><strong>".$case['short_title']."</strong></td>";
        echo "<td>".$case['patient_town']."</td>";
        echo "<td>";
	    echo anchor('bio_phi/print_form411/html/'.$case['patient_id'].'/'.$case['notification_id'].'/'.$case['bio_case_id'], 'html', 'target="_blank"');
        echo " ";
	    echo anchor('bio_phi/print_form411/pdf/'.$case['patient_id'].'/'.$case['notification_id'].'/'.$case['bio_case_id'], 'pdf', 'target="_blank"');
        echo "</td>";
        echo "<td>";
	    echo anchor('bio_hospital/print_form544/html/'.$case['patient_id'].'/'.$case['summary_id'].'/'.$case['bio_case_id'], 'html', 'target="_blank"');
        echo " ";
	    echo anchor('bio_hospital/print_form544/pdf/'.$case['patient_id'].'/'.$case['summary_id'].'/'.$case['bio_case_id'], 'pdf', 'target="_blank"');
        echo "</td>";
    echo "</tr>";
    $rowcount++;
}//endforeach;
echo "</table>";
echo anchor('bio_phi/cases_closed', 'More closed cases');


