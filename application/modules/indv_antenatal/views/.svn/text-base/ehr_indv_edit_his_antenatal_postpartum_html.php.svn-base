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
 * Portions created by the Initial Developer are Copyright (C) 2011 - 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

//include_once("header_xhtml1-strict.php");
//include_once("header_xhtml1-transitional.php");

echo "\n\n<div id='content'>";

if($debug_mode) {
    echo "\n<div class='debug'>";
    print "\n<br />form_purpose = " . $form_purpose;
    print "\n<br />now_id = " . $now_id;
    print "\n<br />patient_id = " . $patient_id;
    print "\n<br />Session info = " . $_SESSION['thirra_mode'];
    print "\n<br />location = " . $_SESSION['location_id'];
    print "\n<br />antenatal_id = " . $antenatal_id;
    print "\n<br />antenatal_postpartum_id = " . $antenatal_postpartum_id;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(antenatal_info)=<br />";
		print_r($antenatal_info);
    echo "\n<br />print_r(antenatal_followup)=<br />";
		print_r($antenatal_followup);
    echo "\n<br />print_r(postpartum_list)=<br />";
		print_r($postpartum_list);
	echo '</pre>';
    echo "\n</div>";
} //endif debug_mode

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_edit_antenatal_postpartum_html_title')."</h1></div>";

//echo validation_errors(); Displays ALL errors in one place.
echo "\n<h2>".$save_attempt."</h2>";

echo "\n<fieldset>";
echo "<legend>POSTPARTUM CARE</legend>";
/*
echo anchor('ehr_consult_antenatal/edit_antenatal_postpartum/new_postpartum/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/new_postpartum', "<strong>Add New Postpartum Care</strong>");
echo "\n<br /><br />";
*/

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Visit Date</th>";
    echo "\n<th width='15'>Days after termination</th>";
    echo "\n<th width='50'>Breastfeeding</th>";
    echo "\n<th width='100'>Fever 38&deg; and above</th>";
    echo "\n<th width='50'>Vaginal bleeding</th>";
    echo "\n<th width='50'>Pallor</th>";
    echo "\n<th width='50'>Remarks</th>";
