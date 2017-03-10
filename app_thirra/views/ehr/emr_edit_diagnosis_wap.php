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
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(diagnosis_list)=<br />";
		print_r($diagnosis_list);
	echo '</pre>';
    echo "\n<br />diagnosis_id=".$diagnosis_id;
    echo "\n<br />diagnosisChapter=".$diagnosisChapter;
    echo "\n<br />diagnosisCategory=".$diagnosisCategory;
    echo "\n<br />diagnosis=".$diagnosis;
    echo "\n<br />diagnosis2=".$diagnosis2;
    echo "\n<br />diagnosis_type=".$diagnosis_type;
    echo "\n<br />diagnosis_notes=".$diagnosis_notes;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_diagnosis_html_title')."</h1></div>";

echo "\n\n<div id='current_diagnosis' class='episodeblock'>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>Code</th>";
    echo "\n<th width='400'>Title</th>";
    echo "\n<th>Type</th>";
    echo "\n<th>Notes</th>";
echo "</tr>";
if(count($diagnosis_list) > 0){
    foreach ($diagnosis_list as $diagnosis_item){
        echo "\n<tr>";
        echo "<td>".anchor('ehr_consult/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$summary_id.'/'.$diagnosis_item['diagnosis_id'], $diagnosis_item['dcode1ext_code'])."</td>";
        echo "<td width='400'>".$diagnosis_item['full_title']."</td>";
        echo "<td>".$diagnosis_item['diagnosis_type']."</td>";
        echo "<td>".$diagnosis_item['diagnosis_notes']."</td>";
        echo "</tr>";
    }//endforeach;
} else {
    echo "\n<tr><td>None recorded</td></tr>";
} //endif(count($diagnosis_list) > 0)
echo "</table>";
echo "</div>"; //id='current_diagnosis'


$attributes =   array('class' => 'select_form', 'id' => 'diagnosis_form');
echo form_open('ehr_consult/edit_diagnosis/'.$patient_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('diagnosis_id', $diagnosis_id);

echo "\n<table class='header' width='100%' align='center'>";
echo "<tr><td><b>Diagnosis</b></td></tr>";
echo "</table>";
echo "\n<table class='frame' width='100%' align='center'>";
echo "<tr>";
    echo "\n<td width='25%'>Chapter <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='diagnosisChapter' class='normal' onchange='javascript:selectDiagnosisCategory()' id='diagnosisChapter'>";
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='javascript:selectDiagnosisCategory()'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($dcode1_chapters as $chapter)
        {
            echo "\n<option label='".$chapter['chapter']."' value='".$chapter['chapter']."'";
            echo ($diagnosisChapter == $chapter['chapter'] ? " selected='selected'" : "");
            echo ">".$chapter['chapter']."</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Category (ICD-10)<font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='diagnosisCategory' class='normal' onchange='javascript:selectDiagnosis()' id='diagnosisCategory'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($dcode1_list as $dcode1)
            {
	            echo "\n<option value='".$dcode1['dcode1_code']."' ";
                if(isset($diagnosisCategory)) {
                    echo ($diagnosisCategory==$dcode1['dcode1_code'] ? " selected='selected'" : "");
                }
                echo ">".$dcode1['full_title']."&nbsp;&nbsp;[".$dcode1['dcode1_code']."]</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td width='25%'>Diagnosis <font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
    echo form_error('diagnosis');
        echo "\n<select name='diagnosis' class='normal' onchange='javascript:selectDiagnosis2()' id='diagnosis'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($dcode1ext_list as $dcode1ext)
            {
	            echo "\n<option value='".$dcode1ext['dcode1ext_code']."' ";
                if(isset($diagnosis)) {
                    echo ($diagnosis==$dcode1ext['dcode1ext_code'] ? "selected='selected'" : "");
                }
                echo ">".substr($dcode1ext['full_title'],0,100)."&nbsp;&nbsp;[".$dcode1ext['dcode1ext_code']."]</option>";
            }
        echo "</select>";

    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td>Maps to ICPC-2</td>";
    echo "\n<td colspan='2'>";
        echo "<select name='diagnosis2' class='normal' id='diagnosis2'>";
        if(count($dcode2ext_list) > 0) {
            foreach($dcode2ext_list as $dcode2ext) 
            {
	            echo "\n<option value='".$dcode2ext['dcode2ext_code']."'>".$dcode2ext['full_title']."&nbsp;&nbsp;[".$dcode2ext['dcode2ext_code']."]</option>";
            }
        } else {
            echo "\n<option value='' selected='selected'>Not applicable</option>";
        }
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td width='25%'>Type <font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('diagnosis_type');
        echo "<select class='normal' name='diagnosis_type'>";          
            echo "\n<option value='Primary' ".set_select('diagnosis_type','Primary').">Primary</option>";
            echo "\n<option value='Secondary' ".set_select('diagnosis_type','Secondary').">Secondary</option>";
        echo "\n</select>";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'>Further Elaboration on Diagnosis <font color='red'>*</font></td>";
    echo "\n<td>";
    echo form_error('diagnosis_notes');
    echo "\n<textarea class='normal' name='diagnosis_notes' cols='40' rows='4'>".$diagnosis_notes."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Enter Diagnosis' />";
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

        function selectDiagnosisCategory(){
            $("diagnosis_form").status.value="Unfinished";
            $("diagnosisCategory").selectedIndex = -1;
            $("diagnosis").selectedIndex = -1;
            $("diagnosis2").selectedIndex = -1;
            $("diagnosis_form").submit.click();
        }

        function selectDiagnosis(){
            $("diagnosis_form").status.value="Unfinished";
            $("diagnosis").selectedIndex = -1;
            $("diagnosis2").selectedIndex = -1;
            $("diagnosis_form").submit.click();
        }

         function selectDiagnosis2()
         {
            $("diagnosis_form").status.value="Unfinished";
            $("diagnosis2").selectedIndex = -1;
            $("diagnosis_form").submit.click();
         }
      </script>


