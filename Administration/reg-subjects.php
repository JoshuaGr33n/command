<?php session_start();?>

<?php


	//database connection
  include('include/db.php');
?>
<?php 
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
?>

<?php
  
  include('include/privilege-restrictions.php');
  
  


  if($addEditStudentM!="YES")
  {
    header("Location: index.php" );
    exit;
  }

  if($studentManagement!="YES")
  {
      header("Location: index.php" );
  exit;
  }

  if($_GET['studentID']=="")
{
    header("Location: index.php" );
exit;
}









	
$studentDetailQuery = "SELECT * FROM students where student_id= '".$_GET['studentID']."'";
$studentDetailResult = mysqli_query($con, $studentDetailQuery);

$studentDetailrow = mysqli_fetch_array($studentDetailResult);
$student_id = $studentDetailrow['student_id'];
$fname = $studentDetailrow['FirstName'];
$mName = $studentDetailrow['MiddleName'];
$lname = $studentDetailrow['LastName'];
$email = $studentDetailrow['Email'];
$dob = $studentDetailrow['DOB'];
$fone = $studentDetailrow['Phone'];
$term = $studentDetailrow['Term'];
$session = $studentDetailrow['session'];
$class = $studentDetailrow['Class'];
$sportHouse = $studentDetailrow['SportHouse'];
$state = $studentDetailrow['State_Of_Origin'];
$lga = $studentDetailrow['LGA'];
$address = $studentDetailrow['Address'];
$profilePic = $studentDetailrow['ProfilePic'];
$regNum = $studentDetailrow['RegNum'];
$gender = $studentDetailrow['Gender'];

$studentName= $fname .' '. $lname;			



?>

<?php

$current_class = substr($class, 0, 5);





if($current_class =="SSS 1"){

  $School="Senior Secondary School 1";
      
      
      }
else{
    
    $current_class = substr($class, 0, 3);
    
    if($current_class =="JSS")
    {
     $School="Junior Secondary School";
    
    }
    
    else if ($current_class =="SSS"){
    
    $School="Senior Secondary School";
    
    }

    else{
      header("Location: dashboard.php");
      exit;
    }
  }   
?>
<?php





$sucResult="";

if ($_POST['subjectID'] ==""){


  header("Location: register-subjects.php?studentID=$student_id");
        exit;



}

if(isset($_POST['save']))
{
   $subjectname = $_POST['subjectname']; 
  if(COUNT($_POST['subjectID']) >0){
   foreach ($_POST['subjectID'] as $key => $value) {
     $subj=mysqli_query($con, "SELECT * FROM `subjects` WHERE subjectID='$value' ");
     $row_subject=mysqli_fetch_array($subj);
     $ck_row=mysqli_query($con, "SELECT subjectName,  subjectID, StudentReg, School, current_class FROM  `registered_subjects` WHERE subjectName='$row_subject[subjectName]' AND subjectID='$value' AND StudentReg='$regNum'  AND School='$School' AND current_class='$class' ");
     if(mysqli_num_rows($ck_row) < 1){

     mysqli_query($con, "INSERT INTO `registered_subjects`(`SerialNo`, `subjectName`, `subjectID`, `StudentID`,`StudentReg`, `student_name`, `School`,  `current_class`) VALUES (NULL, '$row_subject[subjectName]','$value','$student_id','$regNum','$studentName','$School','$class') ");
     }

     else{

      header("Location: register-subjects.php?studentID=$student_id");
        exit;
     }



     


   }
   $sucResult=mysqli_query($con, "SELECT * FROM `registered_subjects` WHERE `StudentID` ='$student_id' ");
   header("location: ./register-subjects-suc.php?studentID=".$student_id);
  }else{
    return "No Subject was selected !!";
  }
      
}


?>