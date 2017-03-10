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

session_start();

/**
 * Controller Class for EHR_CONSULT_ORDERS
 *
 * This class is used for both narrowband and broadband EHR. 
 *
 * @version 0.9.15
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_consult_orders_procedure extends MX_Controller 
{
    protected $_patient_id      =  "";
    protected $_offline_mode    =  FALSE;
    //protected $_offline_mode    =  TRUE;
    protected $_debug_mode      =  FALSE;
    //protected $_debug_mode      =  TRUE;


    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->helper('form');
        $data['app_language']		    =	$this->config->item('app_language');
        $this->lang->load('ehr', $data['app_language']);
		$this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->load->model('mthirra');
		$this->load->model('memr_rdb');
		$this->load->model('morders_procedure_rdb');
        
        $this->pretend_phone	=	FALSE;
        //$this->pretend_phone	=	TRUE;  // Turn this On to overwrites actual device
        $data['debug_mode']		=	TRUE;
        if($data['debug_mode'] == TRUE) {
            // spaghetti html
        } else {
            header('Content-type: application/xhtml+xml'); 
        }

        // Redirect back to login page if not authenticated
		if ($this->session->userdata('user_acl') < 1){
            $flash_message  =   "Session Expired.";
            $new_page   =   base_url()."index.php/thirra";
            header("Status: 200");
            header("Location: ".$new_page);
        } // redirect to login page

    }


    // ------------------------------------------------------------------------
    // === PATIENT CONSULTATION
    // ------------------------------------------------------------------------
    // Categorised procedure order form
    function edit_procedure($seg3,$seg4,$seg5,$seg6)
    {
		$this->load->model('morders_wdb');
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
	  	
        if(count($_POST)) {
            // User has posted the form
            if(isset($_POST['pcode_category'])) { 
                $data['pcode_category']   =   $_POST['pcode_category'];
            }
            if(isset($_POST['pcode1_id'])) { 
                $data['pcode1_id']   =   $_POST['pcode1_id'];
            } else {
                $data['pcode1_id']   =   NULL;
            }
            if(isset($_POST['pcode1ext_id'])) { 
                $data['pcode1ext_id']   =   $_POST['pcode1ext_id'];
            }
            if(isset($_POST['product_id'])) { 
                $data['product_id']   =   $_POST['product_id'];
            }
            $data['form_purpose']   = $_POST['form_purpose'];
            $data['patient_id']     = $_POST['patient_id'];
            $data['summary_id']     = $_POST['summary_id'];
            $data['order_id']   	= $_POST['order_id'];
            $data['counselling']    = $_POST['counselling'];
            $data['other']          = $_POST['other'];
            $data['notes'] 	        = $this->input->post('notes');
            $data['procedure_ref'] 	= $_POST['procedure_ref'];
            $data['procedure_outcome'] = $this->input->post('procedure_outcome');
            $data['outcome_reference'] 	= $_POST['outcome_reference'];
            $data['outcome_remarks'] 	= $this->input->post('outcome_remarks');
            $data['outcome_date'] 	= $_POST['outcome_date'];
        } else {
            // First time form is displayed
            $data['form_purpose']   =   $seg3; //$this->uri->segment(3);
            $data['patient_id']     =   $seg4; //$this->uri->segment(4);
            $data['summary_id']     =   $seg5; //$this->uri->segment(5);
            $data['order_id']       =   $seg6; //$this->uri->segment(6);
            $patient_id             =   $seg4; //$this->uri->segment(4);
            $data['patient_id']     =   $patient_id;
            if ($data['form_purpose'] == "new_procedure") {
                $data['pcode_category']   =   "";
                $data['product_id']  	=   "";
                $data['counselling']  	=   "";
                $data['other']  	=   "";
                $data['notes']  	=   "";
                //$data['result_status']  	=   "";
                //$data['invoice_status']  	=   "";
                $data['procedure_ref']  	=   "";
                $data['pcode1ext_id']  	=   "";
                $data['procedure_outcome']  	=   "";
                $data['outcome_reference']  	=   "";
                $data['outcome_remarks']  	=   "";
                $data['outcome_date']  	=   $data['now_date'];
                $data['pcode1_id']  	=   "";
            } elseif ($data['form_purpose'] == "edit_procedure") {
                $data['order_info'] = $this->morders_procedure_rdb->get_procorder_details($data['order_id']); //
                $data['staff_id']=   $data['order_info']['staff_id'];
                $data['product_id']=   $data['order_info']['product_id'];
                $data['counselling']=   $data['order_info']['counselling'];
                $data['other']=   $data['order_info']['other'];
                $data['notes']=   $data['order_info']['notes'];
                $data['result_status']=   $data['order_info']['result_status'];
                $data['procedure_ref']=   $data['order_info']['procedure_ref'];
                $data['pcode1ext_code']=   $data['order_info']['pcode1ext_code'];
                $data['pcode1ext_id']=   $data['order_info']['pcode1ext_id'];
                $data['procedure_outcome']=   $data['order_info']['procedure_outcome'];
                $data['outcome_reference']=   $data['order_info']['outcome_reference'];
                $data['outcome_remarks']=   $data['order_info']['outcome_remarks'];
                $data['outcome_staff']=   $data['order_info']['outcome_staff'];
                $data['outcome_date']=   $data['order_info']['outcome_date'];
                $data['pcode1_id']=   $data['order_info']['pcode1_id'];
                $data['pcode1ext_longname']=   $data['order_info']['pcode1ext_longname'];
                $data['pcode1ext_shortname']=   $data['order_info']['pcode1ext_shortname'];
                $data['pcode_category']=   $data['order_info']['pcode_category'];
            } //endif ($data['form_purpose'] == "new_procedure")
        } //endif(count($_POST))
		$data['title'] = "procedure";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id']);
        $data['procedure_orders'] = $this->morders_procedure_rdb->get_patcon_procedures($data['summary_id']);
        //$data['init_patient_id']    =   $patient_id;
		//$data['imaging_info']  = $this->memr_rdb->get_one_imaging_product($data['order_id']);

        $data['procedure_categories'] = $this->morders_procedure_rdb->get_procedure_categories();
        $data['procedure_groups'] = $this->morders_procedure_rdb->get_proceduregroups_by_category($data['pcode_category']);
        $data['procedure_list'] = $this->morders_procedure_rdb->get_procedures_by_group($data['pcode1_id']);
        if(isset($data['pcode1ext_id'])){
		    $data['product_list'] = $this->morders_procedure_rdb->get_products_by_procedure($data['pcode1ext_id']);
        } else {
            $data['product_list'] = array();
        }
        if(isset($data['product_id'])){
		    //$data['supplier_list'] = $this->memr_rdb->get_supplier_by_product($data['product_id']);
        } else {
            $data['supplier_list'] = array();
        }
		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_procedure_order') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_conslt_wap";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_wap";
                //$new_body   =   "ehr/ehr_edit_imaging_wap";
                $new_body   =   "ehr_edit_procedure_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_conslt_html";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_html";
                $new_body   =   "ehr_edit_procedure_html";
                $new_footer =   "ehr/footer_emr_html";
            }
            //$this->load->view($new_header);			
            //$this->load->view($new_banner);			
            //$this->load->view($new_sidebar);			
            $this->load->view($new_body);			
            //$this->load->view($new_footer);			
        } else {
            //echo "\nValidated successfully.";
            $data['pcode1ext_details']   = $this->morders_procedure_rdb->get_pcode1ext_details($data['pcode1ext_id']);
            //echo "<pre>";
            //print_r($data);
            //echo "</pre>";
            $this->load->model('morders_procedure_wdb');
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_procedure") {
                // New procedure order record
                $ins_procedure_array   =   array();
                $ins_procedure_array['staff_id']            = $this->session->userdata('staff_id');
                $ins_procedure_array['now_id']              = $data['now_id'];
                $ins_procedure_array['order_id']            = $data['now_id'];
                $ins_procedure_array['patient_id']          = $data['patient_id'];
                $ins_procedure_array['session_id']          = $data['summary_id'];
                $ins_procedure_array['product_id']          = $data['product_id'];
                $ins_procedure_array['counselling']         = $data['counselling'];
                $ins_procedure_array['other']               = $data['other'];
                $ins_procedure_array['notes']               = $data['notes'];
                $ins_procedure_array['invoice_status']      = "Unknown";
                $ins_procedure_array['procedure_ref']       = $data['procedure_ref'];
                $ins_procedure_array['pcode1ext_code']      = $data['pcode1ext_details']['pcode1ext_code'];
                $ins_procedure_array['pcode1ext_id']        = $data['pcode1ext_id'];
                $ins_procedure_array['procedure_outcome']   = $data['procedure_outcome'];
                $ins_procedure_array['outcome_remarks']     = $data['outcome_remarks'];
                if(empty($data['procedure_outcome']) && empty($data['outcome_remarks'])){
                    $ins_procedure_array['result_status']       = "Pending";
                    $ins_procedure_array['outcome_reference']   = NULL;
                    $ins_procedure_array['outcome_staff']       = NULL;
                    $ins_procedure_array['outcome_date']        = NULL;
                } else {
                    $ins_procedure_array['result_status']       = "Received";
                    $ins_procedure_array['outcome_reference']   = $data['outcome_reference'];
                    $ins_procedure_array['outcome_staff']       = $this->session->userdata('staff_id');
                    $ins_procedure_array['outcome_date']        = $data['outcome_date'];
                }
                if($data['offline_mode']){
                    $ins_procedure_array['synch_out']        = $data['now_id'];
                }
	            $ins_procedure_data       =   $this->morders_procedure_wdb->insert_new_procedure_order($ins_procedure_array);
                $this->session->set_flashdata('data_activity', 'Procedure order added.');
            } elseif($data['form_purpose'] == "edit_procedure") {
                // Existing procedure order record
                $upd_procedure_array   =   array();
                $upd_procedure_array['staff_id']            = $this->session->userdata('staff_id');
                $upd_procedure_array['now_id']              = $data['now_id'];
                $upd_procedure_array['order_id']            = $data['order_id'];
                $upd_procedure_array['patient_id']          = $data['patient_id'];
                $upd_procedure_array['session_id']          = $data['summary_id'];
                $upd_procedure_array['product_id']          = $data['product_id'];
                $upd_procedure_array['counselling']         = $data['counselling'];
                $upd_procedure_array['other']               = $data['other'];
                $upd_procedure_array['notes']               = $data['notes'];
                $upd_procedure_array['result_status']       = $data['result_status'];
                $upd_procedure_array['invoice_status']      = "Unknown";
                $upd_procedure_array['procedure_ref']       = $data['procedure_ref'];
                $upd_procedure_array['pcode1ext_code']      = $data['pcode1ext_details']['pcode1ext_code'];
                $upd_procedure_array['pcode1ext_id']        = $data['pcode1ext_id'];
                $upd_procedure_array['procedure_outcome']   = $data['procedure_outcome'];
                $upd_procedure_array['outcome_reference']   = $data['outcome_reference'];
                $upd_procedure_array['outcome_remarks']     = $data['outcome_remarks'];
                $upd_procedure_array['outcome_staff']       = $this->session->userdata('staff_id');
                $upd_procedure_array['outcome_date']        = $data['now_id'];
                if($data['offline_mode']){
                    $upd_procedure_array['synch_out']        = $data['now_id'];
                }
	            $upd_imaging_data       =   $this->morders_procedure_wdb->update_procedure_order($upd_procedure_array);
                $this->session->set_flashdata('data_activity', 'Imaging order updated.');
            } //endif($data['form_purpose'] == "new_imaging")
            $new_page = base_url()."index.php/cons/cons/index/cons_progress/ehr_consult/consult_episode/edit_episode/".$data['patient_id']."/".$data['summary_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_imaging_order') == FALSE)
    } // end of function edit_procedure()


    // ------------------------------------------------------------------------
    function consult_delete_procedure($seg3,$seg4,$seg5,$seg6) 
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $this->load->model('morders_procedure_wdb');
        $data['patient_id']         =   $seg4; //$this->uri->segment(3);
        $data['summary_id']         =   $seg5; //$this->uri->segment(4);
        $data['order_id']           =   $seg6; //$this->uri->segment(5);
        
        // Delete records
        $del_rec_array['order_id']      = $data['order_id'];
        $del_rec_data =   $this->morders_procedure_wdb->consult_delete_order($del_rec_array);
        $this->session->set_flashdata('data_activity', 'Procedure order deleted.');
        $new_page = base_url()."index.php/cons/cons/index/cons_progress/ehr_consult/consult_episode/edit_episode/".$data['patient_id']."/".$data['summary_id'];
        header("Status: 200");
        header("Location: ".$new_page);
        
    } // end of function consult_delete_procedure($id)




}

/* End of file Ehr_consult_orders_procedure.php */
/* Location: ./app_thirra/controllers/Ehr_consult_orders_procedure.php */
