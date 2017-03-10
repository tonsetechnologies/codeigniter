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

class MCons_rdb extends CI_Model
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
     * Method to retrieve list of complaints chapters
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_ccode_chapters()
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM icpc2_category";
        $sqlQuery   .=  " ORDER BY category_code";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_ccode_chapters()


    //************************************************************************
    /**
     * Method to retrieve list of complaints categories
     *
     * This method 
     *
	 * @param   string  $chapter      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_ccode1_by_chapter($chapter)
    {
        $data = array();
        if($chapter == "all"){
            $chapter = "";
        }
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM icpc2_symptom";
        $sqlQuery   .=  " WHERE icpc_code ILIKE '$chapter%'";
        $sqlQuery   .=  " ORDER BY full_description";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_ccode1_by_chapter($chapter)


    //************************************************************************
    /**
     * Method to retrieve details of vital signs for an episode.
     *
     * 
     *
	 * @param   string  $summary_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patcon_physical($summary_id)
    {
        $data = array();
        $this->_summary_id  =   $summary_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_physical_exam";
        $sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        } else {
            $data['physical_exam_id'] = "new_physical";
        }            
        return $data; 
    } //end of function get_patcon_physical($summary_id)

 



}

/* End of file MCons_rdb.php */
/* Location: ./app_thirra/models/MCons_rdb.php */
