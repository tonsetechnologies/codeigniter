<?php
    echo "\n<select name='drug_formulary_id' class='normal' id='drug_formulary_id'>";
        echo "\n<option value='' >Please select one</option>";
        foreach($formulary_list as $formulary_item)
        {
            echo "\n<option value='".$formulary_item['drug_formulary_id']."' ";
            if(isset($drug_formulary_id)) {
                echo ($drug_formulary_id==$formulary_item['drug_formulary_id'] ? " selected='selected'" : "");
            }
            echo ">".$formulary_item['generic_name']."</option>";
            //echo ">".$formulary_item['generic_name']."&nbsp;[".$formulary_item['formulary_code']."]</option>";
        } //foreach
    echo "</select>";

