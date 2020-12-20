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
 $query = "SELECT * FROM students where  Class ='". $_GET['classmate'] ."'";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr> 
                         <th>Reg Number</th> 
                         <th>Names</th>
                         <th>SUBJ 1</th>
                         <th>SUBJ 2</th>
                         <th>SUBJ 3</th>
                         <th>SUBJ 4</th>
                         <th>SUBJ 5</th>
                         <th>SUBJ 6</th>
                         <th>SUBJ 7</th>
                         <th>SUBJ 8</th>
                         <th>SUBJ 9</th>
                         <th>SUBJ 10</th>
                         <th>SUBJ 11</th>
                         <th>SUBJ 12</th>
                         <th>SUBJ 13</th>
                         <th>SUBJ 14</th>
                         <th>SUBJ 15</th>
                         <th>SUBJ 16</th>
                         <th>SUBJ 17</th>
                         <th>SUBJ 18</th>
                         <th>SUBJ 19</th>
                         <th>SUBJ 20</th>
                         <th>SUBJ 21</th>
                         <th>SUBJ 22</th>
                         <th>SUBJ 23</th>
                         <th>SUBJ 24</th>
                         <th>SUBJ 25</th>
                         <th>SUBJ 26</th>
                         <th>SUBJ 27</th>
                         
      
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>                 
                         <td>'.$row["RegNum"].'</td>
                        
                         <td>'.$row["FirstName"].'  '.$row["LastName"].'</td>  
                        
      
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename='.$_GET['classmate'] .'.xls');
  echo $output;
 }
}
?>