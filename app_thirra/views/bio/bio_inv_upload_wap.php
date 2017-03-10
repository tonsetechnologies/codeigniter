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

echo "\n<div align='center'><h1>THIRRA - Upload Investigation Pictures</h1></div>";

echo anchor('bio_phi/edit_inv/edit_inv/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id.'/'.$bio_inv_id, 'Return to Investigation Form');

echo "<p></p>";

echo form_open_multipart('bio_phi/upload_pics_inv/'.$patient_id.'/'.$notification_id.'/'.$bio_case_id.'/'.$bio_inv_id);
echo form_hidden('bio_inv_id', $bio_inv_id);
echo form_hidden('bio_case_id', $bio_case_id);
echo form_hidden('notification_id', $notification_id);
echo form_hidden('patient_id', $patient_id);

echo "PICTURE INFORMATION";

echo "\n<br />Reference<br />";
echo "<input type='text' name='bio_pic_ref' size='30' />";

echo "\n<br />Sort order<br />";
echo "<input type='text' name='bio_pic_sort' size='4' />";

echo "\n<br>Title<br />";
echo "<input type='text' name='bio_pic_title' size='30' />";

echo "\n<br />Description<br />";
echo "<input type='text' name='bio_pic_descr' size='80' />";

echo "\n<br />Remarks<br />";
echo "<input type='text' name='pics_remarks' size='80' />";

echo "\n<br />Locate file<br />";
echo "<input type='file' name='userfile' size='40' />";

echo "<br /><br />";

echo "<div align='center'><input type='submit' value='Upload' /></div>";

echo "</form>";
if($bio_inv_id == "new_inv"){
    
} else {
    echo "<table>";
    foreach ($bio_pics_list as $pic) {
        echo "\n<tr><td>&nbsp;</td><td>";
        echo "<a href='".$pics_url."/INV".$pic['bio_pics_id'].".jpg' target='_blank'>View ";
        echo "<img src='".$pics_url."/INV".$pic['bio_pics_id']."_thumb.jpg' alt='image'></a> ";
        echo "\n </td><td> ".$pic['bio_pic_ref'];
        echo " </td><td> <strong>".$pic['bio_pic_title']."</strong></td></tr>";
    }
    echo "</table>";
}


