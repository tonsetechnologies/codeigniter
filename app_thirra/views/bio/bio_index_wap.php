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
include_once("header_xhtml-mobile10.php");

echo "\n<body>";

echo "<p>";
    echo $agent . " - " . $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
    if ("Unknown Platform" == $this->agent->platform()){
        echo " - Mobile Device Mode";
    } else {
        echo " - Desktop Mode";
    }
echo "</p>";

echo "\n<h1>THIRRA - Biosurveillance</h1>";

echo "\n<hr />";
echo "\n<h2>Open Cases</h2>";
echo " (Total = ".$count_open_list.")";
echo "\n<ol>";
foreach ($open_list as $case){
    echo "\n<li>";
	echo anchor('bio_phi/edit_case/edit_case/'.$case['patient_id'].'/'.$case['notification_id'].'/'.$case['bio_case_id'], 'Edit');
    echo " : " . $case['case_ref'];
    echo " : " . $case['bio_start_date'];
    echo " : " . $case['short_title'];
    echo " : " . $case['gender'];
    echo " : " . $case['patient_name'];
    echo " : " . $case['birth_date'];
	echo "</li>"; 
}
//endforeach;
echo "</ol>";
echo anchor('bio_phi/cases_open', 'More open cases');

echo "\n<hr />";
echo "<h2>Fresh Cases</h2>";
echo " (Total = ".$count_fresh_list.")";
echo "\n<ol>";
foreach ($fresh_list as $case){
    echo "\n<li>";
	echo anchor('bio_phi/edit_case/new_case/'.$case['patient_id'].'/'.$case['notification_id'], 'New');
    echo " : " . $case['notification_reference'];
    echo " : " . $case['notify_date'];
    echo " : " . $case['short_title'];
    echo " : " . $case['gender'];
    echo " : " . $case['patient_name'];
    echo " : " . $case['birth_date'];
	echo "</li>"; 
}
//endforeach;
echo "</ol>";
echo anchor('bio_phi/cases_fresh', 'More fresh cases');

echo "\n<hr />";
echo "<h2>Closed Cases</h2>";
echo " (Total = ".$count_closed_list.")";
echo "\n<ol>";
foreach ($closed_list as $case){
    echo "\n<li>";
	echo anchor('bio_phi/edit_case/edit_case/'.$case['patient_id'].'/'.$case['notification_id'].'/'.$case['bio_case_id'], 'Edit');
    echo " : " . $case['case_ref'];
    echo " : " . $case['bio_start_date'];
    echo " : " . $case['short_title'];
    echo " : " . $case['gender'];
    echo " : " . $case['patient_name'];
    echo " : " . $case['birth_date'];
	echo "</li>"; 
}
//endforeach;
echo "</ol>";
echo anchor('bio_phi/cases_closed', 'More closed cases');

echo "\n<hr />";
echo "<p>";

echo "</p>";
?>
</body>
</html>
