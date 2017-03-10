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
 * @version 0.9.12
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MPharma_wdb extends CI_Model
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
     * Method to insert New Drug Supplier
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_drugsupplier($data_array)
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
		
        // Insert into drug_supplier
        if(isset($data_array['supplier_id'])){$this->db->set('supplier_id', $data_array['supplier_id']);}
        if(isset($data_array['supplier_name'])){$this->db->set('supplier_name', $data_array['supplier_name']);}
        if(isset($data_array['registration_no'])){$this->db->set('registration_no', $data_array['registration_no']);}
        if(isset($data_array['contact_id'])){$this->db->set('contact_id', $data_array['contact_id']);}
        if(isset($data_array['customer_info_id'])){$this->db->set('customer_info_id', $data_array['customer_info_id']);}
        if(isset($data_array['acc_no'])){$this->db->set('acc_no', $data_array['acc_no']);}
        if(isset($data_array['account_id'])){$this->db->set('account_id', $data_array['account_id']);}
        if(isset($data_array['credit_term'])){$this->db->set('credit_term', $data_array['credit_term']);}
        if(isset($data_array['supplier_remarks'])){$this->db->set('remarks', $data_array['supplier_remarks']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('drug_supplier');
        //echo $this->db->last_query();
        //echo "<br />Inserted into drug_supplier";
		
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
        echo $this->db->_compile_select();
        $this->db->insert('supplier_contact_info');
        //echo $this->db->last_query();
        //echo "<br />Inserted into supplier_contact_info";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_drugsupplier($data_array)


    //************************************************************************
    /**
     * Method to insert New Drug Product
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_drug_product($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        
        // Insert into drug_product
        if(isset($data_array['product_id'])){$this->db->set('product_id', $data_array['product_id']);}
        if(isset($data_array['drug_official_code'])){$this->db->set('drug_official_code', $data_array['drug_official_code']);}
        if(isset($data_array['drug_code_id'])){$this->db->set('drug_code_id', $data_array['drug_code_id']);}
        if(isset($data_array['formulary_id'])){$this->db->set('formulary_id', $data_array['formulary_id']);}
        if(isset($data_array['manufacturer_id'])){$this->db->set('manufacturer_id', $data_array['manufacturer_id']);}
        if(isset($data_array['supplier_id'])){$this->db->set('supplier_id', $data_array['supplier_id']);}
        if(isset($data_array['product_name'])){$this->db->set('product_name', $data_array['product_name']);}
        if(isset($data_array['seller_code'])){$this->db->set('seller_code', $data_array['seller_code']);}
        if(isset($data_array['pbkd_no'])){$this->db->set('pbkd_no', $data_array['pbkd_no']);}
        if(isset($data_array['packing'])){$this->db->set('packing', (int)$data_array['packing']);}
        if(isset($data_array['packing_form'])){$this->db->set('packing_form', $data_array['packing_form']);}
        if(isset($data_array['bulk_packing'])){$this->db->set('bulk_packing', $data_array['bulk_packing']);}
        if(isset($data_array['bulk_form'])){$this->db->set('bulk_form', $data_array['bulk_form']);}
        if(isset($data_array['wholesale_price'])){$this->db->set('wholesale_price', (int)$data_array['wholesale_price']);}
        if(isset($data_array['bonus_base'])){$this->db->set('bonus_base', (int)$data_array['bonus_base']);}
        if(isset($data_array['bonus_extra'])){$this->db->set('bonus_extra', (int)$data_array['bonus_extra']);}
        if(isset($data_array['retail_price'])){$this->db->set('retail_price', (int)$data_array['retail_price']);}
        if(isset($data_array['retail_price_2'])){$this->db->set('retail_price_2', (int)$data_array['retail_price_2']);}
        if(isset($data_array['retail_price_3'])){$this->db->set('retail_price_3', (int)$data_array['retail_price_3']);}
        if(isset($data_array['ucost_std'])){$this->db->set('ucost_std', (int)$data_array['ucost_std']);}
        if(isset($data_array['ucost_fifo'])){$this->db->set('ucost_fifo', (int)$data_array['ucost_fifo']);}
        if(isset($data_array['ucost_wac'])){$this->db->set('ucost_wac', (int)$data_array['ucost_wac']);}
        if(isset($data_array['quantity'])){$this->db->set('quantity', (int)$data_array['quantity']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', (int)$data_array['commonly_used']);}
        if(isset($data_array['reorder_level'])){$this->db->set('reorder_level', (int)$data_array['reorder_level']);}
        if(isset($data_array['reorder_qty'])){$this->db->set('reorder_qty', (int)$data_array['reorder_qty']);}
        if(isset($data_array['eoq'])){$this->db->set('eoq', (int)$data_array['eoq']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['drug_type'])){$this->db->set('drug_type', $data_array['drug_type']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('drug_product');
        //echo $this->db->last_query();
        //echo "<br />Inserted into drug_product";
		
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_drug_product($data_array)


    //************************************************************************
    /**
     * Method to insert New Drug Package
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_drug_package($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        
        // Insert into drug_product
        if(isset($data_array['drug_package_id'])){$this->db->set('drug_package_id', $data_array['drug_package_id']);}
        if(isset($data_array['package_name'])){$this->db->set('package_name', $data_array['package_name']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['package_code'])){$this->db->set('package_code', $data_array['package_code']);}
        if(isset($data_array['package_remarks'])){$this->db->set('package_remarks', $data_array['package_remarks']);}
        if(isset($data_array['package_sort'])){$this->db->set('package_sort', $data_array['package_sort']);}
        if(isset($data_array['package_active'])){$this->db->set('package_active', $data_array['package_active']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('drug_package');
        //echo $this->db->last_query();
        //echo "<br />Inserted into drug_package";
		
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_drug_package($data_array)


    //************************************************************************
    /**
     * Method to insert New Drug Package Content
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_package_drug($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        
        // Insert into drug
        if(isset($data_array['content_id'])){$this->db->set('content_id', $data_array['content_id']);}
        if(isset($data_array['drug_package_id'])){$this->db->set('drug_package_id', $data_array['drug_package_id']);}
        if(isset($data_array['drug_formulary_id'])){$this->db->set('drug_formulary_id', $data_array['drug_formulary_id']);}
        if(isset($data_array['atc_code'])){$this->db->set('atc_code', $data_array['atc_code']);}
        if(isset($data_array['dose'])){$this->db->set('dose', $data_array['dose']);}
        if(isset($data_array['dose_form'])){$this->db->set('dose_form', $data_array['dose_form']);}
        if(isset($data_array['frequency'])){$this->db->set('frequency', $data_array['frequency']);}
        if(isset($data_array['instruction'])){$this->db->set('instruction', $data_array['instruction']);}
        if(isset($data_array['quantity'])){$this->db->set('quantity', $data_array['quantity']);}
        if(isset($data_array['quantity_form'])){$this->db->set('quantity_form', $data_array['quantity_form']);}
        if(isset($data_array['indication'])){$this->db->set('indication', $data_array['indication']);}
        if(isset($data_array['caution'])){$this->db->set('caution', $data_array['caution']);}
        if(isset($data_array['drug_code_id'])){$this->db->set('drug_code_id', $data_array['drug_code_id']);}
        if(isset($data_array['drug_remarks'])){$this->db->set('drug_remarks', $data_array['drug_remarks']);}
        if(isset($data_array['dose_duration'])){$this->db->set('dose_duration', $data_array['dose_duration']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('drug_package_content');
        //echo $this->db->last_query();
        //echo "<br />Inserted into drug_package_content";
		
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_package_drug($data_array)


    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update drug supplier
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_drug_supplier($data_array)
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
        if(isset($data_array['supplier_remarks'])){$this->db->set('remarks', $data_array['supplier_remarks']);}
        $this->db->where('supplier_id', (string)$data_array['supplier_id']);
        $this->db->update('drug_supplier');
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
    } // end of function update_drug_supplier($data_array)


    //************************************************************************
    /**
     * Method to update drug product
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_drug_product($data_array)
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
        if(isset($data_array['drug_official_code'])){$this->db->set('drug_official_code', (string)$data_array['drug_official_code']);}
        if(isset($data_array['drug_code_id'])){$this->db->set('drug_code_id', $data_array['drug_code_id']);}
        if(isset($data_array['formulary_id'])){$this->db->set('formulary_id', $data_array['formulary_id']);}
        if(isset($data_array['manufacturer_id'])){$this->db->set('manufacturer_id', $data_array['manufacturer_id']);}
        if(isset($data_array['supplier_id'])){$this->db->set('supplier_id', $data_array['supplier_id']);}
        if(isset($data_array['product_name'])){$this->db->set('product_name', $data_array['product_name']);}
        if(isset($data_array['seller_code'])){$this->db->set('seller_code', $data_array['seller_code']);}
        if(isset($data_array['pbkd_no'])){$this->db->set('pbkd_no', $data_array['pbkd_no']);}
        if(isset($data_array['packing'])){$this->db->set('packing', (float)$data_array['packing']);}
        if(isset($data_array['packing_form'])){$this->db->set('packing_form', $data_array['packing_form']);}
        if(isset($data_array['bulk_packing'])){$this->db->set('bulk_packing', (float)$data_array['bulk_packing']);}
        if(isset($data_array['bulk_form'])){$this->db->set('bulk_form', $data_array['bulk_form']);}
        if(isset($data_array['wholesale_price'])){$this->db->set('wholesale_price', (float)$data_array['wholesale_price']);}
        if(isset($data_array['bonus_base'])){$this->db->set('bonus_base', (float)$data_array['bonus_base']);}
        if(isset($data_array['bonus_extra'])){$this->db->set('bonus_extra', (float)$data_array['bonus_extra']);}
        if(isset($data_array['retail_price'])){$this->db->set('retail_price', (float)$data_array['retail_price']);}
        if(isset($data_array['retail_price_2'])){$this->db->set('retail_price_2', (float)$data_array['retail_price_2']);}
        if(isset($data_array['retail_price_3'])){$this->db->set('retail_price_3', (float)$data_array['retail_price_3']);}
        if(isset($data_array['ucost_std'])){$this->db->set('ucost_std', (float)$data_array['ucost_std']);}
        if(isset($data_array['ucost_fifo'])){$this->db->set('ucost_fifo', (float)$data_array['ucost_fifo']);}
        if(isset($data_array['ucost_wac'])){$this->db->set('ucost_wac', (float)$data_array['ucost_wac']);}
        if(isset($data_array['quantity'])){$this->db->set('quantity', (float)$data_array['quantity']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['reorder_level'])){$this->db->set('reorder_level', (float)$data_array['reorder_level']);}
        if(isset($data_array['reorder_qty'])){$this->db->set('reorder_qty', (float)$data_array['reorder_qty']);}
        if(isset($data_array['eoq'])){$this->db->set('eoq', (float)$data_array['eoq']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['drug_type'])){$this->db->set('drug_type', $data_array['drug_type']);}
        if(isset($data_array['edit_remarks'])){$this->db->set('edit_remarks', $data_array['edit_remarks']);}
        if(isset($data_array['edit_staff'])){$this->db->set('edit_staff', $data_array['edit_staff']);}
        if(isset($data_array['edit_date'])){$this->db->set('edit_date', $data_array['edit_date']);}
        $this->db->where('product_id', (string)$data_array['product_id']);
        $this->db->update('drug_product');
        //echo $this->db->last_query();
        
       
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_drug_product($data_array)


    //************************************************************************
    /**
     * Method to update drug package
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_drug_package($data_array)
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
        if(isset($data_array['package_name'])){$this->db->set('package_name', $data_array['package_name']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['package_code'])){$this->db->set('package_code', $data_array['package_code']);}
        if(isset($data_array['package_remarks'])){$this->db->set('package_remarks', $data_array['package_remarks']);}
        if(isset($data_array['package_sort'])){$this->db->set('package_sort', $data_array['package_sort']);}
        if(isset($data_array['package_active'])){$this->db->set('package_active', $data_array['package_active']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        $this->db->where('drug_package_id', (string)$data_array['drug_package_id']);
        $this->db->update('drug_package');
        //echo $this->db->last_query();
        
       
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_drug_package($data_array)


    //************************************************************************
    /**
     * Method to update drug package content
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_package_drug($data_array)
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
        if(isset($data_array['drug_formulary_id'])){$this->db->set('drug_formulary_id', $data_array['drug_formulary_id']);}
        if(isset($data_array['atc_code'])){$this->db->set('atc_code', $data_array['atc_code']);}
        if(isset($data_array['dose'])){$this->db->set('dose', $data_array['dose']);}
        if(isset($data_array['dose_form'])){$this->db->set('dose_form', $data_array['dose_form']);}
        if(isset($data_array['frequency'])){$this->db->set('frequency', $data_array['frequency']);}
        if(isset($data_array['instruction'])){$this->db->set('instruction', $data_array['instruction']);}
        if(isset($data_array['quantity'])){$this->db->set('quantity', $data_array['quantity']);}
        if(isset($data_array['quantity_form'])){$this->db->set('quantity_form', $data_array['quantity_form']);}
        if(isset($data_array['indication'])){$this->db->set('indication', $data_array['indication']);}
        if(isset($data_array['caution'])){$this->db->set('caution', $data_array['caution']);}
        if(isset($data_array['drug_code_id'])){$this->db->set('drug_code_id', $data_array['drug_code_id']);}
        if(isset($data_array['drug_remarks'])){$this->db->set('drug_remarks', $data_array['drug_remarks']);}
        if(isset($data_array['dose_duration'])){$this->db->set('dose_duration', $data_array['dose_duration']);}
        $this->db->where('content_id', (string)$data_array['content_id']);
        $this->db->update('drug_package_content');
        //echo $this->db->last_query();
        
       
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_package_drug($data_array)


    //===============================================================
    // Delete Database Records Methods
    //************************************************************************
    /**
     * Method to delete package content
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function phar_delete_packagedrug($data_array)
    {
        /*
        echo "<hr />";
        echo "delete immunisation";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        $this->db->where('content_id', (string)$data_array['content_id']);
        $this->db->delete('drug_package_content');
        //echo $this->db->last_query();
        //echo "Deleted<br />";
        //echo "<hr />";
    } // end of function phar_delete_packagedrug($data_array)




}

/* End of file MPharma_wdb.php */
/* Location: ./app_thirra/models/mpharma_wdb.php */
