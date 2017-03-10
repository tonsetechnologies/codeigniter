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

$ideal_field_length = 25;

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(drugcode_info)=<br />";
		print_r($drugcode_info);
    echo "\n<br />print_r(formulary_info)=<br />";
		print_r($formulary_info);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />init_drug_formulary_id=".$init_drug_formulary_id;
    echo "\n<br />drug_code_id=".$drug_code_id;
    echo "\n<br />drugformulary_length=".$drugformulary_length;
    echo "\n<br />drugcode_length=".$drugcode_length;
    echo "\n<br />drugatc_length=".$drugatc_length;
    echo "\n<br />init_part_drug_code=".$init_part_drug_code;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'>\n<h1>".$this->lang->line('util_edit_drugcode_html_title')."</h1></div>\n";


$attributes =   array('class' => 'select_form', 'id' => 'drugcode_form');
echo form_open('ehr_utilities/util_edit_drugcode/'.$form_purpose.'/'.$drug_code_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('drug_locale', $init_drug_locale);
echo form_hidden('now_id', $now_id);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Drug Code <font color='red'>*</font></td><td>";
echo form_error('part_drug_code');
echo "\n<span id='show_formulary_code'>";
echo (!empty($init_drug_formulary_code) ? $init_drug_formulary_code : "Formulary Code + ");
echo "</span>";
echo "<input type='text' name='part_drug_code' value='".set_value('part_drug_code',$init_part_drug_code)."' size='".$drugcode_length."' maxlength='".$drugcode_length."' /> ".$drugcode_length." characters</td></tr>";

echo "\n<tr><td>Trade name <font color='red'>*</font></td><td>";
echo form_error('trade_name');
echo "<input type='text' name='trade_name' value='".set_value('trade_name',$init_trade_name)."' size='80' /></td></tr>";

/*
echo "\n<tr><td>Generic name <font color='red'>*</font></td><td>";
echo form_error('generic_name');
echo "<input type='text' name='generic_name' value='".set_value('generic_name',$init_generic_name)."' size='80' /></td></tr>";
*/
echo "\n<tr>";
    echo "\n<td>Generic name <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo form_error('drug_formulary_id');
    echo "\n<div id='genericnames_select'>";
    echo "\n<select name='drug_formulary_id' id='drug_formulary_id' class='normal'>";
        echo "\n<option label='' value='' selected='selected'></option>";
        foreach($formulary_list as $formulary_item)
        {
            echo "\n<option value='".rtrim($formulary_item['drug_formulary_id'])."'";
            echo ($init_drug_formulary_id == rtrim($formulary_item['drug_formulary_id']) ? " selected='selected'" : "");
            echo ">".$formulary_item['generic_name']." - ".$formulary_item['formulary_code']."</option>";
        }
        echo "</select>";
    echo "</div>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Commonly used</td><td>";
echo form_error('commonly_used');
echo "<input type='text' name='commonly_used' value='".set_value('commonly_used',$init_commonly_used)."' size='5' /> number</td></tr>";

echo "\n<tr><td>PBKD No.</td><td>";
echo form_error('pbkd_no');
echo "<input type='text' name='pbkd_no' value='".set_value('pbkd_no',$init_pbkd_no)."' size='15' /></td></tr>";

echo "\n<tr><td>USFDA pregnancy category</td><td>";
echo form_error('usfda_preg_cat');
echo "<input type='text' name='usfda_preg_cat' value='".set_value('usfda_preg_cat',$init_usfda_preg_cat)."' size='5' /></td></tr>";

echo "\n<tr><td>Poison category</td><td>";
echo form_error('poison_cat');
echo "<input type='text' name='poison_cat' value='".set_value('poison_cat',$init_poison_cat)."' size='5' /></td></tr>";

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
echo "\n<input type='hidden' name='drug_code_id' value='".$drug_code_id."' />";

echo "\n</form>";
echo "\n<br />";

echo "\n\n<div id='knowledgebase_drug' class='episodeblock'>";
if(isset($formulary_info[0])){
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<td>Generic name</td>";
        //echo "<td>".$formulary_info[0]['generic_name']."</td>";
        echo "\n<td>".anchor('ehr_utilities/util_edit_drugformulary/edit_formulary/'.$formulary_info[0]['drug_formulary_id'], $formulary_info[0]['generic_name'])."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Formulary code</td>";
        echo "<td>".$formulary_info[0]['formulary_code']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Formulary system</td>";
        echo "<td>".$formulary_info[0]['formulary_system']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Commonly used</td>";
        echo "<td>".$formulary_info[0]['commonly_used']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>USFDA pregnancy category</td>";
        echo "<td>".$formulary_info[0]['usfda_preg_cat']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Poison category</td>";
        echo "<td>".$formulary_info[0]['poison_cat']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Dose form</td>";
        echo "<td>".$formulary_info[0]['dose_form']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Indication</td>";
        echo "<td>".$formulary_info[0]['indication']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Dosage</td>";
        echo "<td>".$formulary_info[0]['dosage']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Contra indication</td>";
        echo "<td>".$formulary_info[0]['contra_indication']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Precautions</td>";
        echo "<td>".$formulary_info[0]['precautions']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Interactions</td>";
        echo "<td>".$formulary_info[0]['interactions']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Adverse reactions</td>";
        echo "<td>".$formulary_info[0]['adverse_reactions']."</td>";
    echo "\n</tr>";
    echo "\n</table>";

    echo "\n<br /><u>Drug codes in database</u>";
    echo "\n<ol>";
    foreach ($drugcode_list as $drugcode_item){
        echo "\n<li>[".$drugcode_item['drug_code']."] ".anchor('ehr_utilities/util_edit_drugcode/edit_drugcode/'.$drugcode_item['drug_code_id'], $drugcode_item['trade_name'])."</li>";
    }//endforeach;
    echo "\n</ol>";

} //endif(isset($formulary_info[0]))
echo "</div>"; //id='knowledgebase_drug'

// Set for AJAX calling
$siteurl_formularyinfo    =   site_url()."/ehr_ajax/get_formulary_info";
//echo $siteurl;
?>
<script  type="text/javascript">

    $(document).ready(function() {
        $('#genericnames_select').delegate('select','change',function (){
            ajax_formulary_info()}
            );
        return false;
      })


    function ajax_formulary_info() {
        var siteurl = "<?php echo $siteurl_formularyinfo; ?>";
        var ajax_drug_formulary_id = $('#drug_formulary_id').val();
        var data = 'ajax_drug_formulary_id=' + ajax_drug_formulary_id;
        //alert(siteurl+' '+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            var multi_part  =   result.split("|=|");
            $('#show_formulary_code').html(multi_part[0]);
            $('#knowledgebase_drug').html(multi_part[1]);
            $('#allergic_reactions').html(multi_part[2]);
          }
        }
    )}




</script>


