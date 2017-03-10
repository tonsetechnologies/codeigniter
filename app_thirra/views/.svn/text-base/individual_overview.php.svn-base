<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title><?php echo $title; ?></title>
</head>
<body>
<?php

echo "<h1>Individual Overview</h1>";
echo '<table>';
echo '<tr>';
	echo '<td>';
		echo 'Patient Id';
	echo '</td>';
	echo '<td>';
		echo $patient_id;
	echo '</td>';
echo '</tr>';
echo '<tr>';
	echo '<td>';
		echo 'Patient Name';
	echo '</td>';
	echo '<td>';
		echo $patient_info['name'];
	echo '</td>';
echo '</tr>';
echo '<tr>';
	echo '<td>';
		echo 'Birth Date';
	echo '</td>';
	echo '<td>';
		echo $patient_info['birth_date'];
	echo '</td>';
echo '</tr>';
echo '</table>';


echo '<p />';
echo anchor('thirra/consult_episode/'.$patient_info['patient_id'], 'Start/Continue Consultation');

echo '<p />';
//echo $patient_past_con['date_started'];
echo '<u>Past Consultations</u>';
echo "<ol>";
foreach ($patient_past_con as $consultation){
    echo "<li>";
	echo anchor('thirra/past_con/'.$consultation['summary_id'].'/'.$consultation['patient_id'], $consultation['date_started']);
    echo "</li>";
}
//endforeach;
echo "</ol>";


echo "</body></html>";
