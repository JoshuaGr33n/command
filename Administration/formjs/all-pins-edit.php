




<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: ../index.php" );
exit;
}

include('../include/db.php');





?>
<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag5="pin manager";
$currentPageTag="all pin";


if($pageActiveTag5="pin manager"){

    $studentsExpand="";
    $ExpandAdmin="";
    $ExpandResults="";
    $ExpandSiteManager="";
    $ExpandPinManager="is-expanded";
    $ExpandSettings="";
    


}

if($currentPageTag="all pin"){
  
  $allPinCurrentPageTag="active";
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
  $studentsActiveTag="";
  $dashboardActiveTag="";
  $setResultMarkCurrentPageTag="";



}






?>
<?php 
// side bar and header
           include('../include/privilege-restrictions.php');


?>







<?php if($pinManagement!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>




<?php

//output all from classes table
        $allClassesQuery = "SELECT * FROM classes";
        $allClassesResult = mysqli_query($con, $allClassesQuery);
	
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





if(isset($_POST["submit"]) && $_POST["submit"]!="") {
$usersCount = count($_POST["studentReg"]);
for($i=0;$i<$usersCount;$i++) {
mysqli_query($con, "UPDATE pinlogin set StudentID='" . $_POST["studentReg"][$i] . "', Class='" . $_POST["class"][$i] . "' , Session='" . $_POST["session"][$i] . "' , Term='" . $_POST["term"][$i] . "'  , LoginCount='" . $_POST["loginCount"][$i] . "' , Status='" . $_POST["status"][$i] . "'  WHERE serial='" . $_POST["ID"][$i] . "'");
}
header("Location:../all-pins.php");
}
?>
<?php 

$rowCount = count($_POST["users"]);
if ($_POST["users"]=="")
{

    header("Location:../all-pins.php");
    exit;


}





?>
<?php

//output all from school_session table
        $allSessionQuery = "SELECT * FROM school_session";
        $allSessionResult = mysqli_query($con, $allSessionQuery);
	
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
    <title>Pin</title>
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
          <h1><i class="fa fa-th-list"></i> All Pins </h1>
          <p></p>
        </div>
       
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
         <a href="../all-pins.php" class="btn btn-sm btn btn-success font-weight-bold py-2 px-3 px-xxl-5 my-1">Back</a>
        
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
$result = mysqli_query($con, "SELECT * FROM pinlogin WHERE serial='" . $_POST["users"][$i] . "'");
$row[$i]= mysqli_fetch_array($result);
?>



    

       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Pin</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['PinCode']; ?>"  disabled/></td>
                                                                            
	  </div>
       </div>


       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Reg Number</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="hidden" name="ID[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['serial']; ?>"><input type="text" name="studentReg[]" class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['StudentID']; ?>"></td>
                                                                            
	  </div>
       </div>

       <?php 

$classes_query= $con->prepare("SELECT className FROM classes WHERE className NOT IN('GRADUATED STUDENT')");
  
$classes_query->execute();                            
$classes_query->Store_result();                       
$classes_query->bind_result($classes);  


     ?>


       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Class</label>
      <div class="col-lg-6 col-xl-6">
      
      
      <select class="form-control form-control-lg form-control-solid"  name="class[]">
                 <option value="<?php echo $row[$i]['Class']; ?>"><?php echo $row[$i]['Class']; ?></option>
                 <option value="">---Empty---</option>
                 <?php
                  while ($classes_query->fetch())
                  {

                 
                 ?>
                 <option value="<?php echo $classes;?>"><?php echo $classes;?></option> 
                <?php }?>
      </select>                                                                   
	  </div>
       </div>


       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Session</label>
      <div class="col-lg-6 col-xl-6">
      
     



                                                         <select class="form-control form-control-lg form-control-solid"  name="session[]">
                                                                        <option value="<?php echo $row[$i]['Session']; ?>"><?php echo $row[$i]['Session']; ?></option>
                                                                        <option value="">---Empty---</option>
                                                            <?php  while ($allSessionRow = mysqli_fetch_array($allSessionResult))
                                                             {
                                                                //output all from school_session table
                                                                 $school_Session_id =$allSessionRow['sessionID']; 
                                             
                                                                $school_SessionName = $allSessionRow['sessionName'];
                                                                
                                                                ?>

                                                                <option value="<?php echo $school_SessionName;?>"><?php echo $school_SessionName ;?></option>
                                                                <?php }?>
                                                        </select></td>
                                                                            
	  </div>
       </div>



       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Status</label>
      <div class="col-lg-6 col-xl-6">
      <select class="form-control form-control-lg form-control-solid" name="status[]">
                                                                          <option value="<?php echo $row[$i]['Status']; ?>"><?php echo $row[$i]['Status']; ?></option>
                                                                          <option value="Available">Available</option>
                                                                          <option value="Used">Used</option>
                                                                         



                                                          
       <select>
      
     
                                                                            
	  </div>
       </div>

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Term</label>
                                 <div class="col-lg-6 col-xl-6">
																		<select class="form-control form-control-lg form-control-solid" name="term[]">
                                                                          <option value="<?php echo $row[$i]['Term']; ?>"><?php echo $row[$i]['Term']; ?></option>
                                                                          <option value="">--Empty--</option>
                                                                          <option value="First">First Term</option>
                                                                          <option value="Second">Second Term</option>
                                                                          <option value="Third">Third Term</option>
                                                                          <option value="Annual Result">Annual Result</option>
                                                                          



                                                          
                                                                        <select>
																		<span class="form-text text-muted"></span>
																	</div>
                                   </div></td>


       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Number of Times Used</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" name="loginCount[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['LoginCount']; ?>"/></td>
                                                                            
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


