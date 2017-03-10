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

include_once("header_xhtml1-strict.php");
//include_once("header_xhtml1-transitional.php");

echo "\n<body>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />patient_birthstamp = " . $patient_birthstamp;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(modules_list)=<br />";
		print_r($modules_list);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_externalmod_html_title')."</h1></div>";


if(count($modules_list) > 0) {
    $one_year   =   60*60*24*365;
    echo "\n<br />Click on Module Name to open Module in new window.<br /><br />";
    echo "\n<table>";
    echo "<tr>";
        echo "<th>No.</th>";
        echo "<th width='120'>Code</th>";
        echo "<th width='300'>Module Name</th>";
        echo "<th>Description</th>";
    echo "</tr>";
    $row_num = 1;
    foreach ($modules_list as $module){
        $older_than      = 1;
        $younger_than    = 99;
        if(
           //(($patient_birthstamp) ) && // SORT OUT AGE FILTER LATER
           (("B" == $module['gem_filter_sex']) || 
            (substr($patient_info['gender'],0,1) == $module['gem_filter_sex']) )
           ){
            echo "\n<tr>";
                echo "<td>";
	            echo $row_num.".";
                echo "</td>";
                echo "<td>";
                echo $module['gem_module_code'];
                echo "</td>";
                echo "<td>";
	            echo "<a href='".$module['gem_module_ovurllink']."?patient_id=".$patient_id. "&staff_id=".$staff_id."&bookingId=&gem_module_id=".$module['gem_module_id']."&caller=Over&dbname=".$current_db."' target='_blank'><strong>".$module['gem_module_ovurltext']."</strong></a>";
                echo "</td>";
                echo "<td>";
                echo $module['gem_module_descr'];
                echo "</td>";
            echo "\n</tr>";
            $row_num++;
        }
    }
    //endforeach;
    echo "</table>"; 

} else {
    echo "\nNo patient with name starting with ".$alphabet.".";
} //endif


