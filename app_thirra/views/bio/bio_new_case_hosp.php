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
//include_once("header_xhtml1-transitional.php");

$init_case_ref      =   NULL;
$init_case_findings =   NULL;
$init_case_summary  =   NULL;
$init_end_date      =   NULL;

echo "\n<body>";

echo "\n<div align='center'><h1>THIRRA - Add New Case</h1></div>";
print "Session info = " . $_SESSION['thirra_mode'];
print "<br />User = " . $_SESSION['username'];

//echo validation_errors(); Displays ALL errors in one place.
echo $save_attempt;
echo form_open('bio/new_case/'.$patient_id);

if ($save_attempt == "Edit Case") {
    //echo "case_ref=".$bio_case_details[0]['case_ref'];
    $init_case_ref      =   $patient_info['name'];
    $init_case_findings =   $patient_info['gender'];
    $init_case_summary  =   $patient_info['birth_date'];
    $init_end_date      =   $patient_info['town'];
}

echo "<table>";
echo "\n<tr><td>Name</td><td>";
echo form_error('case_ref');
echo "<input type='text' name='case_ref' value='".set_value('case_ref',$init_case_ref)."' size='50' /></td></tr>";

echo "\n<tr><td>Gender</td><td>";
echo form_error('case_findings');
echo "<input type='text' name='case_findings' value='".set_value('case_findings',$init_case_findings)."' size='6' /></td></tr>";

echo "\n<tr><td>Birth Date</td><td>";
echo form_error('case_summary');
echo "<input type='text' name='case_summary' value='".set_value('case_summary',$init_case_summary)."' size='10' /></td></tr>";

echo "\n<tr><td>Town</td><td>";
echo form_error('end_date');
echo "<input type='text' name='end_date' value='".set_value('end_date',$init_end_date)."' size='10' /></td></tr>\n";

echo "</table>";
?>
<div align='center'><br /><input type="submit" value="Save" /></div>

</form>

</body>
</html>
