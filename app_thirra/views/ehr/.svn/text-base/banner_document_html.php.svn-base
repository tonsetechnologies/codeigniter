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

if($doc_status=="open"){
    echo "\n<body class='doc_open'>";
} else {
    echo "\n<body class='doc_closed'>";
}
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
/*
echo "\n<table>";
echo "<tr>";
    echo "\n<td width='150'>";
    echo anchor('ehr_dashboard', 'Home');
    echo "</td>";
    echo "\n<td width='150'>";
    if(isset($user_rights['section_patients']) && ($user_rights['section_patients'] > 0)){
        echo anchor('ehr_patient/patients_mgt', 'Patients');
    } else {
        echo "Patients";
    }
    echo "</td>";

    echo "\n<td width='150'>";
    if(isset($user_rights['section_pharmacy']) && ($user_rights['section_pharmacy'] > 0)){
        echo anchor('ehr_pharmacy/pharmacy_mgt', 'Pharmacy');
    } else {
        echo "Pharmacy";
    }
    echo "</td>";

    echo "\n<td width='150'>";
    if(isset($user_rights['section_orders']) && ($user_rights['section_orders'] > 0)){
        echo anchor('ehr_orders/orders_mgt', 'Orders');
    } else {
        echo "Orders";
    }
    echo "</td>";

    echo "\n<td width='150'>";
    if(isset($user_rights['section_queue']) && ($user_rights['section_queue'] > 0)){
        echo anchor('ehr_queue/queue_mgt', 'Queue');
    } else {
        echo "Queue";
    }
    echo "</td>";

    echo "\n<td width='150'>";
    if(isset($user_rights['section_reports']) && ($user_rights['section_reports'] > 0)){
        echo anchor('ehr_reports/reports_mgt', 'Reports');
    } else {
        echo "Reports";
    }
    echo "</td>";

    echo "\n<td width='150'>";
    if(isset($user_rights['section_utilities']) && ($user_rights['section_utilities'] > 0)){
        echo anchor('ehr_utilities/utilities_mgt', 'Utilities');
    } else {
        echo "Utilities";
    }
    echo "</td>";

    echo "\n<td width='150'>";
    if(isset($user_rights['section_admin']) && ($user_rights['section_admin'] > 0)){
        echo anchor('ehr_admin/admin_mgt', 'Admin');
    } else {
        echo "Admin";
    }
    echo "</td>";

    echo "\n<td width='150'>";
    echo anchor('thirra/logout', 'Logout');
    echo "</td>";
echo "\n</tr>";
echo "</table>";
*/
echo "<hr />";
echo "</div>"; // id=banner
