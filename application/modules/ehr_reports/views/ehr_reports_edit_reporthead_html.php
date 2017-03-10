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
    print "\n<br />user_id = " . $user_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(report_head)=<br />";
		print_r($report_head);
    echo "\n<br />print_r(report_body)=<br />";
		print_r($report_body);
    echo "\n<br />print_r(reports_sources)=<br />";
		print_r($reports_sources);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('reports_edit_reporthead_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<p>".anchor('ehr/ehr/index/ehr_reports/ehr_reports/reports_select_report/edit_param/'.$report_header_id, ' <strong>PRINT REPORT</strong>', "target='_blank'")."</p>";

//echo validation_errors(); Displays ALL errors in one place.
echo form_open('ehr/ehr/index/ehr_reports/ehr_reports/reports_edit_reporthead/'.$form_purpose.'/'.$report_header_id);

echo "<fieldset>";
echo "<legend>Header Info</legend>";
echo "\n<table>";
echo "\n<tr><td>Report Code </td><td>";
echo form_error('report_code');
echo "\n<input type='text' name='report_code' value='".set_value('report_code',$init_report_code)."' size='20' /></td></tr>";

echo "\n<tr><td>Report Name <font color='red'>*</font><td>";
echo form_error('report_name');
echo "<input type='text' name='report_name' value='".set_value('report_name',$init_report_name)."' size='100' /></td></tr>";

echo "\n<tr><td>Report Shortname <font color='red'>*</font></td><td>";
echo form_error('report_shortname');
echo "<input type='text' name='report_shortname' value='".set_value('report_shortname',$init_report_shortname)."' size='50' /></td></tr>";

echo "\n<tr><td>Report Title <font color='red'>*</font></td><td>";
echo form_error('report_title1');
echo "<input type='text' name='report_title1' value='".set_value('report_title1',$init_report_title1)."' size='100' /></td></tr>";

echo "\n<tr><td>Report Subtitle</td><td>";
echo form_error('report_title2');
echo "<input type='text' name='report_title2' value='".set_value('report_title2',$init_report_title2)."' size='100' /></td></tr>";

echo "\n<tr><td>Report Description</td><td>";
echo form_error('report_descr');
echo "<input type='text' name='report_descr' value='".set_value('report_descr',$init_report_descr)."' size='100' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='250'>Data Source <font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo form_error('report_source');
        if(!empty($report_body)){
            echo form_hidden('report_source', $init_report_source);
            echo $init_report_source;
        } else {
            echo "\n<select name='report_source' class='normal' onchange='javascript:select_one_package()' id='report_source'>";
                echo "\n<option value='' >Please select one</option>";
                //foreach($fields_list as $field_item)
                for($i=1; $i <= count($reports_sources); $i++)
                {
                    $repeat_space = $ideal_field_length - strlen($reports_sources[$i]['view']);
                    if($repeat_space < 1){
                        $repeat_space = 0;
                    }
                    echo "\n<option value='".$reports_sources[$i]['view']."' ";
                    if(isset($init_report_source)) {
                        echo ($init_report_source==$reports_sources[$i]['view'] ? " selected='selected'" : "");
                    }
                    echo " class='monosp'>".$reports_sources[$i]['view'].str_repeat("&nbsp;",$repeat_space)."-";
                    if(isset($init_report_source)) {
                        echo ($init_report_source==$reports_sources[$i]['view'] ? "*" : " ");
                    }
                    echo $reports_sources[$i]['desc']."</option>";
                } //endforeach
            echo "</select>";
        } //endif(isset($report_body))
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Data Sort Order</td><td>";
echo form_error('report_db_sort');
echo "<input type='text' name='report_db_sort' value='".set_value('report_db_sort',$init_report_db_sort)."' size='100' /></td></tr>";

echo "\n<tr><td>Data groupby</td><td>";
echo form_error('report_db_groupby');
echo "<input type='text' name='report_db_groupby' value='".set_value('report_db_groupby',$init_report_db_groupby)."' size='100' /></td></tr>";

echo "\n<tr><td>Data having</td><td>";
echo form_error('report_db_having');
echo "<input type='text' name='report_db_having' value='".set_value('report_db_having',$init_report_db_having)."' size='100' /></td></tr>";

echo "\n<tr><td>Report Section</td><td>";
echo form_error('report_section');
echo "<input type='text' name='report_section' value='".set_value('report_section',$init_report_section)."' size='40' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='200'>Report Scope <font color='red'>*</font></td>";
    echo "\n<td>";
        echo "\n<select name='report_scope' class='normal' id='report_scope'>";
            //echo "\n<option value='' >Please select one</option>";
            foreach($reports_scope as $scope)
            {
	            echo "\n<option value='".$scope['scope']."' ";
                if(isset($init_report_scope)) {
                    echo ($init_report_scope==$scope['scope'] ? " selected='selected'" : "");
                }
                echo ">".$scope['scope']."&nbsp;-&nbsp;".$scope['desc']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr><td>Filter by Sex</td><td>";
echo form_error('report_filter_sex');
echo "<input type='text' name='report_filter_sex' value='".set_value('report_filter_sex',$init_report_filter_sex)."' size='1' /></td></tr>";

echo "\n<tr><td>Age from</td><td>";
echo form_error('report_filter_olderthan');
echo "<input type='text' name='report_filter_olderthan' value='".set_value('report_filter_olderthan',$init_report_filter_olderthan)."' size='3' /> years old</td></tr>";

echo "\n<tr><td>Age to</td><td>";
echo form_error('report_filter_youngerthan');
echo "<input type='text' name='report_filter_youngerthan' value='".set_value('report_filter_youngerthan',$init_report_filter_youngerthan)."' size='3' /> years old</td></tr>";

echo "\n<tr><td>Report filter_1<td>";
echo form_error('report_filter_1');
echo "<input type='text' name='report_filter_1' value='".set_value('report_filter_1',$init_report_filter_1)."' size='100' /></td></tr>";

echo "\n<tr><td>Report filter_2<td>";
echo form_error('report_filter_2');
echo "<input type='text' name='report_filter_2' value='".set_value('report_filter_2',$init_report_filter_2)."' size='100' /></td></tr>";

echo "\n<tr><td>Report Version</td><td>";
echo form_error('report_version');
echo "<input type='text' name='report_version' value='".set_value('report_version',$init_report_version)."' size='10' /></td></tr>";

echo "\n<tr><td>List Order</td><td>";
echo form_error('report_sort');
echo "<input type='text' name='report_sort' value='".set_value('report_sort',$init_report_sort)."' size='5' /></td></tr>";

echo "\n<tr><td>Paper Orientation</td><td>";
echo form_error('report_paper_orient');
    echo "\n<select name='report_paper_orient'>";
    echo "\n<option value='Landscape'".($init_report_paper_orient=='Landscape'?' selected=\'selected\'':'').">Landscape</option>";
    echo "\n<option value='Portrait'".($init_report_paper_orient=='Portrait'?' selected=\'selected\'':'').">Portrait</option>";
    echo "\n</select>";
//echo "<input type='text' name='report_paper_orient' value='".set_value('report_paper_orient',$init_report_paper_orient)."' size='10' /></td></tr>";

echo "\n<tr><td>Paper Size</td><td>";
echo form_error('report_paper_size');
    echo "\n<select name='report_paper_size'>";
    echo "\n<option value='A2'".($init_report_paper_size=='A2'?' selected=\'selected\'':'').">A2</option>";
    echo "\n<option value='A3'".($init_report_paper_size=='A3'?' selected=\'selected\'':'').">A3</option>";
    echo "\n<option value='A4'".($init_report_paper_size=='A4'?' selected=\'selected\'':'').">A4</option>";
    echo "\n<option value='A5'".($init_report_paper_size=='A5'?' selected=\'selected\'':'').">A5</option>";
    echo "\n</select>";
//echo "<input type='text' name='report_paper_size' value='".set_value('report_paper_size',$init_report_paper_size)."' size='20' /></td></tr>";

echo "\n</table>";
echo "</fieldset>";


echo form_hidden('now_id', $now_id);
echo form_hidden('report_header_id', $report_header_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Add/Edit Template' />";
echo "</div>";

echo "</form>";

echo "<fieldset>";
echo "<legend>Body Info</legend>";

if($report_header_id <> 'new_report'){
    echo anchor('ehr/ehr/index/ehr_reports/ehr_reports/reports_edit_reportbody/new_body/'.$report_header_id.'/new_body', "<strong>Add Column</strong>");
} else {
    echo "Add Column";
}
echo "\n<br /><br />";

    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<th width='200'>Data</th>";
        echo "\n<th width='70'>Sort</th>";
        echo "\n<th colspan='3' align='center'>Column Title</th>";
        echo "\n<th></th>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<th width='200'>Field</th>";
        echo "\n<th width='70'>Order</th>";
        echo "\n<th>Line 1</th>";
            echo "<td> | </td>";
        echo "\n<th>Line 2</th>";
    echo "</tr>";
    if(isset($report_body)){
        foreach ($report_body as $body_item){
            echo "\n<tr>";
            echo "<td>".anchor('ehr/ehr/index/ehr_reports/ehr_reports/reports_edit_reportbody/edit_body/'.$body_item['report_header_id']."/".$body_item['report_body_id'], $body_item['col_fieldname'])."</td>";
            echo "<td>".$body_item['col_sort']."</td>";
            echo "<td>".$body_item['col_title1']."</td>";
            echo "<td> | </td>";
            echo "<td>".$body_item['col_title2']."</td>";
    $delete_link    =   base_url()."index.php/ehr/ehr/index/ehr_reports/ehr_reports/reports_delete_reportbody/".$body_item['report_header_id']."/".$body_item['report_body_id'];
    echo "\n<td><a href=\"javascript:deleteRecord('remove','Column:".$body_item['col_fieldname']."','".$delete_link ."');\">delete</a>";
            //echo "<td>".anchor('ehr_reports/reports_delete_reportbody/'.$body_item['report_header_id']."/".$body_item['report_body_id'], 'delete')."</td>";
            echo "</tr>";
        }//endforeach;
    }
    echo "\n</table>";
echo "</fieldset>";
echo "</div>";

echo "</div>"; //id=content
?>
    <script  type="text/javascript">

        function deleteRecord($action, $name, $link){            
            if(confirm("Are you sure you want to " + $action + " this " + $name + " ?")){
                window.open($link, "_top");
            }
        }
      </script>


