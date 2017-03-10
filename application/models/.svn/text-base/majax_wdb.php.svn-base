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
 * @version 0.9.15
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MAjax_wdb extends CI_Model
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



    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update patient demographic info
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_kin_demog_info($data_array)
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
        /*
        (!empty($data_array['next_of_kin_id'])?$this->db->set('next_of_kin_id', $data_array['next_of_kin_id']) :$this->db->set('next_of_kin_id', NULL));
        (isset($data_array['demise_date'])?$this->db->set('demise_date', $data_array['demise_date']) :$this->db->set('demise_date', NULL));
        (isset($data_array['demise_time'])?$this->db->set('demise_time', $data_array['demise_time']) :$this->db->set('demise_time', NULL));
        if(isset($data_array['update_when'])){$this->db->set('update_when', $data_array['update_when']);}
        if(isset($data_array['update_by'])){$this->db->set('update_by', $data_array['update_by']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
    `   */
        if(isset($data_array['ic_no'])){$this->db->set('ic_no', $data_array['ic_no']);}
        if(isset($data_array['birth_date'])){$this->db->set('birth_date', $data_array['birth_date']);}
        if(isset($data_array['job_function'])){$this->db->set('job_function', $data_array['job_function']);}
        $this->db->where('patient_id', $data_array['patient_id']);
        $this->db->update('patient_demographic_info');
        //echo $this->db->last_query();
		
        if(isset($data_array['tel_mobile'])){$this->db->set('tel_mobile', $data_array['tel_mobile']);}
        $this->db->where('contact_id', $data_array['contact_id']);
        $this->db->update('patient_contact_info');
        //echo $this->db->last_query();

        //echo "Updated Patient Demographic Info<br />";
        //echo "<hr />";
    } // end of function update_kin_demog_info($data_array)




    //===============================================================
    // Delete Database Records Methods


}

/* End of file MAjax_wdb.php */
/* Location: ./app_thirra/models/MAjax_wdb.php */
