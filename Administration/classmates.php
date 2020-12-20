<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}

if( $_GET['classmate'] =="")
{
header("Location: allclasses.php" );
exit;
}

//database connection
include('include/db.php');



//check for wrong url input

$check = "SELECT * FROM students where Class = '".$_GET['classmate']."'";
$rs = mysqli_query($con, $check);
//$data = mysqli_fetch_array($rs, MYSQLI_NUM);
$num_rows =mysqli_num_rows($rs);
$data=mysqli_fetch_array($rs);


$class_name=$data['Class'];




if($_GET['classmate'] != $data['Class'])
   {
	 

	 header("Location: allclasses.php" );
    exit;


   }





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

if($studentManagement!="YES")
{
    header("Location: index.php" );
exit;
}
?>




<?php

$addNewstudentLink="";
$exportLink="";
$importLink="";
$promoteButton= "";
$class_reg_subjects="";
$formTeacherButton="";


if($addEditStudentM=="YES" && $studentManagement=="YES")
{
 $addNewstudentLink='<li><a href="add-new-student.php" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Add New Student +</a></li>';
 $exportLink='
 <form method="post" action="exports/register-subjects-export.php?classmate='.$data['Class'].'">
 <li><button name="export" class="btn btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Export Registered Subject Template</button></li>
 </form>';

 $importLink='<li><a href="import-students.php" class="btn btn-sm btn-warning font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Import</a></li>';
 $class_reg_subjects='<li><a href="class-reg-subjects.php?classmate='.$data['Class'].'" class="btn btn-sm btn-warning font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Registered Subjects</a></li>';

$promoteButton= '<input type="submit" name="promote" class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-left:25%;" style="margin-left:25%; width:50%" value="Promote"/>';
$formTeacherButton='<input type="submit" name="submitbutton" class="btn btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-left:25%; width:50%" value="Apply"/>';
}

?>


<?php

//output all classmates from table
        $allClassmateQuery = "SELECT * FROM students where class= '".$_GET['classmate']."'";
        $allClassmateResult = mysqli_query($con, $allClassmateQuery);

        $classmate=$_GET['classmate'];


        
	
        




?>



<?php

//output all from classes table
        $allClassQuery = "SELECT * FROM classes";
        $allClassResult = mysqli_query($con, $allClassQuery);
	
        




