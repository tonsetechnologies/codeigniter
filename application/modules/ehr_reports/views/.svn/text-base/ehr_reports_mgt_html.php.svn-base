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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2011
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
    echo "\n<br />print_r(clinic_reports_list)=<br />";
		print_r($clinic_reports_list);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div align='center'><h1>".$this->lang->line('reports_mgt_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n\n<div id='reports_clinical' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>User Customisable</h2></div>";
	echo "\n<div class='section_body'>";
    echo anchor('ehr/ehr/index/ehr_reports/ehr_reports/reports_edit_reporthead/new_report/new_report', "<strong>Add New Report</strong>");
    echo "\n<table class='valigntop'>";
    echo "\n<tr>";
        echo "\n<th>No.</th>";
        echo "\n<th width='1'></th>";
        echo "\n<th width='110'>Code</th>";
        echo "\n<th>&nbsp;</th>";
        echo "\n<th width='300'>Report Name</th>";
        echo "\n<th width='100'>Scope</th>";
        echo "\n<th width='50'>Sort</th>";
        echo "\n<th width='50'>Version</th>";
        echo "\n<th width='350'>Description</th>";
        echo "\n<th width='50'>Template</th>";
    echo "</tr>";
    if(isset($clinic_reports_list)){
        $rownum = 1;
        foreach ($clinic_reports_list as $clinrep_item){
            echo "\n<tr>";
            echo "\n<td>".$rownum.".</td>";
            echo "\n<td>";
            //echo anchor('ehr_reports/print_report/html/'.$clinrep_item['report_header_id'], 'html', "target='_blank'");
            echo " ";
            //echo anchor('ehr_reports/print_report/pdf/'.$clinrep_item['report_header_id'], 'pdf', "target='_blank'");
            echo "</td>";
            echo "\n<td>".$clinrep_item['report_code']."</td>";
            echo "\n<td>".anchor('ehr/ehr/index/ehr_reports/ehr_reports/reports_select_report/edit_param/'.$clinrep_item['report_header_id'], 'print', "target='_blank'")."</td>";
            echo "\n<td> <strong>".$clinrep_item['report_name']."</strong>"."</td>";
            echo "\n<td>".$clinrep_item['report_scope']."</td>";
            echo "\n<td>".$clinrep_item['report_sort']."</td>";
            echo "\n<td>".$clinrep_item['report_version']."</td>";
            echo "\n<td>".$clinrep_item['report_descr']."</td>";
            echo "\n<td>".anchor('ehr/ehr/index/ehr_reports/ehr_reports/reports_edit_reporthead/edit_report/'.$clinrep_item['report_header_id'], "<strong>Edit</strong>")."</td>";
            echo "\n</tr>";
            $rownum++;
        }//endforeach;
    }
    echo "</table>";
	echo "<br />";
	echo "</div>";
echo "</div>";

echo "\n\n<div id='reports_pharmacy' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Pharmacy</h2></div>";
	echo "\n<div class='section_body'>";
	echo "<br />";
	echo "</div>";
echo "</div>";

echo "\n\n<div id='reports_lab' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Lab</h2></div>";
	echo "\n<div class='section_body'>";
	echo "<br />";
	echo "</div>";
echo "</div>";

echo "\n\n<div id='reports_imaging' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Imaging</h2></div>";
	echo "\n<div class='section_body'>";
	echo "<br />";
	echo "</div>";
echo "</div>";

echo "\n\n<div id='new' class='section'>";
	echo "\n<div class='section_title'>";
	echo "<h2>Modules powered by GEM</h2></div>";
	echo "\n<div class='section_body'>";
    echo "<A HREF='/gem/gem_reports.php?dbname=$current_db' target='_blank'>GEM Reports</A>";
	echo "</div>";
	echo "<br />";
echo "</div>";

echo "</div>"; //id=body

