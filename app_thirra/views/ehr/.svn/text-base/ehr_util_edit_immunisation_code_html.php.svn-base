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

$ideal_field_length = 25;

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(same_name)=<br />";
		print_r($same_name);
    echo "\n<br />print_r(vaccine_drugs)=<br />";
		print_r($vaccine_drugs);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />immunisation_id=".$immunisation_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_edit_immunisation_code_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

$attributes =   array('class' => 'select_form', 'id' => 'immunisation_code');
echo form_open('ehr_utilities/util_edit_immunisation_code/'.$form_purpose.'/'.$immunisation_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('immunisation_id', $immunisation_id);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Immunisation_code</td><td>";
echo form_error('immunisation_code');
echo "<input type='text' name='immunisation_code' value='".set_value('immunisation_code',$init_immunisation_code)."' size='3' /></td></tr>";

echo "\n<tr><td>Vaccine Name <font color='red'>*</font></td><td>";
echo form_error('vaccine');
echo "<input type='text' name='vaccine' value='".set_value('vaccine',$init_vaccine)."' size='60' /></td></tr>";

echo "\n<tr><td>Short name <font color='red'>*</font></td><td>";
echo form_error('vaccine_short');
echo "<input type='text' name='vaccine_short' value='".set_value('vaccine_short',$init_vaccine_short)."' size='40' /></td></tr>";

echo "\n<tr><td>Dose</td><td>";
echo form_error('dose');
echo "\n<select name='dose' class='normal' id='dose'>";
    echo "\n<option label='' value='0' >Please select one</option>";
    foreach($doses_list as $dose_item)
    {
        echo "\n<option value='".rtrim($dose_item)."'";
        echo ($init_dose == rtrim($dose_item) ? " selected='selected'" : "");
        echo ">".$dose_item."</option>";
    }
    echo "</select>";
echo "</td>";
echo "</tr>";

echo "\n<tr><td>Sort Order <font color='red'>*</font></td><td>";
echo form_error('immunisation_sort');
echo "<input type='text' name='immunisation_sort' value='".set_value('immunisation_sort',$init_immunisation_sort)."' size='5' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Description</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='description' cols='40' rows='3'>".set_value('description',$init_description)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Adverse events</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='adverse_events' cols='40' rows='3'>".set_value('adverse_events',$init_adverse_events)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Age group</td><td>";
echo form_error('age_group');
echo "<input type='text' name='age_group' value='".set_value('age_group',$init_age_group)."' size='40' /></td></tr>";

echo "\n<tr><td>Dose Frequency</td><td>";
echo form_error('dose_frequency');
echo "<input type='text' name='dose_frequency' value='".set_value('dose_frequency',$init_dose_frequency)."' size='40' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='remarks' cols='40' rows='3'>".set_value('remarks',$init_remarks)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";


echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_code"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Immunisation Code' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";

echo "\n</form>";
echo "\n<br />";

echo "\n<br /><br />";
echo "\nOther doses:";
if(!empty($same_name)){
    echo "\n<table>";
    echo "<th>Sort order</th>";
    echo "<th>Code</th>";
    echo "<th>Dose</th>";
    foreach ($same_name as $vaccine_item){
        echo "\n<tr>";
        echo "<td>".$vaccine_item['immunisation_sort']."</td>";
        echo "<td>".$vaccine_item['immunisation_code']."</td>";
        echo "<td>".$vaccine_item['dose']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "\n</table>";
}

echo "\n<br /><br />";
echo "\nDrug(s) administered for this vaccine:";
if(!empty($vaccine_drugs)){
    echo "\n<table>";
    echo "<th>Formulary_code</th>";
    echo "<th>Generic Name</th>";
    echo "<th>Dosage</th>";
    echo "<th>Remarks</th>";
    foreach ($vaccine_drugs as $drug_item){
        echo "\n<tr>";
        echo "<td valign='top'><strong>".$drug_item['formulary_code']."</strong></td>";
        echo "<td valign='top'>".$drug_item['generic_name']."</td>";
        echo "<td valign='top'><strong>".$drug_item['dosage']."</strong></td>";
        echo "<td valign='top'>".$drug_item['remarks']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "\n</table>";
}

if($form_purpose == "edit_code"){
    $attributes =   array('class' => 'select_form', 'id' => 'immunisation_drug');
    echo form_open('ehr_utilities/util_edit_immunisation_drug/'.$form_purpose.'/'.$immunisation_id, $attributes);

    echo form_hidden('form_purpose', $form_purpose);
    echo form_hidden('now_id', $now_id);
    echo form_hidden('immunisation_id', $immunisation_id);
    echo form_hidden('vaccine_short', $init_vaccine_short);
    echo "\nAdd Drug Link:";
    echo "\n<select name='drug_formulary_id' id='drug_formulary_id'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($formulary_list as $formulary_item)
            {
	            echo "\n<option value='".$formulary_item['drug_formulary_id']."' ";
                if(isset($drug_formulary_id)) {
                    echo ($drug_formulary_id==$formulary_item['drug_formulary_id'] ? " selected='selected'" : "");
                }
                echo ">".$formulary_item['generic_name']."&nbsp;[".$formulary_item['formulary_code']."]</option>";
            } //foreach
    echo "</select>";
    echo "\n<br />Remarks &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ";
    echo "<input type='text' name='remarks' value='' size='80' />";
    echo "\n<br /><br />";
    echo "\n<center>";
        echo "\n<input class='button' type='submit' name='submit' value='";
        echo "Add Drug to Vaccine' />";
    echo "\n</center>";
    echo "\n<input type='hidden' name='status' value='Finished' />";

    echo "\n</form>";
}
echo "\n<br />";



?>
    <script  type="text/javascript">

        function select_level_two(){
            document.getElementById("consultation_form").status.value="Unfinished";
            document.getElementById("level_two").selectedIndex = -1;
            document.getElementById("consultation_form").submit.click();
        }

      </script>


