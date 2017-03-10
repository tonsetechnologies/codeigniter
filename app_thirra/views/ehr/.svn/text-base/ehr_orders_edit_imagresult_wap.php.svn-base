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

echo "\n<body>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />user_id = " . $user_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
		print_r($user_info);
    echo "\n<br />print_r(order_info)=<br />";
		print_r($order_info);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('orders_edit_imag_results_html_title')."</h1></div>";

echo "\n<table class='header' width='100%' align='center'>";
echo "\n<tr>";
    echo "<td width='25%'>Patient Name</td><td>";
    echo $name;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Birth Date</td><td>";
    echo $birth_date;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Supplier Name</td><td>";
    echo $supplier_name;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Supplier Ref.</td><td>";
    echo $supplier_ref;
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Product</td><td>";
    echo $product_code." - ".$description;
    echo "</td>";
echo "</tr>";
echo "\n</table>";


echo form_open('ehr_orders/orders_edit_imagresult/edit_result/'.$form_purpose.'/'.$order_id);

echo "<fieldset>";
echo "<legend>Results</legend>";
echo "\n<table>";
echo "\n<tr><td>Result Date <font color='red'>*</font></td><td>";
echo form_error('result_date');
echo "\n<input type='text' name='result_date' value='".set_value('result_date',$init_result_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Results Notes <font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('notes');
    echo "\n<textarea class='normal' name='notes' id='notes' cols='50' rows='5'>".$init_notes."</textarea>";
    echo "\n</td>";
echo "\n</tr>";


echo "\n</table>";
echo "\n<br /><input type='checkbox' name='close_order' id='close_order' value='TRUE'";
echo "\n /> Close Imaging Order<br />";

echo "</fieldset>";


echo form_hidden('now_id', $now_id);
echo form_hidden('order_id', $order_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Record Results' />";
echo "</div>";

echo "</form>";

echo "</div>"; //id=content

