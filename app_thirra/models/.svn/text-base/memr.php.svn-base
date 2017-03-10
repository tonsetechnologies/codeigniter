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
 * Portions created by the Initial Developer are Copyright (C) 2009
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

class MEmr extends CI_Model
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


    /************************************************************************
     * Method to retrieve list of patients inside database. 
     *
     * Base is patient_demographic_info
     * This method also displays bio_case info if available.
     *
	 * @param   string  $patient_name      Optional parameter to filter
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patients_list($patient_name=NULL)
    {
        $data = array();
        // Still need to find a way to display latest notification
        $sqlQuery   =   "SELECT *";
        /*
                            patient_demographic_info.patient_id,
                            patient_demographic_info.clinic_reference_number,
                            patient_demographic_info.name,
                            patient_demographic_info.gender,
                            patient_demographic_info.ic_other_no,
                            patient_demographic_info.birth_date
        */
        $sqlQuery   .=  " FROM patient_demographic_info";
        if(isset($patient_name)){
            $_patient_name  =   $patient_name;
            if(strlen($_patient_name) < 2) {
                $sqlQuery   .=  " WHERE name ILIKE '$_patient_name%'";
            } else {
                $sqlQuery   .=  " WHERE name ILIKE '%$_patient_name%'";
            } //endif(strlen($patient_name) < 2)
        }
        $sqlQuery   .=  " ORDER BY (patient_demographic_info.name||patient_demographic_info.patient_id) ";
        //$sqlQuery   .=  " ORDER BY name";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
        return $dataset; 
        }
    } //end of function get_patients_list($patient_name=NULL)

 
    /************************************************************************
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
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT 
                            patient_demographic_info.patient_id, name as patient_name, name_first, name_alias, clinic_reference_number, 
                            nhfa_no, gender, ic_no, ic_other_no, nationality, birth_date, ethnicity, religion, marital_status,
                            patient_type, blood_group, blood_rhesus,
                            demise_date, demise_time, demise_cause, status,";
        if(isset($this->_patient_id)){
            $sqlQuery   .=  " patient_contact_info.contact_id, address as patient_address, address_2 as patient_address2, 
                              address_3 as patient_address3,
                              town as patient_town, country as patient_country, state as patient_state, postcode as patient_postcode,
                              tel_home";
        } //endif(isset($this->_patient_id))
        $sqlQuery   .=  " FROM patient_demographic_info";
        $sqlQuery   .=  " JOIN patient_contact_info ON patient_demographic_info.patient_id = patient_contact_info.patient_id";
        if(isset($this->_patient_id)){
            $sqlQuery   .=  " WHERE patient_demographic_info.patient_id = '".$this->_patient_id."'";
        } else {
            $sqlQuery   .=  " ORDER BY patient_name";
        }//endif(isset($this->_patient_id))
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_patient_details($patient_id)


    /************************************************************************
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
        $sqlQuery   =   "SELECT *
                            FROM patient_consultation_summary";
        $sqlQuery   .=  " WHERE patient_id='".$patient_id."'";
        $sqlQuery   .=  " AND status > 0";
        $sqlQuery   .=  " ORDER BY date_started";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['summary_id']      = $row['summary_id'];
                $dataset[$rownum]['session_sequence']= $row['session_sequence'];
                $dataset[$rownum]['external_ref']    = $row['external_ref'];
                $dataset[$rownum]['session_type']    = $row['session_type'];
                $dataset[$rownum]['patient_id']      = $row['patient_id'];
                $dataset[$rownum]['date_started']    = $row['date_started'];
                $dataset[$rownum]['time_started']    = $row['time_started'];
                $dataset[$rownum]['date_ended']      = $row['date_ended'];
                $dataset[$rownum]['time_ended']      = $row['time_ended'];
                $dataset[$rownum]['signed_by']       = $row['signed_by'];
                $dataset[$rownum]['staff_id']        = $row['staff_id'];
                $dataset[$rownum]['location_start']  = $row['location_start'];
                $dataset[$rownum]['location_end']    = $row['location_end'];
                $dataset[$rownum]['summary']         = $row['summary'];
                $dataset[$rownum]['status']          = $row['status'];
                $rownum++;            
            }
        }
        return $dataset; 
    } //end of function get_pastcons_list($patient_name=NULL)

 
    /************************************************************************
     * Method to retrieve details of vital signs for an episode.
     *
     * 
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
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        }
        return $data; 
    } //end of function get_recent_vitals($patient_id)

 
    /************************************************************************
     * Method to retrieve details of vital signs for an episode.
     *
     * 
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_medication($patient_id)
    {
        $dataset = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT patient_medication.*,
                            drug_formulary.generic_name, drug_formulary.formulary_code, drug_formulary.atc_code
                            FROM patient_medication";
        $sqlQuery   .=  " JOIN drug_formulary ON patient_medication.drug_formulary_id = drug_formulary.drug_formulary_id";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
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

 
    /************************************************************************
     * Method to retrieve details of vital signs for an episode.
     *
     * 
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_recent_diagnoses($patient_id)
    {
        $dataset = array();
        $this->_patient_id   =   $patient_id;
        if(isset($diagnosis_id)){
            $this->_diagnosis_id =   $diagnosis_id;
        } else {
            $this->_diagnosis_id =   NULL;
        }
        $sqlQuery   =   "SELECT patient_diagnosis.*,";
        $sqlQuery   .=  " dcode1ext.dcode1ext_shortname, dcode1ext.full_title,";
        $sqlQuery   .=  " dcode1.chapter, dcode1.dcode1_code";
        $sqlQuery   .=  " FROM patient_diagnosis, dcode1ext, dcode1";
        $sqlQuery   .=  " WHERE patient_id='".$this->_patient_id."'";
        $sqlQuery   .=  " AND patient_diagnosis.dcode1ext_code=dcode1ext.dcode1ext_code";
        $sqlQuery   .=  " AND dcode1ext.dcode1_id=dcode1.dcode1_id";
        if(isset($diagnosis_id)){
            $sqlQuery   .=  " AND patient_diagnosis.diagnosis_id='".$this->_diagnosis_id."'";
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
                $dataset[$rownum]['dcode1_code']    = $row['dcode1_code'];
                $dataset[$rownum]['full_title']     = $row['full_title'];
                $dataset[$rownum]['diagnosisChapter']= $row['chapter'];
                $dataset[$rownum]['diagnosisCategory']= $row['dcode1_code'];
                $dataset[$rownum]['diagnosis']      = $row['dcode1ext_code'];
                $dataset[$rownum]['diagnosis2']     = $row['dcode2ext_code'];
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

 
    /************************************************************************
     * Method to retrieve demographic info of one patient.
     *
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patient_demo($id){
        $data = array();
        $options = array('patient_id' => $id);
        $Q = $this->db->get_where('patient_demographic_info',$options,1);
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_patient_demo($id)


    /************************************************************************
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
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM patient_consultation_summary";
        $sqlQuery   .=  " WHERE patient_id = '".$this->_patient_id."'";
        if(isset($summary_id)){
            $sqlQuery   .=  " AND summary_id = '".$summary_id."'";
        } else {
            $sqlQuery   .=  " AND session_type = '0'";
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


    /************************************************************************
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
        $sqlQuery   =   "SELECT patient_complaint.*,";
        $sqlQuery   .=  " icpc2_symptom.icd_10, icpc2_symptom.full_description";
        $sqlQuery   .=  " FROM patient_complaint, icpc2_symptom";
        $sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        $sqlQuery   .=  " AND patient_complaint.icpc_code=icpc2_symptom.icpc_code";
        if(isset($diagnosis_id)){
            $sqlQuery   .=  " AND patient_complaint.diagnosis_id='".$this->_complaint_id."'";
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
                $dataset[$rownum]['remarks']        = $row['remarks'];
                $dataset[$rownum]['full_description']= $row['full_description'];
                $dataset[$rownum]['icd_10']         = $row['icd_10'];
                $rownum++;            
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_patcon_complaints($summary_id)

 
    /************************************************************************
     * Method to retrieve array of lab orders for an episode.
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $lab_order_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patcon_lab($summary_id, $lab_order_id=NULL)
    {
        $dataset = array();
        $this->_summary_id   =   $summary_id;
        if(isset($lab_order_id)){
            $this->_lab_order_id =   $lab_order_id;
        } else {
            $this->_lab_order_id =   NULL;
        }
        $sqlQuery   =   "SELECT lab_order.*,";
        $sqlQuery   .=  " lab_package.package_code, lab_package.package_name,
                            lab_package.description, lab_package.package_cost_std,";
        $sqlQuery   .=  " lab_supplier.supplier_id, lab_supplier.supplier_name";
        $sqlQuery   .=  " FROM lab_order";
        $sqlQuery   .=  " JOIN lab_package ON lab_order.lab_package_id=lab_package.lab_package_id";
        $sqlQuery   .=  " JOIN lab_supplier ON lab_package.supplier_id=lab_supplier.supplier_id";
        $sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        //$sqlQuery   .=  " AND patient_complaint.icpc_code=icpc2_symptom.icpc_code";
        if(isset($lab_order_id)){
            $sqlQuery   .=  " AND patient_complaint.diagnosis_id='".$this->_lab_order_id."'";
        }
        $sqlQuery   .=  " ORDER BY lab_package.package_code";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['lab_order_id']   = $row['lab_order_id'];
                $dataset[$rownum]['sample_ref']     = $row['sample_ref'];
                $dataset[$rownum]['sample_date']    = $row['sample_date'];
                $dataset[$rownum]['remarks']        = $row['remarks'];
                $dataset[$rownum]['lab_package_id'] = $row['lab_package_id'];
                $dataset[$rownum]['package_code']   = $row['package_code'];
                $dataset[$rownum]['package_name']   = $row['package_name'];
                $dataset[$rownum]['description']    = $row['description'];
                $dataset[$rownum]['package_cost_std']= $row['package_cost_std'];
                $dataset[$rownum]['supplier_id']    = $row['package_cost_std'];
                $dataset[$rownum]['supplier_name']  = $row['supplier_name'];
                $rownum++;            
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_patcon_lab($summary_id)

 
    /************************************************************************
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
        $sqlQuery   =   "SELECT patient_referral.*,";
        $sqlQuery   .=  " referral_doctor.doctor_name, referral_doctor.specialty,";
        $sqlQuery   .=  " referral_center.name AS referral_center_name, referral_center.centre_type";
        $sqlQuery   .=  " FROM patient_referral";
        $sqlQuery   .=  " JOIN referral_doctor ON patient_referral.referral_doctor_id = referral_doctor.referral_doctor_id";
        $sqlQuery   .=  " JOIN referral_center ON referral_doctor.referral_center_id = referral_center.referral_center_id";
        $sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        if(isset($referral_id)){
            $sqlQuery   .=  " AND patient_referral.referral_id='".$this->_referral_id."'";
        }
        $sqlQuery   .=  " ORDER BY patient_referral.referral_centre";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['referral_id']        = $row['referral_id'];
                $dataset[$rownum]['referral_doctor_id'] = $row['referral_doctor_id'];
                $dataset[$rownum]['referral_date']      = $row['referral_date'];
                $dataset[$rownum]['reason']             = $row['reason'];
                $dataset[$rownum]['clinical_exam']      = $row['clinical_exam'];
                $dataset[$rownum]['referral_reference'] = $row['referral_reference'];
                $dataset[$rownum]['doctor_name']        = $row['doctor_name'];
                $dataset[$rownum]['specialty']          = $row['specialty'];
                $dataset[$rownum]['referral_center_name']= $row['referral_center_name'];
                $dataset[$rownum]['centre_type']        = $row['centre_type'];
                $rownum++;            
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_patcon_referrals($summary_id)

 
    /************************************************************************
     * Method to retrieve list of diagnosis chapters
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


    /************************************************************************
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


    /************************************************************************
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

 
    /************************************************************************
     * Method to retrieve array of diagnosis for an episode.
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $diagnosis_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patcon_diagnosis($summary_id, $diagnosis_id=NULL)
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
                $dataset[$rownum]['dcode1_code']    = $row['dcode1_code'];
                $dataset[$rownum]['full_title']     = $row['full_title'];
                $dataset[$rownum]['diagnosisChapter']= $row['chapter'];
                $dataset[$rownum]['diagnosisCategory']= $row['dcode1_code'];
                $dataset[$rownum]['diagnosis']      = $row['dcode1ext_code'];
                $dataset[$rownum]['diagnosis2']     = $row['dcode2ext_code'];
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

 
    /************************************************************************
     * Method to retrieve list of lab packages
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_lab_packages_list()
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM lab_package";
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


    /************************************************************************
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


    /************************************************************************
     * Method to retrieve details of one lab package.
     *
     * 
     *
	 * @param   string  $code_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_lab_package($package_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT *
                            FROM lab_package";
        $sqlQuery   .=  " WHERE lab_package_id='".$package_id."'";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        } else {
            $data['sample_required'] = "N/A";
        }
        return $data; 
    } //end of function get_one_lab_package($package_id)

 
    /************************************************************************
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

 
    /************************************************************************
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
        $sqlQuery   =   "SELECT 
                            dcode1ext.dcode1ext_id,
                            dcode1ext.dcode1_id,
                            dcode1ext.dcode1set,
                            dcode1ext.dcode1ext_code,
                            dcode1ext.full_title,
                            dcode1ext.commonly_used,
                            dcode1ext.remarks
                            FROM dcode1ext";
        $sqlQuery   .=  " WHERE dcode1ext.commonly_used > 0";
        $sqlQuery   .=  " ORDER BY dcode1ext.commonly_used ";
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
    } //end of function get_common_diagnosis()

 
    /************************************************************************
     * Method to retrieve details of one diagnosis code.
     *
     * 
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

 
    /************************************************************************
     * Method to retrieve list of diagnosis chapters
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_dcode_chapters()
    {
        $data = array();
        $sqlQuery   =   "SELECT DISTINCT chapter";
        $sqlQuery   .=  " FROM dcode1";
        $sqlQuery   .=  " ORDER BY chapter";
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
    } //end of function get_dcode_chapters()


    /************************************************************************
     * Method to retrieve list of diagnosis categories
     *
     * This method 
     *
	 * @param   string  $chapter      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_dcode1_by_chapter($chapter)
    {
        $data = array();
        $options = array('chapter' => $chapter);
        $this->db->order_by('full_title');
        $Q = $this->db->get_where('dcode1',$options);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_dcode1_by_chapter($chapter)


    /************************************************************************
     * Method to retrieve list of diagnosis codes
     *
     * This method 
     *
	 * @param   string  $dcode1      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_dcode1ext_by_dcode1($dcode1=NULL)
    {
        $data = array();
        if(empty($dcode1)) {
            $dcode1 = "NULL";
        }
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM dcode1ext";
        $sqlQuery   .=  " WHERE dcode1ext_code ILIKE '$dcode1%'";
        $sqlQuery   .=  " ORDER BY full_title";
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
    } //end of function get_dcode1ext_by_dcode1($dcode1)


    /************************************************************************
     * Method to retrieve list of mapped secondary diagnosis codes
     *
     * This method 
     *
	 * @param   string  $dcode1ext_code      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_dcode2ext_by_dcode1ext($dcode1ext_code)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM dcode1ext, dcode2ext, dcode_map";
        $sqlQuery   .=  " WHERE dcode1ext.dcode1ext_code='$dcode1ext_code'";
        $sqlQuery   .=  " AND dcode1ext.dcode1ext_code=dcode_map.dcode1ext_code";
        $sqlQuery   .=  " AND dcode_map.dcode2ext_code=dcode2ext.dcode2ext_code";
        $sqlQuery   .=  " ORDER BY dcode2ext.full_title";
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
    } //end of function get_dcode2ext_by_dcode1ext($dcode1ext)


    /************************************************************************
     * Method to retrieve array of prescriptions for an episode.
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $summary_id      Required
	 * @param   string  $diagnosis_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patcon_prescribe($summary_id, $queue_id=NULL)
    {
        $dataset = array();
        $this->_summary_id   =   $summary_id;
        if(isset($queue_id)){
            $this->_queue_id =   $queue_id;
        } else {
            $this->_queue_id =   NULL;
        }
        $sqlQuery   =   "SELECT prescript_queue.*,";
        $sqlQuery   .=  " drug_formulary.generic_name, drug_formulary.formulary_code, drug_formulary.formulary_system";
        //$sqlQuery   .=  " dcode1.chapter, dcode1.dcode1_code";
        $sqlQuery   .=  " FROM prescript_queue, drug_formulary"; //, dcode1";
        $sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        $sqlQuery   .=  " AND prescript_queue.drug_formulary_id=drug_formulary.drug_formulary_id";
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
                $dataset[$rownum]['quantity']       = $row['quantity'];
                $dataset[$rownum]['quantity_form']  = $row['quantity_form'];
                $dataset[$rownum]['indication']     = $row['indication'];
                $dataset[$rownum]['caution']        = $row['caution'];
                $dataset[$rownum]['status']         = $row['status'];
                $dataset[$rownum]['formulary_code'] = $row['formulary_code'];
                $dataset[$rownum]['generic_name']   = $row['generic_name'];
                $dataset[$rownum]['formulary_system']= $row['formulary_system'];
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

 
    /************************************************************************
     * Method to retrieve list of drug systems
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drug_system()
    {
        $data = array();
        $sqlQuery   =   "SELECT DISTINCT formulary_system";
        $sqlQuery   .=  " FROM drug_formulary";
        $sqlQuery   .=  " ORDER BY formulary_system";
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
    } //end of function get_drug_system()


    /************************************************************************
     * Method to retrieve list of drug formulary
     *
     * This method 
     *
	 * @param   string  $system      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_formulary_by_system($system=NULL)
    {
        $data = array();
        if(empty($system)) {
            $system = "NULL";
        }
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM drug_formulary";
        $sqlQuery   .=  " WHERE formulary_system ILIKE '$system%'";
        $sqlQuery   .=  " ORDER BY generic_name";
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
    } //end of function get_formulary_by_system($system)


    /************************************************************************
     * Method to retrieve list of drug codes
     *
     * This method 
     *
	 * @param   string  $formulary_code      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_tradename_by_formulary($drug_formulary_id)
    {
        $data = array();
        if(empty($drug_formulary_id)) {
            $drug_formulary_id = "NULL";
        }
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM drug_code";
        $sqlQuery   .=  " WHERE drug_formulary_id ='$drug_formulary_id'";
        $sqlQuery   .=  " ORDER BY trade_name";
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
    } //end of function get_tradename_by_formulary($drug_formulary_id)


    /************************************************************************
     * Method to retrieve list of referral centres
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_referral_centres()
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM referral_center";
        $sqlQuery   .=  " ORDER BY name";
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
    } //end of function get_referral_centres()


    /************************************************************************
     * Method to retrieve list of complaints categories
     *
     * This method 
     *
	 * @param   string  $chapter      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_referral_person($centre_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM referral_doctor";
        $sqlQuery   .=  " WHERE referral_center_id = '$centre_id'";
        $sqlQuery   .=  " ORDER BY doctor_name";
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
    } //end of function get_referral_person($centre_id)


    /************************************************************************
     * Method to retrieve list of pending Dispensings
     *
     * This method 
     *
	 * @param   string  $formulary_code      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_pending_dispensings()
    {
        $data = array();
        if(empty($drug_formulary_id)) {
            $drug_formulary_id = "NULL";
        }
        $sqlQuery   =   "SELECT distinct session_id, date_ended, dispense_queue.patient_id,name,birth_date,gender";
        $sqlQuery   .=  " FROM dispense_queue";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON dispense_queue.session_id = patient_consultation_summary.summary_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON dispense_queue.patient_id = patient_demographic_info.patient_id";
        $sqlQuery   .=  " WHERE dispense_queue.status ='Unconfirmed'";
        $sqlQuery   .=  " ORDER BY session_id";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_pending_dispensings()


    /************************************************************************
     * Method to retrieve list of pending prescriptions
     *
     * This method 
     *
	 * @param   string  $formulary_code      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_pending_prescriptions()
    {
        $data = array();
        if(empty($drug_formulary_id)) {
            $drug_formulary_id = "NULL";
        }
        $sqlQuery   =   "SELECT distinct session_id, date_ended, prescript_queue.patient_id,name,birth_date,gender";
        $sqlQuery   .=  " FROM prescript_queue";
        $sqlQuery   .=  " JOIN patient_consultation_summary ON prescript_queue.session_id = patient_consultation_summary.summary_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON prescript_queue.patient_id = patient_demographic_info.patient_id";
        $sqlQuery   .=  " WHERE prescript_queue.status ='Unconfirmed'";
        $sqlQuery   .=  " ORDER BY session_id";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_pending_prescriptions()


    /************************************************************************
     * Method to retrieve array of pending lab orders (for a clinic).
     *
     * If diagnosis_id is passed, only one row will be retrieved.
     *
	 * @param   string  $location_id    Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_pending_labresult($location_id=NULL)
    {
        $dataset = array();
        if(isset($location_id)){
            $this->_location_id =   $location_id;
        } else {
            $this->_location_id =   NULL;
        }
        $sqlQuery   =   "SELECT lab_order.*,";
        $sqlQuery   .=  " lab_package.package_code, lab_package.package_name,
                            lab_package.description, lab_package.package_cost_std,";
        $sqlQuery   .=  " lab_supplier.supplier_id, lab_supplier.supplier_name,";
        $sqlQuery   .=  " patient_demographic_info.name, patient_demographic_info.name_first, patient_demographic_info.birth_date";
        $sqlQuery   .=  " FROM lab_order";
        $sqlQuery   .=  " JOIN lab_package ON lab_order.lab_package_id=lab_package.lab_package_id";
        $sqlQuery   .=  " JOIN lab_supplier ON lab_package.supplier_id=lab_supplier.supplier_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON lab_order.patient_id=patient_demographic_info.patient_id";
        //$sqlQuery   .=  " WHERE session_id='".$this->_summary_id."'";
        /*
        if(isset($lab_order_id)){
            $sqlQuery   .=  " AND patient_complaint.diagnosis_id='".$this->_lab_order_id."'";
        }
        */
        $sqlQuery   .=  " ORDER BY lab_order.sample_date";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['lab_order_id']   = $row['lab_order_id'];
                $dataset[$rownum]['sample_ref']     = $row['sample_ref'];
                $dataset[$rownum]['sample_date']    = $row['sample_date'];
                $dataset[$rownum]['remarks']        = $row['remarks'];
                $dataset[$rownum]['lab_package_id'] = $row['lab_package_id'];
                $dataset[$rownum]['package_code']   = $row['package_code'];
                $dataset[$rownum]['package_name']   = $row['package_name'];
                $dataset[$rownum]['description']    = $row['description'];
                $dataset[$rownum]['package_cost_std']= $row['package_cost_std'];
                $dataset[$rownum]['supplier_id']    = $row['package_cost_std'];
                $dataset[$rownum]['supplier_name']  = $row['supplier_name'];
                $dataset[$rownum]['name']           = $row['name'];
                $dataset[$rownum]['name_first']     = $row['name_first'];
                $dataset[$rownum]['birth_date']     = $row['birth_date'];
                $rownum++;            
            }
        reset($query);
        }
        return $dataset; 
    } //end of function get_pending_labresult($location_id=NULL)

 
    /************************************************************************
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


    /************************************************************************
     * Method to retrieve list of patients queueing
     *
     * This method 
     *
	 * @param   string  $date      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patients_queue($date=NULL)
    {
        $data = array();
        if(empty($system)) {
            $system = "NULL";
        }
        $sqlQuery   =   "SELECT *,";
        $sqlQuery   .=  " patient_demographic_info.name,";
        $sqlQuery   .=  " staff_info.staff_name";
        $sqlQuery   .=  " FROM booking";
        $sqlQuery   .=  " JOIN patient_demographic_info ON booking.patient_id = patient_demographic_info.patient_id";
        $sqlQuery   .=  " JOIN staff_info ON booking.staff_id = staff_info.staff_id";
        if(isset($date)){
            $sqlQuery   .=  " WHERE date = '$date'";
        }
        $sqlQuery   .=  " ORDER BY date, start_time";
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
    } //end of function get_patients_queue($date=NULL)


    /************************************************************************
     * Method to retrieve list of patients queueing
     *
     * This method 
     *
	 * @param   string  $date      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_postconsultation_queue($date=NULL)
    {
        $data = array();
        if(empty($system)) {
            $system = "NULL";
        }
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM patient_consultation_summary";
        $sqlQuery   .=  " WHERE date_ended = '$date'";
        $sqlQuery   .=  " AND status = 10";
        $sqlQuery   .=  " ORDER BY date_ended, time_ended";
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
    } //end of function get_postconsultation_queue($date=NULL)


    /************************************************************************
     * Method to retrieve list of users
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_users_list()
    {
        $data = array();
        $sqlQuery   =   "SELECT system_user.*,";
        $sqlQuery   .=  " staff_info.staff_name,";
        $sqlQuery   .=  " staff_work.location_id,";
        $sqlQuery   .=  " clinic_info.clinic_shortname,";
        $sqlQuery   .=  " system_user_category.category_name";
        $sqlQuery   .=  " FROM system_user";
        $sqlQuery   .=  " JOIN staff_info ON system_user.staff_id=staff_info.staff_id";
        $sqlQuery   .=  " JOIN staff_work ON staff_info.staff_work_id=staff_work.staff_work_id";
        $sqlQuery   .=  " JOIN clinic_info ON staff_work.location_id=clinic_info.clinic_info_id";
        $sqlQuery   .=  " JOIN system_user_category ON system_user.category_id=system_user_category.category_id";
        $sqlQuery   .=  " ORDER BY username";
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
    } //end of function get_users_list()


    /************************************************************************
     * Method to retrieve details of one system user.
     *
     * 
     *
	 * @param   string  $user_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_systemuser($user_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT system_user.*,";
        $sqlQuery   .=  " staff_info.*,";
        $sqlQuery   .=  " staff_contact.*";
        //$sqlQuery   .=  " staff_info.staff_name,staff_info.staff_initials,staff_info.mmc_no,staff_info.specialty,staff_info.gender";
        $sqlQuery   .=  " FROM system_user";
        $sqlQuery   .=  " JOIN staff_info ON system_user.staff_id=staff_info.staff_id";
        $sqlQuery   .=  " JOIN staff_contact ON staff_info.staff_contact_id=staff_contact.staff_contact_id";
        $sqlQuery   .=  " WHERE user_id='".$user_id."'";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        }            
        return $data; 
    } //end of function get_one_systemuser($user_id)

 
    /************************************************************************
     * Method to retrieve list of systemuser_categories
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_systemuser_categories()
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM system_user_category";
        $sqlQuery   .=  " ORDER BY category_name";
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
    } //end of function get_systemuser_categories()


    /************************************************************************
     * Method to retrieve list of staff_categories
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_staff_categories()
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM staff_category";
        $sqlQuery   .=  " ORDER BY category_name";
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
    } //end of function get_staff_categories()


    /************************************************************************
     * Method to retrieve list of clinics
     *
     * This method 
     *
	 * @param   string  $country      Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_clinics_list($country=NULL)
    {
        $data = array();
        if(isset($country)) {
            $options = array('country' => $country);
            $this->db->orderby('sort_clinic');
            $Q = $this->db->get_where('clinic_info',$options,1);
        } else {
            $this->db->orderby('sort_clinic');
            $Q = $this->db->get('clinic_info');
        } //end if(isset($country)
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_clinics_list($country=NULL)


    //===============================================================
    // Insert Database Methods

    /************************************************************************
     * Method to add new patients
     *
     * This method adds a new patient to the clinic. It inserts row into 
     * patient_demographic_info, patient_contact_info, 
     * patient_immunisation and patient_employment(if any)
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_patient($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        echo "<hr />";
        echo "Adding new patient details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";

        // Insert row into patient_contact_info
        if(isset($data_array['now_id'])){$this->db->set('contact_id', $data_array['now_id']);} // Not NULL
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['contact_type'])){$this->db->set('contact_type', $data_array['contact_type']);}
        if(isset($data_array['start_date'])){$this->db->set('start_date', $data_array['start_date']);}
        if(isset($data_array['end_date'])){$this->db->set('end_date', $data_array['end_date']);}
        if(isset($data_array['patient_address'])){$this->db->set('address', $data_array['patient_address']);}
        if(isset($data_array['patient_address2'])){$this->db->set('address_2', $data_array['patient_address2']);}
        if(isset($data_array['patient_address3'])){$this->db->set('address_3', $data_array['patient_address3']);}
        if(isset($data_array['patient_town'])){$this->db->set('town', $data_array['patient_town']);}
        if(isset($data_array['patient_state'])){$this->db->set('state', $data_array['patient_state']);}
        if(isset($data_array['patient_postcode'])){$this->db->set('postcode', $data_array['patient_postcode']);}
        if(isset($data_array['patient_country'])){$this->db->set('country', $data_array['patient_country']);}
        if(isset($data_array['tel_home'])){$this->db->set('tel_home', $data_array['tel_home']);}
        if(isset($data_array['tel_office'])){$this->db->set('tel_office', $data_array['tel_office']);}
        if(isset($data_array['tel_mobile'])){$this->db->set('tel_mobile', $data_array['tel_mobile']);}
        if(isset($data_array['pager_no'])){$this->db->set('pager_no', $data_array['pager_no']);}
        if(isset($data_array['fax_no'])){$this->db->set('fax_no', $data_array['fax_no']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        if(isset($data_array['other'])){$this->db->set('other', $data_array['other']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        // Perform db insert
        $this->db->insert('patient_contact_info');
        //echo $this->db->last_query();
        echo "<br />Inserted into patient_contact_info";
        
        // Insert row into patient_correspondence
        if(isset($data_array['now_id'])){$this->db->set('patient_correspondence_id', $data_array['now_id']);} // Not NULL
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['correspondence_type'])){$this->db->set('contact_type', $data_array['correspondence_type']);}
        if(isset($data_array['start_date'])){$this->db->set('start_date', $data_array['start_date']);}
        /*
        if(isset($data_array['end_date'])){$this->db->set('end_date', $data_array['end_date']);}
        if(isset($data_array['patient_address'])){$this->db->set('address', $data_array['patient_address']);}
        if(isset($data_array['patient_address2'])){$this->db->set('address_2', $data_array['patient_address2']);}
        if(isset($data_array['patient_address3'])){$this->db->set('address_3', $data_array['patient_address3']);}
        if(isset($data_array['patient_town'])){$this->db->set('town', $data_array['patient_town']);}
        if(isset($data_array['patient_state'])){$this->db->set('state', $data_array['patient_state']);}
        if(isset($data_array['patient_postcode'])){$this->db->set('postcode', $data_array['patient_postcode']);}
        */
        if(isset($data_array['country'])){$this->db->set('country', $data_array['country']);}
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
        // Perform db insert
        $this->db->insert('patient_correspondence');
        //echo $this->db->last_query();
        echo "<br />Inserted into patient_correspondence";
        
        // Insert into patient_demographic_info
        $this->db->set('patient_id', $data_array['patient_id']); // Not NULL
        if(isset($data_array['clinic_reference_number'])){$this->db->set('clinic_reference_number', $data_array['clinic_reference_number']);}
        if(isset($data_array['pns_pat_id'])){$this->db->set('pns_pat_id', $data_array['pns_pat_id']);}
        if(isset($data_array['nhfa_no'])){$this->db->set('nhfa_no', $data_array['nhfa_no']);}
        if(isset($data_array['patient_name'])){$this->db->set('name', $data_array['patient_name']);}
        if(isset($data_array['name_first'])){$this->db->set('name_first', $data_array['name_first']);}
        if(isset($data_array['name_alias'])){$this->db->set('name_alias', $data_array['name_alias']);}
        if(isset($data_array['shortname'])){$this->db->set('shortname', $data_array['shortname']);}
        if(isset($data_array['gender'])){$this->db->set('gender', $data_array['gender']);}
        if(isset($data_array['ic_no'])){$this->db->set('ic_no', $data_array['ic_no']);}
        if(isset($data_array['ic_other_type'])){$this->db->set('ic_other_type', $data_array['ic_other_type']);}
        if(isset($data_array['ic_other_no'])){$this->db->set('ic_other_no', $data_array['ic_other_no']);}
        if(isset($data_array['nationality'])){$this->db->set('nationality', $data_array['nationality']);}
        if(isset($data_array['birth_date'])){$this->db->set('birth_date', $data_array['birth_date']);}
        if(isset($data_array['birth_cert_no'])){$this->db->set('birth_cert_no', $data_array['birth_cert_no']);}
        if(isset($data_array['family_link'])){$this->db->set('family_link', $data_array['family_link']);}
        if(isset($data_array['ethnicity'])){$this->db->set('ethnicity', $data_array['ethnicity']);}
        if(isset($data_array['religion'])){$this->db->set('religion', $data_array['religion']);}
        if(isset($data_array['marital_status'])){$this->db->set('marital_status', $data_array['marital_status']);}
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
        if(isset($data_array['patient_type'])){$this->db->set('patient_type', $data_array['patient_type']);}
        if(isset($data_array['contact_id'])){$this->db->set('contact_id', $data_array['contact_id']);} // Not NULL, foreign key to patient_contact_info
        if(isset($data_array['correspondence_id'])){$this->db->set('correspondence_id', $data_array['correspondence_id']);}
        if(isset($data_array['organdonor_no'])){$this->db->set('organdonor_no', $data_array['organdonor_no']);}
        if(isset($data_array['organdonor_status'])){$this->db->set('organdonor_status', $data_array['organdonor_status']);}
        if(isset($data_array['next_of_kin_id'])){$this->db->set('next_of_kin_id', $data_array['next_of_kin_id']);} // foreign key to patient_demographic_info
        if(isset($data_array['next_of_kin_name'])){$this->db->set('next_of_kin_name', $data_array['next_of_kin_name']);}
        if(isset($data_array['next_of_kin_relationship'])){$this->db->set('next_of_kin_relationship', $data_array['next_of_kin_relationship']);}
        if(isset($data_array['blood_group'])){$this->db->set('blood_group', $data_array['blood_group']);}
        if(isset($data_array['blood_rhesus'])){$this->db->set('blood_rhesus', $data_array['blood_rhesus']);}
        if(isset($data_array['demise_date'])){$this->db->set('demise_date', $data_array['demise_date']);}
        if(isset($data_array['demise_time'])){$this->db->set('demise_time', $data_array['demise_time']);}
        if(isset($data_array['death_cert'])){$this->db->set('death_cert', $data_array['death_cert']);}
        if(isset($data_array['demise_code'])){$this->db->set('demise_code', $data_array['demise_code']);}
        if(isset($data_array['demise_cause'])){$this->db->set('demise_cause', $data_array['demise_cause']);}
        if(isset($data_array['clinic_home'])){$this->db->set('clinic_home', $data_array['clinic_home']);}
        if(isset($data_array['clinic_registered'])){$this->db->set('clinic_registered', $data_array['clinic_registered']);}
        if(isset($data_array['other'])){$this->db->set('other', $data_array['other']);}
        if(isset($data_array['patient_status'])){$this->db->set('status', $data_array['patient_status']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        // Perform db insert
        $this->db->insert('patient_demographic_info');
        //echo $this->db->last_query();
        echo "<br />Inserted into patient_demographic_info";

        // Insert row into patient_immunisation
        if(isset($data_array['now_id'])){$this->db->set('patient_immunisation_id', $data_array['now_id']);} // Not NULL
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);} // Not NULL
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);} // Not NULL
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['birth_date'])){$this->db->set('date', $data_array['birth_date']);}
        $this->db->set('immunisation_id', '0');
        // Perform db insert
        $this->db->insert('patient_immunisation');
        //echo $this->db->last_query();
        echo "<br />Inserted into patient_immunisation";

        echo "<hr />";
    } // end of function insert_new_patient($data_array)


    /************************************************************************
     * Method to insert New Episode  
     *
     * This method creates a new consultation.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_episode($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        $_user_ip =   $this->input->ip_address();
        //echo "<hr />";
        //echo "Inserting episode details";
        //echo "<pre>";
        //print_r($data_array);
        //echo "</pre>";

/*
  check_in_date date,
  check_in_time time without time zone,
  check_in_remarks character varying(255),
  check_out_estimate date,
  check_out_date date,
  check_out_time time without time zone,
  check_out_staff character(10),
  check_out_remarks character varying(255),
  physician_1 character(10),
  physician_2 character(10),
  specialist_1 character(10),
  specialist_2 character(10),
  discharge_notes text,
  security_deposit numeric(10,2),
  security_reference character varying(20),
  security_type character varying(20),
  security_trans_id character(10),
  remarks text,
*/        // Insert into adt
        if(isset($data_array['adt_id'])){$this->db->set('adt_id', $data_array['adt_id']);}
        if(isset($data_array['adt_reference'])){$this->db->set('adt_reference', $data_array['adt_reference']);}
        if(isset($data_array['adt_sequence'])){$this->db->set('adt_sequence', $data_array['adt_sequence']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['check_in_date'])){$this->db->set('check_in_date', $data_array['check_in_date']);}
        if(isset($data_array['check_in_time'])){$this->db->set('check_in_time', $data_array['check_in_time']);}
        if(isset($data_array['staff_id'])){$this->db->set('check_in_staff', $data_array['staff_id']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        // Perform db insert
        $this->db->insert('adt');
        //echo $this->db->last_query();
        //echo "<br />Inserted into adt";

        // Insert into patient_consultation_summary
        // Perform db insert
/*
  note_billing text, -- Added on Jan 22, 08
  note_staff text, -- Added on Jan 22, 08
  note_patient text, -- Added on Jan 22, 08
  con_workflow text, -- Added on Jan 22, 08
  booking_id character varying(10), -- Added on Jan 22, 08
*/
        if(isset($data_array['summary_id'])){$this->db->set('summary_id', $data_array['summary_id']);}
        if(isset($data_array['session_ref'])){$this->db->set('session_ref', $data_array['session_ref']);}
        if(isset($data_array['session_sequence'])){$this->db->set('session_sequence', $data_array['session_sequence']);}
        if(isset($data_array['external_ref'])){$this->db->set('external_ref', $data_array['external_ref']);}
        if(isset($data_array['session_type'])){$this->db->set('session_type', $data_array['session_type']);}
        if(isset($data_array['adt_id'])){$this->db->set('adt_id', $data_array['adt_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['date_started'])){$this->db->set('date_started', $data_array['date_started']);}
        if(isset($data_array['time_started'])){$this->db->set('time_started', $data_array['time_started']);}
        if(isset($data_array['date_ended'])){$this->db->set('date_ended', $data_array['date_ended']);}
        if(isset($data_array['time_ended'])){$this->db->set('time_ended', $data_array['time_ended']);}
        if(isset($data_array['signed_by'])){$this->db->set('signed_by', $data_array['signed_by']);}
        if(isset($data_array['location_start'])){$this->db->set('location_start', $data_array['location_start']);}
        if(isset($data_array['location_end'])){$this->db->set('location_end', $data_array['location_end']);}
        $this->db->set('ip_start', $_user_ip);
        $this->db->set('ip_end', $_user_ip);
        //if(isset($data_array['ip_start'])){$this->db->set('ip_start', $data_array['ip_start']);}
        //if(isset($data_array['ip_end'])){$this->db->set('ip_end', $data_array['ip_end']);}
        if(isset($data_array['summary'])){$this->db->set('summary', $data_array['summary']);}
        if(isset($data_array['status'])){$this->db->set('status', $data_array['status']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        $this->db->insert('patient_consultation_summary');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_consultation_summary";


        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_episode($data_array)


    /************************************************************************
     * Method to insert New Diagnosis  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_complaint($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting diagnosis details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */

        /*
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_diagnosis
        if(isset($data_array['complaint_id'])){$this->db->set('complaint_id', $data_array['complaint_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['icpc_code'])){$this->db->set('icpc_code', $data_array['icpc_code']);} //deprecate
        if(isset($data_array['duration'])){$this->db->set('duration', $data_array['duration']);}
        if(isset($data_array['complaint_notes'])){$this->db->set('notes', $data_array['complaint_notes']);}
        if(isset($data_array['ccode1ext_code'])){$this->db->set('ccode1ext_code', $data_array['ccode1ext_code']);}
        if(isset($data_array['complaint_rank'])){$this->db->set('complaint_rank', $data_array['complaint_rank']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_complaint');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_complaint";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_complaint($data_array)


    /************************************************************************
     * Method to insert New Vital Signs  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required    
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_vitals($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting vitals details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        */

        /*
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_vital
        if(isset($data_array['vital_id'])){$this->db->set('vital_id', $data_array['vital_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['adt_id'])){$this->db->set('adt_id', $data_array['adt_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['reading_date'])){$this->db->set('reading_date', $data_array['reading_date']);}
        if(isset($data_array['reading_time'])){$this->db->set('reading_time', $data_array['reading_time']);}
        if(isset($data_array['time'])){$this->db->set('time', $data_array['time']);}
        if(isset($data_array['height'])){$this->db->set('height', $data_array['height']);}
        if(isset($data_array['weight'])){$this->db->set('weight', $data_array['weight']);}
        if(isset($data_array['left_vision'])){$this->db->set('left_vision', $data_array['left_vision']);}
        if(isset($data_array['right_vision'])){$this->db->set('right_vision', $data_array['right_vision']);}
        if(isset($data_array['temperature'])){$this->db->set('temperature', $data_array['temperature']);}
        if(isset($data_array['pulse_rate'])){$this->db->set('pulse_rate', $data_array['pulse_rate']);}
        if(isset($data_array['blood_pressure'])){$this->db->set('blood_pressure', $data_array['blood_pressure']);}
        if(isset($data_array['bmi'])){$this->db->set('bmi', $data_array['bmi']);}
        if(isset($data_array['waist_circumference'])){$this->db->set('waist_circumference', $data_array['waist_circumference']);}
        if(isset($data_array['bp_systolic'])){$this->db->set('bp_systolic', $data_array['bp_systolic']);}
        if(isset($data_array['bp_diastolic'])){$this->db->set('bp_diastolic', $data_array['bp_diastolic']);}
        if(isset($data_array['respiration_rate'])){$this->db->set('respiration_rate', $data_array['respiration_rate']);}
        if(isset($data_array['ofc'])){$this->db->set('ofc', $data_array['ofc']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_vital');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_vital";


        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_vitals($data_array)


    /************************************************************************
     * Method to insert New Diagnosis  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required   
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_diagnosis($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting diagnosis details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */

        /*
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_diagnosis
        if(isset($data_array['diagnosis_id'])){$this->db->set('diagnosis_id', $data_array['diagnosis_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['icpc_code'])){$this->db->set('icpc_code', $data_array['icpc_code']);} //deprecate
        if(isset($data_array['diagnosis_type'])){$this->db->set('diagnosis_type', $data_array['diagnosis_type']);}
        if(isset($data_array['diagnosis_notes'])){$this->db->set('notes', $data_array['diagnosis_notes']);}
        if(isset($data_array['dcode1set'])){$this->db->set('dcode1set', $data_array['dcode1set']);}
        if(isset($data_array['dcode1ext_code'])){$this->db->set('dcode1ext_code', $data_array['dcode1ext_code']);}
        if(isset($data_array['dcode2set'])){$this->db->set('dcode2set', $data_array['dcode2set']);}
        if(isset($data_array['dcode2ext_code'])){$this->db->set('dcode2ext_code', $data_array['dcode2ext_code']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('patient_diagnosis');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_diagnosis";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_diagnosis($data_array)


    /************************************************************************
     * Method to insert New Diagnosis  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required     
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_prescribe($data_array)
    {
        //$data_array = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting diagnosis details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */

        /*
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_diagnosis
        if(isset($data_array['prescribe_id'])){$this->db->set('queue_id', $data_array['prescribe_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['drug_formulary_id'])){$this->db->set('drug_formulary_id', $data_array['drug_formulary_id']);} //deprecate
        if(isset($data_array['dose'])){$this->db->set('dose', $data_array['dose']);}
        if(isset($data_array['dose_form'])){$this->db->set('dose_form', $data_array['dose_form']);}
        if(isset($data_array['frequency'])){$this->db->set('frequency', $data_array['frequency']);}
        if(isset($data_array['instruction'])){$this->db->set('instruction', $data_array['instruction']);}
        if(isset($data_array['quantity'])){$this->db->set('quantity', $data_array['quantity']);}
        if(isset($data_array['quantity_form'])){$this->db->set('quantity_form', $data_array['quantity_form']);}
        if(isset($data_array['indication'])){$this->db->set('indication', $data_array['indication']);}
        if(isset($data_array['caution'])){$this->db->set('caution', $data_array['caution']);}
        if(isset($data_array['status'])){$this->db->set('status', $data_array['status']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('prescript_queue');
        //echo $this->db->last_query();
        //echo "<br />Inserted into prescript_queue";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_prescribe($data_array)


    /************************************************************************
     * Method to add new system users
     *
     * This method adds a new user to the system. It inserts row into 
     * staff_info, staff_contact, staff_education, staff_work and system_user.
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_systemuser($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Adding new patient details";
        echo "<pre>";
            print_r($data_array);
        echo "</pre>";
  place_of_birth character varying(50),
  marital_status character varying(20),
  spouse_name character varying(100),
  no_of_children character varying(2),
  language_spoken character varying(50),
  language_written character varying(50),
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert row into staff_info
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);} // Not NULL
        if(isset($data_array['staff_category_id'])){$this->db->set('staff_category_id', $data_array['staff_category_id']);}
        if(isset($data_array['staff_name'])){$this->db->set('staff_name', $data_array['staff_name']);}
        if(isset($data_array['staff_initials'])){$this->db->set('staff_initials', $data_array['staff_initials']);}
        if(isset($data_array['mmc_no'])){$this->db->set('mmc_no', $data_array['mmc_no']);}
        if(isset($data_array['specialty'])){$this->db->set('specialty', $data_array['specialty']);}
        if(isset($data_array['gender'])){$this->db->set('gender', $data_array['gender']);}
        if(isset($data_array['ic_no'])){$this->db->set('ic_no', $data_array['ic_no']);}
        if(isset($data_array['ic_other_type'])){$this->db->set('ic_other_type', $data_array['ic_other_type']);}
        if(isset($data_array['ic_other_no'])){$this->db->set('ic_other_no', $data_array['ic_other_no']);}
        if(isset($data_array['nationality'])){$this->db->set('nationality', $data_array['nationality']);}
        if(isset($data_array['date_of_birth'])){$this->db->set('date_of_birth', $data_array['date_of_birth']);}
        if(isset($data_array['race'])){$this->db->set('race', $data_array['race']);}
        if(isset($data_array['staff_contact_id'])){$this->db->set('staff_contact_id', $data_array['staff_contact_id']);}
        if(isset($data_array['staff_work_id'])){$this->db->set('staff_work_id', $data_array['staff_work_id']);}
        // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('staff_info');
        //echo $this->db->last_query();
        //echo "<br />Inserted into staff_info";
        
        // Insert row into staff_contact
        /*
  tel_office character varying(20),
  pager_no character varying(30),
  fax_no character varying(20),
  remarks character varying(255), -- Added on Nov 18, 07
  im_handle character varying(255), -- Added on Nov 18, 07
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        if(isset($data_array['staff_contact_id'])){$this->db->set('staff_contact_id', $data_array['staff_contact_id']);}
        if(isset($data_array['address'])){$this->db->set('address', $data_array['address']);}
        if(isset($data_array['address2'])){$this->db->set('address2', $data_array['address2']);}
        if(isset($data_array['address3'])){$this->db->set('address3', $data_array['address3']);}
        if(isset($data_array['town'])){$this->db->set('town', $data_array['town']);}
        if(isset($data_array['state'])){$this->db->set('state', $data_array['state']);}
        if(isset($data_array['postcode'])){$this->db->set('postcode', $data_array['postcode']);}
        if(isset($data_array['country'])){$this->db->set('country', $data_array['country']);}
        if(isset($data_array['tel_home'])){$this->db->set('tel_home', $data_array['tel_home']);}
        if(isset($data_array['tel_mobile'])){$this->db->set('tel_mobile', $data_array['tel_mobile']);}
        if(isset($data_array['email'])){$this->db->set('email', $data_array['email']);}
        // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('staff_contact');
        //echo $this->db->last_query();
        //echo "<br />Inserted into staff_contact";

        // Insert row into staff_education
        /*
  staff_education_id character(10) NOT NULL,
  staff_id character(10) NOT NULL,
  school_name character varying(100),
  from_year character(4),
  to_year character(4),
  highest_level character varying(20),
  grade character varying(10),
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert row into staff_work
        /*
  epf_no character varying(20),
  socso_no character varying(20),
  date_started date,
  date_stopped date,
  weekly_rest_day character(1),
  no_paid_holiday character varying(3),
  no_sick_day character varying(3),
  annual_leave character varying(3),
  overtime_rate numeric(10,2),
  overtime_hour character varying(2),
  other_allowance numeric(10,2),
  starting_salary numeric(10,2),
  present_salary numeric(10,2),
  last_login timestamp without time zone, -- Added on May 19, 2006
  income_tax_no character varying(20), -- Added on May 19, 2006
  cost_hour_std numeric(11,3), -- Added on Nov 18, 07
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Perform db insert
        if(isset($data_array['staff_work_id'])){$this->db->set('staff_work_id', $data_array['staff_work_id']);}
        if(isset($data_array['wage_type'])){$this->db->set('wage_type', $data_array['wage_type']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['home_clinic'])){$this->db->set('home_clinic', $data_array['home_clinic']);}
        //echo $this->db->_compile_select();
        $this->db->insert('staff_work');
        //echo $this->db->last_query();
        //echo "<br />Inserted into system_user";

        // Insert row into system_user
        if(isset($data_array['user_id'])){$this->db->set('user_id', $data_array['user_id']);}
        if(isset($data_array['category_id'])){$this->db->set('category_id', $data_array['category_id']);}
        if(isset($data_array['username'])){$this->db->set('username', $data_array['username']);}
        if(isset($data_array['password'])){$this->db->set('password', $data_array['password']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['expiry_date'])){$this->db->set('expiry_date', $data_array['expiry_date']);}
        if(isset($data_array['access_status'])){$this->db->set('access_status', $data_array['access_status']);}
        if(isset($data_array['permission'])){$this->db->set('permission', $data_array['permission']);}
        // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('system_user');
        //echo $this->db->last_query();
        //echo "<br />Inserted into system_user";

    } // end of function insert_new_systemuser($data_array)


    //===============================================================
    // Update Database Methods
    /************************************************************************
     * Method to update current diagnosis
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_diagnosis($data_array)
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
        $this->db->set('patient_id', $data_array['patient_id']);
        $this->db->set('session_id', $data_array['session_id']);
        //$this->db->set('icpc_code', $data_array['icpc_code']); //deprecated
        $this->db->set('diagnosis_type', $data_array['diagnosis_type']);
        $this->db->set('notes', $data_array['diagnosis_notes']);
        $this->db->set('dcode1set', $data_array['dcode1set']);
        $this->db->set('dcode1ext_code', $data_array['dcode1ext_code']);
        //$this->db->set('dcode2set', $data_array['dcode2set']);
        //$this->db->set('dcode2ext_code', $data_array['dcode2ext_code']);
        $this->db->set('remarks', $data_array['remarks']);
        $this->db->where('diagnosis_id', $data_array['diagnosis_id']);
        $this->db->update('patient_diagnosis');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_diagnosis($data_array)


    /************************************************************************
     * Method to update_complaint
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_complaint($data_array)
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
        $this->db->set('patient_id', $data_array['patient_id']);
        $this->db->set('session_id', $data_array['session_id']);
        $this->db->set('icpc_code', $data_array['icpc_code']); 
        $this->db->set('duration', $data_array['duration']);
        $this->db->set('notes', $data_array['complaint_notes']);
        $this->db->set('ccode1ext_code', $data_array['ccode1ext_code']);
        $this->db->set('remarks', $data_array['remarks']);
        $this->db->where('complaint_id', $data_array['complaint_id']);
        $this->db->update('patient_complaint');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_complaint($data_array)


    /************************************************************************
     * Method to close clinical consultation episode
     *
     * This method 
     *
	 * @param   array  data_array      Required
	 * @param   array  diagnosis_array Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function end_episode($data_array,$diagnosis_array=NULL)
    {
        //$data = array();
        //$data   = $data_array;
        $_user_ip =   $this->input->ip_address();
        
        /*
        echo "<hr />";
        echo "Updating episode details";
        echo "<pre>";
        print_r($data_array);
        print_r($diagnosis_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        */
        //$this->db->set('patient_id', $data_array['patient_id']);
        $this->db->set('session_ref', $data_array['session_ref']);
        //$this->db->set('session_sequence', $data_array['session_sequence']); 
        $this->db->set('external_ref', $data_array['external_ref']);
        $this->db->set('date_started', $data_array['date_started']);
        $this->db->set('time_started', $data_array['time_started']);
        $this->db->set('date_ended', $data_array['date_ended']);
        $this->db->set('time_ended', $data_array['time_ended']);
        $this->db->set('signed_by', $data_array['signed_by']);
        $this->db->set('location_end', $data_array['location_end']);
        $this->db->set('ip_end', $_user_ip);
        $this->db->set('summary', $data_array['consult_summary']);
        $this->db->set('status', $data_array['status']);
        $this->db->set('remarks', $data_array['remarks']);
        $this->db->where('summary_id', $data_array['summary_id']);
        //$this->db->update('patient_con');
        $this->db->update('patient_consultation_summary');
        //echo $this->db->last_query();

        /*
  "month" character varying(2),
  "year" character varying(4),
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into patient_medical_history
        //echo "Transfering to medical history";
        foreach($diagnosis_array as $diagnosis_item){
            $this->db->set('medical_history_id', $diagnosis_item['diagnosis_id']);
            $this->db->set('patient_id', $data_array['patient_id']);
            $this->db->set('staff_id', $data_array['signed_by']);
            $this->db->set('history_date', $data_array['date_ended']);
            $this->db->set('condition', $diagnosis_item['full_title']);
            $this->db->set('status', 'In-house Consultation');
            if(isset($diagnosis_item['diagnosis_notes'])){$this->db->set('summary', $diagnosis_item['diagnosis_notes']);}
            $this->db->set('dcode1set', $diagnosis_item['dcode1set']);
            $this->db->set('dcode1ext_code', $diagnosis_item['dcode1ext_code']);
            if(isset($diagnosis_item['dcode2set'])){$this->db->set('dcode2set', $diagnosis_item['dcode2set']);}
            if(isset($diagnosis_item['dcode2ext_code'])){$this->db->set('dcode2ext_code', $diagnosis_item['dcode2ext_code']);}
            if(isset($diagnosis_item['remarks'])){$this->db->set('remarks', $diagnosis_item['remarks']);}
             // Perform db insert
            $this->db->insert('patient_medical_history');
            //echo "\n<br />";
            //echo $this->db->last_query();
        }
            //echo "<br />Inserted into patient_diagnosis";

        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function end_episode($data_array,$diagnosis_array=NULL)


}

/* End of file memr.php */
/* Location: ./app_thirra/models/memr.php */
