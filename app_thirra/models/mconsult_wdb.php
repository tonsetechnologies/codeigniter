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
 * @version 0.9.11
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MConsult_wdb extends CI_Model
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
     * Method to insert New Episode  
     *
     * This method creates a new consultation.
     * Status for patient_consultation_summary:
     * 0    -   Open
     * 1    -   Closed
     * 2    -   OTC Open
     * 3    -   Closed not billed
     * 10   -   Post Consultation
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_episode($data_array, $synch=NULL)
    {
        //$data = array();
        //$data   = $data_array;
        $_user_ip =   $this->input->ip_address();
        //echo "<hr />";
        //echo "Inserting episode details";
        //echo "<pre>";
        //print_r($data_array);
        //echo "</pre>";

        // Begin transaction
        $this->db->trans_begin();
        
        /*
          check_in_remarks character varying(255),
          check_out_estimate date,
          check_out_date date,
          check_out_time time without time zone,
          check_out_staff character(10),
          check_out_remarks character varying(255),
          physician_1 character(10),
          physician_2 character(10),
          specialist_1 character(10),
          specialist_2 character(10),
          discharge_notes text,
          security_deposit numeric(10,2),
          security_reference character varying(20),
          security_type character varying(20),
          security_trans_id character(10),
        */
        // Insert into adt
        if(isset($data_array['adt_id'])){$this->db->set('adt_id', $data_array['adt_id']);}
        if(isset($data_array['adt_reference'])){$this->db->set('adt_reference', $data_array['adt_reference']);}
        if(isset($data_array['adt_sequence'])){$this->db->set('adt_sequence', $data_array['adt_sequence']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['check_in_date'])){$this->db->set('check_in_date', $data_array['check_in_date']);}
        if(isset($data_array['check_in_time'])){$this->db->set('check_in_time', $data_array['check_in_time']);}
        if(isset($data_array['staff_id'])){$this->db->set('check_in_staff', $data_array['staff_id']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['synch_start'])){$this->db->set('synch_start', $data_array['synch_start']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        // Perform db insert
        if(isset($synch)){
            $this->db->insert('syn_adt');
        } else {
            $this->db->insert('adt');
        }
        //echo $this->db->last_query();
        //echo "<br />Inserted into adt";

        // Insert into patient_consultation_summary
        /*
          note_billing text, -- Added on Jan 22, 08
          note_staff text, -- Added on Jan 22, 08
          note_patient text, -- Added on Jan 22, 08
          con_workflow text, -- Added on Jan 22, 08
          booking_id character varying(10), -- Added on Jan 22, 08
        */
        if(isset($data_array['summary_id'])){$this->db->set('summary_id', $data_array['summary_id']);}
        if(isset($data_array['session_ref'])){$this->db->set('session_ref', $data_array['session_ref']);}
        if(isset($data_array['session_sequence'])){$this->db->set('session_sequence', $data_array['session_sequence']);}
        if(isset($data_array['external_ref'])){$this->db->set('external_ref', $data_array['external_ref']);}
        if(isset($data_array['session_type'])){$this->db->set('session_type', $data_array['session_type']);}
        if(isset($data_array['adt_id'])){$this->db->set('adt_id', $data_array['adt_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['date_started'])){$this->db->set('date_started', $data_array['date_started']);}
        if(isset($data_array['time_started'])){$this->db->set('time_started', $data_array['time_started']);}
        if(isset($data_array['date_ended'])){$this->db->set('date_ended', $data_array['date_ended']);}
        if(isset($data_array['time_ended'])){$this->db->set('time_ended', $data_array['time_ended']);}
        if(isset($data_array['signed_by'])){$this->db->set('signed_by', $data_array['signed_by']);}
        if(isset($data_array['location_start'])){$this->db->set('location_start', $data_array['location_start']);}
        if(isset($data_array['location_end'])){$this->db->set('location_end', $data_array['location_end']);}
        $this->db->set('ip_start', $_user_ip);
        $this->db->set('ip_end', $_user_ip);
        //if(isset($data_array['ip_start'])){$this->db->set('ip_start', $data_array['ip_start']);}
        //if(isset($data_array['ip_end'])){$this->db->set('ip_end', $data_array['ip_end']);}
        if(isset($data_array['summary'])){$this->db->set('summary', $data_array['summary']);}
        if(isset($data_array['status'])){$this->db->set('status', $data_array['status']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['synch_start'])){$this->db->set('synch_start', $data_array['synch_start']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        if(isset($synch)){
            $this->db->insert('syn_patient_consultation_summary');
        } else {
            $this->db->insert('patient_consultation_summary');
        }
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_consultation_summary";

        //echo "Inserted<br />";
        // End transaction
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            echo "<br /><br />Some errors were found. Consultation commencemnt not completed.";
        } else {
            $this->db->trans_commit();
            //echo "<br /><br />No errors found. New Consultation started.";
        }
        //echo "<hr />";
    } // end of function insert_new_episode($data_array)


    //************************************************************************
    /**
     * Method to insert New Patient Complaint  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_complaint($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting diagnosis details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */

        /*
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_diagnosis
        if(isset($data_array['complaint_id'])){$this->db->set('complaint_id', $data_array['complaint_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['icpc_code'])){$this->db->set('icpc_code', $data_array['icpc_code']);} //deprecate
        if(isset($data_array['duration'])){$this->db->set('duration', $data_array['duration']);}
        if(isset($data_array['complaint_notes'])){$this->db->set('notes', $data_array['complaint_notes']);}
        if(isset($data_array['ccode1ext_code'])){$this->db->set('ccode1ext_code', $data_array['ccode1ext_code']);}
        if(isset($data_array['complaint_rank'])){$this->db->set('complaint_rank', $data_array['complaint_rank']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_complaint');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_complaint";
		
        $last_query = $this->db->last_query();
        $clast_query = str_replace("VALUES" , "VALUE_S", $last_query);
		//echo $clast_query;
        $audit_sql   =  "INSERT INTO offline_log(offline_log_id,offline_log_table,offline_log_type,offline_log_sql
,offline_log_timestamp,offline_log_user)
                        VALUES (".$data_array['complaint_id'].",'patient_complaint','inserting','".addslashes($clast_query).",".$data_array['complaint_id']."',".$data_array['complaint_id'].")";
        //echo "<br />".$sqlQuery;
        //$query =  $this->db->query($audit_sql);
        //echo $this->db->last_query();

        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_complaint($data_array)


    //************************************************************************
    /**
     * Method to insert New Vital Signs  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_vitals($data_array)
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
        // Insert into patient_vital
        if(isset($data_array['vital_id'])){$this->db->set('vital_id', $data_array['vital_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['adt_id'])){$this->db->set('adt_id', $data_array['adt_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['reading_date'])){$this->db->set('reading_date', $data_array['reading_date']);}
        if(isset($data_array['reading_time'])){$this->db->set('reading_time', $data_array['reading_time']);}
        if(isset($data_array['time'])){$this->db->set('time', $data_array['time']);}
        if(isset($data_array['height'])){$this->db->set('height', $data_array['height']);}
        if(isset($data_array['weight'])){$this->db->set('weight', $data_array['weight']);}
        if(isset($data_array['left_vision'])){$this->db->set('left_vision', $data_array['left_vision']);}
        if(isset($data_array['right_vision'])){$this->db->set('right_vision', $data_array['right_vision']);}
        if(isset($data_array['temperature'])){$this->db->set('temperature', $data_array['temperature']);}
        if(isset($data_array['pulse_rate'])){$this->db->set('pulse_rate', $data_array['pulse_rate']);}
        if(isset($data_array['blood_pressure'])){$this->db->set('blood_pressure', $data_array['blood_pressure']);}
        if(isset($data_array['bmi'])){$this->db->set('bmi', $data_array['bmi']);}
        if(isset($data_array['waist_circumference'])){$this->db->set('waist_circumference', $data_array['waist_circumference']);}
        if(isset($data_array['bp_systolic'])){$this->db->set('bp_systolic', $data_array['bp_systolic']);}
        if(isset($data_array['bp_diastolic'])){$this->db->set('bp_diastolic', $data_array['bp_diastolic']);}
        if(isset($data_array['respiration_rate'])){$this->db->set('respiration_rate', $data_array['respiration_rate']);}
        if(isset($data_array['ofc'])){$this->db->set('ofc', $data_array['ofc']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_vital');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_vital";

        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_vitals($data_array)


    //************************************************************************
    /**
     * Method to insert New Physical Examination  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_physical_exam($data_array)
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
        // Insert into patient_physical_exam
        if(isset($data_array['physical_exam_id'])){$this->db->set('physical_exam_id', $data_array['physical_exam_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['pulse_rate'])){$this->db->set('pulse_rate', $data_array['pulse_rate']);}
        if(isset($data_array['pulse_regular'])){$this->db->set('pulse_regular', $data_array['pulse_regular']);}
        if(isset($data_array['pulse_regular_spec'])){$this->db->set('pulse_regular_spec', $data_array['pulse_regular_spec']);}
        if(isset($data_array['pulse_volume'])){$this->db->set('pulse_volume', $data_array['pulse_volume']);}
        if(isset($data_array['pulse_volume_spec'])){$this->db->set('pulse_volume_spec', $data_array['pulse_volume_spec']);}
        if(isset($data_array['heart_rhythm'])){$this->db->set('heart_rhythm', $data_array['heart_rhythm']);}
        if(isset($data_array['heart_rhythm_spec'])){$this->db->set('heart_rhythm_spec', $data_array['heart_rhythm_spec']);}
        if(isset($data_array['heart_murmur'])){$this->db->set('heart_murmur', $data_array['heart_murmur']);}
        if(isset($data_array['heart_murmur_spec'])){$this->db->set('heart_murmur_spec', $data_array['heart_murmur_spec']);}
        if(isset($data_array['lung_clear'])){$this->db->set('lung_clear', $data_array['lung_clear']);}
        if(isset($data_array['lung_clear_spec'])){$this->db->set('lung_clear_spec', $data_array['lung_clear_spec']);}
        if(isset($data_array['chest_measurement_in'])){$this->db->set('chest_measurement_in', $data_array['chest_measurement_in']);}
        if(isset($data_array['chest_measurement_out'])){$this->db->set('chest_measurement_out', $data_array['chest_measurement_out']);}
        if(isset($data_array['percussion'])){$this->db->set('percussion', $data_array['percussion']);}
        if(isset($data_array['percussion_spec'])){$this->db->set('percussion_spec', $data_array['percussion_spec']);}
        if(isset($data_array['abdominal_girth'])){$this->db->set('abdominal_girth', $data_array['abdominal_girth']);}
        if(isset($data_array['liver_palpable'])){$this->db->set('liver_palpable', $data_array['liver_palpable']);}
        if(isset($data_array['liver_palpable_spec'])){$this->db->set('liver_palpable_spec', $data_array['liver_palpable_spec']);}
        if(isset($data_array['spleen_palpable'])){$this->db->set('spleen_palpable', $data_array['spleen_palpable']);}
        if(isset($data_array['spleen_palpable_spec'])){$this->db->set('spleen_palpable_spec', $data_array['spleen_palpable_spec']);}
        if(isset($data_array['kidney_palpable'])){$this->db->set('kidney_palpable', $data_array['kidney_palpable']);}
        if(isset($data_array['kidney_palpable_spec'])){$this->db->set('kidney_palpable_spec', $data_array['kidney_palpable_spec']);}
        if(isset($data_array['external_genitalia'])){$this->db->set('external_genitalia', $data_array['external_genitalia']);}
        if(isset($data_array['external_genitalia_spec'])){$this->db->set('external_genitalia_spec', $data_array['external_genitalia_spec']);}
        if(isset($data_array['perectal_exam'])){$this->db->set('perectal_exam', $data_array['perectal_exam']);}
        if(isset($data_array['hernial_orifices'])){$this->db->set('hernial_orifices', $data_array['hernial_orifices']);}
        if(isset($data_array['hernial_orifices_spec'])){$this->db->set('hernial_orifices_spec', $data_array['hernial_orifices_spec']);}
        if(isset($data_array['pupils_equal'])){$this->db->set('pupils_equal', $data_array['pupils_equal']);}
        if(isset($data_array['pupils_reactive'])){$this->db->set('pupils_reactive', $data_array['pupils_reactive']);}
        if(isset($data_array['reflexes'])){$this->db->set('reflexes', $data_array['reflexes']);}
        if(isset($data_array['notes'])){$this->db->set('notes', $data_array['notes']);}
        if(isset($data_array['breasts'])){$this->db->set('breasts', $data_array['breasts']);}
        if(isset($data_array['breasts_spec'])){$this->db->set('breasts_spec', $data_array['breasts_spec']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_physical_exam');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_physical_exam";

        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_physical_exam($data_array)


    //************************************************************************
    /**
     * Method to insert New Lab Order  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_lab_order($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting lab order";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into lab_order
        if(isset($data_array['lab_order_id'])){$this->db->set('lab_order_id', $data_array['lab_order_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['lab_package_id'])){$this->db->set('lab_package_id', $data_array['lab_package_id']);}
        if(isset($data_array['product_id'])){$this->db->set('product_id', $data_array['product_id']);}
        if(isset($data_array['sample_ref'])){$this->db->set('sample_ref', $data_array['sample_ref']);}
        if(isset($data_array['sample_date'])){$this->db->set('sample_date', $data_array['sample_date']);}
        if(isset($data_array['sample_time'])){$this->db->set('sample_time', $data_array['sample_time']);}
        if(isset($data_array['fasting'])){$this->db->set('fasting', $data_array['fasting']);}
        if(isset($data_array['urgency'])){$this->db->set('urgency', $data_array['urgency']);}
        if(isset($data_array['summary_result'])){$this->db->set('summary_result', $data_array['summary_result']);}
        if(isset($data_array['result_status'])){$this->db->set('result_status', $data_array['result_status']);}
        if(isset($data_array['invoice_status'])){$this->db->set('invoice_status', $data_array['invoice_status']);}
        if(isset($data_array['invoice_detail_id'])){$this->db->set('invoice_detail_id', $data_array['invoice_detail_id']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('lab_order');
        //echo $this->db->last_query();
        //echo "<br />Inserted into lab_order";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_lab_order($data_array)


    //************************************************************************
    /**
     * Method to insert New Lab Result  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_lab_result($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting lab order";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into lab_result
        if(isset($data_array['lab_result_id'])){$this->db->set('lab_result_id', $data_array['lab_result_id']);}
        if(isset($data_array['lab_order_id'])){$this->db->set('lab_order_id', $data_array['lab_order_id']);}
        if(isset($data_array['sort_test'])){$this->db->set('sort_test', $data_array['sort_test']);}
        if(isset($data_array['lab_package_test_id'])){$this->db->set('lab_package_test_id', $data_array['lab_package_test_id']);}
        if(isset($data_array['result_date'])){$this->db->set('result_date', $data_array['result_date']);}
        if(isset($data_array['date_recorded'])){$this->db->set('date_recorded', $data_array['date_recorded']);}
        if(isset($data_array['reply_method'])){$this->db->set('reply_method', $data_array['reply_method']);}
        if(isset($data_array['reply_ack_date'])){$this->db->set('reply_ack_date', $data_array['reply_ack_date']);}
        if(isset($data_array['result'])){$this->db->set('result', $data_array['result']);}
        if(isset($data_array['loinc_num'])){$this->db->set('loinc_num', $data_array['loinc_num']);}
        if(isset($data_array['normal_reading'])){$this->db->set('normal_reading', $data_array['normal_reading']);}
        if(isset($data_array['abnormal_flag'])){$this->db->set('abnormal_flag', $data_array['abnormal_flag']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['result_remarks'])){$this->db->set('result_remarks', $data_array['result_remarks']);}
        if(isset($data_array['result_reviewed_by'])){$this->db->set('result_reviewed_by', $data_array['result_reviewed_by']);}
        if(isset($data_array['result_reviewed_date'])){$this->db->set('result_reviewed_date', $data_array['result_reviewed_date']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        if(isset($data_array['lab_enhanced_id'])){$this->db->set('lab_enhanced_id', $data_array['lab_enhanced_id']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('lab_result');
        //echo $this->db->last_query();
        //echo "<br />Inserted into lab_result";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_lab_result($data_array)


    //************************************************************************
    /**
     * Method to insert New Imaging Order  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_imaging_order($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting imaging order";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into imaging_order
        if(isset($data_array['order_id'])){$this->db->set('order_id', $data_array['order_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['product_id'])){$this->db->set('product_id', $data_array['product_id']);}
        if(isset($data_array['supplier_ref'])){$this->db->set('supplier_ref', $data_array['supplier_ref']);}
        if(isset($data_array['result_status'])){$this->db->set('result_status', $data_array['result_status']);}
        if(isset($data_array['invoice_status'])){$this->db->set('invoice_status', $data_array['invoice_status']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('imaging_order');
        //echo $this->db->last_query();
        //echo "<br />Inserted into imaging_order";

        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_imaging_order($data_array)


    //************************************************************************
    /**
     * Method to insert New Diagnosis  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required   
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_diagnosis($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting diagnosis details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */

        /*
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_diagnosis
        if(isset($data_array['diagnosis_id'])){$this->db->set('diagnosis_id', $data_array['diagnosis_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['icpc_code'])){$this->db->set('icpc_code', $data_array['icpc_code']);} //deprecate
        if(isset($data_array['diagnosis_type'])){$this->db->set('diagnosis_type', $data_array['diagnosis_type']);}
        if(isset($data_array['diagnosis_notes'])){$this->db->set('notes', $data_array['diagnosis_notes']);}
        if(isset($data_array['dcode1set'])){$this->db->set('dcode1set', $data_array['dcode1set']);}
        if(isset($data_array['dcode1ext_code'])){$this->db->set('dcode1ext_code', $data_array['dcode1ext_code']);}
        if(isset($data_array['dcode2set'])){$this->db->set('dcode2set', $data_array['dcode2set']);}
        if(isset($data_array['dcode2ext_code'])){$this->db->set('dcode2ext_code', $data_array['dcode2ext_code']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_diagnosis');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_diagnosis";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_diagnosis($data_array)


    //************************************************************************
    /**
     * Method to insert New Prescription 
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required     
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_prescribe($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting prescript_queue details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */

        /*
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into prescript_queue
        if(isset($data_array['prescribe_id'])){$this->db->set('queue_id', $data_array['prescribe_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['drug_formulary_id'])){$this->db->set('drug_formulary_id', $data_array['drug_formulary_id']);} //deprecate
        if(isset($data_array['dose'])){$this->db->set('dose', $data_array['dose']);}
        if(isset($data_array['dose_form'])){$this->db->set('dose_form', $data_array['dose_form']);}
        if(isset($data_array['frequency'])){$this->db->set('frequency', $data_array['frequency']);}
        if(isset($data_array['instruction'])){$this->db->set('instruction', $data_array['instruction']);}
        if(isset($data_array['quantity'])){$this->db->set('quantity', $data_array['quantity']);}
        if(isset($data_array['quantity_form'])){$this->db->set('quantity_form', $data_array['quantity_form']);}
        if(isset($data_array['indication'])){$this->db->set('indication', $data_array['indication']);}
        if(isset($data_array['caution'])){$this->db->set('caution', $data_array['caution']);}
        if(isset($data_array['status'])){$this->db->set('status', $data_array['status']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        if(isset($data_array['dose_duration'])){$this->db->set('dose_duration', $data_array['dose_duration']);}
        if(isset($data_array['generic_drugname'])){$this->db->set('generic_drugname', $data_array['generic_drugname']);}
        if(isset($data_array['drug_tradename'])){$this->db->set('drug_tradename', $data_array['drug_tradename']);}
        if(isset($data_array['prescript_remarks'])){$this->db->set('prescript_remarks', $data_array['prescript_remarks']);}
        if(isset($data_array['drug_code_id'])){$this->db->set('drug_code_id', $data_array['drug_code_id']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('prescript_queue');
        //echo $this->db->last_query();
        //echo "<br />Inserted into prescript_queue";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_prescribe($data_array)


    //************************************************************************
    /**
     * Method to insert New Dispensing 
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required     
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_dispense($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting dispense_queue";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
  dispensed_date date, -- Added on June 7, 2006
  dispensed_time time without time zone, -- Added on June 7, 2006
  unit_revenue numeric(12,5), -- Added on Sept 21, 06
  ucost_std numeric(12,5), -- Added on June 7, 2006
  ucost_fifo numeric(12,5), -- Added on June 7, 2006
  ucost_wac numeric(12,5), -- Added on June 7, 2006
  location_id character(10), -- Added on June 7, 2006
        */
        // Insert into dispense_queue
        if(isset($data_array['queue_id'])){$this->db->set('queue_id', $data_array['queue_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['dispense_ref'])){$this->db->set('dispense_ref', $data_array['dispense_ref']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['product_id'])){$this->db->set('product_id', $data_array['product_id']);} //deprecate
        if(isset($data_array['dose'])){$this->db->set('dose', $data_array['dose']);}
        if(isset($data_array['dose_form'])){$this->db->set('dose_form', $data_array['dose_form']);}
        if(isset($data_array['frequency'])){$this->db->set('frequency', $data_array['frequency']);}
        if(isset($data_array['instruction'])){$this->db->set('instruction', $data_array['instruction']);}
        if(isset($data_array['quantity'])){$this->db->set('quantity', $data_array['quantity']);}
        if(isset($data_array['quantity_form'])){$this->db->set('quantity_form', $data_array['quantity_form']);}
        if(isset($data_array['indication'])){$this->db->set('indication', $data_array['indication']);}
        if(isset($data_array['caution'])){$this->db->set('caution', $data_array['caution']);}
        if(isset($data_array['adt_id'])){$this->db->set('adt_id', $data_array['adt_id']);}
        if(isset($data_array['status'])){$this->db->set('status', $data_array['status']);}
        if(isset($data_array['drug_code_id'])){$this->db->set('drug_code_id', $data_array['drug_code_id']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('dispense_queue');
        //echo $this->db->last_query();
        //echo "<br />Inserted into dispense_queue";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_dispense($data_array)


    //************************************************************************
    /**
     * Method to insert New Prescription OBSOLETE !!!
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required     
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_vaccine_prescribe($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting diagnosis details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        // Insert into prescript_queue
        if(isset($data_array['prescribe_id'])){$this->db->set('queue_id', $data_array['prescribe_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['drug_formulary_id'])){$this->db->set('drug_formulary_id', $data_array['drug_formulary_id']);} //deprecate
        if(isset($data_array['dose'])){$this->db->set('dose', $data_array['dose']);}
        if(isset($data_array['dose_form'])){$this->db->set('dose_form', $data_array['dose_form']);}
        if(isset($data_array['frequency'])){$this->db->set('frequency', $data_array['frequency']);}
        if(isset($data_array['instruction'])){$this->db->set('instruction', $data_array['instruction']);}
        if(isset($data_array['quantity'])){$this->db->set('quantity', $data_array['quantity']);}
        if(isset($data_array['quantity_form'])){$this->db->set('quantity_form', $data_array['quantity_form']);}
        if(isset($data_array['indication'])){$this->db->set('indication', $data_array['indication']);}
        if(isset($data_array['caution'])){$this->db->set('caution', $data_array['caution']);}
        if(isset($data_array['status'])){$this->db->set('status', $data_array['status']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('prescript_queue');
        //echo $this->db->last_query();
        //echo "<br />Inserted into prescript_queue";

        // Insert row into patient_immunisation
        if(isset($data_array['patient_immunisation_id'])){$this->db->set('patient_immunisation_id', $data_array['patient_immunisation_id']);} // Not NULL
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);} // Not NULL
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);} // Not NULL
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['vaccine_date'])){$this->db->set('date', (string)$data_array['vaccine_date']);}
        if(isset($data_array['immunisation_id'])){$this->db->set('immunisation_id', $data_array['immunisation_id']);} // Not NULL
        if(isset($data_array['dispense_queue_id'])){$this->db->set('dispense_queue_id', $data_array['dispense_queue_id']);}
        if(isset($data_array['prescribe_id'])){$this->db->set('prescript_queue_id', $data_array['prescribe_id']);}
        if(isset($data_array['vaccine_notes'])){$this->db->set('notes', $data_array['vaccine_notes']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        // Perform db insert
        $this->db->insert('patient_immunisation');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_immunisation";

		//echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_vaccine_prescribe($data_array)


    //************************************************************************
    /**
     * Method to insert New Immunisation  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required     
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_vaccine($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting vaccine details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        // Insert row into patient_immunisation
        if(isset($data_array['patient_immunisation_id'])){$this->db->set('patient_immunisation_id', $data_array['patient_immunisation_id']);} // Not NULL
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);} // Not NULL
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);} // Not NULL
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['vaccine_date'])){$this->db->set('date', (string)$data_array['vaccine_date']);}
        if(isset($data_array['immunisation_id'])){$this->db->set('immunisation_id', $data_array['immunisation_id']);} // Not NULL
        if(isset($data_array['dispense_queue_id'])){$this->db->set('dispense_queue_id', $data_array['dispense_queue_id']);}
        if(isset($data_array['prescribe_id'])){$this->db->set('prescript_queue_id', $data_array['prescribe_id']);}
        if(isset($data_array['vaccine_notes'])){$this->db->set('notes', $data_array['vaccine_notes']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        // Perform db insert
        $this->db->insert('patient_immunisation');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_immunisation";

		//echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_vaccine($data_array)


    //************************************************************************
    /**
     * Method to insert New Patient Referral
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_referral($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting patient_referral";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_referral
        if(isset($data_array['referral_id'])){$this->db->set('referral_id', $data_array['referral_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', (string)$data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['referral_doctor_id'])){$this->db->set('referral_doctor_id', $data_array['referral_doctor_id']);}
        if(isset($data_array['referral_doctor_name'])){$this->db->set('referral_doctor_name', $data_array['referral_doctor_name']);}
        if(isset($data_array['referral_specialty'])){$this->db->set('referral_specialty', $data_array['referral_specialty']);}
        if(isset($data_array['referral_centre'])){$this->db->set('referral_centre', $data_array['referral_centre']);}
        if(isset($data_array['referral_date'])){$this->db->set('referral_date', $data_array['referral_date']);}
        if(isset($data_array['reason'])){$this->db->set('reason', $data_array['reason']);}
        if(isset($data_array['clinical_exam'])){$this->db->set('clinical_exam', $data_array['clinical_exam']);}
        if(isset($data_array['history_attached'])){$this->db->set('history_attached', (int)$data_array['history_attached']);}
        if(isset($data_array['referral_sequence'])){$this->db->set('referral_sequence', $data_array['referral_sequence']);}
        if(isset($data_array['referral_reference'])){$this->db->set('referral_reference', $data_array['referral_reference']);}
        if(isset($data_array['date_replied'])){$this->db->set('date_replied', $data_array['date_replied']);}
        if(isset($data_array['replying_doctor'])){$this->db->set('replying_doctor', $data_array['replying_doctor']);}
        if(isset($data_array['replying_specialty'])){$this->db->set('replying_specialty', $data_array['replying_specialty']);}
        if(isset($data_array['replying_centre'])){$this->db->set('replying_centre', $data_array['replying_centre']);}
        if(isset($data_array['department'])){$this->db->set('department', $data_array['department']);}
        if(isset($data_array['findings'])){$this->db->set('findings', $data_array['findings']);}
        if(isset($data_array['investigation'])){$this->db->set('investigation', $data_array['investigation']);}
        if(isset($data_array['diagnosis'])){$this->db->set('diagnosis', $data_array['diagnosis']);}
        if(isset($data_array['treatment'])){$this->db->set('treatment', $data_array['treatment']);}
        if(isset($data_array['plan'])){$this->db->set('plan', $data_array['plan']);}
        if(isset($data_array['comments'])){$this->db->set('comments', $data_array['comments']);}
        if(isset($data_array['reply_recorder'])){$this->db->set('reply_recorder', $data_array['reply_recorder']);}
        if(isset($data_array['date_recorded'])){$this->db->set('date_recorded', $data_array['date_recorded']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_referral');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_referral";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_referral($data_array)


    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update_complaint
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_complaint($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        $this->db->set('patient_id', (string)$data_array['patient_id']);
        $this->db->set('session_id', $data_array['session_id']);
        $this->db->set('icpc_code', $data_array['icpc_code']); 
        $this->db->set('duration', $data_array['duration']);
        $this->db->set('notes', $data_array['complaint_notes']);
        $this->db->set('ccode1ext_code', $data_array['ccode1ext_code']);
        $this->db->set('remarks', $data_array['remarks']);
        $this->db->where('complaint_id', $data_array['complaint_id']);
        $this->db->update('patient_complaint');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_complaint($data_array)


    //************************************************************************
    /**
     * Method to update current vitals
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_vitals($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
  vital_edited boolean, -- Added on Nov 23, 06
  edit_reason character varying(255), -- Added on Nov 23, 06
  edit_staff character(10), -- Added on Nov 23, 06
  edit_date date, -- Added on Nov 23, 06
  vital_deleted boolean, -- Added on Nov 23, 06
  delete_reason character varying(255), -- Added on Nov 23, 06
  delete_staff character(10), -- Added on Nov 23, 06
  delete_date date, -- Added on Nov 23, 06
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        //$this->db->set('patient_id', (string)$data_array['patient_id']);
        //$this->db->set('session_id', $data_array['session_id']);
        //$this->db->set('adt_id', $data_array['adt_id']);
        //$this->db->set('staff_id', $data_array['staff_id']);
        $this->db->set('reading_date', $data_array['reading_date']);
        if(isset($data_array['reading_time'])){$this->db->set('reading_time', $data_array['reading_time']);}
        //$this->db->set('time', $data_array['time']);
        if(isset($data_array['height'])){$this->db->set('height', $data_array['height']);}
        if(isset($data_array['weight'])){$this->db->set('weight', $data_array['weight']);}
        if(isset($data_array['left_vision'])){$this->db->set('left_vision', $data_array['left_vision']);}
        if(isset($data_array['right_vision'])){$this->db->set('right_vision', $data_array['right_vision']);}
        if(isset($data_array['temperature'])){$this->db->set('temperature', $data_array['temperature']);}
        if(isset($data_array['pulse_rate'])){$this->db->set('pulse_rate', $data_array['pulse_rate']);}
        //$this->db->set('blood_pressure', $data_array['blood_pressure']);
        if(isset($data_array['bmi'])){$this->db->set('bmi', $data_array['bmi']);}
        if(isset($data_array['waist_circumference'])){$this->db->set('waist_circumference', $data_array['waist_circumference']);}
        if(isset($data_array['bp_systolic'])){$this->db->set('bp_systolic', $data_array['bp_systolic']);}
        if(isset($data_array['bp_diastolic'])){$this->db->set('bp_diastolic', $data_array['bp_diastolic']);}
        if(isset($data_array['respiration_rate'])){$this->db->set('respiration_rate', $data_array['respiration_rate']);}
        if(isset($data_array['ofc'])){$this->db->set('ofc', $data_array['ofc']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        $this->db->where('vital_id', $data_array['vital_id']);
        $this->db->update('patient_vital');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_vitals($data_array)


    //************************************************************************
    /**
     * Method to update current physical_exam
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_physical_exam($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['pulse_rate'])){$this->db->set('pulse_rate', $data_array['pulse_rate']);}
        if(isset($data_array['pulse_regular'])){$this->db->set('pulse_regular', $data_array['pulse_regular']);}
        if(isset($data_array['pulse_regular_spec'])){$this->db->set('pulse_regular_spec', $data_array['pulse_regular_spec']);}
        if(isset($data_array['pulse_volume'])){$this->db->set('pulse_volume', $data_array['pulse_volume']);}
        if(isset($data_array['pulse_volume_spec'])){$this->db->set('pulse_volume_spec', $data_array['pulse_volume_spec']);}
        if(isset($data_array['heart_rhythm'])){$this->db->set('heart_rhythm', $data_array['heart_rhythm']);}
        if(isset($data_array['heart_rhythm_spec'])){$this->db->set('heart_rhythm_spec', $data_array['heart_rhythm_spec']);}
        if(isset($data_array['heart_murmur'])){$this->db->set('heart_murmur', $data_array['heart_murmur']);}
        if(isset($data_array['heart_murmur_spec'])){$this->db->set('heart_murmur_spec', $data_array['heart_murmur_spec']);}
        if(isset($data_array['lung_clear'])){$this->db->set('lung_clear', $data_array['lung_clear']);}
        if(isset($data_array['lung_clear_spec'])){$this->db->set('lung_clear_spec', $data_array['lung_clear_spec']);}
        if(isset($data_array['chest_measurement_in'])){$this->db->set('chest_measurement_in', $data_array['chest_measurement_in']);}
        if(isset($data_array['chest_measurement_out'])){$this->db->set('chest_measurement_out', $data_array['chest_measurement_out']);}
        if(isset($data_array['percussion'])){$this->db->set('percussion', $data_array['percussion']);}
        if(isset($data_array['percussion_spec'])){$this->db->set('percussion_spec', $data_array['percussion_spec']);}
        if(isset($data_array['abdominal_girth'])){$this->db->set('abdominal_girth', $data_array['abdominal_girth']);}
        if(isset($data_array['liver_palpable'])){$this->db->set('liver_palpable', $data_array['liver_palpable']);}
        if(isset($data_array['liver_palpable_spec'])){$this->db->set('liver_palpable_spec', $data_array['liver_palpable_spec']);}
        if(isset($data_array['spleen_palpable'])){$this->db->set('spleen_palpable', $data_array['spleen_palpable']);}
        if(isset($data_array['spleen_palpable_spec'])){$this->db->set('spleen_palpable_spec', $data_array['spleen_palpable_spec']);}
        if(isset($data_array['kidney_palpable'])){$this->db->set('kidney_palpable', $data_array['kidney_palpable']);}
        if(isset($data_array['kidney_palpable_spec'])){$this->db->set('kidney_palpable_spec', $data_array['kidney_palpable_spec']);}
        if(isset($data_array['external_genitalia'])){$this->db->set('external_genitalia', $data_array['external_genitalia']);}
        if(isset($data_array['external_genitalia_spec'])){$this->db->set('external_genitalia_spec', $data_array['external_genitalia_spec']);}
        if(isset($data_array['perectal_exam'])){$this->db->set('perectal_exam', $data_array['perectal_exam']);}
        if(isset($data_array['hernial_orifices'])){$this->db->set('hernial_orifices', $data_array['hernial_orifices']);}
        if(isset($data_array['hernial_orifices_spec'])){$this->db->set('hernial_orifices_spec', $data_array['hernial_orifices_spec']);}
        if(isset($data_array['pupils_equal'])){$this->db->set('pupils_equal', $data_array['pupils_equal']);}
        if(isset($data_array['pupils_reactive'])){$this->db->set('pupils_reactive', $data_array['pupils_reactive']);}
        if(isset($data_array['reflexes'])){$this->db->set('reflexes', $data_array['reflexes']);}
        if(isset($data_array['notes'])){$this->db->set('notes', $data_array['notes']);}
        if(isset($data_array['breasts'])){$this->db->set('breasts', $data_array['breasts']);}
        if(isset($data_array['breasts_spec'])){$this->db->set('breasts_spec', $data_array['breasts_spec']);}
        $this->db->where('physical_exam_id', (string)$data_array['physical_exam_id']);
        $this->db->update('patient_physical_exam');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_physical_exam($data_array)


    //************************************************************************
    /**
     * Method to update current diagnosis
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_diagnosis($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        $this->db->set('patient_id', (string)$data_array['patient_id']);
        $this->db->set('session_id', $data_array['session_id']);
        //$this->db->set('icpc_code', $data_array['icpc_code']); //deprecated
        $this->db->set('diagnosis_type', $data_array['diagnosis_type']);
        $this->db->set('notes', $data_array['diagnosis_notes']);
        $this->db->set('dcode1set', $data_array['dcode1set']);
        $this->db->set('dcode1ext_code', $data_array['dcode1ext_code']);
        //$this->db->set('dcode2set', $data_array['dcode2set']);
        //$this->db->set('dcode2ext_code', $data_array['dcode2ext_code']);
        $this->db->set('remarks', $data_array['remarks']);
        $this->db->where('diagnosis_id', $data_array['diagnosis_id']);
        $this->db->update('patient_diagnosis');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_diagnosis($data_array)


    //************************************************************************
    /**
     * Method to update_prescription
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_prescription($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
            print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        //$this->db->set('patient_id', (string)$data_array['patient_id']);
        //$this->db->set('session_id', $data_array['session_id']);
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['drug_formulary_id'])){$this->db->set('drug_formulary_id', $data_array['drug_formulary_id']);}
        if(isset($data_array['dose'])){$this->db->set('dose', $data_array['dose']);}
        if(isset($data_array['dose_form'])){$this->db->set('dose_form', $data_array['dose_form']);}
        if(isset($data_array['frequency'])){$this->db->set('frequency', $data_array['frequency']);}
        if(isset($data_array['instruction'])){$this->db->set('instruction', $data_array['instruction']);}
        if(isset($data_array['quantity'])){$this->db->set('quantity', $data_array['quantity']);}
        if(isset($data_array['quantity_form'])){$this->db->set('quantity_form', $data_array['quantity_form']);}
        if(isset($data_array['indication'])){$this->db->set('indication', $data_array['indication']);}
        if(isset($data_array['caution'])){$this->db->set('caution', $data_array['caution']);}
        if(isset($data_array['status'])){$this->db->set('status', $data_array['status']);}
        if(isset($data_array['dose_duration'])){$this->db->set('dose_duration', $data_array['dose_duration']);}
        if(isset($data_array['drug_code_id'])){$this->db->set('drug_code_id', $data_array['drug_code_id']);}
        $this->db->where('queue_id', (string)$data_array['queue_id']);
        $this->db->update('prescript_queue');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_prescription($data_array)


    //************************************************************************
    /**
     * Method to update current imaging_result
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_consult_referral($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['referral_id'])){$this->db->set('referral_id', $data_array['referral_id']);}
        if(isset($data_array['referral_doctor_id'])){$this->db->set('referral_doctor_id', $data_array['referral_doctor_id']);}
        if(isset($data_array['referral_doctor_name'])){$this->db->set('referral_doctor_name', $data_array['referral_doctor_name']);}
        if(isset($data_array['referral_specialty'])){$this->db->set('referral_specialty', $data_array['referral_specialty']);}
        if(isset($data_array['referral_centre'])){$this->db->set('referral_centre', $data_array['referral_centre']);}
        if(isset($data_array['referral_date'])){$this->db->set('referral_date', $data_array['referral_date']);}
        if(isset($data_array['reason'])){$this->db->set('reason', $data_array['reason']);}
        if(isset($data_array['clinical_exam'])){$this->db->set('clinical_exam', $data_array['clinical_exam']);}
        if(isset($data_array['history_attached'])){$this->db->set('history_attached', $data_array['history_attached']);}
        if(isset($data_array['referral_sequence'])){$this->db->set('referral_sequence', $data_array['referral_sequence']);}
        if(isset($data_array['referral_reference'])){$this->db->set('referral_reference', $data_array['referral_reference']);}
        $this->db->where('referral_id', $data_array['referral_id']);
        $this->db->update('patient_referral');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_consult_referral($data_array)


    //************************************************************************
    /**
     * Method to close clinical consultation episode
     *
     * This method 
     *
	 * @param   array  data_array      Required
	 * @param   array  diagnosis_array Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function end_episode($data_array,$diagnosis_array=NULL)
    {
        //$data = array();
        //$data   = $data_array;
        $_user_ip =   $this->input->ip_address();        
        /*
        echo "<hr />";
        echo "Updating episode details";
        echo "<pre>";
        print_r($data_array);
        print_r($diagnosis_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        // Begin transaction
        $this->db->trans_begin();
        
        //$this->db->set('patient_id', (string)$data_array['patient_id']);
        $this->db->set('session_ref', $data_array['session_ref']);
        //$this->db->set('session_sequence', $data_array['session_sequence']); 
        $this->db->set('external_ref', $data_array['external_ref']);
        $this->db->set('date_started', $data_array['date_started']);
        $this->db->set('time_started', $data_array['time_started']);
        $this->db->set('date_ended', $data_array['date_ended']);
        $this->db->set('time_ended', $data_array['time_ended']);
        $this->db->set('signed_by', $data_array['signed_by']);
        $this->db->set('location_end', $data_array['location_end']);
        $this->db->set('ip_end', $_user_ip);
        $this->db->set('summary', $data_array['consult_summary']);
        $this->db->set('status', $data_array['status']);
        $this->db->set('remarks', $data_array['remarks']);
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        $this->db->where('summary_id', $data_array['summary_id']);
        //$this->db->update('patient_con');
        $this->db->update('patient_consultation_summary');
        //echo $this->db->last_query();

        $this->db->set('check_out_date', $data_array['check_out_date']);
        $this->db->set('check_out_time', $data_array['check_out_time']);
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        $this->db->where('adt_id', $data_array['adt_id']);
        //$this->db->update('patient_con');
        $this->db->update('adt');
        //echo $this->db->last_query();

        /*
  "month" character varying(2),
  "year" character varying(4),
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_medical_history
        //echo "Transfering to medical history";
        foreach($diagnosis_array as $diagnosis_item){
            $this->db->set('medical_history_id', $diagnosis_item['diagnosis_id']);
            $this->db->set('patient_id', (string)$data_array['patient_id']);
            $this->db->set('staff_id', $data_array['signed_by']);
            $this->db->set('history_date', $data_array['date_ended']);
            $this->db->set('condition', $diagnosis_item['full_title']);
            $this->db->set('status', 'In-house Consultation');
            if(isset($diagnosis_item['diagnosis_notes'])){$this->db->set('summary', $diagnosis_item['diagnosis_notes']);}
            $this->db->set('dcode1set', $diagnosis_item['dcode1set']);
            $this->db->set('dcode1ext_code', $diagnosis_item['dcode1ext_code']);
            if(isset($diagnosis_item['dcode2set'])){$this->db->set('dcode2set', $diagnosis_item['dcode2set']);}
            if(isset($diagnosis_item['dcode2ext_code'])){$this->db->set('dcode2ext_code', $diagnosis_item['dcode2ext_code']);}
            if(isset($diagnosis_item['remarks'])){$this->db->set('remarks', $diagnosis_item['remarks']);}
			if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
             // Perform db insert
            $this->db->insert('patient_medical_history');
            //echo "\n<br />";
            //echo $this->db->last_query();
        }
            //echo "<br />Inserted into patient_diagnosis";

        // End transaction
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            //echo "<br /><br />Some errors were found. Patient registration not completed.";
        } else {
            $this->db->trans_commit();
            //echo "<br /><br />No errors found. Patient registration completed.";
        }
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function end_episode($data_array,$diagnosis_array=NULL)


    //===============================================================
    // Delete Database Records Methods
    //************************************************************************
    /**
     * Method to delete prescription
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function consult_delete_session($data_array)
    {

        // Begin transaction
        $this->db->trans_begin();

        $this->db->where('summary_id', (string)$data_array['summary_id']);
        $this->db->delete('patient_consultation_summary');
        //echo $this->db->last_query();

        $this->db->where('adt_id', (string)$data_array['summary_id']);
        $this->db->delete('adt');
        //echo $this->db->last_query();

        // End transaction
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            echo "<br /><br />Some errors were found. Consultation deletion not completed.";
        } else {
            $this->db->trans_commit();
            //echo "<br /><br />No errors found. Consultation session deleted.";
        }
        //echo "<hr />";
    } // end of function consult_delete_session($data_array)


    //************************************************************************
    /**
     * Method to delete complaint
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function consult_delete_complaint($data_array)
    {
        
        $this->db->where('complaint_id', (string)$data_array['complaint_id']);
        $this->db->delete('patient_complaint');
        //echo $this->db->last_query();
        //echo "Deleted<br />";
        //echo "<hr />";
    } // end of function consult_delete_complaint($data_array)


    //************************************************************************
    /**
     * Method to delete lab order
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function consult_delete_lab($data_array)
    {
        /*
        echo "<hr />";
        echo "delete immunisation";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        switch($data_array['ordering_status']){
            case "TRUE":
                $this->db->where('lab_order_id', (string)$data_array['lab_order_id']);
                $this->db->delete('lab_result');
                break;
            case "FALSE":
                break;
        } //endswitch($data_array['ordering_status'])
        $this->db->where('lab_order_id', (string)$data_array['lab_order_id']);
        $this->db->delete('lab_order');
        //echo $this->db->last_query();
        //echo "Deleted<br />";
        //echo "<hr />";
    } // end of function consult_delete_lab($data_array)


    //************************************************************************
    /**
     * Method to delete diagnosis
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function consult_delete_diagnosis($data_array)
    {
        /*
        echo "<hr />";
        echo "delete immunisation";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        $this->db->where('diagnosis_id', (string)$data_array['diagnosis_id']);
        $this->db->delete('patient_diagnosis');
        //echo $this->db->last_query();
        //echo "Deleted<br />";
        //echo "<hr />";
    } // end of function consult_delete_diagnosis($data_array)


    //************************************************************************
    /**
     * Method to delete prescription
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function consult_delete_prescription($data_array)
    {
        /*
        echo "<hr />";
        echo "delete immunisation";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        $this->db->where('queue_id', (string)$data_array['queue_id']);
        $this->db->delete('prescript_queue');
        //echo $this->db->last_query();
        //echo "Deleted<br />";
        //echo "<hr />";
    } // end of function consult_delete_prescription($data_array)


    //************************************************************************
    /**
     * Method to delete lab package test
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function delete_lab_packagetest($data_array)
    {
        /*
        echo "<hr />";
        echo "delete lab_package_test";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        $this->db->where('lab_package_test_id', (string)$data_array['lab_package_test_id']);
        $this->db->delete('lab_package_test');
        //echo $this->db->last_query();
        //echo "Deleted<br />";
        //echo "<hr />";
    } // end of function delete_lab_packagetest($data_array)


}

/* End of file MConsult_wdb.php */
/* Location: ./app_thirra/models/mconsult_wdb.php */
