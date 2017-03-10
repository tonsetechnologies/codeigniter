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

echo "\n\n<div id='content'>";
if($debug_mode) {
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(prescribe_list)=<br />";
		print_r($prescribe_list);
    echo "\n<br />print_r(batch_list)=<br />";
		print_r($batch_list);
    echo "\n<br />print_r(formulary_filter)=<br />";
		print_r($formulary_filter);
    if(isset($diagnosis_chosen)){
        echo "\n<br />print_r(diagnosis_chosen)=<br />";
		    print_r($diagnosis_chosen);
    }
	echo '</pre>';
    echo "\n<br />form_id=".$form_id;
    echo "\n<br />button=".$button;
    echo "\n<br />prescribe_id=".$prescribe_id;
    echo "\n<br />drug_formulary_id=".$drug_formulary_id;
    echo "\n<br />drug_code_id=".$drug_code_id;
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_prescribe_html_title')."</h1></div>";

echo "\n\n<div id='current_prescriptions' class='episodeblock'>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>Generic Name</th>";
    echo "\n<th>Dose</th>";
    echo "\n<th></th>";
    echo "\n<th>Frequency</th>";
    echo "\n<th>Indication</th>";
echo "</tr>";
foreach ($prescribe_list as $prescribe_item){
    echo "\n<tr>";
    echo "<td>".anchor('ehr_consult/edit_prescription/edit_prescribe/'.$patient_id.'/'.$summary_id.'/'.$prescribe_item['queue_id'], $prescribe_item['generic_name'])."</td>";
    echo "<td>".$prescribe_item['dose']."</td>";
    echo "<td>".$prescribe_item['dose_form']."</td>";
    echo "<td>".$prescribe_item['frequency']."</td>";
    echo "<td>".$prescribe_item['indication']."</td>";
    echo "</tr>";
}//endforeach;
echo "</table>";
echo "</div>"; //id='current_prescriptions'


echo "\n\n<div id='patients_new_prescribe' class='section'>\n";
    $attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
    echo form_open('ehr_consult/edit_prescribe/'.$patient_id, $attributes);
    echo form_hidden('form_purpose', $form_purpose);
    echo form_hidden('form_id', "search");
    echo form_hidden('now_id', $now_id);
    echo form_hidden('patient_id', $patient_id);
    echo form_hidden('summary_id', $summary_id);
    echo form_hidden('prescribe_id', $prescribe_id);

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
    echo "<td>Batch</td>";
    echo "\n<td colspan='2'>";
        echo "<select name='drug_batch' class='normal' id='level_three'>";
        if(count($batch_list) > 0) {
            foreach($batch_list as $batch_item) 
            {
	            echo "\n<option value='".$batch_item['dcode2ext_code']."'>[".$batch_item['dcode2ext_code']."] &nbsp;&nbsp;&nbsp;".$batch_item['full_title']."</option>";
            }
        } else {
            echo "\n<option value='' selected='selected'>Not applicable</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Indication</td>";
    echo "\n<td>";
    echo "\n<input type='text' name='indication' value='".set_value('indication',$indication)."' size='70'  id='level_four'/>";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Dose<font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('dose');
    echo "\n<input type='text' name='dose' value='".set_value('dose',$dose)."' size='3' />";
    echo "\n<select class='normal' name='dose_form'>";          
        echo "\n<option value='tablet(s)' ".set_select('dose_form','tablet(s)').">tablet(s)</option>";
        echo "\n<option value='capsule(s)' ".set_select('dose_form','capsule(s)').">capsule(s)</option>";
        echo "\n<option value='ml' ".set_select('dose_form','ml').">ml</option>";
        echo "\n<option value='g' ".set_select('dose_form','g').">g</option>";
        echo "\n<option value='amps' ".set_select('dose_form','amps').">amps</option>";
        echo "\n<option value='vial(s)' ".set_select('dose_form','vial(s)').">vial(s)</option>";
        echo "\n<option value='suppository' ".set_select('dose_form','suppository').">suppository</option>";
        echo "\n<option value='pessary' ".set_select('dose_form','pessary').">pessary</option>";
        echo "\n<option value='caplet(s)' ".set_select('dose_form','caplet(s)').">caplet(s)</option>";
    echo "\n</select>";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td width='25%'>Frequency<font color='red'>*</font></td>";
    echo "\n<td>";
        echo "<select class='normal' name='frequency'>";          
            echo "\n<option value='bid' ".set_select('frequency','bid').">bid</option>";
            echo "\n<option value='od' ".set_select('frequency','od').">od</option>";
            echo "\n<option value='om' ".set_select('frequency','om').">om</option>";
            echo "\n<option value='on' ".set_select('frequency','on').">on</option>";
            echo "\n<option value='prn' ".set_select('frequency','prn').">prn</option>";
            echo "\n<option value='tds' ".set_select('frequency','tds').">tds</option>";
            echo "\n<option value='qid' ".set_select('frequency','qid').">qid</option>";
            echo "\n<option value='5 times a day' ".set_select('frequency','5 times a day').">5 times a day</option>";
            echo "\n<option value='6 times a day' ".set_select('frequency','6 times a day').">6 times a day</option>";
            echo "\n<option value='stat' ".set_select('frequency','stat').">stat</option>";
            echo "\n<option value='Q4H' ".set_select('frequency','Q4H').">Q4H</option>";
            echo "\n<option value='Q5H' ".set_select('frequency','Q5H').">Q5H</option>";
            echo "\n<option value='Q6H' ".set_select('frequency','Q6H').">Q6H</option>";
            echo "\n<option value='Q8H' ".set_select('frequency','Q8H').">Q8H</option>";
            echo "\n<option value='Q12H' ".set_select('frequency','Q12H').">Q12H</option>";
        echo "\n</select>";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td width='25%'>Instructions<font color='red'>*</font></td>";
    echo "\n<td>";
        echo "<select class='normal' name='instruction'>";          
            echo "\n<option value='before food' ".set_select('instruction','before food').">before food</option>";
            echo "\n<option value='after food' ".set_select('instruction','after food').">after food</option>";
            echo "\n<option value='as directed' ".set_select('instruction','as directed').">as directed</option>";
            echo "\n<option value='as needed' ".set_select('instruction','as needed').">as needed</option>";
            echo "\n<option value='apply locally' ".set_select('instruction','apply locally').">apply locally</option>";
            echo "\n<option value='intra-vaginal' ".set_select('instruction','intra-vaginal').">intra-vaginal</option>";
            echo "\n<option value='sub-lingual' ".set_select('instruction','sub-lingual').">sub-lingual</option>";
        echo "\n</select>";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Quantity</td>";
    echo "\n<td>";
    echo form_error('quantity');
    echo "\n<input type='text' name='quantity' value='".set_value('quantity',$quantity)."' size='3' />";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Caution</td>";
    echo "\n<td>";
    echo "\n<input type='text' name='caution' value='".set_value('caution',$caution)."' size='70'/>";
    echo "\n</td>";
echo "\n</tr>";

echo "</table>";

echo "<br />";
echo "<center>";
    echo "\n<input type='submit' name='submit' value='Prescribe' />";
    //echo "<input class='button' type='submit' name='submit' value='Prescribe' />";
echo "</center>";
echo "<input type='hidden' name='status' value='Finished' />";
echo "<input type='hidden' name='bookingId' value='1196092858' />";

echo "</form>";


echo "\n\n<div id='knowledgebase_drug' class='episodeblock'>";
echo "\n<table>";
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


