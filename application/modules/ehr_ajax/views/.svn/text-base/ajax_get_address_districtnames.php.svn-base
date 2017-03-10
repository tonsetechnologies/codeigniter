<?php
    echo "\n<select name='addr_district_id' class='normal' id='addr_district_id'>";
        echo "\n<option value='' >Please select one</option>";
        foreach($district_list as $district_item)
        {
            echo "\n<option value='".$district_item['addr_district_id']."' ";
            if(isset($init_addr_district_id)) {
                echo ($init_addr_district_id==$district_item['addr_district_id'] ? " selected='selected'" : "");
            }
            echo ">".$district_item['addr_district_name']."</option>";
        } //foreach
    echo "</select>";

