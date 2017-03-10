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

echo "\n<body class='dept'>";
echo "\n<table width='100%' border='0'>";
echo "<tr>";
    echo "\n<td width='100%' align='center' class='banner'>";
    echo "\n<img src='".base_url()."/images/THIRRA_banner.png' alt='THIRRA banner' />";
    echo "\n</td>";
echo "\n</tr>";
echo "</table>";
echo "\n<table>";
echo "<tr>";
    echo "\n<td width='150'><strong>";
    echo anchor('bio', 'Home');
    echo "</strong></td>";
    echo "\n<td width='150'><strong>Manage Cases</strong></td>";
    echo "\n<td width='150'><strong>";
    echo anchor('bio/reports_management', 'Print Reports', "target='_blank'");
    echo "</strong></td>";
    echo "\n<td width='150'><strong>Admin</strong></td>";
echo "\n</tr>";
echo "</table>";

