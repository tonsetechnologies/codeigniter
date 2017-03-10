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

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_edit_area_info_html_title')."</h1></div>";


$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_area_info/'.$form_purpose.'/'.$addr_area_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('addr_area_id', $addr_area_id);
echo form_hidden('addr_area_town', $init_addr_area_town);
echo form_hidden('addr_area_state', $init_addr_area_state);
echo form_hidden('addr_area_country', $init_addr_area_country);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Area Name <font color='red'>*</font></td><td>";
echo form_error('addr_area_name');
echo "<input type='text' name='addr_area_name' value='".set_value('addr_area_name',$init_addr_area_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Area Code <font color='red'>*</font></td><td>";
echo form_error('addr_area_code');
echo "<input type='text' name='addr_area_code' value='".set_value('addr_area_code',$init_addr_area_code)."' size='10' /></td></tr>";

echo "\n<tr><td>Area Subcode</td><td>";
echo form_error('addr_area_subcode');
echo "<input type='text' name='addr_area_subcode' value='".set_value('addr_area_subcode',$init_addr_area_subcode)."' size='10' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>District, State, Country <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='addr_district_id' class='normal' onchange='javascript:selectArea()' id='addr_district_id'>";
        echo "\n<option label='' value='' selected='selected'></option>";
        foreach($addr_district_list as $addr_district)
        {
            $repeat_space = $ideal_field_length - strlen($addr_district['addr_district_name']);
            if($repeat_space < 1){
                $repeat_space = 0;
            }
            echo "\n<option value='".rtrim($addr_district['addr_district_id'])."'";
            echo ($init_addr_district_id == rtrim($addr_district['addr_district_id']) ? " selected='selected'" : "");
            echo " class='monosp'>".$addr_district['addr_district_name'];
            echo str_repeat("&nbsp;",$repeat_space);
            echo $addr_district['addr_state_name'].", &nbsp;".$addr_district['addr_state_country']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Sort Order</td><td>";
echo form_error('addr_area_sort');
echo "<input type='text' name='addr_area_sort' value='".set_value('addr_area_sort',$init_addr_area_sort)."' size='5' /> number</td></tr>";

echo "\n<tr><td>Section</td><td>";
echo form_error('addr_area_section');
echo "<input type='text' name='addr_area_section' value='".set_value('addr_area_section',$init_addr_area_section)."' size='30' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Description</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='addr_area_descr' cols='40' rows='3'>".set_value('addr_area_descr',$init_addr_area_descr)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Address</td><td>";
echo form_error('addr_area_address1');
echo "<input type='text' name='addr_area_address1' value='".set_value('addr_area_address1',$init_addr_area_address1)."' size='50' /></td></tr>";

echo "\n<tr><td>Address2</td><td>";
echo form_error('addr_area_address2');
echo "<input type='text' name='addr_area_address2' value='".set_value('addr_area_address2',$init_addr_area_address2)."' size='50' /></td></tr>";

echo "\n<tr><td>Address3</td><td>";
echo form_error('addr_area_address3');
echo "<input type='text' name='addr_area_address3' value='".set_value('addr_area_address3',$init_addr_area_address3)."' size='50' /></td></tr>";

echo "\n<tr><td>Town</td><td>";
echo form_error('addr_area_town');
echo "<input type='text' name='addr_area_town' value='".set_value('addr_area_town',$init_addr_area_town)."' size='30' /></td></tr>";

echo "\n<tr><td>Post Code</td><td>";
echo form_error('addr_area_postcode');
echo "<input type='text' name='addr_area_postcode' value='".set_value('addr_area_postcode',$init_addr_area_postcode)."' size='10' /></td></tr>";

echo "\n<tr><td>State</td><td>";
echo form_error('addr_area_state');
echo "<input type='text' name='addr_area_state' value='".set_value('addr_area_state',$init_addr_area_state)."' size='20'  disabled='disabled'/></td></tr>";

echo "\n<tr><td>Country</td><td>";
echo form_error('addr_area_country');
echo "<input type='text' name='addr_area_country' value='".set_value('addr_area_country',$init_addr_area_country)."' size='20' disabled='disabled'/></td></tr>";

echo "\n<tr><td>Tel. No.</td><td>";
echo form_error('addr_area_tel');
echo "<input type='text' name='addr_area_tel' value='".set_value('addr_area_tel',$init_addr_area_tel)."' size='20' /></td></tr>";

echo "\n<tr><td>Fax No.</td><td>";
echo form_error('addr_area_fax');
echo "<input type='text' name='addr_area_fax' value='".set_value('addr_area_fax',$init_addr_area_fax)."' size='20' /></td></tr>";

echo "\n<tr><td>e-mail</td><td>";
echo form_error('addr_area_email');
echo "<input type='text' name='addr_area_email' value='".set_value('addr_area_email',$init_addr_area_email)."' size='30' /></td></tr>";

echo "\n<tr><td>Area_mgr1_position</td><td>";
echo form_error('addr_area_mgr1_position');
echo "<input type='text' name='addr_area_mgr1_position' value='".set_value('addr_area_mgr1_position',$init_addr_area_mgr1_position)."' size='30' /></td></tr>";

echo "\n<tr><td>Area_mgr1_name</td><td>";
echo form_error('addr_area_mgr1_name');
echo "<input type='text' name='addr_area_mgr1_name' value='".set_value('addr_area_mgr1_name',$init_addr_area_mgr1_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Area_mgr2_position</td><td>";
echo form_error('addr_area_mgr2_position');
echo "<input type='text' name='addr_area_mgr2_position' value='".set_value('addr_area_mgr2_position',$init_addr_area_mgr2_position)."' size='30' /></td></tr>";

echo "\n<tr><td>Area_mgr2_name</td><td>";
echo form_error('addr_area_mgr2_name');
echo "<input type='text' name='addr_area_mgr2_name' value='".set_value('addr_area_mgr2_name',$init_addr_area_mgr2_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Area Population</td><td>";
echo form_error('addr_area_population');
echo "<input type='text' name='addr_area_population' value='".set_value('addr_area_population',$init_addr_area_population)."' size='10' /></td></tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_area"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Area' />";
echo "\n</center>";

echo "\n</form>";
echo "\n<br />";

echo "\n<fieldset>";
echo "<legend>TOWNS LIST</legend>";
if($addr_area_id <> "new_area"){
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_town_info/new_town/new_town', "<strong>Add New Town</strong>");
}
echo "\n<br />";

echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrtowns/addr_town_code', 'Code');
    echo "</th>";
    echo "\n<th width='300'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrtowns/addr_town_name', 'Town Name');
    echo "</th>";
    echo "\n<th width='250'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrtowns/addr_area_name', 'Area');
    echo "</th>";
    echo "\n<th width='200'>";
	echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrtowns/addr_district_name', 'District');
    echo "</th>";
    echo "\n<th width='50'>Sort</th>";
    echo "\n<th width='250'>Description</th>";
echo "</tr>";
if(isset($town_list)){
    $rownum = 1;
    foreach ($town_list as $town_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$town_item['addr_town_code']."</td>";
        echo "\n<td>".anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_town_info/edit_town/'.$town_item['addr_town_id'], "<strong>".$town_item['addr_town_name']."</strong>")."</td>";
        echo "\n<td>".$town_item['addr_area_name']."</td>";
        echo "\n<td><strong>".$town_item['addr_district_name']."</strong></td>";
        echo "\n<td>".$town_item['addr_town_sort']."</td>";
        echo "\n<td>".$town_item['addr_town_descr']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";

echo "\n<fieldset>";
echo "<legend>VILLAGES INSIDE THIS AREA</legend>";
if($addr_area_id <> "new_area"){
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_village_info/new_village/new_village', "<strong>Add New Village</strong>");
}
echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>";
	//echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_village_code', 'Code');
    echo "Code</th>";
    echo "\n<th width='300'>";
	//echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_village_name', 'Village Name');
    echo "Village Name</th>";
    echo "\n<th width='250'>";
	//echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_town_name', 'Town');
    echo "Town</th>";
    echo "\n<th width='250'>";
	//echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_area_name', 'Area');
    echo "Area</th>";
    echo "\n<th width='200'>";
	//echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_district_name', 'District');
    echo "District</th>";
    echo "\n<th width='50'>Sort</th>";
    echo "\n<th width='250'>Description</th>";
echo "</tr>";
if(isset($village_list)){
    $rownum = 1;
    foreach ($village_list as $village_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        echo "\n<td>".$village_item['addr_village_code']."</td>";
        echo "\n<td>".anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_village_info/edit_village/'.$village_item['addr_village_id'], "<strong>".$village_item['addr_village_name']."</strong>")."</td>";
        echo "\n<td>".$village_item['addr_town_name']."</td>";
        echo "\n<td><strong>".$village_item['addr_area_name']."</strong></td>";
        echo "\n<td>".$village_item['addr_district_name']."</td>";
        echo "\n<td>".$village_item['addr_village_sort']."</td>";
        echo "\n<td>".$village_item['addr_village_descr']."</td>";
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


