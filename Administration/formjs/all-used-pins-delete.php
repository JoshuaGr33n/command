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

   $pin_number_of_times_query= $con->prepare("SELECT content_for_integer FROM sitemanager  WHERE tag = 'pin_number_of_times'");
  
   $pin_number_of_times_query->execute();                            
   $pin_number_of_times_query->Store_result();                       
   $pin_number_of_times_query->bind_result($pin_number_of_times);  
   $pin_number_of_times_query->fetch();
   $pin_number_of_times_query->close();
?>

<?php











    mysqli_query($con, "DELETE FROM pinlogin WHERE LoginCount='$pin_number_of_times' AND Status='Used'");
    header("Location:../all-pins.php");
    exit;



?>