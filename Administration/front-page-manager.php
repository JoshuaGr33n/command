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


$pageActiveTag4="site manager";
$currentPageTag="front page";


if($pageActiveTag4="site manager"){

    $studentsExpand="";
    $ExpandAdmin="";
    $ExpandResults="";
    $ExpandSiteManager="is-expanded";
    $ExpandPinManager="";

    


}

if($currentPageTag="front page"){
    $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="active";
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



}






?>

<?php 
// side bar and header
include('include/privilege-restrictions.php');


?>



<?php if($siteManagement!="YES")
{
    header("Location: index.php" );
exit;
}
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

$bgQuery="";

if(isset($_POST['bgbutton']))
{

	$dir="../images/";
    $image=$_FILES['bg']['name'];
    $temp_name=$_FILES['bg']['tmp_name'];
 
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


        if($_FILES['bg']['size']>5000)
        {



        

    //update administration table
   $bgQuery = "Update sitemanager set Content = '".$image."'
     
    Where  tag = 'Front_Page_Background'";


    

        }

 $bgResult ="";
    
    if($bgQuery)
    
    
    {
    
        $bgResult = mysqli_query($con, $bgQuery);
    }
    
    
    
    
    
    if($bgResult)
    {
    
        header("Location: front-page-manager.php");
    
    }
    
    
    
    
    
   
  }
?>




<?php
$sucUpdate="";
$errorUpdate="";

$faviconUploadQuery="";

if(isset($_POST['faviconSubmit']))
{

	$dir="../images/";
    $faviconUpload=$_FILES['faviconUpload']['name'];
    $temp_name=$_FILES['faviconUpload']['tmp_name'];
 
    if($faviconUpload!="")
    {
        if(file_exists($dir.$faviconUpload))
        {
			$faviconUpload= time().'_'.$faviconUpload;
		}
		
	
 
        $fdir= $dir.$faviconUpload;
		move_uploaded_file($temp_name, $fdir);
		
	}


	if($faviconUpload=="")
    {
        if(file_exists($dir.$faviconUpload))
        {
			$faviconUpload= time().'_'.$faviconUpload;
		}
		
	
 
        $fdir= $dir.$faviconUpload;
		move_uploaded_file($temp_name, $fdir);
		
	}


        if($_FILES['faviconUpload']['size']>5000)
        {



        

    //update logo 
   $faviconUploadQuery = "Update sitemanager set Content = '".$faviconUpload."'
     
    Where  tag = 'favicon'";



     

    

        }

 $faviconUploadResult ="";
    
    if($faviconUploadQuery)
    
    
    {
    
        $faviconUploadResult = mysqli_query($con, $faviconUploadQuery);
    }
    
    
    
    
    
    if($faviconUploadResult)
    {
    
        header("Location: front-page-manager.php");
    
    }
    
    
    
    
    
   
  }
?>










<?php
  



 $frontpageQuery = "SELECT * FROM sitemanager where tag='Front_Page_Background'";
 $frontpageResult = mysqli_query($con, $frontpageQuery);

$row = mysqli_fetch_array($frontpageResult);
$bg = $row['Content'];
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






	
   <?php  if(isset($_POST["headingButton"])) {

mysqli_query($con, "UPDATE sitemanager set Content='" . $_POST["heading"] . "' WHERE tag='Heading'");


header("Location:front-page-manager.php");
exit;      
}




?>	





	
<?php  if(isset($_POST["annoucementButton"])) {

mysqli_query($con, "UPDATE sitemanager set Content='" . $_POST["annoucement"] . "' WHERE tag='Annoucement'");


header("Location:front-page-manager.php");
exit;      
}




?>




<?php  if(isset($_POST["activateAnnualResultButton"])) {

mysqli_query($con, "UPDATE term set Status='Activated' WHERE Term='Annual Result'");


header("Location:front-page-manager.php");
exit;      
}





if(isset($_POST["deactivateAnnualResultButton"])) {

    mysqli_query($con, "UPDATE term set Status='Deactivated' WHERE Term='Annual Result'");
    
    
    header("Location:front-page-manager.php");
    exit;      
    }




?>	

<?php
  



 $annualResultButtonQuery = "SELECT * FROM term where Term='Annual Result'";
 $annualResultButtonResult = mysqli_query($con, $annualResultButtonQuery);

 $annualResultButtonRow = mysqli_fetch_array($annualResultButtonResult);
 $annualResultButtonStatus = $annualResultButtonRow['Status'];

if ($annualResultButtonStatus=="Activated"){
       
	$annualResultButton='<input type="submit" name="deactivateAnnualResultButton" class="btn btn-warning font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Deactivate Annual Result"/>';

}
else{
    
	$annualResultButton='<input type="submit" name="activateAnnualResultButton" class="btn btn-outline-warning font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Activate Annual Result"/>';


}




?>







<?php  
//student login Button


if(isset($_POST["activateStudentLoginButton"])) {

mysqli_query($con, "UPDATE sitemanager set Content='Activated' WHERE tag='Student_Login'");


header("Location:front-page-manager.php");
exit;      
}





if(isset($_POST["deactivateStudentLoginButton"])) {

    mysqli_query($con, "UPDATE sitemanager set Content='Deactivated' WHERE tag='Student_Login'");
    
    
    header("Location:front-page-manager.php");
    exit;      
    }




