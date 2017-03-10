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
 * Portions created by the Initial Developer are Copyright (C) 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

if($ajax_outcome == "Init"){
    $ajax_outcome   =   "";
}

echo "AJAX";

// Section to choose which is Home Clinic
echo "\n<table>";
$row_num =   1;
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th>Home</th>";
    echo "\n<th>Code</th>";
    echo "\n<th>Clinic Name</th>";
    echo "\n<th>Town</th>";
    echo "\n<th>State</th>";
echo "\n<tr>";
foreach($user_clinics as $clinic_item){
    echo "\n<tr>";
    echo "<td>".$row_num.". </td>";
    echo "\n<td>";
    echo "<input type='radio' name='home_clinic' value='".$clinic_item['clinic_info_id']."' ".($ajax_home_clinic==$clinic_item['clinic_info_id']?"checked='checked'":"")." >&nbsp;</input>";
    echo "</td>";
    echo "<td>".$clinic_item['clinic_ref_no']."</td>";
    echo "<td><strong>".$clinic_item['clinic_name']."</strong></td>";
    echo "<td>".$clinic_item['town']."</td>";
    echo "<td>".$clinic_item['state']."</td>";
    echo "</tr>";
    $row_num++;
}
echo "</table>";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<td width='25%' ><span class='flashdata'>".$ajax_outcome."</span></td>";
echo "</tr>";
/*
echo "\n<tr>";
    echo "\n<td>NRIC No.</td>";
    echo "\n<td>";
    //echo "\n<input type='text' id='kin_ic_no' name='kin_ic_no' value='".set_value('kin_ic_no',$init_kin_ic_no)."' size='14' />";
    echo "</td>";
echo "</tr>";
*/
echo "\n</table>";

echo "|=|";

// Section to add new clinics to user
echo "\n<br />";
echo "\n<select name='add_clinic'>";
echo "\n<option value=''>Please select one</option>";

foreach($clinics_list as $new_clinic){
    $donot_show =   FALSE;
    foreach($user_clinics as $reg_clinic){        
        if($new_clinic['clinic_info_id'] == $reg_clinic['clinic_info_id']){
            $donot_show =   TRUE;
        }
    }
    if($donot_show === FALSE){
        echo "\n<option value='".$new_clinic['clinic_info_id']."' >".$new_clinic['clinic_name']." (".$new_clinic['town'].")</option>";
    }
}
echo "\n</select>";

