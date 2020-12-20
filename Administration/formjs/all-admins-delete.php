<?php session_start();?>
<?php
//database connection
include('../include/db.php');

 ?>
 <?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag2="All Admins";
$currentPageTag="All-Admins";


if($pageActiveTag2="All Admins"){

    $studentsExpand="";
    $ExpandAdmin="is-expanded";
    $ExpandResults="";
    $ExpandSiteManager="";
    $ExpandPinManager="";
    $ExpandSettings="";
    


}

if($currentPageTag="All-Admins"){
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
  $allAdminsCurrentPageTag="active";
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
  $setResultMarkCurrentPageTag="";


}






?>
 <?php
// restrictions
include('../include/privilege-restrictions.php');






 if($adminManagement!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>


<?php



$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($con, "DELETE FROM administration WHERE Sno='" . $_POST["users"][$i] . "'");
}
header("Location:../all-admins.php");
?>