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

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(area_list)=<br />";
		print_r($area_list);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_list_referral_centres_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<fieldset>";
echo "<legend>CENTRES LIST</legend>";
echo "<p>";
echo anchor('ehr_admin/admin_edit_referral_centre/new_centre', 'Add New Centre');
echo "</p>";
echo "\n<br />";

echo "\n<table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th width='400'>Centre Name</th>";
    echo "\n<th>Centre Type</th>";
    echo "\n<th>Town</th>";
    echo "\n<th>Contact Person</th>";
echo "</tr>";
foreach ($centres_list as $centre_item){
    echo "<tr>";
    echo "<td>".anchor('ehr_admin/admin_edit_referral_centre/edit_centre/'.$centre_item['referral_center_id'], $centre_item['name'])."</td>";
    echo "<td>".$centre_item['centre_type']."</td>";
    echo "<td>".$centre_item['town']."</td>";
    echo "<td>".$centre_item['contact_person']."</td>";
    echo "</tr>";
}//endforeach;
echo "</table>";

echo "\n<br />";
echo "\n</fieldset>";



