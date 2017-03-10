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

echo "\n<body class='ovrvw' ".$auto_refresh.">";
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
        //echo "\n<img src='".base_url()."/images/THIRRA_banner.png' alt='THIRRA banner' />";
        if($this->config->item('app_name')=="THIRRA"){
            echo "\n<img src='".base_url()."/images/THIRRA_banner.png' alt='THIRRA banner' />";
        } else {
            echo "\n<img src='".base_url()."/images/THIRRA_banner2.png' alt='THIRRA banner' />";
        }
    }
    echo "\n</td>";
    echo "\n<td width='10%' align='right' class='banner'>";
    echo $this->session->userdata('clinic_shortname');//$_SESSION['clinic_shortname'];
    echo "\n<br />".$this->session->userdata('username');//$_SESSION['username'];
echo "\n</tr>";
echo "</table>";

    echo "<div id='patientinfo'>";
        echo $individual_info['name'].", ".$individual_info['name_first'];
        echo "<br />(".$individual_info['birth_date'];
        echo ") ";
        echo $individual_info['age_words'];
        echo " : ".$individual_info['gender'];
    echo "</div>"; // id='patientinfo'
echo "</div>"; // id=banner
