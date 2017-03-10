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
 * @version 0.9.12
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MRefer_wdb extends CI_Model
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
     * Method to insert New Test Data 
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_test_data($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting imaging order";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        if(isset($data_array['testing_id'])){$this->db->set('testing_id', $data_array['testing_id']);}
        if(isset($data_array['testing1'])){$this->db->set('testing1', $data_array['testing1']);}
        if(isset($data_array['testing2'])){$this->db->set('testing2', $data_array['testing2']);}
        if(isset($data_array['testing3'])){$this->db->set('testing3', $data_array['testing3']);}
        if(isset($data_array['testing4'])){$this->db->set('testing4', $data_array['testing4']);}
        if(isset($data_array['testing5'])){$this->db->set('testing5', $data_array['testing5']);}
		// Insert into patient_referral_in_staging
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('testing');
        //echo $this->db->last_query();
        //echo "<br />Inserted into testing";
		
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_test_data($data_array)


    //************************************************************************
    /**
     * Method to insert New Referral incoming from external clinic  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_referin_staging($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting imaging order";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
		// Insert into patient_referral_in_staging
        if(isset($data_array['referin_staging_id'])){$this->db->set('referin_staging_id', $data_array['referin_staging_id']);}
        if(isset($data_array['referin_filename'])){$this->db->set('referin_filename', $data_array['referin_filename']);}
        if(isset($data_array['staged_time'])){$this->db->set('staged_time', $data_array['staged_time']);}
        if(isset($data_array['staged_by'])){$this->db->set('staged_by', $data_array['staged_by']);}
        if(isset($data_array['staged_reference'])){$this->db->set('staged_reference', $data_array['staged_reference']);}
        if(isset($data_array['staged_sequence'])){$this->db->set('staged_sequence', $data_array['staged_sequence']);}
        if(isset($data_array['import_time'])){$this->db->set('import_time', $data_array['import_time']);}
        if(isset($data_array['import_by'])){$this->db->set('import_by', $data_array['import_by']);}
        if(isset($data_array['import_reference'])){$this->db->set('import_reference', $data_array['import_reference']);}
        if(isset($data_array['import_sequence'])){$this->db->set('import_sequence', $data_array['import_sequence']);}
        if(isset($data_array['referral_in_id'])){$this->db->set('referral_in_id', $data_array['referral_in_id']);}
        if(isset($data_array['refer_version'])){$this->db->set('refer_version', $data_array['refer_version']);}
        if(isset($data_array['refer_to_person'])){$this->db->set('refer_to_person', $data_array['refer_to_person']);}
        if(isset($data_array['refer_to_department'])){$this->db->set('refer_to_department', $data_array['refer_to_department']);}
        if(isset($data_array['refer_to_specialty'])){$this->db->set('refer_to_specialty', $data_array['refer_to_specialty']);}
        if(isset($data_array['refer_clinicname'])){$this->db->set('refer_clinicname', $data_array['refer_clinicname']);}
        if(isset($data_array['refer_clinicid'])){$this->db->set('refer_clinicid', $data_array['refer_clinicid']);}
        if(isset($data_array['refer_clinicref'])){$this->db->set('refer_clinicref', $data_array['refer_clinicref']);}
        if(isset($data_array['refer_person'])){$this->db->set('refer_person', $data_array['refer_person']);}
        if(isset($data_array['refer_position'])){$this->db->set('refer_position', $data_array['refer_position']);}
        if(isset($data_array['refer_department'])){$this->db->set('refer_department', $data_array['refer_department']);}
        if(isset($data_array['refer_specialty'])){$this->db->set('refer_specialty', $data_array['refer_specialty']);}
        if(isset($data_array['refer_staffno'])){$this->db->set('refer_staffno', $data_array['refer_staffno']);}
        if(isset($data_array['refer_reference'])){$this->db->set('refer_reference', $data_array['refer_reference']);}
        if(isset($data_array['refer_reason'])){$this->db->set('refer_reason', $data_array['refer_reason']);}
        if(isset($data_array['refer_clinical_exam'])){$this->db->set('refer_clinical_exam', $data_array['refer_clinical_exam']);}
        if(isset($data_array['refer_remarks'])){$this->db->set('refer_remarks', $data_array['refer_remarks']);}
        if(isset($data_array['import_remarks'])){$this->db->set('import_remarks', $data_array['import_remarks']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['patient_id_refer'])){$this->db->set('patient_id_refer', $data_array['patient_id_refer']);}
        if(isset($data_array['patient_reference'])){$this->db->set('patient_reference', $data_array['patient_reference']);}
        if(isset($data_array['patient_pns_id'])){$this->db->set('patient_pns_id', $data_array['patient_pns_id']);}
        if(isset($data_array['patient_nhfa'])){$this->db->set('patient_nhfa', $data_array['patient_nhfa']);}
        if(isset($data_array['patient_name'])){$this->db->set('patient_name', $data_array['patient_name']);}
        if(isset($data_array['patient_name_first'])){$this->db->set('patient_name_first', $data_array['patient_name_first']);}
        if(isset($data_array['patient_gender'])){$this->db->set('patient_gender', $data_array['patient_gender']);}
        if(isset($data_array['patient_icno'])){$this->db->set('patient_icno', $data_array['patient_icno']);}
        if(isset($data_array['patient_icother_type'])){$this->db->set('patient_icother_type', $data_array['patient_icother_type']);}
        if(isset($data_array['patient_icother_no'])){$this->db->set('patient_icother_no', $data_array['patient_icother_no']);}
        if(isset($data_array['patient_birthdate'])){$this->db->set('patient_birthdate', $data_array['patient_birthdate']);}
        if(isset($data_array['xmlin_string'])){$this->db->set('xmlin_string', $data_array['xmlin_string']);}
        if(isset($data_array['xmlin_mdhash'])){$this->db->set('xmlin_mdhash', $data_array['xmlin_mdhash']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_referral_in_staging');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_referral_in_staging";
		
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_referin_staging($data_array)




    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update patient_referral replies
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_refer_out_reply($data_array)
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
        if(isset($data_array['date_replied'])){$this->db->set('date_replied', $data_array['date_replied']);}
        if(isset($data_array['replying_doctor'])){$this->db->set('replying_doctor', $data_array['replying_doctor']);}
        if(isset($data_array['replying_specialty'])){$this->db->set('replying_specialty', $data_array['replying_specialty']);}
        if(isset($data_array['replying_centre'])){$this->db->set('replying_centre', $data_array['replying_centre']);}
        if(isset($data_array['department'])){$this->db->set('department', $data_array['department']);}
        if(isset($data_array['findings'])){$this->db->set('findings', $data_array['findings']);}
        if(isset($data_array['investigation'])){$this->db->set('investigation', $data_array['investigation']);}
        if(isset($data_array['diagnosis'])){$this->db->set('diagnosis', $data_array['diagnosis']);}
        if(isset($data_array['treatment'])){$this->db->set('treatment', $data_array['treatment']);}
        if(isset($data_array['plan'])){$this->db->set('plan', $data_array['plan']);}
        if(isset($data_array['comments'])){$this->db->set('comments', $data_array['comments']);}
        if(isset($data_array['reply_recorder'])){$this->db->set('reply_recorder', $data_array['reply_recorder']);}
        if(isset($data_array['date_recorded'])){$this->db->set('date_recorded', $data_array['date_recorded']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
        $this->db->where('referral_id', $data_array['referral_id']);
        $this->db->update('patient_referral');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_refer_out_reply($data_array)




    //===============================================================
    // Delete Database Records Methods


}

/* End of file MRefer_wdb.php */
/* Location: ./app_thirra/models/MRefer_wdb.php */
