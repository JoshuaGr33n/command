<?php session_start();
if(isset($_GET['logout']))
 {
unset($_SESSION['studentID']);
header("Location: index.php");
 }
 
 
 if(isset($_GET['logoutStudent']))
 {
unset($_SESSION['studentLoginstudentID']);
header("Location: student-login.php");
 }
 
 
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>