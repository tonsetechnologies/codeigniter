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
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_export_antenatalinfo_html_title')."</h1></div>";


echo "\n<fieldset>";
echo "<legend>UNSYNCHED ANTENATAL EVENTS</legend>";
$attributes =   array('class' => 'select_form', 'id' => 'export_form');
echo form_open('ehr_admin_edi_export/admin_export_new_antenatalinfo', $attributes);

echo form_hidden('form_purpose', 'export_new');
echo form_hidden('now_id', $now_id);

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th></th>";
    echo "\n<th>No.</th>";
    echo "\n<th width='250'>Patient Name</th>";
    echo "\n<th width='110'>Birth Date</th>";
    echo "\n<th width='80'>Sex</th>";
    echo "\n<th width='130'>Recorded Date</th>";
    echo "\n<th>Date Created</th>";
echo "</tr>";
if(isset($unsynched_list)){
    $rownum = 1;
    foreach ($unsynched_list as $unsynched_item){
        echo "\n<tr>";
        echo "\n<td><input type='checkbox' name='s$rownum' value='".$unsynched_item['antenatal_id']."-.-".$unsynched_item['patient_id']."-.-".$unsynched_item['name']."-.-".$unsynched_item['name_first']."-.-".$unsynched_item['birth_date']."-.-".$unsynched_item['gender']."-.-".$unsynched_item['date']."-.-".$unsynched_item['synch_out']."' checked='checked' /></td>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('ehr_individual/individual_overview/'.$unsynched_item['patient_id'], "<strong>".$unsynched_item['name']."</strong>, ".$unsynched_item['name_first'], 'target="_blank"')."</td>";
        echo "\n<td>".$unsynched_item['birth_date']."</td>";
        echo "\n<td>".$unsynched_item['gender']."</td>";
        echo "\n<td>";
     	echo anchor('ehr_individual/past_con_details/'.$unsynched_item['patient_id'].'/'.$unsynched_item['antenatal_id'], $unsynched_item['date'], 'target="_blank"');
        echo "\n</td>";
        echo "\n<td>".date("Y-m-d H:i",$unsynched_item['synch_out'])."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Export' />";
echo "\n</center>";
echo form_hidden('num_rows', $rownum-1);
echo "\n</form>";
echo "\n<br />";
echo "\n</fieldset>";


echo "\n<fieldset>";
echo "<legend>EXPORTED EPISODES</legend>";
$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('ehr_admin_edi/admin_export_new_patients', $attributes);

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
    echo "\n<th>Date Exported</th>";
echo "</tr>";
if(isset($synched_list)){
    $rownum = 1;
    foreach ($synched_list as $synched_item){
        echo "\n<tr>";
        echo "\n<td><input type='checkbox' name='".$synched_item['patient_id']."' /></td>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('ehr_admin/individual_overview/'.$synched_item['patient_id'], "<strong>".$synched_item['name']."</strong>, ".$synched_item['name_first'], 'target="_blank"')."</td>";
        echo "\n<td>".$synched_item['birth_date']."</td>";
        echo "\n<td>".$synched_item['gender']."</td>";
        echo "\n<td>(".$synched_item['patient_id'].")</td>";
        echo "\n<td>".date("Y-m-d",$synched_item['synch_out'])."</td>";
        echo "\n<td>".date("Y-m-d",$synched_item['synch_remarks'])."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Export Again' />";
echo "\n</center>";
echo "\n</form>";
echo "\n<br />";
echo "\n</fieldset>";





