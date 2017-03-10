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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2011
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
    echo "\n<br />print_r(package_info)=<br />";
		print_r($package_info);
    echo "\n<br />print_r(clinics_list)=<br />";
		print_r($clinics_list);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />drug_package_id=".$drug_package_id;
    echo "\n<br />referral_doctor_id=".$referral_doctor_id;
    echo "\n<br />partner_clinic_id=".$partner_clinic_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('phar_edit_drugs_package_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/phar_edit_drug_package/'.$form_purpose.'/'.$drug_package_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('drug_package_id', $drug_package_id);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td width='200'>Package Name<font color='red'>*</font></td><td>";
echo form_error('package_name');
echo "<input type='text' name='package_name' value='".set_value('package_name',$init_package_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Package Code</td><td>";
echo form_error('init_package_code');
echo "<input type='text' name='package_code' value='".set_value('package_code',$init_package_code)."' size='20' /></td></tr>";

echo "\n<tr><td>Description</td><td>";
echo form_error('init_description');
echo "<input type='text' name='description' value='".set_value('description',$init_description)."' size='100' /></td></tr>";

echo "\n<tr><td>Sort Order</td><td>";
echo form_error('init_package_sort');
echo "<input type='text' name='package_sort' value='".set_value('package_sort',$init_package_sort)."' size='5' /></td></tr>";

echo "\n<tr>";
    echo "\n<td id='level_two'>Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='package_remarks'  rows='4' cols='50'>".set_value('package_remarks',$init_package_remarks)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "<tr>";
    echo "\n<td >Clinic</td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='location_id' class='normal' id='level_one'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($clinics_list as $clinic_item)
        {
            echo "\n<option value='".$clinic_item['clinic_info_id']."'";
            //echo "\n<option label='".$clinic_item['clinic_info_id']."' value='".$clinic_item['clinic_info_id']."'";
            echo ($init_location_id == $clinic_item['clinic_info_id'] ? " selected='selected'" : "");
            echo ">".$clinic_item['clinic_name']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Active</td><td>";
echo form_error('package_active');
    echo "\n<select name='package_active'>";
    if($package_active == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='TRUE' ".($init_package_active==TRUE ?' selected=\'selected\'':'').">Active</option>";
    echo "\n<option value='FALSE' ".($init_package_active==FALSE ?' selected=\'selected\'':'').">Inactive</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Add/Edit Package' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";

echo "\n<fieldset>";
echo "<legend>PACKAGE CONTENT</legend>";
if($form_purpose <> 'new_package'){
echo anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/phar_edit_package_drug/new_drug/new_drug/'.$drug_package_id, "<strong>Add New Drug</strong>");
} else {
    echo "<strong>Add New Drug</strong>";
}
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='100'>Dose</th>";
    echo "\n<th width='70'>Form</th>";
    echo "\n<th width='200'>Frequency</th>";
    echo "\n<th width='150'>Instruction</th>";
    echo "\n<th width='200'>Duration</th>";
    echo "\n<th width='150'>Total</th>";
echo "</tr>";
if(isset($contents_list)){
    $rownum = 1;
    foreach ($contents_list as $content_item){
        echo "\n<tr>";
        echo "\n<td valign='top'>".$rownum.".</td>";
        echo "\n<td valign='top' colspan='6'>".anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/phar_edit_package_drug/edit_drug/'.$content_item['content_id'].'/'.$content_item['drug_package_id'], $content_item['generic_name'])."</td>";
        $delete_link    =   base_url()."index.php/ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/phar_delete_package_drug/".$drug_package_id."/".$content_item['content_id'];
        echo "\n<td><a href=\"javascript:deleteRecord('remove','Drug:".$content_item['generic_name']."','".$delete_link ."');\">delete</a>";
        echo "</tr><tr>";
        echo "<td></td>";
        echo "<td>Indication</td>";
        echo "<td valign='top' colspan='6'>:&nbsp;&nbsp;";
        echo $content_item['indication']."</td>";
        echo "</tr><tr>";
        echo "<td></td>";
        echo "<td>Caution</td>";
        echo "<td valign='top' colspan='6'>:&nbsp;&nbsp;";
        echo $content_item['caution']."</td>";
        echo "</tr><tr>";
        echo "<td></td>";
        echo "<td valign='top'>Remarks</td>";
        echo "<td valign='top' colspan='6'>:&nbsp;&nbsp;";
        echo $content_item['drug_remarks']."</td>";
        echo "</tr><tr>";
        echo "<td></td>";
        echo "\n<td valign='top'><strong>".$content_item['dose']."</strong></td>";
        echo "\n<td valign='top'>".$content_item['dose_form']."</td>";
        echo "\n<td valign='top'><strong>".$content_item['frequency']."</strong></td>";
        echo "\n<td valign='top'>".$content_item['instruction']."</td>";
        echo "\n<td valign='top'>for ".$content_item['dose_duration']." days</td>";
        echo "\n<td valign='top'>".$content_item['quantity']." ".$content_item['quantity_form']."</td>";
        echo "\n<tr><td colspan='8'><hr /></td></tr>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";

?>
<script  type="text/javascript">

    function deleteRecord($action, $name, $link){            
        if(confirm("Are you sure you want to " + $action + " this " + $name + " ?")){
            window.open($link, "_top");
        }
    }

</script>


