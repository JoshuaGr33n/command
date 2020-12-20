<?php





$school_class = substr($_POST["class"][$i], 0, 3);
if($school_class=="JSS")
{
 $School="Junior Secondary School";


}

else if ($school_class=="SSS"){

$School="Senior Secondary School";


}




  $query= $con->prepare("SELECT CA1, CA2, CA3, Exam FROM result_marks  WHERE School = '$School' AND session = '$session_for_edit' AND term = '$term_for_edit' ");
   //$query->bind_param("i", $School); // Bind search values to parameters ("iiii" : one "i" for each variable, set's data type to "int")
   $query->execute();                            // Run the query
    $query->Store_result();                       // Store the result set
    $query->bind_result($ca1_score, $ca2_score, $ca3_score, $exam_score);  
    $query->fetch();
    $query->close();


$total = ((int)$_POST["ca1"][$i]+(int)$_POST["ca2"][$i]+(int)$_POST["ca3"][$i]+(int)$_POST["exam"][$i]);


if($ca1_score == 0 && $ca2_score == 0 && $ca3_score == 0 && $exam_score > 0 ){

  $average = $total/1;
  }
  
 else if($ca1_score == 0 && $ca2_score == 0 && $ca3_score > 0 && $exam_score > 0 ){

    $average= $total/2;
 }
 else if($ca1_score == 0 && $ca3_score == 0 && $ca2_score > 0 && $exam_score > 0 ){

  $average= $total/2;
 }
 else if($ca2_score == 0 && $ca3_score == 0 && $ca1_score > 0 && $exam_score > 0 ){

  $average= $total/2;
 }
 else if($ca1_score == 0  && $ca2_score > 0 && $ca3_score > 0 && $exam_score > 0 ){

  $average= $total/3;
 }
 else if($ca2_score == 0 && $ca1_score > 0 && $ca3_score > 0 && $exam_score > 0 ){

  $average= $total/3;
 }
 else if($ca3_score == 0 && $ca2_score > 0 && $ca1_score > 0 && $exam_score > 0 ){

  $average= $total/3;
 
 }
 else if($ca1_score > 0 && $ca2_score > 0 && $ca3_score > 0 && $exam_score > 0 ){
  $average= $total/4;
 }
 else if($exam_score == 0){
  

 }


$average=number_format($average, 2);






               
                
                
                






              if($School=="Junior Secondary School")
                  {
                  
                   $sch_grade=get_grade_jss($total);
                  
                  }
                  
                  else if ($School=="Senior Secondary School")
                  {
                  
                 
                  $sch_grade=get_grade_sss($total);
                  
                  }

?>