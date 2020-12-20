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
 $query = "SELECT * FROM students";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr> 
                         <th>First Name</th> 
                         <th>Middle Name</th> 
                         <th>Last Name</th>
                         <th>Registration Number</th>
                         <th>Class</th>
                         <th>Gender</th> 
                         <th>D.O.B</th> 
                         <th>Sport-House</th>
                         <th>Address</th> 
                         <th>State of Origin</th>
                         <th>LGA</th> 
                         <th>Phone</th>
                         <th>Email</th>       
                         

                       
                         
                       
                         
                        
                        
                         
                         

      
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
  header('Content-Disposition: attachment; filename=all-students-template.xls');
  echo $output;
 }
}
?>
