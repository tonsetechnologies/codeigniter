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
 * Portions created by the Initial Developer are Copyright (C) 2010
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for Biosurveillance
 *
 * This class is for models of Biosurveillance.
 *
 * @version 0.8
 * @package THIRRA - mBiosurveillance
 * @author  Jason Tan Boon Teck
 */

class MBio extends CI_Model
{
    protected $_patient_id      =  "";
    protected $_summary_id      =  "";
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
     * Not used. Method to retrieve 
     *
     * This method 
     *
	 * @param   string  None      No parameter required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_case_info($id)
    {
        $data = array();
        $options = array('bio_case_id' => $id);
        $Q = $this->db->get_where('bio_case',$options,1);
        if ($Q->num_rows() > 0){
          $data = $Q->row_array();
        }

        $Q->free_result();    
        return $data;    
    }


    //************************************************************************
    /**
     * Method to retrieve clinic information.
     *
     * This method retrieves either one row or multiple rows (if no key was supplied)
     *
	 * @param   string  $clinic_id      Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_clinic_info($clinic_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT clinic_info.*, district.district_name";
        $sqlQuery   .=  " FROM clinic_info";
        $sqlQuery   .=  " LEFT OUTER JOIN district ON clinic_info.clinic_district_id=district.district_id";
        //echo "<br />".$sqlQuery;

        if(isset($clinic_id)) {
			$sqlQuery   .=  " WHERE clinic_info.clinic_info_id='".$clinic_id."'";
        } //end if(isset($clinic_id)
        $Q =  $this->db->query($sqlQuery);
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        //echo $this->db->last_query();
        $Q->free_result();    
        return $data;    
    } //end of function getClinicInfo($country=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of clinics
     *
     * This method 
     *
	 * @param   string  $country      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_clinics_list($country=NULL, $offline_mode=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM clinic_info";
        if($country <> "ALL") {
            //$options = array('country' => $country);
			$sqlQuery   .=  " WHERE country='".$country."'";
			if($offline_mode){
				$sqlQuery   .=  " AND clinic_type = 'Mobile'";					
			}
        } else {
			// Don't restrict by country - Demo
        } //end if(isset($country)
        $sqlQuery   .=  " ORDER BY sort_clinic";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $data[] = $row;
            }
		}
		return $data;    
    } //end of function get_clinics_list($country)


	//************************************************************************
    /**
     * Method to retrieve details of patients.
     *
     * This method retrieves details of patients. Less fields retrieved if patient_id is given.
     * Base is patient_demographic_info.
     *
	 * @param   string  $patient_id      Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patient_details($patient_id=NULL)
    {
        $data = array();
        $this->_patient_id  =   $patient_id;
        $sqlQuery   =   "SELECT patient_demographic_info.*, name as patient_name,";
        if(isset($this->_patient_id)){
            $sqlQuery   .=  " address as patient_address, address_2 as patient_address2, 
                              address_3 as patient_address3,
                              town as patient_town, country as patient_country, state as patient_state, postcode as patient_postcode,
                              tel_home, tel_office, tel_mobile, email, 
                              addr_village_id, addr_area_id,";
            $sqlQuery   .=  " birth_date_estimate";
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
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_patient_details($patient_id)


    //************************************************************************
    /**
     * Method to retrieve list of patients inside database. Base is patient_demographic_info
     *
     * This method also displays bio_case info if available.
     *
	 * @param   string  $patient_name      Optional parameter to filter
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_all_patients($patient_name=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT 
                            patient_demographic_info.patient_id,
                            patient_demographic_info.clinic_reference_number,
                            patient_demographic_info.name,
                            patient_demographic_info.gender,
                            patient_demographic_info.ic_other_no,
                            patient_demographic_info.birth_date,
                            bio_case.bio_case_id,
                            bio_case.case_ref,
                            bio_case.start_date
                            FROM patient_demographic_info";
        $sqlQuery   .=  " LEFT OUTER JOIN bio_case ON patient_demographic_info.patient_id=bio_case.patient_id";
        if(isset($patient_name)){
            $_patient_name  =   $patient_name;
            $sqlQuery   .=  " WHERE name ILIKE '%$_patient_name%'";
        }
        $sqlQuery   .=  " ORDER BY name";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['patient_id']             = $row['patient_id'];
                $dataset[$rownum]['name']                   = $row['name'];
                $dataset[$rownum]['clinic_reference_number']= $row['clinic_reference_number'];
                $dataset[$rownum]['gender']                 = $row['gender'];
                $dataset[$rownum]['ic_other_no']            = $row['ic_other_no'];
                $dataset[$rownum]['birth_date']             = $row['birth_date'];
                $dataset[$rownum]['bio_case_id']            = $row['bio_case_id'];
                $dataset[$rownum]['case_ref']               = $row['case_ref'];
                $dataset[$rownum]['start_date']             = $row['start_date'];
                $rownum++;            
            }
        }
        return $dataset; 
    } //end of function get_all_patients($patient_name=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve list of patients inside database. Base is patient_demographic_info
     *
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
        $sqlQuery   =   "SELECT DISTINCT ON (patient_demographic_info.name||patient_demographic_info.patient_id) 
                            patient_demographic_info.patient_id,
                            patient_demographic_info.clinic_reference_number,
                            patient_demographic_info.name,
                            patient_demographic_info.gender,
                            patient_demographic_info.ic_other_no,
                            patient_demographic_info.birth_date,
                            patient_disease_notification.notification_id,
                            patient_disease_notification.notification_reference,
                            patient_disease_notification.notify_date,
                            patient_disease_notification.started_date,
							bio_case.bio_case_id, bio_case.start_date, bio_case.end_date 
                            FROM patient_demographic_info";
        $sqlQuery   .=  " LEFT OUTER JOIN patient_disease_notification ON patient_demographic_info.patient_id=patient_disease_notification.patient_id";
        $sqlQuery   .=  " LEFT OUTER JOIN bio_case ON patient_disease_notification.notification_id=bio_case.notification_id";
        if(isset($patient_name)){
            $_patient_name  =   $patient_name;
            $sqlQuery   .=  " WHERE name ILIKE '%$_patient_name%'";
        }
        $sqlQuery   .=  " ORDER BY (patient_demographic_info.name||patient_demographic_info.patient_id) ";
        //$sqlQuery   .=  " ORDER BY name";
        //echo "<br />".$sqlQuery;
        $query =  $this->db->query($sqlQuery);
        //reset($query);
        
        if ($query->num_rows() > 0){
            $rownum     =   1;        
            foreach ($query->result_array() as $row){
                $dataset[] = $row;
            }
			/*
            foreach ($query->result_array() as $row)
            {
                $dataset[$rownum]['patient_id']             = $row['patient_id'];
                $dataset[$rownum]['name']                   = $row['name'];
                $dataset[$rownum]['clinic_reference_number']= $row['clinic_reference_number'];
                $dataset[$rownum]['gender']                 = $row['gender'];
                $dataset[$rownum]['ic_other_no']            = $row['ic_other_no'];
                $dataset[$rownum]['birth_date']             = $row['birth_date'];
                $dataset[$rownum]['notification_id']        = $row['notification_id'];
                $dataset[$rownum]['notification_reference'] = $row['notification_reference'];
                $dataset[$rownum]['notify_date']            = $row['notify_date'];
                $dataset[$rownum]['started_date']           = $row['started_date'];
                $rownum++;            
            }
			*/
        }
        return $dataset; 
    } //end of function get_patients_list($patient_name=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve array of lab orders for an episode.
     *
     * If lab_order_id is passed, only one row will be retrieved.
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
        if(isset($lab_order_id)){
            $sqlQuery   .=  " AND lab_order.lab_order_id='".$this->_lab_order_id."'";
        }
        $sqlQuery   .=  " ORDER BY lab_package.package_code";
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
        $sqlQuery   .=  " JOIN lab_supplier ON lab_package.supplier_id=lab_supplier.supplier_id";
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
     * Method to retrieve list of rooms
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_rooms_list($location_id=NULL,$category=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT room.*,";
        $sqlQuery   .=  " room_category.name AS category_name";
        $sqlQuery   .=  " FROM room";
        $sqlQuery   .=  " JOIN room_category ON room.category_id=room_category.category_id";
        $sqlQuery   .=  " WHERE location_id='".$location_id."'";
        $sqlQuery   .=  " ORDER BY name";
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
    } //end of function get_rooms_list($location_id=NULL,$category=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of patients queueing
     *
     * This method 
     *
	 * @param   string  $location_id    Required  
	 * @param   string  $date           Optional
	 * @param   string  $queue_id       Optional

     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_patients_queue($location_id,$date=NULL,$queue_id=NULL)
    {
        $data = array();
        if($queue_id) {
            $this->_queue_id  =   $queue_id;
        }
        $sqlQuery   =   "SELECT booking.*,";
        $sqlQuery   .=  " patient_demographic_info.name,patient_demographic_info.gender, patient_demographic_info.birth_date,";
        $sqlQuery   .=  " room.name as room_name,";
		$sqlQuery   .=  " staff_info.staff_name";
        $sqlQuery   .=  " FROM booking";
        $sqlQuery   .=  " JOIN room ON booking.room_id=room.room_id";
        $sqlQuery   .=  " JOIN patient_demographic_info ON booking.patient_id = patient_demographic_info.patient_id";
        $sqlQuery   .=  " JOIN staff_info ON booking.staff_id = staff_info.staff_id";
        $sqlQuery   .=  " WHERE 1=1";
        //  location_id = '$location_id'";
        if($queue_id) {
            $sqlQuery   .=  " AND booking_id = '$this->_queue_id'";
        }
        if(isset($date) && ($date <> "any")) {
            $sqlQuery   .=  " AND date = '$date'";
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
    } //end of function get_patients_queue($location_id,$date=NULL,$booking_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve bio_cases. Base is bio_case.
     *
     * This method 
     *
	 * @param   string  None      No parameter required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_all_cases()
    {
        $data = array();
        $this->db->select('bio_case_id, case_ref,
                           clinic_name,
                           patient_consultation_summary.summary_id, patient_consultation_summary.patient_id, 
                           patient_demographic_info.name as patient_name, birth_date, gender,
                           start_date');
        $this->db->from('bio_case');
        $this->db->join('patient_consultation_summary','bio_case.summary_id=patient_consultation_summary.summary_id','left inner join');
        $this->db->join('patient_demographic_info','patient_consultation_summary.patient_id=patient_demographic_info.patient_id','left inner join');
        $this->db->join('clinic_info','bio_case.location_id=clinic_info.clinic_info_id','left inner join');
        //$this->db->where('patient_demographic_info.patient_id', $id);
        $this->db->orderby('start_date');
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
           foreach ($Q->result_array() as $row){
             $data[] = $row;
           }
        }
        $Q->free_result();    
        return $data; 
    } // end of function get_all_cases()


    // CANDIDATE FOR DEPRECATION 
    //************************************************************************
    /**
     * Method to retrieve case details
     *
     * This method 
     *
	 * @param   string  None      No parameter required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_case_details($case_id)
    {
        $data = array();
        $this->db->select('bio_case_id, case_ref,bio_case.location_id, district_id, gps_lat, gps_long,
                           case_findings, case_summary, alert_max, alert_now, start_date, end_date, staff_start_id,
                           staff_close, case_comments, case_remarks,
                           clinic_name,
                           patient_consultation_summary.summary_id, patient_consultation_summary.patient_id,
                           patient_consultation_summary.date_ended as visit_date,
                           patient_demographic_info.name as patient_name, birth_date, gender, ic_other_no
                           ');
        $this->db->from('bio_case');
        $this->db->join('patient_consultation_summary','bio_case.summary_id=patient_consultation_summary.summary_id','left inner join');
        $this->db->join('patient_demographic_info','patient_consultation_summary.patient_id=patient_demographic_info.patient_id','left inner join');
        $this->db->join('clinic_info','bio_case.location_id=clinic_info.clinic_info_id','left inner join');
        $this->db->where('bio_case.bio_case_id', $case_id);
        //$this->db->orderby('start_date');
        //echo $this->db->_compile_select();
        $Q = $this->db->get();
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data = $row;
            }
        }
        $Q->free_result();    
        return $data; 
    } // end of function get_case_details($case_id)


    //************************************************************************
    /**
     * Method to retrieve case details from BIO_CASE table only
     *
     * This method 
     *
	 * @param   string  bio_case_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_case_details_only($bio_case_id)
    {
        $data = array();
       $this->db->from('bio_case');
       $this->db->where('bio_case.bio_case_id', $bio_case_id);
        //$this->db->orderby('start_date');
        //echo $this->db->_compile_select();
        $Q = $this->db->get();
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data = $row;
            }
        }
        $Q->free_result();    
        return $data; 
    } // end of function get_case_details_only($bio_case_id)


    //************************************************************************
    /**
     * Method to retrieve investigation details from BIO_INVESTIGATE table only
     *
     * This method 
     *
	 * @param   string  bio_inv_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_investigate_details_only($bio_inv_id)
    {
        $data = array();
        $this->db->from('bio_investigate');
        $this->db->where('bio_investigate.bio_inv_id', $bio_inv_id);
        //$this->db->orderby('start_date');
        //echo $this->db->_compile_select();
        $Q = $this->db->get();
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data = $row;
            }
        }
        $Q->free_result();    
        return $data; 
    } // end of function get_investigate_details_only($bio_inv_id)


    //************************************************************************
    /**
     * Method to retrieve investigation details from BIO_INVESTIGATE table only, per bio_case
     *
     * This method 
     *
	 * @param   string  bio_case_id      
	 * @param   string  bio_inv_id      Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_investigate_details_per_biocase($bio_case_id,$contacttype=NULL)
    {
        $data = array();
        $this->db->from('bio_investigate');
        $this->db->where('bio_investigate.bio_case_id', $bio_case_id);
		if(isset($contacttype)){
			$this->db->where('bio_investigate.inv_main_contacttype', $contacttype);			
		}
        $this->db->orderby('inv_main_contacttype');
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
    } // end of function get_investigate_details_per_biocase($bio_case_id)


    //************************************************************************
    /**
     * Method to retrieve PHI range from BIO_CASE table only
     *
     * This method 
     *
	 * @param   string  bio_case_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_phi_range($location_id=NULL)
    {
        $data = array();
       $this->db->from('clinic_info');
       $this->db->where('clinic_info.clinic_info_id', $location_id);
        //$this->db->orderby('start_date');
        //echo $this->db->_compile_select();
        $Q = $this->db->get();
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data = $row;
            }
        }
        $Q->free_result();    
        return $data; 
    } // end of function get_phi_range($location_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of picture files from BIO_PICS table only
     *
     * This method 
     *
	 * @param   string  bio_inv_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_pics_list($bio_inv_id=NULL)
    {
        $data = array();
        $this->db->from('bio_file');
        $this->db->where('bio_file.bio_inv_id', $bio_inv_id);
        $this->db->order_by('bio_file_sort'); 
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
    } // end of function get_pics_list($bio_pics_id)


    //************************************************************************
    /**
     * Method to retrieve list of Disease Notifications
     *
     * 
     *
	 * @param   boolean     dbfilter        If needed, e.g. fresh, open, closed, all
	 * @param   string      bio_case_id     If available
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_disease_notified_list($dbfilter=NULL,$limit='ALL',$offset=0,$bio_case_id=NULL)
    {
        $data = array();
        switch ($dbfilter){
            case "fresh":
                $sqlQueryFil   =   " AND bio_case.bio_case_id IS NULL";
                break;			
            case "open":
                $sqlQueryFil   =   " AND bio_case.bio_case_id IS NOT NULL AND bio_case.end_date IS NULL";
                break;			
            case "closed":
                $sqlQueryFil   =   " AND bio_case.end_date IS NOT NULL";
                break;			
            case "all":
                $sqlQueryFil   =   "  closed";
                break;			
            default:
                $sqlQueryFil   =   " default";
                break;			
        } //endswitch
        //echo $sqlQueryFil;
        $sqlQuery   =   "SELECT 
                                dn.notification_id, notify_date, started_date as illness_started, dn.comments as notify_comments, notification_sequence, notification_reference,
                                notification_reference, bio_case_id, case_ref, bio_phi_ref, case_comments,
                                clinic_name, clinic_shortname,
                                cs.summary_id, cs.patient_id,
                                diagnosis_id, patient_diagnosis.dcode1ext_code, dcode1ext_longname, short_title,
                                di.name as patient_name, birth_date, gender, ic_other_no,
                                ci.town as patient_town,
                                bio_case.start_date as bio_start_date";
        $sqlQuery   .=  " FROM patient_disease_notification dn";
        $sqlQuery   .=  " JOIN patient_consultation_summary cs ON
                             dn.session_id=cs.summary_id";
        $sqlQuery   .=  " JOIN patient_demographic_info di ON cs.patient_id=di.patient_id";
        $sqlQuery   .=  " LEFT OUTER JOIN patient_contact_info ci ON di.patient_id=ci.patient_id";
        $sqlQuery   .=  " JOIN clinic_info ON cs.location_start=clinic_info.clinic_info_id";
        $sqlQuery   .=  " JOIN patient_diagnosis ON cs.summary_id=patient_diagnosis.session_id";
        $sqlQuery   .=  " JOIN dcode1ext ON patient_diagnosis.dcode1ext_code=dcode1ext.dcode1ext_code";
        $sqlQuery   .=  " LEFT OUTER JOIN bio_case ON cs.summary_id=bio_case.summary_id";
        $sqlQuery   .=  " WHERE dcode1ext.dcode1ext_notify > 0";
        $sqlQuery   .=   $sqlQueryFil;
        $sqlQuery   .=  " ORDER BY bio_start_date";
        $sqlQuery   .=  " LIMIT ".$limit;
        $sqlQuery   .=  " OFFSET ".$offset;
        //echo "<br />".$sqlQuery."<br /><br />";
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
           foreach ($Q->result_array() as $row){
             $data[] = $row;
           }
        }
        $Q->free_result();    
        return $data; 
    } //end function get_disease_notified_list($dbfilter=NULL,$bio_case_id=NULL)

 
    //************************************************************************
    /**
     * Method to retrieve details of disease notification
     *
     * 
     *
	 * @param   string      bio_case_id     If available
	 * @param   boolean     dbfilter        If needed
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_disease_notify_details($patient_id=NULL,$notification_id=NULL)
    {
        $data = array();
        $this->_patient_id      = $patient_id;
        $this->_notification_id = $notification_id;
        //echo $sqlQueryFil;
        $sqlQuery   =   "SELECT 
                                notification_id, notify_date, started_date, dn.comments as notify_comments, 
                                notification_sequence, notification_reference as notify_ref,
                                clinic_info_id as location_id, clinic_name,";
        $sqlQuery   .=  "       cs.summary_id, cs.patient_id, cs.booking_id,";
        $sqlQuery   .=  "       diagnosis_id, patient_diagnosis.dcode1ext_code, dcode1ext_longname, short_title, patient_diagnosis.notes as diagnosis_notes,";
        $sqlQuery   .=  "       clinic_reference_number,
                                di.name as patient_name, birth_date, gender, ic_other_no,";
        $sqlQuery   .=  "       ci.postcode as patient_postcode, 
                                ci.town as patient_town,
                                ci.state as patient_state,
                                tel_home,";
        $sqlQuery   .=  "       adt.adt_id, adt.check_in_date, adt.check_out_date, adt.adt_reference AS bht_no";
        $sqlQuery   .=  " FROM patient_disease_notification dn";
        $sqlQuery   .=  " JOIN patient_consultation_summary cs ON
                             dn.session_id=cs.summary_id";
        $sqlQuery   .=  " JOIN patient_demographic_info di ON cs.patient_id=di.patient_id";
        $sqlQuery   .=  " LEFT OUTER JOIN patient_contact_info ci ON di.patient_id=ci.patient_id";
        $sqlQuery   .=  " JOIN clinic_info ON cs.location_start=clinic_info.clinic_info_id";
		// For the purpose of THIRRA biosurveillance, assumes only 1 diagnosis per notification
        $sqlQuery   .=  " JOIN patient_diagnosis ON cs.summary_id=patient_diagnosis.session_id";
        $sqlQuery   .=  " JOIN dcode1ext ON patient_diagnosis.dcode1ext_code=dcode1ext.dcode1ext_code";
        $sqlQuery   .=  " JOIN adt ON cs.adt_id=adt.adt_id";
        $sqlQuery   .=  " WHERE dn.notification_id='".$this->_notification_id."'";
        $sqlQuery   .=  " AND dcode1ext.dcode1ext_notify > 0";
        //$sqlQuery   .=  " ORDER BY bio_start_date";
        //echo "<br />".$sqlQuery."<br /><br />";
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
           foreach ($Q->result_array() as $row){
             $data = $row;
           }
        }
        $Q->free_result();    
        return $data; 
    } //end of get_disease_notify_details($patient_id=NULL,$bio_case_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve 
     *
     * This method 
     *
	 * @param   string  $infectious      Optional
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_diagnosis_list($infectious=NULL, $commonly_used=NULL)
    {
        $data = array();
        $this->db->select('dcode1ext_id,dcode1ext_code,dcode1ext_longname,short_title,dcode1ext_notify');
        $this->db->from('dcode1ext');
        if(isset($infectious) && $infectious == TRUE) {
            $this->db->where('dcode1ext_notify >',0);
        }
        if(isset($commonly_used) && $commonly_used == TRUE) {
            $this->db->where('commonly_used >',0);
        }
        $this->db->orderby('short_title');
        //echo $this->db->_compile_select();
        //echo "\n<br /><br />";
        $Q = $this->db->get();
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_diagnosis_list($country=NULL)


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



    //===============================================================
    // Insert Database Methods

    //************************************************************************
    /**
     * Method to add new patients
     *
     * This method adds a new patient to the clinic. It inserts row into patient_demographic_info,
     * patient_contact_info, patient_immunisation and patient_employment(if any)
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
        if(isset($data_array['addr_village_id'])){$this->db->set('addr_village_id', (string)$data_array['addr_village_id']);}
        if(isset($data_array['addr_town_id'])){$this->db->set('addr_town_id', (string)$data_array['addr_town_id']);}
        if(isset($data_array['addr_area_id'])){$this->db->set('addr_area_id', (string)$data_array['addr_area_id']);}
        if(isset($data_array['addr_district_id'])){$this->db->set('addr_district_id', (string)$data_array['addr_district_id']);}
        if(isset($data_array['addr_state_id'])){$this->db->set('addr_state_id', (string)$data_array['addr_state_id']);}
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
        if(isset($data_array['birth_date_estimate'])){$this->db->set('birth_date_estimate', (boolean)TRUE);}//(boolean)$data_array['birth_date_estimate']);}
        if(isset($data_array['guardian_name'])){$this->db->set('guardian_name', $data_array['guardian_name']);}
        if(isset($data_array['guardian_relation'])){$this->db->set('guardian_relationship', $data_array['guardian_relation']);}
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


    //************************************************************************
    /**
     * Method to insert New Disease Notification  
     *
     * This method creates a disease notification together with the consultation.
     *
	 * @param   array  $data_array      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_disease_notify($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        $_user_ip =   $this->input->ip_address();
        //echo "<hr />";
        //echo "Inserting notify details";
        //echo "<pre>";
        //print_r($data_array);
        //echo "</pre>";

        // Insert into patient_medical_history
        if(isset($data_array['medical_history_id'])){$this->db->set('medical_history_id', $data_array['medical_history_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['onset_date'])){$this->db->set('history_date', $data_array['onset_date']);}
        if(isset($data_array['history_date_accuracy'])){$this->db->set('year', $data_array['history_date_accuracy']);}
        if(isset($data_array['history_condition'])){$this->db->set('condition', $data_array['history_condition']);}
        if(isset($data_array['history_status'])){$this->db->set('status', $data_array['history_status']);}
        if(isset($data_array['diagnosis_notes'])){$this->db->set('summary', $data_array['diagnosis_notes']);}
        if(isset($data_array['dcode1set'])){$this->db->set('dcode1set', $data_array['dcode1set']);}
        if(isset($data_array['dcode1ext_code'])){$this->db->set('dcode1ext_code', $data_array['dcode1ext_code']);}
        if(isset($data_array['dcode2set'])){$this->db->set('dcode2set', $data_array['dcode2set']);}
        if(isset($data_array['dcode2ext_code'])){$this->db->set('dcode2ext_code', $data_array['dcode2ext_code']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['diagnosis_id'])){$this->db->set('diagnosis_id', $data_array['diagnosis_id']);}
        $this->db->insert('patient_medical_history');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_medical_history";
/*
  check_in_remarks character varying(255),
  check_out_estimate date,
  check_out_staff character(10),
  check_out_remarks character varying(255),
*/
		// Insert into adt
        if(isset($data_array['adt_id'])){$this->db->set('adt_id', $data_array['adt_id']);}
        if(isset($data_array['bht_no'])){$this->db->set('adt_reference', $data_array['bht_no']);}
        if(isset($data_array['adt_sequence'])){$this->db->set('adt_sequence', $data_array['adt_sequence']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['check_in_date'])){$this->db->set('check_in_date', $data_array['check_in_date']);}
        if(isset($data_array['check_in_time'])){$this->db->set('check_in_time', $data_array['check_in_time']);}
        if(isset($data_array['check_out_date'])){
			$this->db->set('check_out_date', $data_array['check_out_date']);
			if(isset($data_array['check_out_time'])){$this->db->set('check_out_time', $data_array['check_out_time']);}
		}
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
        if(isset($data_array['booking_id'])){$this->db->set('booking_id', $data_array['booking_id']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        $this->db->insert('patient_consultation_summary');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_consultation_summary";

        // Insert into patient_diagnosis
        if(isset($data_array['diagnosis_id'])){$this->db->set('diagnosis_id', $data_array['diagnosis_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['diagnosis_type'])){$this->db->set('diagnosis_type', $data_array['diagnosis_type']);}
        if(isset($data_array['diagnosis_notes'])){$this->db->set('notes', $data_array['diagnosis_notes']);}
        if(isset($data_array['dcode1set'])){$this->db->set('dcode1set', $data_array['dcode1set']);}
        if(isset($data_array['dcode1ext_code'])){$this->db->set('dcode1ext_code', $data_array['dcode1ext_code']);}
        if(isset($data_array['dcode2set'])){$this->db->set('dcode2set', $data_array['dcode2set']);}
        if(isset($data_array['dcode2ext_code'])){$this->db->set('dcode2ext_code', $data_array['dcode2ext_code']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        $this->db->insert('patient_diagnosis');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_diagnosis";

        // Insert into patient_disease_notification
        if(isset($data_array['notification_id'])){$this->db->set('notification_id', $data_array['notification_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['notify_date'])){$this->db->set('notify_date', $data_array['notify_date']);}
        if(isset($data_array['onset_date'])){$this->db->set('started_date', $data_array['onset_date']);}
        if(isset($data_array['notify_comments'])){$this->db->set('comments', $data_array['notify_comments']);}
        if(isset($data_array['others'])){$this->db->set('others', $data_array['others']);}
        if(isset($data_array['confirmation'])){$this->db->set('confirmation', $data_array['confirmation']);}
        if(isset($data_array['notification_sequence'])){$this->db->set('notification_sequence', $data_array['notification_sequence']);}
        if(isset($data_array['notify_ref'])){$this->db->set('notification_reference', $data_array['notify_ref']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        $this->db->insert('patient_disease_notification');
        //echo $this->db->last_query();
        //echo "<br />Inserted into patient_disease_notification";

        // Insert into booking
        if(isset($data_array['booking_id'])){$this->db->set('booking_id', $data_array['booking_id']);}
        if(isset($data_array['room_id'])){$this->db->set('room_id', $data_array['room_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['staff_id'])){$this->db->set('booking_staff_id', $data_array['staff_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['check_in_date'])){$this->db->set('reserve_date', $data_array['check_in_date']);}
        if(isset($data_array['check_in_time'])){$this->db->set('reserve_time', $data_array['check_in_time']);}
        if(isset($data_array['check_in_date'])){$this->db->set('date', $data_array['check_in_date']);}
        if(isset($data_array['check_in_time'])){$this->db->set('start_time', $data_array['check_in_time']);}
        if(isset($data_array['check_in_time'])){$this->db->set('end_time', $data_array['check_in_time']);}
        if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
        if(isset($data_array['booking_type'])){$this->db->set('booking_type', $data_array['booking_type']);}
        if(isset($data_array['priority'])){$this->db->set('priority', $data_array['priority']);}
        if(isset($data_array['booking_status'])){$this->db->set('status', $data_array['booking_status']);}
        if(isset($data_array['canceled_reason'])){$this->db->set('canceled_reason', $data_array['canceled_reason']);}
        if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
        if(isset($data_array['previous_session_id'])){$this->db->set('previous_session_id', $data_array['previous_session_id']);}
        if(isset($data_array['external_ref'])){$this->db->set('external_ref', $data_array['external_ref']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('booking');
        //echo $this->db->last_query();
        //echo "<br />Inserted into booking";
		
        // Insert into lab_order
		if($data_array['has_lab']) {
			if(isset($data_array['lab_order_id'])){$this->db->set('lab_order_id', $data_array['lab_order_id']);}
			if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
			if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
			if(isset($data_array['session_id'])){$this->db->set('session_id', $data_array['session_id']);}
			if(isset($data_array['lab_package_id'])){$this->db->set('lab_package_id', $data_array['lab_package_id']);}
			if(isset($data_array['product_id'])){$this->db->set('product_id', $data_array['product_id']);}
			if(isset($data_array['sample_ref'])){$this->db->set('sample_ref', $data_array['sample_ref']);}
			if(isset($data_array['sample_date'])){$this->db->set('sample_date', $data_array['sample_date']);}
			if(isset($data_array['sample_time'])){$this->db->set('sample_time', $data_array['sample_time']);}
			if(isset($data_array['fasting'])){$this->db->set('fasting', $data_array['fasting']);}
			if(isset($data_array['urgency'])){$this->db->set('urgency', $data_array['urgency']);}
			if(isset($data_array['summary_result'])){$this->db->set('summary_result', $data_array['summary_result']);}
			if(isset($data_array['result_status'])){$this->db->set('result_status', $data_array['result_status']);}
			if(isset($data_array['invoice_status'])){$this->db->set('invoice_status', $data_array['invoice_status']);}
			if(isset($data_array['invoice_detail_id'])){$this->db->set('invoice_detail_id', $data_array['invoice_detail_id']);}
			if(isset($data_array['remarks'])){$this->db->set('remarks', $data_array['remarks']);}
			if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
			 // Perform db insert
			//echo $this->db->_compile_select();
			$this->db->insert('lab_order');
			//echo $this->db->last_query();
			//echo "<br />Inserted into lab_order";
		} //endif($data_array['has_lab'])
		
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_disease_notify($data_array)


    //************************************************************************
    /**
     * Method to insert New Case  
     *
     * This method creates a new case tying to a disease notification.
     *
	 * @param   array  $data_array      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_bio_case($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting case details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        */
        // Insert into bio_case
        if(isset($data_array['bio_case_id'])){$this->db->set('bio_case_id', $data_array['bio_case_id']);}
        if(isset($data_array['summary_id'])){$this->db->set('summary_id', $data_array['summary_id']);}
        if(isset($data_array['patient_id'])){$this->db->set('patient_id', $data_array['patient_id']);}
        if(isset($data_array['case_ref'])){$this->db->set('case_ref', $data_array['case_ref']);}
        if(isset($data_array['bio_phi_ref'])){$this->db->set('bio_phi_ref', $data_array['bio_phi_ref']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        if(isset($data_array['district_id'])){$this->db->set('district_id', $data_array['district_id']);}
        if(isset($data_array['case_location_isolation'])){$this->db->set('case_location_isolation', $data_array['case_location_isolation']);}
        if(isset($data_array['case_clinical_outcome'])){$this->db->set('case_clinical_outcome', $data_array['case_clinical_outcome']);}
        if(isset($data_array['case_disease_confirmed'])){$this->db->set('case_disease_confirmed', $data_array['case_disease_confirmed']);}
        if(isset($data_array['date_disease_confirmed'])){$this->db->set('date_disease_confirmed', $data_array['date_disease_confirmed']);}
        if(isset($data_array['gps_lat'])){$this->db->set('gps_lat', $data_array['gps_lat']);}
        if(isset($data_array['gps_long'])){$this->db->set('gps_long', $data_array['gps_long']);}
        if(isset($data_array['case_prior_movements'])){$this->db->set('case_prior_movements', $data_array['case_prior_movements']);}
        if(isset($data_array['case_findings'])){$this->db->set('case_findings', $data_array['case_findings']);}
        if(isset($data_array['case_outbreak_degree'])){$this->db->set('case_outbreak_degree', $data_array['case_outbreak_degree']);}
        if(isset($data_array['case_in_outbreak'])){$this->db->set('case_in_outbreak', $data_array['case_in_outbreak']);}
        if(isset($data_array['case_summary'])){$this->db->set('case_summary', $data_array['case_summary']);}
        if(isset($data_array['alert_max'])){$this->db->set('alert_max', $data_array['alert_max']);}
        if(isset($data_array['alert_now'])){$this->db->set('alert_now', $data_array['alert_now']);}
        if(isset($data_array['start_date'])){$this->db->set('start_date', $data_array['start_date']);}
        if(isset($data_array['end_date'])){$this->db->set('end_date', $data_array['end_date']);}
        if(isset($data_array['staff_start_id'])){$this->db->set('staff_start_id', $data_array['staff_start_id']);}
        if(isset($data_array['staff_end_id'])){$this->db->set('staff_end_id', $data_array['staff_end_id']);}
        if(isset($data_array['staff_close'])){$this->db->set('staff_close', $data_array['staff_close']);}
        if(isset($data_array['case_comments'])){$this->db->set('case_comments', $data_array['case_comments']);}
        if(isset($data_array['case_remarks'])){$this->db->set('case_remarks', $data_array['case_remarks']);}
        // Perform db insert
        $this->db->insert('bio_case');
        //echo $this->db->last_query();
        //echo "<br />Inserted into bio_case";

		// Insert into adt
        if(isset($data_array['discharged_date'])){
			$this->db->set('check_out_date', $data_array['discharged_date']);
			$this->db->set('check_out_time', "12:00:00");
			$this->db->set('check_out_staff', $data_array['staff_start_id']);
			$this->db->where('adt_id', $data_array['adt_id']);
			$this->db->update('adt');
			// Perform db insert
			//echo $this->db->last_query();
		}
        //echo "<br />Inserted into adt";

        /*
        echo "<br />Inserted new case";
        echo "<hr />";
        */
    } // end of function insert_bio_case($data_array)


    //************************************************************************
    /**
     * Method to insert New Investigation  
     *
     * This method creates a new investigation tying to a bio case.
     *
	 * @param   array  $data_array      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_bio_investigate($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        /*
        echo "<hr />";
        echo "Inserting case details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        */
        // Insert into bio_investigate
        if(isset($data_array['bio_inv_id'])){$this->db->set('bio_inv_id', $data_array['bio_inv_id']);}
        if(isset($data_array['bio_case_id'])){$this->db->set('bio_case_id', $data_array['bio_case_id']);}
        if(isset($data_array['inv_ref'])){$this->db->set('inv_ref', $data_array['inv_ref']);}
        if(isset($data_array['inv_main_name'])){$this->db->set('inv_main_name', $data_array['inv_main_name']);}
        if(isset($data_array['inv_main_relship'])){$this->db->set('inv_main_relship', $data_array['inv_main_relship']);}
        if(isset($data_array['inv_main_answer'])){$this->db->set('inv_main_answer', $data_array['inv_main_answer']);}
        if(isset($data_array['inv_main_remarks'])){$this->db->set('inv_main_remarks', $data_array['inv_main_remarks']);}
        if(isset($data_array['inv_main_age'])){$this->db->set('inv_main_age', $data_array['inv_main_age']);}
        if(isset($data_array['inv_main_contacttype'])){$this->db->set('inv_main_contacttype', $data_array['inv_main_contacttype']);}
        if(isset($data_array['inv_other_answer'])){$this->db->set('inv_other_answer', $data_array['inv_other_answer']);}
        if(isset($data_array['inv_other_remarks'])){$this->db->set('inv_other_remarks', $data_array['inv_other_remarks']);}
        if(isset($data_array['inv_cluster_size'])){$this->db->set('inv_cluster_size', $data_array['inv_cluster_size']);}
        if(isset($data_array['inv_findings'])){$this->db->set('inv_findings', $data_array['inv_findings']);}
        if(isset($data_array['inv_summary'])){$this->db->set('inv_summary', $data_array['inv_summary']);}
        if(isset($data_array['inv_comments'])){$this->db->set('inv_comments', $data_array['inv_comments']);}
        if(isset($data_array['inv_address1'])){$this->db->set('inv_address1', $data_array['inv_address1']);}
        if(isset($data_array['inv_address2'])){$this->db->set('inv_address2', $data_array['inv_address2']);}
        if(isset($data_array['inv_address3'])){$this->db->set('inv_address3', $data_array['inv_address3']);}
        if(isset($data_array['inv_postcode'])){$this->db->set('inv_postcode', $data_array['inv_postcode']);}
        if(isset($data_array['inv_town'])){$this->db->set('inv_town', $data_array['inv_town']);}
        if(isset($data_array['inv_state'])){$this->db->set('inv_state', $data_array['inv_state']);}
        if(isset($data_array['inv_tel'])){$this->db->set('inv_tel', $data_array['inv_tel']);}
        if(isset($data_array['inv_fax'])){$this->db->set('inv_fax', $data_array['inv_fax']);}
        if(isset($data_array['inv_email'])){$this->db->set('inv_email', $data_array['inv_email']);}
        if(isset($data_array['inv_gps_lat'])){$this->db->set('inv_gps_lat', $data_array['inv_gps_lat']);}
        if(isset($data_array['inv_gps_long'])){$this->db->set('inv_gps_long', $data_array['inv_gps_long']);}
        if(isset($data_array['inv_start_date'])){$this->db->set('inv_start_date', $data_array['inv_start_date']);}
        if(isset($data_array['inv_end_date'])){$this->db->set('inv_end_date', $data_array['inv_end_date']);}
        if(isset($data_array['staff_start_id'])){$this->db->set('staff_start_id', $data_array['staff_start_id']);}
        if(isset($data_array['staff_end_id'])){$this->db->set('staff_end_id', $data_array['staff_end_id']);}
        if(isset($data_array['inv_remarks'])){$this->db->set('inv_remarks', $data_array['inv_remarks']);}
        // Perform db insert
        $this->db->insert('bio_investigate');
        //echo $this->db->last_query();
        /*
        echo "<br />Inserted into bio_bio_investigate";
        echo "<br />Inserted new case";
        echo "<hr />";
        */
    } // end of function insert_bio_investigate($data_array)


    //************************************************************************
    /**
     * Method to insert New Pictures  
     *
     * This method creates a new picture tying to investigation
     *
	 * @param   array  $data_array      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_bio_pics($data_array)
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
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into bio_pics
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
        if(isset($data_array['bio_summary_id'])){$this->db->set('bio_summary_id', $data_array['bio_summary_id']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        $this->db->set('ip_uploaded', $_user_ip);
        if(isset($data_array['file_remarks'])){$this->db->set('file_remarks', $data_array['file_remarks']);}
        /*
        if(isset($data_array['bio_pics_id'])){$this->db->set('bio_pics_id', $data_array['bio_pics_id']);}
        if(isset($data_array['bio_inv_id'])){$this->db->set('bio_inv_id', $data_array['bio_inv_id']);}
        if(isset($data_array['bio_pic_ref'])){$this->db->set('bio_pic_ref', $data_array['bio_pic_ref']);}
        if(isset($data_array['bio_pic_title'])){$this->db->set('bio_pic_title', $data_array['bio_pic_title']);}
        if(isset($data_array['bio_pic_descr'])){$this->db->set('bio_pic_descr', $data_array['bio_pic_descr']);}
        if(isset($data_array['bio_pic_sort'])){$this->db->set('bio_pic_sort', $data_array['bio_pic_sort']);}
        if(isset($data_array['staff_id'])){$this->db->set('staff_id', $data_array['staff_id']);}
        if(isset($data_array['date_uploaded'])){$this->db->set('date_uploaded', $data_array['date_uploaded']);}
        if(isset($data_array['time_uploaded'])){$this->db->set('time_uploaded', $data_array['time_uploaded']);}
        if(isset($data_array['location_id'])){$this->db->set('location_id', $data_array['location_id']);}
        $this->db->set('ip_uploaded', $_user_ip);
        if(isset($data_array['pics_remarks'])){$this->db->set('pics_remarks', $data_array['pics_remarks']);}
        */
        // Perform db insert
        $this->db->insert('bio_file');
        //echo $this->db->last_query();
        /*
        echo "<br />Inserted into bio_pics";

        echo "<br />Inserted new pics";
        echo "<hr />";
        */
    } // end of function insert_bio_pics($data_array)



    //===============================================================
    // Update Database Methods
    //************************************************************************
    /**
     * Method to update Patient Information
     *
     * This method 
     *
	 * @param   data_array
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
        //print_r($data_array);
        echo "</pre>";
        $this->db->set('', $data_array['']);
        if(isset($diagnosis_item[''])){$this->db->set('', $diagnosis_item['']);}
        */
        $this->db->set('clinic_reference_number', $data_array['clinic_reference_number']);
        //$this->db->set('pns_pat_id', $data_array['pns_pat_id']);
        //$this->db->set('nhfa_no', $data_array['nhfa_no']);
        $this->db->set('name', $data_array['patient_name']);
        $this->db->set('name_first', $data_array['name_first']);
        $this->db->set('name_alias', $data_array['name_alias']);
        //$this->db->set('shortname', $data_array['shortname']);
        $this->db->set('gender', $data_array['gender']);
        $this->db->set('ic_no', $data_array['ic_no']);
        //$this->db->set('ic_other_type', $data_array['ic_other_type']);
        $this->db->set('ic_other_no', $data_array['ic_other_no']);
        $this->db->set('nationality', $data_array['nationality']);
        //$this->db->set('birth_date', $data_array['birth_date']);
        //$this->db->set('birth_cert_no', $data_array['birth_cert_no']);
        $this->db->set('family_link', $data_array['family_link']);
        $this->db->set('ethnicity', $data_array['ethnicity']);
        $this->db->set('religion', $data_array['religion']);
        //$this->db->set('marital_status', $data_array['marital_status']);
        //$this->db->set('married_date', $data_array['married_date']);
        //$this->db->set('spouse_id', $data_array['spouse_id']);
        //$this->db->set('spouse_name', $data_array['spouse_name']);
        //$this->db->set('company', $data_array['company']);
        //$this->db->set('employee_no', $data_array['employee_no']);
        //$this->db->set('job_function', $data_array['job_function']);
        //$this->db->set('job_industry', $data_array['job_industry']);
        //$this->db->set('patient_employment_id', $data_array['patient_employment_id']);
        //$this->db->set('family_income', $data_array['family_income']);
        //$this->db->set('education_level', $data_array['education_level']);
        $this->db->set('patient_type', $data_array['patient_type']);
        //$this->db->set('organdonor_no', $data_array['organdonor_no']);
        //$this->db->set('organdonor_status', $data_array['organdonor_status']);
        //$this->db->set('next_of_kin_id', $data_array['next_of_kin_id']);
        //$this->db->set('next_of_kin_name', $data_array['next_of_kin_name']);
        //$this->db->set('next_of_kin_relationship', $data_array['next_of_kin_relationship']);
        $this->db->set('blood_group', $data_array['blood_group']);
        $this->db->set('blood_rhesus', $data_array['blood_rhesus']);
        if(isset($diagnosis_item['demise_date'])){$this->db->set('demise_date', $diagnosis_item['demise_date']);}
        if(isset($diagnosis_item['demise_time'])){$this->db->set('demise_time', $diagnosis_item['demise_time']);}
        if(isset($diagnosis_item['death_cert'])){$this->db->set('death_cert', $diagnosis_item['death_cert']);}
        if(isset($diagnosis_item['demise_code'])){$this->db->set('demise_code', $diagnosis_item['demise_code']);}
        if(isset($diagnosis_item['demise_cause'])){$this->db->set('demise_cause', $diagnosis_item['demise_cause']);}
        //$this->db->set('demise_date', $data_array['demise_date']);
        //$this->db->set('demise_time', $data_array['demise_time']);
        //$this->db->set('death_cert', $data_array['death_cert']);
        //$this->db->set('demise_code', $data_array['demise_code']);
        //$this->db->set('demise_cause', $data_array['demise_cause']);
        $this->db->set('clinic_home', $data_array['clinic_home']);
        //$this->db->set('clinic_registered', $data_array['clinic_registered']);
        //$this->db->set('other', $data_array['other']);
        $this->db->set('status', $data_array['patient_status']);
        if(isset($diagnosis_item['remarks'])){$this->db->set('remarks', $diagnosis_item['remarks']);}
        //$this->db->set('remarks', $data_array['remarks']);
        //$this->db->set('referred_by', $data_array['referred_by']);
        //$this->db->set('referred_remarks', $data_array['referred_remarks']);
        //$this->db->set('patient_password', $data_array['patient_password']);
        //$this->db->set('share_level', $data_array['share_level']);
        $this->db->set('patient_demographic_info_1', $data_array['guardian_name']);
        $this->db->set('patient_demographic_info_2', $data_array['guardian_relation']);
        $this->db->where('patient_id', $data_array['patient_id']);
        $this->db->update('patient_demographic_info');
        //echo $this->db->last_query();
        echo "<br />Updated patient_demographic_info<br />";

        $this->db->set('contact_type', $data_array['contact_type']);
        //$this->db->set('start_date', $data_array['start_date']);
        //$this->db->set('end_date', $data_array['end_date']);
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
        if(isset($diagnosis_item['pager_no'])){$this->db->set('pager_no', $diagnosis_item['pager_no']);}
        if(isset($diagnosis_item['fax_no'])){$this->db->set('fax_no', $diagnosis_item['fax_no']);}
        //$this->db->set('pager_no', $data_array['pager_no']);
        //$this->db->set('fax_no', $data_array['fax_no']);
        $this->db->set('email', $data_array['email']);
        //$this->db->set('other', $data_array['other']);
        //$this->db->set('remarks', $data_array['remarks']);
        $this->db->set('addr_village_id', $data_array['addr_village_id']);
        $this->db->set('addr_town_id', $data_array['addr_town_id']);
        $this->db->set('addr_area_id', $data_array['addr_area_id']);
        $this->db->set('addr_district_id', $data_array['addr_district_id']);
        $this->db->set('addr_state_id', $data_array['addr_state_id']);
        $this->db->where('contact_id', $data_array['contact_id']);
        $this->db->update('patient_contact_info');
        //echo $this->db->last_query();
        echo "<br />Updated patient_contact_info<br />";
        echo "<hr />";
        
    } // end of function update_patient_info($data_array)


    //************************************************************************
    /**
     * Method to update Infectious Disease Notification
     *
     * This method 
     *
	 * @param   data_array  None      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_disease_notify($data_array)
    {
        //$data = array();
        //$data   = $data_array;
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        //print_r($data_array);
        echo "</pre>";
        $this->db->set('notify_date', $data_array['notify_date']);
        $this->db->set('started_date', $data_array['notify_started_date']);
        $this->db->set('comments', $data_array['notify_comments']);
        $this->db->set('notification_reference', $data_array['notify_ref']);
        $this->db->where('notification_id', $data_array['notification_id']);
        $this->db->update('patient_disease_notification');
        //echo $this->db->last_query();

		// Update adt
        if(isset($data_array['discharged_date'])){
			$this->db->set('check_out_date', $data_array['discharged_date']);
			$this->db->set('check_out_time', "12:00:00");
			$this->db->set('check_out_staff', $data_array['staff_id']);
			$this->db->where('adt_id', $data_array['adt_id']);
			$this->db->update('adt');
			// Perform db insert
			//echo $this->db->last_query();
		}
        //echo "<br />Updated adt";

		// Update patient_diagnosis
        if($data_array['dcode1ext_code_changed']){
			$this->db->set('dcode1ext_code', $data_array['dcode1ext_code']);
			$this->db->set('notes', $data_array['case_diagnosis_notes']);
			$this->db->where('diagnosis_id', $data_array['diagnosis_id']);
			$this->db->update('patient_diagnosis');
			// Perform db insert
			//echo $this->db->last_query();
		}
        //echo "<br />Updated patient_diagnosis";

	echo "Updated<br />";
        echo "<hr />";
    } // end of function update_disease_notify($data_array)


    //************************************************************************
    /**
     * Method to update case details
     *
     * This method 
     *
	 * @param   string  None      No parameter required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_case_details($case_array)
    {
        $data = array();
        //echo "<hr />";
        //echo "Updating form details";
        //echo "<pre>";
        //print_r($case_array);
        //echo "</pre>";
        if(isset($case_array['case_ref'])){$this->db->set('case_ref', $case_array['case_ref']);}
        if(isset($case_array['bio_phi_ref'])){$this->db->set('bio_phi_ref', $case_array['bio_phi_ref']);}
        if(isset($case_array['location_id'])){$this->db->set('location_id', $case_array['location_id']);}
        if(isset($case_array['case_location_isolation'])){$this->db->set('case_location_isolation', $case_array['case_location_isolation']);}
        if(isset($case_array['case_clinical_outcome'])){$this->db->set('case_clinical_outcome', $case_array['case_clinical_outcome']);}
        if(isset($case_array['case_disease_confirmed'])){$this->db->set('case_disease_confirmed', $case_array['case_disease_confirmed']);}
        if(isset($case_array['date_disease_confirmed'])){$this->db->set('date_disease_confirmed', $case_array['date_disease_confirmed']);}
        if(isset($case_array['gps_lat'])){$this->db->set('gps_lat', $case_array['gps_lat']);}
        if(isset($case_array['gps_long'])){$this->db->set('gps_lat', $case_array['gps_long']);}
        if(isset($case_array['case_prior_movements'])){$this->db->set('case_prior_movements', $case_array['case_prior_movements']);}
        if(isset($case_array['case_findings'])){$this->db->set('case_findings', $case_array['case_findings']);}
        if(isset($case_array['case_outbreak_degree'])){$this->db->set('case_outbreak_degree', $case_array['case_outbreak_degree']);}
        if(isset($case_array['case_in_outbreak'])){$this->db->set('case_in_outbreak', $case_array['case_in_outbreak']);}
        if(isset($case_array['case_summary'])){$this->db->set('case_summary', $case_array['case_summary']);}
        if(isset($case_array['case_conclusion'])){$this->db->set('case_conclusion', $case_array['case_conclusion']);}
        if(isset($case_array['alert_max'])){$this->db->set('alert_max', $case_array['alert_max']);}
        if(isset($case_array['alert_now'])){$this->db->set('alert_now', $case_array['alert_now']);}
        if(isset($case_array['end_date'])){$this->db->set('end_date', $case_array['end_date']);}
        if(isset($case_array['case_comments'])){$this->db->set('case_comments', $case_array['case_comments']);}
        $this->db->where('bio_case_id', $case_array['bio_case_id']);
        $this->db->update('bio_case');
        //echo $this->db->last_query();

		// Insert into adt
        if(isset($case_array['discharged_date'])){
			$this->db->set('check_out_date', $case_array['discharged_date']);
			$this->db->set('check_out_time', "12:00:00");
			$this->db->set('check_out_staff', $case_array['staff_id']);
			$this->db->where('adt_id', $case_array['adt_id']);
			$this->db->update('adt');
			// Perform db insert
			//echo $this->db->last_query();
		}
        //echo "<br />Inserted into adt";

		//echo "<br />Updated<br />";
        //echo "<hr />";
    } // end of function update_case_details($case_array)


    //************************************************************************
    /**
     * Method to update  
     *
     * This method 
     *
	 * @param   string  None      No parameter required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function update_investigate_details($inv_array)
    {
        $data = array();
        //echo "<hr />";
        //echo "Updating form details";
        //echo "<pre>";
        //print_r($inv_array);
        //echo "</pre>";
        if(isset($inv_array['inv_ref'])){$this->db->set('inv_ref', $inv_array['inv_ref']);}
        if(isset($inv_array['inv_main_name'])){$this->db->set('inv_main_name', $inv_array['inv_main_name']);}
        if(isset($inv_array['inv_main_relship'])){$this->db->set('inv_main_relship', $inv_array['inv_main_relship']);}
        if(isset($inv_array['inv_main_answer'])){$this->db->set('inv_main_answer', $inv_array['inv_main_answer']);}
        if(isset($inv_array['inv_main_remarks'])){$this->db->set('inv_main_remarks', $inv_array['inv_main_remarks']);}
        if(isset($inv_array['inv_main_age'])){$this->db->set('inv_main_age', $inv_array['inv_main_age']);}
        if(isset($inv_array['inv_main_contacttype'])){$this->db->set('inv_main_contacttype', $inv_array['inv_main_contacttype']);}
        if(isset($inv_array['inv_cluster_size'])){$this->db->set('inv_cluster_size', $inv_array['inv_cluster_size']);}
        if(isset($inv_array['inv_findings'])){$this->db->set('inv_findings', $inv_array['inv_findings']);}
        if(isset($inv_array['inv_summary'])){$this->db->set('inv_summary', $inv_array['inv_summary']);}
        if(isset($inv_array['inv_comments'])){$this->db->set('inv_comments', $inv_array['inv_comments']);}
        if(isset($inv_array['inv_address1'])){$this->db->set('inv_address1', $inv_array['inv_address1']);}
        if(isset($inv_array['inv_address2'])){$this->db->set('inv_address2', $inv_array['inv_address2']);}
        if(isset($inv_array['inv_address3'])){$this->db->set('inv_address3', $inv_array['inv_address3']);}
        if(isset($inv_array['inv_postcode'])){$this->db->set('inv_postcode', $inv_array['inv_postcode']);}
        if(isset($inv_array['inv_town'])){$this->db->set('inv_town', $inv_array['inv_town']);}
        if(isset($inv_array['inv_state'])){$this->db->set('inv_state', $inv_array['inv_state']);}
        if(isset($inv_array['inv_tel'])){$this->db->set('inv_tel', $inv_array['inv_tel']);}
        if(isset($inv_array['inv_fax'])){$this->db->set('inv_fax', $inv_array['inv_fax']);}
        if(isset($inv_array['inv_email'])){$this->db->set('inv_email', $inv_array['inv_email']);}
        if(isset($inv_array['inv_gps_lat'])){$this->db->set('inv_gps_lat', $inv_array['inv_gps_lat']);}
        if(isset($inv_array['inv_gps_long'])){$this->db->set('inv_gps_long', $inv_array['inv_gps_long']);}
        if(isset($inv_array['inv_end_date'])){$this->db->set('inv_end_date', $inv_array['inv_end_date']);}
        $this->db->where('bio_inv_id', $inv_array['bio_inv_id']);
        $this->db->update('bio_investigate');
        //echo $this->db->last_query();
        //echo "<br />Updated<br />";
        //echo "<hr />";
    } // end of function update_case_details($inv_array)

}
