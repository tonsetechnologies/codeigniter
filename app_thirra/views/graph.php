<html>
<head>
<style type="text/css">

body { 
 background-color: #fff; 
 margin: 40px; 
 font-family: Lucida Grande, Verdana, Sans-serif;
 font-size: 14px;
 color: #4F5155;
}

a {
 color: #003399;
 background-color: transparent;
 font-weight: normal;
}

h2 {
 color: #444;
 background-color: transparent;
 border-bottom: 1px solid #D0D0D0;
 font-size: 16px;
 font-weight: bold;
 margin: 24px 0 2px 0;
 padding: 5px 0 6px 0;
}

<?php
echo "</style>";
echo "</head>";

echo "<body>";
echo "<h2>Growth Chart</h2>";
echo "<p>";
//echo anchor('welcome', ' Panaci home');
echo "</p>";
echo "<p>For Boys</p>";
echo "<img src='".base_url()."/images/dynamic_chart.png' />";
?>
<p><br />Page rendered in {elapsed_time} seconds</p>
</body>
</html>
