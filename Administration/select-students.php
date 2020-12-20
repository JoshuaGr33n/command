<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}

if( $_SESSION['classResultSession']=="")
{
header("Location: dashboard.php" );
exit;
}


//database connection
include('include/db.php');




?>
<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag3="Results";
$currentPageTag="search result by Class";


if($pageActiveTag3="Results"){

  $studentsExpand="";
  $ExpandAdmin="";
  $ExpandResults="is-expanded";
  $ExpandSiteManager="";
  $ExpandPinManager="";

    


}

if($currentPageTag="search result by Class"){
  
  $searchResultByClassCurrentPageTag="active";
  $allPinCurrentPageTag="";
  $pinGeneratorCurrentPageTag="";
  $resultPageManagerCurrentPageTag="";
  $frontPageManagerCurrentPageTag="";
  $downloadResultClassCurrentPageTag="";
  $importResultClassCurrentPageTag="";
  $searchResultClassCurrentPageTag="";
  $allStudentResultClassCurrentPageTag="";
  
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



<?php 

if($resultManagement!="YES")
{
  header("Location: index.php" );
  exit;
}
?>

<?php

//output all from students table
        $classResultQuery = "SELECT * FROM results where  school_session ='".$_SESSION['classResultSession']."'and class ='".$_SESSION['classResultClass']."'and Term ='". $_SESSION['classResultTerm']."'
        Group By StudentReg";
        $classResultResult = mysqli_query($con,  $classResultQuery);
	
	




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
    <title>All Students Results</title>
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
  </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Students of <strong><?php echo $_SESSION['classResultClass'];?>-<?php echo $_SESSION['classResultSession'];?>-<?php echo $_SESSION['classResultTerm'];?> Term</strong></h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li><a href="com-class-results.php" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:700px;">Comprehensive Result</a></li>
          <li><a href="select-result-class-category.php" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Current Class</th>
                      <th>Registration ID</th>
                      <th>View Term Result</th>
                      <th>View Annual Result</th>
                    </tr>
                  </thead>
                  <tbody>


                



                   <?php
                   while ($classResultRow = mysqli_fetch_array($classResultResult))
                   {
                   //output all from students table
                    $studentID =$classResultRow['StudentID']; 
                    $class =$classResultRow['class'];




                    $studentDetailQuery = "SELECT * FROM students where student_id= '". $studentID."'";
                   $studentDetailResult = mysqli_query($con, $studentDetailQuery);
                   
                   $studentDetailrow = mysqli_fetch_array($studentDetailResult);
                  
                   $fname = $studentDetailrow['FirstName'];
                   $mName = $studentDetailrow['MiddleName'];
                   $lname = $studentDetailrow['LastName'];
                   $RegNumber = $studentDetailrow['RegNum'];
                   $current_class = $studentDetailrow['Class'];

                  
                   
            
                   
                   			
                   
                     ?>
                    <tr>
                      <td><a href="student-details.php?studentID=<?php echo $studentID;?>" style="text-decoration:none"> <?php echo strtoupper($fname);?> <?php echo strtoupper($lname);?></a></td>
                      <td><?php echo $current_class;?></td>
                      <td><?php echo $RegNumber;?></td>
                      <td><a href="student-term-result.php?studentID=<?php echo $studentID;?>" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="text-decoration:none; margin-left:30%;">View Result</a></td>
                      <td><a href="student-annual-result.php?studentID=<?php echo $studentID;?>" class="btn btn-sm btn-warning font-weight-bold py-2 px-3 px-xxl-5 my-1" style="text-decoration:none; margin-left:30%;">View Annual Result</a></td>
                    </tr>
                   <?php }?>

                   

                    
                    
                  </tbody>
                   
                </table>
              </div>
            </div>
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


