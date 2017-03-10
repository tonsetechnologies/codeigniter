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
 * Controller Class for EHR_ORDERS
 *
 * This class is used for both narrowband and broadband EHR. 
 *
 * @version 0.9.15
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_orders_procedure extends MX_Controller 
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
		$this->load->model('morders_rdb');
		$this->load->model('morders_wdb');
		$this->load->model('morders_procedure_rdb');
		$this->load->model('morders_imaging_rdb');
		$this->load->model('morders_lab_rdb');
        
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
    // === ORDERS MANAGEMENT
    // ------------------------------------------------------------------------
    function orders_edit_imagresult($seg3,$seg4) 
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr_orders/orders_mgt','Orders');    
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['order_id'] =   $seg4; //$this->uri->segment(4);
        $data['location_id']        =   $this->session->userdata('location_id');
		$data['title'] 				=   "Record Imaging Result";
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['now_time']           =   date("H:i",$data['now_id']);
        
        if(count($_POST)) {
            // User has posted the form
            $data['order_id']        	=   $_POST['order_id'];
            $data['init_notes']     	=   $_POST['notes'];
            $data['init_result_date']   =   $_POST['result_date'];
            $data['init_result_remarks']=   $_POST['result_remarks'];
            $data['init_result_ref']    =   $_POST['result_ref'];
			// Static information
			$data['order_info'] = $this->morders_imaging_rdb->get_one_imaging_result($data['order_id']);
			$data['session_id']     	=   $data['order_info'][0]['session_id'];
			$data['name'] 				=   $data['order_info'][0]['name'];
			$data['birth_date'] 		=   $data['order_info'][0]['birth_date'];
			$data['supplier_name'] 		=   $data['order_info'][0]['supplier_name'];
			$data['product_id']   		=   $data['order_info'][0]['product_id'];
			$data['product_code']   	=   $data['order_info'][0]['product_code'];
			$data['description']   		=   $data['order_info'][0]['description'];
			$data['supplier_ref'] 		=   $data['order_info'][0]['supplier_ref'];
			$data['result_status']  	=   $data['order_info'][0]['result_status'];
			$data['remarks']  			=   $data['order_info'][0]['remarks'];
			$data['result_id']  		=   $data['order_info'][0]['result_id'];
			$data['result_remarks']  	=   $data['order_info'][0]['result_remarks'];
			$data['result_ref']  		=   $data['order_info'][0]['result_ref'];
            if(isset($_POST['close_order'])) { 
				$data['close_order']  			=   $_POST['close_order'];//TRUE;
			} else {
				$data['close_order']  			=   "FALSE";				
			}
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_result") {
                // New user
		        $data['room_info']          =  array();
                $data['room_id']            =   "";
                $data['category_id']        =   "";
                $data['init_room_name']     =   "";
                $data['init_description']   =   "";
            } else {
                // Existing result row
				$data['order_info'] = $this->morders_imaging_rdb->get_one_imaging_result($data['order_id']);
                $data['session_id']      	=   $data['order_info'][0]['session_id'];
                $data['name'] 				=   $data['order_info'][0]['name'];
                $data['birth_date'] 		=   $data['order_info'][0]['birth_date'];
                $data['supplier_name'] 		=   $data['order_info'][0]['supplier_name'];
                $data['product_id']   		=   $data['order_info'][0]['product_id'];
                $data['product_code']   	=   $data['order_info'][0]['product_code'];
                $data['description']   		=   $data['order_info'][0]['description'];
                $data['supplier_ref'] 		=   $data['order_info'][0]['supplier_ref'];
                $data['result_status']  	=   $data['order_info'][0]['result_status'];
                $data['remarks']  			=   $data['order_info'][0]['remarks'];
                $data['result_id']  		=   $data['order_info'][0]['result_id'];
                $data['init_result_date']   =   $data['order_info'][0]['result_date'];
                $data['init_notes']   		=   $data['order_info'][0]['notes'];
                $data['image_path']   		=   $data['order_info'][0]['image_path'];
                $data['result_staff_id']   	=   $data['order_info'][0]['staff_id'];
                $data['date_ended'] 		=   $data['order_info'][0]['date_ended'];
                $data['init_result_remarks']   		=   $data['order_info'][0]['result_remarks'];
                $data['init_result_ref']   		=   $data['order_info'][0]['result_ref'];
           } //endif ($data['form_purpose'] == "new_result")
        } //endif(count($_POST))
        
		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_imag_result') == FALSE){
            // Return to incomplete form
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_orders_wap";
                //$new_body   =   "ehr/ehr_orders_edit_imagresult_wap";
                $new_body   =   "ehr_orders_edit_imagresult_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_orders_html";
                $new_body   =   "ehr_orders_edit_imagresult_html";
                $new_footer =   "ehr/footer_emr_html";
            }
            if($data['user_rights']['section_orders'] < 100){
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
            if($data['close_order'] == "TRUE") {
                //echo "Change status ".$data['close_order'];
				$upd_order_array['order_id']  		= $data['order_id'];
				$upd_order_array['result_status']  	= "Received";
                if($data['offline_mode']){
                    $upd_order_array['synch_out']        = $data['now_id'];
                }
				$upd_order_data =   $this->morders_wdb->update_imaging_order($upd_order_array);
            }
			// Update records
			$upd_result_array['result_id']      = $data['result_id'];
			$upd_result_array['staff_id']       = $this->session->userdata('staff_id');
			$upd_result_array['result_date']    = $data['init_result_date'];
			$upd_result_array['notes']  		= $data['init_notes'];
			$upd_result_array['result_remarks'] = $data['init_result_remarks'];
			$upd_result_array['result_ref']  	= $data['init_result_ref'];
            if($data['offline_mode']){
                $upd_result_array['synch_out']        = $data['now_id'];
            }
			$upd_result_data =   $this->morders_wdb->update_imaging_result($upd_result_array);
            $this->session->set_flashdata('data_activity', 'Imaging result for '.$data['order_info'][0]['name'].' updated.');
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_orders/ehr_orders/orders_mgt";
            header("Status: 200");
            header("Location: ".$new_page);
        } //endif ($this->form_validation->run('edit_imag_result') == FALSE)
    } // end of function orders_edit_imagresult($result_id)


    // ------------------------------------------------------------------------
    function orders_listclosed_imagresults($seg3)  
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr_orders/orders_mgt','Orders' );    
		$data['supplier_type']   	=   $seg3; //$this->uri->segment(3);
		$data['title'] = "T H I R R A - Closed Lab Results";
		$data['pending_imaging'] = $this->morders_rdb->get_list_imaging_result('Received');
		$this->load->vars($data);
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            $new_sidebar=   "ehr/sidebar_ehr_orders_wap";
            $new_body   =   "ehr_orders_listclosed_imagresults_wap";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_orders_html";
            $new_body   =   "ehr_orders_listclosed_imagresults_html";
            $new_footer =   "ehr/footer_emr_html";
		}
        if($data['user_rights']['section_orders'] < 100){
            $new_body   =   "ehr/ehr_access_denied_html";
        }
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);			
    } // end of function orders_listclosed_imagresults($id)


    // ------------------------------------------------------------------------
    function print_imag_result($id=NULL)  // Print lab result to HTML or PDF
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
		$data['title'] = "T H I R R A - Print Imaging Results";
		$data['now_id']             =   time();
        $data['patient_id']         =   $this->uri->segment(4);
		$data['order_id']      	  =   $this->uri->segment(5);
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['order_info']     = $this->morders_imaging_rdb->get_one_imaging_result($data['order_id']);
		$data['summary_id']     =   $data['order_info'][0]['session_id'];
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id'],$data['summary_id']);
		
		if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            $new_sidebar=   "ehr/sidebar_ehr_orders_wap";
            $new_body   =   "ehr/ehr_print_imag_result_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_print_html";
            $new_sidebar=   "ehr/sidebar_emr_orders_html";
            $new_body   =   "ehr/ehr_print_imag_result_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		
		// Output Format
		$data['output_format'] 	= $this->uri->segment(3);
		$data['filename']		=	"THIRRA-ImagingResult-".$data['summary_id'].".pdf";
		$this->load->vars($data);
		if($data['output_format'] == 'pdf') {
			$html = $this->load->view($new_header,'',TRUE);			
			//$html .= $this->load->view($new_banner,'',TRUE);			
			//$this->load->view($new_sidebar);			
			$html .= $this->load->view($new_body,'',TRUE);			
			//$html .= $this->load->view($new_footer,'',TRUE);		

			$this->load->library('mpdf');
			$mpdf=new mPDF('win-1252','A4','','',20,15,5,25,10,10);
			$mpdf->useOnlyCoreFonts = true;    // false is default
			$mpdf->SetProtection(array('print'));
			$mpdf->SetTitle("THIRRA - Consultation Episode");
			$mpdf->SetAuthor("THIRRA");
			//$mpdf->SetWatermarkText("Paid");
			//$mpdf->showWatermarkText = true;
			//$mpdf->watermark_font = 'DejaVuSansCondensed';
			//$mpdf->watermarkTextAlpha = 0.1;
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->WriteHTML($html);

			$mpdf->Output($data['filename'],'I'); exit;
		} else { // display in browser
			$this->load->view($new_header);			
			//$this->load->view($new_banner);			
			//$this->load->view($new_sidebar);			
			$this->load->view($new_body);			
			$this->load->view($new_footer);		
		} //endif($data['output_format'] == 'pdf')
		
    } // end of function print_imag_result($id)


    // ------------------------------------------------------------------------
    function ehr_orders_list_procsuppliers($seg3)  // List suppliers for imaging
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr_orders/orders_mgt','Orders');    
		$data['supplier_type']   	=   $seg3;//$this->uri->segment(3);
		$data['title'] = "T H I R R A - List of Suppliers for ".$data['supplier_type'];
		$data['supplier_list']  = $this->morders_procedure_rdb->get_supplier_list_proc();
		$this->load->vars($data);
        if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_wap";
            $new_sidebar=   "ehr/sidebar_ehr_orders_wap";
            //$new_body   =   "ehr/ehr_orders_list_imagsuppliers_wap";
            $new_body   =   "ehr_orders_list_procsuppliers_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_html";
            $new_sidebar=   "ehr/sidebar_emr_orders_html";
            $new_body   =   "ehr_orders_list_procsuppliers_html";
            $new_footer =   "ehr/footer_emr_html";
		}
        if($data['user_rights']['section_orders'] < 100){
            $new_body   =   "ehr/ehr_access_denied_html";

        }
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);			
    } // end of function ehr_orders_list_procsuppliers($id)


    // ------------------------------------------------------------------------
    function orders_edit_procsupplier_info($seg3,$seg4,$seg5)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_currency']		=	$this->config->item('app_currency');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr_orders/orders_mgt','Orders','ehr_orders/ehr_orders_list_imagsuppliers/imaging','List Imaging Suppliers');    
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['supplier_type']      =   $seg4; //$this->uri->segment(4);
        $data['supplier_id']        =   $seg5; //$this->uri->segment(5);
        $data['packages_list']= $this->morders_procedure_rdb->get_proc_product_bysupplier($data['supplier_id']);
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['form_purpose']       = $_POST['form_purpose'];
            $data['init_supplier_id']	= $_POST['supplier_id'];
            $data['init_supplier_name'] = $_POST['supplier_name'];
            $data['init_registration_no']= $_POST['registration_no'];
            $data['init_acc_no']        = $_POST['acc_no'];
            $data['init_credit_term']   = $_POST['credit_term'];
            $data['init_supplier_remarks']= $_POST['supplier_remarks'];
            $data['init_address']       = $_POST['address'];
            $data['init_address2']      = $_POST['address2'];
            $data['init_address3']      = $_POST['address3'];
            $data['init_town']          = $_POST['town'];
            $data['init_state']         = $_POST['state'];
            $data['init_postcode']      = $_POST['postcode'];
            $data['init_country']       = $_POST['country'];
            $data['init_tel_no']        = $_POST['tel_no'];
            $data['init_tel2_no']       = $_POST['tel2_no'];
            $data['init_tel3_no']       = $_POST['tel3_no'];
            $data['init_fax_no']        = $_POST['fax_no'];
            $data['init_fax2_no']       = $_POST['fax2_no'];
            $data['init_email']         = $_POST['email'];
            $data['init_contact_person']= $_POST['contact_person'];
            $data['init_contact_other'] = $_POST['contact_other'];
            $data['init_website']       = $_POST['website'];
            $data['init_contact_remarks'] = $_POST['contact_remarks'];
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_supplier") {
                $data['init_supplier_name'] =   "";
                $data['init_registration_no']=   "";
                $data['init_acc_no']        =   "";
                $data['init_credit_term']   =   0;
                $data['init_supplier_remarks']=   "";
                $data['init_address']       =   "";
                $data['init_address2']      =   "";
                $data['init_address3']      =   "";
                $data['init_town']          =   "";
                $data['init_state']         =   "";
                $data['init_postcode']      =   "";
                $data['init_country']       =   "";
                $data['init_tel_no']        =   "";
                $data['init_tel2_no']       =   "";
                $data['init_tel3_no']       =   "";
                $data['init_fax_no']        =   "";
                $data['init_fax2_no']       =   "";
                $data['init_email']         =   "";
                $data['init_contact_person']=   "";
                $data['init_contact_other'] =   "";
                $data['init_website']       =   "";
                $data['init_contact_remarks']=   "";
            } elseif ($data['form_purpose'] == "edit_supplier") {
                //echo "Edit supplier";
                $data['supplier_info'] = $this->morders_procedure_rdb->get_supplier_list_proc($data['supplier_id']);
                $data['init_supplier_name'] = $data['supplier_info'][0]['supplier_name'];
                $data['init_registration_no']= $data['supplier_info'][0]['registration_no'];
                $data['contact_id']        = $data['supplier_info'][0]['contact_id'];
                $data['customer_info_id']        = $data['supplier_info'][0]['customer_info_id'];
                $data['init_acc_no']        = $data['supplier_info'][0]['acc_no'];
                $data['init_credit_term']   = $data['supplier_info'][0]['credit_term'];
                $data['init_supplier_remarks']= $data['supplier_info'][0]['supplier_remarks'];
                $data['init_address']       = $data['supplier_info'][0]['address'];
                $data['init_address2']      = $data['supplier_info'][0]['address2'];
                $data['init_address3']      = $data['supplier_info'][0]['address3'];
                $data['init_town']          = $data['supplier_info'][0]['town'];
                $data['init_state']         = $data['supplier_info'][0]['state'];
                $data['init_postcode']      = $data['supplier_info'][0]['postcode'];
                $data['init_country']       = $data['supplier_info'][0]['country'];
                $data['init_tel_no']        = $data['supplier_info'][0]['tel_no'];
                $data['init_tel2_no']       = $data['supplier_info'][0]['tel2_no'];
                $data['init_tel3_no']       = $data['supplier_info'][0]['tel2_no'];
                $data['init_fax_no']        = $data['supplier_info'][0]['fax_no'];
                $data['init_fax2_no']       = $data['supplier_info'][0]['fax2_no'];
                $data['init_email']         = $data['supplier_info'][0]['email'];
                $data['init_contact_person']= $data['supplier_info'][0]['contact_person'];
                $data['init_contact_other'] = $data['supplier_info'][0]['contact_other'];
                $data['init_website']       = $data['supplier_info'][0]['website'];
                $data['init_contact_remarks'] = $data['supplier_info'][0]['contact_remarks'];
            } //endif ($data['form_purpose'] == "new_supplier")
        } //endif(count($_POST))
		$data['title'] = "Add/Edit Supplier";
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
		$data['clinics_list']       =   $this->mthirra->get_clinics_list('All');
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_imagsupplier') == FALSE){
		    //$this->load->view('emr/emr_edit_patient_html');			
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_orders_wap";
                //$new_body   =   "ehr/ehr_orders_edit_imagsupplier_info_wap";
                $new_body   =   "ehr_orders_edit_procsupplier_info_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_orders_html";
                $new_body   =   "ehr_orders_edit_procsupplier_info_html";
                $new_footer =   "ehr/footer_emr_html";
            }
            if($data['user_rights']['section_orders'] < 100){
                $new_body   =   "ehr/ehr_access_denied_html";
            }
            //$this->load->view($new_header);			
            //$this->load->view($new_banner);			
            //$this->load->view($new_sidebar);			
            $this->load->view($new_body);			
            //$this->load->view($new_footer);			
        } else {
            //echo "\nValidated successfully.";
            $this->load->model('morders_procedure_wdb');
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_supplier") {
                // New supplier record
                $ins_supplier_array   =   array();
                $ins_supplier_array['staff_id']       = $this->session->userdata('staff_id');
                $ins_supplier_array['now_id']         = $data['now_id'];
                $ins_supplier_array['supplier_id']	  = $data['now_id'];
                $ins_supplier_array['supplier_name']  = $data['init_supplier_name'];
                $ins_supplier_array['registration_no']= $data['init_registration_no'];
                $ins_supplier_array['contact_id']     = $data['now_id'];
                $ins_supplier_array['customer_info_id']= $data['now_id'];
                $ins_supplier_array['acc_no']         = $data['init_acc_no'];
                //$ins_supplier_array['account_id']   = $data['init_town'];
                if(is_numeric($data['init_credit_term'])){
                    $ins_supplier_array['credit_term']                = $data['init_credit_term'];
                }
                //$ins_supplier_array['credit_term']    = $data['init_credit_term'];
                $ins_supplier_array['supplier_remarks']= $data['init_supplier_remarks'];
                $ins_supplier_array['address']        = $data['init_address'];
                $ins_supplier_array['address2']       = $data['init_address2'];
                $ins_supplier_array['address3']       = $data['init_address3'];
                $ins_supplier_array['town']           = $data['init_town'];
                $ins_supplier_array['state']          = $data['init_state'];
                $ins_supplier_array['postcode']       = $data['init_postcode'];
                $ins_supplier_array['country']        = $data['init_country'];
                $ins_supplier_array['tel_no']         = $data['init_tel_no'];
                $ins_supplier_array['tel_no2']        = $data['init_tel_no2'];
                $ins_supplier_array['tel_no3']        = $data['init_tel_no3'];
                $ins_supplier_array['fax_no']         = $data['init_fax_no'];
                $ins_supplier_array['fax_no2']        = $data['init_fax_no2'];
                $ins_supplier_array['email']          = $data['init_email'];
                $ins_supplier_array['contact_person'] = $data['init_contact_person'];
                $ins_supplier_array['other']          = $data['partner_clinic_id'];
                $ins_supplier_array['website']        = $data['init_website'];
                $ins_supplier_array['contact_remarks']        = $data['init_contact_remarks'];
                if($data['offline_mode']){
                    $ins_supplier_array['synch_out']        = $data['now_id'];
                }
	            $ins_supplier_data       =   $this->morders_procedure_wdb->insert_new_procsupplier($ins_supplier_array);
                $this->session->set_flashdata('data_activity', 'Procedure supplier added.');
            } elseif($data['form_purpose'] == "edit_supplier") {
                // Existing supplier record
                $upd_supplier_array   =   array();
                $upd_supplier_array['staff_id']       = $this->session->userdata('staff_id');
                $upd_supplier_array['supplier_name']  = $data['init_supplier_name'];
                $upd_supplier_array['registration_no']= $data['init_registration_no'];
                $upd_supplier_array['contact_id']     = $data['contact_id'];
                $upd_supplier_array['customer_info_id']= $data['customer_info_id'];
                $upd_supplier_array['acc_no']         = $data['init_acc_no'];
                //$upd_supplier_array['account_id']   = $data['init_town'];
                if(is_numeric($data['init_credit_term'])){
                    $upd_supplier_array['credit_term']                = $data['init_credit_term'];
                }
                //$upd_supplier_array['credit_term']    = $data['init_credit_term'];
                $upd_supplier_array['supplier_remarks']= $data['init_supplier_remarks'];
                $upd_supplier_array['supplier_id']= $data['supplier_id'];
                $upd_supplier_array['supplier_name']    = $data['init_supplier_name'];
                $upd_supplier_array['address']        = $data['init_address'];
                $upd_supplier_array['address2']       = $data['init_address2'];
                $upd_supplier_array['address3']       = $data['init_address3'];
                $upd_supplier_array['town']           = $data['init_town'];
                $upd_supplier_array['state']          = $data['init_state'];
                $upd_supplier_array['postcode']       = $data['init_postcode'];
                $upd_supplier_array['country']        = $data['init_country'];
                $upd_supplier_array['tel_no']         = $data['init_tel_no'];
                $upd_supplier_array['tel_no2']        = $data['init_tel_no2'];
                $upd_supplier_array['tel_no3']        = $data['init_tel_no3'];
                $upd_supplier_array['fax_no']         = $data['init_fax_no'];
                $upd_supplier_array['fax_no2']        = $data['init_fax_no2'];
                $upd_supplier_array['email']          = $data['init_email'];
                $upd_supplier_array['contact_person'] = $data['init_contact_person'];
                $upd_supplier_array['other']          = $data['partner_clinic_id'];
                $upd_supplier_array['website']        = $data['init_website'];
                $upd_supplier_array['contact_remarks']        = $data['init_contact_remarks'];
	            $upd_supplier_data       =   $this->morders_procedure_wdb->update_procedure_supplier($upd_supplier_array);
                $this->session->set_flashdata('data_activity', 'Procedure supplier updated.');
            } //endif($data['diagnosis_id'] == "new_supplier")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_orders/ehr_orders_procedure/ehr_orders_list_procsuppliers/procedure";
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_imagupplier') == FALSE)


    } // end of function orders_edit_procsupplier_info()


    // ------------------------------------------------------------------------
    // Add/Edit imaging product based on LOINC
    function orders_edit_proc_product($seg3,$seg4,$seg5,$seg6)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['app_currency']		=	$this->config->item('app_currency');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['breadcrumbs']        =   breadcrumbs('ehr_orders/orders_mgt','Orders','ehr_orders/ehr_orders_list_imagsuppliers/imaging','List Imaging Suppliers');    
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['supplier_id']        =   $seg5; //$this->uri->segment(5);
        $data['product_id']         =   $seg6; //$this->uri->segment(6);
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['now_time']           =   date("H:i",$data['now_id']);
        $data['packages_ordered']   =   array();
	  	
        if(count($_POST)) {
            // User has posted the form
            $data['init_product_name']   =   $_POST['product_name'];
            //$data['form_purpose']   = $_POST['form_purpose'];
            $data['supplier_id']   		    = $_POST['supplier_id'];
            $data['init_pcode1ext_id']      = $_POST['pcode1ext_id'];
            $data['init_product_code']      = $_POST['product_code'];
            $data['init_retail_price_1']      = $_POST['retail_price_1'];
            $data['init_retail_price_2']    = $_POST['retail_price_2'];
            $data['init_retail_price_3']    = $_POST['retail_price_3'];
            $data['init_seller_code']   	= $_POST['seller_code'];
            $data['init_supplier_cost']   	= $_POST['supplier_cost'];
            $data['init_prod_description'] 		= $_POST['prod_description'];
            $data['init_commonly_used']     = $_POST['commonly_used'];
            $data['init_prod_remarks'] 		    = $_POST['prod_remarks'];
            $data['init_package_location_id']      = $_POST['package_location_id'];
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_product") {
                //echo "new_product";
                $data['init_clinic_shortname']       =   $this->session->userdata('clinic_shortname');
                $data['init_pcode1ext_id']         =   "";
                $data['init_product_name']         =   "";
                $data['init_product_code']      =   "";
                $data['init_retail_price_1']      =   0;
                $data['init_retail_price_2']    =   0;
                $data['init_retail_price_3']    =   0;
                $data['init_seller_code']       =   "";
                $data['init_supplier_cost']     =   0;
                $data['init_prod_description']       =   "";
                $data['init_commonly_used']     =   "";
                $data['init_prod_remarks']           =   "";
                $data['init_package_location_id'] =   "";
            } elseif ($data['form_purpose'] == "edit_product") {
                //echo "Edit lab order";
                $data['product_info'] = $this->morders_procedure_rdb->get_proc_product_bysupplier($data['supplier_id'],$data['product_id']);
                $data['init_clinic_shortname']  =   $data['product_info'][0]['clinic_shortname'];
                $data['init_pcode1ext_id']     	=   $data['product_info'][0]['pcode1ext_id'];
                $data['init_product_name']     	=   $data['product_info'][0]['product_name'];
                $data['init_product_code']     	=   $data['product_info'][0]['product_code'];
                $data['init_retail_price_1'] 		=   $data['product_info'][0]['retail_price_1'];
                $data['init_retail_price_2'] 	=   $data['product_info'][0]['retail_price_2'];
                $data['init_retail_price_3'] 	=   $data['product_info'][0]['retail_price_3'];
                $data['init_seller_code']       =   $data['product_info'][0]['seller_code'];
                $data['init_supplier_cost'] 	=   $data['product_info'][0]['supplier_cost'];
                $data['init_prod_description'] 	    =   $data['product_info'][0]['prod_description'];
                $data['init_commonly_used']     =   $data['product_info'][0]['commonly_used'];
                $data['init_prod_remarks']           =   $data['product_info'][0]['prod_remarks'];
                $data['init_package_location_id'] = $data['product_info'][0]['location_id'];
				$data['packages_ordered']   = $this->morders_rdb->get_imag_product_ordered($data['product_id']);
            } //endif ($data['form_purpose'] == "new_product")
        } //endif(count($_POST))
		$data['title'] = "Add/Edit Imaging Product";
        $data['init_location_id']   =   $this->session->userdata('location_id');
        //$data['init_clinic_name']   =   NULL;
        if(empty($data['init_package_location_id'])){
            $data['init_package_location_id']   =   $this->session->userdata('location_id');
        }
		$data['clinics_list']       =   $this->mthirra->get_clinics_list('All');
		$data['procedures_list']  = $this->morders_procedure_rdb->get_procedure_code_list('data','pcode1ext_longname', 'ALL',0);
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        //$data['init_patient_id']    =   $patient_id;
        $data['supplier_info'] = $this->morders_procedure_rdb->get_supplier_list_proc($data['supplier_id']);

        $data['level3_list']    =   array();
        $data['level3_list'][0]['marker']      = "valid";  
        $data['level3_list'][0]['info']        = "N/A";  
        if(!empty($data['init_loinc_num']) ){
            $data['level3'] =   "valid";
        }

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_proc_product') == FALSE){
            //echo "Validation failed";
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_orders_wap";
                //$new_body   =   "ehr/ehr_orders_edit_lab_packagetest_wap";
                $new_body   =   "ehr_orders_edit_proc_product_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_html";
                $new_sidebar=   "ehr/sidebar_emr_orders_html";
                $new_body   =   "ehr_orders_edit_proc_product_html";
                $new_footer =   "ehr/footer_emr_html";
            }
            if($data['user_rights']['section_orders'] < 100){
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
            $this->load->model('morders_procedure_wdb');
            //echo "<br />Insert record";
            if($data['form_purpose'] == "new_product") {
                // New procedure product record
                $ins_imag_array   =   array();
                $ins_imag_array['now_id']           = $data['now_id'];
                $ins_imag_array['staff_id']         = $this->session->userdata('staff_id');
				$ins_imag_array['product_id']	    = $data['now_id'];
                $ins_imag_array['location_id']      = $data['init_package_location_id']; // Unused
				$ins_imag_array['product_name']		= $data['init_product_name'];
				$ins_imag_array['supplier_id']		= $data['supplier_id'];
				$ins_imag_array['pcode1ext_id']		= $data['init_pcode1ext_id'];
				//$ins_imag_array['pcode1ext_code']		= $data['init_pcode1ext_id'];
				$ins_imag_array['product_code']		= $data['init_product_code'];
				$ins_imag_array['supplier_cost']	= $data['init_supplier_cost'];
				$ins_imag_array['retail_price_1']	    = $data['init_retail_price_1'];
				$ins_imag_array['retail_price_2']	= $data['init_retail_price_2'];
				$ins_imag_array['retail_price_3']	= $data['init_retail_price_3'];
				$ins_imag_array['prod_description']	    = $data['init_prod_description'];
                if(is_numeric($data['init_commonly_used'])){
                    $ins_imag_array['commonly_used']                = $data['init_commonly_used'];
                }
				//$ins_imag_array['commonly_used']		= $data['commonly_used'];
				$ins_imag_array['prod_remarks']	        = $data['init_prod_remarks'];
                if($data['offline_mode']){
                    $ins_imag_array['synch_out']        = $data['now_id'];
                }//endif($data['offline_mode'])
	            $ins_imag_data  =   $this->morders_procedure_wdb->insert_new_proc_product($ins_imag_array);
                $this->session->set_flashdata('data_activity', 'Procedure product added.');
            } elseif($data['form_purpose'] == "edit_product") {
                // Existing procedure product record
                $upd_imag_array['product_id']       = $data['product_id'];
                $upd_imag_array['staff_id']         = $this->session->userdata('staff_id');
                $upd_imag_array['pcode1ext_id']        = $data['init_pcode1ext_id'];
                //$upd_imag_array['product_code']      = $data['product_code'];
                $upd_imag_array['product_name']      = $data['init_product_name'];
                $upd_imag_array['supplier_id']      = $data['supplier_id'];
                $upd_imag_array['product_code']     = $data['init_product_code'];
                $upd_imag_array['retail_price_1']     = $data['init_retail_price_1'];
                $upd_imag_array['retail_price_2']   = $data['init_retail_price_2'];
                $upd_imag_array['retail_price_3']   = $data['init_retail_price_3'];
                $upd_imag_array['seller_code']    = $data['init_seller_code'];
                $upd_imag_array['supplier_cost']    = $data['init_supplier_cost'];
                $upd_imag_array['prod_description']      = $data['init_prod_description'];
                if(is_numeric($data['init_commonly_used'])){
                    $upd_imag_array['commonly_used'] = $data['init_commonly_used'];
                }
				$upd_imag_array['prod_remarks']	        = $data['init_prod_remarks'];
                $upd_imag_array['location_id']      = $data['init_package_location_id']; // Unused
	            $upd_imag_data  =   $this->morders_procedure_wdb->update_proc_product($upd_imag_array);
                $this->session->set_flashdata('data_activity', 'Procedure product updated.');
            } //endif($data['diagnosis_id'] == "new_patient")
            $new_page = base_url()."index.php/ehr/ehr/index/ehr_orders/ehr_orders_procedure/orders_edit_procsupplier_info/edit_supplier/proc/".$data['supplier_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_lab_order') == FALSE)


    } // end of function orders_edit_proc_product()



}

/* End of file Ehr_orders_procedure.php */
/* Location: ./app_thirra/controllers/Ehr_orders_procedure.php */
