<?php session_start();?>
<?php
    //database connection
include('include/db.php');
	
    $id = $_GET['id'];

    

    


    

	
	
    $studentDetailQuery = "SELECT * FROM students where student_id= '".$id."'";
$studentDetailResult = mysqli_query($con, $studentDetailQuery);




// Loop through each row, outputting the login and password
while ($studentDetailrow = mysqli_fetch_array($studentDetailResult))
{
$student_id = $studentDetailrow['student_id'];
$fname = $studentDetailrow['FirstName'];
$mName = $studentDetailrow['MiddleName'];
$lname = $studentDetailrow['LastName'];
$profilePic = $studentDetailrow['ProfilePic'];
$regNum = $studentDetailrow['RegNum'];







}			
    
    
    			

			




?>



<?php

$current_class = substr($_SESSION['promoteStudentClass'], 0, 5);





if($current_class =="SSS 1"){

  $School="Senior Secondary School 1";
      
      
      }
else{
    
    $current_class = substr($_SESSION['promoteStudentClass'], 0, 3);
    
    if($current_class =="JSS")
    {
     $School="Junior Secondary School";
    
    }
    
    else if ($current_class =="SSS"){
    
    $School="Senior Secondary School";
    
    }

    else{
      header("Location: select-promote-student-category.php");
      exit;
    }
  }   
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annual Result</title>

   
</head>
<body>


<span style="margin-left:20px;"><?php echo $fname;?> <?php echo $mName;?> <?php echo $lname;?></span>
<span style="margin-left:30px;"><?php echo $regNum;?></span>

<table class="table table-hover table-bordered table-striped">
                
                <thead>
                  <tr>
                  
                    <th>Subject</th>
                    <th>First Term</th>
                    <th>Second Term</th>
                    <th>Third Term</th>
                    <th>Annual Result</th>
                   
                   

                   
                    
                  </tr>
                </thead>
                <tbody>
                <?php
                   $list_sub = $con->query("SELECT * FROM `registered_subjects` WHERE  School='$School' AND StudentReg ='$regNum' GROUP BY subjectID Order By subjectID ASC");
                   while($row_subjects = $list_sub->fetch_array()){

                    

         




                 $result = mysqli_query($con, "SELECT *,
                 
                 MAX(CASE WHEN results.Term = 'First' THEN results.Total END) 'FirstTermTotal',
                
                
                 MAX(CASE WHEN results.Term = 'Second' THEN results.Total END) 'SecondTermTotal',
         
                 
                 MAX(CASE WHEN results.Term = 'Third' THEN results.Total END) 'ThirdTermTotal',
                 SUM(results.Total) AS allTermScoreTotal FROM `results` WHERE school_session='$_SESSION[promoteStudentSession]'  AND class='$_SESSION[promoteStudentClass]' AND  subjectID='$row_subjects[subjectID]' AND StudentReg ='$regNum' AND Publish ='YES' 
                 ORDER BY results.Sno, results.StudentID DESC ");
                 $row_results = $result->fetch_array();
                 $allTotalScoreAverage=$row_results['allTermScoreTotal']/3;

                 ?>


                <tr>
                <td><?php echo $row_subjects['subjectName'];?></td>
                <td><?php echo  $row_results['FirstTermTotal'];?></td>
                <td><?php echo  $row_results['SecondTermTotal'];?></td>
                <td><?php echo  $row_results['ThirdTermTotal'];?></td>
                <td><strong><?php echo round($allTotalScoreAverage, 2);?></strong></td>
                <tr>

                <?php }?>








                </tbody>

                </table>

		<div class="modal-footer">
			
			<button type="button" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" data-dismiss="modal">Close</button>
		</div>
	
</body>
</html>
