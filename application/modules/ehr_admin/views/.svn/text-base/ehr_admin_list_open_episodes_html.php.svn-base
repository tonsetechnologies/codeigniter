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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(unsynched_list)=<br />";
		print_r($unsynched_list);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_list_open_episodes_html_title')."</h1></div>";


echo "\n<fieldset>";
echo "<legend>OPEN EPISODES</legend>";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='200'>Patient Name</th>";
    echo "\n<th width='110'>Birth Date</th>";
    echo "\n<th width='50'>Sex</th>";
    echo "\n<th width='250'>Consult Date</th>";
    echo "\n<th>Date Created</th>";
echo "</tr>";
if(isset($unsynched_list)){
    $rownum = 1;
    foreach ($unsynched_list as $unsynched_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('indv/indv/index/indv_overview/ehr_individual/individual_overview/overview/'.$unsynched_item['patient_id'], "<strong>".$unsynched_item['name']."</strong>, ".$unsynched_item['name_first'], 'target="_blank"')."</td>";
        echo "\n<td>".$unsynched_item['birth_date']."</td>";
        echo "\n<td>".$unsynched_item['gender']."</td>";
        echo "\n<td>";
     	//echo anchor('ehr_individual/past_con_details/'.$unsynched_item['patient_id'].'/'.$unsynched_item['summary_id'], $unsynched_item['date_started']." ".$unsynched_item['time_started'], 'target="_blank"');
        echo anchor('cons/cons/index/cons_progress/ehr_consult/consult_episode/edit_episode/'.$unsynched_item['patient_id'].'/'.$unsynched_item['summary_id'], $unsynched_item['date_started']." ".$unsynched_item['time_started'], 'target="_blank"');
        echo "\n</td>";
        echo "\n<td>".date("Y-m-d H:i",$unsynched_item['synch_out'])."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";

echo "\n<br />";
echo "\n</fieldset>";






