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
 * Portions created by the Initial Developer are Copyright (C) 2010
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for Utilities
 *
 * This class is for models that only writes to the database.
 *
 * @version 0.8
 * @package THIRRA - mUtil-Wdb
 * @author  Jason Tan Boon Teck
 */

class MUtil_wdb extends CI_Model
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
     * Method to insert New addr_village
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_village($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting addr_village";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into addr_village
        if(isset($data_array['addr_village_id'])){$this->db->set('addr_village_id', $data_array['addr_village_id']);}
        if(isset($data_array['addr_town_id'])){$this->db->set('addr_town_id', $data_array['addr_town_id']);}
        if(isset($data_array['addr_area_id'])){$this->db->set('addr_area_id', $data_array['addr_area_id']);}
        if(isset($data_array['addr_village_name'])){$this->db->set('addr_village_name', $data_array['addr_village_name']);}
        if(isset($data_array['addr_village_code'])){$this->db->set('addr_village_code', $data_array['addr_village_code']);}
        if(isset($data_array['addr_village_subcode'])){$this->db->set('addr_village_subcode', $data_array['addr_village_subcode']);}
        if(isset($data_array['addr_village_sort'])){$this->db->set('addr_village_sort', $data_array['addr_village_sort']);}
        if(isset($data_array['addr_village_descr'])){$this->db->set('addr_village_descr', $data_array['addr_village_descr']);}
        if(isset($data_array['addr_village_section'])){$this->db->set('addr_village_section', $data_array['addr_village_section']);}
        if(isset($data_array['addr_village_address1'])){$this->db->set('addr_village_address1', $data_array['addr_village_address1']);}
        if(isset($data_array['addr_village_address2'])){$this->db->set('addr_village_address2', $data_array['addr_village_address2']);}
        if(isset($data_array['addr_village_address3'])){$this->db->set('addr_village_address3', $data_array['addr_village_address3']);}
        if(isset($data_array['addr_village_postcode'])){$this->db->set('addr_village_postcode', $data_array['addr_village_postcode']);}
        if(isset($data_array['addr_village_town'])){$this->db->set('addr_village_town', $data_array['addr_village_town']);}
        if(isset($data_array['addr_village_state'])){$this->db->set('addr_village_state', $data_array['addr_village_state']);}
        if(isset($data_array['addr_village_country'])){$this->db->set('addr_village_country', $data_array['addr_village_country']);}
        if(isset($data_array['addr_village_tel'])){$this->db->set('addr_village_tel', $data_array['addr_village_tel']);}
        if(isset($data_array['addr_village_fax'])){$this->db->set('addr_village_fax', $data_array['addr_village_fax']);}
        if(isset($data_array['addr_village_email'])){$this->db->set('addr_village_email', $data_array['addr_village_email']);}
        if(isset($data_array['addr_village_mgr1_position'])){$this->db->set('addr_village_mgr1_position', $data_array['addr_village_mgr1_position']);}
        if(isset($data_array['addr_village_mgr1_name'])){$this->db->set('addr_village_mgr1_name', $data_array['addr_village_mgr1_name']);}
        if(isset($data_array['addr_village_mgr2_position'])){$this->db->set('addr_village_mgr2_position', $data_array['addr_village_mgr2_position']);}
        if(isset($data_array['addr_village_mgr2_name'])){$this->db->set('addr_village_mgr2_name', $data_array['addr_village_mgr2_name']);}
        if(isset($data_array['addr_village_gps_lat'])){$this->db->set('addr_village_gps_lat', $data_array['addr_village_gps_lat']);}
        if(isset($data_array['addr_village_gps_long'])){$this->db->set('addr_village_gps_long', $data_array['addr_village_gps_long']);}
        if(isset($data_array['addr_village_population'])){$this->db->set('addr_village_population', $data_array['addr_village_population']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('addr_village');
        //echo $this->db->last_query();
        //echo "<br />Inserted into addr_village";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_village($data_array)


    //************************************************************************
    /**
     * Method to insert New addr_town
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_town($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting addr_town";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into addr_town
        if(isset($data_array['addr_town_id'])){$this->db->set('addr_town_id', $data_array['addr_town_id']);}
        if(isset($data_array['addr_area_id'])){$this->db->set('addr_area_id', $data_array['addr_area_id']);}
        if(isset($data_array['addr_district_id'])){$this->db->set('addr_district_id', $data_array['addr_district_id']);}
        if(isset($data_array['addr_town_name'])){$this->db->set('addr_town_name', $data_array['addr_town_name']);}
        if(isset($data_array['addr_town_code'])){$this->db->set('addr_town_code', $data_array['addr_town_code']);}
        if(isset($data_array['addr_town_subcode'])){$this->db->set('addr_town_subcode', $data_array['addr_town_subcode']);}
        if(isset($data_array['addr_town_sort'])){$this->db->set('addr_town_sort', $data_array['addr_town_sort']);}
        if(isset($data_array['addr_town_descr'])){$this->db->set('addr_town_descr', $data_array['addr_town_descr']);}
        if(isset($data_array['addr_town_section'])){$this->db->set('addr_town_section', $data_array['addr_town_section']);}
        if(isset($data_array['addr_town_address1'])){$this->db->set('addr_town_address1', $data_array['addr_town_address1']);}
        if(isset($data_array['addr_town_address2'])){$this->db->set('addr_town_address2', $data_array['addr_town_address2']);}
        if(isset($data_array['addr_town_address3'])){$this->db->set('addr_town_address3', $data_array['addr_town_address3']);}
        if(isset($data_array['addr_town_postcode'])){$this->db->set('addr_town_postcode', $data_array['addr_town_postcode']);}
        if(isset($data_array['addr_town_town'])){$this->db->set('addr_town_town', $data_array['addr_town_town']);}
        if(isset($data_array['addr_town_state'])){$this->db->set('addr_town_state', $data_array['addr_town_state']);}
        if(isset($data_array['addr_town_country'])){$this->db->set('addr_town_country', $data_array['addr_town_country']);}
        if(isset($data_array['addr_town_tel'])){$this->db->set('addr_town_tel', $data_array['addr_town_tel']);}
        if(isset($data_array['addr_town_fax'])){$this->db->set('addr_town_fax', $data_array['addr_town_fax']);}
        if(isset($data_array['addr_town_email'])){$this->db->set('addr_town_email', $data_array['addr_town_email']);}
        if(isset($data_array['addr_town_mgr1_position'])){$this->db->set('addr_town_mgr1_position', $data_array['addr_town_mgr1_position']);}
        if(isset($data_array['addr_town_mgr1_name'])){$this->db->set('addr_town_mgr1_name', $data_array['addr_town_mgr1_name']);}
        if(isset($data_array['addr_town_mgr2_position'])){$this->db->set('addr_town_mgr2_position', $data_array['addr_town_mgr2_position']);}
        if(isset($data_array['addr_town_mgr2_name'])){$this->db->set('addr_town_mgr2_name', $data_array['addr_town_mgr2_name']);}
        if(isset($data_array['addr_town_population'])){$this->db->set('addr_town_population', $data_array['addr_town_population']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('addr_town');
        //echo $this->db->last_query();
        //echo "<br />Inserted into addr_town";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_town($data_array)


    //************************************************************************
    /**
     * Method to insert New addr_area
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_area($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting addr_area";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into addr_area
        if(isset($data_array['addr_area_id'])){$this->db->set('addr_area_id', $data_array['addr_area_id']);}
        if(isset($data_array['addr_district_id'])){$this->db->set('addr_district_id', $data_array['addr_district_id']);}
        if(isset($data_array['addr_area_name'])){$this->db->set('addr_area_name', $data_array['addr_area_name']);}
        if(isset($data_array['addr_area_code'])){$this->db->set('addr_area_code', $data_array['addr_area_code']);}
        if(isset($data_array['addr_area_subcode'])){$this->db->set('addr_area_subcode', $data_array['addr_area_subcode']);}
        if(isset($data_array['addr_area_sort'])){$this->db->set('addr_area_sort', $data_array['addr_area_sort']);}
        if(isset($data_array['addr_area_descr'])){$this->db->set('addr_area_descr', $data_array['addr_area_descr']);}
        if(isset($data_array['addr_area_section'])){$this->db->set('addr_area_section', $data_array['addr_area_section']);}
        if(isset($data_array['addr_area_address1'])){$this->db->set('addr_area_address1', $data_array['addr_area_address1']);}
        if(isset($data_array['addr_area_address2'])){$this->db->set('addr_area_address2', $data_array['addr_area_address2']);}
        if(isset($data_array['addr_area_address3'])){$this->db->set('addr_area_address3', $data_array['addr_area_address3']);}
        if(isset($data_array['addr_area_postcode'])){$this->db->set('addr_area_postcode', $data_array['addr_area_postcode']);}
        if(isset($data_array['addr_area_town'])){$this->db->set('addr_area_town', $data_array['addr_area_town']);}
        if(isset($data_array['addr_area_state'])){$this->db->set('addr_area_state', $data_array['addr_area_state']);}
        if(isset($data_array['addr_area_country'])){$this->db->set('addr_area_country', $data_array['addr_area_country']);}
        if(isset($data_array['addr_area_tel'])){$this->db->set('addr_area_tel', $data_array['addr_area_tel']);}
        if(isset($data_array['addr_area_fax'])){$this->db->set('addr_area_fax', $data_array['addr_area_fax']);}
        if(isset($data_array['addr_area_email'])){$this->db->set('addr_area_email', $data_array['addr_area_email']);}
        if(isset($data_array['addr_area_mgr1_position'])){$this->db->set('addr_area_mgr1_position', $data_array['addr_area_mgr1_position']);}
        if(isset($data_array['addr_area_mgr1_name'])){$this->db->set('addr_area_mgr1_name', $data_array['addr_area_mgr1_name']);}
        if(isset($data_array['addr_area_mgr2_position'])){$this->db->set('addr_area_mgr2_position', $data_array['addr_area_mgr2_position']);}
        if(isset($data_array['addr_area_mgr2_name'])){$this->db->set('addr_area_mgr2_name', $data_array['addr_area_mgr2_name']);}
        if(isset($data_array['addr_area_population'])){$this->db->set('addr_area_population', $data_array['addr_area_population']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('addr_area');
        //echo $this->db->last_query();
        //echo "<br />Inserted into addr_area";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_area($data_array)


    //************************************************************************
    /**
     * Method to insert New addr_district
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_district($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting addr_area";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into addr_district
        if(isset($data_array['addr_district_id'])){$this->db->set('addr_district_id', $data_array['addr_district_id']);}
        if(isset($data_array['addr_state_id'])){$this->db->set('addr_state_id', $data_array['addr_state_id']);}
        if(isset($data_array['addr_district_name'])){$this->db->set('addr_district_name', $data_array['addr_district_name']);}
        if(isset($data_array['addr_district_code'])){$this->db->set('addr_district_code', $data_array['addr_district_code']);}
        if(isset($data_array['addr_district_subcode'])){$this->db->set('addr_district_subcode', $data_array['addr_district_subcode']);}
        if(isset($data_array['addr_district_sort'])){$this->db->set('addr_district_sort', $data_array['addr_district_sort']);}
        if(isset($data_array['addr_district_descr'])){$this->db->set('addr_district_descr', $data_array['addr_district_descr']);}
        if(isset($data_array['addr_district_section'])){$this->db->set('addr_district_section', $data_array['addr_district_section']);}
        if(isset($data_array['addr_district_address1'])){$this->db->set('addr_district_address1', $data_array['addr_district_address1']);}
        if(isset($data_array['addr_district_address2'])){$this->db->set('addr_district_address2', $data_array['addr_district_address2']);}
        if(isset($data_array['addr_district_address3'])){$this->db->set('addr_district_address3', $data_array['addr_district_address3']);}
        if(isset($data_array['addr_district_postcode'])){$this->db->set('addr_district_postcode', $data_array['addr_district_postcode']);}
        if(isset($data_array['addr_district_town'])){$this->db->set('addr_district_town', $data_array['addr_district_town']);}
        if(isset($data_array['addr_district_state'])){$this->db->set('addr_district_state', $data_array['addr_district_state']);}
        if(isset($data_array['addr_district_country'])){$this->db->set('addr_district_country', $data_array['addr_district_country']);}
        if(isset($data_array['addr_district_tel'])){$this->db->set('addr_district_tel', $data_array['addr_district_tel']);}
        if(isset($data_array['addr_district_fax'])){$this->db->set('addr_district_fax', $data_array['addr_district_fax']);}
        if(isset($data_array['addr_district_email'])){$this->db->set('addr_district_email', $data_array['addr_district_email']);}
        if(isset($data_array['addr_district_mgr1_position'])){$this->db->set('addr_district_mgr1_position', $data_array['addr_district_mgr1_position']);}
        if(isset($data_array['addr_district_mgr1_name'])){$this->db->set('addr_district_mgr1_name', $data_array['addr_district_mgr1_name']);}
        if(isset($data_array['addr_district_mgr2_position'])){$this->db->set('addr_district_mgr2_position', $data_array['addr_district_mgr2_position']);}
        if(isset($data_array['addr_district_mgr2_name'])){$this->db->set('addr_district_mgr2_name', $data_array['addr_district_mgr2_name']);}
        if(isset($data_array['addr_district_population'])){$this->db->set('addr_district_population', $data_array['addr_district_population']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('addr_district');
        //echo $this->db->last_query();
        //echo "<br />Inserted into addr_district";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_district($data_array)


    //************************************************************************
    /**
     * Method to insert New addr_state
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_state($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting addr_state";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into addr_state
        if(isset($data_array['addr_state_id'])){$this->db->set('addr_state_id', $data_array['addr_state_id']);}
        if(isset($data_array['addr_state_name'])){$this->db->set('addr_state_name', $data_array['addr_state_name']);}
        if(isset($data_array['addr_state_code'])){$this->db->set('addr_state_code', $data_array['addr_state_code']);}
        if(isset($data_array['addr_state_subcode'])){$this->db->set('addr_state_subcode', $data_array['addr_state_subcode']);}
        if(isset($data_array['addr_state_sort'])){$this->db->set('addr_state_sort', $data_array['addr_state_sort']);}
        if(isset($data_array['addr_state_descr'])){$this->db->set('addr_state_descr', $data_array['addr_state_descr']);}
        if(isset($data_array['addr_state_section'])){$this->db->set('addr_state_section', $data_array['addr_state_section']);}
        if(isset($data_array['addr_state_address1'])){$this->db->set('addr_state_address1', $data_array['addr_state_address1']);}
        if(isset($data_array['addr_state_address2'])){$this->db->set('addr_state_address2', $data_array['addr_state_address2']);}
        if(isset($data_array['addr_state_address3'])){$this->db->set('addr_state_address3', $data_array['addr_state_address3']);}
        if(isset($data_array['addr_state_postcode'])){$this->db->set('addr_state_postcode', $data_array['addr_state_postcode']);}
        if(isset($data_array['addr_state_town'])){$this->db->set('addr_state_town', $data_array['addr_state_town']);}
        if(isset($data_array['addr_state_state'])){$this->db->set('addr_state_state', $data_array['addr_state_state']);}
        if(isset($data_array['addr_state_country'])){$this->db->set('addr_state_country', $data_array['addr_state_country']);}
        if(isset($data_array['addr_state_tel'])){$this->db->set('addr_state_tel', $data_array['addr_state_tel']);}
        if(isset($data_array['addr_state_fax'])){$this->db->set('addr_state_fax', $data_array['addr_state_fax']);}
        if(isset($data_array['addr_state_email'])){$this->db->set('addr_state_email', $data_array['addr_state_email']);}
        if(isset($data_array['addr_state_mgr1_position'])){$this->db->set('addr_state_mgr1_position', $data_array['addr_state_mgr1_position']);}
        if(isset($data_array['addr_state_mgr1_name'])){$this->db->set('addr_state_mgr1_name', $data_array['addr_state_mgr1_name']);}
        if(isset($data_array['addr_state_mgr2_position'])){$this->db->set('addr_state_mgr2_position', $data_array['addr_state_mgr2_position']);}
        if(isset($data_array['addr_state_mgr2_name'])){$this->db->set('addr_state_mgr2_name', $data_array['addr_state_mgr2_name']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('addr_state');
        //echo $this->db->last_query();
        //echo "<br />Inserted into addr_state";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_state($data_array)


    //************************************************************************
    /**
     * Method to insert New complaint code
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_complaintcode($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting icpc2_symptom";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into icpc2_symptom
        if(isset($data_array['icpc_code'])){$this->db->set('icpc_code', $data_array['icpc_code']);}
        if(isset($data_array['component'])){$this->db->set('component', $data_array['component']);}
        if(isset($data_array['full_description'])){$this->db->set('full_description', $data_array['full_description']);}
        if(isset($data_array['short_description'])){$this->db->set('short_description', $data_array['short_description']);}
        if(isset($data_array['icd_10'])){$this->db->set('icd_10', $data_array['icd_10']);}
        if(isset($data_array['criteria'])){$this->db->set('criteria', $data_array['criteria']);}
        if(isset($data_array['inclusion_criteria'])){$this->db->set('inclusion_criteria', $data_array['inclusion_criteria']);}
        if(isset($data_array['exclusion_criteria'])){$this->db->set('exclusion_criteria', $data_array['exclusion_criteria']);}
        if(isset($data_array['consideration'])){$this->db->set('consideration', $data_array['consideration']);}
        if(isset($data_array['note'])){$this->db->set('note', $data_array['note']);}
		// Perform db insert
        echo $this->db->_compile_select();
        $this->db->insert('icpc2_symptom');
        //echo $this->db->last_query();
        //echo "<br />Inserted into icpc2_symptom";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_complaintcode($data_array)


    //************************************************************************
    /**
     * Method to insert New dcode1
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_dcode1($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting dcode1";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into dcode1ext
        if(isset($data_array['dcode1_id'])){$this->db->set('dcode1_id', $data_array['dcode1_id']);}
        if(isset($data_array['dcode1set'])){$this->db->set('dcode1set', $data_array['dcode1set']);}
        if(isset($data_array['dcode1_code'])){$this->db->set('dcode1_code', $data_array['dcode1_code']);}
        if(isset($data_array['component'])){$this->db->set('component', $data_array['component']);}
        if(isset($data_array['code_use'])){$this->db->set('code_use', $data_array['code_use']);}
        if(isset($data_array['chapter'])){$this->db->set('chapter', $data_array['chapter']);}
        if(isset($data_array['topic'])){$this->db->set('topic', $data_array['topic']);}
        if(isset($data_array['full_title'])){$this->db->set('full_title', $data_array['full_title']);}
        if(isset($data_array['short_title'])){$this->db->set('short_title', $data_array['short_title']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['dcode2maps'])){$this->db->set('dcode2_maps', $data_array['dcode2maps']);}
        if(isset($data_array['criteria'])){$this->db->set('criteria', $data_array['criteria']);}
        if(isset($data_array['inclusion_criteria'])){$this->db->set('inclusion_criteria', $data_array['inclusion_criteria']);}
        if(isset($data_array['exclusion_criteria'])){$this->db->set('exclusion_criteria', $data_array['exclusion_criteria']);}
        if(isset($data_array['consideration'])){$this->db->set('consideration', $data_array['consideration']);}
        if(isset($data_array['note'])){$this->db->set('note', $data_array['note']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['dcode1ext_x01'])){$this->db->set('dcode1ext_x01', $data_array['dcode1ext_x01']);}
        if(isset($data_array['dcode1ext_x02'])){$this->db->set('dcode1ext_x02', $data_array['dcode1ext_x02']);}
        if(isset($data_array['dcode1ext_x03'])){$this->db->set('dcode1ext_x03', $data_array['dcode1ext_x03']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['dcode1_active'])){$this->db->set('dcode1_active', $data_array['dcode1_active']);}
        if(isset($data_array['edit_remarks'])){$this->db->set('edit_remarks', $data_array['edit_remarks']);}
        if(isset($data_array['edit_staff'])){$this->db->set('edit_staff', $data_array['edit_staff']);}
        if(isset($data_array['edit_date'])){$this->db->set('edit_date', $data_array['edit_date']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('dcode1');
        //echo $this->db->last_query();
        //echo "<br />Inserted into dcode1";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_dcode1($data_array)


    //************************************************************************
    /**
     * Method to insert New dcode1ext
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_dcode1ext($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting dcode1ext";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into dcode1ext
        if(isset($data_array['dcode1ext_id'])){$this->db->set('dcode1ext_id', $data_array['dcode1ext_id']);}
        if(isset($data_array['dcode1_id'])){$this->db->set('dcode1_id', $data_array['dcode1_id']);}
        if(isset($data_array['dcode1set'])){$this->db->set('dcode1set', $data_array['dcode1set']);}
        if(isset($data_array['dcode1ext_code'])){$this->db->set('dcode1ext_code', $data_array['dcode1ext_code']);}
        if(isset($data_array['dcode1ext_longname'])){$this->db->set('dcode1ext_longname', $data_array['dcode1ext_longname']);}
        if(isset($data_array['dcode1ext_shortname'])){$this->db->set('dcode1ext_shortname', $data_array['dcode1ext_shortname']);}
        if(isset($data_array['component'])){$this->db->set('component', $data_array['component']);}
        if(isset($data_array['code_use'])){$this->db->set('code_use', $data_array['code_use']);}
        if(isset($data_array['chapter'])){$this->db->set('chapter', $data_array['chapter']);}
        if(isset($data_array['topic'])){$this->db->set('topic', $data_array['topic']);}
        if(isset($data_array['full_title'])){$this->db->set('full_title', $data_array['full_title']);}
        if(isset($data_array['short_title'])){$this->db->set('short_title', $data_array['short_title']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['dcode2maps'])){$this->db->set('dcode2maps', $data_array['dcode2maps']);}
        if(isset($data_array['criteria'])){$this->db->set('criteria', $data_array['criteria']);}
        if(isset($data_array['inclusion_criteria'])){$this->db->set('inclusion_criteria', $data_array['inclusion_criteria']);}
        if(isset($data_array['exclusion_criteria'])){$this->db->set('exclusion_criteria', $data_array['exclusion_criteria']);}
        if(isset($data_array['consideration'])){$this->db->set('consideration', $data_array['consideration']);}
        if(isset($data_array['note'])){$this->db->set('note', $data_array['note']);}
        if(isset($data_array['dcode1ext_notify'])){$this->db->set('dcode1ext_notify', $data_array['dcode1ext_notify']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['dcode1ext_x01'])){$this->db->set('dcode1ext_x01', $data_array['dcode1ext_x01']);}
        if(isset($data_array['dcode1ext_x02'])){$this->db->set('dcode1ext_x02', $data_array['dcode1ext_x02']);}
        if(isset($data_array['dcode1ext_x03'])){$this->db->set('dcode1ext_x03', $data_array['dcode1ext_x03']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['dcode1ext_active'])){$this->db->set('dcode1ext_active', $data_array['dcode1ext_active']);}
        if(isset($data_array['edit_remarks'])){$this->db->set('edit_remarks', $data_array['edit_remarks']);}
        if(isset($data_array['edit_staff'])){$this->db->set('edit_staff', $data_array['edit_staff']);}
        if(isset($data_array['edit_date'])){$this->db->set('edit_date', $data_array['edit_date']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('dcode1ext');
        //echo $this->db->last_query();
        //echo "<br />Inserted into dcode1ext";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_dcode1ext($data_array)


    //************************************************************************
    /**
     * Method to insert New ATC drug code
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_drugatc_code($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting drug_atc";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into drug_atc
        if(isset($data_array['drug_atc_id'])){$this->db->set('drug_atc_id', (string)$data_array['drug_atc_id']);}
        if(isset($data_array['atc_code'])){$this->db->set('atc_code', (string)$data_array['atc_code']);}
        if(isset($data_array['atc_anatomical'])){$this->db->set('atc_anatomical', (string)$data_array['atc_anatomical']);}
        if(isset($data_array['atc_therapeutic'])){$this->db->set('atc_therapeutic', (string)$data_array['atc_therapeutic']);}
        if(isset($data_array['atc_pharmaco'])){$this->db->set('atc_pharmaco', (string)$data_array['atc_pharmaco']);}
        if(isset($data_array['atc_chemical'])){$this->db->set('atc_chemical', (string)$data_array['atc_chemical']);}
        if(isset($data_array['desc_anatomical'])){$this->db->set('desc_anatomical', $data_array['desc_anatomical']);}
        if(isset($data_array['desc_therapeutic'])){$this->db->set('desc_therapeutic', $data_array['desc_therapeutic']);}
        if(isset($data_array['desc_pharmaco'])){$this->db->set('desc_pharmaco', $data_array['desc_pharmaco']);}
        if(isset($data_array['desc_chemical'])){$this->db->set('desc_chemical', $data_array['desc_chemical']);}
        if(isset($data_array['atc_name'])){$this->db->set('atc_name', (string)$data_array['atc_name']);}
        if(isset($data_array['ddd_qty'])){$this->db->set('ddd_qty', $data_array['ddd_qty']);}
        if(isset($data_array['ddd_unit'])){$this->db->set('ddd_unit', $data_array['ddd_unit']);}
        if(isset($data_array['admin_route'])){$this->db->set('admin_route', $data_array['admin_route']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['drug_interaction'])){$this->db->set('drug_interaction', $data_array['drug_interaction']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('drug_atc');
        //echo $this->db->last_query();
        //echo "<br />Inserted into drug_atc";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_drugatc_code($data_array)


    //************************************************************************
    /**
     * Method to insert New drug_formulary
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_drugformulary($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting drug_formulary";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into drug_formulary
        if(isset($data_array['drug_formulary_id'])){$this->db->set('drug_formulary_id', $data_array['drug_formulary_id']);}
        if(isset($data_array['formulary_code'])){$this->db->set('formulary_code', $data_array['formulary_code']);}
        if(isset($data_array['atc_code'])){$this->db->set('atc_code', $data_array['atc_code']);}
        if(isset($data_array['generic_name'])){$this->db->set('generic_name', $data_array['generic_name']);}
        if(isset($data_array['trade_name'])){$this->db->set('trade_name', $data_array['trade_name']);}
        if(isset($data_array['formulary_system'])){$this->db->set('formulary_system', $data_array['formulary_system']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['usfda_preg_cat'])){$this->db->set('usfda_preg_cat', $data_array['usfda_preg_cat']);}
        if(isset($data_array['poison_cat'])){$this->db->set('poison_cat', $data_array['poison_cat']);}
        if(isset($data_array['dose_form'])){$this->db->set('dose_form', $data_array['dose_form']);}
        if(isset($data_array['indication'])){$this->db->set('indication', $data_array['indication']);}
        if(isset($data_array['dosage'])){$this->db->set('dosage', $data_array['dosage']);}
        if(isset($data_array['contra_indication'])){$this->db->set('contra_indication', $data_array['contra_indication']);}
        if(isset($data_array['precautions'])){$this->db->set('precautions', $data_array['precautions']);}
        if(isset($data_array['interactions'])){$this->db->set('interactions', $data_array['interactions']);}
        if(isset($data_array['adverse_reactions'])){$this->db->set('adverse_reactions', $data_array['adverse_reactions']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
        if(isset($data_array['formulary_active'])){$this->db->set('formulary_active', $data_array['formulary_active']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('drug_formulary');
        //echo $this->db->last_query();
        //echo "<br />Inserted into drug_formulary";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_drugformulary($data_array)


    //************************************************************************
    /**
     * Method to insert New drug_code
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_drugcode($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting drug_formulary";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into drug_code
        if(isset($data_array['drug_code_id'])){$this->db->set('drug_code_id', $data_array['drug_code_id']);}
        if(isset($data_array['drug_locale'])){$this->db->set('drug_locale', $data_array['drug_locale']);}
        if(isset($data_array['drug_code'])){$this->db->set('drug_code', $data_array['drug_code']);}
        if(isset($data_array['drug_formulary_code'])){$this->db->set('drug_formulary_code', $data_array['drug_formulary_code']);}
        if(isset($data_array['drug_formulary_id'])){$this->db->set('drug_formulary_id', $data_array['drug_formulary_id']);}
        if(isset($data_array['atc_code'])){$this->db->set('atc_code', $data_array['atc_code']);}
        if(isset($data_array['generic_name'])){$this->db->set('generic_name', $data_array['generic_name']);}
        if(isset($data_array['trade_name'])){$this->db->set('trade_name', $data_array['trade_name']);}
        if(isset($data_array['drug_system'])){$this->db->set('drug_system', $data_array['drug_system']);}
        if(isset($data_array['pbkd_no'])){$this->db->set('pbkd_no', $data_array['pbkd_no']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['usfda_preg_cat'])){$this->db->set('usfda_preg_cat', $data_array['usfda_preg_cat']);}
        if(isset($data_array['poison_cat'])){$this->db->set('poison_cat', $data_array['poison_cat']);}
        if(isset($data_array['immunisation_drug_id'])){$this->db->set('immunisation_drug_id', $data_array['immunisation_drug_id']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
		// Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('drug_code');
        //echo $this->db->last_query();
        //echo "<br />Inserted into drug_code";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_drugcode($data_array)


    //************************************************************************
    /**
     * Method to insert New immunisation code
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_immunisationcode($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting immunisation";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into icpc2_symptom
        if(isset($data_array['immunisation_id'])){$this->db->set('immunisation_id', $data_array['immunisation_id']);}
        if(isset($data_array['vaccine_short'])){$this->db->set('vaccine_short', $data_array['vaccine_short']);}
        if(isset($data_array['vaccine'])){$this->db->set('vaccine', $data_array['vaccine']);}
        if(isset($data_array['dose'])){$this->db->set('dose', $data_array['dose']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['immunisation_sort'])){$this->db->set('immunisation_sort', $data_array['immunisation_sort']);}
        if(isset($data_array['age_group'])){$this->db->set('age_group', $data_array['age_group']);}
        if(isset($data_array['dose_frequency'])){$this->db->set('dose_frequency', $data_array['dose_frequency']);}
        if(isset($data_array['adverse_events'])){$this->db->set('adverse_events', $data_array['adverse_events']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['immunisation_code'])){$this->db->set('immunisation_code', $data_array['immunisation_code']);}
		// Perform db insert
        echo $this->db->_compile_select();
        $this->db->insert('immunisation');
        //echo $this->db->last_query();
        //echo "<br />Inserted into immunisation";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_immunisationcode($data_array)


    //************************************************************************
    /**
     * Method to insert New immunisation drug
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_immunisationdrug($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting immunisation";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into immunisation_drug
        if(isset($data_array['immunisation_drug_id'])){$this->db->set('immunisation_drug_id', $data_array['immunisation_drug_id']);}
        if(isset($data_array['vaccine_short'])){$this->db->set('vaccine_short', $data_array['vaccine_short']);}
        if(isset($data_array['immunisation_id'])){$this->db->set('immunisation_id', $data_array['immunisation_id']);}
        if(isset($data_array['drug_formulary_id'])){$this->db->set('drug_formulary_id', $data_array['drug_formulary_id']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
		// Perform db insert
        $this->db->insert('immunisation_drug');
        //echo $this->db->last_query();
        //echo "<br />Inserted into immunisation_drug";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_immunisationdrug($data_array)


    //===============================================================
    // Update Database Methods
	//************************************************************************
    /**
     * Method to update_village_info
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_village_info($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        $this->db->set('addr_town_id', $data_array['addr_town_id']);
        $this->db->set('addr_area_id', $data_array['addr_area_id']);
        $this->db->set('addr_village_name', $data_array['addr_village_name']);
        $this->db->set('addr_village_code', $data_array['addr_village_code']);
        $this->db->set('addr_village_subcode', $data_array['addr_village_subcode']);
        if(isset($data_array['addr_village_sort'])){$this->db->set('addr_village_sort', $data_array['addr_village_sort']);}
        //$this->db->set('addr_village_sort', $data_array['addr_village_sort']);
        $this->db->set('addr_village_descr', $data_array['addr_village_descr']);
        $this->db->set('addr_village_section', $data_array['addr_village_section']);
        $this->db->set('addr_village_address1', $data_array['addr_village_address1']);
        $this->db->set('addr_village_address2', $data_array['addr_village_address2']);
        $this->db->set('addr_village_address3', $data_array['addr_village_address3']);
        $this->db->set('addr_village_postcode', $data_array['addr_village_postcode']);
        $this->db->set('addr_village_town', $data_array['addr_village_town']);
        $this->db->set('addr_village_state', $data_array['addr_village_state']);
        $this->db->set('addr_village_country', $data_array['addr_village_country']);
        $this->db->set('addr_village_tel', $data_array['addr_village_tel']);
        $this->db->set('addr_village_fax', $data_array['addr_village_fax']);
        $this->db->set('addr_village_email', $data_array['addr_village_email']);
        $this->db->set('addr_village_mgr1_position', $data_array['addr_village_mgr1_position']);
        $this->db->set('addr_village_mgr1_name', $data_array['addr_village_mgr1_name']);
        $this->db->set('addr_village_mgr2_position', $data_array['addr_village_mgr2_position']);
        $this->db->set('addr_village_mgr2_name', $data_array['addr_village_mgr2_name']);
        $this->db->set('addr_village_gps_lat', $data_array['addr_village_gps_lat']);
        $this->db->set('addr_village_gps_long', $data_array['addr_village_gps_long']);
        if(isset($data_array['addr_village_population'])){$this->db->set('addr_village_population', $data_array['addr_village_population']);}
        //$this->db->set('addr_village_population', $data_array['addr_village_population']);
        $this->db->where('addr_village_id', $data_array['addr_village_id']);
        $this->db->update('addr_village');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_village_info($data_array)


	//************************************************************************
    /**
     * Method to update_town_info
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_town_info($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        $this->db->set('addr_area_id', $data_array['addr_area_id']);
        $this->db->set('addr_district_id', $data_array['addr_district_id']);
        $this->db->set('addr_town_name', $data_array['addr_town_name']);
        $this->db->set('addr_town_code', $data_array['addr_town_code']);
        $this->db->set('addr_town_subcode', $data_array['addr_town_subcode']);
        if(isset($data_array['addr_town_sort'])){$this->db->set('addr_town_sort', $data_array['addr_town_sort']);}
        //$this->db->set('addr_town_sort', $data_array['addr_town_sort']);
        $this->db->set('addr_town_descr', $data_array['addr_town_descr']);
        $this->db->set('addr_town_section', $data_array['addr_town_section']);
        $this->db->set('addr_town_address1', $data_array['addr_town_address1']);
        $this->db->set('addr_town_address2', $data_array['addr_town_address2']);
        $this->db->set('addr_town_address3', $data_array['addr_town_address3']);
        $this->db->set('addr_town_postcode', $data_array['addr_town_postcode']);
        $this->db->set('addr_town_town', $data_array['addr_town_town']);
        $this->db->set('addr_town_state', $data_array['addr_town_state']);
        $this->db->set('addr_town_country', $data_array['addr_town_country']);
        $this->db->set('addr_town_tel', $data_array['addr_town_tel']);
        $this->db->set('addr_town_fax', $data_array['addr_town_fax']);
        $this->db->set('addr_town_email', $data_array['addr_town_email']);
        $this->db->set('addr_town_mgr1_position', $data_array['addr_town_mgr1_position']);
        $this->db->set('addr_town_mgr1_name', $data_array['addr_town_mgr1_name']);
        $this->db->set('addr_town_mgr2_position', $data_array['addr_town_mgr2_position']);
        $this->db->set('addr_town_mgr2_name', $data_array['addr_town_mgr2_name']);
        if(isset($data_array['addr_town_population'])){$this->db->set('addr_town_population', $data_array['addr_town_population']);}
        //$this->db->set('addr_town_population', $data_array['addr_town_population']);
        $this->db->where('addr_town_id', $data_array['addr_town_id']);
        $this->db->update('addr_town');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_town_info($data_array)


	//************************************************************************
    /**
     * Method to update_area_info
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_area_info($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        $this->db->set('addr_district_id', $data_array['addr_district_id']);
        $this->db->set('addr_area_name', $data_array['addr_area_name']);
        $this->db->set('addr_area_code', $data_array['addr_area_code']);
        $this->db->set('addr_area_subcode', $data_array['addr_area_subcode']);
        if(isset($data_array['addr_area_sort'])){$this->db->set('addr_area_sort', $data_array['addr_area_sort']);}
        //$this->db->set('addr_area_sort', $data_array['addr_area_sort']);
        $this->db->set('addr_area_descr', $data_array['addr_area_descr']);
        $this->db->set('addr_area_section', $data_array['addr_area_section']);
        $this->db->set('addr_area_address1', $data_array['addr_area_address1']);
        $this->db->set('addr_area_address2', $data_array['addr_area_address2']);
        $this->db->set('addr_area_address3', $data_array['addr_area_address3']);
        $this->db->set('addr_area_postcode', $data_array['addr_area_postcode']);
        $this->db->set('addr_area_town', $data_array['addr_area_town']);
        $this->db->set('addr_area_state', $data_array['addr_area_state']);
        $this->db->set('addr_area_country', $data_array['addr_area_country']);
        $this->db->set('addr_area_tel', $data_array['addr_area_tel']);
        $this->db->set('addr_area_fax', $data_array['addr_area_fax']);
        $this->db->set('addr_area_email', $data_array['addr_area_email']);
        $this->db->set('addr_area_mgr1_position', $data_array['addr_area_mgr1_position']);
        $this->db->set('addr_area_mgr1_name', $data_array['addr_area_mgr1_name']);
        $this->db->set('addr_area_mgr2_position', $data_array['addr_area_mgr2_position']);
        $this->db->set('addr_area_mgr2_name', $data_array['addr_area_mgr2_name']);
        if(isset($data_array['addr_area_population'])){$this->db->set('addr_area_population', $data_array['addr_area_population']);}
        //$this->db->set('addr_area_population', $data_array['addr_area_population']);
        $this->db->where('addr_area_id', $data_array['addr_area_id']);
        $this->db->update('addr_area');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_area_info($data_array)


	//************************************************************************
    /**
     * Method to update_district_info
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_district_info($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        $this->db->set('addr_state_id', $data_array['addr_state_id']);
        $this->db->set('addr_district_name', $data_array['addr_district_name']);
        $this->db->set('addr_district_code', $data_array['addr_district_code']);
        $this->db->set('addr_district_subcode', $data_array['addr_district_subcode']);
        if(isset($data_array['addr_district_sort'])){$this->db->set('addr_district_sort', $data_array['addr_district_sort']);}
        $this->db->set('addr_district_descr', $data_array['addr_district_descr']);
        $this->db->set('addr_district_section', $data_array['addr_district_section']);
        $this->db->set('addr_district_address1', $data_array['addr_district_address1']);
        $this->db->set('addr_district_address2', $data_array['addr_district_address2']);
        $this->db->set('addr_district_address3', $data_array['addr_district_address3']);
        $this->db->set('addr_district_postcode', $data_array['addr_district_postcode']);
        $this->db->set('addr_district_town', $data_array['addr_district_town']);
        $this->db->set('addr_district_state', $data_array['addr_district_state']);
        $this->db->set('addr_district_country', $data_array['addr_district_country']);
        $this->db->set('addr_district_tel', $data_array['addr_district_tel']);
        $this->db->set('addr_district_fax', $data_array['addr_district_fax']);
        $this->db->set('addr_district_email', $data_array['addr_district_email']);
        $this->db->set('addr_district_mgr1_position', $data_array['addr_district_mgr1_position']);
        $this->db->set('addr_district_mgr1_name', $data_array['addr_district_mgr1_name']);
        $this->db->set('addr_district_mgr2_position', $data_array['addr_district_mgr2_positionv']);
        $this->db->set('addr_district_mgr2_name', $data_array['addr_district_mgr2_name']);
        if(isset($data_array['addr_district_population'])){$this->db->set('addr_district_population', $data_array['addr_district_population']);}
        //$this->db->set('addr_area_population', $data_array['addr_area_population']);
        $this->db->where('addr_district_id', $data_array['addr_district_id']);
        $this->db->update('addr_district');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_district_info($data_array)


	//************************************************************************
    /**
     * Method to update_state_info
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_state_info($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        $this->db->set('addr_state_id', $data_array['addr_state_id']);
        $this->db->set('addr_state_name', $data_array['addr_state_name']);
        $this->db->set('addr_state_code', $data_array['addr_state_code']);
        $this->db->set('addr_state_subcode', $data_array['addr_state_subcode']);
        if(isset($data_array['addr_state_sort'])){$this->db->set('addr_state_sort', $data_array['addr_state_sort']);}
        $this->db->set('addr_state_descr', $data_array['addr_state_descr']);
        $this->db->set('addr_state_section', $data_array['addr_state_section']);
        $this->db->set('addr_state_address1', $data_array['addr_state_address1']);
        $this->db->set('addr_state_address2', $data_array['addr_state_address2']);
        $this->db->set('addr_state_address3', $data_array['addr_state_address3']);
        $this->db->set('addr_state_postcode', $data_array['addr_state_postcode']);
        $this->db->set('addr_state_town', $data_array['addr_state_town']);
        $this->db->set('addr_state_state', $data_array['addr_state_state']);
        $this->db->set('addr_state_country', $data_array['addr_state_country']);
        $this->db->set('addr_state_tel', $data_array['addr_state_tel']);
        $this->db->set('addr_state_fax', $data_array['addr_state_fax']);
        $this->db->set('addr_state_email', $data_array['addr_state_email']);
        $this->db->set('addr_state_mgr1_position', $data_array['addr_state_mgr1_position']);
        $this->db->set('addr_state_mgr1_name', $data_array['addr_state_mgr1_name']);
        $this->db->set('addr_state_mgr2_position', $data_array['addr_state_mgr2_position']);
        $this->db->set('addr_state_mgr2_name', $data_array['addr_state_mgr2_name']);
        $this->db->where('addr_state_id', $data_array['addr_state_id']);
        $this->db->update('addr_state');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_state_info($data_array)


	//************************************************************************
    /**
     * Method to update_complaint_code
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_complaint_code($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['component'])){$this->db->set('component', $data_array['component']);}
        if(isset($data_array['full_description'])){$this->db->set('full_description', $data_array['full_description']);}
        if(isset($data_array['short_description'])){$this->db->set('short_description', $data_array['short_description']);}
        if(isset($data_array['icd_10'])){$this->db->set('icd_10', $data_array['icd_10']);}
        if(isset($data_array['criteria'])){$this->db->set('criteria', $data_array['criteria']);}
        if(isset($data_array['inclusion_criteria'])){$this->db->set('inclusion_criteria', $data_array['inclusion_criteria']);}
        if(isset($data_array['exclusion_criteria'])){$this->db->set('exclusion_criteria', $data_array['exclusion_criteria']);}
        if(isset($data_array['consideration'])){$this->db->set('consideration', $data_array['consideration']);}
        if(isset($data_array['note'])){$this->db->set('note', $data_array['note']);}
        $this->db->where('icpc_code', $data_array['icpc_code']);
        $this->db->update('icpc2_symptom');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_complaint_code($data_array)


	//************************************************************************
    /**
     * Method to update_dcode1
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_dcode1($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['dcode1set'])){$this->db->set('dcode1set', $data_array['dcode1set']);}
        if(isset($data_array['dcode1_code'])){$this->db->set('dcode1_code', $data_array['dcode1_code']);}
        if(isset($data_array['component'])){$this->db->set('component', $data_array['component']);}
        if(isset($data_array['code_use'])){$this->db->set('code_use', $data_array['code_use']);}
        if(isset($data_array['chapter'])){$this->db->set('chapter', $data_array['chapter']);}
        if(isset($data_array['topic'])){$this->db->set('topic', $data_array['topic']);}
        if(isset($data_array['full_title'])){$this->db->set('full_title', $data_array['full_title']);}
        if(isset($data_array['short_title'])){$this->db->set('short_title', $data_array['short_title']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['dcode2_maps'])){$this->db->set('dcode2_maps', $data_array['dcode2_maps']);}
        if(isset($data_array['criteria'])){$this->db->set('criteria', $data_array['criteria']);}
        if(isset($data_array['inclusion_criteria'])){$this->db->set('inclusion_criteria', $data_array['inclusion_criteria']);}
        if(isset($data_array['exclusion_criteria'])){$this->db->set('exclusion_criteria', $data_array['exclusion_criteria']);}
        if(isset($data_array['consideration'])){$this->db->set('consideration', $data_array['consideration']);}
        if(isset($data_array['note'])){$this->db->set('note', $data_array['note']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['dcode1_x01'])){$this->db->set('dcode1_x01', $data_array['dcode1_x01']);}
        if(isset($data_array['dcode1_x02'])){$this->db->set('dcode1_x02', $data_array['dcode1_x02']);}
        if(isset($data_array['dcode1_x03'])){$this->db->set('dcode1_x03', $data_array['dcode1_x03']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['dcode1_active'])){$this->db->set('dcode1_active', $data_array['dcode1_active']);}
        if(isset($data_array['edit_remarks'])){$this->db->set('edit_remarks', $data_array['edit_remarks']);}
        if(isset($data_array['edit_staff'])){$this->db->set('edit_staff', $data_array['edit_staff']);}
        if(isset($data_array['edit_date'])){$this->db->set('edit_date', $data_array['edit_date']);}
        if(isset($data_array['delete_remarks'])){$this->db->set('delete_remarks', $data_array['delete_remarks']);}
        if(isset($data_array['delete_staff'])){$this->db->set('delete_staff', $data_array['delete_staff']);}
        if(isset($data_array['delete_date'])){$this->db->set('delete_date', $data_array['delete_date']);}
        if(isset($data_array['patch_remarks'])){$this->db->set('patch_remarks', $data_array['patch_remarks']);}
        if(isset($data_array['patch_version'])){$this->db->set('patch_version', $data_array['patch_version']);}
        if(isset($data_array['patch_date'])){$this->db->set('patch_date', $data_array['patch_date']);}
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        $this->db->where('dcode1_id', $data_array['dcode1_id']);
        $this->db->update('dcode1');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_dcode1($data_array)


	//************************************************************************
    /**
     * Method to update_dcode1ext
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_dcode1ext($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        //if(isset($data_array['dcode1_id'])){$this->db->set('dcode1_id', $data_array['dcode1_id']);}
        //if(isset($data_array['dcode1set'])){$this->db->set('dcode1set', $data_array['dcode1set']);}
        if(isset($data_array['dcode1ext_code'])){$this->db->set('dcode1ext_code', $data_array['dcode1ext_code']);}
        if(isset($data_array['dcode1ext_longname'])){$this->db->set('dcode1ext_longname', $data_array['dcode1ext_longname']);}
        if(isset($data_array['dcode1ext_shortname'])){$this->db->set('dcode1ext_shortname', $data_array['dcode1ext_shortname']);}
        if(isset($data_array['component'])){$this->db->set('component', $data_array['component']);}
        if(isset($data_array['code_use'])){$this->db->set('code_use', $data_array['code_use']);}
        if(isset($data_array['chapter'])){$this->db->set('chapter', $data_array['chapter']);}
        if(isset($data_array['topic'])){$this->db->set('topic', $data_array['topic']);}
        if(isset($data_array['full_title'])){$this->db->set('full_title', $data_array['full_title']);}
        if(isset($data_array['short_title'])){$this->db->set('short_title', $data_array['short_title']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['dcode2maps'])){$this->db->set('dcode2maps', $data_array['dcode2maps']);}
        if(isset($data_array['criteria'])){$this->db->set('criteria', $data_array['criteria']);}
        if(isset($data_array['inclusion_criteria'])){$this->db->set('inclusion_criteria', $data_array['inclusion_criteria']);}
        if(isset($data_array['exclusion_criteria'])){$this->db->set('exclusion_criteria', $data_array['exclusion_criteria']);}
        if(isset($data_array['consideration'])){$this->db->set('consideration', $data_array['consideration']);}
        if(isset($data_array['note'])){$this->db->set('note', $data_array['note']);}
        if(isset($data_array['dcode1ext_notify'])){$this->db->set('dcode1ext_notify', $data_array['dcode1ext_notify']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['dcode1ext_x01'])){$this->db->set('dcode1ext_x01', $data_array['dcode1ext_x01']);}
        if(isset($data_array['dcode1ext_x02'])){$this->db->set('dcode1ext_x02', $data_array['dcode1ext_x02']);}
        if(isset($data_array['dcode1ext_x03'])){$this->db->set('dcode1ext_x03', $data_array['dcode1ext_x03']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['dcode1ext_active'])){$this->db->set('dcode1ext_active', $data_array['dcode1ext_active']);}
        if(isset($data_array['edit_remarks'])){$this->db->set('edit_remarks', $data_array['edit_remarks']);}
        if(isset($data_array['edit_staff'])){$this->db->set('edit_staff', $data_array['edit_staff']);}
        if(isset($data_array['edit_date'])){$this->db->set('edit_date', $data_array['edit_date']);}
        $this->db->where('dcode1ext_id', $data_array['dcode1ext_id']);
        $this->db->update('dcode1ext');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_dcode1ext($data_array)


	//************************************************************************
    /**
     * Method to update_drug_atc
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_drugatc_code($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['atc_code'])){$this->db->set('atc_code', $data_array['atc_code']);}
        if(isset($data_array['atc_anatomical'])){$this->db->set('atc_anatomical', $data_array['atc_anatomical']);}
        if(isset($data_array['atc_therapeutic'])){$this->db->set('atc_therapeutic', $data_array['atc_therapeutic']);}
        if(isset($data_array['atc_pharmaco'])){$this->db->set('atc_pharmaco', $data_array['atc_pharmaco']);}
        if(isset($data_array['atc_chemical'])){$this->db->set('atc_chemical', $data_array['atc_chemical']);}
        if(isset($data_array['desc_anatomical'])){$this->db->set('desc_anatomical', $data_array['desc_anatomical']);}
        if(isset($data_array['desc_therapeutic'])){$this->db->set('desc_therapeutic', $data_array['desc_therapeutic']);}
        if(isset($data_array['desc_pharmaco'])){$this->db->set('desc_pharmaco', $data_array['desc_pharmaco']);}
        if(isset($data_array['desc_chemical'])){$this->db->set('desc_chemical', $data_array['desc_chemical']);}
        if(isset($data_array['atc_name'])){$this->db->set('atc_name', $data_array['atc_name']);}
        if(isset($data_array['ddd_qty'])){$this->db->set('ddd_qty', (float)$data_array['ddd_qty']);}
        if(isset($data_array['ddd_unit'])){$this->db->set('ddd_unit', $data_array['ddd_unit']);}
        if(isset($data_array['admin_route'])){$this->db->set('admin_route', $data_array['admin_route']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['drug_interaction'])){$this->db->set('drug_interaction', $data_array['drug_interaction']);}
        $this->db->where('drug_atc_id', $data_array['drug_atc_id']);
        $this->db->update('drug_atc');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_drugatc_code($data_array)


	//************************************************************************
    /**
     * Method to update_drug_formulary
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_drug_formulary($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['formulary_code'])){$this->db->set('formulary_code', $data_array['formulary_code']);}
        if(isset($data_array['atc_code'])){$this->db->set('atc_code', $data_array['atc_code']);}
        if(isset($data_array['generic_name'])){$this->db->set('generic_name', $data_array['generic_name']);}
        if(isset($data_array['trade_name'])){$this->db->set('trade_name', $data_array['trade_name']);}
        if(isset($data_array['formulary_system'])){$this->db->set('formulary_system', $data_array['formulary_system']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['usfda_preg_cat'])){$this->db->set('usfda_preg_cat', $data_array['usfda_preg_cat']);}
        if(isset($data_array['poison_cat'])){$this->db->set('poison_cat', $data_array['poison_cat']);}
        if(isset($data_array['dose_form'])){$this->db->set('dose_form', $data_array['dose_form']);}
        if(isset($data_array['indication'])){$this->db->set('indication', $data_array['indication']);}
        if(isset($data_array['dosage'])){$this->db->set('dosage', $data_array['dosage']);}
        if(isset($data_array['contra_indication'])){$this->db->set('contra_indication', $data_array['contra_indication']);}
        if(isset($data_array['precautions'])){$this->db->set('precautions', $data_array['precautions']);}
        if(isset($data_array['interactions'])){$this->db->set('interactions', $data_array['interactions']);}
        if(isset($data_array['adverse_reactions'])){$this->db->set('adverse_reactions', $data_array['adverse_reactions']);}
        $this->db->where('drug_formulary_id', $data_array['drug_formulary_id']);
        $this->db->update('drug_formulary');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_drug_formulary($data_array)


	//************************************************************************
    /**
     * Method to update_drug_code
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_drug_code($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['drug_locale'])){$this->db->set('drug_locale', $data_array['drug_locale']);}
        if(isset($data_array['drug_code'])){$this->db->set('drug_code', $data_array['drug_code']);}
        if(isset($data_array['drug_formulary_code'])){$this->db->set('drug_formulary_code', $data_array['drug_formulary_code']);}
        if(isset($data_array['drug_formulary_id'])){$this->db->set('drug_formulary_id', $data_array['drug_formulary_id']);}
        if(isset($data_array['atc_code'])){$this->db->set('atc_code', $data_array['atc_code']);}
        if(isset($data_array['generic_name'])){$this->db->set('generic_name', $data_array['generic_name']);}
        if(isset($data_array['trade_name'])){$this->db->set('trade_name', $data_array['trade_name']);}
        if(isset($data_array['drug_system'])){$this->db->set('drug_system', $data_array['drug_system']);}
        if(isset($data_array['pbkd_no'])){$this->db->set('pbkd_no', $data_array['pbkd_no']);}
        if(isset($data_array['commonly_used'])){$this->db->set('commonly_used', $data_array['commonly_used']);}
        if(isset($data_array['usfda_preg_cat'])){$this->db->set('usfda_preg_cat', $data_array['usfda_preg_cat']);}
        if(isset($data_array['poison_cat'])){$this->db->set('poison_cat', $data_array['poison_cat']);}
        if(isset($data_array['immunisation_drug_id'])){$this->db->set('immunisation_drug_id', $data_array['immunisation_drug_id']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
        $this->db->where('drug_code_id', $data_array['drug_code_id']);
        $this->db->update('drug_code');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_drug_code($data_array)


	//************************************************************************
    /**
     * Method to update_immunisation_code
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_immunisation_code($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['vaccine_short'])){$this->db->set('vaccine_short', $data_array['vaccine_short']);}
        if(isset($data_array['vaccine'])){$this->db->set('vaccine', $data_array['vaccine']);}
        if(isset($data_array['dose'])){$this->db->set('dose', $data_array['dose']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['immunisation_sort'])){$this->db->set('immunisation_sort', $data_array['immunisation_sort']);}
        if(isset($data_array['age_group'])){$this->db->set('age_group', $data_array['age_group']);}
        if(isset($data_array['dose_frequency'])){$this->db->set('dose_frequency', $data_array['dose_frequency']);}
        if(isset($data_array['adverse_events'])){$this->db->set('adverse_events', $data_array['adverse_events']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['immunisation_code'])){$this->db->set('immunisation_code', $data_array['immunisation_code']);}
        $this->db->where('immunisation_id', $data_array['immunisation_id']);
        $this->db->update('immunisation');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_immunisation_code($data_array)


}

/* End of file mutil_wdb.php */
/* Location: ./app_thirra/models/mutil_wdb.php */
