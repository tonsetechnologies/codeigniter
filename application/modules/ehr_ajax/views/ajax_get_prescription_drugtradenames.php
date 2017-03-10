<?php
    echo "\n<select name='mdrug_code_id' class='normal' id='tradename'>";
        if(count($drugstock_list) > 0){
            echo "\n<option value='' >- Stock in hand</option>";
            foreach($drugstock_list as $drugstock_item)
            {
                echo "\n<option value='d-".$drugstock_item['drug_code_id']."-".$drugstock_item['product_id']."' ";
                if(isset($drug_code_id)) {
                    echo ($mdrug_code_id=='d-'.$drugstock_item['drug_code_id'].'-'.$drugstock_item['product_id'] ? "selected='selected'" : "");
                }
                //echo ">".$drugstock_item['trade_name']."&nbsp;&nbsp;{".$drugstock_item['quantity']."}</option>";
                echo ">".$drugstock_item['trade_name'];
                if($mod_inventctrl === TRUE){
                    echo "&nbsp;&nbsp;{".$drugstock_item['quantity']."}";
                }
                echo "</option>";
            }
        }
        echo "\n<option value='' >- Some examples of this drug</option>";
        foreach($tradename_list as $tradename_item)
        {
            echo "\n<option value='p-".$tradename_item['drug_code_id']."' ";
            if(isset($drug_code_id)) {
                echo ($mdrug_code_id=='p-'.$tradename_item['drug_code_id'] ? "selected='selected'" : "");
            }
            echo ">".$tradename_item['trade_name']."&nbsp;&nbsp;[...".substr($tradename_item['drug_code'],15,2)."]</option>";
        }
    echo "</select>";

echo "|=|";

echo "\n<table>";
if(($ajax_drug_formulary_id <> "") && ($ajax_drug_formulary_id <> "none")) {
    echo "\n<tr>";
        echo "\n<td width='150'>Generic Name</td>";
        echo "\n<td>".$formulary_chosen['generic_name']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Indication</td>";
        echo "\n<td>".$formulary_chosen['indication']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Dosage</td>";
        echo "\n<td>".$formulary_chosen['dosage']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Contra Indication</td>";
        echo "\n<td valign='top'>".$formulary_chosen['contra_indication']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Precautions</td>";
        echo "\n<td>".$formulary_chosen['precautions']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Interactions</td>";
        echo "\n<td>".$formulary_chosen['interactions']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Adverse Reactions</td>";
        echo "\n<td valign='top'>".$formulary_chosen['adverse_reactions']."</td>";
    echo "</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Indication</td>";
        echo "\n<td>".$formulary_chosen['formulary_code']."</td>";
    echo "</tr>";
} else {
    echo "\n<tr>";
        echo "\n<td>Generic Drug Knowledgebase<br />&nbsp; </td>";
        echo "\n<td></td>";
    echo "</tr>";
} //endif($drug_formulary_id <> "")
echo "</table>";

echo "|=|";
if(isset($error_messages)){
    echo $error_messages['severity'].$error_messages['msg'];
}
