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
 * Portions created by the Initial Developer are Copyright (C) 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username');
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(order_info)=<br />";
		print_r($order_info);
    echo "\n<br />print_r(procedure_groups)=<br />";
		print_r($procedure_groups);
    echo "\n<br />print_r(procedure_list)=<br />";
		print_r($procedure_list);
    echo "\n<br />print_r(product_list)=<br />";
		print_r($product_list);
	echo '</pre>';
    echo "\n<br />order_id=".$order_id;
    echo "\n<br />product_id=".$product_id;
    echo "\n<br />supplier_id=".$supplier_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_problem_list_html_title')."</h1></div>";


$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('indv/indv/index/indv_history/ehr_indvhist_problemlist/edit_problem_list/'.$form_purpose.'/'.$patient_id.'/'.$problem_list_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('staff_name', $staff_name);

    echo "\n<strong>";
if("new_problem" == $form_purpose){
    echo "ADDING NEW";
} else {
    echo "EDITING";
}
    echo "\n PROBLEM</strong><br /><br />";

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Date of Record <font color='red'>*</font></td><td>";
echo form_error('record_date');
echo "<input type='text' name='record_date' id='outcome_datepicker' value='".set_value('record_date',$init_record_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Recorded by</td><td>";
echo $staff_name;
echo "</td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='center'>Problem <font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('problem');
    echo "\n<textarea class='normal' name='problem' cols='50' rows='5'>".$init_problem."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Add/Edit Problem' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";

echo "\n</form>";
echo "\n<br />";

?>
<script  type="text/javascript">



    $(function() {
        $( "#procedure_datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });


    $(function() {
        $( "#outcome_datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });


</script>


