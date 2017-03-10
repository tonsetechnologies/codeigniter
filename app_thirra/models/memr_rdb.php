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
 * Portions created by the Initial Developer are Copyright (C) 2010 - 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for EMR
 *
 * This class is for models that only reads from the database.
 *
 * @version 0.9.12
 * @package THIRRA - mEMR-Rdb
 * @author  Jason Tan Boon Teck
 */

class MEmr_rdb extends CI_Model
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
    function get_patients_list($patient_location,$sort_order="name",$patient_name=NULL,$search_field="name")
    {
        $debug_mode		    =	$this->config->item('debug_mode');
        $data = array();
        $sqlQuery   =   "SELECT clinic_info.clinic_shortname,";
        $sqlQuery   .=  " 
                            pdem.patient_id,
                            pdem.clinic_reference_number,
                            pdem.name, pdem.name_first,
                            pdem.gender,
                            pdem.ic_no, pdem.ic_other_no,
                            pdem.birth_date
        ";
        $sqlQuery   .=  " FROM patient_demographic_info pdem";
        $sqlQuery   .=  " JOIN clinic_info ON pdem.clinic_home=clinic_info.clinic_info_id";
		//echo "patient_location=".$patient_location;
		if($patient_location == 'all'){
			$sqlQuery   .=  " WHERE pdem.clinic_home ILIKE '%'";
		} else {
			$sqlQuery   .=  " WHERE pdem.clinic_home = '".$patient_location."'";
		}
        if(isset($patient_name)){
            $_patient_name  =   $patient_name;
			if($patient_name == 'All'){
				// 
			} else {
				if(strlen($_patient_name) < 2) {
					$sqlQuery   .=  " AND ".$search_field." ILIKE '$_patient_name%'";
				} else {
					$sqlQuery   .=  " AND ".$search_field." ILIKE '%$_patient_name%'";
				} //endif(strlen($patient_name) < 2)
			} //endif($patient_name = 'All')
        }
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
    } //end of function get_patients_list($patient_name=NULL)

 
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
     * Method to retrieve details of patients.
     *
     * This method retrieves details of patients. Less fields retrieved if 
     * patient_id is given. Base is patient_demographic_info.
     *
	 * @param   string  $patient_id      Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patient_details($patient_id=NULL)
    {
        $age_menarche	    =	$this->config->item('age_menarche');
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT 
                            pdem.*, name as patient_name, pdem.status as patient_status, pdem.remarks as patdemo_remarks,";
        if(isset($this->_patient_id)){
            $sqlQuery   .=  " pcin.contact_id, start_date,
							  address as patient_address, address_2 as patient_address2, 
                              address_3 as patient_address3,
                              town as patient_town, country as patient_country, state as patient_state, 
							  postcode as patient_postcode,
                              tel_home, tel_office, tel_mobile, pager_no, fax_no, email, pcin.other as contact_other, pcin.remarks as contact_remarks, pcin.addr_village_id, pcin.addr_town_id, pcin.addr_area_id, pcin.addr_district_id, pcin.addr_state_id,";
            $sqlQuery   .=  " pimm.staff_id";
        } //endif(isset($this->_patient_id))
        $sqlQuery   .=  " FROM patient_demographic_info pdem";
        if(isset($this->_patient_id)){
			$sqlQuery   .=  " JOIN patient_contact_info pcin ON pdem.patient_id
								= pcin.patient_id";
			$sqlQuery   .=  " LEFT OUTER JOIN patient_immunisation pimm ON pcin.contact_id
								= pimm.patient_immunisation_id";
            $sqlQuery   .=  " WHERE pdem.patient_id = '".$this->_patient_id."'";
        } else {
            $sqlQuery   .=  " ORDER BY patient_name";
        }//endif(isset($this->_patient_id))
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
            $data['age_today']  =   round((time()-strtotime($data['birth_date']))/(60*60*24*365.2425),1);
            $data['age_words']  =   $data['age_today']." years";
            $data['age_menarche']     =   $age_menarche;
            if(($data['age_today'] - $data['age_menarche']) > 0){
                $data['fertile']     =   "TRUE";
            } else {
                $data['fertile']     =   "FALSE";
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_patient_details($patient_id)


    //************************************************************************
    /**
     * Method to retrieve list of past consultations for one patient.
     *
     * Base is patient_demographic_info
     * This method also displays bio_case info if available.
     *
	 * @param   string  $patient_name      Optional parameter to filter
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_pastcons_list($patient_id=NULL)
    {
        $dataset = array();
        // Still need to find a way to display latest notification
        $sqlQuery   =   "SELECT patient_consultation_summary.*,";
        $sqlQuery   .=  " clinic_info.clinic_name, clinic_info.clinic_shortname";
        $sqlQuery   .=  " FROM patient_consultation_summary";
        $sqlQuery   .=  " JOIN clinic_info ON patient_consultation_summary.location_end=clinic_info.clinic_info_id";
        $sqlQuery   .=  " WHERE patient_id='".$patient_id."'";
        $sqlQuery   .=  " AND status > 0";
        $sqlQuery   .=  " ORDER BY date_started DESC";
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
    } //end of function get_pastcons_list($patient_name=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve list of picture files from BIO_FILE table only
     *
     * This method 
     *
	 * @param   string  patient_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_files_list($patient_id=NULL)
    {
        $data = array();
        $this->db->from('patient_file');
        $this->db->where('patient_file.patient_id', $patient_id);
        $this->db->order_by('file_sort'); 
        //echo $this->db->_compile_select();
        $Q = $this->db->get();
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data; 
    } // end of function get_files_list($patient_id=NULL)


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
     * Method to retrieve details of vital signs for latest episode.
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

 
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drug_allergies($query_type='List',$patient_id=NULL,$patient_drug_allergy_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT pdal.*, dfor.generic_name
                            FROM patient_drug_allergy pdal";
        $sqlQuery   .=  " JOIN drug_formulary dfor ON pdal.drug_formulary=dfor.formulary_code";		
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        if(isset($patient_drug_allergy_id)){
            $sqlQuery   .=  " AND patient_drug_allergy_id='".$patient_drug_allergy_id."'";            
        }
        $sqlQuery   .=  " ORDER BY drug_formulary ASC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_drug_allergies($query_type='List',$patient_id=NULL,$vital_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_vitals($patient_id)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_vital";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        $sqlQuery   .=  " ORDER BY reading_date DESC, reading_time DESC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        }
        return $data; 
    } //end of function get_recent_vitals($patient_id)

 
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_history_vitals($query_type='List',$patient_id=NULL,$vital_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_vital";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        $sqlQuery   .=  " ORDER BY reading_date DESC, reading_time DESC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_history_vitals($query_type='List',$patient_id=NULL,$vital_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of vital signs for latest episode.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_history_social($query_type='List',$patient_id=NULL,$social_history_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_social_history";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        if(isset($social_history_id)){
            $sqlQuery   .=  " AND social_history_id='".$social_history_id."'";            
        }
        $sqlQuery   .=  " ORDER BY date DESC";		
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return $data; 
    } //end of function get_history_social($query_type='List',$patient_id=NULL,$vital_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of recent medication.
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_medication($patient_id, $show_rows=999, $rows_from=0, $medication_id=NULL)
    {
        $dataset = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT patient_medication.*,
                            drug_formulary.generic_name, drug_formulary.formulary_code, drug_formulary.atc_code
                            FROM patient_medication";
        $sqlQuery   .=  " JOIN drug_formulary ON patient_medication.drug_formulary_id = drug_formulary.drug_formulary_id";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        $sqlQuery   .=  " ORDER BY date_started DESC";
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
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['medication_id']      = $row['medication_id'];
                $dataset[$rownum]['staff_id']           = $row['staff_id'];
                $dataset[$rownum]['dispense_queue_id']  = $row['dispense_queue_id'];
                $dataset[$rownum]['prescript_queue_id'] = $row['prescript_queue_id'];
                $dataset[$rownum]['drug_formulary_id']  = $row['drug_formulary_id'];
                $dataset[$rownum]['dose']               = $row['dose'];
                $dataset[$rownum]['dose_form']          = $row['dose_form'];
                $dataset[$rownum]['frequency']          = $row['frequency'];
                $dataset[$rownum]['instruction']        = $row['instruction'];
                $dataset[$rownum]['quantity']           = $row['quantity'];
                $dataset[$rownum]['quantity_form']      = $row['quantity_form'];
                $dataset[$rownum]['remarks']            = $row['remarks'];
                $dataset[$rownum]['date_started']       = $row['date_started'];
                $dataset[$rownum]['date_stopped']       = $row['date_stopped'];
                $dataset[$rownum]['reason']             = $row['reason'];
                $dataset[$rownum]['formulary_code']     = $row['formulary_code'];
                $dataset[$rownum]['atc_code']           = $row['atc_code'];
                $dataset[$rownum]['generic_name']       = $row['generic_name'];
                $rownum++;            
            }
        }            
        return $dataset; 
    } //end of function get_recent_medication($patient_id)

 
    //************************************************************************
    /**
     * Method to retrieve array of lab orders for a patient.
     *
     * If lab_order_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $lab_order_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_lab($patient_id, $lab_order_id=NULL)
    {
        $dataset = array();
        $this->_patient_id   =   $patient_id;
        if(isset($lab_order_id)){
            $this->_lab_order_id =   $lab_order_id;
        } else {
            $this->_lab_order_id =   NULL;
        }
        $sqlQuery   =   "SELECT lord.*,";
        $sqlQuery   .=  " lpac.package_code, lpac.package_name,
                            lpac.description, lpac.package_cost_std, lpac.sample_required,";
        $sqlQuery   .=  " lsup.supplier_id, lsup.supplier_name, lsup.acc_no";
        $sqlQuery   .=  " FROM lab_order lord";
        $sqlQuery   .=  " JOIN lab_package lpac ON lord.lab_package_id=lpac.lab_package_id";
        $sqlQuery   .=  " JOIN lab_supplier lsup ON lpac.supplier_id=lsup.supplier_id";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        if(isset($lab_order_id)){
            $sqlQuery   .=  " AND lord.lab_order_id='".$this->_lab_order_id."'";
        }
        $sqlQuery   .=  " ORDER BY lord.sample_date";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_recent_lab($summary_id)

 
    //************************************************************************
    /**
     * Method to retrieve array of imaging orders for a patient.
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $imaging_order_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_imaging($patient_id, $imaging_order_id=NULL)
    {
        $dataset = array();
        $this->_patient_id   =   $patient_id;
        if(isset($imaging_order_id)){
            $this->_imaging_order_id =   $imaging_order_id;
        } else {
            $this->_imaging_order_id =   NULL;
        }
        $sqlQuery   =   "SELECT imaging_order.*,";
        $sqlQuery   .=  " imaging_product.product_code, imaging_product.loinc_num,
                            imaging_product.description, imaging_product.retail_price,";
        $sqlQuery   .=  " ires.result_date, ires.notes,";
        $sqlQuery   .=  " imaging_supplier.supplier_id, imaging_supplier.supplier_name,";
        $sqlQuery   .=  " loinc.component,";
        $sqlQuery   .=  " patient_consultation_summary.date_started";
        $sqlQuery   .=  " FROM imaging_order";
        $sqlQuery   .=  " LEFT OUTER JOIN imaging_result ires ON imaging_order.order_id=ires.order_id";
        $sqlQuery   .=  " JOIN imaging_product ON imaging_order.product_id=imaging_product.product_id";
        $sqlQuery   .=  " JOIN imaging_supplier ON imaging_product.supplier_id=imaging_supplier.supplier_id";
        $sqlQuery   .=  " JOIN loinc ON imaging_product.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON imaging_order.session_id=patient_consultation_summary.summary_id";
        $sqlQuery   .=  " WHERE imaging_order.patient_id='".$this->_patient_id."'";
        //$sqlQuery   .=  " AND patient_complaint.icpc_code=icpc2_symptom.icpc_code";
        if(isset($imaging_order_id)){
            $sqlQuery   .=  " AND imaging_order.order_id='".$this->_imaging_order_id."'";
        }
        $sqlQuery   .=  " ORDER BY imaging_product.product_code";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum] = $row;
                /*
                $dataset[$rownum]['order_id']   = $row['order_id'];
                $dataset[$rownum]['supplier_ref']     = $row['supplier_ref'];
                $dataset[$rownum]['remarks']        = $row['remarks'];
                $dataset[$rownum]['product_code']   = $row['product_code'];
                $dataset[$rownum]['description']    = $row['description'];
                $dataset[$rownum]['retail_price']= $row['retail_price'];
                $dataset[$rownum]['supplier_id']    = $row['supplier_id'];
                $dataset[$rownum]['supplier_name']  = $row['supplier_name'];
                $dataset[$rownum]['component']  = $row['component'];
                */
                $rownum++;            
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_recent_imaging($patient_id, $imaging_order_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of recent diagnoses.
     *
     * 
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_diagnoses($patient_id,$prediagnosis=FALSE)
    {
        $dataset = array();
        $this->_patient_id   =   $patient_id;
        if(isset($diagnosis_id)){
            $this->_diagnosis_id =   $diagnosis_id;
        } else {
            $this->_diagnosis_id =   NULL;
        }
        $sqlQuery   =   "SELECT patient_diagnosis.*, patient_consultation_summary.date_ended,";
        $sqlQuery   .=  " dcode1ext.dcode1ext_shortname, dcode1ext.full_title,";
        $sqlQuery   .=  " dcode1.chapter, dcode1.dcode1_code";
        $sqlQuery   .=  " FROM patient_diagnosis, dcode1ext, dcode1, patient_consultation_summary";
        $sqlQuery   .=  " WHERE patient_diagnosis.patient_id='".$this->_patient_id."'";
        if($prediagnosis==TRUE){
            $sqlQuery   .=  " AND patient_diagnosis.diagnosis_type='Pre-diagnostic'";
        } else {
            $sqlQuery   .=  " AND patient_diagnosis.diagnosis_type<>'Pre-diagnostic'";
        }
        $sqlQuery   .=  " AND patient_diagnosis.dcode1ext_code=dcode1ext.dcode1ext_code";
        $sqlQuery   .=  " AND dcode1ext.dcode1_id=dcode1.dcode1_id";
        $sqlQuery   .=  " AND patient_diagnosis.session_id=patient_consultation_summary.summary_id";
        if(isset($diagnosis_id)){
            $sqlQuery   .=  " AND patient_diagnosis.diagnosis_id='".$this->_diagnosis_id."'";
        }
        $sqlQuery   .=  " ORDER BY patient_consultation_summary.date_ended DESC";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['diagnosis_id']   = $row['diagnosis_id'];
                $dataset[$rownum]['diagnosis_type'] = $row['diagnosis_type'];
                $dataset[$rownum]['diagnosis_notes']= $row['notes'];
                $dataset[$rownum]['dcode1set']      = $row['dcode1set'];
                $dataset[$rownum]['dcode1ext_code'] = $row['dcode1ext_code'];
                $dataset[$rownum]['dcode2set']      = $row['dcode2set'];
                $dataset[$rownum]['dcode2ext_code'] = $row['dcode2ext_code'];
                $dataset[$rownum]['remarks']        = $row['remarks'];
                $dataset[$rownum]['dcode1_code']    = $row['dcode1_code'];
                $dataset[$rownum]['full_title']     = $row['full_title'];
                $dataset[$rownum]['diagnosisChapter']= $row['chapter'];
                $dataset[$rownum]['diagnosisCategory']= $row['dcode1_code'];
                $dataset[$rownum]['diagnosis']      = $row['dcode1ext_code'];
                $dataset[$rownum]['diagnosis2']     = $row['dcode2ext_code'];
                $dataset[$rownum]['date_ended']     = $row['date_ended'];
                $rownum++;            
            }
        /*
        } else { //create dummy row
            $dataset[1]['diagnosis_id']   = "new_diagnosis";
            $dataset[1]['diagnosis_type'] = "";
            $dataset[1]['notes']          = "";
            $dataset[1]['dcode1ext_code'] = "";
        */
        reset($query);
        }
        return $dataset; 
    } //end of function get_recent_diagnoses($patient_id)

 
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
     * Method to retrieve demographic info of one patient.
     *
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patient_demo($id){
        $age_menarche	    =	$this->config->item('age_menarche');
        $data = array();
        $options = array('patient_id' => $id);
        $Q = $this->db->get_where('patient_demographic_info',$options,1);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
            $data['age_days']   =   round((time()-strtotime($data['birth_date']))/(60*60*24),1);
            $data['age_today']  =   round((time()-strtotime($data['birth_date']))/(60*60*24*365.2425),1);
            $data['age_words']  =   $data['age_today']." years";
            $data['age_menarche']     =   $age_menarche;
            if(($data['age_today'] - $data['age_menarche']) > 0){
                $data['fertile']     =   "TRUE";
            } else {
                $data['fertile']     =   "FALSE";
            }

        }
        $Q->free_result();    
        return $data;    
    } //end of function get_patient_demo($id)


    //************************************************************************
    /**
     * Method to retrieve details of open summmary for one patient.
     *
     * Method returns a new summary row if none is found.
     *
	 * @param   string  $patient_id      Required
	 * @param   string  $summary_id      Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patcon_details($patient_id, $summary_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT patient_consultation_summary.*,";
        $sqlQuery   .=  " staff_info.staff_name AS signed_name";
        $sqlQuery   .=  " FROM patient_consultation_summary";
        $sqlQuery   .=  " LEFT OUTER JOIN staff_info ON patient_consultation_summary.signed_by=staff_info.staff_id";
        $sqlQuery   .=  " WHERE patient_id = '".$this->_patient_id."'";
        if(isset($summary_id)){
            $sqlQuery   .=  " AND summary_id = '".$summary_id."'";
        } else {
            $sqlQuery   .=  " AND status = '0'"; 
        }
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        } else {
            $data['summary_id'] = "new_summary";
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_patcon_details($patient_id)


    //************************************************************************
    /**
     * Method to retrieve array of complaints for an episode.
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $complaint_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patcon_complaints($summary_id, $complaint_id=NULL)
    {
        $dataset = array();
        $this->_summary_id   =   $summary_id;
        if(isset($complaint_id)){
            $this->_complaint_id =   $complaint_id;
        } else {
            $this->_complaint_id =   NULL;
        }
        $sqlQuery   =   "SELECT patient_complaint.*, substring(patient_complaint.icpc_code from 1 for 1) AS complaint_chapter,";
        $sqlQuery   .=  " icpc2_symptom.icd_10, icpc2_symptom.full_description";
        $sqlQuery   .=  " FROM patient_complaint, icpc2_symptom";
        $sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        $sqlQuery   .=  " AND patient_complaint.icpc_code=icpc2_symptom.icpc_code";
        if(isset($complaint_id)){
            $sqlQuery   .=  " AND patient_complaint.complaint_id='".$this->_complaint_id."'";
        }
        $sqlQuery   .=  " ORDER BY patient_complaint.icpc_code";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['complaint_id']   = $row['complaint_id'];
                $dataset[$rownum]['icpc_code']      = $row['icpc_code'];
                $dataset[$rownum]['duration']       = $row['duration'];
                $dataset[$rownum]['complaint_notes']= $row['notes'];
                $dataset[$rownum]['ccode1ext_code'] = $row['ccode1ext_code'];
                $dataset[$rownum]['complaint_rank'] = $row['complaint_rank'];
                $dataset[$rownum]['remarks']        = $row['remarks'];
                $dataset[$rownum]['full_description']= $row['full_description'];
                $dataset[$rownum]['icd_10']         = $row['icd_10'];
                $dataset[$rownum]['complaint_chapter'] = $row['complaint_chapter'];
                $dataset[$rownum]['synch_out']      = $row['synch_out'];
                $dataset[$rownum]['synch_remarks']  = $row['synch_remarks'];
                $rownum++;            
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_patcon_complaints($summary_id)

 
    //************************************************************************
    /**
     * Method to retrieve array of lab orders for an episode.
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $lab_order_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patcon_lab($summary_id=NULL, $lab_order_id=NULL)
    {
        $dataset = array();
        $this->_summary_id   =   $summary_id;
        if(isset($lab_order_id)){
            $this->_lab_order_id =   $lab_order_id;
        } else {
            $this->_lab_order_id =   NULL;
        }
        $sqlQuery   =   "SELECT lord.*,";
        $sqlQuery   .=  " lpac.package_code, lpac.package_name,
                            lpac.description, lpac.package_cost_std, lpac.sample_required,";
        $sqlQuery   .=  " lsup.supplier_id, lsup.supplier_name, lsup.acc_no";
        $sqlQuery   .=  " FROM lab_order lord";
        $sqlQuery   .=  " JOIN lab_package lpac ON lord.lab_package_id=lpac.lab_package_id";
        $sqlQuery   .=  " JOIN lab_supplier lsup ON lpac.supplier_id=lsup.supplier_id";
        $sqlQuery   .=  " WHERE 1=1";
        if(isset($summary_id)){
            $sqlQuery   .=  " AND session_id='".$this->_summary_id."'";
        }
        if(isset($lab_order_id)){
            $sqlQuery   .=  " AND lord.lab_order_id='".$this->_lab_order_id."'";
        }
        $sqlQuery   .=  " ORDER BY lpac.package_code";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_patcon_lab($summary_id)

 
    //************************************************************************
    /**
     * Method to retrieve array of imaging orders for an episode.
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $imaging_order_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patcon_imaging($summary_id=NULL, $imaging_order_id=NULL)
    {
        $dataset = array();
        $this->_summary_id   =   $summary_id;
        if(isset($imaging_order_id)){
            $this->_imaging_order_id =   $imaging_order_id;
        } else {
            $this->_imaging_order_id =   NULL;
        }
        $sqlQuery   =   "SELECT imaging_order.*,";
        $sqlQuery   .=  " imaging_product.product_code, imaging_product.loinc_num,
                            imaging_product.description, imaging_product.retail_price,";
        $sqlQuery   .=  " imaging_supplier.supplier_id, imaging_supplier.supplier_name,";
        $sqlQuery   .=  " loinc.component";
        $sqlQuery   .=  " FROM imaging_order";
        $sqlQuery   .=  " JOIN imaging_product ON imaging_order.product_id=imaging_product.product_id";
        $sqlQuery   .=  " JOIN imaging_supplier ON imaging_product.supplier_id=imaging_supplier.supplier_id";
        $sqlQuery   .=  " JOIN loinc ON imaging_product.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " WHERE 1=1";
        if(isset($summary_id)){
            $sqlQuery   .=  " AND session_id='".$this->_summary_id."'";
        }
        //$sqlQuery   .=  " AND patient_complaint.icpc_code=icpc2_symptom.icpc_code";
        if(isset($imaging_order_id)){
            $sqlQuery   .=  " AND imaging_order.order_id='".$this->_imaging_order_id."'";
        }
        $sqlQuery   .=  " ORDER BY imaging_product.product_code";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['order_id']   = $row['order_id'];
                $dataset[$rownum]['product_id']   = $row['product_id'];
                $dataset[$rownum]['supplier_ref']   = $row['supplier_ref'];
                $dataset[$rownum]['result_status']  = $row['result_status'];
                $dataset[$rownum]['invoice_status'] = $row['invoice_status'];
                $dataset[$rownum]['remarks']        = $row['remarks'];
                $dataset[$rownum]['synch_out']        = $row['synch_out'];
                $dataset[$rownum]['synch_remarks']= $row['synch_remarks'];
                $dataset[$rownum]['product_code']   = $row['product_code'];
                $dataset[$rownum]['loinc_num']   = $row['loinc_num'];
                $dataset[$rownum]['description']    = $row['description'];
                $dataset[$rownum]['retail_price']= $row['retail_price'];
                $dataset[$rownum]['supplier_id']    = $row['supplier_id'];
                $dataset[$rownum]['supplier_name']  = $row['supplier_name'];
                $dataset[$rownum]['component']  = $row['component'];
                $rownum++;            
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_patcon_imaging($summary_id)

 
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
    function get_patcon_referrals($summary_id, $referral_id=NULL)
    {
        $dataset = array();
        $this->_summary_id   =   $summary_id;
        if(isset($referral_id)){
            $this->_referral_id =   $referral_id;
        } else {
            $this->_referral_id =   NULL;
        }
        $sqlQuery   =   "SELECT pref.*,";
        $sqlQuery   .=  " referral_doctor.doctor_name, referral_doctor.specialty,referral_doctor.email AS doctor_email,";
        $sqlQuery   .=  "  referral_center.*,";
        $sqlQuery   .=  "  pcon.signed_by,";
        $sqlQuery   .=  "  sinf.staff_name";
        $sqlQuery   .=  " FROM patient_referral pref";
        $sqlQuery   .=  " JOIN referral_doctor ON pref.referral_doctor_id = referral_doctor.referral_doctor_id";
        $sqlQuery   .=  " JOIN referral_center ON referral_doctor.referral_center_id = referral_center.referral_center_id";
        $sqlQuery   .=  " LEFT OUTER JOIN patient_consultation_summary pcon ON pref.session_id = pcon.summary_id";
        $sqlQuery   .=  " LEFT OUTER JOIN staff_info sinf ON pcon.signed_by = sinf.staff_id";
        $sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        if(isset($referral_id)){
            $sqlQuery   .=  " AND pref.referral_id='".$this->_referral_id."'";
        }
        $sqlQuery   .=  " ORDER BY pref.referral_centre";
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
    } //end of function get_patcon_referrals($summary_id)

 
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
    function get_patcon_vitals($summary_id)
    {
        $data = array();
        $this->_summary_id  =   $summary_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_vital";
        $sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        } else {
            $data['vital_id'] = "new_vitals";
        }            
        return $data; 
    } //end of function get_patcon_vitals($summary_id)

 
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

 
    //************************************************************************
    /**
     * Method to retrieve array of diagnosis for an episode.
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $diagnosis_id    Optional
	 * @param   string  $cleanup         Optional
	 * @param   string  $prediagnosis    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patcon_diagnosis($summary_id, $diagnosis_id=NULL,$cleanup="htmlspecialchars",$prediagnosis=FALSE)
    {
        $dataset = array();
        $this->_summary_id   =   $summary_id;
        if(isset($diagnosis_id)){
            $this->_diagnosis_id =   $diagnosis_id;
        } else {
            $this->_diagnosis_id =   NULL;
        }
        $sqlQuery   =   "SELECT patient_diagnosis.*,";
        $sqlQuery   .=  " dcode1ext.dcode1ext_shortname, dcode1ext.full_title,";
        $sqlQuery   .=  " dcode1.chapter, dcode1.dcode1_code";
        $sqlQuery   .=  " FROM patient_diagnosis, dcode1ext, dcode1";
        $sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        $sqlQuery   .=  " AND patient_diagnosis.dcode1ext_code=dcode1ext.dcode1ext_code";
        $sqlQuery   .=  " AND dcode1ext.dcode1_id=dcode1.dcode1_id";
        if(isset($diagnosis_id)){
            $sqlQuery   .=  " AND patient_diagnosis.diagnosis_id='".$this->_diagnosis_id."'";
        }
        if($prediagnosis==TRUE){
            $sqlQuery   .=  " AND patient_diagnosis.diagnosis_type='Pre-diagnostic'";
        } else {
            $sqlQuery   .=  " AND patient_diagnosis.diagnosis_type<>'Pre-diagnostic'";
        }
        $sqlQuery   .=  " ORDER BY patient_diagnosis.dcode1ext_code";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['diagnosis_id']   = $row['diagnosis_id'];
                $dataset[$rownum]['diagnosis_type'] = $row['diagnosis_type'];
                $dataset[$rownum]['diagnosis_notes']= $row['notes'];
                $dataset[$rownum]['dcode1set']      = $row['dcode1set'];
                $dataset[$rownum]['dcode1ext_code'] = $row['dcode1ext_code'];
                $dataset[$rownum]['dcode2set']      = $row['dcode2set'];
                $dataset[$rownum]['dcode2ext_code'] = $row['dcode2ext_code'];
                $dataset[$rownum]['remarks']        = $row['remarks'];
                $dataset[$rownum]['full_title']     = $row['full_title'];
                if($cleanup=="htmlspecialchars"){
                    $dataset[$rownum]['remarks']    =   htmlspecialchars($dataset[$rownum]['remarks']);
                    $dataset[$rownum]['full_title']    =   htmlspecialchars($dataset[$rownum]['full_title']);
                }
                $dataset[$rownum]['dcode1_code']    = $row['dcode1_code'];
                if($cleanup=="htmlspecialchars"){
                }
                $dataset[$rownum]['diagnosisChapter']= $row['chapter'];
                $dataset[$rownum]['diagnosisCategory']= $row['dcode1_code'];
                $dataset[$rownum]['diagnosis']      = $row['dcode1ext_code'];
                $dataset[$rownum]['diagnosis2']     = $row['dcode2ext_code'];
                $dataset[$rownum]['edit_remarks']   = $row['edit_remarks'];
                $dataset[$rownum]['edit_staff']     = $row['edit_staff'];
                $dataset[$rownum]['edit_date']      = $row['edit_date'];
                $dataset[$rownum]['confirm_dcode1ext']= $row['confirm_dcode1ext'];
                $dataset[$rownum]['confirm_remarks']= $row['confirm_remarks'];
                $dataset[$rownum]['confirm_staff']  = $row['confirm_staff'];
                $dataset[$rownum]['confirm_date']   = $row['confirm_date'];
                $dataset[$rownum]['synch_out']      = $row['synch_out'];
                $dataset[$rownum]['synch_remarks']  = $row['synch_remarks'];
                $rownum++;            
            }
        /*
        } else { //create dummy row
            $dataset[1]['diagnosis_id']   = "new_diagnosis";
            $dataset[1]['diagnosis_type'] = "";
            $dataset[1]['notes']          = "";
            $dataset[1]['dcode1ext_code'] = "";
        */
        reset($query);
        }
        return $dataset; 
    } //end of function get_patcon_diagnosis($summary_id)

 
    //************************************************************************
    /**
     * Method to retrieve list of lab packages
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_lab_packages_list($location_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT lab_package.*,";
        $sqlQuery   .=  " clinic_info,clinic_shortname";
        $sqlQuery   .=  " FROM lab_package";
        $sqlQuery   .=  " JOIN clinic_info ON lab_package.location_id=clinic_info.clinic_info_id";
        if(isset($location_id)){
            $sqlQuery   .=  " AND lab_package.location_id='".$location_id."'";
        }
        $sqlQuery   .=  " ORDER BY package_code";
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
    } //end of function get_lab_packages_list()


    //************************************************************************
    /**
     * Method to retrieve list of lab suppliers
     *
     * This method 
     *
	 * @param   string  $package_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_supplier_by_labpackage($package_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT lab_supplier.*";
        $sqlQuery   .=  " FROM lab_package";
        $sqlQuery   .=  " JOIN lab_supplier ON lab_package.supplier_id=lab_supplier.supplier_id";
        $sqlQuery   .=  " WHERE lab_package_id = '$package_id'";
        $sqlQuery   .=  " ORDER BY supplier_name";
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
    } //end of function get_supplier_by_labpackage($package_id)


    //************************************************************************
    /**
     * Method to retrieve details of one lab package. TO DEPRECATE
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_lab_package($package_id, $test_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT lab_package.*,";
        //$sqlQuery   .=  " ltes.lab_package_test_id, ltes.sort_test, ltes.test_name, ltes.test_code, 
		//					ltes.loinc_num, ltes.sample_required as test_sample, ltes.normal_adult, 
		//					ltes.normal_child, ltes.normal_infant, ltes.test_remarks,";
        $sqlQuery   .=  " lab_supplier.supplier_name,";
        $sqlQuery   .=  " lcls.class_name";
        $sqlQuery   .=  " FROM lab_package";
        //$sqlQuery   .=  " LEFT OUTER JOIN lab_package_test ltes ON lab_package.lab_package_id=ltes.lab_package_id";
        //$sqlQuery   .=  " JOIN lab_package_test ltes ON lab_package.lab_package_id=ltes.lab_package_id";
        $sqlQuery   .=  " JOIN lab_supplier ON lab_package.supplier_id=lab_supplier.supplier_id";
        $sqlQuery   .=  " LEFT OUTER JOIN loinc_class lcls ON lab_package.loinc_class_id=lcls.loinc_class_id";
        $sqlQuery   .=  " WHERE lab_package.lab_package_id='".$package_id."'";
		if(isset($test_id)){
			//$sqlQuery   .=  " AND ltes.lab_package_test_id='".$test_id."'";
		}
        //$sqlQuery   .=  " ORDER BY ltes.sort_test";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
				$row_num++;
                $data[] = $row;
                /*
				$data[($row_num-1)]['test_result_'.$row_num]	=	"";//$row_num;
				$data[($row_num-1)]['test_normal_'.$row_num]	=	$row['normal_adult'];
				$data[($row_num-1)]['test_remark_'.$row_num]	=	"";//$row_num+100;
                */
            }
        //} else {
        //    $data[0]['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_one_lab_package($package_id)

 
    //************************************************************************
    /**
     * Method to retrieve details of one lab package. TO DEPRECATE
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_lab_package_test($package_id, $test_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT lab_package.*,";
        $sqlQuery   .=  " ltes.lab_package_test_id, ltes.sort_test, ltes.test_name, ltes.test_code, 
							ltes.loinc_num, ltes.sample_required as test_sample, ltes.normal_adult, 
							ltes.normal_child, ltes.normal_infant, ltes.test_remarks,";
        $sqlQuery   .=  " lcls.class_name";
        $sqlQuery   .=  " FROM lab_package";
        //$sqlQuery   .=  " LEFT OUTER JOIN lab_package_test ltes ON lab_package.lab_package_id=ltes.lab_package_id";
        $sqlQuery   .=  " JOIN lab_package_test ltes ON lab_package.lab_package_id=ltes.lab_package_id";
        $sqlQuery   .=  " LEFT OUTER JOIN loinc_class lcls ON lab_package.loinc_class_id=lcls.loinc_class_id";
        $sqlQuery   .=  " WHERE lab_package.lab_package_id='".$package_id."'";
		if(isset($test_id)){
			$sqlQuery   .=  " AND ltes.lab_package_test_id='".$test_id."'";
		}
        $sqlQuery   .=  " ORDER BY ltes.sort_test";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
				$row_num++;
                $data[] = $row;
				$data[($row_num-1)]['test_result_'.$row_num]	=	"";//$row_num;
				$data[($row_num-1)]['test_normal_'.$row_num]	=	$row['normal_adult'];
				$data[($row_num-1)]['test_remark_'.$row_num]	=	"";//$row_num+100;
            }
        //} else {
        //    $data[0]['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_one_lab_package_test($package_id)

 
    //************************************************************************
    /**
     * Method to retrieve details of one lab package.
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_lab_orderresult($order_id, $result_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT lord.*,";
        $sqlQuery   .=  " lres.lab_package_test_id, lres.result, lres.normal_reading, lres.result_remarks,";
		$sqlQuery   .=  " ltes.sort_test, ltes.test_name, ltes.test_code, 
							ltes.loinc_num, ltes.sample_required as test_sample, ltes.normal_adult, 
							ltes.normal_child, ltes.normal_infant, ltes.test_remarks,";
		$sqlQuery   .=  "  lab_package.sample_required";
        $sqlQuery   .=  " FROM lab_result lres";
        $sqlQuery   .=  " JOIN lab_order lord ON lord.lab_order_id=lres.lab_order_id";
        $sqlQuery   .=  " JOIN lab_package_test ltes ON lres.lab_package_test_id=ltes.lab_package_test_id";
		$sqlQuery   .=  " LEFT OUTER JOIN lab_package ON ltes.lab_package_id=lab_package.lab_package_id";
        $sqlQuery   .=  " WHERE lord.lab_order_id='".$order_id."'";

		if(isset($result_id)){
			$sqlQuery   .=  " AND ltes.lab_package_test_id='".$result_id."'";
		}
        $sqlQuery   .=  " ORDER BY ltes.sort_test";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
				$row_num++;
                $data[] = $row;
				$data[($row_num-1)]['test_result_'.$row_num]	=	$row['result'];
				$data[($row_num-1)]['test_normal_'.$row_num]	=	$row['normal_adult'];
				$data[($row_num-1)]['test_remark_'.$row_num]	=	$row['result_remarks'];
            }
        //} else {
        //    $data[0]['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_one_lab_package($package_id)

 
    //************************************************************************
    /**
     * Method to retrieve list of diagnosis chapters
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_imaging_categories()
    {
        $data = array();
        $sqlQuery   =   "SELECT DISTINCT loinc.class_name, loinc_class.class_group";
        $sqlQuery   .=  " FROM imaging_product";
        $sqlQuery   .=  " JOIN loinc ON imaging_product.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " JOIN loinc_class ON loinc.class_name=loinc_class.class_name";
        $sqlQuery   .=  " ORDER BY class_name";
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
    } //end of function get_imaging_categories()


    //************************************************************************
    /**
     * Method to retrieve list of imaging products
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_imaging_product_by_category($category, $location_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM imaging_product";
        $sqlQuery   .=  " JOIN loinc ON imaging_product.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " JOIN loinc_class ON loinc.class_name=loinc_class.class_name";
        $sqlQuery   .=  " WHERE loinc.class_name = '$category'";
        if(isset($location_id)){
            $sqlQuery   .=  " AND imaging_product.location_id = '$location_id'";
        }
        $sqlQuery   .=  " ORDER BY component";
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
    } //end of function get_imaging_product_by_category($category)


    //************************************************************************
    /**
     * Method to retrieve list of supplier
     *
     * This method 
     *
	 * @param   string  $product_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_supplier_by_product($product_id=NULL)
    {
        $data = array();
        if(empty($dcode1)) {
            $dcode1 = "NULL";
        }
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM imaging_product";
        $sqlQuery   .=  " JOIN imaging_supplier ON imaging_product.supplier_id=imaging_supplier.supplier_id";
        $sqlQuery   .=  " WHERE imaging_product.product_id = '$product_id'";
        $sqlQuery   .=  " ORDER BY supplier_name";
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
    } //end of function get_supplier_by_product($product_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve details of one product.
     *
     * 
     *
	 * @param   string  $order_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_imaging_product($order_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT imaging_order.*,";
        $sqlQuery   .=  " imaging_product.product_code, imaging_product.supplier_id,";
        $sqlQuery   .=  " ires.result_date, ires.notes, ires.result_remarks, ires.result_reviewed_by, ires.result_reviewed_date, ires.result_ref, ires.recorded_timestamp,";
        $sqlQuery   .=  " loinc.class_name";
        $sqlQuery   .=  " FROM imaging_order";
        $sqlQuery   .=  " JOIN imaging_product ON imaging_order.product_id=imaging_product.product_id";
        $sqlQuery   .=  " LEFT OUTER JOIN imaging_result ires ON imaging_order.order_id=ires.order_id";
        $sqlQuery   .=  " JOIN loinc ON imaging_product.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " WHERE imaging_order.order_id='".$order_id."'";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        } else {
            $data['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_one_imaging_product($order_id)

 
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
     * Method to retrieve array of prescriptions for an episode.
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $diagnosis_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patcon_prescribe($summary_id, $queue_id=NULL,$cleanup='htmlspecialchars')
    {
        $dataset = array();
        $this->_summary_id   =   $summary_id;
        if(isset($queue_id)){
            $this->_queue_id =   $queue_id;
        } else {
            $this->_queue_id =   NULL;
        }
        $sqlQuery   =   "SELECT prescript_queue.*,";
        $sqlQuery   .=  " drug_formulary.generic_name, drug_formulary.formulary_code, drug_formulary.formulary_system,";
        $sqlQuery   .=  " drug_code.trade_name";
        $sqlQuery   .=  " FROM prescript_queue"; //, dcode1";
        $sqlQuery   .=  " JOIN drug_formulary ON prescript_queue.drug_formulary_id=drug_formulary.drug_formulary_id";
        $sqlQuery   .=  " LEFT OUTER JOIN drug_code ON prescript_queue.drug_code_id=drug_code.drug_code_id";
        $sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        //$sqlQuery   .=  " AND prescript_queue.drug_formulary_id=drug_formulary.drug_formulary_id";
        //$sqlQuery   .=  " AND dcode1ext.dcode1_id=dcode1.dcode1_id";
        if(isset($queue_id)){
            $sqlQuery   .=  " AND prescript_queue.queue_id='".$this->_queue_id."'";
        }
        $sqlQuery   .=  " ORDER BY drug_formulary.generic_name";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['queue_id']       = $row['queue_id'];
                $dataset[$rownum]['drug_formulary_id'] = $row['drug_formulary_id'];
                $dataset[$rownum]['dose']           = $row['dose'];
                $dataset[$rownum]['dose_form']      = $row['dose_form'];
                $dataset[$rownum]['frequency']      = $row['frequency'];
                $dataset[$rownum]['instruction']    = $row['instruction'];
                if($cleanup=="htmlspecialchars"){
                    $dataset[$rownum]['instruction']    =   htmlspecialchars($dataset[$rownum]['instruction']);
                }
                $dataset[$rownum]['quantity']       = $row['quantity'];
                $dataset[$rownum]['quantity_form']  = $row['quantity_form'];
                $dataset[$rownum]['indication']     = $row['indication'];
                $dataset[$rownum]['caution']        = $row['caution'];
                $dataset[$rownum]['status']         = $row['status'];
                $dataset[$rownum]['dose_duration']  = $row['dose_duration'];
                $dataset[$rownum]['synch_out']      = $row['synch_out'];
                $dataset[$rownum]['synch_remarks']  = $row['synch_remarks'];
                $dataset[$rownum]['formulary_code'] = $row['formulary_code'];
                $dataset[$rownum]['generic_name']   = $row['generic_name'];
                if($cleanup=="htmlspecialchars"){
                    $dataset[$rownum]['generic_name']    =   htmlspecialchars($dataset[$rownum]['generic_name']);
                }
                $dataset[$rownum]['formulary_system']= $row['formulary_system'];
                $dataset[$rownum]['drug_code_id']   = $row['drug_code_id']; 
                $dataset[$rownum]['trade_name']   = $row['trade_name'];
                $rownum++;            
            }
        /*
        } else { //create dummy row
            $dataset[1]['diagnosis_id']   = "new_prescribe";
            $dataset[1]['diagnosis_type'] = "";
            $dataset[1]['notes']          = "";
            $dataset[1]['dcode1ext_code'] = "";
        */
        reset($query);
        }
        return $dataset; 
    } //end of function get_patcon_prescribe($summary_id)

 
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


    //************************************************************************
    /**
     * Method to retrieve list of external modules
     *
     * This method 
     *
	 * @param   string  call_from      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_externalmod_list($call_from,$gem_module_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM gem_module";
        $sqlQuery   .=  " WHERE gem_active=TRUE";
        switch ($call_from){
            case "clinic":
                $sqlQuery   .=   " AND gem_module_urllink IS NOT NULL";
                break;			
            case "patient":
                $sqlQuery   .=   " AND gem_module_ovurllink IS NOT NULL";
                break;			
            case "episode":
                $sqlQuery   .=   " AND gem_module_pcurllink IS NOT NULL";
                break;			
        } //end switch ($_SESSION['thirra_mode'])
        if(isset($gem_module_id)){
                $sqlQuery   .=  " AND gem_module_id = '".$gem_module_id."'";
        }
        $sqlQuery   .=  " ORDER BY gem_module_sort";
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
    } //end of function get_externalmod_list($call_from)


    //************************************************************************
    /**
     * Method to retrieve details for an antenatal event.
     *
     * 
     *
	 * @param   string  $summary_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_antenatal_list($format='list', $patient_id, $antenatal_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT pant.antenatal_id, pant.status, pant.antenatal_reference, pant.session_id, ainf.*, acur.*, peve.*";
        $sqlQuery   .=  " ,adel.antenatal_delivery_id,adel.date_admission,adel.time_admission,adel.date_delivery,adel.time_delivery,adel.delivery_type,adel.delivery_place,adel.mother_condition,adel.baby_condition,adel.baby_weight,adel.complication_icpc,adel.complication_notes,adel.delivery_outcome, adel.child_id,";
        $sqlQuery   .=  " cdem.name, cdem.name_first";
        $sqlQuery   .=  " FROM patient_antenatal pant";
        $sqlQuery   .=  " JOIN patient_event peve ON pant.antenatal_id=peve.event_id";
        $sqlQuery   .=  " JOIN patient_antenatal_info ainf ON pant.antenatal_id=ainf.antenatal_info_id";
        $sqlQuery   .=  " JOIN patient_antenatal_current acur ON pant.antenatal_id=acur.antenatal_id";
        $sqlQuery   .=  " LEFT OUTER JOIN patient_antenatal_delivery adel ON pant.antenatal_id=adel.antenatal_id";
        $sqlQuery   .=  " LEFT OUTER JOIN patient_demographic_info cdem ON adel.child_id=cdem.patient_id";
        $sqlQuery   .=  " WHERE pant.patient_id='".$this->_patient_id."'";
        if($format == 'Open'){
            $sqlQuery   .=  " AND pant.status=0";
        }
        if(isset($antenatal_id)){
            $sqlQuery   .=  " AND pant.antenatal_id='".$antenatal_id."'";
        }
        $sqlQuery   .=  " ORDER BY ainf.gravida,ainf.date DESC";
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
                $data[0]['antenatal_id'] = "new_antenatal";
            }
        }            
        return $data; 
    } //end of function get_antenatal_list($format='List', $patient_id, $antenatal_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve list of antenatal follow-ups.
     *
     * 
     *
	 * @param   string  $summary_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_antenatal_followup($format='list', $patient_id, $antenatal_id=NULL, $antenatal_followup_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT *
                            FROM patient_antenatal pant";
        $sqlQuery   .=  " JOIN patient_antenatal_followup afup ON pant.antenatal_id=afup.antenatal_id";
        $sqlQuery   .=  " WHERE pant.patient_id='".$patient_id."'";
        if($format == 'Open'){
            $sqlQuery   .=  " AND pant.status=0";
        }
        if(!empty($antenatal_id)){
            $sqlQuery   .=  " AND afup.antenatal_id='".$antenatal_id."'";
        }
        if(!empty($antenatal_followup_id)){
            $sqlQuery   .=  " AND afup.antenatal_followup_id='".$antenatal_followup_id."'";
        }
        $sqlQuery   .=  " ORDER BY afup.date DESC";
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
                $data[0]['antenatal_followup_id'] = "new_followup";
            }
        }            
        return $data; 
    } //end of function get_antenatal_followup($format='list', $patient_id, $antenatal_id=NULL, $antenatal_followup_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve list of antenatal deliveries/terminations.
     *
     * 
     *
	 * @param   string  $summary_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_antenatal_delivery($format='list', $patient_id, $antenatal_id=NULL, $antenatal_delivery_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT pant.*, adel.*, cdem.name, cdem.name_first
                            FROM patient_antenatal pant";
        $sqlQuery   .=  " JOIN patient_antenatal_delivery adel ON pant.antenatal_id=adel.antenatal_id";
        $sqlQuery   .=  " LEFT OUTER JOIN patient_demographic_info cdem ON adel.child_id=cdem.patient_id";
        $sqlQuery   .=  " WHERE pant.antenatal_id='".$antenatal_id."'";
        if($format == 'Open'){
            $sqlQuery   .=  " AND pant.status=0";
        }
        if(!empty($antenatal_delivery_id)){
            $sqlQuery   .=  " AND adel.antenatal_delivery_id='".$antenatal_delivery_id."'";
        }
        $sqlQuery   .=  " ORDER BY adel.date_delivery, adel.time_delivery DESC";
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
                $data[0]['antenatal_delivery_id'] = "new_delivery";
            }
        }            
        return $data; 
    } //end of function get_antenatal_delivery($format='list', $patient_id, $antenatal_id=NULL, $antenatal_delivery_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of one lab package.
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function getsimple_one_lab_results($order_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT lord.*,";
        $sqlQuery   .=  " lres.result, lres.normal_reading, lres.result_remarks,";
        $sqlQuery   .=  " ltes.lab_package_test_id, ltes.sort_test, ltes.test_name, ltes.test_code, 
							ltes.loinc_num, ltes.sample_required as test_sample, ltes.normal_adult, 
							ltes.normal_child, ltes.normal_infant, ltes.test_remarks";
        $sqlQuery   .=  " FROM lab_order lord";
        $sqlQuery   .=  " JOIN lab_result lres ON lord.lab_order_id=lres.lab_order_id";
        $sqlQuery   .=  " JOIN lab_package_test ltes ON lres.lab_package_test_id=ltes.lab_package_test_id";
        $sqlQuery   .=  " WHERE lord.lab_order_id='".$order_id."'";
        $sqlQuery   .=  " ORDER BY ltes.sort_test";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
				$row_num++;
                $data[] = $row;
				$data[($row_num-1)]['test_result_'.$row_num]	=	$row['result'];
				$data[($row_num-1)]['test_normal_'.$row_num]	=	$row['normal_reading'];
				$data[($row_num-1)]['test_remark_'.$row_num]	=	$row['result_remarks'];
            }
        //} else {
        //    $data[0]['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function getsimple_one_lab_results($order_id)

 
    //************************************************************************
    /**
     * Method to retrieve details of one lab package.
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_lab_results($order_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT lord.*,";
        $sqlQuery   .=  " lres.lab_result_id, lres.date_recorded, lres.reply_method, lres.reply_ack_date, 
                            lres.result, lres.normal_reading, lres.abnormal_flag, lres.result_remarks, 
                            lres.lab_enhanced_id, lres.result_ref, lres.recorded_timestamp,";
        $sqlQuery   .=  " ltes.lab_package_test_id, ltes.sort_test, ltes.test_name, ltes.test_code, 
							ltes.loinc_num, ltes.sample_required as test_sample, ltes.normal_adult, 
							ltes.normal_child, ltes.normal_infant, ltes.test_remarks";
        $sqlQuery   .=  " FROM lab_order lord";
        $sqlQuery   .=  " LEFT OUTER JOIN lab_result lres ON lord.lab_order_id=lres.lab_order_id";
        $sqlQuery   .=  " JOIN lab_package_test ltes ON lres.lab_package_test_id=ltes.lab_package_test_id";
        $sqlQuery   .=  " WHERE lord.lab_order_id='".$order_id."'";
        $sqlQuery   .=  " ORDER BY ltes.sort_test";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
				$row_num++;
                $data[] = $row;
				$data[($row_num-1)]['test_result_'.$row_num]	=	$row['result'];
				$data[($row_num-1)]['test_normal_'.$row_num]	=	$row['normal_reading'];
				$data[($row_num-1)]['test_remark_'.$row_num]	=	$row['result_remarks'];
            }
        } else {
            $data[0]['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_one_lab_results($order_id)

 
    //************************************************************************
    /**
     * Method to retrieve array of pending imaging orders (for a clinic).
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $location_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function getsimple_one_imaging_result($order_id)
    {
        $dataset = array();
        if(isset($location_id)){
            $this->_location_id =   $location_id;
        } else {
            $this->_location_id =   NULL;
        }
        $sqlQuery   =   "SELECT iord.*,";
        $sqlQuery   .=  " ires.result_id,ires.result_date,ires.notes,ires.image_path,ires.staff_id AS result_staff,";
        $sqlQuery   .=  " imaging_product.product_code, imaging_product.description,";
        $sqlQuery   .=  " imaging_supplier.supplier_id, imaging_supplier.supplier_name,";
        $sqlQuery   .=  " patient_demographic_info.name, patient_demographic_info.name_first, patient_demographic_info.birth_date,";
        $sqlQuery   .=  " patient_consultation_summary.date_ended";
        $sqlQuery   .=  " FROM imaging_order iord";
        $sqlQuery   .=  " JOIN imaging_result ires ON iord.order_id=ires.order_id";
        $sqlQuery   .=  " JOIN imaging_product ON iord.product_id=imaging_product.product_id";
        $sqlQuery   .=  " JOIN imaging_supplier ON imaging_product.supplier_id=imaging_supplier.supplier_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON iord.patient_id=patient_demographic_info.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON iord.session_id=patient_consultation_summary.summary_id";
        $sqlQuery   .=  " WHERE iord.order_id='".$order_id."'";
        //$sqlQuery   .=  " ORDER BY imaging_order.sample_date";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        reset($query);
        }
        return $dataset; 
    } //end of function getsimple_one_imaging_result($order_id)

 
    //************************************************************************
    /**
     * Method to retrieve array of pending imaging orders (for a clinic).
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $location_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_imaging_result($order_id)
    {
        $dataset = array();
        if(isset($location_id)){
            $this->_location_id =   $location_id;
        } else {
            $this->_location_id =   NULL;
        }
        $sqlQuery   =   "SELECT iord.*,";
        $sqlQuery   .=  " ires.result_id,ires.result_date,ires.notes,ires.image_path,ires.staff_id AS result_staff,";
        $sqlQuery   .=  " ires.result_remarks,ires.result_reviewed_by,ires.result_reviewed_date,ires.result_ref,ires.recorded_timestamp,";
        $sqlQuery   .=  " imaging_product.product_code, imaging_product.description,";
        $sqlQuery   .=  " imaging_supplier.supplier_id, imaging_supplier.supplier_name,";
        $sqlQuery   .=  " patient_demographic_info.name, patient_demographic_info.name_first, patient_demographic_info.birth_date,";
        $sqlQuery   .=  " patient_consultation_summary.date_ended";
        $sqlQuery   .=  " FROM imaging_order iord";
        $sqlQuery   .=  " LEFT OUTER JOIN imaging_result ires ON iord.order_id=ires.order_id";
        $sqlQuery   .=  " JOIN imaging_product ON iord.product_id=imaging_product.product_id";
        $sqlQuery   .=  " JOIN imaging_supplier ON imaging_product.supplier_id=imaging_supplier.supplier_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON iord.patient_id=patient_demographic_info.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON iord.session_id=patient_consultation_summary.summary_id";
        $sqlQuery   .=  " WHERE iord.order_id='".$order_id."'";
        //$sqlQuery   .=  " ORDER BY imaging_order.sample_date";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_one_imaging_result($order_id)

 
    //************************************************************************
    /**
     * Method to retrieve details of one lab package.
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_lab_packagetests($package_id, $test_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT lpak.*,";
        $sqlQuery   .=  " ltes.lab_package_test_id, ltes.sort_test, ltes.test_name, ltes.test_code, 
							ltes.loinc_num, ltes.sample_required as test_sample, ltes.normal_adult, 
							ltes.normal_child, ltes.normal_infant, ltes.test_remarks,";
        $sqlQuery   .=  " loinc.loinc_num, loinc.class_name";
        $sqlQuery   .=  " FROM lab_package lpak";
        //$sqlQuery   .=  " LEFT OUTER JOIN lab_package_test ltes ON lab_package.lab_package_id=ltes.lab_package_id";
        $sqlQuery   .=  " JOIN lab_package_test ltes ON lpak.lab_package_id=ltes.lab_package_id";
        $sqlQuery   .=  " JOIN loinc ON ltes.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " WHERE lpak.lab_package_id='".$package_id."'";
		if(isset($test_id)){
			$sqlQuery   .=  " AND ltes.lab_package_test_id='".$test_id."'";
		}
        $sqlQuery   .=  " ORDER BY ltes.sort_test";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
			$row_num	=	0;
            foreach ($query->result_array() as $row){
				$row_num++;
                $data[] = $row;
				$data[($row_num-1)]['test_result_'.$row_num]	=	"";//$row_num;
				$data[($row_num-1)]['test_normal_'.$row_num]	=	$row['normal_adult'];
				$data[($row_num-1)]['test_remark_'.$row_num]	=	"";//$row_num+100;
            }
        }
        return $data; 
    } //end of function get_lab_packagetests($package_id, $test_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve last session reference
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_last_session_reference()
    {
        $data = array();
        $sqlQuery   =   "SELECT MAX(session_ref) as max_ref";
        $sqlQuery   .=  " FROM patient_consultation_summary";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_last_session_reference()


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


}

/* End of file memr_rdb.php */
/* Location: ./app_thirra/models/memr_rdb.php */
