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
 * Portions created by the Initial Developer are Copyright (C) 2010-2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for EHR
 *
 * This class is for models that only writes to the database.
 *
 * @version 0.9.9
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MAntenatal_wdb extends CI_Model
{
    protected $_location_id     =  "";
    protected $_patient_id      =  "";
    protected $_summary_id      =  "";
    protected $_complaint_id    =  "";
    protected $_lab_order_id    =  "";
    protected $_diagnosis_id    =  "";
    protected $_referral_id     =  "";
    protected $_queue_id        =  "";
    protected $_notification_id =  "";
    protected $_bio_case_id     =  "";
    protected $_bio_inv_id      =  "";
    protected $_user_ip         =  "";

    function __construct()
    {
        parent::__construct();
    }


    //===============================================================
    // Insert Database Methods
    //************************************************************************
    /**
     * Method to insert New antenatal 
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_antenatal($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting new_antenatal";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Begin transaction
        $this->db->trans_begin();
        
        // Insert into patient_event
        if(isset($data_array['event_id'])){$this->db->set('event_id', $data_array['event_id']);}
        $this->db->set('event_tabletop', 'patient_antenatal');
        $this->db->set('event_key', 'antenatal_id');
        $this->db->set('event_name', 'pregnancy');
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['event_description'])){$this->db->set('event_description', $data_array['event_description']);}
        if(isset($data_array['event_remarks'])){$this->db->set('event_remarks', $data_array['event_remarks']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_event');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_event";

        // Insert into patient_antenatal
        if(isset($data_array['antenatal_id'])){$this->db->set('antenatal_id', $data_array['antenatal_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['status'])){$this->db->set('status', $data_array['status']);}
        if(isset($data_array['antenatal_reference'])){$this->db->set('antenatal_reference', $data_array['antenatal_reference']);}
        if(isset($data_array['event_id'])){$this->db->set('event_id', $data_array['event_id']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_antenatal');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_antenatal";

        // Insert into patient_antenatal_info
        if(isset($data_array['antenatal_info_id'])){$this->db->set('antenatal_info_id', $data_array['antenatal_info_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['record_date'])){$this->db->set('date', $data_array['record_date']);}
        if(isset($data_array['husband_name'])){$this->db->set('husband_name', $data_array['husband_name']);}
        if(isset($data_array['husband_job'])){$this->db->set('husband_job', $data_array['husband_job']);}
        if(isset($data_array['husband_dob'])){$this->db->set('husband_dob', $data_array['husband_dob']);}
        if(isset($data_array['husband_ic_no'])){$this->db->set('husband_ic_no', $data_array['husband_ic_no']);}
        if(isset($data_array['gravida'])){$this->db->set('gravida', $data_array['gravida']);}
        if(isset($data_array['para'])){$this->db->set('para', $data_array['para']);}
        if(isset($data_array['method_contraception'])){$this->db->set('method_contraception', $data_array['method_contraception']);}
        if(isset($data_array['abortion'])){$this->db->set('abortion', $data_array['abortion']);}
        if(isset($data_array['past_obstretical_history_icpc'])){$this->db->set('past_obstretical_history_icpc', $data_array['past_obstretical_history_icpc']);}
        if(isset($data_array['past_obstretical_history_notes'])){$this->db->set('past_obstretical_history_notes', $data_array['past_obstretical_history_notes']);}
        if(isset($data_array['num_term_deliveries'])){$this->db->set('num_term_deliveries', $data_array['num_term_deliveries']);}
        if(isset($data_array['num_preterm_deliveries'])){$this->db->set('num_preterm_deliveries', $data_array['num_preterm_deliveries']);}
        if(isset($data_array['num_preg_lessthan_21wk'])){$this->db->set('num_preg_lessthan_21wk', $data_array['num_preg_lessthan_21wk']);}
        if(isset($data_array['num_live_births'])){$this->db->set('num_live_births', $data_array['num_live_births']);}
        if(isset($data_array['num_caesarean_births'])){$this->db->set('num_caesarean_births', $data_array['num_caesarean_births']);}
        if(isset($data_array['num_miscarriages'])){$this->db->set('num_miscarriages', $data_array['num_miscarriages']);}
        if(isset($data_array['three_consec_miscarriages'])){$this->db->set('three_consec_miscarriages', $data_array['three_consec_miscarriages']);}
        if(isset($data_array['num_stillbirths'])){$this->db->set('num_stillbirths', $data_array['num_stillbirths']);}
        if(isset($data_array['post_partum_depression'])){$this->db->set('post_partum_depression', $data_array['post_partum_depression']);}
        if(isset($data_array['present_pulmonary_tb'])){$this->db->set('present_pulmonary_tb', $data_array['present_pulmonary_tb']);}
        if(isset($data_array['present_heart_disease'])){$this->db->set('present_heart_disease', $data_array['present_heart_disease']);}
        if(isset($data_array['present_diabetes'])){$this->db->set('present_diabetes', $data_array['present_diabetes']);}
        if(isset($data_array['present_bronchial_asthma'])){$this->db->set('present_bronchial_asthma', $data_array['present_bronchial_asthma']);}
        if(isset($data_array['present_goiter'])){$this->db->set('present_goiter', $data_array['present_goiter']);}
        if(isset($data_array['present_hepatitis_b'])){$this->db->set('present_hepatitis_b', $data_array['present_hepatitis_b']);}
        if(isset($data_array['contact_person'])){$this->db->set('contact_person', $data_array['contact_person']);}
        if(isset($data_array['antenatal_id'])){$this->db->set('antenatal_id', $data_array['antenatal_id']);}
        if(isset($data_array['event_id'])){$this->db->set('event_id', $data_array['event_id']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_antenatal_info');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_antenatal_info";

        // Insert into patient_antenatal_current
        if(isset($data_array['antenatal_current_id'])){$this->db->set('antenatal_current_id', $data_array['antenatal_current_id']);}
        if(isset($data_array['antenatal_id'])){$this->db->set('antenatal_id', $data_array['antenatal_id']);}
        if(isset($data_array['midwife_name'])){$this->db->set('midwife_name', $data_array['midwife_name']);}
        if(isset($data_array['pregnancy_duration'])){$this->db->set('pregnancy_duration', $data_array['pregnancy_duration']);}
        if(isset($data_array['lmp'])){$this->db->set('lmp', $data_array['lmp']);}
        if(isset($data_array['edd'])){$this->db->set('edd', $data_array['edd']);}
        if(isset($data_array['planned_place'])){$this->db->set('planned_place', $data_array['planned_place']);}
        if(isset($data_array['menstrual_cycle_length'])){$this->db->set('menstrual_cycle_length', $data_array['menstrual_cycle_length']);}
        if(isset($data_array['lmp_edd'])){$this->db->set('lmp_edd', $data_array['lmp_edd']);}
        if(isset($data_array['lmp_gestation'])){$this->db->set('lmp_gestation', $data_array['lmp_gestation']);}
        if(isset($data_array['usscan_date'])){$this->db->set('usscan_date', $data_array['usscan_date']);}
        if(isset($data_array['usscan_edd'])){$this->db->set('usscan_edd', $data_array['usscan_edd']);}
        if(isset($data_array['usscan_gestation'])){$this->db->set('usscan_gestation', $data_array['usscan_gestation']);}
        if(isset($data_array['event_id'])){$this->db->set('event_id', $data_array['event_id']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_antenatal_current');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_antenatal_current";

        //echo "Inserted<br />";
        // End transaction
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            echo "<br /><br />Some errors were found. New antenatal event not completed.";
        } else {
            $this->db->trans_commit();
            //echo "<br /><br />No errors found. New antenatal event completed.";
        }
        //echo "<hr />";
    } // end of function insert_new_antenatal($data_array)


    //************************************************************************
    /**
     * Method to insert New antenatal_followup
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_antenatal_followup($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting vitals details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_antenatal_followup
        if(isset($data_array['antenatal_followup_id'])){$this->db->set('antenatal_followup_id', $data_array['antenatal_followup_id']);}
        if(isset($data_array['antenatal_id'])){$this->db->set('antenatal_id', $data_array['antenatal_id']);}
        if(isset($data_array['record_date'])){$this->db->set('date', $data_array['record_date']);}
        if(isset($data_array['pregnancy_duration'])){$this->db->set('pregnancy_duration', $data_array['pregnancy_duration']);}
        if(isset($data_array['lie'])){$this->db->set('lie', $data_array['lie']);}
        if(isset($data_array['weight'])){$this->db->set('weight', $data_array['weight']);}
        if(isset($data_array['fundal_height'])){$this->db->set('fundal_height', $data_array['fundal_height']);}
        if(isset($data_array['hb'])){$this->db->set('hb', $data_array['hb']);}
        if(isset($data_array['urine_alb'])){$this->db->set('urine_alb', $data_array['urine_alb']);}
        if(isset($data_array['urine_sugar'])){$this->db->set('urine_sugar', $data_array['urine_sugar']);}
        if(isset($data_array['ankle_odema'])){$this->db->set('ankle_odema', $data_array['ankle_odema']);}
        if(isset($data_array['notes'])){$this->db->set('notes', $data_array['notes']);}
        if(isset($data_array['next_followup'])){$this->db->set('next_followup', $data_array['next_followup']);}
        if(isset($data_array['fundal_height2'])){$this->db->set('fundal_height2', $data_array['fundal_height2']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['event_id'])){$this->db->set('event_id', $data_array['event_id']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        if(isset($data_array['glucose_tolerance_test'])){$this->db->set('glucose_tolerance_test', $data_array['glucose_tolerance_test']);}
        if(isset($data_array['vaginal_bleeding'])){$this->db->set('vaginal_bleeding', $data_array['vaginal_bleeding']);}
        if(isset($data_array['vaginal_infection'])){$this->db->set('vaginal_infection', $data_array['vaginal_infection']);}
        if(isset($data_array['urinary_tract_infection'])){$this->db->set('urinary_tract_infection', $data_array['urinary_tract_infection']);}
        if(isset($data_array['blood_pressure'])){$this->db->set('blood_pressure', $data_array['blood_pressure']);}
        if(isset($data_array['fever'])){$this->db->set('fever', $data_array['fever']);}
        if(isset($data_array['pallor'])){$this->db->set('pallor', $data_array['pallor']);}
        if(isset($data_array['abnormal_fundal_height'])){$this->db->set('abnormal_fundal_height', $data_array['abnormal_fundal_height']);}
        if(isset($data_array['movements'])){$this->db->set('movements', $data_array['movements']);}
        if(isset($data_array['abnormal_presentation'])){$this->db->set('abnormal_presentation', $data_array['abnormal_presentation']);}
        if(isset($data_array['fetal_heart_tones'])){$this->db->set('fetal_heart_tones', $data_array['fetal_heart_tones']);}
        if(isset($data_array['missing_fetal_heartbeat'])){$this->db->set('missing_fetal_heartbeat', $data_array['missing_fetal_heartbeat']);}
        if(isset($data_array['supplement_iodine'])){$this->db->set('supplement_iodine', $data_array['supplement_iodine']);}
        if(isset($data_array['supplement_iron'])){$this->db->set('supplement_iron', $data_array['supplement_iron']);}
        if(isset($data_array['supplement_vitamins'])){$this->db->set('supplement_vitamins', $data_array['supplement_vitamins']);}
        if(isset($data_array['supplement_folate'])){$this->db->set('supplement_folate', $data_array['supplement_folate']);}
        if(isset($data_array['malaria_prophylaxis'])){$this->db->set('malaria_prophylaxis', $data_array['malaria_prophylaxis']);}
        if(isset($data_array['breastfeed_intention'])){$this->db->set('breastfeed_intention', $data_array['breastfeed_intention']);}
        if(isset($data_array['advise_4_danger_signs'])){$this->db->set('advise_4_danger_signs', $data_array['advise_4_danger_signs']);}
        if(isset($data_array['dental_checkup'])){$this->db->set('dental_checkup', $data_array['dental_checkup']);}
        if(isset($data_array['emergency_plans'])){$this->db->set('emergency_plans', $data_array['emergency_plans']);}
        if(isset($data_array['healthy_diet'])){$this->db->set('healthy_diet', $data_array['healthy_diet']);}
        if(isset($data_array['adequate_rest'])){$this->db->set('adequate_rest', $data_array['adequate_rest']);}
        if(isset($data_array['adequate_exercise'])){$this->db->set('adequate_exercise', $data_array['adequate_exercise']);}
        if(isset($data_array['thirdtrimester_issues'])){$this->db->set('thirdtrimester_issues', $data_array['thirdtrimester_issues']);}
        if(isset($data_array['followup_remarks'])){$this->db->set('followup_remarks', $data_array['followup_remarks']);}
        if(isset($data_array['risks'])){$this->db->set('risks', $data_array['risks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_antenatal_followup');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_antenatal_followup";

        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_antenatal_followup($data_array)


    //************************************************************************
    /**
     * Method to insert New antenatal_delivery
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_antenatal_delivery($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting vitals details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_antenatal_delivery
        if(isset($data_array['antenatal_delivery_id'])){$this->db->set('antenatal_delivery_id', $data_array['antenatal_delivery_id']);}
        if(isset($data_array['antenatal_id'])){$this->db->set('antenatal_id', $data_array['antenatal_id']);}
        if(isset($data_array['date_admission'])){$this->db->set('date_admission', $data_array['date_admission']);}
        if(isset($data_array['time_admission'])){$this->db->set('time_admission', $data_array['time_admission']);}
        if(isset($data_array['date_delivery'])){$this->db->set('date_delivery', $data_array['date_delivery']);}
        if(isset($data_array['time_delivery'])){$this->db->set('time_delivery', $data_array['time_delivery']);}
        if(isset($data_array['delivery_type'])){$this->db->set('delivery_type', $data_array['delivery_type']);}
        if(isset($data_array['delivery_place'])){$this->db->set('delivery_place', $data_array['delivery_place']);}
        if(isset($data_array['mother_condition'])){$this->db->set('mother_condition', $data_array['mother_condition']);}
        if(isset($data_array['baby_condition'])){$this->db->set('baby_condition', $data_array['baby_condition']);}
        if(isset($data_array['baby_weight'])){$this->db->set('baby_weight', $data_array['baby_weight']);}
        if(isset($data_array['complication_icpc'])){$this->db->set('complication_icpc', $data_array['complication_icpc']);}
        if(isset($data_array['complication_notes'])){$this->db->set('complication_notes', $data_array['complication_notes']);}
        if(isset($data_array['baby_alive'])){$this->db->set('baby_alive', $data_array['baby_alive']);}
        if(isset($data_array['birth_attendant'])){$this->db->set('birth_attendant', $data_array['birth_attendant']);}
        if(isset($data_array['breastfeed_immediate'])){$this->db->set('breastfeed_immediate', $data_array['breastfeed_immediate']);}
        if(isset($data_array['post_partum_bleed'])){$this->db->set('post_partum_bleed', $data_array['post_partum_bleed']);}
        if(isset($data_array['apgar_score'])){$this->db->set('apgar_score', $data_array['apgar_score']);}
        if(isset($data_array['event_id'])){$this->db->set('event_id', $data_array['event_id']);}
        if(isset($data_array['child_id'])){$this->db->set('child_id', $data_array['child_id']);}
        if(isset($data_array['delivery_remarks'])){$this->db->set('delivery_remarks', $data_array['delivery_remarks']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        if(isset($data_array['delivery_outcome'])){$this->db->set('delivery_outcome', $data_array['delivery_outcome']);}
        if(isset($data_array['dcode1ext_code'])){$this->db->set('dcode1ext_code', $data_array['dcode1ext_code']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_antenatal_delivery');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_antenatal_delivery";

        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_antenatal_delivery($data_array)


    //************************************************************************
    /**
     * Method to insert New antenatal_postpartum
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_antenatal_postpartum($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting vitals details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_antenatal_postpartum
        if(isset($data_array['antenatal_postpartum_id'])){$this->db->set('antenatal_postpartum_id', $data_array['antenatal_postpartum_id']);}
        if(isset($data_array['antenatal_id'])){$this->db->set('antenatal_id', $data_array['antenatal_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['event_id'])){$this->db->set('event_id', $data_array['event_id']);}
        if(isset($data_array['care_date'])){$this->db->set('care_date', $data_array['care_date']);}
        if(isset($data_array['termination_date'])){$this->db->set('termination_date', $data_array['termination_date']);}
        if(isset($data_array['breastfeed'])){$this->db->set('breastfeed', $data_array['breastfeed']);}
        if(isset($data_array['want_family_planning'])){$this->db->set('want_family_planning', $data_array['want_family_planning']);}
        if(isset($data_array['fever_38'])){$this->db->set('fever_38', $data_array['fever_38']);}
        if(isset($data_array['vaginal_discharge'])){$this->db->set('vaginal_discharge', $data_array['vaginal_discharge']);}
        if(isset($data_array['vaginal_bleeding'])){$this->db->set('vaginal_bleeding', $data_array['vaginal_bleeding']);}
        if(isset($data_array['pallor'])){$this->db->set('pallor', $data_array['pallor']);}
        if(isset($data_array['cord'])){$this->db->set('cord', $data_array['cord']);}
        if(isset($data_array['postpartum_remarks'])){$this->db->set('postpartum_remarks', $data_array['postpartum_remarks']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_antenatal_postpartum');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_antenatal_postpartum";

        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_antenatal_postpartum($data_array)


    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update_antenatal_info
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_antenatal_info($data_array, $update_status=NULL)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['status'])){$this->db->set('status', $data_array['status']);}
        if(isset($data_array['antenatal_reference'])){$this->db->set('antenatal_reference', $data_array['antenatal_reference']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
        if(isset($data_array['update_when'])){$this->db->set('update_when', $data_array['update_when']);}
        if(isset($data_array['update_by'])){$this->db->set('update_by', $data_array['update_by']);}
        $this->db->where('antenatal_id', $data_array['antenatal_id']);
        $this->db->update('patient_antenatal');
        //echo $this->db->last_query();

        if($update_status <> "update_status"){
            if(isset($data_array['reading_date'])){$this->db->set('date', $data_array['reading_date']);}
            if(isset($data_array['husband_name'])){$this->db->set('husband_name', $data_array['husband_name']);}
            if(isset($data_array['husband_job'])){$this->db->set('husband_job', $data_array['husband_job']);}
            if(isset($data_array['husband_dob'])){$this->db->set('husband_dob', $data_array['husband_dob']);}
            if(isset($data_array['husband_ic_no'])){$this->db->set('husband_ic_no', $data_array['husband_ic_no']);}
            if(isset($data_array['gravida'])){$this->db->set('gravida', $data_array['gravida']);}
            if(isset($data_array['para'])){$this->db->set('para', $data_array['para']);}
            if(isset($data_array['method_contraception'])){$this->db->set('method_contraception', $data_array['method_contraception']);}
            if(isset($data_array['abortion'])){$this->db->set('abortion', $data_array['abortion']);}
            if(isset($data_array['past_obstretical_history_icpc'])){$this->db->set('past_obstretical_history_icpc', $data_array['past_obstretical_history_icpc']);}
            if(isset($data_array['past_obstretical_history_notes'])){$this->db->set('past_obstretical_history_notes', $data_array['past_obstretical_history_notes']);}
            if(isset($data_array['num_term_deliveries'])){$this->db->set('num_term_deliveries', $data_array['num_term_deliveries']);}
            if(isset($data_array['num_preterm_deliveries'])){$this->db->set('num_preterm_deliveries', $data_array['num_preterm_deliveries']);}
            if(isset($data_array['num_preg_lessthan_21wk'])){$this->db->set('num_preg_lessthan_21wk', $data_array['num_preg_lessthan_21wk']);}
            if(isset($data_array['num_live_births'])){$this->db->set('num_live_births', $data_array['num_live_births']);}
            if(isset($data_array['num_caesarean_births'])){$this->db->set('num_caesarean_births', $data_array['num_caesarean_births']);}
            if(isset($data_array['num_miscarriages'])){$this->db->set('num_miscarriages', $data_array['num_miscarriages']);}
            //$this->db->set('three_consec_miscarriages', $data_array['three_consec_miscarriages']);
            if(isset($data_array['three_consec_miscarriages'])){$this->db->set('three_consec_miscarriages', $data_array['three_consec_miscarriages']);}
            if(isset($data_array['num_stillbirths'])){$this->db->set('num_stillbirths', $data_array['num_stillbirths']);}
            if(isset($data_array['post_partum_depression'])){$this->db->set('post_partum_depression', $data_array['post_partum_depression']);}
            if(isset($data_array['present_pulmonary_tb'])){$this->db->set('present_pulmonary_tb', $data_array['present_pulmonary_tb']);}
            if(isset($data_array['present_heart_disease'])){$this->db->set('present_heart_disease', $data_array['present_heart_disease']);}
            if(isset($data_array['present_diabetes'])){$this->db->set('present_diabetes', $data_array['present_diabetes']);}
            if(isset($data_array['present_bronchial_asthma'])){$this->db->set('present_bronchial_asthma', $data_array['present_bronchial_asthma']);}
            if(isset($data_array['present_goiter'])){$this->db->set('present_goiter', $data_array['present_goiter']);}
            if(isset($data_array['present_hepatitis_b'])){$this->db->set('present_hepatitis_b', $data_array['present_hepatitis_b']);}
            if(isset($data_array['contact_person'])){$this->db->set('contact_person', $data_array['contact_person']);}
            if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
            if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
            if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
            if(isset($data_array['update_when'])){$this->db->set('update_when', $data_array['update_when']);}
            if(isset($data_array['update_by'])){$this->db->set('update_by', $data_array['update_by']);}
            $this->db->where('antenatal_info_id', $data_array['antenatal_info_id']);
            $this->db->update('patient_antenatal_info');
            //echo $this->db->last_query();
            
            if(isset($data_array['midwife_name'])){$this->db->set('midwife_name', $data_array['midwife_name']);}
            if(isset($data_array['pregnancy_duration'])){$this->db->set('pregnancy_duration', $data_array['pregnancy_duration']);}
            if(isset($data_array['lmp'])){$this->db->set('lmp', $data_array['lmp']);}
            if(isset($data_array['edd'])){$this->db->set('edd', $data_array['edd']);}
            if(isset($data_array['planned_place'])){$this->db->set('planned_place', $data_array['planned_place']);}
            if(isset($data_array['menstrual_cycle_length'])){$this->db->set('menstrual_cycle_length', $data_array['menstrual_cycle_length']);}
            if(isset($data_array['lmp_edd'])){$this->db->set('lmp_edd', $data_array['lmp_edd']);}
            if(isset($data_array['lmp_gestation'])){$this->db->set('lmp_gestation', $data_array['lmp_gestation']);}
            if(isset($data_array['usscan_date'])){$this->db->set('usscan_date', $data_array['usscan_date']);}
            if(isset($data_array['usscan_edd'])){$this->db->set('usscan_edd', $data_array['usscan_edd']);}
            if(isset($data_array['usscan_gestation'])){$this->db->set('usscan_gestation', $data_array['usscan_gestation']);}
            if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
            if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
            if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
            if(isset($data_array['update_when'])){$this->db->set('update_when', $data_array['update_when']);}
            if(isset($data_array['update_by'])){$this->db->set('update_by', $data_array['update_by']);}
            $this->db->where('antenatal_current_id', $data_array['antenatal_current_id']);
            $this->db->update('patient_antenatal_current');
            //echo $this->db->last_query();
        }
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_antenatal_info($data_array)


    //************************************************************************
    /**
     * Method to update_antenatal_followup
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_antenatal_followup($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['reading_date'])){$this->db->set('date', $data_array['reading_date']);}
        if(isset($data_array['pregnancy_duration'])){$this->db->set('pregnancy_duration', $data_array['pregnancy_duration']);}
        if(isset($data_array['lie'])){$this->db->set('lie', $data_array['lie']);}
        if(isset($data_array['weight'])){$this->db->set('weight', $data_array['weight']);}
        if(isset($data_array['fundal_height'])){$this->db->set('fundal_height', $data_array['fundal_height']);}
        if(isset($data_array['hb'])){$this->db->set('hb', $data_array['hb']);}
        if(isset($data_array['urine_alb'])){$this->db->set('urine_alb', $data_array['urine_alb']);}
        if(isset($data_array['urine_sugar'])){$this->db->set('urine_sugar', $data_array['urine_sugar']);}
        if(isset($data_array['ankle_odema'])){$this->db->set('ankle_odema', $data_array['ankle_odema']);}
        if(isset($data_array['notes'])){$this->db->set('notes', $data_array['notes']);}
        if(isset($data_array['next_followup'])){$this->db->set('next_followup', $data_array['next_followup']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
        if(isset($data_array['update_when'])){$this->db->set('update_when', $data_array['update_when']);}
        if(isset($data_array['update_by'])){$this->db->set('update_by', $data_array['update_by']);}
        if(isset($data_array['glucose_tolerance_test'])){$this->db->set('glucose_tolerance_test', $data_array['glucose_tolerance_test']);}
        if(isset($data_array['vaginal_bleeding'])){$this->db->set('vaginal_bleeding', $data_array['vaginal_bleeding']);}
        if(isset($data_array['vaginal_infection'])){$this->db->set('vaginal_infection', $data_array['vaginal_infection']);}
        if(isset($data_array['urinary_tract_infection'])){$this->db->set('urinary_tract_infection', $data_array['urinary_tract_infection']);}
        if(isset($data_array['blood_pressure'])){$this->db->set('blood_pressure', $data_array['blood_pressure']);}
        if(isset($data_array['fever'])){$this->db->set('fever', $data_array['fever']);}
        if(isset($data_array['pallor'])){$this->db->set('pallor', $data_array['pallor']);}
        if(isset($data_array['abnormal_fundal_height'])){$this->db->set('abnormal_fundal_height', $data_array['abnormal_fundal_height']);}
        if(isset($data_array['movements'])){$this->db->set('movements', $data_array['movements']);}
        if(isset($data_array['abnormal_presentation'])){$this->db->set('abnormal_presentation', $data_array['abnormal_presentation']);}
        if(isset($data_array['fetal_heart_tones'])){$this->db->set('fetal_heart_tones', $data_array['fetal_heart_tones']);}
        if(isset($data_array['missing_fetal_heartbeat'])){$this->db->set('missing_fetal_heartbeat', $data_array['missing_fetal_heartbeat']);}
        if(isset($data_array['supplement_iodine'])){$this->db->set('supplement_iodine', $data_array['supplement_iodine']);}
        if(isset($data_array['supplement_iron'])){$this->db->set('supplement_iron', $data_array['supplement_iron']);}
        if(isset($data_array['supplement_vitamins'])){$this->db->set('supplement_vitamins', $data_array['supplement_vitamins']);}
        if(isset($data_array['supplement_folate'])){$this->db->set('supplement_folate', $data_array['supplement_folate']);}
        if(isset($data_array['malaria_prophylaxis'])){$this->db->set('malaria_prophylaxis', $data_array['malaria_prophylaxis']);}
        if(isset($data_array['breastfeed_intention'])){$this->db->set('breastfeed_intention', $data_array['breastfeed_intention']);}
        if(isset($data_array['advise_4_danger_signs'])){$this->db->set('advise_4_danger_signs', $data_array['advise_4_danger_signs']);}
        if(isset($data_array['dental_checkup'])){$this->db->set('dental_checkup', $data_array['dental_checkup']);}
        if(isset($data_array['emergency_plans'])){$this->db->set('emergency_plans', $data_array['emergency_plans']);}
        if(isset($data_array['healthy_diet'])){$this->db->set('healthy_diet', $data_array['healthy_diet']);}
        if(isset($data_array['adequate_rest'])){$this->db->set('adequate_rest', $data_array['adequate_rest']);}
        if(isset($data_array['adequate_exercise'])){$this->db->set('adequate_exercise', $data_array['adequate_exercise']);}
        if(isset($data_array['thirdtrimester_issues'])){$this->db->set('thirdtrimester_issues', $data_array['thirdtrimester_issues']);}
        if(isset($data_array['followup_remarks'])){$this->db->set('followup_remarks', $data_array['followup_remarks']);}
        if(isset($data_array['risks'])){$this->db->set('risks', $data_array['risks']);}
        $this->db->where('antenatal_followup_id', $data_array['antenatal_followup_id']);
        $this->db->update('patient_antenatal_followup');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_antenatal_followup($data_array)


    //************************************************************************
    /**
     * Method to update_antenatal_delivery
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_antenatal_delivery($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['date_admission'])){$this->db->set('date_admission', $data_array['date_admission']);}
        if(isset($data_array['time_admission'])){$this->db->set('time_admission', $data_array['time_admission']);}
        if(isset($data_array['date_delivery'])){$this->db->set('date_delivery', $data_array['date_delivery']);}
        if(isset($data_array['time_delivery'])){$this->db->set('time_delivery', $data_array['time_delivery']);}
        if(isset($data_array['delivery_type'])){$this->db->set('delivery_type', $data_array['delivery_type']);}
        if(isset($data_array['delivery_place'])){$this->db->set('delivery_place', $data_array['delivery_place']);}
        if(isset($data_array['mother_condition'])){$this->db->set('mother_condition', $data_array['mother_condition']);}
        if(isset($data_array['baby_condition'])){$this->db->set('baby_condition', $data_array['baby_condition']);}
        if(isset($data_array['baby_weight'])){$this->db->set('baby_weight', $data_array['baby_weight']);}
        if(isset($data_array['complication_icpc'])){$this->db->set('complication_icpc', $data_array['complication_icpc']);}
        if(isset($data_array['complication_notes'])){$this->db->set('complication_notes', $data_array['complication_notes']);}
        if(isset($data_array['baby_alive'])){$this->db->set('baby_alive', $data_array['baby_alive']);}
        if(isset($data_array['birth_attendant'])){$this->db->set('birth_attendant', $data_array['birth_attendant']);}
        if(isset($data_array['breastfeed_immediate'])){$this->db->set('breastfeed_immediate', $data_array['breastfeed_immediate']);}
        if(isset($data_array['post_partum_bleed'])){$this->db->set('post_partum_bleed', $data_array['post_partum_bleed']);}
        if(isset($data_array['apgar_score'])){$this->db->set('apgar_score', $data_array['apgar_score']);}
        if(isset($data_array['child_id'])){$this->db->set('child_id', $data_array['child_id']);}
        if(isset($data_array['delivery_remarks'])){$this->db->set('delivery_remarks', $data_array['delivery_remarks']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
        if(isset($data_array['delivery_outcome'])){$this->db->set('delivery_outcome', $data_array['delivery_outcome']);}
        if(isset($data_array['dcode1ext_code'])){$this->db->set('dcode1ext_code', $data_array['dcode1ext_code']);}
        $this->db->where('antenatal_delivery_id', $data_array['antenatal_delivery_id']);
        $this->db->update('patient_antenatal_delivery');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_antenatal_delivery($data_array)


    //************************************************************************
    /**
     * Method to update_antenatal_postpartum
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_antenatal_postpartum($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        //if(isset($data_array['antenatal_id'])){$this->db->set('antenatal_id', $data_array['antenatal_id']);}
        //if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        //if(isset($data_array['event_id'])){$this->db->set('event_id', $data_array['event_id']);}
        if(isset($data_array['care_date'])){$this->db->set('care_date', $data_array['care_date']);}
        if(isset($data_array['termination_date'])){$this->db->set('termination_date', $data_array['termination_date']);}
        if(isset($data_array['breastfeed'])){$this->db->set('breastfeed', $data_array['breastfeed']);}
        if(isset($data_array['want_family_planning'])){$this->db->set('want_family_planning', $data_array['want_family_planning']);}
        if(isset($data_array['fever_38'])){$this->db->set('fever_38', $data_array['fever_38']);}
        if(isset($data_array['vaginal_discharge'])){$this->db->set('vaginal_discharge', $data_array['vaginal_discharge']);}
        if(isset($data_array['vaginal_bleeding'])){$this->db->set('vaginal_bleeding', $data_array['vaginal_bleeding']);}
        if(isset($data_array['pallor'])){$this->db->set('pallor', $data_array['pallor']);}
        if(isset($data_array['cord'])){$this->db->set('cord', $data_array['cord']);}
        if(isset($data_array['postpartum_remarks'])){$this->db->set('postpartum_remarks', $data_array['postpartum_remarks']);}
       $this->db->where('antenatal_postpartum_id', $data_array['antenatal_postpartum_id']);
        $this->db->update('patient_antenatal_postpartum');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_antenatal_postpartum($data_array)


    //===============================================================
    // Delete Database Records Methods


}

/* End of file MAntenatal_wdb.php */
/* Location: ./app_thirra/models/mantenatal_wdb.php */
