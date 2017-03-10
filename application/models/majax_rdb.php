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

class MAjax_rdb extends CI_Model
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
    function get_autocomplete_diagnosis($term)
    /**
     * Method to retrieve list of diagnosis for autocomplete
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    {
        //$this->db->select('dcode1ext_longname');
        //$this->db->like('dcode1ext_longname', $options['keyword'], 'after');
        //$query = $this->db->get('dcode1ext');
        
        $sqlQuery   =   "SELECT dcode1ext_longname";
        $sqlQuery   .=  " FROM dcode1ext";
        $sqlQuery   .=  " WHERE dcode1ext.dcode1ext_longname ILIKE '%".$term."%'";
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        return $Q->result();
    } //end function get_autocomplete_diagnosis($options)


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
    function get_kin_contact_info($patient_id=NULL)
    {
        $age_menarche	    =	$this->config->item('age_menarche');
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT 
                            pdem.patient_id, pdem.name, pdem.birth_date, pdem.ic_no, pdem.job_function,";
        $sqlQuery   .=  " pcin.contact_id, start_date, tel_mobile  ";
        $sqlQuery   .=  " FROM patient_demographic_info pdem";
        $sqlQuery   .=  " JOIN patient_contact_info pcin ON pdem.patient_id
                            = pcin.patient_id";
        $sqlQuery   .=  " WHERE pdem.patient_id = '".$this->_patient_id."'";
        //$sqlQuery   .=  " ORDER BY patient_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
            $data['age_today']  =   round((time()-strtotime($data['birth_date']))/(60*60*24*365.2425),1);
            $data['age_words']  =   $data['age_today']." years";
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_kin_contact_info($patient_id)


}

/* End of file MAjax_rdb.php */
/* Location: ./app_thirra/models/MAjax_rdb.php */
