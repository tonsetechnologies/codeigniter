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

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
    print "<br />age_menarche = " . $age_menarche;
	echo '<pre>';
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patient_age)=<br />";
		print_r($patient_age);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(patient_past_con)=<br />";
		print_r($patient_past_con);
    echo "\n<br />print_r(queue_info)=<br />";
		print_r($queue_info);
    echo "\n<br />print_r(vitals_info)=<br />";
		print_r($vitals_info);
    echo "\n<br />print_r(medication_info)=<br />";
		print_r($medication_info);
    echo "\n<br />print_r(lab_info)=<br />";
		print_r($lab_info);
    echo "\n<br />print_r(imaging_info)=<br />";
		print_r($imaging_info);
    echo "\n<br />print_r(diagnoses_info)=<br />";
		print_r($diagnoses_info);
    echo "\n<br />print_r(social_history)=<br />";
		print_r($social_history);
    echo "\n<br />print_r(vaccines_list)=<br />";
		print_r($vaccines_list);
    echo "\n<br />print_r(history_antenatal)=<br />";
		print_r($history_antenatal);
    echo "\n<br />print_r(antenatal_checkup)=<br />";
		print_r($antenatal_checkup);
    echo "\n<br />print_r(referrals_list)=<br />";
		print_r($referrals_list);
	echo '</pre>';
    echo "\n</div>";
}

