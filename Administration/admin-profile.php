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
$appoint = $adminDetailRow['privileged_Status'];
$restriction = $adminDetailRow['Restriction'];




}	

if($appoint!=="None"){

$showAppoint="($appoint)";



}

else

{
  $showAppoint="";

}




	
  

if($profilePic=="")
{

$emptypic="blank.png";
}

else{

 $emptypic="";


}
	
	?>

<?php
$deactivateLink='<button name="deactivate" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="color:#fff; margin-right:60px;">Deactivate This User </button>';
$activateLink='<button name="activate" class="btn btn-sm btn-warning font-weight-bold  py-2 px-3 px-xxl-5 my-1" style="color:#fff; margin-right:60px;">Reactivate This User</button>';

$editDQuery="";

if(isset($_POST['deactivate']))
{
        

        

    //update administration table
   $editDQuery = "Update administration set Restriction = 'Deactivated'
     
    Where  Sno = '". $sno ."'";

	$editDResult ="";
    
    if($editDQuery)
    
    
    {
    
      $editDResult = mysqli_query($con, $editDQuery);
    }
    
    
    
    
    
    if($editDResult)
    {
    
        header("Location: admin-profile.php?adminID=$sno");
    
    }
    
    
    

        


  }
?>



<?php


$editAQuery="";

if(isset($_POST['activate']))
{
        

        

    //update administration table
   $editAQuery = "Update administration set Restriction = 'Activated'
     
	Where  Sno = '". $sno ."'";
	



	if($editAQuery)
    
    
    {
    
      $editAResult = mysqli_query($con, $editAQuery);
    }
    
    
    
    
    
    if($editAResult)
    {
    
      header("Location: admin-profile.php?adminID=$sno");
    
    }


    

        


  }
  ?>



<?php 
														
														if($restriction=="Deactivated")
														{
														$signal= "<div class='btn btn-light-danger font-weight-bold'>$restriction</div>";

														}

														else{


															$signal="";
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
    <title>Admin Profile: <?php echo $fname;?> <?php echo $lname;?></title>
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
												<h3 class="card-title"> <a href="all-admins.php" class="btn btn-sm btn btn-secondary font-weight-bold py-2 px-3 px-xxl-5 my-1">Back</a></h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
                                                    <form method="post">

                             <?php 
														
														if($restriction=="Activated")
														{
														echo $deactivateLink;

														}

														else{


															echo $activateLink;
														}




														
														?>
														
                                                    
                                                    </form>
                                                    <a href="admin-upload-signature.php?adminID=<?php echo $sno;?>" class="btn btn-sm btn-info font-weight-bold py-2 px-3 px-xxl-5 my-1" style="color:#fff; margin-right:5px;">Upload Signature</a>

                                                   
                                                    <a href="view-admin-privileges.php?adminID=<?php echo $sno;?>" class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1" style="color:#fff; margin-right:5px;">View Privileges</a>
                                                    
                                                    
                                                    <a href="edit-admin-profile.php?adminID=<?php echo $sno;?>" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="color:#fff;">Edit Profile</a>
                                                    
													</div>
												</div>
											</div>
											<div class="card-body">
												<table class="table table-striped">
                                                <tr style="background:none;">
                                                  <td><img src="images/profile-pics/<?php echo $profilePic; echo $emptypic;?>"  style="border: 1px #000 solid"  width="100" height="100"/></td>  
                                                  <td></td>  


                                                </tr>
                                                
                                                <tr>
                                                  <td>First Name:</td>  
                                                  <td><div  style="margin-left:20%"><?php echo $fname;?></div></td>  


                                                </tr>
                                                <tr>
                                                  <td>Middle Name:</td>  
                                                  <td><div  style="margin-left:20%"><?php echo $mName;?></div></td>  


                                                </tr>
                                                <tr>
                                                  <td>Last Name:</td>  
                                                  <td><div  style="margin-left:20%"><?php echo $lname ;?></div></td>  


                                                </tr>


                                                <tr>
                                                  <td>Gender:</td>  
                                                  <td><div  style="margin-left:20%"><?php echo $gender;?></div></td>  


                                                </tr>

                                                <tr>
                                                  <td>Phone:</td>  
                                                  <td><div  style="margin-left:20%"><?php echo $fone;?></div></td> 
                                                  
                                                

                                                 

                                                </tr>
                                                <tr>
                                                  <td>Email:</td>  
                                                  <td><div  style="margin-left:20%"><?php echo $email ;?></div></td> 
                                                  
                                                

                                                 

                                                </tr>


                                                <tr>
                                                  <td>Username:</td>  
                                                  <td><div  style="margin-left:20%"><?php echo $username;?>	<?php echo $signal;?></div></td>  


                                                </tr>
                                                 

                                                

                                                <tr>
                                                  <td>Status:</td>  
                                                  <td><div  style="margin-left:20%"><?php echo $status;?><?php echo $showAppoint;?></div></td> 
                                                  
                                                

                                                 

                                                </tr>
                                                
                                                 

                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                               </table>
												 
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


<?php
unset($_SESSION["reEmail"]);
unset($_SESSION["genPass"]);
unset($_SESSION["emailFail"]);


?>