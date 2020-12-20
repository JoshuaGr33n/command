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


$pageActiveTag="All Students";
$currentPageTag="All Students";



if($pageActiveTag="All Students"){

  $studentsExpand="is-expanded";
  $ExpandAdmin="";
  $ExpandResults="";
  $ExpandSiteManager="";
  $ExpandPinManager="";
    


}

if($currentPageTag="All Students"){

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
  $addnewStudentsCurrentPageTag="";
  $promoteStudentsCurrentPageTag="";
  $classPositionCurrentPageTag="";
  $updateSchoolDetailsCurrentPageTag="";
  $importRegSubjectCurrentPageTag="";

  $allSubjectCurrentPageTag="";

  $allSessionCurrentPageTag="";
  $sportHouseCurrentPageTag="";
  $allClassesCurrentPageTag="";
  $studentsActiveTag="active";
  $dashboardActiveTag="";



}








?>

<?php 
// side bar and header
           include('include/privilege-restrictions.php');


?>



<?php if($studentManagement!="YES")
{
    header("Location: index.php" );
exit;
}
?>
<?php

$addNewstudentLink="";
$exportLink="";
$importLink="";
$exportallStudentLink="";

if($addEditStudentM=="YES" && $studentManagement=="YES")
{
 $addNewstudentLink='<li class=""><a href="add-new-student.php" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Add New Student +</a></li>';
 $exportLink=' <li class="">
 <form method="post" action="exports/all-students-export-template.php">
 <button name="export" class="btn btn-sm btn-secondary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Export template in Excel Format</button>
 </form>
 </li>';

 $importLink='<li class=""><a href="import-students.php" class="btn btn-sm btn-warning font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Import</a></li>';
 
 $exportallStudentLink=' <li class="">
 <form method="post" action="exports/all-students-export.php">
 <button name="export" class="btn btn-sm btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:80px;">Export all Students in Excel Format</button>
 </form>
 </li>';
}

?>



<?php

//output all from students table
        $allStudentQuery = "SELECT * FROM students";
        $allStudentResult = mysqli_query($con, $allStudentQuery);
	
	




?>



<?php
 


  if(isset($_POST["promote"])) {
    $newclass= $_POST['promoteClass'];
  $rowCount = count($_POST["studentID"]);
  for($i=0;$i<$rowCount;$i++) {
  
   
  mysqli_query($con, "UPDATE students set Class = '".$_POST['promoteClass']."' WHERE student_id='" .  $_POST["studentID"][$i]. "'");
            
  }
  header("Location: classmates.php?classmate=$newclass");
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
    <title>All-Students</title>
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
          <h1><i class="fa fa-th-list"></i> All Students </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
        <?php echo  $exportallStudentLink;?>
         <?php echo  $exportLink;?>
         <?php echo  $importLink;?>
        <?php echo $addNewstudentLink;?>
        
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped"  id="sampleTable">


                
                
                  <thead>
                    <tr>
                      <th>Passport</th>
                      <th>Name</th>
                      <th>Class</th>
                      <th>Term</th>
                      <th>Session</th>
                      <th>Gender</th>
                      <th>House Colour</th>
                      <th>Registration Number</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   while ($allStudentRow = mysqli_fetch_array($allStudentResult))
                   {
                   //output all from students table
                    $student_id =$allStudentRow['student_id']; 

                   $FirstName = $allStudentRow['FirstName'];
                   $MiddleName = $allStudentRow['MiddleName'];
                   $LastName = $allStudentRow['LastName'];
                   $class = $allStudentRow['Class'];
                   $session = $allStudentRow['session'];
                   $term = $allStudentRow['Term'];
                   $SportHouseColour = $allStudentRow['SportHouse'];
                   $pic = $allStudentRow['ProfilePic'];
                   $gender = $allStudentRow['Gender'];
                   $DOB = $allStudentRow['DOB'];
                   $RegNumber = $allStudentRow['RegNum'];
                   $status = $allStudentRow['status'];

                   if ($status=="Activated")
                   {

                   $status="Active";

                   }



                   
                   
                   
                   
            
                   
                   			
                   
                     ?>
                    <tr>
                      <td><img src="images/student-passport/<?php echo $pic;?>" height="60" width="60" class="rounded"/></td>
                      <td><a href="student-details.php?studentID=<?php echo $student_id;?>" style="text-decoration:none"> <?php echo strtoupper($FirstName);?> <?php echo strtoupper($MiddleName);?> <?php echo strtoupper($LastName);?></a></td>
                      <td><?php echo $class;?></td>
                      <td><?php echo $term;?> Term</td>
                      <td><?php echo $session;?></td>
                      <td><?php echo $gender;?></td>
                      <td><?php echo $SportHouseColour;?></td>
                      <td><?php echo $RegNumber;?></td>
                      <td><?php echo $status;?></td>
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

     <!--begin::Global Theme Bundle(used by all pages)-->
     <script src="external/plugins/global/plugins.bundle526f.js?v=7.0.8"></script>
       
       <script src="external/plugins/custom/prismjs/prismjs.bundle526f.js?v=7.0.8"></script>
       <script src="external/js/scripts.bundle526f.js?v=7.0.8"></script>
       
       <!--end::Global Theme Bundle-->
       



<!--begin::Page Vendors(used by this page)-->
<script src="external/plugins/custom/datatables/datatables.bundle526f.js?v=7.0.8"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="external/js/pages/crud/datatables/extensions/buttons526f.js?v=7.0.8"></script>
<!--end::Page Scripts-->
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
<?php unset($_SESSION['delete_Student_id']);?>



