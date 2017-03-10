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

echo "\n<h1>THIRRA - Health Supplies</h1>";
echo "<p>";
echo anchor('thirra/supplies_balance', 'Supplies On Hand');
echo "<br />";
echo anchor('thirra/supplies_distribute', 'Distribute Supplies');
echo "</p>";


echo "<p>";
echo anchor('thirra/new_investigate', 'Start New Form');

echo "</p>";
?>
</body>
</html>
