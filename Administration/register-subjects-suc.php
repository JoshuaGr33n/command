<?php session_start();?>
<?php
if( $_SESSION['Adminusername'] =="")
{
header("Location: index.php" );
exit;
}


//database connection
include('include/db.php');

$_SESSION['Sid'] =$_GET['studentID'];




if($_GET['studentID']=="")
{
    header("Location: index.php" );
exit;
}
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

 include('include/privilege-restrictions.php');


?>



<?php if($studentManagement!="YES")
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

$updateLink="";
$deleteLink="";
$addNewLink="";
if($addEditStudentM=="YES" && $studentManagement=="YES")
{
 $updateLink='<li class="breadcrumb-item active"><button name="update" onClick="setUpdateAction();"  class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Update</button></li>';
 $deleteLink='<li class="breadcrumb-item active"><button name="delete" onClick="setDeleteAction();"  class="btn btn-sm btn-danger  font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Delete</button></li>';
 $addNewLink='<button type="button"  class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;" data-toggle="modal" data-target="#myModal">Add New Subject</button>';
 }

?>

<?php

//output all from subjects table
        $allSubjectsQuery = "SELECT * FROM subjects";
        $allSubjectsResult = mysqli_query($con, $allSubjectsQuery);
	
?>








<?php

	
	
$studentDetailQuery = "SELECT * FROM students where student_id= '".$_GET['studentID']."'";
$studentDetailResult = mysqli_query($con, $studentDetailQuery);

$studentDetailrow = mysqli_fetch_array($studentDetailResult);
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



?>
<?php

$current_class = substr($class, 0, 5);





if($current_class =="SSS 1"){

  $School="Senior Secondary School 1";
      
      
      }
else{
    
    $current_class = substr($class, 0, 3);
    
    if($current_class =="JSS")
    {
     $School="Junior Secondary School";
    
    }
    
    else if ($current_class =="SSS"){
    
    $School="Senior Secondary School";
    
    }

    else{
      header("Location: dashboard.php");
      exit;
    }
  }   
?>
<?php
$sucResult=mysqli_query($con, "SELECT * FROM `registered_subjects` WHERE `StudentID` ='$student_id' and  `current_class` ='$class' and  `School` ='$School'");




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
    <title>Register Subjects</title>
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





    



<!--edit and delete form script-->

<script language="javascript" src="formjs/register-subjects-suc.js" type="text/javascript"></script>
<!--edit and delete form script-->







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




<!--modal-->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--modal-->




      </head>
  <body class="app sidebar-mini">
    

          <?php 
// side bar and header
           include('include/nav_header.php');


        ?>


    <main class="app-content">
      <div class="app-title">
      <div>
          <h1><i class="fa fa-th-list"></i> Registered Subject: <strong><?php echo $fname?> <?php echo $lname;?>(<?php echo $regNum;?>)</strong></h1>
          <p></p>
        </div>


        <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <a type="button"  class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;" href="registered-subjects.php?studentID=<?php echo $student_id;?>">Registered Subjects</a>
        
          <a type="button"  class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;" href="register-subjects.php?studentID=<?php echo $student_id;?>">Back</a>
  

          
          
        </ul>





      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              
              <form name="frmUser" method="post" action="">
                <table class="table table-bordered  table-striped" id="sampleTable" style="width:60%; margin-left:18%">
                
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="selectall"/> Select all</th>
                      <th>Class</th>
                      <th>Subject</th>
                      <th>Subject ID</th>
                      <th>School</th>
                     
                      
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                 while ($Row = mysqli_fetch_array($sucResult))
                 {
                     $sno = $Row['SerialNo'];
                     $regSubClass = $Row['current_class'];
                     
                   
                     $regSchool = $Row['School'];
                     
                     $regSubRegNum = $Row['StudentID'];
                     $subName = $Row['subjectName'];
                     $subID = $Row['subjectID'];
                  
                   
                   
            
                   
                   			
                   
                     ?>
                    <tr><td><input type="checkbox" name="users[]" value="<?php echo $Row['SerialNo']; ?>" class="name" /></td>
                   
                      <td> <?php echo $regSubClass;?></td>
                      <td> <?php echo $subName;?></td>
                      <td> <?php echo $subID;?></td>
                      <td> <?php echo $regSchool;?></td>
                      
                      
                      

                      
                      
                    </tr>
                   <?php }?>

                   

                    
                    
                  </tbody>
                   
                </table>
                <tr>
                       
                    </tr>
                    </form>
              
                    <ul class="app-breadcrumb breadcrumb side">
          <!--<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>-->
          <!--<li class="breadcrumb-item"></li>-->
          <li><button name="delete" onClick="setDeleteAction();"  class="btn btn-sm btn-danger  font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Delete</button></li>
          <li><button name="update" onClick="setUpdateAction();"  class="btn btn-sm btn-primary  font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Update</button></li>
        </ul>

        </form>
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
    
  </body>
</html>


<script src="js/classedit/bootstable.js"></script>
<script src="js/classedit/editable.js"></script>