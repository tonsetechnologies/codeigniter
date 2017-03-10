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

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(supplier_info)=<br />";
		print_r($supplier_info);
    echo "\n<br />print_r(invoices_list)=<br />";
		print_r($invoices_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('phar_list_drugsupplier_invoices_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Supplier Name</td>";
echo "\n<td>".anchor('ehr_pharmacy_supplier/phar_edit_drugsupplier_info/edit_supplier/drug/'.$supplier_id, "<strong>".$supplier_info[0]['supplier_name']."</strong>")."</td>";
echo "</td></tr>";

echo "\n<tr><td>Registration No.</td>";
echo "\n<td>".$supplier_info[0]['registration_no']."</td>";
echo "</td></tr>";

echo "\n<tr><td>Account No.</td>";
echo "\n<td>".$supplier_info[0]['acc_no']."</td>";
echo "</td></tr>";


echo "\n</table>";


echo "\n<fieldset>";
echo "<legend>INVOICES LIST</legend>";
echo anchor('ehr_pharmacy_supplier/phar_edit_drug_supplierinvoice/new_invoice/'.$supplier_id.'/new_invoice', "<strong>Add New Invoice</strong>", 'target="_blank"');
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Status</th>";
    echo "\n<th width='150'>Invoice No.</th>";
    echo "\n<th width='50'>Date</th>";
    echo "\n<th width='200'>Amount</th>";
    echo "\n<th width='200'>Remarks</th>";
echo "</tr>";
if(isset($invoices_list)){
    $rownum = 1;
    foreach ($invoices_list as $invoice_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$invoice_item['status']."</td>";
        if($invoice_item['with_po'] == TRUE){
            echo "\n<td>".anchor('ehr_pharmacy_supplier/phar_edit_drug_supplierinvoice/edit_invoice/'.$invoice_item['supplier_id'].'/'.$invoice_item['supplier_invoice_id'], "<strong>".$invoice_item['invoice_no']."</strong>", 'target="_blank"')."</td>";
        } else {
            //echo "\n<td>".anchor('ehr_pharmacy_supplier/phar_edit_drug_supplierinvoice/edit_invoice/'.$invoice_item['supplier_id'].'/'.$invoice_item['supplier_invoice_id'], "<strong>".$invoice_item['invoice_no']."</strong>", 'target="_blank"')."</td>";
        }
        echo "\n<td>".$invoice_item['invoice_date']."</td>";
        echo "\n<td align='right'>".$invoice_item['total_cost']."</td>";
        echo "\n<td>".$invoice_item['remarks']."</td>";
        echo "\n<td>".anchor('ehr_pharmacy_supplier/phar_edit_drug_supplierinvoice/edit_invoice/'.$invoice_item['supplier_id'].'/'.$invoice_item['supplier_invoice_id'], "Invoices", 'target="_blank"')."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


