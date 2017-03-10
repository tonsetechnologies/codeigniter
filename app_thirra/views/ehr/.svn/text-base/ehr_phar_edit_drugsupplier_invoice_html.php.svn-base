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

$ideal_field_length = 25;
$max_sort           = 0;

//echo "\n<body>";

echo "\n\n<div id='content'>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />supplier_id = " . $supplier_id;
    print "\n<br />supplier_invoice_id = " . $supplier_invoice_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(clinic_info)=<br />";
		print_r($clinic_info);
    echo "\n<br />print_r(supplier_info)=<br />";
		print_r($supplier_info);
    echo "\n<br />print_r(invoice_header)=<br />";
		print_r($invoice_header);
    echo "\n<br />print_r(invoice_details)=<br />";
		print_r($invoice_details);
    echo "\n<br />print_r(details_withpo)=<br />";
		print_r($details_withpo);
    echo "\n<br />print_r(details_nopo)=<br />";
		print_r($details_nopo);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n<table class='frame' width='100%' align='center'>";

echo form_open('ehr_pharmacy_supplier/phar_edit_drug_supplierinvoice/'.$form_purpose.'/'.$supplier_id.'/'.$supplier_invoice_id);

echo "\n<tr><td><h1>";
echo $supplier_info[0]['supplier_name']."</h1>";
echo "\nReg. No. ".$supplier_info[0]['registration_no'];
echo "</td></tr>";

echo "\n<tr><td>";
echo "<h3>";
echo $supplier_info[0]['address'].", ";
echo $supplier_info[0]['address2'].", ";
echo $supplier_info[0]['address3'].", ";
echo $supplier_info[0]['postcode']." ";
echo $supplier_info[0]['town'].",  ";
echo $supplier_info[0]['state'].", ";
echo $supplier_info[0]['country']."<br />";
echo "</h3>";
echo "</td></tr>";

echo "\n<td>";
echo $clinic_info['clinic_name']."<br />";
echo $clinic_info['address']."<br />";
echo $clinic_info['address2']."<br />";
echo $clinic_info['address3']."<br />";
echo $clinic_info['postcode']." ";
echo $clinic_info['town']."<br />";
echo $clinic_info['state']."<br />";
echo $clinic_info['country']."<br />";
echo "</td></tr>";

echo "\n<tr><td>Account No. :";
echo $supplier_info[0]['acc_no'];
echo "</td></tr>";

echo "\n</table>";

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('phar_edit_drugsupplier_invoice_html_title')."</h1></div>";



echo "<fieldset>";
echo "<legend>Column Info</legend>";
echo "\n<table>";

echo "\n<tr><td>Invoice No. <font color='red'>*</font></td>";
echo "<td>";
echo form_error('invoice_no');
echo "<input type='text' name='invoice_no' value='".set_value('invoice_no',$init_invoice_no)."' size='20' />";
echo "</td></tr>";

echo "\n<tr><td>Invoice Date <font color='red'>*</font></td>";
echo "<td>";
echo form_error('invoice_date');
echo "<input type='text' name='invoice_date' value='".set_value('invoice_date',$init_invoice_date)."' size='20' />";
echo "</td></tr>";

echo "\n<tr><td>Remarks</td><td>";
echo form_error('remarks');
echo "<input type='text' name='remarks' value='".set_value('remarks',$init_remarks)."' size='100' /></td></tr>";

echo "\n<tr><td>Invoice Type <font color='red'>*</font></td><td valign='top'>";
//if(!isset($init_with_po)){
    //$init_with_po  = "";
//}
echo form_error('with_po');
echo "\n<input type='radio' name='with_po' value=TRUE ".set_radio('with_po','TRUE',($init_with_po=='t'?TRUE:FALSE))." >With PO</input>";
echo "\n<input type='radio' name='with_po' value=FALSE ".set_radio('with_po','FALSE',($init_with_po=='f'?TRUE:FALSE))." >Ad hoc</input>";
echo "\n</td></tr>";



echo "\n</table>";
echo "</fieldset>";


echo form_hidden('now_id', $now_id);
echo form_hidden('supplier_id', $supplier_id);
echo form_hidden('supplier_invoice_id', $supplier_invoice_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Add/Edit Invoice Header' />";
echo "</div>";

echo "</form>";

echo "</div>";

echo "\n<fieldset>";
echo "<legend>INVOICE ITEMS</legend>";
echo anchor('ehr_pharmacy_supplier/phar_edit_drug_supplierinvoice/edit_invoice/'.$supplier_invoice_id.'/new_invoice', "<strong>Add New Item</strong>");
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>PO No.</th>";
    echo "\n<th width='110'>Code</th>";
    echo "\n<th width='350'>Product Name</th>";
    echo "\n<th width='50'>Packs</th>";
    echo "\n<th width='50'>Packing</th>";
    echo "\n<th width='100'> </th>";
    echo "\n<th width='70'>Cost Per Pack</th>";
    echo "\n<th width='50'>Bonus</th>";
    echo "\n<th width='80'>Total</th>";
echo "</tr>";
if(isset($details_withpo)){
    $rownum         =   1;
    $grand_total    =   0;
    foreach ($details_withpo as $invoice_item){
        $cost_per_pack      =   0;
        $item_total         =   0;
        echo "\n<tr>";
        echo "\n<td valign='top'>".$rownum.".</td>";
        echo "\n<td valign='top'>".$invoice_item['po_no']."</td>";
        echo "\n<td valign='top'>".$invoice_item['seller_code']."</td>";
        if($init_with_po == 't'){
            echo "\n<td valign='top'>".anchor('ehr_pharmacy_supplier/phar_edit_drug_supplierinvoice/edit_invoice/'.$invoice_item['supplier_invoice_id'].'/'.$invoice_item['supplier_inv_drug_id'], "<strong>".$invoice_item['product_name']."</strong>")."</td>";
        } else {
            echo "\n<td valign='top'>".anchor('ehr_pharmacy_supplier/phar_edit_drug_supplierinvoice/edit_invoice/'.$invoice_item['supplier_invoice_id'].'/'.$invoice_item['supplier_inv_drug_adhoc_id'], "<strong>".$invoice_item['product_name']."</strong>")."</td>";
        }
        echo "\n<td align='right' valign='top'>".$invoice_item['quantity_received']."</td>";
        echo "\n<td align='right' valign='top'>".$invoice_item['packing']."</td>";
        echo "\n<td valign='top'>".$invoice_item['packing_form']."</td>";
        $cost_per_pack =   $invoice_item['unit_cost'] * $invoice_item['packing'];
        echo "\n<td align='right' valign='top'>".number_format($cost_per_pack, 3, '.', ',')."</td>";
        echo "\n<td align='right' valign='top'>".$invoice_item['bonus_qty']."</td>";
        $item_total =   ($invoice_item['quantity_received']/$invoice_item['packing']) * $cost_per_pack;
        echo "\n<td align='right' valign='top'>".number_format($item_total, 2, '.', ',')."</td>";
        echo "\n</tr>";
        $grand_total    =   $grand_total + $item_total;
        $rownum++;
    }//endforeach;
}
        echo "\n<tr>";
        echo "\n<td></td>";
        echo "\n<td></td>";
        echo "\n<td></td>";
        echo "\n<td></td>";
        echo "\n<td></td>";
        echo "\n<td></td>";
        echo "\n<td></td>";
        echo "\n<td></td>";
        echo "\n<td></td>";
        echo "\n<td align='right'>".number_format($grand_total, 2, '.', ',')."</td>";
        echo "\n</tr>";
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


echo "</div>"; //id=content

