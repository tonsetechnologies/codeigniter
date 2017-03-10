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
 * Portions created by the Initial Developer are Copyright (C) 2009-2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username');
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(patient_past_con)=<br />";
		print_r($patient_past_con);
	echo '</pre>';
    echo "\n</div>";
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
echo "\n<form action='".base_url()."index.php/cons/cons/index/cons_progress/ehr_consult/consult_episode/edit_episode/".$patient_id."/".$summary_id."/".$summary_ref."' method='post'>";
echo form_hidden('form_purpose', $form_purpose);
echo "\n<input type='hidden' name='patient_id' value='".$patient_id."' size='50' />";
echo "\n<input type='hidden' name='summary_id' value='".$summary_id."' size='50' />";
//echo "\n<input type='hidden' name='summary_id' value='new_summary' size='50' />";
echo "\n<input type='submit' value=' S T A R T ' />";
echo "\n</form>";

echo "</p>";
echo "\n<br /><p>Last consultation: ";
if(count($patient_past_con) > 0){
    echo $patient_past_con[0]['date_ended'];
    echo "&nbsp;&nbsp;";
    echo $patient_past_con[0]['time_ended'];
} else {
    echo "N/A";
} 
echo "</p>";
echo "</div>"; // id='content'

echo "</div>"; //id=body
