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
 * Portions created by the Initial Developer are Copyright (C) 2009-2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

session_start();

/**
 * Controller Class for Utilities
 *
 * This class is used for both narrowband and broadband EHR. 
 *
 * @version 0.9.13
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_test extends MX_Controller 
{
    protected $_patient_id      =  "";
    protected $_offline_mode    =  FALSE;
    //protected $_offline_mode    =  TRUE;
    protected $_debug_mode      =  FALSE;
    protected $_drugatc_length      =  7;


    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->helper('form');
        $data['app_language']		    =	$this->config->item('app_language');
        $this->lang->load('ehr', $data['app_language']);
		$this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->load->model('mutil_rdb');
		$this->load->model('mutil_wdb');
		$this->load->model('mtest_rdb');
        
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
    // === UTILITIES MANAGEMENT
    // ------------------------------------------------------------------------
    function entities_mgt($id=NULL)  // template for new classes
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
		$data['title']              = "THIRRA - Utilities Management";
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities/utilities_mgt','Utilities');    
        
        $data['baseurl']            =   base_url();
        $data['exploded_baseurl']   =   explode('/', $data['baseurl'], 4);
        $data['app_folder']         =   substr($data['exploded_baseurl'][3], 0, -1);
        $data['DOCUMENT_ROOT']      =   $_SERVER['DOCUMENT_ROOT'];
        if(substr($data['DOCUMENT_ROOT'],-1) === "/"){
            // Do nothing
        } else {
            // Add a slash
            $data['DOCUMENT_ROOT']  =   $data['DOCUMENT_ROOT'].'/';
        }
        $data['app_path']           =   $data['DOCUMENT_ROOT'].$data['app_folder'];
        $data['directory']          =   $data['app_path']."/application/views";
        $data['changelog_path']     =   $data['app_path']."/docs/views";
		$data['version_file']		=   $data['directory']."/version.php";
        $data['patient_id1']         =   '04041974011120001193890580';
        $data['patient_id2']         =   '04072011241020111319427365';
        $data['clinic_info_id1']     =   '1319425561';
        $data['clinic_info_id2']     =   '1143691352';
        $data['entities_list'] 	= $this->mtest_rdb->get_entities();
        $data['clients_list1'] 	= $this->mtest_rdb->get_entities_per_clinic($data['clinic_info_id1']);
        $data['clients_list2'] 	= $this->mtest_rdb->get_entities_per_clinic($data['clinic_info_id2']);
        $data['entities_patient1'] 	= $this->mtest_rdb->get_entities_per_patient($data['patient_id1']);
        $data['entities_patient2'] 	= $this->mtest_rdb->get_entities_per_patient($data['patient_id2']);

        $this->load->vars($data);
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
            //$new_body   =   "ehr/ehr_utilities_mgt_wap";
            $new_body   =   "ehr_utilities_mgt_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_entities_mgt_html";
            $new_footer =   "ehr/footer_emr_html";
		}
        if($data['user_rights']['section_utilities'] < 100){
            $new_body   =   "ehr/ehr_access_denied_html";
        }
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);			
    } // end of function utilities_mgt($id)




}

/* End of file emr.php */
/* Location: ./app_thirra/controllers/emr.php */
