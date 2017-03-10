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
 * Model Class for Utilities
 *
 * This class is for models that only reads from the database.
 *
 * @version 0.9
 * @package THIRRA - mReport
 * @author  Jason Tan Boon Teck
 */

class MReport extends CI_Model
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
    /**
     * Method to retrieve list of geographical villages
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_reports_list($section=NULL,$type=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT report_header.*";
        $sqlQuery   .=  " FROM report_header";
		if(isset($section)){
			$sqlQuery   .=  " AND report_section='".$section."'";
		}
        $sqlQuery   .=  " ORDER BY report_sort";
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
    } //end of function get_reports_list($section=NULL,$type=NULL)


    //************************************************************************
    /**
     * Method to retrieve one report header.
     *
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_report_header($id)
    {
        $data = array();
        $options = array('report_header_id' => $id);
        $Q = $this->db->get_where('report_header',$options,1);
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_report_header($id)


    //************************************************************************
    /**
     * Method to retrieve one report data.
     *
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_report_data($report_source)
    {
        $data = array();
        //$options = array('report_header_id' => $id);
        //$Q = $this->db->get_where('report_header',$options,1);
        $Q = $this->db->get($report_source);
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_report_data($report_source)


    //************************************************************************
    /**
     * Method to retrieve report columns.
     *
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_report_body($report_header_id, $body_id=NULL)
    {
        $data = array();
        $options = array('report_header_id' => $report_header_id);
        if(isset($body_id)){
            $options = array('report_body_id' => $body_id);
        }
        $this->db->order_by('col_sort'); 
        $Q = $this->db->get_where('report_body',$options);
        //$Q = $this->db->get($report_source);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_report_body($id)


	//************************************************************************
    /**
     * Method to retrieve list of views
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_reports_scope()
    {
        $dataset = array();
        $dataset[1]['scope']     =   "Server";
        $dataset[1]['desc']     =   "All clinics";
        $dataset[2]['scope']     =   "Clinic";
        $dataset[2]['desc']     =   "One single clinic";
        $dataset[3]['scope']     =   "Patient";
        $dataset[3]['desc']     =   "Per patient";
        
        return $dataset;    
    } //end of function get_reports_scope()


	//************************************************************************
    /**
     * Method to retrieve list of views. Each view is a method below.
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_reports_sources()
    {
        $dataset = array();
        $dataset[1]['view']     =   "rpt_patient_demo";
        $dataset[1]['desc']     =   "Patient Demographic Info";
        $dataset[1]['order']    =   "pdem.name";
        $dataset[2]['view']     =   "rpt_patient_vital";
        $dataset[2]['desc']     =   "Vital Signs";
        $dataset[2]['order']    =   "pdem.name";
        $dataset[3]['view']     =   "rpt_clinical_consults";
        $dataset[3]['desc']     =   "Clinical Consultations";
        $dataset[3]['order']    =   "pdem.name";
        $dataset[4]['view']     =   "rpt_patient_diagnoses";
        $dataset[4]['desc']     =   "Diagnoses";
        $dataset[4]['order']    =   "pdem.patient_name";
        $dataset[5]['view']     =   "rpt_patient_complaints";
        $dataset[5]['desc']     =   "Complaints";
        $dataset[5]['order']    =   "pdem.patient_name";
        $dataset[6]['view']     =   "rpt_patient_lab_orders";
        $dataset[6]['desc']     =   "Lab Tests Orders";
        $dataset[6]['order']    =   "pdem.patient_name";
        $dataset[7]['view']     =   "rpt_patient_imag_orders";
        $dataset[7]['desc']     =   "Imaging Orders";
        $dataset[7]['order']    =   "pdem.patient_name";
        $dataset[8]['view']     =   "rpt_bio_closed";
        $dataset[8]['desc']     =   "Closed Biosurveillance Investigations";
        $dataset[8]['order']    =   "pdem.patient_name";
        $dataset[9]['view']     =   "rpt_consult_antenatal";
        $dataset[9]['desc']     =   "List of Pregnancies Consulted";
        $dataset[9]['order']    =   "pdem.patient_name";
        $dataset[10]['view']    =   "rpt_prescript_queue";
        $dataset[10]['desc']    =   "Drugs Prescribed";
        $dataset[10]['order']    =   "pdem.patient_name";
        $dataset[11]['view']     =   "rpt_antenatal_list";
        $dataset[11]['desc']     =   "List of Pregnancies";
        $dataset[11]['order']    =   "pdem.patient_name";
        $dataset[12]['view']     =   "rpt_immunisation_done";
        $dataset[12]['desc']     =   "Immunisations Done";
        $dataset[12]['order']    =   "pdem.patient_name";
        $dataset[13]['view']     =   "rpt_export_demo2sipps";
        $dataset[13]['desc']     =   "Export demographic to SIPPS";
        $dataset[13]['order']    =   "pdem.patient_name";
        
        return $dataset;    
    } //end of function get_reports_sources() get_rpt_consult_antenatal


    //************************************************************************
    /**
     * Method to retrieve details of get_rpt_patient_demo.
     * NOT WORKING - VARIABLE VARIABLE IN ARRAY
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_view_patient_demo($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =  " SELECT * FROM gem_report_diagnosis ";
        /*
        $sqlQuery   =   "SELECT patient_id, clinic_reference_number, name, name_first, gender, ic_no, ic_other_no, 
                        birth_date, ethnicity, marital_status,
                        cinf.clinic_name
                            ";
        $sqlQuery   .=  " FROM patient_demographic_info pdem";
        $sqlQuery   .=  " JOIN clinic_info cinf ON pdem.clinic_home = cinf.clinic_info_id";
        
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND pdem.clinic_home='".$param['clinic_info_id']."'";
        }
        */
        $sqlQuery   .=  " WHERE 1=1";
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND patient_id='".$param['patient_id']."'";
        }
        
        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        $num_fields = $query->num_fields(); 
        //reset($query);

        $sqlQuery2   =  "select column_name from information_schema.columns where table_name = 'gem_report_diagnosis'";
        $query2 =  $this->db->query($sqlQuery2);
        $num_fields2 = $query2->num_fields(); 
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            // Rename keys
            foreach ($query->result_array() as $row)
            {
                
                $rownum++;            
            }
            foreach ($query->result_array() as $row)
            {
                $colnum=0;
        /*
                foreach ($query2->result_array() as $col)
                {
                    $col_name = $col['column_name']
                    $dataset[$rownum][$colnum]['field'] = $col_name;
                    //$dataset[$rownum][$colnum]['val']   = $row[$colnum];
                    $dataset[$rownum][$colnum]['desc']  = $col_name;
                    $colnum++;
                }
        */
                $rownum++;            
            }
        }    
        if($expect == 'data'){
            return $dataset; 
        } else {
            return $num_fields;
        }
        
    } //end of function get_view_patient_demo($patient_id)


    //************************************************************************
    /**
     * Method to retrieve details of get_rpt_patient_demo.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_patient_demo($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pdem.patient_id, clinic_reference_number, pns_pat_id, nhfa_no, name, name_first, gender, 
                        ic_no, ic_other_no, nationality, birth_date, ethnicity, religion, marital_status, pdem.remarks as pdem_remarks,";
        $sqlQuery   .=  " pctc.state AS con_state, pctc.country AS con_country, pctc.tel_home, pctc.tel_mobile, ";
        $sqlQuery   .=  " cinf.clinic_name,";
        $sqlQuery   .=  " avil.addr_village_name,";
        $sqlQuery   .=  " atow.addr_town_name";
        $sqlQuery   .=  " FROM patient_demographic_info pdem";
        $sqlQuery   .=  " JOIN clinic_info cinf ON pdem.clinic_home = cinf.clinic_info_id";
        $sqlQuery   .=  " JOIN patient_contact_info pctc ON pdem.contact_id = pctc.contact_id";
        $sqlQuery   .=  " LEFT OUTER JOIN addr_village avil ON pctc.addr_village_id = avil.addr_village_id";
        $sqlQuery   .=  " LEFT OUTER JOIN addr_town atow ON pctc.addr_town_id = atow.addr_town_id";
        $sqlQuery   .=  " WHERE 1=1";
        
        
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND pdem.clinic_home='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND pdem.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "patient_id";
                $dataset[$rownum][0]['val']  = $row['patient_id'];
                $dataset[$rownum][0]['desc']  = "System identification number";
                $dataset[$rownum][1]['field']  = "clinic_reference_number";
                $dataset[$rownum][1]['val']  = $row['clinic_reference_number'];
                $dataset[$rownum][1]['desc']  = "Clinic Reference Number";
                $dataset[$rownum][2]['field']  = "pns_pat_id";
                $dataset[$rownum][2]['val']  = $row['pns_pat_id'];
                $dataset[$rownum][2]['desc']  = "pns_pat_id";
                $dataset[$rownum][3]['field']  = "nhfa_no";
                $dataset[$rownum][3]['val']  = $row['nhfa_no'];
                $dataset[$rownum][3]['desc']  = "nhfa_no";
                $dataset[$rownum][4]['field']  = "name";
                $dataset[$rownum][4]['val']  = $row['name'];
                $dataset[$rownum][4]['desc']  = "Name";
                $dataset[$rownum][5]['field']  = "name_first";
                $dataset[$rownum][5]['val']  = $row['name_first'];
                $dataset[$rownum][5]['desc']  = "First name (optional)";
                $dataset[$rownum][6]['field']  = "gender";
                $dataset[$rownum][6]['val']  = $row['gender'];
                $dataset[$rownum][6]['desc']  = "Gender";
                $dataset[$rownum][7]['field']  = "ic_no";
                $dataset[$rownum][7]['val']  = $row['ic_no'];
                $dataset[$rownum][7]['desc']  = "National ID No.";
                $dataset[$rownum][8]['field']  = "ic_other_no";
                $dataset[$rownum][8]['val']  = $row['ic_other_no'];
                $dataset[$rownum][8]['desc']  = "Other IC No.";
                $dataset[$rownum][9]['field']  = "nationality";
                $dataset[$rownum][9]['val']  = $row['nationality'];
                $dataset[$rownum][9]['desc']  = "Nationality";
                $dataset[$rownum][10]['field']  = "birth_date";
                $dataset[$rownum][10]['val']  = $row['birth_date'];
                $dataset[$rownum][10]['desc']  = "Date of Birth";
                $dataset[$rownum][11]['field']  = "ethnicity";
                $dataset[$rownum][11]['val']  = $row['ethnicity'];
                $dataset[$rownum][11]['desc']  = "Ethnicity/Race";
                $dataset[$rownum][12]['field']  = "religion";
                $dataset[$rownum][12]['val']  = $row['religion'];
                $dataset[$rownum][12]['desc']  = "Religion";
                $dataset[$rownum][13]['field']  = "marital_status";
                $dataset[$rownum][13]['val']  = $row['marital_status'];
                $dataset[$rownum][13]['desc']  = "marital_status";
                $dataset[$rownum][14]['field']  = "remarks";
                $dataset[$rownum][14]['val']  = $row['pdem_remarks'];
                $dataset[$rownum][14]['desc']  = "remarks";
                $dataset[$rownum][15]['field']  = "con_state";
                $dataset[$rownum][15]['val']  = $row['con_state'];
                $dataset[$rownum][15]['desc']  = "con_state";
                $dataset[$rownum][16]['field']  = "con_country";
                $dataset[$rownum][16]['val']  = $row['con_country'];
                $dataset[$rownum][16]['desc']  = "con_country";
                $dataset[$rownum][17]['field']  = "tel_home";
                $dataset[$rownum][17]['val']  = $row['tel_home'];
                $dataset[$rownum][17]['desc']  = "tel_home";
                $dataset[$rownum][18]['field']  = "tel_mobile";
                $dataset[$rownum][18]['val']  = $row['tel_mobile'];
                $dataset[$rownum][18]['desc']  = "tel_mobile";
                $dataset[$rownum][19]['field']  = "home_clinic";
                $dataset[$rownum][19]['val']  = $row['clinic_name'];
                $dataset[$rownum][19]['desc']  = "Home clinic";
                $dataset[$rownum][20]['field']  = "addr_village_name";
                $dataset[$rownum][20]['val']  = $row['addr_village_name'];
                $dataset[$rownum][20]['desc']  = "addr_village_name";
                $dataset[$rownum][21]['field']  = "addr_town_name";
                $dataset[$rownum][21]['val']  = $row['addr_town_name'];
                $dataset[$rownum][21]['desc']  = "addr_town_name";
                $rownum++;            
            }
        }    
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
        
    } //end of function get_patient_demo($patient_id)


    //************************************************************************
    /** OBSOLETE
     * Method to retrieve columns names of get_rpt_patient_demo. This is needed
     * to count the number of columns per view
     *
	 * @param   string  $patient_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function getc_rpt_patient_demo()
    {
        $dataset = array();
        $dataset[0] =   'patient_id';
        $dataset[1] =   'clinic_reference_number';
        $dataset[2] =   'name';
        $dataset[3] =   'name_first';
        $dataset[4] =   'gender';
        $dataset[5] =   'ic_no';
        $dataset[6] =   'birth_date';
        return $dataset; 
    } //end of function getc_patient_demo()


    //************************************************************************
    /**
     * Method to retrieve details of recent get_patient_vital.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_patient_vital($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pvit.patient_id, reading_date, reading_time, temperature, pulse_rate,
                        height, weight, bp_systolic, bp_diastolic,
                        pdem.name, pdem.name_first, pdem.gender, pdem.ic_no, pdem.birth_date
                            ";
        $sqlQuery   .=  " FROM patient_vital pvit";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON pvit.patient_id = pdem.patient_id";
        $sqlQuery   .=  " WHERE 1=1";
        
        if(isset($param['period_from'])){
            $sqlQuery   .=  " AND reading_date >= '".$param['period_from']."'";        
        }
        if(isset($param['period_to'])){
            $sqlQuery   .=  " AND reading_date <= '".$param['period_to']."'";        
        }
        if($param['clinic_info_id'] <> "All"){
            //$sqlQuery   .=  " AND location_start='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND pvit.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "patient_id";
                $dataset[$rownum][0]['val']  = $row['patient_id'];
                $dataset[$rownum][0]['desc']  = "patient_id";
                $dataset[$rownum][1]['field']= "reading_date";
                $dataset[$rownum][1]['val']  = $row['reading_date'];
                $dataset[$rownum][1]['desc']= "reading_date";
                $dataset[$rownum][2]['field']= "reading_time";
                $dataset[$rownum][2]['val']  = $row['reading_time'];
                $dataset[$rownum][2]['desc']= "reading_time";
                $dataset[$rownum][3]['field']= "temperature";
                $dataset[$rownum][3]['val']  = $row['temperature'];
                $dataset[$rownum][3]['desc']= "temperature";
                $dataset[$rownum][4]['field']= "pulse_rate";
                $dataset[$rownum][4]['val']  = $row['pulse_rate'];
                $dataset[$rownum][4]['desc']= "pulse_rate";
                $dataset[$rownum][5]['field']= "height";
                $dataset[$rownum][5]['val']  = $row['height'];
                $dataset[$rownum][5]['desc']= "height";
                $dataset[$rownum][6]['field']= "weight";
                $dataset[$rownum][6]['val']  = $row['weight'];
                $dataset[$rownum][6]['desc']= "weight";
                $dataset[$rownum][7]['field'] = "bp_systolic";
                $dataset[$rownum][7]['val'] = $row['bp_systolic'];
                $dataset[$rownum][7]['desc'] = "bp_systolic";
                $dataset[$rownum][8]['field']  = "bp_diastolic";
                $dataset[$rownum][8]['val']  = $row['bp_diastolic'];
                $dataset[$rownum][8]['desc']  = "bp_diastolic";
                $dataset[$rownum][9]['field']  = "patient_name";
                $dataset[$rownum][9]['val']  = $row['name'];
                $dataset[$rownum][9]['desc']  = "Patient name";
                $dataset[$rownum][10]['field']  = "name_first";
                $dataset[$rownum][10]['val']  = $row['name_first'];
                $dataset[$rownum][10]['desc']  = "First name";
                $dataset[$rownum][11]['field']  = "gender";
                $dataset[$rownum][11]['val']  = $row['gender'];
                $dataset[$rownum][11]['desc']  = "gender";
                $dataset[$rownum][12]['field']  = "ic_no";
                $dataset[$rownum][12]['val']  = $row['ic_no'];
                $dataset[$rownum][12]['desc']  = "ic_no";
                $dataset[$rownum][13]['field']  = "birth_date";
                $dataset[$rownum][13]['val']  = $row['birth_date'];
                $dataset[$rownum][13]['desc']  = "birth_date";
                $rownum++;            
            }
        }            
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
     } //end of function get_patient_vital($patient_id)


    //************************************************************************
    /**
     * Method to retrieve details of recent clinical consultations.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_clinical_consults($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pcon.summary_id, session_ref, session_sequence, external_ref, pcon.patient_id, staff_id, 
                        date_started, time_started, date_ended,time_ended,signed_by,location_start,location_end,
                        summary, pcon.status,
                        pdem.clinic_reference_number, pdem.name, pdem.name_first, pdem.gender, pdem.birth_date,
                        clin.clinic_shortname
                            ";
        $sqlQuery   .=  " FROM patient_consultation_summary pcon";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON pcon.patient_id = pdem.patient_id";
        $sqlQuery   .=  " JOIN clinic_info clin ON pcon.location_start=clin.clinic_info_id";
        //$sqlQuery   .=  " JOIN drug_formulary ON patient_medication.drug_formulary_id = drug_formulary.drug_formulary_id";
        
        $sqlQuery   .=  " WHERE 1=1";
        if(isset($param['period_from'])){
            $sqlQuery   .=  " AND date_started >= '".$param['period_from']."'";        
        }
        if(isset($param['period_to'])){
            $sqlQuery   .=  " AND date_started <= '".$param['period_to']."'";        
        }
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND location_start='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND pcon.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "summary_id";
                $dataset[$rownum][0]['val']  = $row['summary_id'];
                $dataset[$rownum][0]['desc']  = "summary_id";
                $dataset[$rownum][1]['field']= "session_ref";
                $dataset[$rownum][1]['val']  = $row['session_ref'];
                $dataset[$rownum][1]['desc']= "session_ref";
                $dataset[$rownum][2]['field']= "session_sequence";
                $dataset[$rownum][2]['val']  = $row['session_sequence'];
                $dataset[$rownum][2]['desc']= "session_sequence";
                $dataset[$rownum][3]['field']= "external_ref";
                $dataset[$rownum][3]['val']  = $row['external_ref'];
                $dataset[$rownum][3]['desc']= "external_ref";
                $dataset[$rownum][4]['field'] = "patient_id";
                $dataset[$rownum][4]['val'] = $row['patient_id'];
                $dataset[$rownum][4]['desc'] = "patient_id";
                $dataset[$rownum][5]['field']  = "staff_id";
                $dataset[$rownum][5]['val']  = $row['staff_id'];
                $dataset[$rownum][5]['desc']  = "staff_id";
                $dataset[$rownum][6]['field']  = "date_started";
                $dataset[$rownum][6]['val']  = $row['date_started'];
                $dataset[$rownum][6]['desc']  = "date_started";
                $dataset[$rownum][7]['field']  = "time_started";
                $dataset[$rownum][7]['val']  = $row['time_started'];
                $dataset[$rownum][7]['desc']  = "time_started";
                $dataset[$rownum][8]['field']  = "date_ended";
                $dataset[$rownum][8]['val']  = $row['date_ended'];
                $dataset[$rownum][8]['desc']  = "date_ended";
                $dataset[$rownum][9]['field']  = "time_ended";
                $dataset[$rownum][9]['val']  = $row['time_ended'];
                $dataset[$rownum][9]['desc']  = "time_ended";
                $dataset[$rownum][10]['field']  = "signed_by";
                $dataset[$rownum][10]['val']  = $row['signed_by'];
                $dataset[$rownum][10]['desc']  = "signed_by";
                $dataset[$rownum][11]['field']  = "location_start";
                $dataset[$rownum][11]['val']  = $row['location_start'];
                $dataset[$rownum][11]['desc']  = "location_start";
                $dataset[$rownum][12]['field']  = "location_end";
                $dataset[$rownum][12]['val']  = $row['location_end'];
                $dataset[$rownum][12]['desc']  = "location_end";
                $dataset[$rownum][13]['field']  = "summary";
                $dataset[$rownum][13]['val']  = $row['summary'];
                $dataset[$rownum][13]['desc']  = "summary";
                $dataset[$rownum][14]['field']  = "status";
                $dataset[$rownum][14]['val']  = $row['status'];
                $dataset[$rownum][14]['desc']  = "status";
                $dataset[$rownum][15]['field']  = "clinic_reference_number";
                $dataset[$rownum][15]['val']  = $row['clinic_reference_number'];
                $dataset[$rownum][15]['desc']  = "clinic_reference_number";
                $dataset[$rownum][16]['field']  = "patient_name";
                $dataset[$rownum][16]['val']  = $row['name'];
                $dataset[$rownum][16]['desc']  = "Patient name";
                $dataset[$rownum][17]['field']  = "name_first";
                $dataset[$rownum][17]['val']  = $row['name_first'];
                $dataset[$rownum][17]['desc']  = "name_first";
                $dataset[$rownum][18]['field']  = "gender";
                $dataset[$rownum][18]['val']  = $row['gender'];
                $dataset[$rownum][18]['desc']  = "gender";
                $dataset[$rownum][19]['field']  = "birth_date";
                $dataset[$rownum][19]['val']  = $row['birth_date'];
                $dataset[$rownum][19]['desc']  = "birth_date";
                $dataset[$rownum][20]['field']  = "clinic_shortname";
                $dataset[$rownum][20]['val']  = $row['clinic_shortname'];
                $dataset[$rownum][20]['desc']  = "clinic_shortname";
                $rownum++;            
            }
        }            
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
     } //end of function get_rpt_clinical_consults($patient_id)


    //************************************************************************
    /**
     * Method to retrieve details of recent patient_diagnoses.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_patient_diagnoses($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pdig.patient_id, pdig.diagnosis_type, pdig.notes, pdig.dcode1ext_code, 
                        name AS patient_name, pdem.name_first, birth_date, gender,
                        date_started,
                        dcode1ext_longname, dcode1ext_shortname,
                        clin.clinic_shortname
                            ";
        $sqlQuery   .=  " FROM patient_diagnosis pdig";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON pdig.patient_id = pdem.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary pcsm ON pdig.session_id = pcsm.summary_id";
        $sqlQuery   .=  " JOIN dcode1ext ON pdig.dcode1ext_code = dcode1ext.dcode1ext_code";
        $sqlQuery   .=  " JOIN clinic_info clin ON pcsm.location_start=clin.clinic_info_id";
        $sqlQuery   .=  " WHERE 1=1";
        
        if(isset($param['period_from'])){
            $sqlQuery   .=  " AND date_started >= '".$param['period_from']."'";        
        }
        if(isset($param['period_to'])){
            $sqlQuery   .=  " AND date_started <= '".$param['period_to']."'";        
        }
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND location_start='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND pdig.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "patient_id";
                $dataset[$rownum][0]['val']  = $row['patient_id'];
                $dataset[$rownum][0]['desc']  = "patient_id";
                $dataset[$rownum][1]['field']= "diagnosis_type";
                $dataset[$rownum][1]['val']  = $row['diagnosis_type'];
                $dataset[$rownum][1]['desc']= "diagnosis_type";
                $dataset[$rownum][2]['field']= "notes";
                $dataset[$rownum][2]['val']  = $row['notes'];
                $dataset[$rownum][2]['desc']= "notes";
                $dataset[$rownum][3]['field']= "dcode1ext_code";
                $dataset[$rownum][3]['val']  = $row['dcode1ext_code'];
                $dataset[$rownum][3]['desc']= "dcode1ext_code";
                $dataset[$rownum][4]['field'] = "patient_name";
                $dataset[$rownum][4]['val'] = $row['patient_name'];
                $dataset[$rownum][4]['desc'] = "patient_name";
                $dataset[$rownum][5]['field']  = "name_first";
                $dataset[$rownum][5]['val']  = $row['name_first'];
                $dataset[$rownum][5]['desc']  = "First name";
                $dataset[$rownum][6]['field']  = "birth_date";
                $dataset[$rownum][6]['val']  = $row['birth_date'];
                $dataset[$rownum][6]['desc']  = "birth_date";
                $dataset[$rownum][7]['field']  = "gender";
                $dataset[$rownum][7]['val']  = $row['gender'];
                $dataset[$rownum][7]['desc']  = "gender";
                $dataset[$rownum][8]['field']  = "date_started";
                $dataset[$rownum][8]['val']  = $row['date_started'];
                $dataset[$rownum][8]['desc']  = "date_started";
                $dataset[$rownum][9]['field']  = "dcode1ext_longname";
                $dataset[$rownum][9]['val']  = $row['dcode1ext_longname'];
                $dataset[$rownum][9]['desc']  = "dcode1ext_longname";
                $dataset[$rownum][10]['field']  = "dcode1ext_shortname";
                $dataset[$rownum][10]['val']  = $row['dcode1ext_shortname'];
                $dataset[$rownum][10]['desc']  = "dcode1ext_shortname";
                $dataset[$rownum][11]['field']  = "clinic_shortname";
                $dataset[$rownum][11]['val']  = $row['clinic_shortname'];
                $dataset[$rownum][11]['desc']  = "clinic_shortname";
                $rownum++;            
            }
        }            
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
     } //end of function get_rpt_patient_diagnoses($expect='data',$rows=NULL,$param=NULL)


    //************************************************************************
    /**
     * Method to retrieve details of recent patient_complaints.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_patient_complaints($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pcpl.patient_id, pcpl.icpc_code, pcpl.duration, pcpl.notes, pcpl.remarks,
                        name AS patient_name, pdem.name_first, birth_date, gender,
                        date_started,
                        icpc.full_description, icpc.icd_10,
                        clin.clinic_shortname
                            ";
        $sqlQuery   .=  " FROM patient_complaint pcpl";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON pcpl.patient_id = pdem.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary pcsm ON pcpl.session_id = pcsm.summary_id";
        $sqlQuery   .=  " JOIN icpc2_symptom icpc ON pcpl.icpc_code = icpc.icpc_code";
        $sqlQuery   .=  " JOIN clinic_info clin ON pcsm.location_start=clin.clinic_info_id";
        $sqlQuery   .=  " WHERE 1=1";
        
        if(isset($param['period_from'])){
            $sqlQuery   .=  " AND date_started >= '".$param['period_from']."'";        
        }
        if(isset($param['period_to'])){
            $sqlQuery   .=  " AND date_started <= '".$param['period_to']."'";        
        }
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND location_start='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND pcpl.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "patient_id";
                $dataset[$rownum][0]['val']  = $row['patient_id'];
                $dataset[$rownum][0]['desc']  = "patient_id";
                $dataset[$rownum][1]['field']= "icpc_code";
                $dataset[$rownum][1]['val']  = $row['icpc_code'];
                $dataset[$rownum][1]['desc']= "icpc_code";
                $dataset[$rownum][2]['field']= "duration";
                $dataset[$rownum][2]['val']  = $row['duration'];
                $dataset[$rownum][2]['desc']= "duration";
                $dataset[$rownum][3]['field']= "notes";
                $dataset[$rownum][3]['val']  = $row['notes'];
                $dataset[$rownum][3]['desc']= "notes";
                $dataset[$rownum][4]['field']= "remarks";
                $dataset[$rownum][4]['val']  = $row['remarks'];
                $dataset[$rownum][4]['desc']= "remarks";
                $dataset[$rownum][5]['field'] = "patient_name";
                $dataset[$rownum][5]['val'] = $row['patient_name'];
                $dataset[$rownum][5]['desc'] = "patient_name";
                $dataset[$rownum][6]['field']  = "name_first";
                $dataset[$rownum][6]['val']  = $row['name_first'];
                $dataset[$rownum][6]['desc']  = "First name";
                $dataset[$rownum][7]['field']  = "birth_date";
                $dataset[$rownum][7]['val']  = $row['birth_date'];
                $dataset[$rownum][7]['desc']  = "birth_date";
                $dataset[$rownum][8]['field']  = "gender";
                $dataset[$rownum][8]['val']  = $row['gender'];
                $dataset[$rownum][8]['desc']  = "gender";
                $dataset[$rownum][9]['field']  = "date_started";
                $dataset[$rownum][9]['val']  = $row['date_started'];
                $dataset[$rownum][9]['desc']  = "date_started";
                $dataset[$rownum][10]['field']  = "full_description";
                $dataset[$rownum][10]['val']  = $row['full_description'];
                $dataset[$rownum][10]['desc']  = "full_description";
                $dataset[$rownum][11]['field']  = "icd_10";
                $dataset[$rownum][11]['val']  = $row['icd_10'];
                $dataset[$rownum][11]['desc']  = "icd_10";
                $dataset[$rownum][12]['field']  = "clinic_shortname";
                $dataset[$rownum][12]['val']  = $row['clinic_shortname'];
                $dataset[$rownum][12]['desc']  = "clinic_shortname";
                $rownum++;            
            }
        }            
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
     } //end of function get_rpt_patient_complaints($expect='data',$rows=NULL,$param=NULL)


    //************************************************************************
    /**
     * Method to retrieve details of recent lab orders.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_patient_lab_orders($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT lord.patient_id, lord.sample_ref, lord.sample_date, lord.summary_result, 
                        name AS patient_name, pdem.name_first, birth_date, gender,
                        date_started,
                        lpac.package_code, lpac.package_name,
                        clin.clinic_shortname
                            ";
        $sqlQuery   .=  " FROM lab_order lord";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON lord.patient_id = pdem.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary pcsm ON lord.session_id = pcsm.summary_id";
        $sqlQuery   .=  " JOIN lab_package lpac ON lord.lab_package_id = lpac.lab_package_id";
        $sqlQuery   .=  " JOIN clinic_info clin ON pcsm.location_start=clin.clinic_info_id";
        $sqlQuery   .=  " WHERE 1=1";
        
        if(isset($param['period_from'])){
            $sqlQuery   .=  " AND date_started >= '".$param['period_from']."'";        
        }
        if(isset($param['period_to'])){
            $sqlQuery   .=  " AND date_started <= '".$param['period_to']."'";        
        }
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND location_start='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND lord.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "patient_id";
                $dataset[$rownum][0]['val']  = $row['patient_id'];
                $dataset[$rownum][0]['desc']  = "patient_id";
                $dataset[$rownum][1]['field']= "sample_ref";
                $dataset[$rownum][1]['val']  = $row['sample_ref'];
                $dataset[$rownum][1]['desc']= "sample_ref";
                $dataset[$rownum][2]['field']= "sample_date";
                $dataset[$rownum][2]['val']  = $row['sample_date'];
                $dataset[$rownum][2]['desc']= "sample_date";
                $dataset[$rownum][3]['field']= "summary_result";
                $dataset[$rownum][3]['val']  = $row['summary_result'];
                $dataset[$rownum][3]['desc']= "summary_result";
                $dataset[$rownum][4]['field'] = "patient_name";
                $dataset[$rownum][4]['val'] = $row['patient_name'];
                $dataset[$rownum][4]['desc'] = "patient_name";
                $dataset[$rownum][5]['field']  = "name_first";
                $dataset[$rownum][5]['val']  = $row['name_first'];
                $dataset[$rownum][5]['desc']  = "First name";
                $dataset[$rownum][6]['field']  = "birth_date";
                $dataset[$rownum][6]['val']  = $row['birth_date'];
                $dataset[$rownum][6]['desc']  = "birth_date";
                $dataset[$rownum][7]['field']  = "gender";
                $dataset[$rownum][7]['val']  = $row['gender'];
                $dataset[$rownum][7]['desc']  = "gender";
                $dataset[$rownum][8]['field']  = "date_started";
                $dataset[$rownum][8]['val']  = $row['date_started'];
                $dataset[$rownum][8]['desc']  = "date_started";
                $dataset[$rownum][9]['field']  = "package_code";
                $dataset[$rownum][9]['val']  = $row['package_code'];
                $dataset[$rownum][9]['desc']  = "package_code";
                $dataset[$rownum][10]['field']  = "package_name";
                $dataset[$rownum][10]['val']  = $row['package_name'];
                $dataset[$rownum][10]['desc']  = "package_name";
                $dataset[$rownum][11]['field']  = "clinic_shortname";
                $dataset[$rownum][11]['val']  = $row['clinic_shortname'];
                $dataset[$rownum][11]['desc']  = "clinic_shortname";
                $rownum++;            
            }
        }            
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
     } //end of function get_rpt_patient_lab_orders($expect='data',$rows=NULL,$param=NULL)


    //************************************************************************
    /**
     * Method to retrieve details of recent imaging orders.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_patient_imag_orders($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT iord.patient_id, iord.supplier_ref, iord.result_status, iord.remarks, 
                        name AS patient_name, pdem.name_first, birth_date, gender,
                        date_started,
                        ipro.product_code, ipro.description,
                        clin.clinic_shortname
                            ";
        $sqlQuery   .=  " FROM imaging_order iord";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON iord.patient_id = pdem.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary pcsm ON iord.session_id = pcsm.summary_id";
        $sqlQuery   .=  " JOIN imaging_product ipro ON iord.product_id = ipro.product_id";
        $sqlQuery   .=  " JOIN clinic_info clin ON pcsm.location_start=clin.clinic_info_id";
        $sqlQuery   .=  " WHERE 1=1";
        
        if(isset($param['period_from'])){
            $sqlQuery   .=  " AND date_started >= '".$param['period_from']."'";        
        }
        if(isset($param['period_to'])){
            $sqlQuery   .=  " AND date_started <= '".$param['period_to']."'";        
        }
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND location_start='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND iord.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "patient_id";
                $dataset[$rownum][0]['val']  = $row['patient_id'];
                $dataset[$rownum][0]['desc']  = "patient_id";
                $dataset[$rownum][1]['field']= "supplier_ref";
                $dataset[$rownum][1]['val']  = $row['supplier_ref'];
                $dataset[$rownum][1]['desc']= "supplier_ref";
                $dataset[$rownum][2]['field']= "result_status";
                $dataset[$rownum][2]['val']  = $row['result_status'];
                $dataset[$rownum][2]['desc']= "result_status";
                $dataset[$rownum][3]['field']= "remarks";
                $dataset[$rownum][3]['val']  = $row['remarks'];
                $dataset[$rownum][3]['desc']= "remarks";
                $dataset[$rownum][4]['field'] = "patient_name";
                $dataset[$rownum][4]['val'] = $row['patient_name'];
                $dataset[$rownum][4]['desc'] = "patient_name";
                $dataset[$rownum][5]['field']  = "name_first";
                $dataset[$rownum][5]['val']  = $row['name_first'];
                $dataset[$rownum][5]['desc']  = "First name";
                $dataset[$rownum][6]['field']  = "birth_date";
                $dataset[$rownum][6]['val']  = $row['birth_date'];
                $dataset[$rownum][6]['desc']  = "birth_date";
                $dataset[$rownum][7]['field']  = "gender";
                $dataset[$rownum][7]['val']  = $row['gender'];
                $dataset[$rownum][7]['desc']  = "gender";
                $dataset[$rownum][8]['field']  = "date_started";
                $dataset[$rownum][8]['val']  = $row['date_started'];
                $dataset[$rownum][8]['desc']  = "date_started";
                $dataset[$rownum][9]['field']  = "product_code";
                $dataset[$rownum][9]['val']  = $row['product_code'];
                $dataset[$rownum][9]['desc']  = "product_code";
                $dataset[$rownum][10]['field']  = "description";
                $dataset[$rownum][10]['val']  = $row['description'];
                $dataset[$rownum][10]['desc']  = "description";
                $dataset[$rownum][11]['field']  = "clinic_shortname";
                $dataset[$rownum][11]['val']  = $row['clinic_shortname'];
                $dataset[$rownum][11]['desc']  = "clinic_shortname";
                $rownum++;            
            }
        }            
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
     } //end of function get_rpt_patient_imag_orders($expect='data',$rows=NULL,$param=NULL)


    //************************************************************************
    /**
     * Method to retrieve details of recent biosurveillance cases.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_bio_closed($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pcon.summary_id, session_ref, session_sequence, external_ref, pcon.patient_id, staff_id, 
                        date_started, time_started, date_ended,time_ended,signed_by,location_start,location_end,
                        summary, pcon.status,
                        pdem.clinic_reference_number, pdem.name, pdem.name_first, pdem.gender, pdem.birth_date,
                        clin.clinic_shortname
                            ";
        $sqlQuery   .=  " FROM patient_consultation_summary pcon";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON pcon.patient_id = pdem.patient_id";
        $sqlQuery   .=  " JOIN clinic_info clin ON pcon.location_start=clin.clinic_info_id";
        //$sqlQuery   .=  " JOIN drug_formulary ON patient_medication.drug_formulary_id = drug_formulary.drug_formulary_id";
        
        $sqlQuery   .=  " WHERE 1=1";
        if(isset($param['period_from'])){
            $sqlQuery   .=  " AND date_started >= '".$param['period_from']."'";        
        }
        if(isset($param['period_to'])){
            $sqlQuery   .=  " AND date_started <= '".$param['period_to']."'";        
        }
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND location_start='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND pcon.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "summary_id";
                $dataset[$rownum][0]['val']  = $row['summary_id'];
                $dataset[$rownum][0]['desc']  = "summary_id";
                $dataset[$rownum][1]['field']= "session_ref";
                $dataset[$rownum][1]['val']  = $row['session_ref'];
                $dataset[$rownum][1]['desc']= "session_ref";
                $dataset[$rownum][2]['field']= "session_sequence";
                $dataset[$rownum][2]['val']  = $row['session_sequence'];
                $dataset[$rownum][2]['desc']= "session_sequence";
                $dataset[$rownum][3]['field']= "external_ref";
                $dataset[$rownum][3]['val']  = $row['external_ref'];
                $dataset[$rownum][3]['desc']= "external_ref";
                $dataset[$rownum][4]['field'] = "patient_id";
                $dataset[$rownum][4]['val'] = $row['patient_id'];
                $dataset[$rownum][4]['desc'] = "patient_id";
                $dataset[$rownum][5]['field']  = "staff_id";
                $dataset[$rownum][5]['val']  = $row['staff_id'];
                $dataset[$rownum][5]['desc']  = "staff_id";
                $dataset[$rownum][6]['field']  = "date_started";
                $dataset[$rownum][6]['val']  = $row['date_started'];
                $dataset[$rownum][6]['desc']  = "date_started";
                $dataset[$rownum][7]['field']  = "time_started";
                $dataset[$rownum][7]['val']  = $row['time_started'];
                $dataset[$rownum][7]['desc']  = "time_started";
                $dataset[$rownum][8]['field']  = "date_ended";
                $dataset[$rownum][8]['val']  = $row['date_ended'];
                $dataset[$rownum][8]['desc']  = "date_ended";
                $dataset[$rownum][9]['field']  = "time_ended";
                $dataset[$rownum][9]['val']  = $row['time_ended'];
                $dataset[$rownum][9]['desc']  = "time_ended";
                $dataset[$rownum][10]['field']  = "signed_by";
                $dataset[$rownum][10]['val']  = $row['signed_by'];
                $dataset[$rownum][10]['desc']  = "signed_by";
                $dataset[$rownum][11]['field']  = "location_start";
                $dataset[$rownum][11]['val']  = $row['location_start'];
                $dataset[$rownum][11]['desc']  = "location_start";
                $dataset[$rownum][12]['field']  = "location_end";
                $dataset[$rownum][12]['val']  = $row['location_end'];
                $dataset[$rownum][12]['desc']  = "location_end";
                $dataset[$rownum][13]['field']  = "summary";
                $dataset[$rownum][13]['val']  = $row['summary'];
                $dataset[$rownum][13]['desc']  = "summary";
                $dataset[$rownum][14]['field']  = "status";
                $dataset[$rownum][14]['val']  = $row['status'];
                $dataset[$rownum][14]['desc']  = "status";
                $dataset[$rownum][15]['field']  = "clinic_reference_number";
                $dataset[$rownum][15]['val']  = $row['clinic_reference_number'];
                $dataset[$rownum][15]['desc']  = "clinic_reference_number";
                $dataset[$rownum][16]['field']  = "patient_name";
                $dataset[$rownum][16]['val']  = $row['name'];
                $dataset[$rownum][16]['desc']  = "Patient name";
                $dataset[$rownum][17]['field']  = "name_first";
                $dataset[$rownum][17]['val']  = $row['name_first'];
                $dataset[$rownum][17]['desc']  = "name_first";
                $dataset[$rownum][18]['field']  = "gender";
                $dataset[$rownum][18]['val']  = $row['gender'];
                $dataset[$rownum][18]['desc']  = "gender";
                $dataset[$rownum][19]['field']  = "birth_date";
                $dataset[$rownum][19]['val']  = $row['birth_date'];
                $dataset[$rownum][19]['desc']  = "birth_date";
                $dataset[$rownum][20]['field']  = "clinic_shortname";
                $dataset[$rownum][20]['val']  = $row['clinic_shortname'];
                $dataset[$rownum][20]['desc']  = "clinic_shortname";
                $rownum++;            
            }
        }            
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
     } //end of function get_rpt_bio_closed($patient_id)


    //************************************************************************
    /**
     * Method to retrieve details of recent clinical consultations.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_consult_antenatal($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pcon.summary_id, session_ref, session_sequence, external_ref, pcon.patient_id, staff_id, 
                        date_started, time_started, date_ended,time_ended,signed_by,location_start,location_end,
                        summary, pcon.status,
                        pdem.clinic_reference_number, pdem.name, pdem.name_first, pdem.gender, pdem.birth_date,
                        clin.clinic_shortname,
                        pant.antenatal_id,
                        acur.midwife_name, acur.pregnancy_duration, acur.lmp, acur.lmp_edd, acur.planned_place
                            ";
        $sqlQuery   .=  " FROM patient_consultation_summary pcon";
        $sqlQuery   .=  " JOIN patient_antenatal pant ON pcon.summary_id = pant.session_id";
        $sqlQuery   .=  " JOIN patient_antenatal_current acur ON pant.antenatal_id = acur.antenatal_id";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON pcon.patient_id = pdem.patient_id";
        $sqlQuery   .=  " JOIN clinic_info clin ON pcon.location_start=clin.clinic_info_id";
        //$sqlQuery   .=  " JOIN drug_formulary ON patient_medication.drug_formulary_id = drug_formulary.drug_formulary_id";
        
        $sqlQuery   .=  " WHERE 1=1";
        if(isset($param['period_from'])){
            $sqlQuery   .=  " AND date_started >= '".$param['period_from']."'";        
        }
        if(isset($param['period_to'])){
            $sqlQuery   .=  " AND date_started <= '".$param['period_to']."'";        
        }
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND location_start='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND pcon.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "summary_id";
                $dataset[$rownum][0]['val']  = $row['summary_id'];
                $dataset[$rownum][0]['desc']  = "summary_id";
                $dataset[$rownum][1]['field']= "session_ref";
                $dataset[$rownum][1]['val']  = $row['session_ref'];
                $dataset[$rownum][1]['desc']= "session_ref";
                $dataset[$rownum][2]['field']= "session_sequence";
                $dataset[$rownum][2]['val']  = $row['session_sequence'];
                $dataset[$rownum][2]['desc']= "session_sequence";
                $dataset[$rownum][3]['field']= "external_ref";
                $dataset[$rownum][3]['val']  = $row['external_ref'];
                $dataset[$rownum][3]['desc']= "external_ref";
                $dataset[$rownum][4]['field'] = "patient_id";
                $dataset[$rownum][4]['val'] = $row['patient_id'];
                $dataset[$rownum][4]['desc'] = "patient_id";
                $dataset[$rownum][5]['field']  = "staff_id";
                $dataset[$rownum][5]['val']  = $row['staff_id'];
                $dataset[$rownum][5]['desc']  = "staff_id";
                $dataset[$rownum][6]['field']  = "date_started";
                $dataset[$rownum][6]['val']  = $row['date_started'];
                $dataset[$rownum][6]['desc']  = "date_started";
                $dataset[$rownum][7]['field']  = "time_started";
                $dataset[$rownum][7]['val']  = $row['time_started'];
                $dataset[$rownum][7]['desc']  = "time_started";
                $dataset[$rownum][8]['field']  = "date_ended";
                $dataset[$rownum][8]['val']  = $row['date_ended'];
                $dataset[$rownum][8]['desc']  = "date_ended";
                $dataset[$rownum][9]['field']  = "time_ended";
                $dataset[$rownum][9]['val']  = $row['time_ended'];
                $dataset[$rownum][9]['desc']  = "time_ended";
                $dataset[$rownum][10]['field']  = "signed_by";
                $dataset[$rownum][10]['val']  = $row['signed_by'];
                $dataset[$rownum][10]['desc']  = "signed_by";
                $dataset[$rownum][11]['field']  = "location_start";
                $dataset[$rownum][11]['val']  = $row['location_start'];
                $dataset[$rownum][11]['desc']  = "location_start";
                $dataset[$rownum][12]['field']  = "location_end";
                $dataset[$rownum][12]['val']  = $row['location_end'];
                $dataset[$rownum][12]['desc']  = "location_end";
                $dataset[$rownum][13]['field']  = "summary";
                $dataset[$rownum][13]['val']  = $row['summary'];
                $dataset[$rownum][13]['desc']  = "summary";
                $dataset[$rownum][14]['field']  = "status";
                $dataset[$rownum][14]['val']  = $row['status'];
                $dataset[$rownum][14]['desc']  = "status";
                $dataset[$rownum][15]['field']  = "clinic_reference_number";
                $dataset[$rownum][15]['val']  = $row['clinic_reference_number'];
                $dataset[$rownum][15]['desc']  = "clinic_reference_number";
                $dataset[$rownum][16]['field']  = "patient_name";
                $dataset[$rownum][16]['val']  = $row['name'];
                $dataset[$rownum][16]['desc']  = "Patient name";
                $dataset[$rownum][17]['field']  = "name_first";
                $dataset[$rownum][17]['val']  = $row['name_first'];
                $dataset[$rownum][17]['desc']  = "name_first";
                $dataset[$rownum][18]['field']  = "gender";
                $dataset[$rownum][18]['val']  = $row['gender'];
                $dataset[$rownum][18]['desc']  = "gender";
                $dataset[$rownum][19]['field']  = "birth_date";
                $dataset[$rownum][19]['val']  = $row['birth_date'];
                $dataset[$rownum][19]['desc']  = "birth_date";
                $dataset[$rownum][20]['field']  = "clinic_shortname";
                $dataset[$rownum][20]['val']  = $row['clinic_shortname'];
                $dataset[$rownum][20]['desc']  = "clinic_shortname";
                $dataset[$rownum][21]['field']  = "antenatal_id";
                $dataset[$rownum][21]['val']  = $row['antenatal_id'];
                $dataset[$rownum][21]['desc']  = "antenatal_id";
                $dataset[$rownum][22]['field']  = "midwife_name";
                $dataset[$rownum][22]['val']  = $row['midwife_name'];
                $dataset[$rownum][22]['desc']  = "Midwife's name";
                $dataset[$rownum][23]['field']  = "pregnancy_duration";
                $dataset[$rownum][23]['val']  = $row['pregnancy_duration'];
                $dataset[$rownum][23]['desc']  = "pregnancy_duration";
                $dataset[$rownum][24]['field']  = "lmp";
                $dataset[$rownum][24]['val']  = $row['lmp'];
                $dataset[$rownum][24]['desc']  = "Last Menstrual Period";
                $dataset[$rownum][25]['field']  = "lmp_edd";
                $dataset[$rownum][25]['val']  = $row['lmp_edd'];
                $dataset[$rownum][25]['desc']  = "Expected Date of Delivery based on LMP";
                $dataset[$rownum][26]['field']  = "planned_place";
                $dataset[$rownum][26]['val']  = $row['planned_place'];
                $dataset[$rownum][26]['desc']  = "Planned place of delivery";
                $rownum++;            
            }
        }            
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
     } //end of function get_rpt_antenatal_list($patient_id)


    //************************************************************************
    /**
     * Method to retrieve details of recent clinical consultations.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_antenatal_list($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pdem.patient_id, pdem.clinic_reference_number, pdem.name, pdem.name_first, pdem.gender, pdem.birth_date,
                        pdem.clinic_home,
                        clin.clinic_shortname,
                        pant.antenatal_id,
                        acur.midwife_name, acur.pregnancy_duration, acur.lmp, acur.lmp_edd, acur.planned_place,
                        ainf.gravida, ainf.para, ainf.method_contraception, ainf.abortion, ainf.num_term_deliveries, 
                        ainf.num_preterm_deliveries, ainf.num_preg_lessthan_21wk, ainf.num_live_births, ainf.num_caesarean_births,
                        ainf.num_miscarriages, ainf.three_consec_miscarriages, ainf.num_stillbirths, ainf.post_partum_depression,
                        ainf.present_pulmonary_tb, ainf.present_heart_disease, ainf.present_diabetes, ainf.present_bronchial_asthma, 
                        ainf.present_goiter, ainf.present_hepatitis_b, ainf.antenatal_remarks, ainf.contact_person,
                        pdel.date_delivery, pdel.time_delivery, pdel.delivery_type, pdel.delivery_place, pdel.mother_condition, 
                        pdel.baby_condition, pdel.baby_weight, pdel.complication_notes, pdel.baby_alive, pdel.birth_attendant,
                        pdel.breastfeed_immediate, pdel.post_partum_bleed, pdel.delivery_remarks, pdel.delivery_outcome
                            ";
        $sqlQuery   .=  " FROM patient_demographic_info pdem";
        $sqlQuery   .=  " JOIN patient_antenatal pant ON pdem.patient_id = pant.patient_id";
        $sqlQuery   .=  " JOIN patient_antenatal_current acur ON pant.antenatal_id = acur.antenatal_id";
        $sqlQuery   .=  " JOIN patient_antenatal_info ainf ON pant.antenatal_id = ainf.antenatal_id";
        $sqlQuery   .=  " LEFT OUTER JOIN patient_antenatal_delivery pdel ON pant.antenatal_id=pdel.antenatal_id";
        $sqlQuery   .=  " JOIN clinic_info clin ON pdem.clinic_home=clin.clinic_info_id";
        //$sqlQuery   .=  " JOIN drug_formulary ON patient_medication.drug_formulary_id = drug_formulary.drug_formulary_id";
        
        $sqlQuery   .=  " WHERE 1=1";
        /*
        if(isset($param['period_from'])){
            $sqlQuery   .=  " AND lmp_edd >= '".$param['period_from']."'";        
        }
        if(isset($param['period_to'])){
            $sqlQuery   .=  " AND lmp_edd <= '".$param['period_to']."'";        
        }
        */
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND clinic_home='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND pdem.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field'] = "patient_id";
                $dataset[$rownum][0]['val'] = $row['patient_id'];
                $dataset[$rownum][0]['desc'] = "patient_id";
                $dataset[$rownum][1]['field']  = "clinic_home";
                $dataset[$rownum][1]['val']  = $row['clinic_home'];
                $dataset[$rownum][1]['desc']  = "clinic_home";
                $dataset[$rownum][2]['field']  = "clinic_reference_number";
                $dataset[$rownum][2]['val']  = $row['clinic_reference_number'];
                $dataset[$rownum][2]['desc']  = "clinic_reference_number";
                $dataset[$rownum][3]['field']  = "patient_name";
                $dataset[$rownum][3]['val']  = $row['name'];
                $dataset[$rownum][3]['desc']  = "Patient name";
                $dataset[$rownum][4]['field']  = "name_first";
                $dataset[$rownum][4]['val']  = $row['name_first'];
                $dataset[$rownum][4]['desc']  = "name_first";
                $dataset[$rownum][5]['field']  = "gender";
                $dataset[$rownum][5]['val']  = $row['gender'];
                $dataset[$rownum][5]['desc']  = "gender";
                $dataset[$rownum][6]['field']  = "birth_date";
                $dataset[$rownum][6]['val']  = $row['birth_date'];
                $dataset[$rownum][6]['desc']  = "birth_date";
                $dataset[$rownum][7]['field']  = "clinic_shortname";
                $dataset[$rownum][7]['val']  = $row['clinic_shortname'];
                $dataset[$rownum][7]['desc']  = "clinic_shortname";
                $dataset[$rownum][8]['field']  = "antenatal_id";
                $dataset[$rownum][8]['val']  = $row['antenatal_id'];
                $dataset[$rownum][8]['desc']  = "antenatal_id";
                $dataset[$rownum][9]['field']  = "midwife_name";
                $dataset[$rownum][9]['val']  = $row['midwife_name'];
                $dataset[$rownum][9]['desc']  = "Midwife's name";
                $dataset[$rownum][10]['field']  = "pregnancy_duration";
                $dataset[$rownum][10]['val']  = $row['pregnancy_duration'];
                $dataset[$rownum][10]['desc']  = "pregnancy_duration";
                $dataset[$rownum][11]['field']  = "lmp";
                $dataset[$rownum][11]['val']  = $row['lmp'];
                $dataset[$rownum][11]['desc']  = "Last Menstrual Period";
                $dataset[$rownum][12]['field']  = "lmp_edd";
                $dataset[$rownum][12]['val']  = $row['lmp_edd'];
                $dataset[$rownum][12]['desc']  = "Expected Date of Delivery based on LMP";
                $dataset[$rownum][13]['field']  = "planned_place";
                $dataset[$rownum][13]['val']  = $row['planned_place'];
                $dataset[$rownum][13]['desc']  = "Planned place of delivery";
                $dataset[$rownum][14]['field']  = "gravida";
                $dataset[$rownum][14]['val']  = $row['gravida'];
                $dataset[$rownum][14]['desc']  = "gravida";
                $dataset[$rownum][15]['field']  = "para";
                $dataset[$rownum][15]['val']  = $row['para'];
                $dataset[$rownum][15]['desc']  = "para";
                $dataset[$rownum][16]['field']  = "method_contraception";
                $dataset[$rownum][16]['val']  = $row['method_contraception'];
                $dataset[$rownum][16]['desc']  = "method_contraception";
                $dataset[$rownum][17]['field']  = "abortion";
                $dataset[$rownum][17]['val']  = $row['abortion'];
                $dataset[$rownum][17]['desc']  = "abortion";
                $dataset[$rownum][18]['field']  = "num_term_deliveries";
                $dataset[$rownum][18]['val']  = $row['num_term_deliveries'];
                $dataset[$rownum][18]['desc']  = "num_term_deliveries";
                $dataset[$rownum][19]['field']  = "num_preterm_deliveries";
                $dataset[$rownum][19]['val']  = $row['num_preterm_deliveries'];
                $dataset[$rownum][19]['desc']  = "num_preterm_deliveries";
                $dataset[$rownum][20]['field']  = "num_preg_lessthan_21wk";
                $dataset[$rownum][20]['val']  = $row['num_preg_lessthan_21wk'];
                $dataset[$rownum][20]['desc']  = "num_preg_lessthan_21wk";
                $dataset[$rownum][21]['field']  = "num_live_births";
                $dataset[$rownum][21]['val']  = $row['num_live_births'];
                $dataset[$rownum][21]['desc']  = "num_live_births";
                $dataset[$rownum][22]['field']  = "num_caesarean_births";
                $dataset[$rownum][22]['val']  = $row['num_caesarean_births'];
                $dataset[$rownum][22]['desc']  = "num_caesarean_births";
                $dataset[$rownum][23]['field']  = "num_miscarriages";
                $dataset[$rownum][23]['val']  = $row['num_miscarriages'];
                $dataset[$rownum][23]['desc']  = "num_miscarriages";
                $dataset[$rownum][24]['field']  = "three_consec_miscarriages";
                $dataset[$rownum][24]['val']  = $row['three_consec_miscarriages'];
                $dataset[$rownum][24]['desc']  = "three_consec_miscarriages";
                $dataset[$rownum][25]['field']  = "num_stillbirths";
                $dataset[$rownum][25]['val']  = $row['num_stillbirths'];
                $dataset[$rownum][25]['desc']  = "num_stillbirths";
                $dataset[$rownum][26]['field']  = "post_partum_depression";
                $dataset[$rownum][26]['val']  = $row['post_partum_depression'];
                $dataset[$rownum][26]['desc']  = "post_partum_depression";
                $dataset[$rownum][27]['field']  = "present_pulmonary_tb";
                $dataset[$rownum][27]['val']  = $row['present_pulmonary_tb'];
                $dataset[$rownum][27]['desc']  = "present_pulmonary_tb";
                $dataset[$rownum][28]['field']  = "present_heart_disease";
                $dataset[$rownum][28]['val']  = $row['present_heart_disease'];
                $dataset[$rownum][28]['desc']  = "present_heart_disease";
                $dataset[$rownum][29]['field']  = "present_diabetes";
                $dataset[$rownum][29]['val']  = $row['present_diabetes'];
                $dataset[$rownum][29]['desc']  = "present_diabetes";
                $dataset[$rownum][30]['field']  = "present_bronchial_asthma";
                $dataset[$rownum][30]['val']  = $row['present_bronchial_asthma'];
                $dataset[$rownum][30]['desc']  = "present_bronchial_asthma";
                $dataset[$rownum][31]['field']  = "present_goiter";
                $dataset[$rownum][31]['val']  = $row['present_goiter'];
                $dataset[$rownum][31]['desc']  = "present_goiter";
                $dataset[$rownum][32]['field']  = "present_hepatitis_b";
                $dataset[$rownum][32]['val']  = $row['present_hepatitis_b'];
                $dataset[$rownum][32]['desc']  = "present_hepatitis_b";
                $dataset[$rownum][33]['field']  = "antenatal_remarks";
                $dataset[$rownum][33]['val']  = $row['antenatal_remarks'];
                $dataset[$rownum][33]['desc']  = "antenatal_remarks";
                $dataset[$rownum][34]['field']  = "contact_person";
                $dataset[$rownum][34]['val']  = $row['contact_person'];
                $dataset[$rownum][34]['desc']  = "contact_person";
                $dataset[$rownum][35]['field']  = "date_delivery";
                $dataset[$rownum][35]['val']  = $row['date_delivery'];
                $dataset[$rownum][35]['desc']  = "date_delivery";
                $dataset[$rownum][36]['field']  = "time_delivery";
                $dataset[$rownum][36]['val']  = $row['time_delivery'];
                $dataset[$rownum][36]['desc']  = "time_delivery";
                $dataset[$rownum][37]['field']  = "delivery_type";
                $dataset[$rownum][37]['val']  = $row['delivery_type'];
                $dataset[$rownum][37]['desc']  = "delivery_type";
                $dataset[$rownum][38]['field']  = "delivery_place";
                $dataset[$rownum][38]['val']  = $row['delivery_place'];
                $dataset[$rownum][38]['desc']  = "delivery_place";
                $dataset[$rownum][39]['field']  = "mother_condition";
                $dataset[$rownum][39]['val']  = $row['mother_condition'];
                $dataset[$rownum][39]['desc']  = "mother_condition";
                $dataset[$rownum][40]['field']  = "baby_condition";
                $dataset[$rownum][40]['val']  = $row['baby_condition'];
                $dataset[$rownum][40]['desc']  = "baby_condition";
                $dataset[$rownum][41]['field']  = "baby_weight";
                $dataset[$rownum][41]['val']  = $row['baby_weight'];
                $dataset[$rownum][41]['desc']  = "baby_weight";
                $dataset[$rownum][42]['field']  = "complication_notes";
                $dataset[$rownum][42]['val']  = $row['complication_notes'];
                $dataset[$rownum][42]['desc']  = "complication_notes";
                $dataset[$rownum][43]['field']  = "baby_alive";
                $dataset[$rownum][43]['val']  = $row['baby_alive'];
                $dataset[$rownum][43]['desc']  = "baby_alive";
                $dataset[$rownum][44]['field']  = "birth_attendant";
                $dataset[$rownum][44]['val']  = $row['birth_attendant'];
                $dataset[$rownum][44]['desc']  = "birth_attendant";
                $dataset[$rownum][45]['field']  = "breastfeed_immediate";
                $dataset[$rownum][45]['val']  = $row['breastfeed_immediate'];
                $dataset[$rownum][45]['desc']  = "breastfeed_immediate";
                $dataset[$rownum][46]['field']  = "post_partum_bleed";
                $dataset[$rownum][46]['val']  = $row['post_partum_bleed'];
                $dataset[$rownum][46]['desc']  = "post_partum_bleed";
                $dataset[$rownum][47]['field']  = "delivery_remarks";
                $dataset[$rownum][47]['val']  = $row['delivery_remarks'];
                $dataset[$rownum][47]['desc']  = "delivery_remarks";
                $dataset[$rownum][48]['field']  = "delivery_outcome";
                $dataset[$rownum][48]['val']  = $row['delivery_outcome'];
                $dataset[$rownum][48]['desc']  = "delivery_outcome";
                $rownum++;            
            }
        }            
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
     } //end of function get_rpt_antenatal_list($patient_id)


    //************************************************************************
    /**
     * Method to retrieve details of recent patient_complaints.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_prescript_queue($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT preq.patient_id, preq.indication, preq.dose, preq.dose_form, preq.frequency, preq.quantity,
                        name AS patient_name, pdem.name_first, birth_date, gender,
                        date_started,
                        dfor.generic_name, dfor.formulary_system,
                        clin.clinic_shortname
                            ";
        $sqlQuery   .=  " FROM prescript_queue preq";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON preq.patient_id = pdem.patient_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary pcsm ON preq.session_id = pcsm.summary_id";
        $sqlQuery   .=  " JOIN drug_formulary dfor ON preq.drug_formulary_id = dfor.drug_formulary_id";
        $sqlQuery   .=  " JOIN clinic_info clin ON pcsm.location_start=clin.clinic_info_id";
        $sqlQuery   .=  " WHERE 1=1";
        
        if(isset($param['period_from'])){
            $sqlQuery   .=  " AND date_started >= '".$param['period_from']."'";        
        }
        if(isset($param['period_to'])){
            $sqlQuery   .=  " AND date_started <= '".$param['period_to']."'";        
        }
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND location_start='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND preq.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "patient_id";
                $dataset[$rownum][0]['val']  = $row['patient_id'];
                $dataset[$rownum][0]['desc']  = "patient_id";
                $dataset[$rownum][1]['field']= "indication";
                $dataset[$rownum][1]['val']  = $row['indication'];
                $dataset[$rownum][1]['desc']= "indication";
                $dataset[$rownum][2]['field']= "dose";
                $dataset[$rownum][2]['val']  = $row['dose'];
                $dataset[$rownum][2]['desc']= "dose";
                $dataset[$rownum][3]['field']= "dose_form";
                $dataset[$rownum][3]['val']  = $row['dose_form'];
                $dataset[$rownum][3]['desc']= "dose_form";
                $dataset[$rownum][4]['field']= "frequency";
                $dataset[$rownum][4]['val']  = $row['frequency'];
                $dataset[$rownum][4]['desc']= "frequency";
                $dataset[$rownum][5]['field']= "quantity";
                $dataset[$rownum][5]['val']  = $row['quantity'];
                $dataset[$rownum][5]['desc']= "quantity";
                $dataset[$rownum][6]['field'] = "patient_name";
                $dataset[$rownum][6]['val'] = $row['patient_name'];
                $dataset[$rownum][6]['desc'] = "patient_name";
                $dataset[$rownum][7]['field']  = "name_first";
                $dataset[$rownum][7]['val']  = $row['name_first'];
                $dataset[$rownum][7]['desc']  = "First name";
                $dataset[$rownum][8]['field']  = "birth_date";
                $dataset[$rownum][8]['val']  = $row['birth_date'];
                $dataset[$rownum][8]['desc']  = "birth_date";
                $dataset[$rownum][9]['field']  = "gender";
                $dataset[$rownum][9]['val']  = $row['gender'];
                $dataset[$rownum][9]['desc']  = "gender";
                $dataset[$rownum][10]['field']  = "date_started";
                $dataset[$rownum][10]['val']  = $row['date_started'];
                $dataset[$rownum][10]['desc']  = "date_started";
                $dataset[$rownum][11]['field']  = "generic_name";
                $dataset[$rownum][11]['val']  = $row['generic_name'];
                $dataset[$rownum][11]['desc']  = "generic_name";
                $dataset[$rownum][12]['field']  = "formulary_system";
                $dataset[$rownum][12]['val']  = $row['formulary_system'];
                $dataset[$rownum][12]['desc']  = "formulary_system";
                $dataset[$rownum][13]['field']  = "clinic_shortname";
                $dataset[$rownum][13]['val']  = $row['clinic_shortname'];
                $dataset[$rownum][13]['desc']  = "clinic_shortname";
                $rownum++;            
            }
        }            
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
     } //end of function get_rpt_prescript_queue($expect='data',$rows=NULL,$param=NULL)


    //************************************************************************
    /**
     * Method to retrieve details of get_rpt_immunisation_done.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_immunisation_done($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pdem.patient_id, clinic_reference_number, pns_pat_id, nhfa_no, name, name_first, gender, 
                        ic_no, ic_other_no, nationality, birth_date, ethnicity, religion, marital_status, pdem.remarks as pdem_remarks,";
        $sqlQuery   .=  " pctc.state AS con_state, pctc.country AS con_country, pctc.tel_home, pctc.tel_mobile, ";
        $sqlQuery   .=  " pimm.date as vaccined_date,";
        $sqlQuery   .=  " immu.vaccine, immu.dose, immu.immunisation_sort,";
        $sqlQuery   .=  " cinf.clinic_name,";
        $sqlQuery   .=  " avil.addr_village_name,";
        $sqlQuery   .=  " atow.addr_town_name";
        $sqlQuery   .=  " FROM patient_demographic_info pdem";
        $sqlQuery   .=  " JOIN clinic_info cinf ON pdem.clinic_home = cinf.clinic_info_id";
        $sqlQuery   .=  " JOIN patient_contact_info pctc ON pdem.contact_id = pctc.contact_id";
        $sqlQuery   .=  " JOIN patient_immunisation pimm ON pdem.patient_id = pimm.patient_id";
        $sqlQuery   .=  " JOIN immunisation immu ON pimm.immunisation_id = immu.immunisation_id";
        $sqlQuery   .=  " LEFT OUTER JOIN addr_village avil ON pctc.addr_village_id = avil.addr_village_id";
        $sqlQuery   .=  " LEFT OUTER JOIN addr_town atow ON pctc.addr_town_id = atow.addr_town_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND vaccine<>''";        
        
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND pdem.clinic_home='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND pdem.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name, pdem.name_first";
        }
        $sqlQuery   .=  ", immunisation_sort";

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "patient_id";
                $dataset[$rownum][0]['val']  = $row['patient_id'];
                $dataset[$rownum][0]['desc']  = "System identification number";
                $dataset[$rownum][1]['field']  = "clinic_reference_number";
                $dataset[$rownum][1]['val']  = $row['clinic_reference_number'];
                $dataset[$rownum][1]['desc']  = "Clinic Reference Number";
                $dataset[$rownum][2]['field']  = "pns_pat_id";
                $dataset[$rownum][2]['val']  = $row['pns_pat_id'];
                $dataset[$rownum][2]['desc']  = "pns_pat_id";
                $dataset[$rownum][3]['field']  = "nhfa_no";
                $dataset[$rownum][3]['val']  = $row['nhfa_no'];
                $dataset[$rownum][3]['desc']  = "nhfa_no";
                $dataset[$rownum][4]['field']  = "name";
                $dataset[$rownum][4]['val']  = $row['name'];
                $dataset[$rownum][4]['desc']  = "Name";
                $dataset[$rownum][5]['field']  = "name_first";
                $dataset[$rownum][5]['val']  = $row['name_first'];
                $dataset[$rownum][5]['desc']  = "First name (optional)";
                $dataset[$rownum][6]['field']  = "gender";
                $dataset[$rownum][6]['val']  = $row['gender'];
                $dataset[$rownum][6]['desc']  = "Gender";
                $dataset[$rownum][7]['field']  = "ic_no";
                $dataset[$rownum][7]['val']  = $row['ic_no'];
                $dataset[$rownum][7]['desc']  = "National ID No.";
                $dataset[$rownum][8]['field']  = "ic_other_no";
                $dataset[$rownum][8]['val']  = $row['ic_other_no'];
                $dataset[$rownum][8]['desc']  = "Other IC No.";
                $dataset[$rownum][9]['field']  = "nationality";
                $dataset[$rownum][9]['val']  = $row['nationality'];
                $dataset[$rownum][9]['desc']  = "Nationality";
                $dataset[$rownum][10]['field']  = "birth_date";
                $dataset[$rownum][10]['val']  = $row['birth_date'];
                $dataset[$rownum][10]['desc']  = "Date of Birth";
                $dataset[$rownum][11]['field']  = "ethnicity";
                $dataset[$rownum][11]['val']  = $row['ethnicity'];
                $dataset[$rownum][11]['desc']  = "Ethnicity/Race";
                $dataset[$rownum][12]['field']  = "religion";
                $dataset[$rownum][12]['val']  = $row['religion'];
                $dataset[$rownum][12]['desc']  = "Religion";
                $dataset[$rownum][13]['field']  = "marital_status";
                $dataset[$rownum][13]['val']  = $row['marital_status'];
                $dataset[$rownum][13]['desc']  = "marital_status";
                $dataset[$rownum][14]['field']  = "remarks";
                $dataset[$rownum][14]['val']  = $row['pdem_remarks'];
                $dataset[$rownum][14]['desc']  = "remarks";
                $dataset[$rownum][15]['field']  = "vaccined_date";
                $dataset[$rownum][15]['val']  = $row['vaccined_date'];
                $dataset[$rownum][15]['desc']  = "vaccined_date";
                $dataset[$rownum][16]['field']  = "vaccine";
                $dataset[$rownum][16]['val']  = $row['vaccine'];
                $dataset[$rownum][16]['desc']  = "vaccine";
                $dataset[$rownum][17]['field']  = "dose";
                $dataset[$rownum][17]['val']  = $row['dose'];
                $dataset[$rownum][17]['desc']  = "dose";
                $dataset[$rownum][18]['field']  = "";
                $dataset[$rownum][18]['val']  = $row[''];
                $dataset[$rownum][18]['desc']  = "";
                $dataset[$rownum][19]['field']  = "home_clinic";
                $dataset[$rownum][19]['val']  = $row['clinic_name'];
                $dataset[$rownum][19]['desc']  = "Home clinic";
                $dataset[$rownum][20]['field']  = "addr_village_name";
                $dataset[$rownum][20]['val']  = $row['addr_village_name'];
                $dataset[$rownum][20]['desc']  = "addr_village_name";
                $dataset[$rownum][21]['field']  = "addr_town_name";
                $dataset[$rownum][21]['val']  = $row['addr_town_name'];
                $dataset[$rownum][21]['desc']  = "addr_town_name";
                $rownum++;            
            }
        }    
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
        
    } //end of function get_rpt_immunisation_done($patient_id)


    //************************************************************************
    /**
     * Method to retrieve details of get_rpt_export_demo2sipps.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt_export_demo2sipps($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pdem.patient_id, clinic_reference_number, pns_pat_id, nhfa_no, name, name_first, gender, 
                        ic_no, ic_other_no, nationality, birth_date, ethnicity, religion, marital_status, pdem.remarks as pdem_remarks,";
        $sqlQuery   .=  " pctc.state AS con_state, pctc.country AS con_country, pctc.tel_home, pctc.tel_mobile, ";
        $sqlQuery   .=  " cinf.clinic_name,";
        $sqlQuery   .=  " avil.addr_village_name,";
        $sqlQuery   .=  " atow.addr_town_name";
        $sqlQuery   .=  " FROM patient_demographic_info pdem";
        $sqlQuery   .=  " JOIN clinic_info cinf ON pdem.clinic_home = cinf.clinic_info_id";
        $sqlQuery   .=  " JOIN patient_contact_info pctc ON pdem.contact_id = pctc.contact_id";
        $sqlQuery   .=  " LEFT OUTER JOIN addr_village avil ON pctc.addr_village_id = avil.addr_village_id";
        $sqlQuery   .=  " LEFT OUTER JOIN addr_town atow ON pctc.addr_town_id = atow.addr_town_id";
        $sqlQuery   .=  " WHERE 1=1";
        
        
        if($param['clinic_info_id'] <> "All"){
            $sqlQuery   .=  " AND pdem.clinic_home='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND pdem.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = "patient_id";
                $dataset[$rownum][0]['val']  = $row['patient_id'];
                $dataset[$rownum][0]['desc']  = "System identification number";
                $dataset[$rownum][1]['field']  = "clinic_reference_number";
                $dataset[$rownum][1]['val']  = $row['clinic_reference_number'];
                $dataset[$rownum][1]['desc']  = "Clinic Reference Number";
                $dataset[$rownum][2]['field']  = "pns_pat_id";
                $dataset[$rownum][2]['val']  = $row['pns_pat_id'];
                $dataset[$rownum][2]['desc']  = "pns_pat_id";
                $dataset[$rownum][3]['field']  = "nhfa_no";
                $dataset[$rownum][3]['val']  = $row['nhfa_no'];
                $dataset[$rownum][3]['desc']  = "nhfa_no";
                $dataset[$rownum][4]['field']  = "name";
                $dataset[$rownum][4]['val']  = $row['name'];
                $dataset[$rownum][4]['desc']  = "Name";
                $dataset[$rownum][5]['field']  = "name_first";
                $dataset[$rownum][5]['val']  = $row['name_first'];
                $dataset[$rownum][5]['desc']  = "First name (optional)";
                $dataset[$rownum][6]['field']  = "gender";
                $dataset[$rownum][6]['val']  = $row['gender'];
                $dataset[$rownum][6]['desc']  = "Gender";
                $dataset[$rownum][7]['field']  = "ic_no";
                $dataset[$rownum][7]['val']  = $row['ic_no'];
                $dataset[$rownum][7]['desc']  = "National ID No.";
                $dataset[$rownum][8]['field']  = "ic_other_no";
                $dataset[$rownum][8]['val']  = $row['ic_other_no'];
                $dataset[$rownum][8]['desc']  = "Other IC No.";
                $dataset[$rownum][9]['field']  = "nationality";
                $dataset[$rownum][9]['val']  = $row['nationality'];
                $dataset[$rownum][9]['desc']  = "Nationality";
                $dataset[$rownum][10]['field']  = "birth_date";
                $dataset[$rownum][10]['val']  = $row['birth_date'];
                $dataset[$rownum][10]['desc']  = "Date of Birth";
                $dataset[$rownum][11]['field']  = "ethnicity";
                $dataset[$rownum][11]['val']  = $row['ethnicity'];
                $dataset[$rownum][11]['desc']  = "Ethnicity/Race";
                $dataset[$rownum][12]['field']  = "religion";
                $dataset[$rownum][12]['val']  = $row['religion'];
                $dataset[$rownum][12]['desc']  = "Religion";
                $dataset[$rownum][13]['field']  = "marital_status";
                $dataset[$rownum][13]['val']  = $row['marital_status'];
                $dataset[$rownum][13]['desc']  = "marital_status";
                $dataset[$rownum][14]['field']  = "remarks";
                $dataset[$rownum][14]['val']  = $row['pdem_remarks'];
                $dataset[$rownum][14]['desc']  = "remarks";
                $dataset[$rownum][15]['field']  = "con_state";
                $dataset[$rownum][15]['val']  = $row['con_state'];
                $dataset[$rownum][15]['desc']  = "con_state";
                $dataset[$rownum][16]['field']  = "con_country";
                $dataset[$rownum][16]['val']  = $row['con_country'];
                $dataset[$rownum][16]['desc']  = "con_country";
                $dataset[$rownum][17]['field']  = "tel_home";
                $dataset[$rownum][17]['val']  = $row['tel_home'];
                $dataset[$rownum][17]['desc']  = "tel_home";
                $dataset[$rownum][18]['field']  = "tel_mobile";
                $dataset[$rownum][18]['val']  = $row['tel_mobile'];
                $dataset[$rownum][18]['desc']  = "tel_mobile";
                $dataset[$rownum][19]['field']  = "home_clinic";
                $dataset[$rownum][19]['val']  = $row['clinic_name'];
                $dataset[$rownum][19]['desc']  = "Home clinic";
                $dataset[$rownum][20]['field']  = "addr_village_name";
                $dataset[$rownum][20]['val']  = $row['addr_village_name'];
                $dataset[$rownum][20]['desc']  = "addr_village_name";
                $dataset[$rownum][21]['field']  = "addr_town_name";
                $dataset[$rownum][21]['val']  = $row['addr_town_name'];
                $dataset[$rownum][21]['desc']  = "addr_town_name";
                $rownum++;            
            }
        }    
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
        
    } //end of function get_rpt_export_demo2sipps($patient_id)


    //===============================================================
    // Insert Database Methods

    //************************************************************************
    /**
     * Method to insert New Report Header  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_report_header($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting report_header";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into report_header
        if(isset($data_array['report_header_id'])){$this->db->set('report_header_id', $data_array['report_header_id']);}
        if(isset($data_array['report_code'])){$this->db->set('report_code', $data_array['report_code']);}
        if(isset($data_array['report_name'])){$this->db->set('report_name', $data_array['report_name']);}
        if(isset($data_array['report_shortname'])){$this->db->set('report_shortname', $data_array['report_shortname']);}
        if(isset($data_array['report_title1'])){$this->db->set('report_title1', $data_array['report_title1']);}
        if(isset($data_array['report_title2'])){$this->db->set('report_title2', $data_array['report_title2']);}
        if(isset($data_array['report_descr'])){$this->db->set('report_descr', $data_array['report_descr']);}
        if(isset($data_array['report_source'])){$this->db->set('report_source', $data_array['report_source']);}
        if(isset($data_array['report_type'])){$this->db->set('report_type', $data_array['report_type']);}
        if(isset($data_array['report_section'])){$this->db->set('report_section', $data_array['report_section']);}
        if(isset($data_array['report_scope'])){$this->db->set('report_scope', $data_array['report_scope']);}
        if(isset($data_array['report_version'])){$this->db->set('report_version', $data_array['report_version']);}
        if(isset($data_array['report_latest'])){$this->db->set('report_latest', $data_array['report_latest']);}
        if(isset($data_array['report_paper_orient'])){$this->db->set('report_paper_orient', $data_array['report_paper_orient']);}
        if(isset($data_array['report_paper_size'])){$this->db->set('report_paper_size', $data_array['report_paper_size']);}
        if(isset($data_array['report_sort'])){$this->db->set('report_sort', $data_array['report_sort']);}
        if(isset($data_array['report_db_sort'])){$this->db->set('report_db_sort', $data_array['report_db_sort']);}
        if(isset($data_array['report_db_groupby'])){$this->db->set('report_db_groupby', $data_array['report_db_groupby']);}
        if(isset($data_array['report_db_having'])){$this->db->set('report_db_having', $data_array['report_db_having']);}
        if(isset($data_array['report_filter_sex'])){$this->db->set('report_filter_sex', $data_array['report_filter_sex']);}
        if(isset($data_array['report_filter_youngerthan'])){$this->db->set('report_filter_youngerthan', $data_array['report_filter_youngerthan']);}
        if(isset($data_array['report_filter_olderthan'])){$this->db->set('report_filter_olderthan', $data_array['report_filter_olderthan']);}
        if(isset($data_array['report_filter_1'])){$this->db->set('report_filter_1', $data_array['report_filter_1']);}
        if(isset($data_array['report_filter_2'])){$this->db->set('report_filter_2', $data_array['report_filter_2']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('report_header');
        //echo $this->db->last_query();
        //echo "<br />Inserted into report_header";

        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_report_header($data_array)


    //************************************************************************
    /**
     * Method to insert New Report Column  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required  
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_report_body($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting report_body";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into report_body
        if(isset($data_array['report_body_id'])){$this->db->set('report_body_id', $data_array['report_body_id']);}
        if(isset($data_array['report_header_id'])){$this->db->set('report_header_id', $data_array['report_header_id']);}
        if(isset($data_array['report_line'])){$this->db->set('report_line', $data_array['report_line']);}
        if(isset($data_array['col_fieldname'])){$this->db->set('col_fieldname', $data_array['col_fieldname']);}
        if(isset($data_array['col_security'])){$this->db->set('col_security', $data_array['col_security']);}
        if(isset($data_array['col_sort'])){$this->db->set('col_sort', $data_array['col_sort']);}
        if(isset($data_array['col_title1'])){$this->db->set('col_title1', $data_array['col_title1']);}
        if(isset($data_array['col_title2'])){$this->db->set('col_title2', $data_array['col_title2']);}
        if(isset($data_array['col_format'])){$this->db->set('col_format', $data_array['col_format']);}
        if(isset($data_array['col_transform'])){$this->db->set('col_transform', $data_array['col_transform']);}
        if(isset($data_array['col_widthmin'])){$this->db->set('col_widthmin', $data_array['col_widthmin']);}
        if(isset($data_array['col_widthmax'])){$this->db->set('col_widthmax', $data_array['col_widthmax']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('report_body');
        //echo $this->db->last_query();
        //echo "<br />Inserted into report_body";

        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_report_body($data_array)


    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update report template column
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_report_header($data_array)
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
        if(isset($data_array['report_code'])){$this->db->set('report_code', $data_array['report_code']);}
        if(isset($data_array['report_name'])){$this->db->set('report_name', $data_array['report_name']);}
        if(isset($data_array['report_shortname'])){$this->db->set('report_shortname', $data_array['report_shortname']);}
        if(isset($data_array['report_title1'])){$this->db->set('report_title1', $data_array['report_title1']);}
        if(isset($data_array['report_title2'])){$this->db->set('report_title2', $data_array['report_title2']);}
        if(isset($data_array['report_descr'])){$this->db->set('report_descr', $data_array['report_descr']);}
        if(isset($data_array['report_source'])){$this->db->set('report_source', $data_array['report_source']);}
        if(isset($data_array['report_type'])){$this->db->set('report_type', $data_array['report_type']);}
        if(isset($data_array['report_section'])){$this->db->set('report_section', $data_array['report_section']);}
        if(isset($data_array['report_scope'])){$this->db->set('report_scope', $data_array['report_scope']);}
        if(isset($data_array['report_version'])){$this->db->set('report_version', $data_array['report_version']);}
        if(isset($data_array['report_latest'])){$this->db->set('report_latest', $data_array['report_latest']);}
        if(isset($data_array['report_paper_orient'])){$this->db->set('report_paper_orient', $data_array['report_paper_orient']);}
        if(isset($data_array['report_paper_size'])){$this->db->set('report_paper_size', $data_array['report_paper_size']);}
        if(isset($data_array['report_sort'])){$this->db->set('report_sort', $data_array['report_sort']);}
        if(isset($data_array['report_db_sort'])){$this->db->set('report_db_sort', $data_array['report_db_sort']);}
        if(isset($data_array['report_db_groupby'])){$this->db->set('report_db_groupby', $data_array['report_db_groupby']);}
        if(isset($data_array['report_db_having'])){$this->db->set('report_db_having', $data_array['report_db_having']);}
        if(isset($data_array['report_filter_sex'])){$this->db->set('report_filter_sex', $data_array['report_filter_sex']);}
        if(isset($data_array['report_filter_youngerthan'])){$this->db->set('report_filter_youngerthan', $data_array['report_filter_youngerthan']);}
        if(isset($data_array['report_filter_olderthan'])){$this->db->set('report_filter_olderthan', $data_array['report_filter_olderthan']);}
        if(isset($data_array['report_filter_1'])){$this->db->set('report_filter_1', $data_array['report_filter_1']);}
        if(isset($data_array['report_filter_2'])){$this->db->set('report_filter_2', $data_array['report_filter_2']);}
        $this->db->where('report_header_id', (string)$data_array['report_header_id']);
        $this->db->update('report_header');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_report_header($data_array)


    //************************************************************************
    /**
     * Method to update report template column
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_report_body($data_array)
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
        if(isset($data_array['report_header_id'])){$this->db->set('report_header_id', $data_array['report_header_id']);}
        if(isset($data_array['report_line'])){$this->db->set('report_line', $data_array['report_line']);}
        if(isset($data_array['col_fieldname'])){$this->db->set('col_fieldname', $data_array['col_fieldname']);}
        if(isset($data_array['col_security'])){$this->db->set('col_security', $data_array['col_security']);}
        if(isset($data_array['col_sort'])){$this->db->set('col_sort', $data_array['col_sort']);}
        if(isset($data_array['col_title1'])){$this->db->set('col_title1', $data_array['col_title1']);}
        if(isset($data_array['col_title2'])){$this->db->set('col_title2', $data_array['col_title2']);}
        if(isset($data_array['col_format'])){$this->db->set('col_format', $data_array['col_format']);}
        if(isset($data_array['col_transform'])){$this->db->set('col_transform', $data_array['col_transform']);}
        if(isset($data_array['col_widthmin'])){$this->db->set('col_widthmin', $data_array['col_widthmin']);}
        if(isset($data_array['col_widthmax'])){$this->db->set('col_widthmax', $data_array['col_widthmax']);}
        $this->db->where('report_body_id', (string)$data_array['report_body_id']);
        $this->db->update('report_body');
        //echo $this->db->last_query();
        //echo "Updated<br />";
        //echo "<hr />";
    } // end of function update_report_body($data_array)


    //===============================================================
    // Delete Database Records Methods
    //************************************************************************
    /**
     * Method to delete report template column
     *
     * This method 
     *
	 * @param   array  data_array      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function delete_report_body($data_array)
    {
        /*
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        */
        $this->db->where('report_body_id', (string)$data_array['report_body_id']);
        $this->db->delete('report_body');
        echo $this->db->last_query();
        //echo "Deleted<br />";
        //echo "<hr />";
    } // end of function delete_report_body($data_array)


    //************************************************************************
    /**
     * Method to retrieve details of recent get_patient_vital.
     *
	 * @param   string  $expect     Required. data or 'num of fields'
	 * @param   string  $rows       Optional. All rows or just one.
	 * @param   array   $param      Optional. Printing parameters
     * @return  array, integer   
     * @author  Jason Tan Boon Teck
     */
    function get_rpt($expect='data',$sort_order='pdem.name',$rows=NULL,$param=NULL,$selects)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT ";
        $sqlQuery   .=   $selects[0].",";
        $sqlQuery   .=   $selects[1].",";
        $sqlQuery   .=   $selects[2].",";
        $sqlQuery   .=   $selects[3].",";
        $sqlQuery   .=   $selects[4];
        //"pvit.patient_id, reading_date, reading_time, temperature, pulse_rate,
                        //height, weight, bp_systolic, bp_diastolic,
                        //name
                            //";
        $sqlQuery   .=  " FROM patient_vital pvit";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON pvit.patient_id = pdem.patient_id";
        $sqlQuery   .=  " WHERE 1=1";
        
        if(isset($param['period_from'])){
            $sqlQuery   .=  " AND reading_date >= '".$param['period_from']."'";        
        }
        if(isset($param['period_to'])){
            $sqlQuery   .=  " AND reading_date <= '".$param['period_to']."'";        
        }
        if($param['clinic_info_id'] <> "All"){
            //$sqlQuery   .=  " AND location_start='".$param['clinic_info_id']."'";
        }
        if($param['patient_id'] <> "All"){
            $sqlQuery   .=  " AND pvit.patient_id='".$param['patient_id']."'";
        }
        
        $sqlQuery   .=  " ORDER BY ".$sort_order;
        if(empty($sort_order)){
            $sqlQuery   .=  "pdem.name";
        }

        if(isset($rows)){
            $sqlQuery   .=  " LIMIT ".$rows;
        }
        echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum][0]['field']  = $selects[0];
                $dataset[$rownum][0]['val']  = $row[$selects[0]];
                $dataset[$rownum][0]['desc']  = $selects[0];
                //$dataset[$rownum][0]['field']  = "patient_id";
                //$dataset[$rownum][0]['val']  = $row['patient_id'];
                //$dataset[$rownum][0]['desc']  = "patient_id";
                $dataset[$rownum][1]['field']= $selects[1];
                $dataset[$rownum][1]['val']  = $row[$selects[1]];
                $dataset[$rownum][1]['desc']= $selects[1];
                //$dataset[$rownum][1]['field']= "reading_date";
                //$dataset[$rownum][1]['val']  = $row['reading_date'];
                //$dataset[$rownum][1]['desc']= "reading_date";
                $dataset[$rownum][2]['field']= "reading_time";
                $dataset[$rownum][2]['val']  = $row['reading_time'];
                $dataset[$rownum][2]['desc']= "reading_time";
                $dataset[$rownum][3]['field']= "temperature";
                $dataset[$rownum][3]['val']  = $row['temperature'];
                $dataset[$rownum][3]['desc']= "temperature";
                $dataset[$rownum][4]['field']= "pulse_rate";
                $dataset[$rownum][4]['val']  = $row['pulse_rate'];
                $dataset[$rownum][4]['desc']= "pulse_rate";
                /*
                $dataset[$rownum][5]['field']= "height";
                $dataset[$rownum][5]['val']  = $row['height'];
                $dataset[$rownum][5]['desc']= "height";
                $dataset[$rownum][6]['field']= "weight";
                $dataset[$rownum][6]['val']  = $row['weight'];
                $dataset[$rownum][6]['desc']= "weight";
                $dataset[$rownum][7]['field'] = "bp_systolic";
                $dataset[$rownum][7]['val'] = $row['bp_systolic'];
                $dataset[$rownum][7]['desc'] = "bp_systolic";
                $dataset[$rownum][8]['field']  = "bp_diastolic";
                $dataset[$rownum][8]['val']  = $row['bp_diastolic'];
                $dataset[$rownum][8]['desc']  = "bp_diastolic";
                $dataset[$rownum][9]['field']  = "patient_name";
                $dataset[$rownum][9]['val']  = $row['name'];
                $dataset[$rownum][9]['desc']  = "Patient name";
            */
                $rownum++;            
            }
        }            
        if($expect == 'data'){
            return $dataset; 
        } else {
            $num_fields = $query->num_fields(); 
            return $num_fields;
        }
     } //end of function get_patient_vital($patient_id)



}

/* End of file mreport.php */
/* Location: ./app_thirra/models/mreport.php */
