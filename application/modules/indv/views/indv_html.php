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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

$module_link    =   $module_name.'/'.$module_controller.'/'.$module_method;

// Experimental ACL widgets
if(isset($acl_widget)){
    foreach($acl_widget as $acl_item){
        if($acl_item['rights_single'] > 0){
            echo "\n<div class='widget_std'>";
            //echo $acl_item['syssection_link_url'];
            echo Modules::run($acl_item['syssection_link_url']);
            //echo Modules::run('ehr_modulea/ehr_modulea/index');
            echo "\n</div>";
            echo "\n<div class='widget_reset'>";
            echo "\n</div>";
        }
    }
}

echo "\n<div class='overview_body'>";
/*
echo "\n<div class='widget_std'>";
echo "\n<fieldset>";
echo "<legend>DEBUG</legend>";
echo "module_name = ".$module_name;
echo "<br />module_controller = ".$module_controller;
echo "<br />module_method = ".$module_method;
echo "<br />seg3 = ".$seg3;
echo "<br />seg4 = ".$seg4;
echo "<br />seg5 = ".$seg5;
echo "<br />module_link = ".$module_link;
echo "\n</fieldset>\n";
echo "\n</div>"; //class='widget_std'
if($seg3 == "print_hardcopy"){
    // Don't show
} else {
    echo "\n<div class='widget_std'>";
    echo Modules::run('messages/widget_messages/index');
    //echo Modules::run('ehr_dashboard/ehr_dashboard/index'); 
    echo "\n</div>";
    //echo "\n<div class='widget_reset'>";
    //echo "\n</div>";
}
*/

echo Modules::run($module_link,$seg3,$seg4,$seg5,$seg6,$seg7,$seg8); 

echo "\n</div>"; //class='overview_body'
echo "<br /><div class='rendered'>Page rendered in <strong>{elapsed_time}</strong> seconds</div>";

