


<?php
function annual_grade_sss($allTotalScoreAverage){
    if($allTotalScoreAverage >= 75){
        return array("grade" => "<span class='text-success font-weight-bold'>A1</span>", "remark" => "<span class='text-success font-weight-bold'>Excellent</span>");
    }else if($allTotalScoreAverage >= 70){
        return array("grade" => "<span class='text-primary font-weight-bold'>B2</span>", "remark" => "<span class='text-primary font-weight-bold'>Very Good</span>");
    }else if($allTotalScoreAverage >= 65){
      return array("grade" => "<span class='text-primary font-weight-bold'>B3</span>", "remark" => "<span class='text-primary font-weight-bold'>Good</span>");
  }else if($allTotalScoreAverage >= 60){
        return array("grade" => "<span class='text-info font-weight-bold'>C4</span>", "remark" => "<span class='text-info font-weight-bold'>Credit</span>");
    }else if($allTotalScoreAverage >= 55){
      return array("grade" => "<span class='text-info font-weight-bold'>C5</span>", "remark" => "<span class='text-info font-weight-bold'>Credit</span>");
  }else if($allTotalScoreAverage >= 50){
    return array("grade" => "<span class='text-info font-weight-bold'>C6</span>", "remark" => "<span class='text-info font-weight-bold'>Credit</span>");
  }else if($allTotalScoreAverage >= 45){
        return array("grade" => "<span class='text-secondary font-weight-bold'>D7</span>", "remark" => "<span class='text-secondary font-weight-bold'>Pass</span>");
    }else if($allTotalScoreAverage >= 40){
      return array("grade" => "<span class='text-warning font-weight-bold'>E8</span>", "remark" => "<span class='text-warning font-weight-bold'>Pass</span>");
    }else if($allTotalScoreAverage < 40){
      return array("grade" => "<span class='text-danger font-weight-bold'>F9</span>", "remark" => "<span class='text-danger font-weight-bold'>Fail</span>");
    }
    
  
  } 








  function annual_grade_jss($allTotalScoreAverage){
    if($allTotalScoreAverage >= 75){
        return array("grade" => "<span class='text-success font-weight-bold'>A</span>", "remark" => "<span class='text-success font-weight-bold'>Excellent</span>");
    }else if($allTotalScoreAverage >= 69){
        return array("grade" => "<span class='text-primary font-weight-bold'>B</span>", "remark" => "<span class='text-primary font-weight-bold'>Very Good</span>");
    }else if($allTotalScoreAverage >= 50){
        return array("grade" => "<span class='text-info font-weight-bold'>C</span>", "remark" => "<span class='text-info font-weight-bold'>Good</span>");
    }else if($allTotalScoreAverage >= 40){
        return array("grade" => "<span class='text-secondary font-weight-bold'>D</span>", "remark" => "<span class='text-secondary font-weight-bold'>Pass</span>");
    }else if($allTotalScoreAverage < 40){
      return array("grade" => "<span class='text-danger font-weight-bold'>F</span>", "remark" => "<span class='text-danger font-weight-bold'>Fail</span>");
    }
   
  } 
?>



<?php
if($School=="Junior Secondary School")
{
 
   





     $key_To_Grades='<span class="text-success font-weight-bold" style="margin-right:10px;"><i>A (Excellent)75% and Above</i></span>
     <span class="text-primary font-weight-bold" style="margin-right:10px;"><i>B (Very Good)69% - 74%</i></span>
     <span class="text-info font-weight-bold" style="margin-right:10px;"><i>C (Good)50% - 68%</i></span>
     <span class="text-secondary font-weight-bold" style="margin-right:10px;"><i>D(Pass)40% - 49%</i></span>
     
     <span class="text-danger font-weight-bold" style="margin-right:10px;"><i>F (Fail)39% and Below</i></span>';





}




else if($School=="Senior Secondary School"){
    
  


        $key_To_Grades='<span class="text-success font-weight-bold" style="margin-right:10px;"><i>A1 (Excellent)75% and Above</i></span>
     <span class="text-primary font-weight-bold" style="margin-right:10px;"><i>B2 (Very Good)70% - 74%</i></span>
     <span class="text-primary font-weight-bold" style="margin-right:10px;"><i>B3 (Good)65% - 69%</i></span>
     <span class="text-info font-weight-bold" style="margin-right:10px;"><i>C4 (Credit)60% - 64%</i></span>
     <span class="text-info font-weight-bold" style="margin-right:10px;"><i>C5 (Credit)55% - 59%</i></span>
     <span class="text-info font-weight-bold" style="margin-right:10px;"><i>C6 (Credit)50% - 54%</i></span>
     <span class="text-secondary font-weight-bold" style="margin-right:10px;"><i>D7 (Pass)45% - 49%</i></span>
     <span class="text-warning font-weight-bold" style="margin-right:10px;"><i>E8 (Pass)40% - 44%</i></span>
     <span class="text-danger font-weight-bold" style="margin-right:10px;"><i>F9 (Fail)39% and Below</i></span>';



}
else if($School=="Senior Secondary School 1"){
    
  


  $key_To_Grades='<span class="text-success font-weight-bold" style="margin-right:10px;"><i>A1 (Excellent)75% and Above</i></span>
<span class="text-primary font-weight-bold" style="margin-right:10px;"><i>B2 (Very Good)70% - 74%</i></span>
<span class="text-primary font-weight-bold" style="margin-right:10px;"><i>B3 (Good)65% - 69%</i></span>
<span class="text-info font-weight-bold" style="margin-right:10px;"><i>C4 (Credit)60% - 64%</i></span>
<span class="text-info font-weight-bold" style="margin-right:10px;"><i>C5 (Credit)55% - 59%</i></span>
<span class="text-info font-weight-bold" style="margin-right:10px;"><i>C6 (Credit)50% - 54%</i></span>
<span class="text-secondary font-weight-bold" style="margin-right:10px;"><i>D7 (Pass)45% - 49%</i></span>
<span class="text-warning font-weight-bold" style="margin-right:10px;"><i>E8 (Pass)40% - 44%</i></span>
<span class="text-danger font-weight-bold" style="margin-right:10px;"><i>F9 (Fail)39% and Below</i></span>';



}

?>








<?php
 $teacherComment="";

                      if($teacherCustomRemark=="")



                      {





                      
                      
                      if($totalAverageSummation<=560)
                      {

                        $teacherComment="Fail";




                      }
                      

                      if($totalAverageSummation>=561)
                      {

                        $teacherComment="Pass";




                      }



                      if($totalAverageSummation>=757)
                      {

                        $teacherComment="Good";




                      }


                      if($totalAverageSummation>=827)
                      {

                        $teacherComment="Very Good";




                      }


                      if($totalAverageSummation>=966)
                      {

                        $teacherComment="Excellent";




                      }

                      else if($totalAverageSummation=="")
                      {

                       

                        $teacherComment="No Comment";
                        $principal_promotion_comment="No Comment";
                      




                      }







                      




                    }



                    else if($totalAverageSummation=="")
                      {

                        $teacherCustomRemark="No Comment";
                       

                       
                      




                      }

                    else{

                       $teacherCustomRemark;

                       $teacherComment="";

                   }



                      
                      
                      
                      ?>














                      