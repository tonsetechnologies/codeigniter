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
 * Portions created by the Initial Developer are Copyright (C) 2012
 * the Initial Developer and IDRC. All Rights Reserved.
 *
 * ***** END LICENSE BLOCK ***** */

/**
 * Model Class for MConsult_procedure_rdb
 *
 * This class is for models that only reads from the database.
 *
 * @version 0.9.15
 * @package THIRRA - MAntenatal_rdb
 * @author  Jason Tan Boon Teck
 */

class MOrders_procedure_rdb extends CI_Model
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
    /**
     * Method to retrieve details for last antenatal event.
     *
     * 
     *
	 * @param   string  $summary_id      Required
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_procedure_categories()
    {
        $data = array();
        $sqlQuery   =   "SELECT DISTINCT pcode_category";
        $sqlQuery   .=  " FROM pcode1";
        $sqlQuery   .=  " ORDER BY pcode_category";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_procedure_categories($patient_id)


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
    function get_proceduregroups_by_category($category)
    {
        $data = array();
        $sqlQuery   =   "SELECT pcode1_id,pcode1_code,full_title,short_title,description,commonly_used";
        $sqlQuery   .=  " FROM pcode1";
        $sqlQuery   .=  " where pcode_category='".$category."'";
        $sqlQuery   .=  " ORDER BY pcode_category";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_proceduregroups_by_category($patient_id)


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
    function get_procedures_by_group($pcode1_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT pcode1ext_id,pcode1ext_code,pcode1ext_longname,pcode1ext_shortname,description,commonly_used";
        $sqlQuery   .=  " FROM pcode1ext";
        $sqlQuery   .=  " where pcode1_id='".$pcode1_id."'";
        $sqlQuery   .=  " ORDER BY pcode1ext_longname";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_procedures_by_group($patient_id)


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
    function get_products_by_procedure($pcode1ext_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT pprd.*, psup.acc_no";
        $sqlQuery   .=  " FROM procedure_product pprd";
        $sqlQuery   .=  " JOIN procedure_supplier psup ON pprd.supplier_id=psup.supplier_id";
        $sqlQuery   .=  " where pcode1ext_id='".$pcode1ext_id."'";
        $sqlQuery   .=  " ORDER BY product_name";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_products_by_procedure($patient_id)


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
    function get_pcode1ext_details($pcode1ext_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT *";
        $sqlQuery   .=  " FROM pcode1ext";
        $sqlQuery   .=  " where pcode1ext_id='".$pcode1ext_id."'";
        //$sqlQuery   .=  " ORDER BY pcode1ext_longname";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_pcode1ext_details($patient_id)


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
    function get_procorder_details($order_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT pord.*,";
        $sqlQuery   .=  " pext.pcode1_id,pext.pcode1ext_longname, pext.pcode1ext_shortname,pext.pcode_category";
        $sqlQuery   .=  " FROM procedure_order pord";
        $sqlQuery   .=  " JOIN pcode1ext pext ON pord.pcode1ext_id=pext.pcode1ext_id";
        $sqlQuery   .=  " WHERE pord.order_id='".$order_id."'";
        //$sqlQuery   .=  " ORDER BY pcode1ext_longname";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            $data = $Q->row_array();
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_procedures_by_group($patient_id)


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
    function get_patcon_procedures($summary_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT pord.*, pext.pcode1ext_longname, psup.supplier_name,";
        $sqlQuery   .=  " pprd.product_name,pprd.product_code,pprd.prod_description,pprd.seller_code";
        $sqlQuery   .=  " FROM procedure_order pord";
        $sqlQuery   .=  " JOIN pcode1ext pext ON pord.pcode1ext_id=pext.pcode1ext_id";
        $sqlQuery   .=  " LEFT OUTER JOIN procedure_product pprd ON pord.product_id=pprd.product_id";
        $sqlQuery   .=  " LEFT OUTER JOIN procedure_supplier psup ON pprd.supplier_id=psup.supplier_id";
        $sqlQuery   .=  " WHERE session_id='".$summary_id."'";
        //$sqlQuery   .=  " ORDER BY pcode_category";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_patcon_procedures($patient_id)


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
    function get_recent_procedure_orders($patient_id)
    {
        $data = array();
        $sqlQuery   =   "SELECT pord.*, pext.pcode1ext_longname,pext.pcode1ext_shortname,";
        $sqlQuery   .=  " pprd.product_name,pprd.product_code,pprd.prod_description,pprd.seller_code,";
        $sqlQuery   .=  " pcon.date_started,psup.supplier_name";
        $sqlQuery   .=  " FROM procedure_order pord";
        $sqlQuery   .=  " JOIN pcode1ext pext ON pord.pcode1ext_id=pext.pcode1ext_id";
        $sqlQuery   .=  " JOIN patient_consultation_summary pcon ON pord.session_id=pcon.summary_id";
        $sqlQuery   .=  " LEFT OUTER JOIN procedure_product pprd ON pord.product_id=pprd.product_id";
        $sqlQuery   .=  " LEFT OUTER JOIN procedure_supplier psup ON pprd.supplier_id=psup.supplier_id";
        $sqlQuery   .=  " where pord.patient_id='".$patient_id."'";
        //$sqlQuery   .=  " ORDER BY pcode_category";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_recent_procedure_orders($patient_id)


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
    function get_past_procedures($patient_id, $past_procedure_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT pasp.*, pext.pcode1_id, pext.pcode1ext_longname, pext.pcode1ext_shortname, pext.pcode_category,";
        $sqlQuery   .=  " pprd.product_name,pprd.product_code,pprd.prod_description,pprd.seller_code";
        $sqlQuery   .=  " FROM patient_past_procedure pasp";
        $sqlQuery   .=  " JOIN pcode1ext pext ON pasp.pcode1ext_id=pext.pcode1ext_id";
        $sqlQuery   .=  " LEFT OUTER JOIN procedure_product pprd ON pasp.product_id=pprd.product_id";
        $sqlQuery   .=  " where patient_id='".$patient_id."'";
        if(isset($past_procedure_id)){
            $sqlQuery   .=  " AND pasp.past_procedure_id='".$past_procedure_id."'";
        }
        $sqlQuery   .=  " ORDER BY procedure_date DESC";
        //echo "<br />".$sqlQuery;
        $Q =  $this->db->query($sqlQuery);
        //echo $this->db->last_query();
        if ($Q->num_rows() > 0){
            foreach ($Q->result_array() as $row){
                $data[] = $row;
            }
        }

        $Q->free_result();    
        return $data;    
    } // end of function get_past_procedures($patient_id)


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
    function get_procedure_group_list($expect='data',$sort_order="pcode1_code",$per_page="ALL",$row_first=0,$pcode1_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pcod.*";
        $sqlQuery   .=  " FROM pcode1 pcod";
        $sqlQuery   .=  " WHERE 1=1";
		if(isset($pcode1_id)){
			$sqlQuery   .=  " AND pcode1_id='".$pcode1_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",pcod.pcode1_code";
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
    } //end of function get_procedure_group_list($location_id=NULL,$category=NULL)


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
    function get_procedure_code_list($expect='data',$sort_order="pcode1ext_code",$per_page="ALL",$row_first=0,$pcode1_id=NULL,$pcode1ext_id=NULL)
    {
        $dataset = array();
        $sqlQuery   =   "SELECT pcod.*";
        $sqlQuery   .=  " FROM pcode1ext pcod";
        $sqlQuery   .=  " WHERE 1=1";
		if(isset($pcode1_id)){
			$sqlQuery   .=  " AND pcod.pcode1_id='".$pcode1_id."'";
		}
		if(isset($pcode1ext_id)){
			$sqlQuery   .=  " AND pcod.pcode1ext_id='".$pcode1ext_id."'";
		}
        $sqlQuery   .=  " ORDER BY ".$sort_order.",pcod.pcode1ext_code";
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
    } //end of function get_procedure_code_list($location_id=NULL,$category=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of imaging suppliers
     *
     * This method 
     *
	 * @param   string  $package_id      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_supplier_list_proc($supplier_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT isup.*,";
        $sqlQuery   .=  " scin.address, scin.address2, scin.address3, scin.postcode, scin.town, scin.state, scin.country,";
        $sqlQuery   .=  " scin.contact_person, scin.tel_no, scin.tel2_no, scin.tel3_no, scin.fax_no, scin.fax2_no, scin.email, scin.contact_other,scin.website, scin.contact_remarks";
        $sqlQuery   .=  " FROM procedure_supplier isup";
        $sqlQuery   .=  " JOIN supplier_contact_info scin ON isup.contact_id=scin.contact_id";
		if(isset($supplier_id)){
			$sqlQuery   .=  " WHERE isup.supplier_id = '".$supplier_id."'";
		}
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
    } //end of function get_supplier_list_proc($supplier_id=NULL)


    //************************************************************************
    /**
     * Method to retrieve list of imaging packages by supplier
     *
     * This method 
     *
	 * @param   string  none      
     * @return  array   
     * @author  Jason Tan Boon Teck
     */
    function get_proc_product_bysupplier($supplier_id,$imag_package_id=NULL)
    {
        $data = array();
        $sqlQuery   =   "SELECT pprd.*,";
        $sqlQuery   .=  " psup.supplier_name, psup.acc_no,";
        $sqlQuery   .=  " clinic_shortname, clinic_name";
        //$sqlQuery   .=  " loinc.component, loinc.class_name";
        $sqlQuery   .=  " FROM procedure_product pprd";
        $sqlQuery   .=  " JOIN procedure_supplier psup ON pprd.supplier_id=psup.supplier_id";
        //$sqlQuery   .=  " JOIN loinc ON pprd.loinc_num=loinc.loinc_num";
        $sqlQuery   .=  " LEFT OUTER JOIN clinic_info ON pprd.location_id=clinic_info.clinic_info_id";
        $sqlQuery   .=  " WHERE pprd.supplier_id='".$supplier_id."'";
		if(isset($imag_package_id)){
			$sqlQuery   .=  " AND pprd.product_id='".$imag_package_id."'";
		}
        $sqlQuery   .=  " ORDER BY product_code";
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
    } //end of function get_proc_product_bysupplier($supplier_id,$imag_package_id=NULL)



}

/* End of file MConsult_procedure_rdb.php */
/* Location: ./app_thirra/models/MConsult_procedure_rdb.php */
