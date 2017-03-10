21<?php
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
 * Portions created by the Initial Developer are Copyright (C) 2010-2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

session_start();

/**
 * Controller Class for EHR_INDIVIDUAL_HISTORY
 *
 * This class is used for both narrowband and broadband EHR. 
 *
 * @version 0.9.15
 * @package THIRRA - EHR
 * @author  Jason Tan Boon Teck
 */
class Ehr_individual_history extends MX_Controller 
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
		$this->load->model('mindiv_rdb');
		$this->load->model('memr_rdb');
		$this->load->model('mehr_wdb');
		$this->load->model('morders_lab_rdb');
		$this->load->model('morders_imaging_rdb');
		$this->load->model('mthirra');

		// PanaCI
        $params = array('width' => 750, 'height' => 800, 'margin' => 10, 'backgroundColor' => '#eeeeee',);
        $this->load->library('chart', $params);

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
    // === INDIVIDUAL RECORD
    // ------------------------------------------------------------------------
    function list_history_vitals($seg3,$seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['patient_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
        $data['patient_info']['name']   = $data['patient_info']['patient_name'];
 		$data['title'] = "PR-".$data['patient_info']['name'];
		$data['vitals_list']  = $this->mindiv_rdb->get_history_vitals('List',$data['patient_id']);

        // Build data for Charts
        $data['min_points']     = 3;
        $data['max_points']     = 16;
        $data['vitals_data']    =   array_reverse($data['vitals_list']);
        // Classes defined in CSS
        $data['css_chart_height_low']       =   "chart_height_low";
        $data['css_chart_height_high']      =   "chart_height_high";
        $data['css_chart_width_narrow']     =   "chart_width_narrow";
        $data['css_chart_width_broad']      =   "chart_width_broad";
        
        // TEMPERATURE DATA
        $data['points_temperature'] = 0;
        $data['chart_height_temperature']   =   $data['css_chart_height_low'];
        $data['chart_width_temperature']    =   $data['css_chart_width_narrow'];
        $data['threshold_points']   =   4; // Number of data points
        $data['threshold_days']     =   365; // Days spread
        $data['threshold_range']    =   4; // Minimum and maximum temperatures (degrees Celcius)
        $data['temperature'] = "[";
        foreach ($data['vitals_data'] as $vitals_item){
            if(!empty($vitals_item['temperature'])){
                if($data['points_temperature'] >= $data['max_points']){
                    break 1;
                }
                $data['temperature'] .= "['";
                $data['temperature'] .= $vitals_item['reading_date'];
                $data['temperature'] .= " ".$vitals_item['reading_time'];
                $data['temperature'] .= "',";// 4:00PM',";
                $data['temperature'] .= $vitals_item['temperature'];
                $data['temperature'] .= "],";
                $data['dates_temperature'][] = $vitals_item['reading_date'];
                $data['range_temperature'][] = $vitals_item['temperature'];
                $data['points_temperature']++;
            }
        } //end foreach ($data['vitals_data'] as $vitals_item)
        if($data['points_temperature'] > 0){
            // Remove extra comma from serialised array
            $data['temperature'] = substr($data['temperature'],0,strlen($data['temperature'])-1);
            // Determine height and width of chart
            $data['days_temperature'] = round((strtotime(max($data['dates_temperature']))-strtotime(min($data['dates_temperature'])))/(60*60*24),2);
            $data['range_temperature']  =   max($data['range_temperature']) - min($data['range_temperature']);
            if($data['points_temperature'] >= $data['threshold_points']){
                $data['chart_width_temperature']    =   $data['css_chart_width_broad'];
            }
            if($data['days_temperature'] >= $data['threshold_days']){
                $data['chart_width_temperature']    =   $data['css_chart_width_broad'];
            }
            if($data['range_temperature'] >= $data['threshold_range']){
                $data['chart_height_temperature']    =   $data['css_chart_height_high'];
            }
        } //endif($data['points_temperature'] > 0)
        $data['temperature'] .= "]";

        // HEIGHT DATA
        $data['points_height'] = 0;
        $data['chart_height_height']   =   $data['css_chart_height_low'];
        $data['chart_width_height']    =   $data['css_chart_width_narrow'];
        $data['threshold_points']   =   4; // Number of data points
        $data['threshold_days']     =   365; // Days spread
        $data['threshold_range']    =   50; // Minimum and maximum heights (cm)
        $data['height'] = "[";
        foreach ($data['vitals_data'] as $vitals_item){
            if(!empty($vitals_item['height'])){
                if($data['points_height'] >= $data['max_points']){
                    break 1;
                }
                $data['height'] .= "['";
                $data['height'] .= $vitals_item['reading_date'];
                $data['height'] .= " ".$vitals_item['reading_time'];
                $data['height'] .= "',";// 4:00PM',";
                $data['height'] .= $vitals_item['height'];
                $data['height'] .= "],";
                $data['dates_height'][] = $vitals_item['reading_date'];
                $data['range_height'][] = $vitals_item['height'];
                $data['points_height']++;
            }
        } //end foreach ($data['vitals_data'] as $vitals_item)
        if($data['points_height'] > 0){
            // Remove extra comma from serialised array
            $data['height'] = substr($data['height'],0,strlen($data['height'])-1);
            // Determine height and width of chart
            $data['days_height'] = round((strtotime(max($data['dates_height']))-strtotime(min($data['dates_height'])))/(60*60*24),2);
            $data['range_height']  =   max($data['range_height']) - min($data['range_height']);
            if($data['points_height'] >= $data['threshold_points']){
                $data['chart_width_height']    =   $data['css_chart_width_broad'];
            }
            if($data['days_height'] >= $data['threshold_days']){
                $data['chart_width_height']    =   $data['css_chart_width_broad'];
            }
            if($data['range_height'] >= $data['threshold_range']){
                $data['chart_height_height']    =   $data['css_chart_height_high'];
            }
        } //endif($data['points_height'] > 0)
        $data['height'] .= "]";

        // WEIGHT DATA
        $data['points_weight'] = 0;
        $data['chart_height_weight']   =   $data['css_chart_height_low'];
        $data['chart_width_weight']    =   $data['css_chart_width_narrow'];
        $data['threshold_points']   =   4; // Number of data points
        $data['threshold_days']     =   365; // Days spread
        $data['threshold_range']    =   10; // Minimum and maximum heights (kg)
        $data['weight'] = "[";
        foreach ($data['vitals_data'] as $vitals_item){
            if(!empty($vitals_item['weight'])){
                $data['weight'] .= "['";
                $data['weight'] .= $vitals_item['reading_date'];
                $data['weight'] .= " ".$vitals_item['reading_time'];
                $data['weight'] .= "',";// 4:00PM',";
                $data['weight'] .= $vitals_item['weight'];
                $data['weight'] .= "],";
                $data['dates_weight'][] = $vitals_item['reading_date'];
                $data['range_weight'][] = $vitals_item['weight'];
                $data['points_weight']++;
            }
        } //end foreach ($data['vitals_data'] as $vitals_item)
        if($data['points_weight'] > 0){
            // Remove extra comma from serialised array
            $data['weight'] = substr($data['weight'],0,strlen($data['weight'])-1);
            // Determine height and width of chart
            $data['days_weight'] = round((strtotime(max($data['dates_weight']))-strtotime(min($data['dates_weight'])))/(60*60*24),2);
            $data['range_weight']  =   max($data['range_weight']) - min($data['range_weight']);
            if($data['points_weight'] >= $data['threshold_points']){
                $data['chart_width_weight']    =   $data['css_chart_width_broad'];
            }
            if($data['days_weight'] >= $data['threshold_days']){
                $data['chart_width_weight']    =   $data['css_chart_width_broad'];
            }
            if($data['range_weight'] >= $data['threshold_range']){
                $data['chart_height_weight']    =   $data['css_chart_height_high'];
            }
        } //endif($data['points_weight'] > 0)
        $data['weight'] .= "]";

        // BLOOD PRESSURE DATA
        $data['points_bp_systolic'] = 0;
        $data['chart_height_bp']   =   $data['css_chart_height_low'];
        $data['chart_width_bp']    =   $data['css_chart_width_narrow'];
        $data['threshold_points']   =   4; // Number of data points
        $data['threshold_days']     =   365; // Days spread
        $data['threshold_range']    =   10; // Minimum and maximum bp (mm Hg)
        $data['bp_systolic'] = "[";
        foreach ($data['vitals_data'] as $vitald_item){
            if((!empty($vitald_item['bp_systolic'])) && $vitald_item['bp_systolic']<>""){
                $data['bp_systolic'] .= "['";
                $data['bp_systolic'] .= $vitald_item['reading_date'];
                $data['bp_systolic'] .= " ".$vitald_item['reading_time'];
                $data['bp_systolic'] .= "',";// 4:00PM',";
                $data['bp_systolic'] .= $vitald_item['bp_systolic'];
                $data['bp_systolic'] .= "],";
                $data['dates_bp'][] = $vitald_item['reading_date'];
                $data['range_bp'][] = $vitald_item['bp_systolic'];
                $data['points_bp_systolic']++;
            }
        } //end foreach ($data['vitals_data'] as $vitals_item)
        if($data['points_bp_systolic'] > 0){
            // Remove extra comma from serialised array
            $data['bp_systolic'] = substr($data['bp_systolic'],0,strlen($data['bp_systolic'])-1);
            // Determine height and width of chart
            $data['days_bp'] = round((strtotime(max($data['dates_bp']))-strtotime(min($data['dates_bp'])))/(60*60*24),2);
            $data['range_bp']  =   max($data['range_bp']) - min($data['range_bp']);
            if($data['points_bp_systolic'] >= $data['threshold_points']){
                $data['chart_width_bp']    =   $data['css_chart_width_broad'];
            }
            if($data['days_bp'] >= $data['threshold_days']){
                $data['chart_width_bp']    =   $data['css_chart_width_broad'];
            }
            if($data['range_bp'] >= $data['threshold_range']){
                $data['chart_height_bp']    =   $data['css_chart_height_high'];
            }
        } //endif($data['points_bp_systolic'] > 0)
        $data['bp_systolic'] .= "]";
        
        $data['points_bp_diastolic'] = 0;
        $data['bp_diastolic'] = "[";
        foreach ($data['vitals_data'] as $vitale_item){
            if(!empty($vitale_item['bp_diastolic']) && $vitale_item['bp_systolic']<>""){
                $data['bp_diastolic'] .= "['";
                $data['bp_diastolic'] .= $vitale_item['reading_date'];
                $data['bp_diastolic'] .= " ".$vitale_item['reading_time'];
                $data['bp_diastolic'] .= "',";// 4:00PM',";
                $data['bp_diastolic'] .= $vitale_item['bp_diastolic'];
                $data['bp_diastolic'] .= "],";
                $data['points_bp_diastolic']++;
            }
        } //end foreach ($data['vitals_data'] as $vitals_item)
        $data['bp_diastolic'] = substr($data['bp_diastolic'],0,strlen($data['bp_diastolic'])-1);
        $data['bp_diastolic'] .= "]";
         
        if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            // Keep all charts as narrow
            $data['chart_width_temperature']=   $data['css_chart_width_narrow'];
            $data['chart_width_height']     =   $data['css_chart_width_narrow'];
            $data['chart_width_weight']     =   $data['css_chart_width_narrow'];
            $data['chart_width_bp']         =   $data['css_chart_width_narrow'];
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_ovrvw_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
            //$new_body   =   "ehr/ehr_indv_list_history_vitals_wap";
            $new_body   =   "ehr_indv_list_history_vitals_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_ovrvw_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
            $new_body   =   "ehr_indv_list_history_vitals_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		$this->load->vars($data);
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);		
		
    } // end of function list_history_vitals()


    // ------------------------------------------------------------------------
    function edit_history_vitals($seg3,$seg4,$seg5)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$this->load->model('mconsult_wdb');
		$data['title'] = 'Vital Signs';
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['patient_vital']      =   $seg5; //$this->uri->segment(6);
		//$data['clinic_info']    = $this->mbio->get_clinic_info($_SESSION['location_id']);
		//$data['patient_info'] = $this->memr_rdb->get_patient_demo($data['patient_id']);
        //$data['patcon_info']  = $this->memr_rdb->get_patcon_details($data['patient_id']);
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['now_time']           =   date("H:i",$data['now_id']);

        if(count($_POST)) {
            // User has posted the form
            $data['now_id']                   =   $_POST['now_id'];
            $data['now_date']                 =   date("Y-m-d",$data['now_id']);
            $data['init_patient_id']          =   $_POST['patient_id'];
            $data['patient_id']               =   $data['init_patient_id'];
            $data['init_vital_id']            =   $_POST['vital_id'];
            $data['vital_id']                 =   $data['init_vital_id'];
            $data['init_reading_date']        =   $_POST['reading_date'];
            $data['init_reading_time']        =   $_POST['reading_time'];
            $data['init_height']              =   trim($_POST['height']);
            $data['init_weight']              =   trim($_POST['weight']);
            $data['init_left_vision']         =   $_POST['left_vision'];
            $data['init_right_vision']        =   $_POST['right_vision'];
            $data['init_temperature']         =   trim($_POST['temperature']);
            $data['init_pulse_rate']          =   trim($_POST['pulse_rate']);
            $data['init_bmi']                 =   $_POST['bmi'];
            $data['init_waist_circumference'] =   trim($_POST['waist_circumference']);
            $data['init_bp_systolic']         =   trim($_POST['bp_systolic']);
            $data['init_bp_diastolic']        =   trim($_POST['bp_diastolic']);
            $data['init_respiration_rate']    =   trim($_POST['respiration_rate']);
            $data['init_ofc']                 =   trim($_POST['ofc']);
            $data['init_remarks']             =   $_POST['remarks'];
            
            if ($data['patient_id'] == "new_patient"){
                // New form
		        //$data['patient_id']         = "";
          		$data['save_attempt']       = 'VITAL SIGNS';
		        $data['patient_info']       = array();
            } else {
                // Edit form
          		$data['save_attempt']       = 'VITAL SIGNS';
                // These fields were passed through as hidden tags
                $data['patient_id']         =   $data['init_patient_id']; //came from POST
		        $data['patient_info']       =   $this->memr_rdb->get_patient_demo($data['patient_id']);
                $data['init_patient_id']    =   $data['patient_info']['patient_id'];
                //$data['init_ic_other_no']   =   $data['patient_info']['ic_other_no'];
            } //endif ($patient_id == "new_patient")

        } else {
            // First time form is displayed
            $data['init_location_id']   =   $this->session->userdata('location_id');
            $data['init_end_date']      =   NULL;
            $data['init_clinic_name']   =   NULL;
            $data['now_id']             =   time();
            $data['now_date']           =   date("Y-m-d",$data['now_id']);
            $patient_id                 =   $seg4; //$this->uri->segment(4);
            $data['patient_id']         =   $patient_id;
            $data['init_patient_id']    =   $patient_id;
            $data['summary_id']         = $this->uri->segment(5);
            $data['patient_info'] = $this->memr_rdb->get_patient_demo($data['patient_id']);
            $data['patcon_info']  = $this->memr_rdb->get_patcon_details($data['patient_id'],$data['summary_id']);
            $data['vitals_info']  = $this->memr_rdb->get_patcon_vitals($data['summary_id']);

            if ($data['vitals_info']['vital_id'] == "new_vitals") {
                // New vitals
          		$data['save_attempt']            =   'ADD VITAL SIGNS';
	            //$data['vitals_info']             =   array();
                $data['init_vital_id']           =   $data['vitals_info']['vital_id'];
                $data['init_reading_date']       =   $data['now_date'];
                $data['init_reading_time']       =   $data['now_time'];
                $data['init_height']             =   NULL;
                $data['init_weight']             =   NULL;
                $data['init_left_vision']        =   NULL;
                $data['init_right_vision']       =   NULL;
                $data['init_temperature']        =   NULL;
                $data['init_pulse_rate']         =   NULL;
                $data['init_bmi']                =   NULL;
                $data['init_waist_circumference']=   NULL;
                $data['init_bp_systolic']        =   NULL;
                $data['init_bp_diastolic']       =   NULL;
                $data['init_respiration_rate']   =   NULL;
                $data['init_ofc']                =   NULL;
                $data['init_remarks']            =   NULL;
            } else {
                // Editing vitals
          		$data['save_attempt'] = 'EDIT VITAL SIGNS';
                $data['init_patient_id']         =   $data['patient_id'];
                $data['init_vital_id']           =   $data['vitals_info']['vital_id'];
                $data['init_reading_date']       =   $data['vitals_info']['reading_date'];
                $data['init_reading_time']       =   $data['vitals_info']['reading_time'];
                $data['init_height']             =   $data['vitals_info']['height'];
                $data['init_weight']             =   $data['vitals_info']['weight'];
                $data['init_left_vision']        =   $data['vitals_info']['left_vision'];
                $data['init_right_vision']       =   $data['vitals_info']['right_vision'];
                $data['init_temperature']        =   $data['vitals_info']['temperature'];
                $data['init_pulse_rate']         =   $data['vitals_info']['pulse_rate'];
                $data['init_bmi']                =   $data['vitals_info']['bmi'];
                $data['init_waist_circumference']=   $data['vitals_info']['waist_circumference'];
                $data['init_bp_systolic']        =   $data['vitals_info']['bp_systolic'];
                $data['init_bp_diastolic']       =   $data['vitals_info']['bp_diastolic'];
                $data['init_respiration_rate']   =   $data['vitals_info']['respiration_rate'];
                $data['init_ofc']                =   $data['vitals_info']['ofc'];
                $data['init_remarks']            =   $data['vitals_info']['remarks'];
            } //endif ($patient_id == "new_vitals")
        } //endif(count($_POST))

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_vitals') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_ovrvw_wap";
                $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
                //$new_body   =   "ehr/emr_edit_vitals_wap";
                $new_body   =   "ehr_indv_edit_history_vitals_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_ovrvw_html";
                $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
                $new_body   =   "ehr_indv_edit_history_vitals_html";
                $new_footer =   "ehr/footer_emr_html";
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
            if($data['vital_id'] == "new_vitals") {
                // New patient vital signs
                $ins_vitals_array   =   array();
                $ins_vitals_array['staff_id']           = $this->session->userdata('staff_id');
                $ins_vitals_array['now_id']             = $data['now_id'];
                $ins_vitals_array['vital_id']           = $data['now_id'];
                $ins_vitals_array['patient_id']         = $data['init_patient_id'];
                //$ins_vitals_array['session_id']         = $data['summary_id'];
                $ins_vitals_array['adt_id']             = $data['summary_id'];
                $ins_vitals_array['reading_date']       = $data['init_reading_date'];
                $ins_vitals_array['reading_time']       = $data['init_reading_time'];
                if(is_numeric($data['init_height'])){
                    $ins_vitals_array['height']             = $data['init_height'];
                }
                if(is_numeric($data['init_weight'])){
                    $ins_vitals_array['weight']             = $data['init_weight'];
                }
                $ins_vitals_array['left_vision']        = $data['init_left_vision'];
                $ins_vitals_array['right_vision']       = $data['init_right_vision'];
                if(is_numeric($data['init_temperature'])){
                    $ins_vitals_array['temperature']        = $data['init_temperature'];
                }
                if(is_numeric($data['init_pulse_rate'])){
                    $ins_vitals_array['pulse_rate']         = $data['init_pulse_rate'];
                }
                if(is_numeric($data['init_bmi'])){
                    $ins_vitals_array['bmi']                = $data['init_bmi'];
                }
                if(is_numeric($data['init_waist_circumference'])){
                    $ins_vitals_array['waist_circumference']= $data['init_waist_circumference'];
                }
                if(is_numeric($data['init_bp_systolic'])){
                    $ins_vitals_array['bp_systolic']        = $data['init_bp_systolic'];
                }
                if(is_numeric($data['init_bp_diastolic'])){
                    $ins_vitals_array['bp_diastolic']       = $data['init_bp_diastolic'];
                }
                if(is_numeric($data['init_respiration_rate'])){
                    $ins_vitals_array['respiration_rate']   = $data['init_respiration_rate'];
                }
                if(is_numeric($data['init_ofc'])){
                    $ins_vitals_array['ofc']                = $data['init_ofc'];
                }
                $ins_vitals_array['remarks']            = $data['init_remarks'];
                if($data['offline_mode']){
                    $ins_vitals_array['synch_out']        = $data['now_id'];
                }
	            $ins_vitals_data       =   $this->mconsult_wdb->insert_new_vitals($ins_vitals_array);
                $this->session->set_flashdata('data_activity', 'Vital signs added.');
            } else {
                //Edit patient vital signs
                $ins_vitals_array   =   array();
                $ins_vitals_array['staff_id']           = $this->session->userdata('staff_id');
                $ins_vitals_array['now_id']             = $data['now_id'];
                $ins_vitals_array['vital_id']           = $data['vital_id'];
                $ins_vitals_array['patient_id']         = $data['init_patient_id'];
                //$ins_vitals_array['session_id']         = $data['summary_id'];
                $ins_vitals_array['adt_id']             = $data['summary_id'];
                $ins_vitals_array['reading_date']       = $data['init_reading_date'];
                $ins_vitals_array['reading_time']       = $data['init_reading_time'];
                if(is_numeric($data['init_height'])){
                    $ins_vitals_array['height']             = $data['init_height'];
                }
                if(is_numeric($data['init_weight'])){
                    $ins_vitals_array['weight']             = $data['init_weight'];
                }
                $ins_vitals_array['left_vision']        = $data['init_left_vision'];
                $ins_vitals_array['right_vision']       = $data['init_right_vision'];
                if(is_numeric($data['init_temperature'])){
                    $ins_vitals_array['temperature']        = $data['init_temperature'];
                }
                if(is_numeric($data['init_pulse_rate'])){
                    $ins_vitals_array['pulse_rate']         = $data['init_pulse_rate'];
                }
                if(is_numeric($data['init_bmi'])){
                    $ins_vitals_array['bmi']                = $data['init_bmi'];
                }
                if(is_numeric($data['init_waist_circumference'])){
                    $ins_vitals_array['waist_circumference']= $data['init_waist_circumference'];
                }
                if(is_numeric($data['init_bp_systolic'])){
                    $ins_vitals_array['bp_systolic']        = $data['init_bp_systolic'];
                }
                if(is_numeric($data['init_bp_diastolic'])){
                    $ins_vitals_array['bp_diastolic']       = $data['init_bp_diastolic'];
                }
                if(is_numeric($data['init_respiration_rate'])){
                    $ins_vitals_array['respiration_rate']   = $data['init_respiration_rate'];
                }
                if(is_numeric($data['init_ofc'])){
                    $ins_vitals_array['ofc']                = $data['init_ofc'];
                }
                $ins_vitals_array['remarks']            = $data['init_remarks'];
	            $ins_vitals_data       =   $this->mconsult_wdb->update_vitals($ins_vitals_array);
                $this->session->set_flashdata('data_activity', 'Vital signs updated.');
                
            } //endif($data['patient_id'] == "new_patient")
            $new_page = base_url()."index.php/indv/indv/index/indv_history/ehr_individual_history/list_history_vitals/list_vitals/".$data['patient_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_vitals') == FALSE)
		//$this->load->view('bio/bio_new_case_hosp');
    } //end of function edit_history_vitals()


    // ------------------------------------------------------------------------
    function list_history_diagnosis($seg3,$seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['patient_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
        $data['patient_info']['name']   = $data['patient_info']['patient_name'];
 		$data['title'] = "PR-".$data['patient_info']['name'];
        $data['diagnoses_list'] = $this->mindiv_rdb->get_recent_diagnoses($data['patient_id']);
		$this->load->vars($data);
        if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_ovrvw_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
            //$new_body   =   "ehr/ehr_indv_list_history_vitals_wap";
            $new_body   =   "ehr_indv_list_history_diagnosis_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_ovrvw_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
            $new_body   =   "ehr_indv_list_history_diagnosis_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);		
		
    } // end of function list_history_diagnosis()


    // ------------------------------------------------------------------------
    function list_history_medication($seg3,$seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['patient_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
        $data['patient_info']['name']   = $data['patient_info']['patient_name'];
 		$data['title'] = "PR-".$data['patient_info']['name'];
        $data['medication_list']= $this->mindiv_rdb->get_recent_medication($data['patient_id'],99,0);
        $data['diagnoses_list'] = $this->mindiv_rdb->get_recent_diagnoses($data['patient_id']);
		$this->load->vars($data);
        if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_ovrvw_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
            //$new_body   =   "ehr/ehr_indv_list_history_vitals_wap";
            $new_body   =   "ehr_indv_list_history_medication_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_ovrvw_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
            $new_body   =   "ehr_indv_list_history_medication_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);		
		
    } // end of function list_history_medication()


    // ------------------------------------------------------------------------
    function list_history_lab($seg3,$seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['patient_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
        $data['patient_info']['name']   = $data['patient_info']['patient_name'];
 		$data['title'] = "PR-".$data['patient_info']['name'];
        $data['tests_list']       = $this->mindiv_rdb->get_recent_lab($data['patient_id']);
		$this->load->vars($data);
        if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_ovrvw_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
            //$new_body   =   "ehr/ehr_indv_list_history_vitals_wap";
            $new_body   =   "ehr_indv_list_history_lab_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_ovrvw_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
            $new_body   =   "ehr_indv_list_history_lab_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);		
		
    } // end of function list_history_lab()


    // ------------------------------------------------------------------------
    // Lab Results Form
    function edit_labresults($seg3,$seg4,$seg5,$seg6)
    {
		$this->load->model('morders_wdb');
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['now_time']           =   date("H:i",$data['now_id']);
	  	
        if(count($_POST)) {
            // User has posted the form
            if(isset($_POST['lab_package_id'])) { 
                $data['lab_package_id']   =   $_POST['lab_package_id'];
            }
            if(isset($_POST['supplier_id'])) { 
                $data['supplier_id']   =   $_POST['supplier_id'];
            } else {
                $data['supplier_id']   =   "none";
            }
            $data['form_purpose']   = $_POST['form_purpose'];
            $data['patient_id']     = $_POST['patient_id'];
            $data['summary_id']     = $_POST['summary_id'];
            $data['lab_order_id']   = $_POST['lab_order_id'];
            $data['order_info'] = $this->memr_rdb->get_patcon_lab($data['summary_id'],$data['lab_order_id']);
            $data['lab_package_id'] =   $data['order_info'][0]['lab_package_id'];
            $data['package_name']   =   $data['order_info'][0]['package_name'];
            $data['supplier_id']    =   $data['order_info'][0]['supplier_id'];
            $data['supplier_name']  =   $data['order_info'][0]['supplier_name'];
            $data['sample_required']=   $data['order_info'][0]['sample_required'];
            $data['sample_date']    =   $data['order_info'][0]['sample_date'];
            $data['sample_time']    =   $data['order_info'][0]['sample_time'];
            $data['fasting']        =   $data['order_info'][0]['fasting'];
            $data['urgency']        =   $data['order_info'][0]['urgency'];
            $data['sample_ref']     =   $data['order_info'][0]['sample_ref'];
            $data['remarks']        =   $data['order_info'][0]['remarks'];
            $data['summary_result'] = $_POST['summary_result'];
            $data['result_date']    = $_POST['result_date'];
            $data['result_ref']     = $_POST['result_ref'];
            $data['num_of_tests']   = $_POST['num_of_tests'];
			//$data['package_info']  = $this->morders_lab_rdb->get_one_lab_package($data['lab_package_id']);
            $data['package_info']  = $this->memr_rdb->get_one_lab_results($data['lab_order_id']);
			if(count($data['package_info']) > 0){
				for($i=1; ($i <= $data['num_of_tests']); $i++){
					$varname_result =   "test_result_".$i;
					$varname_normal =   "test_normal_".$i;
					$varname_remark =   "test_remark_".$i;
					$data['package_info'][$i-1][$varname_result]	=	$_POST["test_result_".$i];
					$data['package_info'][$i-1][$varname_normal]	=	$_POST["test_normal_".$i];
					$data['package_info'][$i-1][$varname_remark]	=	$_POST["test_remark_".$i];
					//echo $data[$varname_result];
				} //end for($i=1; ($i <= $data['num_of_test']); $i++)
				$data['num_of_tests'] = count($data['package_info']);
			} //endif(count($data['package_info']) == $data['num_of_tests'])
            if(isset($_POST['close_order'])) { 
				$data['close_order']  			=   $_POST['close_order'];//TRUE;
			} else {
				$data['close_order']  			=   "FALSE";				
			}
        } else {
            // First time form is displayed
            $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
            $data['patient_id']         =   $seg4; //$this->uri->segment(4);
            $data['summary_id']         =   $seg5; //$this->uri->segment(5);
            $data['lab_order_id']       =   $seg6; //$this->uri->segment(6);
            $patient_id             =   $data['patient_id'];
            //$data['patient_id']     =   $patient_id;
            if ($data['form_purpose'] == "new_labresults") {
                //echo "new_lab";
                $data['lab_package_id'] =   "none";
                $data['supplier_id']    =   "none";
                $data['sample_date']    =   $data['now_date'];
                $data['sample_time']    =   $data['now_time'];
                $data['fasting']        =   "";
                $data['urgency']        =   "";
                $data['sample_ref']     =   "";
                $data['summary_result'] =   "Pending";
                $data['remarks']        =   "";
                $data['lab_order_id']   = "new_lab";
				$data['package_info'][0]['sample_required'] = "N/A";
                $data['result_ref']        =   "";
                $data['num_of_tests']       =   0;
            } elseif ($data['form_purpose'] == "edit_labresults") {
                //echo "Edit diagnosis";
                $data['order_info'] = $this->memr_rdb->get_patcon_lab($data['summary_id'],$data['lab_order_id']);
                $data['lab_package_id'] =   $data['order_info'][0]['lab_package_id'];
                $data['package_name']   =   $data['order_info'][0]['package_name'];
                $data['supplier_id']    =   $data['order_info'][0]['supplier_id'];
                $data['supplier_name']  =   $data['order_info'][0]['supplier_name'];
                $data['sample_required']=   $data['order_info'][0]['sample_required'];
                $data['sample_date']    =   $data['order_info'][0]['sample_date'];
                $data['sample_time']    =   $data['order_info'][0]['sample_time'];
                $data['fasting']        =   $data['order_info'][0]['fasting'];
                $data['urgency']        =   $data['order_info'][0]['urgency'];
                $data['sample_ref']     =   $data['order_info'][0]['sample_ref'];
                $data['summary_result'] =   $data['order_info'][0]['summary_result'];
                $data['remarks']        =   $data['order_info'][0]['remarks'];
                $data['result_reviewed_by'] =   $data['order_info'][0]['result_reviewed_by'];
                $data['result_date']    =   $data['order_info'][0]['result_date'];
                $data['result_ref']     =   $data['order_info'][0]['result_ref'];
				$data['package_info']  = $this->memr_rdb->get_one_lab_results($data['lab_order_id']);
				$data['num_of_tests']   = count($data['package_info']);
				if($data['fasting'] == 1){
					$data['fasting'] 	=	"Yes";
				} else {
					$data['fasting'] 	=	"No";
				}
				if($data['urgency'] == 1){
					$data['urgency'] 	=	"Yes";
				} else {
					$data['urgency'] 	=	"No";
				}
            } //endif ($data['form_purpose'] == "new_lab")
        } //endif(count($_POST))
		$data['title'] = "Edit Lab Results";
		$data['patient_info']   = $this->memr_rdb->get_patient_demo($data['patient_id']);
        $data['patcon_info']    = $this->memr_rdb->get_patcon_details($data['patient_id'],$data['summary_id']);
        //$data['lab_list']       = $this->memr_rdb->get_patcon_lab($data['summary_id']);
        $data['init_location_id']   =   $this->session->userdata('location_id');
        $data['init_clinic_name']   =   NULL;
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        //$data['init_patient_id']    =   $patient_id;

        //$data['packages_list']= $this->morders_lab_rdb->get_lab_packages_list();
		//$data['package_info']  = $this->morders_lab_rdb->get_one_lab_package($data['lab_package_id']);

		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_lab_result') == FALSE){
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_ovrvw_wap";
                $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
                //$new_body   =   "ehr/ehr_orders_edit_labresults_wap";
                $new_body   =   "ehr_indv_edit_labresults_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_ovrvw_html";
                $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
                $new_body   =   "ehr_indv_edit_labresults_html";
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
            // Existing lab order record
            $upd_lab_array['lab_order_id']    = $data['lab_order_id'];
            $upd_lab_array['summary_result']  = $data['summary_result'];
            $upd_lab_array['result_status']   = "Received";
            if($data['close_order'] == "TRUE") {
                //echo "Change status ".$data['close_order'];
                $upd_lab_array['result_status']  	    = "Received"; // To consider to use "Reviewed"
                $upd_lab_array['result_reviewed_by']  	= $this->session->userdata('staff_id');
                $upd_lab_array['result_reviewed_date']  = $data['now_date'];
            }
            $upd_lab_array['invoice_status']    = "Unknown";
            $upd_lab_array['recorded_timestamp']   = $data['now_id'];
            $upd_lab_array['reply_method']      = "THIRRA";
            //$ins_lab_array['invoice_detail_id']= $data['invoice_detail_id']; //N/A
            $upd_lab_array['result_date']       = $data['result_date'];
            $upd_lab_array['result_ref']        = $data['result_ref'];
            $upd_lab_data  =   $this->morders_wdb->update_lab_order($upd_lab_array);
            if($data['num_of_tests'] > 0){
                for($j=1; $j <= $data['num_of_tests']; $j++){
                    $varname_result =   "test_result_".$j;
                    $varname_normal =   "test_normal_".$j;
                    $varname_remark =   "test_remark_".$j;
                    $upd_test_array['lab_result_id']	=	$data['package_info'][$j-1]['lab_result_id'];
                    $upd_test_array['lab_order_id']		=	$upd_lab_array['lab_order_id'];
                    //$upd_test_array['sort_test']		=	$data['package_info'][$j-1]['sort_test'];
                    //$upd_test_array['lab_package_test_id']	=	$data['lab_package_id'];
                    $upd_test_array['result_date']		=	$data['result_date'];
                    $upd_test_array['date_recorded']	=	$data['now_date'];
                    $upd_test_array['result']		    =	$data['package_info'][$j-1][$varname_result];
                    //$upd_test_array['loinc_num']		=	$data['package_info'][$j-1]['loinc_num'];
                    $upd_test_array['normal_reading']	=	$data['package_info'][$j-1][$varname_normal];
                    $upd_test_array['staff_id']	        =	$this->session->userdata('staff_id');
                    $upd_test_array['result_remarks']	=	$data['package_info'][$j-1][$varname_remark];
                    //$ins_test_array['abnormal_flag']		=	$data['package_info'][$j-1]['abnormal_flag'];
                    if($data['offline_mode']){
                        $upd_test_array['synch_out']    = $data['now_id'];
                    }//endif($data['offline_mode'])
                    $upd_test_data  =   $this->morders_wdb->update_lab_result($upd_test_array);
                    $data['now_id']++;
                }
                $this->session->set_flashdata('data_activity', 'Lab result updated.');
            }//endif($data['num_of_tests'] > 0)
            $new_page = base_url()."index.php/indv/indv/index/indv_history/ehr_individual_history/list_history_lab/list_orders/".$data['patient_id'];
            header("Status: 200");
            header("Location: ".$new_page);

        } // endif ($this->form_validation->run('edit_lab_order') == FALSE)


    } // end of function edit_labresults()


    // ------------------------------------------------------------------------
    function list_history_imaging($seg3,$seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['patient_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
        $data['patient_info']['name']   = $data['patient_info']['patient_name'];
 		$data['title'] = "PR-".$data['patient_info']['name'];
        $data['imaging_list']   = $this->mindiv_rdb->get_recent_imaging($data['patient_id']);
		$this->load->vars($data);
        if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_ovrvw_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
            //$new_body   =   "ehr/ehr_indv_list_history_vitals_wap";
            $new_body   =   "ehr_indv_list_history_imaging_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_ovrvw_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
            $new_body   =   "ehr_indv_list_history_imaging_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);		
		
    } // end of function list_history_imaging()


    // ------------------------------------------------------------------------
    function edit_imagresult($seg3,$seg4,$seg5) 
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$this->load->model('morders_wdb');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['order_id']           =   $seg5; //$this->uri->segment(6);
        $data['location_id']    	=   $this->session->userdata('location_id');
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
			$data['result_remarks']  			=   $data['order_info'][0]['result_remarks'];
			$data['result_ref']  			=   $data['order_info'][0]['result_ref'];
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
        
		$data['patient_id']     = $data['order_info'][0]['patient_id'];
        $data['patient_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
        $data['patient_info']['name']   = $data['patient_info']['patient_name'];
		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_imag_result') == FALSE){
            // Return to incomplete form
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_ehr_ovrvw_wap";
                $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
                //$new_body   =   "ehr/ehr_orders_edit_imagresult_wap";
                $new_body   =   "ehr_indv_edit_imagresults_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_ovrvw_html";
                $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
                $new_body   =   "ehr_indv_edit_imagresults_html";
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
			$upd_result_array['result_ref']     = $data['init_result_ref'];
			$upd_result_array['notes']  		= $data['init_notes'];
            if($data['offline_mode']){
                $upd_result_array['synch_out']        = $data['now_id'];
            }
			$upd_result_data =   $this->morders_wdb->update_imaging_result($upd_result_array);
                $this->session->set_flashdata("data_activity", "Results updated.");
            $new_page = base_url()."index.php/indv/indv/index/indv_history/ehr_individual_history/list_history_imaging/list_orders/".$data['patient_id'];
            header("Status: 200");
            header("Location: ".$new_page);
        } //endif ($this->form_validation->run('edit_imag_result') == FALSE)
    } // end of function orders_edit_imagresult($result_id)


    // ------------------------------------------------------------------------
    function list_history_social($seg3,$seg4)
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['patient_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
        $data['patient_info']['name']   = $data['patient_info']['patient_name'];
 		$data['title'] = "PR-".$data['patient_info']['name'];
		$data['history_list']  = $this->mindiv_rdb->get_history_social('List',$data['patient_id']);
		$this->load->vars($data);
        if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_ehr_ovrvw_wap";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
            $new_body   =   "ehr_indv_list_history_social_html";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_ehr_ovrvw_html";
            $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
            $new_body   =   "ehr_indv_list_history_social_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		//$this->load->view($new_header);			
		//$this->load->view($new_banner);			
		//$this->load->view($new_sidebar);			
		$this->load->view($new_body);			
		//$this->load->view($new_footer);		
		
    } // end of function list_history_social()


    // ------------------------------------------------------------------------
    function edit_history_social($seg3,$seg4,$seg5) 
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['user_rights']        =   $this->mthirra->get_user_rights($this->session->userdata('username'));
        $data['form_purpose']       =   $seg3; //$this->uri->segment(3);
        $data['patient_id']         =   $seg4; //$this->uri->segment(4);
        $data['social_history_id']      =   $seg5; //$this->uri->segment(6);
        $data['location_id']        =   $this->session->userdata('location_id');
        $data['patient_info'] = $this->memr_rdb->get_patient_details($data['patient_id']);
 		$data['title'] = "PR-".$data['patient_info']['name'];
        $data['now_id']             =   time();
        $data['now_date']           =   date("Y-m-d",$data['now_id']);
        $data['now_time']           =   date("H:i",$data['now_id']);
		$data['history_list']  = $this->mindiv_rdb->get_history_social('List',$data['patient_id']);
        
        if(count($_POST)) {
            // User has posted the form
            //$data['social_history_id']            =   $_POST['social_history_id'];
            if(isset($_POST['record_date'])){
                $data['init_record_date']       =   $_POST['record_date'];
            }
            $data['init_safety_belt_use']   =   $_POST['safety_belt_use'];
            $data['init_helmet_use']        =   $_POST['helmet_use'];
            if(isset($_POST['drugs_use'])){
                $data['init_drugs_use']         =   $_POST['drugs_use'];
            } else {
                $data['init_drugs_use']         =   NULL;
            }
            //$data['init_drugs_use']         =   $_POST['drugs_use'];
            if(isset($_POST['drugs_spec'])){
                $data['init_drugs_spec']         =   $_POST['drugs_spec'];
            } else {
                $data['init_drugs_spec']         =   NULL;
            }
            //$data['init_drugs_spec']        =   $_POST['drugs_spec'];
            $data['init_alcohol_use']       =   $_POST['alcohol_use'];
            if(isset($_POST['alcohol_spec'])){
                $data['init_alcohol_spec']         =   $_POST['alcohol_spec'];
            } else {
                $data['init_alcohol_spec']         =   NULL;
            }
            //$data['init_alcohol_spec']      =   $_POST['alcohol_spec'];
            $data['init_tobacco_use']       =   $_POST['tobacco_use'];
            if(isset($_POST['tobacco_spec'])){
                $data['init_tobacco_spec']         =   $_POST['tobacco_spec'];
            } else {
                $data['init_tobacco_spec']         =   NULL;
            }
            //$data['init_tobacco_spec']      =   $_POST['tobacco_spec'];
            $data['init_exercise_use']      =   $_POST['exercise_use'];
            if(isset($_POST['exercise_spec'])){
                $data['init_exercise_spec']         =   $_POST['exercise_spec'];
            } else {
                $data['init_exercise_spec']         =   NULL;
            }
            //$data['init_exercise_spec']     =   $_POST['exercise_spec'];
            $data['init_trauma']            =   $_POST['trauma'];
            $data['init_hospitalizations']  =   $_POST['hospitalizations'];
            $data['init_illness']           =   $_POST['illness'];
            $data['init_operation']         =   $_POST['operation'];
            $data['init_family_income']     =   $_POST['family_income'];
            $data['init_remarks']           =   $_POST['remarks'];
        } else {
            // First time form is displayed
            if ($data['form_purpose'] == "new_history") {
                // New user
		        $data['room_info']          =  array();
                $data['room_id']            =   "";
                $data['category_id']        =   "";
                $data['init_record_date']          =   $data['now_date'];
                $data['init_safety_belt_use']=   "";
                $data['init_helmet_use']    =   "";
                $data['init_drugs_use']     =   "";
                $data['init_drugs_spec']    =   "";
                $data['init_alcohol_use']   =   "";
                $data['init_alcohol_spec']  =   "";
                $data['init_tobacco_use']   =   "";
                $data['init_tobacco_spec']  =   "";
                $data['init_exercise_use']  =   "";
                $data['init_exercise_spec'] =   "";
                $data['init_trauma']        =   "";
                $data['init_hospitalizations'] =   "";
                $data['init_illness']       =   "";
                $data['init_operation']     =   "";
                $data['init_family_income'] =   "";
                $data['init_remarks']       =   "";
            } else {
                // Existing user
		        $data['history_info'] =  $this->mindiv_rdb->get_history_social('one',$data['patient_id'],$data['social_history_id']);
                $data['init_record_date']          =   $data['history_info'][0]['date'];
                $data['init_safety_belt_use'] =   $data['history_info'][0]['safety_belt_use'];
                $data['init_helmet_use']    =   $data['history_info'][0]['helmet_use'];
                $data['init_drugs_use']     =   $data['history_info'][0]['drugs_use'];
                $data['init_drugs_spec']    =   $data['history_info'][0]['drugs_spec'];
                $data['init_alcohol_use']   =   $data['history_info'][0]['alcohol_use'];
                $data['init_alcohol_spec']  =   $data['history_info'][0]['alcohol_spec'];
                $data['init_tobacco_use']   =   $data['history_info'][0]['tobacco_use'];
                $data['init_tobacco_spec']  =   $data['history_info'][0]['tobacco_spec'];
                $data['init_exercise_use']  =   $data['history_info'][0]['exercise_use'];
                $data['init_exercise_spec'] =   $data['history_info'][0]['exercise_spec'];
                $data['init_trauma']        =   $data['history_info'][0]['trauma'];
                $data['init_hospitalizations']   =   $data['history_info'][0]['hospitalizations'];
                $data['init_illness']       =   $data['history_info'][0]['illness'];
                $data['init_operation']     =   $data['history_info'][0]['operation'];
                $data['init_family_income'] =   $data['history_info'][0]['family_income'];
                $data['init_remarks']       =   $data['history_info'][0]['remarks'];
           } //endif ($data['form_purpose'] == "new_room")
        } //endif(count($_POST))
        
		$this->load->vars($data);
        // Run validation
		if ($this->form_validation->run('edit_history_social') == FALSE){
            // Return to incomplete form
            if ($this->session->userdata('thirra_mode') == "ehr_mobile"){
                $new_header =   "ehr/header_xhtml-mobile10";
                $new_banner =   "ehr/banner_emr_wap";
                $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_wap";
                $new_body   =   "ehr_indv_edit_history_social_html";
                $new_footer =   "ehr/footer_emr_wap";
            } else {
                //$new_header =   "ehr/header_xhtml1-strict";
                $new_header =   "ehr/header_xhtml1-transitional";
                $new_banner =   "ehr/banner_ehr_ovrvw_html";
                $new_sidebar=   "ehr/sidebar_ehr_patients_ovrvw_html";
                $new_body   =   "ehr_indv_edit_history_social_html";
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
            if($data['form_purpose'] == "new_history") {
                // Insert records
                $ins_social_array['social_history_id']      = $data['now_id'];
                $ins_social_array['patient_id']    = $data['patient_id'];
                $ins_social_array['staff_id']    = $this->session->userdata('staff_id');
                $ins_social_array['record_date']    = $data['init_record_date'];
                $ins_social_array['safety_belt_use']    = $data['init_safety_belt_use'];
                $ins_social_array['helmet_use']    = $data['init_helmet_use'];
                $ins_social_array['drugs_use']    = $data['init_drugs_use'];
                $ins_social_array['drugs_spec']    = $data['init_drugs_spec'];
                $ins_social_array['alcohol_use']    = $data['init_alcohol_use'];
                $ins_social_array['alcohol_spec']    = $data['init_alcohol_spec'];
                $ins_social_array['tobacco_use']    = $data['init_tobacco_use'];
                $ins_social_array['tobacco_spec']    = $data['init_tobacco_spec'];
                $ins_social_array['exercise_use']    = $data['init_exercise_use'];
                $ins_social_array['exercise_spec']    = $data['init_exercise_spec'];
                $ins_social_array['trauma']    = $data['init_trauma'];
                $ins_social_array['hospitalizations']    = $data['init_hospitalizations'];
                $ins_social_array['illness']    = $data['init_illness'];
                $ins_social_array['operation']    = $data['init_operation'];
                $ins_social_array['family_income']    = $data['init_family_income'];
                $ins_social_array['remarks']    = $data['init_remarks'];
                if($data['offline_mode']){
                    $ins_followup_array['synch_out']  = $data['now_id'];
                }
                $ins_social_data =   $this->mehr_wdb->insert_new_social_history($ins_social_array);
                $this->session->set_flashdata('data_activity', 'Social history added.');
            } else {
                // Update records
                $upd_social_array['social_history_id']      = $data['social_history_id'];
                $upd_social_array['safety_belt_use']  = $data['init_safety_belt_use'];
                $upd_social_array['helmet_use']  = $data['init_helmet_use'];
                $upd_social_array['drugs_use']  = $data['init_drugs_use'];
                $upd_social_array['drugs_spec']  = $data['init_drugs_spec'];
                $upd_social_array['alcohol_use']  = $data['init_alcohol_use'];
                $upd_social_array['alcohol_spec']  = $data['init_alcohol_spec'];
                $upd_social_array['tobacco_use']  = $data['init_tobacco_use'];
                $upd_social_array['tobacco_spec']  = $data['init_tobacco_spec'];
                $upd_social_array['exercise_use']  = $data['init_exercise_use'];
                $upd_social_array['exercise_spec']  = $data['init_exercise_spec'];
                $upd_social_array['trauma']  = $data['init_trauma'];
                $upd_social_array['hospitalizations']  = $data['init_hospitalizations'];
                $upd_social_array['illness']  = $data['init_illness'];
                $upd_social_array['operation']  = $data['init_operation'];
                $upd_social_array['family_income']  = $data['init_family_income'];
                $upd_social_array['remarks']  = $data['init_remarks'];
                $upd_social_data =   $this->mehr_wdb->update_social_history($upd_social_array);
                $this->session->set_flashdata('data_activity', 'Social history updated.');
            } //endif($data['form_purpose'] == "new_history")

            $new_page = base_url()."index.php/indv/indv/index/indv_history/ehr_individual_history/list_history_social/list_socials/".$data['patient_id'];
            header("Status: 200");
            header("Location: ".$new_page);
        } //endif ($this->form_validation->run('edit_history') == FALSE)
    } // end of function edit_history_social($id)



}

/* End of file ehr_individual_history.php */
/* Location: ./app_thirra/controllers/ehr_individual_history.php */