echo "</tr>";
if(isset($postpartum_list)){
    $rownum = 1;
    foreach ($postpartum_list as $postpartum_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        if($antenatal_postpartum_id == $postpartum_item['antenatal_postpartum_id']){
            echo "\n<td><strong>".$postpartum_item['care_date']."</strong></td>";
        } else {
            echo "\n<td>".anchor('ehr_individual_antenatal/edit_history_antenatal_postpartum/edit_postpartum/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/'.$postpartum_item['antenatal_postpartum_id'], "<strong>".$postpartum_item['care_date']."</strong>")."</td>";
        } //endif($antenatal_id == $followup_item['antenatal_id'])
        echo "\n<td align='center'>".(round((strtotime($postpartum_item['care_date'])-strtotime($postpartum_item['termination_date']))/(60*60*24),1))."</td>";
        echo "\n<td>".$postpartum_item['breastfeed']."</td>";
        echo "\n<td align='center'>".$postpartum_item['fever_38']."</td>";
        echo "\n<td>".$postpartum_item['vaginal_bleeding']."</td>";
        echo "\n<td>".$postpartum_item['pallor']."</td>";
        echo "\n<td>".$postpartum_item['postpartum_remarks']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
} //endif(isset($postpartum_list))
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";


$attributes =   array('class' => 'select_form', 'id' => 'followup_form');
echo form_open('ehr_individual_antenatal/edit_history_antenatal_postpartum/'.$form_purpose.'/'.$patient_id.'/'.$summary_id.'/'.$antenatal_id.'/'.$antenatal_postpartum_id, $attributes);
echo "\n<table>";
echo "\n<tr><td>Visit Date <font color='red'>*</font></td><td>";
echo form_error('care_date');
echo "\n<input type='text' name='care_date' id='care_date' value='".set_value('care_date',$init_care_date)."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Termination Date <font color='red'>*</font></td><td>";
echo form_error('termination_date');
echo "\n<input type='text' name='termination_date' id='termination_date' value='".set_value('termination_date',$init_termination_date)."' size='10' onChange='calculateVP();' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td>Visit period</td><td>";
//echo form_error('visit_period');
//echo "\n<input type='text' name='visit_period' value='".set_value('visit_period',$init_visit_period)."' size='2' />";
echo "\n<input class='disabled' name='visit_period' value='$init_visit_period' type='text' size='3' id='visit_period' readonly='readonly' onFocus='blur();'> ";
echo "days</td></tr>";

echo "\n<tr><td>Breastfeed immediate</td><td>";
echo form_error('breastfeed');
    echo "\n<select name='breastfeed'>";
    if($init_breastfeed == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Immediate' ".($init_breastfeed=='Immediate'?' selected=\'selected\'':'').">Immediate</option>";
    echo "\n<option value='Delayed' ".($init_breastfeed=='Delayed'?' selected=\'selected\'':'').">Delayed</option>";
    echo "\n<option value='Attempted, failed' ".($init_breastfeed=='None'?' selected=\'selected\'':'').">Attempted, failed</option>";
    echo "\n<option value='No attempt' ".($init_breastfeed=='None'?' selected=\'selected\'':'').">No attempt</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Wants family planning</td><td>";
echo form_error('want_family_planning');
echo "\n<select class='normal' name='want_family_planning'>";          
    echo "\n<option value=' ' ".($init_want_family_planning==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_want_family_planning=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Yes' ".($init_want_family_planning=='Yes'?"selected='selected'":"").">Yes</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Fever 38&deg;C and above</td><td>";
echo form_error('fever_38');
echo "\n<select class='normal' name='fever_38'>";          
    echo "\n<option value=' ' ".($init_fever_38==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_fever_38=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Yes' ".($init_fever_38=='Yes'?"selected='selected'":"").">Yes</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Vaginal discharge</td><td>";
echo form_error('vaginal_discharge');
echo "\n<select class='normal' name='vaginal_discharge'>";          
    echo "\n<option value=' ' ".($init_vaginal_discharge==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_vaginal_discharge=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Light' ".($init_vaginal_discharge=='Light'?"selected='selected'":"").">Light</option>";
    echo "\n<option value='Heavy' ".($init_vaginal_discharge=='Heavy'?"selected='selected'":"").">Heavy</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Vaginal bleedings</td><td>";
echo form_error('vaginal_bleeding');
echo "\n<select class='normal' name='vaginal_bleeding'>";          
    echo "\n<option value=' ' ".($init_vaginal_bleeding==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_vaginal_bleeding=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Light' ".($init_vaginal_bleeding=='Light'?"selected='selected'":"").">Light</option>";
    echo "\n<option value='Heavy' ".($init_vaginal_bleeding=='Heavy'?"selected='selected'":"").">Heavy</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Pallor</td><td>";
echo form_error('pallor');
echo "\n<select class='normal' name='pallor'>";          
    echo "\n<option value=' ' ".($init_pallor==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_pallor=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Yes' ".($init_pallor=='Yes'?"selected='selected'":"").">Yes</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Umbilical cord OK?</td><td>";
echo form_error('cord');
echo "\n<select class='normal' name='cord'>";          
    echo "\n<option value=' ' ".($init_cord==' '?"selected='selected'":"").">Choose</option>";
    echo "\n<option value='No' ".($init_cord=='No'?"selected='selected'":"").">No</option>";
    echo "\n<option value='Yes' ".($init_cord=='Yes'?"selected='selected'":"").">Yes</option>";
echo "\n</select>";
echo "\n</td>";
echo "\n</tr>";

echo "\n<tr>";
    echo "\n<td valign='top'>Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='postpartum_remarks' id='postpartum_remarks' cols='40' rows='4'>".$init_postpartum_remarks."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "</table>";
echo form_hidden('save_attempt', $save_attempt);
echo form_hidden('now_id', $now_id);
echo form_hidden('patient_id', $patient_id);
echo form_hidden('summary_id', $summary_id);
echo form_hidden('antenatal_id', $antenatal_id);
echo form_hidden('antenatal_postpartum_id', $antenatal_postpartum_id);

echo "<div align='center'><br />";
echo "<input type='submit' value='Save' />";
echo "</div>";

echo "</form>";


echo "\n<fieldset>";
echo "<legend>ANTENATAL INFO</legend>";
echo "\n<table>";
echo "\n<tr><td>Gravida</td><td>";
echo $antenatal_info[0]['gravida']."</td></tr>";

echo "\n<tr><td>Para</td><td>";
echo $antenatal_info[0]['para']."</td></tr>";

//echo "\n<tr><td>Gestation based on LMP</td><td>";
//echo round((time()-strtotime($antenatal_info[0]['lmp']))/(60*60*24*7),1);
//echo $antenatal_info[0]['lmp_gestation'].;
//echo " weeks</td></tr>";

echo "\n<tr><td>LMP</td><td>";
echo $antenatal_info[0]['lmp']."</td></tr>";

echo "\n<tr><td>EDD based on LMP</td><td>";
echo $antenatal_info[0]['lmp_edd']."</td></tr>";

//echo "\n<tr><td>Planned Place of Delivery </td><td>";
//echo $antenatal_info[0]['planned_place']."</td></tr>";

//echo "\n<tr><td>Record Date</td><td>";
//echo $antenatal_info[0]['date']."</td></tr>";

//echo "\n<tr><td>Method of Contraception</td><td>";
//echo $antenatal_info[0]['method_contraception']."</td></tr>";

echo "\n<tr><td>Abortions</td><td>";
echo $antenatal_info[0]['abortion']."</td></tr>";

echo "\n<tr><td>Husband's Name</td><td>";
echo $antenatal_info[0]['husband_name']."</td></tr>";

echo "\n<tr><td>Husband's Job</td><td>";
echo $antenatal_info[0]['husband_job']."</td></tr>";

echo "\n<tr><td>Husband's DOB</td><td>";
echo $antenatal_info[0]['husband_dob']."</td></tr>";

echo "\n<tr><td>Husband's IC No.</td><td>";
echo $antenatal_info[0]['husband_ic_no']."</td></tr>";

echo "\n<tr><td>Midwife's Name</td><td>";
echo $antenatal_info[0]['midwife_name']."</td></tr>";

//echo "\n<tr><td>Gestation based on LMP</td><td>";
//echo $antenatal_info[0]['lmp_gestation']." weeks</td></tr>";

echo "</table>";
echo "\n</fieldset>";


echo "\n<fieldset>";
echo "<legend>ANTENATAL DELIVERY/TERMINATION</legend>";
echo "\n<table>";
echo "\n<tr><td>Delivery Outcome</td><td>";
echo $delivery_list[0]['delivery_outcome']."</td></tr>";

echo "\n<tr><td>Baby Alive</td><td>";
if($delivery_list[0]['baby_alive'] == TRUE){
    echo "YES";
} else {
    echo "NO";
}
echo "</td></tr>";

echo "\n<tr><td>Delivery Date</td><td>";
echo $delivery_list[0]['date_delivery']."</td></tr>";

echo "\n<tr><td>Delivery Time</td><td>";
echo $delivery_list[0]['time_delivery']."</td></tr>";

echo "\n<tr><td>Gestation based on LMP</td><td>";
echo round((strtotime($delivery_list[0]['date_delivery'])-strtotime($antenatal_info[0]['lmp']))/(60*60*24*7),1);
//echo $antenatal_info[0]['lmp_gestation'].;
echo " weeks</td></tr>";

echo "\n<tr><td>Delivery Type</td><td>";
echo $delivery_list[0]['delivery_type']."</td></tr>";

echo "\n<tr><td>Delivery Place</td><td>";
echo $delivery_list[0]['delivery_place']."</td></tr>";

echo "\n<tr><td>Mother's Condition</td><td>";
echo $delivery_list[0]['mother_condition']."</td></tr>";

echo "\n<tr><td>Baby's Condition</td><td>";
echo $delivery_list[0]['baby_condition']."</td></tr>";

echo "\n<tr><td>Baby's Weight</td><td>";
echo $delivery_list[0]['baby_weight']."g</td></tr>";

echo "\n<tr><td>Birth Attendant</td><td>";
echo $delivery_list[0]['birth_attendant']."</td></tr>";

echo "\n<tr><td>Breastfeed immediate</td><td>";
echo $delivery_list[0]['breastfeed_immediate']."</td></tr>";

echo "\n<tr><td>Postpartum Bleeding</td><td>";
echo $delivery_list[0]['post_partum_bleed']."</td></tr>";

echo "\n<tr><td>Remarks</td><td>";
echo $delivery_list[0]['delivery_remarks']."</td></tr>";

echo "</table>";
echo "\n</fieldset>";


echo "</div>";
?>
<script  type="text/javascript">

    $(function() {
        $( "#next_followup" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c+1'
        });
    });


    $(function() {
        $( "#termination_date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c'
        });
    });


    $(function() {
        $( "#care_date" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: 'c-100:c'
        });
    });


      function calculateVP()
      {
         //if ($("lmp").value == '')
         if (document.getElementById("termination_date").value == '')
            document.getElementById("care_date").value = '';
            //$("est_edd").value = '';
         else
         {
            //var lmp_date = $("lmp").value;
            var lmp_date = document.getElementById("termination_date").value;
            if ((lmp_date.charAt(4) == "-") && (lmp_date.charAt(7) == "-")){
                var lmpYYYY = lmp_date.substring(0,4);
                var lmpMM = lmp_date.substring(5,7) - 1;
                var lmpDD = lmp_date.substring(8,10);
                var lmp_plus_40w  =   new Date(lmpYYYY, lmpMM, lmpDD)
                lmp_plus_40w.setDate(lmp_plus_40w.getDate() + (40*7));

                //var record_date = $("record_date").value;
                //var record_date = document.getElementById("record_date").value;
                var record_date = document.getElementById("care_date").value;
                if ((record_date.charAt(4) == "-") && (record_date.charAt(7) == "-")){
                    var recordYYYY = record_date.substring(0,4);
                    var recordMM = record_date.substring(5,7) - 1;
                    var recordDD = record_date.substring(8,10);
                    var record_date  =   new Date(recordYYYY, recordMM, recordDD)
                    var lmp_date  =   new Date(lmpYYYY, lmpMM, lmpDD)
                    var lmp_till_record = (record_date.getTime() - lmp_date.getTime()) / (1000*60*60*24);


                } else {
                    var lmp_till_record = "Invalid format";
                }

            } else {
                var lmp_plus_40w = "Invalid format";
            }
            //document.getElementById("visit_period").value = lmp_plus_40w;
            document.getElementById("visit_period").value = lmp_till_record;
            //$("est_edd").value = lmp_plus_40w;
            //$("est_duration").value = lmp_till_record;
         }
      }

    window.onload = function() {
        document.getElementById("termination_date").onChange = calculateVP;
        //$("lmp").onChange = calculateEDD;
    }

</script>

