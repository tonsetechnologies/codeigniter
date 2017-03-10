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

echo "\n\n<div id='content'>";
if($debug_mode) {
    echo "\n<div class='debug'>";
    print "Session info = " . $_SESSION['thirra_mode'];
    print "<br />User = " . $_SESSION['username'];
	echo '<pre>';
    echo "\n<br />print_r(vitals_list)=<br />";
		print_r($vitals_list);
    echo "\n<br />print_r(vitals_data)=<br />";
		print_r($vitals_data);
	echo '</pre>';
    echo "\n<br />supplier_type=".$supplier_type;
    echo "\n</div>";
}

echo "\n\n<div id='page_title' align='center'><h1>".$this->lang->line('patients_ovv_history_vitals_html_title')."</h1></div>";

echo "\n<div class='flashdata'>".$this->session->flashdata('data_activity')."</div>";

echo "\n<fieldset>";
echo "<legend>VITAL SIGNS LIST</legend>";
//echo "<strong>Add New Reading</strong>";
echo anchor('ehr_individual_history/edit_history_vitals/new_vitals/'.$patient_id, "<strong>Add New Reading</strong>");
echo "\n<br /><br />";

echo "\n<table>";
echo "\n<tr>";
    echo "\n<th>No.</th>";
    echo "\n<th width='110'>Reading Date</th>";
    echo "\n<th width='150'>Time</th>";
    echo "\n<th width='150'>Temperature<br />&deg;C</th>";
    echo "\n<th width='150'>BP systolic<br />mm Hg</th>";
    echo "\n<th width='150'>BP diastolic<br />mm Hg</th>";
    echo "\n<th width='150'>Height<br />cm</th>";
    echo "\n<th width='150'>Weight<br />kg</th>";
echo "</tr>";
if(isset($vitals_list)){
    $rownum = 1;
    foreach ($vitals_list as $vitals_item){
        echo "\n<tr>";
        echo "\n<td>".$rownum.".</td>";
        //echo "\n<td>".anchor('ehr_utilities/util_edit_state_info/edit_state/'.$vitals_item['vital_id'], "<strong>".$vitals_item['reading_date']."</strong>")."</td>";
        echo "\n<td>".$vitals_item['reading_date']."</td>";
        echo "\n<td>".$vitals_item['reading_time']."</td>";
        echo "\n<td>".$vitals_item['temperature']."</td>";
        echo "\n<td>".$vitals_item['bp_systolic']."</td>";
        echo "\n<td>".$vitals_item['bp_diastolic']."</td>";
        echo "\n<td>".$vitals_item['height']."</td>";
        echo "\n<td>".$vitals_item['weight']."</td>";
        echo "\n</tr>";
        $rownum++;
    }//endforeach;
}
echo "</table>";
echo "\n<br />";
echo "\n</fieldset>";

// Load jqPlot library
echo "\n<script language='javascript' type='text/javascript' src='".base_url()."js/jquery.jqplot.1.0.0b2/jquery.jqplot.min.js'></script>";
echo "\n<script language='javascript' type='text/javascript' src='".base_url()."js/jquery.jqplot.1.0.0b2/plugins/jqplot.dateAxisRenderer.js'></script>";
echo "\n<script language='javascript' type='text/javascript' src='".base_url()."js/jquery.jqplot.1.0.0b2/plugins/jqplot.canvasTextRenderer.js'></script>";
echo "\n<script language='javascript' type='text/javascript' src='".base_url()."js/jquery.jqplot.1.0.0b2/plugins/jqplot.canvasAxisTickRenderer.js'></script>";
echo "\n<script language='javascript' type='text/javascript' src='".base_url()."js/jquery.jqplot.1.0.0b2/plugins/jqplot.canvasAxisLabelRenderer.js'></script>";
echo "\n<script language='javascript' type='text/javascript' src='".base_url()."js/jquery.jqplot.1.0.0b2/plugins/jqplot.pointLabels.js'></script>";
echo "\n<link rel='stylesheet' type='text/css' href='".base_url()."js/jquery.jqplot.1.0.0b2/jquery.jqplot.css' />";

//echo $points_temperature;
//echo $points_height;
//echo $points_weight;
//echo $points_bp_systolic;
//echo $points_bp_diastolic;

//jqPlot drawing area

$cannot_show    =    "<br />Insufficient data points to display chart.<br /><br /><br />";
echo "\n<h2>TEMPERATURE (&deg;C)</h2>";
    echo "\n<div id='chartdiv1' class='chart ".$chart_height_temperature." ".$chart_width_temperature."'>";
    if($points_temperature >= $min_points){
        $show_temperature = "TRUE";
    } else {
        echo $cannot_show;
        $show_temperature = "FALSE";
    }
    echo "</div><br /><br />";
    //echo $days_temperature;
    //echo "<br />".$range_temperature;

echo "\n<h2>HEIGHT (cm)</h2>";
    echo "\n<div id='chartdiv2' class='chart ".$chart_height_height." ".$chart_width_height."'>";
    if($points_height >= $min_points){
        $show_height = "TRUE";
    } else {
        echo $cannot_show;
        $show_height = "FALSE";
    }
    echo "</div><br /><br />";
    //echo $days_height;
    //echo "<br />".$range_height;

