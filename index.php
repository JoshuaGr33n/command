<?php session_start();?>
<?php
include('Administration/include/db.php');

?>
<?php 

$pin_number_of_times_query= $con->prepare("SELECT content_for_integer FROM sitemanager  WHERE tag = 'pin_number_of_times'");

$pin_number_of_times_query->execute();                            
$pin_number_of_times_query->Store_result();                       
$pin_number_of_times_query->bind_result($pin_number_of_times);  
$pin_number_of_times_query->fetch();
$pin_number_of_times_query->close();
?>
<?php



$err1="";
$err3="";
$err="";

if(!isset($_POST['annualResult']))

{


	$_POST['annualResult']="";
}

if(isset($_POST['login']))
{
    $updateQuery="";
    $ID = $_POST['ID'];
    $pin = $_POST['pin'];
    $class = $_POST['class'];
    $schoolSession = $_POST['schoolSession'];
	$term = $_POST['term'];
	$annualResult = $_POST['annualResult'];
	$_SESSION['annualResult'] = $annualResult;
    
	
	
	if($term == "Second" && $annualResult == "Annual Result"){

		header("Location: index.php");
		exit;
		

		


	}

	else if($term == "First" && $annualResult == "Annual Result"){

		header("Location: index.php");
		exit;

		


	}




//fetch details from pinlogin table
$fetchpinloginQuery = "SELECT * FROM pinlogin where PinCode = '".$pin."'";
$fetchpinloginResult = mysqli_query($con, $fetchpinloginQuery);

// Loop through each row, outputting the login and password
//while ($test = @mysqli_fetch_array($result, MYSQL_ASSOC)) PHP 5

while ($pinTableRow = @mysqli_fetch_assoc($fetchpinloginResult))
{
$studentID = $pinTableRow['StudentID'];
//echo $studentID;


$check = "SELECT * FROM students where RegNum = '".$ID."'";
$rs = mysqli_query($con, $check);
//$data = mysqli_fetch_array($rs, MYSQLI_NUM);
$num_rows =mysqli_num_rows($rs);
$data=mysqli_fetch_array($rs);

$IDupperCase=strtoupper($ID);

//checking if students info truly exist
if($IDupperCase != $data['RegNum'])
   {
	 $err1= " <p>Registration Number does not exist</p>";
	
	


   }


   





                                

//integrate student Id with generated pin code

else if($pinTableRow['StudentID'] =="" && $pinTableRow['Class'] =="" && $pinTableRow['Session'] =="" && $pinTableRow['Term'] =="" ){
    

$updateQuery = "update pinlogin set StudentID='".$IDupperCase."', Class='".$class."', Session='".$schoolSession."', Term='".$term."', Status='Used'
  where PinCode='".$pin."'";

}  


$updateResult ="";
if($updateQuery)


{

    $updateResult = mysqli_query($con, $updateQuery);
}





if($updateResult)
{
//echo "<span class='saved'>Changes Saved!</span>";
}





else if (!$updateResult)


{

 $err= " <p>This Pin is not for this session</p>";
 
}


}
















    //Login: Joining both students and pinlogin table together 


    $query1 = "SELECT * FROM students INNER JOIN pinlogin ON students.RegNum = pinlogin.StudentID where students.RegNum = '".$ID."' and pinlogin.PinCode = '".$pin."'
    and pinlogin.Class = '".$class."' and pinlogin.Session = '".$schoolSession."' and pinlogin.Term = '".$term."'";


	//$query1 = "SELECT * FROM students where student_id ='".$ID."' and RegNum ='".$pin."'";
    
    
    $query = mysqli_query($con, $query1);
     $result = mysqli_num_rows($query);
       if($result == 0)
{
	
$err3 =" <p>ERROR!!</p>";


}

//if login is successful start a session
while($c = mysqli_fetch_array( $query ))
{
    $_SESSION['FName'] = $c['FirstName'];
    $_SESSION['MName'] = $c['MiddleName'];
    $_SESSION['LName'] = $c['LastName'];
    $_SESSION['class']= $c['Class'];
    $_SESSION['school_session'] = $c['Session'];
    $_SESSION['term'] = $c['Term'];
    $_SESSION['sHouse'] = $c['SportHouse'];
    $_SESSION['ProfilePic'] = $c['ProfilePic'];
    $_SESSION['gender'] = $c['Gender'];
	$_SESSION['DOB'] = $c['DOB'];
	$_SESSION['studentID'] = $c['student_id'];
	$_SESSION['status'] = $c['status'];
    $_SESSION['RegNum'] = $c['RegNum'];




    $_SESSION['pinCode'] = $c['PinCode'];
    $_SESSION['count'] = $c['LoginCount'];

    //record the number of times the user logs in
    if($_SESSION['count'] < $pin_number_of_times)
    {
	$currentDate = date('Y-m-d g:i:s');
    $loginCountQuery = "Update pinlogin set LoginCount = LoginCount + 1, last_login ='$currentDate'
     
    Where  PinCode = '".$_SESSION['pinCode']."'";


    $updateCount = mysqli_query($con,  $loginCountQuery);
	
	}
	

	
    
	 if($term == "Third" && $annualResult == "Annual Result"){

		header("Location: annual-result.php");
		exit;


	}
	else{

	header("Location: results.php");
	exit;

	}
	

	






}

}











