<?php
echo '<?xml version="1.0"?'.'>';
echo "\n<!DOCTYPE html PUBLIC '-//WAPFORUM//DTD XHTML Mobile 1.0//EN' 'http://www.wapforum.org/DTD/xhtml-mobile10.dtd'>";
echo "\n<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "  \n<head>";
echo "  \n<meta http-equiv='Content-Type' content='application/xhtml+xml; charset=utf-8' /> ";
/*
echo "\n<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'
        'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>";
echo "\n<head>";
    echo "<meta http-equiv='content-type' content='text/html; charset=utf-8' />";
*/
    echo "\n<title>$title</title>";
echo "</head>";
echo "\n<body>";

echo "<p>";
    echo $agent . " - " . $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.) 
    if ("Unknown Platform" == $this->agent->platform()){
        echo " - Mobile Device Mode";
    } else {
        echo " - Desktop Mode";
    }
echo "</p>";

echo "\n<h1>THIRRA</h1>";
echo "\n<ol>";
foreach ($patlist as $patient){
    echo "\n<li>";
	echo anchor('thirra/individual_overview/'.$patient['patient_id'], $patient['patient_id']);
    echo " - " . $patient['name'];
	echo "</li>"; 
}
//endforeach;
echo "</ol>";

echo "\n<ol>";
foreach($query->result() as $row){
	echo "\n<li>"; 
	echo anchor('thirra/individual_overview/'.$row->patient_id, $row->patient_id);
	echo " - " . $row->name . " ";
	echo "</li>"; 
	
}
//endforeach;
echo "</ol>";
?>
</body>
</html>
