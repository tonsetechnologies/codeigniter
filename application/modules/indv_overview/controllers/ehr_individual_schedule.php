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
 * Controller Class for EHR_INDIVIDUAL
 *
 * This class is used for both narrowband and broadband EHR. 
 *
 * @version 0.9.14
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_individual_schedule extends MX_Controller 
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
		$this->load->model('memr_rdb');
		$this->load->model('mehr_wdb');
		$this->load->model('mthirra');
		$this->load->model('mqueue_rdb');
		$this->load->model('mqueue_wdb');

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
        /* Defined in indv.php
        $data['pics_url']      =    base_url();
        $data['pics_url']      =    substr_replace($data['pics_url'],'',-1);
        //$data['pics_url']      =    substr_replace($data['pics_url'],'',-7);
        $data['pics_url']      =    $data['pics_url']."-uploads/";
        define("PICS_URL", $data['pics_url']);
        */
    }


    // ------------------------------------------------------------------------
    // === INDIVIDUAL RECORD
    // ------------------------------------------------------------------------
    /**
     * Patient Overview Sheet
     *
     * @author  Jason Tan Boon Teck
     */
    function indv_edit_queue($seg3,$seg4,$seg5)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr_queue/queue_mgt','Queue');    
        $data['location_id']        =   $this->session->userdata('location_id');
		$data['title'] = 'Add/Edit Queue';
		$data['form_purpose']   = $seg3; //$form_purpose;//$this->uri->segment(9);
        $data['patient_id']     = $seg4; //$patient_id;//$this->uri->segment(10);
        $data['booking_id']     = $seg5; //$booking_id;//$this->uri->segment(11);
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['now_time']           =   date("H:i",$data['now_id']);
		//$data['clinic_info']    = $this->mbio->get_clinic_info($this->session->userdata('location_id'));
        
        if(count($_POST)) {
            // User has posted the form
            //$data['now_id']                   =   $_POST['now_id'];
            //$data['now_date']                 =   date("Y-m-d",$data['now_id']);
            $data['init_location_id']           =   $this->session->userdata('location_id');
            $data['form_purpose']      	        =   $this->input->post('form_purpose');
            $data['init_booking_id']      	    =   $this->input->post('booking_id');
            $data['booking_id']                 =   $data['init_booking_id'];
            $data['init_room_id']      	        =   $this->input->post('room_id');
            $data['init_staff_id']      	    =   $this->input->post('staff_id');
            $data['init_queue_date']      	    =   $this->input->post('queue_date');
            $data['init_start_time']      	    =   $this->input->post('start_time');
            $data['init_remarks']      	        =   $this->input->post('remarks');
            $data['init_priority']      	    =   $this->input->post('priority');
            $data['init_external_ref']      	=   $this->input->post('external_ref');
            $data['init_canceled_reason']      	=   $this->input->post('canceled_reason');
           if(isset($_POST['patient_id'])) {
                $data['init_patient_id']      	    =   $this->input->post('patient_id');
            } else {
                $data['init_patient_id']          = "";
            }
            if ($data['form_purpose'] == "new_queue") {            
                $data['patients_list'] = $this->memr_rdb->get_patients_list($data['location_id']);
            }
            $data['patient_id']               =   $data['init_patient_id'];
            if ($data['booking_id'] == "new_queue"){
                // New form
		        //$data['patient_id']         = "";
          		$data['save_attempt']       = 'ADD TO QUEUE';
            } //endif ($data['booking_id'] == "new_queue")
            /*
            } else {
                // Edit form
          		$data['save_attempt']       = 'EDIT QUEUE';
                // These fields were passed through as hidden tags
                //$data['patient_id']         =   $data['init_patient_id']; //came from POST
                //$data['init_patient_id']    =   $data['patient_info']['patient_id'];
            } //endif ($data['booking_id'] == "new_queue")
            */
        } else {
            // First time form is displayed
            $data['init_clinic_name']   =   NULL;
            $data['booking_id']         = $seg5; //$booking_id;//$this->uri->segment(5);
            $data['patient_info'] = $this->memr_rdb->get_patient_demo($data['patient_id']);

            if ($data['form_purpose'] == "new_queue") {
                // New vitals
          		$data['save_attempt']            =   'ADD TO QUEUE';
		        //$data['patient_info']       = array();
                //$data['init_booking_id']          =   "";
                //$data['booking_id']               =   "";
                $data['init_room_id']             =   "";
                $data['init_staff_id']            =   "";
                $data['init_reserve_date']        =   "";
                $data['init_reserve_time']        =   "";
                $data['init_jqqueue_date']          =   "10/20/2010";
                $data['init_queue_date']          =   $data['now_date'];
                $data['init_start_time']          =   $data['now_time'];
                $data['init_end_time']            =   "";
                $data['init_remarks']             =   "";
                $data['init_priority']            =   "";
                $data['init_canceled_reason']     =   "";
                $data['init_external_ref']        =   "";
                $data['init_name']                =   "";
                $data['init_gender']              =   "";
                $data['init_birth_date']          =   "";
                if($data['patient_id'] == "patient_id") {
                    $data['patient_scope'] 		= $data['location_id'];
                    $data['list_sort'] 			= "name";
                    $data['alphabet'] 			= "All";
                    $data['patients_list'] = $this->memr_rdb->get_patients_list($data['location_id'],$data['list_sort'],NULL,$data['alphabet']);
                    $data['patient_id'] = "";
                } else {
                    $data['patients_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
                    $data['init_name']         = $data['patients_info']['patient_name'];
                    $data['init_name_first']   = $data['patients_info']['name_first'];
                    $data['init_gender']       = $data['patients_info']['gender'];
                    $data['init_birth_date']   = $data['patients_info']['birth_date'];
               }
            } else {
                // Editing queue
          		$data['save_attempt'] = 'EDIT QUEUE';
                $data['init_patient_id']   = $data['patient_id'];
                $data['queue_info'] = $this->mqueue_rdb->get_patients_queue($data['location_id'],"any",$data['booking_id']);
                $data['init_room_id']      = $data['queue_info'][0]['room_id'];
                $data['init_staff_id']     = $data['queue_info'][0]['staff_id'];
                $data['init_queue_date']   = $data['queue_info'][0]['date'];
                $data['init_start_time']   = $data['queue_info'][0]['start_time'];
                $data['init_end_time']     = $data['queue_info'][0]['end_time'];
                $data['init_remarks']      = $data['queue_info'][0]['remarks'];
                $data['init_booking_type'] = $data['queue_info'][0]['booking_type'];
                $data['init_priority']     = $data['queue_info'][0]['priority'];
                $data['init_status']       = $data['queue_info'][0]['status'];
                $data['init_canceled_reason']= $data['queue_info'][0]['canceled_reason'];
                $data['init_previous_session_id']= $data['queue_info'][0]['previous_session_id'];
                $data['init_external_ref'] = $data['queue_info'][0]['external_ref'];
                $data['init_name']         = $data['queue_info'][0]['name'];
                $data['init_name_first']   = $data['queue_info'][0]['name_first'];
                $data['init_gender']       = $data['queue_info'][0]['gender'];
                $data['init_birth_date']   = $data['queue_info'][0]['birth_date'];
            } //endif ($data['form_purpose'] == "new_queue")
        } //endif(count($_POST))
        //$data['staff_list'] = $this->madmin_rdb->get_staff_list("doctor");
        $data['staff_list'] = $this->mqueue_rdb->get_consultants_list($data['location_id'],"doctor");
        $data['rooms_list'] = $this->mqueue_rdb->get_rooms_list($data['location_id']);
        $data['queue_list']     = $this->mqueue_rdb->get_patients_queue(NULL,NULL,NULL,$data['patient_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_queue') == FALSE){
		    //$this->load->view('emr/emr_edit_patient_html');			
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_queue_wap";
                //$new_body   =   "ehr/emr_queue_edit_queue_wap";
                $new_body   =   "ehr/ehr_indv_edit_queue_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_queue_html";
                $new_body   =   "ehr_indv_edit_queue_html";
                $new_footer =   "ehr/footer_emr_html";
            }
            if($data['user_rights']['section_queue'] < 100){
                $new_body   =   "ehr/ehr_access_denied_html";
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
            //echo "<br />Insert record";
            if($data['booking_id'] == "new_queue") {
                // New patient record
                $ins_queue_array   =   array();
                $ins_queue_array['now_id']          = $data['now_id'];
                $ins_queue_array['booking_id']      = $data['now_id'];
                $ins_queue_array['room_id']         = $data['init_room_id'];
                $ins_queue_array['staff_id']        = $data['init_staff_id'];
                $ins_queue_array['booking_staff_id']= $this->session->userdata('staff_id');
                $ins_queue_array['patient_id']      = $data['init_patient_id'];
                $ins_queue_array['reserve_date']    = $data['now_date'];
                $ins_queue_array['reserve_time']    = $data['now_time'];
                $ins_queue_array['date']            = $data['init_queue_date'];
                $ins_queue_array['start_time']      = $data['init_start_time'];
                // OSM To COMPUTE end time
                $ins_queue_array['end_time']        = $data['init_start_time'];
                $ins_queue_array['remarks']         = $data['init_remarks'];
                $ins_queue_array['booking_type']    = "External";
                $ins_queue_array['priority']        = $data['init_priority'];
                $ins_queue_array['status']          = "Pending";
                $ins_queue_array['external_ref']    = $data['init_external_ref'];
	            $ins_queue_data       =   $this->mqueue_wdb->insert_new_booking($ins_queue_array);
                $this->session->set_flashdata('data_activity', 'Patient added to queue.');
            } else {
                // Edit patient queue
                $ins_queue_array   =   array();
                $ins_queue_array['now_id']          = $data['now_id'];
                $ins_queue_array['booking_id']      = $data['booking_id'];
                $ins_queue_array['room_id']         = $data['init_room_id'];
                $ins_queue_array['staff_id']        = $data['init_staff_id'];
                $ins_queue_array['booking_staff_id']= $this->session->userdata('staff_id');
                $ins_queue_array['patient_id']      = $data['init_patient_id'];
                $ins_queue_array['reserve_date']    = $data['now_date'];
                $ins_queue_array['reserve_time']    = $data['now_time'];
                $ins_queue_array['date']            = $data['init_queue_date'];
                $ins_queue_array['start_time']      = $data['init_start_time'];
                // OSM To COMPUTE end time
                $ins_queue_array['end_time']        = $data['init_start_time'];
                $ins_queue_array['remarks']         = $data['init_remarks'];
                $ins_queue_array['booking_type']    = "External";
                $ins_queue_array['priority']        = $data['init_priority'];
                if(empty($data['init_canceled_reason'])){
                    $ins_queue_array['status']          = "Pending";
                } else {
                    $ins_queue_array['status']          = "Cancelled";
                    $ins_queue_array['canceled_reason']        = $data['now_date']." ".$_SESSION['username'].":".$data['init_canceled_reason'];
                } //endif(empty($data['init_canceled_reason']))
                $ins_queue_array['external_ref']    = $data['init_external_ref'];
	            $ins_queue_data       =   $this->mqueue_wdb->update_booking($ins_queue_array);
                $this->session->set_flashdata('data_activity', 'Patient queue updated.');
            } //endif($data['patient_id'] == "new_queue")
            $new_page = base_url()."index.php/indv/indv/index/indv_overview/ehr_individual/individual_overview/overview/".trim($data['patient_id']);
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_vitals') == FALSE)
		//$this->load->view('bio/bio_new_case_hosp');
    } //end of function queue_edit_queue()



}

/* End of file emr.php */
/* Location: ./app_thirra/controllers/emr.php */
