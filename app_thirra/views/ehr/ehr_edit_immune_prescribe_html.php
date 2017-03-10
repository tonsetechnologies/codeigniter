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
 * Portions created by the Initial Developer are Copyright (C) 2010
 * the Initial Developer and IDRC. All Rights Reserved.
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
    echo "\n<br />print_r(vaccination_table)=<br />";
		print_r($vaccination_table);
    echo "\n<br />print_r(vaccines_list)=<br />";
		print_r($vaccines_list);
    echo "\n<br />print_r(this_vaccine)=<br />";
		print_r($this_vaccine);
    echo "\n<br />print_r(prescribe_list)=<br />";
		print_r($prescribe_list);
    echo "\n<br />print_r(formulary_list)=<br />";
		print_r($formulary_list);
	echo '</pre>';
    echo "\n<br />vaccine_id=".$vaccine_id;
    echo "\n<br />prescribe_id=".$prescribe_id;
    echo "\n<br />drug_system=".$drug_system;
    echo "\n<br />drug_formulary_id=".$drug_formulary_id;
    echo "\n<br />generic_name=".$generic_name;
    echo "\n<br />drug_code_id=".$drug_code_id;
    echo "\n<br />drug_batch=".$drug_batch;
    echo "\n<br />dose=".$dose;
    echo "\n<br />dose_form=".$dose_form;
    echo "\n<br />frequency=".$frequency;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_immune_prescribe_html_title')."</h1></div>";

echo "\n\n<div id='current_prescriptions' class='episodeblock'>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>Generic Name</th>";
    echo "\n<th>Dose</th>";
    echo "\n<th></th>";
    echo "\n<th>Frequency</th>";
    echo "\n<th>Indication</th>";
echo "</tr>";
foreach ($prescribe_list as $prescribe_item){
    echo "\n<tr>";
    echo "<td>".anchor('ehr_consult_prescribe/edit_immune_prescribe/edit_prescribe/'.$patient_id.'/'.$summary_id.'/'.$prescribe_item['queue_id'], $prescribe_item['generic_name'])."</td>";
    echo "<td>".$prescribe_item['dose']."</td>";
    echo "<td>".$prescribe_item['dose_form']."</td>";
    echo "<td>".$prescribe_item['frequency']."</td>";
    echo "<td>".$prescribe_item['indication']."</td>";
    echo "</tr>";
}//endforeach;
echo "\n</table>";
echo "</div>\n"; //id='current_prescriptions'


