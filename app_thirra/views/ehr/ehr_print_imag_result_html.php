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

echo "\n\n<div id='print_content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    print "\n<br />patient_id = " . $patient_id;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(order_info)=<br />";
		print_r($order_info);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('orders_print_imag_results_html_title')."</h1></div>";

echo "\n<p>";

echo "\n<table>";
echo "\n<tr>";
	echo '<td>';
		echo "Patient's Name";
	echo '</td>';
	echo '<td>';
        echo "<h3>".$patient_info['name'].", ".$patient_info['name_first']."</h3>";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Date of Birth / Sex';
	echo '</td>';
	echo '<td>';
        echo $patient_info['birth_date']." / ".$patient_info['gender'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Session started';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['date_started']." at ".$patcon_info['time_started'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Session ended';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['date_ended']." at ".$patcon_info['time_ended'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Ordered By';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['signed_name'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'External Reference';
	echo '</td>';
	echo '<td>';
        echo $patcon_info['external_ref'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'supplier_ref';
	echo '</td>';
	echo '<td>';
        echo $order_info[0]['supplier_ref'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'supplier_name';
	echo '</td>';
	echo '<td>';
        echo $order_info[0]['supplier_name'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'product_code';
	echo '</td>';
	echo '<td><strong>';
        echo $order_info[0]['product_code'];
	echo '</strong></td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'description';
	echo '</td>';
	echo '<td><strong>';
        echo $order_info[0]['description'];
	echo '</strong></td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'remarks';
	echo '</td>';
	echo '<td>';
        echo $order_info[0]['remarks'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'result_date';
	echo '</td>';
	echo '<td>';
        echo $order_info[0]['result_date'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'notes';
	echo '</td>';
	echo '<td>';
        echo $order_info[0]['notes'];
	echo '</td>';
echo '</tr>';

echo '</table>';
echo "\n</p>";



echo "</div>"; //id='content'

echo "</div>"; //id=body
