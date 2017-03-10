<?php
    echo "\n<select name='addr_area_id' class='normal' id='addr_area_id'>";
        echo "\n<option value='' >Please select one</option>";
        foreach($area_list as $area_item)
        {
            echo "\n<option value='".$area_item['addr_area_id']."' ";
            if(isset($init_addr_area_id)) {
                echo ($init_addr_area_id==$area_item['addr_area_id'] ? " selected='selected'" : "");
            }
            echo ">".$area_item['addr_area_name']."</option>";
        } //foreach
    echo "</select>";

echo "|=|";

    echo "\n<select name='addr_town_id' class='normal' id='addr_town_id'>";
        echo "\n<option value='' > </option>";
    echo "</select>";

echo "|=|";

    echo "\n<select name='addr_village_id' class='normal' id='addr_village_id'>";
        echo "\n<option value='' >Please select one</option>";
    echo "</select>";


