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

echo "\n\n<div id='print_content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    print "\n<br />output_format = " . $output_format;
    print "\n<br />report_header_id = " . $report_header_id;
    print "\n<br />period_from = " . $period_from;
    print "\n<br />period_to = " . $period_to;
    print "\n<br />clinic_info_id = " . $clinic_info_id;
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />columnsc_count = " . $columnsc_count;
    print "\n<br />rows_count = " . $rows_count;
	echo '<pre>';
    echo "\n<br />print_r(scope_clinic)=<br />";
		print_r($scope_clinic);
    echo "\n<br />print_r(scope_patient)=<br />";
		print_r($scope_patient);
    echo "\n<br />print_r(report_head)=<br />";
		print_r($report_head);
    echo "\n<br />print_r(report_body)=<br />";
		print_r($report_body);
    echo "\n<br />print_r(reportc_data)=<br />";
		print_r($reportc_data);
    echo "\n<br />print_r(report_data)=<br />";
		print_r($report_data);
    echo "\n<br />print_r(table_data)=<br />";
		print_r($table_data);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h4 class='print'>".$this->lang->line('reports_print_report_html_title')."</h4></div>";
echo "\n\n<div id='report_title1' align='center'><h1 class='print'>".$report_head['report_title1']."</h1></div>";
echo "\n\n<div id='report_title2' align='center'><h3 class='print'>".$report_head['report_title2']."</h3></div>";

echo "\n<p>";

echo "\n<table>";
echo "\n<tr>";
	echo "<td width='20%' valign='top'>";
		echo "Report Description";
	echo "</td>";
	echo "<td colspan='2'> : ";
        echo $report_head['report_descr'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Report Source';
	echo '</td>';
	echo "<td width='35%'> : ";
        echo $report_head['report_source'];
	echo '</td>';
	echo "<td width='10%'>";
		echo 'Clinic';
	echo '</td>';
	echo "<td width='35%'> : ";
        echo $scope_clinic['clinic_name'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Period of Report';
	echo '</td>';
	echo '<td> : ';
        echo $period_from." to ".$period_to;
	echo '</td>';
	echo '<td>';
		echo 'Patient';
	echo '</td>';
	echo '<td> : ';
        echo $scope_patient['name'];
	echo '</td>';
echo '</tr>';


echo '</table>';
echo "<br />";
echo "\n</p>";

echo "\n<table border='1'  class='print valigntop'>";

// Print Table Header
echo "\n<tr>";
echo "<th width='5'>No.</th>";
//echo "<th width='250'>Patient Name</th>";
for($i=0; $i < $columns_count; $i++){
    echo "<th>".$report_body[$i]['col_title1']."</th>";
}//endfor($i=0; $i < $columns_count; $i++)
echo "</tr>";
echo "\n<tr>";
echo "<th width='5'> </th>";
//echo "<th width='250'>Patient Name</th>";
for($i=0; $i < $columns_count; $i++){
    echo "<th>".$report_body[$i]['col_title2']."</th>";
}//endfor($i=0; $i < $columns_count; $i++)
echo "</tr>";

// Print data
for($j=1; $j <= $rows_count; $j++){
    echo "\n<tr>";
    echo "\n<td>".($j).". </td>";
    //echo "\n<td></td>";
    for($k=0; $k < $columns_count; $k++){
        echo "<td>";
        echo $table_data[$j][$k];
        echo "</td>";
    }
    echo "</tr>";
}//endfor($i=0; $i < $rows_count; $i++)

echo "\n</table>";


echo "</div>"; //id='lab'

echo "\n<br />";
echo " &nbsp; End of Report printed on ".$now_date." &nbsp; ".$now_time;

echo "</div>"; //id='content'

echo "</div>"; //id=body
