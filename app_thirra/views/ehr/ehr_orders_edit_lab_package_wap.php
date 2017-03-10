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

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(packages_list)=<br />";
		print_r($packages_list);
    echo "\n<br />print_r(packages_info)=<br />";
		print_r($packages_info);
    echo "\n<br />print_r(tests_info)=<br />";
		print_r($tests_info);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />supplier_id=".$supplier_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('orders_edit_lab_package_html_title')."</h1></div>";

$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('ehr_orders/orders_edit_lab_package/'.$form_purpose.'/'.$supplier_id.'/'.$lab_package_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('lab_package_id', $lab_package_id);
echo form_hidden('supplier_id', $supplier_id);
//echo form_hidden('supplier_type', $supplier_type);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Supplier Name</td><td><strong>";
echo form_error('lab_package_id');
echo $supplier_info[0]['supplier_name']."</strong></td><tr>";

echo "\n<tr><td>Package Name <font color='red'>*</font></td><td>";
echo form_error('package_name');
echo "<input type='text' name='package_name' value='".set_value('package_name',$init_package_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Package Code <font color='red'>*</font></td><td>";
echo form_error('package_code');
echo "<input type='text' name='package_code' value='".set_value('package_code',$init_package_code)."' size='10' /></td></tr>";

echo "\n<tr><td>Description</td><td>";
echo form_error('description');
echo "<input type='text' name='description' value='".set_value('description',$init_description)."' size='80' /></td></tr>";

echo "\n<tr><td>Sample Required</td><td>";
echo form_error('sample_required');
echo "<input type='text' name='sample_required' value='".set_value('sample_required',$init_sample_required)."' size='50' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>LOINC Class <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo form_error('loinc_class_id');
    echo "\n<select name='loinc_class_id' class='normal' id='loinc_class_id'>";
        echo "\n<option label='' value='' selected='selected'>Please select one</option>";
        foreach($loinc_class as $class_item)
        {
            echo "\n<option value='".rtrim($class_item['loinc_class_id'])."'";
            echo ($init_loinc_class_id == rtrim($class_item['loinc_class_id']) ? " selected='selected'" : "");
            echo ">".$class_item['class_group']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Lab Classification <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo form_error('lab_classification_id');
    echo "\n<select name='lab_classification_id' class='normal' id='lab_classification_id'>";
        echo "\n<option label='' value='' selected='selected'>Please select one</option>";
        foreach($lab_classifications as $labclass_item)
        {
            echo "\n<option value='".rtrim($labclass_item['lab_classification_id'])."'";
            echo ($init_lab_classification_id == rtrim($labclass_item['lab_classification_id']) ? " selected='selected'" : "");
            echo ">".$labclass_item['class_title']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Commonly Used</td><td>";
echo form_error('commonly_used');
echo "<input type='text' name='commonly_used' value='".set_value('commonly_used',$init_commonly_used)."' size='2' /> max. 99</td></tr>";

echo "\n<tr><td>Package Active</td><td>";
echo form_error('package_active');
    echo "\n<select name='package_active'>";
    if($init_package_active == NULL){$init_package_active=TRUE;}
    echo "\n<option value='TRUE'".($init_package_active==TRUE?' selected=\'selected\'':'').">Yes</option>";
    echo "\n<option value='FALSE'".($init_package_active==FALSE?' selected=\'selected\'':'').">No</option>";
    echo "\n</select></td></tr>";

echo "\n<tr><td>Filter by Sex</td><td>";
echo form_error('lab_filter_sex');
    echo "\n<select name='lab_filter_sex'>";
    if($init_lab_filter_sex == NULL){$init_lab_filter_sex='B';}
    echo "\n<option value='B'".($init_lab_filter_sex=='B'?' selected=\'selected\'':'').">Both</option>";
    echo "\n<option value='M'".($init_lab_filter_sex=='M'?' selected=\'selected\'':'').">Male</option>";
    echo "\n<option value='F'".($init_lab_filter_sex=='F'?' selected=\'selected\'':'').">Female</option>";
    echo "\n</select></td></tr>";

echo "\n<tr><td>Filter by Age: Older than</td><td>";
echo form_error('lab_filter_olderthan');
echo "<input type='text' name='lab_filter_olderthan' value='".set_value('lab_filter_olderthan',$init_lab_filter_olderthan)."' size='5' /> years old</td></tr>";

echo "\n<tr><td>Filter by Age: Younger than</td><td>";
echo form_error('lab_filter_youngerthan');
echo "<input type='text' name='lab_filter_youngerthan' value='".set_value('lab_filter_youngerthan',$init_lab_filter_youngerthan)."' size='5' /> years old</td></tr>";

echo "\n<tr><td>Supplier Cost</td><td>";
echo form_error('supplier_cost');
echo $app_currency." <input type='text' name='supplier_cost' value='".set_value('supplier_cost',$init_supplier_cost)."' size='7' /></td></tr>";

echo "\n<tr><td>Retail Price 1</td><td>";
echo form_error('retail_price_1');
echo $app_currency." <input type='text' name='retail_price_1' value='".set_value('retail_price_1',$init_retail_price_1)."' size='7' /></td></tr>";

echo "\n<tr><td>Retail Price 2</td><td>";
echo form_error('retail_price_2');
echo $app_currency." <input type='text' name='retail_price_2' value='".set_value('retail_price_2',$init_retail_price_2)."' size='7' /></td></tr>";

echo "\n<tr><td>Retail Price 3</td><td>";
echo form_error('retail_price_3');
echo $app_currency." <input type='text' name='retail_price_3' value='".set_value('retail_price_3',$init_retail_price_3)."' size='7' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Package Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='package_remarks' cols='40' rows='3'>".set_value('package_remarks',$init_package_remarks)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_package"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Lab Package' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";


echo "\n<fieldset>";
echo "<legend>PACKAGE TESTS</legend>";
if($form_purpose == "edit_package"){
    echo anchor('ehr_orders/orders_edit_lab_packagetest/new_packagetest/'.$lab_package_id.'/new_packagetest', '<strong>Add New Test</strong>');
} //endif($form_purpose == "edit_package")
echo "\n<br /><br /><table>";
echo "\n<tr>";
    echo "\n<th width='10'>Sort Order</th>";
    echo "\n<th width='50'>Code</th>";
    echo "\n<th width='200'>Test Name</th>";
    echo "\n<th width='55'>LOINC</th>";
    echo "\n<th>Normal Adult</th>";
    echo "\n<th>Remarks</th>";
echo "</tr>";

if(isset($tests_info)){
    foreach ($tests_info as $tests_item){
        echo "<tr>";
        echo "<td>".$tests_item['sort_test']."</td>";
        echo "<td>".$tests_item['test_code']."</td>";
        echo "<td>".anchor('ehr_orders/orders_edit_lab_packagetest/edit_packagetest/'.$lab_package_id.'/'.$tests_item['lab_package_test_id'], $tests_item['test_name'])."</td>";
        echo "<td><strong>".$tests_item['loinc_num']."</strong></td>";
        echo "<td>".$tests_item['normal_adult']."</td>";
        echo "<td>".$tests_item['test_remarks']."</td>";
        echo "</tr>";
    }//endforeach;
} //endif(isset($tests_info))

echo "</table>";
echo "\n</fieldset>";


?>
    <script  type="text/javascript">
        var $ = function (id) {
            return document.getElementById(id);
        }

        function select_level_two(){
            $("consultation_form").status.value="Unfinished";
            $("level_two").selectedIndex = -1;
            $("consultation_form").submit.click();
        }

      </script>


