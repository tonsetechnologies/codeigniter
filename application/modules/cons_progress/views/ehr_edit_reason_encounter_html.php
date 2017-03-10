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

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $this->session->userdata('thirra_mode');
    print "<br />User = " . $this->session->userdata('username');
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		//print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(ccode1_chapters)=<br />";
		print_r($ccode1_chapters);
    echo "\n<br />print_r(complaints_list)=<br />";
		print_r($complaints_list);
	echo '</pre>';
    echo "\n<br />complaint_id=".$complaint_id;
    echo "\n<br />complaintChapter=".$complaintChapter;
    echo "\n<br />complaintCode=".$complaintCode;
    echo "\n<br />duration=".$duration;
    echo "\n<br />complaint_notes=".$complaint_notes;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_reason_encounter_html_title')."</h1></div>";

echo "\n\n<div id='complaints' class='episodeblock'>";
echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>Code</th>";
    echo "\n<th width='400'>Title</th>";
    echo "\n<th>Duration</th>";
    echo "\n<th>Notes</th>";
echo "</tr>";
if(count($complaints_list) > 0){
    foreach ($complaints_list as $complaint_item){
        echo "\n<tr>";
        echo "<td>".anchor('cons/cons/index/cons_progress/ehr_consult/edit_reason_encounter/edit_complaint/'.$patient_id.'/'.$summary_id.'/'.$complaint_item['complaint_id'], $complaint_item['icpc_code'])."</td>";
        echo "<td width='400'>".$complaint_item['full_description']."</td>";
        echo "<td>".$complaint_item['duration']."</td>";
        echo "<td>".$complaint_item['complaint_notes']."</td>";
        $delete_link    =   base_url()."index.php/cons/cons/index/cons_progress/ehr_consult/consult_delete_complaint/delete_complaint/".$patient_id."/".$summary_id."/".$complaint_item['complaint_id'];
        echo "\n<td><a href=\"javascript:deleteRecord('remove','Complaint:".$complaint_item['full_description']."','".$delete_link ."');\">delete</a></td>";
        //echo "\n<td>".anchor('cons/cons/index/cons_progress/ehr_consult/consult_delete_complaint/'.$patient_id.'/'.$summary_id.'/'.$complaint_item['complaint_id'], 'delete')."</td>";
        echo "</tr>";
    }//endforeach;
} else {
    echo "\n<tr><td>None recorded</td></tr>";
} //endif(count($complaints_list) > 0)
echo "</table>";
echo "</div>"; //id='complaints'


$attributes =   array('class' => 'select_form', 'id' => 'complaint_form');
echo form_open('cons/cons/index/cons_progress/ehr_consult/edit_reason_encounter/edit_complaint/'.$patient_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('complaint_id', $complaint_id);

echo "\n<table class='header' width='100%' align='center'>";
echo "<tr><td><b>Complaint</b></td></tr>";
echo "</table>";
echo "\n<table class='frame' width='100%' align='center'>";
echo "<tr>";
    echo "\n<td width='25%'>Chapter <font color='red'>*</font></td>";
    echo "<td colspan='2' class='red'>";   
    echo "\n<select name='complaintChapter' class='normal' onchange='javascript:selectLevel1()' id='complaintChapter'>";
        echo "\n<option label='' value='0' selected='selected'></option>";
        foreach($ccode1_chapters as $chapter)
        {
            echo "\n<option value='".rtrim($chapter['category_code'])."'";
            echo ($complaintChapter == rtrim($chapter['category_code']) ? " selected='selected'" : "");
            echo ">".$chapter['category_code']." - ".$chapter['description']."</option>";
        } //endforeach($ccode1_chapters as $chapter)
            echo "\n<option value='all'";
            echo (($complaintChapter == 'all') ? " selected='selected'" : "");
            echo ">All = Full list</option>";
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Complaint<font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='complaintCode' class='normal' onchange='javascript:selectLevel2()' id='complaintCode'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($ccode1_list as $ccode1)
            {
	            echo "\n<option value='".$ccode1['icpc_code']."' ";
                if(isset($complaintCode)) {
                    echo ($complaintCode==$ccode1['icpc_code'] ? " selected='selected'" : "");
                }
                echo ">".$ccode1['full_description']." &nbsp;&nbsp;&nbsp;[".$ccode1['icpc_code']."]</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "\n<td width='25%'>Subcode<font color='red'>*</font></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='level3' class='normal' id='level3'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($level3_list as $level3_item)
            {
	            echo "\n<option value='".$level3_item['marker']."' ";
                if(isset($level3)) {
                    echo ($level3==$level3_item['marker'] ? " selected='selected'" : "");
                }
                echo ">".$level3_item['info']."</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

echo "\n<tr>";
    echo "<td>Duration</td>";
    echo "<td>";
        echo "<input type='text' class='normal' name='duration' value='$duration' id='duration' />";          
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td>Further Elaboration on complaint</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='complaint_notes' id='diagnosis2' cols='40' rows='4'>".$complaint_notes."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Enter Complaint' />";
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

        function selectLevel1(){
            $("complaint_form").status.value="Unfinished";
            $("complaintCode").selectedIndex = -1;
            $("level3").selectedIndex = -1;
            $("diagnosis2").selectedIndex = -1;
            $("complaint_form").submit.click();
        }

        function selectLevel2(){
            $("complaint_form").status.value="Unfinished";
            $("level3").selectedIndex = -1;
            $("diagnosis2").selectedIndex = -1;
            $("complaint_form").submit.click();
        }


        function deleteRecord($action, $name, $link){            
            if(confirm("Are you sure you want to " + $action + " this " + $name + " ?")){
                window.open($link, "_top");
            }
        }
      </script>


