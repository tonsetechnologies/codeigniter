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
 * Portions created by the Initial Developer are Copyright (C) 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for EHR
 *
 * This class is for models that only writes to the database.
 *
 * @version 1.0.0
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MIndiv_rdb extends CI_Model
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
    // Query Database Methods
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_vitals($patient_id)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_vital";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        $sqlQuery   .=  " ORDER BY reading_date DESC, reading_time DESC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        }
        return $data; 
    } //end of function get_recent_vitals($patient_id)

 
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_history_social($query_type='List',$patient_id=NULL,$social_history_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_social_history";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        if(isset($social_history_id)){
            $sqlQuery   .=  " AND social_history_id='".$social_history_id."'";            
        }
        $sqlQuery   .=  " ORDER BY date DESC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_history_social($query_type='List',$patient_id=NULL,$vital_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of recent medication.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_medication($patient_id, $show_rows=999, $rows_from=0, $medication_id=NULL)
    {
        $dataset = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT patient_medication.*,
                            drug_formulary.generic_name, drug_formulary.formulary_code, drug_formulary.atc_code
                            FROM patient_medication";
        $sqlQuery   .=  " JOIN drug_formulary ON patient_medication.drug_formulary_id = drug_formulary.drug_formulary_id";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        $sqlQuery   .=  " ORDER BY date_started DESC";
		if(isset($show_rows)){
			$sqlQuery   .=  " LIMIT ".$show_rows;
		} else {

        }
		if(isset($rows_from)){
			$sqlQuery   .=  " OFFSET ".$rows_from;
		} else {

        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['medication_id']      = $row['medication_id'];
                $dataset[$rownum]['staff_id']           = $row['staff_id'];
                $dataset[$rownum]['dispense_queue_id']  = $row['dispense_queue_id'];
                $dataset[$rownum]['prescript_queue_id'] = $row['prescript_queue_id'];
                $dataset[$rownum]['drug_formulary_id']  = $row['drug_formulary_id'];
                $dataset[$rownum]['dose']               = $row['dose'];
                $dataset[$rownum]['dose_form']          = $row['dose_form'];
                $dataset[$rownum]['frequency']          = $row['frequency'];
                $dataset[$rownum]['instruction']        = $row['instruction'];
                $dataset[$rownum]['quantity']           = $row['quantity'];
                $dataset[$rownum]['quantity_form']      = $row['quantity_form'];
                $dataset[$rownum]['remarks']            = $row['remarks'];
                $dataset[$rownum]['date_started']       = $row['date_started'];
                $dataset[$rownum]['date_stopped']       = $row['date_stopped'];
                $dataset[$rownum]['reason']             = $row['reason'];
                $dataset[$rownum]['formulary_code']     = $row['formulary_code'];
                $dataset[$rownum]['atc_code']           = $row['atc_code'];
                $dataset[$rownum]['generic_name']       = $row['generic_name'];
                $rownum++;            
            }
        }            
        return $dataset; 
    } //end of function get_recent_medication($patient_id)

 
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_history_vitals($query_type='List',$patient_id=NULL,$vital_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_vital";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        $sqlQuery   .=  " ORDER BY reading_date DESC, reading_time DESC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_history_vitals($query_type='List',$patient_id=NULL,$vital_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve array of lab orders for a patient.
     *
     * If lab_order_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $lab_order_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_lab($patient_id, $lab_order_id=NULL)
    {
        $dataset = array();
        $this->_patient_id   =   $patient_id;
        if(isset($lab_order_id)){
            $this->_lab_order_id =   $lab_order_id;
        } else {
            $this->_lab_order_id =   NULL;
        }
        $sqlQuery   =   "SELECT lord.*,";
        $sqlQuery   .=  " lpac.package_code, lpac.package_name,
                            lpac.description, lpac.package_cost_std, lpac.sample_required,";
        $sqlQuery   .=  " lsup.supplier_id, lsup.supplier_name, lsup.acc_no";
        $sqlQuery   .=  " FROM lab_order lord";
        $sqlQuery   .=  " JOIN lab_package lpac ON lord.lab_package_id=lpac.lab_package_id";
        $sqlQuery   .=  " JOIN lab_supplier lsup ON lpac.supplier_id=lsup.supplier_id";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        if(isset($lab_order_id)){
            $sqlQuery   .=  " AND lord.lab_order_id='".$this->_lab_order_id."'";
        }
        $sqlQuery   .=  " ORDER BY lord.sample_date";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_recent_lab($summary_id)

 
    //************************************************************************
    /**
     * Method to retrieve array of imaging orders for a patient.
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $imaging_order_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_imaging($patient_id, $imaging_order_id=NULL)
    {
        $dataset = array();
        $this->_patient_id   =   $patient_id;
        if(isset($imaging_order_id)){
            $this->_imaging_order_id =   $imaging_order_id;
        } else {
            $this->_imaging_order_id =   NULL;
        }
        $sqlQuery   =   "SELECT imaging_order.*,";
        $sqlQuery   .=  " imaging_product.product_code, imaging_product.loinc_num,
                            imaging_product.description, imaging_product.retail_price,";
        $sqlQuery   .=  " ires.result_date, ires.notes,";
        $sqlQuery   .=  " imaging_supplier.supplier_id, imaging_supplier.supplier_name,";
        $sqlQuery   .=  " loinc.component,";
        $sqlQuery   .=  " patient_consultation_summary.date_started";
        $sqlQuery   .=  " FROM imaging_order";
        $sqlQuery   .=  " LEFT OUTER JOIN imaging_result ires ON imaging_order.order_id=ires.order_id";
        $sqlQuery   .=  " JOIN imaging_product ON imaging_order.product_id=imaging_product.product_id";
        $sqlQuery   .=  " JOIN imaging_supplier ON imaging_product.supplier_id=imaging_supplier.supplier_id";
        $sqlQuery   .=  " JOIN loinc ON imaging_product.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON imaging_order.session_id=patient_consultation_summary.summary_id";
        $sqlQuery   .=  " WHERE imaging_order.patient_id='".$this->_patient_id."'";
        //$sqlQuery   .=  " AND patient_complaint.icpc_code=icpc2_symptom.icpc_code";
        if(isset($imaging_order_id)){
            $sqlQuery   .=  " AND imaging_order.order_id='".$this->_imaging_order_id."'";
        }
        $sqlQuery   .=  " ORDER BY imaging_product.product_code";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum] = $row;
                /*
                $dataset[$rownum]['order_id']   = $row['order_id'];
                $dataset[$rownum]['supplier_ref']     = $row['supplier_ref'];
                $dataset[$rownum]['remarks']        = $row['remarks'];
                $dataset[$rownum]['product_code']   = $row['product_code'];
                $dataset[$rownum]['description']    = $row['description'];
                $dataset[$rownum]['retail_price']= $row['retail_price'];
                $dataset[$rownum]['supplier_id']    = $row['supplier_id'];
                $dataset[$rownum]['supplier_name']  = $row['supplier_name'];
                $dataset[$rownum]['component']  = $row['component'];
                */
                $rownum++;            
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_recent_imaging($patient_id, $imaging_order_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve details of recent diagnoses.
     *
     * 
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_diagnoses($patient_id,$prediagnosis=FALSE)
    {
        $dataset = array();
        $this->_patient_id   =   $patient_id;
        if(isset($diagnosis_id)){
            $this->_diagnosis_id =   $diagnosis_id;
        } else {
            $this->_diagnosis_id =   NULL;
        }
        $sqlQuery   =   "SELECT patient_diagnosis.*, patient_consultation_summary.date_ended,";
        $sqlQuery   .=  " dcode1ext.dcode1ext_shortname, dcode1ext.full_title,";
        $sqlQuery   .=  " dcode1.chapter, dcode1.dcode1_code";
        $sqlQuery   .=  " FROM patient_diagnosis, dcode1ext, dcode1, patient_consultation_summary";
        $sqlQuery   .=  " WHERE patient_diagnosis.patient_id='".$this->_patient_id."'";
        if($prediagnosis==TRUE){
            $sqlQuery   .=  " AND patient_diagnosis.diagnosis_type='Pre-diagnostic'";
        } else {
            $sqlQuery   .=  " AND patient_diagnosis.diagnosis_type<>'Pre-diagnostic'";
        }
        $sqlQuery   .=  " AND patient_diagnosis.dcode1ext_code=dcode1ext.dcode1ext_code";
        $sqlQuery   .=  " AND dcode1ext.dcode1_id=dcode1.dcode1_id";
        $sqlQuery   .=  " AND patient_diagnosis.session_id=patient_consultation_summary.summary_id";
        if(isset($diagnosis_id)){
            $sqlQuery   .=  " AND patient_diagnosis.diagnosis_id='".$this->_diagnosis_id."'";
        }
        $sqlQuery   .=  " ORDER BY patient_consultation_summary.date_ended DESC";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['diagnosis_id']   = $row['diagnosis_id'];
                $dataset[$rownum]['diagnosis_type'] = $row['diagnosis_type'];
                $dataset[$rownum]['diagnosis_notes']= $row['notes'];
                $dataset[$rownum]['dcode1set']      = $row['dcode1set'];
                $dataset[$rownum]['dcode1ext_code'] = $row['dcode1ext_code'];
                $dataset[$rownum]['dcode2set']      = $row['dcode2set'];
                $dataset[$rownum]['dcode2ext_code'] = $row['dcode2ext_code'];
                $dataset[$rownum]['remarks']        = $row['remarks'];
                $dataset[$rownum]['dcode1_code']    = $row['dcode1_code'];
                $dataset[$rownum]['full_title']     = $row['full_title'];
                $dataset[$rownum]['diagnosisChapter']= $row['chapter'];
                $dataset[$rownum]['diagnosisCategory']= $row['dcode1_code'];
                $dataset[$rownum]['diagnosis']      = $row['dcode1ext_code'];
                $dataset[$rownum]['diagnosis2']     = $row['dcode2ext_code'];
                $dataset[$rownum]['date_ended']     = $row['date_ended'];
                $rownum++;            
            }
        /*
        } else { //create dummy row
            $dataset[1]['diagnosis_id']   = "new_diagnosis";
            $dataset[1]['diagnosis_type'] = "";
            $dataset[1]['notes']          = "";
            $dataset[1]['dcode1ext_code'] = "";
        */
        reset($query);
        }
        return $dataset; 
    } //end of function get_recent_diagnoses($patient_id)

 
    //************************************************************************
    /**
     * Method to retrieve list of past consultations for one patient.
     *
     * Base is patient_demographic_info
     * This method also displays bio_case info if available.
     *
	 * @param   string  $patient_name      Optional parameter to filter
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_pastcons_list($patient_id=NULL)
    {
        $dataset = array();
        // Still need to find a way to display latest notification
        $sqlQuery   =   "SELECT patient_consultation_summary.*,";
        $sqlQuery   .=  " clinic_info.clinic_name, clinic_info.clinic_shortname";
        $sqlQuery   .=  " FROM patient_consultation_summary";
        $sqlQuery   .=  " JOIN clinic_info ON patient_consultation_summary.location_end=clinic_info.clinic_info_id";
        $sqlQuery   .=  " WHERE patient_id='".$patient_id."'";
        $sqlQuery   .=  " AND status > 0";
        $sqlQuery   .=  " ORDER BY date_started DESC";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[] = $row;
            }
        }
        return $dataset; 
    } //end of function get_pastcons_list($patient_name=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details for last antenatal event.
     *
     * 
     *
	 * @param   string  $summary_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_problem_list($patient_id, $problem_list_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT plis.*, ";
        $sqlQuery   .=  " sinf.staff_name,sinf.staff_initials";
        $sqlQuery   .=  " FROM patient_problem_list plis";
        $sqlQuery   .=  " JOIN staff_info sinf ON plis.staff_id=sinf.staff_id";
        $sqlQuery   .=  " where patient_id='".$patient_id."'";
        if(isset($problem_list_id)){
            $sqlQuery   .=  " AND plis.problem_list_id='".$problem_list_id."'";
        }
        $sqlQuery   .=  " ORDER BY date DESC";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_problem_list($patient_id)




}

/* End of file MIndiv_rdb.php */
/* Location: ./app_thirra/models/MIndiv_rdb.php */
