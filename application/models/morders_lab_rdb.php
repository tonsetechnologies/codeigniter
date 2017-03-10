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

class MOrders_lab_rdb extends CI_Model
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
     * Method to retrieve list of lab packages
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_lab_packages_list($location_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT lab_package.*,";
        $sqlQuery   .=  " clinic_info,clinic_shortname";
        $sqlQuery   .=  " FROM lab_package";
        $sqlQuery   .=  " JOIN clinic_info ON lab_package.location_id=clinic_info.clinic_info_id";
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
    } //end of function get_lab_packages_list()


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
    function get_supplier_by_labpackage($package_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT lab_supplier.*";
        $sqlQuery   .=  " FROM lab_package";
        $sqlQuery   .=  " JOIN lab_supplier ON lab_package.supplier_id=lab_supplier.supplier_id";
        $sqlQuery   .=  " WHERE lab_package_id = '$package_id'";
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
    } //end of function get_supplier_by_labpackage($package_id)


    //************************************************************************
    /**
     * Method to retrieve details of one lab package.
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_lab_orderresult($order_id, $result_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT lord.*,";
        $sqlQuery   .=  " lres.lab_package_test_id, lres.result, lres.normal_reading, lres.result_remarks,";
		$sqlQuery   .=  " ltes.sort_test, ltes.test_name, ltes.test_code, 
							ltes.loinc_num, ltes.sample_required as test_sample, ltes.normal_adult, 
							ltes.normal_child, ltes.normal_infant, ltes.test_remarks,";
		$sqlQuery   .=  "  lab_package.sample_required";
        $sqlQuery   .=  " FROM lab_result lres";
        $sqlQuery   .=  " JOIN lab_order lord ON lord.lab_order_id=lres.lab_order_id";
        $sqlQuery   .=  " JOIN lab_package_test ltes ON lres.lab_package_test_id=ltes.lab_package_test_id";
		$sqlQuery   .=  " LEFT OUTER JOIN lab_package ON ltes.lab_package_id=lab_package.lab_package_id";
        $sqlQuery   .=  " WHERE lord.lab_order_id='".$order_id."'";

		if(isset($result_id)){
			$sqlQuery   .=  " AND ltes.lab_package_test_id='".$result_id."'";
		}
        $sqlQuery   .=  " ORDER BY ltes.sort_test";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
				$row_num++;
                $data[] = $row;
				$data[($row_num-1)]['test_result_'.$row_num]	=	$row['result'];
				$data[($row_num-1)]['test_normal_'.$row_num]	=	$row['normal_adult'];
				$data[($row_num-1)]['test_remark_'.$row_num]	=	$row['result_remarks'];
            }
        //} else {
        //    $data[0]['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_one_lab_orderresult($order_id, $result_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of one lab package. TO DEPRECATE
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_lab_package($package_id, $test_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT lab_package.*,";
        //$sqlQuery   .=  " ltes.lab_package_test_id, ltes.sort_test, ltes.test_name, ltes.test_code, 
		//					ltes.loinc_num, ltes.sample_required as test_sample, ltes.normal_adult, 
		//					ltes.normal_child, ltes.normal_infant, ltes.test_remarks,";
        $sqlQuery   .=  " lab_supplier.supplier_name,";
        $sqlQuery   .=  " lcls.class_name";
        $sqlQuery   .=  " FROM lab_package";
        //$sqlQuery   .=  " LEFT OUTER JOIN lab_package_test ltes ON lab_package.lab_package_id=ltes.lab_package_id";
        //$sqlQuery   .=  " JOIN lab_package_test ltes ON lab_package.lab_package_id=ltes.lab_package_id";
        $sqlQuery   .=  " JOIN lab_supplier ON lab_package.supplier_id=lab_supplier.supplier_id";
        $sqlQuery   .=  " LEFT OUTER JOIN loinc_class lcls ON lab_package.loinc_class_id=lcls.loinc_class_id";
        $sqlQuery   .=  " WHERE lab_package.lab_package_id='".$package_id."'";
		if(isset($test_id)){
			//$sqlQuery   .=  " AND ltes.lab_package_test_id='".$test_id."'";
		}
        //$sqlQuery   .=  " ORDER BY ltes.sort_test";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
				$row_num++;
                $data[] = $row;
                /*
				$data[($row_num-1)]['test_result_'.$row_num]	=	"";//$row_num;
				$data[($row_num-1)]['test_normal_'.$row_num]	=	$row['normal_adult'];
				$data[($row_num-1)]['test_remark_'.$row_num]	=	"";//$row_num+100;
                */
            }
        //} else {
        //    $data[0]['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_one_lab_package($package_id)

 
    //************************************************************************
    /**
     * Method to retrieve details of one lab package. TO DEPRECATE
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_lab_package_test($package_id, $test_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT lab_package.*,";
        $sqlQuery   .=  " ltes.lab_package_test_id, ltes.sort_test, ltes.test_name, ltes.test_code, 
							ltes.loinc_num, ltes.sample_required as test_sample, ltes.normal_adult, 
							ltes.normal_child, ltes.normal_infant, ltes.test_remarks,";
        $sqlQuery   .=  " lcls.class_name";
        $sqlQuery   .=  " FROM lab_package";
        //$sqlQuery   .=  " LEFT OUTER JOIN lab_package_test ltes ON lab_package.lab_package_id=ltes.lab_package_id";
        $sqlQuery   .=  " JOIN lab_package_test ltes ON lab_package.lab_package_id=ltes.lab_package_id";
        $sqlQuery   .=  " LEFT OUTER JOIN loinc_class lcls ON lab_package.loinc_class_id=lcls.loinc_class_id";
        $sqlQuery   .=  " WHERE lab_package.lab_package_id='".$package_id."'";
		if(isset($test_id)){
			$sqlQuery   .=  " AND ltes.lab_package_test_id='".$test_id."'";
		}
        $sqlQuery   .=  " ORDER BY ltes.sort_test";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
				$row_num++;
                $data[] = $row;
				$data[($row_num-1)]['test_result_'.$row_num]	=	"";//$row_num;
				$data[($row_num-1)]['test_normal_'.$row_num]	=	$row['normal_adult'];
				$data[($row_num-1)]['test_remark_'.$row_num]	=	"";//$row_num+100;
            }
        //} else {
        //    $data[0]['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_one_lab_package_test($package_id)

 
    //************************************************************************
    /**
     * Method to retrieve details of one lab package.
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function getsimple_one_lab_results($order_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT lord.*,";
        $sqlQuery   .=  " lres.result, lres.normal_reading, lres.result_remarks,";
        $sqlQuery   .=  " ltes.lab_package_test_id, ltes.sort_test, ltes.test_name, ltes.test_code, 
							ltes.loinc_num, ltes.sample_required as test_sample, ltes.normal_adult, 
							ltes.normal_child, ltes.normal_infant, ltes.test_remarks";
        $sqlQuery   .=  " FROM lab_order lord";
        $sqlQuery   .=  " JOIN lab_result lres ON lord.lab_order_id=lres.lab_order_id";
        $sqlQuery   .=  " JOIN lab_package_test ltes ON lres.lab_package_test_id=ltes.lab_package_test_id";
        $sqlQuery   .=  " WHERE lord.lab_order_id='".$order_id."'";
        $sqlQuery   .=  " ORDER BY ltes.sort_test";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
				$row_num++;
                $data[] = $row;
				$data[($row_num-1)]['test_result_'.$row_num]	=	$row['result'];
				$data[($row_num-1)]['test_normal_'.$row_num]	=	$row['normal_reading'];
				$data[($row_num-1)]['test_remark_'.$row_num]	=	$row['result_remarks'];
            }
        //} else {
        //    $data[0]['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function getsimple_one_lab_results($order_id)

 


}

/* End of file MOrders_imaging_rdb.php */
/* Location: ./app_thirra/models/MOrders_imaging_rdb.php */
