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
 * Portions created by the Initial Developer are Copyright (C) 2009
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Classes for Reports Module
 *
 *
 */

class Mpatients extends CI_Model{

    protected $_patient_name      =  "";
    protected $_patient_id      =  "";

    function __construct()
    {
        parent::__construct();

    }


    function getPatientInfo($id){
        $data = array();
        $options = array('patient_id' => $id);
        $Q = $this->db->get_where('patient_demographic_info',$options,1);
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }
        $Q->free_result();    
        return $data;    
    } //end of function getPatientInfo($id)


    function getPatientPastCon($id){
        $data = array();
        $this->db->select('summary_id, patient_demographic_info.patient_id, date_started');
        $this->db->from('patient_demographic_info');
        $this->db->join('patient_consultation_summary','patient_demographic_info.patient_id=patient_consultation_summary.patient_id','left inner join');
        $this->db->where('patient_demographic_info.patient_id', $id);
        $this->db->orderby('date_started');
        //echo $this->db->_compile_select();
        $Q = $this->db->get();
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
        //$data = $Q->row_array();
            foreach ($Q->result_array() as $row){
            $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function getPatientPastCon($id)


    function getPastConDetails($id){
        $data = array();
        $this->db->select('summary_id, patient_demographic_info.patient_id, session_ref, date_started, date_ended, time_ended');
        $this->db->from('patient_demographic_info');
        $this->db->join('patient_consultation_summary','patient_demographic_info.patient_id=patient_consultation_summary.patient_id','left inner join');
        $this->db->where('patient_consultation_summary.summary_id', $id);
        //echo $this->db->_compile_select();
        $Q = $this->db->get();
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
            //foreach ($Q->result_array() as $row){
            //  $data[] = $row;
            //}
        }
        $Q->free_result();    
        return $data;    
    } //end of function getPastConDetails($id)


    function get_all_patients()
    {
        $data = array();
        $Q = $this->db->get('patient_demographic_info');
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data; 
    }

 
 
}
