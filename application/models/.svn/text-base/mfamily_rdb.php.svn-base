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
 * Model Class for MAntenatal_rdb
 *
 * This class is for models that only reads from the database.
 *
 * @version 0.9.15
 * @package THIRRA - MAntenatal_rdb
 * @author  Jason Tan Boon Teck
 */

class MFamily_rdb extends CI_Model
{
    protected $_location_id     =  "";
    protected $_patient_id      =  "";
    protected $_summary_id      =  "";
    protected $_complaint_id    =  "";

    function __construct()
    {
        parent::__construct();
    }


    //************************************************************************
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_family_relations($query_type='List',$generation='below',$patient_id=NULL,$relationship_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_family_relationship frel";
        if($generation == "below"){
            $sqlQuery   .=  " JOIN patient_demographic_info pinf ON frel.patient_id=pinf.patient_id";
            $sqlQuery   .=  " LEFT OUTER JOIN patient_family_details fdet ON frel.patient_id=fdet.patient_id";
            $sqlQuery   .=  " WHERE 1=1";
            $sqlQuery   .=  " AND frel.head_id='".$this->_patient_id."'";
        } else {
            $sqlQuery   .=  " JOIN patient_demographic_info pinf ON frel.head_id=pinf.patient_id";
            $sqlQuery   .=  " WHERE 1=1";
            $sqlQuery   .=  " AND frel.patient_id='".$this->_patient_id."'";
        } //endif($generation == "below")
        if(isset($relationship_id)){
            $sqlQuery   .=  " AND frel.relationship_id='".$relationship_id."'";            
        }
        //$sqlQuery   .=  " ORDER BY date DESC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_family_relations($query_type='List',$patient_id=NULL,$relationship_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_relationship_info($patient_id=NULL,$relationship_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_family_relationship frel";
            $sqlQuery   .=  " JOIN patient_demographic_info pinf ON frel.patient_id=pinf.patient_id";
            $sqlQuery   .=  " LEFT OUTER JOIN patient_family_details fdet ON frel.patient_id=fdet.patient_id";
            $sqlQuery   .=  " WHERE 1=1";
            $sqlQuery   .=  " AND frel.patient_id='".$this->_patient_id."'";
        if(isset($relationship_id)){
            $sqlQuery   .=  " AND frel.relationship_id='".$relationship_id."'";            
        }
        //$sqlQuery   .=  " ORDER BY date DESC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_relationship_info($patient_id=NULL,$relationship_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patientby_family_type($relation_type,$patient_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT DISTINCT name, name_first, pinf.patient_id, birth_date";
        $sqlQuery   .=  " FROM patient_demographic_info pinf";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND pinf.family_link='".$relation_type."'";
        if(isset($patient_id)){
            $sqlQuery   .=  " AND patient_id='".$patient_id."'";
        }
        $sqlQuery   .=  " ORDER BY name, name_first, birth_date ASC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_patientby_family_type($query_type='List',$patient_id=NULL,$relationship_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.  - DEPRECATED???
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_no_family_patients($patient_id=NULL,$relationship_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT patient_id, name, name_first, birthdate
                            FROM patient_demographic_info pinf";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND frel.patient_id='".$this->_patient_id."'";
        if(isset($relationship_id)){
            $sqlQuery   .=  " AND frel.relationship_id='".$relationship_id."'";            
        }
        //$sqlQuery   .=  " ORDER BY date DESC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_no_family_patients($patient_id=NULL,$relationship_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_family_head($patient_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        if(isset($patient_id)){
            $sqlQuery   =   "SELECT *";
        } else {
            $sqlQuery   =   "SELECT DISTINCT name, name_first, pinf.patient_id, birth_date";
        }
        $sqlQuery   .=  " FROM patient_family_relationship frel";
        $sqlQuery   .=  " JOIN patient_demographic_info pinf ON frel.head_id=pinf.patient_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND pinf.family_link='Head of Family'";
        if(isset($patient_id)){
            $sqlQuery   .=  " AND frel.patient_id='".$this->_patient_id."'";
        }
        //$sqlQuery   .=  " ORDER BY date DESC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_family_head($query_type='List',$patient_id=NULL,$relationship_id=NULL)

 


}

/* End of file MFamily_rdb.php */
/* Location: ./app_thirra/models/MFamily_rdb.php */
