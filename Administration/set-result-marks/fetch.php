<?php  
 //fetch.php  

//database connection
include('../include/db2.php');

 if(isset($_POST["sno"]))  
 {  
      $query  = "SELECT * FROM result_marks WHERE Sno = '" .$_POST["sno"] . "'";
      $result = mysqli_query($con, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>