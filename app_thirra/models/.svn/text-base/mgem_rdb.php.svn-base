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
 * Portions created by the Initial Developer are Copyright (C) 2009 - 2011
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Classes for GEM Module
 *
 *
 */

class MGem_rdb extends CI_Model{

    protected $_patient_name      =  "";
    protected $_patient_id      =  "";

    function __construct()
    {
        parent::__construct();

    }


    //************************************************************************
    /**
     * Method to retrieve list of submodules
     *
     * This method 
     *
	 * @param   string  call_from      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_submodules_list_simple($gem_module_id, $gem_submod_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT gsub.*, gmod.*";
        $sqlQuery   .=  " FROM gem_submodule gsub";
        $sqlQuery   .=  " JOIN gem_module gmod ON gsub.gem_module_id=gmod.gem_module_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND gsub.gem_module_id ='".$gem_module_id."'";
        if(isset($gem_submod_id)){
            $sqlQuery   .=  " AND gsub.gem_submod_id ='".$gem_submod_id."'";            
        }
        $sqlQuery   .=  " ORDER BY gsub.gem_submod_sort";
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
    } //end of function get_submodules_list_simple($gem_module_id, $gem_submod_id=NULL)



    //************************************************************************
    /**
     * Method to retrieve list of submodules
     *
     * This method 
     *
	 * @param   string  call_from      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_session_by_submodule($patient_id,$gem_submod_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT gsub.*, gses.*, gagr.gem_agename, ";
        $sqlQuery   .=  " pcon.summary_id, pcon.date_ended, pcon.time_ended, pcon.signed_by, sinf.staff_name";
        $sqlQuery   .=  " FROM gem_submodule gsub";
        $sqlQuery   .=  " LEFT OUTER JOIN gem_session gses ON gsub.gem_submod_id=gses.gem_submod_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary pcon ON gses.summary_id=pcon.summary_id";
        $sqlQuery   .=  " LEFT OUTER JOIN gem_agegroup gagr ON gses.gem_agegroup_id=gagr.gem_agegroup_id";
        $sqlQuery   .=  " LEFT OUTER JOIN staff_info sinf ON gses.staff_id=sinf.staff_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND gses.patient_id ='".$patient_id."'";
        if(isset($gem_submod_id)){
            $sqlQuery   .=  " AND gsub.gem_submod_id ='".$gem_submod_id."'";
        }
        $sqlQuery   .=  " ORDER BY pcon.date_ended DESC, pcon.time_ended DESC";
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
    } //end of function get_session_by_submodule($patient_id,$gem_submod_id=NULL)



   //************************************************************************
    /**
     * Method to retrieve list of submodules
     *
     * This method 
     *
	 * @param   string  call_from      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_submodules_list($gem_module_id=NULL, $summary_id=NULL, $gem_submod_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT gsub.*, gses.gem_session_id, gses.gem_agegroup_id";
        $sqlQuery   .=  " FROM gem_submodule gsub";
        $sqlQuery   .=  " LEFT OUTER JOIN (select * FROM gem_session";
        $sqlQuery   .=  "  WHERE summary_id ='".$summary_id."')";
        $sqlQuery   .=  " gses ON gsub.gem_submod_id=gses.gem_submod_id";
        $sqlQuery   .=  " WHERE 1=1";
        if(isset($gem_module_id)){
            $sqlQuery   .=  " AND gsub.gem_module_id = '".$gem_module_id."'";
        }
        //$sqlQuery   .=  " AND gsub.gem_module_id ='".$gem_module_id."'";
        if(isset($gem_submod_id)){
            $sqlQuery   .=  " AND gsub.gem_submod_id = '".$gem_submod_id."'";
        }
        $sqlQuery   .=  " ORDER BY";
        if(!isset($gem_module_id)){
            $sqlQuery   .=  " gsub.gem_module_id,";
        }
        $sqlQuery   .=  " gsub.gem_submod_sort";
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
    } //end of function get_submodules_list($call_from)



    //************************************************************************
    /**
     * Method to retrieve submodule info based on gem_submod_id
     *
     * This method 
     *
	 * @param   string  call_from      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_submodule_info($gem_submod_id, $summary_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT gsub.*, gmod.*, gses.gem_session_id";
        $sqlQuery   .=  " FROM gem_submodule gsub";
        $sqlQuery   .=  " JOIN gem_module gmod ON gsub.gem_module_id=gmod.gem_module_id";
        $sqlQuery   .=  " LEFT OUTER JOIN (select * FROM gem_session";
        $sqlQuery   .=  "  WHERE summary_id ='".$summary_id."') gses  ON gsub.gem_submod_id=gses.gem_submod_id";
        //$sqlQuery   .=  " LEFT OUTER JOIN gem_session gses ON gsub.gem_submod_id=gses.gem_submod_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND gsub.gem_submod_id = '".$gem_submod_id."'";
        $sqlQuery   .=  " ORDER BY gsub.gem_submod_sort";
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
    } //end of function get_submodule_info($gem_submod_id)



    //************************************************************************
    /**
     * Method to retrieve list of age bands
     *
     * This method 
     *
	 * @param   string  call_from      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_agebands_list($gem_ageset_id, $gem_agegroup_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM gem_agegroup ";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND gem_ageset_id ='".$gem_ageset_id."'";
        if(isset($gem_agegroup_id)){
            $sqlQuery   .=  " AND gem_agegroup_id ='".$gem_agegroup_id."'";
        }
        $sqlQuery   .=  " ORDER BY gem_age_min";
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
    } //end of function get_agebands_list($call_from)


    //************************************************************************
    /**
     * Method to retrieve submodule info based on gem_submod_id
     *
     * This method 
     *
	 * @param   string  call_from      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_form_content($gem_submod_id, $gem_age_min, $gem_age_max, $age_days, $gem_session_id=NULL)
    {
    //SELECT * FROM gem_question WHERE gem_submod_id='1234567899' AND gem_quest_showlower <= 456.00 AND gem_quest_showupper >= 456.00 ORDER BY gem_quest_sort         
        $data = array();
        $sqlQuery   =   "SELECT gque.*";
        if(isset($gem_session_id)){
            $sqlQuery   .=  " , gans.gem_conanswer, substring(gans.gem_modque FROM 11 FOR 10) as subst";
            $sqlQuery   .=  " FROM gem_question gque";
            $sqlQuery   .=  " LEFT OUTER JOIN gem_conanswer gans ON gque.gem_question_id=substring(gans.gem_modque FROM 11 FOR 10)";
            $sqlQuery   .=  " WHERE 1=1";
            $sqlQuery   .=  " AND gans.gem_session_id='".$gem_session_id."'";
        } else {
            $sqlQuery   .=  " , NULL as gem_conanswer, NULL AS subst";
            $sqlQuery   .=  " FROM gem_question gque";
            $sqlQuery   .=  " WHERE 1=1";
        }
        $sqlQuery   .=  " AND gque.gem_submod_id = '".$gem_submod_id."'";
        $sqlQuery   .=  " AND gque.gem_quest_showlower <= ".$gem_age_max;
        $sqlQuery   .=  " AND gque.gem_quest_showupper >= ".$gem_age_max;
        $sqlQuery   .=  " ORDER BY gque.gem_quest_sort";
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
    } //end of function get_form_content($gem_submod_id)


    //************************************************************************
    /**
     * Method to retrieve submodule info based on gem_submod_id
     *
     * This method 
     *
	 * @param   string  call_from      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_form_content_completed($gem_submod_id, $gem_session_id=NULL)
    {
    //SELECT * FROM gem_question WHERE gem_submod_id='1234567899' AND gem_quest_showlower <= 456.00 AND gem_quest_showupper >= 456.00 ORDER BY gem_quest_sort         
        $data = array();
        $sqlQuery   =   "SELECT gses.summary_id, gque.*, gagr.gem_agename";
        $sqlQuery   .=  " , gans.gem_conanswer, substring(gans.gem_modque FROM 11 FOR 10) as subst";
        $sqlQuery   .=  " FROM gem_question gque";
        $sqlQuery   .=  " LEFT OUTER JOIN gem_conanswer gans ON gque.gem_question_id=substring(gans.gem_modque FROM 11 FOR 10)";
        $sqlQuery   .=  " LEFT OUTER JOIN gem_session gses ON gans.gem_session_id=gses.gem_session_id";
        $sqlQuery   .=  " LEFT OUTER JOIN gem_agegroup gagr ON gses.gem_agegroup_id=gagr.gem_agegroup_id";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND gans.gem_session_id='".$gem_session_id."'";
        $sqlQuery   .=  " AND gque.gem_submod_id = '".$gem_submod_id."'";
        $sqlQuery   .=  " ORDER BY gque.gem_quest_sort";
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
    } //end of function get_form_content_completed($gem_submod_id)


    //************************************************************************
    /**
     * Method to retrieve list of multiple choices
     *
     * This method 
     *
	 * @param   string  call_from      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_multiple_choices($gem_question_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT gem_option.*";
        $sqlQuery   .=  " FROM gem_option";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND gem_question_id = '".$gem_question_id."'";
        $sqlQuery   .=  " ORDER BY gem_option_sort";
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
    } //end of function get_multiple_choices($gem_question_id)


    //************************************************************************
    /**
     * Method to retrieve list of multiple choices
     *
     * This method 
     *
	 * @param   string  call_from      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_lookup_choices($lookup_table, $lookup_column)
    {
        $data = array();
        $sqlQuery   =   "SELECT ".$lookup_column." AS gem_option_text";
        $sqlQuery   .=  " FROM ".$lookup_table;
        $sqlQuery   .=  " WHERE 1=1";
        //$sqlQuery   .=  " AND gem_question_id = '".$gem_question_id."'";
        $sqlQuery   .=  " ORDER BY ".$lookup_column;
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
    } //end of function get_lookup_choices($lookup_table, $lookup_column)


    //************************************************************************
    /**
     * Method to retrieve list of multiple choices
     *
     * This method 
     *
	 * @param   string  call_from      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_ehr_single($lookup_table, $lookup_column, $lookup_key, $gem_key)
    {
        $data = array();
        $sqlQuery   =   "SELECT ".$lookup_column." AS gem_option_text";
        $sqlQuery   .=  " FROM ".$lookup_table;
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND ".$lookup_key." = '".$gem_key."'";
        $sqlQuery   .=  " ORDER BY ".$lookup_column;
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
    } //end of function get_ehr_single($summary_id,$lookup_table, $lookup_column, $lookup_key, $gem_key)






 
 
}
