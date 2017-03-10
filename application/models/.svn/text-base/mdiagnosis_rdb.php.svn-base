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

class MDiagnosis_rdb extends CI_Model
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
     * Method to retrieve list of diagnosis commonly used.
     *
     * 
     *
	 * @param   string  none      No parameter is required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_common_diagnosis()
    {
        $dataset = array();
        $sqlQuery   =   "SELECT *"; /*
                            dcode1ext.dcode1ext_id,
                            dcode1ext.dcode1_id,
                            dcode1ext.dcode1set,
                            dcode1ext.dcode1ext_code,
                            dcode1ext.full_title,
                            dcode1ext.commonly_used,
                            dcode1ext.remarks */
        $sqlQuery   .=  " FROM dcode1ext";
        $sqlQuery   .=  " WHERE dcode1ext.commonly_used > 0";
        $sqlQuery   .=  " ORDER BY dcode1ext.commonly_used ";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[] = $row;
            }
        }
        return $dataset; 
    } //end of function get_common_diagnosis()

 
    //************************************************************************
    /**
     * Method to retrieve details of one diagnosis code.
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_diagnosis_code($code_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT *
                            FROM dcode1ext";
        $sqlQuery   .=  " WHERE dcode1ext_code='".$code_id."'";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        }            
        return $data; 
    } //end of function get_one_diagnosis_code($code_id)

 
    //************************************************************************
    /**
     * Method to retrieve list of diagnosis based on filter.
     *
     * This method retrieves all diagnosis codes if 1st argument is given.
     *
	 * @param   string  $search_term      Optional parameter to filter
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_diagnosis_list($pull_all=FALSE,$search_term=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT 
                            dcode1ext.dcode1ext_id,
                            dcode1ext.dcode1_id,
                            dcode1ext.dcode1set,
                            dcode1ext.dcode1ext_code,
                            dcode1ext.full_title,
                            dcode1ext.commonly_used,
                            dcode1ext.remarks
                            FROM dcode1ext";
        if(isset($search_term)){
            $sqlQuery   .=  " WHERE dcode1ext.full_title ILIKE '%$search_term%'";
        } elseif($pull_all) {
            echo "pull all";
            // retrieve all
        } else {
            echo "else";
            $sqlQuery   .=  " WHERE dcode1ext.full_title ILIKE 'do nothing'";
        }
        $sqlQuery   .=  " ORDER BY dcode1ext.dcode1ext_code ";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['dcode1ext_id']  = $row['dcode1ext_id'];
                $dataset[$rownum]['dcode1_id']     = $row['dcode1_id'];
                $dataset[$rownum]['dcode1ext_code']= $row['dcode1ext_code'];
                $dataset[$rownum]['full_title']    = $row['full_title'];
                $dataset[$rownum]['commonly_used'] = $row['commonly_used'];
                $dataset[$rownum]['remarks']       = $row['remarks'];
                $rownum++;            
            }
        }
        return $dataset; 
    } //end of function get_diagnosis_list($search_term=NULL)

 


}

/* End of file MDiagnosis_rdb.php */
/* Location: ./app_thirra/models/MDiagnosis_rdb.php */
