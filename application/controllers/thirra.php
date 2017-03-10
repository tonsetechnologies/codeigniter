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
 * Controller Class for THIRRA
 *
 * This class is used for both narrowband and broadband THIRRA. 
 *
 * @version 0.9.14
 * @package THIRRA
 * @author  Jason Tan Boon Teck
 */
class Thirra extends MY_Controller 
{
    protected $_offline_mode    =  FALSE;
    protected $_debug_mode      =  FALSE;

    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        $this->load->helper('form');
        //$this->load->scaffolding('patient_demographic_info');
		$this->load->model('mthirra');
		$this->load->model('memr_rdb');
	  	//$this->load->model('mpatients');
        header('Content-type: application/xhtml+xml'); 
        $this->pretend_phone	=	FALSE;
        //$this->pretend_phone	=	TRUE;  // Turn this On to overwrites actual device
    }


    //************************************************************************
    /**
     *  Login page
     *
     * @author  Jason Tan Boon Teck
     **/
	function index() // Default page
    {	
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
        $data['country']		    =	$this->config->item('app_country');
        $data['app_name']		    =	$this->config->item('app_name');
		$this->load->model('mthirra');

        //---------------- Check user agent
        $this->load->library('user_agent');

        if ($this->agent->is_browser()){
            $data['agent'] = $this->agent->browser().' '.$this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $data['agent'] = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $data['agent'] = $this->agent->mobile();
        } else {
            $data['agent'] = 'Unidentified User Agent';
        }

	    if ("Unknown Platform" == $this->agent->platform()){
	        $device_mode = "wap";
		    $data['device_mode'] = "WAP";
	    } else {
			if ($this->pretend_phone == TRUE) {
			    $device_mode = "wap";
			    $data['device_mode'] = "WAP"; 
			} else {
		        $device_mode = "html";
			    $data['device_mode'] = "HTML";
			}
	    }			

        //----------------
		/*
        $filename="/var/www/thirra/app_thirra/version.txt";
        //echo "filename=".$filename;
        // read from file
        if(!file_exists($filename))
        //if(!file_exists("name.txt"))
        {
	        echo "File not found!\n";
        } else {
            //$fhr = fopen("name.txt","r");
            $fhr = fopen($filename,"r");
            $line = fgets($fhr);
            //echo $line;
            $data['appversion'] =   $line;
            fclose($fhr);
        }
        */
		// CHANGE COUNTRY SETTING
		// Now moved to config.php
        //$data['country']    =   "ALL";
        //$data['country']    =   "Malaysia";
        //$data['country']    =   "Nepal";
        //$data['country']    =   "Sri Lanka";
		$data['clinics_list'] = $this->mthirra->get_clinics_list($data['country'],'sort_clinic',$data['offline_mode']);
		$data['title'] = "T H I R R A - Login";
		$data['main'] = 'home';
        if(isset($flash_message)){
            $data['flash_message']   = $flash_message;  
        } else {
            $data['flash_message']   = " ";              
        }
		$this->load->vars($data);
		if ($device_mode == "wap"){
			$this->load->view('index_wap');			
		} else {
			$this->load->view('index_html');			
		}
		//$this->load->view('template');
        pg_close();
	} //end function index()


    //************************************************************************
    /**
     *  Process login info and redirect to correct dashboards.
     *
     *  Redirects to the correct section based on login selection.
     *
     * @author  Jason Tan Boon Teck
     **/
	function main() // Default page
    {	
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		//$this->load->model('mpatients');
        //---------------- Check user agent
        $this->load->library('user_agent');

        //$_SESSION['thirra_mode']    = $this->input->post('thirra_mode');
        //$_SESSION['location_id']    = $this->input->post('location_id');
        //$_SESSION['username']       = trim($this->input->post('username'));
        $this->session->set_userdata('thirra_mode', $this->input->post('thirra_mode'));
        $this->session->set_userdata('location_id', $this->input->post('location_id'));
        $username                   = trim($this->input->post('username'));
        $password                   = trim($this->input->post('password'));
        $location_id                =   $this->input->post('location_id');
        // Perform authentication and set user_acl
		$data['clinic_info'] = $this->mthirra->get_clinic_info($this->session->userdata('location_id'));
        //$_SESSION['clinic_shortname'] = $data['clinic_info']['clinic_shortname'];
        $data['user_info']['username']   =   "";
        $data['user_info']['password']   =   "";
		$data['user_info'] = $this->mthirra->get_one_user_clinic($username,$location_id); // Assume only one clinic
		//$data['user_info'] = $this->mthirra->get_user_info($username,$password); // Deprecated No restriction to clinics
        if(isset($data['user_info'])){
            //echo "user_info][password=".$data['user_info']['password'];
            if ($data['user_info']['password'] === crypt($password,$data['user_info']['password'])) {
                $this->session->set_userdata('user_acl', 10);
                $this->session->set_userdata('staff_id', $data['user_info']['staff_id']);
                //$_SESSION['staff_id']       = $data['user_info']['staff_id'];
                //echo "AUTHENTICATED";
				$data['now_id']             =   time();
				$data['now_date']           =   date("Y-m-d",$data['now_id']);
				$data['now_time']           =   date("H:i:s",$data['now_id']);
				//Log log in
                $ins_login_array   =   array();
                $ins_login_array['log_id']      = $data['now_id'];
                $ins_login_array['user_id']     = $data['user_info']['user_id'];
                $ins_login_array['now_id']      = $data['now_id'];
                $ins_login_array['date']    	= $data['now_date'];
                $ins_login_array['login_time']  = $data['now_time'];
                $ins_login_array['logout_time'] = $ins_login_array['login_time'];
                $ins_login_array['login_ip']  	= $this->input->ip_address();
                $ins_login_array['login_location']= $this->session->userdata('location_id');//$_SESSION['location_id'];
                $ins_login_array['webbrowser']  = $this->agent->browser().' '.$this->agent->version();
                $ins_login_array['log_outcome']  = "In";
                if($data['offline_mode']){
                    $ins_login_array['synch_out']      = $data['now_id'];
                }
	            $ins_login_data       =   $this->mthirra->insert_new_login($ins_login_array);
            } else {
                $this->session->set_userdata('user_acl', 0);
                $this->session->set_flashdata('data_activity', 'Incorrect username, password or clinic.');
            }
        } else {
                $this->session->set_flashdata('data_activity', 'Incorrect username, password or clinic.');
        } //endif(isset($data['user_info']))
        $this->session->set_userdata('thirra_mode', $this->input->post('thirra_mode'));
        $this->session->set_userdata('username', $this->input->post('username'));
        $this->session->set_userdata('clinic_shortname', $data['clinic_info']['clinic_shortname']);


        //---------------- Check user agent
        $this->load->library('user_agent');
        if ($this->agent->is_browser()){
            $data['agent'] = $this->agent->browser().' '.$this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $data['agent'] = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $data['agent'] = $this->agent->mobile();
        } else {
            $data['agent'] = 'Unidentified User Agent';
        } //endif ($this->agent->is_browser())

	    if ("Unknown Platform" == $this->agent->platform()){
	        $device_mode = "wap";
		    $data['device_mode'] = "WAP";
	    } else {
			if ($this->pretend_phone == TRUE) {
			    $device_mode = "wap";
			    $data['device_mode'] = "WAP"; 
			} else {
		        $device_mode = "html";
			    $data['device_mode'] = "HTML";
			}
	    } //endif ("Unknown Platform" == $this->agent->platform())

        //----------------
		$data['title'] = "T H I R R A - Main Page";
		$data['main'] = 'home';
		$this->load->vars($data);
        // Redirect user to main page based on devices and application chosen
        switch ($this->session->userdata('thirra_mode')){
            case "bio_mobile":
			    $data['device_mode'] = "WAP"; 
                $new_page   =   base_url()."index.php/bio_phi";
                break;			
            case "bio_broad":
			    $data['device_mode'] = "HTML";
                $new_page   =   base_url()."index.php/bio_phi";
                break;			
            case "bio_hospital":
			    $data['device_mode'] = "HTML";
                $new_page   =   base_url()."index.php/bio_hospital";
                break;			
            case "bio_dept":
			    $data['device_mode'] = "HTML";
                $new_page   =   base_url()."index.php/bio";
                break;			
            case "ehr_mobile":
			    $data['device_mode'] = "WAP"; 
                $new_page   =   base_url()."index.php/ehr_dashboard";
                break;			
            case "ehr_broad":
			    $data['device_mode'] = "HTML";
                //$new_page   =   base_url()."index.php/ehr_dashboard";
                $new_page   =   base_url()."index.php/ehr/ehr/index/ehr_dashboard/ehr_dashboard/index";
                break;			
            case "ehr_dept":
			    $data['device_mode'] = "HTML";
                $new_page   =   base_url()."index.php/ehr_dashboard";
                break;			
            case "admin_broad":
			    $data['device_mode'] = "HTML";
                $new_page   =   base_url()."index.php/admin";
                break;			
            case "mh_mobile":
			    $data['device_mode'] = "WAP"; 
                $new_page   =   base_url()."index.php/mh";
                break;			
            case "mh_broad":
			    $data['device_mode'] = "HTML";
                $new_page   =   base_url()."index.php/mh";
                break;			
        } //end switch ($_SESSION['thirra_mode'])
        $this->session->set_userdata('device_mode',$data['device_mode']);
        header("Status: 200");
        header("Location: ".$new_page);
	} //end of function main()


    //************************************************************************
    // ------------------------------------------------------------------------
    function logout($id=NULL)  // 
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
	  	//$this->load->model('mpatients');
        pg_close();
        $this->session->sess_destroy();
        $new_page   =   base_url()."index.php";
        header("Status: 200");
        header("Location: ".$new_page);
		//$this->load->view('new_view');
    } // end of function new_method($id)


    // ------------------------------------------------------------------------
    function new_method($id=NULL)  // template for new classes
    {
        $data['offline_mode']		=	$this->config->item('offline_mode');
        $data['debug_mode']		    =	$this->config->item('debug_mode');
		$data['title'] = "T H I R R A - NewPage";
		$this->load->vars($data);
		if ($_SESSION['thirra_mode'] == "emr_mobile"){
            $new_header =   "ehr/header_xhtml-mobile10";
            $new_banner =   "ehr/banner_emr_wap";
            $new_body   =   "ehr/emr_newpage_wap";
            $new_footer =   "ehr/footer_emr_wap";
		} else {
            //$new_header =   "ehr/header_xhtml1-strict";
            $new_header =   "ehr/header_xhtml1-transitional";
            $new_banner =   "ehr/banner_emr_html";
            $new_body   =   "ehr/emr_newpage_html";
            $new_footer =   "ehr/footer_emr_html";
		}
		$this->load->view($new_header);			
		$this->load->view($new_banner);			
		$this->load->view($new_body);			
		$this->load->view($new_footer);			
    } // end of function new_method($id)


}
