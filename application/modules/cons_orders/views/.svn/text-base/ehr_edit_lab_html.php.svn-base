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
    echo "\n<br />print_r(lab_list)=<br />";
		print_r($lab_list);
    echo "\n<br />print_r(package_info)=<br />";
		print_r($package_info);
    echo "\n<br />print_r(results_info)=<br />";
		print_r($results_info);
	echo '</pre>';
    echo "\n<br />patient_id=".$patient_id;
    echo "\n<br />lab_package_id=".$lab_package_id;
    echo "\n<br />supplier_id=".$supplier_id;
    echo "\n<br />sample_date=".$sample_date;
    echo "\n<br />sample_time=".$sample_time;
    echo "\n<br />fasting=".$fasting;
    echo "\n<br />urgency=".$urgency;
    echo "\n<br />remarks=".$remarks;
    echo "\n<br />num_of_tests=".$num_of_tests;
    echo "\n<br />num_of_results=".$num_of_results;
    echo "\n<br />enter_tests=".$enter_tests;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_lab_html_title')."</h1></div>";

echo "\n\n<div id='tests_ordered' class='episodeblock'>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>Code</th>";
    echo "\n<th width='200'>Title</th>";
    echo "\n<th>Sample Ref.</th>";
    echo "\n<th>Supplier</th>";
    echo "\n<th>Remarks</th>";
    echo "\n<th>Results Summary</th>";
echo "</tr>";
foreach ($lab_list as $order_item){
    echo "\n<tr>";
    echo "<td>".anchor('cons/cons/index/cons_orders/ehr_consult_orders/edit_lab/edit_lab/'.$patient_id.'/'.$summary_id.'/'.$order_item['lab_order_id'], $order_item['package_code'])."</td>";
    echo "<td>".$order_item['package_name']."</td>";
    echo "<td>".$order_item['sample_ref']."</td>";
    echo "<td>".$order_item['supplier_name']."</td>";
    echo "<td>".$order_item['remarks']."</td>";
    echo "<td>".$order_item['summary_result']."</td>";
    echo "<td>";
    //if($order_item['details'] == "FALSE"){
        //echo anchor('cons/cons/index/cons_orders/ehr_consult_orders/consult_delete_lab/'.$patient_id.'/'.$summary_id.'/'.$order_item['lab_order_id'].'/'.$order_item['details'], "Delete");
        $delete_link    =   base_url()."index.php/cons/cons/index/cons_orders/ehr_consult_orders/consult_delete_lab/".$patient_id."/".$summary_id."/".$order_item['lab_order_id'].'/'.$order_item['details'];
        echo "<a href=\"javascript:deleteRecord('remove','Order: ".$order_item['package_name']."','".$delete_link ."');\">Delete</a>";
    //} else {
        //echo " - ";
    //}
    echo "</td>";
    echo "</tr>";
}//endforeach;
echo "</table>";
echo "</div>"; //id='complaints'


