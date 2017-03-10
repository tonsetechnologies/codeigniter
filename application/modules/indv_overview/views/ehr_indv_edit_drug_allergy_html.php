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
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(formulary_chosen)=<br />";
		print_r($formulary_chosen);
    echo "\n<br />print_r(batch_list)=<br />";
		print_r($batch_list);
    echo "\n<br />print_r(drugcode_info)=<br />";
		print_r($drugcode_info);
	echo '</pre>';
    echo "\n<br />form_id=".$form_id;
    echo "\n<br />button=".$button;
    echo "\n<br />patient_drug_allergy_id=".$patient_drug_allergy_id;
    echo "\n<br />drug_formulary_id=".$drug_formulary_id;
    echo "\n<br />drug_code_id=".$drug_code_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_drug_allergies_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n\n<div id='current_prescriptions' class='episodeblock'>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>Generic Name</th>";
    echo "\n<th>Reaction</th>";
    echo "\n<th>Remarks</th>";
echo "</tr>";
if(!empty($allergies_list)){
    foreach ($allergies_list as $allergies_item){
        echo "\n<tr>";
        echo "<td>".anchor('indv/indv/index/indv_overview/ehr_individual/edit_drug_allergy/edit_allergy/'.$patient_id.'/'.$allergies_item['patient_drug_allergy_id'], $allergies_item['generic_name'])."</td>";
        echo "<td>".$allergies_item['reaction']."</td>";
        echo "<td>".$allergies_item['added_remarks']."</td>";
        echo "\n<td>".anchor('ehr_consult/consult_delete_prescription/'.$patient_id.'/'.$allergies_item['patient_drug_allergy_id'], 'delete')."</td>";
        echo "</tr>";
    }//endforeach;
} else {
    echo "\n<tr><td> None recorded</td></tr>";
} //endif(isset($allergies_list))
echo "</table>";
echo "</div>"; //id='current_prescriptions'


echo "\n\n<div id='patients_new_prescribe' class='section'>\n";
    $attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
    echo form_open('indv/indv/index/indv_overview/ehr_individual/edit_drug_allergy/edit_allergy/'.$patient_id, $attributes);
    echo form_hidden('form_purpose', $form_purpose);
    echo form_hidden('form_id', "search");
    echo form_hidden('now_id', $now_id);
    echo form_hidden('patient_id', $patient_id);
    echo form_hidden('patient_drug_allergy_id', $patient_drug_allergy_id);
    if(isset($formulary_chosen)){
        if(count($formulary_chosen) > 0){
            echo form_hidden('drug_formulary', $formulary_chosen['formulary_code']);
        }
    }

    echo "\nSearch term must be at least 3 characters long.";
    echo "\n<table>";
    echo "\n<tr><td>Generic Name</td><td><input type='text' name='formulary_term1' value='' size='50' /> AND optionally</td></tr>";
    echo "\n<tr><td>Indication</td><td><input type='text' name='formulary_term2' value='' size='50' /></td></tr>";
    echo "\n</table>";
    echo "\n<div align='centre'><input type='submit' name='part_form' value='Search' /></div>";
    //echo "\n<input type='submit' value='Search' />";
    //echo "\n</form>";
    echo "\n<p>Searched generic names for <strong>".$formulary_term1."</strong> AND indications for <strong>".
        $formulary_term2."</strong>. Found ".count($formulary_filter).".</p>";
echo "</div>";

//$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
//echo form_open('ehr_consult/edit_prescribe/'.$patient_id, $attributes);

//echo form_hidden('form_purpose', $form_purpose);
//echo form_hidden('form_id', "select");

