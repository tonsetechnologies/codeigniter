<?php
foreach ($medication_list as $medication_item){
    if(!empty($medication_item['date_started'])){
        echo "\n<tr>";
        echo "<td valign='top'>".$medication_item['date_started']."</td>";
        //echo "<td>".anchor('ehr_patient/edit_/edit_diagnosis/'.$patient_id.'/'.$imaging_item['order_id'], $imaging_item['product_code'])."</td>";
        echo "<td><strong>".$medication_item['generic_name']."</strong></td>";
        echo "</tr>";
    }
}//endforeach;

