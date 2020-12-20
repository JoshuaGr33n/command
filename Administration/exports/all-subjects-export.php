<?php session_start();?>
<?php
 
//database connection
include('../include/db.php');
$setResultMarkCurrentPageTag="";

$studentsExpand="";
$ExpandAdmin="";
$ExpandResults="";
$ExpandSiteManager="";
$ExpandPinManager="";




$pinGeneratorCurrentPageTag="active";
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




if($studentManagement!="YES")
{
    header("Location: ../dashboard.php" );
exit;
}
if($addEditStudentM!="YES")
{
    header("Location: ../dashboard.php" );
exit;
}







if(!isset($_POST["export"]))
{

     header("Location: ../dashboard.php" );
     exit;

}

$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM subjects ";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr> <th>Subjects</th> 
                        
      
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>                  
      
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=subjects.xls');
  echo $output;
 }
}

?>