if($multicolumn){
    $column_newrow  =   "\n</td>\n</tr>\n<tr>\n<td valign='top'>";
    $column_newcol  =   "\n</td>\n<td valign='top'>";
} else {
    $column_newrow  =   "";
    $column_newcol  =   "";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('12000-100_patients_indv_overview_html_title')."</h1></div>";

echo "\n<p /><span class='simple_button_yellow' >";
if($patcon_info['summary_id'] == "new_summary"){
    echo anchor('ehr_consult/consult_new/'.trim($patient_info['patient_id']).'/'.$patcon_info['summary_id'], 'Start New Consultation', 'target="_blank"');
} else {
    echo anchor('ehr_consult/consult_episode/'.trim($patient_info['patient_id']).'/'.$patcon_info['summary_id'], 'Continue Consultation started on '.$patcon_info['date_started'], 'target="_blank"');
} //endif $patcon_info['summary_id'] == "new_summary")
echo "</span>";
/*
echo "\n<p />";
//echo $patient_past_con['date_started'];
echo "\n<u>Past Consultations</u>";
if(count($patient_past_con) > 0){
    echo "<table>";
    echo "\n<tr>";
        echo "<th></th>";
        echo "<th>Date</th>";
        echo "<th>Clinic</th>";
        echo "<th>Summary</th>";
    echo "</tr>";
    foreach ($patient_past_con as $consultation){
        echo "<tr><td valign='top'>";
	    echo anchor('ehr_individual/past_con_details/'.trim($consultation['patient_id']).'/'.$consultation['summary_id'].'/html ', 'html', 'target="_blank"');
        echo "  ";
	    echo anchor('ehr_individual/past_con_details/'.trim($consultation['patient_id']).'/'.$consultation['summary_id'].'/pdf ', 'pdf', 'target="_blank"');
        echo " </td><td valign='top'> ";
        echo $consultation['date_ended'];
        echo " </td><td valign='top'><strong>".$consultation['clinic_shortname']."</strong>";
        echo " </td><td valign='top'> ".$consultation['summary'];
        echo "</td></tr>";
    }
    //endforeach;
    echo "</table>";
} else {
    echo "\n: First time visit.";
}
*/

if($multicolumn){
    echo "\n<table border='1' class='overviewcard'>";
}

if($multicolumn){
    echo "\n<tr>";
        echo "\n<td valign='top' colspan='2'>";
}
            echo "\n\n<div id='past_con'>"; // class='overviewblock'
                echo "\n<div class='block_title_ovv'>PAST CONSULTATIONS</div>";
                if(count($patient_past_con) > 0){
                    echo "<table>";
                    echo "\n<tr>";
                        echo "<th>Details</th>";
                        echo "<th>Date</th>";
                        echo "<th>Time</th>";
                        echo "<th>Clinic</th>";
                        echo "<th>Summary</th>";
                    echo "</tr>";
                    foreach ($patient_past_con as $consultation){
                        echo "<tr><td valign='top'>";
	                    echo anchor('ehr_individual/past_con_details/'.trim($consultation['patient_id']).'/'.$consultation['summary_id'].'/html ', 'html', 'target="_blank"');
                        echo "  ";
	                    echo anchor('ehr_individual/past_con_details/'.trim($consultation['patient_id']).'/'.$consultation['summary_id'].'/pdf ', 'pdf', 'target="_blank"');
                        echo " </td>";
                        echo "<td valign='top'><strong>".$consultation['date_ended']."</strong></td>";
                        echo "<td valign='top'>".$consultation['time_ended']."</td>";
                        echo "<td valign='top'><strong>".$consultation['clinic_shortname']."</strong>";
                        echo " </td><td valign='top'> ".$consultation['summary'];
                        echo "</td></tr>";
                    }
                    //endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br />&nbsp;First time visit.<br />";
                }
            echo "</div>"; //id='drug_allergies'

echo $column_newrow;
/*
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";

    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
*/
            echo "\n\n<div id='drug_allergies' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
	            echo anchor('ehr_individual/list_drug_allergies/'.$patient_id, 'DRUG ALLERGIES');
                echo "</div>";
                echo "\n<table>";
                if(count($drug_allergies) > 0){
                    $rownum = 1;
                    foreach ($drug_allergies as $allergy_item){
                        echo "\n<tr>";
                        echo "\n<td>".$rownum.".</td>";
                        echo "\n<td bgcolor='red' ><strong><font color='white'>".$allergy_item['generic_name']."</font></strong></td>";
                        //echo "\n<td>".anchor('ehr_individual/edit_drug_allergy/edit_allergy/'.$patient_id.'/'.$allergy_item['patient_drug_allergy_id'], "<strong>".$allergy_item['generic_name']."</strong></td>");
                        echo "\n<td>".$allergy_item['reaction']."</td>";
                        echo "\n</tr>";
                        $rownum++;
                    }//endforeach;
                } else {
                    echo "\n<tr><td><br /> None recorded</td></tr>";
                } //endif(isset($allergy_list))
                echo "\n</table>";
            echo "</div>"; //id='drug_allergies'
        echo "\n</td>";
        echo "\n<td valign='top'>";
            echo "\n\n<div id='other_allergies' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>OTHER ALLERGIES</div>";
                    echo "\n<br /> None recorded";
            echo "</div>"; //id='other_allergies'
echo $column_newrow;
/*
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";

    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
*/
            echo "\n\n<div id='vitals' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
        	    echo anchor('ehr_individual_history/list_history_vitals/'.$patient_id, 'VITAL SIGNS');
                echo "</div>";
                if(isset($vitals_info['vital_id']) && ($vitals_info['vital_id'] <> "new_vitals")){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<td width='180'>Temperature</td>";
                        echo "<td width='65' align='right'>".$vitals_info['temperature']."</td>";
                        echo "\n<td width='85'>";
                        echo (!empty($vitals_info['temperature']))?"&deg;C":"-";
                        echo "</td>";
                        echo "\n<td width='180'>Pulse Rate</td>";
                        echo "<td width='65' align='right'>".$vitals_info['pulse_rate']."</td>";
                        echo "\n<td width='85'>";
                        echo (!empty($vitals_info['pulse_rate']))?"bpm":"-";
                        echo "</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>BP systolic</td>";
                        echo "<td align='right'>".$vitals_info['bp_systolic']."</td>";
                        echo "\n<td>";
                        echo (!empty($vitals_info['bp_systolic']))?"mm Hg":"-";
                        echo "</td>";
                        //mm Hg</td>";
                        echo "\n<td>BP diastolic</td>";
                        echo "<td align='right'>".$vitals_info['bp_diastolic']."</td>";
                        echo "\n<td>";
                        echo (!empty($vitals_info['bp_diastolic']))?"mm Hg":"-";
                        echo "</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>Height</td>";
                        echo "<td width='50' align='right'>".$vitals_info['height']."</td>";
                        echo "\n<td>";
                        echo (!empty($vitals_info['height']))?"cm":"-";
                        echo "</td>";
                        echo "\n<td>Weight</td>";
                        echo "<td width='50' align='right'>".$vitals_info['weight']."</td>";
                        echo "\n<td>";
                        echo (!empty($vitals_info['weight']))?"kg":"-";
                        echo "</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td></td>";
                        echo "<td></td>";
                        echo "\n<td></td>";
                        echo "<td></td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>[@ ".$vitals_info['reading_date']."]</td>";
                        echo "<td></td><td></td><td>";
                        echo anchor('ehr_individual_history/list_history_vitals/'.$patient_id, 'View Charts');
                        echo "</td>";
                        echo "\n<td></td>";
                        echo "<td></td>";
                    echo "\n</tr>";
                    echo "\n</table>";
                } else {
                    echo "\n<br /> None recorded";
                    //    echo anchor('ehr_individual_history/list_history_vitals/'.$patient_id, ' Chart');
                }
            echo "</div>"; //id='vitals'
echo $column_newcol;
/*
if($multicolumn){
        echo "\n</td>";
        echo "\n<td valign='top'>";
}
*/
            echo "\n\n<div id='appointments' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>APPOINTMENTS</div>";
                if(count($queue_info) > 0){
                    echo "\n<table class=''>";
                    echo "\n<tr>";
                        echo "\n<th>Date</th>";
                        echo "\n<th width='200'>Clinic</th>";
                        echo "\n<th>Consultant</th>";
                        echo "\n<th>Remarks</th>";
                    echo "</tr>";
                    foreach ($queue_info as $queue_item){
                        echo "<tr>";
                        echo "<td><strong>".$queue_item['date']."</strong></td>";
                        echo "<td valign='top'>".$queue_item['clinic_shortname']."</td>";
                        echo "<td valign='top'>".$queue_item['staff_initials']."</td>";
                        echo "<td valign='top'>".$queue_item['remarks']."</td>";
                       echo "</tr>";
                     }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($queue_info) > 0)
            echo "</div>"; //id='appointments'
echo $column_newrow;
/*
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";

    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
*/
            echo "\n\n<div id='prediagnostic_history' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>PRE-DIAGNOSTIC OBSERVATIONS</div>";
                if(count($prediagnoses_info) > 0){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th width='95'>Date</th>";
                        //echo "\n<th>Code</th>";
                        echo "\n<th>Title</th>";
                        echo "\n<th>Notes</th>";
                    echo "</tr>";
                    foreach ($prediagnoses_info as $diagnosis_item){
                        echo "<tr>";
                        echo "<td valign='top'>".$diagnosis_item['date_ended']."</td>";
                        echo "<td valign='top'><strong>".$diagnosis_item['full_title']."</strong></td>";
                        echo "<td valign='top'>".$diagnosis_item['diagnosis_notes']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($diagnoses_info) > 0)
            echo "</div>"; //id='prediagnostic_history'
echo $column_newcol;
/*
if($multicolumn){
        echo "\n</td>";
        echo "\n<td valign='top'>";
}
*/
            echo "\n\n<div id='family_history' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>FAMILY HISTORY</div>";
                    echo "\n<br /> None recorded";
            echo "</div>"; //id='family_history'
echo $column_newrow;
/*
if($multicolumn){
       echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
*/
            echo "\n\n<div id='medical_history' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
        	    echo anchor('ehr_individual_history/list_history_diagnosis/'.$patient_id, 'MEDICAL HISTORY');
                echo "</div>";
                if(count($diagnoses_info) > 0){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th width='95'>Date</th>";
                        //echo "\n<th>Code</th>";
                        echo "\n<th>Title</th>";
                        echo "\n<th>Notes</th>";
                    echo "</tr>";
                    foreach ($diagnoses_info as $diagnosis_item){
                        echo "<tr>";
                        echo "<td valign='top'>".$diagnosis_item['date_ended']."</td>";
                        echo "<td valign='top'><strong>".$diagnosis_item['full_title']."</strong></td>";
                        echo "<td valign='top'>".$diagnosis_item['diagnosis_notes']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($diagnoses_info) > 0)
            echo "</div>"; //id='medical_history'
echo $column_newcol;
/*
if($multicolumn){
        echo "\n</td>";
        echo "\n<td valign='top'>";
}
*/
            echo "\n\n<div id='medication_history' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
	            echo anchor('ehr_individual_history/list_history_medication/'.$patient_id, 'MEDICATION HISTORY');
                echo "</div>";
                echo "\n<table>";
                if(count($medication_info) > 0){
                    echo "\n<tr>";
                        echo "\n<th width='95'>Started</th>";
                        echo "\n<th>Generic Name</th>";
                        echo "\n<th>Ended</th>";
                    echo "</tr>";
                    foreach ($medication_info as $medication_item){
                        echo "\n<tr>";
                        echo "<td valign='top'>".$medication_item['date_started']."</td>";
                        echo "<td><strong>".$medication_item['generic_name']."</strong></td>";
                        //echo "<td width='400'>".anchor('ehr_patient/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$medication_item['medication_id'], $medication_item['generic_name'])."</td>";
                        echo "<td>".$medication_item['date_stopped']."</td>";
                        //echo "<td>".$medication_item['dose_form']."</td>";
                        //echo "<td>".$medication_item['frequency']."</td>";
                        //echo "<td>".$medication_item['quantity']."</td>";
                        echo "</tr>";
                    }//endforeach;
                } else {
                    echo "\n<tr><td><br /> None recorded</td></tr>";
                } //endif(isset($medication_info))
                echo "\n</table>";
                echo "<div id='more_medication'></div>";
                echo "<div id='see_more_medication'>";
                echo "<input type='submit' value='See more' />";
                echo "</div>";
            echo "</div>"; //id='medication_history'
echo $column_newrow;
/*
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";

    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
*/
            echo "\n\n<div id='lab_orders' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
	            echo anchor('ehr_individual_history/list_history_lab/'.$patient_id, 'LAB ORDERS');
                echo "</div>";
                if(count($lab_info) > 0){
                    echo "\n<table>";
                    echo "\n<tr>";
                        //echo "\n<th>Code</th>";
                        echo "\n<th width='400'>Package</th>";
                        echo "\n<th>Sample Date</th>";
                        echo "\n<th>Result Date</th>";
                        echo "\n<th>Result</th>";
                    echo "</tr>";
                    foreach ($lab_info as $lab_item){
                        echo "<tr>";
                        //echo "<td>".$lab_item['package_code']."</td>";
                        echo "\n<td>".anchor('ehr_individual_history/edit_labresults/edit_labresults/'.$patient_id.'/'.$lab_item['session_id'].'/'.$lab_item['lab_order_id'], "<strong>".$lab_item['package_name']."</strong>")."</td>";
                        //echo "<td>".$lab_item['package_name']."</td>";
                        echo "<td>".$lab_item['sample_date']."</td>";
                        echo "<td>".$lab_item['result_date']."</td>";
                        if(($lab_item['result_status']=="Received") && empty($lab_item['result_reviewed_by'])){
                            echo "<td><div class='flashdata'>REVIEW!</div></td>";
                        } else {
                            echo "<td>".$lab_item['result_status']."</td>";
                        }
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($lab_info) > 0)
            echo "</div>"; //id='lab_orders'
echo $column_newcol;
/*
        echo "\n</td>";
        echo "\n<td valign='top'>";
*/
                echo "\n\n<div id='imaging_orders' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
        	    echo anchor('ehr_individual_history/list_history_imaging/'.$patient_id, 'IMAGING ORDERS');
                echo "</div>";
                if(count($imaging_info) > 0){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th>Code</th>";
                        echo "\n<th>Component</th>";
                        echo "\n<th width='200'>Remarks</th>";
                        echo "\n<th>Supplier</th>";
                    echo "</tr>";
                    foreach ($imaging_info as $imaging_item){
                        echo "<tr>";
                        echo "<td valign='top'>".$imaging_item['product_code']."</td>";
                        //echo "<td>".anchor('ehr_patient/edit_/edit_diagnosis/'.$patient_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
                        echo "\n<td valign='top'>".anchor('ehr_individual_history/edit_imagresult/edit_result/'.$imaging_item['order_id'], "<strong>".$imaging_item['component']."</strong>")."</td>";
                        //echo "<td><strong>".$imaging_item['component']."</strong></td>";
                        echo "<td valign='top'>".$imaging_item['remarks']."</td>";
                        echo "<td valign='top'>".$imaging_item['supplier_name']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($imaging_info) > 0)
                echo "</div>"; //id='imaging_orders'
echo $column_newrow;
/*
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";

    echo "\n<tr>";
        echo "\n<td valign='top'>";
} //endif($multicolumn)
*/
            echo "\n\n<div id='proc_orders' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
        	    echo anchor('ehr_individual_history/list_history_social/'.$patient_id, 'SOCIAL HISTORY');
                echo "</div>";
                if(count($social_history) > 0){
                    echo "\n<table>";
                    echo "\n<tr><td colspan='2'>Date recorded</td><td>: ".anchor('ehr_individual_history/edit_history_social/'.$patient_id.'/edit_history/'.$social_history[0]['social_history_id'], $social_history[0]['date'])."</td>";
                    echo "\n<tr><td valign='top' width='100'>Drugs use</td><td width='40' valign='top'>: ".$social_history[0]['drugs_use']."</td><td>: ".$social_history[0]['drugs_spec']."</td></tr>";
                    echo "\n<tr><td valign='top'>Alcohols use</td><td valign='top'>: ".$social_history[0]['alcohol_use']."</td><td>: ".$social_history[0]['alcohol_spec']."</td></tr>";
                    echo "\n<tr><td valign='top'>Tobacco use</td><td valign='top'>: ".$social_history[0]['tobacco_use']."</td><td>: ".$social_history[0]['tobacco_spec']."</td></tr>";
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($diagnoses_info) > 0)
            echo "</div>"; //id='proc_orders'
echo $column_newcol;
/*
        echo "\n</td>";
        echo "\n<td valign='top'>";
*/
            echo "\n\n<div id='immunisation' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
        	    echo anchor('ehr_individual/edithist_immune_select/new_immune/'.$patient_id.'/new_immune', 'IMMUNISATION HISTORY');
                echo "</div>";
                echo "\n<table>";
                echo "\n<tr>";
                    echo "\n<th>Date</th>";
                    echo "\n<th>Vaccine</th>";
                    echo "\n<th width='200'>Notes</th>";
                echo "</tr>";
                foreach ($vaccines_list as $vaccine_item){
                    if(!empty($vaccine_item['date'])){
                        echo "\n<tr>";
                        echo "<td valign='top'>".$vaccine_item['date']."</td>";
                        //echo "<td>".anchor('ehr_patient/edit_/edit_diagnosis/'.$patient_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
                        echo "<td><strong>".$vaccine_item['vaccine_short']."</strong></td>";
                        echo "<td>".$vaccine_item['notes']."</td>";
                        echo "</tr>";
                    }
                }//endforeach;
                echo "</table>";
            //echo "\n<a href='".$patient_id."' id='see_all'>Display all</a>";
            echo "<div id='more_immunisation'></div>";
            echo "<div id='see_more_immunisation'>";
            echo "<input type='submit' value='See all' />";
            echo "</div>";
            echo "</div>"; //id='immunisation'
echo $column_newrow;
/*
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
} //endif($multicolumn)
*/
            echo "\n\n<div id='antenatal_history' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
	            echo anchor('ehr_individual_antenatal/list_history_antenatal/'.$patient_id, 'ANTENATAL HISTORY');
                echo "</div>";
                if(count($history_antenatal) > 0){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th>Gra</th>";
                        echo "\n<th width='80'>LMP</th>";
                        echo "\n<th width='80'>EDD</th>";
                        echo "\n<th width='80'>Outcome</th>";
                        echo "\n<th width='80'>Termination</th>";
                    echo "</tr>";
                    $previous_antenatal_id  =   NULL;
                    foreach ($history_antenatal as $antenatal_item){
                        echo "<tr>";
                        if($previous_antenatal_id === $antenatal_item['antenatal_id']){
                            echo "<td align='left'>\"</td>";
                            echo "<td align='center'>\"</td>";
                            echo "<td align='center'>\"</td>";
                            echo "\n<td>".$antenatal_item['delivery_outcome']."</td>";
                        } else {
                            echo "\n<td>".anchor('ehr_individual_antenatal/edit_history_antenatal/'.$patient_id.'/edit_antenatal/'.$antenatal_item['antenatal_id'], "<strong>".$antenatal_item['gravida']."</strong>");
                            //echo "<td>".$antenatal_item['gravida']."</td>";
                            //echo "<td>".anchor('ehr_patient/edit_/edit_diagnosis/'.$patient_id.'/'.$lab_item['lab_order_id'], $lab_item['package_code'])."</td>";
                            echo "<td>".$antenatal_item['lmp']."</td>";
                            echo "<td><strong>".$antenatal_item['lmp_edd']."</strong></td>";
                            echo "<td>";
                            echo $antenatal_item['delivery_outcome'];
                            /*
                            if($antenatal_item['status'] > 0){
                                echo "Closed";
                            } else {
                                echo "Open";
                            }
                            */
                            echo "</td>";
                        } //endif($previous_antenatal_id === $history_item['antenatal_id'])
                        echo "<td><strong>".$antenatal_item['date_delivery']."</strong></td>";
                        echo "</tr>";
                        $previous_antenatal_id  =   $antenatal_item['antenatal_id'];
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($lab_info) > 0)
            echo "</div>"; //id='proc_orders'
echo $column_newcol;
/*
        echo "\n</td>";
        echo "\n<td valign='top'>";
*/
                echo "\n\n<div id='referrals_history' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
	            echo anchor('ehr_individual_refer/list_referral_out/'.$patient_id, 'REFERRALS HISTORY');
                echo "</div>";
                if(count($referrals_list) > 0){
                    echo "\n<table class='valigntop'>";
                    echo "\n<tr>";
                        echo "\n<th>Date</th>";
                        echo "\n<th width='100'>Referral Centre</th>";
                        echo "\n<th>Doctor</th>";
                        echo "\n<th>Reason</th>";
                    echo "</tr>";
                    foreach ($referrals_list as $referral_item){
                        echo "<tr>";
                        echo "\n<td>".anchor('ehr_individual_refer/edit_referral_out/edit_refer/'.$patient_id.'/'.$referral_item['session_id'].'/'.$referral_item['referral_id'], "<strong>".$referral_item['referral_date']."</strong>")."</td>";
                        //echo "<td valign='top'>".$referral_item['referral_date']."</td>";
                        echo "<td valign='top'>".$referral_item['referral_centre']."</td>";
                        echo "<td valign='top'>".$referral_item['referral_doctor_name']."</td>";
                        echo "<td valign='top'>".$referral_item['reason']."</td>";
                        echo "<td valign='top'>";
                        if(!empty($referral_item['date_replied'])){
                            echo "<strong>Replied</strong>";
                        } else {
                            echo "Pending";
                        }
                        echo "</td>";
                        //echo "<td valign='top'>".anchor('ehr_individual_refer/refer_select_details/new_export/'.$patient_id.'/'.$referral_item['session_id'].'/'.$referral_item['referral_id'], 'Export', 'target="_blank"')."</td>";
                        //echo "<td valign='top'>".anchor('ehr_consult/print_referral_letter/print_referral_letter/'.$patient_id.'/'.$referral_item['session_id'].'/'.$referral_item['referral_id'], 'Print', 'target="_blank"')."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($lab_info) > 0)
                echo "</div>"; //id='imaging_orders'
echo $column_newrow;
/*
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";

    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
*/
            echo "\n\n<div id='vitals' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
                    if(($patient_info['gender'] == "Female") && ($patient_info['fertile'] == "TRUE")){
	                    echo anchor('ehr_individual_antenatal/list_history_antenatal/'.$patient_id, 'LAST ANTENATAL CHECKUP');
                    } else {
                        echo "LAST ANTENATAL";
                    } //endif($patient['gender'] == "Female")

                echo "</div>";
                if(isset($antenatal_checkup[0]['antenatal_followup_id']) && ($antenatal_checkup[0]['antenatal_followup_id'] <> "new_followup")){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<td>Check-up Date</td>";
                        echo "\n<td>".$antenatal_checkup[0]['date']."</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td width='180'>Gestation</td>";
                        echo "<td>".$antenatal_checkup[0]['pregnancy_duration']." weeks</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>Weight</td>";
                        echo "<td>".$antenatal_checkup[0]['weight']." kg</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>Lie & Presentation</td>";
                        echo "<td>".$antenatal_checkup[0]['lie']."</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>Fundal Height</td>";
                        echo "<td>".$antenatal_checkup[0]['fundal_height']." cm</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>Notes</td>";
                        echo "<td>".$antenatal_checkup[0]['notes']."</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>Next Check-up</td>";
                        echo "<td>".$antenatal_checkup[0]['next_followup']."</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td></td>";
                        echo "\n<td></td>";
                    echo "\n</tr>";
                    echo "\n</table>";
                } else {
                    echo "\n<br /> None recorded";
                        //echo anchor('ehr_individual/graph_processor', ' ;', 'target="_blank"');
                }
            echo "</div>"; //id='vitals'
echo $column_newcol;
/*
if($multicolumn){
        echo "\n</td>";
        echo "\n<td valign='top'>";
}
*/
            echo "\n\n<div id='family_history' class='overviewblock'>";
                echo "\n<div class='block_title_ovv'>";
        	    echo anchor('ehr_individual/ovv_externalmod/externalmod/'.$patient_id, 'MODULES');
                echo "</div>";
                    echo "\n<br /> None recorded";
            echo "</div>"; //id='family_history'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n</table>";
}


echo "</div>"; //id=content

echo "</div>"; //id=body

// Links for AJAX calls
$siteurl_medication    =   site_url()."/ehr_ajax/show_medication";
$siteurl_immunisation    =   site_url()."/ehr_ajax/show_immunisation";
//echo $siteurl;
?>

<script type="text/javascript">
//      url:siteurl+'/ehr_ajax/show_immunisation/'+patient_id,

    $(document).ready(function() {
        $('#see_more_immunisation').delegate('input','click',function (){
            ajax_more_immunisation()}
            );
        $('#see_more_medication').delegate('input','click',function (){
            ajax_more_medication()}
            );
        return false;
      })


    function ajax_more_medication() {
        var siteurl = "<?php echo $siteurl_medication; ?>";
        var patient_id = "<?php echo $patient_id; ?>";
        //var siteurl = $('.siteurl').val();
        //var patient_id = $('.patient_id').val();
        var data = 'patient_id='+patient_id;
        //alert(siteurl+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            $('#more_medication').html(result);
          }
        }
    )}


    function ajax_more_immunisation() {
        var siteurl = "<?php echo $siteurl_immunisation; ?>";
        var patient_id = "<?php echo $patient_id; ?>";
        //var siteurl = $('.siteurl').val();
        //var patient_id = $('.patient_id').val();
        var data = 'patient_id='+patient_id;
        //alert(siteurl+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            $('#more_immunisation').html(result);
          }
        }
    )}


/*
    $(document).ready(function() {
      $('#see_more_immunisation').click(function () {
        var siteurl = "<?php echo $siteurl_immunisation; ?>";
        var patient_id = "<?php echo $patient_id; ?>";
        //var siteurl = $('.siteurl').val();
        //var patient_id = $('.patient_id').val();
        var data = 'patient_id='+patient_id;
        //alert(siteurl+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            $('#more_immunisation').html(result);
          }
        });
        return false;
      });
      $('#see_more_medication').click(function () {
        var siteurl = "<?php echo $siteurl_medication; ?>";
        var patient_id = "<?php echo $patient_id; ?>";
        //var siteurl = $('.siteurl').val();
        //var patient_id = $('.patient_id').val();
        var data = 'patient_id='+patient_id;
        //alert(siteurl+data);
        $.ajax({
          type:'POST',
          url:siteurl,
          data: data,
          success: function (result) {
            $('#more_medication').html(result);
          }
        });
        return false;
      });
    });
*/

</script>
