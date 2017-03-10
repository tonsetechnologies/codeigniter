<?php
        echo "\n<select name='diagnosis' class='normal' id='diagnosis'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($dcode1ext_list as $dcode1ext)
            {
	            echo "\n<option value='".$dcode1ext['dcode1ext_code']."' ";
                if(isset($diagnosis)) {
                    echo ($diagnosis==$dcode1ext['dcode1ext_code'] ? "selected='selected'" : "");
                }
                echo ">".substr($dcode1ext['full_title'],0,100)."&nbsp;&nbsp;[".$dcode1ext['dcode1ext_code']."]</option>";
            }
        echo "</select>";

