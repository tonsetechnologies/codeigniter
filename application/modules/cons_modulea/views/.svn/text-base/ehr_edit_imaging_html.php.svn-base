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
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(order_info)=<br />";
		print_r($order_info);
    echo "\n<br />print_r(imaging_list)=<br />";
		print_r($imaging_list);
    echo "\n<br />print_r(imaging_categories)=<br />";
		print_r($imaging_categories);
    echo "\n<br />print_r(product_list)=<br />";
		print_r($product_list);
    echo "\n<br />print_r(supplier_list)=<br />";
		print_r($supplier_list);
	echo '</pre>';
    echo "\n<br />order_id=".$order_id;
    echo "\n<br />imaging_category=".$imaging_category;
    echo "\n<br />product_id=".$product_id;
    echo "\n<br />supplier_id=".$supplier_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_imaging_html_title')."</h1></div>";

echo "\n\n<div id='current_diagnosis' class='episodeblock'>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>Code</th>";
    echo "\n<th width='200'>Component</th>";
    echo "\n<th width='200'>Description</th>";
    echo "\n<th>Ref No.</th>";
    echo "\n<th>Supplier</th>";
    echo "\n<th>Remarks</th>";
echo "</tr>";
foreach ($imaging_list as $imaging_item){
    echo "<tr>";
    echo "<td>".anchor('cons/cons/index/cons_orders/ehr_consult_orders/edit_imaging/edit_imaging/'.$patient_id.'/'.$summary_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
    echo "<td>".$imaging_item['component']."</td>";
    echo "<td>".$imaging_item['description']."</td>";
    echo "<td>".$imaging_item['supplier_ref']."</td>";
    echo "<td>".$imaging_item['supplier_name']."</td>";
    echo "<td>".$imaging_item['remarks']."</td>";
    echo "</tr>";
}//endforeach;
echo "</table>";
echo "</div>"; //id='current_diagnosis'


$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('cons/cons/index/cons_orders/ehr_consult_orders/edit_imaging/'.$form_purpose.'/'.$patient_id.'/'.$summary_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('order_id', $order_id);
echo form_hidden('result_status', $result_status);

echo "\n<table class='header' width='100%' align='center'>";
echo "<tr><td><b>IMAGING ORDER</b></td></tr>";
echo "</table>";
echo "\n<table class='frame' width='100%' align='center'>";
echo "<tr>";
    echo "\n<td width='25%'>Imaging Category <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='imaging_category' class='normal' onchange='javascript:select_level_two()' id='level_one'>";
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:select_level_two()'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($imaging_categories as $category)
        {
            echo "\n<option label='".$category['class_name']."' value='".$category['class_name']."'";
            echo ($imaging_category == $category['class_name'] ? " selected='selected'" : "");
            echo ">".$category['class_group']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Imaging Product<font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='product_id' class='normal' onchange='javascript:select_level_three()' id='level_two'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($product_list as $product_item)
            {
	            echo "\n<option value='".$product_item['product_id']."' ";
                if(isset($product_id)) {
                    echo ($product_id==$product_item['product_id'] ? " selected='selected'" : "");
                }
                echo ">".$product_item['component']."&nbsp;&nbsp;[".$product_item['product_code']."]</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td width='25%'>Imaging Supplier <font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='supplier_id' class='normal' onchange='javascript:select_level_four()' id='level_three'>";
            foreach($supplier_list as $supplier)
            {
	            echo "\n<option value='".$supplier['supplier_id']."' ";
                if(isset($supplier_id)) {
                    echo ($supplier_id==$supplier['supplier_id'] ? "selected='selected'" : "");
                }
                echo ">".$supplier['supplier_name']."&nbsp;&nbsp;[".$supplier['acc_no']."]</option>";
            }
        echo "</select>";

    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Imaging Info</td>";
    echo "\n<td colspan='2'>";
        echo "<select name='diagnosis2' class='normal' id='level_four'>";
        if(count($dcode2ext_list) > 0) {
            foreach($dcode2ext_list as $dcode2ext) 
            {
	            echo "\n<option value='".$dcode2ext['dcode2ext_code']."'>".$dcode2ext['full_title']."&nbsp;&nbsp;[".$dcode2ext['dcode2ext_code']."]</option>";
            }
        } else {
            echo "\n<option value='' selected='selected'>Not applicable</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Order Ref.<font color='red'>*</font></td><td>";
echo form_error('order_ref');
echo "<input type='text' name='order_ref' value='".set_value('order_ref',$order_ref)."' size='20' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Order Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='remarks' cols='50' rows='3'>".$remarks."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";

echo "\n<fieldset>";
echo "<legend>IMAGING RESULTS (OPTIONAL)</legend>";
echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Result Date</td><td>";
echo form_error('result_date');
echo "<input type='text' name='result_date' value='".set_value('result_date',$result_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Results Reference</td><td>";
echo form_error('result_ref');
echo "\n<input type='text' id='result_ref' name='result_ref' value='".set_value('result_ref',$result_ref)."' size='20' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Results</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='imaging_result' cols='50' rows='5'>".$imaging_result."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Results Remarks</td><td>";
echo form_error('result_remarks');
echo "\n<input type='text' id='result_remarks' name='result_remarks' value='".set_value('result_remarks',$result_remarks)."' size='80' /></td></tr>";

echo "\n</table>";
echo "\n</fieldset>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Add Order' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";

?>
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


