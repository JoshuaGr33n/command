<?php session_start();?>
<?php
include('../include/db.php');

 
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

 include('../include/privilege-restrictions.php');


?>



<?php if($studentManagement!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>
<?php
if($addEditStudentM!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>
<?php

	
	
$studentDetailQuery = "SELECT * FROM students WHERE student_id= '".$_SESSION['delete_Student_id']."'";
$studentDetailResult = mysqli_query($con, $studentDetailQuery);





while ($studentDetailrow = mysqli_fetch_array($studentDetailResult))
{
$student_id = $studentDetailrow['student_id'];




}			





?>

<?php





mysqli_query($con, "DELETE FROM students WHERE student_id='" .$student_id. "'");
mysqli_query($con, "DELETE FROM registered_subjects WHERE StudentID='" .$student_id. "'");
mysqli_query($con, "DELETE FROM results WHERE StudentID='" .$student_id. "'");


header("Location:../all-students.php");
exit;







?>