<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}





//database connection
include('include/db.php');








?>
<?php 
$setResultMarkCurrentPageTag="";

$studentsExpand="";
$ExpandAdmin="";
$ExpandResults="";
$ExpandSiteManager="";
$ExpandPinManager="";




$pinGeneratorCurrentPageTag="active";
  $allPinCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="";
  $searchResultByClassCurrentPageTag="";
  $addNewAdminsCurrentPageTag="";
  $allAdminsCurrentPageTag="";
  $addnewStudentsCurrentPageTag="";
  $promoteStudentsCurrentPageTag="";
  $classPositionCurrentPageTag="";
  $updateSchoolDetailsCurrentPageTag="";
  $importRegSubjectCurrentPageTag="";
  $allSubjectCurrentPageTag="";
  $allSessionCurrentPageTag="";
  $sportHouseCurrentPageTag="";
  $allClassesCurrentPageTag="";
  $studentsActiveTag="";
  $dashboardActiveTag="";
?>

<?php 
// side bar and header
include('include/privilege-restrictions.php');


?>










<?php

	
	
		$adminDetailQuery = "SELECT * FROM administration where Sno= '".$_SESSION['AdministratorSno']."'";
        $adminDetailResult = mysqli_query($con, $adminDetailQuery);
	
	
	
	
	// Loop through each row, outputting the login and password
while ($adminDetailRow = mysqli_fetch_array($adminDetailResult))
{
$sno = $adminDetailRow['Sno'];
$fname = $adminDetailRow['First_Name'];
$mName = $adminDetailRow['Middle_Name'];
$lname = $adminDetailRow['Last_Name'];
$email = $adminDetailRow['Email'];
$username = $adminDetailRow['Username'];
$fone = $adminDetailRow['Phone'];
$status =$adminDetailRow['Status'];
$profilePic = $adminDetailRow['ProfilePic'];
$gender = $adminDetailRow['Gender'];
$password = $adminDetailRow['Password'];



if($adminDetailRow['Gender']=="Male"){

	$male="checked";
	$female="";

	
	}
	
	else if($adminDetailRow['Gender']=="Female"){
	
	  $female="checked";
	  $male="";
	  
	  
	  
	}


}			
	
	
	
	?>




<?php
$sucUpdate="";
$errorUpdate="";

$editAdminQuery="";

if(isset($_POST['submitbutton']))
{

	$dir="images/profile-pics/";
    $image=$_FILES['profile-pic']['name'];
    $temp_name=$_FILES['profile-pic']['tmp_name'];
 
    if($image!="")
    {
        if(file_exists($dir.$image))
        {
			$image= time().'_'.$image;
		}
		
	
 
        $fdir= $dir.$image;
		move_uploaded_file($temp_name, $fdir);
		
	}


	if($image=="")
    {
        if(file_exists($dir.$image))
        {
			$image= time().'_'.$image;
		}
		
	
 
        $fdir= $dir.$image;
		move_uploaded_file($temp_name, $fdir);
		
	}


        if($_POST['firstname']!="" && $_POST['lastname']!="" && $_POST['gender'] !="" && $_FILES['profile-pic']['size']>5000)
        {



        

    //update administration table
   $editAdminQuery = "Update administration set First_Name = '".$_POST['firstname']."', Middle_Name = '".$_POST['midname']."', Last_Name = '".$_POST['lastname']."',
    Gender = '".$_POST['gender']."', Email = '".$_POST['email']."', ProfilePic = '".$image."', Phone = '".$_POST['phone']."'
     
    Where  Sno = '". $sno."'";


    

        }

$editAdminResult ="";
    
    if($editAdminQuery)
    
    
    {
    
      $editAdminResult = mysqli_query($con, $editAdminQuery);
    }
    
    
    
    
    
    if($editAdminResult)
    {
    
        header("Location: edit-my-profile.php");
        exit;
    
    }
    
    
    
    
    
    else if (!$editAdminResult)
    
    
    {
    
      echo $errorUpdate= "Error";
      exit;
    }
  }
?>






<?php

//output status from the administration table
        $outputStatusQuery = "SELECT * FROM administration";
        $outputStatusResult = mysqli_query($con, $outputStatusQuery);
	
?>
	
		


<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="description" content="">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="">
    <meta property="twitter:site" content="">
    <meta property="twitter:creator" content="">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="">
    <meta property="og:title" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="">
    <title>My Profile</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  



  <!--begin::Page Custom Styles(used by this page)-->
  <link href="external/css/pages/wizard/wizard-1526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
   <!--end::Page Custom Styles-->

  <!--begin::Global Theme Styles(used by all pages)-->
        <link href="external/plugins/global/plugins.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="external/plugins/custom/prismjs/prismjs.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="external/css/style.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="external/css/themes/layout/header/base/light526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="external/css/themes/layout/header/menu/light526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="external/css/themes/layout/brand/dark526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="external/css/themes/layout/aside/dark526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
  
  
<!--style for the table in this page only-->

<style type="style/css">

td:last-child div:{
    margin-left:20%;
}


</style>


<!--style for the table in this page only-->




  
  </head>
  <body class="app sidebar-mini">



  <?php 
// side bar and header
           include('include/nav_header.php');


        ?>





