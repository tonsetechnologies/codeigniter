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
echo form_open('ehr_utilities/util_edit_town_info/'.$form_purpose.'/'.$addr_town_id, $attributes);

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
echo "<input type='text' name='addr_town_town' value='".set_value('addr_town_town',$init_addr_town_town)."' size='30' /></td></tr>";

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