echo "\n<h2>WEIGHT (kg)</h2>";
    echo "\n<div id='chartdiv3' class='chart ".$chart_height_weight." ".$chart_width_weight."'>";
    if($points_weight >= $min_points){
        $show_weight = "TRUE";
    } else {
        echo $cannot_show;
        $show_weight = "FALSE";
    }
    echo "</div><br /><br />";
    //echo $days_weight;
    //echo "<br />".$range_weight;

echo "\n<h2>BLOOD PRESSURE (mm Hg)</h2>";
    echo "\n<div id='chartdiv4' class='chart ".$chart_height_bp." ".$chart_width_bp."'>";
    if($points_bp_systolic >= $min_points){
        $show_bp = "TRUE";
    } else {
        echo $cannot_show;
        $show_bp = "FALSE";
    }
    echo "</div><br /><br />";
    //echo $days_bp;
    //echo "<br />".$range_bp;



?>

<style type="text/css">
</style>

<script  type="text/javascript">


line1b = new Array();

var show_temperature = '<?php echo $show_temperature; ?>';
if(show_temperature=='TRUE'){
    var line1a = new Array();
    line1a = <?php echo $temperature; ?>;
    //alert(line1a+'\n'+line1b);
    var plot1 = $.jqplot('chartdiv1', [line1a], {
        title:{
            //text:'TEMPERATURE',
            show: false
        },
        seriesDefaults: {
            pointLabels: {
                show: true,
                escapeHTML: false,
                ypadding: 10 
            }
        },
        axes:{
            xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
                tickOptions: {
                    formatString:'%Y-%m-%d %H:%M',
                    angle: -30,
                    fontSize: '12pt'
                }
            },
            yaxis:{
                autoscale: true,
                label:'', 
                labelOptions:{
                    // fontFamily:'Helvetica',
                    fontSize: '11pt'
                },
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
            }
        },
        series:[{
            lineWidth:3,
            markerOptions:{
                style:'square'
            }
        }]
    });
}


var show_height = '<?php echo $show_height; ?>';
if(show_height=='TRUE'){
    var line2a = new Array();
    line2a = <?php echo $height; ?>;
    //alert(line2a+'\n'+line1b);
    var plot2 = $.jqplot('chartdiv2', [line2a], {
        title:{
            //text:'HEIGHT',
            show: false
        },
        seriesDefaults: {
            pointLabels: {
                show: true,
                escapeHTML: false,
                ypadding: 10 
            }
        },
        axes:{
            xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
                tickOptions: {
                    formatString:'%Y-%m-%d %H:%M',
                    angle: -30,
                    fontSize: '12pt'
                }
            },
            yaxis:{
                autoscale: true,
                label:'', 
                labelOptions:{
                    // fontFamily:'Helvetica',
                    fontSize: '11pt'
                },
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
            }
        },
        series:[{
            lineWidth:3,
            markerOptions:{
                style:'square'
            }
        }]
    });
}


var show_weight = '<?php echo $show_weight; ?>';
if(show_weight=='TRUE'){
    var line3a = new Array();
    line3a = <?php echo $weight; ?>;
    //alert(line1a+'\n'+line1b);
    var plot3 = $.jqplot('chartdiv3', [line3a], {
        title:{
            //text:'WEIGHT',
            show: false
        },
        seriesDefaults: {
            pointLabels: {
                show: true,
                escapeHTML: false,
                ypadding: 10 
            }
        },
        axes:{
            xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
                tickOptions: {
                    formatString:'%Y-%m-%d %H:%M',
                    angle: -30,
                    fontSize: '12pt'
                }
            },
            yaxis:{
                autoscale: true,
                label:'', 
                labelOptions:{
                    // fontFamily:'Helvetica',
                    fontSize: '11pt'
                },
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
            }
        },
        series:[{
            lineWidth:3,
            markerOptions:{
                style:'square'
            }
        }]
    });
}


var show_bp = '<?php echo $show_bp; ?>';
if(show_bp=='TRUE'){
    var line4a = new Array();
    line4a = <?php echo $bp_systolic; ?>;
    var line4b = new Array();
    line4b = <?php echo $bp_diastolic; ?>;
    //alert(line4a+'\n'+line4b);
    var plot4 = $.jqplot('chartdiv4', [line4a,line4b], {
        title:{
            //text:'BLOOD PRESSURE',
            show: false
        },
        seriesDefaults: {
            pointLabels: {
                show: true,
                escapeHTML: false,
                ypadding: 10
            }
        },
        //legend: {show: true},
        axes:{
            xaxis:{
                renderer:$.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
                tickOptions: {
                    formatString:'%Y-%m-%d %H:%M',
                    angle: -30,
                    fontSize: '12pt'
                }
            },
            yaxis:{
                autoscale: true,
                label:'', 
                labelOptions:{
                    // fontFamily:'Helvetica',
                    fontSize: '11pt'
                },
                labelRenderer: $.jqplot.CanvasAxisLabelRenderer
            }
        },
        series:[{
            lineWidth:3,
            markerOptions:{
                style:'square'
            }
        }]
    });
}

</script>


