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
 * Controller Class for Utilities for Coding and Classifications
 *
 * This class is used for both narrowband and broadband EHR. 
 *
 * @version 0.9.13
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_utilities_codes extends MX_Controller 
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
    function util_list_complaint_codes($seg3, $seg4)  // template for new classes
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities');    
        $data['sort_order']   	    =   $seg3; //$this->uri->segment(3);
        //$data['page_num']   	    = $this->uri->segment(4);
        $data['per_page']           =   '50';
        $data['row_first']   	    =   $seg4; //$this->uri->segment(4);//$data['page_num'] * $data['per_page'];
        if(!is_numeric($data['row_first'])){
             $data['row_first'] =   0;
        }
        
		$data['title'] = "THIRRA - List of Complaints Codes";
		$data['complaints_list']  = $this->mutil_rdb->get_complaint_codes_list('data',$data['sort_order'],$data['per_page'],$data['row_first']);
		$data['count_fulllist']  = $this->mutil_rdb->get_complaint_codes_list('count',$data['sort_order'],'ALL',0);
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_complaint_codes/".$data['sort_order']."/";
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
            $new_body   =   "ehr_util_list_complaint_codes_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_complaint_codes_html";
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
		
    } // end of function util_list_complaint_codes($id)


    // ------------------------------------------------------------------------
    function util_edit_complaint_code($seg3, $seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_complaint_codes/icpc_code/0','List Complaint Codes');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['icpc_code']		    = 	$seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['form_purpose']           = $_POST['form_purpose'];
            $data['init_icpc_code']         = $_POST['icpc_code'];
            $data['init_component']         = $_POST['component'];
            $data['init_full_description']  = $_POST['full_description'];
            $data['init_short_description'] = $_POST['short_description'];
            $data['init_icd_10']            = $_POST['icd_10'];
            $data['init_criteria']          = $_POST['criteria'];
            $data['init_inclusion_criteria']= $_POST['inclusion_criteria'];
            $data['init_exclusion_criteria']= $_POST['exclusion_criteria'];
            $data['init_consideration']     = $_POST['consideration'];
            $data['init_note']              = $_POST['note'];
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_code") {
                $data['init_icpc_code']       	= 	"";
                $data['init_component']         =   "";
                $data['init_full_description']  =   "";
                $data['init_short_description'] =   "";
                $data['init_icd_10']            =   "";
                $data['init_criteria']          =   "";
                $data['init_inclusion_criteria']=   "";
                $data['init_exclusion_criteria']=   "";
                $data['init_consideration']     =   "";
                $data['init_note']              =   "";
            } elseif ($data['form_purpose'] == "edit_code") {
                //echo "Edit supplier";
                $data['code_info']  = $this->mutil_rdb->get_complaint_codes_list('data','icpc_code',1,0,$data['icpc_code']);
                $data['init_icpc_code']         = $data['icpc_code'];
                $data['init_component']         = $data['code_info'][0]['component'];
                $data['init_full_description']  = $data['code_info'][0]['full_description'];
                $data['init_short_description'] = $data['code_info'][0]['short_description'];
                $data['init_icd_10']            = $data['code_info'][0]['icd_10'];
                $data['init_criteria']          = $data['code_info'][0]['criteria'];
                $data['init_inclusion_criteria']= $data['code_info'][0]['inclusion_criteria'];
                $data['init_exclusion_criteria']= $data['code_info'][0]['exclusion_criteria'];
                $data['init_consideration']     = $data['code_info'][0]['consideration'];
                $data['init_note']              = $data['code_info'][0]['note'];
            } //endif ($data['form_purpose'] == "new_code")
        } //endif(count($_POST))
		$data['title'] = "Add/Edit Complaint Code";
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_complaint_code') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                $new_body   =   "ehr_util_edit_complaint_code_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_complaint_code_html";
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
            //echo "\nValidated successfully.";
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_code") {
                // New code record
                $ins_code_array   =   array();
                $ins_code_array['icpc_code']            = $data['init_icpc_code'];
                $ins_code_array['component']            = $data['init_component'];
                $ins_code_array['full_description']     = $data['init_full_description'];
                $ins_code_array['short_description']    = $data['init_short_description'];
                $ins_code_array['icd_10']               = $data['init_icd_10'];
                $ins_code_array['criteria']             = $data['init_criteria'];
                $ins_code_array['inclusion_criteria']   = $data['init_inclusion_criteria'];
                $ins_code_array['exclusion_criteria']   = $data['init_exclusion_criteria'];
                $ins_code_array['consideration']        = $data['init_consideration'];
                $ins_code_array['note']                 = $data['init_note'];
                if($data['offline_mode']){
                    $ins_code_array['synch_out']      = $data['now_id'];
                }
	            $ins_code_data       =   $this->mutil_wdb->insert_new_complaintcode($ins_code_array);
                $this->session->set_flashdata('data_activity', 'Complaint code added.');
            } elseif($data['form_purpose'] == "edit_code") {
                // Existing supplier record
                $upd_code_array   =   array();
                $upd_code_array['icpc_code']            = $data['init_icpc_code'];
                $upd_code_array['component']            = $data['init_component'];
                $upd_code_array['full_description']     = $data['init_full_description'];
                $upd_code_array['short_description']    = $data['init_short_description'];
                $upd_code_array['icd_10']               = $data['init_icd_10'];
                $upd_code_array['criteria']             = $data['init_criteria'];
                $upd_code_array['inclusion_criteria']   = $data['init_inclusion_criteria'];
                $upd_code_array['exclusion_criteria']   = $data['init_exclusion_criteria'];
                $upd_code_array['consideration']        = $data['init_consideration'];
                $upd_code_array['note']                 = $data['init_note'];
                if($data['offline_mode']){
                    $upd_code_array['synch_out']      = $data['now_id'];
                }
	            $upd_code_data       =   $this->mutil_wdb->update_complaint_code($upd_code_array);
                $this->session->set_flashdata('data_activity', 'Complaint code updated.');
            } //endif($data['diagnosis_id'] == "new_code")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_complaint_codes/icpc_code/0";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_complaint_code') == FALSE)


    } // end of function util_edit_complaint_code()


    // ------------------------------------------------------------------------
    function util_list_diagnosiscodes($seg3, $seg4)  // template for new classes
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
		$data['diagnosis_list']  = $this->mutil_rdb->get_diagnosis_toplevel_list('data',$data['sort_order'],$data['per_page'],$data['row_first']);
		$data['count_fulllist']  = $this->mutil_rdb->get_diagnosis_toplevel_list('count',$data['sort_order'],'ALL',0);
        
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
            $new_body   =   "ehr_util_list_diagnosiscodes_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_diagnosiscodes_html";
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
		
    } // end of function util_list_diagnosiscodes($id)


    // ------------------------------------------------------------------------
    function util_edit_diagnosis_info($seg3, $seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$this->load->model('memr_rdb');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosiscodes/dcode1_code/0','List Diagnosis Codes');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['dcode1_id']		    = 	$seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['init_dcode1_id']         = $data['dcode1_id'];
            $data['init_dcode1set']         = $_POST['dcode1set'];
            $data['init_dcode1_code']       = $_POST['dcode1_code'];
            $data['init_component']         = $_POST['component'];
            $data['init_code_use']          = $_POST['code_use'];
            $data['init_chapter']           = $_POST['chapter'];
            $data['init_topic']             = $_POST['topic'];
            $data['init_full_title']        = $_POST['full_title'];
            $data['init_short_title']       = $_POST['short_title'];
            $data['init_description']       = $_POST['description'];
            $data['init_dcode2maps']        = $_POST['dcode2maps'];
            $data['init_criteria']          = $_POST['criteria'];
            $data['init_inclusion_criteria']= $_POST['inclusion_criteria'];
            $data['init_exclusion_criteria']= $_POST['exclusion_criteria'];
            $data['init_consideration']     = $_POST['consideration'];
            $data['init_note']              = $_POST['note'];
            $data['init_commonly_used']     = $_POST['commonly_used'];
            $data['init_remarks']           = $_POST['remarks'];
            $data['init_dcode1_active']     = $_POST['dcode1_active'];
            $data['init_added_remarks']     = $_POST['added_remarks'];
            $data['init_edit_remarks']      = $_POST['edit_remarks'];
       } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_code") {
                $data['init_dcode1_id']         =   $data['dcode1_id'];
                $data['init_dcode1set']         =   "ICD-10";
                $data['init_dcode1_code']       =   "";
                $data['init_component']         =   "";
                $data['init_code_use']          =   "D";
                $data['init_chapter']           =   "";
                $data['init_topic']             =   "";
                $data['init_full_title']        =   "";
                $data['init_short_title']       =   "";
                $data['init_description']       =   "";
                $data['init_dcode2maps']        =   "";
                $data['init_criteria']          =   "";
                $data['init_inclusion_criteria']=   "";
                $data['init_exclusion_criteria']=   "";
                $data['init_consideration']     =   "";
                $data['init_note']              =   "";
                $data['init_commonly_used']     =   "";
                $data['init_dcode1_x01']              =   "";
                $data['init_dcode1_x02']              =   "";
                $data['init_dcode1_x03']              =   "";
                $data['init_remarks']           =   "";
                $data['init_dcode1_active']  =   "TRUE";
                $data['init_edit_remarks']      =   "";
                $data['init_added_remarks']     =   "";
            } elseif ($data['form_purpose'] == "edit_code") {
                //echo "Edit supplier";
                $data['diagnosis_info']  = $this->mutil_rdb->get_diagnosis_toplevel_list('data','dcode1_id',1,0,$data['dcode1_id']);
                $data['init_dcode1_code']       = $data['diagnosis_info'][0]['dcode1_code'];
                $data['init_dcode1_id']         = $data['diagnosis_info'][0]['dcode1_id'];
                $data['init_dcode1set']         = $data['diagnosis_info'][0]['dcode1set'];
                $data['init_component']         = $data['diagnosis_info'][0]['component'];
                $data['init_code_use']          = $data['diagnosis_info'][0]['code_use'];
                $data['init_chapter']           = $data['diagnosis_info'][0]['chapter'];
                $data['init_topic']             = $data['diagnosis_info'][0]['topic'];
                $data['init_full_title']        = $data['diagnosis_info'][0]['full_title'];
                $data['init_short_title']       = $data['diagnosis_info'][0]['short_title'];
                $data['init_description']       = $data['diagnosis_info'][0]['description'];
                $data['init_dcode2maps']        = $data['diagnosis_info'][0]['dcode2_maps'];
                $data['init_criteria']          = $data['diagnosis_info'][0]['criteria'];
                $data['init_inclusion_criteria']= $data['diagnosis_info'][0]['inclusion_criteria'];
                $data['init_exclusion_criteria']= $data['diagnosis_info'][0]['exclusion_criteria'];
                $data['init_consideration']     = $data['diagnosis_info'][0]['consideration'];
                $data['init_note']              = $data['diagnosis_info'][0]['note'];
                $data['init_commonly_used']     = $data['diagnosis_info'][0]['commonly_used'];
                $data['init_remarks']           = $data['diagnosis_info'][0]['remarks'];
                $data['init_dcode1_active']     = $data['diagnosis_info'][0]['dcode1_active'];
                $data['init_edit_remarks']      = $data['diagnosis_info'][0]['edit_remarks'];
                $data['init_added_remarks']     = $data['diagnosis_info'][0]['added_remarks'];
          } //endif ($data['form_purpose'] == "new_area")
        } //endif(count($_POST))
        //$data['dcode1set']          = $data['init_dcode1set'];
        $data['dcode1_chapters'] = $this->mutil_rdb->get_dcode_chapters();
		$data['title'] = "Add/Edit Diagnosis Code";
        $data['init_location_id']   =   $this->session->userdata('location_id');//$this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_diagnosis_code') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                $new_body   =   "ehr_util_edit_diagnosis_info_html";//util_edit_diagnosisext_info
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_diagnosis_info_html";//util_edit_diagnosisext_info
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
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_code") {
                // New area record
                $ins_code_array   =   array();
                $ins_code_array['staff_id']             = $this->session->userdata('staff_id');
                $ins_code_array['now_id']               = $data['now_id'];
                $ins_code_array['dcode1_id']            = $data['now_id'];
                $ins_code_array['dcode1set']            = $data['init_dcode1set'];
                $ins_code_array['dcode1_code']          = $data['init_dcode1_code'];
                $ins_code_array['component']            = $data['init_component'];
                $ins_code_array['code_use']             = $data['init_code_use'];
                $ins_code_array['chapter']              = $data['init_chapter'];
                $ins_code_array['topic']                = $data['init_topic'];
                $ins_code_array['full_title']           = $data['init_full_title'];
                $ins_code_array['short_title']          = $data['init_short_title'];
                $ins_code_array['description']          = $data['init_description'];
                $ins_code_array['dcode2maps']           = $data['init_dcode2maps'];
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
                $ins_code_array['dcode1_active']     = $data['init_dcode1_active'];
	            $ins_code_data       =   $this->mutil_wdb->insert_new_dcode1($ins_code_array);
                $this->session->set_flashdata('data_activity', 'Code added.');
            } elseif($data['form_purpose'] == "edit_code") {
                // Existing supplier record
                $upd_code_array   =   array();
                $upd_code_array['edit_staff']           = $this->session->userdata('staff_id');
                $upd_code_array['now_id']               = $data['now_id'];
                $upd_code_array['dcode1_id']            = $data['dcode1_id'];
                $upd_code_array['dcode1set']            = $data['init_dcode1set'];
                $upd_code_array['dcode1_code']          = $data['init_dcode1_code'];
                $upd_code_array['component']            = $data['init_component'];
                $upd_code_array['code_use']             = $data['init_code_use'];
                $upd_code_array['chapter']              = $data['init_chapter'];
                $upd_code_array['topic']                = $data['init_topic'];
                $upd_code_array['full_title']           = $data['init_full_title'];
                $upd_code_array['short_title']          = $data['init_short_title'];
                $upd_code_array['description']          = $data['init_description'];
                $upd_code_array['dcode2maps']           = $data['init_dcode2maps'];
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
                $upd_code_array['dcode1_active']        = $data['init_dcode1_active'];
                $upd_code_array['edit_remarks']         = $data['init_edit_remarks'];
                $upd_code_array['edit_date']            = $data['now_date'];
	            $upd_code_data       =   $this->mutil_wdb->update_dcode1($upd_code_array);
                $this->session->set_flashdata('data_activity', 'Code updated.');
            } //endif($data['diagnosis_id'] == "new_code")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosisext_codes/dcode1ext_code/".$data['dcode1_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_diagnosisext_code') == FALSE)


    } // end of function util_edit_diagnosis_info()


    // ------------------------------------------------------------------------
    function util_list_diagnosisext_codes($seg3, $seg4)  // template for new classes
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
        $data['dcode1_id']   	    =   $seg4; //$this->uri->segment(4);
        
		$data['title'] = "THIRRA - List of Diagnosis Codes";
		$data['diagnosis_list']  = $this->mutil_rdb->get_diagnosis_ext_list('data',$data['sort_order'],$data['per_page'],$data['row_first'],$data['dcode1_id']);
		$data['count_fulllist']  = $this->mutil_rdb->get_diagnosis_ext_list('count',$data['sort_order'],'ALL',0,$data['dcode1_id']);
		$data['diagnosis_top']  = $this->mutil_rdb->get_diagnosis_toplevel_list('data','dcode1_id',1,0,$data['dcode1_id']);
        
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
            $new_body   =   "ehr_util_list_diagnosisext_codes_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_diagnosisext_codes_html";
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
		
    } // end of function util_list_diagnosisext_codes($id)


    // ------------------------------------------------------------------------
    function util_edit_diagnosisext_info($seg3, $seg4, $seg5)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosiscodes/dcode1_code/0','List Diagnosis Codes');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['dcode1_id']		    = 	$seg4; //$this->uri->segment(4);
        $data['dcode1ext_id']		= 	$seg5; //$this->uri->segment(5);
		$data['diagnosis_top']  = $this->mutil_rdb->get_diagnosis_toplevel_list('data','dcode1_id',1,0,$data['dcode1_id']);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['init_dcode1ext_code']    = $_POST['dcode1ext_code'];
            $data['init_dcode1_id']         = $data['dcode1_id'];
            $data['init_dcode1set']         = $_POST['dcode1set'];
            $data['init_dcode1ext_code']    = $_POST['dcode1ext_code'];
            $data['init_dcode1ext_longname']= $_POST['dcode1ext_longname'];
            $data['init_dcode1ext_shortname']= $_POST['dcode1ext_shortname'];
            $data['init_component']         = $_POST['component'];
            $data['init_code_use']          = $_POST['code_use'];
            $data['init_chapter']           = $_POST['chapter'];
            $data['init_topic']             = $_POST['topic'];
            $data['init_full_title']        = $_POST['full_title'];
            $data['init_short_title']       = $_POST['short_title'];
            $data['init_description']       = $_POST['description'];
            $data['init_dcode2maps']        = $_POST['dcode2maps'];
            $data['init_criteria']          = $_POST['criteria'];
            $data['init_inclusion_criteria']= $_POST['inclusion_criteria'];
            $data['init_exclusion_criteria']= $_POST['exclusion_criteria'];
            $data['init_consideration']     = $_POST['consideration'];
            $data['init_note']              = $_POST['note'];
            $data['init_dcode1ext_notify']  = $_POST['dcode1ext_notify'];
            $data['init_commonly_used']     = $_POST['commonly_used'];
            $data['init_remarks']           = $_POST['remarks'];
            $data['init_dcode1ext_active']  = $_POST['dcode1ext_active'];
            $data['init_edit_remarks']      = $_POST['edit_remarks'];
            $data['init_added_remarks']      = $_POST['added_remarks'];
       } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_code") {
                $data['dcode1ext_id']           =   $data['dcode1ext_id'];
                $data['init_dcode1ext_code']    = 	$data['diagnosis_top'][0]['dcode1_code'];
                $data['init_dcode1_id']         =   $data['dcode1_id'];
                $data['init_dcode1set']         =   $data['diagnosis_top'][0]['dcode1set'];
                $data['init_dcode1ext_longname']=   "";
                $data['init_dcode1ext_shortname']=   "";
                $data['init_component']         =   "";
                $data['init_code_use']          =   "D";
                $data['init_chapter']           =   $data['diagnosis_top'][0]['chapter'];
                $data['init_topic']             =   "";
                $data['init_full_title']        =   "";
                $data['init_short_title']       =   "";
                $data['init_description']       =   "";
                $data['init_dcode2maps']        =   "";
                $data['init_criteria']          =   "";
                $data['init_inclusion_criteria']=   "";
                $data['init_exclusion_criteria']=   "";
                $data['init_consideration']     =   "";
                $data['init_note']              =   "";
                $data['init_dcode1ext_notify']  =   "";
                $data['init_commonly_used']     =   "";
                $data['init_remarks']           =   "";
                $data['init_dcode1ext_active']  =   "TRUE";
                $data['init_edit_remarks']      =   "";
                $data['init_added_remarks']     =   "";
            } elseif ($data['form_purpose'] == "edit_code") {
                //echo "Edit supplier";
                $data['dcode1ext_info'] = $this->mutil_rdb->get_diagnosis_ext_list('data',"dcode1ext_code",1,0,NULL,$data['dcode1ext_id']);
                $data['init_dcode1ext_code']    = $data['dcode1ext_info'][0]['dcode1ext_code'];
                $data['init_dcode1_id']         = $data['dcode1ext_info'][0]['dcode1_id'];
                $data['init_dcode1set']         = $data['dcode1ext_info'][0]['dcode1set'];
                $data['init_dcode1ext_longname']= $data['dcode1ext_info'][0]['dcode1ext_longname'];
                $data['init_dcode1ext_shortname']= $data['dcode1ext_info'][0]['dcode1ext_shortname'];
                $data['init_component']         = $data['dcode1ext_info'][0]['component'];
                $data['init_code_use']          = $data['dcode1ext_info'][0]['code_use'];
                $data['init_chapter']           = $data['dcode1ext_info'][0]['chapter'];
                $data['init_topic']             = $data['dcode1ext_info'][0]['topic'];
                $data['init_full_title']        = $data['dcode1ext_info'][0]['full_title'];
                $data['init_short_title']       = $data['dcode1ext_info'][0]['short_title'];
                $data['init_description']       = $data['dcode1ext_info'][0]['description'];
                $data['init_dcode2maps']        = $data['dcode1ext_info'][0]['dcode2maps'];
                $data['init_criteria']          = $data['dcode1ext_info'][0]['criteria'];
                $data['init_inclusion_criteria']= $data['dcode1ext_info'][0]['inclusion_criteria'];
                $data['init_exclusion_criteria']= $data['dcode1ext_info'][0]['exclusion_criteria'];
                $data['init_consideration']     = $data['dcode1ext_info'][0]['consideration'];
                $data['init_note']              = $data['dcode1ext_info'][0]['note'];
                $data['init_dcode1ext_notify']  = $data['dcode1ext_info'][0]['dcode1ext_notify'];
                $data['init_commonly_used']     = $data['dcode1ext_info'][0]['commonly_used'];
                $data['init_remarks']           = $data['dcode1ext_info'][0]['remarks'];
                $data['init_dcode1ext_active']  = $data['dcode1ext_info'][0]['dcode1ext_active'];
                $data['init_edit_remarks']      = $data['dcode1ext_info'][0]['edit_remarks'];
                $data['init_added_remarks']     = $data['dcode1ext_info'][0]['added_remarks'];
          } //endif ($data['form_purpose'] == "new_area")
        } //endif(count($_POST))
        $data['dcode1ext_code']     = $data['init_dcode1ext_code'];
        $data['dcode1set']          = $data['init_dcode1set'];
		$data['title'] = "Add/Edit Extended Diagnosis Code";
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_diagnosisext_code') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                $new_body   =   "ehr_util_edit_diagnosisext_info_html";//util_edit_diagnosisext_info
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_diagnosisext_info_html";//util_edit_diagnosisext_info
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
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_code") {
                // New area record
                $ins_code_array   =   array();
                $ins_code_array['staff_id']             = $this->session->userdata('staff_id');//$this->session->userdata('staff_id');
                $ins_code_array['now_id']               = $data['now_id'];
                $ins_code_array['dcode1ext_id']         = $data['now_id'];
                $ins_code_array['dcode1_id']            = $data['init_dcode1_id'];
                $ins_code_array['dcode1set']            = $data['init_dcode1set'];
                $ins_code_array['dcode1ext_code']       = $data['init_dcode1ext_code'];
                $ins_code_array['dcode1ext_longname']   = $data['init_dcode1ext_longname'];
                $ins_code_array['dcode1ext_shortname']  = $data['init_dcode1ext_shortname'];
                $ins_code_array['component']            = $data['init_component'];
                $ins_code_array['code_use']             = $data['init_code_use'];
                $ins_code_array['chapter']              = $data['init_chapter'];
                $ins_code_array['topic']                = $data['init_topic'];
                $ins_code_array['full_title']           = $data['init_full_title'];
                $ins_code_array['short_title']          = $data['init_short_title'];
                $ins_code_array['description']          = $data['init_description'];
                $ins_code_array['dcode2maps']           = $data['init_dcode2maps'];
                $ins_code_array['criteria']             = $data['init_criteria'];
                $ins_code_array['inclusion_criteria']   = $data['init_inclusion_criteria'];
                $ins_code_array['exclusion_criteria']   = $data['init_exclusion_criteria'];
                $ins_code_array['consideration']        = $data['init_consideration'];
                $ins_code_array['note']                 = $data['init_note'];
                $ins_code_array['dcode1ext_notify']     = $data['init_dcode1ext_notify'];
                $ins_code_array['commonly_used']        = $data['init_commonly_used'];
                //$ins_code_array['dcode1ext_x01'] = $data['init_dcode1ext_x01'];
                //$ins_code_array['dcode1ext_x02'] = $data['init_dcode1ext_x02'];
                //$ins_code_array['dcode1ext_x03'] = $data['init_dcode1ext_x03'];
                $ins_code_array['remarks']              = $data['init_remarks'];
                $ins_code_array['dcode1ext_active']     = $data['init_dcode1ext_active'];
	            $ins_code_data       =   $this->mutil_wdb->insert_new_dcode1ext($ins_code_array);
            } elseif($data['form_purpose'] == "edit_code") {
                // Existing supplier record
                $upd_code_array   =   array();
                $upd_code_array['edit_staff']             = $this->session->userdata('staff_id');//$this->session->userdata('staff_id');
                $upd_code_array['now_id']               = $data['now_id'];
                $upd_code_array['dcode1ext_id']         = $data['dcode1ext_id'];
                //$upd_code_array['dcode1_id']            = $data['init_dcode1_id'];
                //$upd_code_array['dcode1set']            = $data['init_dcode1set'];
                $upd_code_array['dcode1ext_code']       = $data['init_dcode1ext_code'];
                $upd_code_array['dcode1ext_longname']   = $data['init_dcode1ext_longname'];
                $upd_code_array['dcode1ext_shortname']  = $data['init_dcode1ext_shortname'];
                $upd_code_array['component']            = $data['init_component'];
                $upd_code_array['code_use']             = $data['init_code_use'];
                $upd_code_array['chapter']              = $data['init_chapter'];
                $upd_code_array['topic']                = $data['init_topic'];
                $upd_code_array['full_title']           = $data['init_full_title'];
                $upd_code_array['short_title']          = $data['init_short_title'];
                $upd_code_array['description']          = $data['init_description'];
                $upd_code_array['dcode2maps']           = $data['init_dcode2maps'];
                $upd_code_array['criteria']             = $data['init_criteria'];
                $upd_code_array['inclusion_criteria']   = $data['init_inclusion_criteria'];
                $upd_code_array['exclusion_criteria']   = $data['init_exclusion_criteria'];
                $upd_code_array['consideration']        = $data['init_consideration'];
                $upd_code_array['note']                 = $data['init_note'];
                if(is_numeric($data['init_dcode1ext_notify'])){
                    $upd_code_array['dcode1ext_notify']= $data['init_dcode1ext_notify'];
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
                $upd_code_array['dcode1ext_active']     = $data['init_dcode1ext_active'];
                $upd_code_array['edit_remarks']              = $data['init_edit_remarks'];
                $upd_code_array['edit_date']              = $data['now_date'];
	            $upd_code_data       =   $this->mutil_wdb->update_dcode1ext($upd_code_array);
            } //endif($data['diagnosis_id'] == "new_code")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_diagnosisext_codes/dcode1ext_code/".$data['dcode1_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_diagnosisext_code') == FALSE)


    } // end of function util_edit_diagnosisext_info()


    // ------------------------------------------------------------------------
    function util_list_drugatc($seg3, $seg4)  // template for new classes
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
        
		$data['title'] = "THIRRA - List of Drugs ATC Codes";
		$data['drugatc_list']  = $this->mutil_rdb->get_drugatc_codes_list('data',$data['sort_order'],$data['per_page'],$data['row_first']);
		$data['count_fulllist']  = $this->mutil_rdb->get_drugatc_codes_list('count',$data['sort_order'],'ALL',0);
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drugatc/".$data['sort_order']."/";
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
            $new_body   =   "ehr_util_list_drugatc_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_drugatc_html";
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
		
    } // end of function util_list_drugatc($id)


    // ------------------------------------------------------------------------
    function util_edit_drugatc($seg3, $seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drugatc/atc_code/0','List ATC Drug Codes');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['atc_code']		    = 	$seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['form_purpose']       = $_POST['form_purpose'];
            $data['init_atc_chemical']  = $_POST['atc_chemical'];
            $data['init_drug_atc_id']   = $_POST['drug_atc_id'];
            $data['init_atc_code']      = $_POST['atc_code'];
            $data['init_part_atc_code'] = $_POST['part_atc_code'];
            $data['init_atc_name']      = $_POST['atc_name'];
            $data['init_ddd_qty']       = $_POST['ddd_qty'];
            $data['init_ddd_unit']      = $_POST['ddd_unit'];
            $data['init_admin_route']   = $_POST['admin_route'];
            $data['init_remarks']       = $_POST['remarks'];
            $data['init_drug_interaction'] = $_POST['drug_interaction'];
            if(!empty($data['init_atc_chemical'])){
                // User has chosen a chemical
                $data['code_info']  = $this->mutil_rdb->get_drugatc_chemical_list('data','atc_chemical','ALL',0,$data['init_atc_chemical']);
                $data['init_atc_anatomical']    = $data['code_info'][0]['atc_anatomical'];
                $data['init_atc_therapeutic']   = $data['code_info'][0]['atc_therapeutic'];
                $data['init_atc_pharmaco']      = $data['code_info'][0]['atc_pharmaco'];
                $data['init_desc_anatomical']   = $data['code_info'][0]['desc_anatomical'];
                $data['init_desc_therapeutic']  = $data['code_info'][0]['desc_therapeutic'];
                $data['init_desc_pharmaco']     = $data['code_info'][0]['desc_pharmaco'];
                $data['init_desc_chemical']     = $data['code_info'][0]['desc_chemical'];
                $data['init_atc_code']         = $data['init_atc_chemical'].$data['init_part_atc_code'];
            } else {
                $data['init_atc_anatomical']    = "";
                $data['init_atc_therapeutic']   = "";
                $data['init_atc_pharmaco']      = "";
                $data['init_desc_anatomical']   = "";
                $data['init_desc_therapeutic']  = "";
                $data['init_desc_pharmaco']     = "";
                $data['init_desc_chemical']     = "";
            }
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_code") {
                $data['init_atc_code']          = "";
                $data['init_drug_atc_id']       = "";
                $data['init_atc_anatomical']    = "";
                $data['init_atc_therapeutic']   = "";
                $data['init_atc_pharmaco']      = "";
                $data['init_atc_chemical']      = "";
                $data['init_desc_anatomical']   = "";
                $data['init_desc_therapeutic']  = "";
                $data['init_desc_pharmaco']     = "";
                $data['init_desc_chemical']     = "";
                $data['init_atc_name']          = "";
                $data['init_ddd_qty']           = NULL;
                $data['init_ddd_unit']          = "";
                $data['init_admin_route']       = "";
                $data['init_remarks']           = "";
                $data['init_drug_interaction']  = "";
                $data['init_part_atc_code']     = "";
            } elseif ($data['form_purpose'] == "edit_code") {
                //echo "Edit supplier";
                $data['code_info']  = $this->mutil_rdb->get_drugatc_codes_list('data','atc_code',1,0,$data['atc_code']);
                $data['init_atc_code']          = $data['atc_code'];
                $data['init_drug_atc_id']       = $data['code_info'][0]['drug_atc_id'];
                $data['init_atc_anatomical']    = $data['code_info'][0]['atc_anatomical'];
                $data['init_atc_therapeutic']   = $data['code_info'][0]['atc_therapeutic'];
                $data['init_atc_pharmaco']      = $data['code_info'][0]['atc_pharmaco'];
                $data['init_atc_chemical']      = $data['code_info'][0]['atc_chemical'];
                $data['init_desc_anatomical']   = $data['code_info'][0]['desc_anatomical'];
                $data['init_desc_therapeutic']  = $data['code_info'][0]['desc_therapeutic'];
                $data['init_desc_pharmaco']     = $data['code_info'][0]['desc_pharmaco'];
                $data['init_desc_chemical']     = $data['code_info'][0]['desc_chemical'];
                $data['init_atc_name']          = $data['code_info'][0]['atc_name'];
                $data['init_ddd_qty']           = $data['code_info'][0]['ddd_qty'];
                $data['init_ddd_unit']          = $data['code_info'][0]['ddd_unit'];
                $data['init_admin_route']       = $data['code_info'][0]['admin_route'];
                $data['init_remarks']           = $data['code_info'][0]['remarks'];
                $data['init_drug_interaction']  = $data['code_info'][0]['drug_interaction'];
                $data['init_part_atc_code']     = substr($data['init_atc_code'],5);
            } //endif ($data['form_purpose'] == "new_code")
        } //endif(count($_POST))
		$data['title'] = "Add/Edit ATC Drug Code";
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['chemical_list']  = $this->mutil_rdb->get_drugatc_chemical_list('data','atc_chemical','ALL',0);
        $data['same_chemical']  = $this->mutil_rdb->get_drugatc_codes_list('data','atc_code','ALL',0,NULL,$data['init_atc_chemical']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_drug_atc') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                $new_body   =   "ehr_util_edit_drugatc_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_drugatc_html";
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
            //echo "\nValidated successfully.";
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_code") {
                // New code record
                $ins_code_array   =   array();
                $ins_code_array['drug_atc_id']      = $data['now_id'];
                $ins_code_array['atc_code']         = $data['init_atc_code'];
                $ins_code_array['atc_anatomical']   = $data['init_atc_anatomical'];
                $ins_code_array['atc_therapeutic']  = $data['init_atc_therapeutic'];
                $ins_code_array['atc_pharmaco']     = $data['init_atc_pharmaco'];
                $ins_code_array['atc_chemical']     = $data['init_atc_chemical'];
                $ins_code_array['desc_anatomical']  = $data['init_desc_anatomical'];
                $ins_code_array['desc_therapeutic'] = $data['init_desc_therapeutic'];
                $ins_code_array['desc_pharmaco']    = $data['init_desc_pharmaco'];
                $ins_code_array['desc_chemical']    = $data['init_desc_chemical'];
                $ins_code_array['atc_name']         = $data['init_atc_name'];
                if(is_numeric($data['init_ddd_qty'])){
                    $ins_code_array['ddd_qty']             = $data['init_ddd_qty'];
                }
                //$ins_code_array['ddd_qty']          = $data['init_ddd_qty'];
                $ins_code_array['ddd_unit']         = $data['init_ddd_unit'];
                $ins_code_array['admin_route']      = $data['init_admin_route'];
                $ins_code_array['remarks']          = $data['init_remarks'];
                $ins_code_array['drug_interaction'] = $data['init_drug_interaction'];
                $ins_code_array['added_remarks']    = "THIRRA";
                $ins_code_array['added_staff']      = $this->session->userdata('staff_id');
                $ins_code_array['added_date']       = $data['now_date'];
                if($data['offline_mode']){
                    $ins_code_array['synch_out']      = $data['now_id'];
                }
	            $ins_code_data       =   $this->mutil_wdb->insert_new_drugatc_code($ins_code_array);
                $this->session->set_flashdata('data_activity', 'ATC code added.');
            } elseif($data['form_purpose'] == "edit_code") {
                // Existing code record
                $upd_code_array   =   array();
                $upd_code_array['drug_atc_id']      = $data['init_drug_atc_id'];
                $upd_code_array['atc_code']         = $data['init_atc_code'];
                $upd_code_array['atc_anatomical']   = $data['init_atc_anatomical'];
                $upd_code_array['atc_therapeutic']  = $data['init_atc_therapeutic'];
                $upd_code_array['atc_pharmaco']     = $data['init_atc_pharmaco'];
                $upd_code_array['atc_chemical']     = $data['init_atc_chemical'];
                $upd_code_array['desc_anatomical']  = $data['init_desc_anatomical'];
                $upd_code_array['desc_therapeutic'] = $data['init_desc_therapeutic'];
                $upd_code_array['desc_pharmaco']    = $data['init_desc_pharmaco'];
                $upd_code_array['desc_chemical']    = $data['init_desc_chemical'];
                $upd_code_array['atc_name']         = $data['init_atc_name'];
                //$upd_code_array['ddd_qty']          = $data['init_ddd_qty'];
                //$upd_code_array['ddd_unit']         = $data['init_ddd_unit'];
                //$upd_code_array['admin_route']      = $data['init_admin_route'];
                $upd_code_array['remarks']          = $data['init_remarks'];
                //$upd_code_array['drug_interaction'] = $data['init_drug_interaction'];
                $upd_code_array['added_remarks']    = "THIRRA";
                $upd_code_array['added_staff']      = $this->session->userdata('staff_id');
                $upd_code_array['added_date']       = $data['now_date'];
                if($data['offline_mode']){
                    $upd_code_array['synch_out']      = $data['now_id'];
                }
	            $upd_code_data       =   $this->mutil_wdb->update_drugatc_code($upd_code_array);
                $this->session->set_flashdata('data_activity', 'ATC code updated.');
            } //endif($data['diagnosis_id'] == "new_code")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drugatc/atc_code/0";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_complaint_code') == FALSE)


    } // end of function util_edit_drugatc()


    // ------------------------------------------------------------------------
    function util_list_drugformulary($seg3, $seg4)  // template for new classes
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
        
		$data['title'] = "THIRRA - List of Drug Formularies";
		$data['formulary_list']  = $this->mutil_rdb->get_drug_formulary_list('data',$data['sort_order'],$data['per_page'],$data['row_first']);
		$data['count_fulllist']  = $this->mutil_rdb->get_drug_formulary_list('count',$data['sort_order'],'ALL',0);
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drugformulary/".$data['sort_order']."/";
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
            $new_body   =   "ehr_util_list_drugformulary_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_drugformulary_html";
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
		
    } // end of function util_list_drugformulary($id)


    // ------------------------------------------------------------------------
    function util_edit_drugformulary($seg3, $seg4, $seg5)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
        $data['drugformulary_length']=	$this->config->item('drugformulary_length');
        $data['drugcode_length']    =	$this->config->item('drugcode_length');
        $data['drugatc_length']     =	7;
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drugformulary/formulary_code/0','List Drug Formularies');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['drug_formulary_id']  = 	$seg4; //$this->uri->segment(4);
        $data['dcode1ext_id']		= 	$seg5; //$this->uri->segment(5);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['init_part_formulary_code'] = $_POST['part_formulary_code'];
            $data['init_atc_code']          = $_POST['atc_code'];
            $data['init_generic_name']      = $_POST['generic_name'];
            $data['init_trade_name']        = $_POST['trade_name'];
            $data['init_formulary_system']  = $_POST['formulary_system'];
            $data['init_commonly_used']     = $_POST['commonly_used'];
            $data['init_usfda_preg_cat']    = $_POST['usfda_preg_cat'];
            $data['init_poison_cat']        = $_POST['poison_cat'];
            $data['init_dose_form']         = $_POST['dose_form'];
            $data['init_indication']        = $_POST['indication'];
            $data['init_dosage']            = $_POST['dosage'];
            $data['init_contra_indication'] = $_POST['contra_indication'];
            $data['init_precautions']       = $_POST['precautions'];
            $data['init_interactions']      = $_POST['interactions'];
            $data['init_adverse_reactions'] = $_POST['adverse_reactions'];
            //$data['init_added_remarks']    = $_POST['added_remarks'];
       } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_formulary") {
                $data['dcode1ext_id']           =   $data['dcode1ext_id'];
                $data['init_part_formulary_code']=   "";
                $data['init_atc_code']          =   "";
                $data['init_generic_name']      =   "";
                $data['init_trade_name']        =   "";
                $data['init_formulary_system']  =   "";
                $data['init_commonly_used']     =   "";
                $data['init_usfda_preg_cat']    =   "";
                $data['init_poison_cat']        =   "";
                $data['init_dose_form']         =   "";
                $data['init_indication']        =   "";
                $data['init_dosage']            =   "";
                $data['init_contra_indication'] =   "";
                $data['init_precautions']       =   "";
                $data['init_interactions']      =   "";
                $data['init_adverse_reactions'] =   "";
            } elseif ($data['form_purpose'] == "edit_formulary") {
                //echo "Edit supplier";
                $data['formulary_info']  = $this->mutil_rdb->get_drug_formulary_list('data','formulary_code',1,0,$data['drug_formulary_id']);
                $data['init_formulary_code']    = $data['formulary_info'][0]['formulary_code'];
                $data['init_part_formulary_code']= substr($data['init_formulary_code'],$data['drugatc_length']);
                $data['init_atc_code']          = $data['formulary_info'][0]['atc_code'];
                $data['init_generic_name']      = $data['formulary_info'][0]['generic_name'];
                $data['init_trade_name']        = $data['formulary_info'][0]['trade_name'];
                $data['init_formulary_system']  = $data['formulary_info'][0]['formulary_system'];
                $data['init_commonly_used']     = $data['formulary_info'][0]['commonly_used'];
                $data['init_usfda_preg_cat']    = $data['formulary_info'][0]['usfda_preg_cat'];
                $data['init_poison_cat']        = $data['formulary_info'][0]['poison_cat'];
                $data['init_dose_form']         = $data['formulary_info'][0]['dose_form'];
                $data['init_indication']        = $data['formulary_info'][0]['indication'];
                $data['init_dosage']            = $data['formulary_info'][0]['dosage'];
                $data['init_contra_indication'] = $data['formulary_info'][0]['contra_indication'];
                $data['init_precautions']       = $data['formulary_info'][0]['precautions'];
                $data['init_interactions']      = $data['formulary_info'][0]['interactions'];
                $data['init_adverse_reactions'] = $data['formulary_info'][0]['adverse_reactions'];
           } //endif ($data['form_purpose'] == "new_formulary")
        } //endif(count($_POST))
        $data['formulary_system']  = $this->mutil_rdb->get_drug_formulary_system('formulary_system','ALL',0);
		$data['atc_list']  = $this->mutil_rdb->get_drugatc_codes_list('data','atc_code','ALL',0);
        //$data['atc_list']  = $this->mutil_rdb->get_drug_atc('atc_code','ALL',0);
        //$data['atc_info']  = $this->mutil_rdb->get_drug_atc('atc_code','ALL',0,$data['init_atc_code']); // Deprecated
        $data['drugcode_list']  = $this->mutil_rdb->get_drug_code_list('data','trade_name','All',0,NULL,$data['drug_formulary_id']);
        $data['code_info']  = $this->mutil_rdb->get_drugatc_codes_list('data','atc_code',1,0,$data['init_atc_code']);
        //$data['init_atc_code']          = $data['init_atc_code'];
        if(count($data['code_info']) > 0){
            $data['init_drug_atc_id']       = $data['code_info'][0]['drug_atc_id'];
            $data['init_atc_anatomical']    = $data['code_info'][0]['atc_anatomical'];
            $data['init_atc_therapeutic']   = $data['code_info'][0]['atc_therapeutic'];
            $data['init_atc_pharmaco']      = $data['code_info'][0]['atc_pharmaco'];
            $data['init_atc_chemical']      = $data['code_info'][0]['atc_chemical'];
            $data['init_desc_anatomical']   = $data['code_info'][0]['desc_anatomical'];
            $data['init_desc_therapeutic']  = $data['code_info'][0]['desc_therapeutic'];
            $data['init_desc_pharmaco']     = $data['code_info'][0]['desc_pharmaco'];
            $data['init_desc_chemical']     = $data['code_info'][0]['desc_chemical'];
            $data['init_atc_name']          = $data['code_info'][0]['atc_name'];
            $data['init_ddd_qty']           = $data['code_info'][0]['ddd_qty'];
            $data['init_ddd_unit']          = $data['code_info'][0]['ddd_unit'];
            $data['init_admin_route']       = $data['code_info'][0]['admin_route'];
            $data['init_remarks']           = $data['code_info'][0]['remarks'];
            $data['init_drug_interaction']  = $data['code_info'][0]['drug_interaction'];
            $data['init_part_atc_code']     = substr($data['init_atc_code'],5);
        } else {
            $data['init_desc_pharmaco']     = "";
            $data['init_desc_chemical']     = "";            
        }
		$data['title'] = "Add/Edit Drug Formulary";
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_drug_formulary') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                $new_body   =   "ehr_util_edit_drugformulary_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_drugformulary_html";
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
            //echo "\nValidated successfully.";
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_formulary") {
                // New area record
                $ins_drug_array   =   array();
                $ins_drug_array['staff_id']         = $this->session->userdata('staff_id');
                $ins_drug_array['now_id']           = $data['now_id'];
                $ins_drug_array['drug_formulary_id']= $data['now_id'];
                $ins_drug_array['formulary_code']   = $data['init_atc_code'].$data['init_part_formulary_code'];
                $ins_drug_array['atc_code']         = $data['init_atc_code'];
                $ins_drug_array['generic_name']     = $data['init_generic_name'];
                $ins_drug_array['trade_name']       = $data['init_trade_name'];
                $ins_drug_array['formulary_system'] = $data['init_formulary_system'];
                if(is_numeric($data['init_commonly_used'])){
                    $ins_drug_array['commonly_used']= $data['init_commonly_used'];
                }
                //$ins_drug_array['commonly_used']    = $data['init_commonly_used'];
                $ins_drug_array['usfda_preg_cat']   = $data['init_usfda_preg_cat'];
                $ins_drug_array['poison_cat']       = $data['init_poison_cat'];
                $ins_drug_array['dose_form']        = $data['init_dose_form'];
                $ins_drug_array['indication']       = $data['init_indication'];
                $ins_drug_array['dosage']           = $data['init_dosage'];
                $ins_drug_array['contra_indication']= $data['init_contra_indication'];
                $ins_drug_array['precautions']      = $data['init_precautions'];
                $ins_drug_array['interactions']     = $data['init_interactions'];
                $ins_drug_array['adverse_reactions']= $data['init_adverse_reactions'];
                $ins_drug_array['added_remarks']    = "THIRRA user";
                //$ins_drug_array['added_remarks']    = $data['init_added_remarks'];
                $ins_drug_array['added_staff']      = $ins_drug_array['staff_id'];
                $ins_drug_array['added_date']       = $data['now_date'];
                if($data['offline_mode']){
                    $ins_drug_array['synch_out']      = $data['now_id'];
                }
	            $ins_drug_data       =   $this->mutil_wdb->insert_new_drugformulary($ins_drug_array);
                $this->session->set_flashdata('data_activity', 'Drug formulary added.');
            } elseif($data['form_purpose'] == "edit_formulary") {
                // Existing supplier record
                $upd_drug_array   =   array();
                $upd_drug_array['staff_id']       	= $this->session->userdata('staff_id');
                $upd_drug_array['drug_formulary_id']= $data['drug_formulary_id'];
                $upd_drug_array['formulary_code']   = $data['init_atc_code'].$data['init_part_formulary_code'];
                $upd_drug_array['atc_code']         = $data['init_atc_code'];
                $upd_drug_array['generic_name']     = $data['init_generic_name'];
                $upd_drug_array['trade_name']       = $data['init_trade_name'];
                $upd_drug_array['formulary_system'] = $data['init_formulary_system'];
                if(is_numeric($data['init_commonly_used'])){
                    $upd_drug_array['commonly_used']= $data['init_commonly_used'];
                }
                //$upd_drug_array['commonly_used']  = $data['init_commonly_used'];
                $upd_drug_array['usfda_preg_cat']   = $data['init_usfda_preg_cat'];
                $upd_drug_array['poison_cat']       = $data['init_poison_cat'];
                $upd_drug_array['dose_form']        = $data['init_dose_form'];
                $upd_drug_array['indication']       = $data['init_indication'];
                $upd_drug_array['dosage']           = $data['init_dosage'];
                $upd_drug_array['contra_indication']= $data['init_contra_indication'];
                $upd_drug_array['precautions']      = $data['init_precautions'];
                $upd_drug_array['interactions']     = $data['init_interactions'];
                $upd_drug_array['adverse_reactions']= $data['init_adverse_reactions'];
	            $upd_drug_data       =   $this->mutil_wdb->update_drug_formulary($upd_drug_array);
                $this->session->set_flashdata('data_activity', 'Drug formulary updated.');
            } //endif($data['diagnosis_id'] == "new_formulary")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes//util_list_drugformulary/commonly_used/0";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_drug_formulary') == FALSE)


    } // end of function util_edit_drugformulary()


    // ------------------------------------------------------------------------
    function util_list_drug_codes($seg3, $seg4)  
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
        
		$data['title'] = "THIRRA - List of Drug Formularies";
		$data['drugcode_list']  = $this->mutil_rdb->get_drug_code_list('data',$data['sort_order'],$data['per_page'],$data['row_first']);
		$data['count_fulllist']  = $this->mutil_rdb->get_drug_code_list('count',$data['sort_order'],'ALL',0);
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drug_codes/".$data['sort_order']."/";
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
            $new_body   =   "ehr_util_list_drug_codes_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_drug_codes_html";
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
		
    } // end of function util_list_drug_codes($id)


    // ------------------------------------------------------------------------
    function util_edit_drugcode($seg3, $seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
        $data['drugformulary_length']=	$this->config->item('drugformulary_length');
        $data['drugcode_length']    =	$this->config->item('drugcode_length');
        $data['drugatc_length']     =	$this->_drugatc_length;
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drug_codes/drug_code/0','List Drug Codes');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['drug_code_id']       = 	$seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['init_drug_locale']           = $_POST['drug_locale'];
            $data['init_part_drug_code']    = $_POST['part_drug_code'];
            $data['init_drug_formulary_id'] = $_POST['drug_formulary_id'];
            $data['init_trade_name']        = $_POST['trade_name'];
            $data['init_pbkd_no']           = $_POST['pbkd_no'];
            $data['init_commonly_used']     = $_POST['commonly_used'];
            $data['init_usfda_preg_cat']    = $_POST['usfda_preg_cat'];
            $data['init_poison_cat']        = $_POST['poison_cat'];
            //$data['init_added_remarks']    = $_POST['added_remarks'];
       } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_drugcode") {
                $data['init_drug_code_id']          =   $data['drug_code_id'];
                $data['init_drug_locale']           = "";
                $data['init_part_drug_code']        =   "";
                $data['init_drug_formulary_code']   =   "";
                $data['init_drug_formulary_id']     =   "";
                $data['init_generic_name']          =   "";
                $data['init_trade_name']            =   "";
                $data['init_pbkd_no']               =   "";
                $data['init_commonly_used']         =   "";
                $data['init_usfda_preg_cat']        =   "";
                $data['init_poison_cat']            =   "";
            } elseif ($data['form_purpose'] == "edit_drugcode") {
                //echo "Edit supplier";
                $data['drugcode_info']  = $this->mutil_rdb->get_drug_code_list('data','drug_code',1,0,$data['drug_code_id']);
                $data['init_drug_locale']           = $data['drugcode_info'][0]['drug_locale'];
                $data['init_drug_code']    = $data['drugcode_info'][0]['drug_code'];
                //echo $data['drugatc_length']+$data['drugformulary_length'];
                $data['init_part_drug_code']= substr($data['init_drug_code'],($data['drugatc_length']+$data['drugformulary_length']));
                $data['init_drug_formulary_code']    = $data['drugcode_info'][0]['drug_formulary_code'];
                $data['init_drug_formulary_id']    = $data['drugcode_info'][0]['drug_formulary_id'];
                $data['init_generic_name']      = $data['drugcode_info'][0]['generic_name'];
                $data['init_trade_name']        = $data['drugcode_info'][0]['trade_name'];
                $data['init_pbkd_no']           = $data['drugcode_info'][0]['pbkd_no'];
                $data['init_commonly_used']     = $data['drugcode_info'][0]['commonly_used'];
                $data['init_usfda_preg_cat']    = $data['drugcode_info'][0]['usfda_preg_cat'];
                $data['init_poison_cat']        = $data['drugcode_info'][0]['poison_cat'];
                //$data['formulary_info']  = $this->mutil_rdb->get_drug_formulary_list('data','formulary_code',1,0,$data['init_drug_formulary_id']);
           } //endif ($data['form_purpose'] == "new_drugcode")
        } //endif(count($_POST))
		$data['title'] = "Add/Edit Drug Code";
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['sort_order']   	    = "generic_name";
        $data['per_page']           = "ALL";
        $data['row_first']   	    = 0;
		$data['formulary_list']  = $this->mutil_rdb->get_drug_formulary_list('data',$data['sort_order'],$data['per_page'],$data['row_first']);
        $data['drugcode_list']  = $this->mutil_rdb->get_drug_code_list('data','trade_name','All',0,NULL,$data['init_drug_formulary_id']);
        $data['formulary_info']  = $this->mutil_rdb->get_drug_formulary_list('data','formulary_code',1,0,$data['init_drug_formulary_id']);
        if(!empty($data['formulary_info'])){
            $data['init_drug_formulary_code'] =   $data['formulary_info'][0]['formulary_code'];
        }

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_drug_code') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                $new_body   =   "ehr_util_edit_drugcode_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_drugcode_html";
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
            //echo "\nValidated successfully.";
            //echo "<br />Insert record";
            $data['chosen_formulary']  = $this->mutil_rdb->get_drug_formulary_list('data','formulary_code',1,0,$data['init_drug_formulary_id']);
            if($data['form_purpose'] == "new_drugcode") {
                switch ($data['app_country']){
                    case "Malaysia":
                        $data['init_drug_locale'] = "MY"; 
                        break;			
                    case "Nepal":
                        $data['init_drug_locale'] = "NP";
                        break;			
                    case "Philippines":
                        $data['init_drug_locale'] = "PH";
                        break;			
                    case "Sri Lanka":
                        $data['init_drug_locale'] = "SL";
                        break;			
                    default:
                        $data['init_drug_locale'] = "Any";
                } //end switch ($data['app_country'])

                // New area record
                $ins_drug_array   =   array();
                $ins_drug_array['now_id']               = $data['now_id'];
                $ins_drug_array['drug_code_id']         = $data['now_id'];
                $ins_drug_array['drug_locale']          = $data['init_drug_locale'];
                $ins_drug_array['drug_code']            = $data['chosen_formulary'][0]['formulary_code'].$data['init_part_drug_code'];
                $ins_drug_array['drug_formulary_code']  = $data['chosen_formulary'][0]['formulary_code'];
                $ins_drug_array['drug_formulary_id']    = $data['init_drug_formulary_id'];
                $ins_drug_array['atc_code']             = $data['chosen_formulary'][0]['atc_code'];
                $ins_drug_array['generic_name']         = $data['chosen_formulary'][0]['generic_name'];
                $ins_drug_array['trade_name']           = $data['init_trade_name'];
                $ins_drug_array['drug_system']          = $data['chosen_formulary'][0]['formulary_system'];
                $ins_drug_array['pbkd_no']              = $data['init_pbkd_no'];
                if(is_numeric($data['init_commonly_used'])){
                    $ins_area_array['commonly_used']= $data['init_commonly_used'];
                }
                //$ins_drug_array['commonly_used']    = $data['init_commonly_used'];
                $ins_drug_array['usfda_preg_cat']   = $data['init_usfda_preg_cat'];
                $ins_drug_array['poison_cat']       = $data['init_poison_cat'];
                //$ins_drug_array['immunisation_drug_id']           = $data['immunisation_drug_id'];
                $ins_drug_array['added_remarks']    = "THIRRA user";
                //$ins_drug_array['added_remarks']    = $data['init_added_remarks'];
                $ins_drug_array['added_staff']      = $this->session->userdata('staff_id');
                $ins_drug_array['added_date']       = $data['now_date'];
                if($data['offline_mode']){
                    $ins_drug_array['synch_out']      = $data['now_id'];
                }
	            $ins_drug_data       =   $this->mutil_wdb->insert_new_drugcode($ins_drug_array);
                $this->session->set_flashdata('data_activity', 'Drug code added.');
            } elseif($data['form_purpose'] == "edit_drugcode") {
                // Existing supplier record
                $upd_drug_array   =   array();
                $upd_drug_array['now_id']               = $data['now_id'];
                $upd_drug_array['drug_code_id']         = $data['drug_code_id'];
                $upd_drug_array['drug_locale']          = $data['init_drug_locale'];
                $upd_drug_array['drug_code']            = $data['chosen_formulary'][0]['formulary_code'].$data['init_part_drug_code'];
                $upd_drug_array['drug_formulary_code']  = $data['chosen_formulary'][0]['formulary_code'];
                $upd_drug_array['drug_formulary_id']    = $data['init_drug_formulary_id'];
                $upd_drug_array['atc_code']             = $data['chosen_formulary'][0]['atc_code'];
                $upd_drug_array['generic_name']         = $data['chosen_formulary'][0]['generic_name'];
                $upd_drug_array['trade_name']           = $data['init_trade_name'];
                $upd_drug_array['drug_system']          = $data['chosen_formulary'][0]['formulary_system'];
                $upd_drug_array['pbkd_no']              = $data['init_pbkd_no'];
                if(is_numeric($data['init_commonly_used'])){
                    $upd_drug_array['commonly_used']= $data['init_commonly_used'];
                }
                //$upd_drug_array['commonly_used']    = $data['init_commonly_used'];
                $upd_drug_array['usfda_preg_cat']   = $data['init_usfda_preg_cat'];
                $upd_drug_array['poison_cat']       = $data['init_poison_cat'];
                //$upd_drug_array['immunisation_drug_id']           = $data['immunisation_drug_id'];
                $upd_drug_array['added_remarks']    = "Modified by";
                //$upd_drug_array['added_remarks']    = $data['init_added_remarks'];
                $upd_drug_array['added_staff']      = $this->session->userdata('staff_id');
                $upd_drug_array['added_date']       = $data['now_date'];
                $upd_drug_data       =   $this->mutil_wdb->update_drug_code($upd_drug_array);
                $this->session->set_flashdata('data_activity', 'Drug code updated.');
            } //endif($data['diagnosis_id'] == "new_drugcode")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drug_codes/commonly_used/0";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_drug_code') == FALSE)


    } // end of function util_edit_drugcode()


    // ------------------------------------------------------------------------
    function util_list_immunisation_codes($seg3, $seg4)  // template for new classes
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
        
		$data['title'] = "THIRRA - List of Immunisation Codes";
		$data['immunisation_list']  = $this->mutil_rdb->get_immunisation_codes_list('data',$data['sort_order'],$data['per_page'],$data['row_first']);
		$data['count_fulllist']  = $this->mutil_rdb->get_immunisation_codes_list('count',$data['sort_order'],'ALL',0);
        
        $this->load->library('pagination');

        $config['base_url'] = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_immunisation_codes/".$data['sort_order']."/";
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
            $new_body   =   "ehr_util_list_immunisation_codes_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_immunisation_codes_html";
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
		
    } // end of function util_list_immunisation_codes($id)


    // ------------------------------------------------------------------------
    function util_edit_immunisation_code($seg3, $seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$this->load->model('memr_rdb');
		$this->load->model('mpharma_rdb');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_drug_codes/drug_code/0','List Drug Codes');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['immunisation_id']    = 	$seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['form_purpose']           = $_POST['form_purpose'];
            $data['init_vaccine_short']         = $_POST['vaccine_short'];
            $data['init_vaccine']         = $_POST['vaccine'];
            $data['init_dose']  = $_POST['dose'];
            $data['init_description'] = $_POST['description'];
            $data['init_immunisation_sort']            = $_POST['immunisation_sort'];
            $data['init_age_group']          = $_POST['age_group'];
            $data['init_dose_frequency']= $_POST['dose_frequency'];
            $data['init_adverse_events']= $_POST['adverse_events'];
            $data['init_remarks']     = $_POST['remarks'];
            $data['init_immunisation_code']              = $_POST['immunisation_code'];
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_code") {
                $data['init_vaccine_short']       	= 	"";
                $data['init_vaccine']         =   "";
                $data['init_dose']  =   "";
                $data['init_description'] =   "";
                $data['init_immunisation_sort']= 0;
                $data['init_age_group']          =   "";
                $data['init_dose_frequency']=   "";
                $data['init_adverse_events']=   "";
                $data['init_remarks']     =   "";
                $data['init_immunisation_code']              =   "";
            } elseif ($data['form_purpose'] == "edit_code") {
                //echo "Edit supplier";
                $data['code_info']  = $this->mutil_rdb->get_immunisation_codes_list('data','immunisation_sort','ALL',0,$data['immunisation_id']);
                $data['init_vaccine_short']     = $data['code_info'][0]['vaccine_short'];
                $data['init_vaccine']           = $data['code_info'][0]['vaccine'];
                $data['init_dose']              = $data['code_info'][0]['dose'];
                $data['init_description']       = $data['code_info'][0]['description'];
                $data['init_immunisation_sort'] = $data['code_info'][0]['immunisation_sort'];
                $data['init_age_group']         = $data['code_info'][0]['age_group'];
                $data['init_dose_frequency']    = $data['code_info'][0]['dose_frequency'];
                $data['init_adverse_events']    = $data['code_info'][0]['adverse_events'];
                $data['init_remarks']           = $data['code_info'][0]['remarks'];
                $data['init_immunisation_code'] = $data['code_info'][0]['immunisation_code'];
            } //endif ($data['form_purpose'] == "new_code")
        } //endif(count($_POST))
        if(!empty($data['init_vaccine'])){
            $data['same_name']  = $this->mutil_rdb->get_immunisation_same_name($data['init_vaccine']);
        }
		$data['title'] = "Add/Edit Immunisation Code";
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['doses_list']  = $this->mutil_rdb->get_vaccine_doses();
		$data['vaccine_drugs'] = $this->mpharma_rdb->get_formulary_by_vaccine($data['immunisation_id']);
		$data['formulary_list'] = $this->mpharma_rdb->get_formulary_by_system('Immunological Products and Vaccines');

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_immunisation_code') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                $new_body   =   "ehr_util_edit_immunisation_code_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_immunisation_code_html";
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
            //echo "\nValidated successfully.";
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_code") {
                // New code record
                $ins_code_array   =   array();
                $ins_code_array['immunisation_id']      = $data['now_id'];
                $ins_code_array['vaccine_short']        = $data['init_vaccine_short'];
                $ins_code_array['vaccine']              = $data['init_vaccine'];
                $ins_code_array['dose']                 = $data['init_dose'];
                $ins_code_array['description']          = $data['init_description'];
                $ins_code_array['immunisation_sort']    = $data['init_immunisation_sort'];
                $ins_code_array['age_group']            = $data['init_age_group'];
                $ins_code_array['dose_frequency']       = $data['init_dose_frequency'];
                $ins_code_array['adverse_events']       = $data['init_adverse_events'];
                $ins_code_array['added_staff']          = $this->session->userdata('staff_id');
                $ins_code_array['added_date']           = $data['now_date'];
                $ins_code_array['added_remarks']        = "THIRRA";
                $ins_code_array['remarks']              = $data['init_remarks'];
                $ins_code_array['immunisation_code']    = $data['init_immunisation_code'];
                if($data['offline_mode']){
                    $ins_code_array['synch_out']      = $data['now_id'];
                }
	            $ins_code_data       =   $this->mutil_wdb->insert_new_immunisationcode($ins_code_array);
                $this->session->set_flashdata('data_activity', 'Immunisation code added.');
            } elseif($data['form_purpose'] == "edit_code") {
                // Existing supplier record
                $upd_code_array   =   array();
                $upd_code_array['immunisation_id']      = $data['immunisation_id'];
                $upd_code_array['vaccine_short']        = $data['init_vaccine_short'];
                $upd_code_array['vaccine']              = $data['init_vaccine'];
                $upd_code_array['dose']                 = $data['init_dose'];
                $upd_code_array['description']          = $data['init_description'];
                $upd_code_array['immunisation_sort']    = $data['init_immunisation_sort'];
                $upd_code_array['age_group']            = $data['init_age_group'];
                $upd_code_array['dose_frequency']       = $data['init_dose_frequency'];
                $upd_code_array['adverse_events']       = $data['init_adverse_events'];
                $upd_code_array['remarks']              = $data['init_remarks'];
                $upd_code_array['immunisation_code']    = $data['init_immunisation_code'];
                if($data['offline_mode']){
                    $upd_code_array['synch_out']      = $data['now_id'];
                }
	            $upd_code_data       =   $this->mutil_wdb->update_immunisation_code($upd_code_array);
                $this->session->set_flashdata('data_activity', 'Immunisation code updated.');
            } //endif($data['form_purpose'] == "new_code")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_immunisation_codes/immunisation_sort/0";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_immunisation_code') == FALSE)


    } // end of function util_edit_immunisation_code()


    // ------------------------------------------------------------------------
    function util_edit_immunisation_drug($seg3,$seg4)
    {
		$this->load->model('memr_rdb');
		$this->load->model('mpharma_rdb');
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_codes/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_list_immunisation_codes/immunisation_sort/0','List Immunisation Codes');    
        $data['form_purpose']   	= 	$seg3;//$this->uri->segment(3);
        $data['immunisation_id']    = 	$seg4;//$this->uri->segment(4);
	  	
        // User has posted the form
        $data['drug_formulary_id']  = $_POST['drug_formulary_id'];
        $data['remarks']            = $_POST['remarks'];
        $data['vaccine_short']      = $_POST['vaccine_short'];

        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        
        if(!empty($data['drug_formulary_id'])){
            $data['vaccine_drugs'] = $this->mpharma_rdb->get_formulary_by_vaccine($data['immunisation_id']);
            $drug_exists    =   FALSE;
            if(count($data['vaccine_drugs']) > 0) {
                foreach($data['vaccine_drugs'] as $vaccine_drug)
                {
                    if($data['drug_formulary_id']== $vaccine_drug['drug_formulary_id']){
                        echo "Exist";
                        $drug_exists    =   TRUE;
                    } else {
                        echo "unique";
                     }
                }
            }
            //echo "\nValidated successfully.";
            if($drug_exists    ==   FALSE || !isset($drug_exists)) {
                // New code record
                $ins_code_array   =   array();
                $ins_code_array['immunisation_drug_id'] = $data['now_id'];
                $ins_code_array['vaccine_short']        = $data['vaccine_short'];
                $ins_code_array['immunisation_id']      = $data['immunisation_id'];
                $ins_code_array['drug_formulary_id']    = $data['drug_formulary_id'];
                $ins_code_array['remarks']              = $data['remarks'];
	            $ins_code_data       =   $this->mutil_wdb->insert_new_immunisationdrug($ins_code_array);
                $this->session->set_flashdata('data_activity', 'Immunisation drug added.');
            } else {
                // Don't create duplicate records
                $this->session->set_flashdata('data_activity', 'Immunisation drug already exists. Not added.');
            }
        } else {
                $this->session->set_flashdata('data_activity', 'No generic drug was selected.');            
        } //endif(isset($data['drug_formulary_id']))
        $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_codes/util_edit_immunisation_code/edit_code/".$data['immunisation_id'];
        header("Status: 200");
        header("Location: ".$new_page);

    } // end of function util_edit_immunisation_drug()


}

/* End of file Ehr_utilities_codes.php */
/* Location: ./app_thirra/controllers/Ehr_utilities_codes.php */
