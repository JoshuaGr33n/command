
<?php $commandantsComment ="No Comment";?>
<?php
if($School=="Junior Secondary School")
{
 
    $credit = mysqli_query($con, "SELECT * FROM `results` WHERE school_session='$_SESSION[school_session]' AND Term='$_SESSION[term]' AND class='$_SESSION[class]' AND  Grade IN ('A','B','C')  AND StudentReg ='$_SESSION[RegNum]' AND Publish ='YES' ");
    while($row_credit = $credit->fetch_array()){
      $sub_english = mysqli_query($con, "SELECT * FROM `results` WHERE subject='English Language' AND school_session='$row_credit[school_session]' AND Term='$row_credit[Term]' AND class='$row_credit[class]'  AND  Grade IN ('A','B','C') AND StudentReg ='$row_credit[StudentReg]' AND Publish ='YES'");
      $sub_maths = mysqli_query($con, "SELECT * FROM `results` WHERE subject='Mathematics' AND school_session='$row_credit[school_session]' AND Term='$row_credit[Term]' AND class='$row_credit[class]'  AND  Grade IN ('A','B','C') AND StudentReg ='$row_credit[StudentReg]' AND Publish ='YES'");
    
    
    
    if(mysqli_num_rows($credit) >= 6 && mysqli_num_rows($sub_english) == 1 && mysqli_num_rows($sub_maths) == 1){
      $commandantsComment="Good Results";
    }
    else if(mysqli_num_rows($credit) >= 7 && mysqli_num_rows($sub_english) < 1 && mysqli_num_rows($sub_maths) == 1){
      $commandantsComment="Put Effort in English Language";
    }
    else if(mysqli_num_rows($credit) >= 7 && mysqli_num_rows($sub_english) == 1 && mysqli_num_rows($sub_maths) < 1){
      $commandantsComment="Put Effort in Mathematics";
    }
    else if(mysqli_num_rows($credit) >= 6 && mysqli_num_rows($sub_english) < 1 && mysqli_num_rows($sub_maths) < 1){
      $commandantsComment="No English Language and Mathematics";
    }
    
    else{
    $commandantsComment="Poor";
    }
    
    
    }






    if($row_results['Grade']=="A"){


        $row_results['Grade']='<span class="text-success font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
        
        
        $row_results['Remark']='<span class="text-success font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }
        if($row_results['Grade']=="B"){
        
          $row_results['Grade']='<span class="text-primary font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-primary font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }
        if($row_results['Grade']=="C"){
        
        
        
          $row_results['Grade']='<span class="text-info font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-info font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }
        
        
        
        
        if($row_results['Grade']=="D"){
        
          $row_results['Grade']='<span class="text-secondary font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-secondary font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }
        
       
        
        if($row_results['Grade']=="F"){
          $row_results['Grade']='<span class="text-danger font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-danger font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }





     $key_To_Grades='<span class="text-success font-weight-bold" style="margin-right:10px;"><i>A (Excellent)75% and Above</i></span>
     <span class="text-primary font-weight-bold" style="margin-right:10px;"><i>B (Very Good)69% - 74%</i></span>
     <span class="text-info font-weight-bold" style="margin-right:10px;"><i>C (Good)50% - 68%</i></span>
     <span class="text-secondary font-weight-bold" style="margin-right:10px;"><i>D(Pass)40% - 49%</i></span>
     
     <span class="text-danger font-weight-bold" style="margin-right:10px;"><i>F (Fail)39% and Below</i></span>';





}




else if($School=="Senior Secondary School"){
    
    $credit = mysqli_query($con, "SELECT * FROM `results` WHERE school_session='$_SESSION[school_session]' AND Term='$_SESSION[term]' AND class='$_SESSION[class]' AND  Grade IN ('A1','B2','B3','C4','C5','C6')  AND StudentReg ='$_SESSION[RegNum]' AND Publish ='YES' ");
    while($row_credit = $credit->fetch_array()){
      $sub_english = mysqli_query($con, "SELECT * FROM `results` WHERE subject='English Language' AND school_session='$row_credit[school_session]' AND Term='$row_credit[Term]' AND class='$row_credit[class]'  AND  Grade IN ('A1','B2','B3','C4','C5','C6') AND StudentReg ='$row_credit[StudentReg]' AND Publish ='YES'");
      $sub_maths = mysqli_query($con, "SELECT * FROM `results` WHERE subject='Mathematics' AND school_session='$row_credit[school_session]' AND Term='$row_credit[Term]' AND class='$row_credit[class]'  AND  Grade IN ('A1','B2','B3','C4','C5','C6') AND StudentReg ='$row_credit[StudentReg]' AND Publish ='YES'");
    
    
    
    if(mysqli_num_rows($credit) >= 5 && mysqli_num_rows($sub_english) == 1 && mysqli_num_rows($sub_maths) == 1){
      $commandantsComment="Good Results";
    }
    else if(mysqli_num_rows($credit) >= 6 && mysqli_num_rows($sub_english) < 1 && mysqli_num_rows($sub_maths) == 1){
      $commandantsComment="Put Effort in English Language";
    }
    else if(mysqli_num_rows($credit) >= 6 && mysqli_num_rows($sub_english) == 1 && mysqli_num_rows($sub_maths) < 1){
      $commandantsComment="Put Effort in Mathematics";
    }
    else if(mysqli_num_rows($credit) >= 5 && mysqli_num_rows($sub_english) < 1 && mysqli_num_rows($sub_maths) < 1){
      $commandantsComment="No English Language and Mathematics";
    }
    
    else{
    $commandantsComment="Poor";
    }
    
    
    }




    if($row_results['Grade']=="A1"){


        $row_results['Grade']='<span class="text-success font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
        
        
        $row_results['Remark']='<span class="text-success font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }
        if($row_results['Grade']=="B2"){
        
          $row_results['Grade']='<span class="text-primary font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-primary font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }


        if($row_results['Grade']=="B3"){
        
            $row_results['Grade']='<span class="text-primary font-weight-bold">' .$row_results['Grade']. '</span>';
          
          
            $row_results['Remark']='<span class="text-primary font-weight-bold">' .$row_results['Remark']. '</span>';
          
          
          
          
          }





        if($row_results['Grade']=="C4"){
        
        
        
          $row_results['Grade']='<span class="text-info font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-info font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }

        if($row_results['Grade']=="C5"){
        
        
        
            $row_results['Grade']='<span class="text-info font-weight-bold">' .$row_results['Grade']. '</span>';
          
          
            $row_results['Remark']='<span class="text-info font-weight-bold">' .$row_results['Remark']. '</span>';
          
          
          
          
          }
          if($row_results['Grade']=="C6"){
        
        
        
            $row_results['Grade']='<span class="text-info font-weight-bold">' .$row_results['Grade']. '</span>';
          
          
            $row_results['Remark']='<span class="text-info font-weight-bold">' .$row_results['Remark']. '</span>';
          
          
          
          
          }
        
        
        
        
        if($row_results['Grade']=="D7"){
        
          $row_results['Grade']='<span class="text-secondary font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-secondary font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }
        
        if($row_results['Grade']=="E8"){
        
          $row_results['Grade']='<span class="text-warning font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-warning font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }
        
        if($row_results['Grade']=="F9"){
          $row_results['Grade']='<span class="text-danger font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-danger font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }


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
    
  $credit = mysqli_query($con, "SELECT * FROM `results` WHERE school_session='$_SESSION[school_session]' AND Term='$_SESSION[term]' AND class='$_SESSION[class]' AND  Grade IN ('A1','B2','B3','C4','C5','C6')  AND StudentReg ='$_SESSION[RegNum]' AND Publish ='YES' ");
  while($row_credit = $credit->fetch_array()){
    $sub_english = mysqli_query($con, "SELECT * FROM `results` WHERE subject='English Language' AND school_session='$row_credit[school_session]' AND Term='$row_credit[Term]' AND class='$row_credit[class]'  AND  Grade IN ('A1','B2','B3','C4','C5','C6') AND StudentReg ='$row_credit[StudentReg]' AND Publish ='YES'");
    $sub_maths = mysqli_query($con, "SELECT * FROM `results` WHERE subject='Mathematics' AND school_session='$row_credit[school_session]' AND Term='$row_credit[Term]' AND class='$row_credit[class]'  AND  Grade IN ('A1','B2','B3','C4','C5','C6') AND StudentReg ='$row_credit[StudentReg]' AND Publish ='YES'");
  
  
  
  if(mysqli_num_rows($credit) >= 5 && mysqli_num_rows($sub_english) == 1 && mysqli_num_rows($sub_maths) == 1){
    $commandantsComment="Good Results";
  }
  else if(mysqli_num_rows($credit) >= 6 && mysqli_num_rows($sub_english) < 1 && mysqli_num_rows($sub_maths) == 1){
    $commandantsComment="Put Effort in English Language";
  }
  else if(mysqli_num_rows($credit) >= 6 && mysqli_num_rows($sub_english) == 1 && mysqli_num_rows($sub_maths) < 1){
    $commandantsComment="Put Effort in Mathematics";
  }
  else if(mysqli_num_rows($credit) >= 5 && mysqli_num_rows($sub_english) < 1 && mysqli_num_rows($sub_maths) < 1){
    $commandantsComment="No English Language and Mathematics";
  }
  
  else{
  $commandantsComment="Poor";
  }
  
  
  }




  if($row_results['Grade']=="A1"){


      $row_results['Grade']='<span class="text-success font-weight-bold">' .$row_results['Grade']. '</span>';
      
      
      
      
      $row_results['Remark']='<span class="text-success font-weight-bold">' .$row_results['Remark']. '</span>';
      
      
      
      
      }
      if($row_results['Grade']=="B2"){
      
        $row_results['Grade']='<span class="text-primary font-weight-bold">' .$row_results['Grade']. '</span>';
      
      
        $row_results['Remark']='<span class="text-primary font-weight-bold">' .$row_results['Remark']. '</span>';
      
      
      
      
      }


      if($row_results['Grade']=="B3"){
      
          $row_results['Grade']='<span class="text-primary font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-primary font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }





      if($row_results['Grade']=="C4"){
      
      
      
        $row_results['Grade']='<span class="text-info font-weight-bold">' .$row_results['Grade']. '</span>';
      
      
        $row_results['Remark']='<span class="text-info font-weight-bold">' .$row_results['Remark']. '</span>';
      
      
      
      
      }

      if($row_results['Grade']=="C5"){
      
      
      
          $row_results['Grade']='<span class="text-info font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-info font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }
        if($row_results['Grade']=="C6"){
      
      
      
          $row_results['Grade']='<span class="text-info font-weight-bold">' .$row_results['Grade']. '</span>';
        
        
          $row_results['Remark']='<span class="text-info font-weight-bold">' .$row_results['Remark']. '</span>';
        
        
        
        
        }
      
      
      
      
      if($row_results['Grade']=="D7"){
      
        $row_results['Grade']='<span class="text-secondary font-weight-bold">' .$row_results['Grade']. '</span>';
      
      
        $row_results['Remark']='<span class="text-secondary font-weight-bold">' .$row_results['Remark']. '</span>';
      
      
      
      
      }
      
      if($row_results['Grade']=="E8"){
      
        $row_results['Grade']='<span class="text-warning font-weight-bold">' .$row_results['Grade']. '</span>';
      
      
        $row_results['Remark']='<span class="text-warning font-weight-bold">' .$row_results['Remark']. '</span>';
      
      
      
      
      }
      
      if($row_results['Grade']=="F9"){
        $row_results['Grade']='<span class="text-danger font-weight-bold">' .$row_results['Grade']. '</span>';
      
      
        $row_results['Remark']='<span class="text-danger font-weight-bold">' .$row_results['Remark']. '</span>';
      
      
      
      
      }


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