$attributes =   array('class' => 'select_form', 'id' => 'prescription_form');
echo form_open('ehr_consult_prescribe/edit_immune_prescribe/new_immune/'.$patient_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('vaccine_id', $vaccine_id);
echo form_hidden('prescribe_id', $prescribe_id);

echo form_error('vaccine');
$total_columns      =   count($vaccination_table);
echo "\n<table border='1' class='line'>";
echo "\n<tr>";
    echo "<td></td>";
    echo "<th colspan='".$total_columns."' align='center'>Month</th>";
echo "\n<tr>";
echo "<tr>";
    echo "<th>Vaccine</th>";
for($i=0; $i < $total_columns; $i++){
    $current_column =   $i;
    $age_column     =   $vaccination_table[$i];
    echo "\n<th width='20'>&nbsp;&nbsp;&nbsp;&nbsp;".$vaccination_table[$i]."&nbsp;&nbsp;&nbsp;&nbsp;</th>";
}
echo "\n<tr>";

$previous_vaccine   =   "";
$previous_column    =   $total_columns;
foreach($vaccines_list as $vaccine){
    if($previous_vaccine <> $vaccine['vaccine']){
        $columns_leftover   =   $total_columns - $previous_column - 1;
        if($columns_leftover < 0){
            $columns_leftover = 0;
        }
        echo str_repeat("<td>&nbsp;</td>",$columns_leftover);
        echo "\n</tr><tr>";
            echo "\n<td>".$vaccine['vaccine_short'];
            echo "</td>";
        $previous_column = -1;
    }

    for($i=0; $i < count($vaccination_table); $i++){
        //$current_column =   0;
        $current_column =   $i;
        $age_column     =   $vaccination_table[$i];
        if($current_column > $previous_column){
            if($vaccine['age_group'] == $age_column){
                if(isset($vaccine['date'])){
                    if($summary_id == $vaccine['session_id']){
                        echo "\n\t<td bgcolor='SpringGreen'>";
                    } else {
                        echo "\n\t<td bgcolor='RoyalBlue'>";
                    }
                    echo $vaccine['date'];
                } else {
                    if($vaccine_id == trim($vaccine['immunisation_id'])){
                        echo "\n\t<td bgcolor='orange'>";
                    } else {
                        echo "\n\t<td bgcolor='yellow'>";
                    }
                    //echo "\n<input type='radio' name='immunisation_id' value='".trim($vaccine['immunisation_id'])."' ".set_radio('immunisation_id','immunisation_id',($init_immunisation_id==' '?TRUE:FALSE))." >Choose</input>";
                }
                echo "\n\t<br />".$vaccine['dose'];
                if($debug_mode){
                    echo "\n<br />".$vaccine['vaccine'];
                    echo " A=".$vaccine['age_group'];
                    echo " S=".$vaccine['immunisation_sort'];
                    echo " AC=".$age_column;
                    echo " C=".$current_column;
                    echo " PV=".$previous_vaccine;
                }
                echo "</td>";;
                $previous_column    = $current_column;
                $previous_vaccine   = $vaccine['vaccine'];
                break;//continue;
            } else {
                echo "\n\t<td>&nbsp;</td>";
            } //endif($vaccine['age_group'] == $age_column)
        } else {
            // do nothing
        } //endif($current_column > $previous_column)
    } //endfor($i=0; $i <= count($vaccination_table); $i++)



    $previous_vaccine   = $vaccine['vaccine']; // no longer touch due to continue
} //endforeach($vaccines_list as $vaccine)
echo "\n</table><br />";

echo "\n<table width='100%' align='center'>";
echo "\n<tr>";
    echo "<td width='50' bgcolor='RoyalBlue'>&nbsp;</td>";
    echo "<td>Previously administered</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td bgcolor='SpringGreen'>&nbsp;</td>";
    echo "<td>Current session</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td bgcolor='yellow'>&nbsp;</td>";
    echo "<td>Not administered</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td bgcolor='orange'>&nbsp;</td>";
    echo "<td>Current selection</td>";
echo "</tr>";
echo "\n</table><br />";

echo "\n<table class='frame' width='100%' align='center'>";
echo "<tr><td><b>Prescription</b></td></tr>";
echo "\n<tr>";
    echo "<td width='25%' valign='top'>Vaccination Note</td>";
    echo "\n<td>";
        echo form_error('vaccine_notes');
        echo "<textarea class='normal' name='vaccine_notes' cols='40' rows='4'>".set_value('vaccine_notes',$vaccine_notes)."</textarea>";
    echo "</td>";
echo "</tr>";

echo "<tr>";
    echo "\n<td width='25%'>Vaccine <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='drug_system' class='normal' onchange='javascript:selectDrugSystem()' id='drug_system'>";
        //echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($this_vaccine as $system_item)
        {
            echo "\n\t<option label='".$system_item['vaccine']."' value='".$system_item['vaccine']."'";
            echo " selected='selected'";
            //echo ($drug_system == $system_item['vaccine'] ? " selected='selected'" : "");
            echo ">".$system_item['vaccine']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Drug Formulary<font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
    echo "\n<div id='genericnames_select'>";
        echo "\n<select name='drug_formulary_id' class='normal'  id='drug_formulary_id'>";
        //echo "\n<select name='drug_formulary_id' class='normal' onchange='javascript:selectDrugFormulary()' id='drug_formulary_id'>";
            echo "\n\t<option value='' >Please select one</option>";
            foreach($formulary_list as $formulary_item)
            {
	            echo "\n\t<option value='".$formulary_item['drug_formulary_id']."' ";
                if(isset($drug_formulary_id)) {
                    echo ($drug_formulary_id==$formulary_item['drug_formulary_id'] ? " selected='selected'" : "");
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
        echo "\n<select name='drug_code_id' class='normal' id='tradename'>";
        //echo "\n<select name='drug_code_id' class='normal' onchange='javascript:selectTradename()' id='tradename'>";
            echo "\n<option value='' >Some examples of this drug</option>";
            foreach($tradename_list as $tradename_item)
            {
	            echo "\n<option value='".$tradename_item['drug_code_id']."' ";
                if(isset($drug_code_id)) {
                    echo ($drug_code_id==$tradename_item['drug_code_id'] ? "selected='selected'" : "");
                }
                echo ">".$tradename_item['trade_name']."&nbsp;[".$tradename_item['drug_code']."]</option>";
            }
        echo "</select>";
    echo "</div>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Batch</td>";
    echo "\n<td colspan='2'>";
        echo "<select name='drug_batch' class='normal' id='drug_batch'>";
        if(count($batch_list) > 0) {
            foreach($batch_list as $batch_item) 
            {
	            echo "\n<option value='".$batch_item['dcode2ext_code']."'>[".$batch_item['dcode2ext_code']."] &nbsp;&nbsp;&nbsp;".$batch_item['full_title']."</option>";
            }
        } else {
            echo "\n<option value='' selected='selected'>Not applicable</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Indication</td>";
    echo "\n<td>";
    echo "\n<input type='text' name='indication' value='".set_value('indication',$indication)."' size='70' />";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Dose<font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('dose');
    echo "\n<input type='text' name='dose' value='".set_value('dose',$dose)."' size='3' />";
    echo "\n<select class='normal' name='dose_form'>";          
        echo "\n\t<option value='amps' ".set_select('dose_form','amps').">amps</option>";
        echo "\n\t<option value='vial(s)' ".set_select('dose_form','vial(s)').">vial(s)</option>";
        echo "\n\t<option value='tablet(s)' ".set_select('dose_form','tablet(s)').">tablet(s)</option>";
        echo "\n\t<option value='capsule(s)' ".set_select('dose_form','capsule(s)').">capsule(s)</option>";
        echo "\n\t<option value='ml' ".set_select('dose_form','ml').">ml</option>";
        echo "\n\t<option value='g' ".set_select('dose_form','g').">g</option>";
        echo "\n\t<option value='suppository' ".set_select('dose_form','suppository').">suppository</option>";
        echo "\n\t<option value='pessary' ".set_select('dose_form','pessary').">pessary</option>";
        echo "\n\t<option value='caplet(s)' ".set_select('dose_form','caplet(s)').">caplet(s)</option>";
    echo "\n</select>";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td width='25%'>Frequency<font color='red'>*</font></td>";
    echo "\n<td>";
        echo "<select class='normal' name='frequency'>";          
            echo "\n\t<option value='stat' ".set_select('frequency','stat').">stat</option>";
            echo "\n\t<option value='bid' ".set_select('frequency','bid').">bid</option>";
            echo "\n\t<option value='od' ".set_select('frequency','od').">od</option>";
            echo "\n\t<option value='om' ".set_select('frequency','om').">om</option>";
            echo "\n\t<option value='on' ".set_select('frequency','on').">on</option>";
            echo "\n\t<option value='prn' ".set_select('frequency','prn').">prn</option>";
            echo "\n\t<option value='tds' ".set_select('frequency','tds').">tds</option>";
            echo "\n\t<option value='qid' ".set_select('frequency','qid').">qid</option>";
            echo "\n\t<option value='5 times a day' ".set_select('frequency','5 times a day').">5 times a day</option>";
            echo "\n\t<option value='6 times a day' ".set_select('frequency','6 times a day').">6 times a day</option>";
            echo "\n\t<option value='Q4H' ".set_select('frequency','Q4H').">Q4H</option>";
            echo "\n\t<option value='Q5H' ".set_select('frequency','Q5H').">Q5H</option>";
            echo "\n\t<option value='Q6H' ".set_select('frequency','Q6H').">Q6H</option>";
            echo "\n\t<option value='Q8H' ".set_select('frequency','Q8H').">Q8H</option>";
            echo "\n\t<option value='Q12H' ".set_select('frequency','Q12H').">Q12H</option>";
        echo "\n</select>";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td width='25%'>Instructions<font color='red'>*</font></td>";
    echo "\n<td>";
        echo "<select class='normal' name='instruction'>";          
            echo "\n\t<option value='as directed' ".set_select('instruction','as directed').">as directed</option>";
            echo "\n\t<option value='before food' ".set_select('instruction','before food').">before food</option>";
            echo "\n\t<option value='after food' ".set_select('instruction','after food').">after food</option>";
            echo "\n\t<option value='as needed' ".set_select('instruction','as needed').">as needed</option>";
            echo "\n\t<option value='apply locally' ".set_select('instruction','apply locally').">apply locally</option>";
            echo "\n\t<option value='intra-vaginal' ".set_select('instruction','intra-vaginal').">intra-vaginal</option>";
            echo "\n\t<option value='sub-lingual' ".set_select('instruction','sub-lingual').">sub-lingual</option>";
        echo "\n</select>";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Quantity</td>";
    echo "\n<td>";
    echo form_error('quantity');
    echo "\n<input type='text' name='quantity' value='".set_value('quantity',$quantity)."' size='3' />";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Caution</td>";
    echo "\n<td>";
    echo "\n<input type='text' name='caution' value='".set_value('caution',$caution)."' size='70'/>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Add Prescription' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";

echo "\n\n<div id='knowledgebase_drug' class='episodeblock'>";
echo "\n<table>";
if($drug_formulary_id <> "") {
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
/*
var $ = function (id) {
    return document.getElementById(id);
}
*/

    $(document).ready(function() {
      /* Not working yet
        $('#drug_system').change(function (){
            ajax_generic_name()}
        );
      $('#drug_formulary_id').change(function (){
            ajax_trade_name()}
        );
        */
      $('#drugsystem_select').delegate('select','change',function (){
            ajax_generic_name()}
        );
      $('#genericnames_select').delegate('select','change',function (){
            ajax_trade_name()}
        );
      $('#doseform').delegate('select','change',function (){
            write_doseform()}
        );
        return false;
      })


    function ajax_generic_name() {
        var siteurl = "<?php echo $siteurl_genericname; ?>";
        var ajax_drug_system = $('#drug_system').val();
        var data = 'ajax_drug_system=' + ajax_drug_system;
        //alert(siteurl+' '+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            $('#genericnames_select').html(result);
          }
        }
    )}


    function ajax_trade_name() {
        var siteurl = "<?php echo $siteurl_tradename; ?>";
        //var drug_system = "<?php echo $drug_system; ?>";
        //var siteurl = $('.siteurl').val();
        var ajax_patient_id = "<?php echo $patient_id; ?>";
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


// Old methods to create cascading dynamic drop down lists

function selectDrugSystem(){
    document.getElementById("prescription_form").status.value="Unfinished";
    document.getElementById("drug_formulary_id").selectedIndex = -1;
    document.getElementById("tradename").selectedIndex = -1;
    document.getElementById("drug_batch").selectedIndex = -1;
    document.getElementById("prescription_form").submit.click();
}


function selectDrugFormulary(){
    document.getElementById("prescription_form").status.value="Unfinished";
    document.getElementById("tradename").selectedIndex = -1;
    document.getElementById("drug_batch").selectedIndex = -1;
    document.getElementById("prescription_form").submit.click();
}

 function selectTradename()
 {
    document.getElementById("prescription_form").status.value="Unfinished";
    document.getElementById("drug_batch").selectedIndex = -1;
    document.getElementById("prescription_form").submit.click();
 }
</script>


