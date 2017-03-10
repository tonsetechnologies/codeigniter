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

include_once("header_xhtml1-strict.php");
//include_once("header_xhtml-mobile10.php");

echo "\n<body>";

echo "\n<div align='center'><h1>THIRRA - Add New Notification</h1></div>";
echo "<p>";
echo anchor('bio/new_notify', 'Add New Patient');

echo "</p>";

echo form_open('bio/search_new_case');
echo "<br /><input type='text' name='patient_name' value='' size='40' />";
echo "<input type='submit' value='Search Another Name to Add New Notification' /> e.g. Ang";
echo "</form>";

echo "Found the following patients with the name containing <strong>'$name_filter'</strong>:";

echo "\n<p><table>";
foreach ($patlist as $patient){
    echo "<tr>";
        echo "\n<td>";
    	    echo anchor('bio/new_notify/'.$patient['patient_id'], 'New Notification');
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
            echo $patient['bio_case_id'];
	    echo "</td>"; 
        echo "\n<td>";
            echo $patient['case_ref'];
	    echo "</td>"; 
        echo "\n<td>";
            echo $patient['start_date'];
	    echo "</td>"; 
}
//endforeach;
echo "</table></p>";



?>
</body>
</html>
