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
    echo "\n<br />directory=".$directory;
    echo "\n<br />filename=".$filename;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_import_new_antenatalcheckup_html_title')."</h1></div>";


if(count($imported_before) > 0){
    echo "\n<fieldset>";
    echo "<legend>WARNING: PRIOR IMPORT ACTIVITY</legend>\n";
    echo "\n<p class='section_body'>";
        echo "\nThe log shows the following previous attempt(s). Are you sure you want to proceed to reimport?";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th>Date / Time</th>";
            echo "\n<th>Import Ref.</th>";
            echo "\n<th>Filename</th>";
            echo "\n<th>Outcome</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        foreach ($imported_before as $import_item){
            echo "<tr>";
            echo "<td>".anchor('ehr_admin/edit_staff_category/edit_category/'.$import_item['data_synch_log_id'], date("Y-m-d H:i",$import_item['import_when']))."</td>";
            echo "<td>".$import_item['import_reference']."</td>";
            echo "<td>".$import_item['data_filename']."</td>";
            echo "<td>".$import_item['import_outcome']."</td>";
            echo "<td>".$import_item['import_remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
    echo "</p>";
    echo "\n</fieldset>";
} //endif(count($imported_before) > 0)


echo "\n<fieldset>";
echo "<legend>IMPORT ANTENATAL CHECKUP</legend>";
echo "\nBased on the file named <a href='http://".$_SERVER["SERVER_ADDR"]."/".$app_folder."-uploads/imports_antenatal/".$filename."' target='_blank'>$filename</a> the following patient records are available for importing:\n";
$attributes =   array('class' => 'select_form', 'id' => 'import_form');
echo form_open('ehr_admin_edi_import/admin_import_new_antenatalcheckupdone/'.$filename, $attributes);

echo form_hidden('form_purpose', 'import_new');
echo form_hidden('now_id', $now_id);

echo "\n<br /><br />";
echo "\n<table>";
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
echo "\n<tr>";
    echo "\n<td><strong>Exporting clinic</strong></td>";
    echo "\n<td> : ".$export_clinicname."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td><strong>Clinic Reference</strong></td>";
    echo "\n<td> : ".$export_clinicref."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td><strong>Export Reference</strong></td>";
    echo "\n<td> : ".$export_reference."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td><strong>Exported by</strong></td>";
    echo "\n<td> : ".$export_username."</td>";
echo "</tr>";
echo "\n</table>";
echo "\n<br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th></th>";
    echo "\n<th>No.</th>";
    echo "\n<th width='250'>Patient Name</th>";
    echo "\n<th width='130'>Checkup date</th>";
    echo "\n<th>Date Created</th>";
echo "</tr>";
$rownum = 0;
if(isset($unsynched_list)){
    $rownum = 1;
    foreach ($unsynched_list as $unsynched_item){
        echo "\n<tr>";
        echo "\n<td><input type='checkbox' name='s$rownum' value='".$unsynched_item['antenatal_followup_id']."' checked='checked' /></td>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('ehr_admin_edi/admin_export_details_patients/'.$unsynched_item['patient_id'], "<strong>".$unsynched_item['patient_name']."</strong>, ".$unsynched_item['name_first'], 'target="_blank"')."</td>";
        //echo "\n<td><strong>".$unsynched_item['patient_name'].", ".$unsynched_item['name_first']."</strong></td>";
        echo "\n<td>".$unsynched_item['checkup_date']."</td>";
        //echo "\n<td>".$unsynched_item['synch_out']."</td>";
        echo "\n<td>".date('Y-m-d', $unsynched_item['synch_out']);
        echo "&nbsp;&nbsp;".date('H:i', $unsynched_item['synch_out'])."</td>";
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





