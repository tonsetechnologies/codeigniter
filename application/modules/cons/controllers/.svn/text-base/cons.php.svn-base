<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * Portions created by the Initial Developer are Copyright (C) 2011 - 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */


class Cons extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->helper('form');
        $data['app_language']		    =	$this->config->item('app_language');
	  	//$this->load->model('mpatients');
        //$this->lang->load('emr', 'nepali');
        //$this->lang->load('emr', 'ceylonese');
        //$this->lang->load('emr', 'malay');
        $this->lang->load('ehr', $data['app_language']);
		//$this->load->library('form_validation');
        //$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->load->model('memr_rdb');
		//$this->load->model('mehr_wdb');
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
		//if ((! isset($_SESSION['user_acl'])) || ($_SESSION['user_acl'] < 1)){
		if ($this->session->userdata('user_acl') < 1){
            $flash_message  =   "Session Expired.";
            $new_page   =   base_url()."index.php/thirra/";
            header("Status: 200");
            header("Location: ".$new_page);
        } // redirect to login page

        $data['pics_url']      =    base_url();
        $data['pics_url']      =    substr_replace($data['pics_url'],'',-1);
        //$data['pics_url']      =    substr_replace($data['pics_url'],'',-7);
        $data['pics_url']      =    $data['pics_url']."-uploads/";
        define("PICS_URL", $data['pics_url']);
        
    }


	public function index()
	{
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_name']		    =	$this->config->item('app_name');
        $data['module_name']        =   $this->uri->segment(4);
        $data['module_controller']  =   $this->uri->segment(5);
        $data['module_method']      =   $this->uri->segment(6);
        $data['seg3']               =   $this->uri->segment(7);
        $data['seg4']               =   $this->uri->segment(8);
        $data['seg5']               =   $this->uri->segment(9);
        $data['seg6']               =   $this->uri->segment(10);
        $data['seg7']               =   $this->uri->segment(11);
        $data['seg8']               =   $this->uri->segment(12);
        $data['seg9']               =   $this->uri->segment(13);
		$data['form_purpose']       =   $this->uri->segment(7);
		$data['patient_id']         =   $this->uri->segment(8);
		$data['summary_id']         =   $this->uri->segment(9);
		$data['user_rights'] = $this->mthirra->get_user_rights($this->session->userdata('username'));
		//$data['user_rights'] = $this->mthirra->get_user_rights($_SESSION['username']);
        //$data['sessions'] = $this->session->all_userdata();
		$data['individual_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
		$data['title']              = "Consult - ".$data['individual_info']['name'];
		$data['main'] = 'home';
		$data['acl_menu'] = $this->mthirra->get_user_acl($data['user_rights']['category_id'],'con','menu');
		$data['acl_panel'] = $this->mthirra->get_user_acl($data['user_rights']['category_id'],'con','panel');
		$data['acl_widget'] = $this->mthirra->get_user_acl($data['user_rights']['category_id'],'con','widget');
		$this->load->vars($data);
		//if ($_SESSION['thirra_mode'] == "ehr_mobile"){
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            //$new_body   =   "ehr/ehr_index_html";
            $new_body   =   "ehr/ehr_index_wap";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_conslt_html";
            if($data['form_purpose'] == "new_episode"){
            //if($data['seg6'] == "new_summary"){
                $new_sidebar=   "ehr/sidebar_ehr_patients_consltNoLink_html";
            } else {
                $new_sidebar=   "ehr/sidebar_ehr_patients_conslt_html";
            }
            $new_body   =   "cons_html";
            $new_footer =   "ehr/footer_ehr_html";
		}
		$this->load->view($new_header);			
		$this->load->view($new_banner);			
		$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		$this->load->view($new_footer);			
	}


}

/* End of file Cons.php */
/* Location: ./application/modules/cons/controllers/Cons.php */
