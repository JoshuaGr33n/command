<?php session_start();?>
<?php
include('../include/db.php');

 
$setResultMarkCurrentPageTag="";

 include('../include/privilege-restrictions.php');


?>



<?php if($pinManagement!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>



<?php



$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($con, "DELETE FROM pinlogin WHERE serial='" . $_POST["users"][$i] . "'");
}
header("Location:../all-pins.php");
?>