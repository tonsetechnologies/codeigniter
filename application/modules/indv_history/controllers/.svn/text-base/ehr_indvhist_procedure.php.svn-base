21<?php
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
 * Portions created by the Initial Developer are Copyright (C) 2010-2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

session_start();

/**
 * Controller Class for EHR_INDIVIDUAL_HISTORY
 *
 * This class is used for both narrowband and broadband EHR. 
 *
 * @version 0.9.15
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_indvhist_procedure extends MX_Controller 
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
		$this->load->model('mindiv_rdb');
		$this->load->model('memr_rdb');
		$this->load->model('mehr_wdb');
		$this->load->model('morders_procedure_rdb');
		$this->load->model('mthirra');

		// PanaCI
        $params = array('width' => 750, 'height' => 800, 'margin' => 10, 'backgroundColor' => '#eeeeee',);
        $this->load->library('chart', $params);

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
    // === INDIVIDUAL RECORD
    // ------------------------------------------------------------------------
    function list_past_procedures($seg3,$seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['patient_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
        $data['patient_info']['name']   = $data['patient_info']['patient_name'];
 		$data['title'] = "PR-".$data['patient_info']['name'];
        $data['procedure_list'] = $this->morders_procedure_rdb->get_past_procedures($data['patient_id']);
		$this->load->vars($data);
        if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_ovrvw_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
            //$new_body   =   "ehr/ehr_indv_list_history_vitals_wap";
            $new_body   =   "ehr_indv_list_past_procedures_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_ovrvw_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
            $new_body   =   "ehr_indv_list_past_procedures_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);		
		
    } // end of function list_history_diagnosis()


    // ------------------------------------------------------------------------
    // Categorised procedure order form
    function edit_past_procedure($seg3,$seg4,$seg5)
    {
		$this->load->model('morders_wdb');
		$this->load->model('morders_procedure_wdb');
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
            $data['form_purpose']   =   $seg3; //$this->uri->segment(3);
            $data['patient_id']     =   $seg4; //$this->uri->segment(4);
            $data['past_procedure_id']     =   $seg5; //$this->uri->segment(5);
            $patient_id             =   $seg4; //$this->uri->segment(4);
            $data['patient_id']     =   $patient_id;
	  	
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
            //$data['order_id']   	= $_POST['order_id'];
            $data['procedure_date']    = $_POST['procedure_date'];
            $data['date_precision']          = $_POST['date_precision'];
            $data['procedure_notes'] 	        = $this->input->post('procedure_notes');
            $data['procedure_remarks'] = $this->input->post('procedure_remarks');
            $data['procedure_place'] = $this->input->post('procedure_place');
            $data['procedure_outcome'] = $this->input->post('procedure_outcome');
            $data['outcome_reference'] 	= $_POST['outcome_reference'];
            $data['outcome_remarks'] 	= $this->input->post('outcome_remarks');
            $data['outcome_date'] 	= $_POST['outcome_date'];
            $data['added_remarks'] = $this->input->post('added_remarks');
            $data['edit_remarks'] = $this->input->post('edit_remarks');
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_procedure") {
                $data['pcode_category']   =   "";
                $data['product_id']  	=   "";
                $data['procedure_date']  	=   "";
                $data['date_precision']  	=   "";
                $data['procedure_notes']  	=   "";
                $data['pcode1ext_id']  	=   "";
                $data['pcode1ext_code']  	=   "";
                $data['order_id']  	=   "";
                $data['product_id']  	=   "";
                $data['procedure_remarks']  	=   "";
                $data['procedure_place']  	=   "";
                $data['procedure_outcome']  	=   "";
                $data['outcome_reference']  	=   "";
                $data['outcome_remarks']  	=   "";
                $data['outcome_staff']  	=   "";
                $data['outcome_date']  	=   $data['now_date'];
                $data['added_remarks']  	=   "";
                $data['pcode1_id']  	=   "";
            } elseif ($data['form_purpose'] == "edit_procedure") {
                $data['purpose_info'] = $this->morders_procedure_rdb->get_past_procedures($data['patient_id'],$data['past_procedure_id']);
                $data['staff_id']=   $data['purpose_info'][0]['staff_id'];
                $data['procedure_date']=   $data['purpose_info'][0]['procedure_date'];
                $data['date_precision']=   $data['purpose_info'][0]['date_precision'];
                $data['procedure_notes']=   $data['purpose_info'][0]['procedure_notes'];
                $data['pcode1ext_id']=   $data['purpose_info'][0]['pcode1ext_id'];
                $data['pcode1ext_code']=   $data['purpose_info'][0]['pcode1ext_code'];
                $data['order_id']=   $data['purpose_info'][0]['order_id'];
                $data['product_id']=   $data['purpose_info'][0]['product_id'];
                $data['procedure_remarks']=   $data['purpose_info'][0]['procedure_remarks'];
                $data['procedure_place']=   $data['purpose_info'][0]['procedure_place'];
                $data['procedure_outcome']=   $data['purpose_info'][0]['procedure_outcome'];
                $data['outcome_remarks']=   $data['purpose_info'][0]['outcome_remarks'];
                $data['outcome_staff']=   $data['purpose_info'][0]['outcome_staff'];
                $data['outcome_date']=   $data['purpose_info'][0]['outcome_date'];
                $data['added_remarks']=   $data['purpose_info'][0]['added_remarks'];
                $data['added_staff']=   $data['purpose_info'][0]['added_staff'];
                $data['added_date']=   $data['purpose_info'][0]['added_date'];
                $data['added_date']=   $data['purpose_info'][0]['added_date'];
                $data['edit_remarks']=   $data['purpose_info'][0]['edit_remarks'];
                $data['edit_staff']=   $data['purpose_info'][0]['edit_staff'];
                $data['edit_date']=   $data['purpose_info'][0]['edit_date'];
                $data['pcode1_id']=   $data['purpose_info'][0]['pcode1_id'];
                $data['pcode1ext_longname']=   $data['purpose_info'][0]['pcode1ext_longname'];
                $data['pcode_category']=   $data['purpose_info'][0]['pcode_category'];
                $data['outcome_reference']=   "";
            } //endif ($data['form_purpose'] == "new_procedure")
        } //endif(count($_POST))
		$data['title'] = "procedure";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id']);
        //$data['procedure_orders'] = $this->morders_procedure_rdb->get_patcon_procedures($data['summary_id']);
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
		if ($this->form_validation->run('edit_past_procedure') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_conslt_wap";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_wap";
                //$new_body   =   "ehr/ehr_edit_imaging_wap";
                $new_body   =   "ehr_indv_edit_past_procedure_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_conslt_html";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_html";
                $new_body   =   "ehr_indv_edit_past_procedure_html";
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
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_procedure") {
                // New diagnosis record
                $ins_procedure_array   =   array();
                $ins_procedure_array['staff_id']            = $this->session->userdata('staff_id');
                $ins_procedure_array['now_id']              = $data['now_id'];
                $ins_procedure_array['past_procedure_id']            = $data['now_id'];
                $ins_procedure_array['patient_id']          = $data['patient_id'];
                $ins_procedure_array['procedure_date']               = $data['procedure_date'];
                $ins_procedure_array['date_precision']       = $data['date_precision'];
                $ins_procedure_array['procedure_notes']       = $data['procedure_notes'];
                $ins_procedure_array['pcode1ext_code']      = $data['pcode1ext_details']['pcode1ext_code'];
                $ins_procedure_array['pcode1ext_id']        = $data['pcode1ext_id'];
                //$ins_procedure_array['order_id']          = $data['order_id'];
                $ins_procedure_array['product_id']          = $data['product_id'];
                $ins_procedure_array['procedure_remarks']   = $data['procedure_remarks'];
                $ins_procedure_array['procedure_place']   = $data['procedure_place'];
                $ins_procedure_array['procedure_outcome']   = $data['procedure_outcome'];
                //$ins_procedure_array['outcome_reference']   = $data['outcome_reference'];
                $ins_procedure_array['outcome_remarks']     = $data['outcome_remarks'];
                $ins_procedure_array['outcome_staff']       = $this->session->userdata('staff_id');
                if(!empty($data['outcome_date'])){
                    $ins_procedure_array['outcome_date']        = $data['outcome_date'];
                }
                $ins_procedure_array['added_remarks']     = $data['added_remarks'];
                $ins_procedure_array['added_staff']       = $this->session->userdata('staff_id');
                $ins_procedure_array['added_date']        = $data['now_id'];
                if($data['offline_mode']){
                    $ins_procedure_array['synch_out']        = $data['now_id'];
                }
	            $ins_procedure_data       =   $this->morders_procedure_wdb->insert_new_past_procedure($ins_procedure_array);
                $this->session->set_flashdata('data_activity', 'Past Procedure added.');
            } elseif($data['form_purpose'] == "edit_procedure") {
                // Existing diagnosis record
                $ins_procedure_array   =   array();
                //$ins_procedure_array['staff_id']            = $this->session->userdata('staff_id');
                $ins_procedure_array['now_id']              = $data['now_id'];
                $ins_procedure_array['past_procedure_id']            = $data['past_procedure_id'];
                //$ins_procedure_array['patient_id']          = $data['patient_id'];
                $ins_procedure_array['procedure_date']               = $data['procedure_date'];
                $ins_procedure_array['date_precision']       = $data['date_precision'];
                $ins_procedure_array['procedure_notes']       = $data['procedure_notes'];
                $ins_procedure_array['pcode1ext_code']      = $data['pcode1ext_details']['pcode1ext_code'];
                $ins_procedure_array['pcode1ext_id']        = $data['pcode1ext_id'];
                //$ins_procedure_array['order_id']          = $data['order_id'];
                $ins_procedure_array['product_id']          = $data['product_id'];
                $ins_procedure_array['procedure_remarks']   = $data['procedure_remarks'];
                $ins_procedure_array['procedure_place']   = $data['procedure_place'];
                $ins_procedure_array['procedure_outcome']   = $data['procedure_outcome'];
                //$ins_procedure_array['outcome_reference']   = $data['outcome_reference'];
                $ins_procedure_array['outcome_remarks']     = $data['outcome_remarks'];
                $ins_procedure_array['outcome_staff']       = $this->session->userdata('staff_id');
                if(!empty($data['outcome_date'])){
                    $ins_procedure_array['outcome_date']        = $data['outcome_date'];
                }
                $ins_procedure_array['added_remarks']     = $data['added_remarks'];
                $ins_procedure_array['added_staff']       = $this->session->userdata('staff_id');
                $ins_procedure_array['added_date']        = $data['now_id'];
                if($data['offline_mode']){
                    $ins_procedure_array['synch_out']        = $data['now_id'];
                }
	            $upd_imaging_data       =   $this->morders_procedure_wdb->update_past_procedure($ins_procedure_array);
                $this->session->set_flashdata('data_activity', 'Past Procedure updated.');
            } //endif($data['form_purpose'] == "new_imaging")
            $new_page = base_url()."index.php/indv/indv/index/indv_history/ehr_indvhist_procedure/list_past_procedures/list_procedures/".$data['patient_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_imaging_order') == FALSE)
    } // end of function edit_past_procedure()


    // ------------------------------------------------------------------------
    function list_history_procedure_orders($seg3,$seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['patient_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
        $data['patient_info']['name']   = $data['patient_info']['patient_name'];
 		$data['title'] = "PR-".$data['patient_info']['name'];
        $data['imaging_list']   = $this->morders_procedure_rdb->get_recent_procedure_orders($data['patient_id']);
		$this->load->vars($data);
        if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_ovrvw_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
            //$new_body   =   "ehr/ehr_indv_list_history_vitals_wap";
            $new_body   =   "ehr_indv_list_procedure_orders_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_ovrvw_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
            $new_body   =   "ehr_indv_list_procedure_orders_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);		
		
    } // end of function list_history_procedure_orders()



}

/* End of file Ehr_indvhist_procedure.php */
/* Location: ./app_thirra/controllers/Ehr_indvhist_procedure.php */
