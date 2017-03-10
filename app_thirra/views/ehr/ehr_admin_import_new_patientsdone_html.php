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

echo "\n\n<div id='content'>";
if($debug_mode) {
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(unsynched_list)=<br />";
		print_r($unsynched_list);
    echo "\n<br />print_r(selected_list)=<br />";
		print_r($selected_list);
    echo "\n<br />print_r(final_selection)=<br />";
		print_r($final_selection);
    echo "\n<br />print_r(intersect)=<br />";
		print_r($intersect);
	echo '</pre>';
    echo "\n<br />num_rows=".$num_rows;
    echo "\n<br />xmlstr=".$xmlstr;
    echo "\n<br />form_purpose=".$form_purpose;
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_export_new_patientsdone_html_title')."</h1></div>";

echo "\nExported to this <a href='/synch-THIRRA/out/patient_demo.xml' target='_blank'>XML file</a>.";



