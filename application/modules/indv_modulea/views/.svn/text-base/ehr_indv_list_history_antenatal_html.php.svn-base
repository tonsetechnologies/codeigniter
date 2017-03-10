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
 * Portions created by the Initial Developer are Copyright (C) 2010 - 2012
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
    echo "\n<br />print_r(history_info)=<br />";
		print_r($history_info);
    echo "\n<br />print_r(history_list)=<br />";
		print_r($history_list);
	echo '</pre>';
    echo "\n</div>";
}

//echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_history_antenatal_html_title')."</h1></div>";
echo "\n\n<div id='page_title' align='center'><h1>MODULE A</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<fieldset>";
echo "<legend>PREGNANCIES RECORDED</legend>";

$allow_add_antenatal    =   TRUE;
if(isset($history_list)){
    foreach ($history_list as $history_item){
        if($history_item['status'] > 0){
            // May allow
        } else {
            $allow_add_antenatal    =   FALSE;
        }
    }
}

if($allow_add_antenatal){
    //echo "<strong>Add New History</strong>";
    echo anchor('indv/indv/index/indv_antenatal/ehr_individual_antenatal/edit_history_antenatal/new_antenatal/'.$patient_id.'/new_antenatal', "<strong>Add New Pregnancy</strong>");
} else {
    echo "<strong>Add New Pregnancy</strong> (Please change status to Closed before adding new antenatal)";
}
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='15'>Gravida</th>";
    echo "\n<th width='15'>Para</th>";
    echo "\n<th width='50'>LMP</th>";
    echo "\n<th width='50'>EDD</th>";
    echo "\n<th width='50'>Outcome</th>";
    echo "\n<th width='50'>Status</th>";
    echo "\n<th width='50'>Delivery Date</th>";
    echo "\n<th width='50'>Recorded Date</th>";
    echo "\n<th width='250'>Name of Child</th>";
echo "</tr>";
if(isset($history_list)){
    $rownum                 = 1;
    $previous_antenatal_id  =   NULL;
    foreach ($history_list as $history_item){
        echo "\n<tr>";
        if($previous_antenatal_id === $history_item['antenatal_id']){
            //echo "<td></td>";
            echo "<td align='center'>\"</td>";
            echo "<td align='center'>\"</td>";
            echo "\n<td align='center'>".$history_item['para']."</td>";
            echo "<td align='center'>\"</td>";
            echo "<td align='center'>\"</td>";
            echo "\n<td>".$history_item['delivery_outcome']."</td>";
            echo "<td align='center'>\"</td>";
        } else {
            echo "\n<td>".$rownum.".</td>";
            echo "\n<td><strong>".anchor('indv/indv/index/indv_antenatal/ehr_individual_antenatal/edit_history_antenatal/edit_antenatal/'.$patient_id.'/'.$history_item['antenatal_id'], $history_item['gravida']);
            echo "</strong></td>";
            echo "\n<td align='center'>".$history_item['para']."</td>";
            echo "\n<td>".$history_item['lmp']."</td>";
            echo "\n<td><strong>".$history_item['lmp_edd']."</strong></td>";
            echo "\n<td>".$history_item['delivery_outcome']."</td>";
            echo "\n<td>";
            if($history_item['status'] > 0){
                echo "Closed";
            } else {
                echo "Open";
            }
            echo "</td>";
            $rownum++;
        } //endif($previous_antenatal_id === $history_item['antenatal_id'])
        echo "\n<td><strong>".$history_item['date_delivery']."</strong></td>";
        echo "\n<td align='center'>".$history_item['date']."</td>";
        echo "\n<td>";
        echo anchor('ehr_individual/individual_overview/'.$history_item['child_id'], "<strong>".$history_item['name_first']." ".$history_item['name']."</strong>", 'target="_blank"');
        echo "\n<td>";
        echo "\n</tr>";
        $previous_antenatal_id  =   $history_item['antenatal_id'];
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";







