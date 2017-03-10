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
 * Portions created by the Initial Developer are Copyright (C) 2010 - 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username');
	echo '<pre>';
    echo "\n<br />print_r(supplier_info)=<br />";
		print_r($supplier_info);
    echo "\n<br />print_r(invoices_list)=<br />";
		print_r($invoices_list);
	echo '</pre>';
    echo "\n<br />breadcrumbs=".$breadcrumbs;
    echo "\n</div>";
}

/*
if(isset($breadcrumbs)){
    echo "\n<div id='breadcrumbs'>";
    echo $breadcrumbs;
    echo "</div>\n";
}
*/

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('phar_list_drugs_packages_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";


echo "\n<table class='frame' width='100%' align='center'>";


echo "\n</table>";


echo "\n<fieldset>";
echo "<legend>PACKAGES LIST</legend>";
echo anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/phar_edit_drug_package/new_package/new_package', "<strong>Add New Package</strong>");
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='50'>Sort</th>";
    echo "\n<th width='100'>Code</th>";
    echo "\n<th width='200'>Package Name</th>";
    echo "\n<th width='250'>Description</th>";
    echo "\n<th width='250'>Remarks</th>";
    echo "\n<th width='200'>Clinic</th>";
echo "</tr>";
if(isset($packages_list)){
    $rownum = 1;
    foreach ($packages_list as $package_item){
        echo "\n<tr>";
        echo "\n<td valign='top'>".$rownum.".</td>";
        echo "\n<td valign='top'>".$package_item['package_sort']."</td>";
        echo "\n<td valign='top'>".$package_item['package_code']."</td>";
        echo "\n<td valign='top'>".anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/phar_edit_drug_package/edit_package/'.$package_item['drug_package_id'], $package_item['package_name'])."</td>";
        echo "\n<td valign='top'>".$package_item['description']."</td>";
        echo "\n<td valign='top'>".$package_item['package_remarks']."</td>";
        echo "\n<td valign='top'>".$package_item['clinic_shortname']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";



