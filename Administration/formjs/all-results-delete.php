<?php session_start();?>
<?php
//database connection
include('../include/db.php');

 
 ?>
 
 <?php
$setResultMarkCurrentPageTag="";
 include('../include/privilege-restrictions.php');


?>



<?php if($resultManagement!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>



<?php



$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($con, "DELETE FROM results WHERE Sno='" . $_POST["users"][$i] . "'");
}
header("Location:../all-results.php");
?>