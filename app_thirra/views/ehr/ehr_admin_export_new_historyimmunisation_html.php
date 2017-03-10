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
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content_nosidebar'>";
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
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_export_new_historyimmunisation_html_title')."</h1></div>";


echo "\n<fieldset>";
echo "<legend>EXPORT IMMUNISATION HISTORIES</legend>\n";
$attributes =   array('class' => 'select_form', 'id' => 'export_form');
echo form_open('ehr_admin_edi_export/admin_export_new_historyimmunisation_done', $attributes);

echo form_hidden('form_purpose', 'export_new');
echo form_hidden('now_id', $now_id);

echo "<table>";
echo "\n<tr>";
    echo "<td>Reference</td>";
    echo "<td>";
        echo "<input type='text' class='normal' name='reference' value='' id='reference' />";          
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td valign='top'>Remarks</td>";
    echo "<td>";
    echo "\n<textarea class='normal' name='remarks' id='remarks' cols='60' rows='4'></textarea>";
    echo "\n</td>";
echo "\n</tr>";
echo "</table>";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th></th>";
    echo "\n<th>No.</th>";
    echo "\n<th width='250'>Patient Name</th>";
    echo "\n<th width='110'>Birth Date</th>";
    echo "\n<th width='150'>Vaccine</th>";
    echo "\n<th width='250'>Date Recorded</th>";
    echo "\n<th>Date Created</th>";
echo "</tr>";
if(isset($unsynched_list)){
    $rownum = 1;
    foreach ($unsynched_list as $unsynched_item){
        echo "\n<tr>";
        echo "\n<td><input type='checkbox' name='s$rownum' value='".$unsynched_item['patient_immunisation_id']."-.-".$unsynched_item['immunisation_id']."-.-".$unsynched_item['patient_id']."' checked='checked' /></td>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('ehr_individual/individual_overview/'.$unsynched_item['patient_id'], "<strong>".$unsynched_item['name']."</strong>, ".$unsynched_item['name_first'], 'target="_blank"')."</td>";
        echo "\n<td>".$unsynched_item['birth_date']."</td>";
        echo "\n<td><strong>".$unsynched_item['vaccine_short']."</strong></td>";
        echo "\n<td>";
     	echo anchor('ehr_individual/past_con_details/'.$unsynched_item['patient_id'].'/'.$unsynched_item['patient_immunisation_id'], $unsynched_item['immunisation_id'], 'target="_blank"');
        echo "\n</td>";
        echo "\n<td>".date("Y-m-d",(int)$unsynched_item['synch_out']);
        echo "&nbsp;&nbsp;".date("H:i",(int)$unsynched_item['synch_out'])."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Confirm Export' />";
echo "\n</center>";
echo form_hidden('num_rows', $rownum-1);
echo "\n</form>";
echo "\n<br />";
echo "\n</fieldset>";