<main class="app-content">
      <div class="row user"  style=" margin-top:5%; margin-left:25%">
        <div class="col-md-12">
          <div class="profile" >
            
            <!--<div class="cover-image"></div>-->

            <!--begin::Card-->
										<div class="card card-custom gutter-b example example-compact"  style="width:70%;">
											<div class="card-header">
												<h3 class="card-title"> <a href="my-profile.php" class="btn btn-sm btn btn-secondary font-weight-bold py-2 px-3 px-xxl-5 my-1">Back</a></h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
                                                    
                                                    
                                                    <a href=" edit-my-password.php" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="color:#fff;">Change Password</a>
                                                    
													</div>
												</div>
											</div>
											<div class="card-body">
                                            <form class="form" id="kt_form_1" method="post"  enctype="multipart/form-data">
														<!--begin::Form Wizard Step 1-->
														<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
															<h3 class="mb-10 font-weight-bold text-dark">Make Changes:</h3>
															<div class="form-group row">
													 <label class="col-xl-3 col-lg-3 col-form-label">Profile Pic</label>
													<div class="col-lg-9 col-xl-6">
														<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(images/profile-pics/blank.png)">
															<div class="image-input-wrapper" style="background-image: url(images/profile-pics/<?php echo $profilePic ;?>)"></div>
																<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Image">
																	<i class="fa fa-pen icon-sm text-muted"></i>
																	<input type="file" name="profile-pic" accept=".png, .jpg, .jpeg" />
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
														</div>
                                                     </div>
													  </div> 
																	<div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
																		<div class="col-lg-6 col-xl-6">
                                                                            <input class="form-control form-control-lg form-control-solid" name="firstname" type="text" value="<?php echo $fname;?>" />
                                                                            
																		</div>
                                                                    </div>
                                                                    <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Middle Name</label>
																		<div class="col-lg-6 col-xl-6">
                                                                            <input class="form-control form-control-lg form-control-solid" name="midname" type="text" value="<?php echo $mName;?>" />
                                                                            <span class="form-text text-muted"></span>
                                                                            <span class="form-text text-muted" style="color:red;"></span>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
																		<div class="col-lg-6 col-xl-6">
                                                                            <input class="form-control form-control-lg form-control-solid" name="lastname" type="text" value="<?php echo $lname ;?>" />
                                                                            <span class="form-text text-muted" style="color:red;"></span>
																		</div>
                                                                    </div>
                                                                    <div class="form-group row align-items-center">
																		<label class="col-xl-3 col-lg-3 col-form-label">Gender</label>
																		<div class="col-lg-9 col-xl-6">
																			<div class="checkbox-inline">
																				<label class="checkbox">
																				<input name="gender" type="radio"  value="Male" <?php echo $male;?>/>
																				<span></span>Male</label>
																				<label class="checkbox">
																				<input name="gender" type="radio" value="Female" <?php echo $female;?>/>
																				<span></span>Female</label>
																			
																			</div>
                                                                        </div>
                                                                        <span class="form-text text-muted" style="color:red;"></span>
                                                                    </div>
                                                                    
                                                                    <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
																		<div class="col-lg-6 col-xl-6">
																			<div class="input-group input-group-lg input-group-solid">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-phone">(+234)</i>
																					</span>
																				</div>
																				<input type="text" class="form-control form-control-lg form-control-solid" name="phone" value="<?php echo $fone ;?>" placeholder="Phone" />
																			</div>
																			<span class="form-text text-muted"></span>
																		</div>
																	</div>

                                                                    <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
																		<div class="col-lg-6 col-xl-6">
																			<div class="input-group input-group-lg input-group-solid">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-at"></i>
																					</span>
																				</div>
                                                                                <input type="text" class="form-control form-control-lg form-control-solid" name="email" value="<?php echo $email ;?>"/>
                                                                                
                                                                                </select>
                                                                            
                            
                                                                            </div>
                                                                            <span class="form-text text-muted"></span>
																		</div>
																	</div>



																
                                                                   
																	

                                                                    
                                                                    
															

                                                                    
            
                                                                    


                                                           
														<!--end::Form Wizard Step 1-->
														
														<!--begin::Wizard Actions-->
														<div>
															
															<div>
																<input type="submit" name="submitbutton" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Submit"/>
																
															</div>
														</div>
														<!--end::Wizard Actions-->
													</form>
													<!--end::Form Wizard Form-->
												 
											</div>
										</div>
										<!--end::Card-->
            
        





            

          





          </div>
        </div>
        
        
      </div>
    </main>
    <!--handle conflict-->
    <script src='js/jquery-3.3.1.min.js'></script>
<script>
var jq132 = jQuery.noConflict();
</script>
<script src='external/plugins/global/plugins.bundle526f.js?v=7.0.8'></script>
<script>
var jq142 = jQuery.noConflict();
</script>
<!--handle conflict-->
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
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
		<script src="external/plugins/global/plugins.bundle526f.js?v=7.0.8"></script>
		<script src="external/plugins/custom/prismjs/prismjs.bundle526f.js?v=7.0.8"></script>
		<script src="external/js/scripts.bundle526f.js?v=7.0.8"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="external/js/pages/widgets526f.js?v=7.0.8"></script>
		<script src="external/js/pages/custom/profile/profile526f.js?v=7.0.8"></script>
        <!--end::Page Scripts-->

        <!--begin::Page Scripts(used by this page)-->
		<!--<script src="external/js/pages/custom/contacts/add-contact526f.js"></script>-->
        <!--end::Page Scripts-->
        

        <!--begin::Page Scripts(used by this page) for all form validation-->
		<script src="external/js/form-controlsForNewAdmin526f.js?"></script>
        <!--end::Page Scripts-->
        
        
        
        




  </body>
</html>


