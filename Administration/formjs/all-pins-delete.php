<?php session_start();?>
<?php
include('../include/db.php');

 
 ?>
 <?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag5="pin manager";
$currentPageTag="all pin";


if($pageActiveTag5="pin manager"){

    $studentsExpand="";
    $ExpandAdmin="";
    $ExpandResults="";
    $ExpandSiteManager="";
    $ExpandPinManager="is-expanded";
    $ExpandSettings="";
    


}

if($currentPageTag="all pin"){
  
  $allPinCurrentPageTag="active";
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
  $allSessionCurrentPageTag="";
  $sportHouseCurrentPageTag="";
  $allClassesCurrentPageTag="";
  $studentsActiveTag="";
  $dashboardActiveTag="";
  $setResultMarkCurrentPageTag="";



}






?>
 <?php

 include('../include/privilege-restrictions.php');


?>



<?php if($pinManagement!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>



<?php



$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($con, "DELETE FROM pinlogin WHERE serial='" . $_POST["users"][$i] . "'");
}
header("Location:../all-pins.php");







?>