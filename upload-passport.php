<?php session_start();?>

<?php



if($_SESSION['studentLoginstudentID'] =="")
{
header("Location: index.php" );
exit;
}

if($_SESSION['studentLoginStatus']=="Deactivated")
{
header("Location: index.php" );
exit;
}










  include('Administration/include/db.php');



  $studentLoginLinkQuery = "SELECT * FROM sitemanager where tag='Student_Login'";
  $studentLoginLinkResult = mysqli_query($con, $studentLoginLinkQuery);
 
  $studentLoginLinkRow = mysqli_fetch_array($studentLoginLinkResult);
  $studentLoginLinkStatus = $studentLoginLinkRow['Content'];
 
 if($studentLoginLinkStatus!="Activated"){
        
   header("Location: index.php" );
     exit;   
 
 }

  

	
	
  $studentDetailQuery = "SELECT * FROM students where student_id= '".$_SESSION['studentLoginstudentID']."'";
  $studentDetailResult = mysqli_query($con, $studentDetailQuery);
	
	
	
	
	// Loop through each row, outputting the login and password
while ($studentDetailrow = mysqli_fetch_array($studentDetailResult))
{
$student_id = $studentDetailrow['student_id'];
$fname = $studentDetailrow['FirstName'];
$mName = $studentDetailrow['MiddleName'];
$lname = $studentDetailrow['LastName'];
$email = $studentDetailrow['Email'];
$dob = $studentDetailrow['DOB'];
$fone = $studentDetailrow['Phone'];
$term = $studentDetailrow['Term'];
$session = $studentDetailrow['session'];
$class = $studentDetailrow['Class'];
$sportHouse = $studentDetailrow['SportHouse'];
$state = $studentDetailrow['State_Of_Origin'];
$lga = $studentDetailrow['LGA'];
$address = $studentDetailrow['Address'];
$profilePic = $studentDetailrow['ProfilePic'];
$regNum = $studentDetailrow['RegNum'];
$gender = $studentDetailrow['Gender'];
$status = $studentDetailrow['status'];




}			
		
  
  
  

  
  
  
  
  
  
  $uploadPassportQuery = "";
  $error="";
  $errImage="";
  $success="";
  
  
  if(isset($_POST['uploadPassport']))
  {
      $dir="Administration/images/student-passport/";
      $image=$_FILES['passport']['name'];
      $temp_name=$_FILES['passport']['tmp_name'];
   
      if($image!="")
      {
          if(file_exists($dir.$image))
          {
              $image= time().'_'.$image;
          }
   
          $fdir= $dir.$image;
          move_uploaded_file($temp_name, $fdir);
      }

     
  
      if($_FILES['passport']['size']>5000)
     {
     
  
        $uploadPassportQuery = "update students set ProfilePic='".$image."'
       where student_id='".$student_id."'";
     
     }  

     
  
  
     $uploadPassportResult ="";
     
     if($uploadPassportQuery)
     
     
     {
     
        $uploadPassportResult = mysqli_query($con, $uploadPassportQuery);
     }
     
     
     
     
     
     if($uploadPassportResult)
     {
     //$success="<span  class='btn btn-light-success font-weight-bold'>Passport Upload Successful</div>";
     header("Location: upload-passport.php");
     exit;
    
     }
     
     
     
     
     
     else if (!$uploadPassportResult)
     
     
     {
     
         $error= "Error!";
     }
  
  
  
   
  
  
  
                      
  
                      
  
  
     
  
  
  
  
  }
  
  
  
  
  
  
  






 $resultpageQuery = "SELECT * FROM sitemanager where tag='school_logo'";
 $resultpageResult = mysqli_query($con, $resultpageQuery);

