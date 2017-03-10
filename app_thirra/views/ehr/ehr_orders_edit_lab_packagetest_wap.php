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
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(packagetest_info)=<br />";
		print_r($packagetest_info);
    echo "\n<br />print_r(tests_list)=<br />";
		print_r($tests_list);
    echo "\n<br />print_r(loinc_class)=<br />";
		print_r($loinc_class);
    echo "\n<br />print_r(loinc_list)=<br />";
		print_r($loinc_list);
    echo "\n<br />print_r(package_info)=<br />";
		print_r($package_info);
	echo '</pre>';
    echo "\n<br />lab_package_id=".$lab_package_id;
    echo "\n<br />lab_package_test_id=".$lab_package_test_id;
    echo "\n<br />loinc_class_name=".$loinc_class_name;
    echo "\n<br />num_of_tests=".$num_of_tests;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('orders_edit_lab_packagetest_html_title')."</h1></div>";

$attributes =   array('class' => 'select_form', 'id' => 'packagetest_form');
echo form_open('ehr_orders/orders_edit_lab_packagetest/'.$form_purpose.'/'.$lab_package_id.'/'.$lab_package_test_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('lab_package_id', $lab_package_id);
echo form_hidden('lab_package_test_id', $lab_package_test_id);
echo form_hidden('num_of_tests', $num_of_tests);
echo form_hidden('supplier_id', $package_info[0]['supplier_id']);

echo "\n<table class='header' width='100%' align='center'>";
echo "<tr><td><b>Lab Package Test</b></td></tr>";
echo "</table>";
echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Lab Package Name</td><td><strong>";
echo $package_info[0]['package_name']."</strong></td><tr>";

echo "\n<tr><td>Lab Package Code</td><td>";
echo $package_info[0]['package_code']."</td><tr>";

echo "\n<tr><td>Package Description</td><td>";
echo $package_info[0]['description']."</td><tr>";

echo "\n<tr><td>Test Name <font color='red'>*</font></td><td>";
echo form_error('test_name');
echo "<input type='text' name='test_name' value='".set_value('test_name',$test_name)."' size='40' /></td></tr>";

echo "\n<tr><td>Test Code <font color='red'>*</font></td><td>";
echo form_error('test_code');
echo "<input type='text' name='test_code' value='".set_value('test_code',$test_code)."' size='20' /></td></tr>";

echo "\n<tr><td>Sort Order <font color='red'>*</font></td><td>";
echo form_error('sort_test');
echo "<input type='text' name='sort_test' value='".set_value('sort_test',$sort_test)."' size='4' /></td></tr>";

echo "\n<tr><td>Normal Adult Range</td><td>";
echo form_error('normal_adult');
echo "<input type='text' name='normal_adult' value='".set_value('normal_adult',$normal_adult)."' size='20' /></td></tr>";

echo "\n<tr><td>Normal Child Range</td><td>";
echo form_error('normal_child');
echo "<input type='text' name='normal_child' value='".set_value('normal_child',$normal_child)."' size='20' /></td></tr>";

echo "\n<tr><td>Normal Infant Range</td><td>";
echo form_error('normal_infant');
echo "<input type='text' name='normal_infant' value='".set_value('normal_infant',$normal_infant)."' size='20' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' valign='top'>Test Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='test_remarks' id='test_remarks' cols='50' rows='3'>".$test_remarks."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>LOINC Class <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='loinc_class_name' class='normal' onchange='javascript:select_loinc_class()' id='loinc_class_name'>";
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:selectDiagnosisCategory()'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($loinc_class as $class_item)
        {
            echo "\n<option value='".rtrim($class_item['class_name'])."'";
            echo ($loinc_class_name == rtrim($class_item['class_name']) ? " selected='selected'" : "");
            echo ">".$class_item['class_group']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>LOINC Code <font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='loinc_num' class='normal' onchange='javascript:select_LOINC()' id='loinc_num'>";
            //echo "\n<option value='' >Please select one</option>";
            foreach($loinc_list as $loinc_item)
            {
	            echo "\n<option value='".$loinc_item['loinc_num']."' ";
                if(isset($loinc_num)) {
                    echo ($loinc_num==$loinc_item['loinc_num'] ? " selected='selected'" : "");
                }
                echo ">".$loinc_item['component']." &nbsp;&nbsp;[".$loinc_item['loinc_num']."].</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n</table>";
echo "\n<div id='one_package'></div>";
echo "\n<div id='one_holder'></div>";
echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_packagetest"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Lab Package Test' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";

echo "\nList of test(s) in this package";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>Test Code</th>";
    echo "\n<th>LOINC</th>";
    echo "\n<th>Test Name</th>";
    echo "\n<th>Result</th>";
    echo "\n<th>Normal Adult</th>";
    echo "\n<th>Remarks</th>";
echo "</tr>";
if($num_of_tests > 0){
    $num_of_tests    = 0;
    foreach ($package_info as $test_item){
        $num_of_tests++;
        $varname_result =   "test_result_".$num_of_tests;
        $varname_normal =   "test_normal_".$num_of_tests;
        $varname_remark =   "test_remark_".$num_of_tests;
        echo "\n<tr>";
        echo "<td>".$test_item['test_code']."</td>";
        echo "<td><strong>".$test_item['loinc_num']."</strong></td>";
        echo "<td>".anchor('ehr_orders/orders_edit_lab_packagetest/edit_packagetest/'.$lab_package_id.'/'.$test_item['lab_package_test_id'], $test_item['test_name'])."</td>";
        echo "<td>".$test_item['normal_adult']."</td>";
        echo "</tr>";
    }//endforeach;
    echo "\n</table>";
    echo "\n<input type='hidden' name='num_of_tests' value='".$num_of_tests."' />";
} else {
    echo "\n<tr><td>&nbsp;None </td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
    echo "\n</table>";
    echo "\n<input type='hidden' name='num_of_tests' value='0' />";
}


?>
    <script  type="text/javascript">
        var $ = function (id) {
            return document.getElementById(id);
        }

        function select_loinc_class(){
            $("packagetest_form").status.value="Unfinished";
            $("loinc_num").selectedIndex = -1;
            $("one_package").selectedIndex = -1;
            $("one_holder").selectedIndex = -1;
            $("packagetest_form").submit.click();
        }

        function select_LOINC(){
            $("packagetest_form").status.value="Unfinished";
            $("one_package").selectedIndex = -1;
            $("one_holder").selectedIndex = -1;
            $("packagetest_form").submit.click();
        }


      </script>


