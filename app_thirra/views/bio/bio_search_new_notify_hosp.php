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

echo "\n<div align='center'><h1>THIRRA - Add New Notification</h1></div>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />name_filter = " . $name_filter;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patlist)=<br />";
		print_r($patlist);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "<p><strong>";
echo anchor('bio_hospital/edit_patient/new_notify/new_patient', 'Add New Patient');

echo "</strong></p>";

echo form_open('bio_hospital/search_new_notify');
echo "\n<br /><input type='text' name='patient_name' value='' size='40' />";
echo "<input type='submit' value='Search Another Name to Add New Notification' /> e.g. Ang";
echo "</form>";

echo "Found the following patients with the name containing <strong>'$name_filter'</strong>:";

echo "\n<p><table border='1' class='line' cellpadding='2'>";
echo "<tr>";
    echo "<th>No.</th>";
    echo "<th>New Notification</th>";
    echo "<th>Edit Patient</th>";
    echo "<th>Name</th>";
    echo "<th>Clinic Ref No.</th>";
    echo "<th>Gender</th>";
    echo "<th>Other IC No.</th>";
    echo "<th>Birth Date</th>";
    echo "<th>Reference</th>";
    echo "<th>Notify Date</th>";
    echo "<th>Onset Date</th>";
echo "</tr>";
$rownum = 1;
foreach ($patlist as $patient){
    echo "<tr>";
        echo "\n<td>";
            echo $rownum;
	    echo "</td>"; 
        echo "\n<td>";
    	    echo anchor('bio_hospital/edit_notify544/new_notify/'.$patient['patient_id'], 'New Form 544');
	    echo "</td>"; 
        echo "\n<td>";
    	    echo anchor('bio_hospital/edit_patient/new_notify/'.$patient['patient_id'], 'Edit Patient');
	    echo "</td>"; 
        echo "\n<td>";
            echo $patient['name'];
	    echo "</td>"; 
        echo "\n<td>";
            echo $patient['clinic_reference_number'];
	    echo "</td>"; 
        echo "\n<td>";
            echo $patient['gender'];
	    echo "</td>"; 
        echo "\n<td>";
            echo $patient['ic_other_no'];
	    echo "</td>"; 
        echo "\n<td>";
            echo $patient['birth_date'];
	    echo "</td>"; 
        echo "\n<td>";
            echo $patient['notification_reference'];
	    echo "</td>"; 
        echo "\n<td>";
            echo $patient['notify_date'];
	    echo "</td>"; 
        echo "\n<td>";
            echo $patient['started_date'];
	    echo "</td>"; 
        $rownum++;
}
//endforeach;
echo "</table></p>";



?>
</body>
</html>
