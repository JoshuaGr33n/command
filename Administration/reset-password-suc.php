
<?php 
if($_GET['resetPasswordEmail']=="")
{

header("Location: index.php");
exit;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Reset Password Successful</title>
    
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Administration</h1>
      </div>
      <div class="login-box" style="padding-left:6%; padding-top:5%">

      <?php
      echo $emailSent = '<tr>
       <p> <td style="color:#fff"><span style="">New Password sent to:</span></td></p>  
        <td><strong> '.$_GET['resetPasswordEmail'].' </strong></td>  
 
 
      </tr>';

      ?>
      <br/>
      


<a href="index.php" class="btn btn-primary" style="margin-top:20%; width:60%"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</a>
       
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>


