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

echo "\n\n<div id='content'>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(village_info)=<br />";
		print_r($village_info);
    echo "\n<br />print_r(addr_town_info)=<br />";
		print_r($addr_town_info);
    echo "\n<br />print_r(addr_town_list)=<br />";
		print_r($addr_town_list);
    echo "\n<br />print_r(addr_area_info)=<br />";
		print_r($addr_area_info);
    echo "\n<br />print_r(addr_area_list)=<br />";
		print_r($addr_area_list);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />addr_village_id=".$addr_village_id;
    echo "\n<br />addr_area_id=".$addr_area_id;
    echo "\n<br />init_addr_town_id=".$init_addr_town_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('util_edit_village_info_html_title')."</h1></div>";

echo "\n<p>";
    echo anchor('bio_utilities/util_list_addrstates/addr_state_sort', 'State');
    echo "\n > ";
    echo anchor('bio_utilities/util_list_addrdistricts/addr_district_sort', 'District');
    echo "\n > ";
    echo anchor('bio_utilities/util_list_addrareas/addr_area_sort', 'Area');
    echo "\n > ";
    echo anchor('bio_utilities/util_list_addrtowns/addr_town_sort', 'Town');
    echo "\n > ";
    echo anchor('bio_utilities/util_list_addrvillages/addr_village_sort', 'Villages');
echo "</p>";


