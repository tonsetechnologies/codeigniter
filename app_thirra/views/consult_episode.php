<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title><?php echo $title; ?></title>
</head>
<body>
<?php

echo form_open("thirra/save_episode");
echo "<h1>Past Consultation</h1>";
echo '<table>';
echo "\n<tr>";
	echo '<td>';
		echo 'Patient Id';
	echo '</td>';
	echo '<td>';
		echo $patient_id;
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Patient Name';
	echo '</td>';
	echo '<td>';
		echo $patient_info['name'];
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Birth Date';
	echo '</td>';
	echo '<td>';
		echo $patient_info['birth_date'];
	echo '</td>';
echo '</tr>';


echo form_hidden('patient_id',$patient_id);
echo form_hidden('summary_id',$summary_id);
echo "\n<tr>";
	echo '<td>';
		echo 'Date Started';
	echo '</td>';
	echo '<td>';
        echo "\n<input type='text' name='date_started' value='$date_started'/>";
        echo "\n<input type='submit' name='part_form' value='Submit Part' />";
	echo '</td>';
echo '</tr>';
echo "\n<tr>";
	echo '<td>';
		echo 'Date Ended';
	echo '</td>';
	echo '<td>';
        echo "\n<input type='text' name='date_ended' value='$date_ended'/>";
	echo '</td>';
echo '</tr>';

echo "</table>\n";

echo "<p /><input type='submit' name='full_form' value='Submit Full' />";
echo "</form>";
echo "\n<p />".$patient_id." - ".$summary_id;

echo "</body></html>";
