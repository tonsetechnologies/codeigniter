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
 * Portions created by the Initial Developer are Copyright (C) 2010-2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for EHR
 *
 * This class is for models that only writes to the database.
 *
 * @version 0.9.14
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MAdmin_wdb extends CI_Model
{
    protected $_location_id     =  "";
    protected $_patient_id      =  "";
    protected $_summary_id      =  "";
    protected $_complaint_id    =  "";
    protected $_lab_order_id    =  "";
    protected $_diagnosis_id    =  "";
    protected $_referral_id     =  "";
    protected $_queue_id        =  "";
    protected $_notification_id =  "";
    protected $_bio_case_id     =  "";
    protected $_bio_inv_id      =  "";
    protected $_user_ip         =  "";

    function __construct()
    {
        parent::__construct();
    }


    //===============================================================
    // Insert Database Methods
    //************************************************************************
    /**
     * Method to add new system users
     *
     * This method adds a new user to the system. It inserts row into 
     * staff_info, staff_contact, staff_education, staff_work and system_user.
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_systemuser($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Adding new patient details";
        echo "<pre>";
            print_r($data_array);
        echo "</pre>";
  place_of_birth character varying(50),
  marital_status character varying(20),
  spouse_name character varying(100),
  no_of_children character varying(2),
  language_spoken character varying(50),
  language_written character varying(50),
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Begin transaction
        $this->db->trans_begin();
        
        // Insert row into staff_info
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);} // Not NULL
        if(isset($data_array['staff_category_id'])){$this->db->set('staff_category_id', $data_array['staff_category_id']);}
        if(isset($data_array['staff_name'])){$this->db->set('staff_name', $data_array['staff_name']);}
        if(isset($data_array['staff_initials'])){$this->db->set('staff_initials', $data_array['staff_initials']);}
        if(isset($data_array['mmc_no'])){$this->db->set('mmc_no', $data_array['mmc_no']);}
        if(isset($data_array['specialty'])){$this->db->set('specialty', $data_array['specialty']);}
        if(isset($data_array['gender'])){$this->db->set('gender', $data_array['gender']);}
        if(isset($data_array['ic_no'])){$this->db->set('ic_no', $data_array['ic_no']);}
        if(isset($data_array['ic_other_type'])){$this->db->set('ic_other_type', $data_array['ic_other_type']);}
        if(isset($data_array['ic_other_no'])){$this->db->set('ic_other_no', $data_array['ic_other_no']);}
        if(isset($data_array['nationality'])){$this->db->set('nationality', $data_array['nationality']);}
        if(isset($data_array['date_of_birth'])){$this->db->set('date_of_birth', $data_array['date_of_birth']);}
        if(isset($data_array['race'])){$this->db->set('race', $data_array['race']);}
        if(isset($data_array['staff_contact_id'])){$this->db->set('staff_contact_id', $data_array['staff_contact_id']);}
        if(isset($data_array['staff_work_id'])){$this->db->set('staff_work_id', $data_array['staff_work_id']);}
        // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('staff_info');
        //echo $this->db->last_query();
        //echo "<br />Inserted into staff_info";
        
        // Insert row into staff_contact
        /*
  tel_office character varying(20),
  pager_no character varying(30),
  fax_no character varying(20),
  remarks character varying(255), -- Added on Nov 18, 07
  im_handle character varying(255), -- Added on Nov 18, 07
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['staff_contact_id'])){$this->db->set('staff_contact_id', $data_array['staff_contact_id']);}
        if(isset($data_array['address'])){$this->db->set('address', $data_array['address']);}
        if(isset($data_array['address2'])){$this->db->set('address2', $data_array['address2']);}
        if(isset($data_array['address3'])){$this->db->set('address3', $data_array['address3']);}
        if(isset($data_array['town'])){$this->db->set('town', $data_array['town']);}
        if(isset($data_array['state'])){$this->db->set('state', $data_array['state']);}
        if(isset($data_array['postcode'])){$this->db->set('postcode', $data_array['postcode']);}
        if(isset($data_array['country'])){$this->db->set('country', $data_array['country']);}
        if(isset($data_array['tel_home'])){$this->db->set('tel_home', $data_array['tel_home']);}
        if(isset($data_array['tel_mobile'])){$this->db->set('tel_mobile', $data_array['tel_mobile']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('staff_contact');
        //echo $this->db->last_query();
        //echo "<br />Inserted into staff_contact";

        // Insert row into staff_education
        /*
  staff_education_id character(10) NOT NULL,
  staff_id character(10) NOT NULL,
  school_name character varying(100),
  from_year character(4),
  to_year character(4),
  highest_level character varying(20),
  grade character varying(10),
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert row into staff_work
        /*
  epf_no character varying(20),
  socso_no character varying(20),
  date_started date,
  date_stopped date,
  weekly_rest_day character(1),
  no_paid_holiday character varying(3),
  no_sick_day character varying(3),
  annual_leave character varying(3),
  overtime_rate numeric(10,2),
  overtime_hour character varying(2),
  other_allowance numeric(10,2),
  starting_salary numeric(10,2),
  present_salary numeric(10,2),
  last_login timestamp without time zone, -- Added on May 19, 2006
  income_tax_no character varying(20), -- Added on May 19, 2006
  cost_hour_std numeric(11,3), -- Added on Nov 18, 07
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Perform db insert
        if(isset($data_array['staff_work_id'])){$this->db->set('staff_work_id', $data_array['staff_work_id']);}
        if(isset($data_array['wage_type'])){$this->db->set('wage_type', $data_array['wage_type']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['home_clinic'])){$this->db->set('home_clinic', $data_array['home_clinic']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['clinic_dept_id'])){$this->db->set('clinic_dept_id', $data_array['clinic_dept_id']);}
        //echo $this->db->_compile_select();
        $this->db->insert('staff_work');
        //echo $this->db->last_query();
        //echo "<br />Inserted into system_user";

        // Insert row into system_user
        if(isset($data_array['user_id'])){$this->db->set('user_id', $data_array['user_id']);}
        if(isset($data_array['category_id'])){$this->db->set('category_id', $data_array['category_id']);}
        if(isset($data_array['username'])){$this->db->set('username', $data_array['username']);}
        if(isset($data_array['password'])){$this->db->set('password', $data_array['password']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['expiry_date'])){$this->db->set('expiry_date', $data_array['expiry_date']);}
        if(isset($data_array['access_status'])){$this->db->set('access_status', $data_array['access_status']);}
        if(isset($data_array['permission'])){$this->db->set('permission', $data_array['permission']);}
        // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('system_user');
        //echo $this->db->last_query();
        //echo "<br />Inserted into system_user";
        
        // Perform db insert
        $this->db->set('sysclinic_staff_id', $data_array['staff_id']);
        $this->db->set('clinic_info_id', $data_array['home_clinic']);
        $this->db->set('staff_id', $data_array['staff_id']);
        $this->db->set('user_id', $data_array['user_id']);
        $this->db->set('sysclinic_staff_active', 'TRUE');
        if(isset($data_array['sysclinic_staff_remarks'])){$this->db->set('sysclinic_staff_remarks', $data_array['sysclinic_staff_remarks']);}
        $this->db->set('added_remarks', 'Added during creation of new user');
        $this->db->set('added_staff', $data_array['clerk_id']);
        $this->db->set('added_time', time());
        //echo $this->db->_compile_select();
        $this->db->insert('system_clinic_staff');
        //echo $this->db->last_query();
        //echo "<br />Inserted into system_clinic_staff";

        // End transaction
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            echo "<br /><br />Some errors were found. User registration not completed.";
        } else {
            $this->db->trans_commit();
            //echo "<br /><br />No errors found. User registration completed.";
        }

    } // end of function insert_new_systemuser($data_array)


    //************************************************************************
    /**
     * Method to insert New staff category
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_staffcategory($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting room";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into staff_category
        if(isset($data_array['category_id'])){$this->db->set('category_id', $data_array['category_id']);}
        if(isset($data_array['category_name'])){$this->db->set('category_name', $data_array['category_name']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('staff_category');
        //echo $this->db->last_query();
        //echo "<br />Inserted into staff_category";
        
        // Insert into system_user_category
        if(isset($data_array['category_id'])){$this->db->set('category_id', $data_array['category_id']);}
        if(isset($data_array['category_name'])){$this->db->set('category_name', $data_array['category_name']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['permission'])){$this->db->set('permission', $data_array['permission']);}
        if(isset($data_array['can_consult'])){$this->db->set('description', $data_array['can_consult']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('system_user_category');
        //echo $this->db->last_query();
        //echo "<br />Inserted into system_user_category";
        
        // Insert into system_acl
        $acl_id =   $data_array['category_id'];
        foreach($data_array['acl_single'] as $acl_array){
            $this->insert_new_acl($acl_id,$acl_array,$data_array['category_id'],$data_array['added_staff']);
            //echo "<br />Inserted into system_acl";
            $acl_id++;
        }
        
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_staffcategory($data_array)


    //************************************************************************
    /**
     * Method to insert New staff ACL
     *
     * This method creates a new row, and is called by other methods in this model.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_acl($acl_id,$acl_array,$category_id,$added_staff)
    {
        // Insert into system_acl
        $this->db->set('acl_id', $acl_id);
        $this->db->set('syssection_id', $acl_array['syssection_id']);
        $this->db->set('category_id', $category_id);
        $syssection_id  =   $acl_array['syssection_id'];
        $this->db->set('rights_single', $acl_array['single_'.$syssection_id]);
        $this->db->set('rights_multi', $acl_array['multi_'.$syssection_id]);
        $this->db->set('acl_remarks', $acl_array['acl_remarks']);
        if(isset($acl_array['added_remarks'])){$this->db->set('added_remarks', $acl_array['added_remarks']);}
        $this->db->set('added_staff', $added_staff);
        $this->db->set('added_time', time());
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('system_acl');
        //echo $this->db->last_query();
        //echo "<br />Inserted into system_acl";
    }
    
    
    //************************************************************************
    /**
     * Method to insert New Clinic
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_clinic($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting clinic_info";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into clinic_info
        if(isset($data_array['clinic_info_id'])){$this->db->set('clinic_info_id', $data_array['clinic_info_id']);}
        if(isset($data_array['clinic_name'])){$this->db->set('clinic_name', $data_array['clinic_name']);}
        if(isset($data_array['clinic_ref_no'])){$this->db->set('clinic_ref_no', $data_array['clinic_ref_no']);}
        if(isset($data_array['clinic_shortname'])){$this->db->set('clinic_shortname', $data_array['clinic_shortname']);}
        if(isset($data_array['manager_id'])){$this->db->set('manager_id', $data_array['manager_id']);}
        if(isset($data_array['owner_id'])){$this->db->set('owner_id', $data_array['owner_id']);}
        if(isset($data_array['time_open'])){$this->db->set('time_open', $data_array['time_open']);}
        if(isset($data_array['time_close'])){$this->db->set('time_close', $data_array['time_close']);}
        if(isset($data_array['locale'])){$this->db->set('locale', $data_array['locale']);}
        if(isset($data_array['address'])){$this->db->set('address', $data_array['address']);}
        if(isset($data_array['address2'])){$this->db->set('address2', $data_array['address2']);}
        if(isset($data_array['address3'])){$this->db->set('address3', $data_array['address3']);}
        if(isset($data_array['town'])){$this->db->set('town', $data_array['town']);}
        if(isset($data_array['state'])){$this->db->set('state', $data_array['state']);}
        if(isset($data_array['postcode'])){$this->db->set('postcode', $data_array['postcode']);}
        if(isset($data_array['country'])){$this->db->set('country', $data_array['country']);}
        if(isset($data_array['tel_no'])){$this->db->set('tel_no', $data_array['tel_no']);}
        if(isset($data_array['tel_no2'])){$this->db->set('tel_no2', $data_array['tel_no2']);}
        if(isset($data_array['tel_no3'])){$this->db->set('tel_no3', $data_array['tel_no3']);}
        if(isset($data_array['fax_no'])){$this->db->set('fax_no', $data_array['fax_no']);}
        if(isset($data_array['fax_no2'])){$this->db->set('fax_no2', $data_array['fax_no2']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        if(isset($data_array['other'])){$this->db->set('other', $data_array['other']);}
        if(isset($data_array['established'])){$this->db->set('established', $data_array['established']);}
        if(isset($data_array['owner_type'])){$this->db->set('owner_type', $data_array['owner_type']);}
        if(isset($data_array['health_department_id'])){$this->db->set('health_department_id', $data_array['health_department_id']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['pcdom_ref'])){$this->db->set('pcdom_ref', $data_array['pcdom_ref']);}
        if(isset($data_array['markup_1'])){$this->db->set('markup_1', $data_array['markup_1']);}
        if(isset($data_array['markup_2'])){$this->db->set('markup_2', $data_array['markup_2']);}
        if(isset($data_array['markup_3'])){$this->db->set('markup_3', $data_array['markup_3']);}
        if(isset($data_array['sort_clinic'])){$this->db->set('sort_clinic', $data_array['sort_clinic']);}
        if(isset($data_array['clinic_privatekey'])){$this->db->set('clinic_privatekey', $data_array['clinic_privatekey']);}
        if(isset($data_array['clinic_publickey'])){$this->db->set('clinic_publickey', $data_array['clinic_publickey']);}
        if(isset($data_array['addr_village_id'])){$this->db->set('addr_village_id', $data_array['addr_village_id']);}
        if(isset($data_array['addr_town_id'])){$this->db->set('addr_town_id', $data_array['addr_town_id']);}
        if(isset($data_array['addr_area_id'])){$this->db->set('addr_area_id', $data_array['addr_area_id']);}
        if(isset($data_array['addr_district_id'])){$this->db->set('addr_district_id', $data_array['addr_district_id']);}
        if(isset($data_array['addr_state_id'])){$this->db->set('addr_state_id', $data_array['addr_state_id']);}
        if(isset($data_array['clinic_district_id'])){$this->db->set('clinic_district_id', $data_array['clinic_district_id']);}
        if(isset($data_array['clinic_status'])){$this->db->set('clinic_status', $data_array['clinic_status']);}
        if(isset($data_array['clinic_gps_lat'])){$this->db->set('clinic_gps_lat', $data_array['clinic_gps_lat']);}
        if(isset($data_array['clinic_gps_long'])){$this->db->set('clinic_gps_long', $data_array['clinic_gps_long']);}
        if(isset($data_array['clinic_type'])){$this->db->set('clinic_type', $data_array['clinic_type']);}
        // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('clinic_info');
        //echo $this->db->last_query();
        //echo "<br />Inserted into clinic_info";
        
        // Insert into clinic_dept
        if(isset($data_array['clinic_dept_id'])){$this->db->set('clinic_dept_id', $data_array['clinic_dept_id']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['dept_name'])){$this->db->set('dept_name', $data_array['dept_name']);}
        if(isset($data_array['dept_shortname'])){$this->db->set('dept_shortname', $data_array['dept_shortname']);}
        if(isset($data_array['tel_no'])){$this->db->set('dept_telno', $data_array['tel_no']);}
        // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('clinic_dept');
        //echo $this->db->last_query();
        //echo "<br />Inserted into clinic_dept";

        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_clinic($data_array)


    //************************************************************************
    /**
     * Method to insert New clinic_dept
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_clinic_dept($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting referral_center";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        // Insert into clinic_dept
        if(isset($data_array['clinic_dept_id'])){$this->db->set('clinic_dept_id', $data_array['clinic_dept_id']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['dept_name'])){$this->db->set('dept_name', $data_array['dept_name']);}
        if(isset($data_array['dept_shortname'])){$this->db->set('dept_shortname', $data_array['dept_shortname']);}
        if(isset($data_array['dept_code'])){$this->db->set('dept_code', $data_array['dept_code']);}
        if(isset($data_array['dept_description'])){$this->db->set('dept_description', $data_array['dept_description']);}
        if(isset($data_array['dept_head'])){$this->db->set('dept_head', $data_array['dept_head']);}
        if(isset($data_array['dept_telno'])){$this->db->set('dept_telno', $data_array['dept_telno']);}
        if(isset($data_array['dept_sort'])){$this->db->set('dept_sort', $data_array['dept_sort']);}
        if(isset($data_array['dept_remarks'])){$this->db->set('dept_remarks', $data_array['dept_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('clinic_dept');
        //echo $this->db->last_query();
        //echo "<br />Inserted into clinic_dept";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_clinic_dept($data_array)


    //************************************************************************
    /**
     * Method to insert New Referral Centre
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_referral_centre($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting referral_center";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        // Insert into referral_center
        if(isset($data_array['referral_center_id'])){$this->db->set('referral_center_id', $data_array['referral_center_id']);}
        if(isset($data_array['centre_name'])){$this->db->set('name', $data_array['centre_name']);}
        if(isset($data_array['centre_type'])){$this->db->set('centre_type', $data_array['centre_type']);}
        if(isset($data_array['address'])){$this->db->set('address', $data_array['address']);}
        if(isset($data_array['address2'])){$this->db->set('address2', $data_array['address2']);}
        if(isset($data_array['address3'])){$this->db->set('address3', $data_array['address3']);}
        if(isset($data_array['town'])){$this->db->set('town', $data_array['town']);}
        if(isset($data_array['state'])){$this->db->set('state', $data_array['state']);}
        if(isset($data_array['postcode'])){$this->db->set('postcode', $data_array['postcode']);}
        if(isset($data_array['country'])){$this->db->set('country', $data_array['country']);}
        if(isset($data_array['tel_no'])){$this->db->set('tel_no', $data_array['tel_no']);}
        if(isset($data_array['tel_no2'])){$this->db->set('tel_no2', $data_array['tel_no2']);}
        if(isset($data_array['tel_no3'])){$this->db->set('tel_no3', $data_array['tel_no3']);}
        if(isset($data_array['fax_no'])){$this->db->set('fax_no', $data_array['fax_no']);}
        if(isset($data_array['fax_no2'])){$this->db->set('fax_no2', $data_array['fax_no2']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        if(isset($data_array['contact_person'])){$this->db->set('contact_person', $data_array['contact_person']);}
        if(isset($data_array['other'])){$this->db->set('other', $data_array['other']);}
        if(isset($data_array['website'])){$this->db->set('website', $data_array['website']);}
        if(isset($data_array['beds'])){$this->db->set('beds', $data_array['beds']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['pcdom_ref'])){$this->db->set('pcdom_ref', $data_array['pcdom_ref']);}
        if(isset($data_array['thirra_url'])){$this->db->set('thirra_url', $data_array['thirra_url']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('referral_center');
        //echo $this->db->last_query();
        //echo "<br />Inserted into referral_center";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_referral_centre($data_array)


    //************************************************************************
    /**
     * Method to insert New Referral Person
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_referral_person($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting referral_doctor";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        // Insert into referral_doctor
        if(isset($data_array['referral_doctor_id'])){$this->db->set('referral_doctor_id', $data_array['referral_doctor_id']);}
        if(isset($data_array['referral_center_id'])){$this->db->set('referral_center_id', $data_array['referral_center_id']);}
        if(isset($data_array['doctor_name'])){$this->db->set('doctor_name', $data_array['doctor_name']);}
        if(isset($data_array['specialty'])){$this->db->set('specialty', $data_array['specialty']);}
        if(isset($data_array['tel_no'])){$this->db->set('tel_no', $data_array['tel_no']);}
        if(isset($data_array['tel_no2'])){$this->db->set('tel_no2', $data_array['tel_no2']);}
        if(isset($data_array['fax_no'])){$this->db->set('fax_no', $data_array['fax_no']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        if(isset($data_array['other'])){$this->db->set('other', $data_array['other']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['doctor_active'])){$this->db->set('doctor_active', $data_array['doctor_active']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('referral_doctor');
        //echo $this->db->last_query();
        //echo "<br />Inserted into referral_doctor";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_referral_person($data_array)


    //************************************************************************
    /**
     * Method to insert New Data Synch log
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_synch_log($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting data_synch_log";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into data_synch_log
        if(isset($data_array['data_synch_log_id'])){$this->db->set('data_synch_log_id', (string)$data_array['data_synch_log_id']);}
        if(isset($data_array['export_by'])){$this->db->set('export_by', (string)$data_array['export_by']);}
        if(isset($data_array['export_when'])){$this->db->set('export_when', (string)$data_array['export_when']);}
        if(isset($data_array['thirra_version'])){$this->db->set('thirra_version', (string)$data_array['thirra_version']);}
        if(isset($data_array['export_clinicname'])){$this->db->set('export_clinicname', (string)$data_array['export_clinicname']);}
        if(isset($data_array['export_clinicref'])){$this->db->set('export_clinicref', (string)$data_array['export_clinicref']);}
        if(isset($data_array['export_reference'])){$this->db->set('export_reference', (string)$data_array['export_reference']);}
        if(isset($data_array['import_by'])){$this->db->set('import_by', (string)$data_array['import_by']);}
        if(isset($data_array['import_when'])){$this->db->set('import_when', (string)$data_array['import_when']);}
        if(isset($data_array['data_filename'])){$this->db->set('data_filename', (string)$data_array['data_filename']);}
        if(isset($data_array['import_remarks'])){$this->db->set('import_remarks', (string)$data_array['import_remarks']);}
        if(isset($data_array['import_reference'])){$this->db->set('import_reference', (string)$data_array['import_reference']);}
        if(isset($data_array['import_number'])){$this->db->set('import_number', $data_array['import_number']);}
        if(isset($data_array['import_outcome'])){$this->db->set('import_outcome', (string)$data_array['import_outcome']);}
        if(isset($data_array['count_inserted'])){$this->db->set('count_inserted', $data_array['count_inserted']);}
        if(isset($data_array['count_declined'])){$this->db->set('count_declined', $data_array['count_declined']);}
        if(isset($data_array['count_rejected'])){$this->db->set('count_rejected', $data_array['count_rejected']);}
        if(isset($data_array['entities_inserted'])){$this->db->set('entities_inserted', (string)$data_array['entities_inserted']);}
        if(isset($data_array['entities_declined'])){$this->db->set('entities_declined', (string)$data_array['entities_declined']);}
        if(isset($data_array['entities_rejected'])){$this->db->set('entities_rejected', (string)$data_array['entities_rejected']);}
        if(isset($data_array['declined_list'])){$this->db->set('declined_list', (string)$data_array['declined_list']);}
        if(isset($data_array['rejected_list'])){$this->db->set('rejected_list', (string)$data_array['rejected_list']);}
        if(isset($data_array['outcome_remarks'])){$this->db->set('outcome_remarks', (string)$data_array['outcome_remarks']);}
        if(isset($data_array['sync_type'])){$this->db->set('sync_type', (string)$data_array['sync_type']);}
        // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('data_synch_log');
        //echo $this->db->last_query();
        //echo "<br />Inserted into data_synch_log";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_synch_log($data_array)


    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update_system_user
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_system_user($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
  place_of_birth character varying(50),
  marital_status character varying(20),
  spouse_name character varying(100),
  no_of_children character varying(2),
  language_spoken character varying(50),
  language_written character varying(50),

  tel_office character varying(20),
  pager_no character varying(30),
  fax_no character varying(20),
  remarks character varying(255), -- Added on Nov 18, 07
  im_handle character varying(255), -- Added on Nov 18, 07

        */
        if(isset($data_array['staff_category_id'])){$this->db->set('staff_category_id', $data_array['staff_category_id']);}
        if(isset($data_array['staff_name'])){$this->db->set('staff_name', $data_array['staff_name']);}
        if(isset($data_array['staff_initials'])){$this->db->set('staff_initials', $data_array['staff_initials']);}
        if(isset($data_array['mmc_no'])){$this->db->set('mmc_no', $data_array['mmc_no']);}
        if(isset($data_array['specialty'])){$this->db->set('specialty', $data_array['specialty']);}
        if(isset($data_array['gender'])){$this->db->set('gender', $data_array['gender']);}
        if(isset($data_array['ic_no'])){$this->db->set('ic_no', $data_array['ic_no']);}
        if(isset($data_array['ic_other_type'])){$this->db->set('ic_other_type', $data_array['ic_other_type']);}
        if(isset($data_array['ic_other_no'])){$this->db->set('ic_other_no', $data_array['ic_other_no']);}
        if(isset($data_array['nationality'])){$this->db->set('nationality', $data_array['nationality']);}
        if(isset($data_array['date_of_birth'])){$this->db->set('date_of_birth', $data_array['date_of_birth']);}
        if(isset($data_array['race'])){$this->db->set('race', $data_array['race']);}
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        $this->db->where('staff_id', $data_array['staff_id']);
        $this->db->update('staff_info');
        //echo $this->db->last_query();
        
        if(isset($data_array['address'])){$this->db->set('address', $data_array['address']);}
        if(isset($data_array['address2'])){$this->db->set('address2', $data_array['address2']);}
        if(isset($data_array['address3'])){$this->db->set('address3', $data_array['address3']);}
        if(isset($data_array['town'])){$this->db->set('town', $data_array['town']);}
        if(isset($data_array['state'])){$this->db->set('state', $data_array['state']);}
        if(isset($data_array['postcode'])){$this->db->set('postcode', $data_array['postcode']);}
        if(isset($data_array['country'])){$this->db->set('country', $data_array['country']);}
        if(isset($data_array['tel_home'])){$this->db->set('tel_home', $data_array['tel_home']);}
        if(isset($data_array['tel_mobile'])){$this->db->set('tel_mobile', $data_array['tel_mobile']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        $this->db->where('staff_contact_id', $data_array['staff_contact_id']);
        $this->db->update('staff_contact');
        //echo $this->db->last_query();
        
        if(isset($data_array['home_clinic'])){$this->db->set('home_clinic', $data_array['home_clinic']);}
        $this->db->where('staff_work_id', $data_array['staff_work_id']);
        $this->db->update('staff_work');
        //echo $this->db->last_query();

        if(isset($data_array['category_id'])){$this->db->set('category_id', $data_array['category_id']);}
        if(isset($data_array['username'])){$this->db->set('username', $data_array['username']);}
        if(isset($data_array['password'])){$this->db->set('password', $data_array['password']);}
        if(isset($data_array['expiry_date'])){$this->db->set('expiry_date', $data_array['expiry_date']);}
        if(isset($data_array['access_status'])){$this->db->set('access_status', $data_array['access_status']);}
        if(isset($data_array['permission'])){$this->db->set('permission', $data_array['permission']);}
        $this->db->where('user_id', $data_array['user_id']);
        $this->db->update('system_user');
        //echo $this->db->last_query();

        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_system_user($data_array)


    //************************************************************************
    /**
     * Method to update_staffcategory
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_staffcategory($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['category_name'])){$this->db->set('category_name', $data_array['category_name']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        $this->db->where('category_id', $data_array['category_id']);
        $this->db->update('staff_category');
        //echo $this->db->last_query();
        
        if(isset($data_array['category_name'])){$this->db->set('category_name', $data_array['category_name']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['permission'])){$this->db->set('permission', $data_array['permission']);}
        if(isset($data_array['can_consult'])){$this->db->set('can_consult', $data_array['can_consult']);}
        $this->db->where('category_id', $data_array['category_id']);
        $this->db->update('system_user_category');
        //echo $this->db->last_query();
        
        $new_acl_id =   time();
        foreach($data_array['acl_single'] as $acl_array){
            if(empty($acl_array['acl_id'])){
                // Insert new row by calling another method
                $this->insert_new_acl($new_acl_id,$acl_array,$data_array['category_id'],$data_array['edit_staff']);
                //echo "<br />Inserted into system_acl";
                $new_acl_id++;
            } else {
                // Update existing row
                $syssection_id  =   $acl_array['syssection_id'];
                $this->db->set('rights_single', $acl_array['single_'.$syssection_id]);
                $this->db->set('rights_multi', $acl_array['multi_'.$syssection_id]);
                //$this->db->set('acl_remarks', $data_array['acl_remarks']);
                $this->db->set('edit_remarks', $data_array['edit_remarks']);
                $this->db->set('edit_staff', $data_array['edit_staff']);
                $this->db->set('edit_time', time());
                $this->db->where('acl_id', $acl_array['acl_id']);
                $this->db->update('system_acl');
                //echo $this->db->last_query();
            }
        }
        
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_staffcategory($data_array)


    //************************************************************************
    /**
     * Method to update_clinic_info
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_clinic_info($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['clinic_name'])){$this->db->set('clinic_name', $data_array['clinic_name']);}
        if(isset($data_array['clinic_ref_no'])){$this->db->set('clinic_ref_no', $data_array['clinic_ref_no']);}
        if(isset($data_array['clinic_shortname'])){$this->db->set('clinic_shortname', $data_array['clinic_shortname']);}
        if(isset($data_array['manager_id'])){$this->db->set('manager_id', $data_array['manager_id']);}
        if(isset($data_array['owner_id'])){$this->db->set('owner_id', $data_array['owner_id']);}
        if(isset($data_array['time_open'])){$this->db->set('time_open', $data_array['time_open']);}
        if(isset($data_array['time_close'])){$this->db->set('time_close', $data_array['time_close']);}
        if(isset($data_array['locale'])){$this->db->set('locale', $data_array['locale']);}
        if(isset($data_array['address'])){$this->db->set('address', $data_array['address']);}
        if(isset($data_array['address2'])){$this->db->set('address2', $data_array['address2']);}
        if(isset($data_array['address3'])){$this->db->set('address3', $data_array['address3']);}
        if(isset($data_array['town'])){$this->db->set('town', $data_array['town']);}
        if(isset($data_array['state'])){$this->db->set('state', $data_array['state']);}
        if(isset($data_array['postcode'])){$this->db->set('postcode', $data_array['postcode']);}
        if(isset($data_array['country'])){$this->db->set('country', $data_array['country']);}
        if(isset($data_array['tel_no'])){$this->db->set('tel_no', $data_array['tel_no']);}
        if(isset($data_array['tel_no2'])){$this->db->set('tel_no2', $data_array['tel_no2']);}
        if(isset($data_array['tel_no3'])){$this->db->set('tel_no3', $data_array['tel_no3']);}
        if(isset($data_array['fax_no'])){$this->db->set('fax_no', $data_array['fax_no']);}
        if(isset($data_array['fax_no2'])){$this->db->set('fax_no2', $data_array['fax_no2']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        if(isset($data_array['other'])){$this->db->set('other', $data_array['other']);}
        if(isset($data_array['established'])){$this->db->set('established', $data_array['established']);}
        if(isset($data_array['owner_type'])){$this->db->set('owner_type', $data_array['owner_type']);}
        if(isset($data_array['health_department_id'])){$this->db->set('health_department_id', $data_array['health_department_id']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['pcdom_ref'])){$this->db->set('pcdom_ref', $data_array['pcdom_ref']);}
        if(isset($data_array['markup_1'])){$this->db->set('markup_1', $data_array['markup_1']);}
        if(isset($data_array['markup_2'])){$this->db->set('markup_2', $data_array['markup_2']);}
        if(isset($data_array['markup_3'])){$this->db->set('markup_3', $data_array['markup_3']);}
        if(isset($data_array['sort_clinic'])){$this->db->set('sort_clinic', $data_array['sort_clinic']);}
        if(isset($data_array['clinic_privatekey'])){$this->db->set('clinic_privatekey', $data_array['clinic_privatekey']);}
        if(isset($data_array['clinic_publickey'])){$this->db->set('clinic_publickey', $data_array['clinic_publickey']);}
        if(isset($data_array['addr_village_id'])){$this->db->set('addr_village_id', $data_array['addr_village_id']);}
        if(isset($data_array['addr_town_id'])){$this->db->set('addr_town_id', $data_array['addr_town_id']);}
        if(isset($data_array['addr_area_id'])){$this->db->set('addr_area_id', $data_array['addr_area_id']);}
        if(isset($data_array['addr_district_id'])){$this->db->set('addr_district_id', $data_array['addr_district_id']);}
        if(isset($data_array['addr_state_id'])){$this->db->set('addr_state_id', $data_array['addr_state_id']);}
        if(isset($data_array['clinic_district_id'])){$this->db->set('clinic_district_id', $data_array['clinic_district_id']);}
        if(isset($data_array['clinic_status'])){$this->db->set('clinic_status', $data_array['clinic_status']);}
        if(isset($data_array['clinic_gps_lat'])){$this->db->set('clinic_gps_lat', $data_array['clinic_gps_lat']);}
        if(isset($data_array['clinic_gps_long'])){$this->db->set('clinic_gps_long', $data_array['clinic_gps_long']);}
        if(isset($data_array['clinic_type'])){$this->db->set('clinic_type', $data_array['clinic_type']);}
        $this->db->where('clinic_info_id', $data_array['clinic_info_id']);
        $this->db->update('clinic_info');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_clinic_info($data_array)


    //************************************************************************
    /**
     * Method to update_clinic_dept
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_clinic_dept($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        $this->db->set('location_id', $data_array['location_id']);
        $this->db->set('dept_name', $data_array['dept_name']);
        $this->db->set('dept_shortname', $data_array['dept_shortname']);
        $this->db->set('dept_code', $data_array['dept_code']);
        $this->db->set('dept_description', $data_array['dept_description']);
        $this->db->set('dept_head', $data_array['dept_head']);
        $this->db->set('dept_telno', $data_array['dept_telno']);
        $this->db->set('dept_sort', $data_array['dept_sort']);
        $this->db->set('dept_remarks', $data_array['dept_remarks']);
        $this->db->where('clinic_dept_id', $data_array['clinic_dept_id']);
        $this->db->update('clinic_dept');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_clinic_dept($data_array)


    //************************************************************************
    /**
     * Method to update_referral_centre
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_referral_centre($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        $this->db->set('name', $data_array['centre_name']);
        $this->db->set('centre_type', $data_array['centre_type']);
        $this->db->set('address', $data_array['address']);
        $this->db->set('address2', $data_array['address2']);
        $this->db->set('address3', $data_array['address3']);
        $this->db->set('town', $data_array['town']);
        $this->db->set('state', $data_array['state']);
        $this->db->set('postcode', $data_array['postcode']);
        $this->db->set('country', $data_array['country']);
        $this->db->set('tel_no', $data_array['tel_no']);
        $this->db->set('tel_no2', $data_array['tel_no2']);
        $this->db->set('tel_no3', $data_array['tel_no3']);
        $this->db->set('fax_no', $data_array['fax_no']);
        $this->db->set('fax_no2', $data_array['fax_no2']);
        $this->db->set('email', $data_array['email']);
        $this->db->set('contact_person', $data_array['contact_person']);
        $this->db->set('other', $data_array['other']);
        $this->db->set('website', $data_array['website']);
        if(isset($data_array['beds'])){$this->db->set('beds', $data_array['beds']);}
        //$this->db->set('beds', $data_array['beds']);
        $this->db->set('remarks', $data_array['remarks']);
        $this->db->set('pcdom_ref', $data_array['pcdom_ref']);
        $this->db->set('thirra_url', $data_array['thirra_url']);
        $this->db->where('referral_center_id', $data_array['referral_center_id']);
        $this->db->update('referral_center');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_referral_centre($data_array)


    //************************************************************************
    /**
     * Method to update_referral_doctor
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_referral_doctor($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        $this->db->set('referral_center_id', $data_array['referral_center_id']);
        $this->db->set('doctor_name', $data_array['doctor_name']);
        $this->db->set('specialty', $data_array['specialty']);
        $this->db->set('tel_no', $data_array['tel_no']);
        $this->db->set('tel_no2', $data_array['tel_no2']);
        $this->db->set('fax_no', $data_array['fax_no']);
        $this->db->set('email', $data_array['email']);
        $this->db->set('other', $data_array['other']);
        $this->db->set('remarks', $data_array['remarks']);
        $this->db->set('doctor_active', $data_array['doctor_active']);
        $this->db->where('referral_doctor_id', $data_array['referral_doctor_id']);
        $this->db->update('referral_doctor');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_referral_doctor($data_array)


    //************************************************************************
    /**
     * Method to reset_synch_flags
     *
     * This method resets synch_flags
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function reset_synch_flags()
    {
        //$data = array();
        //$data   = $data_array;
        
        $reset_results  =   "Reset <table><tr><th>Table</th><th>Rows affected</th>";
        
        // Begin transaction
        $this->db->trans_begin();
        
        $tablelist  =   array();
        $tablelist[]   =   "adt";
        $tablelist[]   =   "billing_invoice";
        $tablelist[]   =   "dispense_queue";
        $tablelist[]   =   "drug_product";
        $tablelist[]   =   "drug_supplier";
        $tablelist[]   =   "gem_conanswer";
        $tablelist[]   =   "gem_session";
        $tablelist[]   =   "imaging_order";
        $tablelist[]   =   "imaging_supplier";
        $tablelist[]   =   "lab_findings";
        $tablelist[]   =   "lab_order";
        $tablelist[]   =   "lab_package_test";
        $tablelist[]   =   "lab_result";
        $tablelist[]   =   "lab_supplier";
        $tablelist[]   =   "patient_antenatal";
        $tablelist[]   =   "patient_antenatal_current";
        $tablelist[]   =   "patient_antenatal_delivery";
        $tablelist[]   =   "patient_antenatal_followup";
        $tablelist[]   =   "patient_antenatal_health";
        $tablelist[]   =   "patient_antenatal_info";
        $tablelist[]   =   "patient_complaint";
        $tablelist[]   =   "patient_consultation_summary";
        $tablelist[]   =   "patient_contact_info";
        $tablelist[]   =   "patient_correspondence";
        $tablelist[]   =   "patient_counselling";
        $tablelist[]   =   "patient_demographic_info";
        $tablelist[]   =   "patient_diagnosis";
        $tablelist[]   =   "patient_disease_notification";
        $tablelist[]   =   "patient_drug_allergy";
        $tablelist[]   =   "patient_employment";
        $tablelist[]   =   "patient_event";
        $tablelist[]   =   "patient_family_details";
        $tablelist[]   =   "patient_family_history";
        $tablelist[]   =   "patient_family_relationship";
        $tablelist[]   =   "patient_file";
        $tablelist[]   =   "patient_immunisation";
        $tablelist[]   =   "patient_medical_history";
        $tablelist[]   =   "patient_medical_leave";
        $tablelist[]   =   "patient_medication";
        $tablelist[]   =   "patient_physical_exam";
        $tablelist[]   =   "patient_referral";
        $tablelist[]   =   "patient_referral_attach";
        $tablelist[]   =   "patient_referral_reply";
        $tablelist[]   =   "patient_social_history";
        $tablelist[]   =   "patient_vital";
        $tablelist[]   =   "prescript_queue";
        $tablelist[]   =   "procedure_order";
        $tablelist[]   =   "procedure_supplier";
        $tablelist[]   =   "purchase_order";
        $tablelist[]   =   "staff_category";
        $tablelist[]   =   "staff_contact";
        $tablelist[]   =   "staff_info";
        $tablelist[]   =   "supplier_contact_info";
        $tablelist[]   =   "supplier_inv_nondrug";
        $tablelist[]   =   "supplier_invoice";
        $tablelist[]   =   "system_log";
        $tablelist[]   =   "system_user";
        
        foreach($tablelist as $table){
            $sqlQuery   =   "UPDATE ".$table;
            $sqlQuery   .=  " SET synch_in=NULL, synch_out=NULL, synch_remarks=NULL";
            $sqlQuery   .=  " WHERE (synch_in IS NOT NULL) OR (synch_out IS NOT NULL) ";
            //echo "<br />".$sqlQuery;
            $query =  $this->db->query($sqlQuery);
            $affected_rows  =   $this->db->affected_rows();
            $reset_results  .=  "\n<tr><td>".$table."</td><td>".$affected_rows."</td></tr>";
        }
        $reset_results  .=  "</table>";
        
        // End transaction
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            echo "<br /><br />Some errors were found. New antenatal event not completed.";
        } else {
            $this->db->trans_commit();
            //echo "<br /><br />No errors found. New antenatal event completed.";
        }
        //echo "<hr />";
        return $reset_results; 

    } // end of function reset_synch_flags($data_array)
    
    
    //===============================================================
    // Delete Database Records Methods


}

/* End of file MAdmin_wdb.php */
/* Location: ./app_thirra/models/madmin_wdb.php */