?>













  <?php
 


  if(isset($_POST["promote"])) {
    $newclass= $_POST['promoteClass'];
  $rowCount = count($_POST["studentID"]);
  for($i=0;$i<$rowCount;$i++) {
  
   
  mysqli_query($con, "UPDATE students set Class = '".$_POST['promoteClass']."' WHERE student_id='" .$_POST["studentID"][$i]. "'");
  mysqli_query($con, "UPDATE registered_subjects SET current_class='".$_POST['promoteClass']."'
  WHERE StudentID='".$_POST["studentID"][$i]."'");
            
  }
  header("Location: classmates.php?classmate=$newclass");
  exit;
  
  
  }
  ?>
  
  





  <?php

//output all from admin table
        $allAdminQuery = "SELECT * FROM administration";
        $allAdminResult = mysqli_query($con,  $allAdminQuery);
?>




<?php
 


if(isset($_POST["submitbutton"])) {


 

           
           
            
            

           
 mysqli_query($con, "UPDATE classes set  FormTeacher='" . $_POST["teacher"] . "' where className ='".$_GET['classmate']."'");


            





header("Location:classmates.php?classmate=$classmate");
exit;


}
?>


<?php 



	

	
$teacherUsernameQuery = "SELECT FormTeacher FROM classes where className ='".$classmate."'";
$teacherUsernameResult = mysqli_query($con, $teacherUsernameQuery);

$teacherUsernameRow = mysqli_fetch_array($teacherUsernameResult);

$teacherUsername = $teacherUsernameRow['FormTeacher'];





$teacherQuery = "SELECT * FROM administration where Username ='".$teacherUsername."'";
$teacherResult = mysqli_query($con, $teacherQuery);

$teacherRow = mysqli_fetch_array($teacherResult);

$teacher = $teacherRow['First_Name'].' '.$teacherRow['Last_Name'];









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
    <title><?php echo $_GET['classmate'] ;?></title>
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
          <h1><i class="fa fa-th-list"></i> <?php echo $data['Class'];?> </h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i></i></li>
          <li><a href="allclasses.php" class="btn btn-danger font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:20px;">Back</a></li>
         
          <?php echo $exportLink;?>
          <?php echo  $class_reg_subjects;?>
          
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
 
               <form method="post" name="frmUser">
              <div class="row">
              <div class="col-xl-6">
              <div class="form-group row">
								<label class="col-xl-3 col-lg-3 col-form-label">Promote</label>
										<div class="col-lg-9 col-xl-9">
                       <select class="form-control form-control-lg form-control-solid" name="promoteClass">
                            <option value=""> <?php echo $data['Class'];?> </option>
                      <?php
                      while ($allClassRow = mysqli_fetch_array($allClassResult))
                   {
                   //output all from students table
                    $classid =$allClassRow['classID']; 

                   $className = $allClassRow['className'];
                  
                   ?>
                    <option value="<?php echo $className;?>"><?php echo $className;?></option>
                    <?php }?>
                    <span class="form-text text-muted" style="color:red;"></span>
                   
                                                                            
                                                                            
                   </select>
                                                                            
																		</div>
                                  </div>
                   </div>
                   <div class="row">
                   <div class="col-xl-6">
                   <div class="form-group row">
                   <?php echo $promoteButton;?>
																
                    </div>
                    </div>
                   </div>
                   </div>

                  



                    




                <table class="table table-hover table-bordered table-striped" id="sampleTable">
                
                  <thead>
                    <tr>
                    <th><input type="checkbox" id="selectall"/> Select all</th>
                      <th>Name</th>
                      <th>Current Class</th>
                      <th>Current Term</th>
                      <th>Current Session</th>
                      <th>Gender</th>
                      <th>House Colour</th>
                      <th>Registration Number</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   while ($allClassmateRow = mysqli_fetch_array($allClassmateResult))
                   {
                   //output all from students table
                    $student_id =$allClassmateRow['student_id']; 

                   $FirstName = $allClassmateRow['FirstName'];
                   $MiddleName = $allClassmateRow['MiddleName'];
                   $LastName = $allClassmateRow['LastName'];
                   $class = $allClassmateRow['Class'];
                   $session = $allClassmateRow['session'];
                   $term = $allClassmateRow['Term'];
                   $SportHouseColour = $allClassmateRow['SportHouse'];
                   $pic = $allClassmateRow['ProfilePic'];
                   $gender = $allClassmateRow['Gender'];
                   $DOB = $allClassmateRow['DOB'];
                   $RegNumber = $allClassmateRow['RegNum'];
                   
                   
                   
            
                   
                   			
                   
                     ?>
                    <tr>
                      <td><input type="checkbox" name="studentID[]" value="<?php echo $allClassmateRow['student_id']; ?>" class="name" /></td>
                      <td><a href="student-details.php?studentID=<?php echo $student_id;?>"> <?php echo $FirstName ;?> <?php echo $LastName ;?></a></td>
                      <td><?php echo $class;?></td>
                      <td><?php echo $term;?> Term</td>
                      <td><?php echo $session;?></td>
                      <td><?php echo $gender;?></td>
                      <td><?php echo $SportHouseColour;?></td>
                      <td><?php echo $RegNumber;?></td>
                    </tr>
                   <?php }?>

                    
                    
                  </tbody>
                   
                </table>

                </form>
              </div>


              <form method="post">
											<div class="card-body">
												<table class="table table-striped">
                        <div class="form-group row">
																		<label class="col-xl-3 col-lg-3 col-form-label">Form Teacher:</label>
																		<div class="col-lg-6 col-xl-6">
																			<div class="input-group input-group-lg input-group-solid">
																				<div class="input-group-prepend">
																					<span class="input-group-text">
																						<i class="la la-at"></i>
																					</span>
																				</div>
                                        <select required class="form-control form-control-lg form-control-solid" name="teacher">
                                                            <option value="<?php echo $teacher; ?>">--<?php echo $teacher; ?>--</option>
                                                             <?php   while ($allAdminRow = mysqli_fetch_array($allAdminResult))
                                                                 {
                                                                   //output all from classes table
                                                                  $first_name =$allAdminRow['First_Name'];
                                                                  $last_name =$allAdminRow['Last_Name'];
                                                                  $username =$allAdminRow['Username'];


                                                                  
                                                                  
                                                                  
                                                                  ?>
                                                                  
                                                                  
                                                                  
                                                

                                                                
																<option value="<?php echo  $username;?>"><?php echo  $first_name;?> <?php echo  $last_name;?></option>
																<?php }?>
																
															</select>
                                                                                
                                                                              
                                                                            
                            
                                                                            </div>
                                                                            <span class="form-text text-muted"></span>
																		</div>
																	</div>
                                                
                                               



                                  <div>
															
															<div>
																<?php echo $formTeacherButton;?>
																
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


<?php
unset($_SESSION['reg_subjects_Session']);



?>