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



<?php 

if($studentManagement!="YES")
{
    header("Location: index.php" );
exit;
}

if($addEditStudentM!="YES")
{
    header("Location: index.php" );
exit;
}


?>



<?php

//If a link in the nav bar is active


$pageActiveTag="All Students";

$dashboardActiveTag="";
$studentsActiveTag="";

if($pageActiveTag=="All Students"){

     $studentsActiveTag="active";


}

if($pageActiveTag=="Dashboard"){

    $dashboardActiveTag="active";


}

?>


<?php


$err="";
$success="";
$wrongformat="";
$updateAlert="";
if (isset($_POST['import_students'])) {
    
   if($_FILES['import']['name']=="")
   {

    header("Location: import-students.php");
    exit;


   }

   
   
   


    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    if(!empty($_FILES['import']['name']) && in_array($_FILES['import']['type'],$file_mimes)){
        if(is_uploaded_file($_FILES['import']['tmp_name'])){   
            $csv_file = fopen($_FILES['import']['tmp_name'], 'r'); 
            $rows=1;
            while(($getData = fgetcsv($csv_file)) !== FALSE){
              if($rows++ !=1){
                $ck_row=mysqli_query($con, "SELECT  RegNum FROM  `students` WHERE RegNum='$getData[3]' ");
                $RegNumUpperCase=strtoupper($getData[3]);
                $FirstNameUpperCase=strtoupper($getData[0]);
                $MidNameUpperCase=strtoupper($getData[1]);
                $LastNameUpperCase=strtoupper($getData[2]);

                $ck_rowCheckClass=mysqli_query($con, "SELECT  className FROM  `classes` WHERE className='$getData[4]' ");




                $outputCurrentSessionResult = mysqli_query($con, "SELECT * FROM  `school_session` WHERE Status='Current' ");
   

                $outputCurrentSessionRow = mysqli_fetch_array($outputCurrentSessionResult);

                $currentSession = $outputCurrentSessionRow['sessionName'];



                $outputCurrentTermResult= mysqli_query($con, "SELECT  * FROM  `term`  WHERE Status='Current' ");
  

                $outputCurrentTermRow = mysqli_fetch_array($outputCurrentTermResult);

                $currentTerm = $outputCurrentTermRow['Term'];


               



                
                
                if($getData[0]=="")
                {

                  header("Location: import-students.php");
                  exit;
              
              
                 }
                 if($getData[2]=="")
                 {
 
                   header("Location: import-students.php");
                   exit;
               
               
                  }
                 if($getData[5]=="")
                 {
 
                   header("Location: import-students.php");
                   exit;
               
               
                  }

                 if($getData[5]!=="Male" && $getData[5]!=="Female")
                {

                  header("Location: import-students.php");
                  exit;
              
              
                 }

                 if(mysqli_num_rows($ck_rowCheckClass) < 1){


                  header("Location: import-students.php?wrongClass=<div class='btn btn-light-danger font-weight-bold'>The Class inputed does not exist. Please create a Class first for this before import");
                  exit;



                 }
                 


                 
                 


                if(mysqli_num_rows($ck_row) < 1 && $getData[5]!==""){

                 
                 
                  mysqli_query($con, "INSERT INTO `students`(`student_id`, `FirstName`, `MiddleName`, `LastName`, `RegNum`, `Class`, `Gender`, `DOB`,`session`,`Term`, `SportHouse`, `ProfilePic`, `Address`, `State_Of_Origin`, `LGA`, `Phone`, `Email`,  `status`) VALUES (NULL, '$FirstNameUpperCase','$MidNameUpperCase','$LastNameUpperCase','$RegNumUpperCase','$getData[4]','$getData[5]','$getData[6]','$currentSession','$currentTerm','$getData[7]',' ','$getData[8]','$getData[9]','$getData[10]','$getData[11]','$getData[12]','Activated') ");
                  $success= ' <button  class="btn btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1"> Successfully Imported !!</button>';
                  $uploadsuccessResult = mysqli_query($con, "SELECT * FROM  `students` WHERE Class='$getData[4]'  AND Session='$currentSession' AND Term='$currentTerm'");
                                                  
                
                
                
                
                
                }
                
                else{

                  //$err=' <button  class="btn btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1"> Some Information already exist</button>';

                
                  $updateAlert=' <button  class="btn btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1"> Some records were not imported because the registration number(s) already exist</button>';
                  $uploadsuccessResult = mysqli_query($con, "SELECT * FROM  `students` WHERE Class='$getData[4]'  AND Session='$currentSession'AND Term='$currentTerm'");
                  $success="";
                }
              }
            }
            fclose($csv_file);
            
        }
    }else{
      header('Location: import-students.php?wrongformat=<button  class="btn btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1">Wrong Format, Upload as CSV</button>');
      exit;
    }
    
 
       
            

   } ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Import Students</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
       <!--begin::Global Theme Styles(used by all pages)-->
       <link href="external/plugins/global/plugins.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		
        <link href="external/css/style.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
        
		<!--end::Global Theme Styles-->



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Main CSS-->


    
		
    


    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    div#response.display-block {
	display: block;
}
</style>
  </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Import Students</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li><a href="import-students.php" class="btn btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Back</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
               


                <?php //echo  $err;?>
                <?php echo $updateAlert;?>
                   <?php echo  $success;?>
                   <?php echo  $wrongformat;?>




                   <table class="table table-bordered  table-striped" id="sampleTable">
                
                <thead>
                  <tr>
                  
                    <th>Registration Number</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    
                    <th>Last Name</th>
                    <th>Session</th>
                    <th>Term</th>
                    <th>Class</th>
                    <th>Sport House</th>
                    <th>Gender</th>
                    <th>D.O.B</th>
                    <th>Address</th>
                    <th>Stato of Origin</th>
                    <th>LGA</th>
                    <th>Phone</th>
                    <th>Email</th>
                   
                    
                  </tr>
                </thead>
                <tbody>
                 <?php
                 while ($uploadsuccessRow = mysqli_fetch_array($uploadsuccessResult))
                 {
               
                 
                 
                 
          
                 
                       
                 
                   ?>
                  <tr>
                   <!-- <td><input type="checkbox" name="sno[]" value="<?php //echo $uploadsuccessRow['Sno']; ?>" class="name" /></td>-->
                    <td><a href="student-details.php?studentID=<?php echo $uploadsuccessRow['student_id']; ?>"> <?php echo $uploadsuccessRow['RegNum'];?></a></td>
                    
                   
                    <td><?php echo $uploadsuccessRow['FirstName'];?></td>
                    <td><?php echo $uploadsuccessRow['MiddleName'];?></td>
                    <td><?php echo $uploadsuccessRow['LastName'];?></td>
                    <td><?php echo $uploadsuccessRow['session'];?></td>
                    <td><?php echo $uploadsuccessRow['Term'];?></td>
                    <td><?php echo $uploadsuccessRow['Class'];?></td>
                    <td><?php echo $uploadsuccessRow['SportHouse'];?></td>
                    <td><?php echo $uploadsuccessRow['Gender'];?></td>
                    <td><?php echo $uploadsuccessRow['DOB'];?></td>
                    <td><?php echo $uploadsuccessRow['Address'];?></td>
                    <td><?php echo $uploadsuccessRow['State_Of_Origin'];?></td>
                    <td><?php echo $uploadsuccessRow['LGA'];?></td>
                    <td><?php echo $uploadsuccessRow['Phone'];?></td>
                    <td><?php echo $uploadsuccessRow['Email'];?></td>
                   
                    

                    
                   
                  </tr>
                 <?php  }?>

                  
                  
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
         <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>

        <!--begin::Page Scripts(used by this page) for all form validation-->
		<script src="external/js/form-controlsForUploadResult526f.js"></script>
        <!--end::Page Scripts-->
        
        <!--begin::Page Scripts(used by this page) For input-masks(Date of Birth field)-->
        <script src="external/js/pages/crud/forms/widgets/input-mask526f.js?v=7.0.8"></script>
        <!--begin::Page Scripts(used by this page) For input-masks-->
        
        <!--script for state and LGA drop down list-->
        <script src="jsForStateDropList/lga.min.js"></script>
       <!--script for state and LGA drop down list-->

  </body>
</html>


