<?php session_start();?>


<?php
//check if data is inputed before loading this page
if($_SESSION['newAdminFirstname'] =="")
    {
header("Location: index.php" );
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
?>'

<?php 
$pinPrivilege="";
if($pinManagement=="YES")
{
 $pinPrivilege='<div class="form-group row">
 <label class="col-3 col-form-label">Pin Management</label>
 <div class="col-9 col-form-label">
   <div class="radio-inline">
     <label class="radio radio-success">
     <input type="radio" name="pin-management"  value="YES"/>
     <span></span>Yes</label>
     <label class="radio radio-danger">
     <input type="radio" name="pin-management" checked="checked" value="NO"/>
     <span></span>No</label>
     
   </div>
   <span class="form-text text-muted"></span>
 </div>
                         </div>';
}


$settingsPrivilege="";
if($settings=="YES")
{
 $settingsPrivilege=' <div class="form-group row">
 <label class="col-3 col-form-label">Settings Management</label>
 <div class="col-9 col-form-label">
   <div class="radio-inline">
     <label class="radio radio-success">
     <input type="radio" name="settings"  value="YES" />
     <span></span>Yes</label>
     <label class="radio radio-danger">
     <input type="radio" name="settings" checked="checked" value="NO" />
     <span></span>No</label>
     
   </div>
   <span class="form-text text-muted"></span>
 </div>
                         </div>';
}

?>

















<?php
//extract admin information
$newAdminQuery = "SELECT * FROM administration where First_Name ='".$_SESSION['newAdminFirstname']."' and Middle_Name='".$_SESSION['newAdminMidname']."'and Last_Name='".$_SESSION['newAdminLastname']."'and Gender='".$_SESSION['newAdminGender']."'and 
          Status ='".$_SESSION['newAdminStatus']."'and Phone='".$_SESSION['newAdminPhone']."'and Email='".$_SESSION['newAdminEmail']."'";
        $newAdminResult = mysqli_query($con, $newAdminQuery);
	
	
	
	
	
while ($newAdminRow = mysqli_fetch_array($newAdminResult))
{
    $_SESSION['sno'] = $newAdminRow['Sno'];

   
    $username = $_SESSION['newAdminFirstname'] . $_SESSION['sno'] ;
    

   //generate username
   $updateUsernameQuery = "Update administration set Username = '".$username."'
     
    Where  Sno = '". $_SESSION['sno']."'";


    $updateUsername = mysqli_query($con,  $updateUsernameQuery);
  

}			


	
?>











<?php
//extract extract username 
$extractUsernameQuery = "SELECT * FROM administration where  Sno ='".$_SESSION['sno']."' ";
       $extractUsernameResult = mysqli_query($con, $extractUsernameQuery);
	
	
	
	
	
while ($extractUsernameRow = mysqli_fetch_array($extractUsernameResult))
{
    $_SESSION['username'] = $extractUsernameRow['Username'];


}			
?>

<?php

$check = "SELECT * FROM privileges where AdminUsername = '". $_SESSION['username']."'";
$rs = mysqli_query($con, $check);
//$data = mysqli_fetch_array($rs, MYSQLI_NUM);
$num_rows =mysqli_num_rows($rs);
$data=mysqli_fetch_array($rs);


     
     if( $_SESSION['username'] != $data['AdminUsername'])
     {


$insertQuery = "INSERT INTO privileges (AdminUsername, StudentManagement, AddEditStudents, AdminManagement, ResultManagement,siteManagement,PinManagement,Settings) VALUES
('".$_SESSION['username']."',' ',' ',' ',' ',' ',' ',' ')";  
 $insertQueryResult = mysqli_query($con, $insertQuery);     
	
     }
       
      
       


?>






<?php
$sucUpdate="";
$errorUpdate="";

$updatePrivilegesQuery="";

if(isset($_POST['submit']))
{
       
  if($studentManagement!="YES")
  {
  
    $_POST['student-management'] ="";
  
  }
  if($addEditStudentM !="YES")
  {
  
    $_POST['add-edit-student'] ="";
  
  }
  if($adminManagement !="YES")
  {
  
    $_POST['admin-management'] ="";
  
  }

  if($siteManagement !="YES")
  {
  
    $_POST['site-management'] ="";
  
  }

  if($resultManagement !="YES")
  {
  
    $_POST['result-management'] ="";
  
  }






  if($pinManagement!="YES")
{

  $_POST['pin-management']="";

}

if($settings !="YES")
  {
  
    $_POST['settings'] ="";
  
  }
       
 
    //insert privileges
   $updatePrivilegesQuery = "Update privileges set StudentManagement = '".$_POST['student-management']."', AddEditStudents = '".$_POST['add-edit-student']."', AdminManagement = '".$_POST['admin-management']."',
    ResultManagement = '".$_POST['result-management']."', siteManagement = '".$_POST['site-management']."', PinManagement = '".$_POST['pin-management']."', Settings = '".$_POST['settings']."'
     
    Where  AdminUsername = '". $_SESSION['username']."'";


           


$updatePrivilegesResult ="";
    
    if($updatePrivilegesQuery)
    
    
    {
    
        $updatePrivilegesResult = mysqli_query($con, $updatePrivilegesQuery);
    }
    
    
    
    
    
    if($updatePrivilegesResult)
    {
    
    header("Location: add-new-admin-crosscheck.php");
    exit;
    
    }
    
    
    
    
    
    else if (!$updatePrivilegesResult)
    
    
    {
    
     echo $errorUpdate= "Error";
      exit;
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
    <title>Privileges</title>
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
      <div class="row user"  style=" margin-top:5%; margin-left:25%">
        <div class="col-md-12">
          <div class="profile" >
            
            <!--<div class="cover-image"></div>-->

            <!--begin::Card-->
										<div class="card card-custom gutter-b example example-compact"  style="width:70%;">
											<div class="card-header">
												<h3 class="card-title">Assign Privileges</h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
														
													</div>
												</div>
											</div>
											<div class="card-body">
												<!--begin::Form-->
												<form class="form" method="post" style="padding-left:20%;">
                                                <?php 
                                                    
                                                    if($studentManagement =="YES")
                                                    { 

                                                    ?>
													<div class="form-group row">
														<label class="col-3 col-form-label">Student Management</label>
														<div class="col-9 col-form-label">
															<div class="radio-inline">
																<label class="radio radio-success">
																<input type="radio" name="student-management"  value="YES"/>
																<span></span>Yes</label>
																<label class="radio radio-danger">
																<input type="radio" name="student-management" checked="checked" value="NO" />
																<span></span>No</label>
																
															</div>
															<span class="form-text text-muted"></span>
														</div>
                                                    </div>
                                                    <?php }?>
                                                    

                                                    <?php 
                                                    
                                                    if($addEditStudentM =="YES")
                                                    { 

                                                    ?>
                                                    <div class="form-group row">
														<label class="col-3 col-form-label">Add/Edit Students</label>
														<div class="col-9 col-form-label">
															<div class="radio-inline">
																<label class="radio radio-success">
																<input type="radio" name="add-edit-student" value="YES" />
																<span></span>Yes</label>
																<label class="radio radio-danger">
																<input type="radio" name="add-edit-student" checked="checked" value="NO"/>
																<span></span>No</label>
																
															</div>
															<span class="form-text text-muted"></span>
														</div>
                                                    </div>

                                                    <?php }?>


                                                    <?php 
                                                    
                                                    if($adminManagement =="YES")
                                                    { 

                                                    ?>
                                                    <div class="form-group row">
														<label class="col-3 col-form-label">Admin Management</label>
														<div class="col-9 col-form-label">
															<div class="radio-inline">
																<label class="radio radio-success">
																<input type="radio" name="admin-management" value="YES" />
																<span></span>Yes</label>
																<label class="radio radio-danger">
																<input type="radio" name="admin-management" checked="checked" value="NO"/>
																<span></span>No</label>
																
															</div>
															<span class="form-text text-muted"></span>
														</div>
                                                    </div>

                                                    <?php }?>




                                                    <?php 
                                                    
                                                    if($resultManagement=="YES")
                                                    { 

                                                    ?>

                                                    <div class="form-group row">
														<label class="col-3 col-form-label">Result Management</label>
														<div class="col-9 col-form-label">
															<div class="radio-inline">
																<label class="radio radio-success">
																<input type="radio" name="result-management"  value="YES"/>
																<span></span>Yes</label>
																<label class="radio radio-danger">
																<input type="radio" name="result-management" checked="checked" value="NO"/>
																<span></span>No</label>
																
															</div>
															<span class="form-text text-muted"></span>
														</div>
                                                    </div>

                                                    <?php }?>



                                                    <?php 
                                                    
                                                    if($siteManagement=="YES")
                                                    { 

                                                    ?>

                                                    <div class="form-group row">
														<label class="col-3 col-form-label">Site Management</label>
														<div class="col-9 col-form-label">
															<div class="radio-inline">
																<label class="radio radio-success">
																<input type="radio" name="site-management"  value="YES"/>
																<span></span>Yes</label>
																<label class="radio radio-danger">
																<input type="radio" name="site-management" checked="checked" value="NO"/>
																<span></span>No</label>
																
															</div>
															<span class="form-text text-muted"></span>
														</div>
                                                    </div>
                                                    <?php }?>


                                                   <?php echo $pinPrivilege; ?>

                                                   <?php echo $settingsPrivilege;?>

                                                    <div>
														<input type="submit" name="submit" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:2%; width:60%" value="Submit"/>
																
												</div>
													
												</form>
												<!--end::Form-->
												 
											</div>
										</div>
										<!--end::Card-->
            
        





            

          





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
  


  

    
    
    
        
    
    
    
    
    
    
    



  



                     

                     


    








