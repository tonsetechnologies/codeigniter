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
 * Portions created by the Initial Developer are Copyright (C) 2010 - 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for MOrders_rdb
 *
 * This class is for models that only reads from the database.
 *
 * @version 0.9.12
 * @package THIRRA - MQueue_rdb
 * @author  Jason Tan Boon Teck
 */

class MOrders_rdb extends CI_Model
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
     * Method to retrieve array of pending lab orders (for a clinic).
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $location_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_list_labresult($result_status,$expect='data',$sort_order="sample_date",$per_page="ALL",$row_first=0,$location_id=NULL)
    {
        $dataset = array();
        if(isset($location_id)){
            $this->_location_id =   $location_id;
        } else {
            $this->_location_id =   NULL;
        }
        $sqlQuery   =   "SELECT lab_order.*,";
        $sqlQuery   .=  " lab_package.package_code, lab_package.package_name,
                            lab_package.description, lab_package.package_cost_std,";
        $sqlQuery   .=  " lab_supplier.supplier_id, lab_supplier.supplier_name,";
        $sqlQuery   .=  " pdem.name, pdem.name_first, pdem.birth_date";
        $sqlQuery   .=  " FROM lab_order";
        $sqlQuery   .=  " JOIN lab_package ON lab_order.lab_package_id=lab_package.lab_package_id";
        $sqlQuery   .=  " JOIN lab_supplier ON lab_package.supplier_id=lab_supplier.supplier_id";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON lab_order.patient_id=pdem.patient_id";
        $sqlQuery   .=  " WHERE result_status='".$result_status."'";
        if(isset($location_id)){
            $sqlQuery   .=  " AND lab_package.location_id='".$this->_location_id."'";
        }
        $sqlQuery   .=  " ORDER BY ".$sort_order.",lab_order.sample_date";
        $sqlQuery   .=  " LIMIT ".$per_page." OFFSET ".$row_first;
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        $num_rows = $query->num_rows(); 
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[] = $row;
            }
        reset($query);
        }
        if($expect == 'data'){
            return $dataset; 
        } else {
            return $num_rows;
        }
    } //end of function get_list_labresult($result_status,$location_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve no. of orders for one lab package. 
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_lab_package_ordered($package_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT lab_package.*,";
        $sqlQuery   .=  " lord.lab_order_id, lord.patient_id, lord.session_id, lord.sample_ref, lord.sample_date, lord.sample_time, lord.summary_result, lord.result_status, lord.remarks, lord.result_reviewed_date";
        $sqlQuery   .=  " FROM lab_package";
        //$sqlQuery   .=  " LEFT OUTER JOIN lab_package_test ltes ON lab_package.lab_package_id=ltes.lab_package_id";
        $sqlQuery   .=  " JOIN lab_order lord ON lab_package.lab_package_id=lord.lab_package_id";
        //$sqlQuery   .=  " LEFT OUTER JOIN loinc_class lcls ON lab_package.loinc_class_id=lcls.loinc_class_id";
        $sqlQuery   .=  " WHERE lab_package.lab_package_id='".$package_id."'";
        $sqlQuery   .=  " ORDER BY lord.sample_date";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        //} else {
        //    $data[0]['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_lab_package_ordered($package_id)

 
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
    function get_list_imaging_result($result_status,$location_id=NULL)
    {
        $dataset = array();
        if(isset($location_id)){
            $this->_location_id =   $location_id;
        } else {
            $this->_location_id =   NULL;
        }
        $sqlQuery   =   "SELECT imaging_order.*,";
        $sqlQuery   .=  " imaging_product.product_code, imaging_product.description,";
        $sqlQuery   .=  " imaging_supplier.supplier_id, imaging_supplier.supplier_name,";
        $sqlQuery   .=  " patient_demographic_info.name, patient_demographic_info.name_first, patient_demographic_info.birth_date,";
        $sqlQuery   .=  " patient_consultation_summary.date_ended";
        $sqlQuery   .=  " FROM imaging_order";
        $sqlQuery   .=  " LEFT OUTER JOIN imaging_product ON imaging_order.product_id=imaging_product.product_id";
        $sqlQuery   .=  " JOIN imaging_supplier ON imaging_product.supplier_id=imaging_supplier.supplier_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON imaging_order.patient_id=patient_demographic_info.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON imaging_order.session_id=patient_consultation_summary.summary_id";
        $sqlQuery   .=  " WHERE result_status='".$result_status."'";
        /*
        if(isset($lab_order_id)){
            $sqlQuery   .=  " AND patient_complaint.diagnosis_id='".$this->_lab_order_id."'";
        }
        */
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
    } //end of function get_list_imaging_result($result_status,$location_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve no. of orders for one imaging package. 
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_imag_product_ordered($product_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT ipro.*,";
        $sqlQuery   .=  " iord.order_id, iord.patient_id, iord.session_id, iord.supplier_ref, iord.result_status, iord.remarks";
        $sqlQuery   .=  " FROM imaging_product ipro";
        //$sqlQuery   .=  " LEFT OUTER JOIN lab_package_test ltes ON lab_package.lab_package_id=ltes.lab_package_id";
        $sqlQuery   .=  " JOIN imaging_order iord ON ipro.product_id=iord.product_id";
        $sqlQuery   .=  " WHERE ipro.product_id='".$product_id."'";
        $sqlQuery   .=  " ORDER BY ipro.product_code";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        //} else {
        //    $data[0]['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_imag_product_ordered($product_id)

 
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
    function get_list_procedure_result($result_status,$location_id=NULL)
    {
        $dataset = array();
        if(isset($location_id)){
            $this->_location_id =   $location_id;
        } else {
            $this->_location_id =   NULL;
        }
        $sqlQuery   =   "SELECT pord.*,";
        $sqlQuery   .=  " pprd.product_code, pprd.product_name,";
        $sqlQuery   .=  " psup.supplier_id, psup.supplier_name,";
        $sqlQuery   .=  " pdem.name, pdem.name_first, pdem.birth_date,";
        $sqlQuery   .=  " pcon.date_ended";
        $sqlQuery   .=  " FROM procedure_order pord";
        $sqlQuery   .=  " LEFT OUTER JOIN procedure_product pprd ON pord.product_id=pprd.product_id";
        $sqlQuery   .=  " JOIN procedure_supplier psup ON pprd.supplier_id=psup.supplier_id";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON pord.patient_id=pdem.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary pcon ON pord.session_id=pcon.summary_id";
        $sqlQuery   .=  " WHERE result_status='".$result_status."'";
        /*
        if(isset($lab_order_id)){
            $sqlQuery   .=  " AND patient_complaint.diagnosis_id='".$this->_lab_order_id."'";
        }
        */
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
    } //end of function get_list_imaging_result($result_status,$location_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve list of lab suppliers
     *
     * This method 
     *
	 * @param   string  $package_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_supplier_list_lab($supplier_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT lsup.*,";
        $sqlQuery   .=  " scin.address, scin.address2, scin.address3, scin.postcode, scin.town, scin.state, scin.country,";
        $sqlQuery   .=  " scin.contact_person, scin.tel_no, scin.tel2_no, scin.tel3_no, scin.fax_no, scin.fax2_no, scin.email, scin.contact_other,scin.website, scin.contact_remarks";
        $sqlQuery   .=  " FROM lab_supplier lsup";
        $sqlQuery   .=  " JOIN supplier_contact_info scin ON lsup.contact_id=scin.contact_id";
		if(isset($supplier_id)){
			$sqlQuery   .=  " WHERE lsup.supplier_id = '".$supplier_id."'";
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
    } //end of function get_supplier_list_lab($supplier_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of lab packages by supplier
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_lab_packages_bysupplier($supplier_id,$lab_package_id=NULL,$location_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT lab_package.*,";
        $sqlQuery   .=  " lab_supplier.supplier_name, lab_supplier.acc_no,";
        $sqlQuery   .=  " clinic_shortname, clinic_name,";
        $sqlQuery   .=  " loinc_class.class_name, loinc_class.class_group";
        $sqlQuery   .=  " FROM lab_package";
        $sqlQuery   .=  " JOIN lab_supplier ON lab_package.supplier_id=lab_supplier.supplier_id";
        $sqlQuery   .=  " JOIN clinic_info ON lab_package.location_id=clinic_info.clinic_info_id";
        $sqlQuery   .=  " JOIN loinc_class ON lab_package.loinc_class_id=loinc_class.loinc_class_id";
        $sqlQuery   .=  " WHERE lab_package.supplier_id='".$supplier_id."'";
		if(isset($lab_package_id)){
			$sqlQuery   .=  " AND lab_package.lab_package_id='".$lab_package_id."'";
		}
		if(isset($location_id)){
			$sqlQuery   .=  " AND lab_package.location_id='".$location_id."'";
        }
        $sqlQuery   .=  " ORDER BY package_code";
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
    } //end of function get_lab_packages_bysupplier($supplier_id,$lab_package_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of LOINC classes
     *
     * This method 
     *
	 * @param   string  $chapter      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_loinc_class_lab($class=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT loinc_class_id,class_name,class_group,test_type,description,remarks,class_active";
        $sqlQuery   .=  " FROM loinc_class";
        $sqlQuery   .=  " WHERE test_type = 'Lab'";
        $sqlQuery   .=  " ORDER BY class_group";
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
    } //end of function get_loinc_class_lab($class)


    //************************************************************************
    /**
     * Method to retrieve list of LOINC codes
     *
     * This method 
     *
	 * @param   string  $chapter      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_loinc($loinc_class_name=NULL,$loinc_num=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT loinc_num,system,component";
        $sqlQuery   .=  " FROM loinc";
        $sqlQuery   .=  " WHERE class_name = '".$loinc_class_name."'";
        if(isset($loinc_num)){
            $sqlQuery   .=  " AND loinc_num='".$loinc_num."'";
        }
        $sqlQuery   .=  " ORDER BY component,system,loinc_num";
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
    } //end of function get_loinc($loinc_class_name=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of lab classifications
     *
     * This method 
     *
	 * @param   string  $chapter      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_lab_classification($class_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM lab_classification";
        $sqlQuery   .=  " WHERE lab_class_active = 'TRUE'";
        $sqlQuery   .=  " ORDER BY commonly_used DESC,class_title";
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
    } //end of function get_lab_classification($class_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of imaging suppliers
     *
     * This method 
     *
	 * @param   string  $package_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_supplier_list_imag($supplier_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT isup.*,";
        $sqlQuery   .=  " scin.address, scin.address2, scin.address3, scin.postcode, scin.town, scin.state, scin.country,";
        $sqlQuery   .=  " scin.contact_person, scin.tel_no, scin.tel2_no, scin.tel3_no, scin.fax_no, scin.fax2_no, scin.email, scin.contact_other,scin.website, scin.contact_remarks";
        $sqlQuery   .=  " FROM imaging_supplier isup";
        $sqlQuery   .=  " JOIN supplier_contact_info scin ON isup.contact_id=scin.contact_id";
		if(isset($supplier_id)){
			$sqlQuery   .=  " WHERE isup.supplier_id = '".$supplier_id."'";
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
    } //end of function get_supplier_list_imag($supplier_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of imaging packages by supplier
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_imag_product_bysupplier($supplier_id,$imag_package_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT imaging_product.*,";
        $sqlQuery   .=  " imaging_supplier.supplier_name, imaging_supplier.acc_no,";
        $sqlQuery   .=  " clinic_shortname, clinic_name,";
        $sqlQuery   .=  " loinc.component, loinc.class_name";
        $sqlQuery   .=  " FROM imaging_product";
        $sqlQuery   .=  " JOIN imaging_supplier ON imaging_product.supplier_id=imaging_supplier.supplier_id";
        $sqlQuery   .=  " JOIN loinc ON imaging_product.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " LEFT OUTER JOIN clinic_info ON imaging_product.location_id=clinic_info.clinic_info_id";
        $sqlQuery   .=  " WHERE imaging_product.supplier_id='".$supplier_id."'";
		if(isset($imag_package_id)){
			$sqlQuery   .=  " AND imaging_product.product_id='".$imag_package_id."'";
		}
        $sqlQuery   .=  " ORDER BY product_code";
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
    } //end of function get_imag_product_bysupplier($supplier_id,$imag_package_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of LOINC classes
     *
     * This method 
     *
	 * @param   string  $chapter      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_loinc_class_imag($class=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT loinc_class_id,class_name,class_group,test_type,description,remarks,class_active";
        $sqlQuery   .=  " FROM loinc_class";
        $sqlQuery   .=  " WHERE test_type = 'Imaging'";
        $sqlQuery   .=  " ORDER BY class_group";
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
    } //end of function get_loinc_class_imag($class)



}

/* End of file MOrders_rdb.php */
/* Location: ./app_thirra/models/MOrders_rdb.php */
