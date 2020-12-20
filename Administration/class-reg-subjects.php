<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


if($_GET['classmate'] =="")
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
$currentPageTag="All Classes";




if($pageActiveTag="All Students"){

  
  $studentsExpand="is-expanded";
  $ExpandAdmin="";
  $ExpandResults="";
  $ExpandSiteManager="";
  $ExpandPinManager="";
  


}








if($currentPageTag="All Classes"){
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
  $allClassesCurrentPageTag="active";
  $studentsActiveTag="";
  $dashboardActiveTag="";



}







?>

<?php 
// side bar and header
           include('include/privilege-restrictions.php');


?>





<?php 

if($studentManagement!="YES" && $addNewstudentLink!="YES")
{
    header("Location: index.php" );
exit;
}
?>


<?php

$current_class = substr($_GET['classmate'], 0, 5);





if($current_class =="SSS 1"){

  $School="Senior Secondary School 1";
      
      
      }
else{
    
    $current_class = substr($_GET['classmate'], 0, 3);
    
    if($current_class =="JSS")
    {
     $School="Junior Secondary School";
    
    }
    
    else if ($current_class =="SSS"){
    
    $School="Senior Secondary School";
    
    }

    else{
      header("Location:classmates.php?classmate=$_GET[classmate]");
      exit;
    }
  }   
?>


<?php

$fetchclassesQuery = "SELECT * FROM classes where className ='".$_GET['classmate']."'";
$fetchclassesResult = mysqli_query($con, $fetchclassesQuery);

$fetchclassesRow = mysqli_fetch_array($fetchclassesResult);

$classname =  $fetchclassesRow['className'];

?>





<?php


        $allclassregSubjectQuery = "SELECT * FROM registered_subjects where School ='".$School."'and current_class ='".$_GET['classmate']."'";
        $allclassregSubjectResult = mysqli_query($con,  $allclassregSubjectQuery);

      
?>

<?php


        $allSubjectQuery = "SELECT * FROM subjects";
        $allSubjectResult = mysqli_query($con,   $allSubjectQuery );

      
?>
















  





 



<?php
 


if(isset($_POST["submitbutton"])) {

    $fetchQuery = "SELECT subjectID FROM subjects where subjectName ='".$_POST["subject"]."'";
    $fetchResult = mysqli_query($con, $fetchQuery);

    $fetchRow = mysqli_fetch_array($fetchResult);

$subjectid =  $fetchRow['subjectID'];














           
    $rowCount = count($_POST["serial"]);
    for($i=0;$i<$rowCount;$i++) {   
        
        



        $fetchRegQuery = "SELECT StudentReg FROM registered_subjects where SerialNo ='".$_POST["serial"][$i]."'";
        $fetchRegResult = mysqli_query($con, $fetchRegQuery);

        $fetchRegRow = mysqli_fetch_array($fetchRegResult);

        $reg =  $fetchRegRow['StudentReg'];




            
        $ck_row=mysqli_query($con, "SELECT  * FROM  `registered_subjects` WHERE subjectName ='".$_POST["subject"]."' AND subjectID ='".$subjectid."' AND School ='".$School."' AND current_class ='".$_GET['classmate']."' AND StudentReg ='". $reg."' ");

        if(mysqli_num_rows($ck_row) < 1){    
               mysqli_query($con, "UPDATE registered_subjects set  subjectName='" . $_POST["subject"] . "',subjectID='" . $subjectid . "' where SerialNo ='". $_POST["serial"][$i]."'");
                                        }

            
    }




header("Location:class-reg-subjects.php?classmate=$_GET[classmate]");
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
    <title>Registered Subjects for <?php echo $classname;?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   






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
          <h1><i class="fa fa-th-list"></i> <?php echo $classname;?> </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i></i></li>
          <li><a href="classmates.php?classmate=<?php echo $classname?>" class="btn btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:20px;">Back</a></li>
         
        
          
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
 
               <form method="post" name="frmUser">
             

                  



                    




                <table class="table table-hover table-bordered table-striped" id="sampleTable">
                
                  <thead>
                    <tr>
                    <th><input type="checkbox" id="selectall"/> Select all</th>
                      <th>Registration Number</th>
                      <th>Name</th>
                      <th>Subject</th>
                      <th>Subject ID</th>
                      <th>Class</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   while ( $allclassregSubjectRow = mysqli_fetch_array($allclassregSubjectResult))
                   {
                  
                   
                   
                   
            
                   
                   			
                   
                     ?>
                    <tr>
                      <td><input type="checkbox" name="serial[]" value="<?php echo  $allclassregSubjectRow['SerialNo']; ?>" class="name" /></td>
                      <td><?php echo $allclassregSubjectRow['StudentReg'];?></td>
                      <td><?php echo $allclassregSubjectRow['student_name'];?></td>
                      <td><?php echo $allclassregSubjectRow['subjectName'];?></td>
                      <td><?php echo $allclassregSubjectRow['subjectID'];?></td>
                      <td><?php echo $_GET['classmate'];?></td>
                    </tr>
                   <?php }?>

                    
                    
                  </tbody>
                   
                </table>

              
              </div>


            
											<div class="card-body">
												<table class="table table-striped">
                        <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Subjects:</label>
																		<div class="col-lg-6 col-xl-6">
																			<div class="input-group input-group-lg input-group-solid">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-at"></i>
																					</span>
																				</div>
                                        <select required class="form-control form-control-lg form-control-solid" name="subject">
                                                            <option value="">--Select Subject--</option>
                                                             <?php   while ($allSubjectRow = mysqli_fetch_array($allSubjectResult))
                                                                 {
                                                                  
                                                                  $subjectname =$allSubjectRow['subjectName'];
                                                                 
                                                                 

                                                                  ?>
                                                                  
                                                                  
                                                                  
                                                

                                                                
																<option value="<?php echo  $subjectname;?> "><?php echo  $subjectname;?></option>



                                                            
																<?php }?>
																
                                                              
															</select>
                                                                                
                                                                              
                                                                            
                            
                                                                            </div>
                                                                            <span class="form-text text-muted"></span>
																		</div>
																	</div>
                                                
                                               



                                  <div>
															
															<div>
																<input type="submit" name="submitbutton" class="btn btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-left:25%; width:50%" value="Save"/>
																
															</div>
														</div>   


                            </form>
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