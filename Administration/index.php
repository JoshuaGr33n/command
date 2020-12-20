<?php session_start();?>
<?php
	//database connection
	include('include/db.php');

if(isset($_POST['login']))
{


	

	
	
	$username = $_POST['username'];
	$password= $_POST['password'];
	
	$query1 = "SELECT * FROM administration where Username ='".$username."' and Password ='".$password."'";
	$query = mysqli_query($con, $query1);
     $result = mysqli_num_rows($query);
if($result == 0)
{
	
	$_SESSION['err'] = "Your Login Details Are Incorrect. Please Verify and Try Again";
}
while($c = mysqli_fetch_array( $query ))
{
  $_SESSION['AdministratorSno'] = $c['Sno'];
	$_SESSION['AdminFname'] = $c['First_Name'];
    $_SESSION['AdminLname']= $c['Last_Name'];
    $_SESSION['Adminusername'] = $c['Username'];
    $_SESSION['status'] = $c['Status'];
    $_SESSION['AdminRestriction'] = $c['Restriction'];

    

    


        header("Location: dashboard.php");
        exit;
    
	 
	

       
        
    

	
}
}




?>












<?php


//Reset Password


       $allAdministratorsQuery = "SELECT Email FROM Administration where Status ='Super Administrator' ";
        $allAdministratorsResult = mysqli_query($con, $allAdministratorsQuery);


        $row = mysqli_fetch_array($allAdministratorsResult);
        $superAdminEmail = $row['Email'];
	
	





       
?>

<?php

$genPasswordQuery="";
$err1="";
$emailSubject="";
if(isset($_POST['resetPassWord']))

{  


 
  
  
  //checking if students info truly exist
  if($_POST['email'] != $superAdminEmail)
     {
     $err1= "Wrong Email";
    
  
  
     }
  else{
  
  
      $genPassword=uniqid();

      //update administration table
   $genPasswordQuery = "Update administration set Password = '".$genPassword."'
     
   where Status ='Super Administrator'";


   

       

       $genPasswordResult ="";
   
   if( $genPasswordQuery)
   
   
   {
   
       $genPasswordResult = mysqli_query($con, $genPasswordQuery);
   }



   if($genPasswordResult && $_POST['email']!="")
   {

    $emailSubject="Command Secondary School:: New Password Generated";
      $mail= mail($_POST['email'],$emailSubject, $genPassword,'Command Secondary School');
      if($mail)
    
    
      {

        $resetPasswordEmail=$_POST['email'];
        header("Location: reset-password-suc.php?resetPasswordEmail=$resetPasswordEmail");
               exit;
    
      
      }
    
     else
      {
 
     echo 'error';
     exit;
 
 
      }

    }   


  }   
  



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
    <link rel="icon" type="image/png" href="images/<?php echo $favicon;?>" sizes="16x16">
    <title>Login - Administration</title>
    <style type="text/css">

.material-half-bg .cover {
  background-color: #f0ad4e;
  
}

    </style>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Administration</h1>
      </div>
      <div class="login-box">
        <form class="login-form" method="post">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
          <div class="form-group">
            <label class="control-label">USERNAME</label>
            <input class="form-control" type="text" placeholder="Username" autofocus name="username">
          </div>
          <div class="form-group">
            <label class="control-label">PASSWORD</label>
            <input class="form-control" type="password" placeholder="Password" name="password">
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
                <label>
                  <!--<input type="checkbox"><span class="label-text">Stay Signed in</span>-->
                </label>
              </div>
              <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" style="background-color: #f0ad4e;" name="login"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
        </form>
        <form class="forget-form" action="" method="post">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
          <div class="form-group">
            <label class="control-label">EMAIL</label>
            <input class="form-control" type="text" placeholder="Email" name="email">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"  style="background-color: #f0ad4e;" name="resetPassWord"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
            <p><?php echo $err1;?></p>
          </div>
        </form>
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


<?php unset($_SESSION['Adminusername']);?>