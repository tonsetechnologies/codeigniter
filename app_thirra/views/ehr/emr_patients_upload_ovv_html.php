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
    print "\n<br />User = " . $_SESSION['username'];
    echo "\n<br />upload_path = ".$upload_path;
    echo "\n<br />Error = ".$error;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('12800-100_patients_upload_ovv_html_title')."</h1></div>";

echo "\n<p></p>";

echo form_open_multipart('ehr_individual/upload_pics_ovv/'.$patient_id);
echo form_hidden('patient_id', $patient_id);

echo "\n<fieldset>";
echo "<legend>PICTURE INFORMATION</legend>";
echo "\n<table>";

echo "\n<tr><td>File Type</td><td>";
    echo "\n<select name='upload_type'>";
    echo "\n<option value='portrait'>Portrait (automatically reduced to maximum ".$new_width." pixels wide)</option>";
    echo "\n<option value='photo'>Photos</option>";
    echo "\n<option value='dicom'>DICOM</option>";
    echo "\n<option value='scan'>Scans</option>";
    echo "\n<option value='others'>Others</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Rotate picture</td><td>";
    echo "\n<select name='rotate_pic'>";
    echo "\n<option value='none'>None</option>";
    echo "\n<option value='90c'>90&deg; clockwise (-&gt;)</option>";
    echo "\n<option value='90a'>90&deg; anti-clockwise (&lt;-)</option>";
    echo "\n<option value='180'>180&deg;</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Reference</td><td>";
echo "<input type='text' name='bio_file_ref' size='30' value='Portrait' /> </td></tr>";

echo "\n<tr><td>Sort order</td><td>";
echo "<input type='text' name='bio_file_sort' size='4' value='0' /> </td></tr>";

echo "\n<tr><td>Title</td><td>";
echo "<input type='text' name='bio_file_title' size='30' value='Portrait' /> </td></tr>";

echo "\n<tr><td>Description</td><td>";
echo "<input type='text' name='bio_file_descr' size='80' /> </td></tr>";

echo "\n<tr><td>Remarks</td><td>";
echo "<input type='text' name='file_remarks' size='80' /> </td></tr>";

echo "\n<tr><td>Locate file</td>";
echo "<td><input type='file' name='userfile' size='40' /></td></tr>";

echo "</table>";
echo "</fieldset>";
echo "<br /><br />";

echo "<div align='center'><input type='submit' value='Upload' /></div>";

echo "</form>";

if($patient_id == "new_patient"){
    
} else {
    echo "<table>";
    echo "<tr>";
        echo "<th>File</th>";
        echo "<th></th>";
        echo "<th>Reference</th>";
        echo "<th>Title</th>";
        echo "<th>Description</th>";
        echo "<th></th>";
    echo "</tr>";
    foreach ($files_list as $pic) {
        echo "\n<tr><td>&nbsp;</td><td>";
        echo "<a href='".$patient_pics_path."/".$pic['bio_filename'].".jpg' target='_blank'>View ";
        //echo "<a href='".$pics_url."/".$pic['bio_filename'].".jpg' target='_blank'>View ";
        echo "<img src='".$patient_pics_path."/".$pic['bio_filename']."_tnlo.jpg' alt='image'></a> ";
        //echo "<img src='".$pics_url."/".$pic['bio_filename']."_tnlo.jpg' alt='image'></a> ";
        echo "\n </td><td> ".$pic['bio_file_ref'];
        echo " </td><td> <strong>".$pic['bio_file_title'];
        echo " </strong></td><td> ".$pic['bio_file_descr'];
        echo "</td></tr>";
    }
    echo "</table>";
}

echo "</div>"; //id=content



