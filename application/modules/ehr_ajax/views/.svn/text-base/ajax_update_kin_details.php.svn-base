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
 * Portions created by the Initial Developer are Copyright (C) 2009-2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

if($ajax_outcome == "Init"){
    $ajax_outcome   =   "";
}
echo "\n<table>";
echo "\n<tr>";
    echo "\n<td width='25%' ><span class='flashdata'>".$ajax_outcome."</span></td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td>Birth Date</td>";
    echo "\n<td>";
    echo "\n<input type='text' id='kin_birth_date' name='kin_birth_date' value='".set_value('kin_birth_date',$init_kin_birth_date)."' size='10' />";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td>NRIC No.</td>";
    echo "\n<td>";
    echo "\n<input type='text' id='kin_ic_no' name='kin_ic_no' value='".set_value('kin_ic_no',$init_kin_ic_no)."' size='14' />";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td>HP No.</td>";
    echo "\n<td>";
    echo "\n<input type='text' id='kin_tel_mobile' name='kin_tel_mobile' value='".set_value('kin_tel_mobile',$init_kin_tel_mobile)."' size='20' />";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td>Job Position</td>";
    echo "\n<td>";
    echo "\n<input type='text' id='kin_job_function' name='kin_job_function' value='".set_value('kin_job_function',$init_kin_job_function)."' size='20' />";
    echo "</td>";
echo "</tr>";
echo "\n</table>";
?>
<script type="text/javascript">

    $(function() {
        $( "#kin_birth_date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c'
        });
    });

</script>
<?php

echo "|=|";


