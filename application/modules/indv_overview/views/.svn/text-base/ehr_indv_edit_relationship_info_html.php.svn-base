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
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";

echo "\n<body>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />relationship_id = " . $relationship_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />patient_id = " . $patient_id;
	echo '<pre>';
    echo "\n<br />print_r(relationship_info)=<br />";
		print_r($relationship_info);
    echo "\n<br />print_r(heads_list)=<br />";
		print_r($heads_list);
    echo "\n<br />print_r(independents_list)=<br />";
		print_r($independents_list);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

if($form_purpose == 'edit_history'){
    $editable = " disabled='disabled' ";
    // Still need to pass data to server
    echo form_hidden('record_date', $init_record_date);
} else {
    $editable = " ";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_relationship_info_html_title')."</h1></div>";


//echo validation_errors(); Displays ALL errors in one place.
echo form_open('indv/indv/index/indv_overview/ehr_individual/edit_relationship_info/'.$form_purpose.'/'.$patient_id.'/'.$relationship_id);

echo "<fieldset>";
echo "<legend>Family Relationship Info</legend>";
echo "\n<table>";

/*
echo "\n<tr><td>Head of Family</td><td>";
echo form_error('safety_belt_use');
if(isset($independents_list) && (count($independents_list) > 1)) {
    echo "\n<select name='patient_id' class='normal' id='patient_id'>";
        echo "\n<option value='' >Please select one</option>";
        foreach($independents_list as $independents)
        {
            echo "\n<option value='".$independents['patient_id']."' ";
            if(isset($heads_id)) {
                echo ($patient_id==$patient['patient_id'] ? " selected='selected'" : "");
            }
            echo ">".$independents['name'].", ".$independents['name_first']." - ".$independents['birth_date']."</option>";
        } //foreach
    echo "\n</select>";
} 
*/

echo "\n<tr><td>Head of Family <span class='mandatory_field'>*</span></td><td>";
echo form_error('head_id');
if(isset($heads_list) && (count($heads_list) > 1)) {
    echo "\n<select name='head_id' class='normal' id='head_id'>";
        echo "\n<option value='' >Please select one</option>";
        foreach($heads_list as $heads)
        {
            echo "\n<option value='".$heads['patient_id']."' ";
            if(isset($head_id)) {
                echo ($head_id==$heads['patient_id'] ? " selected='selected'" : "");
            }
            echo ">".$heads['name'].", ".$heads['name_first']." - ".$heads['birth_date']."</option>";
        } //foreach
    echo "\n</select>";
} 

echo "\n<tr><td>Family position <br />(relative to HOF) <span class='mandatory_field'>*</span></td><td valign='top'>";
echo form_error('family_position');
echo "\n<select name='family_position' class='normal' id='family_position'>";
    echo "\n<option value='' >Please select one</option>";
    if($patient_info['gender'] == 'Female'){
        echo "\n<option value='Wife' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Wife' ? " selected='selected'" : "");
            }
        echo ">Wife</option>";
        echo "\n<option value='Sister' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Sister' ? " selected='selected'" : "");
            }
        echo ">Sister</option>";
        echo "\n<option value='Cousin' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Cousin' ? " selected='selected'" : "");
            }
        echo ">Cousin</option>";
        echo "\n<option value='Daughter' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Daughter' ? " selected='selected'" : "");
            }
        echo ">Daughter</option>";
        echo "\n<option value='Niece' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Niece' ? " selected='selected'" : "");
            }
        echo ">Niece</option>";
        echo "\n<option value='Granddaughter' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Granddaughter' ? " selected='selected'" : "");
            }
        echo ">Granddaughter</option>";
        echo "\n<option value='Mother' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Mother' ? " selected='selected'" : "");
            }
        echo ">Mother</option>";
        echo "\n<option value='Aunt' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Aunt' ? " selected='selected'" : "");
            }
        echo ">Aunt</option>";
    } else {
        echo "\n<option value='Husband' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Husband' ? " selected='selected'" : "");
            }
        echo ">Husband</option>";
        echo "\n<option value='Brother' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Brother' ? " selected='selected'" : "");
            }
        echo ">Brother</option>";
        echo "\n<option value='Cousin' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Cousin' ? " selected='selected'" : "");
            }
        echo ">Cousin</option>";
        echo "\n<option value='Son' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Son' ? " selected='selected'" : "");
            }
        echo ">Son</option>";
        echo "\n<option value='Nephew' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Nephew' ? " selected='selected'" : "");
            }
        echo ">Nephew</option>";
        echo "\n<option value='Minor' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Minor' ? " selected='selected'" : "");
            }
        echo ">Minor</option>";
        echo "\n<option value='Grandson' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Grandson' ? " selected='selected'" : "");
            }
        echo ">Grandson</option>";
        echo "\n<option value='Father' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Father' ? " selected='selected'" : "");
            }
        echo ">Father</option>";
        echo "\n<option value='Uncle' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Uncle' ? " selected='selected'" : "");
            }
        echo ">Uncle</option>";
    } //endif($patient_info['gender'] == 'Male')
        echo "\n<option value='Guardian' ";
            if(isset($init_family_position)) {
                echo ($init_family_position=='Guardian' ? " selected='selected'" : "");
            }
        echo ">Guardian</option>";
    echo "\n<option value='Other' ";
        if(isset($init_family_position)) {
            echo ($init_family_position=='Other' ? " selected='selected'" : "");
        }
    echo ">Other</option>";
echo "\n</select>";
echo "\n</td></tr>";
/*
echo "\n<tr><td>generation_to_head</td><td>";
echo form_error('generation_to_head');
echo "<input type='text' name='generation_to_head' value='".set_value('generation_to_head',$init_generation_to_head)."' size='2' /></td></tr>";


echo "\n<tr><td>date_married</td><td>";
echo form_error('date_married');
echo "<input type='text' name='date_married' value='".set_value('date_married',$init_date_married)."' size='8' /></td></tr>";
*/

echo "\n<tr><td>Remarks</td><td>";
echo form_error('remarks');
echo "<input type='text' name='remarks' value='".set_value('remarks',$init_remarks)."' size='80' /></td></tr>";


echo "\n</table>";
echo "</fieldset>";


echo form_hidden('now_id', $now_id);
echo form_hidden('relationship_id', $relationship_id);
echo form_hidden('family_details_id', $family_details_id);
echo form_hidden('dbhead_id', $dbhead_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Add/Edit History' />";
echo "</div>";

echo "</form>";



