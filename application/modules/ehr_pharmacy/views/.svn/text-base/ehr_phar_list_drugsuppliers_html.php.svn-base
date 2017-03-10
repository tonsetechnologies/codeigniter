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
 * Portions created by the Initial Developer are Copyright (C) 2010 - 2011
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
    echo "\n<br />print_r(supplier_list)=<br />";
		print_r($supplier_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('phar_list_drugsuppliers_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<fieldset>";
echo "<legend>SUPPLIERS LIST</legend>";
echo anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy_supplier/phar_edit_drugsupplier_info/new_supplier/drug/new_supplier', "<strong>Add New Supplier</strong>");
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Code</th>";
    echo "\n<th width='380'>Supplier Name</th>";
    echo "\n<th width='250'>Contact Person</th>";
    echo "\n<th width='200'>Tel. No.</th>";
echo "</tr>";
if(isset($supplier_list)){
    $rownum = 1;
    foreach ($supplier_list as $supplier_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$supplier_item['acc_no']."</td>";
        echo "\n<td>".anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy_supplier/phar_edit_drugsupplier_info/edit_supplier/drug/'.$supplier_item['supplier_id'], "<strong>".$supplier_item['supplier_name']."</strong>")."</td>";
        echo "\n<td>".$supplier_item['contact_person']."</td>";
        echo "\n<td>".$supplier_item['tel_no']."</td>";
        echo "\n<td>".anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy_supplier/phar_list_drug_supplierinvoices/'.$supplier_item['supplier_id'], "Invoices")."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";



