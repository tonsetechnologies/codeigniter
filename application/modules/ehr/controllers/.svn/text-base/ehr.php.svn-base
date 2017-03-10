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


class Ehr extends MX_Controller {

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
		$this->load->model('madmin_rdb');
        
        $this->pretend_phone	=	FALSE;
        //$this->pretend_phone	=	TRUE;  // Turn this On to overwrites actual device
        $data['debug_mode']		=	TRUE;
        if($data['debug_mode'] == TRUE) {
            // spaghetti html
        } else {
            header('Content-type: application/xhtml+xml'); 
        }
        $user_acl   =   $this->session->userdata('user_acl');
        //echo $user_acl;
        // Redirect back to login page if not authenticated
		if ((empty($user_acl)) || ($user_acl < 1)){
            $flash_message  =   "Session Expired.";
            $new_page   =   base_url()."index.php/thirra";
            header("Status: 200");
            header("Location: ".$new_page);
        } // redirect to login page
        
    }


    // ------------------------------------------------------------------------
    // === MAIN WINDOW
    // ------------------------------------------------------------------------
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
		$data['title'] = $data['app_name']." - Main Window";
		$data['main'] = 'home';
        
        $refresh_seconds        =   30;
        $refresh_ms             =   1000 * $refresh_seconds;
        $data['auto_refresh']   =    "";
        if($data['module_controller'] == "ehr_dashboard"){
            $data['auto_refresh']   =    "onload='timed_refresh(".$refresh_ms.");'";
        }
                
		$data['user_rights'] = $this->mthirra->get_user_rights($this->session->userdata('username'));
		//$data['user_rights'] = $this->mthirra->get_user_rights($_SESSION['username']);
		//$data['user_acl'] = $this->mthirra->get_user_acl($data['user_rights']['category_id'],'ehr','menu');
		$data['acl_menu'] = $this->mthirra->get_user_acl($data['user_rights']['category_id'],'ehr','menu');
		$data['acl_panel'] = $this->mthirra->get_user_acl($data['user_rights']['category_id'],'ehr','panel');
		$data['acl_widget'] = $this->mthirra->get_user_acl($data['user_rights']['category_id'],'ehr','widget');
        //$data['sessions'] = $this->session->all_userdata();
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
            $new_banner =   "ehr/banner_ehr_html";
            $new_body   =   "ehr_html";
            $new_footer =   "ehr/footer_ehr_html";
		}
        switch ($data['seg3']){
            case "edit_param":
                $data['new_banner']     =   "hide";
                $data['new_sidebar']    =   "hide";
            break;
            default:
                $data['new_banner']     =   "";
                $data['new_sidebar']    =   "";
            break;
        }
        // Load the various components of VIEW
		$this->load->view($new_header);			
        if($data['new_banner'] == "hide"){
            // Don't print banner and sidebar 
        } else {
            $this->load->view($new_banner);			
        } //endif($data['new_banner'] == "hide")
        /*
        if($data['new_sidebar'] == "hide"){
            // Don't print banner and sidebar 
        } else {
            $this->load->view($new_sidebar);			
        } //endif($data['new_sidebar'] == "hide")
        */
		$this->load->view($new_body);			
		$this->load->view($new_footer);		
	}


    // Deprecated
	public function ehr_dashboard()
	{
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['title'] = "T H I R R A - Main Page";
		$data['main'] = 'home';
		$data['user_rights'] = $this->mthirra->get_user_rights($this->session->userdata('username'));
		//$data['user_rights'] = $this->mthirra->get_user_rights($_SESSION['username']);
        //$data['sessions'] = $this->session->all_userdata();
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
            $new_banner =   "ehr/banner_ehr_html";
            $new_body   =   "ehr_html";
            $new_footer =   "ehr/footer_emr_html";
		}
        
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
