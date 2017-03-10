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
 * Portions created by the Initial Developer are Copyright (C) 2010
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

$ideal_field_length = 25;

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(code_info)=<br />";
		print_r($code_info);
    echo "\n<br />print_r(chemical_list)=<br />";
		print_r($chemical_list);
    echo "\n<br />print_r(same_chemical)=<br />";
		print_r($same_chemical);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_edit_drugatc_html_title')."</h1></div>";

$attributes =   array('class' => 'select_form', 'id' => 'complaint_code');
echo form_open('ehr_utilities/util_edit_drugatc/'.$form_purpose.'/'.$atc_code, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('drug_atc_id', $init_drug_atc_id);
echo form_hidden('atc_code', $init_atc_code);
echo form_hidden('ddd_qty', $init_ddd_qty);
echo form_hidden('ddd_unit', $init_ddd_unit);
echo form_hidden('admin_route', $init_admin_route);
echo form_hidden('drug_interaction', $init_drug_interaction);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>ATC Code</td><td>";
echo $init_atc_code."</td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Anatomical</td>";
    echo "\n<td><strong>".$init_atc_anatomical."</strong> ".$init_desc_anatomical;
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Therapeutic</td>";
    echo "\n<td><strong>".$init_atc_therapeutic."</strong> ".$init_desc_therapeutic;
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Pharmaco</td>";
    echo "\n<td><strong>".$init_atc_pharmaco."</strong> ".$init_desc_pharmaco;
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Chemical</td>";
    echo "\n<td><strong>".$init_atc_chemical."</strong> ".$init_desc_chemical;
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td>ATC chemical <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo form_error('atc_chemical');
    echo "\n<select name='atc_chemical' class='normal'>";
        echo "\n<option label='' value='' selected='selected'></option>";
        $previous_atc_pharmaco  =   "";
        foreach($chemical_list as $chemical_item)
        {
            if($previous_atc_pharmaco <> $chemical_item['atc_pharmaco']){
                echo "\n<optgroup label='".$chemical_item['atc_pharmaco']." ".$chemical_item['desc_pharmaco']."'>";
            }
            echo "\n<option value='".rtrim($chemical_item['atc_chemical'])."'";
            echo ($init_atc_chemical == rtrim($chemical_item['atc_chemical']) ? " selected='selected'" : "");
            echo ">".$chemical_item['atc_chemical']." - ".$chemical_item['desc_chemical']."</option>";
            $previous_atc_pharmaco = $chemical_item['atc_pharmaco'];
            if($previous_atc_pharmaco <> $chemical_item['atc_pharmaco']){
                echo "\n</optgroup>";
            }
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>ATC Code <font color='red'>*</font></td>";
    echo "\n<td>".$init_atc_chemical;
    echo "<input type='text' name='part_atc_code' value='".set_value('part_atc_code',$init_part_atc_code)."' size='2' />";
    echo form_error('part_atc_code');
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>ATC name</td><td>";
echo form_error('atc_name');
echo "<input type='text' name='atc_name' value='".set_value('atc_name',$init_atc_name)."' size='60' /></td></tr>";

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
    echo " ATC Code' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";

echo "\n</form>";
echo "\n<br />";


echo "\nDrugs with similar chemicals:";
if(isset($same_chemical)){
    echo "\n<table>";
    $rownum = 1;
    foreach($same_chemical as $similar_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".anchor('ehr_utilities/util_edit_drugatc/edit_code/'.$similar_item['atc_code'], "<strong>".$similar_item['atc_code']."</strong>")."</td>";
        echo "\n<td>".$similar_item['atc_name']."</strong></td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
    echo "\n</table>";
}



?>
    <script  type="text/javascript">

        function select_level_two(){
            document.getElementById("consultation_form").status.value="Unfinished";
            document.getElementById("level_two").selectedIndex = -1;
            document.getElementById("consultation_form").submit.click();
        }

      </script>


