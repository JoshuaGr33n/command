<?php session_start();?>
<?php
include('../include/db.php');
?>
<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag="All Students";
$currentPageTag="All Session";



if($pageActiveTag="All Students"){

  
  $studentsExpand="is-expanded";
  $ExpandAdmin="";
  $ExpandResults="";
  $ExpandSiteManager="";
  $ExpandPinManager="";


}








if($currentPageTag="All Session"){
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
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

  $allSessionCurrentPageTag="active";
  $sportHouseCurrentPageTag="";
  $allClassesCurrentPageTag="";
  $studentsActiveTag="";
  $dashboardActiveTag="";



}







?>
<?php
 
// restrictions
include('../include/privilege-restrictions.php');






 if($studentManagement!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>

<?php if($addEditStudentM!="YES")
{
    header("Location: ../index.php" );
exit;
}



?>
<?php



$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($con, "DELETE FROM school_session WHERE sessionID='" . $_POST["users"][$i] . "'");
}
header("Location:../all-session.php");
?>