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
 * Controller Class for Utilities for Geographical regions
 *
 * This class is used for both narrowband and broadband EHR. 
 *
 * @version 0.9.13
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_utilities_geo extends MX_Controller 
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
    function util_list_addrvillages($seg3)  // template for new classes
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['sort_order']   	    = $seg3; //$this->uri->segment(3);
		$data['title'] = "THIRRA - List of Villages";
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/utilities_mgt','Utilities');    
		$data['village_list']  = $this->mutil_rdb->get_addr_village_list($data['app_country'],$data['sort_order']);
		$this->load->vars($data);
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
            //$new_body   =   "ehr/ehr_util_list_addrvillages_wap";
            $new_body   =   "ehr_util_list_addrvillages_html";
           $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_addrvillages_html";
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
		
    } // end of function util_list_addrvillages($id)


    // ------------------------------------------------------------------------
    function util_edit_village_info($seg3, $seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_village_sort','List Villages');    
        $data['form_purpose']   	= $seg3; //$this->uri->segment(3);
        $data['addr_village_id']	= $seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['form_purpose']       = $_POST['form_purpose'];
            $data['init_addr_village_id']      = $_POST['addr_village_id'];
            $data['init_addr_town_id']         = $_POST['addr_town_id'];
            $data['init_addr_area_id']         = $_POST['addr_area_id'];
            $data['init_addr_village_name']    = $_POST['addr_village_name'];
            $data['init_addr_village_code']    = $_POST['addr_village_code'];
            $data['init_addr_village_subcode'] = $_POST['addr_village_subcode'];
            $data['init_addr_village_sort']    = $_POST['addr_village_sort'];
            $data['init_addr_village_descr']   = $_POST['addr_village_descr'];
            $data['init_addr_village_section'] = $_POST['addr_village_section'];
            $data['init_addr_village_address1']= $_POST['addr_village_address1'];
            $data['init_addr_village_address2']= $_POST['addr_village_address2'];
            $data['init_addr_village_address3']= $_POST['addr_village_address3'];
            $data['init_addr_village_postcode']= $_POST['addr_village_postcode'];
            $data['init_addr_village_town']    = $_POST['addr_village_town'];
            $data['init_addr_village_state']   = $_POST['addr_village_state'];
            $data['init_addr_village_country'] = $_POST['addr_village_country'];
            $data['init_addr_village_tel']     = $_POST['addr_village_tel'];
            $data['init_addr_village_fax']     = $_POST['addr_village_fax'];
            $data['init_addr_village_email']   = $_POST['addr_village_email'];
            $data['init_addr_village_mgr1_position']= $_POST['addr_village_mgr1_position'];
            $data['init_addr_village_mgr1_name']= $_POST['addr_village_mgr1_name'];
            $data['init_addr_village_mgr2_position']= $_POST['addr_village_mgr2_position'];
            $data['init_addr_village_mgr2_name']= $_POST['addr_village_mgr2_name'];
            $data['init_addr_village_gps_lat'] = $_POST['addr_village_gps_lat'];
            $data['init_addr_village_gps_long']= $_POST['addr_village_gps_long'];
            $data['init_addr_village_population']= $_POST['addr_village_population'];
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_village") {
                $data['init_addr_town_id']            =   "";
                $data['init_addr_area_id']            =   "";
                $data['init_addr_village_name']       =   "";
                $data['init_addr_village_code']       =   "";
                $data['init_addr_village_subcode']    =   "";
                $data['init_addr_village_sort']       =   "";
                $data['init_addr_village_descr']      =   "";
                $data['init_addr_village_section']    =   "";
                $data['init_addr_village_address1']   =   "";
                $data['init_addr_village_address2']   =   "";
                $data['init_addr_village_address3']   =   "";
                $data['init_addr_village_postcode']   =   "";
                $data['init_addr_village_town']       =   "";
                $data['init_addr_village_state']      =   "";
                $data['init_addr_village_country']    =   "";
                $data['init_addr_village_tel']        =   "";
                $data['init_addr_village_fax']        =   "";
                $data['init_addr_village_email']      =   "";
                $data['init_addr_village_mgr1_position']=   "";
                $data['init_addr_village_mgr1_name']  =   "";
                $data['init_addr_village_mgr2_position']=   "";
                $data['init_addr_village_mgr2_name']  =   "";
                $data['init_addr_village_gps_lat']    =   "";
                $data['init_addr_village_gps_long']   =   "";
                $data['init_addr_village_population'] =   "";
            } elseif ($data['form_purpose'] == "edit_village") {
                //echo "Edit supplier";
                $data['village_info'] = $this->mutil_rdb->get_addr_village_list($data['app_country'],'addr_village_sort',$data['addr_village_id']);
                $data['init_addr_village_id']      = $data['addr_village_id'];
                $data['init_addr_town_id']         = $data['village_info'][0]['addr_town_id'];
                $data['init_addr_area_id']         = $data['village_info'][0]['addr_area_id'];
                $data['init_addr_village_name']    = $data['village_info'][0]['addr_village_name'];
                $data['init_addr_village_code']    = $data['village_info'][0]['addr_village_code'];
                $data['init_addr_village_subcode'] = $data['village_info'][0]['addr_village_subcode'];
                $data['init_addr_village_sort']    = $data['village_info'][0]['addr_village_sort'];
                $data['init_addr_village_descr']   = $data['village_info'][0]['addr_village_descr'];
                $data['init_addr_village_section'] = $data['village_info'][0]['addr_village_section'];
                $data['init_addr_village_address1']= $data['village_info'][0]['addr_village_address1'];
                $data['init_addr_village_address2']= $data['village_info'][0]['addr_village_address2'];
                $data['init_addr_village_address3']= $data['village_info'][0]['addr_village_address3'];
                $data['init_addr_village_postcode']= $data['village_info'][0]['addr_village_postcode'];
                $data['init_addr_village_town']    = $data['village_info'][0]['addr_village_town'];
                $data['init_addr_village_state']   = $data['village_info'][0]['addr_village_state'];
                $data['init_addr_village_country'] = $data['village_info'][0]['addr_village_country'];
                $data['init_addr_village_tel']     = $data['village_info'][0]['addr_village_tel'];
                $data['init_addr_village_fax']     = $data['village_info'][0]['addr_village_fax'];
                $data['init_addr_village_email']   = $data['village_info'][0]['addr_village_email'];
                $data['init_addr_village_mgr1_position']= $data['village_info'][0]['addr_village_mgr1_position'];
                $data['init_addr_village_mgr1_name']= $data['village_info'][0]['addr_village_mgr1_name'];
                $data['init_addr_village_mgr2_position']= $data['village_info'][0]['addr_village_mgr2_position'];
                $data['init_addr_village_mgr2_name']= $data['village_info'][0]['addr_village_mgr2_name'];
                $data['init_addr_village_gps_lat'] = $data['village_info'][0]['addr_village_gps_lat'];
                $data['init_addr_village_gps_long']= $data['village_info'][0]['addr_village_gps_long'];
                $data['init_addr_village_population']= $data['village_info'][0]['addr_village_population'];
            } //endif ($data['form_purpose'] == "new_supplier")
        } //endif(count($_POST))
		$data['title'] = "Add/Edit Village";
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
		$data['addr_area_id']		=	$data['init_addr_area_id'];
		$data['addr_town_list']  	= 	$this->mutil_rdb->get_addr_town_list($data['app_country'],'addr_town_sort');
		// Did user choose town
		if(!empty($data['init_addr_town_id']) && ($data['init_addr_town_id']<>"")){
			//echo "<hr />init_addr_town_id = ".$data['init_addr_town_id'];
			$data['addr_town_info']  = $this->mutil_rdb->get_addr_town_list("All",'addr_town_sort',$data['init_addr_town_id']);
			// Replace form selection of addr_area_id to addr_town_id's values.
			$data['addr_area_id']		=	$data['addr_town_info'][0]['addr_area_id'];
			$data['init_addr_area_id']		=	$data['addr_area_id'];
			$data['addr_district_id']	=	$data['addr_town_info'][0]['addr_district_id'];
		}
		$data['addr_area_list']  = $this->mutil_rdb->get_addr_area_list($data['app_country'],'addr_area_sort');
		if(isset($data['init_addr_town_id']) && empty($data['init_addr_town_id'])){
			$data['addr_area_info']  = $this->mutil_rdb->get_addr_area_list("All",'addr_area_sort',$data['addr_area_id']);
			if(count($data['addr_area_info']) > 0){
				$data['addr_district_id']	=	$data['addr_area_info'][0]['addr_district_id'];
			}
		}
		if(!empty($data['init_addr_town_id'])){
			$data['init_addr_village_town']=$data['addr_town_info'][0]['addr_town_name'];
			$data['init_addr_village_state']=$data['addr_town_info'][0]['addr_district_state'];
			$data['init_addr_village_country']=$data['addr_town_info'][0]['addr_district_country'];
		}

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_addr_village') == FALSE){
		    //$this->load->view('emr/emr_edit_patient_html');			
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                //$new_body   =   "ehr/ehr_util_edit_village_info_wap";
                $new_body   =   "ehr_util_edit_village_info_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_village_info_html";
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
            if($data['form_purpose'] == "new_village") {
                // New village record
                $ins_village_array   =   array();
                $ins_village_array['staff_id']             = $this->session->userdata('staff_id');
                $ins_village_array['now_id']               = $data['now_id'];
                $ins_village_array['addr_village_id']      = $data['now_id'];
                $ins_village_array['addr_town_id']         = $data['init_addr_town_id'];
                $ins_village_array['addr_area_id']         = $data['addr_area_id'];
                $ins_village_array['addr_village_name']    = $data['init_addr_village_name'];
                $ins_village_array['addr_village_code']    = $data['init_addr_village_code'];
                $ins_village_array['addr_village_subcode'] = $data['init_addr_village_subcode'];
                if(is_numeric($data['init_addr_village_sort'])){
                    $ins_village_array['addr_village_sort']= $data['init_addr_village_sort'];
                }
                //$ins_village_array['addr_village_sort']    = $data['init_addr_village_sort'];
                $ins_village_array['addr_village_descr']   = $data['init_addr_village_descr'];
                $ins_village_array['addr_village_section'] = $data['init_addr_village_section'];
                $ins_village_array['addr_village_address1']= $data['init_addr_village_address1'];
                $ins_village_array['addr_village_address2']= $data['init_addr_village_address2'];
                $ins_village_array['addr_village_address3']= $data['init_addr_village_address3'];
                $ins_village_array['addr_village_postcode']= $data['init_addr_village_postcode'];
                $ins_village_array['addr_village_town']    = $data['init_addr_village_town'];
                $ins_village_array['addr_village_state']   = $data['init_addr_village_state'];
                $ins_village_array['addr_village_country'] = $data['init_addr_village_country'];
                $ins_village_array['addr_village_tel']     = $data['init_addr_village_tel'];
                $ins_village_array['addr_village_fax']     = $data['init_addr_village_fax'];
                $ins_village_array['addr_village_email']   = $data['init_addr_village_email'];
                $ins_village_array['addr_village_mgr1_position']= $data['init_addr_village_mgr1_position'];
                $ins_village_array['addr_village_mgr1_name']= $data['init_addr_village_mgr1_name'];
                $ins_village_array['addr_village_mgr2_position']= $data['init_addr_village_mgr2_position'];
                $ins_village_array['addr_village_mgr2_name']= $data['init_addr_village_mgr2_name'];
                $ins_village_array['addr_village_gps_lat'] = $data['init_addr_village_gps_lat'];
                $ins_village_array['addr_village_gps_long']= $data['init_addr_village_gps_long'];
                if(is_numeric($data['init_addr_village_population'])){
                    $ins_village_array['addr_village_population']= $data['init_addr_village_population'];
                }
                //$ins_village_array['addr_village_population']= $data['init_addr_village_population'];
                if($data['offline_mode']){
                    $ins_village_array['synch_out']        = $data['now_id'];
                }
	            $ins_village_data       =   $this->mutil_wdb->insert_new_village($ins_village_array);
                $this->session->set_flashdata('data_activity', 'Village added.');
            } elseif($data['form_purpose'] == "edit_village") {
                // Existing supplier record
                $upd_village_array   =   array();
                $upd_village_array['staff_id']       	   = $this->session->userdata('staff_id');
                $upd_village_array['addr_village_id']      = $data['addr_village_id'];
                $upd_village_array['addr_town_id']         = $data['init_addr_town_id'];
                $upd_village_array['addr_area_id']         = $data['init_addr_area_id'];
                $upd_village_array['addr_village_name']    = $data['init_addr_village_name'];
                $upd_village_array['addr_village_code']    = $data['init_addr_village_code'];
                $upd_village_array['addr_village_subcode'] = $data['init_addr_village_subcode'];
                if(is_numeric($data['init_addr_village_sort'])){
                    $upd_village_array['addr_village_sort']= $data['init_addr_village_sort'];
                }
                //$upd_village_array['addr_village_sort']    = $data['init_addr_village_sort'];
                $upd_village_array['addr_village_descr']   = $data['init_addr_village_descr'];
                $upd_village_array['addr_village_section'] = $data['init_addr_village_section'];
                $upd_village_array['addr_village_address1']= $data['init_addr_village_address1'];
                $upd_village_array['addr_village_address2']= $data['init_addr_village_address2'];
                $upd_village_array['addr_village_address3']= $data['init_addr_village_address3'];
                $upd_village_array['addr_village_postcode']= $data['init_addr_village_postcode'];
                $upd_village_array['addr_village_town']    = $data['init_addr_village_town'];
                $upd_village_array['addr_village_state']   = $data['init_addr_village_state'];
                $upd_village_array['addr_village_country'] = $data['init_addr_village_country'];
                $upd_village_array['addr_village_tel']     = $data['init_addr_village_tel'];
                $upd_village_array['addr_village_fax']     = $data['init_addr_village_fax'];
                $upd_village_array['addr_village_email']   = $data['init_addr_village_email'];
                $upd_village_array['addr_village_mgr1_position']= $data['init_addr_village_mgr1_position'];
                $upd_village_array['addr_village_mgr1_name']= $data['init_addr_village_mgr1_name'];
                $upd_village_array['addr_village_mgr2_position']= $data['init_addr_village_mgr2_position'];
                $upd_village_array['addr_village_mgr2_name']= $data['init_addr_village_mgr2_name'];
                $upd_village_array['addr_village_gps_lat'] = $data['init_addr_village_gps_lat'];
                $upd_village_array['addr_village_gps_long']= $data['init_addr_village_gps_long'];
                if(is_numeric($data['init_addr_village_population'])){
                    $upd_village_array['addr_village_population']= $data['init_addr_village_population'];
                }
                //$upd_village_array['addr_village_population']= $data['init_addr_village_population'];
	            $upd_village_data       =   $this->mutil_wdb->update_village_info($upd_village_array);
                $this->session->set_flashdata('data_activity', 'Village updated.');
            } //endif($data['diagnosis_id'] == "new_village")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrvillages/addr_village_sort";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_addr_village') == FALSE)


    } // end of function util_edit_village_info()


    // ------------------------------------------------------------------------
    function util_list_addrtowns($seg3)  // template for new classes
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/utilities_mgt','Utilities');    
        $data['sort_order']   	    = $seg3; //$this->uri->segment(3);
		$data['title'] = "THIRRA - List of Towns";
		$data['town_list']  = $this->mutil_rdb->get_addr_town_list($data['app_country'],$data['sort_order']);
		$this->load->vars($data);
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
            //$new_body   =   "ehr/ehr_util_list_addrtowns_wap";
            $new_body   =   "ehr_util_list_addrtowns_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_addrtowns_html";
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
		
    } // end of function util_list_addrtowns($id)


    // ------------------------------------------------------------------------
    function util_edit_town_info($seg3, $seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrtowns/addr_town_sort','List Towns');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['addr_town_id']		= 	$seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['form_purpose']       = $_POST['form_purpose'];
            $data['init_addr_town_id']      = $_POST['addr_town_id'];
            $data['init_addr_area_id']      = $_POST['addr_area_id'];
            //$data['init_addr_district_id']  = $_POST['addr_district_id'];
            $data['init_addr_town_name']    = $_POST['addr_town_name'];
            $data['init_addr_town_code']    = $_POST['addr_town_code'];
            $data['init_addr_town_subcode'] = $_POST['addr_town_subcode'];
            $data['init_addr_town_sort']    = $_POST['addr_town_sort'];
            $data['init_addr_town_descr']   = $_POST['addr_town_descr'];
            $data['init_addr_town_section'] = $_POST['addr_town_section'];
            $data['init_addr_town_address1']= $_POST['addr_town_address1'];
            $data['init_addr_town_address2']= $_POST['addr_town_address2'];
            $data['init_addr_town_address3']= $_POST['addr_town_address3'];
            $data['init_addr_town_postcode']= $_POST['addr_town_postcode'];
            $data['init_addr_town_town']    = $_POST['addr_town_town'];
            $data['init_addr_town_state']   = $_POST['addr_town_state'];
            $data['init_addr_town_country'] = $_POST['addr_town_country'];
            $data['init_addr_town_tel']     = $_POST['addr_town_tel'];
            $data['init_addr_town_fax']     = $_POST['addr_town_fax'];
            $data['init_addr_town_email']   = $_POST['addr_town_email'];
            $data['init_addr_town_mgr1_position']= $_POST['addr_town_mgr1_position'];
            $data['init_addr_town_mgr1_name']= $_POST['addr_town_mgr1_name'];
            $data['init_addr_town_mgr2_position']= $_POST['addr_town_mgr2_position'];
            $data['init_addr_town_mgr2_name']= $_POST['addr_town_mgr2_name'];
            $data['init_addr_town_population']= $_POST['addr_town_population'];
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_town") {
                $data['init_addr_town_id']      = 	$data['addr_town_id'];
                $data['init_addr_area_id']      =   "";
                $data['init_addr_district_id']  =   "";
                $data['init_addr_town_name']    =   "";
                $data['init_addr_town_code']    =   "";
                $data['init_addr_town_subcode'] =   "";
                $data['init_addr_town_sort']    =   "";
                $data['init_addr_town_descr']   =   "";
                $data['init_addr_town_section'] =   "";
                $data['init_addr_town_address1']=   "";
                $data['init_addr_town_address2']=   "";
                $data['init_addr_town_address3']=   "";
                $data['init_addr_town_postcode']=   "";
                $data['init_addr_town_town']    =   "";
                $data['init_addr_town_state']   =   "";
                $data['init_addr_town_country'] =   "";
                $data['init_addr_town_tel']     =   "";
                $data['init_addr_town_fax']     =   "";
                $data['init_addr_town_email']   =   "";
                $data['init_addr_town_mgr1_position']=   "";
                $data['init_addr_town_mgr1_name']=   "";
                $data['init_addr_town_mgr2_position']=   "";
                $data['init_addr_town_mgr2_name']=   "";
                $data['init_addr_town_population']=   "";
            } elseif ($data['form_purpose'] == "edit_town") {
                //echo "Edit town";
                $data['town_info'] = $this->mutil_rdb->get_addr_town_list($data['app_country'],'addr_town_sort',$data['addr_town_id']);
                $data['init_addr_town_id']      = $data['addr_town_id'];
                $data['init_addr_area_id']      = $data['town_info'][0]['addr_area_id'];
                $data['init_addr_district_id']  = $data['town_info'][0]['addr_district_id'];
                $data['init_addr_town_name']    = $data['town_info'][0]['addr_town_name'];
                $data['init_addr_town_code']    = $data['town_info'][0]['addr_town_code'];
                $data['init_addr_town_subcode'] = $data['town_info'][0]['addr_town_subcode'];
                $data['init_addr_town_sort']    = $data['town_info'][0]['addr_town_sort'];
                $data['init_addr_town_descr']   = $data['town_info'][0]['addr_town_descr'];
                $data['init_addr_town_section'] = $data['town_info'][0]['addr_town_section'];
                $data['init_addr_town_address1']= $data['town_info'][0]['addr_town_address1'];
                $data['init_addr_town_address2']= $data['town_info'][0]['addr_town_address2'];
                $data['init_addr_town_address3']= $data['town_info'][0]['addr_town_address3'];
                $data['init_addr_town_postcode']= $data['town_info'][0]['addr_town_postcode'];
                $data['init_addr_town_town']    = $data['town_info'][0]['addr_town_town'];
                $data['init_addr_town_state']   = $data['town_info'][0]['addr_town_state'];
                $data['init_addr_town_country'] = $data['town_info'][0]['addr_town_country'];
                $data['init_addr_town_tel']     = $data['town_info'][0]['addr_town_tel'];
                $data['init_addr_town_fax']     = $data['town_info'][0]['addr_town_fax'];
                $data['init_addr_town_email']   = $data['town_info'][0]['addr_town_email'];
                $data['init_addr_town_mgr1_position']= $data['town_info'][0]['addr_town_mgr1_position'];
                $data['init_addr_town_mgr1_name']= $data['town_info'][0]['addr_town_mgr1_name'];
                $data['init_addr_town_mgr2_position']= $data['town_info'][0]['addr_town_mgr2_position'];
                $data['init_addr_town_mgr2_name']= $data['town_info'][0]['addr_town_mgr2_name'];
                $data['init_addr_town_population']= $data['town_info'][0]['addr_town_population'];
            } //endif ($data['form_purpose'] == "new_town")
        } //endif(count($_POST))
		$data['title'] = "Add/Edit Town";
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
		$data['addr_town_id']		=	$data['init_addr_town_id'];
		$data['addr_area_list']  	= 	$this->mutil_rdb->get_addr_area_list($data['app_country'],'addr_area_sort');
		$data['area_info']  	= 	$this->mutil_rdb->get_addr_area_list($data['app_country'],'addr_area_sort',$data['init_addr_area_id']);
		if(count($data['area_info']) > 0){
			$data['init_addr_district_id']    = $data['area_info'][0]['addr_district_id'];
			$data['init_addr_town_state']     = $data['area_info'][0]['addr_state_name'];
			$data['init_addr_town_country']   = $data['area_info'][0]['addr_state_country'];
		}
		$data['village_list']  = $this->mutil_rdb->get_addr_village_list($data['app_country'],"addr_village_name",NULL,$data['addr_town_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_addr_town') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                //$new_body   =   "ehr/ehr_util_edit_town_info_wap";
                $new_body   =   "ehr_util_edit_town_info_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_town_info_html";
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
            if($data['form_purpose'] == "new_town") {
                // New town record
                $ins_town_array   =   array();
                $ins_town_array['staff_id']          = $this->session->userdata('staff_id');
                $ins_town_array['now_id']            = $data['now_id'];
                $ins_town_array['addr_town_id']      = $data['now_id'];
                $ins_town_array['addr_area_id']      = $data['init_addr_area_id'];
                $ins_town_array['addr_district_id']  = $data['init_addr_district_id'];
                $ins_town_array['addr_town_name']    = $data['init_addr_town_name'];
                $ins_town_array['addr_town_code']    = $data['init_addr_town_code'];
                $ins_town_array['addr_town_subcode'] = $data['init_addr_town_subcode'];
                if(is_numeric($data['init_addr_town_sort'])){
                    $ins_town_array['addr_town_sort']= $data['init_addr_town_sort'];
                }
                //$ins_town_array['addr_town_sort']  = $data['init_addr_town_sort'];
                $ins_town_array['addr_town_descr']   = $data['init_addr_town_descr'];
                $ins_town_array['addr_town_section'] = $data['init_addr_town_section'];
                $ins_town_array['addr_town_address1']= $data['init_addr_town_address1'];
                $ins_town_array['addr_town_address2']= $data['init_addr_town_address2'];
                $ins_town_array['addr_town_address3']= $data['init_addr_town_address3'];
                $ins_town_array['addr_town_postcode']= $data['init_addr_town_postcode'];
                $ins_town_array['addr_town_town']    = $data['init_addr_town_name'];
                $ins_town_array['addr_town_state']   = $data['init_addr_town_state'];
                $ins_town_array['addr_town_country'] = $data['init_addr_town_country'];
                $ins_town_array['addr_town_tel']     = $data['init_addr_town_tel'];
                $ins_town_array['addr_town_fax']     = $data['init_addr_town_fax'];
                $ins_town_array['addr_town_email']   = $data['init_addr_town_email'];
                $ins_town_array['addr_town_mgr1_position']= $data['init_addr_town_mgr1_position'];
                $ins_town_array['addr_town_mgr1_name']= $data['init_addr_town_mgr1_name'];
                $ins_town_array['addr_town_mgr2_position']= $data['init_addr_town_mgr2_position'];
                $ins_town_array['addr_town_mgr2_name']= $data['init_addr_town_mgr2_name'];
                if(is_numeric($data['init_addr_town_population'])){
                    $ins_town_array['addr_town_population']= $data['init_addr_town_population'];
                }
                //$ins_town_array['addr_town_population']  = $data['init_addr_town_population'];
                if($data['offline_mode']){
                    $ins_town_array['synch_out']        = $data['now_id'];
                }
	            $ins_town_data       =   $this->mutil_wdb->insert_new_town($ins_town_array);
                $this->session->set_flashdata('data_activity', 'Town added.');
            } elseif($data['form_purpose'] == "edit_town") {
                // Existing supplier record
                $upd_town_array   =   array();
                $upd_town_array['staff_id']       	 = $this->session->userdata('staff_id');
                $upd_town_array['addr_town_id']      = $data['addr_town_id'];
                $upd_town_array['addr_area_id']      = $data['init_addr_area_id'];
                $upd_town_array['addr_district_id']  = $data['init_addr_district_id'];
                $upd_town_array['addr_town_name']    = $data['init_addr_town_name'];
                $upd_town_array['addr_town_code']    = $data['init_addr_town_code'];
                $upd_town_array['addr_town_subcode'] = $data['init_addr_town_subcode'];
                if(is_numeric($data['init_addr_town_sort'])){
                    $upd_area_array['addr_town_sort']= $data['init_addr_town_sort'];
                }
                //$upd_town_array['addr_town_sort'] = $data['init_addr_town_sort'];
                $upd_town_array['addr_town_descr']   = $data['init_addr_town_descr'];
                $upd_town_array['addr_town_section'] = $data['init_addr_town_section'];
                $upd_town_array['addr_town_address1']= $data['init_addr_town_address1'];
                $upd_town_array['addr_town_address2']= $data['init_addr_town_address2'];
                $upd_town_array['addr_town_address3']= $data['init_addr_town_address3'];
                $upd_town_array['addr_town_postcode']= $data['init_addr_town_postcode'];
                $upd_town_array['addr_town_town']    = $data['init_addr_town_name'];
                $upd_town_array['addr_town_state']   = $data['init_addr_town_state'];
                $upd_town_array['addr_town_country'] = $data['init_addr_town_country'];
                $upd_town_array['addr_town_tel']     = $data['init_addr_town_tel'];
                $upd_town_array['addr_town_fax']     = $data['init_addr_town_fax'];
                $upd_town_array['addr_town_email']   = $data['init_addr_town_email'];
                $upd_town_array['addr_town_mgr1_position']= $data['init_addr_town_mgr1_position'];
                $upd_town_array['addr_town_mgr1_name']= $data['init_addr_town_mgr1_name'];
                $upd_town_array['addr_town_mgr2_position']= $data['init_addr_town_mgr2_position'];
                $upd_town_array['addr_town_mgr2_name']= $data['init_addr_town_mgr2_name'];
                if(is_numeric($data['init_addr_town_population'])){
                    $upd_area_array['addr_town_population']= $data['init_addr_town_population'];
                }
                //$upd_town_array['addr_town_population']      = $data['init_addr_town_population'];
	            $upd_town_data       =   $this->mutil_wdb->update_town_info($upd_town_array);
                $this->session->set_flashdata('data_activity', 'Town added.');
            } //endif($data['diagnosis_id'] == "new_town")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrtowns/addr_town_sort";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_addr_town') == FALSE)


    } // end of function util_edit_town_info()


    // ------------------------------------------------------------------------
    function util_list_addrareas($seg3)  // template for new classes
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/utilities_mgt','Utilities');    
        $data['sort_order']   	    = $seg3; //$this->uri->segment(3);
		$data['title'] = "THIRRA - List of Areas";
		$data['area_list']  = $this->mutil_rdb->get_addr_area_list($data['app_country'],$data['sort_order']);
		$this->load->vars($data);
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
            //$new_body   =   "ehr/ehr_util_list_addrareas_wap";
            $new_body   =   "ehr_util_list_addrareas_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_addrareas_html";
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
		
    } // end of function util_list_addrareas($id)


    // ------------------------------------------------------------------------
    function util_edit_area_info($seg3, $seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrareas/addr_area_sort','List Areas');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['addr_area_id']		= 	$seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['form_purpose']       = $_POST['form_purpose'];
            $data['init_addr_area_id']        = $_POST['addr_area_id'];
            $data['init_addr_district_id']    = $_POST['addr_district_id'];
            $data['init_addr_area_name']      = $_POST['addr_area_name'];
            $data['init_addr_area_code']      = $_POST['addr_area_code'];
            $data['init_addr_area_subcode']   = $_POST['addr_area_subcode'];
            $data['init_addr_area_sort']      = $_POST['addr_area_sort'];
            $data['init_addr_area_descr']     = $_POST['addr_area_descr'];
            $data['init_addr_area_section']   = $_POST['addr_area_section'];
            $data['init_addr_area_address1']  = $_POST['addr_area_address1'];
            $data['init_addr_area_address2']  = $_POST['addr_area_address2'];
            $data['init_addr_area_address3']  = $_POST['addr_area_address3'];
            $data['init_addr_area_postcode']  = $_POST['addr_area_postcode'];
            $data['init_addr_area_town']      = $_POST['addr_area_town'];
            $data['init_addr_area_state']     = $_POST['addr_area_state'];
            $data['init_addr_area_country']   = $_POST['addr_area_country'];
            $data['init_addr_area_tel']       = $_POST['addr_area_tel'];
            $data['init_addr_area_fax']       = $_POST['addr_area_fax'];
            $data['init_addr_area_email']     = $_POST['addr_area_email'];
            $data['init_addr_area_mgr1_position']= $_POST['addr_area_mgr1_position'];
            $data['init_addr_area_mgr1_name'] = $_POST['addr_area_mgr1_name'];
            $data['init_addr_area_mgr2_position']= $_POST['addr_area_mgr2_position'];
            $data['init_addr_area_mgr2_name'] = $_POST['addr_area_mgr2_name'];
            $data['init_addr_area_population']= $_POST['addr_area_population'];
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_area") {
                $data['init_addr_area_id']       	 = 	$data['addr_area_id'];
                $data['init_addr_district_id']       =   "";
                $data['init_addr_area_name']         =   "";
                $data['init_addr_area_code']         =   "";
                $data['init_addr_area_subcode']      =   "";
                $data['init_addr_area_sort']         =   "";
                $data['init_addr_area_descr']        =   "";
                $data['init_addr_area_section']      =   "";
                $data['init_addr_area_address1']     =   "";
                $data['init_addr_area_address2']     =   "";
                $data['init_addr_area_address3']     =   "";
                $data['init_addr_area_postcode']     =   "";
                $data['init_addr_area_town']         =   "";
                $data['init_addr_area_state']        =   "";
                $data['init_addr_area_country']      =   "";
                $data['init_addr_area_tel']          =   "";
                $data['init_addr_area_fax']          =   "";
                $data['init_addr_area_email']        =   "";
                $data['init_addr_area_mgr1_position']=   "";
                $data['init_addr_area_mgr1_name']    =   "";
                $data['init_addr_area_mgr2_position']=   "";
                $data['init_addr_area_mgr2_name']    =   "";
                $data['init_addr_area_population']   =   "";
            } elseif ($data['form_purpose'] == "edit_area") {
                //echo "Edit supplier";
                $data['area_info'] = $this->mutil_rdb->get_addr_area_list($data['app_country'],'addr_area_sort',$data['addr_area_id']);
                $data['init_addr_area_id']        = $data['addr_area_id'];
                $data['init_addr_district_id']    = $data['area_info'][0]['addr_district_id'];
                $data['init_addr_area_name']      = $data['area_info'][0]['addr_area_name'];
                $data['init_addr_area_code']      = $data['area_info'][0]['addr_area_code'];
                $data['init_addr_area_subcode']   = $data['area_info'][0]['addr_area_subcode'];
                $data['init_addr_area_sort']      = $data['area_info'][0]['addr_area_sort'];
                $data['init_addr_area_descr']     = $data['area_info'][0]['addr_area_descr'];
                $data['init_addr_area_section']   = $data['area_info'][0]['addr_area_section'];
                $data['init_addr_area_address1']  = $data['area_info'][0]['addr_area_address1'];
                $data['init_addr_area_address2']  = $data['area_info'][0]['addr_area_address2'];
                $data['init_addr_area_address3']  = $data['area_info'][0]['addr_area_address3'];
                $data['init_addr_area_postcode']  = $data['area_info'][0]['addr_area_postcode'];
                $data['init_addr_area_town']      = $data['area_info'][0]['addr_area_town'];
                $data['init_addr_area_state']     = $data['area_info'][0]['addr_area_state'];
                $data['init_addr_area_country']   = $data['area_info'][0]['addr_area_country'];
                $data['init_addr_area_tel']       = $data['area_info'][0]['addr_area_tel'];
                $data['init_addr_area_fax']       = $data['area_info'][0]['addr_area_fax'];
                $data['init_addr_area_email']     = $data['area_info'][0]['addr_area_email'];
                $data['init_addr_area_mgr1_position']= $data['area_info'][0]['addr_area_mgr1_position'];
                $data['init_addr_area_mgr1_name'] = $data['area_info'][0]['addr_area_mgr1_name'];
                $data['init_addr_area_mgr2_position']= $data['area_info'][0]['addr_area_mgr2_position'];
                $data['init_addr_area_mgr2_name'] = $data['area_info'][0]['addr_area_mgr2_name'];
                $data['init_addr_area_population']= $data['area_info'][0]['addr_area_population'];
            } //endif ($data['form_purpose'] == "new_area")
        } //endif(count($_POST))
		$data['title'] = "Add/Edit Area";
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
		$data['addr_area_id']		=	$data['init_addr_area_id'];
		$data['addr_district_list']  	= 	$this->mutil_rdb->get_addr_district_list($data['app_country'],'addr_district_sort');
		$data['district_info']  	= 	$this->mutil_rdb->get_addr_district_list($data['app_country'],'addr_district_sort',NULL,$data['init_addr_district_id']);
		if(count($data['district_info']) > 0){
			$data['init_addr_area_state']     = $data['district_info'][0]['addr_state_name'];
			$data['init_addr_area_country']   = $data['district_info'][0]['addr_state_country'];
		}
		$data['village_list']  = $this->mutil_rdb->get_addr_village_list($data['app_country'],"addr_town_name,addr_village_name",NULL,NULL,$data['addr_area_id']);
		$data['town_list']  = $this->mutil_rdb->get_addr_town_list($data['app_country'],'addr_town_sort', NULL, $data['addr_area_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_addr_area') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                //$new_body   =   "ehr/ehr_util_edit_area_info_wap";
                $new_body   =   "ehr_util_edit_area_info_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_area_info_html";
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
            if($data['form_purpose'] == "new_area") {
                // New area record
                $ins_area_array   =   array();
                $ins_area_array['staff_id']          = $this->session->userdata('staff_id');
                $ins_area_array['now_id']            = $data['now_id'];
                $ins_area_array['addr_area_id']      = $data['now_id'];
                $ins_area_array['addr_district_id']  = $data['init_addr_district_id'];
                $ins_area_array['addr_area_name']    = $data['init_addr_area_name'];
                $ins_area_array['addr_area_code']    = $data['init_addr_area_code'];
                $ins_area_array['addr_area_subcode'] = $data['init_addr_area_subcode'];
                if(is_numeric($data['init_addr_area_sort'])){
                    $ins_area_array['addr_area_sort']= $data['init_addr_area_sort'];
                }
                //$ins_area_array['addr_area_sort']      = $data['init_addr_area_sort'];
                $ins_area_array['addr_area_descr']   = $data['init_addr_area_descr'];
                $ins_area_array['addr_area_section'] = $data['init_addr_area_section'];
                $ins_area_array['addr_area_address1']= $data['init_addr_area_address1'];
                $ins_area_array['addr_area_address2']= $data['init_addr_area_address2'];
                $ins_area_array['addr_area_address3']= $data['init_addr_area_address3'];
                $ins_area_array['addr_area_postcode']= $data['init_addr_area_postcode'];
                $ins_area_array['addr_area_town']    = $data['init_addr_area_town'];
                $ins_area_array['addr_area_state']   = $data['init_addr_area_state'];
                $ins_area_array['addr_area_country'] = $data['init_addr_area_country'];
                $ins_area_array['addr_area_tel']     = $data['init_addr_area_tel'];
                $ins_area_array['addr_area_fax']     = $data['init_addr_area_fax'];
                $ins_area_array['addr_area_email']   = $data['init_addr_area_email'];
                $ins_area_array['addr_area_mgr1_position']= $data['init_addr_area_mgr1_position'];
                $ins_area_array['addr_area_mgr1_name']= $data['init_addr_area_mgr1_name'];
                $ins_area_array['addr_area_mgr2_position']= $data['init_addr_area_mgr2_position'];
                $ins_area_array['addr_area_mgr2_name']= $data['init_addr_area_mgr2_name'];
                if(is_numeric($data['init_addr_area_population'])){
                    $ins_area_array['addr_area_population']= $data['init_addr_area_population'];
                }
                //$ins_area_array['addr_area_population']      = $data['init_addr_area_population'];
                if($data['offline_mode']){
                    $ins_area_array['synch_out']      = $data['now_id'];
                }
	            $ins_area_data       =   $this->mutil_wdb->insert_new_area($ins_area_array);
                $this->session->set_flashdata('data_activity', 'Area added.');
            } elseif($data['form_purpose'] == "edit_area") {
                // Existing supplier record
                $upd_area_array   =   array();
                $upd_area_array['staff_id']       	 = $this->session->userdata('staff_id');
                $upd_area_array['addr_area_id']      = $data['addr_area_id'];
                $upd_area_array['addr_district_id']  = $data['init_addr_district_id'];
                $upd_area_array['addr_area_name']    = $data['init_addr_area_name'];
                $upd_area_array['addr_area_code']    = $data['init_addr_area_code'];
                $upd_area_array['addr_area_subcode'] = $data['init_addr_area_subcode'];
                if(is_numeric($data['init_addr_area_sort'])){
                    $upd_area_array['addr_area_sort']= $data['init_addr_area_sort'];
                }
                //$upd_area_array['addr_area_sort']  = $data['init_addr_area_sort'];
                $upd_area_array['addr_area_descr']   = $data['init_addr_area_descr'];
                $upd_area_array['addr_area_section'] = $data['init_addr_area_section'];
                $upd_area_array['addr_area_address1']= $data['init_addr_area_address1'];
                $upd_area_array['addr_area_address2']= $data['init_addr_area_address2'];
                $upd_area_array['addr_area_address3']= $data['init_addr_area_address3'];
                $upd_area_array['addr_area_postcode']= $data['init_addr_area_postcode'];
                $upd_area_array['addr_area_town']    = $data['init_addr_area_town'];
                $upd_area_array['addr_area_state']   = $data['init_addr_area_state'];
                $upd_area_array['addr_area_country'] = $data['init_addr_area_country'];
                $upd_area_array['addr_area_tel']     = $data['init_addr_area_tel'];
                $upd_area_array['addr_area_fax']     = $data['init_addr_area_fax'];
                $upd_area_array['addr_area_email']   = $data['init_addr_area_email'];
                $upd_area_array['addr_area_mgr1_position']= $data['init_addr_area_mgr1_position'];
                $upd_area_array['addr_area_mgr1_name']= $data['init_addr_area_mgr1_name'];
                $upd_area_array['addr_area_mgr2_position']= $data['init_addr_area_mgr2_position'];
                $upd_area_array['addr_area_mgr2_name']= $data['init_addr_area_mgr2_name'];
                if(is_numeric($data['init_addr_area_population'])){
                    $upd_area_array['addr_area_population']= $data['init_addr_area_population'];
                }
                //$upd_area_array['addr_area_population']      = $data['init_addr_area_population'];
	            $upd_area_data       =   $this->mutil_wdb->update_area_info($upd_area_array);
                $this->session->set_flashdata('data_activity', 'Area updated.');
            } //endif($data['diagnosis_id'] == "new_area")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrareas/addr_area_sort";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_addr_area') == FALSE)


    } // end of function util_edit_area_info()


    // ------------------------------------------------------------------------
    function util_list_addrdistricts($seg3)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/utilities_mgt','Utilities');    
        $data['sort_order']   	    =   $seg3; //$this->uri->segment(3);
		$data['title'] = "THIRRA - List of Districts";
		$data['district_list']  = $this->mutil_rdb->get_addr_district_list($data['app_country'],$data['sort_order']);
		$this->load->vars($data);
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
            //$new_body   =   "ehr/ehr_util_list_addrdistricts_wap";
            $new_body   =   "ehr_util_list_addrdistricts_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_addrdistricts_html";
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
		
    } // end of function util_list_addrdistricts($id)


    // ------------------------------------------------------------------------
    function util_edit_district_info($seg3, $seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrdistricts/addr_district_sort','List Districts');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['addr_district_id']	= 	$seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['form_purpose']       = $_POST['form_purpose'];
            $data['init_addr_district_id']        = $_POST['addr_district_id'];
            $data['init_addr_state_id']    = $_POST['addr_state_id'];
            $data['init_addr_district_name']      = $_POST['addr_district_name'];
            $data['init_addr_district_code']      = $_POST['addr_district_code'];
            $data['init_addr_district_subcode']   = $_POST['addr_district_subcode'];
            $data['init_addr_district_sort']      = $_POST['addr_district_sort'];
            $data['init_addr_district_descr']     = $_POST['addr_district_descr'];
            $data['init_addr_district_section']   = $_POST['addr_district_section'];
            $data['init_addr_district_address1']  = $_POST['addr_district_address1'];
            $data['init_addr_district_address2']  = $_POST['addr_district_address2'];
            $data['init_addr_district_address3']  = $_POST['addr_district_address3'];
            $data['init_addr_district_postcode']  = $_POST['addr_district_postcode'];
            $data['init_addr_district_town']      = $_POST['addr_district_town'];
            $data['init_addr_district_state']     = $_POST['addr_district_state'];
            $data['init_addr_district_country']   = $_POST['addr_district_country'];
            $data['init_addr_district_tel']       = $_POST['addr_district_tel'];
            $data['init_addr_district_fax']       = $_POST['addr_district_fax'];
            $data['init_addr_district_email']     = $_POST['addr_district_email'];
            $data['init_addr_district_mgr1_position']= $_POST['addr_district_mgr1_position'];
            $data['init_addr_district_mgr1_name'] = $_POST['addr_district_mgr1_name'];
            $data['init_addr_district_mgr2_position']= $_POST['addr_district_mgr2_position'];
            $data['init_addr_district_mgr2_name'] = $_POST['addr_district_mgr2_name'];
            $data['init_addr_district_population']= $_POST['addr_district_population'];
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_district") {
                $data['init_addr_district_id']       	 = 	$data['addr_district_id'];
                $data['init_addr_state_id']       =   "";
                $data['init_addr_district_name']         =   "";
                $data['init_addr_district_code']         =   "";
                $data['init_addr_district_subcode']      =   "";
                $data['init_addr_district_sort']         =   "";
                $data['init_addr_district_descr']        =   "";
                $data['init_addr_district_section']      =   "";
                $data['init_addr_district_address1']     =   "";
                $data['init_addr_district_address2']     =   "";
                $data['init_addr_district_address3']     =   "";
                $data['init_addr_district_postcode']     =   "";
                $data['init_addr_district_town']         =   "";
                $data['init_addr_district_state']        =   "";
                $data['init_addr_district_country']      =   "";
                $data['init_addr_district_tel']          =   "";
                $data['init_addr_district_fax']          =   "";
                $data['init_addr_district_email']        =   "";
                $data['init_addr_district_mgr1_position']=   "";
                $data['init_addr_district_mgr1_name']    =   "";
                $data['init_addr_district_mgr2_position']=   "";
                $data['init_addr_district_mgr2_name']    =   "";
                $data['init_addr_district_population']   =   "";
            } elseif ($data['form_purpose'] == "edit_district") {
                //echo "Edit supplier";
                $data['area_info'] = $this->mutil_rdb->get_addr_district_list($data['app_country'],'addr_district_sort',NULL,$data['addr_district_id']);
                $data['init_addr_district_id']        = $data['addr_district_id'];
                $data['init_addr_state_id']    = $data['area_info'][0]['addr_state_id'];
                $data['init_addr_district_name']      = $data['area_info'][0]['addr_district_name'];
                $data['init_addr_district_code']      = $data['area_info'][0]['addr_district_code'];
                $data['init_addr_district_subcode']   = $data['area_info'][0]['addr_district_subcode'];
                $data['init_addr_district_sort']      = $data['area_info'][0]['addr_district_sort'];
                $data['init_addr_district_descr']     = $data['area_info'][0]['addr_district_descr'];
                $data['init_addr_district_section']   = $data['area_info'][0]['addr_district_section'];
                $data['init_addr_district_address1']  = $data['area_info'][0]['addr_district_address1'];
                $data['init_addr_district_address2']  = $data['area_info'][0]['addr_district_address2'];
                $data['init_addr_district_address3']  = $data['area_info'][0]['addr_district_address3'];
                $data['init_addr_district_postcode']  = $data['area_info'][0]['addr_district_postcode'];
                $data['init_addr_district_town']      = $data['area_info'][0]['addr_district_town'];
                $data['init_addr_district_state']     = $data['area_info'][0]['addr_district_state'];
                $data['init_addr_district_country']   = $data['area_info'][0]['addr_district_country'];
                $data['init_addr_district_tel']       = $data['area_info'][0]['addr_district_tel'];
                $data['init_addr_district_fax']       = $data['area_info'][0]['addr_district_fax'];
                $data['init_addr_district_email']     = $data['area_info'][0]['addr_district_email'];
                $data['init_addr_district_mgr1_position']= $data['area_info'][0]['addr_district_mgr1_position'];
                $data['init_addr_district_mgr1_name'] = $data['area_info'][0]['addr_district_mgr1_name'];
                $data['init_addr_district_mgr2_position']= $data['area_info'][0]['addr_district_mgr2_position'];
                $data['init_addr_district_mgr2_name'] = $data['area_info'][0]['addr_district_mgr2_name'];
                $data['init_addr_district_population']= $data['area_info'][0]['addr_district_population'];
            } //endif ($data['form_purpose'] == "new_district")
        } //endif(count($_POST))
		$data['title'] = "Add/Edit District";
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
		$data['addr_district_id']		=	$data['init_addr_district_id'];
		$data['addr_state_list']  	= 	$this->mutil_rdb->get_addr_state_list($data['app_country'],'addr_state_sort');
		$data['state_info']  	= 	$this->mutil_rdb->get_addr_state_list($data['app_country'],'addr_state_sort',$data['init_addr_state_id']);
		if(count($data['state_info']) > 0){
			$data['init_addr_district_state']     = $data['state_info'][0]['addr_state_name'];
			$data['init_addr_district_country']   = $data['state_info'][0]['addr_state_country'];
		}
		$data['area_list']  = $this->mutil_rdb->get_addr_area_list($data['app_country'],"addr_area_name",NULL,$data['addr_district_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_addr_district') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                $new_body   =   "ehr_util_edit_district_info_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_district_info_html";
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
            if($data['form_purpose'] == "new_district") {
                // New area record
                $ins_district_array   =   array();
                $ins_district_array['staff_id']          = $this->session->userdata('staff_id');
                $ins_district_array['now_id']            = $data['now_id'];
                $ins_district_array['addr_district_id']      = $data['now_id'];
                $ins_district_array['addr_state_id']  = $data['init_addr_state_id'];
                $ins_district_array['addr_district_name']    = $data['init_addr_district_name'];
                $ins_district_array['addr_district_code']    = $data['init_addr_district_code'];
                $ins_district_array['addr_district_subcode'] = $data['init_addr_district_subcode'];
                if(is_numeric($data['init_addr_district_sort'])){
                    $ins_district_array['addr_district_sort']= $data['init_addr_district_sort'];
                }
                //$ins_area_array['addr_district_sort']      = $data['init_addr_district_sort'];
                $ins_district_array['addr_district_descr']   = $data['init_addr_district_descr'];
                $ins_district_array['addr_district_section'] = $data['init_addr_district_section'];
                $ins_district_array['addr_district_address1']= $data['init_addr_district_address1'];
                $ins_district_array['addr_district_address2']= $data['init_addr_district_address2'];
                $ins_district_array['addr_district_address3']= $data['init_addr_district_address3'];
                $ins_district_array['addr_district_postcode']= $data['init_addr_district_postcode'];
                $ins_district_array['addr_district_town']    = $data['init_addr_district_town'];
                $ins_district_array['addr_district_state']   = $data['init_addr_district_state'];
                $ins_district_array['addr_district_country'] = $data['init_addr_district_country'];
                $ins_district_array['addr_district_tel']     = $data['init_addr_district_tel'];
                $ins_district_array['addr_district_fax']     = $data['init_addr_district_fax'];
                $ins_district_array['addr_district_email']   = $data['init_addr_district_email'];
                $ins_district_array['addr_district_mgr1_position']= $data['init_addr_district_mgr1_position'];
                $ins_district_array['addr_district_mgr1_name']= $data['init_addr_district_mgr1_name'];
                $ins_district_array['addr_district_mgr2_position']= $data['init_addr_district_mgr2_position'];
                $ins_district_array['addr_district_mgr2_name']= $data['init_addr_district_mgr2_name'];
                if(is_numeric($data['init_addr_district_population'])){
                    $ins_district_array['addr_district_population']= $data['init_addr_district_population'];
                }
                //$ins_area_array['addr_district_population']      = $data['init_addr_district_population'];
                if($data['offline_mode']){
                    $ins_district_array['synch_out']      = $data['now_id'];
                }
	            $ins_district_data       =   $this->mutil_wdb->insert_new_district($ins_district_array);
                $this->session->set_flashdata('data_activity', 'District added.');
            } elseif($data['form_purpose'] == "edit_district") {
                // Existing supplier record
                $upd_district_array   =   array();
                $upd_district_array['staff_id']       	 = $this->session->userdata('staff_id');
                $upd_district_array['addr_district_id']      = $data['addr_district_id'];
                $upd_district_array['addr_state_id']  = $data['init_addr_state_id'];
                $upd_district_array['addr_district_name']    = $data['init_addr_district_name'];
                $upd_district_array['addr_district_code']    = $data['init_addr_district_code'];
                $upd_district_array['addr_district_subcode'] = $data['init_addr_district_subcode'];
                if(is_numeric($data['init_addr_district_sort'])){
                    $upd_district_array['addr_district_sort']= $data['init_addr_district_sort'];
                }
                //$upd_district_array['addr_district_sort']  = $data['init_addr_district_sort'];
                $upd_district_array['addr_district_descr']   = $data['init_addr_district_descr'];
                $upd_district_array['addr_district_section'] = $data['init_addr_district_section'];
                $upd_district_array['addr_district_address1']= $data['init_addr_district_address1'];
                $upd_district_array['addr_district_address2']= $data['init_addr_district_address2'];
                $upd_district_array['addr_district_address3']= $data['init_addr_district_address3'];
                $upd_district_array['addr_district_postcode']= $data['init_addr_district_postcode'];
                $upd_district_array['addr_district_town']    = $data['init_addr_district_town'];
                $upd_district_array['addr_district_state']   = $data['init_addr_district_state'];
                $upd_district_array['addr_district_country'] = $data['init_addr_district_country'];
                $upd_district_array['addr_district_tel']     = $data['init_addr_district_tel'];
                $upd_district_array['addr_district_fax']     = $data['init_addr_district_fax'];
                $upd_district_array['addr_district_email']   = $data['init_addr_district_email'];
                $upd_district_array['addr_district_mgr1_position']= $data['init_addr_district_mgr1_position'];
                $upd_district_array['addr_district_mgr1_name']= $data['init_addr_district_mgr1_name'];
                $upd_district_array['addr_district_mgr2_position']= $data['init_addr_district_mgr2_position'];
                $upd_district_array['addr_district_mgr2_name']= $data['init_addr_district_mgr2_name'];
                if(is_numeric($data['init_addr_district_population'])){
                    $upd_district_array['addr_district_population']= $data['init_addr_district_population'];
                }
                //$upd_area_array['addr_district_population']      = $data['init_addr_district_population'];
	            $upd_district_data       =   $this->mutil_wdb->update_district_info($upd_district_array);
                $this->session->set_flashdata('data_activity', 'District updated.');
            } //endif($data['diagnosis_id'] == "new_district")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrdistricts/addr_district_sort";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_addr_area') == FALSE)


    } // end of function util_edit_district_info()


    // ------------------------------------------------------------------------
    function util_list_addrstates($seg3)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
		$data['title'] = "THIRRA - List of States";
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/utilities_mgt','Utilities');    
        $data['sort_order']   	    =   $seg3; //$this->uri->segment(3);
		$data['state_list']  = $this->mutil_rdb->get_addr_state_list('All',$data['sort_order']);
		$this->load->vars($data);
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
            //$new_body   =   "ehr/ehr_util_list_addrstates_wap";
            $new_body   =   "ehr_util_list_addrstates_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_utilities_html";
            $new_body   =   "ehr_util_list_addrstates_html";
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
		
    } // end of function util_list_addrstates($id)


    // ------------------------------------------------------------------------
    function util_edit_state_info($seg3, $seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_country']		=	$this->config->item('app_country');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr/ehr/index/ehr_utilities/ehr_utilities_geo/utilities_mgt','Utilities','ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrstates/addr_state_sort','List States');    
        $data['form_purpose']   	= 	$seg3; //$this->uri->segment(3);
        $data['addr_state_id']		= 	$seg4; //$this->uri->segment(4);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['form_purpose']       = $_POST['form_purpose'];
            $data['init_addr_state_id']        = $_POST['addr_state_id'];
            $data['init_addr_state_name']      = $_POST['addr_state_name'];
            $data['init_addr_state_code']      = $_POST['addr_state_code'];
            $data['init_addr_state_subcode']   = $_POST['addr_state_subcode'];
            $data['init_addr_state_sort']      = $_POST['addr_state_sort'];
            $data['init_addr_state_descr']     = $_POST['addr_state_descr'];
            $data['init_addr_state_section']   = $_POST['addr_state_section'];
            $data['init_addr_state_address1']  = $_POST['addr_state_address1'];
            $data['init_addr_state_address2']  = $_POST['addr_state_address2'];
            $data['init_addr_state_address3']  = $_POST['addr_state_address3'];
            $data['init_addr_state_postcode']  = $_POST['addr_state_postcode'];
            $data['init_addr_state_town']      = $_POST['addr_state_town'];
            $data['init_addr_state_state']     = $_POST['addr_state_state'];
            $data['init_addr_state_country']   = $_POST['addr_state_country'];
            $data['init_addr_state_tel']       = $_POST['addr_state_tel'];
            $data['init_addr_state_fax']       = $_POST['addr_state_fax'];
            $data['init_addr_state_email']     = $_POST['addr_state_email'];
            $data['init_addr_state_mgr1_position']= $_POST['addr_state_mgr1_position'];
            $data['init_addr_state_mgr1_name'] = $_POST['addr_state_mgr1_name'];
            $data['init_addr_state_mgr2_position']= $_POST['addr_state_mgr2_position'];
            $data['init_addr_state_mgr2_name'] = $_POST['addr_state_mgr2_name'];
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_state") {
                $data['init_addr_state_id']       	 = 	$data['addr_state_id'];
                $data['init_addr_state_name']         =   "";
                $data['init_addr_state_code']         =   "";
                $data['init_addr_state_subcode']      =   "";
                $data['init_addr_state_sort']         =   "";
                $data['init_addr_state_descr']        =   "";
                $data['init_addr_state_section']      =   "";
                $data['init_addr_state_address1']     =   "";
                $data['init_addr_state_address2']     =   "";
                $data['init_addr_state_address3']     =   "";
                $data['init_addr_state_postcode']     =   "";
                $data['init_addr_state_town']         =   "";
                $data['init_addr_state_state']        =   "";
                $data['init_addr_state_country']      =   "";
                $data['init_addr_state_tel']          =   "";
                $data['init_addr_state_fax']          =   "";
                $data['init_addr_state_email']        =   "";
                $data['init_addr_state_mgr1_position']=   "";
                $data['init_addr_state_mgr1_name']    =   "";
                $data['init_addr_state_mgr2_position']=   "";
                $data['init_addr_state_mgr2_name']    =   "";
            } elseif ($data['form_purpose'] == "edit_state") {
                //echo "Edit supplier";
                $data['state_info'] = $this->mutil_rdb->get_addr_state_list($data['app_country'],'addr_state_sort',$data['addr_state_id']);
                $data['init_addr_state_id']        = $data['addr_state_id'];
                $data['init_addr_state_name']      = $data['state_info'][0]['addr_state_name'];
                $data['init_addr_state_code']      = $data['state_info'][0]['addr_state_code'];
                $data['init_addr_state_subcode']   = $data['state_info'][0]['addr_state_subcode'];
                $data['init_addr_state_sort']      = $data['state_info'][0]['addr_state_sort'];
                $data['init_addr_state_descr']     = $data['state_info'][0]['addr_state_descr'];
                $data['init_addr_state_section']   = $data['state_info'][0]['addr_state_section'];
                $data['init_addr_state_address1']  = $data['state_info'][0]['addr_state_address1'];
                $data['init_addr_state_address2']  = $data['state_info'][0]['addr_state_address2'];
                $data['init_addr_state_address3']  = $data['state_info'][0]['addr_state_address3'];
                $data['init_addr_state_postcode']  = $data['state_info'][0]['addr_state_postcode'];
                $data['init_addr_state_town']      = $data['state_info'][0]['addr_state_town'];
                $data['init_addr_state_state']     = $data['state_info'][0]['addr_state_state'];
                $data['init_addr_state_country']   = $data['state_info'][0]['addr_state_country'];
                $data['init_addr_state_tel']       = $data['state_info'][0]['addr_state_tel'];
                $data['init_addr_state_fax']       = $data['state_info'][0]['addr_state_fax'];
                $data['init_addr_state_email']     = $data['state_info'][0]['addr_state_email'];
                $data['init_addr_state_mgr1_position']= $data['state_info'][0]['addr_state_mgr1_position'];
                $data['init_addr_state_mgr1_name'] = $data['state_info'][0]['addr_state_mgr1_name'];
                $data['init_addr_state_mgr2_position']= $data['state_info'][0]['addr_state_mgr2_position'];
                $data['init_addr_state_mgr2_name'] = $data['state_info'][0]['addr_state_mgr2_name'];
            } //endif ($data['form_purpose'] == "new_area")
        } //endif(count($_POST))
		$data['title'] = "Add/Edit State";
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
		$data['addr_state_id']		=	$data['init_addr_state_id'];
		$data['addr_country_list']  	= 	$this->mutil_rdb->get_addr_country_list($data['app_country'],'addr_country_sort');
		$data['country_info']  	= 	$this->mutil_rdb->get_addr_country_list($data['app_country'],'addr_country_sort',$data['init_addr_state_country']);
		if(count($data['country_info']) > 0){
			$data['addr_country_name']     = $data['country_info'][0]['addr_country_name'];
			//$data['init_addr_state_country']   = $data['country_info'][0]['addr_state_country'];
		}
		$data['district_list']  = $this->mutil_rdb->get_addr_district_list($data['app_country'],'adis.addr_district_sort',$data['addr_state_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_addr_state') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_utilities_wap";
                $new_body   =   "ehr_util_edit_state_info_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_utilities_html";
                $new_body   =   "ehr_util_edit_state_info_html";
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
            if($data['form_purpose'] == "new_state") {
                // New area record
                $ins_area_array   =   array();
                $ins_area_array['staff_id']          = $this->session->userdata('staff_id');
                $ins_area_array['now_id']            = $data['now_id'];
                $ins_area_array['addr_state_id']      = $data['now_id'];
                $ins_area_array['addr_state_name']    = $data['init_addr_state_name'];
                $ins_area_array['addr_state_code']    = $data['init_addr_state_code'];
                $ins_area_array['addr_state_subcode'] = $data['init_addr_state_subcode'];
                if(is_numeric($data['init_addr_state_sort'])){
                    $ins_area_array['addr_state_sort']= $data['init_addr_state_sort'];
                }
                //$ins_area_array['addr_state_sort']      = $data['init_addr_state_sort'];
                $ins_area_array['addr_state_descr']   = $data['init_addr_state_descr'];
                $ins_area_array['addr_state_section'] = $data['init_addr_state_section'];
                $ins_area_array['addr_state_address1']= $data['init_addr_state_address1'];
                $ins_area_array['addr_state_address2']= $data['init_addr_state_address2'];
                $ins_area_array['addr_state_address3']= $data['init_addr_state_address3'];
                $ins_area_array['addr_state_postcode']= $data['init_addr_state_postcode'];
                $ins_area_array['addr_state_town']    = $data['init_addr_state_town'];
                $ins_area_array['addr_state_state']   = $data['init_addr_state_state'];
                $ins_area_array['addr_state_country'] = $data['init_addr_state_country'];
                $ins_area_array['addr_state_tel']     = $data['init_addr_state_tel'];
                $ins_area_array['addr_state_fax']     = $data['init_addr_state_fax'];
                $ins_area_array['addr_state_email']   = $data['init_addr_state_email'];
                $ins_area_array['addr_state_mgr1_position']= $data['init_addr_state_mgr1_position'];
                $ins_area_array['addr_state_mgr1_name']= $data['init_addr_state_mgr1_name'];
                $ins_area_array['addr_state_mgr2_position']= $data['init_addr_state_mgr2_position'];
                $ins_area_array['addr_state_mgr2_name']= $data['init_addr_state_mgr2_name'];
                if(is_numeric($data['init_addr_state_population'])){
                    $ins_area_array['addr_state_population']= $data['init_addr_state_population'];
                }
                //$ins_area_array['addr_state_population']      = $data['init_addr_state_population'];
                if($data['offline_mode']){
                    $ins_area_array['synch_out']      = $data['now_id'];
                }
	            $ins_area_data       =   $this->mutil_wdb->insert_new_state($ins_area_array);
                $this->session->set_flashdata('data_activity', 'State added.');
            } elseif($data['form_purpose'] == "edit_state") {
                // Existing supplier record
                $upd_area_array   =   array();
                $upd_area_array['staff_id']       	 = $this->session->userdata('staff_id');
                $upd_area_array['addr_state_id']      = $data['addr_state_id'];
                $upd_area_array['addr_state_name']    = $data['init_addr_state_name'];
                $upd_area_array['addr_state_code']    = $data['init_addr_state_code'];
                $upd_area_array['addr_state_subcode'] = $data['init_addr_state_subcode'];
                if(is_numeric($data['init_addr_state_sort'])){
                    $upd_area_array['addr_state_sort']= $data['init_addr_state_sort'];
                }
                //$upd_area_array['addr_state_sort']  = $data['init_addr_state_sort'];
                $upd_area_array['addr_state_descr']   = $data['init_addr_state_descr'];
                $upd_area_array['addr_state_section'] = $data['init_addr_state_section'];
                $upd_area_array['addr_state_address1']= $data['init_addr_state_address1'];
                $upd_area_array['addr_state_address2']= $data['init_addr_state_address2'];
                $upd_area_array['addr_state_address3']= $data['init_addr_state_address3'];
                $upd_area_array['addr_state_postcode']= $data['init_addr_state_postcode'];
                $upd_area_array['addr_state_town']    = $data['init_addr_state_town'];
                $upd_area_array['addr_state_state']   = $data['init_addr_state_state'];
                $upd_area_array['addr_state_country'] = $data['init_addr_state_country'];
                $upd_area_array['addr_state_tel']     = $data['init_addr_state_tel'];
                $upd_area_array['addr_state_fax']     = $data['init_addr_state_fax'];
                $upd_area_array['addr_state_email']   = $data['init_addr_state_email'];
                $upd_area_array['addr_state_mgr1_position']= $data['init_addr_state_mgr1_position'];
                $upd_area_array['addr_state_mgr1_name']= $data['init_addr_state_mgr1_name'];
                $upd_area_array['addr_state_mgr2_position']= $data['init_addr_state_mgr2_position'];
                $upd_area_array['addr_state_mgr2_name']= $data['init_addr_state_mgr2_name'];
                if(is_numeric($data['init_addr_state_population'])){
                    $upd_area_array['addr_state_population']= $data['init_addr_state_population'];
                }
                //$upd_area_array['addr_state_population']      = $data['init_addr_state_population'];
	            $upd_area_data       =   $this->mutil_wdb->update_state_info($upd_area_array);
                $this->session->set_flashdata('data_activity', 'State updated.');
            } //endif($data['diagnosis_id'] == "new_area")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_utilities/ehr_utilities_geo/util_list_addrstates/addr_state_sort";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_addr_state') == FALSE)


    } // end of function util_edit_state_info()


}

/* End of file Ehr_utilities_geo.php */
/* Location: ./app_thirra/controllers/Ehr_utilities_geo.php */
