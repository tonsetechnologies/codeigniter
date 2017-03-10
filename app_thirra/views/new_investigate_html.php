<?php
//include_once("header_xhtml1-strict.php");
include_once("header_xhtml1-transitional.php");

echo "<body>";

echo form_open("thirra/save_episode");
echo "<h1>New Investigation</h1>";
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
?>