?>

<?php

//output all from class table
        $allClassQuery = "SELECT * FROM classes where className not in ('GRADUATED STUDENT')";
		$allClassResult = mysqli_query($con, $allClassQuery);
		
		//in ('JSS 1', 'JSS 2', 'JSS 3', 'SSS 1', 'SSS 2', 'SSS 3')
	
?>


<?php

//output all from school_session table
        $allSessionQuery = "SELECT * FROM school_session";
        $allSessionResult = mysqli_query($con, $allSessionQuery);
	
?>

<?php

//output all from sport_house table
        $allSportHouseQuery = "SELECT * FROM sportHouse";
        $allSportHouseResult = mysqli_query($con, $allSportHouseQuery);
	
?>





<?php
  



 $frontpageQuery = "SELECT * FROM sitemanager where tag='Heading'";
 $frontpageResult = mysqli_query($con, $frontpageQuery);

$row = mysqli_fetch_array($frontpageResult);
$heading = $row['Content'];
?>



<?php
  



 $frontpageQuery = "SELECT * FROM sitemanager where tag='Annoucement'";
 $frontpageResult = mysqli_query($con, $frontpageQuery);

$row = mysqli_fetch_array($frontpageResult);
$annoucement = $row['Content'];
?>

<?php
  



 $frontpageQuery = "SELECT * FROM sitemanager where tag='Front_Page_Background'";
 $frontpageResult = mysqli_query($con, $frontpageQuery);

$row = mysqli_fetch_array($frontpageResult);
$bg = $row['Content'];
?>

<?php
  



 $faviconQuery = "SELECT * FROM sitemanager where tag='favicon'";
 $faviconResult = mysqli_query($con, $faviconQuery);

$row = mysqli_fetch_array($faviconResult);
$favicon = $row['Content'];
?>

<?php
  



 $annualResultFormQuery = "SELECT * FROM term where Term='Annual Result'";
 $annualResultFormResult = mysqli_query($con, $annualResultFormQuery);

$annualResultFormRow = mysqli_fetch_array($annualResultFormResult);
$annualResultFormStatus = $annualResultFormRow['Status'];

if ($annualResultFormStatus=="Activated"){
       
	$annualResultForm='<div style="margin-top:20px">
	
	<label style="color:#18171d">Check Annual Result</label>
	<input type="checkbox" style="margin-left:10px" name="annualResult" value="Annual Result"/>
	
	<span></span>
     </div>';

}
else{
    
	$annualResultForm="";


}




?>






<?php
  
//student login link


 $studentLoginLinkQuery = "SELECT * FROM sitemanager where tag='Student_Login'";
 $studentLoginLinkResult = mysqli_query($con, $studentLoginLinkQuery);

 $studentLoginLinkRow = mysqli_fetch_array($studentLoginLinkResult);
 $studentLoginLinkStatus = $studentLoginLinkRow['Content'];

if ($studentLoginLinkStatus=="Activated"){
       
	$studentLoginLink="<div style='margin-top:30px; margin-left:60%'><a href='student-login.php'>Student Login</a></div>";

}
else{
    
	$studentLoginLink="";


}




?>
<?php
  



  $resultpageQuery = "SELECT * FROM sitemanager where tag='school_logo'";
  $resultpageResult = mysqli_query($con, $resultpageQuery);
 
 $row = mysqli_fetch_array($resultpageResult);
 $school_logo = $row['Content'];
 ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.w3layouts.com/demos_new/template_demo/15-12-2017/course_register_form-demo_Free/1876413846/web/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Aug 2020 19:34:07 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<title>Result Checker</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //custom-theme -->
<!-- css files -->
<link href="http://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">  

<!-- //css files -->

<link rel="stylesheet" href="css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->


<link rel="icon" type="image/png" href="images/<?php echo $favicon;?>" sizes="16x16">



