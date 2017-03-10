<?php
    echo "\n<select name='addr_town_id' class='normal' id='addr_town_id'>";
        echo "\n<option value='' > </option>";
        foreach($town_list as $town_item)
        {
            echo "\n<option value='".$town_item['addr_town_id']."' ";
            if(isset($init_addr_town_id)) {
                echo ($init_addr_town_id==$town_item['addr_town_id'] ? " selected='selected'" : "");
            }
            echo ">".$town_item['addr_town_name']."</option>";
        } //foreach
    echo "</select>";

echo "|=|";

    echo "\n<select name='addr_village_id' class='normal' id='addr_village_id'>";
        echo "\n<option value='' >Please select one</option>";
        foreach($village_list as $village_item)
        {
            echo "\n<option value='".$village_item['addr_village_id']."' ";
            if(isset($init_addr_village_id)) {
                echo ($init_addr_village_id==$village_item['addr_village_id'] ? " selected='selected'" : "");
            }
            echo ">".$village_item['addr_village_name']."</option>";
        } //foreach
    echo "</select>";


