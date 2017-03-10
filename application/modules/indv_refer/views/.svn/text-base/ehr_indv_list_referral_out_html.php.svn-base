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
 * Portions created by the Initial Developer are Copyright (C) 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(history_info)=<br />";
		print_r($history_info);
    echo "\n<br />print_r(referrals_list)=<br />";
		print_r($referrals_list);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_refer_out_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<fieldset>";
echo "<legend>REFERRALS MADE</legend>";
//echo "<strong>Add New History</strong>";
//echo anchor('ehr_individual_history/edit_history_social/'.$patient_id.'/new_history/new_history', "<strong>Add New History</strong>");
//echo "\n<br /><br />";

echo "\n<table class='valigntop'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>referral Date</th>";
    echo "\n<th width='250'>referral_centre</th>";
    echo "\n<th width='150'>specialty</th>";
    echo "\n<th width='150'>doctor_name</th>";
    echo "\n<th width='250'>reason</th>";
echo "</tr>";
if(isset($referrals_list)){
    $rownum = 1;
    foreach ($referrals_list as $referral_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('indv/indv/index/indv_refer/ehr_individual_refer/edit_referral_out/edit_refer/'.$patient_id.'/'.$referral_item['session_id'].'/'.$referral_item['referral_id'], "<strong>".$referral_item['referral_date']."</strong>")."</td>";
        echo "\n<td>".$referral_item['referral_centre']."</td>";
        echo "\n<td>".$referral_item['referral_specialty']."</td>";
        echo "\n<td>".$referral_item['referral_doctor_name']."</td>";
        echo "\n<td>".$referral_item['reason']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";





