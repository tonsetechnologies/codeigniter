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

class MPrescribe_rdb extends CI_Model
{
    protected $_location_id     =  "";
    protected $_patient_id      =  "";
    protected $_summary_id      =  "";
    protected $_complaint_id    =  "";

    function __construct()
    {
        parent::__construct();
    }


    //===============================================================
    // Query Database Methods
    //************************************************************************
    /**
     * Method to retrieve details of one drug tradename.
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_drug_tradename($code_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT *
                            FROM drug_code";
        $sqlQuery   .=  " WHERE drug_code_id='".$code_id."'";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        }            
        return $data; 
    } //end of function get_one_drug_tradename($code_id)

 
    //************************************************************************
    /**
     * Method to retrieve list of vaccines from IMMUNISATION table
     *
     * This method 
     *
	 * @param   string  patient_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patient_immunisation($patient_id, $show_rows=999, $rows_from=0, $vaccine_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT immunisation.*, pati.patient_immunisation_id, pati.staff_id, pati.date, 
                            pati.session_id, pati.dispense_queue_id, pati.prescript_queue_id, pati.notes, 
                            pati.synch_out, pati.synch_remarks";
        $sqlQuery   .=  " FROM immunisation, patient_immunisation pati";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND immunisation.immunisation_id=pati.immunisation_id";
		$sqlQuery   .=  " AND pati.patient_id = '".$patient_id."'";
        $sqlQuery   .=  " AND immunisation.age_group IS NOT NULL";
		if(isset($vaccine_id)){
			$sqlQuery   .=  " AND immunisation.immunisation_id = '".$vaccine_id."'";
		} else {
			//if(isset($patient_id)){
			//	$sqlQuery   .=  " AND patient_immunisation.patient_id IS NOT NULL";
			//}
		}
        $sqlQuery   .=  " ORDER BY pati.date DESC, immunisation.vaccine_short";
		if(isset($show_rows)){
			$sqlQuery   .=  " LIMIT ".$show_rows;
		} else {

        }
		if(isset($rows_from)){
			$sqlQuery   .=  " OFFSET ".$rows_from;
		} else {

        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        }
        return $dataset; 
    } // end of function get_patient_immunisation($patient_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of vaccines from IMMUNISATION table
     *
     * This method 
     *
	 * @param   string  patient_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_vaccines_list($patient_id, $show_rows=999, $rows_from=0, $vaccine_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT immunisation.*, pati.patient_immunisation_id, pati.staff_id, pati.date, 
                            pati.session_id, pati.dispense_queue_id, pati.prescript_queue_id, pati.notes, 
                            pati.synch_out, pati.synch_remarks";
        $sqlQuery   .=  " FROM immunisation";
        $sqlQuery   .=  " LEFT OUTER JOIN patient_immunisation pati ON immunisation.immunisation_id=pati.immunisation_id";
		$sqlQuery   .=  " AND pati.patient_id = '".$patient_id."'";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND immunisation.age_group IS NOT NULL";
		if(isset($vaccine_id)){
			$sqlQuery   .=  " AND immunisation.immunisation_id = '".$vaccine_id."'";
		} else {
			//if(isset($patient_id)){
			//	$sqlQuery   .=  " AND patient_immunisation.patient_id IS NOT NULL";
			//}
		}
        $sqlQuery   .=  " ORDER BY immunisation.immunisation_sort ";
		if(isset($show_rows)){
			$sqlQuery   .=  " LIMIT ".$show_rows;
		} else {

        }
		if(isset($rows_from)){
			$sqlQuery   .=  " OFFSET ".$rows_from;
		} else {

        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        }
        return $dataset; 
    } // end of function get_vaccines_list($patient_id=NULL)




}

/* End of file MPrescribe_rdb.php */
/* Location: ./app_thirra/models/MPrescribe_rdb.php */
