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
 * @version 0.9.15
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MOrders_imaging_rdb extends CI_Model
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
     * Method to retrieve array of pending imaging orders (for a clinic).
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $location_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_imaging_result($order_id)
    {
        $dataset = array();
        if(isset($location_id)){
            $this->_location_id =   $location_id;
        } else {
            $this->_location_id =   NULL;
        }
        $sqlQuery   =   "SELECT iord.*,";
        $sqlQuery   .=  " ires.result_id,ires.result_date,ires.notes,ires.image_path,ires.staff_id AS result_staff,";
        $sqlQuery   .=  " ires.result_remarks,ires.result_reviewed_by,ires.result_reviewed_date,ires.result_ref,ires.recorded_timestamp,";
        $sqlQuery   .=  " imaging_product.product_code, imaging_product.description,";
        $sqlQuery   .=  " imaging_supplier.supplier_id, imaging_supplier.supplier_name,";
        $sqlQuery   .=  " patient_demographic_info.name, patient_demographic_info.name_first, patient_demographic_info.birth_date,";
        $sqlQuery   .=  " patient_consultation_summary.date_ended";
        $sqlQuery   .=  " FROM imaging_order iord";
        $sqlQuery   .=  " LEFT OUTER JOIN imaging_result ires ON iord.order_id=ires.order_id";
        $sqlQuery   .=  " JOIN imaging_product ON iord.product_id=imaging_product.product_id";
        $sqlQuery   .=  " JOIN imaging_supplier ON imaging_product.supplier_id=imaging_supplier.supplier_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON iord.patient_id=patient_demographic_info.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON iord.session_id=patient_consultation_summary.summary_id";
        $sqlQuery   .=  " WHERE iord.order_id='".$order_id."'";
        //$sqlQuery   .=  " ORDER BY imaging_order.sample_date";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_one_imaging_result($order_id)

 
    //************************************************************************
    /**
     * Method to retrieve list of diagnosis chapters
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_imaging_categories()
    {
        $data = array();
        $sqlQuery   =   "SELECT DISTINCT loinc.class_name, loinc_class.class_group";
        $sqlQuery   .=  " FROM imaging_product";
        $sqlQuery   .=  " JOIN loinc ON imaging_product.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " JOIN loinc_class ON loinc.class_name=loinc_class.class_name";
        $sqlQuery   .=  " ORDER BY class_name";
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
    } //end of function get_imaging_categories()


    //************************************************************************
    /**
     * Method to retrieve list of imaging products
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_imaging_product_by_category($category, $location_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM imaging_product";
        $sqlQuery   .=  " JOIN loinc ON imaging_product.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " JOIN loinc_class ON loinc.class_name=loinc_class.class_name";
        $sqlQuery   .=  " WHERE loinc.class_name = '$category'";
        if(isset($location_id)){
            $sqlQuery   .=  " AND imaging_product.location_id = '$location_id'";
        }
        $sqlQuery   .=  " ORDER BY component";
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
    } //end of function get_imaging_product_by_category($category)


    //************************************************************************
    /**
     * Method to retrieve list of imaging supplier 
     *
     * This method 
     *
	 * @param   string  $product_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_supplier_by_product($product_id=NULL)
    {
        $data = array();
        if(empty($dcode1)) {
            $dcode1 = "NULL";
        }
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM imaging_product";
        $sqlQuery   .=  " JOIN imaging_supplier ON imaging_product.supplier_id=imaging_supplier.supplier_id";
        $sqlQuery   .=  " WHERE imaging_product.product_id = '$product_id'";
        $sqlQuery   .=  " ORDER BY supplier_name";
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
    } //end of function get_supplier_by_product($product_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve details of one product.
     *
     * 
     *
	 * @param   string  $order_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_imaging_product($order_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT imaging_order.*,";
        $sqlQuery   .=  " imaging_product.product_code, imaging_product.supplier_id,";
        $sqlQuery   .=  " ires.result_date, ires.notes, ires.result_remarks, ires.result_reviewed_by, ires.result_reviewed_date, ires.result_ref, ires.recorded_timestamp,";
        $sqlQuery   .=  " loinc.class_name";
        $sqlQuery   .=  " FROM imaging_order";
        $sqlQuery   .=  " JOIN imaging_product ON imaging_order.product_id=imaging_product.product_id";
        $sqlQuery   .=  " LEFT OUTER JOIN imaging_result ires ON imaging_order.order_id=ires.order_id";
        $sqlQuery   .=  " JOIN loinc ON imaging_product.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " WHERE imaging_order.order_id='".$order_id."'";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        } else {
            $data['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_one_imaging_product($order_id)

 
    //************************************************************************
    /**
     * Method to retrieve array of pending imaging orders (for a clinic).
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $location_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function getsimple_one_imaging_result($order_id)
    {
        $dataset = array();
        if(isset($location_id)){
            $this->_location_id =   $location_id;
        } else {
            $this->_location_id =   NULL;
        }
        $sqlQuery   =   "SELECT iord.*,";
        $sqlQuery   .=  " ires.result_id,ires.result_date,ires.notes,ires.image_path,ires.staff_id AS result_staff,";
        $sqlQuery   .=  " imaging_product.product_code, imaging_product.description,";
        $sqlQuery   .=  " imaging_supplier.supplier_id, imaging_supplier.supplier_name,";
        $sqlQuery   .=  " patient_demographic_info.name, patient_demographic_info.name_first, patient_demographic_info.birth_date,";
        $sqlQuery   .=  " patient_consultation_summary.date_ended";
        $sqlQuery   .=  " FROM imaging_order iord";
        $sqlQuery   .=  " JOIN imaging_result ires ON iord.order_id=ires.order_id";
        $sqlQuery   .=  " JOIN imaging_product ON iord.product_id=imaging_product.product_id";
        $sqlQuery   .=  " JOIN imaging_supplier ON imaging_product.supplier_id=imaging_supplier.supplier_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON iord.patient_id=patient_demographic_info.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON iord.session_id=patient_consultation_summary.summary_id";
        $sqlQuery   .=  " WHERE iord.order_id='".$order_id."'";
        //$sqlQuery   .=  " ORDER BY imaging_order.sample_date";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        reset($query);
        }
        return $dataset; 
    } //end of function getsimple_one_imaging_result($order_id)

 


}

/* End of file MOrders_imaging_rdb.php */
/* Location: ./app_thirra/models/MOrders_imaging_rdb.php */
