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




       $allAdministratorsQuery = "SELECT * FROM administration WHERE Status IN ('Administrator', 'Teacher') AND Username NOT IN('$_SESSION[Adminusername]')";
        $allAdministratorsResult = mysqli_query($con, $allAdministratorsQuery);
	
	




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
    <title>All Admins</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--begin::Global Theme Styles(used by all pages)-->
    
		<link href="other.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Main CSS-->


    
		
    


    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">



    <!--edit and delete form script-->

<script language="javascript" src="formjs/all-admins.js" type="text/javascript"></script>
<!--edit and delete form script-->



    <!--check all boxes script-->

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>

<SCRIPT language="javascript">

    $(function () {

        // add multiple select / deselect functionality

        $("#selectall").click(function () {

            $('.name').attr('checked', this.checked);

        });

 

        // if all checkbox are selected, then check the select all checkbox

        // and viceversa

        $(".name").click(function () {

 

            if ($(".name").length == $(".name:checked").length) {

                $("#selectall").attr("checked", "checked");

            } else {

                $("#selectall").removeAttr("checked");

            }

 

        });

    });

</SCRIPT>

  </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> All Admins</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li class="breadcrumb-item active"><a href="add-new-admin.php" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Add New Administrator +</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <form name="frmUser" method="post" action="">
                <table class="table table-hover table-bordered table-striped"  id="sampleTable">
                
                  <thead>
                    <tr>
                    <th><input type="checkbox" id="selectall"/> Select all</th>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Username</th>
                      <th>Status</th>
                      <th>Appointment</th>
                      <th>Restriction</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   while ($allAdministratorsRow = mysqli_fetch_array($allAdministratorsResult))
                   {
                   //output all from students table
                    $sno =$allAdministratorsRow['Sno']; 

                   $FirstName = $allAdministratorsRow['First_Name'];
                   $MiddleName = $allAdministratorsRow['Middle_Name'];
                   $LastName = $allAdministratorsRow['Last_Name'];
                   $username = $allAdministratorsRow['Username'];
                   $email = $allAdministratorsRow['Email'];
                   $phone = $allAdministratorsRow['Phone'];
                   $pic = $allAdministratorsRow['ProfilePic'];
                   $gender = $allAdministratorsRow['Gender'];
                   $status = $allAdministratorsRow['Status'];
                   $appoint = $allAdministratorsRow['privileged_Status'];
                   $restriction = $allAdministratorsRow['Restriction'];




                  
                  
                  if($appoint=="None"){
                  
                    $appoint="";
                  
                  
                  
                  }
                  
                  if($restriction=="Deactivated"){
                  
                    $restriction="<div class='btn btn-light-danger font-weight-bold'>$restriction</div>";
                  
                  
                  
                  }

                  else{
                  
                    $restriction="<div class='btn btn-light-primary font-weight-bold'>$restriction</div>";
                  
                  
                  
                  }

                   //$studentM = $allAdministratorsRow['StudentManagement'];
                  // $addEditStudent = $allAdministratorsRow['AddEditStudents'];
                  // $adminM = $allAdministratorsRow['AdminManagement'];
                  // $resultsM = $allAdministratorsRow['ResultManagement'];
                  // $siteM = $allAdministratorsRow['siteManagement'];
                  // $pinM = $allAdministratorsRow['PinManagement'];
                   
                   
                   
            
                   
                   			
                   
                     ?>
                    <tr>
                     <td><input type="checkbox" name="users[]" value="<?php echo $allAdministratorsRow['Sno']; ?>" class="name" /></td>
                      <td><a href="admin-profile.php?adminID=<?php echo $sno;?>" style="text-decoration:none"> <?php echo $FirstName ;?> <?php echo $LastName ;?></a></td>
                      <td><?php echo  $gender;?></td>
                      <td><?php echo  $username;?></td>
                      <td><?php echo  $status;?></td>
                      <td><?php echo  $appoint;?></td>
                      <td><?php echo  $restriction;?></td>
                      
                    </tr>
                   <?php }?>

                   

                    
                    
                  </tbody>
                   
                </table>

                <ul class="app-breadcrumb breadcrumb side">
                <li class="breadcrumb-item active"><button name="delete" onClick="setDeleteAction();"  class="btn btn-sm btn-danger  font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Delete</button></li>
        
        </ul>
                </form>
              
              </div>
            </div>
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
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
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
  </body>
</html>


<?php
unset($_SESSION["insertFirstname"]);
unset($_SESSION["insertLastname"]);
unset($_SESSION["insertGender"]);
unset($_SESSION["insertAddress"]);
unset($_SESSION["insertDOB"]);
unset($_SESSION["insertGender"]);
unset($_SESSION["insertState"]);
unset($_SESSION["insertLGA"]);
unset($_SESSION["insertGender"]);
unset($_SESSION["insertClass"]);
unset($_SESSION["insertSession"]);
unset($_SESSION["insertTerm"]);
?>
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