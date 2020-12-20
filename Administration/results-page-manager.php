<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}





include('include/db.php');







?>
<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag4="site manager";
$currentPageTag="result page";


if($pageActiveTag4="site manager"){

    $studentsExpand="";
    $ExpandAdmin="";
    $ExpandResults="";
    $ExpandSiteManager="is-expanded";
    $ExpandPinManager="";

    


}

if($currentPageTag="result page"){
    $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $resultPageManagerCurrentPageTag="active";
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

$schoolLogoQuery="";

if(isset($_POST['school-logo']))
{

	$dir="../images/";
    $image=$_FILES['logo']['name'];
    $temp_name=$_FILES['logo']['tmp_name'];
 
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


        if($_FILES['logo']['size']>5000)
        {



        

    //update logo 
   $schoolLogoQuery = "Update sitemanager set Content = '".$image."'
     
    Where  tag = 'school_logo'";



     

    

        }

 $schoolLogoResult ="";
    
    if($schoolLogoQuery)
    
    
    {
    
        $schoolLogoResult = mysqli_query($con, $schoolLogoQuery);
    }
    
    
    
    
    
    if($schoolLogoResult)
    {
    
        header("Location: results-page-manager.php");
    
    }
    
    
    
    
    
   
  }
?>





<?php
$sucUpdate="";
$errorUpdate="";

$schoolStampQuery="";

if(isset($_POST['school-stamp-submit']))
{

	$dir="../images/";
    $image=$_FILES['school-stamp']['name'];
    $temp_name=$_FILES['school-stamp']['tmp_name'];
 
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


        if($_FILES['school-stamp']['size']>5000)
        {



        

    //update administration table
    $schoolStampQuery = "Update sitemanager set Content = '".$image."'
     
    Where  tag = 'school_stamp'";


    

        }

        $schoolStampResult ="";
    
    if($schoolStampQuery)
    
    
    {
    
        $schoolStampResult = mysqli_query($con, $schoolStampQuery);
    }
    
    
    
    
    
    if($schoolStampResult)
    {
    
        header("Location: results-page-manager.php");
    
    }
    
    
    
    
    
   
  }
?>






<?php

//output status from the administration table
        $outputStatusQuery = "SELECT * FROM administration";
        $outputStatusResult = mysqli_query($con, $outputStatusQuery);
	
?>






<?php
  



 $resultpageQuery = "SELECT * FROM sitemanager where tag='school_logo'";
 $resultpageResult = mysqli_query($con, $resultpageQuery);

$row = mysqli_fetch_array($resultpageResult);
$school_logo = $row['Content'];
?>


<?php
  



 $resultpageQuery = "SELECT * FROM sitemanager where tag='school_stamp'";
 $resultpageResult = mysqli_query($con, $resultpageQuery);

$row = mysqli_fetch_array($resultpageResult);
$school_stamp = $row['Content'];
?>







<?php
  

  $termQuery = "SELECT * FROM term WHERE Status= 'Current'";
  $termResult = mysqli_query($con, $termQuery);
  
  $termRow = mysqli_fetch_array($termResult);
  
  $term = $termRow['Term'];
 
 
 
 
 
 
 
  $sessionQuery = "SELECT * FROM school_session WHERE Status= 'Current'";
  $sessionResult = mysqli_query($con, $sessionQuery);
  
  $sessionRow = mysqli_fetch_array($sessionResult);
  
  $showSession = $sessionRow['sessionName'];
 
  







 






$resumptionDateQuery = "SELECT * FROM resumption_date WHERE term='$term' AND session='$showSession'";
$resumptionDateResult = mysqli_query($con, $resumptionDateQuery);

$resumptionDaterow = mysqli_fetch_array($resumptionDateResult);
$r_date = $resumptionDaterow['date'];
?>



	
  





	



<?php  if(isset($_POST["r_dateButton"])) {


$ck_row=mysqli_query($con, "SELECT  session, term FROM  resumption_date WHERE  session ='$showSession'  AND term='$term'");
            
if(mysqli_num_rows($ck_row) < 1){
mysqli_query($con, "INSERT INTO `resumption_date`( `date`,  `session`, `term` ) VALUES ('".$_POST["r_date"]."','$showSession','$term') ");
}



if(mysqli_num_rows($ck_row) == 1) {

  mysqli_query($con, "UPDATE resumption_date set  date='".$_POST["r_date"]."' WHERE session ='$showSession'  AND term='$term'");


}

header("Location:results-page-manager.php");
exit;  

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
    <title>Site Management - Results Page</title>
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
												<h3 class="card-title"> Result-Page Manager</h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
                                                    
                                                    
                                                   
                                                    
													</div>
												</div>
											</div>
											<div class="card-body">


                                            <!--school logo-->
                                            <form class="form" id="kt_form_1" method="post"  enctype="multipart/form-data">
														<!--begin::Form Wizard Step 1-->
														<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                                            <h3 class="mb-10 font-weight-bold text-dark"><strong>Result Page Manager:</strong></h3>
                                                            
                                                <form  class="form" id="kt_form_1" method="post"  enctype="multipart/form-data">
															<div class="form-group row">
													 <label class="col-xl-3 col-lg-3 col-form-label"><strong> School Logo</strong></label>
													<div class="col-lg-9 col-xl-6">
														<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(images/profile-pics/blank.png)">
															<div class="image-input-wrapper" style="background-image: url(../images/<?php echo $school_logo;?>)"></div>
																<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Image">
																	<i class="fa fa-pen icon-sm text-muted"></i>
																	<input type="file" name="logo" accept=".png, .jpg, .jpeg" />
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
																<input type="submit" name="school-logo" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Submit"/>
																
															</div>
                                                      </div>
                                            </form>
                                            <!--School Logo-->




                                              <!--School stamp-->
                                              <form class="form" id="kt_form_1" method="post"  enctype="multipart/form-data">
														<!--begin::Form Wizard Step 1-->
														<div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                                            <h3 class="mb-10 font-weight-bold text-dark"></h3>
                                                            
                                                <form  class="form" id="kt_form_1" method="post"  enctype="multipart/form-data">
															<div class="form-group row">
													 <label class="col-xl-3 col-lg-3 col-form-label"><strong> School Stamp</strong></label>
													<div class="col-lg-9 col-xl-6">
														<div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url(images/profile-pics/blank.png)">
															<div class="image-input-wrapper" style="background-image: url(../images/<?php echo $school_stamp;?>)"></div>
																<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Image">
																	<i class="fa fa-pen icon-sm text-muted"></i>
																	<input type="file" name="school-stamp" accept=".png, .jpg, .jpeg" />
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
																<input type="submit" name="school-stamp-submit" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Submit"/>
																
															</div>
                                                      </div>
                                            </form>
                                            <!--School Stamp-->


                                           



                                                              

                                                                   <!--Resumption date-->

                                                     
         





                                                                   <form method="post">


												                 <div class="form-group row " style="margin-top:5%;">
																		<label class="col-xl-3 col-lg-3 col-form-label"><strong>Resumption Date</strong></label>
																		<div class="col-lg-6 col-xl-6">
                                                                            <input class="form-control form-control-lg form-control-solid" name="r_date" type="text" value="<?php echo $r_date ;?>"  id="kt_inputmask_2"/>
                                                                            
                                                                        </div>

                                                                            
                                                                        
                                                                        

                                                                    </div>

                                                                    <div>
																                <input type="submit" name="r_dateButton" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Submit"/>
																
                                                                    </div>
                                                                    
                                                                    </form>



                                                                <!--Resumption Date-->     


                                                    
                      

                                                            <!--Annoucement

                                                                <form method="post">
                                                                    <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label"><strong>Annoucement</strong></label>
																		<div class="col-lg-6 col-xl-6">
                                                                          
                                                                            <textarea   class="form-control form-control-lg form-control-solid" style="margin-top:20px;" rows="5" cols="50" name="annoucement"><?php //echo $annoucement;?></textarea>
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


         <!--begin::Page Scripts(used by this page) For input-masks(Date of Birth field)-->
         <script src="external/js/pages/crud/forms/widgets/input-mask526f.js?v=7.0.8"></script>
        <!--begin::Page Scripts(used by this page) For input-masks-->
        

        <!--begin::Page Scripts(used by this page) for all form validation-->
		<script src="external/js/form-controlsForNewAdmin526f.js?"></script>
        <!--end::Page Scripts-->
        
        
        
        




  </body>
</html>


