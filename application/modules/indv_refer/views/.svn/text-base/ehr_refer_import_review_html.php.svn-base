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
 * ***** END LICENSE BLOCK ***** */

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(unsynched_list)=<br />";
		print_r($unsynched_list);
    echo "\n<br />print_r(selected_list)=<br />";
		print_r($selected_list);
    echo "\n<br />print_r(final_selection)=<br />";
		print_r($final_selection);
    echo "\n<br />print_r(duplicate_patient)=<br />";
		print_r($duplicate_patient);
    echo "\n<br />print_r(same_birthdate)=<br />";
		print_r($same_birthdate);
    echo "\n<br />print_r(patient_info)=<br />";
		print_r($patient_info);
    echo "\n<br />print_r(patient_age)=<br />";
		print_r($patient_age);
    echo "\n<br />print_r(referral_info)=<br />";
		print_r($referral_info);
    echo "\n<br />print_r(patcon_info)=<br />";
		print_r($patcon_info);
    echo "\n<br />print_r(patient_past_con)=<br />";
		print_r($patient_past_con);
    echo "\n<br />print_r(vitals_info)=<br />";
		print_r($unsynched_list[1]['vitals_info']);
    echo "\n<br />print_r(prescribe_info)=<br />";
		print_r($unsynched_list[1]['prescribe_info']);
    echo "\n<br />print_r(lab_info)=<br />";
		print_r($unsynched_list[1]['lab_info']);
    echo "\n<br />print_r(imaging_info)=<br />";
		print_r($unsynched_list[1]['imaging_info']);
    echo "\n<br />print_r(diagnoses_info)=<br />";
		print_r($unsynched_list[1]['diagnosis_info']);
    echo "\n<br />print_r(social_history)=<br />";
		print_r($social_history);
    echo "\n<br />print_r(vaccines_list)=<br />";
		print_r($vaccines_list);
    echo "\n<br />print_r(history_antenatal)=<br />";
		print_r($history_antenatal);
    echo "\n<br />print_r(referrals_list)=<br />";
		print_r($referrals_list);
	echo '</pre>';
    echo "\n<br />num_rows=".$num_rows;
    echo "\n<br />xmlstr=".$xmlstr;
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />import_path = ".$import_path;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_import_new_referreview_html_title')."</h1></div>";

//echo "\nRetrieved from this <a href='/thirra-uploads/imports_refer/".$filename."' target='_blank'>".$filename."</a> XML file.";
echo "\nRetrieved from this <strong><a href='http://".$_SERVER["SERVER_ADDR"]."/".$app_folder."-uploads/imports_refer/".$filename."' target='_blank'>".$filename."</strong></a> XML file.\n";

$attributes =   array('class' => 'select_form', 'id' => 'add_patient');
echo form_open('ehr_individual_refer/admin_import_new_refer_insertpatient/import_new/'.$filename, $attributes);

echo "\n<br /><br />";
echo "\n<table>";
echo "\n<tr>";
    echo "<td>Reference</td>";
    echo "<td>";
        echo "<input type='text' class='normal' name='reference' value='' id='reference' />";          
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td valign='top'>Remarks</td>";
    echo "<td>";
    echo "\n<textarea class='normal' name='remarks' id='remarks' cols='60' rows='4'></textarea>";
    echo "\n</td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "\n<td><strong>Exporting clinic</strong></td>";
    echo "\n<td> : ".$unsynched_list['referring_clinic']."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td><strong>Clinic Reference</strong></td>";
    echo "\n<td> : ".$unsynched_list['export_clinicref']."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td><strong>Export Reference</strong></td>";
    echo "\n<td> : ".$unsynched_list['export_reference']."</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td><strong>Exported by</strong></td>";
    echo "\n<td> : ".$unsynched_list['export_username']."</td>";
echo "</tr>";
echo "\n</table>";
echo "\n<br />";
echo form_hidden('export_username', $unsynched_list['export_username']);
echo form_hidden('export_when', $unsynched_list['export_when']);
echo form_hidden('thirra_version', $unsynched_list['thirra_version']);
echo form_hidden('export_clinicname', $unsynched_list['referring_clinic']);
echo form_hidden('export_clinicref', $unsynched_list['export_clinicref']);
echo form_hidden('export_reference', $unsynched_list['export_reference']);

