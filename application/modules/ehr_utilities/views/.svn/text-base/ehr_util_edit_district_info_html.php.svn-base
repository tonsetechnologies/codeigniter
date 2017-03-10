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
    echo "\n<br />print_r(addr_area_info)=<br />";
		print_r($addr_area_info);
    echo "\n<br />print_r(district_info)=<br />";
		print_r($district_info);
    echo "\n<br />print_r(addr_district_list)=<br />";
		print_r($addr_district_list);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />addr_area_id=".$addr_area_id;
    echo "\n<br />init_addr_area_id=".$init_addr_area_id;
    echo "\n<br />init_addr_district_id=".$init_addr_district_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_edit_district_info_html_title')."</h1></div>";


$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_district_info/'.$form_purpose.'/'.$addr_district_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('addr_district_id', $addr_district_id);
echo form_hidden('addr_district_town', $init_addr_district_town);
echo form_hidden('addr_district_state', $init_addr_district_state);
echo form_hidden('addr_district_country', $init_addr_district_country);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>District Name <font color='red'>*</font></td><td>";
echo form_error('addr_district_name');
echo "<input type='text' name='addr_district_name' value='".set_value('addr_district_name',$init_addr_district_name)."' size='50' /></td></tr>";

echo "\n<tr><td>District Code <font color='red'>*</font></td><td>";
echo form_error('addr_district_code');
echo "<input type='text' name='addr_district_code' value='".set_value('addr_district_code',$init_addr_district_code)."' size='10' /></td></tr>";

