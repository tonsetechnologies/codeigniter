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

echo "\n<body class='wap'>";
echo "<div id='page'>";

echo "\n<div id='banner'>";
echo "THIRRA";
echo "\n<table>";
echo "<tr>";
    echo "\n<td width='50'>";
    echo anchor('ehr_dashboard', 'Home');
    echo "</td>";
    echo "\n<td width='50'>";
    echo anchor('ehr_patient/patients_mgt', 'Pts');
    echo "</td>";
    echo "\n<td width='50'>";
    echo anchor('ehr_pharmacy/pharmacy_mgt', 'Rx');
    echo "</td>";
    echo "\n<td width='50'>";
    echo anchor('ehr_orders/orders_mgt', 'Ord');
    echo "</td>";
    echo "\n<td width='50'>";
    echo anchor('ehr_queue/queue_mgt', 'Que');
    echo "</td>";
    echo "\n<td width='50'>";
    echo anchor('ehr_reports/reports_mgt', 'Rpt');
    echo "</td>";
    echo "\n<td width='50'>";
    echo anchor('ehr_utilities/utilities_mgt', 'Utl');
    echo "</td>";
    echo "\n<td width='50'>";
    echo anchor('ehr_admin/admin_mgt', 'Adm');
    echo "</td>";
    echo "\n<td width='50'>";
    echo anchor('thirra/logout', 'Logout');
    echo "</td>";
echo "\n</tr>";
echo "</table>";
echo "</div>"; // id=banner
