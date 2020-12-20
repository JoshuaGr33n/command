




<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: ../index.php" );
exit;
}

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
//database connection
include('../include/db.php');





?>

<?php 
// side bar and header
           include('../include/privilege-restrictions.php');


?>







<?php if($resultManagement!="YES")
{
    header("Location: ../dashboard.php" );
exit;
}
?>



<?php

	
	
$studentDetailQuery = "SELECT * FROM students where student_id= '".$_SESSION['classResultStudentID']."'";
$studentDetailResult = mysqli_query($con, $studentDetailQuery);




// Loop through each row, outputting the login and password
while ($studentDetailrow = mysqli_fetch_array($studentDetailResult))
{
$student_id = $studentDetailrow['student_id'];





}			



?>







<?php


include('../include/grading.php');




if(isset($_POST["submit"]) && $_POST["submit"]!="") {




$usersCount = count($_POST["ca1"]);
for($i=0;$i<$usersCount;$i++) {




?>
<?php 
$session_for_edit = $_SESSION['classResultSession'];
$term_for_edit = $_SESSION['classResultTerm'];


include('grading-for-edit.php');


?>


<?php

if($_POST["ca1"][$i]<=$ca1_score && $_POST["ca2"][$i]<=$ca2_score && $_POST["ca3"][$i]<=$ca3_score && $_POST["exam"][$i] <=$exam_score){


mysqli_query($con, "UPDATE results set CA1='" . $_POST["ca1"][$i] . "', CA2='" . $_POST["ca2"][$i] . "' , CA3='" . $_POST["ca3"][$i] . "' , Exam='" . $_POST["exam"][$i] . "', Total='" . $total . "', Average='" . $average . "', Grade='" . $sch_grade[grade] . "', Remark='" . $sch_grade[remark]. "'  WHERE Sno='" . $_POST["sno"][$i] . "'");
}
}
header("Location:../student-term-result.php?studentID=$student_id");


       
       

    
      
}
?>
<?php 

$rowCount = count($_POST["users"]);
if ($_POST["users"]=="")
{

    header("Location:../student-term-result.php?studentID=$student_id");
    exit;


}
?>

<?php

$session_for_edit = $_SESSION['classResultSession'];
$term_for_edit = $_SESSION['classResultTerm'];

$school_class = substr($_SESSION['classResultClass'], 0, 3);
if($school_class=="JSS")
{
 $School="Junior Secondary School";


}

else if ($school_class=="SSS"){

$School="Senior Secondary School";


}




  $query= $con->prepare("SELECT School, CA1, CA2, CA3, Exam FROM result_marks  WHERE School = '$School' AND session = '$session_for_edit' AND term = '$term_for_edit' ");
   //$query->bind_param("i", $School); // Bind search values to parameters ("iiii" : one "i" for each variable, set's data type to "int")
   $query->execute();                            // Run the query
    $query->Store_result();                       // Store the result set
    $query->bind_result($School, $ca1_score, $ca2_score, $ca3_score, $exam_score);  
    $query->fetch();
    $query->close();

    if($exam_score == 0){
      header("Location:../student-term-result.php?studentID=$student_id");
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
    <title>Results</title>
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
          <h1><i class="fa fa-th-list"></i> Results</h1>
          <p></p>
        </div>
       
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
         
          <a href="../student-term-result.php?studentID=<?php echo $student_id;?>" class="btn btn-sm btn btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Back</a>


         



        

         
         


          

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
$result = mysqli_query($con, "SELECT * FROM results WHERE Sno='" . $_POST["users"][$i] . "'");
$row[$i]= mysqli_fetch_array($result);







?>



      <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Reg Number</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="hidden" name="sno[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['Sno']; ?>"><input type="text" name="studentReg[]" class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['StudentReg']; ?>"  disabled></td>
                                                                            
	  </div>
       </div>

       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Subject</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['subject']; ?>"  disabled/></td>
                                                                            
	  </div>
       </div>


       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Class</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" name="" class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['class']; ?>" disabled/>
      <input type="hidden" name="class[]" class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['class']; ?>" /></td>                                                                            
	  </div>
       </div>


       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Session</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" name="session[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['school_session']; ?>"  disabled/></td>
                                                                            
	  </div>
       </div>

       <?php
       
        $disable_ca1 = "";

        if($ca1_score == 0){

          $row[$i]['CA1'] = 0;
         

        } 
        ?>



       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">CA 1</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" name="ca1[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['CA1']; ?>" /></td>
                                                                            
	  </div>
       </div>

       <?php
       
      
       if($ca2_score == 0){

         $row[$i]['CA2'] = 0;
        

       } 
       ?>



       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">CA 2</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" name="ca2[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['CA2']; ?>" ></td>
                                                                            
	  </div>
       </div>

       <?php
       
       

       if($ca3_score == 0){

         $row[$i]['CA3'] = 0;
         

       } 
       ?>


       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">CA 3</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" name="ca3[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['CA3']; ?>" ></td>
                                                                            
	  </div>
       </div>

       
       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Exam</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" name="exam[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['Exam']; ?>"></td>
                                                                            
	  </div>
       </div>

                                  

</td>
</tr>
<?php
}
?>


<input type="submit" name="submit" class="btn btn-success font-weight-bold text-uppercase px-9 py-4" style="margin-left:25%; width:50%" value="Submit"/>

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


