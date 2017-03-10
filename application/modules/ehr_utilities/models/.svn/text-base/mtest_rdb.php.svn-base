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
 * Portions created by the Initial Developer are Copyright (C) 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for MAntenatal_rdb
 *
 * This class is for models that only reads from the database.
 *
 * @version 0.9.12
 * @package THIRRA - MAntenatal_rdb
 * @author  Jason Tan Boon Teck
 */

class MTest_rdb extends CI_Model
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
    /**
     * Method to retrieve details for last antenatal event.
     *
     * 
     *
	 * @param   string  $summary_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_entities($clinic_info_id=NULL,$entity_type=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        //$sqlQuery   .=  " pcin.contact_id, start_date, tel_mobile  ";
        $sqlQuery   .=  " FROM entity_info einf";
        //$sqlQuery   .=  " JOIN entity_clinic_relation eclr ON einf.entity_info_id=eclr.entity_info_id";
        $sqlQuery   .=  " WHERE 1=1";
        /*
        if(isset($clinic_info_id)){
            $sqlQuery   .=  " AND eclr.clinic_info_id='".$clinic_info_id."'";
        }
        switch($entity_type){
            case 'Panel':
                $sqlQuery   .=  " AND eclr.is_panel=TRUE";
            case 'MCO':
                $sqlQuery   .=  " AND eclr.is_mco=TRUE";
            case 'Insurer':
                $sqlQuery   .=  " AND eclr.is_insurer=TRUE";
            default:
        }
        */
        //$sqlQuery   .=  " ORDER BY patient_name";
        $sqlQuery   .=  " ORDER BY entity_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_entities($patient_id)


    //************************************************************************
    /**
     * Method to retrieve details for last antenatal event.
     *
     * 
     *
	 * @param   string  $summary_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_entities_per_clinic($clinic_info_id=NULL,$entity_type=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        //$sqlQuery   .=  " pcin.contact_id, start_date, tel_mobile  ";
        $sqlQuery   .=  " FROM entity_info einf";
        $sqlQuery   .=  " JOIN entity_clinic_relation eclr ON einf.entity_info_id=eclr.entity_info_id";
        $sqlQuery   .=  " WHERE 1=1";
        if(isset($clinic_info_id)){
            $sqlQuery   .=  " AND eclr.clinic_info_id='".$clinic_info_id."'";
        }
        switch($entity_type){
            case 'Panel':
                $sqlQuery   .=  " AND eclr.is_panel=TRUE";
            case 'MCO':
                $sqlQuery   .=  " AND eclr.is_mco=TRUE";
            case 'Insurer':
                $sqlQuery   .=  " AND eclr.is_insurer=TRUE";
            default:
        }
        //$sqlQuery   .=  " ORDER BY patient_name";
        $sqlQuery   .=  " ORDER BY entity_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_entities_per_clinic($patient_id)


    //************************************************************************
    /**
     * Method to retrieve details for last antenatal event.
     *
     * 
     *
	 * @param   string  $summary_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_entities_per_patient($patient_id, $clinic_info_id=NULL, $entity_type=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        //$sqlQuery   .=  " pcin.contact_id, start_date, tel_mobile  ";
        $sqlQuery   .=  " FROM entity_clinic_relation eclr";
        $sqlQuery   .=  " JOIN entity_info einf ON einf.entity_info_id=eclr.entity_info_id";
        $sqlQuery   .=  " JOIN entity_patient_relation eptr ON eclr.entity_clinic_id=eptr.entity_clinic_id";
        //$sqlQuery   .=  " LEFT OUTER JOIN entity_clinic_relation eclr ON einf.entity_info_id=eclr.entity_info_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND eptr.patient_id='".$patient_id."'";
        if(isset($clinic_info_id)){
            $sqlQuery   .=  " AND eclr.clinic_info_id='".$clinic_info_id."'";
        }
        switch($entity_type){
            case 'Panel':
                $sqlQuery   .=  " AND eptr.is_panel=TRUE";
            case 'MCO':
                $sqlQuery   .=  " AND eptr.is_mco=TRUE";
            case 'MCO client':
                $sqlQuery   .=  " AND eptr.is_mco_client=TRUE";
            case 'Insurer':
                $sqlQuery   .=  " AND eptr.is_insurer=TRUE";
            case 'Insurer client':
                $sqlQuery   .=  " AND eptr.is_insurer_client=TRUE";
            default:
        }
        //$sqlQuery   .=  " ORDER BY patient_name";
        //$sqlQuery   .=  " ORDER BY patient_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_all_panel($patient_id)

}

/* End of file MAjax_rdb.php */
/* Location: ./app_thirra/models/MAjax_rdb.php */
