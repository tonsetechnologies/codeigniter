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

$ideal_field_length = 25;

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(atc_info)=<br />";
		print_r($atc_info);
    echo "\n<br />print_r(formulary_info)=<br />";
		print_r($formulary_info);
    echo "\n<br />print_r(formulary_system)=<br />";
		print_r($formulary_system);
    echo "\n<br />print_r(drugcode_list)=<br />";
		print_r($drugcode_list);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />drug_formulary_id=".$drug_formulary_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'>\n<h1>".$this->lang->line('util_edit_drugformulary_html_title')."</h1></div>\n";


$attributes =   array('class' => 'select_form', 'id' => 'formulary_form');
echo form_open('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_edit_drugformulary/'.$form_purpose.'/'.$drug_formulary_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Formulary code <font color='red'>*</font></td><td>";
echo form_error('part_formulary_code');
echo "<span id='show_atc_code'>";
echo (!empty($init_atc_code) ? $init_atc_code : "ATC Code + ");
echo "</span>"; //id=show_atc_code
echo "<input type='text' name='part_formulary_code' value='".set_value('formulary_code',$init_part_formulary_code)."' size='".$drugformulary_length."' maxlength='".$drugformulary_length."' /> ".$drugformulary_length." characters</td></tr>";

echo "\n<tr>";
    echo "\n<td>ATC code <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo form_error('atc_code');
    echo "\n<div id='atc_select'>";
    echo "\n<select name='atc_code' id='atc_code' class='normal'>";
        echo "\n<option label='' value='' selected='selected'></option>";
        foreach($atc_list as $atc_item)
        {
            echo "\n<option value='".rtrim($atc_item['atc_code'])."'";
            echo ($init_atc_code == rtrim($atc_item['atc_code']) ? " selected='selected'" : "");
            echo ">".$atc_item['atc_code']." - ".$atc_item['atc_name']."</option>";
        }
        echo "</select>";
    echo "</div>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "<td valign='top'>ATC Pharmaco : Chemical</td>";
    echo "<td><div id='show_atc_info'>";
    echo $init_desc_pharmaco." <br /> ".$init_desc_chemical;
    echo "</div></td>";
echo "</tr>";

echo "\n<tr><td>Generic name <font color='red'>*</font></td><td>";
echo form_error('generic_name');
echo "<input type='text' name='generic_name' value='".set_value('generic_name',$init_generic_name)."' size='80' /></td></tr>";

/*
echo "\n<tr><td>System <font color='red'>*</font></td><td>";
echo form_error('formulary_system');
if(!empty($atc_info[0]['desc_anatomical'])){
    echo $atc_info[0]['desc_anatomical'];
}
//echo "<input type='text' name='formulary_system' value='".set_value('formulary_system',$init_formulary_system)."' size='80' />";
echo "\n<input type='hidden' name='formulary_system' value='".$atc_info[0]['desc_anatomical']."' />";
echo "</td></tr>";
*/

echo "\n<tr>";
    echo "\n<td>System <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo form_error('formulary_system');
    echo "\n<select name='formulary_system' class='normal'>";
        echo "\n<option label='' value='' selected='selected'></option>";
        foreach($formulary_system as $system_item)
        {
            echo "\n<option value='".rtrim($system_item['formulary_system'])."'";
            echo ($init_formulary_system == rtrim($system_item['formulary_system']) ? " selected='selected'" : "");
            echo ">".$system_item['formulary_system']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Commonly used</td><td>";
echo form_error('commonly_used');
echo "<input type='text' name='commonly_used' value='".set_value('commonly_used',$init_commonly_used)."' size='5' /> number</td></tr>";

echo "\n<tr><td>Example Trade name</td><td>";
echo form_error('trade_name');
echo "<input type='text' name='trade_name' value='".set_value('trade_name',$init_trade_name)."' size='80' /></td></tr>";

echo "\n<tr><td>USFDA pregnancy category</td><td>";
echo form_error('usfda_preg_cat');
echo "<input type='text' name='usfda_preg_cat' value='".set_value('usfda_preg_cat',$init_usfda_preg_cat)."' size='5' /></td></tr>";

echo "\n<tr><td>Poison category</td><td>";
echo form_error('poison_cat');
echo "<input type='text' name='poison_cat' value='".set_value('poison_cat',$init_poison_cat)."' size='5' /></td></tr>";

echo "\n<tr><td>Dose form</td><td>";
echo form_error('dose_form');
echo "<input type='text' name='dose_form' value='".set_value('dose_form',$init_dose_form)."' size='30' /></td></tr>";

echo "\n<tr><td valign='top'>Indication</td><td>";
echo form_error('indication');
//echo "<input type='text' name='indication' value='".set_value('indication',$init_indication)."' size='80' /></td></tr>";
echo "\n<textarea class='normal' name='indication' id='indication' cols='80' rows='4'>".$init_indication."</textarea></td></tr>";

echo "\n<tr><td valign='top'>Dosage</td><td>";
echo form_error('dosage');
//echo "<input type='text' name='dosage' value='".set_value('dosage',$init_dosage)."' size='80' /></td></tr>";
echo "\n<textarea class='normal' name='dosage' id='dosage' cols='80' rows='4'>".$init_dosage."</textarea></td></tr>";

echo "\n<tr><td valign='top'>Contra indication</td><td>";
echo form_error('contra_indication');
//echo "<input type='text' name='contra_indication' value='".set_value('contra_indication',$init_contra_indication)."' size='80' /></td></tr>";
echo "\n<textarea class='normal' name='contra_indication' id='contra_indication' cols='80' rows='4'>".$init_contra_indication."</textarea></td></tr>";

echo "\n<tr><td valign='top'>Precautions</td><td>";
echo form_error('precautions');
//echo "<input type='text' name='precautions' value='".set_value('precautions',$init_precautions)."' size='80' /></td></tr>";
echo "\n<textarea class='normal' name='precautions' id='precautions' cols='80' rows='4'>".$init_precautions."</textarea></td></tr>";

echo "\n<tr><td valign='top'>Interactions</td><td>";
echo form_error('interactions');
//echo "<input type='text' name='interactions' value='".set_value('interactions',$init_interactions)."' size='80' /></td></tr>";
echo "\n<textarea class='normal' name='interactions' id='interactions' cols='80' rows='4'>".$init_interactions."</textarea></td></tr>";

echo "\n<tr><td valign='top'>Adverse reactions</td><td>";
echo form_error('adverse_reactions');
//echo "<input type='text' name='adverse_reactions' value='".set_value('adverse_reactions',$init_adverse_reactions)."' size='80' /></td></tr>";
echo "\n<textarea class='normal' name='adverse_reactions' id='adverse_reactions' cols='80' rows='4'>".$init_adverse_reactions."</textarea></td></tr>";


echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_code"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Code' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='drug_formulary_id' value='".$drug_formulary_id."' />";

echo "\n</form>";
echo "\n<br />";

echo "\n<u>Drug codes in database</u>";
echo "\n<br />";
echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_edit_drugcode/new_drugcode/new_drugcode', "<strong>Add New Drug Code</strong>");
echo "\n<ol>";
foreach ($drugcode_list as $drugcode_item){
    echo "\n<li>".anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_edit_drugcode/edit_drugcode/'.$drugcode_item['drug_code_id'], $drugcode_item['trade_name'])."</li>";
}//endforeach;
echo "\n</ol>";


// Links for AJAX calls
//$siteurl_utilities    =   site_url()."/ehr_utilities/utilities_mgt";
$siteurl_atc    =   site_url()."/ehr_ajax/get_atc_info";
//echo $siteurl;
?>

<script type="text/javascript">
/*
    $(document).ready(function() {
        $('#utilities_link').delegate('div','click',function (){
            on_click_utilities()}
            );
        return false;
      })


    function on_click_utilities() {
        var siteurl = "<?php echo $siteurl_utilities; ?>";
        window.location =   siteurl;
    }
*/

    $(document).ready(function() {
        $('#atc_select').delegate('select','change',function (){
            ajax_atc_info()}
            );
        return false;
      })


    function ajax_atc_info() {
        var siteurl = "<?php echo $siteurl_atc; ?>";
        var ajax_atc_code = $('#atc_code').val();
        var data = 'ajax_atc_code=' + ajax_atc_code;
        //alert(siteurl+data+ajax_atc_code);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            var multi_part  =   result.split("|=|");
            $('#show_atc_code').html(multi_part[0]);
            $('#show_atc_info').html(multi_part[1]);
          }
        }
    )}



</script>