echo "\n<table class='header' width='100%' align='center'>";
echo "<tr><td><b>Prescription</b></td></tr>";
echo "</table>";
echo "\n<table class='frame' width='100%' align='center'>";
echo "\n<tr>";
    echo "<td width='25%'>Generic Name <font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='drug_formulary_id' class='normal' onchange='javascript:select_level_two()' id='level_one'>";
            if($drug_formulary_id <> "") {
            echo "\n<option value='".$formulary_chosen['drug_formulary_id']."' ";
            //if(isset($drug_formulary_id)) {
                echo "selected='selected'";
            echo ">".$formulary_chosen['generic_name']." &nbsp;&nbsp;&nbsp;[".$formulary_chosen['formulary_system']."]</option>";
            } else {
                echo "\n<option value='' >Please select one</option>";
            } //endif($drug_formulary_id <> "")
        echo "\n<optgroup label='Searched'>";
            foreach($formulary_filter as $formulary_item)
            {
	            echo "\n<option value='".$formulary_item['drug_formulary_id']."' ";
                /*
                if(isset($drug_formulary_id)) {
                    echo ($drug_formulary_id==$formulary_item['drug_formulary_id'] ? "selected='selected'" : "");
                }
                */
                echo ">".$formulary_item['generic_name']." &nbsp;&nbsp;&nbsp;[".$formulary_item['formulary_system']."]</option>";
            }
        echo "\n</optgroup>";
        echo "\n<optgroup label='Common'>";
            foreach($formulary_common as $common_item)
            {
	            echo "\n<option value='".$common_item['drug_formulary_id']."' ";
                /*
                if(isset($drug_formulary_id)) {
                    echo ($drug_formulary_id==$common_item['drug_formulary_id'] ? "selected='selected'" : "");
                }
                */
                echo ">".$common_item['generic_name']." &nbsp;&nbsp;&nbsp;[".$common_item['formulary_system']."]</option>";
            }
        echo "\n</optgroup>";
        echo "</select>";

    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "<td width='25%'>Trade Name</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='drug_code_id' class='normal' onchange='javascript:select_level_three()' id='level_two'>";
            echo "\n<option value='' >Some examples of this drug</option>";
            foreach($tradename_list as $tradename_item)
            {
	            echo "\n<option value='".$tradename_item['drug_code_id']."' ";
                if(isset($drug_code_id)) {
                    echo ($drug_code_id==$tradename_item['drug_code_id'] ? "selected='selected'" : "");
                }
                echo ">".$tradename_item['trade_name']."&nbsp;[".$tradename_item['drug_code']."]</option>";
            }
        echo "</select>";

    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "<td>Code</td>";
    echo "\n<td colspan='2'>";
        echo "<select name='drug_batch' class='normal' id='level_three'>";
        if(count($drugcode_info) > 0) {
            foreach($drugcode_info as $drugcode_item) 
            {
	            echo "\n<option value='".$drugcode_item['dcode2ext_code']."'>[".$drugcode_item['dcode2ext_code']."] &nbsp;&nbsp;&nbsp;".$drugcode_item['full_title']."</option>";
            }
        } else {
            echo "\n<option value='' selected='selected'>Not applicable</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Reaction</td>";
    echo "\n<td>";
    echo form_error('reaction');
    echo "\n<input type='text' name='reaction' value='".set_value('reaction',$reaction)."' size='70'  id='level_four'/>";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Remarks</td>";
    echo "\n<td>";
    echo form_error('added_remarks');
    echo "\n<input type='text' name='added_remarks' value='".set_value('added_remarks',$added_remarks)."' size='70'/>";
    echo "\n</td>";
echo "\n</tr>";

echo "</table>";

echo "<br />";
echo "<center>";
    echo "\n<input type='submit' name='submit' value='Add Allergy' />";
    //echo "<input class='button' type='submit' name='submit' value='Prescribe' />";
echo "</center>";
echo "<input type='hidden' name='status' value='Finished' />";

echo "</form>";


echo "\n\n<div id='knowledgebase_drug' class='episodeblock'>";
echo "\n<table>";
if(isset($drug_formulary_id)) {
    if($drug_formulary_id <> "") {
        echo "\n<tr>";
            echo "\n<td width='150'>Generic Name</td>";
            echo "\n<td>".$formulary_chosen['generic_name']."</td>";
        echo "</tr>";
        echo "\n<tr>";
            echo "\n<td valign='top'>Indication</td>";
            echo "\n<td>".$formulary_chosen['indication']."</td>";
        echo "</tr>";
        echo "\n<tr>";
            echo "\n<td valign='top'>Dosage</td>";
            echo "\n<td>".$formulary_chosen['dosage']."</td>";
        echo "</tr>";
        echo "\n<tr>";
            echo "\n<td valign='top'>Contra Indication</td>";
            echo "\n<td valign='top'>".$formulary_chosen['contra_indication']."</td>";
        echo "</tr>";
        echo "\n<tr>";
            echo "\n<td valign='top'>Precautions</td>";
            echo "\n<td>".$formulary_chosen['precautions']."</td>";
        echo "</tr>";
        echo "\n<tr>";
            echo "\n<td valign='top'>Interactions</td>";
            echo "\n<td>".$formulary_chosen['interactions']."</td>";
        echo "</tr>";
        echo "\n<tr>";
            echo "\n<td valign='top'>Adverse Reactions</td>";
            echo "\n<td valign='top'>".$formulary_chosen['adverse_reactions']."</td>";
        echo "</tr>";
    } else {
        echo "\n<tr>";
            echo "\n<td>Generic Drug Knowledgebase<br />&nbsp; </td>";
            echo "\n<td></td>";
        echo "</tr>";
    } //endif($drug_formulary_id <> "")
}
echo "</table>";
echo "</div>"; //id='knowledgebase_drug'


?>
<br />

    <script  type="text/javascript">
        var $ = function (id) {
            return document.getElementById(id);
        }

        function select_level_two(){
            $("consultation_form").status.value="Unfinished";
            $("level_two").selectedIndex = -1;
            $("level_three").selectedIndex = -1;
            $("level_four").selectedIndex = -1;
            $("consultation_form").submit.click();
        }

        function select_level_three(){
            $("consultation_form").status.value="Unfinished";
            $("level_three").selectedIndex = -1;
            $("level_four").selectedIndex = -1;
            $("consultation_form").submit.click();
        }

         function select_level_four()
         {
            $("consultation_form").status.value="Unfinished";
            $("level_four").selectedIndex = -1;
            $("consultation_form").submit.click();
         }
      </script>


