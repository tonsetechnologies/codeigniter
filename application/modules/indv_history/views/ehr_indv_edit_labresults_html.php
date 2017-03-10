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

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(order_info)=<br />";
		print_r($order_info);
    echo "\n<br />print_r(package_info)=<br />";
		print_r($package_info);
	echo '</pre>';
    echo "\n<br />lab_package_id=".$lab_package_id;
    echo "\n<br />supplier_id=".$supplier_id;
    echo "\n<br />sample_date=".$sample_date;
    echo "\n<br />sample_time=".$sample_time;
    echo "\n<br />fasting=".$fasting;
    echo "\n<br />urgency=".$urgency;
    echo "\n<br />remarks=".$remarks;
    echo "\n<br />num_of_tests=".$num_of_tests;
    echo "\n<br />result_date=".$result_date;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('orders_edit_lab_results_html_title')."</h1></div>";


$attributes =   array('class' => 'select_form', 'id' => 'results_form');
echo form_open('indv/indv/index/indv_history/ehr_individual_history/edit_labresults/edit_labresults/'.$patient_id.'/'.$summary_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('lab_order_id', $lab_order_id);

echo "\n<table class='header' width='100%' align='center'>";
echo "<tr><td><b>Lab Order</b></td></tr>";
echo "</table>";
echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr>";
    echo "\n<td>Sample Ref.</td>";
    echo "\n<td><strong>".$sample_ref."</strong></td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='35%'>Lab Package</td>";
    echo "\n<td>".$package_name."</td>";
echo "</tr>";

/*
echo "\n<tr>";
    echo "<td>Patient Name</td>";
    echo "<td><strong>".$patient_info['name']."</strong></td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "<td>Birth Date</td>";
    echo "<td>".$patient_info['birth_date']."</td>";
echo "\n</tr>";
*/

echo "\n<tr>";
    echo "<td>Date Consultation Started</td>";
    echo "<td>".$patcon_info['date_started']."</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "<td>Time Consultation Started</td>";
    echo "<td>".$patcon_info['time_started']."</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td>Supplier</td>";
    echo "\n<td><strong>".$supplier_name."</strong></td>";
echo "</tr>";

echo "\n<tr>";
    echo "<td>Sample required</td>";
    echo "<td>$sample_required</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td>Specimen Collection Date</td>";
    echo "\n<td>".$sample_date."</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td>Specimen Collection Time</td>";
    echo "\n<td>".$sample_time."</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td>Fasting</td>";
    echo "\n<td>".$fasting."</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td>Urgent</td>";
    echo "\n<td>".$urgency."</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td>Order Remarks</td>";
    echo "\n<td>".$remarks."</td>";
echo "\n</tr>";

echo "\n<tr><td>Result Date <font color='red'>*</font></td><td>";
echo form_error('result_date');
echo "\n<input type='text' id='result_date' name='result_date' value='".set_value('result_date',$result_date)."' size='10' />";
echo " YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Result Reference</td><td>";
echo form_error('result_ref');
echo "\n<input type='text' id='result_ref' name='result_ref' value='".set_value('result_ref',$result_ref)."' size='20' />";
echo "</td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Results Summary <font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('summary_result');
    echo "\n<textarea class='normal' name='summary_result' id='summary_result' cols='50' rows='5'>".$summary_result."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";

//if($num_of_tests > 0){
if(isset($package_info[0]['lab_order_id'])){
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th>Test Code</th>";
        echo "\n<th>LOINC</th>";
        echo "\n<th>Test Name</th>";
        echo "\n<th>Result</th>";
        echo "\n<th>Normal Adult</th>";
        echo "\n<th>Remarks</th>";
    echo "</tr>";
    $num_of_tests    = 0;
    foreach ($package_info as $test_item){
        $num_of_tests++;
        $varname_result =   "test_result_".$num_of_tests;
        $varname_normal =   "test_normal_".$num_of_tests;
        $varname_remark =   "test_remark_".$num_of_tests;
        $set_value_result   =   set_value($varname_result,$test_item[$varname_result]);
        $set_value_normal   =   set_value($varname_normal,$test_item[$varname_normal]);
        $set_value_remark   =   set_value($varname_remark,$test_item[$varname_remark]);
        echo "\n<tr>";
        echo "<td>".$test_item['test_code']."</td>";
        echo "<td><strong>".$test_item['loinc_num']."</strong></td>";
        echo "<td>".$test_item['test_name']."</td>";
        echo "\n<td><input type='text' name='".$varname_result."' value='".$set_value_result."' size='20' /></td>";
        echo "\n<td><input type='text' name='".$varname_normal."' value='".$set_value_normal."' size='15' /></td>";
        echo "\n<td><input type='text' name='".$varname_remark."' value='".$set_value_remark."' size='30' /></td>";
        if($debug_mode) {
            echo "\n<td bgcolor='white'>result=".$set_value_result.", normal=".$set_value_normal.", remark=".$set_value_remark."</td>";
        }
        echo "</tr>";
    }//endforeach;
    echo "</table>";
    echo "\n<input type='hidden' name='num_of_tests' value='".$num_of_tests."' />";
} else {
    echo "\n<input type='hidden' name='num_of_tests' value='0' />";
}

echo "\n<br /><input type='checkbox' name='close_order' id='close_order' value='TRUE'";
if(!empty($result_reviewed_by)){
    echo " checked='checked'";
}
echo "\n /> Reviewed by Consultant and Close Lab Order<br />";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Save Lab Results' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";

?>
<script  type="text/javascript">

    $(function() {
        $( "#result_date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-5:c'
        });
    });




</script>


