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

$ideal_field_length = 25;

echo "\n<body>";

echo "\n\n<div id='content'>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />output_format = " . $output_format;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(clinics_list)=<br />";
		print_r($clinics_list);
    echo "\n<br />print_r(pat_list)=<br />";
		print_r($pat_list);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('reports_select_report_html_title')."</h1></div>";


//echo validation_errors(); Displays ALL errors in one place.
echo form_open('ehr_reports/reports_select_report/edit_param/'.$report_header_id);

echo "<fieldset>";
echo "<legend>Parameters</legend>";
echo "\n<table>";

echo "\n<tr><td>Output Format <font color='red'>*</font></td><td>";
echo "\n<input type='radio' name='output_format' value='html' ".set_radio('output_format','html',($output_format=='html'?TRUE:FALSE))." >HTML</input>";
echo "\n<input type='radio' name='output_format' value='pdf' ".set_radio('output_format','pdf',($output_format=='pdf'?TRUE:FALSE))." >PDF</input>";
echo "\n<input type='radio' name='output_format' value='csv' ".set_radio('output_format','csv',($output_format=='csv'?TRUE:FALSE))." >CSV</input>"; //disabled='disabled'
echo "\n</td></tr>";

echo "\n<tr><td>Period From</td><td>";
echo form_error('period_from');
echo "<input type='text' name='period_from' id='from_datepicker' value='".set_value('period_from',$period_from)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Period To</td><td>";
echo form_error('period_to');
echo "<input type='text' name='period_to' id='to_datepicker' value='".set_value('period_to',$period_to)."' size='10' /> YYYY-MM-DD</td></tr>";

if(isset($clinics_list)){
    echo "\n<tr>";
        echo "\n<td width='200'>Clinic <font color='red'>*</font></td>";
        echo "\n<td>";
            echo "\n<select name='clinic_info_id' class='normal' id='patient_id'>";
                //if($clinic_info_id == ""){echo "\n<option value=''>Please select one</option>";}
                echo "\n<option value='All'  class='monosp'>All clinics</option>";
                $ideal_field_length = 35;
                foreach($clinics_list as $clinic)
                {
                    $repeat_space = $ideal_field_length - strlen($clinic['clinic_name']);
                    if($repeat_space < 1){
                        $repeat_space = 0;
                    }
	                echo "\n<option value='".$clinic['clinic_info_id']."' ";
                    if(isset($clinic_info_id)) {
                        echo ($clinic_info_id==$clinic['clinic_info_id'] ? " selected='selected'" : "");
                    }
                    echo " class='monosp'>".$clinic['clinic_name'];
                    echo str_repeat("&nbsp;",$repeat_space)."[";
                    //echo substr($clinic['gender'],0,1)."] ";
                    echo $clinic['country']."]</option>";
                } //foreach
            echo "</select>";
        echo "</td>";
    echo "</tr>";
}

if(isset($patients_list)){
    echo "\n<tr>";
        echo "\n<td width='200'>Patient Name</td>";
        echo "\n<td>";
            echo "\n<select name='patient_id' class='normal' id='patient_id'>";
                if($patient_id == ""){echo "\n<option value='All' class='monosp'>All patients</option>";}
                //echo "\n<option value='' >Please select one</option>";
                $ideal_field_length = 25;
                foreach($patients_list as $patient)
                {
                    $repeat_space = $ideal_field_length - strlen($patient['name']);
                    if($repeat_space < 1){
                        $repeat_space = 0;
                    }
	                echo "\n<option value='".$patient['patient_id']."' ";
                    if(isset($patient_id)) {
                        echo ($patient_id==$patient['patient_id'] ? " selected='selected'" : "");
                    }
                    echo " class='monosp'>".$patient['name'];
                    echo str_repeat("&nbsp;",$repeat_space)."[";
                    echo substr($patient['gender'],0,1)."] ";
                    echo $patient['birth_date']."</option>";
                } //foreach
            echo "</select>";
        echo "</td>";
    echo "</tr>";
}

echo "\n<tr><td>Comments<td>";
echo form_error('comments');
echo "<input type='text' name='comments' value='".set_value('comments',$comments)."' size='80' disabled='disabled'/></td></tr>";

echo "\n</table>";
echo "</fieldset>";


echo form_hidden('now_id', $now_id);
echo form_hidden('report_header_id', $report_header_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Generate Report' />";
echo "</div>";

echo "</form>";

echo "<fieldset>";
echo "<legend>Template Info</legend>";
echo "\n<table>";

echo "\n<tr><td>Report Code<td><strong>".$report_head['report_code']."</strong></td></tr>";

echo "\n<tr><td>Report Name<td><strong>".$report_head['report_name']."</strong></td></tr>";

echo "\n<tr><td>Report Shortname</td><td>".$report_head['report_shortname']."</td></tr>";

echo "\n<tr><td>Report Title</td><td><strong>".$report_head['report_title1']."</strong></td></tr>";

echo "\n<tr><td>Report Subtitle</td><td>".$report_head['report_title2']."</td></tr>";

echo "\n<tr><td>Report Description</td><td>".$report_head['report_descr']."</td></tr>";

echo "\n<tr><td>Data Source</td><td>".$report_head['report_source']."</td></tr>";

echo "\n<tr><td>Report Section</td><td>".$report_head['report_section']."</td></tr>";

echo "\n<tr><td>Report Scope</td><td>".$report_head['report_scope']."</td></tr>";

echo "\n<tr><td>Report Version</td><td>".$report_head['report_version']."</td></tr>";

echo "\n</table>";
echo "</fieldset>";


echo "</div>"; //id=content
?>
<script  type="text/javascript">
    $(function() {
        $( "#from_datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-50:c'
        });
    });


    $(function() {
        $( "#to_datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-50:c'
        });
    });

    </script>
