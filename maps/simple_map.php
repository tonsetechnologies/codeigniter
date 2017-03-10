<?php
echo "<!DOCTYPE html '-//W3C//DTD XHTML 1.0 Strict//EN' 
  'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "  <head>";
    echo "<meta http-equiv='content-type' content='text/html; charset=utf-8'/>";
    echo "<title>THIRRA interface with Google Maps</title>";
require_once("google_map_keys.php");
/*
    echo "<!-- <script src='http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAdBPJCNMPuZXUGuUJ-a9YVxQL1bFETDJwfcM-MdAOMXBuSMtvpRQ9wFwCXl3EQG2-pHzEztoR2G4W8A&sensor=false' -->";
    echo "<script src='http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAHxYiy8TIgXJqycM8V3AyUhQn_qxiaE2CdEJazn6iPtF92c8tYBQA4zOuLMJtK5W7W78gzNBwu9KUZw&sensor=false'
            type='text/javascript'></script>";
*/
    echo "<script type='text/javascript'>";

    echo "function initialize() {";
      echo "if (GBrowserIsCompatible()) {";
        echo "var map = new GMap2(document.getElementById('map_canvas'));";
$user_lat   =   $_GET['lat'];
$user_long   =   $_GET['long'];

echo        "map.setCenter(new GLatLng($user_lat, $user_long), 13);";
echo        "map.setUIToDefault();";

echo "var bounds = map.getBounds();";
echo "var southWest = bounds.getSouthWest();";
echo "var northEast = bounds.getNorthEast();";
echo "var lngSpan = northEast.lng() - southWest.lng();";
echo "var latSpan = northEast.lat() - southWest.lat();";
echo "var point = new GLatLng(".$user_lat.",". $user_long.");";
echo "map.addOverlay(new GMarker(point));";
//echo "var point2 = new GLatLng('7.33','80.7');";
//echo "map.addOverlay(new GMarker(point2));";

?>
      }
    }

    </script>
  </head>
  <body onload="initialize()" onunload="GUnload()">
<div id='title' align='center'><h1>THIRRA Maps</h1></div>
    <div id="map_canvas" style="width: 500px; height: 500px"></div>
  </body>
</html>
