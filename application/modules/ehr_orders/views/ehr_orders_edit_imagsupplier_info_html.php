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
 * Portions created by the Initial Developer are Copyright (C) 2010 - 2011
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
    echo "\n<br />print_r(packages_list)=<br />";
		print_r($packages_list);
	echo '</pre>';
    echo "\n<br />form_purpose=".$form_purpose;
    echo "\n<br />supplier_id=".$supplier_id;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('orders_edit_imagsupplier_info_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

$attributes =   array('class' => 'select_form', 'id' => 'consultation_form');
echo form_open('ehr/ehr/index/ehr_orders/ehr_orders/orders_edit_imagsupplier_info/'.$form_purpose.'/imaging/'.$supplier_id, $attributes);

echo form_hidden('form_purpose', $form_purpose);
echo form_hidden('now_id', $now_id);
echo form_hidden('supplier_id', $supplier_id);
//echo form_hidden('supplier_type', $supplier_type);

echo "\n<table class='frame' width='100%' align='center'>";

echo "\n<tr><td>Supplier Name<font color='red'>*</font></td><td>";
echo form_error('supplier_name');
echo "<input type='text' name='supplier_name' value='".set_value('supplier_name',$init_supplier_name)."' size='50' /></td></tr>";

echo "\n<tr><td>Co. Registration No.</td><td>";
echo form_error('town');
echo "<input type='text' name='registration_no' value='".set_value('registration_no',$init_registration_no)."' size='10' /></td></tr>";

echo "\n<tr><td>Account No.</td><td>";
echo form_error('acc_no');
echo "<input type='text' name='acc_no' value='".set_value('acc_no',$init_acc_no)."' size='10' /></td></tr>";

echo "\n<tr><td>Credit Term</td><td>";
echo form_error('credit_term');
echo "<input type='text' name='credit_term' value='".set_value('credit_term',$init_credit_term)."' size='5' /> days</td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Supplier Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='supplier_remarks' cols='40' rows='3'>".set_value('supplier_remarks',$init_supplier_remarks)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n<tr><td>Address</td><td>";
echo form_error('address');
echo "<input type='text' name='address' value='".set_value('address',$init_address)."' size='50' /></td></tr>";

echo "\n<tr><td>Address2</td><td>";
echo form_error('address2');
echo "<input type='text' name='address2' value='".set_value('address2',$init_address2)."' size='50' /></td></tr>";

echo "\n<tr><td>Address3</td><td>";
echo form_error('address3');
echo "<input type='text' name='address3' value='".set_value('address3',$init_address3)."' size='50' /></td></tr>";

echo "\n<tr><td>Town</td><td>";
echo form_error('town');
echo "<input type='text' name='town' value='".set_value('town',$init_town)."' size='30' /></td></tr>";

echo "\n<tr><td>Post Code</td><td>";
echo form_error('postcode');
echo "<input type='text' name='postcode' value='".set_value('postcode',$init_postcode)."' size='10' /></td></tr>";

echo "\n<tr><td>State</td><td>";
echo form_error('state');
echo "<input type='text' name='state' value='".set_value('state',$init_state)."' size='30' /></td></tr>";

echo "\n<tr><td>Country</td><td>";
echo form_error('country');
echo "<input type='text' name='country' value='".set_value('country',$init_country)."' size='20' /></td></tr>";

echo "\n<tr><td>Tel. No.</td><td>";
echo form_error('tel_no');
echo "<input type='text' name='tel_no' value='".set_value('tel_no',$init_tel_no)."' size='20' /></td></tr>";

echo "\n<tr><td>tel2_no</td><td>";
echo form_error('tel2_no');
echo "<input type='text' name='tel2_no' value='".set_value('tel2_no',$init_tel2_no)."' size='20' /></td></tr>";

echo "\n<tr><td>tel3_no</td><td>";
echo form_error('tel3_no');
echo "<input type='text' name='tel3_no' value='".set_value('tel3_no',$init_tel3_no)."' size='20' /></td></tr>";

echo "\n<tr><td>Fax No.</td><td>";
echo form_error('fax_no');
echo "<input type='text' name='fax_no' value='".set_value('fax_no',$init_fax_no)."' size='20' /></td></tr>";

echo "\n<tr><td>Fax2 No.</td><td>";
echo form_error('fax2_no');
echo "<input type='text' name='fax2_no' value='".set_value('fax2_no',$init_fax2_no)."' size='20' /></td></tr>";

echo "\n<tr><td>e-mail</td><td>";
echo form_error('email');
echo "<input type='text' name='email' value='".set_value('email',$init_email)."' size='30' /></td></tr>";

echo "\n<tr><td>Contact Person</td><td>";
echo form_error('contact_person');
echo "<input type='text' name='contact_person' value='".set_value('contact_person',$init_contact_person)."' size='30' /></td></tr>";

echo "\n<tr><td>Website</td><td>";
echo form_error('website');
echo "<input type='text' name='website' value='".set_value('website',$init_website)."' size='50' /></td></tr>";

echo "\n<tr><td>Other</td><td>";
echo form_error('contact_other');
echo "<input type='text' name='contact_other' value='".set_value('contact_other',$init_contact_other)."' size='30' /></td></tr>";

echo "\n<tr>";
    echo "\n<td width='25%' id='level_two' valign='top'>Contact Remarks</td>";
    echo "\n<td>";
    echo "\n<textarea class='normal' name='contact_remarks' cols='40' rows='3'>".set_value('contact_remarks',$init_contact_remarks)."</textarea>";
    echo "\n</td>";
echo "\n</tr>";

echo "\n</table>";

echo "\n<br />";
echo "\n<center>";
    echo "\n<input class='button' type='submit' name='submit' value='";
    if($form_purpose == "new_supplier"){
        echo "Add";
    } else {
        echo "Edit";
    }
    echo " Supplier' />";
echo "\n</center>";
echo "\n<input type='hidden' name='status' value='Finished' />";
echo "\n<input type='hidden' name='bookingId' value='1196092858' />";

echo "\n</form>";
echo "\n<br />";


echo "\n<fieldset>";
echo "<legend>PRODUCTS CATALOGUE</legend>";
if($form_purpose == "edit_supplier"){
    echo anchor('ehr/ehr/index/ehr_orders/ehr_orders/orders_edit_imag_product/new_product/imag/'.$supplier_id.'/new_product', '<strong>Add Package</strong>');
}
echo "\n<br /><br /><table class='tablebg_blue'>";
echo "\n<tr>";
    echo "\n<th width='100'>Code</th>";
    echo "\n<th width='100'>Commonly Used</th>";
    echo "\n<th>Description</th>";
    echo "\n<th>Clinic</th>";
    echo "\n<th>LOINC</th>";
    echo "\n<th>Class</th>";
    echo "\n<th>Cost (".$app_currency.")</th>";
    echo "\n<th>Retail Price 1</th>";
echo "</tr>";
foreach ($packages_list as $packages_item){
    echo "<tr>";
    echo "<td>".anchor('ehr/ehr/index/ehr_orders/ehr_orders/orders_edit_imag_product/edit_product/imag/'.$supplier_id.'/'.$packages_item['product_id'], $packages_item['product_code'])."</td>";
    echo "<td align='center'>".$packages_item['commonly_used']."</td>";
    echo "<td>".$packages_item['description']."</td>";
    echo "<td><strong>".$packages_item['clinic_shortname']."</strong></td>";
    echo "<td>".$packages_item['component']."</td>";
    echo "<td>".$packages_item['class_name']."</td>";
    echo "<td align='right'>".$packages_item['supplier_cost']."</td>";
    echo "<td align='right'>".$packages_item['retail_price']."</td>";
    echo "</tr>";
}//endforeach;
echo "</table>";
echo "\n</fieldset>";


