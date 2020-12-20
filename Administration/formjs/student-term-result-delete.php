<?php session_start();?>
<?php
//database connection
include('../include/db.php');

 
?>
<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag3="Results";
$currentPageTag="search result by Class";


if($pageActiveTag3="Results"){

  $studentsExpand="";
  $ExpandAdmin="";
  $ExpandResults="is-expanded";
  $ExpandSiteManager="";
  $ExpandPinManager="";

    


}

if($currentPageTag="search result by Class"){
  
  $searchResultByClassCurrentPageTag="active";
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="";
  
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




}






?>
<?php 

 include('../include/privilege-restrictions.php');


?>



<?php if($resultManagement!="YES")
{
    header("Location: ../dashboard.php" );
exit;
}
?>
<?php

	
	
$studentDetailQuery = "SELECT * FROM students where student_id= '".$_SESSION['classResultStudentID']."'";
$studentDetailResult = mysqli_query($con, $studentDetailQuery);




// Loop through each row, outputting the login and password
while ($studentDetailrow = mysqli_fetch_array($studentDetailResult))
{
$student_id = $studentDetailrow['student_id'];





}			



?>


<?php



$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($con, "DELETE FROM results WHERE Sno='" . $_POST["users"][$i] . "'");
}
header("Location:../student-term-result.php?studentID=$student_id");
?>