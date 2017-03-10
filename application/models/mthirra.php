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
 * Model Class for THIRRA
 *
 * This class is for models that only reads from the database.
 *
 * @version 0.9.14
 * @package THIRRA - THIRRA
 * @author  Jason Tan Boon Teck
 */

class MThirra extends CI_Model
{
    protected $_patient_id      =  "";
    protected $_summary_id      =  "";
    protected $_bio_case_id     =  "";

    function __construct()
    {
        parent::__construct();
    }


    /************************************************************************
     * Method to retrieve information for one user
     *
     *
	 * @param   string  $username      Required
	 * @param   string  $password      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_one_user_clinic($username,$location_id){
        $data = array();
        //$options = array('username' => $username);
        //$Q = $this->db->get_where('system_user',$options,1);
        $sqlQuery   =   "SELECT suser.*, clst.sysclinic_staff_remarks";
        $sqlQuery   .=  " FROM system_user suser, system_clinic_staff clst";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND suser.username='".$username."'";
        $sqlQuery   .=  " AND clst.clinic_info_id='".$location_id."'";
        $sqlQuery   .=  " AND suser.user_id=clst.user_id";
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }
        $Q->free_result();    
        
        return $data;    
    } //end of function get_user_clinics($username,$location_id)


   /************************************************************************
     * Method to retrieve information for one user
     *
     *
	 * @param   string  $username      Required
	 * @param   string  $password      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_user_info($username,$password=NULL){
        $data = array();
        //$options = array('username' => $username);
        //$Q = $this->db->get_where('system_user',$options,1);
        $sqlQuery   =   "SELECT suser.*, clst.sysclinic_staff_remarks";
        $sqlQuery   .=  " FROM system_user suser, system_clinic_staff clst";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND suser.username='".$username."'";
        $sqlQuery   .=  " AND suser.user_id=clst.user_id";
        $Q =  $this->db->query($sqlQuery);
        echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }
        $Q->free_result();    
        
        return $data;    
    } //end of function get_user_info($username,$password)


    /************************************************************************
     * Method to retrieve access rights for one user
     *
     * This method breaks down the ACL string into sections
     *
	 * @param   string  $username      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_user_rights($username){
        $data = array();
        $sqlQuery   =   "SELECT scat.*";
        $sqlQuery   .=  " FROM system_user_category scat, system_user suser";
        $sqlQuery   .=  " WHERE suser.category_id=scat.category_id";
        $sqlQuery   .=  " AND suser.username='".$username."'";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //reset($query);
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }
        $Q->free_result();   
        $data['section_patients']   =   0;  
        $data['section_pharmacy']   =   0;  
        $data['section_orders']     =   0;  
        $data['section_queue']      =   0;  
        $data['section_reports']    =   0;  
        $data['section_utilities']  =   0;  
        $data['section_admin']      =   0;  
        $data['section_total']      =   0;  
        //$data['permission']     =   261;
        // Converts ACL string into binary.
        $data['binary']             =   decbin($data['permission']);
        // Dashboard section
        if(strlen($data['binary']) > 9){
            $data['place10']                   =   substr($data['binary'],-10,1);
            if($data['place10'] == "1"){
                //$data['section_dashboard']   =   100;  
            }
        }        
        $data['section_total']++;
        // Utilities Section
        if(strlen($data['binary']) > 8){
            $data['place9']                   =   substr($data['binary'],-9,1);
            if($data['place9'] == "1"){
                $data['section_utilities']      =   100;  
            }
        }
        $data['section_total']++;
        // Billings Section
        if(strlen($data['binary']) > 7){
            $data['place8']                   =   substr($data['binary'],-8,1);
            if($data['place8'] == "1"){
                $data['section_billing']      =   100;  
            }
        }
        $data['section_total']++;
        // Finance Section
        if(strlen($data['binary']) > 6){
            $data['place7']                   =   substr($data['binary'],-7,1);
            if($data['place7'] == "1"){
                $data['section_finance']      =   100;  
            }
        }
        $data['section_total']++;
        // Queue Section
        if(strlen($data['binary']) > 5){
            $data['place6']                   =   substr($data['binary'],-6,1);
            if($data['place6'] == "1"){
                $data['section_queue']      =   100;  
            }
        }
        $data['section_total']++;
        // Patients Section
        if(strlen($data['binary']) > 4){
            $data['place5']                   =   substr($data['binary'],-5,1);
            if($data['place5'] == "1"){
                $data['section_patients']      =   100;  
            }
        }
        $data['section_total']++;
        // Orders Section
        if(strlen($data['binary']) > 3){
            $data['place4']                   =   substr($data['binary'],-4,1);
            if($data['place4'] == "1"){
                $data['section_orders']      =   100;  
            }
        }
        $data['section_total']++;
        // Pharmacy Section
        if(strlen($data['binary']) > 2){
            $data['place3']                   =   substr($data['binary'],-3,1);
            if($data['place3'] == "1"){
                $data['section_pharmacy']      =   100;  
            }
        }
        $data['section_total']++;
        // Reports Section
        if(strlen($data['binary']) > 1){
            $data['place2']                   =   substr($data['binary'],-2,1);
            if($data['place2'] == "1"){
                $data['section_reports']      =   100;  
            }
        $data['section_total']++;
        // Admin Section
        }
        if(strlen($data['binary']) > 0){
            $data['place1']                   =   substr($data['binary'],-1,1);
            if($data['place1'] == "1"){
                $data['section_admin']      =   100;  
            }
        }
        $data['section_total']++;
        return $data;    
    } //end of function get_user_rights($username)


    /************************************************************************
     * Method to retrieve ACL information for one user
     *
     *
	 * @param   string  $username      Required
	 * @param   string  $password      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_user_acl($category_id,$syssection_level=NULL,$syssection_layout=NULL){
        $dataset = array();
        $sqlQuery   =   "SELECT ssec.*,";
        $sqlQuery   .=  " sacl.acl_id,sacl.category_id,sacl.rights_single,sacl.rights_multi,sacl.acl_remarks";
        $sqlQuery   .=  " FROM system_section ssec";
        $sqlQuery   .=  " LEFT OUTER JOIN system_acl sacl ON ssec.syssection_id=sacl.syssection_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND sacl.category_id='".$category_id."'";
        $sqlQuery   .=  " AND ssec.syssection_level='".$syssection_level."'";
        $sqlQuery   .=  " AND ssec.syssection_layout='".$syssection_layout."'";
        $sqlQuery   .=  " ORDER BY ssec.syssection_sort";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $dataset[] = $row;
            }
        }    
        return $dataset;    
    } //end of function get_user_info($username,$password)


    /************************************************************************
     * Method to retrieve information for current clinic
     *
     *
	 * @param   string  $location_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_clinic_info($location_id){
        $data = array();
        $options = array('clinic_info_id' => $location_id);
        $Q = $this->db->get_where('clinic_info',$options,1);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_clinic_info($location_id)


    /************************************************************************
     * Method to retrieve list of clinics
     *
     * This method 
     *
	 * @param   string  $country      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_clinics_list($country, $sort_order="sort_clinic", $offline_mode=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT clinic_info_id, clinic_name, clinic_ref_no, clinic_shortname, sort_clinic, country, state, remarks";
        $sqlQuery   .=  " FROM clinic_info";
        if(strtoupper($country) <> "ALL") {
            //$options = array('country' => $country);
			$sqlQuery   .=  " WHERE country='".$country."'";
			if($offline_mode){
				$sqlQuery   .=  " AND clinic_type = 'Mobile'";					
			}
        } else {
			// Don't restrict by country - Demo
        } //end if(isset($country)
        $sqlQuery   .=  " ORDER BY ".$sort_order.",sort_clinic";
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
     * Method to insert New system_log  
     *
     * This method creates a new row.
     *
	 * @param   array  data_array      Required   
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function insert_new_login($data_array)
    {
        /*
        echo "<hr />";
        echo "Inserting system_log details";
        echo "<pre>";
        print_r($data_array);
        echo "</pre>";
        if(isset($data_array[''])){$this->db->set('', $data_array['']);}
        */
        // Insert into system_log
        if(isset($data_array['log_id'])){$this->db->set('log_id', $data_array['log_id']);}
        if(isset($data_array['date'])){$this->db->set('date', $data_array['date']);}
        if(isset($data_array['user_id'])){$this->db->set('user_id', $data_array['user_id']);}
        if(isset($data_array['login_time'])){$this->db->set('login_time', $data_array['login_time']);}
        if(isset($data_array['logout_time'])){$this->db->set('logout_time', $data_array['logout_time']);}
        if(isset($data_array['login_location'])){$this->db->set('login_location', $data_array['login_location']);}
        if(isset($data_array['login_ip'])){$this->db->set('login_ip', $data_array['login_ip']);}
        if(isset($data_array['webbrowser'])){$this->db->set('webbrowser', $data_array['webbrowser']);}
        if(isset($data_array['synch_in'])){$this->db->set('synch_in', $data_array['synch_in']);}
        if(isset($data_array['synch_out'])){$this->db->set('synch_out', $data_array['synch_out']);}
        if(isset($data_array['synch_remarks'])){$this->db->set('synch_remarks', $data_array['synch_remarks']);}
        if(isset($data_array['log_outcome'])){$this->db->set('log_outcome', $data_array['log_outcome']);}
         // Perform db insert
        //echo $this->db->_compile_select();
        $this->db->insert('system_log');
        //echo $this->db->last_query();
        //echo "<br />Inserted into system_log";
        //echo "Inserted<br />";
        //echo "<hr />";
    } // end of function insert_new_login($data_array)



    // Update Database Methods
    /************************************************************************
     * Method to update  // DEPRECATE
     *
     * This method 
     *
	 * @param   string  None      No parameter required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function updateCaseDetails($case_array)
    {
        $data = array();
        echo "<hr />";
        echo "Updating form details";
        echo "<pre>";
        //print_r($case_array);
        echo "</pre>";
        echo "Saved<br />";
        echo "<hr />";
    } // end of function updateCaseDetails($case_array)
 
}
