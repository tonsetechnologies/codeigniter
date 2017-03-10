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

echo "\n\n<div id='content_nosidebar'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(unsynched_list)=<br />";
		print_r($unsynched_list);
	echo '</pre>';
    echo "\n<br />num_rows=".$num_rows;
    echo "\n<br />file_exported=".$file_exported;
    echo "\n<br />xmlstr=".$xmlstr;
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('admin_export_new_antenatalinfo_done_html_title')."</h1></div>";

//echo "\nExported to this XML file named <a href='/synch-THIRRA/exports_consult/".$file_exported."' target='_blank'>$file_exported</a>.";
echo "\nExported to this XML file named <a href='http://".$_SERVER["SERVER_ADDR"]."/".$app_folder."-uploads/exports_antenatal/".$file_exported."' target='_blank'>$file_exported</a>.";




