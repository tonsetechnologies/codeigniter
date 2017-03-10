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
 * @package THIRRA - mUtil-Rdb
 * @author  Jason Tan Boon Teck
 */

class MUtil_rdb extends CI_Model
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
    function get_addr_village_list($country='All',$sort_order="addr_village_sort",$village_id=NULL,$town_id=NULL,$area_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT avil.*,";
        $sqlQuery   .=  " atow.addr_town_name, aare.addr_area_name,";
        $sqlQuery   .=  " adis.addr_district_name, adis.addr_district_id, adis.addr_district_name, adis.addr_district_state, adis.addr_district_country, adis.addr_state_id";
        $sqlQuery   .=  " FROM addr_village avil";
        $sqlQuery   .=  " LEFT OUTER JOIN addr_town atow ON avil.addr_town_id=atow.addr_town_id";
        $sqlQuery   .=  " JOIN addr_area aare ON avil.addr_area_id=aare.addr_area_id";
        $sqlQuery   .=  " JOIN addr_district adis ON aare.addr_district_id=adis.addr_district_id";
		if(strtoupper($country) <> "ALL"){
			$sqlQuery   .=  " WHERE addr_district_country ILIKE '".$country."'";
		} else {
			$sqlQuery   .=  " WHERE addr_district_country ILIKE '%'";
		}
		if(isset($village_id)){
			$sqlQuery   .=  " AND addr_village_id='".$village_id."'";
		}
		if(isset($town_id)){
			$sqlQuery   .=  " AND avil.addr_town_id='".$town_id."'";
		}
		if(isset($area_id)){
			$sqlQuery   .=  " AND avil.addr_area_id='".$area_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",avil.addr_village_sort";
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
    } //end of function get_addr_village_list($location_id=NULL,$category=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of geographical towns
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_addr_town_list($country='All',$sort_order="addr_town_sort",$town_id=NULL,$area_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT atow.*,";
        $sqlQuery   .=  " aare.addr_area_name,";
        $sqlQuery   .=  " adis.addr_district_name, adis.addr_district_state, adis.addr_district_country";
        $sqlQuery   .=  " FROM addr_town atow";
        $sqlQuery   .=  " JOIN addr_area aare ON atow.addr_area_id=aare.addr_area_id";
        $sqlQuery   .=  " JOIN addr_district adis ON aare.addr_district_id=adis.addr_district_id";
        $sqlQuery   .=  " WHERE 1=1";
		if($country <> "All"){
			$sqlQuery   .=  " AND addr_district_country ILIKE '".$country."'";
		}
		if(isset($town_id)){
			$sqlQuery   .=  " AND addr_town_id='".$town_id."'";
		}
		if(isset($area_id)){
			$sqlQuery   .=  " AND atow.addr_area_id='".$area_id."'";
			$sqlQuery   .=  " AND atow.addr_area_id='".$area_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",atow.addr_town_sort";
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
    } //end of function get_addr_town_list($country_id='All',$town_id=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of geographical areas
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_addr_area_list($country='All',$sort_order="addr_area_sort",$area_id=NULL,$district_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT aare.*,";
        $sqlQuery   .=  " adis.addr_district_name, astt.addr_state_name, astt.addr_state_country";
        $sqlQuery   .=  " FROM addr_area aare";
        $sqlQuery   .=  " JOIN addr_district adis ON aare.addr_district_id=adis.addr_district_id";
        $sqlQuery   .=  " JOIN addr_state astt ON adis.addr_state_id=astt.addr_state_id";
		if(strtoupper($country) <> "ALL"){
			$sqlQuery   .=  " WHERE addr_district_country ILIKE '".$country."'";
		} else {
			$sqlQuery   .=  " WHERE addr_district_country ILIKE '%'";
		}
		if(isset($area_id)){
			$sqlQuery   .=  " AND addr_area_id='".$area_id."'";
		}
		if(isset($district_id)){
			$sqlQuery   .=  " AND aare.addr_district_id='".$district_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",aare.addr_area_sort";
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
		
    } //end of function get_addr_area_list($country_id='All',$area_id=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of geographical districts
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_addr_district_list($country='All',$sort_order='adis.addr_district_sort',$state_id=NULL,$district_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT adis.*,";
        $sqlQuery   .=  " astt.addr_state_name, astt.addr_state_country";
        $sqlQuery   .=  " FROM addr_district adis";
        $sqlQuery   .=  " JOIN addr_state astt ON adis.addr_state_id=astt.addr_state_id";
        $sqlQuery   .=  " WHERE 1=1";
		if($country <> "All"){
			$sqlQuery   .=  " AND addr_district_country ILIKE '".$country."'";
		}
		if(isset($state_id)){
			$sqlQuery   .=  " AND adis.addr_state_id='".$state_id."'";
		}
		if(isset($district_id)){
			$sqlQuery   .=  " AND addr_district_id='".$district_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",adis.addr_district_sort";
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
		
    } //end of function get_addr_district_list($country_id='All',$district_id=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of geographical states
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_addr_state_list($country='All',$sort_order="addr_state_sort",$state_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT astt.*";
        $sqlQuery   .=  " FROM addr_state astt";
        $sqlQuery   .=  " WHERE 1=1";
		if($country <> 'All'){
			$sqlQuery   .=  " AND addr_state_country ILIKE '".$country."'";
		}
		if(isset($state_id)){
			$sqlQuery   .=  " AND addr_state_id='".$state_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",astt.addr_state_sort";
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
		
    } //end of function get_addr_state_list($country_id='All',$state_id=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of geographical countries
     *
     * This method 
     *
	 * @param   none
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_addr_country_list($country_id='All',$sort_order="addr_state_sort")
    {
        $data = array();
        $data[0]['addr_country_name']   =   "India";
        $data[1]['addr_country_name']   =   "Malaysia";
        $data[2]['addr_country_name']   =   "Nepal";
        $data[3]['addr_country_name']   =   "Philippines";
        $data[4]['addr_country_name']   =   "Sri Lanka";
        
        return $data;    
		
    } //end of function get_addr_state_list($country_id='All',$state_id=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of drug formularies
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_complaint_codes_list($expect='data',$sort_order="full_description",$per_page="ALL",$row_first=0,$icpc_code=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT isym.*";
        $sqlQuery   .=  " FROM icpc2_symptom isym";
        $sqlQuery   .=  " WHERE 1=1";
		if(isset($icpc_code)){
			$sqlQuery   .=  " AND icpc_code='".$icpc_code."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",isym.icpc_code";
        $sqlQuery   .=  " LIMIT ".$per_page." OFFSET ".$row_first;
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        $num_rows = $Q->num_rows(); 
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $dataset[] = $row;
            }
        }
        $Q->free_result();    
        if($expect == 'data'){
            return $dataset; 
        } else {
            return $num_rows;
        }
    } //end of function get_complaint_codes_list($location_id=NULL,$category=NULL)


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


    //************************************************************************
    /**
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
        if($chapter == "All"){
            // Select all
            $Q = $this->db->get('dcode1');
        } else {
            $Q = $this->db->get_where('dcode1',$options);
        }
        //echo "<br />".$this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_dcode1_by_chapter($chapter)


    //************************************************************************
    /**
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


    //************************************************************************
    /**
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


	//************************************************************************
    /**
     * Method to retrieve list of drug formularies
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_diagnosis_toplevel_list($expect='data',$sort_order="dcode1_code",$per_page="ALL",$row_first=0,$dcode1_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT dcod.*";
        $sqlQuery   .=  " FROM dcode1 dcod";
        $sqlQuery   .=  " WHERE 1=1";
		if(isset($dcode1_id)){
			$sqlQuery   .=  " AND dcode1_id='".$dcode1_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",dcod.dcode1_code";
        $sqlQuery   .=  " LIMIT ".$per_page." OFFSET ".$row_first;
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        $num_rows = $Q->num_rows(); 
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $dataset[] = $row;
            }
        }
        $Q->free_result();    
        if($expect == 'data'){
            return $dataset; 
        } else {
            return $num_rows;
        }
    } //end of function get_diagnosis_toplevel_list($location_id=NULL,$category=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of extended diagnosis
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_diagnosis_ext_list($expect='data',$sort_order="formulary_code",$per_page="ALL",$row_first=0,$dcode1_id=NULL,$dcode1ext_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT dcod.*";
        $sqlQuery   .=  " FROM dcode1ext dcod";
        $sqlQuery   .=  " WHERE 1=1";
		if(isset($dcode1_id)){
			$sqlQuery   .=  " AND dcod.dcode1_id='".$dcode1_id."'";
		}
		if(isset($dcode1ext_id)){
			$sqlQuery   .=  " AND dcod.dcode1ext_id='".$dcode1ext_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",dcod.dcode1ext_code";
        $sqlQuery   .=  " LIMIT ".$per_page." OFFSET ".$row_first;
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        $num_rows = $Q->num_rows(); 
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $dataset[] = $row;
            }
        }
        $Q->free_result();    
        if($expect == 'data'){
            return $dataset; 
        } else {
            return $num_rows;
        }
    } //end of function get_diagnosis_ext_list($location_id=NULL,$category=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of ATC drug codes
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drugatc_codes_list($expect='data',$sort_order="atc_code",$per_page="ALL",$row_first=0,$atc_code=NULL,$atc_chemical=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT atc.*";
        $sqlQuery   .=  " FROM drug_atc atc";
        $sqlQuery   .=  " WHERE 1=1";
		if(isset($atc_code)){
			$sqlQuery   .=  " AND atc_code='".$atc_code."'";
		}
 		if(isset($atc_chemical)){
			$sqlQuery   .=  " AND atc_chemical='".$atc_chemical."'";
		}
       $sqlQuery   .=  " ORDER BY ".$sort_order.",atc.atc_code";
        $sqlQuery   .=  " LIMIT ".$per_page." OFFSET ".$row_first;
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        $num_rows = $Q->num_rows(); 
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $dataset[] = $row;
            }
        }
        $Q->free_result();    
        if($expect == 'data'){
            return $dataset; 
        } else {
            return $num_rows;
        }
    } //end of function get_drugatc_codes_list($location_id=NULL,$category=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of ATC drug codes
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drugatc_chemical_list($expect='data',$sort_order="atc_chemical",$per_page="ALL",$row_first=0,$atc_chemical=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT DISTINCT ON (atc_chemical) atc_anatomical, atc_therapeutic, atc_pharmaco, atc_chemical,
                            desc_anatomical, desc_therapeutic, desc_pharmaco, desc_chemical";
        $sqlQuery   .=  " FROM drug_atc atc";
        $sqlQuery   .=  " WHERE 1=1";
		if(isset($atc_chemical)){
			$sqlQuery   .=  " AND atc_chemical='".$atc_chemical."'";
		}
        $sqlQuery   .=  " ORDER BY atc.atc_chemical";
        $sqlQuery   .=  " LIMIT ".$per_page." OFFSET ".$row_first;
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        $num_rows = $Q->num_rows(); 
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $dataset[] = $row;
            }
        }
        $Q->free_result();    
        if($expect == 'data'){
            return $dataset; 
        } else {
            return $num_rows;
        }
    } //end of function get_drugatc_chemical_list($location_id=NULL,$category=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of drug formularies
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drug_formulary_list($expect='data',$sort_order="formulary_code",$per_page="ALL",$row_first=0,$drug_formulary_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT dfor.*";
        $sqlQuery   .=  " FROM drug_formulary dfor";
        $sqlQuery   .=  " WHERE 1=1";
		if(isset($drug_formulary_id)){
			$sqlQuery   .=  " AND drug_formulary_id='".$drug_formulary_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",dfor.formulary_code";
        $sqlQuery   .=  " LIMIT ".$per_page." OFFSET ".$row_first;
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        $num_rows = $Q->num_rows(); 
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $dataset[] = $row;
            }
        }
        $Q->free_result();    
        if($expect == 'data'){
            return $dataset; 
        } else {
            return $num_rows;
        }
    } //end of function get_drug_formulary_list($location_id=NULL,$category=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of drug formularies system
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drug_formulary_system($sort_order="formulary_code",$per_page="ALL",$row_first=0,$drug_formulary_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT DISTINCT dfor.formulary_system";
        $sqlQuery   .=  " FROM drug_formulary dfor";
        $sqlQuery   .=  " WHERE 1=1";
		if(isset($drug_formulary_id)){
			$sqlQuery   .=  " AND drug_formulary_id='".$drug_formulary_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",dfor.formulary_system";
        $sqlQuery   .=  " LIMIT ".$per_page." OFFSET ".$row_first;
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        $num_rows = $Q->num_rows(); 
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $dataset[] = $row;
            }
        }
        $Q->free_result();    
        return $dataset; 
    } //end of function get_drug_formulary_system($location_id=NULL,$category=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of drug formularies
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drug_code_list($expect='data',$sort_order="drug_code",$per_page="ALL",$row_first=0,$drug_code_id=NULL,$drug_formulary_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT dfor.*";
        $sqlQuery   .=  " FROM drug_code dfor";
        $sqlQuery   .=  " WHERE 1=1";
		if(isset($drug_code_id)){
			$sqlQuery   .=  " AND drug_code_id='".$drug_code_id."'";
		}
		if(isset($drug_formulary_id)){
			$sqlQuery   .=  " AND drug_formulary_id='".$drug_formulary_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",dfor.drug_code";
        $sqlQuery   .=  " LIMIT ".$per_page." OFFSET ".$row_first;
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        $num_rows = $Q->num_rows(); 
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $dataset[] = $row;
            }
        }
        $Q->free_result();    
        if($expect == 'data'){
            return $dataset; 
        } else {
            return $num_rows;
        }
    } //end of function get_drug_code_list($location_id=NULL,$category=NULL)


	//************************************************************************
    /**
     * Method to retrieve list of immunisations
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_immunisation_codes_list($expect='data',$sort_order="immunisation_sort",$per_page="ALL",$row_first=0,$immunisation_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT immu.*";
        $sqlQuery   .=  " FROM immunisation immu";
        $sqlQuery   .=  " WHERE 1=1";
		if(isset($immunisation_id)){
			$sqlQuery   .=  " AND immunisation_id='".$immunisation_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",immu.immunisation_sort";
        $sqlQuery   .=  " LIMIT ".$per_page." OFFSET ".$row_first;
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo "<br />".$this->db->last_query();
        $num_rows = $Q->num_rows(); 
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $dataset[] = $row;
            }
        }
        $Q->free_result();    
        if($expect == 'data'){
            return $dataset; 
        } else {
            return $num_rows;
        }
    } //end of function get_immunisation_codes_list($location_id=NULL,$category=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of pending prescriptions
     *
     * This method 
     *
	 * @param   string  $formulary_code      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_immunisation_same_name($vaccine)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM immunisation";
        $sqlQuery   .=  " WHERE 1=1";
        $sqlQuery   .=  " AND immunisation.vaccine ='".$vaccine."'";
        $sqlQuery   .=  " ORDER BY immunisation_sort";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }
        $Q->free_result();    
        return $data;    
    } //end of function get_immunisation_same_name()


	//************************************************************************
    /**
     * Method to retrieve list of education levels
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_education_levels()
    {
        $dataset = array();
        $dataset[0]['institution'] =   "None";
        $dataset[1]['institution'] =   "Primary school";
        $dataset[2]['institution'] =   "Scondary school";
        $dataset[3]['institution'] =   "High school";
        $dataset[4]['institution'] =   "Vocational training";
        $dataset[5]['institution'] =   "College";
        $dataset[6]['institution'] =   "Bachelors Degree";
        $dataset[7]['institution'] =   "Masters Degree";
        $dataset[8]['institution'] =   "Doctoral Degree";
        $dataset[9]['institution'] =   "Medical Degree";
        return $dataset; 
    } //end of function get_education_levels()


	//************************************************************************
    /**
     * Method to retrieve list of drug packing forms
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_package_forms()
    {
        $dataset = array();
        $dataset[0] =   "tablet(s)";
        $dataset[1] =   "capsule(s)";
        $dataset[2] =   "ml";
        $dataset[3] =   "g";
        $dataset[4] =   "amps";
        $dataset[5] =   "vial(s)";
        $dataset[6] =   "suppository";
        $dataset[7] =   "pessary";
        $dataset[8] =   "caplet(s)";
        return $dataset; 
    } //end of function get_package_forms()


	//************************************************************************
    /**
     * Method to retrieve list of prescribe frequency
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_drug_frequency()
    {
        $dataset = array();
        $dataset[0] =   "bid (twice daily)";
        $dataset[1] =   "od (once daily)";
        $dataset[2] =   "om (every morning)";
        $dataset[3] =   "on (every night)";
        $dataset[4] =   "prn (as needed)";
        $dataset[5] =   "tds (three times a day)";
        $dataset[6] =   "qid (four times a day)";
        $dataset[7] =   "5 times a day";
        $dataset[8] =   "6 times a day";
        $dataset[9] =   "stat";
        $dataset[10] =   "Q4H";
        $dataset[11] =   "Q5H";
        $dataset[12] =   "Q6H";
        $dataset[13] =   "Q8H";
        $dataset[14] =   "Q12H";
        return $dataset; 
    } //end of function get_drug_frequency()


	//************************************************************************
    /**
     * Method to retrieve list of vaccine doses
     *
     * This method 
     *
	 * @param   string  $category      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_vaccine_doses()
    {
        $dataset = array();
        $dataset[0] =   " ";
        $dataset[1] =   "1st Dose";
        $dataset[2] =   "2nd Dose";
        $dataset[3] =   "3rd Dose";
        $dataset[4] =   "1st Booster";
        $dataset[5] =   "2nd Booster";
        $dataset[6] =   "3rd Booster";
        return $dataset; 
    } //end of function get_vaccine_doses()


}

/* End of file mutil_rdb.php */
/* Location: ./app_thirra/models/mutil_rdb.php */
