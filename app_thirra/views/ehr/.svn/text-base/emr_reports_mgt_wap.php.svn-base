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
 * Portions created by the Initial Developer are Copyright (C) 2009
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(clinic_reports_list)=<br />";
		print_r($clinic_reports_list);
	echo '</pre>';
}

echo "\n\n<div align='center'><h1>".$this->lang->line('reports_mgt_html_title')."</h1></div>";

echo "\n\n<div id='reports_clinical' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Clinical</h2></p>";
	echo "\n<p class='section_body'>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th>No.</th>";
        echo "\n<th width='110'>Code</th>";
        echo "\n<th width='300'>State Name</th>";
        echo "\n<th width='200'>Country</th>";
        echo "\n<th width='250'>Sort</th>";
        echo "\n<th width='250'>Description</th>";
    echo "</tr>";
    if(isset($clinic_reports_list)){
        $rownum = 1;
        foreach ($clinic_reports_list as $clinrep_item){
            echo "\n<tr>";
            echo "\n<td>".$rownum.".</td>";
            echo "\n<td>".$clinrep_item['report_code']."</td>";
            echo "\n<td>".anchor('ehr_utilities/util_edit_state_info/edit_state/'.$clinrep_item['report_header_id'], "<strong>".$clinrep_item['report_name']."</strong>")."</td>";
            echo "\n<td>".$clinrep_item['report_scope']."</td>";
            echo "\n<td>".$clinrep_item['report_sort']."</td>";
            echo "\n<td>".$clinrep_item['report_descr']."</td>";
            echo "\n</tr>";
            $rownum++;
        }//endforeach;
    }
    echo "</table>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='reports_pharmacy' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Pharmacy</h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='reports_lab' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Lab</h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='reports_imaging' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Imaging</h2></p>";
	echo "\n<p class='section_body'>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "\n\n<div id='new' class='section'>";
	echo "\n<p class='section_title'>";
	echo "<h2>Modules powered by GEM</h2></p>";
	echo "\n<p class='section_body'>";
    echo "<A HREF='/gem/gem_reports.php?dbname=$current_db' target='_blank'>GEM Reports</A>";
	echo "<br />";
	echo "</p>";
echo "</div>";

echo "</div>"; //id=body

