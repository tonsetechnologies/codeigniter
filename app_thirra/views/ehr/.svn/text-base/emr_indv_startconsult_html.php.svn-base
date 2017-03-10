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
	echo '<pre>';
		print_r($patient_info);
		print_r($patcon_info);
	echo '</pre>';
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_indv_startconsult_html_title')."</h1></div>";

echo "<h1>Individual Consultation</h1>";
echo "<table>";
echo "\n<tr>";
	echo "<td>";
		echo 'Patient Name';
	echo '</td>';
	echo '<td><strong>';
		echo $patient_info['name'];
	echo '</strong></td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Birth Date';
	echo '</td>';
	echo '<td><strong>';
		echo $patient_info['birth_date'];
	echo '</strong></td>';
echo '</tr>';
echo '</table>';

echo "\n<p>";
echo "Start new consultation? Click button to commence.";
echo "\n<form action='".base_url()."index.php/ehr_consult/consult_episode/' method='post'>";
echo form_hidden('form_purpose', $form_purpose);
echo "\n<input type='hidden' name='patient_id' value='".$patient_id."' size='50' />";
echo "\n<input type='hidden' name='summary_id' value='new_summary' size='50' />";
echo "\n<input type='submit' value='Start' />";
echo "\n</form>";

echo "</p>";

echo "</div>";

echo "</div>"; //id=body
