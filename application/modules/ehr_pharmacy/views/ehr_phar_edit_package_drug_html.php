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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2012
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
    echo "\n<br />content_id=".$content_id;
    echo "\n<br />partner_clinic_id=".$partner_clinic_id;
    echo "\n</div>";
}

if(isset($breadcrumbs)){
    echo "\n<div id='breadcrumbs'>";
    echo $breadcrumbs;
    echo "</div>\n";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('phar_edit_package_drug_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<fieldset>";
echo "<legend>CURRENT PACKAGE CONTENT</legend>";
//echo anchor('ehr_pharmacy/phar_edit_package_drug/new_drug/new_drug/'.$drug_package_id, "<strong>Add New Drug</strong>");
//echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='100'>Dose</th>";
    echo "\n<th width='70'>Form</th>";
    echo "\n<th width='200'>Frequency</th>";
    echo "\n<th width='150'>Instruction</th>";
    echo "\n<th width='200'>Duration</th>";
    echo "\n<th width='150'>Total</th>";
    echo "\n<th width='200'>Remarks</th>";
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
        echo "\n<td valign='top'><strong>".$content_item['dose']."</strong></td>";
        echo "\n<td valign='top'>".$content_item['dose_form']."</td>";
        echo "\n<td valign='top'><strong>".$content_item['frequency']."</strong></td>";
        echo "\n<td valign='top'>".$content_item['instruction']."</td>";
        echo "\n<td valign='top'>for ".$content_item['dose_duration']." days</td>";
        echo "\n<td valign='top'>".$content_item['quantity']." ".$content_item['quantity_form']."</td>";
        echo "\n<td valign='top'>".$content_item['drug_remarks']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/phar_edit_package_drug/'.$form_purpose.'/'.$content_id.'/'.$drug_package_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('content_id', $content_id);
echo form_hidden('drug_package_id', $drug_package_id);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td width='200'>Package Name<font color='red'>*</font></td>";
//echo $package_info[0]['package_name']."</td></tr>";
echo "\n<td>".anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/phar_edit_drug_package/edit_package/'.$package_info[0]['drug_package_id'], $package_info[0]['package_name'])."</td></tr>";

echo "\n<tr><td>Package Code</td><td>";
echo $package_info[0]['package_code']."</td></tr>";

echo "\n<tr><td>Package Description</td><td>";
echo $package_info[0]['description']."</td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Drug Formulary<font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
    echo form_error('drug_formulary_id');
    echo "\n<div id='genericnames_select'>";
        echo "\n<select name='drug_formulary_id' class='normal' id='drug_formulary_id'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($formulary_list as $formulary_item)
            {
	            echo "\n<option value='".$formulary_item['drug_formulary_id']."' ";
                if(isset($init_drug_formulary_id)) {
                    echo ($init_drug_formulary_id==$formulary_item['drug_formulary_id'] ? " selected='selected'" : "");
                }
                echo ">".$formulary_item['generic_name']."&nbsp;[".$formulary_item['formulary_code']."]</option>";
            } //foreach
        echo "</select>";
    echo "</div>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "<td width='25%'>Trade Name</font></td>";
    echo "\n<td colspan='2' class='red'>";
    echo "\n<div id='tradenames_select'>";
        //echo "\n<select name='drug_code_id' class='normal' id='drug_code_id'>";
        echo "\n<select name='drug_code_id' class='normal' onchange='javascript:selectTradename()' id='tradename'>";
            echo "\n<option value='' >Some examples of this drug</option>";
            foreach($tradename_list as $tradename_item)
            {
	            echo "\n<option value='".$tradename_item['drug_code_id']."' ";
                if(isset($init_drug_code_id)) {
                    echo ($init_drug_code_id==$tradename_item['drug_code_id'] ? "selected='selected'" : "");
                }
                echo ">".$tradename_item['trade_name']."&nbsp;[".$tradename_item['drug_code']."]</option>";
            }
        echo "</select>";
    echo "</div>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Indication</td>";
    echo "\n<td>";
    echo "\n<input type='text' name='indication' value='".set_value('indication',$init_indication)."' size='70' />";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Dose<font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('dose');
    echo "\n<input type='text' name='dose' value='".set_value('dose',$init_dose)."' size='3' />";
    echo form_error('dose_form');
    echo "\n<span id='doseform'>";
    echo "\n<select name='dose_form' id='dose_form' class='normal'>";
        echo "\n<option label='' value='' >Please select one</option>";
        foreach($dose_forms as $packform_item)
        {
            echo "\n<option value='".rtrim($packform_item)."'";
            echo ($init_dose_form == rtrim($packform_item) ? " selected='selected'" : "");
            echo ">".$packform_item."</option>";
        }
    echo "</select>";
    echo "</span>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "<td width='25%'>Frequency<font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('frequency');
        echo "<select class='normal' name='frequency'>"; 
            echo "\n<option label='' value='' >Please select one</option>";
            foreach($dose_frequency as $frequency_item)
            {
                echo "\n<option value='".rtrim($frequency_item)."'";
                echo ($init_frequency == rtrim($frequency_item) ? " selected='selected'" : "");
                echo ">".$frequency_item."</option>";
            }
        echo "\n</select>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "<td width='25%' valign='top'>Instructions<font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('instruction');
        $instruction_inlist =   FALSE;
        echo "<select class='normal' name='instruction'>";          
            echo "\n<option label='' value='' >Please select one</option>";
            echo "\n<option value='before food' ";
                if($init_instruction ==  "before food"){
                    echo "selected='selected'";
                    $instruction_inlist =   TRUE;
                }
                echo ">before food</option>";
            echo "\n<option value='after food' ";
                if($init_instruction ==  "after food"){
                    echo "selected='selected'";
                    $instruction_inlist =   TRUE;
                }
                echo ">after food</option>";
            echo "\n<option value='as directed' ";
                if($init_instruction ==  "as directed"){
                    echo "selected='selected'";
                    $instruction_inlist =   TRUE;
                }
                echo ">as directed</option>";
            echo "\n<option value='as needed' ";
                if($init_instruction ==  "as needed"){
                    echo "selected='selected'";
                    $instruction_inlist =   TRUE;
                }
                echo ">as needed</option>";
            echo "\n<option value='apply locally' ";
                if($init_instruction ==  "apply locally"){
                    echo "selected='selected'";
                    $instruction_inlist =   TRUE;
                }
                echo ">apply locally</option>";
            echo "\n<option value='intra-vaginal' ";
                if($init_instruction ==  "intra-vaginal"){
                    echo "selected='selected'";
                    $instruction_inlist =   TRUE;
                }
                echo ">intra-vaginal</option>";
            echo "\n<option value='sub-lingual' ";
                if($init_instruction ==  "sub-lingual"){
                    echo "selected='selected'";
                    $instruction_inlist =   TRUE;
                }
                echo ">sub-lingual</option>";
        echo "\n</select> Or override select with";
    echo "\n<br />Other <input type='text' name='instruction_other' value='";
    if($instruction_inlist == FALSE){
        echo $init_instruction;
    }
    echo"' size=65' />";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td>Duration</td>";
    echo "\n<td>";
    echo form_error('dose_duration');
    echo "\n<input type='text' name='dose_duration' id='dose_duration' value='".set_value('dose_duration',$init_dose_duration)."' size='3' /> days";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td>Quantity</td>";
    echo "\n<td>";
    echo form_error('quantity');
    echo "\n<input type='text' name='quantity' value='".set_value('quantity',$init_quantity)."' size='3' />";
    echo "\n <span id='qty_doseform'>".$init_dose_form."</span>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td>Caution</td>";
    echo "\n<td>";
    echo "\n<input type='text' name='caution' value='".set_value('caution',$init_caution)."' size='70'/>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td id='level_two'>Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='drug_remarks'  rows='4' cols='50'>".set_value('drug_remarks',$init_drug_remarks)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";


echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Add/Edit Drug' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";

echo "\n<br />";

echo "\n\n<div id='knowledgebase_drug' class='episodeblock'>";
echo "\n<table>";
if(($init_drug_formulary_id <> "") && ($init_drug_formulary_id <> "none")) {
    echo "\n<tr>";
        echo "\n<td width='150'>Generic Name</td>";
        echo "\n<td>".$formulary_chosen['generic_name']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Indication</td>";
        echo "\n<td>".$formulary_chosen['indication']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Dosage</td>";
        echo "\n<td>".$formulary_chosen['dosage']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Contra Indication</td>";
        echo "\n<td valign='top'>".$formulary_chosen['contra_indication']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Precautions</td>";
        echo "\n<td>".$formulary_chosen['precautions']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Interactions</td>";
        echo "\n<td>".$formulary_chosen['interactions']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Adverse Reactions</td>";
        echo "\n<td valign='top'>".$formulary_chosen['adverse_reactions']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Formulary Code</td>";
        echo "\n<td>".$formulary_chosen['formulary_code']."</td>";
    echo "</tr>";
} else {
    echo "\n<tr>";
        echo "\n<td>Generic Drug Knowledgebase<br />&nbsp; </td>";
        echo "\n<td></td>";
    echo "</tr>";
} //endif($drug_formulary_id <> "")
echo "</table>";
echo "</div>"; //id='knowledgebase_drug'


// Set for AJAX calling
$siteurl_genericname    =   site_url()."/ehr_ajax/get_prescription_druggenericnames";
$siteurl_tradename    =   site_url()."/ehr_ajax/get_prescription_drugtradenames";
//echo $siteurl;
?>
<script  type="text/javascript">

    $(document).ready(function() {
        /*
        $('#drugsystem_select').delegate('select','change',function (){
            ajax_generic_name()}
            );
        */
        $('#genericnames_select').delegate('select','change',function (){
            ajax_trade_name()}
            );
        $('#doseform').delegate('select','change',function (){
            write_doseform()}
            );
        return false;
      })


    function ajax_trade_name() {
        var siteurl = "<?php echo $siteurl_tradename; ?>";
        var ajax_patient_id = "001";
        var ajax_drug_formulary_id = $('#drug_formulary_id').val();
        var data = 'ajax_patient_id='+ajax_patient_id+'&ajax_drug_formulary_id=' + ajax_drug_formulary_id;
        //alert(siteurl+' '+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            var multi_part  =   result.split("|=|");
            $('#tradenames_select').html(multi_part[0]);
            $('#knowledgebase_drug').html(multi_part[1]);
            $('#allergic_reactions').html(multi_part[2]);
          }
        }
    )}


    function write_doseform() {
        var qty_dose_form = $('#dose_form').val();
        //alert(qty_dose_form);
        $('#qty_doseform').html(qty_dose_form);

    }


</script>



