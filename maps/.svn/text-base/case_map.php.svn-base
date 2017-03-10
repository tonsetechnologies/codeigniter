<?php
echo "<!DOCTYPE html '-//W3C//DTD XHTML 1.0 Strict//EN' 
  'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>";
echo "\n<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "  \n<head>";
    echo "\n<meta http-equiv='content-type' content='text/html; charset=utf-8'/>";
    echo "\n<title>THIRRA interface with Google Maps</title>";

require_once("google_map_keys.php");
/*
    // http://jasontan.getmyip.com
    //echo "<script src='http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAdBPJCNMPuZXUGuUJ-a9YVxQL1bFETDJwfcM-MdAOMXBuSMtvpRQ9wFwCXl3EQG2-pHzEztoR2G4W8A&sensor=false'";
    // http://202.9.99.46
    //echo "<script src='http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAHxYiy8TIgXJqycM8V3AyUhQn_qxiaE2CdEJazn6iPtF92c8tYBQA4zOuLMJtK5W7W78gzNBwu9KUZw&sensor=false'";
    // http://jasontan.getmyip.com
    echo "<script src='http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAgQSXayjvV2kkTM-kFoyIUxSiQIVJArL3EQLa-7-CmIY5AhF4jxRULyizZCj_qnY4OOzRXrMuEeGMUg&sensor=false'";
    // http://thirra-my.dnsalias.net
    //echo "<script src='http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAgQSXayjvV2kkTM-kFoyIUxTKOQTJ4sM7tu8euip9RKxHHUQbaRRgcZShApq5AT6Wj6nS_VarMQI4eA&sensor=false'";
          echo "  type='text/javascript'></script>";
*/
    echo "<script type='text/javascript'>";

    echo "\nfunction initialize() {";
      echo "\nif (GBrowserIsCompatible()) {";
        echo "\nvar map = new GMap2(document.getElementById('map_canvas'));";


$points_temp        = array();
$points_temp        = explode("-", $_GET['p1']);
echo        "\nmap.setCenter(new GLatLng($points_temp[0], $points_temp[1]), 15);";
echo        "\nmap.setUIToDefault();";

echo "\nvar bounds = map.getBounds();";
echo "\nvar southWest = bounds.getSouthWest();";
echo "\nvar northEast = bounds.getNorthEast();";
echo "\nvar lngSpan = northEast.lng() - southWest.lng();";
echo "\nvar latSpan = northEast.lat() - southWest.lat();";

$has_gps   =   $_GET['has'];
for($i = 1 ; $i <= $has_gps; $i++){
    //echo "\ni=".$i;
    $points[$i]         = $_GET['p'.$i];
    $points_temp        = array();
    $points_temp        = explode("-", $points[$i]);

    echo "\nvar point = new GLatLng(".$points_temp[0].",". $points_temp[1].");";
    echo "\nmap.addOverlay(new GMarker(point));";
} //endfor($i = 1 ; $i <= $has_gps; $i++)



      echo "}";
    echo "}";

    echo "</script>";
  echo "</head>";
echo "  <body onload='initialize()' onunload='GUnload()'>";

?>
<div id='title' align='center'><h1>THIRRA Maps</h1></div>
    <div id="map_canvas" style="width: 500px; height: 500px"></div>

  </body>
</html>
