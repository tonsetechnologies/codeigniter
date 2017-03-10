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
include_once("header_xhtml-mobile10.php");

echo "\n<body>";

echo "<p>";
    echo $agent . " - " . $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
    if ("Unknown Platform" == $this->agent->platform()){
        echo " - Mobile Device Mode";
    } else {
        echo " - Desktop Mode";
    }
echo "</p>";

echo "\n<h1>THIRRA</h1>";
echo "\n<ol>";
foreach ($patlist as $patient){
    echo "\n<li>";
	echo anchor('thirra/individual_overview/'.$patient['patient_id'], 'View');
    echo " - " . $patient['name'];
	echo "</li>"; 
}
//endforeach;
echo "</ol>";

echo "\n<ol>";
foreach($query->result() as $row){
	echo "\n<li>"; 
	echo anchor('thirra/individual_overview/'.$row->patient_id, 'View');
	echo " - " . $row->name . " ";
	echo "</li>"; 
	
}
//endforeach;
echo "</ol>";
echo "<p>";
echo anchor('thirra/new_investigate', 'Start New Form');

echo "</p>";
?>
</body>
</html>
