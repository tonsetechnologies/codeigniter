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
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for EMR
 *
 * This class is for models that only reads from the database.
 *
 * @version 0.9.14
 * @package THIRRA - mEMR-Rdb
 * @author  Jason Tan Boon Teck
 */

class MPharma_rdb extends CI_Model
{
    protected $_location_id     =  "";
    protected $_patient_id      =  "";
    protected $_summary_id      =  "";
    protected $_complaint_id    =  "";
    protected $_lab_order_id    =  "";
    protected $_imaging_order_id=  "";
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


    //************************************************************************
    /**
     * Method to retrieve details of recent medication.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_medication($patient_id)
    {
        $dataset = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT patient_medication.*,
                            drug_formulary.generic_name, drug_formulary.formulary_code, drug_formulary.atc_code
                            FROM patient_medication";
        $sqlQuery   .=  " JOIN drug_formulary ON patient_medication.drug_formulary_id = drug_formulary.drug_formulary_id";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
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
     * Method to retrieve array of prescriptions for an episode.
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $diagnosis_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patcon_prescribe($summary_id, $queue_id=NULL)
    {
        $dataset = array();
        $this->_summary_id   =   $summary_id;
        if(isset($queue_id)){
            $this->_queue_id =   $queue_id;
        } else {
            $this->_queue_id =   NULL;
        }
        $sqlQuery   =   "SELECT prescript_queue.*,";
        $sqlQuery   .=  " drug_formulary.generic_name, drug_formulary.formulary_code, drug_formulary.formulary_system,";
        $sqlQuery   .=  " drug_code.trade_name";
        $sqlQuery   .=  " FROM prescript_queue"; //, dcode1";
        $sqlQuery   .=  " JOIN drug_formulary ON prescript_queue.drug_formulary_id=drug_formulary.drug_formulary_id";
        $sqlQuery   .=  " LEFT OUTER JOIN drug_code ON prescript_queue.prescript_queue_1=drug_code.drug_code_id";
        $sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        //$sqlQuery   .=  " AND prescript_queue.drug_formulary_id=drug_formulary.drug_formulary_id";
        //$sqlQuery   .=  " AND dcode1ext.dcode1_id=dcode1.dcode1_id";
        if(isset($queue_id)){
            $sqlQuery   .=  " AND prescript_queue.queue_id='".$this->_queue_id."'";
        }
        $sqlQuery   .=  " ORDER BY drug_formulary.generic_name";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['queue_id']       = $row['queue_id'];
                $dataset[$rownum]['drug_formulary_id'] = $row['drug_formulary_id'];
                $dataset[$rownum]['dose']           = $row['dose'];
                $dataset[$rownum]['dose_form']      = $row['dose_form'];
                $dataset[$rownum]['frequency']      = $row['frequency'];
                $dataset[$rownum]['instruction']    = $row['instruction'];
                $dataset[$rownum]['quantity']       = $row['quantity'];
                $dataset[$rownum]['quantity_form']  = $row['quantity_form'];
                $dataset[$rownum]['indication']     = $row['indication'];
                $dataset[$rownum]['caution']        = $row['caution'];
                $dataset[$rownum]['status']         = $row['status'];
                $dataset[$rownum]['dose_duration']           = $row['dose_duration'];
                $dataset[$rownum]['synch_out']           = $row['synch_out'];
                $dataset[$rownum]['synch_remarks']           = $row['synch_remarks'];
                $dataset[$rownum]['formulary_code'] = $row['formulary_code'];
                $dataset[$rownum]['generic_name']   = $row['generic_name'];
                $dataset[$rownum]['formulary_system']= $row['formulary_system'];
                $dataset[$rownum]['drug_code_id']   = $row['prescript_queue_1']; // Temporary usage pending Inventory Management
                $dataset[$rownum]['trade_name']   = $row['trade_name'];
                $rownum++;            
            }
        /*
        } else { //create dummy row
            $dataset[1]['diagnosis_id']   = "new_prescribe";
            $dataset[1]['diagnosis_type'] = "";
            $dataset[1]['notes']          = "";
            $dataset[1]['dcode1ext_code'] = "";
        */
        reset($query);
        }
        return $dataset; 
    } //end of function get_patcon_prescribe($summary_id)

 
    //************************************************************************
    /**
     * Method to retrieve list of drug systems
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drug_system()
    {
        $data = array();
        $sqlQuery   =   "SELECT DISTINCT formulary_system";
        $sqlQuery   .=  " FROM drug_formulary";
        $sqlQuery   .=  " ORDER BY formulary_system";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_drug_system()


    //************************************************************************
    /**
     * Method to retrieve list of drug formulary
     *
     * This method 
     *
	 * @param   string  $system      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_formulary_by_system($system=NULL)
    {
        $data = array();
        if(empty($system)) {
            $system = "NULL";
        }
        $sqlQuery   =   "SELECT drug_formulary_id,formulary_code,generic_name,formulary_system,commonly_used,usfda_preg_cat,poison_cat";
        $sqlQuery   .=  " FROM drug_formulary";
        $sqlQuery   .=  " WHERE 1=1";
        if($system == "All") {
            // No condition
        } else {
            $sqlQuery   .=  " AND formulary_system ILIKE '$system%'";
        }
        $sqlQuery   .=  " ORDER BY generic_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_formulary_by_system($system)


    //************************************************************************
    /**
     * Method to retrieve list of drug formulary for a vaccine
     *
     * This method 
     *
	 * @param   string  $system      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_formulary_by_vaccine($immunisation_id=NULL)
    {
        $data = array();
        if(empty($system)) {
            $system = "NULL";
        }
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM drug_formulary";
        $sqlQuery   .=  " JOIN immunisation_drug ON drug_formulary.drug_formulary_id=immunisation_drug.drug_formulary_id";
        $sqlQuery   .=  " WHERE immunisation_drug.immunisation_id = '$immunisation_id'";
        $sqlQuery   .=  " ORDER BY generic_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_formulary_by_vaccine($immunisation_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of drug codes
     *
     * This method 
     *
	 * @param   string  $formulary_code      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_tradename_by_formulary($drug_formulary_id)
    {
        $data = array();
        if(empty($drug_formulary_id)) {
            $drug_formulary_id = "NULL";
        }
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM drug_code";
        $sqlQuery   .=  " WHERE drug_formulary_id ='$drug_formulary_id'";
        $sqlQuery   .=  " ORDER BY trade_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_tradename_by_formulary($drug_formulary_id)


    //************************************************************************
    /**
     * Method to retrieve list of drug codes
     *
     * This method 
     *
	 * @param   string  $formulary_code      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drugstock_by_formulary($drug_formulary_id,$clinic_info_id)
    {
        $data = array();
        if(empty($drug_formulary_id)) {
            $drug_formulary_id = "NULL";
        }
        //$sqlQuery   =   "SELECT dstk.*,";
        $sqlQuery   =  "SELECT product_id,quantity,dprd.drug_code_id,dprd.product_name AS trade_name";
        $sqlQuery   .=  " FROM drug_product dprd";
        //$sqlQuery   .=  " JOIN drug_product dprd ON dstk.product_id=dprd.product_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND dprd.formulary_id ='".$drug_formulary_id."'";
        $sqlQuery   .=  " AND dprd.quantity > 0";
        if(isset($clinic_info_id)){
            $sqlQuery   .=  " AND dprd.location_id = '".$clinic_info_id."'";
        }
        $sqlQuery   .=  " ORDER BY dprd.product_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_drugstock_by_formulary($drug_formulary_id,$clinic_info_id)


    //************************************************************************
    /**
     * Method to retrieve list of drug codes  DEPRECATED
     *
     * This method 
     *
	 * @param   string  $formulary_code      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function zget_drugstock_by_formulary($drug_formulary_id,$clinic_info_id)
    {
        $data = array();
        if(empty($drug_formulary_id)) {
            $drug_formulary_id = "NULL";
        }
        $sqlQuery   =   "SELECT dstk.*,";
        $sqlQuery   .=  " dprd.drug_code_id,dprd.product_name AS trade_name";
        $sqlQuery   .=  " FROM drug_stock dstk";
        $sqlQuery   .=  " JOIN drug_product dprd ON dstk.product_id=dprd.product_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND dprd.formulary_id ='".$drug_formulary_id."'";
        $sqlQuery   .=  " AND dstk.quantity > 0";
        $sqlQuery   .=  " ORDER BY dprd.product_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function zget_drugstock_by_formulary($drug_formulary_id)


    //************************************************************************
    /**
     * Method to retrieve list of generic drugs based on filter.
     *
     * This method retrieves all generic drugs if 1st argument is given.
     *
	 * @param   string  $search_term1      Optional parameter to filter
	 * @param   string  $search_term2      Optional parameter to filter
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_formulary_list($pull_all=FALSE,$search_term1=NULL,$search_term2=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM drug_formulary";
        $sqlQuery   .=  " WHERE drug_formulary.drug_formulary_id IS NOT NULL";
        if(isset($search_term1)){
            $sqlQuery   .=  " AND drug_formulary.generic_name ILIKE '%$search_term1%'";
            if(isset($search_term2)) {
                $sqlQuery   .=  " AND drug_formulary.indication ILIKE '%$search_term2%'";
            }
        } elseif($pull_all) {
            echo "pull all";
            // retrieve all
        } else {
            //echo "else";
            $sqlQuery   .=  " AND drug_formulary.generic_name ILIKE 'do nothing'";
        }
        $sqlQuery   .=  " ORDER BY drug_formulary.generic_name ";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        }
        return $dataset; 
    } //end of function get_formulary_list($search_term=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of one generic drug.
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_drug_formulary($code_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT *
                            FROM drug_formulary";
        $sqlQuery   .=  " WHERE drug_formulary_id='".$code_id."'";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        }            
        return $data; 
    } //end of function get_one_drug_formulary($code_id)

 
    //************************************************************************
    /**
     * Method to retrieve list of generic drugs commonly used.
     *
     * 
     *
	 * @param   string  none      No parameter is required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_common_formulary()
    {
        $dataset = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM drug_formulary";
        $sqlQuery   .=  " WHERE drug_formulary.commonly_used > 0";
        $sqlQuery   .=  " ORDER BY drug_formulary.commonly_used ";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        }
        return $dataset; 
    } //end of function get_common_formulary()

 
    //************************************************************************
    /**
     * Method to retrieve list of vaccines from IMMUNISATION table
     *
     * This method 
     *
	 * @param   string  patient_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_vaccines_list($patient_id, $vaccine_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT immunisation.*, pati.patient_immunisation_id, pati.staff_id, pati.date, 
                            pati.session_id, pati.dispense_queue_id, pati.prescript_queue_id, pati.notes, 
                            pati.synch_out, pati.synch_remarks";
        $sqlQuery   .=  " FROM immunisation";
        $sqlQuery   .=  " LEFT OUTER JOIN patient_immunisation pati ON immunisation.immunisation_id=pati.immunisation_id";
		$sqlQuery   .=  " AND pati.patient_id = '".$patient_id."'";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND immunisation.age_group IS NOT NULL";
		if(isset($vaccine_id)){
			$sqlQuery   .=  " AND immunisation.immunisation_id = '".$vaccine_id."'";
		} else {
			//if(isset($patient_id)){
			//	$sqlQuery   .=  " AND patient_immunisation.patient_id IS NOT NULL";
			//}
		}
        $sqlQuery   .=  " ORDER BY immunisation.immunisation_sort ";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        }
        return $dataset; 
    } // end of function get_vaccines_list($patient_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of pending Dispensings
     *
     * This method 
     *
	 * @param   string  $formulary_code      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_pending_dispensings($status='Pending',$location_id=NULL)
    {
        $data = array();
        if(empty($drug_formulary_id)) {
            $drug_formulary_id = "NULL";
        }
        $sqlQuery   =   "SELECT distinct session_id, date_ended, dispense_queue.patient_id,name,name_first,birth_date,gender";
        $sqlQuery   .=  " FROM dispense_queue";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON dispense_queue.session_id = patient_consultation_summary.summary_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON dispense_queue.patient_id = patient_demographic_info.patient_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND dispense_queue.status ='".$status."'";
        if(isset($location_id)){
            $sqlQuery   .=  " AND patient_consultation_summary.location_end ='".$location_id."'";
        }
        $sqlQuery   .=  " ORDER BY session_id";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_pending_dispensings()


    //************************************************************************
    /**
     * Method to retrieve list of pending prescriptions
     *
     * This method 
     *
	 * @param   string  $formulary_code      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_pending_prescriptions($status='Pending',$location_id=NULL)
    {
        $data = array();
        if(empty($drug_formulary_id)) {
            $drug_formulary_id = "NULL";
        }
        $sqlQuery   =   "SELECT distinct session_id, date_ended, prescript_queue.patient_id,name,name_first,birth_date,gender";
        $sqlQuery   .=  " FROM prescript_queue";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON prescript_queue.session_id = patient_consultation_summary.summary_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON prescript_queue.patient_id = patient_demographic_info.patient_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND prescript_queue.status ='".$status."'";
        if(isset($location_id)){
            $sqlQuery   .=  " AND patient_consultation_summary.location_end ='".$location_id."'";
        }
        $sqlQuery   .=  " ORDER BY session_id";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_pending_prescriptions()


    //************************************************************************
    /**
     * Method to retrieve list of drug suppliers
     *
     * This method 
     *
	 * @param   string  $package_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_supplier_list_drug($supplier_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT dsup.*,";
        $sqlQuery   .=  " scin.address, scin.address2, scin.address3, scin.postcode, scin.town, scin.state, scin.country,";
        $sqlQuery   .=  " scin.contact_person, scin.tel_no, scin.tel2_no, scin.tel3_no, scin.fax_no, scin.fax2_no, scin.email, scin.contact_other,scin.website, scin.contact_remarks";
        $sqlQuery   .=  " FROM drug_supplier dsup";
        $sqlQuery   .=  " JOIN supplier_contact_info scin ON dsup.contact_id=scin.contact_id";
		if(isset($supplier_id)){
			$sqlQuery   .=  " WHERE dsup.supplier_id = '".$supplier_id."'";
		}
        $sqlQuery   .=  " ORDER BY supplier_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_supplier_list_drug($supplier_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of drug products by supplier
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drug_product_bysupplier($supplier_id,$location_id=NULL,$drug_product_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT drug_product.*,";
        $sqlQuery   .=  " drug_supplier.supplier_name, drug_supplier.acc_no,";
        $sqlQuery   .=  " drug_code.generic_name, drug_code.trade_name, drug_code.drug_system";
        $sqlQuery   .=  " FROM drug_product";
        $sqlQuery   .=  " JOIN drug_supplier ON drug_product.supplier_id=drug_supplier.supplier_id";
        $sqlQuery   .=  " JOIN drug_code ON drug_product.drug_code_id=drug_code.drug_code_id";
        $sqlQuery   .=  " WHERE drug_product.supplier_id='".$supplier_id."'";
		if(isset($location_id)){
			$sqlQuery   .=  " AND drug_product.location_id='".$location_id."'";
		}
		if(isset($drug_product_id)){
			$sqlQuery   .=  " AND drug_product.product_id='".$drug_product_id."'";
		}
        $sqlQuery   .=  " ORDER BY trade_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_drug_product_bysupplier($supplier_id,$imag_package_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of drug products by supplier
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drug_product_quantity($drug_product_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT dstk.stock_id, dstk.quantity, dstk.expiry_date, dstk.mafg_batch, dstk.drug_source";
        $sqlQuery   .=  " FROM drug_stock dstk";
        $sqlQuery   .=  " WHERE 1=1";
		$sqlQuery   .=  " AND dstk.product_id='".$drug_product_id."'";
        $sqlQuery   .=  " ORDER BY expiry_date";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_drug_product_quantity($drug_product_id)


    //************************************************************************
    /**
     * Method to retrieve list of drug supplier invoices
     *
     * This method 
     *
	 * @param   string  $package_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drugsupplier_list_invoices($supplier_id, $supplier_invoice_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT sinv.*";
        $sqlQuery   .=  " FROM supplier_invoice sinv";
        $sqlQuery   .=  " WHERE sinv.supplier_id = '".$supplier_id."'";
		if(isset($supplier_invoice_id)){
			$sqlQuery   .=  " AND sinv.supplier_invoice_id = '".$supplier_invoice_id."'";
		}
        $sqlQuery   .=  " ORDER BY invoice_no";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_drugsupplier_list_invoices($supplier_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve details of drug supplier invoices
     *
     * This method 
     *
	 * @param   string  $package_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drugsinvoice_details_withpo($supplier_invoice_id, $supplier_inv_drug_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT sidr.*, dord.*, dprd.*";
        $sqlQuery   .=  " FROM supplier_inv_drug sidr";
        $sqlQuery   .=  " JOIN drug_order dord ON sidr.order_id=dord.order_id";
        $sqlQuery   .=  " JOIN drug_product dprd ON dord.product_id=dprd.product_id";
        $sqlQuery   .=  " WHERE sidr.supplier_invoice_id = '".$supplier_invoice_id."'";
		if(isset($supplier_inv_drug_id)){
			$sqlQuery   .=  " AND sidr.supplier_inv_drug_id = '".$supplier_inv_drug_id."'";
		}
        $sqlQuery   .=  " ORDER BY supplier_inv_drug_id";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_drugsinvoice_details_withpo($supplier_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve details of drug supplier invoices
     *
     * This method 
     *
	 * @param   string  $package_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drugsinvoice_details_nopo($supplier_invoice_id, $supplier_inv_drug_adhoc_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT iadh.*, dprd.*";
        $sqlQuery   .=  " FROM supplier_inv_drug_adhoc iadh";
        //$sqlQuery   .=  " JOIN supplier_inv_drug_adhoc iadh ON sidr.supplier_invoice_id=iadh.supplier_invoice_id";
        $sqlQuery   .=  " JOIN drug_product dprd ON iadh.product_id=dprd.product_id";
        $sqlQuery   .=  " WHERE iadh.supplier_invoice_id = '".$supplier_invoice_id."'";
		if(isset($supplier_inv_drug_adhoc_id)){
			$sqlQuery   .=  " AND iadh.supplier_inv_drug_adhoc_id = '".$supplier_inv_drug_adhoc_id."'";
		}
        $sqlQuery   .=  " ORDER BY supplier_inv_drug_adhoc_id";
        echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_drugsinvoice_details_nopo($supplier_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of drug packages
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drug_package_list($drug_package_id=NULL, $location_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT dpac.*, clin.clinic_shortname";
        $sqlQuery   .=  " FROM drug_package dpac";
        $sqlQuery   .=  " , clinic_info clin";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND dpac.location_id=clin.clinic_info_id";
        if(isset($drug_package_id)){
            $sqlQuery   .=  " AND dpac.drug_package_id='".$drug_package_id."'";
        }
        if(isset($location_id)){
            $sqlQuery   .=  " AND dpac.location_id='".$location_id."'";
        }
        $sqlQuery   .=  " ORDER BY package_sort";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_drug_package_list($drug_product_id)



    //************************************************************************
    /**
     * Method to retrieve list of drug packages
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drug_package_contents($drug_package_id, $content_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT dpac.*, cont.*,";
        $sqlQuery   .=  " dfor.generic_name, dfor.formulary_system";
        $sqlQuery   .=  " FROM drug_package dpac";
        $sqlQuery   .=  " , drug_package_content cont";
        $sqlQuery   .=  " , drug_formulary dfor";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND dpac.drug_package_id='".$drug_package_id."'";
        $sqlQuery   .=  " AND dpac.drug_package_id=cont.drug_package_id";
        $sqlQuery   .=  " AND cont.drug_formulary_id=dfor.drug_formulary_id";
        if(isset($content_id)){
            $sqlQuery   .=  " AND cont.content_id='".$content_id."'";
        }
        $sqlQuery   .=  " ORDER BY atc_code";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_drug_package_contents($content_id=NULL)




}

/* End of file mpharma_rdb.php */
/* Location: ./app_thirra/models/mpharma_rdb.php */
