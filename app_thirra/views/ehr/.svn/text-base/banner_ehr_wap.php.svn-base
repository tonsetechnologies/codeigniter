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

echo "\n<body class='wap'>";
echo "<div id='page'>";

echo "\n<div id='banner'>";
//echo "THIRRA";

echo "\n<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
echo "<tr>";
    echo "\n<td width='10%' align='center' class='banner'>";
    echo "\n</td>";
    echo "\n<td width='40%' align='center' class='banner'>";
    if($offline_mode) {
        echo "<h1>THIRRA - OFFLINE MODE</h1>";
    } else {
        echo "<h1>THIRRA</h1>";
        //echo "\n<img src='".base_url()."/images/THIRRA_banner.png' alt='THIRRA banner' />";
    }
    echo "\n</td>";
    echo "\n<td width='50%' align='right' class='banner'>";
    echo $_SESSION['clinic_shortname'];
    echo "\n<br />".$_SESSION['username'];
echo "\n</tr>";
echo "</table>";

echo "\n<table>";
echo "<tr>";
    echo "\n<td width='50' class='banner_button_enabled'>";
    echo anchor('ehr_dashboard', 'Home');
    echo "</td>";

    //echo "\n<td width='50'>";
    //echo anchor('ehr_patient/patients_mgt', 'Pts');
    echo "\n<td width='50' id='patients_link' ";
    if(isset($user_rights['section_patients']) && ($user_rights['section_patients'] > 0)){
        echo "class='banner_button_enabled'><div>";
        //echo "Patients";
        echo anchor('ehr_patient/patients_mgt', 'Pts');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Pts";
    }
    echo "</td>";

    //echo "\n<td width='50'>";
    //echo anchor('ehr_pharmacy/pharmacy_mgt', 'Rx');
    echo "\n<td width='50' id='pharmacy_link' ";
    if(isset($user_rights['section_pharmacy']) && ($user_rights['section_pharmacy'] > 0)){
        echo "class='banner_button_enabled'><div>";
        //echo "Pharmacy";
        echo anchor('ehr_pharmacy/pharmacy_mgt', 'Rx');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Rx";
    }
    echo "</td>";

    //echo "\n<td width='50'>";
    //echo anchor('ehr_orders/orders_mgt', 'Ord');
    echo "\n<td width='50' id='orders_link' ";
    if(isset($user_rights['section_orders']) && ($user_rights['section_orders'] > 0)){
        echo "class='banner_button_enabled'><div>";
        //echo "Orders";
        echo anchor('ehr_orders/orders_mgt', 'Ord');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Ord";
    }
    echo "</td>";

    //echo "\n<td width='50'>";
    //echo anchor('ehr_queue/queue_mgt', 'Que');
    echo "\n<td width='50' id='queue_link' ";
    if(isset($user_rights['section_queue']) && ($user_rights['section_queue'] > 0)){
        echo "class='banner_button_enabled'><div>";
        //echo "Queue";
        echo anchor('ehr_queue/queue_mgt', 'Que');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Que";
    }
    echo "</td>";

    //echo "\n<td width='50'>";
    //echo anchor('ehr_reports/reports_mgt', 'Rpt');
    echo "\n<td width='50' id='reports_link'";
    if(isset($user_rights['section_reports']) && ($user_rights['section_reports'] > 0)){
        echo "class='banner_button_enabled'><div>";
        //echo "Rpt";
        echo anchor('ehr_reports/reports_mgt', 'Rpt');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Rpt";
    }
    echo "</td>";

    //echo "\n<td width='50'>";
    //echo anchor('ehr_utilities/utilities_mgt', 'Utl');
    echo "\n<td width='50' id='utilities_link' ";
    if(isset($user_rights['section_utilities']) && ($user_rights['section_utilities'] > 0)){
        echo "class='banner_button_enabled'><div>";
        //echo "Utl";
        echo anchor('ehr_utilities/utilities_mgt', 'Utl');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Utl";
    }
    echo "</td>";

    //echo "\n<td width='50'>";
    //echo anchor('ehr_admin/admin_mgt', 'Adm');
    echo "\n<td width='50' id='admin_link' ";
    if(isset($user_rights['section_admin']) && ($user_rights['section_admin'] > 0)){
        echo "class='banner_button_enabled'><div>";
        //echo "Admin";
        echo anchor('ehr_admin/admin_mgt', 'Adm');
        echo "</div>";
    } else {
        echo "class='banner_button_disabled'>Adm";
    }
    echo "</td>";

    echo "\n<td width='50'>";
    echo anchor('thirra/logout', 'Logout');
    echo "</td>";

echo "\n</tr>";
echo "</table>";
echo "</div>"; // id=banner
