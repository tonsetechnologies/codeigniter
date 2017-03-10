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
 * @version 1.0.0
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_indvhist_problemlist extends MX_Controller 
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
    function list_problem_list($seg3,$seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['patient_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
        $data['patient_info']['name']   = $data['patient_info']['patient_name'];
 		$data['title'] = "PR-".$data['patient_info']['name'];
        $data['problem_list'] = $this->mindiv_rdb->get_problem_list($data['patient_id']);
		$this->load->vars($data);
        if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_ovrvw_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
            //$new_body   =   "ehr/ehr_indv_list_history_vitals_wap";
            $new_body   =   "ehr_indv_list_problem_list_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_ovrvw_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
            $new_body   =   "ehr_indv_list_problem_list_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);		
		
    } // end of function list_problem_list()


    // ------------------------------------------------------------------------
    // Categorised procedure order form
    function edit_problem_list($seg3,$seg4,$seg5)
    {
		$this->load->model('morders_wdb');
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['form_purpose']   =   $seg3; //$this->uri->segment(3);
        $data['patient_id']     =   $seg4; //$this->uri->segment(4);
        $data['problem_list_id']=   $seg5; //$this->uri->segment(5);
        $patient_id             =   $seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['form_purpose']   = $_POST['form_purpose'];
            $data['staff_name'] 	= $this->input->post('staff_name');
            $data['init_record_date']= $this->input->post('record_date');
            $data['init_problem'] = $this->input->post('problem');
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_problem") {
                $data['staff_name']  	        =   $this->session->userdata('username');
                $data['init_record_date']       =   $data['now_date'];
                $data['init_problem']  	        =   "";
            } elseif ($data['form_purpose'] == "edit_problem") {
                $data['purpose_info'] = $this->mindiv_rdb->get_problem_list($data['patient_id'],$data['problem_list_id']);
                $data['staff_id']=   $data['purpose_info'][0]['staff_id'];
                $data['staff_name']=   $data['purpose_info'][0]['staff_name'];
                $data['init_record_date']=   $data['purpose_info'][0]['date'];
                $data['init_problem']=   $data['purpose_info'][0]['problem'];
           } //endif ($data['form_purpose'] == "new_procedure")
        } //endif(count($_POST))
		$data['title'] = "procedure";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id']);
        //$data['procedure_orders'] = $this->morders_procedure_rdb->get_patcon_procedures($data['summary_id']);
        //$data['init_patient_id']    =   $patient_id;
		//$data['imaging_info']  = $this->memr_rdb->get_one_imaging_product($data['order_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_problem_list') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_conslt_wap";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_wap";
                //$new_body   =   "ehr/ehr_edit_imaging_wap";
                $new_body   =   "ehr_indv_edit_problem_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_conslt_html";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_html";
                $new_body   =   "ehr_indv_edit_problem_html";
                $new_footer =   "ehr/footer_emr_html";
            }
            //$this->load->view($new_header);			
            //$this->load->view($new_banner);			
            //$this->load->view($new_sidebar);			
            $this->load->view($new_body);			
            //$this->load->view($new_footer);			
        } else {
            //echo "\nValidated successfully.";
            //echo "<pre>";
            //print_r($data);
            //echo "</pre>";
            $this->load->model('mindiv_wdb');
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_problem") {
                // New diagnosis record
                $ins_procedure_array   =   array();
                $ins_procedure_array['staff_id']            = $this->session->userdata('staff_id');
                $ins_procedure_array['now_id']              = $data['now_id'];
                $ins_procedure_array['problem_list_id']            = $data['now_id'];
                $ins_procedure_array['patient_id']          = $data['patient_id'];
                $ins_procedure_array['date']               = $data['init_record_date'];
                $ins_procedure_array['problem']               = $data['init_problem'];
                if($data['offline_mode']){
                    $ins_procedure_array['synch_out']        = $data['now_id'];
                }
	            $ins_procedure_data       =   $this->mindiv_wdb->insert_new_problem_list($ins_procedure_array);
                $this->session->set_flashdata('data_activity', 'Problem added.');
            } elseif($data['form_purpose'] == "edit_problem") {
                // Existing diagnosis record
                $upd_procedure_array   =   array();
                $upd_procedure_array['staff_id']            = $this->session->userdata('staff_id');
                $upd_procedure_array['now_id']              = $data['now_id'];
                $upd_procedure_array['order_id']            = $data['order_id'];
                $upd_procedure_array['patient_id']          = $data['patient_id'];
                $upd_procedure_array['session_id']          = $data['summary_id'];
                if($data['offline_mode']){
                    $upd_procedure_array['synch_out']        = $data['now_id'];
                }
	            $upd_imaging_data       =   $this->morders_procedure_wdb->update_procedure_order($upd_procedure_array);
                $this->session->set_flashdata('data_activity', 'Problem updated.');
            } //endif($data['form_purpose'] == "new_imaging")
            $new_page = base_url()."index.php/indv/indv/index/indv_history/ehr_indvhist_problemlist/list_problem_list/list_problems/".$data['patient_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_imaging_order') == FALSE)
    } // end of function edit_problem_list()


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

/* End of file Ehr_indvhist_problemlist.php */
/* Location: ./app_thirra/controllers/Ehr_indvhist_problemlist.php */
