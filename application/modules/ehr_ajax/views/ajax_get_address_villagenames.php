<?php
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


