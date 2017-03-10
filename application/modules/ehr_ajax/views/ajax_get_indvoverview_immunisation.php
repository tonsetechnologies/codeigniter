<?php
foreach ($vaccines_list as $vaccine_item){
    if(!empty($vaccine_item['date'])){
        echo "\n<tr>";
        echo "<td valign='top'>".$vaccine_item['date']."</td>";
        //echo "<td>".anchor('ehr_patient/edit_/edit_diagnosis/'.$patient_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
        echo "<td><strong>".$vaccine_item['vaccine_short']."</strong></td>";
        echo "<td>".$vaccine_item['notes']."</td>";
        echo "</tr>";
    }
}//endforeach;

