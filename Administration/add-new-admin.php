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
//If a link in the nav bar is active


$pageActiveTag2="All Admins";
$currentPageTag="add-new-admin";


if($pageActiveTag2="All Admins"){

  $studentsExpand="";
  $ExpandAdmin="is-expanded";
  $ExpandResults="";
  $ExpandSiteManager="";
  $ExpandPinManager="";


}

if($currentPageTag="add-new-admin"){
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="";
  $searchResultByClassCurrentPageTag="";
  $addNewAdminsCurrentPageTag="active";
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



}






?>

<?php 
// side bar and header
           include('include/privilege-restrictions.php');


?>



<?php 

if($adminManagement!="YES")
{
  header("Location: index.php" );
  exit;
}
?>

























<?php

//output status from the administration table
        $outputStatusQuery = "SELECT * FROM administration";
        $outputStatusResult = mysqli_query($con, $outputStatusQuery);
	
?>


<?php 



//insert student info

$errFirstname="";
$errLastname="";
$errGender="";

$errAddress="";
$errStatus="";



$sucInsert="";
$errorInsert="";

$insertQuery="";







if(isset($_POST['submitbutton']))
{
    

    //$sql = "insert into privileges (AdminUsername, StudentManagement, AdminManagement, siteManagement, PinManagement) VALUES ('GOOD','GOOD','GOOD','GOOD','')";
    //if (mysqli_query($con, $sql)) {
      //  echo "File uploaded successfully";
   // }
 //else {
  //  echo "Failed to upload file.";
       //}
    
    $_SESSION['newAdminFirstname'] = $_POST['firstname'];
    $_SESSION['newAdminMidname'] = $_POST['midname'];
    $_SESSION['newAdminLastname'] = $_POST['lastname'];
    $_SESSION['newAdminGender'] = $_POST['gender'];
    $_SESSION['newAdminStatus'] = $_POST['status'];
    $_SESSION['newAdminPhone'] = $_POST['phone'];
    $_SESSION['newAdminEmail'] = $_POST['email'];
    $_SESSION['newAdminPassword']= uniqid();



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







    //checking if any field is empty
    if($_SESSION['newAdminFirstname'] ==""){
             
        echo $errFirstname= "First Name must not be empty";


            }

  if($_SESSION['newAdminLastname'] ==""){

    echo $errLastname= "Last Name must not be empty";


              }

  if($_SESSION['newAdminGender'] ==""){

    echo $errGender= "Gender field must not be empty";
  }

  if($_SESSION['newAdminStatus'] ==""){

    echo $errStatus= "Please Select Status";
  }

  

 




  


  if($_SESSION['newAdminFirstname'] !="" && $_SESSION['newAdminLastname'] !="" && $_SESSION['newAdminGender'] !="")
    {
    

    $insertQuery = "INSERT INTO administration (First_Name, Middle_Name, Last_Name, ProfilePic, Gender,Signature,Username, Status, Password, Phone, Email, privileged_Status, Restriction) VALUES
    ('".$_SESSION['newAdminFirstname']."','".$_SESSION['newAdminMidname']."','".$_SESSION['newAdminLastname']."','".$image."','".$_SESSION['newAdminGender']."',' ',' ','".$_SESSION['newAdminStatus']."',
     '". $_SESSION['newAdminPassword']." ', '".$_SESSION['newAdminPhone']."', '".$_SESSION['newAdminEmail']."', 'None', 'Activated'
    )";
    
      
    //$insertQuery = "Insert into students FirstName ='".$insertFirstname."', MiddleName='".$insertMidname."', LastName='".$insertLastname."', Class='".$insertClass."', session='".$insertSession."', Term='".$insertTerm."' , SportHouse='".$insertHouse."', Gender='".$insertGender."', DOB='".$insertDOB."', 
    //   State_Of_Origin ='".$insertState."', LGA='".$insertLGA."', Phone='".$insertPhone."', Email='".$insertEmail."', Address='".$insertAddress."'";
   }



    
   $insertResult ="";
    
   if($insertQuery)
   
   
   {
   
       $insertResult = mysqli_query($con, $insertQuery);
   }
   
   
   
   
   
   if($insertResult)
   {
       
   
    header("Location:add-privileges.php" );
    exit;

   }
   
   
   
   
   
   else if (!$insertResult)
   
   
   {
   
     // echo  $errorInsert= "Error";
    //  exit;
   }


    

  



                     

                     


    

}

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
    <title>New Admin</title>
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
  
  





  
  </head>
  <body class="app sidebar-mini">



  <?php 
