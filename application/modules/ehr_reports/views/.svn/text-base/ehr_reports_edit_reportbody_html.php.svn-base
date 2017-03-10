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

$ideal_field_length = 25;
$max_sort           = 0;

echo "\n<body>";

echo "\n\n<div id='content_nosidebar'>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />report_header_id = " . $report_header_id;
    print "\n<br />report_body_id = " . $report_body_id;
    print "\n<br />init_col_fieldname = " . $init_col_fieldname;
    print "\n<br />Session info = " . $this->session->userdata('thirra_mode');
    print "<br />location_id = " . $this->session->userdata('location_id');
    print "\n<br />username = " . $this->session->userdata('username');
	echo '<pre>';
    echo "\n<br />print_r(report_head)=<br />";
		print_r($report_head);
    echo "\n<br />print_r(report_body)=<br />";
		print_r($report_body);
    echo "\n<br />print_r(fields_list)=<br />";
		print_r($fields_list);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('reports_edit_reportbody_html_title')."</h1></div>";

echo "<fieldset>";
echo "<legend>Body Info</legend>";
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th width='200'>Column Name</th>";
        echo "\n<th width='70'>Sort</th>";
        echo "\n<th>Column Title Line 1</th>";
        echo "\n<th>Column Title Line 2</th>";
    echo "</tr>";
    foreach ($report_body as $body_item){
        echo "\n<tr>";
        echo "<td>".anchor('ehr_reports/reports_edit_reportbody/edit_body/'.$body_item['report_header_id']."/".$body_item['report_body_id'], $body_item['col_fieldname'])."</td>";
        echo "<td>".$body_item['col_sort']."</td>";
        echo "<td>".$body_item['col_title1']."</td>";
        echo "<td>".$body_item['col_title2']."</td>";
        echo "</tr>";
        if($body_item['col_sort'] > $max_sort){
            $max_sort = $body_item['col_sort'];
        }
    }//endforeach;
    echo "\n</table>";
echo "</fieldset>";

//echo validation_errors(); Displays ALL errors in one place.
echo form_open('ehr_reports/reports_edit_reportbody/'.$form_purpose.'/'.$report_header_id.'/'.$report_body_id);

echo "<fieldset>";
echo "<legend>Column Info</legend>";
echo "\n<table>";

echo "\n<tr>";
    echo "\n<td width='250'>Fieldname <font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
    echo form_error('col_fieldname');
        echo "\n<select name='col_fieldname' class='normal' id='col_fieldname'>";
            echo "\n<option value='' >Please select one</option>";
            //foreach($fields_list as $field_item)
            for($i=0; $i < count($fields_list); $i++)
            {
                $repeat_space = $ideal_field_length - strlen($fields_list[$i]['field']);
                if($repeat_space < 1){
                    $repeat_space = 0;
                }
                echo "\n<option value='".$fields_list[$i]['field']."' ";
                if(isset($init_col_fieldname)) {
                    echo ($init_col_fieldname==$fields_list[$i]['field'] ? " selected='selected'" : "");
                }
                echo " class='monosp'>".$fields_list[$i]['field'].str_repeat("&nbsp;",$repeat_space)."-";
                if(isset($init_col_fieldname)) {
                    echo ($init_col_fieldname==$fields_list[$i]['field'] ? "*" : " ");
                }
                echo $fields_list[$i]['desc']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

if(empty($init_col_sort)){
    $init_col_sort = $max_sort + 100;
}
echo "\n<tr><td>Column Sort Order<td>";
echo form_error('col_sort');
echo "<input type='text' name='col_sort' value='".set_value('col_sort',$init_col_sort)."' size='5' /></td></tr>";

echo "\n<tr><td>Column Title <font color='red'>*</font></td><td>";
echo form_error('col_title1');
echo "<input type='text' name='col_title1' value='".set_value('col_title1',$init_col_title1)."' size='50' /></td></tr>";

echo "\n<tr><td>Column Subtitle</td><td>";
echo form_error('col_title2');
echo "<input type='text' name='col_title2' value='".set_value('col_title2',$init_col_title2)."' size='50' /></td></tr>";

echo "\n<tr><td>Col Format</td><td>";
echo form_error('col_format');
echo "<input type='text' name='col_format' value='".set_value('col_format',$init_col_format)."' size='100' /></td></tr>";

echo "\n<tr><td>Col Transform</td><td>";
echo form_error('col_transform');
echo "<input type='text' name='col_transform' value='".set_value('col_transform',$init_col_transform)."' size='100' /></td></tr>";

echo "\n<tr><td>Col Width min</td><td>";
echo form_error('col_widthmin');
echo "<input type='text' name='col_widthmin' value='".set_value('col_widthmin',$init_col_widthmin)."' size='3' /></td></tr>";

echo "\n<tr><td>Col Width max</td><td>";
echo form_error('col_widthmax');
echo "<input type='text' name='col_widthmax' value='".set_value('col_widthmax',$init_col_widthmax)."' size='4' /></td></tr>";


echo "\n</table>";
echo "</fieldset>";


echo form_hidden('now_id', $now_id);
echo form_hidden('report_header_id', $report_header_id);
echo form_hidden('report_body_id', $report_body_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Add/Edit Column' />";
echo "</div>";

echo "</form>";

echo "</div>";

echo "<fieldset>";
echo "<legend>Header Info</legend>";
echo "\n<table>";
echo "\n<tr><td width='250'>Report Code</td><td>".anchor('ehr_reports/reports_edit_reporthead/edit_report/'.$report_head['report_header_id'],$report_head['report_code'])."</td></tr>";

echo "\n<tr><td>Report Name<td><strong>".$report_head['report_name']."</strong></td></tr>";

echo "\n<tr><td>Report Shortname</td><td>".$report_head['report_shortname']."</td></tr>";

echo "\n<tr><td>Report Title</td><td><strong>".$report_head['report_title1']."</strong></td></tr>";

echo "\n<tr><td>Report Subtitle</td><td>".$report_head['report_title2']."</td></tr>";

echo "\n<tr><td>Report Description</td><td>".$report_head['report_descr']."</td></tr>";

echo "\n<tr><td>Data Source</td><td>".$report_head['report_source']."</td></tr>";

echo "\n<tr><td>Report Section</td><td>".$report_head['report_section']."</td></tr>";

echo "\n<tr><td>Report Scope</td><td>".$report_head['report_scope']."</td></tr>";

echo "\n<tr><td>Report Version</td><td>".$report_head['report_version']."</td></tr>";

echo "\n<tr><td>List Sort</td><td>".$report_head['report_sort']."</td></tr>";

echo "\n</table>";
echo "</fieldset>";

echo "</div>"; //id=content

