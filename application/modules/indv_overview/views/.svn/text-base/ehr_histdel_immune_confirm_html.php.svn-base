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
    echo "\n<br />print_r(vaccination_table)=<br />";
		print_r($vaccination_table);
    echo "\n<br />print_r(vaccines_list)=<br />";
		print_r($vaccines_list);
    echo "\n<br />print_r(prescribe_list)=<br />";
		print_r($prescribe_list);
	echo '</pre>';
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_immune_prescribe_html_title')."</h1></div>";


$attributes =   array('class' => 'select_form', 'id' => 'prescription_form');
echo form_open('indv/indv/index/indv_overview/ehr_individual/histdel_immune_exec/'.$patient_id, $attributes);

echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('patient_immunisation_id', $patient_immunisation_id);

echo form_error('vaccine');
$total_columns      =   count($vaccination_table);
echo "\n<table border='1'>";
echo "\n<tr>";
    echo "<td></td>";
    echo "<th colspan='".$total_columns."' align='center'>Month</th>";
echo "\n<tr>";
echo "<tr>";
    echo "<th>Vaccine</th>";
for($i=0; $i < $total_columns; $i++){
    $current_column =   $i;
    $age_column     =   $vaccination_table[$i];
    echo "\n<th width='20'>&nbsp;&nbsp;&nbsp;&nbsp;".$vaccination_table[$i]."&nbsp;&nbsp;&nbsp;&nbsp;</th>";
}
echo "\n<tr>";

$previous_vaccine   =   "";
$previous_column    =   $total_columns;
foreach($vaccines_list as $vaccine){
    if($previous_vaccine <> $vaccine['vaccine']){
        $columns_leftover   =   $total_columns - $previous_column - 1;
        if($columns_leftover < 0){
            $columns_leftover = 0;
        }
        echo str_repeat("<td>&nbsp;</td>",$columns_leftover);
        echo "\n</tr><tr>";
            echo "\n<td>".$vaccine['vaccine_short'];
            echo "</td>";
        $previous_column = -1;
    }

    for($i=0; $i < count($vaccination_table); $i++){
        //$current_column =   0;
        $current_column =   $i;
        $age_column     =   $vaccination_table[$i];
        if($current_column > $previous_column){
            if($vaccine['age_group'] == $age_column){
                if(isset($vaccine['date'])){
                    if($patient_immunisation_id == $vaccine['patient_immunisation_id']){
                        echo "\n<td bgcolor='OrangeRed'>";
                    } else {
                        echo "\n<td bgcolor='RoyalBlue'>";
                    }
                    echo $vaccine['date'];
                } else {
                    echo "\n<td bgcolor='yellow' width='100'>";
                    //echo "\n<input type='radio' name='vaccine_id' value='".trim($vaccine['immunisation_id'])."' ".set_radio('vaccine_id','vaccine_id',($vaccine_id==' '?TRUE:FALSE))." ><strong>Choose</strong></input>";
                    //echo "<strong>";
                	//echo anchor('ehr_consult/edit_immune_prescribe/new_immune/'.$patient_id.'/'.$summary_id.'/'.trim($vaccine['immunisation_id']), 'Select');
                    //echo "</strong>";
                }
                echo "\n<br />".$vaccine['dose'];
                if($debug_mode){
                    echo "\n<br />".$vaccine['vaccine'];
                    echo " A=".$vaccine['age_group'];
                    echo " S=".$vaccine['immunisation_sort'];
                    echo " AC=".$age_column;
                    echo " C=".$current_column;
                    echo " PV=".$previous_vaccine;
                }
                if(isset($vaccine['date'])){
                    //if($summary_id == $vaccine['session_id']){
                	    //echo anchor('ehr_individual/confirm_immune_delete/'.$patient_id.'/'.trim($vaccine['patient_immunisation_id']), '(x)');
                        //echo "(x)";
                    //}
                }
                echo "</td>";;
                $previous_column    = $current_column;
                $previous_vaccine   = $vaccine['vaccine'];
                break;//continue;
            } else {
                echo "\n<td>&nbsp;</td>";
            } //endif($vaccine['age_group'] == $age_column)
        } else {
            // do nothing
        } //endif($current_column > $previous_column)
    } //endfor($i=0; $i <= count($vaccination_table); $i++)


    $previous_vaccine   = $vaccine['vaccine']; // no longer touch due to continue
} //endforeach($vaccines_list as $vaccine)
echo "</table><br />";

// Table Legends
echo "\n<table width='100%' align='center'>";
echo "\n<tr>";
    echo "<td width='50' bgcolor='RoyalBlue'>&nbsp;</td>";
    echo "<td>Previously administered</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td bgcolor='OrangeRed'>&nbsp;</td>";
    echo "<td>TO DELETE</td>";
echo "</tr>";
echo "\n<tr>";
    echo "<td bgcolor='yellow'>&nbsp;</td>";
    echo "<td>Not administered</td>";
echo "</tr>";
/*
echo "\n<tr>";
    echo "<td bgcolor='orange'>&nbsp;</td>";
    echo "<td>Current selection</td>";
echo "</tr>";
*/
echo "\n</table><br />";



echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='Delete Vaccination History' />";
echo "\n</center>";

echo "\n</form>";
echo "\n<br />";
echo "</div>";