$row = mysqli_fetch_array($resultpageResult);
$school_logo = $row['Content'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Upload Passport:: <?php echo $fname;?> <?php echo $lname;?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	

<link rel="icon" type="image/png" href="images/<?php echo $favicon;?>" sizes="16x16">


	<link rel="stylesheet" type="text/css" href="external/css/main.css">
<!--===============================================================================================-->



 
  <!--begin::Global Theme Styles(used by all pages)-->
        <link href="Administration/external/plugins/global/plugins.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		
		<link href="Administration/external/css/style.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
    <style type="text/css">
  div .table{ border-bottom:2px solid #000; font-family: Times New Roman, Times, serif; font-size:13px; height:20px;}
  span .table{ border-bottom:2px solid #000; font-family: Times New Roman, Times, serif; font-size:13px; height:20px;}




  @media only screen and (max-width: 800px) {
  .logo{font-family: Impact, Charcoal, sans-serif; font-size:20px; margin-left:30%; display:block }
.logo2{font-family: Impact, Charcoal, sans-serif; font-size:10px; margin-left:10%; display:block }



  
}
 
@media only screen and (max-width: 640px) {
	
  .logo{font-family: Impact, Charcoal, sans-serif; font-size:20px; margin-left:30%; display:block }
.logo2{font-family: Impact, Charcoal, sans-serif; font-size:10px; margin-left:10%; display:block }


  
}

    </style>
</head>
<body>
<div>
<table >


  
  <tr> 
  
  <td rowspan="2" style="width:20%"><img src="images/<?php echo $school_logo; ?>" height="100" width="100" style="margin-left:50%; margin-bottom:3%"/></td>
  <td><span style="font-family: Impact, Charcoal, sans-serif; font-size:200%; margin-left:35%" class="logo">COMMAND SECONDARY SCHOOL</span><br/><span style="font-family: Impact, Charcoal, sans-serif; font-size:150%; margin-left:45%" class="logo2"><i>...DISCIPLINE AND KNOWLEGE</i></span><br/><span style="font-size:80%; margin-left:37.5%"></span></td>
    <td  rowspan="2"></td>
    <td><li class="breadcrumb-item active"></li></td>
   
  </tr>
  <tr>
    <td style="width:50%"></td>
   
    <td><br/> <a class="text-danger" href="logout.php?logoutStudent=1" style="margin-left:60%;"> <strong>Logout</strong></a></td>
    
  </tr>
</table>
</div>





<span>

</span>
    <main class="app-content">
      <div class="row user"  style=" margin-top:5%; margin-left:25%">
        <div class="col-md-12">
          <div class="profile" >


        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact"  style="width:70%;">
											<div class="card-header">
												<h3 class="card-title"> <strong> <?php echo $fname;?> <?php echo $mName;?> <?php echo $lname;?>: <?php echo $regNum;?></strong></h3>
												<div class="card-toolbar">
                        
		                          	<?php 
                                   echo $success;
                                ?> 
                            
                          
                           
                            <?php echo $errImage;?>
                           
													<div class="example-tools justify-content-center">
                                                    
                                                    
                                                    
                                                  
                                                    
													</div>
												</div>
											</div>
											<div class="card-body">
												
											<!--Upload Passport-->
											<form class="form" method="post" enctype="multipart/form-data">
												<!--begin::Body-->
												<div class="card-body" style="margin-left:15%">
													<div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mb-6">Upload Passport</h5>
														</div>
                                                    </div>
                                                    
												<div class="form-group row" >
														<label class="col-xl-3 col-lg-3 col-form-label">Passport Here</label>
													<div class="col-lg-9 col-xl-6">
														<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(images/blank.png)">
															<div class="image-input-wrapper" style="background-image: url(Administration/images/student-passport/<?php echo $profilePic;?>)"></div>
																<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Image">
																	<i class="fa fa-pen icon-sm text-muted"></i>
																	<input type="file" name="passport" accept=".png, .jpg, .jpeg" />
																	<input type="hidden" name="profile_avatar_remove" />
																</label>
																<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span>
																<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span> 
															</div>
															<span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                              <span class="form-text text-muted">Image size must not be larger then 1 MB</span>
														</div>
                                                    </div>
											  </div>    
											  

											  <div class="form-group row" style="margin-left:15%">
														<label class="col-xl-3 col-lg-3 col-form-label"></label>
														<div class="col-lg-6 col-xl-6">
                             <input class="btn btn-success mr-2" type="submit" value="Upload Passport" name="uploadPassport" />
                                                           
                                                            <span class="form-text" style="color:red;"></span>
														</div>

                          

													
														
							</div>

							</form>
								<!--Upload Passport-->
											</div>
										</div>
										<!--end::Card-->



                                        </div>
        </div>
        
        
      </div>
    </main>
                 
  <!--handle conflict-->
  <script src='Administration/js/jquery-3.3.1.min.js'></script>
<script>
var jq132 = jQuery.noConflict();
</script>
<script src='Administration/external/plugins/global/plugins.bundle526f.js?v=7.0.8'></script>
<script>
var jq142 = jQuery.noConflict();
</script>
<!--handle conflict-->
    <!-- Essential javascripts for application to work-->
    <script src="Administration/js/jquery-3.3.1.min.js"></script>
    <script src="Administration/js/popper.min.js"></script>
    <script src="Administration/js/bootstrap.min.js"></script>
    <script src="Administration/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="Administration/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
      	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      	ga('create', 'UA-72504830-1', 'auto');
      	ga('send', 'pageview');
      }
    </script>




<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="Administration/external/plugins/global/plugins.bundle526f.js?v=7.0.8"></script>
		<script src="Administration/external/plugins/custom/prismjs/prismjs.bundle526f.js?v=7.0.8"></script>
		<script src="Administration/external/js/scripts.bundle526f.js?v=7.0.8"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="Administration/external/js/pages/widgets526f.js?v=7.0.8"></script>
		<script src="Administration/external/js/pages/custom/profile/profile526f.js?v=7.0.8"></script>
        <!--end::Page Scripts-->

        <!--begin::Page Scripts(used by this page)-->
		<!--<script src="external/js/pages/custom/contacts/add-contact526f.js"></script>-->
        <!--end::Page Scripts-->
        

        <!--begin::Page Scripts(used by this page) for all form validation-->
		<script src="Administration/external/js/form-controlsForNewAdmin526f.js?"></script>
        <!--end::Page Scripts-->
        

        
        </body>

</html>     


<?php unset($_SESSION['studentID']);?>