$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('bio_utilities/util_edit_village_info/'.$form_purpose.'/'.$addr_village_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('addr_village_id', $addr_village_id);
echo form_hidden('addr_village_town', $init_addr_village_town);
echo form_hidden('addr_village_state', $init_addr_village_state);
echo form_hidden('addr_village_country', $init_addr_village_country);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Village Name <font color='red'>*</font></td><td>";
echo form_error('addr_village_name');
echo "<input type='text' name='addr_village_name' value='".set_value('addr_village_name',$init_addr_village_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Village Code <font color='red'>*</font></td><td>";
echo form_error('addr_village_code');
echo "<input type='text' name='addr_village_code' value='".set_value('addr_village_code',$init_addr_village_code)."' size='10' /></td></tr>";

echo "\n<tr><td>Village Subcode</td><td>";
echo form_error('addr_village_subcode');
echo "<input type='text' name='addr_village_subcode' value='".set_value('addr_village_subcode',$init_addr_village_subcode)."' size='10' /></td></tr>";

echo "\n<tr><td>Sort Order</td><td>";
echo form_error('addr_village_sort');
echo "<input type='text' name='addr_village_sort' value='".set_value('addr_village_sort',$init_addr_village_sort)."' size='5' /> number</td></tr>";

echo "\n<tr><td>Section</td><td>";
echo form_error('addr_village_section');
echo "<input type='text' name='addr_village_section' value='".set_value('addr_village_section',$init_addr_village_section)."' size='30' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Description</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='addr_village_descr' cols='40' rows='3'>".set_value('addr_village_descr',$init_addr_village_descr)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Address</td><td>";
echo form_error('addr_village_address1');
echo "<input type='text' name='addr_village_address1' value='".set_value('addr_village_address1',$init_addr_village_address1)."' size='50' /></td></tr>";

echo "\n<tr><td>Address2</td><td>";
echo form_error('addr_village_address2');
echo "<input type='text' name='addr_village_address2' value='".set_value('addr_village_address2',$init_addr_village_address2)."' size='50' /></td></tr>";

echo "\n<tr><td>Address3</td><td>";
echo form_error('addr_village_address3');
echo "<input type='text' name='addr_village_address3' value='".set_value('addr_village_address3',$init_addr_village_address3)."' size='50' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Town, Area, District <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='addr_town_id' class='normal' onchange='javascript:selectArea()' id='addr_town_id'>";
        echo "\n<option label='' value='' ></option>";
        foreach($addr_town_list as $addr_town)
        {
            $repeat_space = $ideal_field_length - strlen($addr_town['addr_town_name']);
            if($repeat_space < 1){
                $repeat_space = 0;
            }
            echo "\n<option value='".rtrim($addr_town['addr_town_id'])."'";
            echo ($init_addr_town_id == rtrim($addr_town['addr_town_id']) ? " selected='selected'" : " Non ");
            echo " class='monosp'>".$addr_town['addr_town_name']." ";
            echo str_repeat("&nbsp;",$repeat_space);
            echo $addr_town['addr_area_name'].", ";
            echo $addr_town['addr_district_name']."</option>";
        }
        echo "</select>";
    echo "\n This has priority over Area, District below</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Area, District <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='addr_area_id' class='normal' onchange='javascript:selectArea()' id='addr_area_id'>";
        echo "\n<option label='' value='' selected='selected'></option>";
        foreach($addr_area_list as $addr_area)
        {
            $repeat_space = $ideal_field_length - strlen($addr_area['addr_area_name']);
            if($repeat_space < 1){
                $repeat_space = 0;
            }
            echo "\n<option value='".rtrim($addr_area['addr_area_id'])."'";
            echo ($init_addr_area_id == rtrim($addr_area['addr_area_id']) ? " selected='selected'" : "");
            echo " class='monosp'>".$addr_area['addr_area_name']." ";
            echo str_repeat("&nbsp;",$repeat_space);
            echo $addr_area['addr_district_name'].", ";
            echo $addr_area['addr_state_name']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Town</td><td>";
echo form_error('addr_village_town');
echo "<input type='text' name='addr_village_town' value='".set_value('addr_village_town',$init_addr_village_town)."' size='30'   disabled='disabled'/></td></tr>";

echo "\n<tr><td>Post Code</td><td>";
echo form_error('addr_village_postcode');
echo "<input type='text' name='addr_village_postcode' value='".set_value('addr_village_postcode',$init_addr_village_postcode)."' size='10' /></td></tr>";

echo "\n<tr><td>State</td><td>";
echo form_error('addr_village_state');
echo "<input type='text' name='addr_village_state' value='".set_value('addr_village_state',$init_addr_village_state)."' size='20'  disabled='disabled'/></td></tr>";

echo "\n<tr><td>Country</td><td>";
echo form_error('addr_village_country');
echo "<input type='text' name='addr_village_country' value='".set_value('addr_village_country',$init_addr_village_country)."' size='20' disabled='disabled'/></td></tr>";

echo "\n<tr><td>Tel. No.</td><td>";
echo form_error('addr_village_tel');
echo "<input type='text' name='addr_village_tel' value='".set_value('addr_village_tel',$init_addr_village_tel)."' size='20' /></td></tr>";

echo "\n<tr><td>Fax No.</td><td>";
echo form_error('addr_village_fax');
echo "<input type='text' name='addr_village_fax' value='".set_value('addr_village_fax',$init_addr_village_fax)."' size='20' /></td></tr>";

echo "\n<tr><td>e-mail</td><td>";
echo form_error('addr_village_email');
echo "<input type='text' name='addr_village_email' value='".set_value('addr_village_email',$init_addr_village_email)."' size='30' /></td></tr>";

echo "\n<tr><td>Village_mgr1_position</td><td>";
echo form_error('addr_village_mgr1_position');
echo "<input type='text' name='addr_village_mgr1_position' value='".set_value('addr_village_mgr1_position',$init_addr_village_mgr1_position)."' size='30' /></td></tr>";

echo "\n<tr><td>Village_mgr1_name</td><td>";
echo form_error('addr_village_mgr1_name');
echo "<input type='text' name='addr_village_mgr1_name' value='".set_value('addr_village_mgr1_name',$init_addr_village_mgr1_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Village_mgr2_position</td><td>";
echo form_error('addr_village_mgr2_position');
echo "<input type='text' name='addr_village_mgr2_position' value='".set_value('addr_village_mgr2_position',$init_addr_village_mgr2_position)."' size='30' /></td></tr>";

echo "\n<tr><td>Village_mgr2_name</td><td>";
echo form_error('addr_village_mgr2_name');
echo "<input type='text' name='addr_village_mgr2_name' value='".set_value('addr_village_mgr2_name',$init_addr_village_mgr2_name)."' size='50' /></td></tr>";

echo "\n<tr><td>GPS lat</td><td>";
echo form_error('addr_village_gps_lat');
echo "<input type='text' name='addr_village_gps_lat' value='".set_value('addr_village_gps_lat',$init_addr_village_gps_lat)."' size='20' /></td></tr>";

echo "\n<tr><td>GPS long</td><td>";
echo form_error('addr_village_gps_long');
echo "<input type='text' name='addr_village_gps_long' value='".set_value('addr_village_gps_long',$init_addr_village_gps_long)."' size='20' /></td></tr>";

echo "\n<tr><td>Village Population</td><td>";
echo form_error('addr_village_population');
echo "<input type='text' name='addr_village_population' value='".set_value('addr_village_population',$init_addr_village_population)."' size='10' /></td></tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_village"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " village' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";



?>
    <script  type="text/javascript">
        var $ = function (id) {
            return document.getElementById(id);
        }

        function select_level_two(){
            $("consultation_form").status.value="Unfinished";
            $("level_two").selectedIndex = -1;
            $("consultation_form").submit.click();
        }

      </script>