echo "\n<fieldset>";
echo "<legend>PATIENT'S DEMOGRAPHIC INFORMATION</legend>\n";
echo "\n<table>";
echo "\n<tr><td width='200'>Last Name <font color='red'>*</font></td><td>";
echo form_error('patient_name');
echo "<input type='text' name='patient_name' value='".set_value('patient_name',$unsynched_list[1]['patient_name'])."' size='50' /></td></tr>";

echo "\n<tr><td>First Name</td><td>";
echo form_error('name_first');
echo "<input type='text' name='name_first' value='".set_value('name_first',$unsynched_list[1]['name_first'])."' size='50' /></td></tr>";

echo "\n<tr><td>IC No.</td><td>";
echo form_error('ic_no');
echo "<input type='text' name='ic_no' value='".set_value('ic_no',$unsynched_list[1]['ic_no'])."' size='12' /> yymmdd-xx-xxxx</td></tr>";

echo "\n<tr><td>Other IC Type</td><td>";
echo form_error('ic_other_type');
echo "<input type='text' name='ic_other_type' value='".set_value('ic_other_type',$unsynched_list[1]['ic_other_type'])."' size='12' /> </td></tr>";

echo "\n<tr><td>Other IC No.</td><td>";
echo form_error('ic_other_no');
echo "<input type='text' name='ic_other_no' value='".set_value('ic_other_no',$unsynched_list[1]['ic_other_no'])."' size='12' /> </td></tr>";

echo "\n<tr><td>Gender  <font color='red'>*</font></td><td>";
echo form_error('gender');
    echo "\n<select name='gender'>";
    if($unsynched_list[1]['gender'] == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Male  ' ".($unsynched_list[1]['gender']=='Male  '?' selected=\'selected\'':'').">Male</option>";
    echo "\n<option value='Female' ".($unsynched_list[1]['gender']=='Female'?' selected=\'selected\'':'').">Female</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Birth Date  <font color='red'>*</font></td><td>";
echo form_error('birth_date');
echo "\n<input type='text' name='birth_date' id='birth_date' value='".$unsynched_list[1]['birth_date']."' size='10' /> YYYY-MM-DD</td></tr>";

echo "\n<tr><td width='200'>Clinic Ref.</td><td>";
echo form_error('clinic_reference_number');
echo "\n<input type='text' name='clinic_reference_number' value='".set_value('clinic_reference_number',$unsynched_list[1]['clinic_reference_number'])."' size='20' /></td></tr>";

echo "\n<tr><td width='200'>PNS No.</td><td>";
echo form_error('pns_pat_id');
echo "\n<input type='text' name='pns_pat_id' value='".set_value('pns_pat_id',$unsynched_list[1]['pns_pat_id'])."' size='20' /></td></tr>";

echo "\n<tr><td width='200'>NHFA No.</td><td>";
echo form_error('nhfa_no');
echo "\n<input type='text' name='nhfa_no' value='".set_value('nhfa_no',$unsynched_list[1]['nhfa_no'])."' size='20' /></td></tr>";

