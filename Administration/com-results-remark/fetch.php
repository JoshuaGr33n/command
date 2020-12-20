<?php session_start();?>
<?php  
 //fetch.php  

//database connection
include('../include/db2.php');

?>

<?php 
$class = $_SESSION['classResultClass'];
$session = $_SESSION['classResultSession'];
$term = $_SESSION['classResultTerm'];

?>

<?php
 if(isset($_POST["sno"]))  
 {  
      $query  = "SELECT * FROM remark WHERE StudentID = '$_POST[sno]' AND session ='$session' AND class = '$class' AND term = '$term'";
      $remark = mysqli_query($con, $query);  
      $row = mysqli_fetch_array($remark);  
      echo json_encode($row);  
 }  
 ?>