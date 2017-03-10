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
 * Portions created by the Initial Developer are Copyright (C) 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username');
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(order_info)=<br />";
		print_r($order_info);
    echo "\n<br />print_r(procedure_groups)=<br />";
		print_r($procedure_groups);
    echo "\n<br />print_r(procedure_list)=<br />";
		print_r($procedure_list);
    echo "\n<br />print_r(product_list)=<br />";
		print_r($product_list);
	echo '</pre>';
    echo "\n<br />order_id=".$order_id;
    echo "\n<br />product_id=".$product_id;
    echo "\n<br />supplier_id=".$supplier_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_history_ast_procedures_html_title')."</h1></div>";


$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('indv/indv/index/indv_history/ehr_indvhist_procedure/edit_past_procedure/'.$form_purpose.'/'.$patient_id.'/'.$past_procedure_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);

    echo "\n<strong>";
if("new_procedure" == $form_purpose){
    echo "ADDING NEW";
} else {
    echo "EDITING";
}
    echo "\n PROCEDURE</strong><br />";
//echo "\n<table class='header' width='100%' align='center'>";
//echo "<tr><td><b>IMAGING ORDER</b></td></tr>";
//echo "</table>";
echo "\n<table class='frame' width='100%' align='center'>";
echo "<tr>";
    echo "\n<td width='25%'>Procedure Category <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='pcode_category' class='normal' onchange='javascript:select_level_two()' id='level_one'>";
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:select_level_two()'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($procedure_categories as $category)
        {
            echo "\n<option label='".$category['pcode_category']."' value='".$category['pcode_category']."'";
            echo ($pcode_category == $category['pcode_category'] ? " selected='selected'" : "");
            echo ">".$category['pcode_category']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Procedure Group<font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='pcode1_id' class='normal' onchange='javascript:select_level_three()' id='level_two'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($procedure_groups as $group_item)
            {
	            echo "\n<option value='".$group_item['pcode1_id']."' ";
                if(isset($pcode1_id)) {
                    echo ($pcode1_id==$group_item['pcode1_id'] ? " selected='selected'" : "");
                }
                echo ">".$group_item['full_title']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td width='25%'>Procedure <font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo form_error('pcode1ext_id');
        echo "\n<select name='pcode1ext_id' class='normal' onchange='javascript:select_level_four()' id='level_three'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($procedure_list as $procedure)
            {
	            echo "\n<option value='".$procedure['pcode1ext_id']."' ";
                if(isset($pcode1ext_id)) {
                    echo ($pcode1ext_id==$procedure['pcode1ext_id'] ? "selected='selected'" : "");
                }
                echo ">".$procedure['pcode1ext_longname']."</option>";
            }
        echo "</select>";

    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Product Name</td>";
    echo "\n<td colspan='2'>";
        echo "<select name='product_id' class='normal' id='level_four'>";
        echo "\n<option value='' >Please select one</option>";
        if(count($product_list) > 0) {
            foreach($product_list as $product) 
            {
	            echo "\n<option value='".$product['product_id']."'";
                if(isset($product_id)) {
                    echo ($product_id==$product['product_id'] ? "selected='selected'" : "");
                }
                echo ">".$product['product_name']." &nbsp;&nbsp;[".$product['product_code']."]&nbsp;&nbsp;".$product['acc_no']."</option>";
            }
        } else {
            echo "\n<option value='' selected='selected'>None available</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Procedure Date</td><td>";
echo form_error('procedure_date');
echo "<input type='text' name='procedure_date' id='procedure_datepicker' value='".set_value('procedure_date',$procedure_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr>";
    echo "<td>Date Precision</td>";
    echo "\n<td colspan='2'>";
        echo "<select name='date_precision' class='normal' id='level_four'>";
        echo "\n<option value='F' ";
        echo ($date_precision == "F" ? "selected='selected'" : "");
        echo ">Full</option>";
        echo "\n<option value='M' ";
        echo ($date_precision == "M" ? "selected='selected'" : "");
        echo ">Month</option>";
        echo "\n<option value='Y' ";
        echo ($date_precision == "Y" ? "selected='selected'" : "");
        echo ">Year</option>";
        echo "\n<option value='D' ";
        echo ($date_precision == "D" ? "selected='selected'" : "");
        echo ">Decade</option>";
        echo "\n<option value='U' ";
        echo ($date_precision == "U" ? "selected='selected'" : "");
        echo ">Unknown</option>";
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Procedure notes</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='procedure_notes' cols='50' rows='5'>".$procedure_notes."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Procedure place</td><td>";
echo form_error('procedure_place');
echo "\n<input type='text' id='procedure_place' name='procedure_place' value='".set_value('procedure_place',$procedure_place)."' size='40' /></td></tr>";

echo "\n</table>";

echo "\n<fieldset>";
echo "<legend>PROCEDURE OUTCOME (OPTIONAL)</legend>";
echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Date Outcome Recorded</td><td>";
echo form_error('outcome_date');
echo "<input type='text' name='outcome_date' id='outcome_datepicker' value='".set_value('outcome_date',$outcome_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Outcome Reference</td><td>";
echo form_error('outcome_reference');
echo "\n<input type='text' id='outcome_reference' name='outcome_reference' value='".set_value('outcome_reference',$outcome_reference)."' size='20' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Outcome</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='procedure_outcome' cols='50' rows='5'>".$procedure_outcome."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Outcome Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='outcome_remarks' cols='50' rows='3'>".$outcome_remarks."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";
echo "\n</fieldset>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Add/Edit Procedure' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";

?>
<script  type="text/javascript">

    function select_level_two(){
        document.getElementById("consultation_form").status.value="Unfinished";
        document.getElementById("level_two").selectedIndex = -1;
        document.getElementById("level_three").selectedIndex = -1;
        document.getElementById("level_four").selectedIndex = -1;
        document.getElementById("consultation_form").submit.click();
    }

    function select_level_three(){
        document.getElementById("consultation_form").status.value="Unfinished";
        document.getElementById("level_three").selectedIndex = -1;
        document.getElementById("level_four").selectedIndex = -1;
        document.getElementById("consultation_form").submit.click();
    }

     function select_level_four()
     {
        document.getElementById("consultation_form").status.value="Unfinished";
        document.getElementById("level_four").selectedIndex = -1;
        document.getElementById("consultation_form").submit.click();
     }


    $(function() {
        $( "#procedure_datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });


    $(function() {
        $( "#outcome_datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });


</script>