// side bar and header
          include('include/nav_header.php');


        ?>





    <main class="app-content">
        




      <div class="row user">
        <div class="col-md-12">
          <div class="profile">
            
            <!--<div class="cover-image"></div>-->

            <!--begin::Content-->
			<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            
        





            

            <!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container" style="margin-top:10px; width:75%">
								<!--begin::Card-->
								<div class="card card-custom gutter-b">
									<!--begin::Body-->
									<div class="card-body p-0">
										<!--begin::Wizard-->
										<div class="wizard wizard-1" id="kt_contact_add" data-wizard-state="step-first" data-wizard-clickable="true">
											<div class="kt-grid__item">
												<!--begin::Wizard Nav-->
												<div class="wizard-nav border-bottom">
													<div class="wizard-steps p-8 p-lg-10">
                                                      <a class="btn btn-secondary" style="margin-left:80%" href="all-admins.php"> Back</a>
													</div>
												</div>
												<!--end::Wizard Nav-->
											</div>
											<div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
												<div class="col-xl-12 col-xxl-7">
													<!--begin::Form Wizard Form-->
													<form class="form" id="kt_form_1" method="post" enctype="multipart/form-data">
														<!--begin::Form Wizard Step 1-->
														<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

															<h3 class="mb-10 font-weight-bold text-dark">Personal Details: <?php echo $errorInsert?></h3>
												   <div class="form-group row">
													 <label class="col-xl-3 col-lg-3 col-form-label">Profile Pic</label>
													<div class="col-lg-9 col-xl-6">
														<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(images/profile-pics/blank.png)">
															<div class="image-input-wrapper" style="background-image: url(images/profile-pics/<?php// echo $profilePic ;?>)"></div>
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
                                                                            <input class="form-control form-control-lg form-control-solid" name="firstname" type="text" value="" />
                                                                            
																		</div>
                                                                    </div>
                                                                    <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Middle Name</label>
																		<div class="col-lg-6 col-xl-6">
                                                                            <input class="form-control form-control-lg form-control-solid" name="midname" type="text" value="" />
                                                                            <span class="form-text text-muted">This Field can be left blank if Admin doesnt have a middle name</span>
                                                                            <span class="form-text text-muted" style="color:red;"><?php echo $errFirstname;?></span>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
																		<div class="col-lg-6 col-xl-6">
                                                                            <input class="form-control form-control-lg form-control-solid" name="lastname" type="text" value="" />
                                                                            <span class="form-text text-muted" style="color:red;"><?php echo $errLastname;?></span>
																		</div>
                                                                    </div>
                                                                    <div class="form-group row align-items-center">
																		<label class="col-xl-3 col-lg-3 col-form-label">Gender</label>
																		<div class="col-lg-9 col-xl-6">
																			<div class="checkbox-inline">
																				<label class="checkbox">
																				<input name="gender" type="radio"  value="Male"/>
																				<span></span>Male</label>
																				<label class="checkbox">
																				<input name="gender" type="radio" value="Female" />
																				<span></span>Female</label>
																			
																			</div>
                                                                        </div>
                                                                        <span class="form-text text-muted" style="color:red;"><?php echo $errGender;?></span>
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
																				<input type="text" class="form-control form-control-lg form-control-solid" name="phone" value="" placeholder="Phone" />
																			</div>
																			<span class="form-text text-muted">This is Optional. Proceed if this information is unavailable at the moment</span>
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
                                                                                <input type="text" class="form-control form-control-lg form-control-solid" name="email" value=""/>
                                                                                
                                                                                </select>
                                                                            
                            
                                                                            </div>
                                                                            <span class="form-text text-muted">This is Optional. Proceed if this information is unavailable at the moment</span>
																		</div>
																	</div>



																	<div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Appoint As</label>
																		<div class="col-lg-6 col-xl-6">
                                                                            <select class="form-control form-control-lg form-control-solid" name="status" value="">
                                                                            <option value="">---Select---</option>
                                                                            
                                                                            <option value="Administrator">Administrator</option>
                                                                            <option value="Teacher">Teacher</option>
                                                                            <span class="form-text text-muted" style="color:red;"><?php echo $errStatus;?></span>
                                                                            
                                                                            
                                                                            </select>
                                                                            
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
										</div>
										<!--end::Wizard-->
									</div>
									<!--end::Body-->
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>
                        <!--end::Entry-->
                        
                        </div>
					<!--end::Content-->
            








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


<?php
unset($_SESSION["newAdminFirstname"]);
unset($_SESSION["newAdminLastname"]);
unset($_SESSION["newAdminGender"]);
unset($_SESSION["newAdminStatus"]);
unset($_SESSION["newAdminEmail"]);
unset($_SESSION["newAdminPhone"]);
unset($_SESSION["sno"]);
unset($_SESSION["username"]);

?>