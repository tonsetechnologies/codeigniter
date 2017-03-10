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

echo "\n\n<div id='content'>";
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

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_drug_package_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<fieldset>";
echo "<legend>ALLERGIES RECORDED</legend>";
//echo "<strong>Add New History</strong>";
echo "\n<br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    //echo "\n<th width='110'>Formulary Code</th>";
    echo "\n<th width='350'>Generic Name</th>";
    echo "\n<th width='300'>Reaction</th>";
    echo "\n<th width='150'>Remarks</th>";
    echo "\n<th width='150'>Active</th>";
echo "</tr>";
if(count($allergy_list) > 0){
    $rownum = 1;
    foreach ($allergy_list as $allergy_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        //echo "\n<td>".$allergy_item['drug_formulary']."</td>";
        //echo "\n<td>".anchor('ehr_individual/edit_drug_allergy/edit_allergy/'.$patient_id.'/'.$allergy_item['patient_drug_allergy_id'], $allergy_item['drug_formulary']."</td>");
        echo "\n<td bgcolor='red'><strong><font color='white'>".$allergy_item['generic_name']."</font></strong></td>";
        echo "\n<td>".$allergy_item['reaction']."</td>";
        echo "\n<td>".$allergy_item['added_remarks']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
} else {
    echo "\n<tr>";
    echo "\n<td></td>";
    echo "\n<td align='center'>None</td>";
    echo "\n</tr>";

}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


echo "\n\n<div id='current_prescriptions' class='episodeblock'>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th>Generic Name</th>";
    echo "\n<th>Dose</th>";
    echo "\n<th></th>";
    echo "\n<th>Frequency</th>";
    echo "\n<th>Quantity</th>";
    echo "\n<th>Indication</th>";
echo "</tr>";
$rownum =   1;
foreach ($prescribe_list as $prescribe_item){
    echo "\n<tr>";
    echo "<td valign='top'>".$rownum.".</td>";
    echo "<td>".anchor('ehr_consult_prescribe/edit_prescription/edit_prescribe/'.$patient_id.'/'.$summary_id.'/'.$prescribe_item['queue_id'], $prescribe_item['generic_name'])."</td>";
    echo "<td>".$prescribe_item['dose']."</td>";
    echo "<td>".$prescribe_item['dose_form']."</td>";
    echo "<td><strong>".$prescribe_item['frequency']."</strong></td>";
    echo "<td>".$prescribe_item['quantity']." ".$prescribe_item['quantity_form']."</td>";
    echo "<td>".$prescribe_item['indication']."</td>";
    $delete_link    =   base_url()."index.php/ehr_consult_prescribe/consult_delete_prescription/".$patient_id."/".$summary_id."/".$prescribe_item['queue_id'];
    echo "\n<td><a href=\"javascript:deleteRecord('remove','Drug:".$prescribe_item['generic_name']."','".$delete_link ."');\">delete</a>";
    //echo "\n<td>".anchor('ehr_consult_prescribe/consult_delete_prescription/'.$patient_id.'/'.$summary_id.'/'.$prescribe_item['queue_id'], 'delete')."</td>";
    echo "</tr>";
    $rownum++;
}//endforeach;
echo "</table>";
echo "</div>\n"; //id='current_prescriptions'


echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td width='200'>Package Name</td><td>";
echo $init_package_name."</td></tr>";

echo "\n<tr><td>Package Code</td><td>";
echo $init_package_code."</td></tr>";

echo "\n<tr><td>Description</td><td>";
echo $init_description."</td></tr>";

echo "\n<tr>";
    echo "\n<td id='level_two'>Remarks</td>";
    echo "\n<td>";
    echo $init_package_remarks;
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";


$attributes =   array('class' => 'select_form', 'id' => 'prescription_form');
echo form_open('ehr_consult_prescribe/edit_prescribe_package/'.$form_purpose.'/'.$drug_package_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('drug_package_id', $drug_package_id);

echo "\n<fieldset>";
echo "<legend>PACKAGE CONTENT</legend>";
//echo anchor('ehr_pharmacy/phar_edit_package_drug/new_drug/new_drug/'.$drug_package_id, "<strong>Add New Drug</strong>");
//echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th></th>";
    echo "\n<th>No.</th>";
    echo "\n<th width='100'>Dose</th>";
    echo "\n<th width='70'>Form</th>";
    echo "\n<th width='220'>Frequency</th>";
    echo "\n<th width='150'>Instruction</th>";
    echo "\n<th width='200'>Duration</th>";
    echo "\n<th width='150'>Total</th>";
echo "</tr>";
if(isset($contents_list)){
    $rownum = 1;
    foreach ($contents_list as $content_item){
        echo form_hidden("drug_package_id_".$rownum, $content_item['drug_package_id']);
        echo "\n<tr>";
        echo "\n<td><input type='checkbox' name='drug_".$rownum."' id='drug_".$rownum."' value='".$content_item['content_id']."'";
        echo "\n checked='checked' /> </td>";
        echo "\n<td valign='top'>".$rownum.".</td>";
        echo "\n<td valign='top' colspan='6'><strong>".$content_item['generic_name']."</strong></td>";
        //echo "\n<td valign='top' colspan='6'>".anchor('ehr_pharmacy/phar_edit_package_drug/edit_drug/'.$content_item['content_id'].'/'.$content_item['drug_package_id'], $content_item['generic_name'])."</td>";
        echo "</tr><tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td valign='top'>Indication</td>";
        echo "<td valign='top' colspan='6'>:&nbsp;&nbsp;";
        echo "\n<input type='text' name='indication_".$rownum."' value='".$content_item['indication']."' size='70' />";
        //echo $content_item['indication'].
        echo "</td>";
        echo "</tr><tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td valign='top'>Caution</td>";
        echo "<td valign='top' colspan='6'>:&nbsp;&nbsp;";
        echo "\n<input type='text' name='caution_".$rownum."' value='".$content_item['caution']."' size='70'/>";
        //echo $content_item['caution'].
        echo "</td>";
        echo "</tr><tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td valign='top'>Remarks</td>";
        echo "<td valign='top' colspan='6'>:&nbsp;&nbsp;";
        echo $content_item['drug_remarks']."</td>";
        echo "</tr><tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "\n<td valign='top'><strong>";
        echo "\n<input type='text' name='dose_".$rownum."' value='".$content_item['dose']."' size='8' />";
        //$content_item['dose'].
        echo "</strong></td>";
        echo "\n<td valign='top'>".$content_item['dose_form']."</td>";
        echo "\n<td valign='top'><strong>".$content_item['frequency']."</strong></td>";
        echo "\n<td valign='top'>".$content_item['instruction']."</td>";
        echo "\n<td valign='top'>for ";
        //$content_item['dose_duration'].
        echo "\n<input type='text' name='dose_duration_".$rownum."' id='dose_duration' value='".$content_item['dose_duration']."' size='3' />";
        echo " days</td>";
        echo "\n<td valign='top'>";
        echo "\n<input type='text' name='quantity_".$rownum."' value='".$content_item['quantity']."' size='3' />";
        //.$content_item['quantity'].
        echo " ".$content_item['quantity_form']."</td>";
        echo "\n</tr>";
        echo "\n<tr><td colspan='9'><hr /></td></tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Prescribe Package' />";
echo "\n</center>";

echo form_hidden('drugs_count', $rownum);

echo "\n</form>";
echo "\n<br />";

?>
<script  type="text/javascript">

    function deleteRecord($action, $name, $link){            
        if(confirm("Are you sure you want to " + $action + " this " + $name + " ?")){
            window.open($link, "_top");
        }
    }

</script>


