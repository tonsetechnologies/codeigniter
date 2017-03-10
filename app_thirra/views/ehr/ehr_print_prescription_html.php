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

echo "\n\n<div id='print_content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    print "\n<br />patient_id = " . $patient_id;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(prescribe_list)=<br />";
		print_r($prescribe_list);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('12900-100_past_con_details_html_title')."</h1></div>";

echo "\n<p>";

echo "\n<table>";
echo "\n<tr>";
	echo "<td width='200'>";
		echo 'Patient\'s Name';
	echo '</td>';
	echo '<td>';
        echo "<h3>".$patient_info['name'].", ".$patient_info['name_first']."</h3>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Date of Birth / Sex';
	echo '</td>';
	echo '<td>';
        echo $patient_info['birth_date']." / ".$patient_info['gender'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Session started';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['date_started']." at ".$patcon_info['time_started'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Session ended';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['date_ended']." at ".$patcon_info['time_ended'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Consultant';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['signed_name'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'External Reference';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['external_ref'];
	echo '</td>';
echo '</tr>';

echo '</table>';
echo "\n</p>";


echo "\n\n<div id='prescriptions' class='episodeblock'>";
    echo "<div class='block_title'>PRESCRIPTIONS</div>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th>No.</th>";
        echo "\n<th width='400'>Generic Name";
        echo "\n(Trade Name)</th>";
        echo "\n<th width='60'>Dose</th>";
        echo "\n<th></th>";
        echo "\n<th>Frequency</th>";
        echo "\n<th>Indication</th>";
    echo "</tr>";
    $rownum = 1;
    foreach ($prescribe_list as $prescribe_item){
        echo "<tr>";
        echo "<td valign='top'>".$rownum."</td>";
        echo "<td valign='top'><strong>".$prescribe_item['generic_name']."</strong>";
        echo "<br />";
        if(!empty($prescribe_item['trade_name'])){
            echo "(".$prescribe_item['trade_name'].")";
        }
        echo "</td>";
        //echo "<td>".anchor('ehr_patient/edit_prescription/edit_prescribe/'.$patient_id.'/'.$summary_id.'/'.$prescribe_item['queue_id'], $prescribe_item['generic_name'])."</td>";
        echo "<td align='center' valign='top'>".$prescribe_item['dose']."</td>";
        echo "<td valign='top'>".$prescribe_item['dose_form']."</td>";
        echo "<td align='center' valign='top'>".$prescribe_item['frequency']."</td>";
        echo "<td valign='top'>".$prescribe_item['indication']."</td>";
        echo "</tr>";
        $rownum++;
    }//endforeach;
    echo "</table>";
echo "</div>"; //id='prescriptions'

echo "\n<br /><br /><br /><br />....................................<br /><br />";

echo "</div>"; //id='content'

echo "</div>"; //id=body
