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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2012
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
    echo "\n<br />print_r(prescription_info)=<br />";
		print_r($prescription_info);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div align='center'><h1>".$this->lang->line('pharmacy_mgt_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n\n<div id='pharmacy_prescriptions' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Prescriptions</h2></div>";
	echo "\n<div class='section_body'>";
        echo "\n<table class='valigntop'>";
            echo "\n<tr>";
                echo "\n<th width='80'>print</th>";
                echo "\n<th width='250'>Name</th>";
                echo "\n<th>Birth date</th>";
                echo "\n<th width='100'>Sex</th>";
                echo "\n<th>Session Date</th>";
            echo "</tr>";
        foreach ($prescription_info as $prescription_item){
            echo "\n<tr>";
            echo "<td>";
            echo anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/print_prescription/edit_param/html/print_prescription/'.$prescription_item['patient_id'].'/'.$prescription_item['session_id'], 'html', "target='_blank'");
            echo " ";
            echo anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/print_prescription/edit_param/pdf/print_prescription/'.$prescription_item['patient_id'].'/'.$prescription_item['session_id'], 'pdf', "target='_blank'");
            echo "</td>";
            echo "<td>".$prescription_item['name'].", ".$prescription_item['name_first']."</td>";
            echo "<td>".$prescription_item['birth_date']."</td>";
            echo "<td>".$prescription_item['gender']."</td>";
            echo "<td><strong>".$prescription_item['date_ended']."</strong></td>";
            echo "<td>";
            echo anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/phar_close_prescription/'.$prescription_item['patient_id'].'/'.$prescription_item['session_id'], 'Archive');
            echo "</td>";
            echo "</tr>";
        }//endforeach;
        echo "\n</table>";
	echo "<br />";
	echo "</div>";
echo "</div>";

echo "\n\n<div id='pharmacy_dispensings' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Dispensings</h2></div>";
	echo "\n<div class='section_body'>";
        echo "\n<table class='valigntop'>";
            echo "\n<tr>";
                echo "\n<th width='80'>print</th>";
                echo "\n<th width='250'>Name</th>";
                echo "\n<th>Birth date</th>";
                echo "\n<th width='100'>Sex</th>";
                echo "\n<th>Session Date</th>";
            echo "</tr>";
        foreach ($dispensing_info as $dispensing_item){
            echo "<tr>";
            echo "<td>".anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/print_prescription/edit_param/html/print_dispensing/'.$dispensing_item['patient_id'].'/'.$dispensing_item['session_id'], 'html', "target='_blank'")."</td>";
            //echo "<td>".anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/print_prescription/'.$dispensing_item['session_id'], 'print', "target='_blank'")."</td>";
            echo "<td>".$dispensing_item['name'].", ".$dispensing_item['name_first']."</td>";
            echo "<td>".$dispensing_item['birth_date']."</td>";
            echo "<td>".$dispensing_item['gender']."</td>";
            echo "<td><strong>".$dispensing_item['date_ended']."</strong></td>";
            echo "</tr>";
        }//endforeach;
        echo "\n</table>";
	echo "<br />";
	echo "</div>";
echo "</div>";

echo "\n\n<div id='pharmacy_' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Closed orders</h2></div>";
	echo "\n<div class='section_body'>";
    echo anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/phar_listclosed_prescriptions/', 'Prescriptions');
	echo "\n<br />Dispensing";
	echo "<br />";
	echo "</div>";
	echo "<br />";
echo "</div>";

echo "\n\n<div id='pharmacy_inventory' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Inventory</h2></div>";
	echo "\n<div class='section_body'>";
    echo anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy_supplier/phar_list_drug_suppliers/drug', 'Drug Suppliers');
	echo "<br />";
    echo anchor('ehr/ehr/index/ehr_pharmacy/ehr_pharmacy/phar_list_drug_packages', 'Drug Packages');
	echo "<br />";
	echo "</div>";
	echo "<br />";
echo "</div>";
/*
echo "\n\n<div id='pharmacy_' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2></h2></div>";
	echo "\n<div class='section_body'>";
	echo "<br />";
	echo "</div>";
echo "</div>";
*/
echo "</div>"; //id=body
