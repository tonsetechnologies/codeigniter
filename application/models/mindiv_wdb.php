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
 * Portions created by the Initial Developer are Copyright (C) 2010-2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for EHR
 *
 * This class is for models that only writes to the database.
 *
 * @version 1.0.0
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MIndiv_wdb extends CI_Model
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
     * Method to insert New Uploaded File  
     *
     * This method creates a new consultation.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_problem_list($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting pics details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
       */
        // Insert into patient_problem_list
        $this->db->set('problem_list_id', $data_array['problem_list_id']);
        $this->db->set('patient_id', $data_array['patient_id']);
        $this->db->set('staff_id', $data_array['staff_id']);
        $this->db->set('date', $data_array['date']);
        $this->db->set('problem', $data_array['problem']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        // Perform db insert
        $this->db->insert('patient_problem_list');
        //echo $this->db->last_query();
        /*
        echo "<br />Inserted into patient_problem_list";

        echo "<br />Inserted new pics";
        echo "<hr />";
        */
    } // end of function insert_new_problem_list($data_array)





    //===============================================================
    // Update Database Methods


    //===============================================================
    // Delete Database Records Methods


}

/* End of file MIndiv_wdb.php */
/* Location: ./app_thirra/models/MIndiv_wdb.php */
