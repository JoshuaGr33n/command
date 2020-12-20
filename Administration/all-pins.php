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


$pageActiveTag5="pin manager";
$currentPageTag="all pin";


if($pageActiveTag5="pin manager"){

    $studentsExpand="";
    $ExpandAdmin="";
    $ExpandResults="";
    $ExpandSiteManager="";
    $ExpandPinManager="is-expanded";

    


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



}






?>
<?php 
// side bar and header
include('include/privilege-restrictions.php');


?>



<?php if($pinManagement!="YES")
{
    header("Location: index.php" );
exit;
}
?>

<?php

//output all from classes table
        $Query = "SELECT * FROM pinlogin";
        $Result = mysqli_query($con, $Query);
	
?>






<?php// if(isset($_POST['subupdate']))
//{

    //$updateClass="Update classes set className ='".$_POST['fname']."'
    //where student_id='".$student_id."'";

//}
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
    <title>All Pins</title>
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

<script language="javascript" src="formjs/all-pins.js" type="text/javascript"></script>
<script language="javascript" src="formjs/all-used-pins.js" type="text/javascript"></script>
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
          <h1><i class="fa fa-th-list"></i> All Pins</h1>
          <p></p>
        </div>
         

        <ul class="app-breadcrumb breadcrumb side">
        <form method="post" action="exports/all-pins-export.php">
        <li><button name="exportUnusedPins"   class="btn btn-sm btn-warning  font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Export all Unused Pins in Excel Format</button></li>
          </form>
          <form method="post" action="exports/all-pins-export.php">
        <li><button name="exportAllPins"   class="btn btn-sm btn-primary  font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Export All Pins in Excel Format</button></li>
        </form>
       
        <li><button name="deleteUsedPins" onClick="setDeleteUsedPinsAction();"  class="btn btn-sm btn-danger  font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Delete All Used Pins</button></li>
      

                   
        </ul>



      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              
              <form name="frmUser" method="post" action="">
                <table class="table table-bordered  table-striped" id="sampleTable" style="width:100%;">
                
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="selectall"/> Select all</th>
                      <th>Student Name</th>
                      <th>Registration Number</th>
                      <th>Pin</th>
                      <th>Class</th>
                      <th>Session</th>
                      <th>Term</th>
                      <th>Status</th>
                      <th>Number of Times Used</th>
                      <th>Time</th>
                      <th>Last Login</th>
                      <?php 

   $pin_query= $con->prepare("SELECT serial, StudentID, PinCode, class, Session, Term, Status, LoginCount, Time, last_login FROM pinlogin ");
  
   $pin_query->execute();                            
   $pin_query->Store_result();                       
   $pin_query->bind_result($pinSno,$student_reg,$pinCode,$pinClass, $pinSession,$pinTerm,$pinStatus, $pinLoginCount,$time, $last_login);  
   
   
?>
                      
                     
                      
                      
                      
                      
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   while ($pin_query->fetch())
                   {
                   

                    $student_query= $con->prepare("SELECT FirstName, LastName, RegNum FROM students WHERE RegNum= '$student_reg' ");


                    $student_query->execute();                            
                    $student_query->Store_result();                       
                    $student_query->bind_result($fname,$lname, $reg_num);  
                    $student_query->fetch();
                    $student_query->close();

                   

                  
                   
                   
            
                   
                   			
                   
                     ?>
                    <tr>
                      <td><input type="checkbox" name="users[]" value="<?php echo $pinSno; ?>" class="name" /></td>
                      <td><?php  if($student_reg==$reg_num){echo  $fname; ?> <?php echo  $lname; }?></td>
                      <td><?php echo  $student_reg; ?></td>
                      <td><?php echo  $pinCode;?></td>
                      <td><?php echo  $pinClass;?></td>
                      <td><?php echo  $pinSession;?></td>
                      <td><?php echo  $pinTerm;?></td>
                      <td><?php echo  $pinStatus;?></td>
                      <td><?php echo  $pinLoginCount;?></td>
                      <td><?php echo  $time;?></td>
                      <td><?php echo  $last_login;?></td>
                     
                      

                      
                      
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
          <li><button name="update" onClick="setUpdateAction();"  class="btn btn-sm btn-primary font-weight-bold py-2 px-3 px-xxl-5 my-1" style="margin-right:10px;">Update</button></li>
        </ul>
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