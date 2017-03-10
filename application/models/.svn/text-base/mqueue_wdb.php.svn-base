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
 * @version 0.9.8
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MQueue_wdb extends CI_Model
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
    function insert_new_booking($data_array)
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
        // Insert into booking
        if(isset($data_array['booking_id'])){$this->db->set('booking_id', $data_array['booking_id']);}
        if(isset($data_array['room_id'])){$this->db->set('room_id', $data_array['room_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['booking_staff_id'])){$this->db->set('booking_staff_id', $data_array['booking_staff_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['reserve_date'])){$this->db->set('reserve_date', $data_array['reserve_date']);}
        if(isset($data_array['reserve_time'])){$this->db->set('reserve_time', $data_array['reserve_time']);}
        if(isset($data_array['date'])){$this->db->set('date', $data_array['date']);}
        if(isset($data_array['start_time'])){$this->db->set('start_time', $data_array['start_time']);}
        if(isset($data_array['end_time'])){$this->db->set('end_time', $data_array['end_time']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['booking_type'])){$this->db->set('booking_type', $data_array['booking_type']);}
        if(isset($data_array['priority'])){$this->db->set('priority', $data_array['priority']);}
        if(isset($data_array['status'])){$this->db->set('status', $data_array['status']);}
        if(isset($data_array['canceled_reason'])){$this->db->set('canceled_reason', $data_array['canceled_reason']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['previous_session_id'])){$this->db->set('previous_session_id', $data_array['previous_session_id']);}
        if(isset($data_array['external_ref'])){$this->db->set('external_ref', $data_array['external_ref']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('booking');
        //echo $this->db->last_query();
        //echo "<br />Inserted into booking";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_booking($data_array)


    //************************************************************************
    /**
     * Method to insert New room
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_room($data_array)
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
        // Insert into room
        if(isset($data_array['room_id'])){$this->db->set('room_id', $data_array['room_id']);}
        if(isset($data_array['category_id'])){$this->db->set('category_id', $data_array['category_id']);}
        if(isset($data_array['room_name'])){$this->db->set('name', $data_array['room_name']);}
        if(isset($data_array['description'])){$this->db->set('description', $data_array['description']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['room_rate1'])){$this->db->set('room_rate1', $data_array['room_rate1']);}
        if(isset($data_array['room_rate2'])){$this->db->set('room_rate2', $data_array['room_rate2']);}
        if(isset($data_array['room_rate3'])){$this->db->set('room_rate3', $data_array['room_rate3']);}
        if(isset($data_array['room_cost'])){$this->db->set('room_cost', $data_array['room_cost']);}
        if(isset($data_array['beds_qty'])){$this->db->set('beds_qty', $data_array['beds_qty']);}
        if(isset($data_array['room_floor'])){$this->db->set('room_floor', $data_array['room_floor']);}
        if(isset($data_array['clinic_dept_id'])){$this->db->set('clinic_dept_id', $data_array['clinic_dept_id']);}
        if(isset($data_array['room_remarks'])){$this->db->set('room_remarks', $data_array['room_remarks']);}
        if(isset($data_array['room_code'])){$this->db->set('room_code', $data_array['room_code']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('room');
        //echo $this->db->last_query();
        //echo "<br />Inserted into room";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_room($data_array)


    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update bookings
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_booking($data_array)
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
        $this->db->set('room_id', $data_array['room_id']);
        $this->db->set('staff_id', $data_array['staff_id']);
        $this->db->set('booking_staff_id', $data_array['booking_staff_id']);
        $this->db->set('reserve_date', $data_array['reserve_date']);
        $this->db->set('reserve_time', $data_array['reserve_time']);
        $this->db->set('date', $data_array['date']);
        $this->db->set('start_time', $data_array['start_time']);
        $this->db->set('end_time', $data_array['end_time']);
        $this->db->set('remarks', $data_array['remarks']);
        $this->db->set('booking_type', $data_array['booking_type']);
        $this->db->set('priority', $data_array['priority']);
        $this->db->set('status', $data_array['status']);
        if(isset($data_array['canceled_reason'])){$this->db->set('canceled_reason', $data_array['canceled_reason']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['previous_session_id'])){$this->db->set('previous_session_id', $data_array['previous_session_id']);}
        $this->db->set('external_ref', $data_array['external_ref']);
        $this->db->where('booking_id', $data_array['booking_id']);
        $this->db->update('booking');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_booking($data_array)


    //************************************************************************
    /**
     * Method to update bookings
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_booking_post_consult($data_array)
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
        if(isset($data_array['status'])){$this->db->set('status', $data_array['status']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['previous_session_id'])){$this->db->set('previous_session_id', $data_array['previous_session_id']);}
        $this->db->where('booking_id', $data_array['booking_id']);
        $this->db->update('booking');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_booking_post_consult($data_array)


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

/* End of file MQueue_wdb.php */
/* Location: ./app_thirra/models/mqueue_wdb.php */
