<?php
    echo "\n<select name='addr_state_id' class='normal' id='addr_state_id'>";
        echo "\n<option value='' >Please select one</option>";
        foreach($states_list as $state_item)
        {
            echo "\n<option value='".$state_item['addr_state_id']."' ";
            if(isset($init_addr_state_id)) {
                echo ($init_addr_state_id==$state_item['addr_state_id'] ? " selected='selected'" : "");
            }
            echo ">".$state_item['addr_state_name']."</option>";
        } //foreach
    echo "</select>";