$attributes =   array('class' => 'select_form', 'id' => 'lab_form');
echo form_open('cons/cons/index/cons_orders/ehr_consult_orders/edit_lab/'.$form_purpose.'/'.$patient_id.'/'.$summary_id.'/'.$lab_order_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('lab_order_id', $lab_order_id);
echo form_hidden('result_status', $result_status);

echo "\n<table class='header' width='100%' align='center'>";
echo "<tr><td><b>Lab Package Order</b></td></tr>";
echo "</table>";
echo "\n<table class='frame' width='100%' align='center'>";

if($enter_tests == TRUE){
    echo form_hidden('enter_tests', $enter_tests);
    echo form_hidden('lab_package_id', $lab_package_id);
    echo form_hidden('supplier_id', $supplier_id);
    echo "\n<tr>";
        echo "\n<td width='25%'>Lab Package <font color='red'>*</font></td>";
        echo "<td colspan='2' class='red'>";   
        echo $package_code." - ".$package_name;
        echo "</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td width='25%'>Supplier</td>";
        echo "\n<td colspan='2' class='red'>";
        echo $acc_no." - ".$supplier_name;
        echo "</td>";
    echo "</tr>";
} else {
    echo "\n<tr>";
        echo "\n<td width='25%'>Lab Package <font color='red'>*</font></td>";
        echo "<td colspan='2' class='red'>";   
        echo "\n<select name='lab_package_id' class='normal' onchange='javascript:selectLabPackage()' id='lab_package_id'>";
        //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:selectDiagnosisCategory()'>";
            echo "\n<option label='' value='0' selected='selected'></option>";
            foreach($packages_list as $package_item)
            {
                echo "\n<option value='".rtrim($package_item['lab_package_id'])."'";
                echo ($lab_package_id == rtrim($package_item['lab_package_id']) ? " selected='selected'" : "");
                echo ">".$package_item['package_code']." - ".$package_item['package_name']."</option>";
            }
            echo "</select>";
        echo "</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td width='25%'>Supplier</td>";
        echo "\n<td colspan='2' class='red'>";
            echo "\n<select name='supplier_id' class='normal' onchange='javascript:select_one_package()' id='supplier_id'>";
                //echo "\n<option value='' >Please select one</option>";
                foreach($supplier_list as $supplier)
                {
	                echo "\n<option value='".$supplier['supplier_id']."' ";
                    if(isset($supplier_id)) {
                        echo ($supplier_id==$supplier['supplier_id'] ? " selected='selected'" : "");
                    }
                    echo ">[".$supplier['acc_no']."] &nbsp;&nbsp;&nbsp;".$supplier['supplier_name']."</option>";
                } //foreach
            echo "</select>";
        echo "</td>";
    echo "</tr>";
} //endif($enter_tests == TRUE)

echo "\n<tr>";
    echo "<td width='25%'>Sample required</td>";
    echo "<td><div id='one_package'></div>";
    if(isset($num_of_results)){
        if($num_of_results > 0){
            echo $results_info[0]['sample_required'];
        } else {
            echo "N/A"; //$num_of_results = 0
        }
    } else {
        if($num_of_tests > 0){
            echo $package_info[0]['sample_required'];
        } else {
            echo "N/A";
        }  //endif($num_of_tests > 0)
    }  //endif($num_of_results > 0)
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Specimen Collection Date</td><td>";
echo form_error('sample_date');
echo "<input type='text' name='sample_date' value='".set_value('sample_date',$sample_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Specimen Collection Time</td><td>";
echo form_error('sample_time');
echo "<input type='text' name='sample_time' value='".set_value('sample_time',$sample_time)."' size='8' /> hh:mm</td></tr>";

echo "\n<tr>";
    echo "<td width='25%'>Fasting</td>";
    echo "\n<td>";
        /*
        echo "<select class='normal' name='fasting'>";          
            echo "\n<option value='0' ".set_select('fasting','Choose').">Choose</option>";
            echo "\n<option value='1' ".set_select('fasting','1').">Yes</option>";
            echo "\n<option value='0' ".set_select('fasting','0').">No</option>";
        echo "\n</select>";
        */
        echo "\n<select name='fasting'>";
            if($fasting == NULL){echo "\n<option value=''>Choose</option>";}
            echo "\n<option value=1 ".($fasting==1?' selected=\'selected\'':'').">Yes</option>";
            echo "\n<option value=0 ".($fasting==0?' selected=\'selected\'':'').">No</option>";
        echo "\n</select>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "<td width='25%'>Urgent</td>";
    echo "\n<td>";
        /*
        echo "<select class='normal' name='urgency'>";          
            echo "\n<option value='0' ".set_select('urgency','Choose').">Choose</option>";
            echo "\n<option value='1' ".set_select('urgency',1).">Yes</option>";
            echo "\n<option value='0' ".set_select('urgency',0).">No</option>";
        echo "\n</select>";
        */
        echo "\n<select name='urgency'>";
            if($urgency == NULL){echo "\n<option value=''>Choose</option>";}
            echo "\n<option value='1' ".($urgency==='1'?' selected=\'selected\'':'').">Yes</option>";
            echo "\n<option value='0' ".($urgency==='0'?' selected=\'selected\'':'').">No</option>";
        echo "\n</select>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Sample Ref.<font color='red'>*</font></td><td>";
echo form_error('sample_ref');
echo "<input type='text' name='sample_ref' value='".set_value('sample_ref',$sample_ref)."' size='20' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='remarks' id='diagnosis2' cols='50' rows='3'>".$remarks."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Summary Results</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='summary_result' id='summary_result' cols='50' rows='5'>".$summary_result."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";

//Block to reassign lab_package_results to lab package tests for rendering below.
if(isset($num_of_results)){
    if($num_of_results > 0 && $enter_tests==TRUE){
        $package_info = $results_info;
        $num_of_tests = $num_of_results;
    }
}

if(!isset($num_of_tests)){
    $num_of_tests = 0;
}

if($num_of_tests > 0 && $enter_tests==TRUE){
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
        echo "\n<tr>";
        echo "<td>".$test_item['test_code']."</td>";
        echo "<td><strong>".$test_item['loinc_num']."</strong></td>";
        echo "<td>".$test_item['test_name']."</td>";
        echo "\n<td><input type='text' name='".$varname_result."' value='".set_value($varname_result,$test_item[$varname_result])."' size='20' disabled='disabled' /></td>";
        echo "\n<td><input type='text' name='".$varname_normal."' value='".set_value($varname_normal,$test_item[$varname_normal])."' size='15' disabled='disabled' /></td>";
        echo "\n<td><input type='text' name='".$varname_remark."' value='".set_value($varname_remark,$test_item[$varname_remark])."' size='30' disabled='disabled' /></td>";
        echo "</tr>";
    }//endforeach;
    echo "</table>";
    echo "\n<input type='hidden' name='num_of_tests' value='".$num_of_tests."' />";

} else {

    echo "\n<input type='hidden' name='num_of_tests' value='0' />";
    if($lab_package_id <> "none"){
        echo "\n<br /><input type='checkbox' name='enter_tests' id='enter_tests' value='TRUE'";
        if($enter_tests == TRUE){
            echo " checked='checked'";
        }
        echo "\n /> Add Test Results Values. You may not change the Package for this lab order after that.<br />";
    } //endif($lab_package_id <> "none")

} //endif($num_of_tests > 0)

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_lab"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Lab Order' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";

?>
    <script  type="text/javascript">
        var $ = function (id) {
            return document.getElementById(id);
        }


        function selectLabPackage(){
            $("lab_form").status.value="Unfinished";
            $("supplier_id").selectedIndex = -1;
            $("one_package").selectedIndex = -1;
            $("diagnosis2").selectedIndex = -1;
            $("lab_form").submit.click();
        }


        function select_one_package(){
            $("lab_form").status.value="Unfinished";
            $("one_package").selectedIndex = -1;
            $("diagnosis2").selectedIndex = -1;
            $("lab_form").submit.click();
        }


        function deleteRecord($action, $name, $link){            
            if(confirm("Are you sure you want to " + $action + " this " + $name + " ?")){
                window.open($link, "_top");
            }
        }

      </script>


