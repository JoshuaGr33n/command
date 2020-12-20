<?php session_start();?>


<?php
//check if data is inputed before loading this page
if($_SESSION['insertFirstname'] =="")
    {
header("Location: dashboard.php" );
exit;
}

if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


//database connection
include('include/db.php');


?>

<?php

//student information
$studentDetailQuery = "SELECT * FROM students where  RegNum='".$_SESSION['regNumber']."'";
        $studentDetailResult = mysqli_query($con, $studentDetailQuery);
	
	
	
	
	
while ($studentDetailrow = mysqli_fetch_array($studentDetailResult))
{
	$student_id = $studentDetailrow['student_id'];
	$profilePic  = $studentDetailrow['ProfilePic'];

  
  

}			


	
    ?>


















<?php
$setResultMarkCurrentPageTag="";

//If a link in the nav bar is active


$pageActiveTag="All Students";
$currentPageTag="add-new-students";



if($pageActiveTag="All Students"){

  
  $studentsExpand="is-expanded";
   $ExpandAdmin="";
   $ExpandResults="";
   $ExpandSiteManager="";
   $ExpandPinManager="";
  


}








if($currentPageTag="add-new-students"){
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="";
  $searchResultByClassCurrentPageTag="";
  $addNewAdminsCurrentPageTag="";
  $allAdminsCurrentPageTag="";
  $addnewStudentsCurrentPageTag="active";
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

if($studentManagement!="YES" && $addEditStudentM !="YES")
{
    header("Location: index.php" );
exit;
}
?>

<?php

//output all from students table
        $allStudentQuery = "SELECT * FROM students";
        $allStudentResult = mysqli_query($con, $allStudentQuery);
	
	




?>











<?php
$errorUpdate="";
$PassportQuery="";
if(isset($_POST['passportButton']))
{
   


$dir="images/student-passport/";
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

   $PassportQuery = "UPDATE students SET ProfilePic='".$image."'
	 WHERE  student_id = '".$student_id."'";

} 
   
   
   
   
   $PassportResult ="";
   
   if($PassportQuery)
   
   
   {
   
	$PassportResult = mysqli_query($con, $PassportQuery);
   }
   
   
   
   
   
   if($PassportResult)
   {
   
   header("Location: add-new-student-suc.php");
   exit;
  
   }
   
   
   
   
   
   else if (!$PassportResult)
   
   
   {
   
	  $errorUpdate= "Error";
	  
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
    <title>Success</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  





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
            
        





            

            <!--begin::Entry-->
						<div class="d-flex flex-column-fluid"  style="margin-top:20px;">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Profile Personal Information-->
								<div class="d-flex flex-row">


									
                  
									<!--begin::Content-->
									<div class="flex-row-fluid ml-lg-8">
										<!--begin::Card-->
										<div class="card card-custom card-stretch">
											<!--begin::Header-->
											<div class="card-header py-3">
												<div class="card-title align-items-start flex-column">
													<h3 class="card-label font-weight-bolder text-dark"><?php echo $_SESSION['insertFirstname'];?> <?php echo $_SESSION['insertLastname'];?></h3>
													<span class="text-muted font-weight-bold font-size-sm mt-1">Registration Successful</span>
												</div>
												<div class="card-toolbar">
                          
                          <a href="add-new-student.php" class="btn btn-sm btn-success font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1">Add Another Student +</a>
                          <a href="student-details.php?studentID=<?php echo $student_id;?>" class="btn btn-sm btn-primary font-weight-bold mr-2" style="margin-right:10px;">View Profile <!--<span class="svg-icon">...</span>--></a>
                          
                          <a href="edit-student-info.php?edit=<?php echo $student_id;?>" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Make Changes</a>
                          
                          <!--<button type="reset" class="btn btn-success mr-2"><a href="" style="color:white;">Make Changes</a></button>-->
													<a class="btn btn-secondary" href="all-students.php"> Back</a>
												</div>
											</div>
											<!--end::Header-->
											<!--begin::Form-->
										
												<!--begin::Body-->
												<div class="card-body">
													<div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mb-6">Student Info</h5>
														</div>
													</div>
													<form class="form" method="post" enctype="multipart/form-data">
														<!--begin::Form Wizard Step 1-->
														<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
															<h3 class="mb-10 font-weight-bold text-dark"></h3>
															<div class="form-group row">
													 <label class="col-xl-3 col-lg-3 col-form-label">Profile Pic</label>
													<div class="col-lg-9 col-xl-6">
														<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(images/profile-pics/blank.png)">
															<div class="image-input-wrapper" style="background-image: url(images/student-passport/<?php echo $profilePic;?>)"></div>
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
														</div>
                                                     </div>
													 <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label"></label>
														<div class="col-lg-9 col-xl-6">
                                                          <input class="btn btn-success mr-2" type="submit" value="Upload Passport" name="passportButton" />
                                                           
                                                            <span class="form-text" style="color:red;"></span>
														</div>

                          

													
														
							                          </div>

                                            </div> 
											</form>
                          
                          
                          
                          
                          <!--info sub headings-->
                          <div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mt-10 mb-6">Personal Details</h5>
														</div>
                          </div>
                          <!---->
                          



													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo strtoupper($_SESSION['insertFirstname']);?>" disabled />
														</div>
                          </div>
                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Middle Name</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo strtoupper($_SESSION['insertMidname']);?>"  disabled/>
														</div>
													</div>

													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo strtoupper($_SESSION['insertLastname']);?>" disabled/>
														</div>
                          </div>
                          

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Gender</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $_SESSION['insertGender'];?>" disabled/>
														</div>
													</div>


                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Date Of Birth</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $_SESSION['insertDOB'];?>" disabled/>
														</div>
                          </div>


                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Address</label>
														<div class="col-lg-9 col-xl-6">
															<textarea class="form-control form-control-lg form-control-solid" disabled><?php echo $_SESSION['insertAddress'];?></textarea>
														</div>
                          </div>

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">State Of Origin</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $_SESSION['insertState'];?>" disabled />
															<!--<span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>-->
                            </div>
                          </div>  

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">LGA</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $_SESSION['insertLGA'];?>" disabled />
															<!--<span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>-->
                            </div>
                          </div>  




                          




                          
                           <!--info sub headings--> 
                          <div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mt-10 mb-6">School Details</h5>
														</div>
                          </div>
                          <!---->




                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Registration Number</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo strtoupper($_SESSION['regNumber']);?>" disabled />
															<!--<span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>-->
                                                        </div>
                          </div>  

													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Current Class</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $_SESSION['insertClass'];?>" disabled />
															<!--<span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>-->
                            </div>
                          </div>  
                            
                          

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Current Session</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $_SESSION['insertSession'];?>" disabled />
															
                            </div>
                            
                          </div>
                          

                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Current Term</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $_SESSION['insertTerm'];?>" disabled />
															
                            </div>
                            
                          </div>


                




                          <div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">House</label>
														<div class="col-lg-9 col-xl-6">
															<input class="form-control form-control-lg form-control-solid" type="text" value="<?php echo $_SESSION['insertHouse'];?>" disabled />
															
                            </div>
                            
                          </div>
                          



                          
                          






													 <!--info sub headings-->
                          <div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mt-10 mb-6">Contact Details</h5>
														</div>
                          </div>
                          <!---->
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
														<div class="col-lg-9 col-xl-6">
															<div class="input-group input-group-lg input-group-solid">
																<div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="la la-phone"></i>
																	</span>
																</div>
																<input type="text" class="form-control form-control-lg form-control-solid" value="<?php echo $_SESSION['insertPhone'];?>" placeholder="None" disabled />
															</div>
															<!--<span class="form-text text-muted">We'll never share your email with anyone else.</span>-->
														</div>
													</div>
													<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
														<div class="col-lg-9 col-xl-6">
															<div class="input-group input-group-lg input-group-solid">
																<div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="la la-at"></i>
																	</span>
																</div>
																<input type="text" class="form-control form-control-lg form-control-solid" value="<?php echo $_SESSION['insertEmail'];?>" placeholder="None" disabled />
															</div>
														</div>
													</div>
													
												</div>
												<!--end::Body-->
											</form>
											<!--end::Form-->
										</div>
									</div>
									<!--end::Content-->
								</div>
								<!--end::Profile Personal Information-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->

            








          </div>
        </div>
        
        
      </div>
    </main>
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
		<script src="external/plugins.bundle526f.js?v=7.0.8"></script>
		<script src="external/plugins/custom/prismjs/prismjs.bundle526f.js?v=7.0.8"></script>
		<script src="external/js/scripts.bundle526f.js?v=7.0.8"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="external/js/pages/widgets526f.js?v=7.0.8"></script>
		<script src="external/js/pages/custom/profile/profile526f.js?v=7.0.8"></script>
		<!--end::Page Scripts-->




  </body>
</html>
  


  

    
    
    
        
    
    
    
    
    
    
    



  



                     

                     


    








