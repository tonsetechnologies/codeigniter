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
 * Portions created by the Initial Developer are Copyright (C) 2010-2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for EHR
 *
 * This class is for models that only writes to the database.
 *
 * @version 0.9.8
 * @package THIRRA - mEHR-Wdb
 * @author  Jason Tan Boon Teck
 */

class MEhr_wdb extends CI_Model
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
    // Insert Database Methods

    //************************************************************************
    /**
     * Method to add new patients
     *
     * This method adds a new patient to the clinic. It inserts row into 
     * patient_demographic_info, patient_contact_info, patient_correspondence,
     * patient_immunisation and patient_employment(if any)
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_patient($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        echo "<hr />";
        echo "Adding new patient details for ".$data_array['patient_name'];
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";

        // Begin transaction
        $this->db->trans_begin();
        
        // Insert row into patient_contact_info
        if(isset($data_array['contact_id'])){$this->db->set('contact_id', $data_array['contact_id']);} // Not NULL
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['contact_type'])){$this->db->set('contact_type', $data_array['contact_type']);}
        if(isset($data_array['start_date'])){$this->db->set('start_date', (string)$data_array['start_date']);}
        if(isset($data_array['end_date'])){$this->db->set('end_date', (string)$data_array['end_date']);}
        if(isset($data_array['patient_address'])){$this->db->set('address', (string)$data_array['patient_address']);}
        if(isset($data_array['patient_address2'])){$this->db->set('address_2', (string)$data_array['patient_address2']);}
        if(isset($data_array['patient_address3'])){$this->db->set('address_3', (string)$data_array['patient_address3']);}
        if(isset($data_array['patient_town'])){$this->db->set('town', (string)$data_array['patient_town']);}
        if(isset($data_array['patient_state'])){$this->db->set('state', (string)$data_array['patient_state']);}
        if(isset($data_array['patient_postcode'])){$this->db->set('postcode', (string)$data_array['patient_postcode']);}
        if(isset($data_array['patient_country'])){$this->db->set('country', (string)$data_array['patient_country']);}
        if(isset($data_array['tel_home'])){$this->db->set('tel_home', (string)$data_array['tel_home']);}
        if(isset($data_array['tel_office'])){$this->db->set('tel_office', (string)$data_array['tel_office']);}
        if(isset($data_array['tel_mobile'])){$this->db->set('tel_mobile', (string)$data_array['tel_mobile']);}
        if(isset($data_array['pager_no'])){$this->db->set('pager_no', (string)$data_array['pager_no']);}
        if(isset($data_array['fax_no'])){$this->db->set('fax_no', (string)$data_array['fax_no']);}
        if(isset($data_array['email'])){$this->db->set('email', (string)$data_array['email']);}
        if(isset($data_array['contact_other'])){$this->db->set('other', (string)$data_array['contact_other']);}
        if(isset($data_array['contact_remarks'])){$this->db->set('remarks', (string)$data_array['contact_remarks']);}
        if(isset($data_array['addr_village_id'])){$this->db->set('addr_village_id', (string)$data_array['addr_village_id']);}
        if(isset($data_array['addr_town_id'])){$this->db->set('addr_town_id', (string)$data_array['addr_town_id']);}
        if(isset($data_array['addr_area_id'])){$this->db->set('addr_area_id', (string)$data_array['addr_area_id']);}
        if(isset($data_array['addr_district_id'])){$this->db->set('addr_district_id', (string)$data_array['addr_district_id']);}
        if(isset($data_array['addr_state_id'])){$this->db->set('addr_state_id', (string)$data_array['addr_state_id']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        // Perform db insert
        $this->db->insert('patient_contact_info');
        //echo $this->db->last_query();
        echo "<br />Inserting into patient_contact_info";
		
        // Insert row into patient_correspondence
        if(isset($data_array['patient_correspondence_id'])){$this->db->set('patient_correspondence_id', $data_array['patient_correspondence_id']);} // Not NULL
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['correspondence_type'])){$this->db->set('contact_type', $data_array['correspondence_type']);}
        if(isset($data_array['start_date'])){$this->db->set('start_date', (string)$data_array['start_date']);}
        /*
        if(isset($data_array['end_date'])){$this->db->set('end_date', $data_array['end_date']);}
        if(isset($data_array['patient_address'])){$this->db->set('address', $data_array['patient_address']);}
        if(isset($data_array['patient_address2'])){$this->db->set('address_2', $data_array['patient_address2']);}
        if(isset($data_array['patient_address3'])){$this->db->set('address_3', $data_array['patient_address3']);}
        if(isset($data_array['patient_town'])){$this->db->set('town', $data_array['patient_town']);}
        if(isset($data_array['patient_state'])){$this->db->set('state', $data_array['patient_state']);}
        if(isset($data_array['patient_postcode'])){$this->db->set('postcode', $data_array['patient_postcode']);}
        */
        if(isset($data_array['country'])){$this->db->set('country', (string)$data_array['country']);}
        /*
        if(isset($data_array['tel_home'])){$this->db->set('tel_home', $data_array['tel_home']);}
        if(isset($data_array['tel_office'])){$this->db->set('tel_office', $data_array['tel_office']);}
        if(isset($data_array['tel_mobile'])){$this->db->set('tel_mobile', $data_array['tel_mobile']);}
        if(isset($data_array['pager_no'])){$this->db->set('pager_no', $data_array['pager_no']);}
        if(isset($data_array['fax_no'])){$this->db->set('fax_no', $data_array['fax_no']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        if(isset($data_array['other'])){$this->db->set('other', $data_array['other']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        */
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        // Perform db insert
        $this->db->insert('patient_correspondence');
        //echo $this->db->last_query();
        echo "<br />Inserting into patient_correspondence";
        
        // Insert into patient_demographic_info
        $this->db->set('patient_id', $data_array['patient_id']); // Not NULL
        if(isset($data_array['clinic_reference_number'])){$this->db->set('clinic_reference_number', (string)$data_array['clinic_reference_number']);}
        if(isset($data_array['pns_pat_id'])){$this->db->set('pns_pat_id', $data_array['pns_pat_id']);}
        if(isset($data_array['nhfa_no'])){$this->db->set('nhfa_no', $data_array['nhfa_no']);}
        if(isset($data_array['patient_name'])){$this->db->set('name', (string)$data_array['patient_name']);}
        if(isset($data_array['name_first'])){$this->db->set('name_first', (string)$data_array['name_first']);}
        if(isset($data_array['name_alias'])){$this->db->set('name_alias', (string)$data_array['name_alias']);}
        if(isset($data_array['shortname'])){$this->db->set('shortname', (string)$data_array['shortname']);}
        if(isset($data_array['gender'])){$this->db->set('gender', (string)$data_array['gender']);}
        if(isset($data_array['ic_no'])){$this->db->set('ic_no', (string)$data_array['ic_no']);}
        if(isset($data_array['ic_other_type'])){$this->db->set('ic_other_type', (string)$data_array['ic_other_type']);}
        if(isset($data_array['ic_other_no'])){$this->db->set('ic_other_no', (string)$data_array['ic_other_no']);}
        if(isset($data_array['nationality'])){$this->db->set('nationality', (string)$data_array['nationality']);}
        if(isset($data_array['birth_date'])){$this->db->set('birth_date', (string)$data_array['birth_date']);}
        if(isset($data_array['birth_cert_no'])){$this->db->set('birth_cert_no', (string)$data_array['birth_cert_no']);}
        if(isset($data_array['family_link'])){$this->db->set('family_link', (string)$data_array['family_link']);}
        if(isset($data_array['ethnicity'])){$this->db->set('ethnicity', (string)$data_array['ethnicity']);}
        if(isset($data_array['religion'])){$this->db->set('religion', (string)$data_array['religion']);}
        if(isset($data_array['marital_status'])){$this->db->set('marital_status', (string)$data_array['marital_status']);}
        if(isset($data_array['married_date'])){$this->db->set('married_date', $data_array['married_date']);}
        if(isset($data_array['spouse_id'])){$this->db->set('spouse_id', $data_array['spouse_id']);}
        if(isset($data_array['spouse_name'])){$this->db->set('spouse_name', $data_array['spouse_name']);}
        if(isset($data_array['company'])){$this->db->set('company', $data_array['company']);}
        if(isset($data_array['employee_no'])){$this->db->set('employee_no', $data_array['employee_no']);}
        if(isset($data_array['job_function'])){$this->db->set('job_function', $data_array['job_function']);}
        if(isset($data_array['job_industry'])){$this->db->set('job_industry', $data_array['job_industry']);}
        if(isset($data_array['patient_employment_id'])){$this->db->set('patient_employment_id', $data_array['patient_employment_id']);} // foreign key to patient_employment
        if(isset($data_array['family_income'])){$this->db->set('family_income', $data_array['family_income']);}
        if(isset($data_array['education_level'])){$this->db->set('education_level', $data_array['education_level']);}
        if(isset($data_array['patient_type'])){$this->db->set('patient_type', (string)$data_array['patient_type']);}
        if(isset($data_array['contact_id'])){$this->db->set('contact_id', (string)$data_array['contact_id']);} // Not NULL, foreign key to patient_contact_info
        if(isset($data_array['patient_correspondence_id'])){$this->db->set('correspondence_id', (string)$data_array['patient_correspondence_id']);}
        if(isset($data_array['organdonor_no'])){$this->db->set('organdonor_no', $data_array['organdonor_no']);}
        if(isset($data_array['organdonor_status'])){$this->db->set('organdonor_status', $data_array['organdonor_status']);}
        if(!empty($data_array['next_of_kin_id'])){$this->db->set('next_of_kin_id', $data_array['next_of_kin_id']);} // foreign key to patient_demographic_info
        if(isset($data_array['next_of_kin_name'])){$this->db->set('next_of_kin_name', $data_array['next_of_kin_name']);}
        if(isset($data_array['next_of_kin_relationship'])){$this->db->set('next_of_kin_relationship', $data_array['next_of_kin_relationship']);}
        if(isset($data_array['blood_group'])){$this->db->set('blood_group', (string)$data_array['blood_group']);}
        if(isset($data_array['blood_rhesus'])){$this->db->set('blood_rhesus', (string)$data_array['blood_rhesus']);}
        if(isset($data_array['demise_date'])){$this->db->set('demise_date', (string)$data_array['demise_date']);}
        if(isset($data_array['demise_time'])){$this->db->set('demise_time', (string)$data_array['demise_time']);}
        if(isset($data_array['death_cert'])){$this->db->set('death_cert', (string)$data_array['death_cert']);}
        if(isset($data_array['demise_code'])){$this->db->set('demise_code', (string)$data_array['demise_code']);}
        if(isset($data_array['demise_cause'])){$this->db->set('demise_cause', (string)$data_array['demise_cause']);}
        if(isset($data_array['clinic_home'])){$this->db->set('clinic_home', $data_array['clinic_home']);}
        if(isset($data_array['clinic_registered'])){$this->db->set('clinic_registered', $data_array['clinic_registered']);}
        if(isset($data_array['other'])){$this->db->set('other', $data_array['other']);}
        if(isset($data_array['patient_status'])){$this->db->set('status', $data_array['patient_status']);}
        if(isset($data_array['patdemo_remarks'])){$this->db->set('remarks', $data_array['patdemo_remarks']);}
        if(isset($data_array['birth_date_estimate'])){$this->db->set('birth_date_estimate', $data_array['birth_date_estimate']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        // Perform db insert
        $this->db->insert('patient_demographic_info');
        //echo $this->db->last_query();
        echo "<br />Inserting into patient_demographic_info";

        // Insert row into patient_immunisation
        if(isset($data_array['patient_immunisation_id'])){$this->db->set('patient_immunisation_id', $data_array['patient_immunisation_id']);} // Not NULL
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);} // Not NULL
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);} // Not NULL
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['birth_date'])){$this->db->set('date', (string)$data_array['birth_date']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        $this->db->set('immunisation_id', '0');
        // Perform db insert
        $this->db->insert('patient_immunisation');
        //echo $this->db->last_query();
        echo "<br />Inserting into patient_immunisation";
        
        // End transaction
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            echo "<br /><br />Some errors were found. Patient registration not completed.";
        } else {
            $this->db->trans_commit();
            echo "<br /><br />No errors found. Patient registration completed.";
        }
        echo "<hr />";
    } // end of function insert_new_patient($data_array)


    //************************************************************************
    /**
     * Method to insert New relationship 
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_relationship($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting patient_family_relationship";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
		// Insert into patient_family_relationship
        if(isset($data_array['relationship_id'])){$this->db->set('relationship_id', $data_array['relationship_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['head_id'])){$this->db->set('head_id', $data_array['head_id']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_family_relationship');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_family_relationship";
		
		// Insert into patient_family_details
        if(isset($data_array['family_details_id'])){$this->db->set('family_details_id', $data_array['family_details_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['family_position'])){$this->db->set('family_position', $data_array['family_position']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['generation_to_head'])){$this->db->set('generation_to_head', $data_array['generation_to_head']);}
        //if(isset($data_array['date_married'])){$this->db->set('date_married', $data_array['date_married']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_family_details');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_family_details";
		
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_relationship($data_array)


    //************************************************************************
    /**
     * Method to insert New drug allergy
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_drugallergy($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting imaging_product";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_drug_allergy
        if(isset($data_array['patient_drug_allergy_id'])){$this->db->set('patient_drug_allergy_id', $data_array['patient_drug_allergy_id']);}
        if(isset($data_array['allergy_active'])){$this->db->set('allergy_active', $data_array['allergy_active']);}
        if(isset($data_array['log_id'])){$this->db->set('log_id', $data_array['log_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['drug_code'])){$this->db->set('drug_code', $data_array['drug_code']);}
        if(isset($data_array['drug_formulary'])){$this->db->set('drug_formulary', $data_array['drug_formulary']);}
        if(isset($data_array['atc_code'])){$this->db->set('atc_code', $data_array['atc_code']);}
        if(isset($data_array['reaction'])){$this->db->set('reaction', $data_array['reaction']);}
        if(isset($data_array['added_remarks'])){$this->db->set('added_remarks', $data_array['added_remarks']);}
        if(isset($data_array['added_staff'])){$this->db->set('added_staff', $data_array['added_staff']);}
        if(isset($data_array['added_date'])){$this->db->set('added_date', $data_array['added_date']);}
        if(isset($data_array['generic_drugname'])){$this->db->set('generic_drugname', $data_array['generic_drugname']);}
        if(isset($data_array['drug_tradename'])){$this->db->set('drug_tradename', $data_array['drug_tradename']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_drug_allergy');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_drug_allergy";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_drugallergy($data_array)


    //************************************************************************
    /**
     * Method to insert New Uploaded File  
     *
     * This method creates a new consultation.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_bio_file($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        $_user_ip =   $this->input->ip_address();
        /*
        echo "<hr />";
        echo "Inserting pics details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        */
        // Insert into bio_file
        if(isset($data_array['bio_file_id'])){$this->db->set('bio_file_id', $data_array['bio_file_id']);}
        if(isset($data_array['bio_filename'])){$this->db->set('bio_filename', $data_array['bio_filename']);}
        if(isset($data_array['bio_origname'])){$this->db->set('bio_origname', $data_array['bio_origname']);}
        if(isset($data_array['bio_inv_id'])){$this->db->set('bio_inv_id', $data_array['bio_inv_id']);}
        if(isset($data_array['bio_patient_id'])){$this->db->set('bio_patient_id', $data_array['bio_patient_id']);}
        if(isset($data_array['bio_file_ref'])){$this->db->set('bio_file_ref', $data_array['bio_file_ref']);}
        if(isset($data_array['bio_file_title'])){$this->db->set('bio_file_title', $data_array['bio_file_title']);}
        if(isset($data_array['bio_file_descr'])){$this->db->set('bio_file_descr', $data_array['bio_file_descr']);}
        if(isset($data_array['bio_file_sort'])){$this->db->set('bio_file_sort', $data_array['bio_file_sort']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['date_uploaded'])){$this->db->set('date_uploaded', $data_array['date_uploaded']);}
        if(isset($data_array['time_uploaded'])){$this->db->set('time_uploaded', $data_array['time_uploaded']);}
        if(isset($data_array['bio_mimetype'])){$this->db->set('bio_mimetype', $data_array['bio_mimetype']);}
        if(isset($data_array['bio_fileext'])){$this->db->set('bio_fileext', $data_array['bio_fileext']);}
        if(isset($data_array['bio_filesize'])){$this->db->set('bio_filesize', $data_array['bio_filesize']);}
        if(isset($data_array['bio_filepath'])){$this->db->set('bio_filepath', $data_array['bio_filepath']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        $this->db->set('ip_uploaded', $_user_ip);
        if(isset($data_array['file_remarks'])){$this->db->set('file_remarks', $data_array['file_remarks']);}
        // Perform db insert
        $this->db->insert('bio_file');
        //echo $this->db->last_query();
        /*
        echo "<br />Inserted into bio_file";

        echo "<br />Inserted new pics";
        echo "<hr />";
        */
    } // end of function insert_bio_file($data_array)


    //************************************************************************
    /**
     * Method to insert New Uploaded File  
     *
     * This method creates a new consultation.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_patient_file($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        $_user_ip =   $this->input->ip_address();
        /*
        echo "<hr />";
        echo "Inserting pics details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        */
        // Insert into patient_file
        if(isset($data_array['patient_file_id'])){$this->db->set('patient_file_id', $data_array['patient_file_id']);}
        if(isset($data_array['file_filename'])){$this->db->set('file_filename', $data_array['file_filename']);}
        if(isset($data_array['file_origname'])){$this->db->set('file_origname', $data_array['file_origname']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['file_category'])){$this->db->set('file_category', $data_array['file_category']);}
        if(isset($data_array['file_ref'])){$this->db->set('file_ref', $data_array['file_ref']);}
        if(isset($data_array['file_title'])){$this->db->set('file_title', $data_array['file_title']);}
        if(isset($data_array['file_descr'])){$this->db->set('file_descr', $data_array['file_descr']);}
        if(isset($data_array['file_sort'])){$this->db->set('file_sort', $data_array['file_sort']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['file_upload_time'])){$this->db->set('file_upload_time', $data_array['file_upload_time']);}
        if(isset($data_array['file_mimetype'])){$this->db->set('file_mimetype', $data_array['file_mimetype']);}
        if(isset($data_array['file_extension'])){$this->db->set('file_extension', $data_array['file_extension']);}
        if(isset($data_array['file_size'])){$this->db->set('file_size', $data_array['file_size']);}
        if(isset($data_array['file_path'])){$this->db->set('file_path', $data_array['file_path']);}
        if(isset($data_array['summary_id'])){$this->db->set('summary_id', $data_array['summary_id']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        $this->db->set('ip_uploaded', $_user_ip);
        if(isset($data_array['file_remarks'])){$this->db->set('file_remarks', $data_array['file_remarks']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
        // Perform db insert
        $this->db->insert('patient_file');
        //echo $this->db->last_query();
        /*
        echo "<br />Inserted into patient_file";

        echo "<br />Inserted new pics";
        echo "<hr />";
        */
    } // end of function insert_patient_file($data_array)


    //************************************************************************
    /**
     * Method to insert New Uploaded File  
     *
     * This method creates a new consultation.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_social_history($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting pics details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
       */
        // Insert into patient_social_history
        if(isset($data_array['social_history_id'])){$this->db->set('social_history_id', $data_array['social_history_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['record_date'])){$this->db->set('date', $data_array['record_date']);}
        if(isset($data_array['safety_belt_use'])){$this->db->set('safety_belt_use', $data_array['safety_belt_use']);}
        if(isset($data_array['helmet_use'])){$this->db->set('helmet_use', $data_array['helmet_use']);}
        if(isset($data_array['drugs_use'])){$this->db->set('drugs_use', $data_array['drugs_use']);}
        if(isset($data_array['drugs_spec'])){$this->db->set('drugs_spec', $data_array['drugs_spec']);}
        if(isset($data_array['alcohol_use'])){$this->db->set('alcohol_use', $data_array['alcohol_use']);}
        if(isset($data_array['alcohol_spec'])){$this->db->set('alcohol_spec', $data_array['alcohol_spec']);}
        if(isset($data_array['tobacco_use'])){$this->db->set('tobacco_use', $data_array['tobacco_use']);}
        if(isset($data_array['tobacco_spec'])){$this->db->set('tobacco_spec', $data_array['tobacco_spec']);}
        if(isset($data_array['exercise_use'])){$this->db->set('exercise_use', $data_array['exercise_use']);}
        if(isset($data_array['exercise_spec'])){$this->db->set('exercise_spec', $data_array['exercise_spec']);}
        if(isset($data_array['trauma'])){$this->db->set('trauma', $data_array['trauma']);}
        if(isset($data_array['hospitalizations'])){$this->db->set('hospitalizations', $data_array['hospitalizations']);}
        if(isset($data_array['illness'])){$this->db->set('illness', $data_array['illness']);}
        if(isset($data_array['operation'])){$this->db->set('operation', $data_array['operation']);}
        if(isset($data_array['family_income'])){$this->db->set('family_income', $data_array['family_income']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}

        // Perform db insert
        $this->db->insert('patient_social_history');
        //echo $this->db->last_query();
        /*
        echo "<br />Inserted into bio_file";

        echo "<br />Inserted new pics";
        echo "<hr />";
        */
    } // end of function insert_new_social_history($data_array)


    //************************************************************************
    /**
     * Method to insert New Prescription 
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required     
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_medication_history($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting prescript_queue details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";

        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_medication
        if(isset($data_array['medication_id'])){$this->db->set('medication_id', $data_array['medication_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['dispense_queue_id'])){$this->db->set('dispense_queue_id', $data_array['dispense_queue_id']);}
        if(isset($data_array['prescript_queue_id'])){$this->db->set('prescript_queue_id', $data_array['prescript_queue_id']);}
        if(isset($data_array['drug_formulary_id'])){$this->db->set('drug_formulary_id', $data_array['drug_formulary_id']);}
        if(isset($data_array['dose'])){$this->db->set('dose', $data_array['dose']);}
        if(isset($data_array['dose_form'])){$this->db->set('dose_form', $data_array['dose_form']);}
        if(isset($data_array['frequency'])){$this->db->set('frequency', $data_array['frequency']);}
        if(isset($data_array['instruction'])){$this->db->set('instruction', $data_array['instruction']);}
        if(isset($data_array['quantity'])){$this->db->set('quantity', $data_array['quantity']);}
        if(isset($data_array['quantity_form'])){$this->db->set('quantity_form', $data_array['quantity_form']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['date_started'])){$this->db->set('date_started', $data_array['date_started']);}
        if(isset($data_array['date_stopped'])){$this->db->set('date_stopped', $data_array['date_stopped']);}
        if(isset($data_array['reason'])){$this->db->set('reason', $data_array['reason']);}
        if(isset($data_array['stopped_by'])){$this->db->set('stopped_by', $data_array['stopped_by']);}
        if(isset($data_array['medication_importance'])){$this->db->set('medication_importance', $data_array['medication_importance']);}
        if(isset($data_array['dose_duration'])){$this->db->set('dose_duration', $data_array['dose_duration']);}
        if(isset($data_array['generic_drugname'])){$this->db->set('generic_drugname', $data_array['generic_drugname']);}
        if(isset($data_array['drug_tradename'])){$this->db->set('drug_tradename', $data_array['drug_tradename']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', (string)$data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', (string)$data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', (string)$data_array['synch_remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_medication');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_medication";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_medication_history($data_array)


    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update patient demographic info
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_patient_info($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        $this->db->set('clinic_reference_number', $data_array['clinic_reference_number']);
        $this->db->set('pns_pat_id', $data_array['pns_pat_id']);
        $this->db->set('nhfa_no', $data_array['nhfa_no']);
        $this->db->set('name', $data_array['patient_name']);
        $this->db->set('name_first', $data_array['name_first']);
        $this->db->set('name_alias', $data_array['name_alias']);
        //$this->db->set('shortname', $data_array['shortname']);
        $this->db->set('gender', $data_array['gender']);
        $this->db->set('ic_no', $data_array['ic_no']);
        $this->db->set('ic_other_type', $data_array['ic_other_type']);
        $this->db->set('ic_other_no', $data_array['ic_other_no']);
        $this->db->set('nationality', $data_array['nationality']);
        $this->db->set('birth_date', $data_array['birth_date']);
        $this->db->set('birth_cert_no', $data_array['birth_cert_no']);
        $this->db->set('family_link', $data_array['family_link']);
        $this->db->set('ethnicity', $data_array['ethnicity']);
        $this->db->set('religion', $data_array['religion']);
        $this->db->set('marital_status', $data_array['marital_status']);
        //$this->db->set('married_date', $data_array['married_date']);
        //$this->db->set('spouse_id', $data_array['spouse_id']);
        //$this->db->set('spouse_name', $data_array['spouse_name']);
        //$this->db->set('company', $data_array['company']);
        //$this->db->set('employee_no', $data_array['employee_no']);
        $this->db->set('job_function', $data_array['job_function']);
        //$this->db->set('job_industry', $data_array['job_industry']);
        //$this->db->set('patient_employment_id', $data_array['patient_employment_id']);
        //$this->db->set('family_income', $data_array['family_income']);
        $this->db->set('education_level', $data_array['education_level']);
        $this->db->set('patient_type', $data_array['patient_type']);
        //$this->db->set('contact_id', $data_array['contact_id']);
        //$this->db->set('correspondence_id', $data_array['correspondence_id']);
        //$this->db->set('organdonor_no', $data_array['organdonor_no']);
        //$this->db->set('organdonor_status', $data_array['organdonor_status']);
        (!empty($data_array['next_of_kin_id'])?$this->db->set('next_of_kin_id', $data_array['next_of_kin_id']):$this->db->set('next_of_kin_id', NULL));
        //$this->db->set('next_of_kin_id', $data_array['next_of_kin_id']);
        $this->db->set('next_of_kin_name', $data_array['next_of_kin_name']);
        $this->db->set('next_of_kin_relationship', $data_array['next_of_kin_relationship']);
        $this->db->set('blood_group', $data_array['blood_group']);
        $this->db->set('blood_rhesus', $data_array['blood_rhesus']);
        (isset($data_array['demise_date'])?$this->db->set('demise_date', $data_array['demise_date']):$this->db->set('demise_date', NULL));
        //$this->db->set('demise_date', $data_array['demise_date']);
        (isset($data_array['demise_time'])?$this->db->set('demise_time', $data_array['demise_time']):$this->db->set('demise_time', NULL));
        //$this->db->set('demise_time', $data_array['demise_time']);
        $this->db->set('death_cert', $data_array['death_cert']);
        //$this->db->set('demise_code', $data_array['demise_code']);
        $this->db->set('demise_cause', $data_array['demise_cause']);
        $this->db->set('clinic_home', $data_array['clinic_home']);
        $this->db->set('clinic_registered', $data_array['clinic_registered']);
        //$this->db->set('other', $data_array['other']);
        $this->db->set('status', $data_array['patient_status']);
        $this->db->set('remarks', $data_array['patdemo_remarks']);
        //$this->db->set('referred_by', $data_array['referred_by']);
        //$this->db->set('referred_remarks', $data_array['referred_remarks']);
        //$this->db->set('patient_password', $data_array['patient_password']);
        //$this->db->set('share_level', $data_array['share_level']);
        if(isset($data_array['update_when'])){$this->db->set('update_when', $data_array['update_when']);}
        if(isset($data_array['update_by'])){$this->db->set('update_by', $data_array['update_by']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
        $this->db->where('patient_id', $data_array['patient_id']);
        $this->db->update('patient_demographic_info');
        //echo $this->db->last_query();
		
        $this->db->set('address', $data_array['patient_address']);
        $this->db->set('address_2', $data_array['patient_address2']);
        $this->db->set('address_3', $data_array['patient_address3']);
        $this->db->set('town', $data_array['patient_town']);
        $this->db->set('state', $data_array['patient_state']);
        $this->db->set('postcode', $data_array['patient_postcode']);
        $this->db->set('country', $data_array['patient_country']);
        $this->db->set('tel_home', $data_array['tel_home']);
        $this->db->set('tel_office', $data_array['tel_office']);
        $this->db->set('tel_mobile', $data_array['tel_mobile']);
        $this->db->set('pager_no', $data_array['pager_no']);
        $this->db->set('fax_no', $data_array['fax_no']);
        $this->db->set('email', $data_array['email']);
        $this->db->set('other', $data_array['contact_other']);
        $this->db->set('remarks', $data_array['contact_remarks']);
        //$this->db->set('contact_district_id', $data_array['contact_district_id']);
        $this->db->set('addr_village_id', $data_array['addr_village_id']);
        $this->db->set('addr_town_id', $data_array['addr_town_id']);
        $this->db->set('addr_area_id', $data_array['addr_area_id']);
        $this->db->set('addr_district_id', $data_array['addr_district_id']);
        $this->db->set('addr_state_id', $data_array['addr_state_id']);
        $this->db->where('contact_id', $data_array['contact_id']);
        $this->db->update('patient_contact_info');
        //echo $this->db->last_query();

        echo "Updated Patient Demographic Info<br />";
        //echo "<hr />";
    } // end of function update_patient_info($data_array)


    //************************************************************************
    /**
     * Method to update_staffcategory
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_patdemo_familylink($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['family_link'])){$this->db->set('family_link', $data_array['family_link']);}
        $this->db->where('patient_id', $data_array['patient_id']);
        $this->db->update('patient_demographic_info');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_patdemo_familylink($data_array)


    //************************************************************************
    /**
     * Method to update_staffcategory
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_relationship_info($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Did user change the Head of Family?
        if($data_array['head_id'] <> $data_array['dbhead_id']){
            $this->db->set('head_id', $data_array['head_id']);
            $this->db->where('relationship_id', $data_array['relationship_id']);
            $this->db->update('patient_family_relationship');
            //echo $this->db->last_query();
        }
        
        // patient_family_details
        if(isset($data_array['family_position'])){$this->db->set('family_position', $data_array['family_position']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['generation_to_head'])){$this->db->set('generation_to_head', $data_array['generation_to_head']);}
        if(isset($data_array['date_married'])){$this->db->set('date_married', $data_array['date_married']);}
        if(isset($data_array['family_link'])){$this->db->set('family_link', $data_array['family_link']);}
        if(isset($data_array['edit_remarks'])){$this->db->set('edit_remarks', $data_array['edit_remarks']);}
        if(isset($data_array['edit_staff'])){$this->db->set('edit_staff', $data_array['edit_staff']);}
        if(isset($data_array['edit_date'])){$this->db->set('edit_date', $data_array['edit_date']);}
        $this->db->where('family_details_id', $data_array['family_details_id']);
        $this->db->update('patient_family_details');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_relationship_info($data_array)


    //************************************************************************
    /**
     * Method to update current social_history
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_social_history($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['safety_belt_use'])){$this->db->set('safety_belt_use', $data_array['safety_belt_use']);}
        if(isset($data_array['helmet_use'])){$this->db->set('helmet_use', $data_array['helmet_use']);}
        if(isset($data_array['drugs_use'])){$this->db->set('drugs_use', $data_array['drugs_use']);}
        if(isset($data_array['drugs_spec'])){$this->db->set('drugs_spec', $data_array['drugs_spec']);}
        if(isset($data_array['alcohol_use'])){$this->db->set('alcohol_use', $data_array['alcohol_use']);}
        if(isset($data_array['alcohol_spec'])){$this->db->set('alcohol_spec', $data_array['alcohol_spec']);}
        if(isset($data_array['tobacco_use'])){$this->db->set('tobacco_use', $data_array['tobacco_use']);}
        if(isset($data_array['tobacco_spec'])){$this->db->set('tobacco_spec', $data_array['tobacco_spec']);}
        if(isset($data_array['exercise_use'])){$this->db->set('exercise_use', $data_array['exercise_use']);}
        if(isset($data_array['exercise_spec'])){$this->db->set('exercise_spec', $data_array['exercise_spec']);}
        if(isset($data_array['trauma'])){$this->db->set('trauma', $data_array['trauma']);}
        if(isset($data_array['hospitalizations'])){$this->db->set('hospitalizations', $data_array['hospitalizations']);}
        if(isset($data_array['illness'])){$this->db->set('illness', $data_array['illness']);}
        if(isset($data_array['operation'])){$this->db->set('operation', $data_array['operation']);}
        if(isset($data_array['family_income'])){$this->db->set('family_income', $data_array['family_income']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        $this->db->where('social_history_id', (string)$data_array['social_history_id']);
        $this->db->update('patient_social_history');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_social_history($data_array)


    //===============================================================
    // Delete Database Records Methods
    //************************************************************************
    /**
     * Method to delete family relationship
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function delete_family_relationship($data_array)
    {
        /*
        echo "<hr />";
        echo "delete immunisation";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        $this->db->where('patient_id', (string)$data_array['patient_id']);
        $this->db->delete('patient_family_details');
        //echo $this->db->last_query();

        $this->db->where('relationship_id', (string)$data_array['relationship_id']);
        $this->db->delete('patient_family_relationship');
        //echo $this->db->last_query();
        //echo "Deleted<br />";
        //echo "<hr />";
    } // end of function delete_family_relationship($data_array)


    //************************************************************************
    /**
     * Method to delete immunisation
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function delete_patient_immunisation($data_array)
    {
        /*
        echo "<hr />";
        echo "delete immunisation";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        $this->db->where('patient_immunisation_id', (string)$data_array['patient_immunisation_id']);
        $this->db->delete('patient_immunisation');
        //echo $this->db->last_query();
        //echo "Deleted<br />";
        //echo "<hr />";
    } // end of function delete_patient_immunisation($data_array)


}

/* End of file MEhr_wdb.php */
/* Location: ./app_thirra/models/MEhr_wdb.php */
