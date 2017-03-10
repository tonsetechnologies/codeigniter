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
    echo "\n<br />print_r(session)=<br />";
        print_r($this->session->userdata);
	echo '</pre>';
    echo "\n<br />form_purpose = ".$form_purpose;
    echo "\n<br />current_db = ".$current_db;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_import_episodes_html_title')."</h1></div>";

echo "\n<fieldset>";
echo "<legend>UNSYNCHED IMPORT FILES ON SERVER</legend>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='400'>Filename</th>";
    echo "\n<th width='80'>File size</th>";
    echo "\n<th> &nbsp; Import</th>";
echo "</tr>";
if(isset($fileList)){
    $rownum = 1;
    foreach ($fileList as $unsynched_item){
	    if (is_file("$directory/$unsynched_item") && $unsynched_item != '.' && $unsynched_item != '..' && (substr($unsynched_item,0,15)=="patient_episode")) {
		    echo "\n<tr>";
            echo "\n<td>".$rownum.".</td>";
            //echo "\n<td><a href='/thirra-uploads/imports_consult/".$unsynched_item."' target='_blank'>".$unsynched_item."</td>";
            echo "\n<td><a href='http://".$_SERVER["SERVER_ADDR"]."/".$app_folder."-uploads/imports_consult/".$unsynched_item."' target='_blank'>$unsynched_item</a></td>";
            echo "\n<td align='right'>".filesize("$directory/$unsynched_item")."</td>";
            echo "\n<td> &nbsp; ".anchor('ehr_admin_edi_import/admin_import_new_episodes/'.$unsynched_item, 'Import')."</td>";
            echo "\n</tr>";
            $rownum++;
	    }
    }//endforeach;
}
echo "</table>";

echo "\n<br /><br />File not on server:";
$attributes =   array('class' => 'select_form', 'id' => 'upload_form');
echo form_open('ehr_admin_edi/admin_upload_new_episode', $attributes);

echo form_hidden('form_purpose', 'export_new');
echo form_hidden('now_id', $now_id);

echo "\n<input type='file' name='userfile' size='40' />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Upload XML file' />";
echo "\n</center>";
echo "\n</form>";
echo "\n<br />";
echo "\n</fieldset>";


echo "\n<fieldset>";
echo "<legend>EPISODES IMPORTED PREVIOUSLY</legend>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='200'>Patient Name</th>";
    echo "\n<th width='110'>Birth Date</th>";
    echo "\n<th width='50'>Sex</th>";
    echo "\n<th width='200'>patient_id</th>";
    echo "\n<th>Date Created</th>";
    echo "\n<th>Date Imported</th>";
echo "</tr>";
if(isset($synched_list)){
    $rownum = 1;
    foreach ($synched_list as $synched_item){
        echo "\n<tr>";
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
echo "\n</fieldset>";


