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
 * Model Class for Orders
 *
 * This class is for models that only writes to the database.
 *
 * @version 0.9.8
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MOrders_wdb extends CI_Model
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
     * Method to insert New Imaging Result  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_imaging_result($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting imaging order";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
		// Insert into imaging_result
		$this->db->set('notes', $data_array['imaging_result']);
		if(isset($data_array['result_id'])){$this->db->set('result_id', $data_array['result_id']);}
		if(isset($data_array['order_id'])){$this->db->set('order_id', $data_array['order_id']);}
		if(isset($data_array['result_date'])){$this->db->set('result_date', $data_array['result_date']);}
		if(isset($data_array['image_path'])){$this->db->set('image_path', $data_array['image_path']);}
		if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['imaging_enhanced_id'])){$this->db->set('imaging_enhanced_id', $data_array['imaging_enhanced_id']);}
        if(isset($data_array['result_remarks'])){$this->db->set('result_remarks', $data_array['result_remarks']);}
        if(isset($data_array['result_reviewed_by'])){$this->db->set('result_reviewed_by', $data_array['result_reviewed_by']);}
        if(isset($data_array['result_reviewed_date'])){$this->db->set('result_reviewed_date', $data_array['result_reviewed_date']);}
        if(isset($data_array['result_ref'])){$this->db->set('result_ref', $data_array['result_ref']);}
        if(isset($data_array['recorded_timestamp'])){$this->db->set('recorded_timestamp', $data_array['recorded_timestamp']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('imaging_result');
        //echo $this->db->last_query();
        //echo "<br />Inserted into imaging_result";
		
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_imaging_result($data_array)


    //************************************************************************
    /**
     * Method to insert New Lab Supplier
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_labsupplier($data_array)
    {
        // Insert into customer_info
        if(isset($data_array['supplier_id'])){$this->db->set('info_id', $data_array['supplier_id']);}
        if(isset($data_array['customer_id'])){$this->db->set('customer_id', $data_array['customer_id']);}
        if(isset($data_array['customer_name'])){$this->db->set('customer_name', $data_array['customer_name']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('customer_info');
        //echo $this->db->last_query();
        //echo "<br />Inserted into customer_info";
		
        // Insert into lab_supplier
        if(isset($data_array['supplier_id'])){$this->db->set('supplier_id', $data_array['supplier_id']);}
        if(isset($data_array['supplier_name'])){$this->db->set('supplier_name', $data_array['supplier_name']);}
        if(isset($data_array['registration_no'])){$this->db->set('registration_no', $data_array['registration_no']);}
        if(isset($data_array['contact_id'])){$this->db->set('contact_id', $data_array['contact_id']);}
        if(isset($data_array['customer_info_id'])){$this->db->set('customer_info_id', $data_array['customer_info_id']);}
        if(isset($data_array['acc_no'])){$this->db->set('acc_no', $data_array['acc_no']);}
        if(isset($data_array['account_id'])){$this->db->set('account_id', $data_array['account_id']);}
        if(isset($data_array['credit_term'])){$this->db->set('credit_term', $data_array['credit_term']);}
        if(isset($data_array['supplier_remarks'])){$this->db->set('supplier_remarks', $data_array['supplier_remarks']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('lab_supplier');
        //echo $this->db->last_query();
        //echo "<br />Inserted into lab_supplier";
		
        // Insert into supplier_contact_info
        if(isset($data_array['contact_id'])){$this->db->set('contact_id', $data_array['contact_id']);}
        if(isset($data_array['address'])){$this->db->set('address', $data_array['address']);}
        if(isset($data_array['address2'])){$this->db->set('address2', $data_array['address2']);}
        if(isset($data_array['address3'])){$this->db->set('address3', $data_array['address3']);}
        if(isset($data_array['town'])){$this->db->set('town', $data_array['town']);}
        if(isset($data_array['state'])){$this->db->set('state', $data_array['state']);}
        if(isset($data_array['postcode'])){$this->db->set('postcode', $data_array['postcode']);}
        if(isset($data_array['country'])){$this->db->set('country', $data_array['country']);}
        if(isset($data_array['tel_no'])){$this->db->set('tel_no', $data_array['tel_no']);}
        if(isset($data_array['tel2_no'])){$this->db->set('tel2_no', $data_array['tel2_no']);}
        if(isset($data_array['tel3_no'])){$this->db->set('tel3_no', $data_array['tel3_no']);}
        if(isset($data_array['fax_no'])){$this->db->set('fax_no', $data_array['fax_no']);}
        if(isset($data_array['fax2_no'])){$this->db->set('fax2_no', $data_array['fax2_no']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        if(isset($data_array['contact_person'])){$this->db->set('contact_person', $data_array['contact_person']);}
        if(isset($data_array['contact_other'])){$this->db->set('contact_other', $data_array['contact_other']);}
        if(isset($data_array['website'])){$this->db->set('website', $data_array['website']);}
        if(isset($data_array['contact_remarks'])){$this->db->set('contact_remarks', $data_array['contact_remarks']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('supplier_contact_info');
        //echo $this->db->last_query();
        //echo "<br />Inserted into supplier_contact_info";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_labsupplier($data_array)


    //************************************************************************
    /**
     * Method to insert New Lab Package
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_lab_package($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting lab_package";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into lab_package
        if(isset($data_array['lab_package_id'])){$this->db->set('lab_package_id', $data_array['lab_package_id']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['lab_classification_id'])){$this->db->set('lab_classification_id', $data_array['lab_classification_id']);}
        if(isset($data_array['loinc_class_id'])){$this->db->set('loinc_class_id', $data_array['loinc_class_id']);}
        if(isset($data_array['supplier_id'])){$this->db->set('supplier_id', $data_array['supplier_id']);}
        if(isset($data_array['package_code'])){$this->db->set('package_code', $data_array['package_code']);}
        if(isset($data_array['sample_required'])){$this->db->set('sample_required', $data_array['sample_required']);}
        if(isset($data_array['package_name'])){$this->db->set('package_name', $data_array['package_name']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['package_active'])){$this->db->set('package_active', $data_array['package_active']);}
        if(isset($data_array['lab_filter_sex'])){$this->db->set('lab_filter_sex', $data_array['lab_filter_sex']);}
        if(isset($data_array['lab_filter_youngerthan'])){$this->db->set('lab_filter_youngerthan', $data_array['lab_filter_youngerthan']);}
        if(isset($data_array['lab_filter_olderthan'])){$this->db->set('lab_filter_olderthan', $data_array['lab_filter_olderthan']);}
        if(isset($data_array['supplier_cost'])){$this->db->set('supplier_cost', $data_array['supplier_cost']);}
        if(isset($data_array['retail_price_1'])){$this->db->set('retail_price_1', $data_array['retail_price_1']);}
        if(isset($data_array['retail_price_2'])){$this->db->set('retail_price_2', $data_array['retail_price_2']);}
        if(isset($data_array['retail_price_3'])){$this->db->set('retail_price_3', $data_array['retail_price_3']);}
        if(isset($data_array['package_remarks'])){$this->db->set('package_remarks', $data_array['package_remarks']);}
        if(isset($data_array['patch_remarks'])){$this->db->set('patch_remarks', $data_array['patch_remarks']);}
        if(isset($data_array['patch_version'])){$this->db->set('patch_version', $data_array['patch_version']);}
        if(isset($data_array['patch_date'])){$this->db->set('patch_date', $data_array['patch_date']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('lab_package');
        //echo $this->db->last_query();
        //echo "<br />Inserted into lab_package";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_lab_package($data_array)


    //************************************************************************
    /**
     * Method to insert New Lab Package Test  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_lab_packagetest($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting lab_package_test";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into lab_result
        if(isset($data_array['lab_package_test_id'])){$this->db->set('lab_package_test_id', $data_array['lab_package_test_id']);}
        if(isset($data_array['lab_package_id'])){$this->db->set('lab_package_id', $data_array['lab_package_id']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['sort_test'])){$this->db->set('sort_test', $data_array['sort_test']);}
        if(isset($data_array['test_name'])){$this->db->set('test_name', $data_array['test_name']);}
        if(isset($data_array['test_code'])){$this->db->set('test_code', $data_array['test_code']);}
        if(isset($data_array['loinc_num'])){$this->db->set('loinc_num', $data_array['loinc_num']);}
        if(isset($data_array['sample_required'])){$this->db->set('sample_required', $data_array['sample_required']);}
        if(isset($data_array['normal_adult'])){$this->db->set('normal_adult', $data_array['normal_adult']);}
        if(isset($data_array['normal_child'])){$this->db->set('normal_child', $data_array['normal_child']);}
        if(isset($data_array['normal_infant'])){$this->db->set('normal_infant', $data_array['normal_infant']);}
        if(isset($data_array['test_remarks'])){$this->db->set('test_remarks', $data_array['test_remarks']);}
        //if(isset($data_array['patch_remarks'])){$this->db->set('patch_remarks', $data_array['patch_remarks']);}
        //if(isset($data_array['patch_version'])){$this->db->set('patch_version', $data_array['patch_version']);}
        //if(isset($data_array['patch_date'])){$this->db->set('patch_date', $data_array['patch_date']);}
        //if(isset($data_array['test_minlegal'])){$this->db->set('test_minlegal', $data_array['test_minlegal']);}
        //if(isset($data_array['test_minnormal'])){$this->db->set('test_minnormal', $data_array['test_minnormal']);}
        //if(isset($data_array['test_maxnormal'])){$this->db->set('test_maxnormal', $data_array['test_maxnormal']);}
        //if(isset($data_array['test_maxlegal'])){$this->db->set('test_maxlegal', $data_array['test_maxlegal']);}
        //if(isset($data_array['concept_id'])){$this->db->set('concept_id', $data_array['concept_id']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('lab_package_test');
        //echo $this->db->last_query();
        //echo "<br />Inserted into lab_package_test";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_lab_packagetest($data_array)


    //************************************************************************
    /**
     * Method to insert New Imaging Supplier
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_imagsupplier($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        
        // Insert into customer_info
        if(isset($data_array['supplier_id'])){$this->db->set('info_id', $data_array['supplier_id']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('customer_info');
        //echo $this->db->last_query();
        //echo "<br />Inserted into customer_info";
		
        // Insert into imaging_supplier
        if(isset($data_array['supplier_id'])){$this->db->set('supplier_id', $data_array['supplier_id']);}
        if(isset($data_array['supplier_name'])){$this->db->set('supplier_name', $data_array['supplier_name']);}
        if(isset($data_array['registration_no'])){$this->db->set('registration_no', $data_array['registration_no']);}
        if(isset($data_array['contact_id'])){$this->db->set('contact_id', $data_array['contact_id']);}
        if(isset($data_array['customer_info_id'])){$this->db->set('customer_info_id', $data_array['customer_info_id']);}
        if(isset($data_array['acc_no'])){$this->db->set('acc_no', $data_array['acc_no']);}
        if(isset($data_array['account_id'])){$this->db->set('account_id', $data_array['account_id']);}
        if(isset($data_array['credit_term'])){$this->db->set('credit_term', $data_array['credit_term']);}
        if(isset($data_array['supplier_remarks'])){$this->db->set('supplier_remarks', $data_array['supplier_remarks']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('imaging_supplier');
        //echo $this->db->last_query();
        //echo "<br />Inserted into imaging_supplier";
		
        // Insert into supplier_contact_info
        if(isset($data_array['contact_id'])){$this->db->set('contact_id', $data_array['contact_id']);}
        if(isset($data_array['address'])){$this->db->set('address', $data_array['address']);}
        if(isset($data_array['address2'])){$this->db->set('address2', $data_array['address2']);}
        if(isset($data_array['address3'])){$this->db->set('address3', $data_array['address3']);}
        if(isset($data_array['town'])){$this->db->set('town', $data_array['town']);}
        if(isset($data_array['state'])){$this->db->set('state', $data_array['state']);}
        if(isset($data_array['postcode'])){$this->db->set('postcode', $data_array['postcode']);}
        if(isset($data_array['country'])){$this->db->set('country', $data_array['country']);}
        if(isset($data_array['tel_no'])){$this->db->set('tel_no', $data_array['tel_no']);}
        if(isset($data_array['tel2_no'])){$this->db->set('tel2_no', $data_array['tel2_no']);}
        if(isset($data_array['tel3_no'])){$this->db->set('tel3_no', $data_array['tel3_no']);}
        if(isset($data_array['fax_no'])){$this->db->set('fax_no', $data_array['fax_no']);}
        if(isset($data_array['fax2_no'])){$this->db->set('fax2_no', $data_array['fax2_no']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        if(isset($data_array['contact_person'])){$this->db->set('contact_person', $data_array['contact_person']);}
        if(isset($data_array['contact_other'])){$this->db->set('contact_other', $data_array['contact_other']);}
        if(isset($data_array['website'])){$this->db->set('website', $data_array['website']);}
        if(isset($data_array['contact_remarks'])){$this->db->set('contact_remarks', $data_array['contact_remarks']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('supplier_contact_info');
        //echo $this->db->last_query();
        //echo "<br />Inserted into supplier_contact_info";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_imagsupplier($data_array)


    //************************************************************************
    /**
     * Method to insert New imaging_product
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_imag_product($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting imaging_product";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
            price numeric(10,2),
        */
        // Insert into imaging_product
        if(isset($data_array['product_id'])){$this->db->set('product_id', $data_array['product_id']);}
        if(isset($data_array['loinc_num'])){$this->db->set('loinc_num', $data_array['loinc_num']);}
        if(isset($data_array['supplier_id'])){$this->db->set('supplier_id', $data_array['supplier_id']);}
        if(isset($data_array['product_code'])){$this->db->set('product_code', $data_array['product_code']);}
        if(isset($data_array['supplier_cost'])){$this->db->set('supplier_cost', $data_array['supplier_cost']);}
        if(isset($data_array['retail_price'])){$this->db->set('retail_price', $data_array['retail_price']);}
        if(isset($data_array['retail_price_2'])){$this->db->set('retail_price_2', $data_array['retail_price_2']);}
        if(isset($data_array['retail_price_3'])){$this->db->set('retail_price_3', $data_array['retail_price_3']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['imaging_enhanced_id'])){$this->db->set('imaging_enhanced_id', $data_array['imaging_enhanced_id']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('imaging_product');
        //echo $this->db->last_query();
        //echo "<br />Inserted into room";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_imag_product($data_array)


    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update current lab order
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_lab_order($data_array)
    {
        /*
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
  invoice_status character varying(20),
  invoice_detail_id character varying(10), -- Added on Nov 5, 07
        */
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['lab_package_id'])){$this->db->set('lab_package_id', $data_array['lab_package_id']);}
        //if(isset($data_array['product_id'])){$this->db->set('product_id', $data_array['product_id']);}
        if(isset($data_array['sample_ref'])){$this->db->set('sample_ref', $data_array['sample_ref']);}
        if(isset($data_array['sample_date'])){$this->db->set('sample_date', $data_array['sample_date']);}
        if(isset($data_array['sample_time'])){$this->db->set('sample_time', $data_array['sample_time']);}
        if(isset($data_array['fasting'])){$this->db->set('fasting', $data_array['fasting']);}
        if(isset($data_array['urgency'])){$this->db->set('urgency', $data_array['urgency']);}
        if(isset($data_array['summary_result'])){$this->db->set('summary_result', $data_array['summary_result']);}
        if(isset($data_array['result_status'])){$this->db->set('result_status', (string)$data_array['result_status']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['result_reviewed_by'])){$this->db->set('result_reviewed_by', $data_array['result_reviewed_by']);}
        if(isset($data_array['result_reviewed_date'])){$this->db->set('result_reviewed_date', $data_array['result_reviewed_date']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
        if(isset($data_array['result_date'])){$this->db->set('result_date', $data_array['result_date']);}
        if(isset($data_array['result_ref'])){$this->db->set('result_ref', $data_array['result_ref']);}
        if(isset($data_array['recorded_timestamp'])){$this->db->set('recorded_timestamp', $data_array['recorded_timestamp']);}
        $this->db->where('lab_order_id', (string)$data_array['lab_order_id']);
        $this->db->update('lab_order');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_lab_order($data_array)


    //************************************************************************
    /**
     * Method to update current lab result
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_lab_result($data_array)
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
        if(isset($data_array['result_ref'])){$this->db->set('result_ref', $data_array['result_ref']);}
        if(isset($data_array['recorded_timestamp'])){$this->db->set('recorded_timestamp', $data_array['recorded_timestamp']);}
        $this->db->where('lab_result_id', (string)$data_array['lab_result_id']);
        $this->db->update('lab_result');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_lab_result($data_array)


    //************************************************************************
    /**
     * Method to update current imaging_order
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_imaging_order($data_array)
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
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['product_id'])){$this->db->set('product_id', $data_array['product_id']);}
        if(isset($data_array['supplier_ref'])){$this->db->set('supplier_ref', $data_array['supplier_ref']);}
        if(isset($data_array['result_status'])){$this->db->set('result_status', (string)$data_array['result_status']);}
        if(isset($data_array['invoice_status'])){$this->db->set('invoice_status', $data_array['invoice_status']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['invoice_detail_id'])){$this->db->set('invoice_detail_id', $data_array['invoice_detail_id']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        $this->db->where('order_id', (string)$data_array['order_id']);
        $this->db->update('imaging_order');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_imaging_order($data_array)


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
    function update_imaging_result($data_array)
    {
        /*
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['result_date'])){$this->db->set('result_date', $data_array['result_date']);}
        if(isset($data_array['notes'])){$this->db->set('notes', $data_array['notes']);}
        if(isset($data_array['image_path'])){$this->db->set('image_path', $data_array['image_path']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['imaging_enhanced_id'])){$this->db->set('imaging_enhanced_id', $data_array['imaging_enhanced_id']);}
        if(isset($data_array['result_remarks'])){$this->db->set('result_remarks', $data_array['result_remarks']);}
        if(isset($data_array['result_reviewed_by'])){$this->db->set('result_reviewed_by', $data_array['result_reviewed_by']);}
        if(isset($data_array['result_reviewed_date'])){$this->db->set('result_reviewed_date', $data_array['result_reviewed_date']);}
        if(isset($data_array['result_ref'])){$this->db->set('result_ref', $data_array['result_ref']);}
        if(isset($data_array['recorded_timestamp'])){$this->db->set('recorded_timestamp', $data_array['recorded_timestamp']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        $this->db->where('result_id', $data_array['result_id']);
        $this->db->update('imaging_result');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_imaging_result($data_array)


    //************************************************************************
    /**
     * Method to update current lab package
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_lab_supplier($data_array)
    {
        /*
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['supplier_name'])){$this->db->set('supplier_name', $data_array['supplier_name']);}
        if(isset($data_array['registration_no'])){$this->db->set('registration_no', $data_array['registration_no']);}
        if(isset($data_array['contact_id'])){$this->db->set('contact_id', $data_array['contact_id']);}
        if(isset($data_array['customer_info_id'])){$this->db->set('customer_info_id', $data_array['customer_info_id']);}
        if(isset($data_array['acc_no'])){$this->db->set('acc_no', $data_array['acc_no']);}
        if(isset($data_array['account_id'])){$this->db->set('account_id', $data_array['account_id']);}
        if(isset($data_array['credit_term'])){$this->db->set('credit_term', $data_array['credit_term']);}
        if(isset($data_array['supplier_remarks'])){$this->db->set('supplier_remarks', $data_array['supplier_remarks']);}
        $this->db->where('supplier_id', (string)$data_array['supplier_id']);
        $this->db->update('lab_supplier');
        //echo $this->db->last_query();
        
        if(isset($data_array['address'])){$this->db->set('address', $data_array['address']);}
        if(isset($data_array['address2'])){$this->db->set('address2', $data_array['address2']);}
        if(isset($data_array['address3'])){$this->db->set('address3', $data_array['address3']);}
        if(isset($data_array['town'])){$this->db->set('town', $data_array['town']);}
        if(isset($data_array['state'])){$this->db->set('state', $data_array['state']);}
        if(isset($data_array['postcode'])){$this->db->set('postcode', $data_array['postcode']);}
        if(isset($data_array['country'])){$this->db->set('country', $data_array['country']);}
        if(isset($data_array['tel_no'])){$this->db->set('tel_no', $data_array['tel_no']);}
        if(isset($data_array['tel2_no'])){$this->db->set('tel2_no', $data_array['tel2_no']);}
        if(isset($data_array['tel3_no'])){$this->db->set('tel3_no', $data_array['tel3_no']);}
        if(isset($data_array['fax_no'])){$this->db->set('fax_no', $data_array['fax_no']);}
        if(isset($data_array['fax2_no'])){$this->db->set('fax2_no', $data_array['fax2_no']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        if(isset($data_array['contact_person'])){$this->db->set('contact_person', $data_array['contact_person']);}
        if(isset($data_array['contact_other'])){$this->db->set('contact_other', $data_array['contact_other']);}
        if(isset($data_array['website'])){$this->db->set('website', $data_array['website']);}
        if(isset($data_array['contact_remarks'])){$this->db->set('contact_remarks', $data_array['contact_remarks']);}
        $this->db->where('contact_id', (string)$data_array['contact_id']);
        $this->db->update('supplier_contact_info');
        //echo $this->db->last_query();
        
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_lab_supplier($data_array)


    //************************************************************************
    /**
     * Method to update current lab package
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_lab_package($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
  supplier_id character(10) NOT NULL,
        */
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['lab_classification_id'])){$this->db->set('lab_classification_id', $data_array['lab_classification_id']);}
        if(isset($data_array['loinc_class_id'])){$this->db->set('loinc_class_id', $data_array['loinc_class_id']);}
        if(isset($data_array['package_code'])){$this->db->set('package_code', $data_array['package_code']);}
        if(isset($data_array['sample_required'])){$this->db->set('sample_required', $data_array['sample_required']);}
        if(isset($data_array['package_name'])){$this->db->set('package_name', $data_array['package_name']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['package_active'])){$this->db->set('package_active', $data_array['package_active']);}
        if(isset($data_array['lab_filter_sex'])){$this->db->set('lab_filter_sex', $data_array['lab_filter_sex']);}
        if(isset($data_array['lab_filter_youngerthan'])){$this->db->set('lab_filter_youngerthan', $data_array['lab_filter_youngerthan']);}
        if(isset($data_array['lab_filter_olderthan'])){$this->db->set('lab_filter_olderthan', $data_array['lab_filter_olderthan']);}
        if(isset($data_array['supplier_cost'])){$this->db->set('supplier_cost', $data_array['supplier_cost']);}
        if(isset($data_array['retail_price_1'])){$this->db->set('retail_price_1', $data_array['retail_price_1']);}
        if(isset($data_array['retail_price_2'])){$this->db->set('retail_price_2', $data_array['retail_price_2']);}
        if(isset($data_array['retail_price_3'])){$this->db->set('retail_price_3', $data_array['retail_price_3']);}
        if(isset($data_array['package_remarks'])){$this->db->set('package_remarks', $data_array['package_remarks']);}
        $this->db->where('lab_package_id', (string)$data_array['lab_package_id']);
        $this->db->update('lab_package');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_lab_package($data_array)


    //************************************************************************
    /**
     * Method to update_lab_packagetest
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_lab_packagetest($data_array)
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
        //if(isset($data_array['lab_package_id'])){$this->db->set('lab_package_id', $data_array['lab_package_id']);}
        //if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['sort_test'])){$this->db->set('sort_test', $data_array['sort_test']);}
        if(isset($data_array['test_name'])){$this->db->set('test_name', $data_array['test_name']);}
        if(isset($data_array['test_code'])){$this->db->set('test_code', $data_array['test_code']);}
        if(isset($data_array['loinc_num'])){$this->db->set('loinc_num', $data_array['loinc_num']);}
        if(isset($data_array['sample_required'])){$this->db->set('sample_required', $data_array['sample_required']);}
        if(isset($data_array['normal_adult'])){$this->db->set('normal_adult', $data_array['normal_adult']);}
        if(isset($data_array['normal_child'])){$this->db->set('normal_child', $data_array['normal_child']);}
        if(isset($data_array['normal_infant'])){$this->db->set('normal_infant', $data_array['normal_infant']);}
        if(isset($data_array['test_remarks'])){$this->db->set('test_remarks', $data_array['test_remarks']);}
        $this->db->where('lab_package_test_id', $data_array['lab_package_test_id']);
        $this->db->update('lab_package_test');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_lab_packagetest($data_array)


    //************************************************************************
    /**
     * Method to update current lab package
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_imaging_supplier($data_array)
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
        if(isset($data_array['supplier_name'])){$this->db->set('supplier_name', $data_array['supplier_name']);}
        if(isset($data_array['registration_no'])){$this->db->set('registration_no', $data_array['registration_no']);}
        if(isset($data_array['contact_id'])){$this->db->set('contact_id', $data_array['contact_id']);}
        if(isset($data_array['customer_info_id'])){$this->db->set('customer_info_id', $data_array['customer_info_id']);}
        if(isset($data_array['acc_no'])){$this->db->set('acc_no', $data_array['acc_no']);}
        if(isset($data_array['account_id'])){$this->db->set('account_id', $data_array['account_id']);}
        if(isset($data_array['credit_term'])){$this->db->set('credit_term', $data_array['credit_term']);}
        if(isset($data_array['supplier_remarks'])){$this->db->set('supplier_remarks', $data_array['supplier_remarks']);}
        $this->db->where('supplier_id', (string)$data_array['supplier_id']);
        $this->db->update('imaging_supplier');
        //echo $this->db->last_query();
        
        if(isset($data_array['address'])){$this->db->set('address', $data_array['address']);}
        if(isset($data_array['address2'])){$this->db->set('address2', $data_array['address2']);}
        if(isset($data_array['address3'])){$this->db->set('address3', $data_array['address3']);}
        if(isset($data_array['town'])){$this->db->set('town', $data_array['town']);}
        if(isset($data_array['state'])){$this->db->set('state', $data_array['state']);}
        if(isset($data_array['postcode'])){$this->db->set('postcode', $data_array['postcode']);}
        if(isset($data_array['country'])){$this->db->set('country', $data_array['country']);}
        if(isset($data_array['tel_no'])){$this->db->set('tel_no', $data_array['tel_no']);}
        if(isset($data_array['tel2_no'])){$this->db->set('tel2_no', $data_array['tel2_no']);}
        if(isset($data_array['tel3_no'])){$this->db->set('tel3_no', $data_array['tel3_no']);}
        if(isset($data_array['fax_no'])){$this->db->set('fax_no', $data_array['fax_no']);}
        if(isset($data_array['fax2_no'])){$this->db->set('fax2_no', $data_array['fax2_no']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        if(isset($data_array['contact_person'])){$this->db->set('contact_person', $data_array['contact_person']);}
        if(isset($data_array['contact_other'])){$this->db->set('contact_other', $data_array['contact_other']);}
        if(isset($data_array['website'])){$this->db->set('website', $data_array['website']);}
        if(isset($data_array['contact_remarks'])){$this->db->set('contact_remarks', $data_array['contact_remarks']);}
        $this->db->where('contact_id', (string)$data_array['contact_id']);
        $this->db->update('supplier_contact_info');
        //echo $this->db->last_query();
        
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_imaging_supplier($data_array)


    //************************************************************************
    /**
     * Method to update_imag_product
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_imag_product($data_array)
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
        if(isset($data_array['loinc_num'])){$this->db->set('loinc_num', $data_array['loinc_num']);}
        //if(isset($data_array['supplier_id'])){$this->db->set('supplier_id', $data_array['supplier_id']);}
        if(isset($data_array['product_code'])){$this->db->set('product_code', $data_array['product_code']);}
        if(isset($data_array['supplier_cost'])){$this->db->set('supplier_cost', $data_array['supplier_cost']);}
        if(isset($data_array['retail_price'])){$this->db->set('retail_price', $data_array['retail_price']);}
        if(isset($data_array['retail_price_2'])){$this->db->set('retail_price_2', $data_array['retail_price_2']);}
        if(isset($data_array['retail_price_3'])){$this->db->set('retail_price_3', $data_array['retail_price_3']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['imaging_enhanced_id'])){$this->db->set('imaging_enhanced_id', $data_array['imaging_enhanced_id']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        $this->db->where('product_id', $data_array['product_id']);
        $this->db->update('imaging_product');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_imag_product($data_array)


    //===============================================================
    // Delete Database Records Methods

}
/* End of file MOrders_wdb.php */
/* Location: ./app_thirra/models/MOrders_wdb.php */
