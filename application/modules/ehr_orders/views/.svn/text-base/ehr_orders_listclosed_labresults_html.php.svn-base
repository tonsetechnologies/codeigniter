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

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('orders_list_closed_lab_results_html_title')."</h1></div>";


echo "\n<fieldset>";
echo "<legend>CLOSED RESULTS LIST</legend>";

echo $this->pagination->create_links();

        echo "\n<table class='tablebg_blue'>";
        echo "\n<tr>";
            echo "\n<th>print</th>";
            echo "\n<th width='260'>";
            echo anchor('ehr/ehr/index/ehr_orders/ehr_orders/orders_listclosed_labresults/name/', 'Patient Name');
            echo "</th>";
            echo "\n<th>";
            echo anchor('ehr/ehr/index/ehr_orders/ehr_orders/orders_listclosed_labresults/package_code/', 'Code');
            echo "</th>";
            echo "\n<th>";
            echo anchor('ehr/ehr/index/ehr_orders/ehr_orders/orders_listclosed_labresults/package_name/', 'Title');
            echo "</th>";
            echo "\n<th>";
            echo anchor('ehr/ehr/index/ehr_orders/ehr_orders/orders_listclosed_labresults/sample_ref/', 'Ref.');
            echo "</th>";
            echo "\n<th>";
            echo anchor('ehr/ehr/index/ehr_orders/ehr_orders/orders_listclosed_labresults/sample_date/', 'Sample Date');
            echo "</th>";
            echo "\n<th>";
            echo anchor('ehr/ehr/index/ehr_orders/ehr_orders/orders_listclosed_labresults/supplier_name/', 'Supplier');
            echo "</th>";
            echo "\n<th>Remarks</th>";
        echo "</tr>";
        foreach ($pending_labresults as $order_item){
            echo "\n<tr>";
            echo "<td>";
            echo anchor('ehr/ehr/index/ehr_orders/ehr_orders/print_lab_result/html/'.$order_item['patient_id'].'/'.$order_item['session_id'].'/'.$order_item['lab_order_id'], 'html', "target='_blank'");
            echo " ";
            echo anchor('ehr/ehr/index/ehr_orders/ehr_orders/print_lab_result/pdf/'.$order_item['patient_id'].'/'.$order_item['session_id'].'/'.$order_item['lab_order_id'], 'pdf', "target='_blank'");
            echo "</td>";
            echo "\n<td>".$order_item['name'].", ".$order_item['name_first']."</td>";
            echo "<td>".anchor('ehr/ehr/index/ehr_orders/ehr_orders/edit_labresults/edit_labresults/'.$order_item['patient_id'].'/'.$order_item['session_id'].'/'.$order_item['lab_order_id'], $order_item['package_code'])."</td>";
            echo "<td>".$order_item['package_name']."</td>";
            echo "<td><strong>".$order_item['sample_ref']."</strong></td>";
            echo "<td>".$order_item['sample_date']."</td>";
            echo "<td>".$order_item['supplier_name']."</td>";
            echo "<td>".$order_item['remarks']."</td>";
            echo "</tr>";
        }//endforeach;
        echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