<style type="text/css">
.register-right{
	
	color:#18171d;background:#fff;border:0; box-shadow: 5px 5px 5px 5px #888888;
}
.register-in{
	
	border-radius:10px;background:#fff;
}
a {color:#18171d}
select {
 
font-family:  sans-serif;
  color: #18171d;
  text-decoration:bold;
  margin-top:10px
 
}
select option {
  margin: 40px;
  background: #e8f0fe;
  color: #000;
  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
}

</style>

</head>
<!-- body starts -->
<body style="background-color:#dfe2e7">
<script src='../../../../../../../ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script><script src="../../../../../../../m.servedby-buysellads.com/monetization.js" type="text/javascript"></script>



<!-- section -->
<section class="register">
	<div class="register-full">
		<div class="register-left">
			<div class="register">
				<div class="logo">
				<img src="images/<?php echo $school_logo; ?>" width="300" height="300"/>
				</div>
				<h1></h1>
				<p><?php //echo $annoucement;?></p>
				<div class="content3">
			
				</div>
			</div>
		</div>
		<div class="register-right">
			<div class="register-in">
				<h2 style="color:#18171d"><span class="fa fa-pencil"></span> Result Checker</h2>
				<div class="register-form">
					<form action="#" method="post">
						<div class="fields-grid">
							<div class="">
								<input type="text" name="ID" required value="" style="border-bottom:2px #eee solid;color:#18171d"/> 
								<label style="color:#18171d">Student Registration Number*</label>
								<span></span>
							</div>
							<div class="">
								<input type="text" name="pin" required style="border-bottom:2px #eee solid;color:#18171d; margin-top:10px"/> 
								<label style="color:#18171d">PinCode*</label>
								<span></span>
							</div>
							
                            <div class="col-xl-6">
				               <div class="form-group">
							   
								<select name="class" placeholder="Class" required>
                                 <option value=""></option>

                                <?php  while ($allClassRow = mysqli_fetch_array($allClassResult))
                                                             {
                                        //output all from classes table
                                        $class_id =$allClassRow['classID']; 
                                             
                                         $ClassName = $allClassRow['className'];
                                                                
                                              ?>

                                     <option value="<?php echo $ClassName ;?>"><?php echo $ClassName ;?></option>
                                            <?php }?>  
                                        <select>
										<label style="color:#18171d">Class</label>
											</div>
                                            </div>
                                            

							<div class="col-xl-6">
								<div class="form-group">
								
									<select  name="schoolSession" placeholder="School Year" required>
                                     <option value=""></option>

                                     <?php  while ($allSessionRow = mysqli_fetch_array($allSessionResult))
                                                             {
                                                                //output all from school_session table
                                                                 $school_Session_id =$allSessionRow['sessionID']; 
                                             
                                                                $school_SessionName = $allSessionRow['sessionName'];
                                                                
                                                                ?>

                                                                <option value="<?php echo $school_SessionName;?>"><?php echo $school_SessionName ;?></option>
                                                                <?php }?>
                                                                            <select>
																			<label style="color:#18171d">School Session*</label>
																	</div>
																</div>
                              </div>
							
							<div class="">
                           
								<select  id="category2" required name="term">
									<option value=""></option>
									<option value="First">First Term</option>
									<option value="Second">Second Term</option>
									<option value="Third">Third Term</option>
									
									
								</select>
								<label style="color:#18171d">Term*</label>
								<span>
								
								
								
								
								
								
								</span>
							</div>



							<?php  echo $annualResultForm; ?>






							
						<input type="submit" value="Submit" name="login" style="background-color:#2664a1; border:solid #18171d">
					</form>
					
				</div>
				
			
			
			  <div class="clear"> </div>
			   <span style="color:#FF0000"><?php echo $err3;?></span><br/>
			    <span style="color:#FF0000"><?php echo $err;?></span><br/>
			    <span style="color:#FF0000"><?php echo $err1;?></span>
			    <span style="color:#FF0000">
			    <?php 
			     if (isset ($_GET['message'])){
			      echo "<p>".$_GET['message']."</p>"; 
			      }?>
			   </span>

			


			 

		    </div>
		

			

			
		</div>
		
		
	<div class="clear"> </div>
	<?php echo $studentLoginLink;?>

	<div style="color:#FFF; margin-top:30px; margin-left:60%"><a href="Administration/index.php">Administration</a></div>
	</div>

	
	<!---728x90--->
	<!-- copyright -->
	
	<!-- //copyright -->
	<!---728x90--->
</section>
<!-- //section -->
</body>	
<!-- //body ends -->

<!-- Mirrored from demo.w3layouts.com/demos_new/template_demo/15-12-2017/course_register_form-demo_Free/1876413846/web/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Aug 2020 19:34:13 GMT -->
</html>








<?php unset($_SESSION['studentID']);?>
<?php unset($_SESSION['studentLoginstudentID']);?>