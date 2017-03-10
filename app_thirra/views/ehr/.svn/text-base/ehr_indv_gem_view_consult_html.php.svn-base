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
 * Portions created by the Initial Developer are Copyright (C) 2010 - 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    //print "form_purpose = " . $form_purpose;
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(agegroup_info)=<br />";
		print_r($agegroup_info);
    echo "\n<br />print_r(submodule_info)=<br />";
		print_r($submodule_info);
    echo "\n<br />print_r(form_content)=<br />";
		print_r($form_content);
	echo '</pre>';
    echo "\n<br />gem_submod_id=".$gem_submod_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_gem_consult_html_title')."</h1></div>";
echo "\n\n<div id='page_title' align='center'><h1>".$submodule_info[0]['gem_submod_name']."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<table class='frame' width='100%' align='center'>";
echo "\n<tr>";
    echo "<td>Submodule Code</td>";
    echo "<td>:</td>";
    echo "<td>".$submodule_info[0]['gem_submod_code']."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Module Name</td>";
    echo "<td>:</td>";
    echo "<td><strong>";
    //echo $module_info[0]['gem_module_name'];
    echo anchor('ehr_individual_gem/list_gem_submodules/'.$submodule_info[0]['gem_module_id'].'/'.$patient_id, $submodule_info[0]['gem_module_name']);
    echo "</strong></td>";
    //echo "<td><strong>".$submodule_info[0]['gem_module_name']."<strong></td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Module Code</td>";
    echo "<td>:</td>";
    echo "<td>".$submodule_info[0]['gem_module_code']."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Description</td>";
    echo "<td>:</td>";
    echo "<td>".$submodule_info[0]['gem_module_descr']."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Age Band</td>";
    echo "<td>:</td>";
    echo "<td>".$form_content[0]['gem_agename']."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Consultation Date</td>";
    echo "<td>:</td>";
    echo "<td><strong>".$patcon_info['date_ended']."</strong> &nbsp;&nbsp;".$patcon_info['time_ended']."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Consultant</td>";
    echo "<td>:</td>";
    echo "<td>".$patcon_info['signed_name']."</td>";
echo "</tr>";

echo "\n</table>";


/*
echo "\n<table class='header' width='100%' align='center'>";
echo "<tr><td><b>Form</b></td></tr>";
echo "</table>";
*/
echo "\n<fieldset>";
echo "<legend>FORM</legend>";
echo "\n<table class='frame' width='100%' align='center'>";

$question_num   =   0;
$row_num        =   0;
foreach($form_content as $form_item){
    $question_num++;
    $row_num++; // Will be displayed inside form
    echo "\n<input type='hidden' name='a".$question_num."modqid' value='".$form_item['gem_modque']."' />";
    echo "\n<input type='hidden' name='a".$question_num."cast' value='".$form_item['gem_quest_cast']."' />";
    echo "\n<tr>";
        if($form_item['gem_quest_cast']=="H" || $form_item['gem_quest_cast']=="T"){
            $row_num--;
            echo "<td>&nbsp;</td><td>&nbsp;</td></tr><tr>";
            if($form_item['gem_quest_cast']=="H"){
                echo "<td>&nbsp;</td><td valign='top'><u>".$form_item['gem_quest_text']."</u>";
            } else {
                echo "<td>&nbsp;</td><td valign='top'>".$form_item['gem_quest_text'];
            }
        } else {
            echo "<td valign='top'>";
            echo $row_num;
            echo ".</td>";
            echo "<td valign='top'>".$form_item['gem_quest_text'];
        }
        echo "</td>";
        echo "\n<td>";
        if($form_item['gem_quest_cast']=="H" || $form_item['gem_quest_cast']=="T"){
            // No input required
            echo "&nbsp;";
        } else {
            // Other data types
            switch($form_item['gem_quest_cast']){
            case "B":
                echo "\n<select name='a".$question_num."answer'>";
                    if($form_item['gem_conanswer'] == NULL){echo "\n<option value=''>Choose</option>";}
                    echo "\n<option value='1' ".($form_item['gem_conanswer']==='1'?' selected=\'selected\'':'').">Yes</option>";
                    echo "\n<option value='0' ".($form_item['gem_conanswer']==='0'?' selected=\'selected\'':'').">No</option>";
                echo "\n</select>";
                break;
            case "C":
                $gem_conanswer =   htmlspecialchars($form_item['gem_conanswer'], ENT_QUOTES);
                if($form_item['gem_quest_length'] >= 50){
                    echo "\n<textarea class='normal' name='a".$question_num."answer' id='diagnosis2' cols='40' rows='4'>".$gem_conanswer."</textarea>";
                } else {
                    echo "<input type='text' class='normal' name='a".$question_num."answer' value='".$gem_conanswer."' id='duration' size='".$form_item['gem_quest_length']."'/>";          
                }
                break;
            case "D":
                echo "<input type='text' class='normal' name='a".$question_num."answer' value='".$form_item['gem_conanswer']."' id='duration' size='10'/> YYYY-MM-DD";          
                break;
            case "E":
                if(count($form_item['multiples']) > 0){
                    foreach($form_item['multiples'] as $option){
                        echo "<input type='text' class='normal' name='a".$question_num."answer' value='".$option['gem_option_text']."' id='duration' size='".$form_item['gem_quest_length']."' />";          
                    }
                } else {
                    echo "<strong>Not available. </strong>";
                }
                echo " ".$form_item['gem_quest_uom'];
                break;
            case "L":
            case "M":
                echo "\n<select name='a".$question_num."answer'>";
                    if($form_item['gem_conanswer'] == NULL){echo "\n<option value=''>Choose</option>";}
                    foreach($form_item['multiples'] as $option){
                        echo "\n<option value='".$option['gem_option_text']."' ";
                        if($form_item['gem_conanswer'] === $option['gem_option_text']){
                            echo "selected=\'selected\'";
                        }
                        echo " >".$option['gem_option_text']."</option>";
                    }
                echo "\n</select>";
                break;
            case "N":
                echo "<input type='text' class='normal' name='a".$question_num."answer' value='".$form_item['gem_conanswer']."' id='du' size='".$form_item['gem_quest_length']."'/>";        
                echo " ".$form_item['gem_quest_uom'];
                break;
            } //endswitch($form_item['gem_quest_cast'])
        } //endif($form_item['gem_quest_text']=="H" || $form_item['gem_quest_text']=="T")
        echo "</td>";
    echo "\n<tr>";

}

echo "\n</table>";

echo "\n<br />";
echo "\n</fieldset>";

echo "\n<br />";


