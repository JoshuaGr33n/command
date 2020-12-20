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




if($pinManagement!="YES")
{
    header("Location: ../dashboard.php" );
exit;
}






if(!isset($_POST["exportAllPins"]) && !isset($_POST["exportUnusedPins"]))
{

     header("Location: ../dashboard.php" );
     exit;

}


 




$output = '';
if(isset($_POST["exportAllPins"]))
{
 $query = "SELECT * FROM pinlogin";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr> 
                    
                    <th>Pin Code</th> 
                    <th>Registration Number</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Session</th> 
                    <th>Term</th> 
                    <th>Number of times Used</th>
                    <th>Status</th> 
                    <th>Time</th> 
                   
                         

      
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {


    $studentDetailQuery = "SELECT * FROM students where RegNum= '".$row["StudentID"]."'";
    $studentDetailResult = mysqli_query($con, $studentDetailQuery);
    
    $studentDetailrow = mysqli_fetch_array($studentDetailResult);
   
    $fname = $studentDetailrow['FirstName'];
    $mName = $studentDetailrow['MiddleName'];
    $lname = $studentDetailrow['LastName'];


   $output .= '
<tr> 
    <td>'.$row["PinCode"].'</td>
    <td>'.$row["StudentID"].'</td>
    <td>'.$fname. ' '.$lname.'</td>
    <td>'.$row["Class"].'</td>    
    <td>'.$row["Session"].'</td> 
    <td>'.$row["Term"].'</td>
    <td>'.$row["LoginCount"].'</td> 
    <td>'.$row["Status"].'</td> 
    <td>'.$row["Time"].'</td>  
   
    
   
    
        
   
   
         
      
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=all-pins.xls');
  echo $output;
 }
}



















if(isset($_POST["exportUnusedPins"]))
{
 $query = "SELECT * FROM pinlogin WHERE Status='Available'";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr> 
                    
                    <th>Pin Code</th>
                    <th>Status</th> 
                    <th>Time</th> 
                   
                         

      
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {


  

   $output .= '
<tr> 
    <td>'.$row["PinCode"].'</td>
    <td>'.$row["Status"].'</td> 
    <td>'.$row["Time"].'</td>  
   
    
   
    
        
   
   
         
      
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=all-unused-pins.xls');
  echo $output;
 }
}




?>
