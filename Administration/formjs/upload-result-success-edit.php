




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
// side bar and header
           include('../include/privilege-restrictions.php');


?>



$setResultMarkCurrentPageTag="";



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
$usersCount = count($_POST["ca1"]);
for($i=0;$i<$usersCount;$i++) {


    $total = ((int)$_POST["ca1"][$i]+(int)$_POST["ca2"][$i]+(int)$_POST["ca3"][$i]+(int)$_POST["exam"][$i]);
    $average= $total/4;
    $average=round($average);
    $sch_grade=get_grade($total);




mysqli_query($con, "UPDATE results set CA1='" . $_POST["ca1"][$i] . "', CA2='" . $_POST["ca2"][$i] . "' , CA3='" . $_POST["ca3"][$i] . "' , Total='" . $total . "', Average='" . $average . "', Grade='" . $sch_grade[grade] . "', Remark='" . $sch_grade[remark]. "', Publish='" . $_POST["publish"][$i] . "'    WHERE Sno='" . $_POST["ID"][$i] . "'");
}
header("Location:../results-suc.php");
}
?>
<?php 

$rowCount = count($_POST["sno"]);
if ($_POST["sno"]=="")
{

    header("Location:../upload-result-success.php");
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
$result = mysqli_query($con, "SELECT * FROM results WHERE Sno='" . $_POST["sno"][$i] . "'");
$row[$i]= mysqli_fetch_array($result);
?>



      <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Reg Number</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="hidden" name="ID[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['Sno']; ?>"><input type="text" class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['StudentReg']; ?>" disabled/></td>
                                                                            
	  </div>
       </div>

       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">CA 1</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" name="ca1[]" class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['CA1']; ?>"  /></td>
                                                                            
	  </div>
       </div>


       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">CA 2</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" name="ca2[]" class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['CA2']; ?>"></td>
                                                                            
	  </div>
       </div>


       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">CA 3</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="hidden" name="ca3[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['CA3']; ?>"></td>
                                                                            
	  </div>
       </div>



       <div class="form-group row">
     <label class="col-xl-3 col-lg-3 col-form-label">Exam</label>
      <div class="col-lg-6 col-xl-6">
      
      <input type="text" name="exam[]"  class="form-control form-control-lg form-control-solid" value="<?php echo $row[$i]['Exam']; ?>"/></td>
      </div>
       </div>




     

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Publish</label>
                                 <div class="col-lg-6 col-xl-6">
																		<select class="form-control form-control-lg form-control-solid" name="publish[]">
                                                                          <option value="<?php echo $row[$i]['Publish']; ?>"><?php echo $row[$i]['Publish']; ?></option>
                                                                         
                                                                          <option value="Yes">Yes</option>
                                                                          <option value="No">No</option>
                                                                         



                                                          
                                                                        <select>
																		<span class="form-text text-muted"></span>
																	</div>
                                   </div></td>


       
                                                                            
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