echo "\n<tr><td>Marital Status</td><td>";
echo form_error('marital_status');
    echo "\n<select name='marital_status'>";
    if($unsynched_list[1]['marital_status'] == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value='Single'".($unsynched_list[1]['marital_status']=='Single'?' selected=\'selected\'':'').">Single</option>";
    echo "\n<option value='Married'".($unsynched_list[1]['marital_status']=='Married'?' selected=\'selected\'':'').">Married</option>";
    echo "\n<option value='Divorced'".($unsynched_list[1]['marital_status']=='Divorced'?' selected=\'selected\'':'').">Divorced</option>";
    echo "\n<option value='Others'".($unsynched_list[1]['marital_status']=='Others'?' selected=\'selected\'':'').">Others</option>";
    echo "\n</select>";
echo "</td></tr>\n";

echo "\n<tr><td>Citizen of</td><td>";
echo form_error('nationality');
echo "<input type='text' name='nationality' value='".set_value('nationality',$unsynched_list[1]['nationality'])."' size='30' /> </td></tr>";

echo "\n<tr><td>Ethnicity</td><td>";
echo form_error('ethnicity');
echo "<input type='text' name='ethnicity' value='".set_value('ethnicity',$unsynched_list[1]['ethnicity'])."' size='30' /> </td></tr>";

echo "\n<tr><td>Religion</td><td>";
echo form_error('religion');
echo "<input type='text' name='religion' value='".set_value('religion',$unsynched_list[1]['religion'])."' size='30' /> </td></tr>";

echo "\n<tr><td>Blood Group</td><td>";
echo form_error('blood_group');
    echo "\n<select name='blood_group'>";
    //if($init_blood_group == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value=''".($unsynched_list[1]['blood_group']==NULL?' selected=\'selected\'':'').">Please select one</option>";
    echo "\n<option value='O'".($unsynched_list[1]['blood_group']=='O '?' selected=\'selected\'':'').">O</option>";
    echo "\n<option value='A'".($unsynched_list[1]['blood_group']=='A '?' selected=\'selected\'':'').">A</option>";
    echo "\n<option value='B'".($unsynched_list[1]['blood_group']=='B '?' selected=\'selected\'':'').">B</option>";
    echo "\n<option value='AB'".($unsynched_list[1]['blood_group']=='AB'?' selected=\'selected\'':'').">AB</option>";
    echo "\n</select>";
//echo form_error('ethnicity');
//echo "<input type='text' name='blood_group' value='".set_value('blood_group',$init_blood_group)."' size='3' /> ";

echo "\n Rhesus Factor";
echo form_error('blood_rhesus');
    echo "\n<select name='blood_rhesus'>";
    //if($init_blood_rhesus == NULL){echo "\n<option value=''>Please select one</option>";}
    echo "\n<option value=''".($unsynched_list[1]['blood_rhesus']==NULL?' selected=\'selected\'':'').">Please select one</option>";
    echo "\n<option value='positive'".($unsynched_list[1]['blood_rhesus']=='positive'?' selected=\'selected\'':'').">positive</option>";
    echo "\n<option value='negative'".($unsynched_list[1]['blood_rhesus']=='negative'?' selected=\'selected\'':'').">negative</option>";
    echo "\n</select>";

echo "\n<tr><td width='200'>Address</td><td>";
echo form_error('patient_address');
echo "<input type='text' name='patient_address' value='".set_value('patient_address',$unsynched_list[1]['patient_address'])."' size='50' /></td></tr>\n";

echo "\n<tr><td>&nbsp;</td><td>";
echo form_error('patient_address2');
echo "<input type='text' name='patient_address2' value='".set_value('patient_address2',$unsynched_list[1]['patient_address2'])."' size='50' /></td></tr>\n";

echo "\n<tr><td>&nbsp;</td><td>";
echo form_error('patient_address3');
echo "<input type='text' name='patient_address3' value='".set_value('patient_address3',$unsynched_list[1]['patient_address3'])."' size='50' /></td></tr>\n";

echo "\n<tr><td>Post Code</td><td>";
echo form_error('patient_postcode');
echo "<input type='text' name='patient_postcode' value='".set_value('patient_postcode',$unsynched_list[1]['patient_postcode'])."' size='10' /></td></tr>\n";

echo "\n<tr><td>Town</td><td>";
echo form_error('patient_town');
echo "<input type='text' name='patient_town' value='".set_value('patient_town',$unsynched_list[1]['patient_town'])."' size='30' /></td></tr>\n";

echo "\n<tr><td>State</td><td>";
echo form_error('patient_state');
echo "<input type='text' name='patient_state' value='".set_value('patient_state',$unsynched_list[1]['patient_state'])."' size='30' /></td></tr>\n";

echo "\n<tr><td>Country</td><td>";
echo form_error('patient_country');
echo "<input type='text' name='patient_country' value='".set_value('patient_country',$unsynched_list[1]['patient_country'])."' size='30' /></td></tr>\n";

echo "\n<tr><td>Tel. Home</td><td>";
echo form_error('tel_home');
echo "<input type='text' name='tel_home' value='".set_value('tel_home',$unsynched_list[1]['tel_home'])."' size='15' /></td></tr>\n";

echo "\n<tr><td>Tel. Office</td><td>";
echo form_error('tel_office');
echo "<input type='text' name='tel_office' value='".set_value('tel_office',$unsynched_list[1]['tel_office'])."' size='15' /></td></tr>\n";

echo "\n<tr><td>Tel. Mobile</td><td>";
echo form_error('tel_mobile');
echo "<input type='text' name='tel_mobile' value='".set_value('tel_mobile',$unsynched_list[1]['tel_mobile'])."' size='15' /></td></tr>\n";

echo "\n<tr><td>e-mail</td><td>";
echo form_error('email');
echo "<input type='text' name='email' value='".set_value('email',$unsynched_list[1]['email'])."' size='20' /></td></tr>\n";

echo "\n<tr><td>Fax No.</td><td>";
echo form_error('fax_no');
echo "<input type='text' name='fax_no' value='".set_value('fax_no',$unsynched_list[1]['fax_no'])."' size='15' /></td></tr>\n";

echo "\n<tr><td>Other</td><td>";
echo form_error('contact_other');
echo "<input type='text' name='contact_other' value='".set_value('contact_other',$unsynched_list[1]['other'])."' size='30' /></td></tr>\n";
/*
echo "\n<tr>";
    echo "<td>Patient Name</td>";
    echo "<td><strong>".$unsynched_list[1]['patient_name']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>Gender</td>";
    echo "<td><strong>".$unsynched_list[1]['gender']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>Birth date</td>";
    echo "<td><strong>".$unsynched_list[1]['birth_date']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>ic_no</td>";
    echo "<td><strong>".$unsynched_list[1]['ic_no']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>ic_other_type</td>";
    echo "<td><strong>".$unsynched_list[1]['ic_other_type']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>ic_other_no</td>";
    echo "<td><strong>".$unsynched_list[1]['ic_other_no']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>nationality</td>";
    echo "<td><strong>".$unsynched_list[1]['nationality']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>clinic_reference_number</td>";
    echo "<td><strong>".$unsynched_list[1]['clinic_reference_number']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>pns_pat_id</td>";
    echo "<td><strong>".$unsynched_list[1]['pns_pat_id']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>nhfa_no</td>";
    echo "<td><strong>".$unsynched_list[1]['nhfa_no']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>ethnicity</td>";
    echo "<td><strong>".$unsynched_list[1]['ethnicity']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>religion</td>";
    echo "<td><strong>".$unsynched_list[1]['religion']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>marital_status</td>";
    echo "<td><strong>".$unsynched_list[1]['marital_status']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>blood_group</td>";
    echo "<td><strong>".$unsynched_list[1]['blood_group']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>blood_rhesus</td>";
    echo "<td><strong>".$unsynched_list[1]['blood_rhesus']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>contact_id</td>";
    echo "<td><strong>".$unsynched_list[1]['contact_id']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>patient_address</td>";
    echo "<td><strong>".$unsynched_list[1]['patient_address']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>patient_address2</td>";
    echo "<td><strong>".$unsynched_list[1]['patient_address2']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>patient_address3</td>";
    echo "<td><strong>".$unsynched_list[1]['patient_address3']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>patient_town</td>";
    echo "<td><strong>".$unsynched_list[1]['patient_town']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>patient_state</td>";
    echo "<td><strong>".$unsynched_list[1]['patient_state']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>patient_postcode</td>";
    echo "<td><strong>".$unsynched_list[1]['patient_postcode']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>patient_country</td>";
    echo "<td><strong>".$unsynched_list[1]['patient_country']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>tel_home</td>";
    echo "<td><strong>".$unsynched_list[1]['tel_home']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>tel_office</td>";
    echo "<td><strong>".$unsynched_list[1]['tel_office']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>tel_mobile</td>";
    echo "<td><strong>".$unsynched_list[1]['tel_mobile']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>fax_no</td>";
    echo "<td><strong>".$unsynched_list[1]['fax_no']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>email</td>";
    echo "<td><strong>".$unsynched_list[1]['email']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>other</td>";
    echo "<td><strong>".$unsynched_list[1]['other']."</strong></td>";
echo "\n</tr>";
*/
echo "\n<tr>";
    echo "<td>Referral Centre</td>";
    echo "<td><strong>".$unsynched_list['referring_clinic']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>Referral Person</td>";
    //echo "<td><strong>".$unsynched_list[1]['referral_doctor_name']."</strong></td>";
echo "\n</tr>";
echo "\n<tr>";
    echo "<td>Speciality</td>";
    //echo "<td><strong>".$unsynched_list[1]['referral_specialty']."</strong></td>";
echo "\n</tr>";
echo "\n</table>";
echo "\n<br />";

echo form_hidden('patient_id', $unsynched_list[1]['patient_id']);
echo form_hidden('contact_id', $unsynched_list[1]['contact_id']);
if(isset($same_patient_id)){
    //Do not allow to create
} else {
    echo "\n<center>";
        echo "\n<input class='button' type='submit' name='submit' value='Add New Patient Record' />";
    echo "\n</center>";
}
echo "\n</fieldset>";
echo "\n</form>";

//echo anchor('ehr_individual_refer/admin_import_new_refer_addpatient/export_new/'.$filename, 'Add Patient as New Record', 'target="_blank"');
if(isset($same_patient_id)){
    echo "\n<br />WARNING: Patient is possibly already in database - same patient_id:";
    foreach($same_patient_id as $duplicate_patient_id){
        echo "\n<ol>";
            //echo "<li>".$duplicate['name']." : ".$duplicate['birth_date']."</li>";
	        echo anchor('ehr_individual/individual_overview/'.$duplicate_patient_id['patient_id'], "<strong>".$duplicate_patient_id['name']."</strong>, ".$duplicate_patient_id['name_first']." (".$duplicate_patient_id['birth_date'].")</strong>", 'target="_blank"');
        echo "\n</ol>";
    }
}

if(isset($duplicate_patient)){
    echo "\n<br />Patient is possibly already in database - same name:";
    foreach($duplicate_patient as $duplicate){
        echo "\n<ol>";
            //echo "<li>".$duplicate['name']." : ".$duplicate['birth_date']."</li>";
	        echo anchor('ehr_individual/individual_overview/'.$duplicate['patient_id'], "<strong>".$duplicate['name']."</strong>, ".$duplicate['name_first']." (".$duplicate['birth_date'].")</strong>", 'target="_blank"');
        echo "\n</ol>";
    }
}

if(isset($same_birthdate)){
    echo "\n<br />Patient is possibly already in database - same birth date:";
    foreach($same_birthdate as $duplicate_birthdate){
        echo "\n<ol>";
            //echo "<li>".$duplicate['name']." : ".$duplicate['birth_date']."</li>";
	        echo anchor('ehr_individual/individual_overview/'.$duplicate_birthdate['patient_id'], "<strong>".$duplicate_birthdate['name']."</strong>, ".$duplicate_birthdate['name_first']." (".$duplicate_birthdate['birth_date'].")</strong>", 'target="_blank"');
        echo "\n</ol>";
    }
}

if(isset($same_ic_no)){
    echo "\n<br />Patient is possibly already in database - same IC No.:";
    foreach($same_ic_no as $duplicate_ic_no){
        echo "\n<ol>";
            //echo "<li>".$duplicate['name']." : ".$duplicate['birth_date']."</li>";
	        echo anchor('ehr_individual/individual_overview/'.$duplicate_ic_no['patient_id'], "<strong>".$duplicate_ic_no['name']."</strong>, ".$duplicate_ic_no['name_first']." (".$duplicate_ic_no['ic_no'].")</strong>", 'target="_blank"');
        echo "\n</ol>";
    }
}

if(isset($same_pns_pat_id) && !empty($unsynched_list[1]['pns_pat_id'])){
    echo "\n<br />Patient is possibly already in database - same PNS No.:";
    foreach($same_pns_pat_id as $duplicate_pns_pat_id){
        echo "\n<ol>";
            //echo "<li>".$duplicate['name']." : ".$duplicate['birth_date']."</li>";
	        echo anchor('ehr_individual/individual_overview/'.$duplicate_pns_pat_id['patient_id'], "<strong>".$duplicate_pns_pat_id['name']."</strong>, ".$duplicate_pns_pat_id['name_first']." (".$duplicate_pns_pat_id['pns_pat_id'].")</strong>", 'target="_blank"');
        echo "\n</ol>";
    }
}

if(isset($same_nhfa_no)){
    echo "\n<br />Patient is possibly already in database - same NHFA No.:";
    foreach($same_nhfa_no as $duplicate_nhfa_no){
        echo "\n<ol>";
            //echo "<li>".$duplicate['name']." : ".$duplicate['birth_date']."</li>";
	        echo anchor('ehr_individual/individual_overview/'.$duplicate_nhfa_no['patient_id'], "<strong>".$duplicate_nhfa_no['name']."</strong>, ".$duplicate_nhfa_no['name_first']." (".$duplicate_nhfa_no['nhfa_no'].")</strong>", 'target="_blank"');
        echo "\n</ol>";
    }
}

if($multicolumn){
    echo "\n<table>";
}

if($multicolumn){
    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='drug_allergies' class='overviewblock'>";
                echo "\n<div class='block_title'>DRUG ALLERGIES</div>";
                echo "\n<table>";
                if(isset($drug_allergies) && (count($drug_allergies) > 0)){
                    $rownum = 1;
                    foreach ($drug_allergies as $allergy_item){
                        echo "\n<tr>";
                        echo "\n<td>".$rownum.".</td>";
                        echo "\n<td>".$allergy_item['generic_name']."</td>";
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
                echo "\n<div class='block_title'>OTHER ALLERGIES</div>";
                    echo "\n<br /> None recorded";
            echo "</div>"; //id='other_allergies'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";

    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='vitals' class='overviewblock'>";
                echo "\n<div class='block_title'>VITAL SIGNS</div>";
                if(isset($unsynched_list[1]['vitals_info'][0]['vital_id']) && ($unsynched_list[1]['vitals_info'][0]['vital_id'] <> "new_vitals")){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<td width='180'>Temperature</td>";
                        echo "<td width='65'>".$unsynched_list[1]['vitals_info'][0]['temperature']."</td>";
                        echo "\n<td width='85'>&deg;C</td>";
                        echo "\n<td width='180'>Pulse Rate</td>";
                        echo "<td width='65'>".$unsynched_list[1]['vitals_info'][0]['pulse_rate']."</td>";
                        echo "\n<td width='85'>bpm</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>BP systolic</td>";
                        echo "<td>".$unsynched_list[1]['vitals_info'][0]['bp_systolic']."</td>";
                        echo "\n<td>mm Hg</td>";
                        echo "\n<td>BP diastolic</td>";
                        echo "<td>".$unsynched_list[1]['vitals_info'][0]['bp_diastolic']."</td>";
                        echo "\n<td>mm Hg</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>Height</td>";
                        echo "<td width='50'>".$unsynched_list[1]['vitals_info'][0]['height']."</td>";
                        echo "\n<td>cm</td>";
                        echo "\n<td>Weight</td>";
                        echo "<td width='50'>".$unsynched_list[1]['vitals_info'][0]['weight']."</td>";
                        echo "\n<td>kg</td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td></td>";
                        echo "<td></td>";
                        echo "\n<td></td>";
                        echo "<td></td>";
                    echo "\n</tr>";
                    echo "\n<tr>";
                        echo "\n<td>[".$unsynched_list[1]['vitals_info'][0]['reading_date']."]</td>";
                        echo "<td>";
                        echo anchor('ehr_individual/graph_processor', ' ;', 'target="_blank"');
                        echo "</td>";
                        echo "\n<td></td>";
                        echo "<td></td>";
                    echo "\n</tr>";
                    echo "\n</table>";
                } else {
                    echo "\n<br /> None recorded";
                        echo anchor('ehr_individual/graph_processor', ' ;', 'target="_blank"');
                }
            echo "</div>"; //id='vitals'
if($multicolumn){
        echo "\n</td>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='appointments' class='overviewblock'>";
                echo "\n<div class='block_title'>APPOINTMENTS</div>";
                    echo "\n<br /> No appointment made.";
            echo "</div>"; //id='appointments'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";

    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='current_medication' class='overviewblock'>";
                echo "\n<div class='block_title'>CURRENT MEDICATION</div>";
                echo "\n<table>";
                    echo "\n<tr><td><br /> None recorded</td></tr>";
                echo "\n</table>";
            echo "</div>"; //id='current_medication'
if($multicolumn){
        echo "\n</td>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='medication_history' class='overviewblock'>";
                echo "\n<div class='block_title'>MEDICATION HISTORY</div>";
                echo "\n<table>";
                if(isset($unsynched_list[1]['prescribe_info']) && (count($unsynched_list[1]['prescribe_info']) > 0)){
                    foreach ($unsynched_list[1]['prescribe_info'] as $medication_item){
                        echo "\n<tr>";
                        //echo "<td>".$medication_item['date_started']."</td>";
                        echo "<td width='400'><strong>".$medication_item['generic_name']."</strong></td>";
                        //echo "<td width='400'>".anchor('ehr_patient/edit_diagnosis/edit_diagnosis/'.$patient_id.'/'.$medication_item['medication_id'], $medication_item['generic_name'])."</td>";
                        //echo "<td>".$medication_item['date_stopped']."</td>";
                        //echo "<td>".$medication_item['dose_form']."</td>";
                        //echo "<td>".$medication_item['frequency']."</td>";
                        //echo "<td>".$medication_item['quantity']."</td>";
                        echo "</tr>";
                    }//endforeach;
                } else {
                    echo "\n<tr><td><br /> None recorded</td></tr>";
                } //endif(isset($medication_info))
                echo "\n</table>";
            echo "</div>"; //id='medication_history'
if($multicolumn){
       echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='medical_history' class='overviewblock'>";
                echo "\n<div class='block_title'>MEDICAL HISTORY</div>";
                if(isset($unsynched_list[1]['diagnosis_info']) && (count($unsynched_list[1]['diagnosis_info']) > 0)){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th>Code</th>";
                        echo "\n<th width='400'>Title</th>";
                        echo "\n<th>Type</th>";
                        echo "\n<th>Notes</th>";
                    echo "</tr>";
                    foreach ($unsynched_list[1]['diagnosis_info'] as $diagnosis_item){
                        echo "<tr>";
                        echo "<td>".$diagnosis_item['dcode1ext_code']."</td>";
                        //echo "<td>".$diagnosis_item['full_title']."</td>";
                        echo "<td valign='top'>".$diagnosis_item['diagnosis_type']."</td>";
                        echo "<td valign='top'>".$diagnosis_item['diagnosis_notes']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($diagnoses_info) > 0)
            echo "</div>"; //id='medical_history'
if($multicolumn){
        echo "\n</td>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='family_history' class='overviewblock'>";
                echo "\n<div class='block_title'>FAMILY HISTORY</div>";
                    echo "\n<br /> None recorded";
            echo "</div>"; //id='family_history'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
}
            echo "\n\n<div id='lab_orders' class='overviewblock'>";
                echo "\n<div class='block_title'>LAB ORDERS</div>";
                if(isset($unsynched_list[1]['lab_info']) && (count($unsynched_list[1]['lab_info']) > 0)){
                    echo "\n<table>";
                    echo "\n<tr>";
                        //echo "\n<th>Code</th>";
                        echo "\n<th width='200'>Package</th>";
                        echo "\n<th>Date</th>";
                        echo "\n<th>Result</th>";
                    echo "</tr>";
                    foreach ($unsynched_list[1]['lab_info'] as $lab_item){
                        echo "\n<tr>";
                        //echo "<td>".$lab_item['package_code']."</td>";
                        echo "<td>".$lab_item['package_name']."</td>";
                        echo "<td>".$lab_item['sample_date']."</td>";
                        echo "<td>".$lab_item['summary_result']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($lab_info) > 0)
            echo "</div>"; //id='lab_orders'
        echo "\n</td>";
        echo "\n<td valign='top'>";
                echo "\n\n<div id='imaging_orders' class='overviewblock'>";
                echo "\n<div class='block_title'>IMAGING ORDERS</div>";
                if(isset($unsynched_list[1]['imaging_info']) && (count($unsynched_list[1]['imaging_info']) > 0)){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th>Code</th>";
                        //echo "\n<th>Component</th>";
                        //echo "\n<th width='200'>Remarks</th>";
                        echo "\n<th>Supplier</th>";
                    echo "</tr>";
                    foreach ($unsynched_list[1]['imaging_info'] as $imaging_item){
                        echo "<tr>";
                        echo "<td>".$imaging_item['product_code']."</td>";
                        //echo "<td>".anchor('ehr_patient/edit_/edit_diagnosis/'.$patient_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
                        //echo "<td>".$imaging_item['component']."</td>";
                        //echo "<td>".$imaging_item['remarks']."</td>";
                        echo "<td>".$imaging_item['supplier_name']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($lab_info) > 0)
                echo "</div>"; //id='imaging_orders'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
} //endif($multicolumn)
            echo "\n\n<div id='proc_orders' class='overviewblock'>";
                echo "\n<div class='block_title'>SOCIAL HISTORY</div>";
                if(isset($social_history) && (count($social_history) > 0)){
                    echo "\n<table>";
                    echo "\n<tr><td colspan='2'>Date recorded</td><td>: ".anchor('ehr_individual/edit_history_social/'.$patient_id.'/edit_history/'.$social_history[0]['social_history_id'], $social_history[0]['date'])."</td>";
                    echo "\n<tr><td valign='top' width='100'>Drugs use</td><td width='40' valign='top'>: ".$social_history[0]['drugs_use']."</td><td>: ".$social_history[0]['drugs_spec']."</td></tr>";
                    echo "\n<tr><td valign='top'>Alcohols use</td><td valign='top'>: ".$social_history[0]['alcohol_use']."</td><td>: ".$social_history[0]['alcohol_spec']."</td></tr>";
                    echo "\n<tr><td valign='top'>Tobacco use</td><td valign='top'>: ".$social_history[0]['tobacco_use']."</td><td>: ".$social_history[0]['tobacco_spec']."</td></tr>";
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($diagnoses_info) > 0)
            echo "</div>"; //id='proc_orders'
        echo "\n</td>";
        echo "\n<td valign='top'>";
            echo "\n\n<div id='appointments' class='overviewblock'>";
                echo "\n<div class='block_title'>IMMUNISATION HISTORY</div>";
                echo "\n<table>";
                echo "\n<tr>";
                    echo "\n<th>Date</th>";
                    echo "\n<th>Vaccine</th>";
                    echo "\n<th width='200'>Notes</th>";
                echo "</tr>";
                if(isset($vaccines_list)){
                    foreach ($vaccines_list as $vaccine_item){
                        if(!empty($vaccine_item['date'])){
                            echo "<tr>";
                            echo "<td>".$vaccine_item['date']."</td>";
                            //echo "<td>".anchor('ehr_patient/edit_/edit_diagnosis/'.$patient_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
                            echo "<td><strong>".$vaccine_item['vaccine_short']."</strong></td>";
                            echo "<td>".$vaccine_item['notes']."</td>";
                            echo "</tr>";
                        }
                    }//endforeach;
                } //endif(isset($vaccines_list))
                echo "</table>";
            echo "</div>"; //id='appointments'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>";
} //endif($multicolumn)
            echo "\n\n<div id='antenatal_history' class='overviewblock'>";
                echo "\n<div class='block_title'>ANTENATAL HISTORY</div>";
                if(isset($history_antenatal) && (count($history_antenatal) > 0)){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th>Gravida</th>";
                        echo "\n<th width='80'>LMP</th>";
                        echo "\n<th width='80'>EDD</th>";
                        echo "\n<th width='80'>Status</th>";
                    echo "</tr>";
                    foreach ($history_antenatal as $antenatal_item){
                        echo "<tr>";
                        echo "<td>".$antenatal_item['gravida']."</td>";
                        //echo "<td>".anchor('ehr_patient/edit_/edit_diagnosis/'.$patient_id.'/'.$lab_item['lab_order_id'], $lab_item['package_code'])."</td>";
                        echo "<td>".$antenatal_item['lmp']."</td>";
                        echo "<td><strong>".$antenatal_item['lmp_edd']."</strong></td>";
                        echo "<td align='center'>".$antenatal_item['status']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($lab_info) > 0)
            echo "</div>"; //id='proc_orders'
        echo "\n</td>";
        echo "\n<td valign='top'>";
                echo "\n\n<div id='referrals_history' class='overviewblock'>";
                echo "\n<div class='block_title'>REFERRALS HISTORY</div>";
                if(isset($referrals_list) && (count($referrals_list) > 0)){
                    echo "\n<table>";
                    echo "\n<tr>";
                        echo "\n<th>Date</th>";
                        echo "\n<th width='100'>Referral Centre</th>";
                        echo "\n<th>Doctor</th>";
                        echo "\n<th>Reason</th>";
                    echo "</tr>";
                    foreach ($referrals_list as $referral_item){
                        echo "<tr>";
                        echo "<td valign='top'>".anchor('ehr_consult/print_referral_letter/print_referral_letter/'.$patient_id.'/'.$referral_item['session_id'].'/'.$referral_item['referral_id'], $referral_item['referral_date'], 'target="_blank"')."</td>";
                        echo "<td valign='top'>".$referral_item['referral_centre']."</td>";
                        echo "<td valign='top'>".$referral_item['referral_doctor_name']."</td>";
                        echo "<td valign='top'>".$referral_item['reason']."</td>";
                        echo "</tr>";
                    }//endforeach;
                    echo "</table>";
                } else {
                    echo "\n<br /> None recorded";
                } //endif(count($lab_info) > 0)
                echo "</div>"; //id='imaging_orders'
if($multicolumn){
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>";
}
if($multicolumn){
        echo "\n</td>";
        echo "\n<td>";
        echo "\n</td>";
    echo "\n</tr>";
    echo "\n</table>";
}


