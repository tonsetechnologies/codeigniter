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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

//include_once("header_xhtml1-strict.php");
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
    //echo "\n<br />Click on Module Name to open Module in new window.<br /><br />";
    echo "\n<br />";
    echo "\n<table class='valigntop'>";
    echo "<tr>";
        echo "<th>No.</th>";
        echo "<th width='120'>Code</th>";
        echo "<th width='320'>Module Name</th>";
        echo "<th>GEM</th>";
        echo "<th>Description</th>";
    echo "</tr>";
    $row_num = 1;
    foreach ($modules_list as $module){
        $older_than      = 1;
        $younger_than    = 99;
        echo "\n<tr>";
            echo "<td valign='top'>";
            echo $row_num.".";
            echo "</td>";
            echo "<td valign='top'>";
            echo $module['gem_module_code'];
            echo "</td>";
            echo "<td valign='top'>";
            if(
                (("B" == $module['gem_filter_sex']) || 
                 (substr($patient_info['gender'],0,1) == $module['gem_filter_sex']) )
                &&
                ($patient_info['age_today'] >= $module['gem_filter_olderthan'])
                &&
                ($patient_info['age_today'] <= $module['gem_filter_youngerthan'])
                ){
                echo anchor('indv/indv/index/indv_gem/ehr_individual_gem/list_gem_submodules/list_submodules/'.$patient_id.'/'.$module['gem_module_id'], '<strong>'.$module['gem_module_ovurltext'].'</strong>');
                echo "</td><td valign='top'>";
	            echo "<a href='".$module['gem_module_ovurllink']."?patient_id=".$patient_id. "&staff_id=".$staff_id."&bookingId=&gem_module_id=".$module['gem_module_id']."&caller=Over&dbname=".$current_db."' target='_blank'>GEM</a>";
                //echo "<a href='".$module['gem_module_pcurllink']."?patient_id=".$patient_id. "&staff_id=".$staff_id."&bookingId=&gem_module_id=".$module['gem_module_id']."&caller=PatCon&summary_id=".$summary_id."&dbname=".$current_db."' target='_blank'><strong>".$module['gem_module_pcurltext']."</strong></a>";
            } else {
                echo "<strong>".$module['gem_module_pcurltext']."</strong>";
                echo "</td><td valign='top'>";
            }
            echo "</td>";
            echo "<td valign='top'>";
            echo $module['gem_module_descr'];
            echo "</td>";
        echo "\n</tr>";
            $row_num++;
        }
    //endforeach;
    echo "</table>"; 

}


