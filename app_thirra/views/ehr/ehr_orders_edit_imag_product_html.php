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

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(packagetest_info)=<br />";
		print_r($packagetest_info);
    echo "\n<br />print_r(packages_ordered)=<br />";
		print_r($packages_ordered);
    echo "\n<br />print_r(loinc_class)=<br />";
		//print_r($loinc_class);
    echo "\n<br />print_r(loinc_list)=<br />";
		print_r($loinc_list);
    echo "\n<br />print_r(product_info)=<br />";
		print_r($product_info);
	echo '</pre>';
    echo "\n<br />product_id=".$product_id;
    echo "\n<br />init_loinc_num=".$init_loinc_num;
    echo "\n<br />loinc_class_name=".$init_loinc_class_name;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('orders_edit_imag_product_html_title')."</h1></div>";

$attributes =   array('class' => 'select_form', 'id' => 'product_form');
echo form_open('ehr_orders/orders_edit_imag_product/'.$form_purpose.'/imag/'.$supplier_id.'/'.$product_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('product_id', $product_id);
echo form_hidden('supplier_id', $supplier_id);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Supplier Name</td>";
echo "\n<td>".anchor('ehr_orders/orders_edit_imagsupplier_info/edit_supplier/imag/'.$supplier_id, "<strong>".$supplier_info[0]['supplier_name']."</strong>")."</td>";
echo "</td></tr>";

echo "\n<tr><td>Product Code</td><td>";
echo form_error('product_code');
echo "<input type='text' name='product_code' value='".set_value('product_code',$init_product_code)."' size='20' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Description <font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('description');
    echo "\n<textarea class='normal' name='description' id='description' cols='50' rows='3'>".$init_description."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>LOINC Class <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='loinc_class_name' class='normal' onchange='javascript:select_loinc_class()' id='loinc_class_name'>";
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:selectDiagnosisCategory()'>";
        echo "\n<option label='' value='0' >Please select one</option>";
        foreach($loinc_class as $class_item)
        {
            echo "\n<option value='".rtrim($class_item['class_name'])."'";
            echo ($init_loinc_class_name == rtrim($class_item['class_name']) ? " selected='selected'" : "");
            echo ">".$class_item['class_group']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>LOINC Code <font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='loinc_num' class='normal' onchange='javascript:select_LOINC()' id='loinc_num'>";
        echo "\n<option value='' >Please select one: Component [LOINC Code] System</option>";
        if(isset($loinc_list)){
            foreach($loinc_list as $loinc_item)
            {
	            echo "\n<option value='".trim($loinc_item['loinc_num'])."' ";
                if(isset($init_loinc_num)) {
                    echo ($init_loinc_num==trim($loinc_item['loinc_num']) ? " selected='selected'" : "");
                }
                echo ">".$loinc_item['component']." &nbsp;&nbsp;[".trim($loinc_item['loinc_num'])."] ".$loinc_item['system']."</option>";
            } //foreach
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Subcode</td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='level3' class='normal' id='level3'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($level3_list as $level3_item)
            {
	            echo "\n<option value='".$level3_item['marker']."' ";
                if(isset($level3)) {
                    echo ($level3==$level3_item['marker'] ? " selected='selected'" : "");
                }
                echo ">".$level3_item['info']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Supplier Cost</td><td>";
echo form_error('supplier_cost');
echo $app_currency." <input type='text' name='supplier_cost' value='".set_value('supplier_cost',$init_supplier_cost)."' size='7' /></td></tr>";

echo "\n<tr><td>Retail Price 1</td><td>";
echo form_error('retail_price');
echo $app_currency." <input type='text' name='retail_price' value='".set_value('retail_price',$init_retail_price)."' size='7' /></td></tr>";

echo "\n<tr><td>Retail Price 2</td><td>";
echo form_error('retail_price_2');
echo $app_currency." <input type='text' name='retail_price_2' value='".set_value('retail_price_2',$init_retail_price_2)."' size='7' /></td></tr>";

echo "\n<tr><td>Retail Price 3</td><td>";
echo form_error('retail_price_3');
echo $app_currency." <input type='text' name='retail_price_3' value='".set_value('retail_price_3',$init_retail_price_3)."' size='7' /></td></tr>";

echo "\n<tr><td>Commonly Used</td><td>";
echo form_error('commonly_used');
echo "<input type='text' name='commonly_used' value='".set_value('commonly_used',$init_commonly_used)."' size='2' /> Max. 99</td></tr>";

echo "\n<tr><td>Clinic</td>";
if(count($packages_ordered) > 0){
    echo "\n<td>".$init_clinic_shortname."</td>";
    echo form_hidden('package_location_id', $init_package_location_id);
} else {
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='package_location_id' class='normal'  id='package_location_id'>";
        foreach($clinics_list as $clinic)
        {
            echo "\n<option value='".$clinic['clinic_info_id']."'";
            //echo "\n<option label='".$clinic['clinic_info_id']."' value='".$clinic['clinic_info_id']."'";
            echo ($init_package_location_id == $clinic['clinic_info_id'] ? " selected='selected'" : "");
            echo ">".$clinic['clinic_name']."</option>";
        }
        echo "</select>";
    echo "</td>";
}
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Remarks</td>";
    echo "\n<td>";
    echo form_error('remarks');
    echo "\n<textarea class='normal' name='remarks' id='remarks' cols='50' rows='3'>".$init_remarks."</textarea>";
    echo "\n</td>";
echo "\n</tr>";


echo "\n</table>";
echo "\n<div id='one_package'></div>";
echo "\n<div id='one_holder'></div>";
echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_product"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Imaging Product' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";

echo "\nNo. of orders for this package = ";
if(isset($packages_ordered)){
    echo count($packages_ordered);
} else {
    echo "None";
}



?>
    <script  type="text/javascript">

        function select_loinc_class(){
            document.getElementById("product_form").status.value="Unfinished";
            document.getElementById("loinc_num").selectedIndex = -1;
            document.getElementById("level3").selectedIndex = -1;
            document.getElementById("one_holder").selectedIndex = -1;
            document.getElementById("product_form").submit.click();
        }

        function select_LOINC(){
            document.getElementById("product_form").status.value="Unfinished";
            document.getElementById("level3").selectedIndex = -1;
            document.getElementById("one_holder").selectedIndex = -1;
            document.getElementById("product_form").submit.click();
        }


      </script>


