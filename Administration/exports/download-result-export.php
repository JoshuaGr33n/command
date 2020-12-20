<?php session_start();?>
<?php  





//export.php  
//database connection
include('../include/db.php');
$setResultMarkCurrentPageTag="";

$studentsExpand="";
$ExpandAdmin="";
$ExpandResults="";
$ExpandSiteManager="";
$ExpandPinManager="";




$pinGeneratorCurrentPageTag="";
  $allPinCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="";
  $searchResultByClassCurrentPageTag="";
  $addNewAdminsCurrentPageTag="";
  $allAdminsCurrentPageTag="";
  $addnewStudentsCurrentPageTag="";
  $promoteStudentsCurrentPageTag="";
  $classPositionCurrentPageTag="";
  $updateSchoolDetailsCurrentPageTag="";
  $importRegSubjectCurrentPageTag="";
  $allSubjectCurrentPageTag="";
  $allSessionCurrentPageTag="";
  $sportHouseCurrentPageTag="";
  $allClassesCurrentPageTag="";
  $studentsActiveTag="";
  $dashboardActiveTag="";

include('../include/privilege-restrictions.php');




if($resultManagement!="YES")
{
    header("Location: ../index.php" );
exit;
}


?>
<?php
   $current_term_query= $con->prepare("SELECT Term FROM term WHERE Status= 'Current' ");
   $current_term_query->execute();                          
   $current_term_query->Store_result();                      
   $current_term_query->bind_result($current_term);  
   $current_term_query->fetch();
   $current_term_query->close();
   
   
   
   
      
   
   $current_session_query= $con->prepare("SELECT sessionName FROM school_session WHERE Status= 'Current' ");
   $current_session_query->execute();                          
   $current_session_query->Store_result();                      
   $current_session_query->bind_result($current_session);  
   $current_session_query->fetch();
   $current_session_query->close();
  ?>


<?php

$current_class = substr($_SESSION['regClass'], 0, 5);





if($current_class =="SSS 1"){

  $School="Senior Secondary School 1";
      
      
      }
else{
    
    $current_class = substr($_SESSION['regClass'], 0, 3);
    
    if($current_class =="JSS")
    {
     $School="Junior Secondary School";
    
    }
    
    else if ($current_class =="SSS"){
    
    $School="Senior Secondary School";
    
    }

    else{
      header("Location: ../download-result.php");
      exit;
    }
  }   
?>

<?php


if(!isset($_POST["export"]))
{

     header("Location: ../dashboard.php" );
     exit;

}
$output = '';




if(isset($_POST["export"]))
{
 $list_sub = $con->prepare("SELECT StudentID, StudentReg, student_name, subjectID, subjectName, current_class FROM registered_subjects  WHERE  School='$School' AND subjectName ='$_SESSION[regSubject]' AND current_class ='$_SESSION[regClass]'");
 $list_sub->execute(); 
 $list_sub->Store_result();  
               
 $list_sub->bind_result($reg_subjects_studentID, $reg_subjects_studentReg, $reg_subjects_student_name, $reg_subjects_subjectID, $reg_subjects_subjectName, $reg_subjects_current_class);
 $count = $list_sub->num_rows; 
 
 if($count > 0){
  $output .= '
   <table class="table" bordered="1">  
                    <tr> 
                         <th>Reg Number</th> 
                         <th>Student Name</th>
                         <th>Class</th>  
                         <th>Subject</th>  
                         <th>Subject Code</th>  
                         <th>Year</th>  
                         <th>Term</th>  
                         <th>CA1</th> 
                         <th>CA2</th> 
                         <th>CA3</th> 
                         <th>Exam</th>  
      
                    </tr>
  ';
  while($list_sub->fetch()){
    $results = $con->prepare("SELECT Sno,class,CA1,CA2,CA3,Exam,Total,Average,Grade,Remark,Teacher,Publish
    FROM `results` WHERE school_session='$current_session' 
    AND Term='$current_term' AND StudentID='$reg_subjects_studentID' 
    AND class='$reg_subjects_current_class' 
    AND  subjectID='$reg_subjects_subjectID' 
   
    Order By subjectID ASC ");
    $results->execute();                           
    $results->Store_result();                      
    $results->bind_result($results_sno, $results_class,$results_ca1, $results_ca2, $results_ca3, $results_exam, $results_total,$results_average,$results_grade,$results_remark,$results_teacher, $results_publish);
    $results->fetch();


   $output .= '
    <tr>                 
                         <td>'.$reg_subjects_studentReg.'</td>
                         <td>'.$reg_subjects_student_name.'</td>
                         <td>'.$reg_subjects_current_class.'</td>  
                         <td>'.$reg_subjects_subjectName.'</td>  
                         <td>'.$reg_subjects_studentID.'</td>    
                         <td>'.$current_session.'</td>  
                         <td>'.$current_term.'</td> 
                         <td>'.$results_ca1.'</td>  
                         <td>'.$results_ca2.'</td>    
                         <td>'.$results_ca3.'</td>  
                         <td>'.$results_exam.'</td>  
      
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename='.$_SESSION['regSubject'].'_'.$current_session.'_'.$_SESSION['regClass'].'_'.$current_term.'.xls');
  echo $output;
 }
}
?>
