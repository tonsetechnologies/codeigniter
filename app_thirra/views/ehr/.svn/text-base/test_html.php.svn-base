<?php
echo "\n<body class='html'>";

echo "<script  language='javascript' type='text/javascript'>";
echo "document.writeln('JS in body');";
echo "</script>";
/*
echo "\n<br />diagnosisChapter ";
echo $diagnosisChapter;
echo "<br />diagnosisCategory";
echo $diagnosisCategory;
echo "<br />diagnosis";
echo $diagnosis;
echo "<br />diagnosis2";
echo $diagnosis2;
echo "<br />";
echo $diagnosisChapter;
echo $diagnosisCategory;
echo $diagnosis;
*/
echo form_open('emr/edit_diagnosis/'.$patient_id);
echo "\n<table class='frame' width='100%' align='center'>";
echo "<tr>";
    echo "\n<td width='25%'><b>Diagnosis Chapter <font color='red'>*</font></b></td>";
    echo "<td colspan='2' class='red'>";   
    //echo "\n<select name='diagnosisChapter' class='normal' onChange='selectDiagnosisCategory()'>";
    echo "\n<select name='diagnosisChapter' class='normal' onchange='javascript:selectDiagnosisCategory()'>";
        echo "\n<option label='' value='0'>Choice 0</option>";
        echo "\n<option label='' value='K00-K93 Diseases of the digestive system'>Choice 1</option>";
        echo "\n<option label='' value='C00-D48 Neoplasms'>Choice 2</option>";
        echo "</select>";
    echo "</td>";
echo "</tr>";
echo "\n<tr>";
    echo "\n<td width='25%'><b>Diagnosis Category (ICD-10)<font color='red'>*</font></b></td>";
    echo "\n<td colspan='2' class='red'>";
        echo "\n<select name='diagnosisCategory' class='normal' onChange='javascript:selectDiagnosis()'>";
            echo "\n<option value='' >Please select one</option>";
            foreach($dcode1_list as $dcode1)
            {
	            echo "\n<option value='".$dcode1['dcode1_code']."' ";
                echo ($diagnosisCategory==$dcode1['dcode1_code'] ? " selected='selected'" : " ");
                echo ">".$dcode1['dcode1_code']." &nbsp;&nbsp;&nbsp;[".$dcode1['full_title']."]</option>";
            } //foreach
        echo "</select>";
    echo "</td>";
echo "</tr>";

?>
               
   </table>
   <br />
   <center>
           <input class='button' type='submit' name='submit' value='Enter Diagnosis' />
   </center>
   </form>
<br />

    <script  language="javascript" type="text/javascript">
<![CDATA[
    alert('Javascript is turned on!')
    document.write('JS in body');
        function selectDiagnosisCategory(){
            document.form.status.value="Unfinished";
            document.form.diagnosisCategory.selectedIndex = -1;
            document.form.diagnosis.selectedIndex = -1;
            document.form.diagnosis2.selectedIndex = -1;
            document.form.submit.click();
        }

        function selectDiagnosis(){
            document.form.status.value="Unfinished";
            document.form.diagnosis.selectedIndex = -1;
            document.form.diagnosis2.selectedIndex = -1;
            document.form.submit.click();
        }

         function selectDiagnosis2()
         {
            document.form.status.value="Unfinished";
            document.form.diagnosis2.selectedIndex = -1;
            document.form.submit.click();
         }
]]>
      </script>

</body></html>
