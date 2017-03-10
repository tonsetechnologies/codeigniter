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

class MOrders_procedure_wdb extends CI_Model
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
     * Method to insert New drug allergy
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_procedure_order($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting procedure_order";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into procedure_order
        if(isset($data_array['order_id'])){$this->db->set('order_id', $data_array['order_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['product_id'])){$this->db->set('product_id', $data_array['product_id']);}
        if(isset($data_array['counselling'])){$this->db->set('counselling', $data_array['counselling']);}
        if(isset($data_array['other'])){$this->db->set('other', $data_array['other']);}
        if(isset($data_array['notes'])){$this->db->set('notes', $data_array['notes']);}
        if(isset($data_array['result_status'])){$this->db->set('result_status', $data_array['result_status']);}
        if(isset($data_array['invoice_status'])){$this->db->set('invoice_status', $data_array['invoice_status']);}
        if(isset($data_array['procedure_ref'])){$this->db->set('procedure_ref', $data_array['procedure_ref']);}
        if(isset($data_array['pcode1ext_code'])){$this->db->set('pcode1ext_code', $data_array['pcode1ext_code']);}
        if(isset($data_array['pcode1ext_id'])){$this->db->set('pcode1ext_id', $data_array['pcode1ext_id']);}
        if(isset($data_array['procedure_outcome'])){$this->db->set('procedure_outcome', $data_array['procedure_outcome']);}
        if(isset($data_array['outcome_reference'])){$this->db->set('outcome_reference', $data_array['outcome_reference']);}
        if(isset($data_array['outcome_remarks'])){$this->db->set('outcome_remarks', $data_array['outcome_remarks']);}
        if(isset($data_array['outcome_staff'])){$this->db->set('outcome_staff', $data_array['outcome_staff']);}
        if(isset($data_array['outcome_date'])){$this->db->set('outcome_date', $data_array['outcome_date']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('procedure_order');
        //echo $this->db->last_query();
        //echo "<br />Inserted into procedure_order";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_procedure_order($data_array)


    //************************************************************************
    /**
     * Method to insert New past_procedure
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_past_procedure($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting patient_past_procedure";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_past_procedure
        $this->db->set('past_procedure_id', $data_array['past_procedure_id']);
        $this->db->set('staff_id', $data_array['staff_id']);
        $this->db->set('patient_id', $data_array['patient_id']);
        $this->db->set('procedure_date', $data_array['procedure_date']);
        $this->db->set('date_precision', $data_array['date_precision']);
        if(isset($data_array['procedure_notes'])){$this->db->set('procedure_notes', $data_array['procedure_notes']);}
        if(isset($data_array['pcode1ext_id'])){$this->db->set('pcode1ext_id', $data_array['pcode1ext_id']);}
        $this->db->set('pcode1ext_code', $data_array['pcode1ext_code']);
        if(isset($data_array['order_id'])){$this->db->set('order_id', $data_array['order_id']);}
        if(isset($data_array['product_id'])){$this->db->set('product_id', $data_array['product_id']);}
        if(isset($data_array['procedure_remarks'])){$this->db->set('procedure_remarks', $data_array['procedure_remarks']);}
        if(isset($data_array['procedure_place'])){$this->db->set('procedure_place', $data_array['procedure_place']);}
        if(isset($data_array['procedure_outcome'])){$this->db->set('procedure_outcome', $data_array['procedure_outcome']);}
        if(isset($data_array['outcome_remarks'])){$this->db->set('outcome_remarks', $data_array['outcome_remarks']);}
        if(isset($data_array['outcome_staff'])){$this->db->set('outcome_staff', $data_array['outcome_staff']);}
        if(isset($data_array['outcome_date'])){$this->db->set('outcome_date', $data_array['outcome_date']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_past_procedure');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_past_procedure";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_past_procedure($data_array)


    //************************************************************************
    /**
     * Method to insert New pcode1
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_pcode1($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting pcode1";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into pcode1ext
        $this->db->set('pcode1_id', $data_array['pcode1_id']);
        $this->db->set('pcode1set', $data_array['pcode1set']);
        $this->db->set('pcode1_code', $data_array['pcode1_code']);
        if(isset($data_array['component'])){$this->db->set('component', $data_array['component']);}
        if(isset($data_array['code_use'])){$this->db->set('code_use', $data_array['code_use']);}
        $this->db->set('pcode_category', $data_array['pcode_category']);
        if(isset($data_array['topic'])){$this->db->set('topic', $data_array['topic']);}
        $this->db->set('full_title', $data_array['full_title']);
        $this->db->set('short_title', $data_array['short_title']);
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['criteria'])){$this->db->set('criteria', $data_array['criteria']);}
        if(isset($data_array['inclusion_criteria'])){$this->db->set('inclusion_criteria', $data_array['inclusion_criteria']);}
        if(isset($data_array['exclusion_criteria'])){$this->db->set('exclusion_criteria', $data_array['exclusion_criteria']);}
        if(isset($data_array['consideration'])){$this->db->set('consideration', $data_array['consideration']);}
        if(isset($data_array['note'])){$this->db->set('note', $data_array['note']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['pcode1ext_x01'])){$this->db->set('pcode1ext_x01', $data_array['pcode1ext_x01']);}
        if(isset($data_array['pcode1ext_x02'])){$this->db->set('pcode1ext_x02', $data_array['pcode1ext_x02']);}
        if(isset($data_array['pcode1ext_x03'])){$this->db->set('pcode1ext_x03', $data_array['pcode1ext_x03']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['pcode1_active'])){$this->db->set('pcode1_active', $data_array['pcode1_active']);}
        if(isset($data_array['edit_remarks'])){$this->db->set('edit_remarks', $data_array['edit_remarks']);}
        if(isset($data_array['edit_staff'])){$this->db->set('edit_staff', $data_array['edit_staff']);}
        if(isset($data_array['edit_date'])){$this->db->set('edit_date', $data_array['edit_date']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('pcode1');
        //echo $this->db->last_query();
        //echo "<br />Inserted into pcode1";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_pcode1($data_array)


    //************************************************************************
    /**
     * Method to insert New pcode1ext
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_pcode1ext($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting pcode1ext";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into pcode1ext
        if(isset($data_array['pcode1ext_id'])){$this->db->set('pcode1ext_id', $data_array['pcode1ext_id']);}
        if(isset($data_array['pcode1_id'])){$this->db->set('pcode1_id', $data_array['pcode1_id']);}
        if(isset($data_array['pcode1set'])){$this->db->set('pcode1set', $data_array['pcode1set']);}
        if(isset($data_array['pcode1ext_code'])){$this->db->set('pcode1ext_code', $data_array['pcode1ext_code']);}
        if(isset($data_array['pcode1ext_longname'])){$this->db->set('pcode1ext_longname', $data_array['pcode1ext_longname']);}
        if(isset($data_array['pcode1ext_shortname'])){$this->db->set('pcode1ext_shortname', $data_array['pcode1ext_shortname']);}
        if(isset($data_array['component'])){$this->db->set('component', $data_array['component']);}
        if(isset($data_array['code_use'])){$this->db->set('code_use', $data_array['code_use']);}
        if(isset($data_array['pcode_category'])){$this->db->set('pcode_category', $data_array['pcode_category']);}
        if(isset($data_array['topic'])){$this->db->set('topic', $data_array['topic']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['criteria'])){$this->db->set('criteria', $data_array['criteria']);}
        if(isset($data_array['inclusion_criteria'])){$this->db->set('inclusion_criteria', $data_array['inclusion_criteria']);}
        if(isset($data_array['exclusion_criteria'])){$this->db->set('exclusion_criteria', $data_array['exclusion_criteria']);}
        if(isset($data_array['consideration'])){$this->db->set('consideration', $data_array['consideration']);}
        if(isset($data_array['note'])){$this->db->set('note', $data_array['note']);}
        if(isset($data_array['pcode1ext_notify'])){$this->db->set('pcode1ext_notify', $data_array['pcode1ext_notify']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['pcode1ext_x01'])){$this->db->set('pcode1ext_x01', $data_array['pcode1ext_x01']);}
        if(isset($data_array['pcode1ext_x02'])){$this->db->set('pcode1ext_x02', $data_array['pcode1ext_x02']);}
        if(isset($data_array['pcode1ext_x03'])){$this->db->set('pcode1ext_x03', $data_array['pcode1ext_x03']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['pcode1ext_active'])){$this->db->set('pcode1ext_active', $data_array['pcode1ext_active']);}
        if(isset($data_array['edit_remarks'])){$this->db->set('edit_remarks', $data_array['edit_remarks']);}
        if(isset($data_array['edit_staff'])){$this->db->set('edit_staff', $data_array['edit_staff']);}
        if(isset($data_array['edit_date'])){$this->db->set('edit_date', $data_array['edit_date']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('pcode1ext');
        //echo $this->db->last_query();
        //echo "<br />Inserted into pcode1ext";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_pcode1ext($data_array)


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
    function insert_new_procsupplier($data_array)
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
		
        // Insert into procedure_supplier
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
        $this->db->insert('procedure_supplier');
        //echo $this->db->last_query();
        //echo "<br />Inserted into procedure_supplier";
		
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
    } // end of function insert_new_procsupplier($data_array)


    //************************************************************************
    /**
     * Method to insert New procedure_product
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_proc_product($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting procedure_product";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
            price numeric(10,2),
        */
        // Insert into procedure_product
        $this->db->set('product_id', $data_array['product_id']);
        $this->db->set('supplier_id', $data_array['supplier_id']);
        $this->db->set('pcode1ext_id', $data_array['pcode1ext_id']);
        if(isset($data_array['pcode1ext_code'])){$this->db->set('pcode1ext_code', $data_array['pcode1ext_code']);}
        if(isset($data_array['product_code'])){$this->db->set('product_code', $data_array['product_code']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        $this->db->set('product_name', $data_array['product_name']);
        if(isset($data_array['prod_description'])){$this->db->set('prod_description', $data_array['prod_description']);}
        if(isset($data_array['retail_price_1'])){$this->db->set('retail_price_1', $data_array['retail_price_1']);}
        if(isset($data_array['retail_price_2'])){$this->db->set('retail_price_2', $data_array['retail_price_2']);}
        if(isset($data_array['retail_price_3'])){$this->db->set('retail_price_3', $data_array['retail_price_3']);}
        if(isset($data_array['seller_code'])){$this->db->set('seller_code', $data_array['seller_code']);}
        if(isset($data_array['supplier_cost'])){$this->db->set('supplier_cost', $data_array['supplier_cost']);}
        if(isset($data_array['prod_remarks'])){$this->db->set('prod_remarks', $data_array['prod_remarks']);}
        $this->db->set('location_id', $data_array['location_id']);
        if(isset($data_array['product_active'])){$this->db->set('product_active', $data_array['product_active']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('procedure_product');
        //echo $this->db->last_query();
        //echo "<br />Inserted into procedure_product";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_proc_product($data_array)




    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update current procedure_order
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_procedure_order($data_array)
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
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        //$this->db->set('patient_id', (string)$data_array['patient_id']);
        //$this->db->set('session_id', $data_array['session_id']);
        $this->db->set('staff_id', $data_array['staff_id']);
        $this->db->set('product_id', $data_array['product_id']);
        if(isset($data_array['counselling'])){$this->db->set('counselling', $data_array['counselling']);}
        if(isset($data_array['other'])){$this->db->set('other', $data_array['other']);}
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        $this->db->set('notes', $data_array['notes']);
        $this->db->set('result_status', $data_array['result_status']);
        $this->db->set('invoice_status', $data_array['invoice_status']);
        $this->db->set('procedure_ref', $data_array['procedure_ref']);
        $this->db->set('pcode1ext_code', $data_array['pcode1ext_code']);
        $this->db->set('pcode1ext_id', $data_array['pcode1ext_id']);
        if(isset($data_array['procedure_outcome'])){$this->db->set('procedure_outcome', $data_array['procedure_outcome']);}
        if(isset($data_array['outcome_reference'])){$this->db->set('outcome_reference', $data_array['outcome_reference']);}
        if(isset($data_array['outcome_remarks'])){$this->db->set('outcome_remarks', $data_array['outcome_remarks']);}
        if(isset($data_array['outcome_staff'])){$this->db->set('outcome_staff', $data_array['outcome_staff']);}
        if(isset($data_array['outcome_date'])){$this->db->set('outcome_date', $data_array['outcome_date']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
        $this->db->where('order_id', $data_array['order_id']);
        $this->db->update('procedure_order');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_procedure_order($data_array)


    //************************************************************************
    /**
     * Method to update update_past_procedure
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_past_procedure($data_array)
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
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        //$this->db->set('staff_id', $data_array['staff_id']);
        //$this->db->set('patient_id', $data_array['patient_id']);
        $this->db->set('procedure_date', $data_array['procedure_date']);
        $this->db->set('date_precision', $data_array['date_precision']);
        if(isset($data_array['procedure_notes'])){$this->db->set('procedure_notes', $data_array['procedure_notes']);}
        if(isset($data_array['pcode1ext_id'])){$this->db->set('pcode1ext_id', $data_array['pcode1ext_id']);}
        $this->db->set('pcode1ext_code', $data_array['pcode1ext_code']);
        //if(isset($data_array['order_id'])){$this->db->set('order_id', $data_array['order_id']);}
        if(isset($data_array['product_id'])){$this->db->set('product_id', $data_array['product_id']);}
        if(isset($data_array['procedure_remarks'])){$this->db->set('procedure_remarks', $data_array['procedure_remarks']);}
        if(isset($data_array['procedure_place'])){$this->db->set('procedure_place', $data_array['procedure_place']);}
        if(isset($data_array['procedure_outcome'])){$this->db->set('procedure_outcome', $data_array['procedure_outcome']);}
        if(isset($data_array['outcome_remarks'])){$this->db->set('outcome_remarks', $data_array['outcome_remarks']);}
        if(isset($data_array['outcome_staff'])){$this->db->set('outcome_staff', $data_array['outcome_staff']);}
        if(isset($data_array['outcome_date'])){$this->db->set('outcome_date', $data_array['outcome_date']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        $this->db->where('past_procedure_id', $data_array['past_procedure_id']);
        $this->db->update('patient_past_procedure');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_past_procedure($data_array)


	//************************************************************************
    /**
     * Method to update_pcode1
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_pcode1($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['pcode1set'])){$this->db->set('pcode1set', $data_array['pcode1set']);}
        if(isset($data_array['pcode1_code'])){$this->db->set('pcode1_code', $data_array['pcode1_code']);}
        if(isset($data_array['component'])){$this->db->set('component', $data_array['component']);}
        if(isset($data_array['code_use'])){$this->db->set('code_use', $data_array['code_use']);}
        if(isset($data_array['pcode_category'])){$this->db->set('pcode_category', $data_array['pcode_category']);}
        if(isset($data_array['topic'])){$this->db->set('topic', $data_array['topic']);}
        if(isset($data_array['full_title'])){$this->db->set('full_title', $data_array['full_title']);}
        if(isset($data_array['short_title'])){$this->db->set('short_title', $data_array['short_title']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['criteria'])){$this->db->set('criteria', $data_array['criteria']);}
        if(isset($data_array['inclusion_criteria'])){$this->db->set('inclusion_criteria', $data_array['inclusion_criteria']);}
        if(isset($data_array['exclusion_criteria'])){$this->db->set('exclusion_criteria', $data_array['exclusion_criteria']);}
        if(isset($data_array['consideration'])){$this->db->set('consideration', $data_array['consideration']);}
        if(isset($data_array['note'])){$this->db->set('note', $data_array['note']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['pcode1_x01'])){$this->db->set('pcode1_x01', $data_array['pcode1_x01']);}
        if(isset($data_array['pcode1_x02'])){$this->db->set('pcode1_x02', $data_array['pcode1_x02']);}
        if(isset($data_array['pcode1_x03'])){$this->db->set('pcode1_x03', $data_array['pcode1_x03']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['pcode1_active'])){$this->db->set('pcode1_active', $data_array['pcode1_active']);}
        if(isset($data_array['edit_remarks'])){$this->db->set('edit_remarks', $data_array['edit_remarks']);}
        if(isset($data_array['edit_staff'])){$this->db->set('edit_staff', $data_array['edit_staff']);}
        if(isset($data_array['edit_date'])){$this->db->set('edit_date', $data_array['edit_date']);}
        if(isset($data_array['delete_remarks'])){$this->db->set('delete_remarks', $data_array['delete_remarks']);}
        if(isset($data_array['delete_staff'])){$this->db->set('delete_staff', $data_array['delete_staff']);}
        if(isset($data_array['delete_date'])){$this->db->set('delete_date', $data_array['delete_date']);}
        if(isset($data_array['patch_remarks'])){$this->db->set('patch_remarks', $data_array['patch_remarks']);}
        if(isset($data_array['patch_version'])){$this->db->set('patch_version', $data_array['patch_version']);}
        if(isset($data_array['patch_date'])){$this->db->set('patch_date', $data_array['patch_date']);}
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        $this->db->where('pcode1_id', $data_array['pcode1_id']);
        $this->db->update('pcode1');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_pcode1($data_array)


	//************************************************************************
    /**
     * Method to update_pcode1ext
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_pcode1ext($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        //if(isset($data_array['pcode1_id'])){$this->db->set('pcode1_id', $data_array['pcode1_id']);}
        //if(isset($data_array['pcode1set'])){$this->db->set('pcode1set', $data_array['pcode1set']);}
        if(isset($data_array['pcode1ext_code'])){$this->db->set('pcode1ext_code', $data_array['pcode1ext_code']);}
        if(isset($data_array['pcode1ext_longname'])){$this->db->set('pcode1ext_longname', $data_array['pcode1ext_longname']);}
        if(isset($data_array['pcode1ext_shortname'])){$this->db->set('pcode1ext_shortname', $data_array['pcode1ext_shortname']);}
        if(isset($data_array['component'])){$this->db->set('component', $data_array['component']);}
        if(isset($data_array['code_use'])){$this->db->set('code_use', $data_array['code_use']);}
        if(isset($data_array['pcode_category'])){$this->db->set('pcode_category', $data_array['pcode_category']);}
        if(isset($data_array['topic'])){$this->db->set('topic', $data_array['topic']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['criteria'])){$this->db->set('criteria', $data_array['criteria']);}
        if(isset($data_array['inclusion_criteria'])){$this->db->set('inclusion_criteria', $data_array['inclusion_criteria']);}
        if(isset($data_array['exclusion_criteria'])){$this->db->set('exclusion_criteria', $data_array['exclusion_criteria']);}
        if(isset($data_array['consideration'])){$this->db->set('consideration', $data_array['consideration']);}
        if(isset($data_array['note'])){$this->db->set('note', $data_array['note']);}
        if(isset($data_array['pcode1ext_notify'])){$this->db->set('pcode1ext_notify', $data_array['pcode1ext_notify']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['pcode1ext_x01'])){$this->db->set('pcode1ext_x01', $data_array['pcode1ext_x01']);}
        if(isset($data_array['pcode1ext_x02'])){$this->db->set('pcode1ext_x02', $data_array['pcode1ext_x02']);}
        if(isset($data_array['pcode1ext_x03'])){$this->db->set('pcode1ext_x03', $data_array['pcode1ext_x03']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['pcode1ext_active'])){$this->db->set('pcode1ext_active', $data_array['pcode1ext_active']);}
        if(isset($data_array['edit_remarks'])){$this->db->set('edit_remarks', $data_array['edit_remarks']);}
        if(isset($data_array['edit_staff'])){$this->db->set('edit_staff', $data_array['edit_staff']);}
        if(isset($data_array['edit_date'])){$this->db->set('edit_date', $data_array['edit_date']);}
        $this->db->where('pcode1ext_id', $data_array['pcode1ext_id']);
        $this->db->update('pcode1ext');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_pcode1ext($data_array)


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
    function update_procedure_supplier($data_array)
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
        $this->db->update('procedure_supplier');
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
    } // end of function update_procedure_supplier($data_array)


    //************************************************************************
    /**
     * Method to update_proc_product
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_proc_product($data_array)
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
        //if(isset($data_array['supplier_id'])){$this->db->set('supplier_id', $data_array['supplier_id']);}
        $this->db->set('pcode1ext_id', $data_array['pcode1ext_id']);
        if(isset($data_array['product_code'])){$this->db->set('product_code', $data_array['product_code']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        $this->db->set('product_name', $data_array['product_name']);
        if(isset($data_array['prod_description'])){$this->db->set('prod_description', $data_array['prod_description']);}
        if(isset($data_array['retail_price_1'])){$this->db->set('retail_price_1', $data_array['retail_price_1']);}
        if(isset($data_array['retail_price_2'])){$this->db->set('retail_price_2', $data_array['retail_price_2']);}
        if(isset($data_array['retail_price_3'])){$this->db->set('retail_price_3', $data_array['retail_price_3']);}
        if(isset($data_array['seller_code'])){$this->db->set('seller_code', $data_array['seller_code']);}
        if(isset($data_array['supplier_cost'])){$this->db->set('supplier_cost', $data_array['supplier_cost']);}
        if(isset($data_array['prod_remarks'])){$this->db->set('prod_remarks', $data_array['prod_remarks']);}
        $this->db->set('location_id', $data_array['location_id']);
        if(isset($data_array['product_active'])){$this->db->set('product_active', $data_array['product_active']);}
        $this->db->where('product_id', $data_array['product_id']);
        $this->db->update('procedure_product');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_proc_product($data_array)




    //===============================================================
    // Delete Database Records Methods
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
    function consult_delete_order($data_array)
    {
        
        $this->db->where('order_id', (string)$data_array['order_id']);
        $this->db->delete('procedure_order');
        //echo $this->db->last_query();
        //echo "Deleted<br />";
        //echo "<hr />";
    } // end of function consult_delete_order($data_array)




}

/* End of file MOrders_procedure_wdb.php */
/* Location: ./app_thirra/models/MOrders_procedure_wdb.php */
