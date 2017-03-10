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

echo "<p>";
    echo $device_mode;
echo "</p>";

echo "\n<div align='center'><h1>THIRRA - Admin</h1></div>";

echo "<h2>Add User</h2>";

echo "<h2>Print Reports</h2>";
echo "<h2>Print Blank Forms</h2>";
echo "<p>";
echo anchor('admin/edit_form', 'START NEW FORM');

echo "</p>";
?>
</body>
</html>