?>	

<?php
  



 $studentLoginButtonQuery = "SELECT * FROM sitemanager where tag='Student_Login'";
 $studentLoginButtonResult = mysqli_query($con, $studentLoginButtonQuery);

 $studentLoginButtonRow = mysqli_fetch_array($studentLoginButtonResult);
 $studentLoginButtonStatus = $studentLoginButtonRow['Content'];

if ($studentLoginButtonStatus=="Activated"){
       
	$studentLoginButton='<input type="submit" name="deactivateStudentLoginButton" class="btn btn-danger font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Deactivate Student Login"/>';

}
else{
    
	$studentLoginButton='<input type="submit" name="activateStudentLoginButton" class="btn btn-outline-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Activate Student Login"/>';


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
    <title>Site Management - Front Page</title>
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
												<h3 class="card-title"> Front-Page Manager</h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
                                                    
                                                    
                                                   
                                                    
													</div>
												</div>
											</div>
											<div class="card-body">


                                            <!--Background Image
                                            <form class="form" id="kt_form_1" method="post"  enctype="multipart/form-data">
													
														<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                                            <h3 class="mb-10 font-weight-bold text-dark"><strong>Front Page Manager:</strong></h3>
                                                            
                                                <form  class="form" id="kt_form_1" method="post"  enctype="multipart/form-data">
															<div class="form-group row">
													 <label class="col-xl-3 col-lg-3 col-form-label"><strong>Background</strong></label>
													<div class="col-lg-9 col-xl-6">
														<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(images/profile-pics/blank.png)">
															<div class="image-input-wrapper" style="background-image: url(../images/<?php echo $bg ;?>)"></div>
																<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Image">
																	<i class="fa fa-pen icon-sm text-muted"></i>
																	<input type="file" name="bg" accept=".png, .jpg, .jpeg" />
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

                                                     <div>
																<input type="submit" name="bgbutton" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Submit"/>
																
															</div>
                                                      </div>
                                            </form>
                                            Background Image-->


                                           



                                            <!--Heading

                                                     
         





                                                                   <form method="post">


												                 <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label"><strong>Heading</strong></label>
																		<div class="col-lg-6 col-xl-6">
                                                                            <input class="form-control form-control-lg form-control-solid" name="heading" type="text" value="<?php echo $heading ;?>" />
                                                                            
                                                                        </div>

                                                                            
                                                                        
                                                                        

                                                                    </div>

                                                                    <div>
																                <input type="submit" name="headingButton" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Submit"/>
																
                                                                    </div>
                                                                    
                                                                    </form>



                                                                Heading-->     


                                                    
                      

                                                            <!--Annoucement

                                                                <form method="post">
                                                                    <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label"><strong>Annoucement</strong></label>
																		<div class="col-lg-6 col-xl-6">
                                                                          
                                                                            <textarea   class="form-control form-control-lg form-control-solid" style="margin-top:20px;" rows="5" cols="50" name="annoucement"><?php echo $annoucement;?></textarea>
                                                                            <span class="form-text text-muted"></span>
                                                                            <span class="form-text text-muted" style="color:red;"></span>
                                                                        </div>

                                                                            

                                                                        
																	</div>
																	
                                                             <div>
															
															<div>
																<input type="submit" name="annoucementButton" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Submit"/>
																
															</div>
                                                        </div>
                                                    </form>

                                                     Annoucement-->

                                                      <!--favicon-->
                                           
                                                            
                                                <form  class="form" id="kt_form_1" method="post"  enctype="multipart/form-data">
															<div class="form-group row">
													 <label class="col-xl-3 col-lg-3 col-form-label"><strong>Favicon</strong></label>
													<div class="col-lg-9 col-xl-6">
														<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(images/profile-pics/blank.png)">
															<div class="image-input-wrapper" style="background-image: url(../images/<?php echo $favicon;?>)"></div>
																<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Image">
																	<i class="fa fa-pen icon-sm text-muted"></i>
																	<input type="file" name="faviconUpload" accept=".png" />
																	<input type="hidden" name="profile_avatar_remove" />
																</label>
																<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span>
																<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span> 
															</div>
															<span class="form-text text-muted">Allowed file types:  png <strong>ONLY</strong></span>
														</div>
                                                     </div>

                                                     <div>
																<input type="submit" name="faviconSubmit" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Submit"/>
																
															</div>
                                                      </div>
                                            </form>
                                            <!--favicon-->




                                            <form method="post">
                                                                    <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label"><strong>Activate/Deactivate Annual Result</strong></label>
																		

                                                                            

                                                                        
																	</div>
																	
                                                             <div>
															
															<div>
																
                                                                <?php echo  $annualResultButton;?>
																
															</div>
                                                        </div>
                                                    </form>





                                                    <form method="post">
                                                                    <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label"><strong>Activate/Deactivate Student Login</strong></label>
																		

                                                                            

                                                                        
																	</div>
																	
                                                             <div>
															
															<div>
																
                                                                <?php echo  $studentLoginButton;?>
																
															</div>
                                                        </div>
                                                    </form>
                                                      




                                            


																
                                                                   
																	

                                                                    
                                                                    
															

                                                                 
            
                                                                    


                                                           
														<!--end::Form Wizard Step 1-->
														
														<!--begin::Wizard Actions-->
														
														<!--end::Wizard Actions-->
													
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


