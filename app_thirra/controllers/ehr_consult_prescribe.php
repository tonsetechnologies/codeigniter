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

session_start();

/**
 * Controller Class for EHR_CONSULT_PRESCRIBE
 *
 * This class is used for both narrowband and broadband EHR. 
 *
 * @version 0.9.12
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_consult_prescribe extends MY_Controller 
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
		$this->load->model('mconsult_wdb');
		//$this->load->model('mehr_wdb');
        
        $this->pretend_phone	=	FALSE;
        //$this->pretend_phone	=	TRUE;  // Turn this On to overwrites actual device
        $data['debug_mode']		=	TRUE;
        if($data['debug_mode'] == TRUE) {
            // spaghetti html
        } else {
            header('Content-type: application/xhtml+xml'); 
        }

        // Redirect back to login page if not authenticated
		if ((! isset($_SESSION['user_acl'])) || ($_SESSION['user_acl'] < 1)){
            $flash_message  =   "Session Expired.";
            $new_page   =   base_url()."index.php/thirra";
            header("Status: 200");
            header("Location: ".$new_page);
        } // redirect to login page

        /*
        $data['pics_url']      =    base_url();
        $data['pics_url']      =    substr_replace($data['pics_url'],'',-1);
        $data['pics_url']      =    $data['pics_url']."uploads/";
        define("PICS_URL", $data['pics_url']);
        */
        $data['pics_url']      =    base_url();
        $data['pics_url']      =    substr_replace($data['pics_url'],'',-1);
        //$data['pics_url']      =    substr_replace($data['pics_url'],'',-7);
        $data['pics_url']      =    $data['pics_url']."-uploads/";
        define("PICS_URL", $data['pics_url']);
    }


    // ------------------------------------------------------------------------
    // === PATIENT CONSULTATION - PRESCRIBING
    // ------------------------------------------------------------------------
    // Categorised prescription form
    function edit_prescription()
    {
		$this->load->model('mutil_rdb');
		$this->load->model('mpharma_rdb');
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['error_messages'] =   array();
        $data['error_messages']['severity'] =   NULL;        
        $data['error_messages']['msg']      =   NULL;        
		//$this->load->library('form_validation');
        //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	  	
        if(count($_POST)) {
            // User has posted the form
            if(isset($_POST['drug_system'])) { 
                $data['drug_system']   =   $_POST['drug_system'];
            }
            //if(isset($_POST['ajax_drug_formulary_id'])) { 
            if(isset($_POST['drug_formulary_id'])) { 
                $data['drug_formulary_id']   =   $_POST['drug_formulary_id'];
                //$data['drug_formulary_id']   =   $_POST['ajax_drug_formulary_id'];
            } else {
                $data['drug_formulary_id']   =   "none";
            }
            if(isset($_POST['drug_code_id'])) { 
                $data['drug_code_id']   =   $_POST['drug_code_id'];
            } else {
                $data['drug_code_id']   =   "none";
            }
            if(isset($_POST['drug_batch'])) { 
                $data['drug_batch']   =   $_POST['drug_batch'];
            } else {
                $data['drug_batch']   =   "none";
            }
            $data['form_purpose']   = $_POST['form_purpose'];
            $data['now_id']         = $_POST['now_id'];
            $data['patient_id']     = $_POST['patient_id'];
            $data['summary_id']     = $_POST['summary_id'];
            $data['prescribe_id']   = $_POST['prescribe_id'];
            $data['dose']           = $_POST['dose'];
            $data['dose_form']      = $_POST['dose_form'];
            $data['frequency']      = $_POST['frequency'];
            $data['indication']  =   $this->input->post('indication');
            $data['instruction']    = $_POST['instruction'];
            $data['instruction_other']  =   $this->input->post('instruction_other');
            if(!empty($data['instruction_other'])){
                $data['instruction']  =   $data['instruction_other'];
            }
            $data['dose_duration']       = $_POST['dose_duration'];
            $data['quantity']       = $_POST['quantity'];
            $data['caution']  =   $this->input->post('caution');
        } else {
            // First time form is displayed
            $data['form_purpose']   = $this->uri->segment(3);
            $data['patient_id']     = $this->uri->segment(4);
            $data['summary_id']     = $this->uri->segment(5);
            $data['prescribe_id']   = $this->uri->segment(6);
            $patient_id             =   $this->uri->segment(4);
            $data['patient_id']     =   $patient_id;
            $data['now_id']             =   time();
            $data['now_date']           =   date("Y-m-d",$data['now_id']);
            if ($data['form_purpose'] == "new_prescribe") {
                //echo "New prescription";
                $data['prescribe_id']       =   $data['now_id'];
                $data['drug_system']        =   "";
                $data['drug_formulary_id']  =   "";
                $data['drug_code_id']       =   "";
                $data['drug_batch']         =   "";
                $data['dose']               =   "";
                $data['dose_form']          =   "";
                $data['frequency']          =   "";
                $data['instruction']        =   "";
                $data['dose_duration']      =   "";
                $data['quantity']           =   "";
                $data['indication']         =   "";
                $data['caution']            =   "";
            } elseif ($data['form_purpose'] == "edit_prescribe") {
                //echo "Edit prescription";
                $data['prescribe_info'] = $this->memr_rdb->get_patcon_prescribe($data['summary_id'],$data['prescribe_id']);
                $data['drug_system']        =   $data['prescribe_info'][1]['formulary_system'];
                $data['drug_formulary_id']  =   $data['prescribe_info'][1]['drug_formulary_id'];
                $data['generic_name']       =   $data['prescribe_info'][1]['generic_name'];
                $data['drug_code_id']       =   $data['prescribe_info'][1]['drug_code_id'];
                $data['drug_batch']         =   "";
                $data['dose']               =   $data['prescribe_info'][1]['dose'];
                $data['dose_form']          =   $data['prescribe_info'][1]['dose_form'];
                $data['frequency']          =   $data['prescribe_info'][1]['frequency'];
                $data['instruction']        =   $data['prescribe_info'][1]['instruction'];
                $data['dose_duration']      =   $data['prescribe_info'][1]['dose_duration'];
                $data['quantity']           =   $data['prescribe_info'][1]['quantity'];
                $data['indication']         =   $data['prescribe_info'][1]['indication'];
                $data['caution']            =   $data['prescribe_info'][1]['caution'];
            } //endif ($data['form_purpose'] == "new_prescribe")
        } //endif(count($_POST))
		$data['title'] = "Prescription";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id']);
        $data['prescribe_list'] = $this->memr_rdb->get_patcon_prescribe($data['summary_id']);
        $data['init_location_id']   =   $_SESSION['location_id'];
        $data['init_clinic_name']   =   NULL;
        //$data['init_patient_id']    =   $patient_id;

        $data['drug_systems'] = $this->mpharma_rdb->get_drug_system();
		$data['formulary_list'] = $this->mpharma_rdb->get_formulary_by_system($data['drug_system']);
        
		$data['allergy_list']   = $this->memr_rdb->get_drug_allergies('List',$data['patient_id']);
        if(isset($data['drug_formulary_id'])){
		    $data['tradename_list'] = $this->mpharma_rdb->get_tradename_by_formulary($data['drug_formulary_id']);
            $data['formulary_chosen'] = $this->mpharma_rdb->get_one_drug_formulary($data['drug_formulary_id']);
            if(count($data['formulary_chosen'])>0){
                // Check for allergy
                if(count($data['allergy_list'])>0){
                    foreach($data['allergy_list'] as $allergic_drug){
                        if(in_array($data['formulary_chosen']['atc_code'],$allergic_drug)){
                            $data['error_messages']['severity'] =   "DRUG ALLERGY: ";        
                            $data['error_messages']['msg']      =   "Possible reaction";        
                        }
                    }
                } // endif(count($data['allergy_list'])>0)
                // Has user selected tradename?
                if(isset($data['drug_code_id'])){
                    $data['tradename_chosen'] = $this->memr_rdb->get_one_drug_tradename($data['drug_code_id']);
                } //endif(isset($data['drug_code_id']))
                // See if can find dose form
                
            } // endif(count($data['formulary_chosen'])>0)
        } else {
        /*
        if(isset($data['drug_formulary_id'])){
		    $data['tradename_list'] = $this->mpharma_rdb->get_tradename_by_formulary($data['drug_formulary_id']);
            $data['formulary_chosen'] = $this->mpharma_rdb->get_one_drug_formulary($data['drug_formulary_id']);
        } else {
        */
            $data['tradename_list'] = array();
        } //endif(isset($data['drug_formulary_id']))
        if(isset($data['c'])){
            $data['batch_list'] = array();
        } else {
            $data['batch_list'] = array();
        } //endif(isset($data['c']))

		$data['dose_forms']     = $this->mutil_rdb->get_package_forms();
		$data['dose_frequency'] = $this->mutil_rdb->get_drug_frequency();

        if($data['debug_mode']){
            $this->output->enable_profiler(TRUE);  
        }
        
		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_prescribe') == FALSE){
		    //$this->load->view('ehr_patient/emr_edit_patient_html');			
            if ($_SESSION['thirra_mode'] == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_conslt_wap";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_wap";
                //$new_body   =   "ehr/emr_edit_prescription_wap";
                $new_body   =   "ehr/ehr_edit_prescription_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_conslt_html";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_html";
                $new_body   =   "ehr/ehr_edit_prescription_html";
                $new_footer =   "ehr/footer_emr_html";
            }
            $this->load->view($new_header);			
            $this->load->view($new_banner);			
            $this->load->view($new_sidebar);			
            $this->load->view($new_body);			
            $this->load->view($new_footer);			
        } else {
            //echo "\nValidated successfully.";
            //echo "<pre>";
            //print_r($data);
            //echo "</pre>";
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_prescribe") {
                // New prescription record
                $ins_prescribe_array   =   array();
                $ins_prescribe_array['staff_id']         = $_SESSION['staff_id'];
                $ins_prescribe_array['now_id']           = $data['now_id'];
                $ins_prescribe_array['prescribe_id']     = $data['now_id'];
                $ins_prescribe_array['patient_id']       = $data['patient_id'];
                $ins_prescribe_array['session_id']       = $data['summary_id'];
                $ins_prescribe_array['drug_formulary_id']= $data['drug_formulary_id'];
                $ins_prescribe_array['dose']             = $data['dose'];
                $ins_prescribe_array['dose_form']        = $data['dose_form'];
                $ins_prescribe_array['frequency']        = $data['frequency'];
                $ins_prescribe_array['instruction']      = $data['instruction'];
                if(is_numeric($data['dose_duration'])){
                    $ins_prescribe_array['dose_duration']= $data['dose_duration'];
                }
                $ins_prescribe_array['quantity']         = $data['quantity'];
                $ins_prescribe_array['quantity_form']    = $data['dose_form'];
                $ins_prescribe_array['indication']       = $data['indication'];
                $ins_prescribe_array['caution']          = $data['caution'];
                $ins_prescribe_array['status']           = "Unconfirmed";//$data['remarks'];
                if($data['offline_mode']){
                    $ins_prescribe_array['synch_out']        = $data['now_id'];
                }
                $ins_prescribe_array['generic_drugname'] = $data['formulary_chosen']['generic_name'];
                $ins_prescribe_array['drug_tradename']   = $data['tradename_chosen']['trade_name'];
                $ins_prescribe_array['drug_code_id']     = $data['drug_code_id'];
	            $ins_prescribe_data       =   $this->mconsult_wdb->insert_new_prescribe($ins_prescribe_array);
                $this->session->set_flashdata('data_activity', 'Prescription added.');
            } elseif($data['form_purpose'] == "edit_prescribe") {
                // Existing prescription record
                $upd_prescribe_array   =   array();
                $upd_prescribe_array['staff_id']        = $_SESSION['staff_id'];
                $upd_prescribe_array['now_id']          = $data['now_id'];
                $upd_prescribe_array['queue_id']        = $data['prescribe_id'];
                $upd_prescribe_array['patient_id']      = $data['patient_id'];
                $upd_prescribe_array['session_id']      = $data['summary_id'];
                $upd_prescribe_array['drug_formulary_id']= $data['drug_formulary_id'];
                $upd_prescribe_array['dose']            = $data['dose'];
                $upd_prescribe_array['dose_form']       = $data['dose_form'];
                $upd_prescribe_array['frequency']       = $data['frequency'];
                $upd_prescribe_array['instruction']     = $data['instruction'];
                if(is_numeric($data['dose_duration'])){
                    $upd_prescribe_array['dose_duration']= $data['dose_duration'];
                }
                $upd_prescribe_array['quantity']        = $data['quantity'];
                $upd_prescribe_array['quantity_form']   = $data['dose_form'];
                $upd_prescribe_array['indication']      = $data['indication'];
                $upd_prescribe_array['caution']         = $data['caution'];
                $upd_prescribe_array['status']          = "Unconfirmed";//$data['remarks'];
                $upd_prescribe_array['drug_code_id']     = $data['drug_code_id']; 
	            $upd_prescribe_data       =   $this->mconsult_wdb->update_prescription($upd_prescribe_array);
                $this->session->set_flashdata('data_activity', 'Prescription updated.');
            } //endif($data['form_purpose'] == "new_prescribe")
            $new_page = base_url()."index.php/ehr_consult_prescribe/edit_prescription/new_prescribe/".$data['patient_id']."/".$data['summary_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_prescribe') == FALSE)


    } // end of function edit_prescription()


    // ------------------------------------------------------------------------
    // Searchable prescription form
    function edit_prescribe()
    {
		$this->load->model('mutil_rdb');
		$this->load->model('mpharma_rdb');
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['error_messages']     =   array();
        $data['error_messages']['severity'] =   NULL;        
        $data['error_messages']['msg']      =   NULL;        
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['button'] = (isset($_POST['part_form']) ? $_POST['part_form'] : $_POST['submit']);
            $data['form_purpose']    = $_POST['form_purpose'];
            $data['form_id']         = $_POST['form_id'];
            $data['patient_id']      = $_POST['patient_id'];
            $data['summary_id']      = $_POST['summary_id'];
            $data['prescribe_id']   = $_POST['prescribe_id'];
            $data['formulary_term1'] = $_POST['formulary_term1'];
            $data['formulary_term2'] = $_POST['formulary_term2'];
            $data['formulary_pullall']= FALSE;
            $data['drug_formulary_id']       = $_POST['drug_formulary_id'];
            if($data['button'] == "Search"){
                if(strlen($data['formulary_term1'])>2){
                    $data['formulary_filter'] = $this->mpharma_rdb->get_formulary_list($data['formulary_pullall'],$data['formulary_term1'],$data['formulary_term2']);
                } elseif(strlen($data['formulary_term2'])>2){
                    $data['formulary_filter'] = $this->mpharma_rdb->get_formulary_list($data['formulary_pullall'],$data['formulary_term1'],$data['formulary_term2']);
                }
            } //endif($data['button'] == "Search")
            if(isset($_POST['drug_code_id'])) { 
                $data['drug_code_id']   =   $_POST['drug_code_id'];
            } else {
                $data['drug_code_id']   =   "none";
            }
            if(isset($_POST['drug_batch'])) { 
                $data['drug_batch']   =   $_POST['drug_batch'];
            } else {
                $data['drug_batch']   =   "none";
            }
            // Check whether any search result was returned, if searched.
            if(! isset($data['formulary_filter'])){ // If none returned
                $data['formulary_filter']= array();
            } //endif(! isset($data['formulary_filter']))
            $data['dose']           = $_POST['dose'];
            $data['dose_form']      = $_POST['dose_form'];
            $data['frequency']      = $_POST['frequency'];
            $data['indication']     = $_POST['indication'];
            $data['instruction']    = $_POST['instruction'];
            $data['instruction_other']      			=   $this->input->post('instruction_other');
            if(!empty($data['instruction_other'])){
                $data['instruction']  =   $data['instruction_other'];
            }
            $data['dose_duration']       = $_POST['dose_duration'];
            $data['quantity']       = $_POST['quantity'];
            $data['caution']        = $_POST['caution'];
        } else {
            // First time form is displayed
            $data['form_purpose']   = $this->uri->segment(3);
            $data['patient_id']     = $this->uri->segment(4);
            $data['summary_id']     = $this->uri->segment(5);
            $data['queue_id']   = $this->uri->segment(6);
            $data['formulary_term1'] = "none";
            $data['formulary_term2'] = "none";
            $data['formulary_filter']= array();
            $data['init_patient_id']    =   $data['patient_id'];
            $data['button']          = "";
            $data['form_id']         = "";
            if ($data['form_purpose'] == "new_prescribe") {
                //echo "New diagnosis";
                $data['prescribe_id']       =   $data['now_id'];
                $data['drug_formulary_id']          =   "";
                $data['diagnosis2']         =   "";
                $data['dose']               =   "";
                $data['dose_form']          =   "";
                $data['frequency']          =   "";
                $data['instruction']        =   "";
                $data['dose_duration']      =   "";
                $data['quantity']           =   "";
                $data['indication']         =   "";
                $data['caution']            =   "";
            } elseif ($data['form_purpose'] == "edit_prescribe") {
                //echo "Edit prescription";
                $data['prescribe_info'] = $this->memr_rdb->get_patcon_prescribe($data['summary_id'],$data['prescribe_id']);
                $data['drug_system']        =   $data['prescribe_info'][1]['formulary_system'];
                $data['drug_formulary_id']  =   $data['prescribe_info'][1]['drug_formulary_id'];
                $data['generic_name']       =   $data['prescribe_info'][1]['generic_name'];
                $data['drug_code_id']       =   "";
                $data['drug_batch']         =   "";
                $data['dose']               =   $data['prescribe_info'][1]['dose'];
                $data['dose_form']          =   $data['prescribe_info'][1]['dose_form'];
                $data['frequency']          =   $data['prescribe_info'][1]['frequency'];
                $data['instruction']        =   $data['prescribe_info'][1]['instruction'];
                $data['quantity']           =   $data['prescribe_info'][1]['quantity'];
                $data['indication']         =   $data['prescribe_info'][1]['indication'];
                $data['caution']            =   $data['prescribe_info'][1]['caution'];
                /*
                $data['diagnosis_info'] = $this->memr_rdb->get_patcon_diagnosis($data['summary_id'],$data['diagnosis_id']);
                $data['diagnosisChapter']   =   $data['diagnosis_info'][1]['diagnosisChapter'];
                $data['diagnosisCategory']  =   $data['diagnosis_info'][1]['diagnosisCategory'];
                $data['drug_formulary_id']  =   $data['diagnosis_info'][1]['diagnosis'];
                $data['diagnosis2']         =   $data['diagnosis_info'][1]['diagnosis2'];
                */
            } //endif ($data['form_purpose'] == "new_prescribe")
        } //endif(count($_POST))
		$data['title'] = "Prescription";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id']);
        $data['prescribe_list'] = $this->memr_rdb->get_patcon_prescribe($data['summary_id']);
        $data['formulary_common'] = $this->mpharma_rdb->get_common_formulary();
        $data['init_location_id']   =   $_SESSION['location_id'];
        $data['init_clinic_name']   =   NULL;
		$data['allergy_list']   = $this->memr_rdb->get_drug_allergies('List',$data['patient_id']);
        if(isset($data['drug_formulary_id'])){
		    $data['tradename_list'] = $this->mpharma_rdb->get_tradename_by_formulary($data['drug_formulary_id']);
            $data['formulary_chosen'] = $this->mpharma_rdb->get_one_drug_formulary($data['drug_formulary_id']);
            if(count($data['formulary_chosen'])>0){
                if(count($data['allergy_list'])>0){
                    foreach($data['allergy_list'] as $allergic_drug){
                        if(in_array($data['formulary_chosen']['atc_code'],$allergic_drug)){
                            $data['error_messages']['severity'] =   "DRUG ALLERGY: ";        
                            $data['error_messages']['msg']      =   "Possible reaction";        
                        }
                    }
                }
                // Has user selected tradename?
                if(isset($data['drug_code_id'])){
                    $data['tradename_chosen'] = $this->memr_rdb->get_one_drug_tradename($data['drug_code_id']);
                } //endif(isset($data['drug_code_id']))
            } //endif(count($data['formulary_chosen'])>0)
        } else {
            $data['tradename_list'] = array();
        } //endif(isset($data['drug_formulary_id']))
        if(isset($data['drug_code_id'])){
            $data['batch_list'] = array();
        } else {
            $data['batch_list'] = array();
        } //endif(isset($data['c']))

		$data['dose_forms']     = $this->mutil_rdb->get_package_forms();
		$data['dose_frequency'] = $this->mutil_rdb->get_drug_frequency();

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_prescribe') == FALSE){
		    //$this->load->view('ehr_patient/emr_edit_patient_html');			
            if ($_SESSION['thirra_mode'] == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_conslt_wap";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_wap";
                //$new_body   =   "ehr/emr_edit_prescribe_wap";
                $new_body   =   "ehr/ehr_edit_prescribe_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_conslt_html";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_html";
                $new_body   =   "ehr/ehr_edit_prescribe_html";
                $new_footer =   "ehr/footer_emr_html";
            }
            $this->load->view($new_header);			
            $this->load->view($new_banner);			
            $this->load->view($new_sidebar);			
            $this->load->view($new_body);			
            $this->load->view($new_footer);			
        } else {
            //echo "\nValidated successfully.";
            //echo "<pre>";
            //print_r($data);
            //echo "</pre>";
            //echo "<br />Insert record";
                // New prescription record
                $ins_prescribe_array   =   array();
                $ins_prescribe_array['staff_id']         = $_SESSION['staff_id'];
                $ins_prescribe_array['now_id']           = $data['now_id'];
                $ins_prescribe_array['prescribe_id']     = $data['now_id'];
                $ins_prescribe_array['patient_id']       = $data['patient_id'];
                $ins_prescribe_array['session_id']       = $data['summary_id'];
                $ins_prescribe_array['drug_formulary_id']= $data['drug_formulary_id'];
                $ins_prescribe_array['dose']             = $data['dose'];
                $ins_prescribe_array['dose_form']        = $data['dose_form'];
                $ins_prescribe_array['frequency']        = $data['frequency'];
                $ins_prescribe_array['instruction']      = $data['instruction'];
                $ins_prescribe_array['quantity']         = $data['quantity'];
                $ins_prescribe_array['quantity_form']    = $data['dose_form'];
                $ins_prescribe_array['indication']       = $data['indication'];
                $ins_prescribe_array['caution']          = $data['caution'];
                $ins_prescribe_array['status']           = "Unconfirmed";//$data['remarks'];
                if($data['offline_mode']){
                    $ins_prescribe_array['synch_out']        = $data['now_id'];
                }
                if(is_numeric($data['dose_duration'])){
                    $ins_prescribe_array['dose_duration']= $data['dose_duration'];
                }
                $ins_prescribe_array['generic_drugname'] = $data['formulary_chosen']['generic_name'];
                $ins_prescribe_array['drug_tradename']   = $data['tradename_chosen']['trade_name'];
                $ins_prescribe_array['drug_code_id']     = $data['drug_code_id'];
	            $ins_prescribe_data       =   $this->mconsult_wdb->insert_new_prescribe($ins_prescribe_array);
                $this->session->set_flashdata('data_activity', 'Prescription added.');
            $new_page = base_url()."index.php/ehr_consult_prescribe/edit_prescribe/new_prescribe/".$data['patient_id']."/".$data['summary_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_prescribe') == FALSE)

    } // end of function edit_prescribe()


    // ------------------------------------------------------------------------
    function consult_delete_prescription($id=NULL) 
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['patient_id']         =   $this->uri->segment(3);
        $data['summary_id']         =   $this->uri->segment(4);
        $data['queue_id']           =   $this->uri->segment(5);
        
        // Delete records
        $del_rec_array['queue_id']      = $data['queue_id'];
        $del_rec_data =   $this->mconsult_wdb->consult_delete_prescription($del_rec_array);
                $this->session->set_flashdata('data_activity', 'Prescription deleted.');
        $new_page = base_url()."index.php/ehr_consult/consult_episode/".$data['patient_id']."/".$data['summary_id'];
        header("Status: 200");
        header("Location: ".$new_page);
        
    } // end of function consult_delete_prescription($id)


    // ------------------------------------------------------------------------
    function list_drug_packages($id=NULL)  // List drug packages
    {
		$this->load->model('mpharma_rdb');
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['user_rights']        =   $this->mthirra->get_user_rights($_SESSION['username']);
		$data['form_purpose']   = $this->uri->segment(3);
		$data['patient_id']     = $this->uri->segment(4);
		$data['summary_id']     = $this->uri->segment(5);
		$data['title'] = "T H I R R A - List of Drug Packages";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id']);
        $data['packages_list']      = $this->mpharma_rdb->get_drug_package_list();
		$data['allergy_list']   = $this->memr_rdb->get_drug_allergies('List',$data['patient_id']);
        
		$this->load->vars($data);
		if ($_SESSION['thirra_mode'] == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_conslt_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_wap";
            //$new_body   =   "ehr/ehr_edit_immune_select_wap";
            $new_body   =   "ehr/ehr_consult_list_drug_package_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_conslt_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_html";
            $new_body   =   "ehr/ehr_consult_list_drug_package_html";
            $new_footer =   "ehr/footer_emr_html";
		}
        if($data['user_rights']['section_orders'] < 100){
            $new_body   =   "ehr/ehr_access_denied_html";
        }
		$this->load->view($new_header);			
		$this->load->view($new_banner);			
		$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		$this->load->view($new_footer);			
    } // end of function list_drug_packages($id)


    // ------------------------------------------------------------------------
    // phar_edit_drug_package
    function edit_drug_package()
    {
		$this->load->model('mpharma_rdb');
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['user_rights']        =   $this->mthirra->get_user_rights($_SESSION['username']);
        $data['form_purpose']       = $this->uri->segment(3);
        $data['drug_package_id']    = $this->uri->segment(4);
        $data['patient_id']         = $this->uri->segment(5);
		$data['summary_id']         = $this->uri->segment(6);
	  	
        if(count($_POST)) {
            // User has posted the form
            //$data['drug_package_id']        =   $this->input->post('drug_package_id');
            $data['init_package_name']      =   $this->input->post('package_name');
            $data['init_description']       =   $this->input->post('description');
            $data['init_package_code']      =   $this->input->post('package_code');
            $data['init_package_remarks']   =   $this->input->post('package_remarks');
            $data['init_package_sort']      =   $this->input->post('package_sort');
            $data['init_package_active']    =   $this->input->post('package_active');
            $data['init_location_id']       =   $this->input->post('location_id');
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_package") {
                $data['init_package_name']      =   "";
                $data['init_description']       =   "";
                $data['init_package_code']      =   "";
                $data['init_package_remarks']   =   "";
                $data['init_package_sort']      =   "";
                $data['init_package_active']    =   TRUE;
                $data['init_location_id']       =   $_SESSION['location_id'];
            } elseif ($data['form_purpose'] == "edit_package") {
                //echo "Edit package";
                $data['package_info'] = $this->mpharma_rdb->get_drug_package_list($data['drug_package_id']);
                $data['init_package_name']      = $data['package_info'][0]['package_name'];
                $data['init_description']       = $data['package_info'][0]['description'];
                $data['init_package_code']      = $data['package_info'][0]['package_code'];
                $data['init_package_remarks']   = $data['package_info'][0]['package_remarks'];
                $data['init_package_sort']      = $data['package_info'][0]['package_sort'];
                $data['init_package_active']    = $data['package_info'][0]['package_active'];
                $data['init_location_id']       = $data['package_info'][0]['location_id'];
            } //endif ($data['form_purpose'] == "new_package")
        } //endif(count($_POST))
        $data['drugs_list']      = $this->mpharma_rdb->get_drug_package_list();
		$data['title'] = "Add/Edit Drug Package";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id']);
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['contents_list']  = $this->mpharma_rdb->get_drug_package_contents($data['drug_package_id']);
        $data['prescribe_list'] = $this->memr_rdb->get_patcon_prescribe($data['summary_id']);
		$data['allergy_list']   = $this->memr_rdb->get_drug_allergies('List',$data['patient_id']);
        
		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_drug_package') == FALSE){
		    //$this->load->view('emr/emr_edit_patient_html');			
		if ($_SESSION['thirra_mode'] == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_conslt_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_wap";
            //$new_body   =   "ehr/ehr_edit_immune_select_wap";
            $new_body   =   "ehr/ehr_edit_drug_package_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_conslt_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_html";
            $new_body   =   "ehr/ehr_edit_drug_package_html";
            $new_footer =   "ehr/footer_emr_html";
		}
            if($data['user_rights']['section_admin'] < 100){
                $new_body   =   "ehr/ehr_access_denied_html";
            }
            $this->load->view($new_header);			
            $this->load->view($new_banner);			
            $this->load->view($new_sidebar);			
            $this->load->view($new_body);			
            $this->load->view($new_footer);			
        } else {
            //echo "\nValidated successfully.";
            //echo "<pre>";
            //print_r($data);
            //echo "</pre>";
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_package") {
                // New package record
                $ins_drug_package   =   array();
                $ins_drug_package['staff_id']       = $_SESSION['staff_id'];
                $ins_drug_package['now_id']         = $data['now_id'];
                $ins_drug_package['drug_package_id']= $data['now_id'];
                $ins_drug_package['package_name']   = $data['init_package_name'];
                $ins_drug_package['description']    = $data['init_description'];
                $ins_drug_package['package_code']   = $data['init_package_code'];
                $ins_drug_package['package_remarks']= $data['init_package_remarks'];
                if(is_numeric($data['init_package_sort'])){
                    $ins_drug_package['package_sort']= $data['init_package_sort'];
                }
                $ins_drug_package['package_active'] = $data['init_package_active'];
                $ins_drug_package['location_id']    = $data['init_location_id'];
	            $drug_package_data       =   $this->mpharma_wdb->insert_new_drug_package($ins_drug_package);
                $this->session->set_flashdata('data_activity', 'Drug package added.');
            } elseif($data['form_purpose'] == "edit_package") {
                // Existing package record
                $upd_drug_package   =   array();
                $upd_drug_package['staff_id']       = $_SESSION['staff_id'];
                $upd_drug_package['now_id']         = $data['now_id'];
                $upd_drug_package['drug_package_id']= $data['drug_package_id'];
                $upd_drug_package['package_name']   = $data['init_package_name'];
                $upd_drug_package['description']    = $data['init_description'];
                $upd_drug_package['package_code']   = $data['init_package_code'];
                $upd_drug_package['package_remarks']= $data['init_package_remarks'];
                if(is_numeric($data['init_package_sort'])){
                    $upd_drug_package['package_sort']= $data['init_package_sort'];
                }
                $upd_drug_package['package_active'] = $data['init_package_active'];
                $upd_drug_package['location_id']    = $data['init_location_id'];
	            $drug_package_data       =   $this->mpharma_wdb->update_drug_package($upd_drug_package);
                $this->session->set_flashdata('data_activity', 'Drug package updated.');
            } //endif($data['diagnosis_id'] == "new_package")
            $new_page = base_url()."index.php/ehr_pharmacy/phar_list_drug_packages";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_referral_centre') == FALSE)


    } // end of function edit_drug_package()


    // ------------------------------------------------------------------------
    // Prescribe drugs in drugs package
    function edit_prescribe_package()
    {
		$this->load->model('mutil_rdb');
		$this->load->model('mpharma_rdb');
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['error_messages']     =   array();
        $data['error_messages']['severity'] =   NULL;        
        $data['error_messages']['msg']      =   NULL;        
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['drugs_count']      =   $this->input->post('drugs_count');
            $data['form_purpose']     =   $this->input->post('form_purpose');
            $data['patient_id']       =   $this->input->post('patient_id');
            $data['summary_id']       =   $this->input->post('summary_id');
            for($i=1; $i <  $data['drugs_count']; $i++) {
                // Did user select the drug to prescribe
                if(isset($_POST['drug_'.$i])){
                    $data['drugs'][$i]['content_id']        =   $this->input->post('drug_'.$i);
                    $data['drugs'][$i]['drug_package_id']   =   $this->input->post('drug_package_id_'.$i);
                    $data['drugs'][$i]  = $this->mpharma_rdb->get_drug_package_contents($data['drugs'][$i]['drug_package_id'],$data['drugs'][$i]['content_id']);
                    $data['drugs'][$i]['content_id']        =   $this->input->post('drug_'.$i);
                    $data['drugs'][$i][0]['dose']           =   $this->input->post('dose_'.$i);
                    $data['drugs'][$i][0]['dose_duration']  =   $this->input->post('dose_duration_'.$i);
                    $data['drugs'][$i][0]['indication']     =   $this->input->post('indication_'.$i);
                    $data['drugs'][$i][0]['quantity']       =   $this->input->post('quantity_'.$i);
                    $data['drugs'][$i][0]['caution']        =   $this->input->post('caution_'.$i);
                } // endif(isset($_POST['drug_'.$i]))
            } // endfor($i=1; $i =<  $data['drugs_count']; $i++)
            //echo "<pre>";
            //print_r($data['drugs']);
            //echo "<pre>";
        } //endif(count($_POST))
		$data['title'] = "Package Prescription";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id']);
        $data['prescribe_list'] = $this->memr_rdb->get_patcon_prescribe($data['summary_id']);
        $data['formulary_common'] = $this->mpharma_rdb->get_common_formulary();
        $data['init_location_id']   =   $_SESSION['location_id'];
        $data['init_clinic_name']   =   NULL;
		$data['allergy_list']       = $this->memr_rdb->get_drug_allergies('List',$data['patient_id']);
        if(isset($data['drug_formulary_id'])){
		    $data['tradename_list'] = $this->mpharma_rdb->get_tradename_by_formulary($data['drug_formulary_id']);
            $data['formulary_chosen'] = $this->mpharma_rdb->get_one_drug_formulary($data['drug_formulary_id']);
            if(count($data['formulary_chosen'])>0){
                if(count($data['allergy_list'])>0){
                    foreach($data['allergy_list'] as $allergic_drug){
                        if(in_array($data['formulary_chosen']['atc_code'],$allergic_drug)){
                            $data['error_messages']['severity'] =   "DRUG ALLERGY: ";        
                            $data['error_messages']['msg']      =   "Possible reaction";        
                        }
                    }
                }
            }
        } else {
            $data['tradename_list'] = array();
        } //endif(isset($data['drug_formulary_id']))
        if(isset($data['drug_code_id'])){
            $data['batch_list'] = array();
        } else {
            $data['batch_list'] = array();
        } //endif(isset($data['c']))

		$data['dose_forms']     = $this->mutil_rdb->get_package_forms();
		$data['dose_frequency'] = $this->mutil_rdb->get_drug_frequency();

		$this->load->vars($data);
        /*
        // Run validation
		if ($this->form_validation->run('edit_prescribe') == FALSE){
		    //$this->load->view('ehr_patient/emr_edit_patient_html');			
            if ($_SESSION['thirra_mode'] == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_conslt_wap";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_wap";
                //$new_body   =   "ehr/emr_edit_prescribe_wap";
                $new_body   =   "ehr/ehr_edit_prescribe_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_conslt_html";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_html";
                $new_body   =   "ehr/ehr_edit_prescribe_html";
                $new_footer =   "ehr/footer_emr_html";
            }
            $this->load->view($new_header);			
            $this->load->view($new_banner);			
            $this->load->view($new_sidebar);			
            $this->load->view($new_body);			
            $this->load->view($new_footer);			
        } else {
            //echo "\nValidated successfully.";
        */
            //echo "<pre>";
            //print_r($data);
            //echo "</pre>";
            //echo "<br />Insert record";
                for($j=1; $j <  $data['drugs_count']; $j++) {
                    // Did user select the drug to prescribe
                    if(isset($_POST['drug_'.$j])){
                        $current_id             =   $data['now_id'] + $j;
                        $ins_prescribe_array   =   array();
                        $ins_prescribe_array['staff_id']         = $_SESSION['staff_id'];
                        $ins_prescribe_array['now_id']           = $current_id;
                        $ins_prescribe_array['prescribe_id']     = $current_id;
                        $ins_prescribe_array['patient_id']       = $data['patient_id'];
                        $ins_prescribe_array['session_id']       = $data['summary_id'];
                        $ins_prescribe_array['drug_formulary_id']= $data['drugs'][$j][0]['drug_formulary_id'];
                        $ins_prescribe_array['dose']             = $data['drugs'][$j][0]['dose'];
                        $ins_prescribe_array['dose_form']        = $data['drugs'][$j][0]['dose_form'];
                        $ins_prescribe_array['frequency']        = $data['drugs'][$j][0]['frequency'];
                        $ins_prescribe_array['instruction']      = $data['drugs'][$j][0]['instruction'];
                        $ins_prescribe_array['quantity']         = $data['drugs'][$j][0]['quantity'];
                        $ins_prescribe_array['quantity_form']    = $data['drugs'][$j][0]['dose_form'];
                        $ins_prescribe_array['indication']       = $data['drugs'][$j][0]['indication'];
                        $ins_prescribe_array['caution']          = $data['drugs'][$j][0]['caution'];
                        $ins_prescribe_array['status']           = "Unconfirmed";//$data['remarks'];
                        if($data['offline_mode']){
                            $ins_prescribe_array['synch_out']        = $current_id;
                        }
                        if(is_numeric($data['drugs'][$j][0]['dose_duration'])){
                            $ins_prescribe_array['dose_duration']= $data['drugs'][$j][0]['dose_duration'];
                        }
                        $ins_prescribe_array['drug_code_id']     = $data['drugs'][$j][0]['drug_code_id']; 
                        $ins_prescribe_data       =   $this->mconsult_wdb->insert_new_prescribe($ins_prescribe_array);
                    } // endif(isset($_POST['drug_'.$i]))
                } // endfor($i=1; $i =<  $data['drugs_count']; $i++)
                // New prescription record
                $this->session->set_flashdata('data_activity', 'Prescription added.');
            $new_page = base_url()."index.php/ehr_consult/consult_episode/".$data['patient_id']."/".$data['summary_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        //} // endif ($this->form_validation->run('edit_prescribe') == FALSE)

    } // end of function edit_prescribe_package()


    // ------------------------------------------------------------------------
    function edit_immune_select($id=NULL)  // patient immunisation
	{
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$this->load->model('mpharma_rdb');
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
		
		// First time form is displayed
		$data['form_purpose']   = $this->uri->segment(3);
		$data['patient_id']     = $this->uri->segment(4);
		$data['summary_id']     = $this->uri->segment(5);
		$data['prescribe_id']   = $this->uri->segment(6);
		$patient_id             =   $this->uri->segment(4);
		$data['patient_id']     =   $patient_id;
		$data['now_id']             =   time();
		$data['now_date']           =   date("Y-m-d",$data['now_id']);
		if ($data['form_purpose'] == "new_immune") {
			//echo "New prescription";
			$data['prescribe_id']       =   $data['now_id'];
			$data['drug_system']        =   "";
			$data['drug_formulary_id']  =   "";
			$data['drug_code_id']       =   "";
			$data['drug_batch']         =   "";
			$data['dose']               =   "";
			$data['dose_form']          =   "";
			$data['frequency']          =   "";
			$data['instruction']        =   "";
			$data['quantity']           =   "";
			$data['indication']         =   "";
			$data['caution']            =   "";
			$data['init_immunisation_id'] = "";
		} elseif ($data['form_purpose'] == "edit_immune") {
			//echo "Edit prescription";
			$data['prescribe_info'] = $this->memr_rdb->get_patcon_prescribe($data['summary_id'],$data['prescribe_id']);
			$data['drug_system']        =   $data['prescribe_info'][1]['formulary_system'];
			$data['drug_formulary_id']  =   $data['prescribe_info'][1]['drug_formulary_id'];
			$data['generic_name']       =   $data['prescribe_info'][1]['generic_name'];
			$data['drug_code_id']       =   "";
			$data['drug_batch']         =   "";
			$data['dose']               =   $data['prescribe_info'][1]['dose'];
			$data['dose_form']          =   $data['prescribe_info'][1]['dose_form'];
			$data['frequency']          =   $data['prescribe_info'][1]['frequency'];
			$data['instruction']        =   $data['prescribe_info'][1]['instruction'];
			$data['quantity']           =   $data['prescribe_info'][1]['quantity'];
			$data['indication']         =   $data['prescribe_info'][1]['indication'];
			$data['caution']            =   $data['prescribe_info'][1]['caution'];
		} //endif ($data['form_purpose'] == "new_prescribe")
		$data['title'] = "Prescribe Immunisation";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id']);
        $data['vaccines_list'] 	= $this->memr_rdb->get_vaccines_list($data['patient_id'],999,0);
        $data['patient_immunisation'] 	= $this->memr_rdb->get_patient_immunisation($data['patient_id'],999,0);
		// This array can be refactored to be automatic
		$data['vaccination_table']	= array(0,1,2,3,4,5,6,12,18,24);		
        $data['prescribe_list'] = $this->memr_rdb->get_patcon_prescribe($data['summary_id']);
        $data['init_location_id']   =   $_SESSION['location_id'];
        $data['init_clinic_name']   =   NULL;
        //$data['init_patient_id']    =   $patient_id;

        //$data['drug_systems'] = $this->memr_rdb->get_drug_system();
        $data['drug_systems'] = array();//$this->memr_rdb->get_drug_system();
        $data['drug_systems'][0]['formulary_system'] = "Immunological Products and Vaccines";
		$data['formulary_list'] = $this->mpharma_rdb->get_formulary_by_vaccine($data['drug_system']);
        if(isset($data['drug_formulary_id'])){
		    $data['tradename_list'] = $this->mpharma_rdb->get_tradename_by_formulary($data['drug_formulary_id']);
            $data['formulary_chosen'] = $this->mpharma_rdb->get_one_drug_formulary($data['drug_formulary_id']);
        } else {
            $data['tradename_list'] = array();
        } //endif(isset($data['drug_formulary_id']))
        if(isset($data['c'])){
            $data['batch_list'] = array();
        } else {
            $data['batch_list'] = array();
        } //endif(isset($data['c']))
		$data['title'] = "T H I R R A - Immunisation";
		$this->load->vars($data);
		
		if ($_SESSION['thirra_mode'] == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_conslt_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_wap";
            //$new_body   =   "ehr/ehr_edit_immune_select_wap";
            $new_body   =   "ehr/ehr_edit_immune_select_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_conslt_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_html";
            $new_body   =   "ehr/ehr_edit_immune_select_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		$this->load->view($new_header);			
		$this->load->view($new_banner);			
		$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		$this->load->view($new_footer);			
    } // end of function edit_select($id)


    // ------------------------------------------------------------------------
    // Categorised prescription form
    function edit_immune_prescribe()
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$this->load->model('mpharma_rdb');
		$data['now_id']             =   time();
		$data['now_date']           =   date("Y-m-d",$data['now_id']);
	  	
        if(count($_POST)) {
            // User has posted the form
            if(isset($_POST['drug_system'])) { 
                $data['drug_system']   =   $_POST['drug_system'];
            }
            if(isset($_POST['drug_formulary_id'])) { 
                $data['drug_formulary_id']   =   $_POST['drug_formulary_id'];
            } else {
                $data['drug_formulary_id']   =   "none";
            }
            if(isset($_POST['drug_code_id'])) { 
                $data['drug_code_id']   =   $_POST['drug_code_id'];
            } else {
                $data['drug_code_id']   =   "none";
            }
            if(isset($_POST['drug_batch'])) { 
                $data['drug_batch']   =   $_POST['drug_batch'];
            } else {
                $data['drug_batch']   =   "none";
            }
            $data['form_purpose']   = $_POST['form_purpose'];
            $data['now_id']         = $_POST['now_id'];
            $data['patient_id']     = $_POST['patient_id'];
            $data['summary_id']     = $_POST['summary_id'];
            $data['vaccine_id']	    = $_POST['vaccine_id'];
            $data['prescribe_id']   = $_POST['prescribe_id'];
            $data['dose']           = $_POST['dose'];
            $data['dose_form']      = $_POST['dose_form'];
            $data['frequency']      = $_POST['frequency'];
            $data['indication']     = $_POST['indication'];
            $data['instruction']    = $_POST['instruction'];
            $data['quantity']       = $_POST['quantity'];
            $data['caution']        = $_POST['caution'];
            $data['vaccine_notes']  = $_POST['vaccine_notes'];
        } else {
            // First time form is displayed
            $data['form_purpose']   = $this->uri->segment(3);
            $data['patient_id']     = $this->uri->segment(4);
            $data['summary_id']     = $this->uri->segment(5);
            $data['vaccine_id']   	= $this->uri->segment(6);
            $patient_id             =   $this->uri->segment(4);
            $data['patient_id']     =   $patient_id;
            if ($data['form_purpose'] == "new_immune") {
                //echo "New prescription";
                $data['prescribe_id']       =   $data['now_id'];
                $data['drug_system']        =   "";
                $data['drug_formulary_id']  =   "";
                $data['drug_code_id']       =   "";
                $data['drug_batch']         =   "";
                $data['dose']               =   "";
                $data['dose_form']          =   "";
                $data['frequency']          =   "";
                $data['instruction']        =   "";
                $data['quantity']           =   "";
                $data['indication']         =   "";
                $data['caution']            =   "";
				$data['vaccine_notes']      =   "";
            } elseif ($data['form_purpose'] == "edit_prescribe") {
                //echo "Edit prescription";
                $data['prescribe_info'] = $this->memr_rdb->get_patcon_prescribe($data['summary_id'],$data['prescribe_id']);
                $data['drug_system']        =   $data['prescribe_info'][1]['formulary_system'];
                $data['drug_formulary_id']  =   $data['prescribe_info'][1]['drug_formulary_id'];
                $data['generic_name']       =   $data['prescribe_info'][1]['generic_name'];
                $data['drug_code_id']       =   "";
                $data['drug_batch']         =   "";
                $data['dose']               =   $data['prescribe_info'][1]['dose'];
                $data['dose_form']          =   $data['prescribe_info'][1]['dose_form'];
                $data['frequency']          =   $data['prescribe_info'][1]['frequency'];
                $data['instruction']        =   $data['prescribe_info'][1]['instruction'];
                $data['quantity']           =   $data['prescribe_info'][1]['quantity'];
                $data['indication']         =   $data['prescribe_info'][1]['indication'];
                $data['caution']            =   $data['prescribe_info'][1]['caution'];
            } //endif ($data['form_purpose'] == "new_prescribe")
        } //endif(count($_POST))
		$data['title'] = "Prescription";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id']);
        $data['prescribe_list'] = $this->memr_rdb->get_patcon_prescribe($data['summary_id']);
        $data['init_location_id']   =   $_SESSION['location_id'];
        $data['init_clinic_name']   =   NULL;
        //$data['init_patient_id']    =   $patient_id;
        $data['this_vaccine'] 	= $this->memr_rdb->get_vaccines_list($data['patient_id'],999,0,$data['vaccine_id']);

        $data['vaccines_list'] 	= $this->memr_rdb->get_vaccines_list($data['patient_id']);
		// This array can be refactored to be automatic
		$data['vaccination_table']	= array(0,1,2,3,4,5,6,12,18,24);		
        //$data['drug_systems'] = $this->memr_rdb->get_drug_system();
		$data['formulary_list'] = $this->mpharma_rdb->get_formulary_by_vaccine($data['vaccine_id']);
        if(isset($data['drug_formulary_id'])){
		    $data['tradename_list'] = $this->mpharma_rdb->get_tradename_by_formulary($data['drug_formulary_id']);
            $data['formulary_chosen'] = $this->mpharma_rdb->get_one_drug_formulary($data['drug_formulary_id']);
        } else {
            $data['tradename_list'] = array();
        } //endif(isset($data['drug_formulary_id']))
        if(isset($data['c'])){
            $data['batch_list'] = array();
        } else {
            $data['batch_list'] = array();
        } //endif(isset($data['c']))
		$data['title'] = "Prescription";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id']);
        $data['prescribe_list'] = $this->memr_rdb->get_patcon_prescribe($data['summary_id']);
        $data['init_location_id']   =   $_SESSION['location_id'];
        $data['init_clinic_name']   =   NULL;
        //$data['init_patient_id']    =   $patient_id;

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_prescribe') == FALSE){
		    //$this->load->view('ehr_patient/emr_edit_patient_html');			
            if ($_SESSION['thirra_mode'] == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_conslt_wap";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_wap";
                //$new_body   =   "ehr/ehr_edit_immune_prescribe_wap";
                $new_body   =   "ehr/ehr_edit_immune_prescribe_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_conslt_html";
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_html";
                $new_body   =   "ehr/ehr_edit_immune_prescribe_html";
                $new_footer =   "ehr/footer_emr_html";
            }
            $this->load->view($new_header);			
            $this->load->view($new_banner);			
            $this->load->view($new_sidebar);			
            $this->load->view($new_body);			
            $this->load->view($new_footer);			
        } else {
            //echo "\nValidated successfully.";
            //echo "<pre>";
            //print_r($data);
            //echo "</pre>";
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_immune") {
                // New prescription record
                $ins_prescribe_array   =   array();
                $ins_prescribe_array['staff_id']         = $_SESSION['staff_id'];
                $ins_prescribe_array['now_id']           = $data['now_id'];
                $ins_prescribe_array['patient_id']       = $data['patient_id'];
                $ins_prescribe_array['patient_immunisation_id']= $data['now_id'];
                $ins_prescribe_array['session_id']       = $data['summary_id'];
                $ins_prescribe_array['prescribe_id']     = $data['now_id'];
                $ins_prescribe_array['immunisation_id']  = $data['vaccine_id'];
                $ins_prescribe_array['vaccine_date']     = $data['now_date'];
                $ins_prescribe_array['drug_formulary_id']= $data['drug_formulary_id'];
                $ins_prescribe_array['drug_code_id']     = $data['drug_code_id'];
                $ins_prescribe_array['dose']             = $data['dose'];
                $ins_prescribe_array['dose_form']        = $data['dose_form'];
                $ins_prescribe_array['frequency']        = $data['frequency'];
                $ins_prescribe_array['instruction']      = $data['instruction'];
                $ins_prescribe_array['quantity']         = $data['quantity'];
                $ins_prescribe_array['quantity_form']    = $data['dose_form'];
                $ins_prescribe_array['indication']       = $data['indication'];
                $ins_prescribe_array['caution']          = $data['caution'];
                $ins_prescribe_array['vaccine_notes']    = $data['vaccine_notes'];
                $ins_prescribe_array['status']           = "Unconfirmed";//$data['remarks'];
                if($data['offline_mode']){
                    $ins_prescribe_array['synch_out']        = $data['now_id'];
                }
	            $ins_prescribe_prescribe       =   $this->mconsult_wdb->insert_new_prescribe($ins_prescribe_array);
	            $ins_prescribe_vaccine       =   $this->mconsult_wdb->insert_new_vaccine($ins_prescribe_array);
            } elseif($data['form_purpose'] == "edit_immune") {
                // Existing prescription record
                $upd_prescribe_array   =   array();
                $upd_prescribe_array['staff_id']        = $_SESSION['staff_id'];
                $upd_prescribe_array['now_id']          = $data['now_id'];
                $upd_prescribe_array['queue_id']        = $data['prescribe_id'];
                $upd_prescribe_array['vaccine_id']      = $data['vaccine_id'];
                $upd_prescribe_array['patient_id']      = $data['patient_id'];
                $upd_prescribe_array['session_id']      = $data['summary_id'];
                $upd_prescribe_array['drug_formulary_id']= $data['drug_formulary_id'];
                $upd_prescribe_array['drug_code_id']    = $data['drug_code_id'];
                $upd_prescribe_array['dose']            = $data['dose'];
                $upd_prescribe_array['dose_form']       = $data['dose_form'];
                $upd_prescribe_array['frequency']       = $data['frequency'];
                $upd_prescribe_array['instruction']     = $data['instruction'];
                $upd_prescribe_array['quantity']        = $data['quantity'];
                $upd_prescribe_array['quantity_form']   = $data['dose_form'];
                $upd_prescribe_array['indication']      = $data['indication'];
                $upd_prescribe_array['caution']         = $data['caution'];
                $upd_prescribe_array['status']          = "Unconfirmed";//$data['remarks'];
	            $upd_prescribe_data       =   $this->mconsult_wdb->update_prescription($upd_prescribe_array);
            } //endif($data['form_purpose'] == "new_prescribe")
            $new_page = base_url()."index.php/ehr_consult_prescribe/edit_immune_select/new_immune/".$data['patient_id']."/".$data['summary_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_prescribe') == FALSE)

    } // end of function edit_immune_prescribe()


    // ------------------------------------------------------------------------
    function break_date($iso_date)  // template for new classes
    {
        $broken_date          =   array();
        $broken_date['yyyy']  =   substr($iso_date,0,4);
        $broken_date['mm']    =   substr($iso_date,5,2);
        $broken_date['dd']    =   substr($iso_date,8,2);
        return $broken_date;
    } // end of function break_date($iso_date)


    // ------------------------------------------------------------------------
	function world($continent = NULL)
	{
		// Set continents data.  In a real application we
		// would obtain this from a database via a model.
		$data['continents'] = array(
				1 => 'Europe',
				2 => 'Africa',
				3 => 'North America',
			);
 
		// If a non-Ajax continent selection is made, call the
		// list_countries method, and set countries data.
		if (isset($continent))
		{
			$data['countries'] = $this->list_countries($continent);
		}
 
		// Load world view.
		$this->load->view('world_view', $data);
	}
 

    // ------------------------------------------------------------------------
    // === TEMPLATES
    // ------------------------------------------------------------------------
    function new_method($id=NULL)  // template for new classes
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['title'] = "T H I R R A - NewPage";
		$this->load->vars($data);
		if ($_SESSION['thirra_mode'] == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_conslt_wap";
            $new_sidebar=   "ehr/sidebar_emr_admin_wap";
            $new_body   =   "ehr/emr_newpage_wap";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/sidebar_ehr_patients_conslt_html";
            $new_sidebar=   "ehr/sidebar_emr_admin_html";
            $new_body   =   "ehr/emr_newpage_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		$this->load->view($new_header);			
		$this->load->view($new_banner);			
		$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		$this->load->view($new_footer);			
    } // end of function new_method($id)


}

/* End of file ehr_consult_prescribe.php */
/* Location: ./app_thirra/controllers/ehr_consult_prescribe.php */
