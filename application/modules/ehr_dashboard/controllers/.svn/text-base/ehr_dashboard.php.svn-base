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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

session_start();

/**
 * Controller Class for EHR_ADMIN
 *
 * This class is used for both narrowband and broadband EHR. 
 *
 * @version 0.9.15
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_dashboard extends MX_Controller 
{
    protected $_offline_mode    =  FALSE;
    //protected $_offline_mode    =  TRUE;
    protected $_debug_mode      =  FALSE;
    //protected $_debug_mode      =  TRUE;


    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->helper('form');
		//$this->load->library('form_validation');
        //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->load->model('memr_rdb');
		$this->load->model('mrefer_rdb');
		//$this->load->model('ehr_dashboard/edb_mqueue_rdb');
		$this->load->model('madmin_rdb');
        
        $this->pretend_phone	=	FALSE;
        //$this->pretend_phone	=	TRUE;  // Turn this On to overwrites actual device
        $data['debug_mode']		=	TRUE;
        if($data['debug_mode'] == TRUE) {
            // spaghetti html
        } else {
            header('Content-type: application/xhtml+xml'); 
        }

        // Redirect back to login page if not authenticated
		//if ((! isset($this->session->userdata('user_acl'))) || ($this->session->userdata('user_acl') < 1)){
		if ($this->session->userdata('user_acl') < 1){
            $flash_message  =   "Session Expired.";
            $new_page   =   base_url()."index.php/thirra";
            header("Status: 200");
            header("Location: ".$new_page);
        } // redirect to login page

    }


    // ------------------------------------------------------------------------
    // === DASHBOARDS
    // ------------------------------------------------------------------------
    /**
     * User Dash Board for EHR
     *
     * @author  Jason Tan Boon Teck
     */
	function index() // Dashboard
    {	
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$this->load->model('mqueue_rdb');
		$this->load->model('morders_rdb');

        //----------------
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['now_time']           =   date("H:i",$data['now_id']);
        $data['location_id']   =   $this->session->userdata('location_id');//$_SESSION['location_id'];
		$data['queue_info'] = $this->mqueue_rdb->get_patients_queue($data['location_id'],$data['now_date']);
		$data['postcon_info'] = $this->mqueue_rdb->get_postconsultation_queue($data['now_date']);
		$data['lab_orders'] = $this->morders_rdb->get_list_labresult('Received','data','sample_date',100,0,$data['location_id']);
		$data['incoming_referrals'] = $this->mrefer_rdb->get_incoming_referrals($data['location_id']); // Old style
		//$data['incoming_referrals'] = $this->mrefer_rdb->get_incoming_referrals_staged($data['location_id']);
		$data['open_episodes'] = $this->madmin_rdb->get_unsynched_episodes('ALL','Open');
        if($data['debug_mode']){
            $this->output->enable_profiler(TRUE);  
        }
		$this->load->vars($data);
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            //$new_body   =   "ehr/ehr_index_html";
            $new_body   =   "ehr/ehr_dashboard_wap";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "header_xhtml1-transitional";
            $new_banner =   "banner_ehr_html";
            $new_body   =   "ehr_dashboard_html";
            $new_footer =   "footer_emr_html";
		}
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);			
	} // end of function index()



}

/* End of file emr.php */
/* Location: ./app_thirra/controllers/emr.php */
