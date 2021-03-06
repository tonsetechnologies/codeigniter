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

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_edit_town_info_html_title')."</h1></div>";

$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_town_info/'.$form_purpose.'/'.$addr_town_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('addr_town_id', $addr_town_id);
echo form_hidden('addr_town_town', $init_addr_town_town);
echo form_hidden('addr_town_state', $init_addr_town_state);
echo form_hidden('addr_town_country', $init_addr_town_country);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Town Name <font color='red'>*</font></td><td>";
echo form_error('addr_town_name');
echo "<input type='text' name='addr_town_name' value='".set_value('addr_town_name',$init_addr_town_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Town Code <font color='red'>*</font></td><td>";
echo form_error('addr_town_code');
echo "<input type='text' name='addr_town_code' value='".set_value('addr_town_code',$init_addr_town_code)."' size='10' /></td></tr>";

echo "\n<tr><td>Town Subcode</td><td>";
echo form_error('addr_town_subcode');
echo "<input type='text' name='addr_town_subcode' value='".set_value('addr_town_subcode',$init_addr_town_subcode)."' size='10' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Area, District, State <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='addr_area_id' class='normal' onchange='javascript:selectArea()' id='addr_area_id'>";
        echo "\n<option label='' value='' selected='selected'></option>";
        foreach($addr_area_list as $addr_area)
        {
            echo "\n<option value='".rtrim($addr_area['addr_area_id'])."'";
            echo ($init_addr_area_id == rtrim($addr_area['addr_area_id']) ? " selected='selected'" : "");
            echo ">".$addr_area['addr_area_name'].", &nbsp;".$addr_area['addr_district_name'].", &nbsp;".$addr_area['addr_state_name']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Sort Order</td><td>";
echo form_error('addr_town_sort');
echo "<input type='text' name='addr_town_sort' value='".set_value('addr_town_sort',$init_addr_town_sort)."' size='5' /> number</td></tr>";

echo "\n<tr><td>Section</td><td>";
echo form_error('addr_town_section');
echo "<input type='text' name='addr_town_section' value='".set_value('addr_town_section',$init_addr_town_section)."' size='30' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Description</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='addr_town_descr' cols='40' rows='3'>".set_value('addr_town_descr',$init_addr_town_descr)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Address</td><td>";
echo form_error('addr_town_address1');
echo "<input type='text' name='addr_town_address1' value='".set_value('addr_town_address1',$init_addr_town_address1)."' size='50' /></td></tr>";

echo "\n<tr><td>Address2</td><td>";
echo form_error('addr_town_address2');
echo "<input type='text' name='addr_town_address2' value='".set_value('addr_town_address2',$init_addr_town_address2)."' size='50' /></td></tr>";

echo "\n<tr><td>Address3</td><td>";
echo form_error('addr_town_address3');
echo "<input type='text' name='addr_town_address3' value='".set_value('addr_town_address3',$init_addr_town_address3)."' size='50' /></td></tr>";

echo "\n<tr><td>Town</td><td>";
echo form_error('addr_town_town');
echo "<input type='text' name='addr_town_town' value='".set_value('addr_town_town',$init_addr_town_town)."' size='30' disabled='disabled' /></td></tr>";

echo "\n<tr><td>Post Code</td><td>";
echo form_error('addr_town_postcode');
echo "<input type='text' name='addr_town_postcode' value='".set_value('addr_town_postcode',$init_addr_town_postcode)."' size='10' /></td></tr>";

echo "\n<tr><td>State</td><td>";
echo form_error('addr_town_state');
echo "<input type='text' name='addr_town_state' value='".set_value('addr_town_state',$init_addr_town_state)."' size='20'  disabled='disabled'/></td></tr>";

echo "\n<tr><td>Country</td><td>";
echo form_error('addr_town_country');
echo "<input type='text' name='addr_town_country' value='".set_value('addrtown_country',$init_addr_town_country)."' size='20' disabled='disabled'/></td></tr>";

echo "\n<tr><td>Tel. No.</td><td>";
echo form_error('addr_town_tel');
echo "<input type='text' name='addr_town_tel' value='".set_value('addr_town_tel',$init_addr_town_tel)."' size='20' /></td></tr>";

echo "\n<tr><td>Fax No.</td><td>";
echo form_error('addr_town_fax');
echo "<input type='text' name='addr_town_fax' value='".set_value('addr_town_fax',$init_addr_town_fax)."' size='20' /></td></tr>";

echo "\n<tr><td>e-mail</td><td>";
echo form_error('addr_town_email');
echo "<input type='text' name='addr_town_email' value='".set_value('addr_town_email',$init_addr_town_email)."' size='30' /></td></tr>";

echo "\n<tr><td>Town_mgr1_position</td><td>";
echo form_error('addr_town_mgr1_position');
echo "<input type='text' name='addr_town_mgr1_position' value='".set_value('addr_town_mgr1_position',$init_addr_town_mgr1_position)."' size='30' /></td></tr>";

echo "\n<tr><td>Town_mgr1_name</td><td>";
echo form_error('addr_town_mgr1_name');
echo "<input type='text' name='addr_town_mgr1_name' value='".set_value('addr_town_mgr1_name',$init_addr_town_mgr1_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Town_mgr2_position</td><td>";
echo form_error('addr_town_mgr2_position');
echo "<input type='text' name='addr_town_mgr2_position' value='".set_value('addr_town_mgr2_position',$init_addr_town_mgr2_position)."' size='30' /></td></tr>";

echo "\n<tr><td>Town_mgr2_name</td><td>";
echo form_error('addr_town_mgr2_name');
echo "<input type='text' name='addr_town_mgr2_name' value='".set_value('addr_town_mgr2_name',$init_addr_town_mgr2_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Town Population</td><td>";
echo form_error('addr_town_population');
echo "<input type='text' name='addr_town_population' value='".set_value('addr_town_population',$init_addr_town_population)."' size='10' /></td></tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_town"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Town' />";
echo "\n</center>";

echo "\n</form>";
echo "\n<br />";


echo "\n<fieldset>";
echo "<legend>VILLAGES INSIDE THIS TOWN</legend>";
if($addr_town_id <> "new_town"){
    echo anchor('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_village_info/new_village/new_village', "<strong>Add New Village</strong>");
}
$dummy_exist    =   FALSE;

if(count($village_list) > 0){
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
            if($village_item['addr_village_descr'] == "Dummy village"){
                $dummy_exist    =   TRUE;
            }
            $rownum++;
        }//endforeach;
    }
    echo "</table>";
} else {
    echo "\n<span class='mandatory_field'>NO VILLAGE RECORD PRESENT. PLEASE ADD AT A MINIMUM, A DUMMY RECORD.</span>";
} //endif
if($addr_town_id <> "new_town" && $dummy_exist===FALSE){
    echo "\n<br />For urban areas - ";
    echo form_open('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_edit_village_info/new_village/new_village', $attributes);

    echo form_hidden('form_purpose', 'new_village');
    echo form_hidden('now_id', $now_id);
    echo form_hidden('addr_village_id', 'new_village');
    echo form_hidden('addr_town_id', $addr_town_id);
    echo form_hidden('addr_area_id', $init_addr_area_id);
    echo form_hidden('addr_village_name', '_');
    echo form_hidden('addr_village_code', $init_addr_town_code);
    echo form_hidden('addr_village_subcode', NULL);
    echo form_hidden('addr_village_sort', NULL);
    echo form_hidden('addr_village_descr', 'Dummy village');
    echo form_hidden('addr_village_section', NULL);
    echo form_hidden('addr_village_address1', NULL);
    echo form_hidden('addr_village_address2', NULL);
    echo form_hidden('addr_village_address3', NULL);
    echo form_hidden('addr_village_postcode', NULL);
    echo form_hidden('addr_village_town', NULL);
    echo form_hidden('addr_village_state', NULL);
    echo form_hidden('addr_village_country', NULL);
    echo form_hidden('addr_village_tel', NULL);
    echo form_hidden('addr_village_fax', NULL);
    echo form_hidden('addr_village_email', NULL);
    echo form_hidden('addr_village_mgr1_position', NULL);
    echo form_hidden('addr_village_mgr1_name', NULL);
    echo form_hidden('addr_village_mgr2_position', NULL);
    echo form_hidden('addr_village_mgr2_name', NULL);
    echo form_hidden('addr_village_gps_lat', NULL);
    echo form_hidden('addr_village_gps_long', NULL);
    echo form_hidden('addr_village_population', NULL);
    echo "\n<input class='button' type='submit' name='' value='Create Dummy Village row'  />";
    echo "\n</form>";
}
echo "\n<br />A village with a description of 'Dummy village' denotes the area of the town without any village inside it.";
echo "\n</fieldset>";


?>
<script  type="text/javascript">




</script>


