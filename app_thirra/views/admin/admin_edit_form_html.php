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

//include_once("header_xhtml1-strict.php");
include_once("header_xhtml1-transitional.php");

echo "\n<body>";
print "Session info = " . $_SESSION['thirra_mode'];
print "<br />User = " . $_SESSION['username'];
echo "<p>";
    echo $agent . " - " . $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
    if ("Unknown Platform" == $this->agent->platform()){
        echo " - Mobile Device Mode";
    } else {
        echo " - Desktop Mode";
    }
echo "</p>";

//echo validation_errors(); Displays ALL error in one place.
echo $save_attempt;
echo form_open('admin/edit_form/'.$patient_id);

echo "<h5>Test Char</h5>";
echo form_error('username');
echo "<input type='text' name='username' value='".set_value('username')."' size='50' />";

echo "<h5>Test Num</h5>";
echo form_error('password');
echo "<input type='text' name='password' value='".set_value('password')."' size='50' />";

echo "<h5>Test Boolean</h5>";
echo form_error('passconf');
echo "<input type='text' name='passconf' value='".set_value('passconf')."' size='50' />";

echo "<h5>Test Date</h5>";
echo form_error('email');
echo "<input type='text' name='email' value='".set_value('email')."' size='50' />";
?>
<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>
