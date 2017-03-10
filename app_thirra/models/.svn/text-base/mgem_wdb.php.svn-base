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

class MGem_wdb extends CI_Model
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
     * Method to insert New Booking
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_gem_consult($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting imaging order";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Begin transaction
        $this->db->trans_begin();
        
        // Insert into gem_session
        if(isset($data_array['gem_session_id'])){$this->db->set('gem_session_id', $data_array['gem_session_id']);}
        if(isset($data_array['summary_id'])){$this->db->set('summary_id', $data_array['summary_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['gem_module_id'])){$this->db->set('gem_module_id', $data_array['gem_module_id']);}
        if(isset($data_array['gem_submod_id'])){$this->db->set('gem_submod_id', $data_array['gem_submod_id']);}
        if(isset($data_array['gem_agegroup_id'])){$this->db->set('gem_agegroup_id', $data_array['gem_agegroup_id']);}
        if(isset($data_array['gem_agegroup'])){$this->db->set('gem_agegroup', $data_array['gem_agegroup']);}
        if(isset($data_array['gem_session_remarks'])){$this->db->set('gem_session_remarks', $data_array['gem_session_remarks']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
        // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('gem_session');
        //echo $this->db->last_query();
        //echo "<br />Inserted into gem_session";
        //echo "Inserted<br />";
        
        // Insert into gem_conanswer
        // Perform db insert
        $gem_conanswer_id   =   $data_array['now_id'];
        foreach($data_array['answers'] as $answer) {
            $gem_conanswer_id++;
            $this->db->set('gem_conanswer_id', $gem_conanswer_id);
            if(isset($data_array['gem_submod_id'])){$this->db->set('gem_submod_id', $data_array['gem_submod_id']);}
            if(isset($answer['modqid'])){$this->db->set('gem_modque', $answer['modqid']);}
            if(isset($data_array['gem_session_id'])){$this->db->set('gem_session_id', $data_array['gem_session_id']);}
            $this->db->set('gem_showquest', TRUE);
            //if(isset($answer['gem_showquest'])){$this->db->set('gem_showquest', $answer['gem_showquest']);}
            if(isset($answer['cast'])){$this->db->set('gem_ans_type', $answer['cast']);}
            if(isset($answer['answer'])){$this->db->set('gem_conanswer', $answer['answer']);}
            if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
            if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
            if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
            //echo $this->db->_compile_select();
            $this->db->insert('gem_conanswer');
            //echo $this->db->last_query();
            //echo "<br />Inserted into gem_conanswer";
            
            // Extra work for cast EHR
            if($answer['cast'] == "E"){
                if(isset($answer['gem_quest_looktable'])){$this->db->set($answer['gem_quest_lookfield'], $answer['answer']);}
                $this->db->where($answer['gem_quest_lookkey'], $answer['gem_key_value']);
                $this->db->update($answer['gem_quest_looktable']);
                //echo $this->db->last_query();
            } //endif($answer['cast'] == "E")
        }
            
        //echo "Inserted<br />";

        // End transaction
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            echo "<br /><br />Some errors were found. Module not completed.";
        } else {
            $this->db->trans_commit();
            //echo "<br /><br />No errors found. Patient registration completed.";
        }
        //echo "<hr />";
    } // end of function insert_new_gem_consult($data_array)


    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update submodule
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_gem_consult($data_array)
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
        foreach($data_array['answers'] as $answer) {
            //$this->db->set('gem_showquest', $data_array['gem_showquest']);
            $this->db->set('gem_conanswer', $answer['answer']);
            if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
            if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
            if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
            $this->db->where('gem_session_id', $data_array['gem_session_id']);
            $this->db->where('gem_modque', $answer['modqid']);
            $this->db->update('gem_conanswer');
            /*
            $sqlQuery   =   "UPDATE gem_conanswer SET ";
            $sqlQuery   .=  " gem_conanswer='".$answer['answer']."'";
            $sqlQuery   .=  " WHERE gem_session_id='".$data_array['gem_session_id']."'";
            $sqlQuery   .=  " AND gem_modque='".$answer['modqid']."'";
            //echo "<br />".$sqlQuery;
            $Q =  $this->db->query($sqlQuery);
            */
            //echo $this->db->last_query();
            //echo "Updated<br />";
            //echo "<hr />";
            //return $data;    
            
            // Extra work for cast EHR
            if($answer['cast'] == "E"){
                if(isset($answer['gem_quest_looktable'])){$this->db->set($answer['gem_quest_lookfield'], $answer['answer']);}
                $this->db->where($answer['gem_quest_lookkey'], $answer['gem_key_value']);
                $this->db->update($answer['gem_quest_looktable']);
                //echo $this->db->last_query();
            } //endif($answer['cast'] == "E")
        }
    } // end of function update_gem_consult($data_array)


    //************************************************************************
    /**
     * Method to update_room
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_room($data_array)
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
        $this->db->set('category_id', $data_array['category_id']);
        $this->db->set('name', $data_array['room_name']);
        $this->db->set('description', $data_array['description']);
        $this->db->set('location_id', $data_array['location_id']);
        if(isset($data_array['room_rate1'])){$this->db->set('room_rate1', $data_array['room_rate1']);}
        if(isset($data_array['room_rate2'])){$this->db->set('room_rate2', $data_array['room_rate2']);}
        if(isset($data_array['room_rate3'])){$this->db->set('room_rate3', $data_array['room_rate3']);}
        if(isset($data_array['room_cost'])){$this->db->set('room_cost', $data_array['room_cost']);}
        if(isset($data_array['beds_qty'])){$this->db->set('beds_qty', $data_array['beds_qty']);}
        $this->db->set('room_floor', $data_array['room_floor']);
        $this->db->set('clinic_dept_id', $data_array['clinic_dept_id']);
        $this->db->set('room_remarks', $data_array['room_remarks']);
        $this->db->set('room_code', $data_array['room_code']);
        $this->db->where('room_id', $data_array['room_id']);
        $this->db->update('room');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_room($data_array)


    //===============================================================
    // Delete Database Records Methods


}

/* End of file MGem_wdb.php */
/* Location: ./app_thirra/models/MGem_wdb.php */
