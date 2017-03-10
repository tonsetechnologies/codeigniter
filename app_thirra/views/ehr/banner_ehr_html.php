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
 * Contributor(s):
 *   Jason Tan Boon Teck <tanboonteck@gmail.com> (original author)
 *
 * ***** END LICENSE BLOCK ***** */

echo "\n<body class='html'>";
echo "<div id='page'>";

echo "\n<div id='banner'>";
echo "\n<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "<tr>";
    echo "\n<td width='10%' align='center' class='banner'>";
    echo "\n</td>";
    echo "\n<td width='80%' align='center' class='banner'>";
    if($offline_mode) {
        echo "<h1>".$this->config->item('app_name')." - OFFLINE MODE</h1>";
    } else {
        if($this->config->item('app_name')=="THIRRA"){
            echo "\n<img src='".base_url()."/images/THIRRA_banner.png' alt='THIRRA banner' />";
        } else {
            echo "\n<img src='".base_url()."/images/THIRRA_banner2.png' alt='THIRRA banner' />";
        }
    }
    echo "\n</td>";
    echo "\n<td width='10%' align='right' class='banner'>";
    echo $_SESSION['clinic_shortname'];
    echo "\n<br />".$_SESSION['username'];
    echo "\n</td>";
echo "\n</tr>";
echo "</table>";
echo "\n<table id='banner_table'>";
echo "<tr>";
    echo "\n<td width='150' id='home_link' class='banner_button_enabled'>";
    echo "<div>";
    echo "Home";
    //echo anchor('ehr_dashboard', 'Home');
    echo "</div>";
    echo "</td>";
    echo "\n<td width='150' id='patients_link' ";
    if(isset($user_rights['section_patients']) && ($user_rights['section_patients'] > 0)){
        echo "class='banner_button_enabled'><div>";
        echo "Patients";
        //echo anchor('ehr_patient/patients_mgt', 'Patients');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Patients";
    }
    echo "</td>";

    echo "\n<td width='150' id='pharmacy_link' ";
    if(isset($user_rights['section_pharmacy']) && ($user_rights['section_pharmacy'] > 0)){
        echo "class='banner_button_enabled'><div>";
        echo "Pharmacy";
        //echo anchor('ehr_pharmacy/pharmacy_mgt', 'Pharmacy');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Pharmacy";
    }
    echo "</td>";

    echo "\n<td width='150' id='orders_link' ";
    if(isset($user_rights['section_orders']) && ($user_rights['section_orders'] > 0)){
        echo "class='banner_button_enabled'><div>";
        echo "Orders";
        //echo anchor('ehr_orders/orders_mgt', 'Orders');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Orders";
    }
    echo "</td>";

    echo "\n<td width='150' id='queue_link' ";
    if(isset($user_rights['section_queue']) && ($user_rights['section_queue'] > 0)){
        echo "class='banner_button_enabled'><div>";
        echo "Queue";
        //echo anchor('ehr_queue/queue_mgt', 'Queue');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Queue";
    }
    echo "</td>";

    echo "\n<td width='150' id='reports_link'";
    if(isset($user_rights['section_reports']) && ($user_rights['section_reports'] > 0)){
        echo "class='banner_button_enabled'><div>";
        echo "Reports";
        //echo anchor('ehr_reports/reports_mgt', 'Reports');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Reports";
    }
    echo "</td>";

    echo "\n<td width='150' id='utilities_link' ";
    if(isset($user_rights['section_utilities']) && ($user_rights['section_utilities'] > 0)){
        echo "class='banner_button_enabled'><div>";
        echo "Utilities";
        //echo anchor('ehr_utilities/utilities_mgt', 'Utilities');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Utilities";
    }
    echo "</td>";

    echo "\n<td width='150' id='admin_link' ";
    if(isset($user_rights['section_admin']) && ($user_rights['section_admin'] > 0)){
        echo "class='banner_button_enabled'><div>";
        echo "Admin";
        //echo anchor('ehr_admin/admin_mgt', 'Admin');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Admin";
    }
    echo "</td>";

    echo "\n<td width='150' id='logout_link' class='banner_button_enabled'>";
    echo "<div>";
    echo "Logout";
    //echo anchor('thirra/logout', 'Logout');
    echo "</div>";
    echo "</td>";
echo "\n</tr>";
echo "</table>";
//echo "<hr />";
echo "</div>"; // id=banner


if(isset($breadcrumbs)){
    echo "\n<div id='breadcrumbs'>";
    echo $breadcrumbs;
    echo "</div>\n";
}

// Links for AJAX calls
$siteurl_home       =   site_url()."/ehr_dashboard";
$siteurl_patients   =   site_url()."/ehr_patient/patients_mgt";
$siteurl_pharmacy   =   site_url()."/ehr_pharmacy/pharmacy_mgt";
$siteurl_orders     =   site_url()."/ehr_orders/orders_mgt";
$siteurl_queue      =   site_url()."/ehr_queue/queue_mgt";
$siteurl_reports    =   site_url()."/ehr_reports/reports_mgt";
$siteurl_utilities  =   site_url()."/ehr_utilities/utilities_mgt";
$siteurl_admin      =   site_url()."/ehr_admin/admin_mgt";
$siteurl_logout     =   site_url()."/thirra/logout";
//echo $siteurl;
?>
<script type="text/javascript">

    $(document).ready(function() {
        $('#banner_table').delegate('td','hover',function (){
            $(this).toggleClass('banner_hover')}
            );
        $('#home_link').delegate('div','click',function (){
            on_click_home()}
            );
        $('#patients_link').delegate('div','click',function (){
            on_click_patients()}
            );
        $('#pharmacy_link').delegate('div','click',function (){
            on_click_pharmacy()}
            );
        $('#orders_link').delegate('div','click',function (){
            on_click_orders()}
            );
        $('#queue_link').delegate('div','click',function (){
            on_click_queue()}
            );
        $('#reports_link').delegate('div','click',function (){
            on_click_reports()}
            );
        $('#utilities_link').delegate('div','click',function (){
            on_click_utilities()}
            );
        $('#admin_link').delegate('div','click',function (){
            on_click_admin()}
            );
        $('#logout_link').delegate('div','click',function (){
            on_click_logout()}
            );
        return false;
      })


    function on_click_home() {
        var siteurl = "<?php echo $siteurl_home; ?>";
        window.location =   siteurl;
    }


    function on_click_patients() {
        var siteurl = "<?php echo $siteurl_patients; ?>";
        window.location =   siteurl;
    }


    function on_click_pharmacy() {
        var siteurl = "<?php echo $siteurl_pharmacy; ?>";
        window.location =   siteurl;
    }


    function on_click_orders() {
        var siteurl = "<?php echo $siteurl_orders; ?>";
        window.location =   siteurl;
    }


    function on_click_queue() {
        var siteurl = "<?php echo $siteurl_queue; ?>";
        window.location =   siteurl;
    }


    function on_click_reports() {
        var siteurl = "<?php echo $siteurl_reports; ?>";
        window.location =   siteurl;
    }


    function on_click_utilities() {
        var siteurl = "<?php echo $siteurl_utilities; ?>";
        window.location =   siteurl;
    }


    function on_click_admin() {
        var siteurl = "<?php echo $siteurl_admin; ?>";
        window.location =   siteurl;
    }


    function on_click_logout() {
        var siteurl = "<?php echo $siteurl_logout; ?>";
        window.location =   siteurl;
    }

</script>


