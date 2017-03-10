<?php
        echo "\n<select name='diagnosisCategory' class='normal' id='diagnosisCategory'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($dcode1_list as $dcode1)
            {
	            echo "\n<option value='".$dcode1['dcode1_code']."' ";
                if(isset($diagnosisCategory)) {
                    echo ($diagnosisCategory==$dcode1['dcode1_code'] ? " selected='selected'" : "");
                }
                echo ">".$dcode1['full_title']."&nbsp;&nbsp;[".$dcode1['dcode1_code']."]</option>";
            } //foreach
        echo "</select>";

