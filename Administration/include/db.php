<?php

//database connection
$con = mysqli_connect('localhost','ResultChecker','ResultChecker') or die('cant connect');
//mysql_select_db('projectTest') or die('cant select'); PHP 5
mysqli_select_db($con, 'command_school') or die(mysqli_error($con));







?>







<!--favicon-->
<?php
  



 $faviconQuery = "SELECT * FROM sitemanager where tag='favicon'";
 $faviconResult = mysqli_query($con, $faviconQuery);

$faviconRow = mysqli_fetch_array($faviconResult);
$favicon = $faviconRow['Content'];
?>

<link rel="icon" type="image/png" href="../images/<?php echo $favicon;?>" sizes="16x16">
<link rel="icon" type="image/png" href="../../images/<?php echo $favicon;?>" sizes="16x16">

<!--favicon-->