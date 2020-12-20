




<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


//database connection
include('../include/db.php');




?>
<?php 
$setResultMarkCurrentPageTag="";

$studentsExpand="";
$ExpandAdmin="";
$ExpandResults="";
$ExpandSiteManager="";
$ExpandPinManager="";




$pinGeneratorCurrentPageTag="";
  $allPinCurrentPageTag="";
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
  $studentsActiveTag="";
  $dashboardActiveTag="";
?>

<?php 
// side bar and header
           include('../include/privilege-restrictions.php');


?>



<?php if($studentManagement!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>

<?php if($addEditStudentM!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>








<?php

//output all from class table
        $allClassQuery = "SELECT * FROM classes";
        $allClassResult = mysqli_query($con, $allClassQuery);
	
?>


<?php

//output all from school_session table
        $allSessionQuery = "SELECT * FROM school_session";
        $allSessionResult = mysqli_query($con, $allSessionQuery);
	
?>


<?php

//output all from classes table
        $allSubjectsQuery = "SELECT * FROM subjects";
        $allSubjectsResult = mysqli_query($con, $allSubjectsQuery);
	
?>


<?php

	
	
$studentDetailQuery = "SELECT * FROM students where student_id= '".$_SESSION['Sid']."'";
$studentDetailResult = mysqli_query($con, $studentDetailQuery);




// Loop through each row, outputting the login and password
while ($studentDetailrow = mysqli_fetch_array($studentDetailResult))
{
$student_id = $studentDetailrow['student_id'];
$fname = $studentDetailrow['FirstName'];
$mName = $studentDetailrow['MiddleName'];
$lname = $studentDetailrow['LastName'];
$email = $studentDetailrow['Email'];
$dob = $studentDetailrow['DOB'];
$fone = $studentDetailrow['Phone'];
$term = $studentDetailrow['Term'];
$session = $studentDetailrow['session'];
$class = $studentDetailrow['Class'];
$sportHouse = $studentDetailrow['SportHouse'];
$state = $studentDetailrow['State_Of_Origin'];
$lga = $studentDetailrow['LGA'];
$address = $studentDetailrow['Address'];
$profilePic = $studentDetailrow['ProfilePic'];
$regNum = $studentDetailrow['RegNum'];
$gender = $studentDetailrow['Gender'];

$studentName= $fname .' '. $lname;




}			



?>
<?php


$current_class = substr($class, 0, 3);
// multibyte strings
//$current_class = mb_substr($Class, 0, 5);




if($current_class=="JSS")
{
 $School="Junior Secondary School";

}

else if ($current_class=="SSS"){

$School="Senior Secondary School";

}

else{
  $School="";
}


?>
<?php





if(isset($_POST["submit"]) && $_POST["submit"]!="") {


  
 



$usersCount = count($_POST["subjects"]);



for($i=0;$i<$usersCount;$i++) {

$subjectIDResult = mysqli_query($con, "SELECT subjectID FROM subjects WHERE subjectName ='" . $_POST["subjects"][$i] . "'");

  $subjectIDRow = mysqli_fetch_array($subjectIDResult);
  
  $subjectID = $subjectIDRow['subjectID'];


  $ck_row=mysqli_query($con, "SELECT subjectName,  subjectID, StudentReg, School, current_class FROM  `registered_subjects` WHERE subjectName='" . $_POST["subjects"][$i] . "' AND subjectID='$subjectID' AND StudentReg='$regNum'  AND School='$School' AND current_class='$class' ");
  if(mysqli_num_rows($ck_row) < 1){

mysqli_query($con, "UPDATE registered_subjects set subjectName='" . $_POST["subjects"][$i] . "', subjectID='" .$subjectID. "' WHERE SerialNo='" . $_POST["serial"][$i] . "'");
}

}
header("Location:../register-subjects-suc.php?studentID=$student_id");
}
?>
<?php 

$rowCount = count($_POST["users"]);
if ($_POST["users"]=="")
{

    header("Location:../register-subjects-suc.php?studentID=$student_id");
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
    <title>Subject</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    



    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Main CSS-->


    <!--begin::Global Theme Styles(used by all pages)-->
        <link href="../external/plugins/global/plugins.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="../external/plugins/custom/prismjs/prismjs.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<link href="../external/css/style.bundle526f.css?v=7.0.8" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles--> 
		
    


    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">





    






  





      </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('../include/nav_header2.php');


        ?>


    <main class="app-content">
      <div class="app-title">
      <div>
          <h1><i class="fa fa-th-list"></i> Change Subject</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <li><a  class="btn btn-sm btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1" href="../register-subjects-suc.php?studentID=<?php echo $student_id?>">Back</a></li>
        <?php //echo $addNewstudentLink;?>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">

      <form name="frmUser" method="post" action="">
<div style="width:500px;">
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center">
<tr class="tableheader">
<td></td>
</tr>
<?php



for($i=0;$i<$rowCount;$i++) {
$result = mysqli_query($con, "SELECT * FROM registered_subjects WHERE SerialNo='" . $_POST["users"][$i] . "'");
$row[$i]= mysqli_fetch_array($result);
?>



      <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label"></label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="hidden" name="serial[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['SerialNo']; ?>"></td>
                                                                            
	  </div>
       </div>


      
                                                                

																







                                                            <div class="col-xl-6">
																	<div class="form-group">
																		<label>Subjects</label>
																		<select class="form-control form-control-lg form-control-solid" name="subjects[]">
                                                                            <option value="<?php echo $row[$i]['subjectName']; ?>"><?php echo $row[$i]['subjectName']; ?></option>

                                                            <?php  while ($allSubjectsRow = mysqli_fetch_array($allSubjectsResult))
                                                             {
                                                                //output all from school_session table
                                                                 $subject_id =$allSubjectsRow['subjectID']; 
                                             
                                                                $subject_Name = $allSubjectsRow['subjectName'];
                                                                
                                                                ?>

                                                                <option value="<?php echo $subject_Name ;?>"><?php echo $subject_Name ;?></option>
                                                                <?php }?>
                                                                            <select>
																		<span class="form-text text-muted"></span>
																	</div>
																</div>
                                                            </div>






<?php
}
?>


<input type="submit" name="submit" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="width:50%" value="Submit"/>
</td>
</tr>
</table>
</div>
</form>

            </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    
  </body>
</html>


