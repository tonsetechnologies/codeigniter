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
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(unsynched_list)=<br />";
		print_r($unsynched_list);
	echo '</pre>';
    echo "\n<br />num_rows=".$num_rows;
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />import_path = ".$import_path;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_import_new_refer_html_title')."</h1></div>";


echo "\n<fieldset>";
echo "<legend>IMPORT EPISODES</legend>";
//echo "\nBased on the file named <a href='/thirra-uploads/imports_refer/".$filename."' target='_blank'><strong>".$filename."</strong></a> the following patient records are available for importing:\n";
echo "\nBased on the file named <strong><a href='http://".$_SERVER["SERVER_ADDR"]."/".$app_folder."-uploads/imports_refer/".$filename."' target='_blank'>".$filename."</strong></a> the following patient records are available for importing:\n";

$attributes =   array('class' => 'select_form', 'id' => 'import_form');
echo form_open('ehr_individual_refer/admin_import_new_refer_review/export_new/'.$filename, $attributes);

echo form_hidden('form_purpose', 'export_new');
echo form_hidden('now_id', $now_id);

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th></th>";
    echo "\n<th>No.</th>";
    echo "\n<th width='200'>Patient Name</th>";
    echo "\n<th width='110'>Birth Date</th>";
    echo "\n<th width='50'>Sex</th>";
    echo "\n<th width='200'>patient_id</th>";
    echo "\n<th>Date Created</th>";
echo "</tr>";
if(isset($unsynched_list)){
    $rownum = 1;
    foreach ($unsynched_list as $unsynched_item){
        echo "\n<tr>";
        echo "\n<td><input type='checkbox' name='s$rownum' value='".$unsynched_item['summary_id']."' checked='checked' /></td>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('ehr_admin_edi/admin_export_details_patients/'.$unsynched_item['patient_id'], "<strong>".$unsynched_item['patient_name']."</strong>, ".$unsynched_item['name_first'], 'target="_blank"')."</td>";
        //echo "\n<td><strong>".$unsynched_item['patient_name'].", ".$unsynched_item['name_first']."</strong></td>";
        echo "\n<td>".$unsynched_item['summary_id']."</td>";
        echo "\n<td>".$unsynched_item['date_started']."</td>";
        echo "\n<td>(".$unsynched_item['time_started'].")</td>";
        //echo "\n<td>".$unsynched_item['synch_out']."</td>";
        echo "\n<td>".date('Y-m-d H:i', $unsynched_item['synch_out'])."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Confirm & Import' />";
echo "\n</center>";
echo form_hidden('num_rows', $rownum-1);
echo "\n</form>";
echo "\n<br />";
echo "\n</fieldset>";





