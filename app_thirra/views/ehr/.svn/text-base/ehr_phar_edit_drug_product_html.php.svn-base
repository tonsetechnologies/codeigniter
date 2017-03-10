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

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(product_info)=<br />";
		print_r($product_info);
    echo "\n<br />print_r(drugcode_info)=<br />";
		print_r($drugcode_info);
    echo "\n<br />print_r(formulary_info)=<br />";
		print_r($formulary_info);
    echo "\n<br />print_r(drug_stocks)=<br />";
		print_r($drug_stocks);
	echo '</pre>';
    echo "\n<br />product_id=".$product_id;
    echo "\n<br />supplier_id=".$supplier_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('phar_edit_drug_product_html_title')."</h1></div>";

$attributes =   array('class' => 'select_form', 'id' => 'product_form');
echo form_open('ehr_pharmacy_supplier/phar_edit_drug_product/'.$form_purpose.'/drug/'.$supplier_id.'/'.$product_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('product_id', $product_id);
echo form_hidden('supplier_id', $supplier_id);
echo form_hidden('quantity', $init_quantity);
echo form_hidden('location_id', $init_location_id);
echo form_hidden('drug_type', $init_drug_type);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Supplier Name</td>";
//echo form_error('product_code');
echo "\n<td>".anchor('ehr_pharmacy_supplier/phar_edit_drugsupplier_info/edit_supplier/drug/'.$supplier_id, "<strong>".$supplier_info[0]['supplier_name']."</strong>")."</td>";
echo "</td></tr>";

echo "\n<tr><td>Product name <font color='red'>*</font></td><td>";
echo form_error('product_name');
echo "<input type='text' name='product_name' value='".set_value('product_name',$init_product_name)."' size='80' /></td></tr>";

echo "\n<tr><td>Seller Code</td><td>";
echo form_error('seller_code');
echo "<input type='text' name='seller_code' value='".set_value('seller_code',$init_seller_code)."' size='20' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Trade name <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='drug_code_id' class='normal' onchange='javascript:select_loinc_class()' id='loinc_class_name'>";
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:selectDiagnosisCategory()'>";
        echo "\n<option label='' value='0' >Please select one</option>";
        foreach($drugcode_list as $drugcode_item)
        {
            echo "\n<option value='".rtrim($drugcode_item['drug_code_id'])."'";
            echo ($init_drug_code_id == rtrim($drugcode_item['drug_code_id']) ? " selected='selected'" : "");
            echo ">".substr($drugcode_item['trade_name'],0,65)." &nbsp;&nbsp;(".substr($drugcode_item['generic_name'],0,55).")</option>";
            //echo ">".$drugcode_item['trade_name']." &nbsp;&nbsp;(".substr($drugcode_item['generic_name'],0,30).")</option>";
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

echo "\n<tr><td>Packing Size <font color='red'>*</font></td><td>";
echo form_error('packing');
echo "<input type='text' name='packing' value='".set_value('packing',$init_packing)."' size='7' /></td></tr>";

echo "\n<tr><td>Packing Form <font color='red'>*</font></td><td>";
echo form_error('packing_form');
echo "\n<select name='packing_form' class='normal' id='packing_form'>";
    echo "\n<option label='' value='' >Please select one</option>";
    foreach($package_forms as $packform_item)
    {
        echo "\n<option value='".rtrim($packform_item)."'";
        echo ($init_packing_form == rtrim($packform_item) ? " selected='selected'" : "");
        echo ">".$packform_item."</option>";
    }
    echo "</select>";
echo "</td>";
echo "</tr>";

echo "\n<tr><td>Wholesale Supplier Cost</td><td>";
echo form_error('wholesale_price');
echo $app_currency." <input type='text' name='wholesale_price' value='".set_value('wholesale_price',$init_wholesale_price)."' size='7' /></td></tr>";

echo "\n<tr><td>Standard Cost</td><td>";
echo form_error('ucost_std');
echo $app_currency." <input type='text' name='ucost_std' value='".set_value('ucost_std',$init_ucost_std)."' size='7' /></td></tr>";

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
echo "<input type='text' name='commonly_used' value='".set_value('commonly_used',$init_commonly_used)."' size='3' /> max. 99</td></tr>";

echo "\n<tr><td>PBKD No.</td><td>";
echo form_error('pbkd_no');
echo "<input type='text' name='pbkd_no' value='".set_value('pbkd_no',$init_pbkd_no)."' size='15' /></td></tr>";

echo "\n<tr><td>Remarks</td><td>";
echo form_error('remarks');
echo "<input type='text' name='remarks' value='".set_value('remarks',$init_remarks)."' size='80' /></td></tr>";

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
    echo " Drug Product' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";


if(isset($formulary_info[0])){
    echo "\n<fieldset>";
    echo "<legend>DRUG INFORMATION</legend>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<td>Trade name</td>";
        //echo "<td>".$formulary_info[0]['generic_name']."</td>";
        echo "\n<td>".anchor('ehr_utilities/util_edit_drugcode/edit_formulary/'.$formulary_info[0]['drug_formulary_id'], $drugcode_info[0]['trade_name'])."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Generic name</td>";
        //echo "<td>".$formulary_info[0]['generic_name']."</td>";
        echo "\n<td>".anchor('ehr_utilities/util_edit_drugformulary/edit_formulary/'.$formulary_info[0]['drug_formulary_id'], $formulary_info[0]['generic_name'])."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Formulary code</td>";
        echo "<td>".$formulary_info[0]['formulary_code']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Formulary system</td>";
        echo "<td>".$formulary_info[0]['formulary_system']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Commonly used</td>";
        echo "<td>".$formulary_info[0]['commonly_used']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>USFDA pregnancy category</td>";
        echo "<td>".$formulary_info[0]['usfda_preg_cat']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Poison category</td>";
        echo "<td>".$formulary_info[0]['poison_cat']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Dose form</td>";
        echo "<td>".$formulary_info[0]['dose_form']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Indication</td>";
        echo "<td>".$formulary_info[0]['indication']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Dosage</td>";
        echo "<td>".$formulary_info[0]['dosage']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Contra indication</td>";
        echo "<td>".$formulary_info[0]['contra_indication']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Precautions</td>";
        echo "<td>".$formulary_info[0]['precautions']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Interactions</td>";
        echo "<td>".$formulary_info[0]['interactions']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Adverse reactions</td>";
        echo "<td>".$formulary_info[0]['adverse_reactions']."</td>";
    echo "\n</tr>";
    echo "\n</table>";
    echo "\n</fieldset>";
} //endif(isset($formulary_info[0]))


if(isset($drug_stocks)){
    echo "\n<fieldset>";
    echo "<legend>STOCKS IN HAND</legend>";
    echo "\n<table>";
    echo "\n<tr>";
    echo "<th>Mfg. Batch</th>";
    echo "<th>Quantity</th>";
    echo "<th>Expiry</th>";
    echo "<th>Source</th>";
    echo "\n</tr>";
    foreach($drug_stocks as $stock_item){
        echo "\n<tr>";
        echo "<td>".$stock_item['mafg_batch']."</td>";
        echo "<td>".$stock_item['quantity']."</td>";
        echo "<td>".$stock_item['expiry_date']."</td>";
        echo "<td>".$stock_item['drug_source']."</td>";
        echo "</tr>";
    }
    echo "\n</table>";
    echo "\n</fieldset>";
} //endif(isset($drug_stocks))

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


