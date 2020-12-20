<?php session_start();?>
<?php  
 //database connection
include('../include/db2.php');
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $student_id = mysqli_real_escape_string($con, $_POST["sno"]);
      $remark = mysqli_real_escape_string($con, $_POST["remark"]); 
     
    



?>

<?php 
$class = $_SESSION['classResultClass'];
$session = $_SESSION['classResultSession'];
$term = $_SESSION['classResultTerm'];

?>

      <?php



$check_remark_rows = $con->prepare("SELECT * FROM remark WHERE StudentID = '$_POST[sno]' AND session ='$session' AND class = '$class' AND term = '$term'");
$check_remark_rows ->execute();                           
$check_remark_rows ->Store_result();

//$remark_row_count = $check_remark_rows->num_rows;
?>




      
      
 <?php
 $remark_row_count = $con->query("SELECT * FROM remark WHERE StudentID = '$_POST[sno]' AND session ='$session' AND class = '$class' AND term = '$term'");
 ?>    
      
      
      
         
        

<?php
$name="Teacher";
      if(mysqli_num_rows($remark_row_count) > 0)  
      {  
           
          $sql="UPDATE remark SET remark = '$remark' WHERE name = '$name' AND StudentID = '$student_id' AND session = '$session' AND class ='$class' AND term= '$term'";
          $updateQuery = $con->prepare($sql); 
           
           
          
       
         
          // $updateQuery->bind_param("iiiiii", $remark, $name, $student_id, $session, $class, $term); 
          
         
           $updateQuery->execute();
           
          
           
         
           
      } 

      else if(mysqli_num_rows($remark_row_count) < 1)  
       
      {  
       
          $sql = "  
        INSERT INTO remark(Sno, name, remark, StudentID, session, class, term)  
        VALUES(NULL, '$name','$remark','$student_id','$session', '$class','$term')
        ";  
        $insertQuery = $con->prepare($sql); 

        //$insertQuery->bind_param("iiiiiiii", NULL, $school,$current_session,$current_term,$ca1, $ca2, $ca3, $exam);

      

        $insertQuery->execute();
       

        }
     
        





      if($sql)  
      {  
        header("Location: com-class-results.php");
        exit; 
}  


}  
 ?>
 