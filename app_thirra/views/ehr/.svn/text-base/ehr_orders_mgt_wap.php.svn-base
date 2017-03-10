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
    echo "\n<br />print_r(pending_labresults)=<br />";
		print_r($pending_labresults);
    echo "\n<br />print_r(pending_imaging)=<br />";
		print_r($pending_imaging);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div align='center'><h1>".$this->lang->line('orders_mgt_html_title')."</h1></div>";

echo "\n\n<div id='orders_lab' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Pending Lab Orders</h2></p>";
	echo "\n<p class='section_body'>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th width='250'>Patient Name</th>";
            echo "\n<th>Code</th>";
            echo "\n<th>Title</th>";
            echo "\n<th>Sample Ref.</th>";
            echo "\n<th>Sample Date</th>";
            echo "\n<th>Supplier</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        foreach ($pending_labresults as $order_item){
            echo "<tr>";
            echo "<td>".$order_item['name'].", ".$order_item['name_first']."</td>";
            echo "<td>".anchor('ehr_orders/edit_labresults/edit_labresults/'.$order_item['patient_id'].'/'.$order_item['summary_id'].'/'.$order_item['lab_order_id'], $order_item['package_code'])."</td>";
            echo "<td>".$order_item['package_name']."</td>";
            echo "<td><strong>".$order_item['sample_ref']."</strong></td>";
            echo "<td>".$order_item['sample_date']."</td>";
            echo "<td>".$order_item['supplier_name']."</td>";
            echo "<td>".$order_item['remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='orders_imaging' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Pending Imaging Orders</h2></p>";
	echo "\n<p class='section_body'>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th width='250'>Patient Name</th>";
            echo "\n<th>Code</th>";
            echo "\n<th>Description</th>";
            echo "\n<th>Supplier Ref.</th>";
            echo "\n<th>Order Date</th>";
            echo "\n<th>Supplier</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        foreach ($pending_imaging as $order_item){
            echo "<tr>";
            echo "<td>".$order_item['name'].", ".$order_item['name_first']."</td>";
            echo "<td>".anchor('ehr_orders/orders_edit_imagresult/edit_result/'.$order_item['order_id'], $order_item['product_code'])."</td>";
            echo "<td>".$order_item['description']."</td>";
            echo "<td>".$order_item['supplier_ref']."</td>";
            echo "<td><strong>".$order_item['date_ended']."</strong></td>";
            echo "<td>".$order_item['supplier_name']."</td>";
            echo "<td>".$order_item['remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='orders_procedures' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Pending Procedures Orders</h2></p>";
	echo "\n<p class='section_body'>";
        echo "\n<table>";
        echo "\n<tr>";
            echo "\n<th width='200'>Patient Name</th>";
            echo "\n<th>Code</th>";
            echo "\n<th>Description</th>";
            echo "\n<th>Supplier Ref.</th>";
            echo "\n<th>Order Date</th>";
            echo "\n<th>Supplier</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        /*
        foreach ($pending_imaging as $order_item){
            echo "<tr>";
            echo "<td>".$order_item['name'].", ".$order_item['name_first']."</td>";
            echo "<td>".anchor('ehr_orders/edit_reason_encounter/edit_complaints/'.$order_item['order_id'], $order_item['product_code'])."</td>";
            echo "<td>".$order_item['description']."</td>";
            echo "<td>".$order_item['supplier_ref']."</td>";
            echo "<td>".$order_item['date_ended']."</td>";
            echo "<td>".$order_item['supplier_name']."</td>";
            echo "<td>".$order_item['remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        */
        echo "</table>";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='orders_closed' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Closed Results</h2></p>";
	echo "\n<p class='section_body'>";
    echo "\n<br />".anchor('ehr_orders/orders_listclosed_labresults/lab', 'Laboratory Orders');
    echo "\n<br />".anchor('ehr_orders/orders_listclosed_imagresults/imaging', 'Imaging Orders');
    echo "\n<br />".anchor('ehr_orders/orders_listclosed_labresults/procedure', 'Procedures Orders');
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='suppliers_' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Suppliers and Catalogues</h2></p>";
	echo "\n<p class='section_body'>";
    echo "\n<br />".anchor('ehr_orders/ehr_orders_list_labsuppliers/lab', 'Laboratory Suppliers');
    echo "\n<br />".anchor('ehr_orders/ehr_orders_list_imagsuppliers/imaging', 'Imaging Suppliers');
    echo "\n<br />".anchor('ehr_orders/ehr_orders_list_procsuppliers/procedure', 'Procedures Suppliers');
	echo "<br />";
	echo "</p>";
echo "</div>";
/*
echo "\n\n<div id='orders_' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2></h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";
*/
echo "</div>"; //id=body

