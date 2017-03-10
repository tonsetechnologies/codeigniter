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
 * Portions created by the Initial Developer are Copyright (C) 2009-2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

session_start();

/**
 * Controller Class for Utilities for Coding and Classifications
 *
 * This class is used for both narrowband and broadband EHR. 
 *
 * @version 0.9.15
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_utilities_codes_procedures extends MX_Controller 
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
    // === UTILITIES MANAGEMENT
    // ------------------------------------------------------------------------
    function util_list_procedure_groups($seg3, $seg4)  // template for new classes
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities');    
        $data['sort_order']   	    =   $seg3; //$this->uri->segment(3);
        //$data['page_num']   	    =   $this->uri->segment(4);
        $data['per_page']           =   '50';
        $data['row_first']   	    =   $seg4; //$this->uri->segment(4);//$data['page_num'] * $data['per_page'];
        if(!is_numeric($data['row_first'])){
             $data['row_first'] =   0;
        }
        
		$data['title'] = "THIRRA - List of Diagnosis Codes";
		$data['diagnosis_list']  = $this->morders_procedure_rdb->get_procedure_group_list('data',$data['sort_order'],$data['per_page'],$data['row_first']);
		$data['count_fulllist']  = $this->morders_procedure_rdb->get_procedure_group_list('count',$data['sort_order'],'ALL',0);
        
        // Pagination Class of CodeIgniter
        $this->load->library('pagination');
        $config['base_url'] = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosiscodes/".$data['sort_order']."/";
        $config['total_rows']   = $data['count_fulllist'];
        $config['per_page']     = $data['per_page'];
        $config['num_links']    = 10;
        $config['uri_segment']  = 8;
        $this->pagination->initialize($config);
        //echo $this->pagination->create_links();

		$this->load->vars($data);
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
            $new_body   =   "ehr_util_list_procedure_groups_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_procedure_groups_html";
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
		
    } // end of function util_list_procedure_groups($id)


    // ------------------------------------------------------------------------
    function util_edit_procedure_group($seg3, $seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$this->load->model('memr_rdb');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosiscodes/dcode1_code/0','List Diagnosis Codes');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['pcode1_id']		    = 	$seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['init_pcode1_id']         = $data['pcode1_id'];
            $data['init_pcode1set']         = $_POST['pcode1set'];
            $data['init_pcode1_code']       = $_POST['pcode1_code'];
            $data['init_component']         = $_POST['component'];
            $data['init_code_use']          = $_POST['code_use'];
            $data['init_pcode_category']           = $_POST['pcode_category'];
            $data['init_topic']             = $_POST['topic'];
            $data['init_full_title']        = $_POST['full_title'];
            $data['init_short_title']       = $_POST['short_title'];
            $data['init_description']       = $_POST['description'];
            $data['init_criteria']          = $_POST['criteria'];
            $data['init_inclusion_criteria']= $_POST['inclusion_criteria'];
            $data['init_exclusion_criteria']= $_POST['exclusion_criteria'];
            $data['init_consideration']     = $_POST['consideration'];
            $data['init_note']              = $_POST['note'];
            $data['init_commonly_used']     = $_POST['commonly_used'];
            $data['init_remarks']           = $_POST['remarks'];
            $data['init_pcode1_active']     = $_POST['pcode1_active'];
            $data['init_added_remarks']     = $_POST['added_remarks'];
            $data['init_edit_remarks']      = $_POST['edit_remarks'];
       } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_code") {
                $data['init_pcode1_id']         =   $data['pcode1_id'];
                $data['init_pcode1set']         =   "PCDOMPC";
                $data['init_pcode1_code']       =   "";
                $data['init_component']         =   "";
                $data['init_code_use']          =   "P";
                $data['init_pcode_category']           =   "";
                $data['init_topic']             =   "";
                $data['init_full_title']        =   "";
                $data['init_short_title']       =   "";
                $data['init_description']       =   "";
                $data['init_criteria']          =   "";
                $data['init_inclusion_criteria']=   "";
                $data['init_exclusion_criteria']=   "";
                $data['init_consideration']     =   "";
                $data['init_note']              =   "";
                $data['init_commonly_used']     =   "";
                $data['init_pcode1_x01']              =   "";
                $data['init_pcode1_x02']              =   "";
                $data['init_pcode1_x03']              =   "";
                $data['init_remarks']           =   "";
                $data['init_pcode1_active']  =   "TRUE";
                $data['init_edit_remarks']      =   "";
                $data['init_added_remarks']     =   "";
            } elseif ($data['form_purpose'] == "edit_code") {
                //echo "Edit supplier";
                $data['diagnosis_info']  = $this->morders_procedure_rdb->get_procedure_group_list('data','pcode1_id',1,0,$data['pcode1_id']);
                $data['init_pcode1_code']       = $data['diagnosis_info'][0]['pcode1_code'];
                $data['init_pcode1_id']         = $data['diagnosis_info'][0]['pcode1_id'];
                $data['init_pcode1set']         = $data['diagnosis_info'][0]['pcode1set'];
                $data['init_component']         = $data['diagnosis_info'][0]['component'];
                $data['init_code_use']          = $data['diagnosis_info'][0]['code_use'];
                $data['init_pcode_category']           = $data['diagnosis_info'][0]['pcode_category'];
                $data['init_topic']             = $data['diagnosis_info'][0]['topic'];
                $data['init_full_title']        = $data['diagnosis_info'][0]['full_title'];
                $data['init_short_title']       = $data['diagnosis_info'][0]['short_title'];
                $data['init_description']       = $data['diagnosis_info'][0]['description'];
                $data['init_criteria']          = $data['diagnosis_info'][0]['criteria'];
                $data['init_inclusion_criteria']= $data['diagnosis_info'][0]['inclusion_criteria'];
                $data['init_exclusion_criteria']= $data['diagnosis_info'][0]['exclusion_criteria'];
                $data['init_consideration']     = $data['diagnosis_info'][0]['consideration'];
                $data['init_note']              = $data['diagnosis_info'][0]['note'];
                $data['init_commonly_used']     = $data['diagnosis_info'][0]['commonly_used'];
                $data['init_remarks']           = $data['diagnosis_info'][0]['remarks'];
                $data['init_pcode1_active']     = $data['diagnosis_info'][0]['pcode1_active'];
                $data['init_edit_remarks']      = $data['diagnosis_info'][0]['edit_remarks'];
                $data['init_added_remarks']     = $data['diagnosis_info'][0]['added_remarks'];
          } //endif ($data['form_purpose'] == "new_area")
        } //endif(count($_POST))
        //$data['dcode1set']          = $data['init_dcode1set'];
        $data['pcode_categories'] = $this->morders_procedure_rdb->get_procedure_categories();
		$data['title'] = "Add/Edit Diagnosis Code";
        $data['init_location_id']   =   $this->session->userdata('location_id');//$this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_procedure_group_code') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                $new_body   =   "ehr_util_edit_procedure_group_html";//util_edit_diagnosisext_info
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_procedure_group_html";//util_edit_diagnosisext_info
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
        } else {
            echo "\nValidated successfully.";
            $this->load->model('morders_procedure_wdb');
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_code") {
                // New area record
                $ins_code_array   =   array();
                $ins_code_array['staff_id']             = $this->session->userdata('staff_id');
                $ins_code_array['now_id']               = $data['now_id'];
                $ins_code_array['pcode1_id']            = $data['now_id'];
                $ins_code_array['pcode1set']            = $data['init_pcode1set'];
                $ins_code_array['pcode1_code']          = $data['init_pcode1_code'];
                $ins_code_array['component']            = $data['init_component'];
                $ins_code_array['code_use']             = $data['init_code_use'];
                $ins_code_array['pcode_category']              = $data['init_pcode_category'];
                $ins_code_array['topic']                = $data['init_topic'];
                $ins_code_array['full_title']           = $data['init_full_title'];
                $ins_code_array['short_title']          = $data['init_short_title'];
                $ins_code_array['description']          = $data['init_description'];
                $ins_code_array['criteria']             = $data['init_criteria'];
                $ins_code_array['inclusion_criteria']   = $data['init_inclusion_criteria'];
                $ins_code_array['exclusion_criteria']   = $data['init_exclusion_criteria'];
                $ins_code_array['consideration']        = $data['init_consideration'];
                $ins_code_array['note']                 = $data['init_note'];
                if(is_numeric($data['init_commonly_used'])){
                    $ins_code_array['commonly_used']= $data['init_commonly_used'];
                }
                //$ins_code_array['commonly_used']        = $data['init_commonly_used'];
                //$ins_code_array['dcode1_x01'] = $data['init_dcode1_x01'];
                //$ins_code_array['dcode1_x02'] = $data['init_dcode1_x02'];
                //$ins_code_array['dcode1_x03'] = $data['init_dcode1_x03'];
                $ins_code_array['remarks']              = $data['init_remarks'];
                $ins_code_array['added_remarks']              = $data['init_added_remarks'];
                $ins_code_array['pcode1_active']     = $data['init_pcode1_active'];
	            $ins_code_data       =   $this->morders_procedure_wdb->insert_new_pcode1($ins_code_array);
                $this->session->set_flashdata('data_activity', 'Group Code added.');
            } elseif($data['form_purpose'] == "edit_code") {
                // Existing supplier record
                $upd_code_array   =   array();
                $upd_code_array['edit_staff']           = $this->session->userdata('staff_id');
                $upd_code_array['now_id']               = $data['now_id'];
                $upd_code_array['pcode1_id']            = $data['pcode1_id'];
                $upd_code_array['pcode1set']            = $data['init_pcode1set'];
                $upd_code_array['pcode1_code']          = $data['init_pcode1_code'];
                $upd_code_array['component']            = $data['init_component'];
                $upd_code_array['code_use']             = $data['init_code_use'];
                $upd_code_array['pcode_category']              = $data['init_pcode_category'];
                $upd_code_array['topic']                = $data['init_topic'];
                $upd_code_array['full_title']           = $data['init_full_title'];
                $upd_code_array['short_title']          = $data['init_short_title'];
                $upd_code_array['description']          = $data['init_description'];
                $upd_code_array['criteria']             = $data['init_criteria'];
                $upd_code_array['inclusion_criteria']   = $data['init_inclusion_criteria'];
                $upd_code_array['exclusion_criteria']   = $data['init_exclusion_criteria'];
                $upd_code_array['consideration']        = $data['init_consideration'];
                $upd_code_array['note']                 = $data['init_note'];
                if(is_numeric($data['init_commonly_used'])){
                    $upd_code_array['commonly_used']= $data['init_commonly_used'];
                }
                //$ins_code_array['commonly_used']        = $data['init_commonly_used'];
                //$upd_code_array['dcode1_x01'] = $data['init_dcode1_x01'];
                //$upd_code_array['dcode1_x02'] = $data['init_dcode1_x02'];
                //$upd_code_array['dcode1_x03'] = $data['init_dcode1_x03'];
                $upd_code_array['remarks']              = $data['init_remarks'];
                $upd_code_array['pcode1_active']        = $data['init_pcode1_active'];
                $upd_code_array['edit_remarks']         = $data['init_edit_remarks'];
                $upd_code_array['edit_date']            = $data['now_date'];
	            $upd_code_data       =   $this->morders_procedure_wdb->update_pcode1($upd_code_array);
                $this->session->set_flashdata('data_activity', 'Group Code updated.');
            } //endif($data['diagnosis_id'] == "new_code")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes_procedures/util_list_procedure_groups/pcode1_code/0";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_diagnosisext_code') == FALSE)


    } // end of function util_edit_procedure_group()


    // ------------------------------------------------------------------------
    function util_list_procedure_codes_pergroup($seg3, $seg4)  // template for new classes
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosiscodes/dcode1_code/0','List Diagnosis Codes');    
        $data['sort_order']   	    =   $seg3; //$this->uri->segment(3);
        $data['per_page']           =   'ALL';//'50';
        $data['row_first']   	    =   0;//$this->uri->segment(4);//$data['page_num'] * $data['per_page'];
        if(!is_numeric($data['row_first'])){
             $data['row_first'] =   0;
        }
        $data['pcode1_id']   	    =   $seg4; //$this->uri->segment(4);
        
		$data['title'] = "THIRRA - List of Diagnosis Codes";
		$data['diagnosis_list']  = $this->morders_procedure_rdb->get_procedure_code_list('data',$data['sort_order'],$data['per_page'],$data['row_first'],$data['pcode1_id']);
		$data['count_fulllist']  = $this->morders_procedure_rdb->get_procedure_code_list('count',$data['sort_order'],'ALL',0,$data['pcode1_id']);
		$data['diagnosis_top']  = $this->morders_procedure_rdb->get_procedure_group_list('data','pcode1_id',1,0,$data['pcode1_id']);
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."index.php/ehr_utilities/util_list_diagnosiscodes/".$data['sort_order']."/";
        $config['total_rows']   = $data['count_fulllist'];
        $config['per_page']     = $data['per_page'];
        $config['num_links']    = 10;
        $config['uri_segment']  = 4;
        $this->pagination->initialize($config);

        //echo $this->pagination->create_links();

		$this->load->vars($data);
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
            $new_body   =   "ehr_util_list_procedure_codes_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_procedure_codes_html";
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
		
    } // end of function util_list_procedure_codes_pergroup($id)


    // ------------------------------------------------------------------------
    function util_edit_procedure_code($seg3, $seg4, $seg5)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosiscodes/dcode1_code/0','List Diagnosis Codes');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['pcode1_id']		    = 	$seg4; //$this->uri->segment(4);
        $data['pcode1ext_id']		= 	$seg5; //$this->uri->segment(5);
		$data['diagnosis_top']  = $this->morders_procedure_rdb->get_procedure_group_list('data','pcode1_id',1,0,$data['pcode1_id']);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['init_pcode1ext_code']    = $_POST['pcode1ext_code'];
            $data['init_pcode1_id']         = $data['pcode1_id'];
            $data['init_pcode1set']         = $_POST['pcode1set'];
            $data['init_pcode1ext_code']    = $_POST['pcode1ext_code'];
            $data['init_pcode1ext_longname']= $_POST['pcode1ext_longname'];
            $data['init_pcode1ext_shortname']= $_POST['pcode1ext_shortname'];
            $data['init_component']         = $_POST['component'];
            $data['init_code_use']          = $_POST['code_use'];
            $data['init_pcode_category']           = $_POST['pcode_category'];
            $data['init_topic']             = $_POST['topic'];
            $data['init_description']       = $_POST['description'];
            $data['init_criteria']          = $_POST['criteria'];
            $data['init_inclusion_criteria']= $_POST['inclusion_criteria'];
            $data['init_exclusion_criteria']= $_POST['exclusion_criteria'];
            $data['init_consideration']     = $_POST['consideration'];
            $data['init_note']              = $_POST['note'];
            $data['init_pcode1ext_notify']  = $_POST['pcode1ext_notify'];
            $data['init_commonly_used']     = $_POST['commonly_used'];
            $data['init_remarks']           = $_POST['remarks'];
            $data['init_pcode1ext_active']  = $_POST['pcode1ext_active'];
            $data['init_edit_remarks']      = $_POST['edit_remarks'];
            $data['init_added_remarks']      = $_POST['added_remarks'];
       } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_code") {
                $data['pcode1ext_id']           =   $data['pcode1ext_id'];
                $data['init_pcode1ext_code']    = 	$data['diagnosis_top'][0]['pcode1_code'];
                $data['init_pcode1_id']         =   $data['pcode1_id'];
                $data['init_pcode1set']         =   $data['diagnosis_top'][0]['pcode1set'];
                $data['init_pcode1ext_longname']=   "";
                $data['init_pcode1ext_shortname']=   "";
                $data['init_component']         =   "";
                $data['init_code_use']          =   "P";
                $data['init_pcode_category']    =   $data['diagnosis_top'][0]['pcode_category'];
                $data['init_topic']             =   "";
                $data['init_description']       =   "";
                $data['init_criteria']          =   "";
                $data['init_inclusion_criteria']=   "";
                $data['init_exclusion_criteria']=   "";
                $data['init_consideration']     =   "";
                $data['init_note']              =   "";
                $data['init_pcode1ext_notify']  =   "";
                $data['init_commonly_used']     =   "";
                $data['init_remarks']           =   "";
                $data['init_pcode1ext_active']  =   "TRUE";
                $data['init_edit_remarks']      =   "";
                $data['init_added_remarks']     =   "";
            } elseif ($data['form_purpose'] == "edit_code") {
                //echo "Edit supplier";
                $data['dcode1ext_info'] = $this->morders_procedure_rdb->get_procedure_code_list('data',"pcode1ext_code",1,0,NULL,$data['pcode1ext_id']);
                $data['init_pcode1ext_code']    = $data['dcode1ext_info'][0]['pcode1ext_code'];
                $data['init_pcode1_id']         = $data['dcode1ext_info'][0]['pcode1_id'];
                $data['init_pcode1set']         = $data['dcode1ext_info'][0]['pcode1set'];
                $data['init_pcode1ext_longname']= $data['dcode1ext_info'][0]['pcode1ext_longname'];
                $data['init_pcode1ext_shortname']= $data['dcode1ext_info'][0]['pcode1ext_shortname'];
                $data['init_component']         = $data['dcode1ext_info'][0]['component'];
                $data['init_code_use']          = $data['dcode1ext_info'][0]['code_use'];
                $data['init_pcode_category']    = $data['dcode1ext_info'][0]['pcode_category'];
                $data['init_topic']             = $data['dcode1ext_info'][0]['topic'];
                $data['init_description']       = $data['dcode1ext_info'][0]['description'];
                $data['init_criteria']          = $data['dcode1ext_info'][0]['criteria'];
                $data['init_inclusion_criteria']= $data['dcode1ext_info'][0]['inclusion_criteria'];
                $data['init_exclusion_criteria']= $data['dcode1ext_info'][0]['exclusion_criteria'];
                $data['init_consideration']     = $data['dcode1ext_info'][0]['consideration'];
                $data['init_note']              = $data['dcode1ext_info'][0]['note'];
                $data['init_pcode1ext_notify']  = $data['dcode1ext_info'][0]['pcode1ext_notify'];
                $data['init_commonly_used']     = $data['dcode1ext_info'][0]['commonly_used'];
                $data['init_remarks']           = $data['dcode1ext_info'][0]['remarks'];
                $data['init_pcode1ext_active']  = $data['dcode1ext_info'][0]['pcode1ext_active'];
                $data['init_edit_remarks']      = $data['dcode1ext_info'][0]['edit_remarks'];
                $data['init_added_remarks']     = $data['dcode1ext_info'][0]['added_remarks'];
          } //endif ($data['form_purpose'] == "new_area")
        } //endif(count($_POST))
        $data['pcode1ext_code']     = $data['init_pcode1ext_code'];
        $data['pcode1set']          = $data['init_pcode1set'];
		$data['title'] = "Add/Edit Extended Diagnosis Code";
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_procedure_code') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                $new_body   =   "ehr_util_edit_procedure_code_html";//util_edit_diagnosisext_info
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_procedure_code_html";//util_edit_diagnosisext_info
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
        } else {
            echo "\nValidated successfully.";
            $this->load->model('morders_procedure_wdb');
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_code") {
                // New area record
                $ins_code_array   =   array();
                $ins_code_array['staff_id']             = $this->session->userdata('staff_id');//$this->session->userdata('staff_id');
                $ins_code_array['now_id']               = $data['now_id'];
                $ins_code_array['pcode1ext_id']         = $data['now_id'];
                $ins_code_array['pcode1_id']            = $data['init_pcode1_id'];
                $ins_code_array['pcode1set']            = $data['init_pcode1set'];
                $ins_code_array['pcode1ext_code']       = $data['init_pcode1ext_code'];
                $ins_code_array['pcode1ext_longname']   = $data['init_pcode1ext_longname'];
                $ins_code_array['pcode1ext_shortname']  = $data['init_pcode1ext_shortname'];
                $ins_code_array['component']            = $data['init_component'];
                $ins_code_array['code_use']             = $data['init_code_use'];
                $ins_code_array['pcode_category']              = $data['init_pcode_category'];
                $ins_code_array['topic']                = $data['init_topic'];
                $ins_code_array['description']          = $data['init_description'];
                $ins_code_array['criteria']             = $data['init_criteria'];
                $ins_code_array['inclusion_criteria']   = $data['init_inclusion_criteria'];
                $ins_code_array['exclusion_criteria']   = $data['init_exclusion_criteria'];
                $ins_code_array['consideration']        = $data['init_consideration'];
                $ins_code_array['note']                 = $data['init_note'];
                if(!empty($data['init_pcode1ext_notify'])){
                    $ins_code_array['pcode1ext_notify']     = $data['init_pcode1ext_notify'];
                }
                if(!empty($data['init_commonly_used'])){
                    $ins_code_array['commonly_used']        = $data['init_commonly_used'];
                }
                //$ins_code_array['dcode1ext_x01'] = $data['init_dcode1ext_x01'];
                //$ins_code_array['dcode1ext_x02'] = $data['init_dcode1ext_x02'];
                //$ins_code_array['dcode1ext_x03'] = $data['init_dcode1ext_x03'];
                $ins_code_array['remarks']              = $data['init_remarks'];
                $ins_code_array['pcode1ext_active']     = $data['init_pcode1ext_active'];
	            $ins_code_data       =   $this->morders_procedure_wdb->insert_new_pcode1ext($ins_code_array);
                $this->session->set_flashdata('data_activity', 'Procedure code added.');
            } elseif($data['form_purpose'] == "edit_code") {
                // Existing supplier record
                $upd_code_array   =   array();
                $upd_code_array['edit_staff']             = $this->session->userdata('staff_id');//$this->session->userdata('staff_id');
                $upd_code_array['now_id']               = $data['now_id'];
                $upd_code_array['pcode1ext_id']         = $data['pcode1ext_id'];
                //$upd_code_array['dcode1_id']            = $data['init_dcode1_id'];
                //$upd_code_array['dcode1set']            = $data['init_dcode1set'];
                $upd_code_array['pcode1ext_code']       = $data['init_pcode1ext_code'];
                $upd_code_array['pcode1ext_longname']   = $data['init_pcode1ext_longname'];
                $upd_code_array['pcode1ext_shortname']  = $data['init_pcode1ext_shortname'];
                $upd_code_array['component']            = $data['init_component'];
                $upd_code_array['code_use']             = $data['init_code_use'];
                $upd_code_array['pcode_category']              = $data['init_pcode_category'];
                $upd_code_array['topic']                = $data['init_topic'];
                $upd_code_array['description']          = $data['init_description'];
                $upd_code_array['criteria']             = $data['init_criteria'];
                $upd_code_array['inclusion_criteria']   = $data['init_inclusion_criteria'];
                $upd_code_array['exclusion_criteria']   = $data['init_exclusion_criteria'];
                $upd_code_array['consideration']        = $data['init_consideration'];
                $upd_code_array['note']                 = $data['init_note'];
                if(is_numeric($data['init_pcode1ext_notify'])){
                    $upd_code_array['pcode1ext_notify']= $data['init_pcode1ext_notify'];
                }
                //$upd_code_array['dcode1ext_notify']     = $data['init_dcode1ext_notify'];
                if(is_numeric($data['init_commonly_used'])){
                    $upd_code_array['commonly_used']= $data['init_commonly_used'];
                }
                //$upd_code_array['commonly_used']        = $data['init_commonly_used'];
                //$ins_code_array['dcode1ext_x01'] = $data['init_dcode1ext_x01'];
                //$ins_code_array['dcode1ext_x02'] = $data['init_dcode1ext_x02'];
                //$ins_code_array['dcode1ext_x03'] = $data['init_dcode1ext_x03'];
                $upd_code_array['remarks']              = $data['init_remarks'];
                $upd_code_array['pcode1ext_active']     = $data['init_pcode1ext_active'];
                $upd_code_array['edit_remarks']              = $data['init_edit_remarks'];
                $upd_code_array['edit_date']              = $data['now_date'];
	            $upd_code_data       =   $this->morders_procedure_wdb->update_pcode1ext($upd_code_array);
                $this->session->set_flashdata('data_activity', 'Procedure code updated.');
            } //endif($data['diagnosis_id'] == "new_code")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes_procedures/util_list_procedure_codes_pergroup/pcode1ext_code/".$data['pcode1_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_diagnosisext_code') == FALSE)


    } // end of function util_edit_procedure_code()





}

/* End of file Ehr_utilities_codes_procedures.php */
/* Location: ./app_thirra/controllers/Ehr_utilities_codes_procedures.php */
