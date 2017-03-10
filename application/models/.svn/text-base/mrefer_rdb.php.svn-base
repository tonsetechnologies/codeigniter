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
 * Portions created by the Initial Developer are Copyright (C) 2012
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

class MRefer_rdb extends CI_Model
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
    // Query Database Methods
    //************************************************************************
    /**
     * Method to retrieve list of incoming referrals from partners
     *
	 * @param   string  $location_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_incoming_referrals($location_id=NULL)
    {
        $data = array();
        //$this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT patient_demographic_info.*,";
        $sqlQuery   .=  " patient_referral.referral_date,patient_referral.reason,patient_referral.referral_reference,";
        $sqlQuery   .=  " patient_consultation_summary.date_ended,patient_consultation_summary.summary,";
        $sqlQuery   .=  " referral_doctor.doctor_name,referral_doctor.specialty,";
        $sqlQuery   .=  " clinic_info.clinic_name, clinic_info.clinic_shortname,";
        $sqlQuery   .=  " staff_info.staff_name";
        $sqlQuery   .=  " FROM patient_referral";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON patient_referral.session_id=patient_consultation_summary.summary_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON patient_referral.patient_id=patient_demographic_info.patient_id";
        $sqlQuery   .=  " JOIN referral_doctor ON patient_referral.referral_doctor_id=referral_doctor.referral_doctor_id";
        $sqlQuery   .=  " JOIN referral_center ON referral_doctor.referral_center_id=referral_center.referral_center_id";
        $sqlQuery   .=  " JOIN clinic_info ON patient_consultation_summary.location_end=clinic_info.clinic_info_id";
        $sqlQuery   .=  " JOIN staff_info ON patient_consultation_summary.signed_by=staff_info.staff_id";
        if(isset($location_id)) {
            $sqlQuery   .=  " WHERE referral_center.other<>'".$location_id."'";
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_incoming_referrals($location_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of incoming referrals from partners
     *
	 * @param   string  $location_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_incoming_referrals_staged($location_id=NULL)
    {
        $data = array();
        //$this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT patient_referral_in_staging.*";
        $sqlQuery   .=  " FROM patient_referral_in_staging";
        //if(isset($location_id)) {
            //$sqlQuery   .=  " WHERE referral_center.other<>'".$location_id."'";
        //}
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_incoming_referrals_staged($location_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve array of referrals for an episode.
     *
     * If referral_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $referral_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_list_referrals($status=NULL, $location_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT patient_referral.*,";
        $sqlQuery   .=  " referral_doctor.doctor_name, referral_doctor.specialty,";
        $sqlQuery   .=  "  referral_center.*,";
        //$sqlQuery   .=  "  referral_center.referral_center_id,referral_center.name AS referral_center_name, referral_center.centre_type";
        $sqlQuery   .=  "  pdem.*";
        $sqlQuery   .=  " FROM patient_referral";
        $sqlQuery   .=  " JOIN referral_doctor ON patient_referral.referral_doctor_id = referral_doctor.referral_doctor_id";
        $sqlQuery   .=  " JOIN referral_center ON referral_doctor.referral_center_id = referral_center.referral_center_id";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON patient_referral.patient_id=pdem.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary pcon ON patient_referral.session_id=pcon.summary_id";
        $sqlQuery   .=  " WHERE 1=1";
        if(isset($location_id)){
            $sqlQuery   .=  " AND pcon.location_start='".$location_id."'";
        }
        if($status == "Consulted"){
            $sqlQuery   .=  " AND pcon.date_ended IS NOT NULL";
        }
        $sqlQuery   .=  " ORDER BY patient_referral.referral_centre";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[] = $row;
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_list_referrals($summary_id)

 
    //************************************************************************
    /**
     * Method to retrieve details of referrals for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_history_referrals($status='All',$query_type='List',$patient_id=NULL,$referral_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT pref.*,";
        $sqlQuery   .=  " rdoc.doctor_name, rdoc.specialty,";
        $sqlQuery   .=  "  rcen.*,";
        $sqlQuery   .=  "  pcon.date_ended, pcon.signed_by";
        $sqlQuery   .=  " FROM patient_referral pref";
        $sqlQuery   .=  " JOIN referral_doctor rdoc ON pref.referral_doctor_id = rdoc.referral_doctor_id";
        $sqlQuery   .=  " JOIN referral_center rcen ON rdoc.referral_center_id = rcen.referral_center_id";
        $sqlQuery   .=  " LEFT OUTER JOIN patient_consultation_summary pcon ON pref.session_id = pcon.summary_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND pref.patient_id='".$patient_id."'";
        if($status == "Consulted"){
            $sqlQuery   .=  " AND pcon.date_ended IS NOT NULL";
        }
        if(isset($referral_id)){
            $sqlQuery   .=  " AND pref.referral_id='".$referral_id."'";
        }
        $sqlQuery   .=  " ORDER BY pref.referral_date DESC";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_history_referrals($query_type='List',$patient_id=NULL,$vital_id=NULL)

 
   //************************************************************************
    /**
     * Method to retrieve list of patients inside database. 
     *
     * Base is patient_demographic_info
     * This method also displays bio_case info if available.
     *
	 * @param   string  $sort_order		First order
	 * @param   string  $patient_name   Optional parameter to filter
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patients_listby_anything($patient_location='All',$sort_order="name",$search_field='name',$search_term)
    {
        $debug_mode		    =	$this->config->item('debug_mode');
        $search_term        =   (string)$search_term;
        $data = array();
        $sqlQuery   =   "SELECT pdem.*, clinic_info.clinic_shortname";
        $sqlQuery   .=  " FROM patient_demographic_info pdem";
        $sqlQuery   .=  " JOIN clinic_info ON pdem.clinic_home=clinic_info.clinic_info_id";
		//echo "patient_location=".$patient_location;
		if($patient_location == 'All'){
			$sqlQuery   .=  " WHERE pdem.clinic_home ILIKE '%'";
		} else {
			$sqlQuery   .=  " WHERE pdem.clinic_home = '".$patient_location."'";
		}
        
        $sqlQuery   .=  " AND ".$search_field." = '$search_term'";
        $sqlQuery   .=  " AND ".$search_field." IS NOT NULL";
        //$sqlQuery   .=  " ORDER BY (pdem.name||pdem.patient_id) ";
        $sqlQuery   .=  " ORDER BY ".$sort_order.", name";
        if($debug_mode){
            echo "<br />".$sqlQuery;
        }
        $query =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        return $dataset; 
        }
    } //end of function get_patients_listby_anything($patient_name=NULL)

 


}

/* End of file MRefer_wdb.php */
/* Location: ./app_thirra/models/MRefer_wdb.php */
