<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}

if( $_GET['adminID'] =="")
{
header("Location: index.php" );
exit;
}
if( $_GET['adminID'] == $_SESSION['AdministratorSno'])
{
header("Location: dashboard.php" );
exit;
}

//database connection
include('include/db.php');


//check for wrong url input

$check = "SELECT * FROM administration where Sno = '".$_GET['adminID']."'";
$rs = mysqli_query($con, $check);
//$data = mysqli_fetch_array($rs, MYSQLI_NUM);
$num_rows =mysqli_num_rows($rs);
$data=mysqli_fetch_array($rs);




if($_GET['adminID'] != $data['Sno'])
   {
	 

	 header("Location: dashboard.php" );
    exit;


   }





?>

<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag2="All Admins";
$currentPageTag="All-Admins";


if($pageActiveTag2="All Admins"){

    $studentsExpand="";
    $ExpandAdmin="is-expanded";
    $ExpandResults="";
    $ExpandSiteManager="";
    $ExpandPinManager="";
    


}

if($currentPageTag="All-Admins"){
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
  $allAdminsCurrentPageTag="active";
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

	
	
$adminDetailQuery = "SELECT * FROM administration where Sno= '".$_GET['adminID']."'";
$adminDetailResult = mysqli_query($con, $adminDetailQuery);




// Loop through each row, outputting the login and password
while ($adminDetailRow = mysqli_fetch_array($adminDetailResult))
{
$adminSno = $adminDetailRow['Sno'];
$fname = $adminDetailRow['First_Name'];
$mName = $adminDetailRow['Middle_Name'];
$lname = $adminDetailRow['Last_Name'];
$email = $adminDetailRow['Email'];
$username = $adminDetailRow['Username'];
$fone = $adminDetailRow['Phone'];
$status =$adminDetailRow['Status'];
$profilePic = $adminDetailRow['ProfilePic'];
$signature= $adminDetailRow['Signature'];
$gender = $adminDetailRow['Gender'];
$password = $adminDetailRow['Password'];





}			



?>


<?php



$uploadSignatureQuery = "";
$errorUpdate="";


if(isset($_POST['uploadSignature']))
{
	$dir="images/signatures/";
    $image=$_FILES['signature']['name'];
    $temp_name=$_FILES['signature']['tmp_name'];
 
    if($image!="")
    {
        if(file_exists($dir.$image))
        {
            $image= time().'_'.$image;
        }
 
        $fdir= $dir.$image;
        move_uploaded_file($temp_name, $fdir);
	}
	


   

   $uploadSignatureQuery = "update administration set Signature='".$image."'
	 where Sno='".$adminSno."'";
   
    


   $uploadSignatureResult ="";
   
   if($uploadSignatureQuery)
   
   
   {
   
	$uploadSignatureResult = mysqli_query($con, $uploadSignatureQuery);
   }
   
   
   
   
   
   if($uploadSignatureResult)
   {
   
   header("Location: admin-upload-signature.php?adminID=$adminSno");
   exit;
  
   }
   
   
   
   
   
   else if (!$uploadSignatureResult)
   
   
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
    <title>Upload Signature:: <?php echo $fname;?> <?php echo $lname;?></title>
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
      <div class="row user"  style=" margin-top:5%; margin-left:25%">
        <div class="col-md-12">
          <div class="profile" >
            
            <!--<div class="cover-image"></div>-->

            <!--begin::Card-->
										<div class="card card-custom gutter-b example example-compact"  style="width:70%;">
											<div class="card-header">
												<h3 class="card-title"> <a href="admin-profile.php?adminID=<?php echo $adminSno;?>" class="btn btn-sm btn btn-secondary font-weight-bold py-2 px-3 px-xxl-5 my-1">Back</a></h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
                                                    
                                                    
                                                    
                                                  
                                                    
													</div>
												</div>
											</div>
											<div class="card-body">
												
											<!--Upload Signature-->
											<form class="form" method="post" enctype="multipart/form-data">
												<!--begin::Body-->
												<div class="card-body">
													<div class="row">
														<label class="col-xl-3"></label>
														<div class="col-lg-9 col-xl-6">
															<h5 class="font-weight-bold mb-6">Upload Signature in Image format</h5>
														</div>
                                                    </div>
                                                    
												<div class="form-group row">
														<label class="col-xl-3 col-lg-3 col-form-label">Signature Here</label>
													<div class="col-lg-9 col-xl-6">
														<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(images/profile-pics/blank.png)">
															<div class="image-input-wrapper" style="background-image: url(images/signatures/<?php echo $signature ;?>)"></div>
																<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Image">
																	<i class="fa fa-pen icon-sm text-muted"></i>
																	<input type="file" name="signature" accept=".png, .jpg, .jpeg" />
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
														<label class="col-xl-3 col-lg-3 col-form-label"></label>
														<div class="col-lg-6 col-xl-6">
                             <input class="btn btn-success mr-2" type="submit" value="Upload" name="uploadSignature" />
                                                           
                                                            <span class="form-text" style="color:red;"></span>
														</div>

                          

													
														
							</div>

							</form>
								<!--Upload Signature-->
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


