<?php
//include_once("header_xhtml1-strict.php");
include_once("header_xhtml-mobile10.php");

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
	echo anchor('thirra/individual_overview/'.$patient['patient_id'], 'View');
    echo " - " . $patient['name'];
	echo "</li>"; 
}
//endforeach;
echo "</ol>";

echo "\n<ol>";
foreach($query->result() as $row){
	echo "\n<li>"; 
	echo anchor('thirra/individual_overview/'.$row->patient_id, 'View');
	echo " - " . $row->name . " ";
	echo "</li>"; 
	
}
//endforeach;
echo "</ol>";
echo "<p>";
echo anchor('thirra/new_investigate', 'Start New Form');

echo "</p>";
?>
</body>
</html>
