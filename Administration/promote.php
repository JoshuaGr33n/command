<?php session_start();?>
<?php
	
	// Include database connection

	//database connection
include('include/db.php');


	// Insert multiple checkbox value in databse
    if(intval($_GET['q']))
    {
    $user  = intval($_GET['q']);

          
          

          $query = "UPDATE results set Promotion_Status = 'Promoted' WHERE StudentID='$user'";
          

          $result = $con->query($query);

          if ($result) {
              echo 1;
          }else{
              echo 0;
          }

  

        }



        if(intval($_GET['reverse'])){



        

          $reverse  = intval($_GET['reverse']);

          $Query = "SELECT * FROM results WHERE StudentID='$reverse'";
          $Result = mysqli_query($con, $Query);
          
          $row = mysqli_fetch_array($Result);
          $class = $row['class'];

          
          mysqli_query($con, "UPDATE results set Promotion_Status = ' ' WHERE StudentID='$reverse'");
          mysqli_query($con, "UPDATE students set Class = '$_SESSION[promoteStudentClass]' WHERE student_id='$reverse'");

          mysqli_query($con, "UPDATE registered_subjects SET current_class='$_SESSION[promoteStudentClass]'
          WHERE StudentID='$reverse'");

        }


?>