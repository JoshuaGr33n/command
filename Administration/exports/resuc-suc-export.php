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




if($resultManagement!="YES")
{
    header("Location: ../index.php" );
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
 $query = "SELECT * FROM results where subject ='".$_SESSION['searchSubject']."' and school_session ='".$_SESSION['searchSession']."'and class ='".$_SESSION['searchClass']."'and Term ='".$_SESSION['searchTerm']."'";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr> 
                         <th>Registration Number</th> 
                         <th>Student Name</th>
                         <th>Class</th>  
                         <th>Subject</th>  
                         <th>Subject Code</th>  
                         <th>Year</th>  
                         <th>Term</th>  
                         <th>CA1</th> 
                         <th>CA2</th> 
                         <th>CA3</th> 
                         <th>Exam</th>  
      
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
    $studentDetailQuery = "SELECT * FROM students where student_id= '".$row["StudentID"]."'";
    $studentDetailResult = mysqli_query($con, $studentDetailQuery);
    
    $studentDetailrow = mysqli_fetch_array($studentDetailResult);
   
    $fname = $studentDetailrow['FirstName'];
   
    $lname = $studentDetailrow['LastName'];
    $fname=strtoupper($fname);
    $lname=strtoupper($lname);
    
    


   $output .= '
    <tr>                 
                         <td>'.$row["StudentReg"].'</td>
                         <td>'.$fname.' '.$lname.'</td>
                         <td>'.$row["class"].'</td>  
                         <td>'.$row["subject"].'</td>  
                         <td>'.$row["subjectID"].'</td>    
                         <td>'.$row["school_session"].'</td>  
                         <td>'.$row["Term"].'</td> 
                         <td>'.$row["CA1"].'</td>
                         <td>'.$row["CA2"].'</td>
                         <td>'.$row["CA3"].'</td>
                         <td>'.$row["Exam"].'</td> 
      
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Result_for_'.$_SESSION['searchSubject'].'_'.$_SESSION['searchSession'].'_'.$_SESSION['searchClass'].'_'.$_SESSION['searchTerm'].'.xls');
  echo $output;
 }
}
?>