echo "\n<tr><td>District Subcode</td><td>";
echo form_error('addr_district_subcode');
echo "<input type='text' name='addr_district_subcode' value='".set_value('addr_district_subcode',$init_addr_district_subcode)."' size='10' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>State, Country <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='addr_state_id' class='normal' onchange='javascript:selectArea()' id='addr_state_id'>";
        echo "\n<option label='' value='' selected='selected'></option>";
        foreach($addr_state_list as $addr_state)
        {
            $repeat_space = $ideal_field_length - strlen($addr_state['addr_state_name']);
            if($repeat_space < 1){
                $repeat_space = 0;
            }
            echo "\n<option value='".rtrim($addr_state['addr_state_id'])."'";
            echo ($init_addr_state_id == rtrim($addr_state['addr_state_id']) ? " selected='selected'" : "");
            echo " class='monosp'>".$addr_state['addr_state_name'];
            echo str_repeat("&nbsp;",$repeat_space);
            echo $addr_state['addr_state_country']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Sort Order</td><td>";
echo form_error('addr_district_sort');
echo "<input type='text' name='addr_district_sort' value='".set_value('addr_district_sort',$init_addr_district_sort)."' size='5' /> number</td></tr>";

echo "\n<tr><td>Section</td><td>";
echo form_error('addr_district_section');
echo "<input type='text' name='addr_district_section' value='".set_value('addr_district_section',$init_addr_district_section)."' size='30' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Description</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='addr_district_descr' cols='40' rows='3'>".set_value('addr_district_descr',$init_addr_district_descr)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Address</td><td>";
echo form_error('addr_district_address1');
echo "<input type='text' name='addr_district_address1' value='".set_value('addr_district_address1',$init_addr_district_address1)."' size='50' /></td></tr>";

echo "\n<tr><td>Address2</td><td>";
echo form_error('addr_district_address2');
echo "<input type='text' name='addr_district_address2' value='".set_value('addr_district_address2',$init_addr_district_address2)."' size='50' /></td></tr>";

echo "\n<tr><td>Address3</td><td>";
echo form_error('addr_district_address3');
echo "<input type='text' name='addr_district_address3' value='".set_value('addr_district_address3',$init_addr_district_address3)."' size='50' /></td></tr>";

echo "\n<tr><td>Town</td><td>";
echo form_error('addr_district_town');
echo "<input type='text' name='addr_district_town' value='".set_value('addr_district_town',$init_addr_district_town)."' size='30' /></td></tr>";

echo "\n<tr><td>Post Code</td><td>";
echo form_error('addr_district_postcode');
echo "<input type='text' name='addr_district_postcode' value='".set_value('addr_district_postcode',$init_addr_district_postcode)."' size='10' /></td></tr>";

echo "\n<tr><td>State</td><td>";
echo form_error('addr_district_state');
echo "<input type='text' name='addr_district_state' value='".set_value('addr_district_state',$init_addr_district_state)."' size='20'  disabled='disabled'/></td></tr>";

echo "\n<tr><td>Country</td><td>";
echo form_error('addr_district_country');
echo "<input type='text' name='addr_district_country' value='".set_value('addr_district_country',$init_addr_district_country)."' size='20' disabled='disabled'/></td></tr>";

echo "\n<tr><td>Tel. No.</td><td>";
echo form_error('addr_district_tel');
echo "<input type='text' name='addr_district_tel' value='".set_value('addr_district_tel',$init_addr_district_tel)."' size='20' /></td></tr>";

echo "\n<tr><td>Fax No.</td><td>";
echo form_error('addr_district_fax');
echo "<input type='text' name='addr_district_fax' value='".set_value('addr_district_fax',$init_addr_district_fax)."' size='20' /></td></tr>";

echo "\n<tr><td>e-mail</td><td>";
echo form_error('addr_district_email');
echo "<input type='text' name='addr_district_email' value='".set_value('addr_district_email',$init_addr_district_email)."' size='30' /></td></tr>";

echo "\n<tr><td>District manager 1 position</td><td>";
echo form_error('addr_district_mgr1_position');
echo "<input type='text' name='addr_district_mgr1_position' value='".set_value('addr_district_mgr1_position',$init_addr_district_mgr1_position)."' size='30' /></td></tr>";

echo "\n<tr><td>District manager 1 name</td><td>";
echo form_error('addr_district_mgr1_name');
echo "<input type='text' name='addr_district_mgr1_name' value='".set_value('addr_district_mgr1_name',$init_addr_district_mgr1_name)."' size='50' /></td></tr>";

echo "\n<tr><td>District manager 2 position</td><td>";
echo form_error('addr_district_mgr2_position');
echo "<input type='text' name='addr_district_mgr2_position' value='".set_value('addr_district_mgr2_position',$init_addr_district_mgr2_position)."' size='30' /></td></tr>";

echo "\n<tr><td>District manager 2 name</td><td>";
echo form_error('addr_district_mgr2_name');
echo "<input type='text' name='addr_district_mgr2_name' value='".set_value('addr_district_mgr2_name',$init_addr_district_mgr2_name)."' size='50' /></td></tr>";

echo "\n<tr><td>District Population</td><td>";
echo form_error('addr_district_population');
echo "<input type='text' name='addr_district_population' value='".set_value('addr_district_population',$init_addr_district_population)."' size='10' /></td></tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_district"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " District' />";
echo "\n</center>";

echo "\n</form>";
echo "\n<br />";


echo "\n<fieldset>";
echo "<legend>AREAS INSIDE THIS DISTRICT</legend>";
if($addr_district_id <> "new_district"){
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_area_info/new_area/new_area', "<strong>Add New Area</strong>");
}
echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>";
	//echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrareas/addr_area_code', 'Code');
    echo "Code</th>";
    echo "\n<th width='300'>";
	//echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrareas/addr_area_name', 'Area Name');
    echo "Area Name</th>";
    echo "\n<th width='200'>";
	//echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrareas/addr_district_name', 'District');
    echo "District</th>";
    echo "\n<th width='50'>Sort</th>";
    echo "\n<th width='250'>Description</th>";
echo "</tr>";
if(isset($area_list)){
    $rownum = 1;
    foreach ($area_list as $area_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$area_item['addr_area_code']."</td>";
        echo "\n<td>".anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_area_info/edit_area/'.$area_item['addr_area_id'], "<strong>".$area_item['addr_area_name']."</strong>")."</td>";
        echo "\n<td>".$area_item['addr_district_name']."</td>";
        echo "\n<td>".$area_item['addr_area_sort']."</td>";
        echo "\n<td>".$area_item['addr_area_descr']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


?>
    <script  type="text/javascript">

        function select_level_two(){
            document.getElementById("consultation_form").status.value="Unfinished";
            document.getElementById("level_two").selectedIndex = -1;
            document.getElementById("consultation_form").submit.click();
        }

      </script>


