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
    echo "\n<br />print_r(supplier_list)=<br />";
		print_r($supplier_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('orders_list_closed_imag_results_html_title')."</h1></div>";


echo "\n<fieldset>";
echo "<legend>CLOSED RESULTS LIST</legend>";
        echo "\n<table class='tablebg_blue'>";
        echo "\n<tr>";
            echo "\n<th>print</th>";
            echo "\n<th width='250'>Patient Name</th>";
            echo "\n<th>Code</th>";
            //echo "\n<th>Description</th>";
            echo "\n<th>Supplier Ref.</th>";
            echo "\n<th>Order Date</th>";
            echo "\n<th>Supplier</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        foreach ($pending_imaging as $order_item){
            echo "\n<tr>";
            echo "<td>";
            echo anchor('ehr_orders/print_imag_result/html/'.$order_item['patient_id'].'/'.$order_item['order_id'], 'html', "target='_blank'");
            echo " ";
            echo anchor('ehr_orders/print_imag_result/pdf/'.$order_item['patient_id'].'/'.$order_item['order_id'], 'pdf', "target='_blank'");
            echo "</td>";
            echo "<td>".$order_item['name'].", ".$order_item['name_first']."</td>";
            echo "<td>".anchor('ehr_orders/orders_edit_imagresult/edit_result/'.$order_item['order_id'], $order_item['product_code'])."</td>";
            //echo "<td>".$order_item['description']."</td>";
            echo "<td>".$order_item['supplier_ref']."</td>";
            echo "<td>".$order_item['date_ended']."</td>";
            echo "<td>".$order_item['supplier_name']."</td>";
            echo "<td>".$order_item['remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";



