<?php

// Display formulary code
echo $formulary_info[0]['formulary_code']." + ";

echo "|=|";

// Display formulary info
    echo "\n<table>";
    echo "\n<tr>";
        echo "\n<td width='200'>Generic name</td>";
        //echo "<td>".$formulary_info[0]['generic_name']."</td>";
        echo "\n<td>".anchor('ehr_utilities/util_edit_drugformulary/edit_formulary/'.$formulary_info[0]['drug_formulary_id'], $formulary_info[0]['generic_name'])."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Formulary code</td>";
        echo "<td>".$formulary_info[0]['formulary_code']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Formulary system</td>";
        echo "<td>".$formulary_info[0]['formulary_system']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Commonly used</td>";
        echo "<td>".$formulary_info[0]['commonly_used']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>USFDA pregnancy category</td>";
        echo "<td>".$formulary_info[0]['usfda_preg_cat']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td>Poison category</td>";
        echo "<td>".$formulary_info[0]['poison_cat']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Dose form</td>";
        echo "<td>".$formulary_info[0]['dose_form']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Indication</td>";
        echo "<td>".$formulary_info[0]['indication']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Dosage</td>";
        echo "<td>".$formulary_info[0]['dosage']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Contra indication</td>";
        echo "<td>".$formulary_info[0]['contra_indication']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Precautions</td>";
        echo "<td>".$formulary_info[0]['precautions']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Interactions</td>";
        echo "<td>".$formulary_info[0]['interactions']."</td>";
    echo "\n</tr>";
    echo "\n<tr>";
        echo "\n<td valign='top'>Adverse reactions</td>";
        echo "<td>".$formulary_info[0]['adverse_reactions']."</td>";
    echo "\n</tr>";
    echo "\n</table>";

    echo "\n<br /><u>Drug codes in database</u>";
    echo "\n<ol>";
    foreach ($drugcode_list as $drugcode_item){
        echo "\n<li>[".$drugcode_item['drug_code']."] ".anchor('ehr_utilities/util_edit_drugcode/edit_drugcode/'.$drugcode_item['drug_code_id'], $drugcode_item['trade_name'])."</li>";
    }//endforeach;
    echo "\n</ol>";



