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
 * Model Class for MAntenatal_rdb
 *
 * This class is for models that only reads from the database.
 *
 * @version 0.9.15
 * @package THIRRA - MAntenatal_rdb
 * @author  Jason Tan Boon Teck
 */

class MAntenatal_rdb extends CI_Model
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
    function get_last_gravida($format='list', $patient_id)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT MAX(TO_NUMBER(gravida,'999')) as last_gravida";//
        $sqlQuery   .=  " FROM patient_antenatal_info ainf";
        $sqlQuery   .=  " WHERE ainf.patient_id='".$this->_patient_id."'";
        //$sqlQuery   .=  " ORDER BY ainf.gravida,ainf.date DESC";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data['last_gravida'] = $row['last_gravida'];
            }
            return $data['last_gravida']; 
        } else {
            return 0; 
        }            
    } //end of function get_last_gravida($format='List', $patient_id)

 
    //************************************************************************
    /**
     * Method to retrieve list of postpartum care.
     *
     * 
     *
	 * @param   string  $summary_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_antenatal_postpartum($format='list', $patient_id, $antenatal_id=NULL, $antenatal_postpartum_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_antenatal pant";
        $sqlQuery   .=  " JOIN patient_antenatal_postpartum apos ON pant.antenatal_id=apos.antenatal_id";
        $sqlQuery   .=  " WHERE pant.antenatal_id='".$antenatal_id."'";
        if($format == 'Open'){
            $sqlQuery   .=  " AND pant.status=0";
        }
        if(!empty($antenatal_postpartum_id)){
            $sqlQuery   .=  " AND apos.antenatal_postpartum_id='".$antenatal_postpartum_id."'";
        }
        $sqlQuery   .=  " ORDER BY apos.care_date DESC";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        } else {
            // Return new record
            if($format <> 'list'){
                $data[0]['antenatal_followup_id'] = "new_postpartum";
            }
        }            
        return $data; 
    } //end of function get_antenatal_followup($format='list', $patient_id, $antenatal_id=NULL, $antenatal_followup_id=NULL)

 


}

/* End of file MAntenatal_rdb.php */
/* Location: ./app_thirra/models/MAntenatal_rdb.php */
