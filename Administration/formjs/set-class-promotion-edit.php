




<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


include('../include/db.php');





?>
<?php
$setResultMarkCurrentPageTag="";
//If a link in the nav bar is active


$pageActiveTag="All Students";
$currentPageTag="promote-students";



if($pageActiveTag="All Students"){

  
  $studentsExpand="is-expanded";
   $ExpandAdmin="";
   $ExpandResults="";
   $ExpandSiteManager="";
   $ExpandPinManager="";
  


}








if($currentPageTag="promote-students"){
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
  $promoteStudentsCurrentPageTag="active";
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
           include('../include/privilege-restrictions.php');


?>



<?php if($studentManagement!="YES")
{
    header("Location: ../index.php" );
exit;
}
?>












<?php





if(isset($_POST["submit"]) && $_POST["submit"]!="") {

$usersCount = count($_POST["promote_from"]);
for($i=0;$i<$usersCount;$i++) {

    $ck_row=mysqli_query($con, "SELECT Promote_From, Promote_To  FROM  `class_promotion` WHERE Promote_From ='" . $_POST["promote_from"][$i] . "' AND  Promote_To ='" . $_POST["promote_to"][$i] . "'");

if($_POST["promote_from"]!=$_POST["promote_to"] && mysqli_num_rows($ck_row) < 1){
mysqli_query($con, "UPDATE class_promotion SET Promote_From ='" . $_POST["promote_from"][$i] . "', Promote_To ='" . $_POST["promote_to"][$i] . "' WHERE Sno ='" . $_POST["ID"][$i] . "'");
    }
}
header("Location:../set-class-promotion.php");
}
?>
<?php 

$rowCount = count($_POST["users"]);
if ($_POST["users"]=="")
{

    header("Location:../set-class-promotion.php");
    exit;


}
?>
<?php

//output all from classes table
        $allClassesQuery = "SELECT * FROM classes WHERE className NOT IN('GRADUATED STUDENT')";
        $allClassesResult = mysqli_query($con, $allClassesQuery);
	
?>


<?php

	
	//query for class link
		$Query = "SELECT * FROM classes";
    $Result = mysqli_query($con, $Query);
	
	
	
	
	
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
    <title>Edit</title>
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
          <h1><i class="fa fa-th-list"></i> Edit</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
        
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
$result = mysqli_query($con, "SELECT * FROM class_promotion WHERE Sno='" . $_POST["users"][$i] . "'");
$row[$i]= mysqli_fetch_array($result);
?>



      <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Promote From</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="hidden" name="ID[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['Sno']; ?>">
     
      <select  class="form-control form-control-lg form-control-solid" name="promote_from[]">
                                      <option value="<?php echo $row[$i]['Promote_From']; ?>"><?php echo $row[$i]['Promote_From']; ?></option>
                                         <?php   while ($allClassesRow = mysqli_fetch_array($allClassesResult))
                                             {
                                            //output all from classes table
                                           $class_id =$allClassesRow['classID'];
                                           $class_name =$allClassesRow['className'];
                                             ?>
                                                                  
                                                                  
                                                                  
                                                

                                                                
										<option value="<?php echo $class_name;?>"><?php echo $class_name;?></option>
													<?php }?>
								</select>




                              
      </td>
                                                                            
	  </div>
       </div>


       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Promote To</label>
      <div class="col-lg-6 col-xl-6">
          

          <select  class="form-control form-control-lg form-control-solid" name="promote_to[]">
                                      <option value="<?php echo $row[$i]['Promote_To']; ?>"><?php echo $row[$i]['Promote_To']; ?></option>
                                         <?php   while ($allClassesRow2 = mysqli_fetch_array($Result))
                                             {
                                            //output all from classes table
                                           $class_id2 =$allClassesRow2['classID'];
                                           $class_name2 =$allClassesRow2['className'];
                                             ?>
                                                                  
                                                                  
                                                                  
                                                

                                                                
										<option value="<?php echo $class_name2;?>"><?php echo $class_name2;?></option>
													<?php }?>
		     </select>
          
          
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


