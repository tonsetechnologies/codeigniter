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
 * Portions created by the Initial Developer are Copyright (C) 2010 - 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for mQueue_rdb
 *
 * This class is for models that only reads from the database.
 *
 * @version 0.9.14
 * @package THIRRA - MQueue_rdb
 * @author  Jason Tan Boon Teck
 */

class MQueue_rdb extends CI_Model
{
    protected $_location_id     =  "";
    protected $_patient_id      =  "";
    protected $_summary_id      =  "";
    protected $_complaint_id    =  "";
    protected $_lab_order_id    =  "";
    protected $_imaging_order_id=  "";
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


    //************************************************************************
    /**
     * Method to retrieve list of patients queueing
     *
     * This method 
     *
	 * @param   string  $location_id    Required  
	 * @param   string  $date           Optional
	 * @param   string  $queue_id       Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patients_queue($location_id=NULL,$date=NULL,$queue_id=NULL,$patient_id=NULL)
    {
        $data = array();
        if($queue_id) {
            $this->_queue_id  =   $queue_id;
        }
        $sqlQuery   =   "SELECT booking.*,";
        $sqlQuery   .=  " pdem.name, pdem.name_first, pdem.gender, pdem.birth_date, pdem.clinic_reference_number,";
        $sqlQuery   .=  " staff_info.staff_name, staff_info.staff_initials,";
        $sqlQuery   .=  " room.name AS room_name, room.clinic_dept_id,";
        $sqlQuery   .=  " clinic_info.clinic_shortname";
        $sqlQuery   .=  " FROM booking";
        $sqlQuery   .=  " JOIN room ON booking.room_id=room.room_id";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON booking.patient_id = pdem.patient_id";
        $sqlQuery   .=  " JOIN staff_info ON booking.staff_id = staff_info.staff_id";
        $sqlQuery   .=  " JOIN clinic_info ON room.location_id = clinic_info.clinic_info_id";
        $sqlQuery   .=  " WHERE 1 = 1";
        if($location_id) {
            $sqlQuery   .=  " AND location_id = '".$location_id."'";
        }
        //$sqlQuery   .=  " WHERE location_id = '$location_id'";
        if($queue_id) {
            $sqlQuery   .=  " AND booking_id = '$this->_queue_id'";
        }
        if(isset($date) && ($date <> "any")) {
            $sqlQuery   .=  " AND date = '$date'";
        }
        if(isset($patient_id)) {
            $sqlQuery   .=  " AND booking.patient_id = '$patient_id'";
        }
        $sqlQuery   .=  " AND booking.status = 'Pending'";
        $sqlQuery   .=  " ORDER BY room.clinic_dept_id, date, start_time";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_patients_queue($location_id,$date=NULL,$booking_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of patients queueing
     *
     * This method 
     *
	 * @param   string  $date      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_postconsultation_queue($date=NULL)
    {
        $data = array();
        if(empty($system)) {
            $system = "NULL";
        }
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM patient_consultation_summary";
        $sqlQuery   .=  " JOIN patient_demographic_info ON patient_consultation_summary.patient_id = patient_demographic_info.patient_id";
        $sqlQuery   .=  " JOIN staff_info ON patient_consultation_summary.signed_by = staff_info.staff_id";
        $sqlQuery   .=  " WHERE patient_consultation_summary.status = 10";
        if(isset($date)){
            $sqlQuery   .=  " AND date_ended = '".$date."'";
        }
        $sqlQuery   .=  " ORDER BY date_ended, time_ended";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_postconsultation_queue($date=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of users
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_consultants_list($location_id,$can_consult=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT system_user.*,";
        $sqlQuery   .=  " staff_info.staff_name,";
        $sqlQuery   .=  " staff_work.location_id,";
        $sqlQuery   .=  " ucat.category_name,";
        $sqlQuery   .=  " scln.sysclinic_staff_remarks";
        $sqlQuery   .=  " FROM system_user";
        $sqlQuery   .=  " JOIN staff_info ON system_user.staff_id=staff_info.staff_id";
        $sqlQuery   .=  " JOIN staff_work ON staff_info.staff_work_id=staff_work.staff_work_id";
        $sqlQuery   .=  " JOIN system_user_category ucat ON system_user.category_id=ucat.category_id";
        $sqlQuery   .=  " JOIN system_clinic_staff scln ON staff_info.staff_id=scln.staff_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND scln.clinic_info_id='".$location_id."'";
        $sqlQuery   .=  " AND (ucat.category_name='Doctor' OR ucat.category_name='OwnerDoctor' OR ucat.category_name='Nurse-Practitioner' OR ucat.category_name='Doctor-Assistant')";
        if(isset($can_consult)){
            if($can_consult=="TRUE"){
                $sqlQuery   .=  " AND ucat.can_consult >= 100";
            }
        }
        $sqlQuery   .=  " ORDER BY staff_info.staff_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        return $Q->result_array();//$data;    
    } //end of function get_consultants_list()


    //************************************************************************
    /**
     * Method to retrieve list of room categories
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_room_categories($category=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM room_category";
        //$sqlQuery   .=  " WHERE location_id='".$location_id."'";
        $sqlQuery   .=  " ORDER BY name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_room_categories($category=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of rooms
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_room($room_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT room.*,";
        $sqlQuery   .=  " room_category.name AS category_name";
        $sqlQuery   .=  " FROM room";
        $sqlQuery   .=  " JOIN room_category ON room.category_id=room_category.category_id";
        $sqlQuery   .=  " WHERE room_id='".$room_id."'";
        $sqlQuery   .=  " ORDER BY room.name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data = $Q->row_array();
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_one_room($room_id)


    //************************************************************************
    /**
     * Method to retrieve list of rooms
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_rooms_list($location_id=NULL,$category=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT room.*,";
        $sqlQuery   .=  " dept.dept_name, dept.dept_shortname, dept.dept_code,";
        $sqlQuery   .=  " room_category.name AS category_name,";
        $sqlQuery   .=  " clinic_info.clinic_name, clinic_info.clinic_shortname";
        $sqlQuery   .=  " FROM room";
        $sqlQuery   .=  " LEFT OUTER JOIN clinic_dept dept ON room.clinic_dept_id=dept.clinic_dept_id";
        $sqlQuery   .=  " JOIN room_category ON room.category_id=room_category.category_id";
        $sqlQuery   .=  " JOIN clinic_info ON room.location_id=clinic_info.clinic_info_id";
        $sqlQuery   .=  " WHERE room.location_id='".$location_id."'";
        $sqlQuery   .=  " ORDER BY name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_rooms_list($location_id=NULL,$category=NULL)




}

/* End of file MQueue_rdb.php */
/* Location: ./app_thirra/models/MQueue_rdb.php */
