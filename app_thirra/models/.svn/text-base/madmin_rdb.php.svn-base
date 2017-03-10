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
 * @version 0.9.10
 * @package THIRRA - mEMR-Rdb
 * @author  Jason Tan Boon Teck
 */

class MAdmin_rdb extends CI_Model
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
     * Method to retrieve list of users
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_staff_list()
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
        $sqlQuery   .=  " ORDER BY staff_info.staff_name";
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
    } //end of function get_staff_list()


    //************************************************************************
    /**
     * Method to retrieve list of departments
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_depts_list($location_id=NULL,$sort_order='dept_sort')
    {
        $data = array();
        $sqlQuery   =   "SELECT clinic_dept.*,";
        $sqlQuery   .=  " clinic_info.clinic_name, clinic_info.clinic_shortname";
        $sqlQuery   .=  " FROM clinic_dept";
        $sqlQuery   .=  " JOIN clinic_info ON clinic_dept.location_id=clinic_info.clinic_info_id";
        $sqlQuery   .=  " WHERE 1=1";
        if($location_id=='All'){
            // Select all
        } else {
            $sqlQuery   .=  " AND location_id='".$location_id."'";
        }
        $sqlQuery   .=  " ORDER BY clinic_name,".$sort_order;
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
    } //end of function get_depts_list($location_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of clinics
     *
     * This method 
     *
	 * @param   string  $country      Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_dept_info($clinic_dept_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM clinic_dept dept, clinic_info clinic";
        $sqlQuery   .=  " WHERE dept.location_id=clinic.clinic_info_id";
        $sqlQuery   .=  " AND clinic_dept_id='".$clinic_dept_id."'";
        $sqlQuery   .=  " ORDER BY country, clinic_name, dept_sort";
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
    } //end of function get_dept_info($country=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of users
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_users_list($sort_order="username")
    {
        $data = array();
        $sqlQuery   =   "SELECT system_user.*,";
        $sqlQuery   .=  " staff_info.staff_name, staff_info.staff_initials,";
        $sqlQuery   .=  " staff_work.home_clinic,";
        $sqlQuery   .=  " clinic_info.clinic_shortname,";
        $sqlQuery   .=  " system_user_category.category_name";
        $sqlQuery   .=  " FROM system_user";
        $sqlQuery   .=  " JOIN staff_info ON system_user.staff_id=staff_info.staff_id";
        $sqlQuery   .=  " JOIN staff_work ON staff_info.staff_work_id=staff_work.staff_work_id";
        $sqlQuery   .=  " JOIN clinic_info ON staff_work.home_clinic=clinic_info.clinic_info_id";
        $sqlQuery   .=  " JOIN system_user_category ON system_user.category_id=system_user_category.category_id";
        $sqlQuery   .=  " ORDER BY ".$sort_order;
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


    //************************************************************************
    /**
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
        $sqlQuery   .=  " staff_work.*,";
        $sqlQuery   .=  " staff_contact.*";
       //$sqlQuery   .=  " staff_info.staff_name,staff_info.staff_initials,staff_info.mmc_no,staff_info.specialty,staff_info.gender";
        $sqlQuery   .=  " FROM system_user";
        $sqlQuery   .=  " JOIN staff_info ON system_user.staff_id=staff_info.staff_id";
        $sqlQuery   .=  " JOIN staff_contact ON staff_info.staff_contact_id=staff_contact.staff_contact_id";
        $sqlQuery   .=  " JOIN staff_work ON staff_info.staff_work_id=staff_work.staff_work_id";
        $sqlQuery   .=  " WHERE user_id='".$user_id."'";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $data = $query->row_array();
        }            
        return $data; 
    } //end of function get_one_systemuser($user_id)

 
    //************************************************************************
    /**
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


    //************************************************************************
    /**
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


    //************************************************************************
    /**
     * Method to retrieve one staff_category
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_staffcategory($category_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT stac.*,";
        $sqlQuery   .=  " sysc.category_id AS sys_category_id, sysc.category_name AS sys_category_name, sysc.description AS sys_description, sysc.permission";
        $sqlQuery   .=  " FROM staff_category stac";
        $sqlQuery   .=  " LEFT OUTER JOIN system_user_category sysc ON stac.category_name=sysc.category_name";
        $sqlQuery   .=  " WHERE stac.category_id='".$category_id."'";
        
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_one_staffcategory()


    //************************************************************************
    /**
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
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM clinic_info";
        if(isset($country)) {
			if("ALL" == strtoupper($country)){
				//Don't filter
			} else {
				$sqlQuery   .=  " WHERE country='".$country."'";
			}
		} else {

		} //end if(isset($country)
        $sqlQuery   .=  " ORDER BY sort_clinic";
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
    } //end of function get_clinics_list($country=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of referral centres
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_referral_centres($centre_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM referral_center";
        if(isset($centre_id)) {
            $sqlQuery   .=  " WHERE referral_center_id='".$centre_id."'";
        }
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


    //************************************************************************
    /**
     * Method to retrieve list of persons attached to a referral centre
     *
     * This method 
     *
	 * @param   string  $centre_id  Required      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_referral_persons($centre_id,$person_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT referral_doctor.*, referral_center.name AS centre_name";
        $sqlQuery   .=  " FROM referral_doctor";
        $sqlQuery   .=  " JOIN referral_center ON referral_doctor.referral_center_id=referral_center.referral_center_id";
        $sqlQuery   .=  " WHERE referral_doctor.referral_center_id = '$centre_id'";
        if(isset($person_id)) {
            $sqlQuery   .=  " AND referral_doctor_id='".$person_id."'";
        }
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
    } //end of function get_referral_persons($centre_id,$person_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of patients records not synched to HQ
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_unsynched_logins($location_id='ALL',$synched_out=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT slog.*, system_user.username";
        $sqlQuery   .=  " FROM system_log slog";
        $sqlQuery   .=  " JOIN system_user ON slog.user_id=system_user.user_id";
        $sqlQuery   .=  " WHERE slog.synch_out IS NOT NULL";
		if($location_id=='ALL'){
			$sqlQuery   .=  " ";
		} else {
			$sqlQuery   .=  " AND slog.login_location = '".$location_id."'";
		}
		if($synched_out){
			$sqlQuery   .=  " AND slog.synch_remarks IS NOT NULL";
		} else {
			$sqlQuery   .=  " AND slog.synch_remarks IS NULL";
		}
        $sqlQuery   .=  " ORDER BY slog.synch_out ASC";
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
    } //end of function get_unsynched_logins()


    //************************************************************************
    /**
     * Method to retrieve list of patients records not synched to HQ
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_unsynched_patients($location_id='ALL',$synched_in=NULL,$synched_out=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM patient_demographic_info";
        $sqlQuery   .=  " WHERE synch_out IS NOT NULL";
		if($location_id=='ALL'){
			$sqlQuery   .=  " ";
		} else {
			$sqlQuery   .=  " AND clinic_home = '".$location_id."'";
		} //endif($location_id=='ALL')
		if($synched_in){
            // Edited record while offline
			$sqlQuery   .=  " AND synch_in IS NOT NULL";
		} else {
			$sqlQuery   .=  " AND synch_in IS NULL";
		} //endif($synched_in)
		if($synched_out){
			$sqlQuery   .=  " AND synch_remarks IS NOT NULL";
		} else {
			$sqlQuery   .=  " AND synch_remarks IS NULL";
		} //endif($synched_out)
        $sqlQuery   .=  " ORDER BY synch_out ASC";
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
    } //end of function get_unsynched_patients()


    //************************************************************************
    /**
     * Method to retrieve list of antenatal events not synched to HQ
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_unsynched_antenatalinfo($location_id='ALL',$synched_in=NULL,$synched_out=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT patient_antenatal.*,";
        $sqlQuery   .=  " ainf.date,";
        $sqlQuery   .=  " pdem.name, pdem.name_first, pdem.birth_date, pdem.gender";
        $sqlQuery   .=  " FROM patient_antenatal";
        $sqlQuery   .=  " JOIN patient_event peve ON patient_antenatal.antenatal_id= peve.event_id";
        $sqlQuery   .=  " JOIN patient_antenatal_info ainf ON patient_antenatal.antenatal_id= ainf.event_id";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON patient_antenatal.patient_id= pdem.patient_id";
        $sqlQuery   .=  " WHERE ainf.synch_out IS NOT NULL";
		if($location_id=='ALL'){
			$sqlQuery   .=  " ";
		} else {
			$sqlQuery   .=  " AND peve.location_id = '".$location_id."'";
		}
		if($synched_in){
            // Edited record while offline
			$sqlQuery   .=  " AND ainf.synch_in IS NOT NULL";
		} else {
			$sqlQuery   .=  " AND ainf.synch_in IS NULL";
		} //endif($synched_in)
		if($synched_out){
			$sqlQuery   .=  " AND patient_antenatal.synch_remarks IS NOT NULL";
		} else {
			$sqlQuery   .=  " AND patient_antenatal.synch_remarks IS NULL";
		}
        $sqlQuery   .=  " ORDER BY patient_antenatal.synch_out ASC";
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
    } //end of function get_unsynched_antenatalinfo()


    //************************************************************************
    /**
     * Method to retrieve list of antenatal checkups not synched to HQ
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_unsynched_antenatalcheckup($location_id='ALL',$synched_out=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT patient_antenatal_followup.*,";
        $sqlQuery   .=  " pant.patient_id,";
        $sqlQuery   .=  " pdem.name, pdem.name_first, pdem.birth_date, pdem.gender";
        $sqlQuery   .=  " FROM patient_antenatal_followup";
        $sqlQuery   .=  " JOIN patient_antenatal pant ON patient_antenatal_followup.antenatal_id= pant.antenatal_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary pcon ON patient_antenatal_followup.session_id= pcon.summary_id";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON pant.patient_id= pdem.patient_id";
        $sqlQuery   .=  " WHERE patient_antenatal_followup.synch_out IS NOT NULL";
		if($location_id=='ALL'){
			$sqlQuery   .=  " ";
		} else {
			$sqlQuery   .=  " AND pcon.location_end = '".$location_id."'";
		}
		if($synched_out){
			$sqlQuery   .=  " AND patient_antenatal_followup.synch_remarks IS NOT NULL";
		} else {
			$sqlQuery   .=  " AND patient_antenatal_followup.synch_remarks IS NULL";
		}
        $sqlQuery   .=  " ORDER BY patient_antenatal_followup.synch_out ASC";
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
    } //end of function get_unsynched_antenatalcheckup()


    //************************************************************************
    /**
     * Method to retrieve list of antenatal deliveries not synched to HQ
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_unsynched_antenataldelivery($location_id='ALL',$synched_out=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT patient_antenatal_delivery.*,";
        $sqlQuery   .=  " pant.patient_id,";
        $sqlQuery   .=  " pdem.name, pdem.name_first, pdem.birth_date, pdem.gender";
        $sqlQuery   .=  " FROM patient_antenatal_delivery";
        $sqlQuery   .=  " JOIN patient_antenatal pant ON patient_antenatal_delivery.antenatal_id= pant.antenatal_id";
        $sqlQuery   .=  " JOIN patient_event peve ON patient_antenatal_delivery.event_id= peve.event_id";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON pant.patient_id= pdem.patient_id";
        $sqlQuery   .=  " WHERE patient_antenatal_delivery.synch_out IS NOT NULL";
		if($location_id=='ALL'){
			$sqlQuery   .=  " ";
		} else {
			$sqlQuery   .=  " AND peve.location_id = '".$location_id."'";
		}
		if($synched_out){
			$sqlQuery   .=  " AND patient_antenatal_delivery.synch_remarks IS NOT NULL";
		} else {
			$sqlQuery   .=  " AND patient_antenatal_delivery.synch_remarks IS NULL";
		}
        $sqlQuery   .=  " ORDER BY patient_antenatal_delivery.synch_out ASC";
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
    } //end of function get_unsynched_antenataldelivery()


    //************************************************************************
    /**
     * Method to retrieve list of patients episodes not synched to HQ
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_unsynched_episodes($location_id='ALL',$status='Closed',$synched_out=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT patient_consultation_summary.*,";
        $sqlQuery   .=  " pdem.name, pdem.name_first, pdem.birth_date, pdem.gender";
        $sqlQuery   .=  " FROM patient_consultation_summary";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON patient_consultation_summary.patient_id= pdem.patient_id";
        $sqlQuery   .=  " WHERE patient_consultation_summary.synch_out IS NOT NULL";
		if($location_id=='ALL'){
			$sqlQuery   .=  " ";
		} else {
			$sqlQuery   .=  " AND location_end = '".$location_id."'";
		} // endif($location_id=='ALL')
        if($status=="Closed"){
            $sqlQuery   .=  " AND patient_consultation_summary.date_ended IS NOT NULL";
		} else {
			$sqlQuery   .=  " AND patient_consultation_summary.date_ended IS NULL";
        } // endif($status=="Closed")
		if($synched_out){
			$sqlQuery   .=  " AND patient_consultation_summary.synch_remarks IS NOT NULL";
		} else {
			$sqlQuery   .=  " AND patient_consultation_summary.synch_remarks IS NULL";
		} // endif($synched_out)
        $sqlQuery   .=  " ORDER BY patient_consultation_summary.synch_out ASC";
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
    } //end of function get_unsynched_episodes()


    //************************************************************************
    /**
     * Method to retrieve list of antenatal checkups not synched to HQ
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_unsynched_historyimmunisation($location_id='ALL',$synched_out=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT pimm.*,";
        $sqlQuery   .=  " immu.*,";
        $sqlQuery   .=  " pdem.name, pdem.name_first, pdem.birth_date, pdem.gender";
        $sqlQuery   .=  " FROM patient_immunisation pimm";
        $sqlQuery   .=  " JOIN immunisation immu ON pimm.immunisation_id= immu.immunisation_id";
        $sqlQuery   .=  " JOIN patient_demographic_info pdem ON pimm.patient_id= pdem.patient_id";
        $sqlQuery   .=  " WHERE pimm.synch_out IS NOT NULL";
        $sqlQuery   .=  " AND pimm.immunisation_id <> '0'";
		if($location_id=='ALL'){
			$sqlQuery   .=  " ";
		} else {
			//$sqlQuery   .=  " AND pcon.location_end = '".$location_id."'";
		}
		if($synched_out){
			$sqlQuery   .=  " AND pimm.synch_remarks IS NOT NULL";
		} else {
			$sqlQuery   .=  " AND pimm.synch_remarks IS NULL";
		}
        $sqlQuery   .=  " ORDER BY pimm.synch_out ASC";
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
    } //end of function get_unsynched_antenatalcheckup()


    //************************************************************************
    /**
     * Method to retrieve list of patients records not synched to HQ
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_synch_logs($activity='Import', $log_id=NULL, $filename=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT slog.*";
        $sqlQuery   .=  " FROM data_synch_log slog";
        $sqlQuery   .=  " WHERE 1 = 1";
        if($activity=='Import'){
            $sqlQuery   .=  " AND slog.import_by IS NOT NULL";
        } else {
            $sqlQuery   .=  " AND slog.import_by IS NULL";
        }
        if(isset($log_id)){
            $sqlQuery   .=  " AND slog.data_synch_log_id='".$log_id."'";
        }
        if(isset($filename)){
            $sqlQuery   .=  " AND slog.data_filename='".$filename."'";
        }
        $sqlQuery   .=  " ORDER BY slog.import_when ASC";
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
    } //end of function get_synch_logs()


}

/* End of file memr.php */
/* Location: ./app_thirra/models/memr.php */
